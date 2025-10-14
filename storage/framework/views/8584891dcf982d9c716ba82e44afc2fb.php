<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container" style="max-width: 1370px;"> <!-- centraliza e limita largura -->

        <!-- Logo -->
        <a class="navbar-brand" href="<?php echo e(route('index')); ?>">
            <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['style' => 'height: 36px;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['style' => 'height: 36px;']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
        </a>

        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links e dropdown -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Menu principal -->
            <ul class="mb-2 navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('index') ? 'active' : ''); ?>" href="<?php echo e(route('index')); ?>">Index</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('livros.index') ? 'active' : ''); ?>" href="<?php echo e(route('livros.index')); ?>">Livros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('autores.index') ? 'active' : ''); ?>" href="<?php echo e(route('autores.index')); ?>">Autor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('assuntos.index') ? 'active' : ''); ?>" href="<?php echo e(route('assuntos.index')); ?>">Assunto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('relatorios.autores.*') ? 'active' : ''); ?>" href="<?php echo e(route('relatorios.autores.index')); ?>">Relatório Autor</a>
                </li>
            </ul>

            <!-- Perfil à direita -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo e(Auth::user()->name); ?>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">Editar Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">Sair</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /private/var/www/desafio_tecnico/livros/resources/views/layouts/navigation.blade.php ENDPATH**/ ?>