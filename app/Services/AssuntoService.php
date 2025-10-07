<?php

namespace App\Services;

use App\Interfaces\Repositories\AssuntoRepositoryInterface;
use App\Interfaces\Services\AssuntoServiceInterface;
use App\Models\Assunto;
use Illuminate\Database\Eloquent\Collection;

class AssuntoService implements AssuntoServiceInterface
{
    public function __construct(protected AssuntoRepositoryInterface $repository)
    {
    }

    public function listarAssuntos(): Collection
    {
        return $this->repository->getAllAssuntos();
    }

    public function buscarPorId(int $codAs): Assunto
    {
        return $this->repository->findAssuntoById($codAs);
    }

    public function criarAssunto(array $dados): Assunto
    {
        return $this->repository->createAssunto($dados);
    }

    public function atualizarAssunto(int $codAs, array $dados): Assunto
    {
        return $this->repository->updateAssunto($codAs, $dados);
    }

    public function deletarAssunto(int $codAs): bool
    {
        return $this->repository->deleteAssunto($codAs);
    }
}
