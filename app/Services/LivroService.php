<?php

namespace App\Services;

use App\Interfaces\Services\LivroServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Interfaces\Repositories\LivroRepositoryInterface;
use App\Models\Livro;
use Illuminate\Support\Facades\DB;

class LivroService implements LivroServiceInterface
{
    public function __construct(protected LivroRepositoryInterface $repository) {}

    public function listarLivros(): LengthAwarePaginator
    {
        return $this->repository->getAllLivros();
    }

    public function buscarPorId(int $codl): Livro|null
    {
        return $this->repository->buscarPorId($codl);
    }

    public function criarLivros(array $dados): Livro
    {
        return DB::transaction(function () use ($dados) {
            $livro = $this->repository->createLivro([
                'titulo'          => $dados['titulo'],
                'editora'         => $dados['editora'],
                'edicao'          => $dados['edicao'],
                'ano_publicacao'  => $dados['ano_publicacao'],
                'valor'           => $dados['valor'],
            ]);

            $this->repository->attachAutores($livro, $dados['autores'] ?? []);
            $this->repository->attachAssuntos($livro, $dados['assuntos'] ?? []);

            return $livro;
        });
    }

    public function atualizarLivro(int $codAu, array $dados): Livro
    {
        return DB::transaction(function () use ($codAu, $dados) {
            $this->repository->updateLivro($codAu, $dados);

            $livro = $this->repository->buscarPorId($codAu);
            if (!empty($dados['autores'])) {
                $this->repository->attachAutores($livro, $dados['autores']);
            }

            if (!empty($dados['assuntos'])) {
                $this->repository->attachAssuntos($livro, $dados['assuntos']);
            }

            return $livro;
        });
    }

    public function deletarLivro(int $codAu): bool
    {
        return $this->repository->deleteLivro($codAu);
    }
}
