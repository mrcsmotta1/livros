<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';
    protected $primaryKey = 'codl';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'titulo',
        'editora',
        'edicao',
        'ano_publicacao',
        'valor'
    ];

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'livro_autor', 'livro_codl', 'autor_codAu');
    }

    public function assuntos(): BelongsToMany
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto', 'livro_codl', 'assunto_codAs');
    }

    // public function setValorAttribute($value)
    // {
    //     if (is_string($value)) {
    //         $clean = str_replace(['R$', ' '], '', $value);
    //         $clean = str_replace('.', '', $clean);
    //         $clean = str_replace(',', '.', $clean);
    //         $this->attributes['valor'] = is_numeric($clean) ? $clean : null;
    //     } else {
    //         $this->attributes['valor'] = $value;
    //     }
    // }
}
