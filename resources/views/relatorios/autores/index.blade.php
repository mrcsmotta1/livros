<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Relatório de Autores e Livros') }}
        </h2>
    </x-slot>

    <x-validation-messages />

    <div class="container mt-4">
        <form method="GET" action="{{ route('relatorios.autores.index') }}" id="relatorios-autores"
            class="p-3 mb-4 rounded shadow-sm row g-3 bg-light">

            <!-- Autor -->
            <div class="col-md-3">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" value="{{ old('autor', $filtros['autor'] ?? '') }}"
                    class="form-control">
            </div>

            <!-- Livro -->
            <div class="col-md-3">
                <label class="form-label">Título do Livro</label>
                <input type="text" name="titulo_livro" value="{{ old('autor', $filtros['titulo_livro'] ?? '') }}"
                    class="form-control">
            </div>

            <!-- Editora -->
            <div class="col-md-3">
                <label class="form-label">Editora</label>
                <input type="text" name="editora" value="{{ old('autor', $filtros['editora'] ?? '') }}"
                    class="form-control">
            </div>

            <!-- Edição -->
            <div class="col-md-3">
                <label class="form-label">Edição</label>
                <div class="input-group">
                    <select name="operador_edicao" class="form-select" style="max-width: 100px;">
                        <option value="=" {{ (old('operador_edicao', $filtros['operador_edicao'] ?? '' )==='=' )
                            ? 'selected' : '' }}>=</option>
                        <option value=">=" {{ (old('operador_edicao', $filtros['operador_edicao'] ?? '' )==='>=' )
                            ? 'selected' : '' }}>maior ou igual</option>
                        <option value="<=" {{ (old('operador_edicao', $filtros['operador_edicao'] ?? '' )==='<=' )
                            ? 'selected' : '' }}>menor ou igual</option>
                    </select>
                    <input type="number" name="edicao" value="{{ old('autor', $filtros['edicao'] ?? '') }}"
                        class="form-control">
                </div>
            </div>

            <!-- Ano de publicação -->
            <div class="col-md-3">
                <label class="form-label">Ano de Publicação</label>
                <div class="input-group">
                    <select name="operador_ano" class="form-select" style="max-width: 100px;">
                        <option value="=" {{ (old('operador_ano', $filtros['operador_ano'] ?? '' )==='=' ) ? 'selected'
                            : '' }}>=</option>
                        <option value=">=" {{ (old('operador_ano', $filtros['operador_ano'] ?? '' )==='>=' )
                            ? 'selected' : '' }}>maior ou igual</option>
                        <option value="<=" {{ (old('operador_ano', $filtros['operador_ano'] ?? '' )==='<=' )
                            ? 'selected' : '' }}>menor ou igual</option>
                    </select>
                    <input type="text" name="ano_publicacao" id="ano_publicacao" class="form-control"
                        value="{{ old('ano_publicacao', $filtros['ano_publicacao'] ?? '') }}" maxlength="4"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>

            <!-- Valor -->
            <div class="col-md-3">
                <label for="operador_valor" class="form-label">Valor (R$)</label>
                <div class="input-group">
                    <select id="operador_valor" name="operador_valor" class="form-select" style="max-width: 100px;">
                        <option value="=" {{ (old('operador_valor', $filtros['operador_valor'] ?? '' )==='=' )
                            ? 'selected' : '' }}>=</option>
                        <option value=">=" {{ (old('operador_valor', $filtros['operador_valor'] ?? '' )==='>=' )
                            ? 'selected' : '' }}>maior ou igual</option>
                        <option value="<=" {{ (old('operador_valor', $filtros['operador_valor'] ?? '' )==='<=' )
                            ? 'selected' : '' }}>menor ou igual</option>
                    </select>
                    <input type="text" id="valor" name="valor" value="{{ old('valor', $filtros['valor'] ?? '') }}"
                        class="form-control">
                </div>
            </div>

            <!-- Range de data de criação -->
            <div class="col-md-3">
                <label class="form-label">Criado de</label>
                <input type="date" name="data_inicio" value="{{ request('data_inicio') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Até</label>
                <input type="date" name="data_fim" value="{{ request('data_fim') }}" class="form-control">
            </div>

            <!-- Botões -->
            <div class="gap-2 mt-3 col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Filtrar
                </button>

                <button type="button" id="btnExportarCsv" class="btn btn-success">
                    <i class="bi bi-file-earmark-arrow-down"></i> Exportar CSV
                </button>

                <a href="{{ route('relatorios.autores.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Limpar
                </a>
            </div>
        </form>



        <div class="table-responsive">
            <table class="table align-middle table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Autor</th>
                        <th>Título</th>
                        <th>Editora</th>
                        <th>Ano Publicação</th>
                        <th>Edição</th>
                        <th>Valor (R$)</th>
                        <th>Assunto</th>
                        <th>Data de Criação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($relatorio as $item)
                    <tr>
                        <td>{{ $item->autor }}</td>
                        <td>{{ $item->titulo_livro }}</td>
                        <td>{{ $item->editora }}</td>
                        <td>{{ $item->ano_publicacao }}</td>
                        <td>{{ $item->edicao }}</td>
                        <td>R$ {{ number_format($item->valor, 2, ',', '.') }}</td>
                        <td>{{ $item->assuntos_relacionados }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($item->data_criacao_livro)->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Nenhum resultado encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3 d-flex justify-content-center">
                {{ $relatorio->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    window.ROUTES = {
        exportCsv: "{{ route('relatorios.autores.csv') }}"
    };
</script>
