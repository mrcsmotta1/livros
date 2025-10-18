<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Detalhes do Assunto') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Visualizar Assunto</h1>
            <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="mt-4 shadow-sm card">
            <div class="card-header bg-light fw-semibold">
                <i class="bi bi-tags"></i> Assunto
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="mb-2 row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Descrição:</strong> {{ $assunto->descricao ?? '—' }}</p>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('assuntos.edit', ['assunto' => $assunto->codAs]) }}"
                                    class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Voltar
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
