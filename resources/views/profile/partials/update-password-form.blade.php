<div class="col-12 col-md-8">
    <div class="shadow-sm card">
        <div class="card-body">
            <h5 class="mb-3 card-title">Atualizar Senha</h5>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Senha Atual</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Nova Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Senha</button>
            </form>
        </div>
    </div>
</div>
