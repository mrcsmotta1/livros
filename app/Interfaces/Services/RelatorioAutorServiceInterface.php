<?php

namespace App\Interfaces\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Closure;

interface RelatorioAutorServiceInterface
{
    public function listarTodos(): LengthAwarePaginator;

    public function filtrar(array $filtros): LengthAwarePaginator;

     public function filtrarTodos(array $filtros): Collection;

    public function exportarCsv(array $filtros): Closure;

}
