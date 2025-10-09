<?php

namespace App\Interfaces\Repositories;

use App\Models\Assunto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AssuntoRepositoryInterface
{
    public function getAllAssuntos(int $perPage = 10): LengthAwarePaginator;

    public function findAssuntoById(int $codAs): Assunto;

    public function createAssunto(array $data): Assunto;

    public function updateAssunto(int $codAs, array $data): Assunto;

    public function deleteAssunto(int $codAs): ?bool;
}
