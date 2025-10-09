<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Lista de Assuntos') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Lista de Assuntos</h1>
            <!-- Botão para criar novo assunto -->
            <a href="{{ route('assuntos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Criar Assunto</a>
        </div>

        <x-validation-messages />

        <!-- Tabela de assuntos -->
        <div class="border-0 shadow-sm card">
            <div class="p-0 card-body">
                @if($assuntos->isEmpty())
                <p class="p-3 mb-0 text-center text-muted">Nenhum Assunto cadastrado.</p>
                @else
                <div class="table-responsive">
                    <table class="table mb-0 align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Descrição</th>
                                <th style="width: 10%" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assuntos as $assunto)
                            <tr>
                                <td>{{ $assunto->descricao }}</td>
                                <td class="text-center">
                                    <a href="{{ route('assuntos.show', $assunto->codAs) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i></a>
                                    <a href="{{ route('assuntos.edit', $assunto->codAs) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('assuntos.destroy', $assunto->codAs) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $assuntos->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
