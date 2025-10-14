<?php

namespace App\Services;

use App\Interfaces\Repositories\RelatorioAutorRepositoryInterface;
use App\Interfaces\Services\RelatorioAutorServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Csv\Writer;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Closure;

class RelatorioAutorService implements RelatorioAutorServiceInterface
{
    public function __construct(
        protected RelatorioAutorRepositoryInterface $repository
    ) {}

    public function listarTodos(): LengthAwarePaginator
    {
        return $this->repository->getAll();
    }

    public function filtrar(array $filtros): LengthAwarePaginator
    {
        return $this->repository->filter($filtros);
    }

    public function filtrarTodos(array $filtros): Collection
    {
        return $this->repository->filterAll($filtros);
    }

    public function exportarCsv(array $filtros): Closure
    {
        $dados = $this->filtrarTodos($filtros);
        $header = ['Autor', 'Livro', 'Editora', 'Ano', 'Edição', 'Valor', 'Assuntos'];

        return function () use ($dados, $header) {
            $file = fopen('php://output', 'w');
            fwrite($file, chr(239) . chr(187) . chr(191));
            fwrite($file, "sep=;\n");
            fputcsv($file, $header, ';');

            foreach ($dados as $linha) {
                fputcsv($file, [
                    $linha->autor,
                    $linha->titulo_livro,
                    $linha->editora,
                    $linha->ano_publicacao,
                    $linha->edicao,
                    number_format($linha->valor, 2, ',', '.'),
                    $linha->assuntos_relacionados
                ], ';', '"');
            }
            fclose($file);
        };
    }
}
