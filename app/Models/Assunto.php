<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    protected $table = 'assunto';
    protected $primaryKey = 'codAs';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'descricao'
    ];
    public $timestamps = true;

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_assunto', 'assunto_codAs', 'livro_codl');
    }
}
