<?php

namespace Tests\Feature;

use App\Interfaces\Services\RelatorioAutorServiceInterface;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class RelatorioAutorTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_lista_relatorio_com_filtros(): void
    {
        $this->actingAs(User::factory()->create());

        // Mock do service para retornar um paginator (a view usa ->links())
        $mock = \Mockery::mock(RelatorioAutorServiceInterface::class);
        $paginator = new LengthAwarePaginator([], 0, 15);
        $mock->shouldReceive('filtrar')->once()->andReturn($paginator);
        $this->app->instance(RelatorioAutorServiceInterface::class, $mock);

        $response = $this->get(route('relatorios.autores.index', [
            'autor' => 'joao',
            'titulo_livro' => 'algum',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('relatorios.autores.index');
        $response->assertViewHasAll(['relatorio', 'filtros']);
    }

    public function test_export_csv_stream(): void
    {
        $this->actingAs(User::factory()->create());

        $mock = \Mockery::mock(RelatorioAutorServiceInterface::class);
        $mock->shouldReceive('exportarCsv')->once()->andReturn(function () {
            echo "autor,titulo_livro\n";
        });
        $this->app->instance(RelatorioAutorServiceInterface::class, $mock);

        $response = $this->get(route('relatorios.autores.csv'));
        $response->assertOk();
        $this->assertStringContainsString('autor,titulo_livro', $response->streamedContent());
    }
}


