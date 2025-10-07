<?php

namespace App\Interfaces\Repositories;

use App\Models\Assunto;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Autor;

interface AutorRepositoryInterface
{
    public function getAllAutores(): Collection;

    public function findAutorById(int $codAu): ?Autor;

    public function createAutor(array $data): Autor;

    public function updateAutor(int $codAu, array $data): Autor;

    public function deleteAutor(int $codAu): ?bool;
}
