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

        <x-validation-messages />

        <form action="{{ route('autores.update', $autor->codAu) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                    value="{{ old('nome', $autor->nome) }}" required>
                <button type="submit" class="btn btn-success me-2">
                    <i class="bi bi-check-circle"></i> Atualizar
                </button>
                <a href="{{ route('autores.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
        </form>
    </div>
</x-app-layout>
