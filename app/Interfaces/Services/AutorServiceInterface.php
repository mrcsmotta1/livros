<?php

namespace App\Interfaces\Services;

use App\Models\Autor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AutorServiceInterface
{
    public function listarAutores(): LengthAwarePaginator;
    public function buscarPorId(int $codAu): ?Autor;
    public function criarAutor(array $dados): Autor;
    public function atualizarAutor(int $codAu, array $dados): Autor;
    public function deletarAutor(int $codAu): bool;
}
