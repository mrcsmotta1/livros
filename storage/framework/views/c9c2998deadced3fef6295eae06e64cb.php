<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="h4 fw-semibold text-dark">
            <?php echo e(__('Lista de Livros')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="container mt-4">
        <!-- Título e botão -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Livros</h1>
            <a href="<?php echo e(route('livros.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Cadastrar Livro
            </a>
        </div>

        <?php if (isset($component)) { $__componentOriginalfb73a4619cbede6bdd061b5a109eb89d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb73a4619cbede6bdd061b5a109eb89d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation-messages','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('validation-messages'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb73a4619cbede6bdd061b5a109eb89d)): ?>
<?php $attributes = $__attributesOriginalfb73a4619cbede6bdd061b5a109eb89d; ?>
<?php unset($__attributesOriginalfb73a4619cbede6bdd061b5a109eb89d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb73a4619cbede6bdd061b5a109eb89d)): ?>
<?php $component = $__componentOriginalfb73a4619cbede6bdd061b5a109eb89d; ?>
<?php unset($__componentOriginalfb73a4619cbede6bdd061b5a109eb89d); ?>
<?php endif; ?>

        <!-- Card -->
        <div class="mt-4 shadow-sm card">
            <div class="card-header bg-light fw-semibold">
                <i class="bi bi-people"></i> Livros
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <?php if($livros->isEmpty()): ?>
                        <p class="p-3 mb-0 text-center text-muted">Nenhum livro cadastrado.</p>
                        <?php else: ?>
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Título</th>
                                        <th>Editora</th>
                                        <th>Ano</th>
                                        <th>Valor</th>
                                        <th>Autores</th>
                                        <th>Assuntos</th>
                                        <th style="width: 15%" class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $livros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $livro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($livro->titulo); ?></td>
                                        <td><?php echo e($livro->editora); ?></td>
                                        <td><?php echo e($livro->ano_publicacao ?? '—'); ?></td>
                                        <td class="text-start" style="white-space: nowrap;">
                                            <span class="fw-semibold text-success">
                                                R$ <?php echo e(number_format($livro->valor, 2, ',', '.')); ?>

                                            </span>
                                        </td>


                                        <!-- Autores -->
                                        <td>
                                            <?php $__empty_1 = true; $__currentLoopData = $livro->autores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <span class="mb-1 badge bg-primary me-1">
                                                <?php echo e($autor->nome); ?>

                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            —
                                            <?php endif; ?>
                                        </td>

                                        <!-- Assuntos -->
                                        <td>
                                            <?php $__empty_1 = true; $__currentLoopData = $livro->assuntos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <span class="mb-1 badge bg-secondary me-1">
                                                <?php echo e($assunto->descricao); ?>

                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            —
                                            <?php endif; ?>
                                        </td>

                                        <!-- Ações -->
                                        <td class="text-center">
                                            <a href="<?php echo e(route('livros.show', $livro->codl)); ?>"
                                                class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="<?php echo e(route('livros.edit', $livro->codl)); ?>"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="<?php echo e(route('livros.destroy', $livro->codl)); ?>" method="POST"
                                                class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <div class="mt-3 d-flex justify-content-center">
                                <?php echo e($livros->links('pagination::bootstrap-5')); ?>

                            </div>
                        </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /app/resources/views/livros/index.blade.php ENDPATH**/ ?>