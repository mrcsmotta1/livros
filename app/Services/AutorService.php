<?php

namespace App\Services;

use App\Models\Autor;
use App\Interfaces\Services\AutorServiceInterface;
use App\Interfaces\Repositories\AutorRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AutorService implements AutorServiceInterface
{
    public function __construct(protected AutorRepositoryInterface $repository) {}

    public function listarAutores(): LengthAwarePaginator
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
