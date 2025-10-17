<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Cadastrar Livro') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Cadastrar Livro</h1>
            <a href="{{ route('livros.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <x-validation-messages />

        <!-- Formulário -->
        <form id="form-livro" action="{{ route('livros.store') }}" method="POST">
            @csrf

            <div class="mt-4 shadow-sm card">
                <div class="card-header bg-light fw-semibold">
                    <i class="bi bi-tags"></i> Livro
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">

                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="titulo" class="form-label"><strong>Título </strong></label>
                                    <input type="text" name="titulo" id="titulo"
                                        class="form-control @error('titulo') is-invalid @enderror"
                                        value="{{ old('titulo') }}" autofocus>
                                    @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="editora" class="form-label"><strong>Editora</strong></label>
                                    <input type="text" name="editora" id="editora"
                                        class="form-control @error('editora') is-invalid @enderror"
                                        value="{{ old('editora') }}">
                                    @error('editora')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label for="edicao" class="form-label"><strong>Edição</strong></label>
                                    <input type="number" name="edicao" id="edicao"
                                        class="form-control @error('edicao') is-invalid @enderror"
                                        value="{{ old('edicao') }}" min="1" step="1"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    @error('edicao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="ano_publicacao" class="form-label"><strong>Ano de
                                            Publicação</strong></label>
                                    <input type="text" name="ano_publicacao" id="ano_publicacao"
                                        class="form-control @error('ano_publicacao') is-invalid @enderror"
                                        value="{{ old('ano_publicacao') }}" maxlength="4"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    @error('ano_publicacao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="valor" class="form-label"><strong>Valor (R$)</strong></label>
                                    <input type="text" name="valor" id="valor"
                                        class="form-control @error('valor') is-invalid @enderror"
                                        value="{{ old('valor') }}">
                                    @error('valor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Autores -->
                            <div class="mb-3">
                                <label class="form-label"><strong>Autores</strong></label>
                                <div id="autores-container"
                                    class="@error('autores') border border-danger rounded p-2 @enderror">
                                    <div class="mb-2 input-group autor-field">
                                        <select name="autores[]" class="form-select autor-select"></select>
                                        <button type="button" class="btn btn-danger remove-autor" style="displaynone;">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('autores')
                                <div class="mt-1 text-danger small">{{ $message }}</div>
                                @enderror

                                <button type="button" id="add-autor" class="mt-2 btn btn-outline-primary btn-sm"
                                    disabled>
                                    <i class="bi bi-plus-circle"></i> Adicionar Autor
                                </button>
                            </div>

                            <!-- Assuntos -->
                            <div class="mb-3">
                                <label class="form-label"><strong>Assuntos</strong></label>
                                <div id="assuntos-container"
                                    class="@error('assuntos') border border-danger rounded p-2 @enderror">
                                    <div class="mb-2 input-group assunto-field">
                                        <select name="assuntos[]" class="form-select assunto-select"></select>
                                        <button type="button" class="btn btn-danger remove-assunto"
                                            style="displaynone;">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('assuntos')
                                <div class="mt-1 text-danger small">{{ $message }}</div>
                                @enderror

                                <button type="button" id="add-assunto" class="mt-2 btn btn-outline-primary btn-sm"
                                    disabled>
                                    <i class="bi bi-plus-circle"></i> Adicionar Assunto
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="mt-4 d-flex justify-content-start">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-check-circle"></i> Salvar Alterações
                    </button>
                    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
        </form>
    </div>

    <x-slot name="scripts">
        <script>
            window.livroOld = {
                autores: @json(old('autores', [])),
                assuntos: @json(old('assuntos', []))
            };
        </script>
    </x-slot>
</x-app-layout>
