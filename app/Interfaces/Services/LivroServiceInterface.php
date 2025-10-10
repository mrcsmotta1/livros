<?php
namespace App\Interfaces\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Livro;

Interface LivroServiceInterface
{
    public function listarLivros(): LengthAwarePaginator;
    public function buscarPorId(int $codl): ?Livro;
    public function criarLivros(array $dados): Livro;
    public function atualizarLivro(int $codl, array $dados): Livro;
    public function deletarLivro(int $codl): bool;
}
