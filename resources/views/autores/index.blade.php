<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Lista de Autores') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Lista de Autores</h1>
            <!-- Botão para criar novo autor -->
            <a href="{{ route('autores.create') }}" class="btn btn-primary">Criar Autor</a>
        </div>

        <x-validation-messages />

        <!-- Tabela de autores -->
        <table class="table align-middle table-bordered">
            <thead>
                <tr>
                    <th style="width: 10%">ID</th>
                    <th>Descrição</th>
                    <th style="width: 20%" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($autores as $autor)
                <tr>
                    <td>{{ $autor->codAu }}</td>
                    <td>{{ $autor->nome }}</td>
                    <td class="text-center">
                        <a href="{{ route('autores.show', $autor->codAu) }}"
                            class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i> Ver</a>
                        <a href="{{ route('autores.edit', $autor->codAu) }}"
                            class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar</a>
                        <form action="{{ route('autores.destroy', $autor->codAu) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Nenhum assunto cadastrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
