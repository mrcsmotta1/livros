<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Editar Autor') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Editar Autor</h1>
            <a href="{{ route('autores.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                value="{{ old('nome', $autor->nome) }}" required>
        </div>

        <a href="{{ route('autores.edit', $autor->codAu) }}" class="btn btn-sm btn-warning">
            <i class="bi bi-pencil"></i> Editar</a>
    </div>
</x-app-layout>
