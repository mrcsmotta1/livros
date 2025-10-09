<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;

class IndexController extends Controller
{
    public function index()
    {
        $livros = Livro::with('autores') // eager loading pra evitar N+1
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('index', [
            'livrosCount'   => Livro::count(),
            'autoresCount'  => Autor::count(),
            'assuntosCount' => Assunto::count(),
            'ultimosLivros' => $livros,
        ]);
    }
}
