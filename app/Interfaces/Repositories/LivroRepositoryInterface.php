<?php

namespace App\Interfaces\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Livro;

interface LivroRepositoryInterface
{
    public function getAllLivros(int $perPage = 10): LengthAwarePaginator;

    public function buscarPorId(int $codl): ?Livro;

    public function createLivro(array $data): Livro;

    public function attachAutores(Livro $livro, array $autores): void;

    public function attachAssuntos(Livro $livro, array $assuntos): void;

    public function updateLivro(int $codl, array $data): Livro;

    public function deleteLivro(int $codl): ?bool;
}
