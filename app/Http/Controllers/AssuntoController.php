<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssuntoStoreRequest;
use App\Models\Assunto;
use Illuminate\Http\Request;
use App\Services\AssuntoService;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Database\QueryException;

class AssuntoController extends Controller
{
    public function __construct(private AssuntoService $assuntoService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $assuntos = $this->assuntoService->getAllAssuntos();
            return view('assuntos.index', compact('assuntos'));
        } catch (Exception $e) {
            return redirect()->route('assuntos.index')
                ->with('error', 'Erro ao carregar assuntos: ' . $e->getMessage());
        }
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
            $validatedData = $request->validated();

            $this->assuntoService->createAssunto($validatedData);

            return redirect()->route('assuntos.index')
                ->with('success', 'Assunto criado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->with('error', 'Erro ao criar assunto: ' . $e->getMessage())
                ->withInput();
        } catch (QueryException $e) {
            return redirect()->back()
                ->with('error', 'Erro ao criar assunto, tente novamente.')
                ->withInput();
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Ocorreu um erro inesperado.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $assunto = $this->assuntoService->findAssuntoById($id);

            if (!$assunto) {
                return redirect()->route('assuntos.index')
                    ->with('error', 'Assunto não encontrado');
            }

            return view('assuntos.show', compact('assunto'));
        } catch (Exception $e) {
            return redirect()->route('assuntos.index')
                ->with('error', 'Erro ao buscar assunto: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $assunto = $this->assuntoService->findAssuntoById($id);

            if (!$assunto) {
                return redirect()->route('assuntos.index')
                    ->with('error', 'Assunto não encontrado');
            }

            return view('assuntos.edit', compact('assunto'));
        } catch (Exception $e) {
            return redirect()->route('assuntos.index')
                ->with('error', 'Erro ao buscar assunto para edição: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $assunto = $this->assuntoService->findAssuntoById($id);

            if (!$assunto) {
                return redirect()->route('assuntos.index')
                    ->with('error', 'Assunto não encontrado');
            }

            $validatedData = $request->validate([
                'descricao' => 'required|string|max:20|unique:assuntos,descricao,' . $id . ',codAs', // Ignora o próprio assunto ao verificar unicidade
            ]);

            $this->assuntoService->updateAssunto($assunto, $validatedData);

            return redirect()->route('assuntos.index')
                ->with('success', 'Assunto atualizado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->route('assuntos.index')
                ->with('error', 'Erro ao atualizar assunto: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('assuntos.index')
                ->with('error', 'Erro ao atualizar assunto: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $assunto = $this->assuntoService->findAssuntoById($id);

            if (!$assunto) {
                return redirect()->route('assuntos.index')
                    ->with('error', 'Assunto não encontrado');
            }

            $this->assuntoService->deleteAssunto($assunto);

            return redirect()->route('assuntos.index')
                ->with('success', 'Assunto excluído com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('assuntos.index')
                ->with('error', 'Erro ao excluir assunto: ' . $e->getMessage());
        }
    }
}
