<?php

namespace App\Interfaces\Services;

use App\Models\Assunto;
use Illuminate\Database\Eloquent\Collection;

interface AssuntoServiceInterface
{
    public function listarAssuntos(): Collection;
    public function buscarPorId(int $codAs): Assunto;
    public function criarAssunto(array $dados): Assunto;
    public function atualizarAssunto(int $codAs, array $dados): Assunto;
    public function deletarAssunto(int $codAs): bool;
}
