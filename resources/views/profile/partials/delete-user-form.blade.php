<!-- Deletar Conta -->
<div class="col-12 col-md-8">
    <div class="shadow-sm card">
        <div class="card-body">
            <h5 class="mb-3 card-title text-danger">Deletar Conta</h5>
            <p>Ao deletar sua conta, todos os dados serão removidos permanentemente.</p>

            <form method="POST" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <label for="password_delete" class="form-label">Confirme sua senha</label>
                    <input type="password" class="form-control" id="password_delete" name="password" required>
                </div>

                @error('password', 'userDeletion')
                    <div class="mt-1 text-danger">{{ $message }}</div>
                @enderror



                <button type="button" class="btn btn-danger" id="deleteAccountButton">
                    Deletar Conta
                </button>
            </form>
        </div>

    </div>
</div>

<script>
document.getElementById('deleteAccountButton').addEventListener('click', function() {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Esta ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sim, deletar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteAccountForm').submit();
        }
    });
});

@if ($errors->has('password'))
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: '{{ $errors->first('password') }}',
        });
    @endif
</script>
