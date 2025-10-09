<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Autor;
use App\Models\Assunto;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livro';
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
        return $this->belongsToMany(Autor::class, 'livro_autor', 'livro_codl', 'autor_codAu')
            ->withTimestamps();
    }

    public function assuntos(): BelongsToMany
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto', 'livro_codl', 'assunto_codAs')
            ->withTimestamps();
    }

    public function getAutorPrincipalAttribute(): object|null
    {
        return $this->autores()->orderBy('livro_autor.id')->first();
    }

    public function getAssuntoPrincipalAttribute(): object|null
    {
        return $this->assuntos()->orderBy('livro_assunto.id')->first();
    }
}
