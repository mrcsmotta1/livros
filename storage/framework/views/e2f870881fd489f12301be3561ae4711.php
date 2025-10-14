<!-- Deletar Conta -->
<div class="col-12 col-md-8">
    <div class="shadow-sm card">
        <div class="card-body">
            <h5 class="mb-3 card-title text-danger">Deletar Conta</h5>
            <p>Ao deletar sua conta, todos os dados serão removidos permanentemente.</p>

            <form method="POST" action="<?php echo e(route('profile.destroy')); ?>" id="deleteAccountForm">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>

                <div class="mb-3">
                    <label for="password_delete" class="form-label">Confirme sua senha</label>
                    <input type="password" class="form-control" id="password_delete" name="password" required>
                </div>

                <?php $__errorArgs = ['password', 'userDeletion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="mt-1 text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>



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

<?php if($errors->has('password')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: '<?php echo e($errors->first('password')); ?>',
        });
    <?php endif; ?>
</script>
<?php /**PATH /app/resources/views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>