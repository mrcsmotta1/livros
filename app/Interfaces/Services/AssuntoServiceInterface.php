<?php

namespace App\Interfaces\Services;

use App\Models\Assunto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AssuntoServiceInterface
{
    public function listarAssuntos(): LengthAwarePaginator;
    public function buscarPorId(int $codAs): Assunto;
    public function criarAssunto(array $dados): Assunto;
    public function atualizarAssunto(int $codAs, array $dados): Assunto;
    public function deletarAssunto(int $codAs): bool;
}
