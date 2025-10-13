<?php

namespace App\Models;

use App\Traits\UnaccentSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatorioAutor extends Model
{
    use HasFactory, UnaccentSearchable;
    /**
     * Nome da view no banco.
     */
    protected $table = 'vw_relatorio_autores';

    /**
     * Essa view não tem chave primária autoincremental.
     */
    public $incrementing = false;

    /**
     * Desabilita timestamps automáticos (a view não tem created_at/updated_at próprios).
     */
    public $timestamps = false;

    /**
     * Define o tipo de chave primária (caso precise usar no Eloquent).
     */
    protected $keyType = 'int';

    /**
     * Campos retornados pela view.
     */
    protected $fillable = [
        'id_autor',
        'autor',
        'id_livro',
        'titulo_livro',
        'editora',
        'ano_publicacao',
        'edicao',
        'valor',
        'assuntos_relacionados',
        'data_inicio',
        'data_fim'
    ];
}
