<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LivroStoreRequest;

class LivrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livros = Livro::with([
            'autores'  => fn($q) => $q->orderBy('livro_autor.id'),
            'assuntos' => fn($q) => $q->orderBy('livro_assunto.id'),
        ])->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livros.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LivroStoreRequest $request)
    {
        try {
            $livro = Livro::create([
                'titulo' => $request->titulo,
                'editora' => $request->editora,
                'edicao' => $request->edicao,
                'ano_publicacao' => $request->ano_publicacao,
                'valor' => $request->valor,
            ]);

            if ($request->autores) {
                $livro->autores()->sync($request->autores);
            }

            if ($request->assuntos) {
                $livro->assuntos()->sync($request->assuntos);
            }

            return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
        } catch (Exception $e) {
            // TODO: Remover $e->getMessage e logar o erro em arquivo txt.log
            return redirect()->route('livros.index')->with('error', 'Erro ao criar livro: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $livro = Livro::with([
            'autores'  => fn($q) => $q->orderBy('livro_autor.id'),
            'assuntos' => fn($q) => $q->orderBy('livro_assunto.id'),
        ])->findOrFail($id);

        return view('livros.show', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $livro = Livro::with([
            'autores' => fn($q) => $q->orderBy('livro_autor.id'),
            'assuntos' => fn($q) => $q->orderBy('livro_assunto.id'),
        ])->findOrFail($id);

        return view('livros.edit', compact('livro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LivroStoreRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $livro = Livro::with(['autores', 'assuntos'])->findOrFail($id);

            // Normaliza o valor monetário
            $valor = $request->input('valor');

            $livro->update([
                'titulo'          => $request->input('titulo'),
                'editora'         => $request->input('editora'),
                'edicao'          => $request->input('edicao'),
                'ano_publicacao'  => $request->input('ano_publicacao'),
                'valor'           => $valor,
            ]);

            $autores = $request->input('autores', []);
            $assuntos = $request->input('assuntos', []);

            $livro->autores()->sync($autores);
            $livro->assuntos()->sync($assuntos);

            DB::commit();

            return redirect()
                ->route('livros.show', $livro->codl)
                ->with('success', 'Livro atualizado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('livros.edit', $id)
                ->with('error', 'Erro ao atualizar livro: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $livro = Livro::findOrFail($id);

            $livro->autores()->detach();
            $livro->assuntos()->detach();

            $livro->delete();

            DB::commit();

            return redirect()
                ->route('livros.index')
                ->with('success', 'Livro excluído com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('livros.index')
                ->with('error', 'Erro ao excluir livro: ' . $e->getMessage());
        }
    }
}
