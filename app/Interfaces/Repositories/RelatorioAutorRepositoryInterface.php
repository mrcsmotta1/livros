<?php

namespace App\Interfaces\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RelatorioAutorRepositoryInterface
{
    public function getAll(int $perPage = 10): LengthAwarePaginator;

    public function filter(array $filters, int $perPage = 10): LengthAwarePaginator;

    public function filterAll(array $filters, int $perPage = 10): Collection;

}
