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

        {{-- Mensagem de sucesso --}}
        @if(session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
        @endif

        {{-- Mensagem de erro genérica --}}
        @if(session('error'))
        <x-alert type="danger">
            {{ session('error') }}
        </x-alert>
        @endif

        <form action="{{ route('assuntos.update', $assunto->codAs) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" name="descricao" id="descricao"
                    class="form-control @error('descricao') is-invalid @enderror"
                    value="{{ old('descricao', $assunto->descricao) }}" required>

                {{-- Erro de validação específico --}}
                @error('descricao')
                <x-alert type="danger">
                    {{ $message }}
                </x-alert>
                @enderror
            </div>

            <button type="submit" class="btn btn-success me-2">
                <i class="bi bi-check-circle"></i> Atualizar
            </button>
            <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancelar
            </a>
        </form>
    </div>
</x-app-layout>
