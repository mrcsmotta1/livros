<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autor';
    protected $primaryKey = 'codAu';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nome'
    ];
    public $timestamps = true;

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = ucwords(strtolower(trim($value)));
    }

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_autor', 'autor_codAu', 'livro_codl');
    }

}
