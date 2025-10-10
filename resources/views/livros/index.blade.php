<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Lista de Livros') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <!-- Título e botão -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Livros</h1>
            <a href="{{ route('livros.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Cadastrar Livro
            </a>
        </div>

        <x-validation-messages />

        <!-- Card -->
        <div class="mt-4 shadow-sm card">
            <div class="card-header bg-light fw-semibold">
                <i class="bi bi-people"></i> Livros
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        @if($livros->isEmpty())
                        <p class="p-3 mb-0 text-center text-muted">Nenhum livro cadastrado.</p>
                        @else
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Título</th>
                                        <th>Editora</th>
                                        <th>Ano</th>
                                        <th>Valor</th>
                                        <th>Autores</th>
                                        <th>Assuntos</th>
                                        <th style="width: 15%" class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($livros as $livro)
                                    <tr>
                                        <td>{{ $livro->titulo }}</td>
                                        <td>{{ $livro->editora }}</td>
                                        <td>{{ $livro->ano_publicacao ?? '—' }}</td>
                                        <td class="text-start" style="white-space: nowrap;">
                                            <span class="fw-semibold text-success">
                                                R$ {{ number_format($livro->valor, 2, ',', '.') }}
                                            </span>
                                        </td>


                                        <!-- Autores -->
                                        <td>
                                            @forelse($livro->autores as $autor)
                                            <span class="mb-1 badge bg-primary me-1">
                                                {{ $autor->nome }}
                                            </span>
                                            @empty
                                            —
                                            @endforelse
                                        </td>

                                        <!-- Assuntos -->
                                        <td>
                                            @forelse($livro->assuntos as $assunto)
                                            <span class="mb-1 badge bg-secondary me-1">
                                                {{ $assunto->descricao }}
                                            </span>
                                            @empty
                                            —
                                            @endforelse
                                        </td>

                                        <!-- Ações -->
                                        <td class="text-center">
                                            <a href="{{ route('livros.show', $livro->codl) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="{{ route('livros.edit', $livro->codl) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('livros.destroy', $livro->codl) }}" method="POST"
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
                                {{ $livros->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
