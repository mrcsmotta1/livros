<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_exibe_formulario_do_perfil(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('profile.edit'));
        $response->assertStatus(200);
        $response->assertViewIs('profile.edit');
        $response->assertViewHas('user', function ($viewUser) use ($user) {
            return $viewUser->id === $user->id;
        });
    }

    public function test_update_atualiza_perfil(): void
    {
        $user = User::factory()->create(['name' => 'Antigo']);
        $this->actingAs($user);

        $response = $this->patch(route('profile.update'), [
            'name' => 'Novo Nome',
            'email' => $user->email, // manter email
        ]);

        $response->assertRedirect(route('profile.edit'));
        $response->assertSessionHas('status', 'profile-updated');
        $user->refresh();
        $this->assertSame('Novo Nome', $user->name);
    }

    public function test_update_alterar_email_invalida_verificacao(): void
    {
        $user = User::factory()->create([
            'email' => 'old@example.com',
            'email_verified_at' => now(),
        ]);
        $this->actingAs($user);

        $response = $this->patch(route('profile.update'), [
            'name' => $user->name,
            'email' => 'new@example.com',
        ]);

        $response->assertRedirect(route('profile.edit'));
        $user->refresh();
        $this->assertSame('new@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_destroy_exclui_conta(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->delete(route('profile.destroy'), [
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
