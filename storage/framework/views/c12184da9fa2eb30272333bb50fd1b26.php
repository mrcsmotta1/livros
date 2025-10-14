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
        <h2 class="h4 fw-semibold text-dark">Dashboard</h2>
     <?php $__env->endSlot(); ?>

    <div class="container mt-4">
        
        <div class="mb-4 text-center row">
            <div class="mb-3 col-md-4">
                <a href="<?php echo e(route('livros.index')); ?>" class="text-decoration-none text-reset">
                    <div class="transition-all border-0 shadow-sm card hover-shadow">
                        <div class="text-center card-body">
                            <i class="bi bi-book text-primary fs-2"></i>
                            <h4 class="mt-2"><?php echo e($livrosCount); ?></h4>
                            <p class="mb-0 text-muted">Livros cadastrados</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-3 col-md-4">
                <a href="<?php echo e(route('autores.index')); ?>" class="text-decoration-none text-reset">
                    <div class="transition-all border-0 shadow-sm card hover-shadow">
                        <div class="text-center card-body">
                            <i class="bi bi-person-lines-fill text-success fs-2"></i>
                            <h4 class="mt-2"><?php echo e($autoresCount); ?></h4>
                            <p class="mb-0 text-muted">Autores cadastrados</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mb-3 col-md-4">
                <a href="<?php echo e(route('assuntos.index')); ?>" class="text-decoration-none text-reset">
                    <div class="transition-all border-0 shadow-sm card hover-shadow">
                        <div class="text-center card-body">
                            <i class="bi bi-tags-fill text-warning fs-2"></i>
                            <h4 class="mt-2"><?php echo e($assuntosCount); ?></h4>
                            <p class="mb-0 text-muted">Assuntos cadastrados</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        
        <div class="border-0 shadow-sm card">
            <div class="bg-white card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>
                    <?php if($ultimosLivros->count() === 0): ?>
                        Nenhum livro cadastrado
                    <?php elseif($ultimosLivros->count() === 1): ?>
                        Último livro cadastrado
                    <?php else: ?>
                        Últimos <?php echo e($ultimosLivros->count()); ?> livros cadastrados
                    <?php endif; ?>
                </h5>
                <a href="<?php echo e(route('livros.index')); ?>" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-list"></i> Ver todos
                </a>
            </div>

            <div class="p-0 card-body">
                <?php if($ultimosLivros->isEmpty()): ?>
                <p class="p-3 mb-0 text-center text-muted">
                    Nenhum livro cadastrado até o momento.
                </p>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table mb-0 align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Título</th>
                                <th>Assunto</th>
                                <th>Editora</th>
                                <th>Autor Principal</th>
                                <th>Ano</th>
                                <th>Valor</th>
                                <th>Data de Cadastro</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $ultimosLivros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $livro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($livro->titulo); ?></td>
                                <td><?php echo e($livro->editora); ?></td>
                                <td>
                                    <?php echo e($livro->assunto_principal?->descricao ?? '—'); ?>

                                </td>
                                <td>
                                    <?php echo e($livro->autor_principal?->nome ?? '—'); ?>

                                </td>
                                <td><?php echo e($livro->ano_publicacao ?? '—'); ?></td>
                                <td>R$ <?php echo e(number_format($livro->valor, 2, ',', '.')); ?></td>
                                <td>
                                    <?php echo e($livro->created_at->timezone('America/Sao_Paulo')->format('d/m/Y H:i')); ?>

                                </td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('livros.show', $livro->codl)); ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('livros.edit', $livro->codl)); ?>"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
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
<?php /**PATH /app/resources/views/index.blade.php ENDPATH**/ ?>