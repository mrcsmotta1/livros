<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class livro_assunto extends Model
{
    use HasFactory;

    protected $table = 'livro_assunto';
    public $timestamps = true;

    protected $fillable = [
        'livro_codl',
        'assunto_codAs',
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_codl', 'codl');
    }

    public function assunto()
    {
        return $this->belongsTo(Assunto::class, 'assunto_codAs', 'codAs');
    }
}
