<?php

namespace App\Repositories;

use App\Models\Assunto;
use Exception;
use App\Interfaces\Repositories\AssuntoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentAssuntoRepository implements AssuntoRepositoryInterface
{
    /**
     * Retorna todos os assuntos ordenados por codAs.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws Exception
     */
    public function getAllAssuntos(): Collection
    {
        return Assunto::all();
    }

    /**
     * Cria um novo assunto.
     *
     * @param array $data Dados do assunto a ser criado
     * @return Assunto
     * @throws Exception
     */
    public function createAssunto(array $data): Assunto
    {
        return Assunto::create($data);
    }

    /**
     * Atualiza um assunto existente.
     *
     * @param Assunto $assunto O assunto a ser atualizado
     * @param array $data Dados atualizados do assunto
     * @return bool
     * @throws Exception
     */
    public function updateAssunto(int $codAs, array $data): Assunto
    {
        $assunto = Assunto::findOrFail($codAs);
        $assunto->update($data);
        return $assunto;
    }

    /**
     * Encontra um assunto pelo ID.
     *
     * @param int $id
     * @return Assunto
     */
    public function findAssuntoById(int $codAs): Assunto
    {
        return Assunto::findOrFail($codAs);
    }

    /**
     * Deleta um assunto.
     *
     * @param Assunto $assunto
     * @return bool|null
     */
    public function deleteAssunto(int $codAs): ?bool
    {
        $assunto = Assunto::findOrFail($codAs);
        return $assunto->delete();
    }
}
