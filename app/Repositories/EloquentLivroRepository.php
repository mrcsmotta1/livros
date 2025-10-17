<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Livro;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Interfaces\Repositories\LivroRepositoryInterface;

class EloquentLivroRepository implements LivroRepositoryInterface
{
    /**
     * Retorna todos os autores ordenados por codAu.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws Exception
     */
    public function getAllLivros(int $perPage = 10): LengthAwarePaginator
    {
    return Livro::with(['autores', 'assuntos'])->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Cria um novo autor.
     *
     * @param array $data Dados do autor a ser criado
     * @return Livro
     * @throws Exception
     */
    public function createLivro(array $data): Livro
    {
        return Livro::create($data);
    }

    /**
     * Sincroniza Autores
     * @param \App\Models\Livro $livro
     * @param array $autores
     * @return void
     */
    public function attachAutores(Livro $livro, array $autores): void
    {
        $livro->autores()->detach();
        foreach ($autores as $key => $id) {
            $livro->autores()->attach($id);
        }
    }

    /**
     * Sincroniza Assuntos
     * @param \App\Models\Livro $livro
     * @param array $assuntos
     * @return void
     */
    public function attachAssuntos(Livro $livro, array $assuntos): void
    {
        $livro->assuntos()->detach();
        foreach ($assuntos as $key => $id) {
            $livro->assuntos()->attach($id);
        }
    }

    /**
     * Sincroniza Editora única
     */
    public function attachEditora(Livro $livro, int $editoraId): void
    {
    // Removido: relacionamento editoras
    }

    /**
     * Atualiza um autor existente.
     *
     * @param Livro $autor O autor a ser atualizado
     * @param array $data Dados atualizados do autor
     * @return bool
     * @throws Exception
     */
    public function updateLivro(int $codAu, array $data): Livro
    {
        $autor = Livro::findOrFail($codAu);
        // Evita atualizar 'editora' string diretamente
        unset($data['editora']);

        // Trata a codificação dos caracteres especiais
        if (isset($data['edicao'])) {
            $data['edicao'] = mb_convert_encoding($data['edicao'], 'UTF-8', 'UTF-8');
        }

        $autor->update($data);
        return $autor;
    }

    /**
     * Encontra um autor pelo ID.
     *
     * @param int $id
     * @return Livro|null
     */
    public function buscarPorId(int $codl): Livro|null
    {
    return Livro::with(['autores', 'assuntos'])->find($codl);
    }

    /**
     * Deleta um autor.
     *
     * @param Livro $autor
     * @return bool|null
     */
    public function deleteLivro(int $codAu): ?bool
    {
        $autor = Livro::findOrFail($codAu);
        return $autor->delete();
    }
}
