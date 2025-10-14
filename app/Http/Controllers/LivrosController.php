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
            $data = $request->validated();
            $livro = $this->service->criarLivros($data);

            $autores = (array) ($data['autores'] ?? []);
            if (!empty($autores)) {
                $livro->autores()->sync($autores);
            }

            $assuntos = (array) ($data['assuntos'] ?? []);
            if (!empty($assuntos)) {
                $livro->assuntos()->sync($assuntos);
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
    public function update(LivroStoreRequest $request, Livro $livro)
    {
        $livro = $this->service->atualizarLivro($livro->codl, $request->validated());

        return redirect()
            ->route('livros.show', $livro->codl)
            ->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livro $livro)
    {
        $this->service->deletarLivro($livro->codl);
        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro excluído com sucesso!');
    }
}
