<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssuntoStoreRequest;
use App\Interfaces\Services\AssuntoServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;
use Illuminate\Http\Request;
use App\Models\Assunto;
use Illuminate\Support\Facades\DB;

class AssuntoController extends Controller
{
    public function __construct(private AssuntoServiceInterface $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assuntos = $this->service->listarAssuntos();
        return view('assuntos.index', compact('assuntos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assuntos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssuntoStoreRequest $request)
    {
        try {
            $this->service->criarAssunto($request->validated());
            return redirect()
                ->route('assuntos.index')
                ->with('success', 'Assunto criado com sucesso!');
        } catch (Exception $e) {
            return redirect()
                ->route('assuntos.index')
                ->with('error', 'Erro ao criar assunto: tente novamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Assunto $assunto): RedirectResponse|View
    {
        return view('assuntos.show', compact('assunto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assunto $assunto): RedirectResponse|View
    {
        return view('assuntos.edit', compact('assunto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssuntoStoreRequest $request, Assunto $assunto)
    {
        $this->service->atualizarAssunto($assunto->codAs, $request->validated());

        return redirect()
            ->route('assuntos.index')
            ->with('success', 'Assunto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assunto $assunto)
    {
        $this->service->deletarAssunto($assunto->codAs);
        return redirect()
            ->route('assuntos.index')
            ->with('success', 'Assunto excluído com sucesso!');
    }

    public function search(Request $request)
    {
        //Retorna itens do form Edit
        if ($request->filled('id')) {
            $ids = (array) $request->get('id');
            $result = Assunto::whereIn('codAs', $ids)
                ->selectRaw('"codAs" as id, "descricao" as text')
                ->get();

            return response()->json($result);
        }

        $query = Assunto::query();

        if ($request->filled('exclude')) {
            $exclude =  array_filter(array_map('intval', (array) $request->exclude));
            if (!empty($exclude)) {
                $query->whereNotIn("codAs", $exclude);
            }
        }

        $term = $request->get('q', '');
        if ($term) {
            if (DB::getDriverName() === 'sqlite') {
                $query->whereRaw('LOWER("descricao") LIKE LOWER(?)', ["%{$term}%"]);
            } else {
                $query->whereRaw('"descricao" ILIKE ?', ["%{$term}%"]);
            }
        }

        $assuntos = $query->selectRaw('"codAs" as id, "descricao"')
            ->orderBy('descricao')
            ->get();

        return response()->json($assuntos);
    }
}
