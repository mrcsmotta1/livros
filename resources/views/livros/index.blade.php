<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Lista de Livros') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Lista de Livros</h1>
            <!-- Botão para criar novo livro -->
            <a href="{{ route('livros.create') }}" class="btn btn-primary">Criar Livro</a>
        </div>

        <!-- Mensagens de sucesso -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Mensagens de erro -->
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Tabela de livros -->
        <table class="table align-middle table-bordered">
            <thead class="table-light">
                <tr>
                    <th style="width: 5%">ID</th>
                    <th>Título</th>
                    <th>Editora</th>
                    <th>Edição</th>
                    <th>Ano</th>
                    <th class="text-end">Valor (R$)</th>
                    <th style="width: 20%" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($livros as $livro)
                <tr>
                    <td>{{ $livro->codl }}</td>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->editora ?? '-' }}</td>
                    <td>{{ $livro->edicao ?? '-' }}</td>
                    <td>{{ $livro->ano_publicacao ?? '-' }}</td>
                    <td class="text-end">{{ number_format($livro->valor ?? 0, 2, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('livros.show', $livro->codl) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i> Ver
                        </a>
                        <a href="{{ route('livros.edit', $livro->codl) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('livros.destroy', $livro->codl) }}" method="POST" class="d-inline">
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
                    <td colspan="7" class="text-center">Nenhum livro cadastrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const form = this.closest('form');

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Essa ação não poderá ser desfeita!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
