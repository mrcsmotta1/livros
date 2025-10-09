<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">Dashboard</h2>
    </x-slot>

    <div class="container mt-4">
        {{-- Contadores gerais --}}
        <div class="mb-4 text-center row">
            <div class="mb-3 col-md-4">
                <a href="{{ route('livros.index') }}" class="text-decoration-none text-reset">
                    <div class="transition-all border-0 shadow-sm card hover-shadow">
                        <div class="text-center card-body">
                            <i class="bi bi-book text-primary fs-2"></i>
                            <h4 class="mt-2">{{ $livrosCount }}</h4>
                            <p class="mb-0 text-muted">Livros cadastrados</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-3 col-md-4">
                <a href="{{ route('autores.index') }}" class="text-decoration-none text-reset">
                    <div class="transition-all border-0 shadow-sm card hover-shadow">
                        <div class="text-center card-body">
                            <i class="bi bi-person-lines-fill text-success fs-2"></i>
                            <h4 class="mt-2">{{ $autoresCount }}</h4>
                            <p class="mb-0 text-muted">Autores cadastrados</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-3 col-md-4">
                <a href="{{ route('assuntos.index') }}" class="text-decoration-none text-reset">
                    <div class="transition-all border-0 shadow-sm card hover-shadow">
                        <div class="text-center card-body">
                            <i class="bi bi-tags-fill text-warning fs-2"></i>
                            <h4 class="mt-2">{{ $assuntosCount }}</h4>
                            <p class="mb-0 text-muted">Assuntos cadastrados</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Últimos livros --}}
        <div class="border-0 shadow-sm card">
            <div class="bg-white card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>
                    @if ($livrosCount === 0)
                    Nenhum livro cadastrado
                    @elseif ($livrosCount === 1)
                    Último livro cadastrado
                    @else
                    Últimos {{ $livrosCount }} livros cadastrados
                    @endif
                </h5>
                <a href="{{ route('livros.index') }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-list"></i> Ver todos
                </a>
            </div>

            <div class="p-0 card-body">
                @if($ultimosLivros->isEmpty())
                <p class="p-3 mb-0 text-center text-muted">
                    Nenhum livro cadastrado até o momento.
                </p>
                @else
                <div class="table-responsive">
                    <table class="table mb-0 align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Título</th>
                                <th>Assunto</th>
                                <th>Editora</th>
                                <th>Autor Principal</th>
                                <th>Ano</th>
                                <th>Valor</th>
                                <th>Data de Cadastro</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ultimosLivros as $livro)
                            <tr>
                                <td>{{ $livro->titulo }}</td>
                                <td>{{ $livro->editora }}</td>
                                <td>
                                    {{ $livro->assunto_principal?->descricao ?? '—' }}
                                </td>
                                <td>
                                    {{ $livro->autor_principal?->nome ?? '—' }}
                                </td>
                                <td>{{ $livro->ano_publicacao ?? '—' }}</td>
                                <td>R$ {{ number_format($livro->valor, 2, ',', '.') }}</td>
                                <td>
                                    {{ $livro->created_at->timezone('America/Sao_Paulo')->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('livros.show', $livro->codl) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('livros.edit', $livro->codl) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
