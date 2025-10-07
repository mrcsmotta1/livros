<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Autor;
use App\Interfaces\Services\AutorServiceInterface;
use App\Interfaces\Repositories\AutorRepositoryInterface;

class AutorService implements AutorServiceInterface
{
    public function __construct(protected AutorRepositoryInterface $repository) {}

    public function listarAutores(): Collection
    {
        return $this->repository->getAllAutores();
    }

    public function buscarPorId(int $codAu): Autor
    {
        return $this->repository->findAutorById($codAu);
    }

    public function criarAutor(array $dados): Autor
    {
        return $this->repository->createAutor($dados);
    }

    public function atualizarAutor(int $codAu, array $dados): Autor
    {
        return $this->repository->updateAutor($codAu, $dados);
    }

    public function deletarAutor(int $codAu): bool
    {
        return $this->repository->deleteAutor($codAu);
    }
}
