<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Lista de Assuntos') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Lista de Assuntos</h1>
            <!-- Botão para criar novo assunto -->
            <a href="{{ route('assuntos.create') }}" class="btn btn-primary">Criar Assunto</a>
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

        <!-- Tabela de assuntos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assuntos as $assunto)
                <tr>
                    <td>{{ $assunto->codAs }}</td>
                    <td>{{ $assunto->descricao }}</td>
                    <td>
                        <a href="{{ route('assuntos.edit', $assunto->codAs) }}"
                            class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('assuntos.destroy', $assunto->codAs) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-delete">Excluir</button>
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
