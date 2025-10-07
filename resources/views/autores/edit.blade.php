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

        <form action="{{ route('autores.update', $autor->codAu) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome"
                    class="form-control @error('nome') is-invalid @enderror"
                    value="{{ old('nome', $autor->nome) }}" required>

                {{-- Erro de validação específico --}}
                @error('nome')
                <x-alert type="danger">
                    {{ $message }}
                </x-alert>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Atualizar
            </button>
        </form>
    </div>
</x-app-layout>
