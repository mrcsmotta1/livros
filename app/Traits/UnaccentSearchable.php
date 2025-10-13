<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

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

        return $query->whereRaw("unaccent({$column}) ILIKE unaccent(?)", ['%' . $value . '%']);
    }
}
