<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Detalhes do Autor') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Visualizar Autor</h1>
            <a href="{{ route('autores.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="mt-4 shadow-sm card">
            <div class="card-header bg-light fw-semibold">
                <i class="bi bi-tags"></i> Autor
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome"
                            class="form-control @error('nome') is-invalid @enderror"
                            value="{{ old('nome', $autor->nome) }}" required>
                    </li>
                </ul>
            </div>

            <div class="mt-4">
                <a href="{{ route('autores.edit', ['autor' => $autor->codAu]) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="{{ route('autores.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
