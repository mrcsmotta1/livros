<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorStoreRequest;
use App\Models\Autor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Interfaces\Services\AutorServiceInterface;
use Exception;

class AutorController extends Controller
{
    public function __construct(protected AutorServiceInterface $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autores = $this->service->listarAutores();
        return view('autores.index', compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('autores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AutorStoreRequest $request)
    {
        try {
            $this->service->criarAutor($request->validated());
            return redirect()->route('autores.index')
                ->with('success', 'Autor criado com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('autores.index')
                ->with('error', 'Erro ao criar autor: tente novamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $codAu)
    {
        try {
            $autor = $this->service->buscarPorId($codAu);
            return view('autores.show', compact('autor'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('autores.index')
                ->with('error', 'Autor não encontrado.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $codAu)
    {
        try {
            $autor = $this->service->buscarPorId($codAu);
            return view('autores.edit', compact('autor'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('autores.index')
                ->with('error', 'Autor não encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AutorStoreRequest $request, int $codAu)
    {
        try {
            $this->service->atualizarAutor($codAu, $request->validated());
            return redirect()->route('autores.index')
                ->with('success', 'Autor atualizado com sucesso!');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('autores.index')
                ->with('error', 'Autor não encontrado.');
        } catch (Exception $e) {
            return redirect()
                ->route('autores.index')
                ->with('error', 'Erro ao atualizar autor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $codAu)
    {
        try {
            $this->service->deletarAutor($codAu);
            return redirect()
                ->route('autores.index')
                ->with('success', 'Autor excluído com sucesso!');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('autores.index')
                ->with('error', 'Autor não encontrado.');
        } catch (Exception $e) {
            return redirect()
                ->route('autores.index')
                ->with('error', 'Erro ao excluir autor: ' . $e->getMessage());
        }
    }
}
