<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorStoreRequest;
use Illuminate\Http\Request;
use App\Models\Autor;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autores = Autor::all();
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
        Autor::create($request->validated());

        return redirect()->route('autores.index')
            ->with('success', 'Autor criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $codAu)
    {
        try {
            $autor = Autor::findOrFail($codAu);
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
            $autor = Autor::findOrFail($codAu);
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
            $autor = Autor::findOrFail($codAu);
            $autor->update($request->validated());
            return redirect()->route('autores.index')
                ->with('success', 'Autor atualizado com sucesso!');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('autores.index')
                ->with('error', 'Autor não encontrado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $codAu)
    {
        try {
            $autor = Autor::findOrFail($codAu);
            $autor->delete();
            return redirect()->route('autores.index')
                ->with('success', 'Autor excluído com sucesso!');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('autores.index')
                ->with('error', 'Autor não encontrado.');
        }
    }
}
