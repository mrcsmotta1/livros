<?php

namespace App\Repositories;

use App\Models\RelatorioAutor;
use App\Interfaces\Repositories\RelatorioAutorRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentRelatorioAutorRepository implements RelatorioAutorRepositoryInterface
{
    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return RelatorioAutor::orderBy('autor')->paginate($perPage);
    }

    public function filter(array $filtros, int $perPage = 10): LengthAwarePaginator
    {
        $query = RelatorioAutor::query();

        if (!empty($filtros['autor'])) {
            $query->whereUnaccent('autor', $filtros['autor']);
        }

        if (!empty($filtros['editora'])) {
            $query->where('editora', 'ILIKE', '%' . $filtros['editora'] . '%');
        }

        if (!empty($filtros['titulo_livro'])) {
            $query->whereUnaccent('titulo_livro', $filtros['titulo_livro']);
        }

        if (!empty($filtros['edicao']) && !empty($filtros['operador_edicao'])) {
            $operador = in_array($filtros['operador_edicao'], ['=', '>=', '<=']) ? $filtros['operador_edicao'] : '=';
            $query->where('edicao', $operador, $filtros['edicao']);
        }

        if (!empty($filtros['ano_publicacao']) && !empty($filtros['operador_ano'])) {
            $operador = in_array($filtros['operador_ano'], ['=', '>=', '<=']) ? $filtros['operador_ano'] : '=';
            $query->where('ano_publicacao', $operador, $filtros['ano_publicacao']);
        }

        if (!empty($filtros['valor']) && !empty($filtros['operador_valor'])) {
            $operador = in_array($filtros['operador_valor'], ['=', '>=', '<=']) ? $filtros['operador_valor'] : '=';
            $query->where('valor', $operador, $filtros['valor']);
        }

        if (!empty($filtros['data_inicio']) && !empty($filtros['data_fim'])) {
            $query->whereBetween('data_criacao_livro', [
                $filtros['data_inicio'] . ' 00:00:00',
                $filtros['data_fim'] . ' 23:59:59'
            ]);
        } elseif (!empty($filtros['data_inicio'])) {
            $query->whereDate('data_criacao_livro', '>=', $filtros['data_inicio']);
        } elseif (!empty($filtros['data_fim'])) {
            $query->whereDate('data_criacao_livro', '<=', $filtros['data_fim']);
        }


        return $query->orderBy('autor')->paginate($perPage);
    }

    public function filterAll(array $filtros, int $perPage = 10): Collection
    {
        $query = RelatorioAutor::query();

        if (!empty($filtros['autor'])) {
            $query->whereUnaccent('autor', $filtros['autor']);
        }

        if (!empty($filtros['editora'])) {
            $query->where('editora', 'ILIKE', '%' . $filtros['editora'] . '%');
        }

        if (!empty($filtros['titulo_livro'])) {
            $query->whereUnaccent('titulo_livro', $filtros['titulo_livro']);
        }

        if (!empty($filtros['edicao']) && !empty($filtros['operador_edicao'])) {
            $operador = in_array($filtros['operador_edicao'], ['=', '>=', '<=']) ? $filtros['operador_edicao'] : '=';
            $query->where('edicao', $operador, $filtros['edicao']);
        }

        if (!empty($filtros['ano_publicacao']) && !empty($filtros['operador_ano'])) {
            $operador = in_array($filtros['operador_ano'], ['=', '>=', '<=']) ? $filtros['operador_ano'] : '=';
            $query->where('ano_publicacao', $operador, $filtros['ano_publicacao']);
        }

        if (!empty($filtros['valor']) && !empty($filtros['operador_valor'])) {
            $operador = in_array($filtros['operador_valor'], ['=', '>=', '<=']) ? $filtros['operador_valor'] : '=';
            $query->where('valor', $operador, $filtros['valor']);
        }

        if (!empty($filtros['data_inicio']) && !empty($filtros['data_fim'])) {
            $query->whereBetween('data_criacao_livro', [
                $filtros['data_inicio'] . ' 00:00:00',
                $filtros['data_fim'] . ' 23:59:59'
            ]);
        } elseif (!empty($filtros['data_inicio'])) {
            $query->whereDate('data_criacao_livro', '>=', $filtros['data_inicio']);
        } elseif (!empty($filtros['data_fim'])) {
            $query->whereDate('data_criacao_livro', '<=', $filtros['data_fim']);
        }


        return $query->orderBy('autor')->get();
    }
}
