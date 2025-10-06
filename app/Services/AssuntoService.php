<?php

namespace App\Services;

use App\Models\Assunto;
use Exception; // Para lançar exceções em caso de erro

class AssuntoService
{

    /**
     * Retorna todos os assuntos ordenados por codAs.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws Exception
     */
    public function getAllAssuntos(): mixed
    {
        try {
            return Assunto::orderBy('codAs')->get();
        } catch (Exception $e) {
            throw new Exception("Erro ao listar assuntos: " . $e->getMessage());
        }
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
        try {
            return Assunto::create($data);
        } catch (Exception $e) {
            throw new Exception("Erro ao criar assunto: " . $e->getMessage());
        }
    }

    /**
     * Atualiza um assunto existente.
     *
     * @param Assunto $assunto O assunto a ser atualizado
     * @param array $data Dados atualizados do assunto
     * @return bool
     * @throws Exception
     */
    public function updateAssunto(Assunto $assunto, array $data): bool
    {
        try {
            return $assunto->update($data);
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar assunto: " . $e->getMessage());
        }
    }

    /**
     * Encontra um assunto pelo ID.
     *
     * @param int $id
     * @return Assunto|null
     */
    public function findAssuntoById(int $id): ?Assunto
    {
        return Assunto::query()->where('codAs', $id)->first();
    }

    /**
     * Deleta um assunto.
     *
     * @param Assunto $assunto
     * @return bool|null
     */
    public function deleteAssunto(Assunto $assunto): ?bool
    {
        try {
            return $assunto->delete();
        } catch (Exception $e) {
            throw new Exception("Erro ao deletar assunto: " . $e->getMessage());
        }
    }
}
