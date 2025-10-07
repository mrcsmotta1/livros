<?php

namespace App\Interfaces\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Autor;

interface AutorServiceInterface
{
    public function listarAutores(): Collection;
    public function buscarPorId(int $codAu): ?Autor;
    public function criarAutor(array $dados): Autor;
    public function atualizarAutor(int $codAu, array $dados): Autor;
    public function deletarAutor(int $codAu): bool;
}
