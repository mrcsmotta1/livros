<?php

namespace Tests\Feature;

use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_convidado_e_redirecionado_da_index_para_login(): void
    {
        $response = $this->get(route('index'));

        $response->assertRedirect(route('login'));
    }

    public function test_usuario_autenticado_ve_index_com_contadores_e_ultimos_livros(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create autores and assuntos (sem factories)
        $autores = collect([
            Autor::create(['nome' => 'Autor A']),
            Autor::create(['nome' => 'Autor B']),
            Autor::create(['nome' => 'Autor C']),
        ]);
        $assuntos = collect([
            Assunto::create(['descricao' => 'Assunto X']),
            Assunto::create(['descricao' => 'Assunto Y']),
        ]);

        // Create 6 livros so the controller's take(5) can be verified
        $createdLivros = collect();
        for ($i = 1; $i <= 6; $i++) {
            $livro = Livro::create([
                'titulo' => 'Livro ' . $i,
                'editora' => 'Editora ' . $i,
                'edicao' => $i,
                'ano_publicacao' => (string) (2000 + $i),
                'valor' => 10.00 + $i,
            ]);

            // Attach relationships to avoid N+1 or missing relations
            $livro->autores()->attach($autores->random()->getKey());
            $livro->assuntos()->attach($assuntos->random()->getKey());

            $createdLivros->push($livro);
        }

        $response = $this->get(route('index'));

        $response->assertStatus(200);
        $response->assertViewIs('index');

        $response->assertViewHasAll([
            'livrosCount',
            'autoresCount',
            'assuntosCount',
            'ultimosLivros',
        ]);

        $response->assertViewHas('livrosCount', 6);
        $response->assertViewHas('autoresCount', 3);
        $response->assertViewHas('assuntosCount', 2);

        $response->assertViewHas('ultimosLivros', function ($ultimosLivros) use ($createdLivros) {
            // Should contain 5 latest by created_at desc
            if ($ultimosLivros->count() !== 5) {
                return false;
            }

            $latestFive = $createdLivros->sortByDesc('created_at')->take(5)->pluck('codl')->values();
            $fromView = $ultimosLivros->pluck('codl')->values();

            return $fromView->toArray() === $latestFive->toArray();
        });
    }

    public function test_estado_vazio_exibe_contadores_zero_e_sem_ultimos(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('index'));

        $response->assertStatus(200);
        $response->assertViewIs('index');
        $response->assertViewHas('livrosCount', 0);
        $response->assertViewHas('autoresCount', 0);
        $response->assertViewHas('assuntosCount', 0);
        $response->assertViewHas('ultimosLivros', function ($ultimosLivros) {
            return $ultimosLivros->count() === 0;
        });
    }

    public function test_menos_de_cinco_livros_retorna_quantidade_exata_e_ordenados(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $autores = collect([
            Autor::create(['nome' => 'Autor A']),
            Autor::create(['nome' => 'Autor B']),
        ]);
        $assuntos = collect([
            Assunto::create(['descricao' => 'Assunto X']),
        ]);

        $createdLivros = collect();
        for ($i = 1; $i <= 3; $i++) {
            $livro = Livro::create([
                'titulo' => 'Livro ' . $i,
                'editora' => 'Editora ' . $i,
                'edicao' => $i,
                'ano_publicacao' => (string) (2000 + $i),
                'valor' => 10.00 + $i,
            ]);
            $livro->autores()->attach($autores->random()->getKey());
            $livro->assuntos()->attach($assuntos->random()->getKey());
            $createdLivros->push($livro);
        }

        $response = $this->get(route('index'));

        $response->assertStatus(200);
        $response->assertViewHas('ultimosLivros', function ($ultimosLivros) use ($createdLivros) {
            if ($ultimosLivros->count() !== 3) {
                return false;
            }
            $expectedOrder = $createdLivros->sortByDesc('created_at')->pluck('codl')->values()->toArray();
            $fromView = $ultimosLivros->pluck('codl')->values()->toArray();
            return $fromView === $expectedOrder;
        });
    }

    public function test_ultimos_livros_tem_relacao_autores_carregada(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $autores = collect([
            Autor::create(['nome' => 'Autor A']),
            Autor::create(['nome' => 'Autor B']),
            Autor::create(['nome' => 'Autor C']),
        ]);
        $assuntos = collect([
            Assunto::create(['descricao' => 'Assunto X']),
            Assunto::create(['descricao' => 'Assunto Y']),
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $livro = Livro::create([
                'titulo' => 'Livro ' . $i,
                'editora' => 'Editora ' . $i,
                'edicao' => $i,
                'ano_publicacao' => (string) (2000 + $i),
                'valor' => 10.00 + $i,
            ]);
            $livro->autores()->attach($autores->random()->getKey());
            $livro->assuntos()->attach($assuntos->random()->getKey());
        }

        $response = $this->get(route('index'));

        $response->assertStatus(200);
        $response->assertViewHas('ultimosLivros', function ($ultimosLivros) {
            // All livros should have 'autores' relation eager-loaded
            foreach ($ultimosLivros as $livro) {
                if (!$livro->relationLoaded('autores')) {
                    return false;
                }
            }
            return true;
        });
    }
}


