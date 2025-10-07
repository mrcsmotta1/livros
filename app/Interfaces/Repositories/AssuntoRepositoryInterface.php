<?php

namespace App\Interfaces\Repositories;

use App\Models\Assunto;
use Illuminate\Database\Eloquent\Collection;

interface AssuntoRepositoryInterface
{
    public function getAllAssuntos(): Collection;

    public function findAssuntoById(int $codAs): Assunto;

    public function createAssunto(array $data): Assunto;

    public function updateAssunto(int $codAs, array $data): Assunto;

    public function deleteAssunto(int $codAs): ?bool;
}
