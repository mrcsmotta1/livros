<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class livro_autor extends Model
{
    use HasFactory;

    protected $table = 'livro_autor';
    public $timestamps = true;

    protected $fillable = [
        'livro_codl',
        'autor_codAu',
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_codl', 'codl');
    }

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_codAu', 'codAu');
    }
}
