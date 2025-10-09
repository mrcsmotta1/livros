<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\Repositories\AutorRepositoryInterface;
use App\Models\Autor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentAutorRepository implements AutorRepositoryInterface
{
    /**
     * Retorna todos os autores ordenados por codAu.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws Exception
     */
    public function getAllAutores(int $perPage = 10): LengthAwarePaginator
    {
        return Autor::orderBy('nome')->paginate($perPage);
    }

    /**
     * Cria um novo autor.
     *
     * @param array $data Dados do autor a ser criado
     * @return Autor
     * @throws Exception
     */
    public function createAutor(array $data): Autor
    {
        return Autor::create($data);
    }

    /**
     * Atualiza um autor existente.
     *
     * @param Autor $autor O autor a ser atualizado
     * @param array $data Dados atualizados do autor
     * @return bool
     * @throws Exception
     */
    public function updateAutor(int $codAu, array $data): Autor
    {
        $autor = Autor::findOrFail($codAu);
        $autor->update($data);
        return $autor;
    }

    /**
     * Encontra um autor pelo ID.
     *
     * @param int $id
     * @return Autor|null
     */
    public function findAutorById(int $codAu): ?Autor
    {
        return Autor::find($codAu);
    }

    /**
     * Deleta um autor.
     *
     * @param Autor $autor
     * @return bool|null
     */
    public function deleteAutor(int $codAu): ?bool
    {
        $autor = Autor::findOrFail($codAu);
        return $autor->delete();
    }
}
