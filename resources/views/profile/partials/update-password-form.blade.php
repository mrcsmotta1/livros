<div class="col-12 col-md-8">
    <div class="shadow-sm card">
        <div class="card-body">
            <h5 class="mb-3 card-title">Atualizar Senha</h5>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>Senha atualizada com sucesso!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Senha Atual</label>
                    <input type="password"
                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                        id="current_password" name="current_password" autocomplete="current-password" required>

                    @error('current_password', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Nova Senha</label>
                    <input type="password"
                        class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password"
                        name="password" autocomplete="new-password" required>

                    @error('password', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                    <input type="password"
                        class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                        id="password_confirmation" name="password_confirmation" autocomplete="new-password" required>

                    @error('password_confirmation', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Senha</button>
            </form>
        </div>
    </div>
</div>
