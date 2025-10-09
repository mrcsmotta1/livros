<?php

namespace App\Interfaces\Repositories;

use App\Models\Autor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AutorRepositoryInterface
{
    public function getAllAutores(int $perPage = 10): LengthAwarePaginator;

    public function findAutorById(int $codAu): ?Autor;

    public function createAutor(array $data): Autor;

    public function updateAutor(int $codAu, array $data): Autor;

    public function deleteAutor(int $codAu): ?bool;
}
