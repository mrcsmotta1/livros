<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Editar Livro') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <!-- Cabeçalho -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Editar Livro</h1>
            <a href="{{ route('livros.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <!-- Formulário -->
        <form id="form-livro" action="{{ route('livros.update', $livro->codl) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Dados principais -->
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control"
                        value="{{ old('titulo', $livro->titulo) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="editora" class="form-label">Editora</label>
                    <input type="text" name="editora" id="editora" class="form-control"
                        value="{{ old('editora', $livro->editora) }}">
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-md-4">
                    <label for="edicao" class="form-label">Edição</label>
                    <input type="number" name="edicao" id="edicao" class="form-control"
                        value="{{ old('edicao', $livro->edicao) }}" min="1" step="1"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <div class="col-md-4">
                    <label for="ano_publicacao" class="form-label">Ano de Publicação</label>
                    <input type="text" name="ano_publicacao" id="ano_publicacao" maxlength="4" class="form-control"
                        value="{{ old('ano_publicacao', $livro->ano_publicacao) }}"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <div class="col-md-4">
                    <label for="valor" class="form-label">Valor (R$)</label>
                    <input type="text" name="valor" id="valor" class="form-control"
                        value="{{ old('valor', number_format($livro->valor, 2, ',', '.')) }}">
                </div>
            </div>

            <!-- Autores -->
            <div class="mb-3">
                <label class="form-label">Autores</label>
                <div id="autores-container">
                    @forelse ($livro->autores as $autor)
                        <div class="mb-2 input-group autor-field">
                            <select name="autores[]" class="form-select autor-select" data-selected="{{ $autor->codAu }}"></select>
                            <button type="button" class="btn btn-danger remove-autor">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>
                    @empty
                        <div class="mb-2 input-group autor-field">
                            <select name="autores[]" class="form-select autor-select"></select>
                            <button type="button" class="btn btn-danger remove-autor" style="display:none;">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>
                    @endforelse
                </div>

                <button type="button" id="add-autor" class="mt-2 btn btn-outline-primary btn-sm" disabled>
                    <i class="bi bi-plus-circle"></i> Adicionar Autor
                </button>
            </div>

            <!-- Assuntos -->
            <div class="mb-3">
                <label class="form-label">Assuntos</label>
                <div id="assuntos-container">
                    @forelse ($livro->assuntos as $assunto)
                        <div class="mb-2 input-group assunto-field">
                            <select name="assuntos[]" class="form-select assunto-select" data-selected="{{ $assunto->codAs }}"></select>
                            <button type="button" class="btn btn-danger remove-assunto">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>
                    @empty
                        <div class="mb-2 input-group assunto-field">
                            <select name="assuntos[]" class="form-select assunto-select"></select>
                            <button type="button" class="btn btn-danger remove-assunto" style="display:none;">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>
                    @endforelse
                </div>

                <button type="button" id="add-assunto" class="mt-2 btn btn-outline-primary btn-sm" disabled>
                    <i class="bi bi-plus-circle"></i> Adicionar Assunto
                </button>
            </div>

            <!-- Botões -->
            <div class="mt-4 d-flex justify-content-start">
                <button type="submit" class="btn btn-success me-2">
                    <i class="bi bi-check-circle"></i> Salvar Alterações
                </button>
                <a href="{{ route('livros.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
