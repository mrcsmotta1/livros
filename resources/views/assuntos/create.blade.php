<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Criar Assunto') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Criar Assunto</h1>
            <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <form action="{{ route('assuntos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" name="descricao" id="descricao"
                    class="form-control @error('descricao') is-invalid @enderror" value="{{ old('descricao') }}"
                    required>

                {{-- Erro de validação específico --}}
                @error('descricao')
                <x-alert type="danger">
                    {{ $message }}
                </x-alert>
                @enderror

                {{-- Mensagem de sucesso --}}
                @if(session('success'))
                <x-alert type="success">
                    {{ session('success') }}
                </x-alert>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Criar
            </button>
        </form>
    </div>
</x-app-layout>
