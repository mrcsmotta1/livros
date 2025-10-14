<div class="col-12 col-md-8">
    <div class="shadow-sm card">
        <div class="card-body">
            <h5 class="mb-3 card-title">Atualizar Informações do Perfil</h5>
            <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="<?php echo e(old('name', $user->name)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="<?php echo e(old('email', $user->email)); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
            </form>
        </div>
    </div>
</div>
<?php /**PATH /app/resources/views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>