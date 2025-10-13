<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelatorioAutorRequest;
use App\Interfaces\Services\RelatorioAutorServiceInterface;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class RelatorioAutorController extends Controller
{
    public function __construct(
        protected RelatorioAutorServiceInterface $service
    ) {}

    public function index(RelatorioAutorRequest $request): View
    {
        $filtros   = $request->only(keys: ['autor', 'editora', 'titulo_livro', 'operador_edicao', 'edicao', 'operador_ano', 'ano_publicacao', 'operador_valor', 'valor', 'data_inicio', 'data_fim']);
        $relatorio = $this->service->filtrar($filtros);

        return view('relatorios.autores.index', compact('relatorio', 'filtros'));
    }

    public function exportCsv(RelatorioAutorRequest $request): StreamedResponse
    {
        $filtros = $request->only(keys: ['autor', 'editora', 'titulo_livro', 'operador_edicao', 'edicao', 'operador_ano', 'ano_publicacao', 'operador_valor', 'valor', 'data_inicio', 'data_fim']);
        $callback =  $this->service->exportarCsv($filtros);

        $nomeArquivo = 'relatorio_autores_.csv';

        return Response::streamDownload($callback, $nomeArquivo, [
            'Content-Type' => 'application/octet-stream',
        ]);
    }
}
