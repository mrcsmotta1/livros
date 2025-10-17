<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Editar Assunto') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Assunto: {{ $assunto->descricao }}</h1>
            <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <x-validation-messages />

        <form action="{{ route('assuntos.update', ['assunto' => $assunto->codAs]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mt-4 shadow-sm card">
                <div class="card-header bg-light fw-semibold">
                    <i class="bi bi-tags"></i> Assunto
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label for="descricao" class="form-label"><strong>Descrição:</strong></label>
                            <input type="text" name="descricao" id="descricao"
                                class="form-control @error('descricao') is-invalid @enderror"
                                value="{{ old('descricao', $assunto->descricao) }}">
                        </li>
                    </ul>
                </div>

                <div class="mt-4 d-flex justify-content-start">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-check-circle"></i> Salvar Alterações
                    </button>
                    <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
