<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Detalhes do Livro') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <!-- Cabeçalho -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Detalhes do Livro</h1>
            <a href="{{ route('livros.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <x-validation-messages />

        <!-- Card principal -->
        <div class="mt-4 shadow-sm card">
            <div class="card-header bg-light fw-semibold">
                <i class="bi bi-people"></i> Livros
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="shadow-sm card">
                            <div class="card-body">
                                <h5 class="mb-3 card-title">
                                    <i class="bi bi-book"></i> {{ $livro->titulo }}
                                </h5>

                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Editora:</strong> {{ $livro->editora ?? '—' }}</p>
                                        <p class="mb-1"><strong>Edição:</strong> {{ $livro->edicao ?? '—' }}</p>
                                        <p class="mb-1"><strong>Ano de Publicação:</strong> {{ $livro->ano_publicacao ??
                                            '—' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Valor:</strong>
                                            {{ $livro->valor ? 'R$ ' . number_format($livro->valor, 2, ',', '.') : '—'
                                            }}
                                        </p>
                                        <p class="mb-1"><strong>Código:</strong> {{ $livro->codl }}</p>
                                        <p class="mb-1"><strong>Criado em:</strong>
                                            {{ $livro->created_at ? $livro->created_at->format('d/m/Y H:i') : '—' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Autores -->
                        <div class="mt-4 shadow-sm card">
                            <div class="card-header bg-light fw-semibold">
                                <i class="bi bi-people"></i> Autores
                            </div>
                            <div class="card-body">
                                @if ($livro->autores->count() > 0)
                                <ul class="list-group">
                                    @foreach ($livro->autores as $autor)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $autor->nome }}
                                        <a href="{{ route('autores.show', $autor->codAu) }}"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i> Ver Autor
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                <p class="mb-0 text-muted">Nenhum autor associado.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Assuntos -->
                        <div class="mt-4 shadow-sm card">
                            <div class="card-header bg-light fw-semibold">
                                <i class="bi bi-tags"></i> Assuntos
                            </div>
                            <div class="card-body">
                                @if ($livro->assuntos->count() > 0)
                                <ul class="list-group">
                                    @foreach ($livro->assuntos as $assunto)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $assunto->descricao }}
                                        <a href="{{ route('assuntos.show', $assunto->codAs) }}"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i> Ver Assunto
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                <p class="mb-0 text-muted">Nenhum assunto associado.</p>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="mt-4">
                <a href="{{ route('livros.edit', $livro->codl) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="{{ route('livros.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
</x-app-layout>
