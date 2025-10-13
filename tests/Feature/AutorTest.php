<?php

namespace Tests\Feature;

use App\Interfaces\Services\AutorServiceInterface;
use App\Models\Autor;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\AutorService;

class AutorTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_lista_paginada(): void
    {
        $this->actingAs(User::factory()->create());

        Autor::create(['nome' => 'Autor A']);
        Autor::create(['nome' => 'Autor B']);

        $response = $this->get(route('autores.index'));
        $response->assertStatus(200);
        $response->assertViewIs('autores.index');
        $response->assertViewHas('autores', function ($autores) {
            return $autores instanceof LengthAwarePaginator && $autores->total() === 2;
        });
    }

    public function test_create_exibe_formulario(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('autores.create'));
        $response->assertStatus(200);
        $response->assertViewIs('autores.create');
    }

    public function test_store_persiste_e_redireciona(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('autores.store'), [
            'nome' => 'Autor Novo',
        ]);

        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('autor', ['nome' => 'Autor Novo']);
    }

    public function test_store_erros_de_validacao(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->from(route('autores.create'))->post(route('autores.store'), [
            'nome' => ' ',
        ]);
        $response->assertRedirect(route('autores.create'));
        $response->assertSessionHasErrors(['nome']);
    }

    public function test_store_trata_excecao_e_redireciona_com_erro(): void
    {
        $this->actingAs(User::factory()->create());

        $mock = \Mockery::mock(AutorServiceInterface::class);
        $mock->shouldReceive('criarAutor')->once()->andThrow(new Exception('Falha'));
        $this->app->instance(AutorServiceInterface::class, $mock);

        $response = $this->post(route('autores.store'), ['nome' => 'Autor X']);
        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('autor', ['nome' => 'Autor X']);
    }

    public function test_show_exibe_autor(): void
    {
        $this->actingAs(User::factory()->create());
        $autor = Autor::create(['nome' => 'Mostrar']);

        $response = $this->get(route('autores.show', $autor->codAu));
        $response->assertStatus(200);
        $response->assertViewIs('autores.show');
        $response->assertViewHas('autor', function ($viewAutor) use ($autor) {
            return $viewAutor->codAu === $autor->codAu;
        });
    }

    public function test_edit_exibe_formulario(): void
    {
        $this->actingAs(User::factory()->create());
        $autor = Autor::create(['nome' => 'Editar']);

        $response = $this->get(route('autores.edit', $autor->codAu));
        $response->assertStatus(200);
        $response->assertViewIs('autores.edit');
        $response->assertViewHas('autor', function ($viewAutor) use ($autor) {
            return $viewAutor->codAu === $autor->codAu;
        });
    }

    public function test_update_atualiza_e_redireciona(): void
    {
        $this->actingAs(User::factory()->create());
        $autor = Autor::create(['nome' => 'Antigo']);

        $response = $this->put(route('autores.update', $autor->codAu), ['nome' => 'Atualizado']);
        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('autor', ['codAu' => $autor->codAu, 'nome' => 'Atualizado']);
    }

    public function test_destroy_exclui_e_redireciona(): void
    {
        $this->actingAs(User::factory()->create());
        $mock = $this->createMock(AutorService::class);
        $mock->method('deletarAutor')
            ->willThrowException(new ModelNotFoundException('Autor não encontrado.'));

        // Injeta o mock no container do Laravel
        $this->app->instance(AutorService::class, $mock);

        $response = $this->delete(route('autores.destroy', 999999));

        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('error', 'Autor não encontrado.');
    }

    public function test_destroy_quando_nao_encontrado_trata_erro(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->delete(route('autores.destroy', 999999));
        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('error');
    }

    public function test_search_por_termo_retorna_json(): void
    {
        $this->actingAs(User::factory()->create());
        Autor::create(['nome' => 'João da Silva']);
        Autor::create(['nome' => 'Maria']);

        $response = $this->getJson(route('autores.search') . '?q=jo');
        $response->assertOk();
        $data = $response->json();
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('id', $data[0]);
        // caminho sem id retorna nome como "nome"
        $this->assertArrayHasKey('nome', $data[0]);
    }

    public function test_destroy_catch_generico_quando_servico_lanca_excecao(): void
    {
        $this->actingAs(User::factory()->create());
        // Mocka o serviço para lançar exceção
        $mock = \Mockery::mock(AutorServiceInterface::class);
        $mock->shouldReceive('deletarAutor')->once()->andThrow(new Exception('falha'));
        $this->app->instance(AutorServiceInterface::class, $mock);

        $response = $this->delete(route('autores.destroy', 1));
        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('error');
    }

    public function test_show_quando_nao_encontrado_trata_erro(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('autores.show', 999999));
        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('error');
    }

    public function test_edit_quando_nao_encontrado_trata_erro(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('autores.edit', 999999));
        $response->assertRedirect(route('autores.index'));
    }

    public function test_update_quando_nao_encontrado_trata_erro(): void
    {
        $this->actingAs(User::factory()->create());
        $this->actingAs(User::factory()->create());
        $mock = $this->createMock(AutorService::class);
        $mock->method('deletarAutor')
            ->willThrowException(new ModelNotFoundException('Autor não encontrado.'));

        // Injeta o mock no container do Laravel
        $this->app->instance(AutorService::class, $mock);

        $response = $this->delete(route('autores.destroy', 999999));

        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('error', 'Autor não encontrado.');
    }

    public function test_update_catch_generico_quando_servico_lanca_excecao(): void
    {
        $this->actingAs(User::factory()->create());
        $autor = Autor::create(['nome' => 'Qualquer']);

        $mock = \Mockery::mock(AutorServiceInterface::class);
        $mock->shouldReceive('atualizarAutor')->once()->andThrow(new Exception('falha'));
        $this->app->instance(AutorServiceInterface::class, $mock);

        $response = $this->put(route('autores.update', $autor->codAu), ['nome' => 'Novo']);
        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('error');
    }

    public function test_search_por_ids_retorna_json_com_texto(): void
    {
        $this->actingAs(User::factory()->create());
        $a1 = Autor::create(['nome' => 'João da Silva']);
        $a2 = Autor::create(['nome' => 'Maria']);

        $response = $this->getJson(route('autores.search') . '?id[]=' . $a1->codAu . '&id[]=' . $a2->codAu);
        $response->assertOk();
        $data = $response->json();
        $this->assertCount(2, $data);
        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('text', $data[0]);
    }
}
