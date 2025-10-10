<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Exception;
use App\Http\Requests\LivroStoreRequest;
use App\Interfaces\Services\LivroServiceInterface;

class LivrosController extends Controller
{

    public function __construct(protected LivroServiceInterface $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livros = $this->service->listarLivros();

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
            $livro = $this->service->criarLivros($request->validated());

            if ($request->autores) {
                $livro->autores()->sync($request->autores);
            }

            if ($request->assuntos) {
                $livro->assuntos()->sync($request->assuntos);
            }

            return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('livros.index')->with('error', 'Erro ao criar livro: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Livro $livro)
    {
        return view('livros.show', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livro $livro)
    {
        return view('livros.edit', compact('livro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LivroStoreRequest $request, string $id)
    {
        $livro = $this->service->atualizarLivro($id, $request->validated());

        return redirect()
            ->route('livros.show', $livro->codl)
            ->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->deletarLivro($id);
        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro excluído com sucesso!');
    }
}
