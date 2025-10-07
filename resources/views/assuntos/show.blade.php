<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Editar Assunto') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Editar Assunto</h1>
            <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror"
                value="{{ old('descricao', $assunto->descricao) }}" required>
        </div>

        <a href="{{ route('assuntos.edit', $assunto->codAs) }}" class="btn btn-sm btn-warning">
            <i class="bi bi-pencil"></i> Editar</a>
    </div>
</x-app-layout>
