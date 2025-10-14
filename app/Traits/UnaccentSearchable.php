<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait UnaccentSearchable
{
    /**
     * Escopo para busca insensível a acentos e maiúsculas/minúsculas.
     *
     * @example Model::whereUnaccent('nome', 'zelia')->get();
     */
    public function scopeWhereUnaccent(Builder $query, string $column, string $value): Builder
    {
        // Evita injeção de SQL em nome de coluna
        $column = str_replace(['"', "'"], '', $column);

        if (DB::getDriverName() === 'sqlite') {
            // Fallback para SQLite (sem unaccent/ILIKE)
            return $query->whereRaw("LOWER({$column}) LIKE LOWER(?)", ['%' . $value . '%']);
        }

        return $query->whereRaw("unaccent({$column}) ILIKE unaccent(?)", ['%' . $value . '%']);
    }
}
