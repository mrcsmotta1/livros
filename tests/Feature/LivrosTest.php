<?php

namespace Tests\Feature;

use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;
use App\Interfaces\Services\LivroServiceInterface;
use Exception;

class LivrosTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_lista_paginada(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // cria alguns livros
        for ($i = 1; $i <= 3; $i++) {
            Livro::create([
                'titulo' => 'Livro ' . $i,
                'editora' => 'Editora ' . $i,
                'edicao' => $i,
                'ano_publicacao' => (string) (2000 + $i),
                'valor' => 10.00 + $i,
            ]);
        }

        $response = $this->get(route('livros.index'));

        $response->assertStatus(200);
        $response->assertViewIs('livros.index');
        $response->assertViewHas('livros', function ($livros) {
            return $livros instanceof LengthAwarePaginator && $livros->total() === 3;
        });
    }

    public function test_criacao_exibe_formulario(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('livros.create'));

        $response->assertStatus(200);
        $response->assertViewIs('livros.create');
    }

    public function test_store_persiste_e_redireciona(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $autor = Autor::create(['nome' => 'Autor Teste']);
        $assunto = Assunto::create(['descricao' => 'Assunto Teste']);

        $payload = [
            'titulo' => 'Livro Criado',
            'editora' => 'Editora X',
            'edicao' => 1,
            'ano_publicacao' => 2020,
            'valor' => 59.9,
            'autores' => [$autor->getKey()],
            'assuntos' => [$assunto->getKey()],
        ];

        $response = $this->post(route('livros.store'), $payload);

        $response->assertRedirect(route('livros.index'));
        $response->assertSessionHas('success');

        $livro = Livro::where('titulo', 'Livro Criado')->first();
        $this->assertNotNull($livro);
        $this->assertSame('Editora X', $livro->editora);
        $this->assertSame(1, (int) $livro->edicao);
        $this->assertSame('2020', (string) $livro->ano_publicacao);
        $this->assertTrue($livro->autores()->where('autor.codAu', $autor->getKey())->exists());
        $this->assertTrue($livro->assuntos()->where('assunto.codAs', $assunto->getKey())->exists());
    }

    public function test_store_erros_de_validacao(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->from(route('livros.create'))->post(route('livros.store'), []);
        $response->assertRedirect(route('livros.create'));
        $response->assertSessionHasErrors([
            'titulo', 'editora', 'edicao', 'ano_publicacao', 'valor', 'autores', 'assuntos'
        ]);
    }

    public function test_store_trata_excecao_e_redireciona_com_erro(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $autor = Autor::create(['nome' => 'Autor Erro']);
        $assunto = Assunto::create(['descricao' => 'Assunto Erro']);

        $payload = [
            'titulo' => 'Livro Erro',
            'editora' => 'Editora E',
            'edicao' => 1,
            'ano_publicacao' => 2020,
            'valor' => 10.0,
            'autores' => [$autor->getKey()],
            'assuntos' => [$assunto->getKey()],
        ];

        $mock = \Mockery::mock(LivroServiceInterface::class);
        $mock->shouldReceive('criarLivros')->once()->andThrow(new Exception('Falha ao criar livro'));
        $this->app->instance(LivroServiceInterface::class, $mock);

        $response = $this->post(route('livros.store'), $payload);

        $response->assertRedirect(route('livros.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('livro', ['titulo' => 'Livro Erro']);
    }

    public function test_show_exibe_livro(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $livro = Livro::create([
            'titulo' => 'Livro Show',
            'editora' => 'Editora Show',
            'edicao' => 2,
            'ano_publicacao' => '2021',
            'valor' => 100.00,
        ]);

        $response = $this->get(route('livros.show', $livro->codl));
        $response->assertStatus(200);
        $response->assertViewIs('livros.show');
        $response->assertViewHas('livro', function ($viewLivro) use ($livro) {
            return $viewLivro->codl === $livro->codl;
        });
    }

    public function test_edit_exibe_formulario_com_livro(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $livro = Livro::create([
            'titulo' => 'Livro Edit',
            'editora' => 'Editora E',
            'edicao' => 3,
            'ano_publicacao' => '2019',
            'valor' => 70.00,
        ]);

        $response = $this->get(route('livros.edit', $livro->codl));
        $response->assertStatus(200);
        $response->assertViewIs('livros.edit');
        $response->assertViewHas('livro', function ($viewLivro) use ($livro) {
            return $viewLivro->codl === $livro->codl;
        });
    }

    public function test_update_atualiza_e_redireciona(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $livro = Livro::create([
            'titulo' => 'Livro Antigo',
            'editora' => 'Editora A',
            'edicao' => 1,
            'ano_publicacao' => '2018',
            'valor' => 50.00,
        ]);

        $autor = Autor::create(['nome' => 'Autor Update']);
        $assunto = Assunto::create(['descricao' => 'Assunto Update']);

        $payload = [
            'titulo' => 'Livro Atualizado',
            'editora' => 'Editora B',
            'edicao' => 2,
            'ano_publicacao' => 2022,
            'valor' => 99.99,
            'autores' => [$autor->getKey()],
            'assuntos' => [$assunto->getKey()],
        ];

        $response = $this->put(route('livros.update', $livro->codl), $payload);

        $livro->refresh();
        $response->assertRedirect(route('livros.show', $livro->codl));
        $response->assertSessionHas('success');
        $this->assertSame('Livro Atualizado', $livro->titulo);
        $this->assertSame('Editora B', $livro->editora);
        $this->assertSame('2022', (string) $livro->ano_publicacao);
        $this->assertTrue($livro->autores()->where('autor.codAu', $autor->getKey())->exists());
        $this->assertTrue($livro->assuntos()->where('assunto.codAs', $assunto->getKey())->exists());
    }

    public function test_destroy_exclui_e_redireciona(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $livro = Livro::create([
            'titulo' => 'Livro Apagar',
            'editora' => 'Editora Z',
            'edicao' => 1,
            'ano_publicacao' => '2017',
            'valor' => 40.00,
        ]);

        $response = $this->delete(route('livros.destroy', $livro->codl));

        $response->assertRedirect(route('livros.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('livro', ['codl' => $livro->codl]);
    }
}


