<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Lista de Autores') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Autores</h1>
            <a href="{{ route('autores.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Cadastrar Autor
            </a>
        </div>

        <x-validation-messages />

        <div class="mt-4 shadow-sm card">
            <div class="card-header bg-light fw-semibold">
                <i class="bi bi-people"></i> Autores
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        @if($autores->isEmpty())
                        <p class="p-3 mb-0 text-center text-muted">Nenhum Autor cadastrado.</p>
                        @else
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nome</th>
                                        <th style="width: 15%" class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($autores as $autor)
                                    <tr>
                                        <td>{{ $autor->nome }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('autores.show', $autor->codAu) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i></a>
                                            <a href="{{ route('autores.edit', $autor->codAu) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('autores.destroy', $autor->codAu) }}" method="POST"
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
                                {{ $autores->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
