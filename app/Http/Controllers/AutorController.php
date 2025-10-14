<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorStoreRequest;
use App\Models\Autor;
use App\Interfaces\Services\AutorServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
    public function show(Autor $autor): RedirectResponse|View
    {
        return view('autores.show', compact('autor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Autor $autor)
    {
        return view('autores.edit', compact('autor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AutorStoreRequest $request, Autor $autor)
    {
        $this->service->atualizarAutor($autor->codAu, $request->validated());

        return redirect()->route('autores.index')
            ->with('success', 'Autor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Autor $autor)
    {
        $this->service->deletarAutor($autor->codAu);

        return redirect()
            ->route('autores.index')
            ->with('success', 'Autor excluído com sucesso!');
    }

    public function search(Request $request)
    {
        //Retorna itens do form Edit
        if ($request->filled('id')) {
            $ids = (array) $request->get('id');
            $result = Autor::whereIn('codAu', $ids)
                ->selectRaw('"codAu" as id, nome as text')
                ->orderBy('nome')
                ->get();

            return response()->json($result);
        }

        $query = Autor::query();

        if ($request->filled('exclude')) {
            $exclude = array_filter(array_map('intval', (array) $request->exclude));
            if (!empty($exclude)) {
                $query->whereNotIn("codAu", $exclude);
            }
        }

        $term = $request->get('q', '');
        if ($term) {
            if (DB::getDriverName() === 'sqlite') {
                $query->whereRaw('LOWER("nome") LIKE LOWER(?)', ["%{$term}%"]);
            } else {
                $query->whereRaw('"nome" ILIKE ?', ["%{$term}%"]);
            }
        }

        $result = $query->selectRaw('"codAu" as id, "nome"')
            ->orderBy('nome')
            ->get();


        return response()->json($result);
    }
}
