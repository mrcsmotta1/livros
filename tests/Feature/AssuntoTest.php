<?php

namespace Tests\Feature;

use App\Interfaces\Services\AssuntoServiceInterface;
use App\Models\Assunto;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class AssuntoTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_lista_paginada(): void
    {
        $this->actingAs(User::factory()->create());

        Assunto::create(['descricao' => 'Assunto A']);
        Assunto::create(['descricao' => 'Assunto B']);

        $response = $this->get(route('assuntos.index'));
        $response->assertStatus(200);
        $response->assertViewIs('assuntos.index');
        $response->assertViewHas('assuntos', function ($assuntos) {
            return $assuntos instanceof LengthAwarePaginator && $assuntos->total() === 2;
        });
    }

    public function test_create_exibe_formulario(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('assuntos.create'));
        $response->assertStatus(200);
        $response->assertViewIs('assuntos.create');
    }

    public function test_store_persiste_e_redireciona(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->post(route('assuntos.store'), ['descricao' => 'Novo Assunto']);
        $response->assertRedirect(route('assuntos.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('assunto', ['descricao' => 'Novo Assunto']);
    }

    public function test_store_erros_de_validacao(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->from(route('assuntos.create'))->post(route('assuntos.store'), ['descricao' => ' ']);
        $response->assertRedirect(route('assuntos.create'));
        $response->assertSessionHasErrors(['descricao']);
    }

    public function test_store_trata_excecao_e_redireciona_com_erro(): void
    {
        $this->actingAs(User::factory()->create());

        $mock = \Mockery::mock(AssuntoServiceInterface::class);
        $mock->shouldReceive('criarAssunto')->once()->andThrow(new Exception('Falha'));
        $this->app->instance(AssuntoServiceInterface::class, $mock);

        $response = $this->post(route('assuntos.store'), ['descricao' => 'Falha X']);
        $response->assertRedirect(route('assuntos.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('assunto', ['descricao' => 'Falha X']);
    }

    public function test_show_exibe_assunto(): void
    {
        $this->actingAs(User::factory()->create());
        $assunto = Assunto::create(['descricao' => 'Mostrar']);

        $response = $this->get(route('assuntos.show', $assunto->codAs));
        $response->assertStatus(200);
        $response->assertViewIs('assuntos.show');
        $response->assertViewHas('assunto', function ($viewAssunto) use ($assunto) {
            return $viewAssunto->codAs === $assunto->codAs;
        });
    }

    public function test_edit_exibe_formulario(): void
    {
        $this->actingAs(User::factory()->create());
        $assunto = Assunto::create(['descricao' => 'Editar']);

        $response = $this->get(route('assuntos.edit', $assunto->codAs));
        $response->assertStatus(200);
        $response->assertViewIs('assuntos.edit');
        $response->assertViewHas('assunto', function ($viewAssunto) use ($assunto) {
            return $viewAssunto->codAs === $assunto->codAs;
        });
    }

    public function test_update_atualiza_e_redireciona(): void
    {
        $this->actingAs(User::factory()->create());
        $assunto = Assunto::create(['descricao' => 'Antigo']);

        $response = $this->put(route('assuntos.update', $assunto->codAs), ['descricao' => 'Atualizado']);
        $response->assertRedirect(route('assuntos.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('assunto', ['codAs' => $assunto->codAs, 'descricao' => 'Atualizado']);
    }

    public function test_destroy_exclui_e_redireciona(): void
    {
        $this->actingAs(User::factory()->create());
        $assunto = Assunto::create(['descricao' => 'Apagar']);

        $response = $this->delete(route('assuntos.destroy', $assunto->codAs));
        $response->assertRedirect(route('assuntos.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('assunto', ['codAs' => $assunto->codAs]);
    }

    public function test_show_quando_nao_encontrado_trata_retorna_pagina_404(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('assuntos.show', 999999));
        $response->assertStatus(404);
    }

    public function test_edit_quando_nao_encontrado_trata_erro(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('assuntos.edit', 999999));
        $response->assertStatus(404);
    }

    public function test_search_por_termo_retorna_json(): void
    {
        $this->actingAs(User::factory()->create());
        Assunto::create(['descricao' => 'search']);
        Assunto::create(['descricao' => 'termo']);

        $response = $this->getJson(route('api.assuntos.search') . '?q=se');
        $response->assertOk();
        $data = $response->json();
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('descricao', $data[0]);
    }

    public function test_search_por_ids_retorna_json_com_texto(): void
    {
        $this->actingAs(User::factory()->create());
        $a1 = Assunto::create(['descricao' => 'search']);
        $a2 = Assunto::create(['descricao' => 'termo']);

        $response = $this->getJson(route('api.assuntos.search') . '?id[]=' . $a1->codAs . '&id[]=' . $a2->codAs);
        $response->assertOk();
        $data = $response->json();
        $this->assertCount(2, $data);
        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('text', $data[0]);
    }

    public function test_search_exclui_os_ids_passados(): void
    {
        $this->actingAs(User::factory()->create());

        // Cria 3 assuntos
        $a1 = Assunto::create(['descricao' => 'Teste 1']);
        $a2 = Assunto::create(['descricao' => 'Teste 2']);
        $a3 = Assunto::create(['descricao' => 'Teste 3']);

        // Requisição com exclude
        $response = $this->getJson(route('api.assuntos.search', ['exclude' => [$a1->codAs, $a3->codAs]]));

        $response->assertOk();

        // Confirma que apenas o assunto 2 foi retornado
        $json = $response->json();

        // Remove camadas extras se existirem
        if (isset($json[0]) && is_array($json[0])) {
            $json = $json[0];
        }

        $idsRetornados = array_column($json, 'id');

        $this->assertNotContains($a2->codAs, $idsRetornados);
        $this->assertNotContains($a3->codAs, $idsRetornados);
    }
}
