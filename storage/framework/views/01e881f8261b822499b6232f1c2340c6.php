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
            <?php echo e(__('Detalhes do Livro')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="container mt-4">
        <!-- Cabeçalho -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Detalhes do Livro</h1>
            <a href="<?php echo e(route('livros.index')); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
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

        <!-- Card principal -->
        <div class="mt-4 shadow-sm card">
            <div class="card-header bg-light fw-semibold">
                <i class="bi bi-people"></i> Livros
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="shadow-sm card">
                            <div class="card-body">
                                <h5 class="mb-3 card-title">
                                    <i class="bi bi-book"></i> <?php echo e($livro->titulo); ?>

                                </h5>

                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Editora:</strong> <?php echo e($livro->editora ?? '—'); ?></p>
                                        <p class="mb-1"><strong>Edição:</strong> <?php echo e($livro->edicao ?? '—'); ?></p>
                                        <p class="mb-1"><strong>Ano de Publicação:</strong> <?php echo e($livro->ano_publicacao ??
                                            '—'); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Valor:</strong>
                                            <?php echo e($livro->valor ? 'R$ ' . number_format($livro->valor, 2, ',', '.') : '—'); ?>

                                        </p>
                                        <p class="mb-1"><strong>Código:</strong> <?php echo e($livro->codl); ?></p>
                                        <p class="mb-1"><strong>Criado em:</strong>
                                            <?php echo e($livro->created_at ? $livro->created_at->format('d/m/Y H:i') : '—'); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Autores -->
                        <div class="mt-4 shadow-sm card">
                            <div class="card-header bg-light fw-semibold">
                                <i class="bi bi-people"></i> Autores
                            </div>
                            <div class="card-body">
                                <?php if($livro->autores->count() > 0): ?>
                                <ul class="list-group">
                                    <?php $__currentLoopData = $livro->autores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo e($autor->nome); ?>

                                        <a href="<?php echo e(route('autores.show', $autor->codAu)); ?>"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i> Ver Autor
                                        </a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php else: ?>
                                <p class="mb-0 text-muted">Nenhum autor associado.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Assuntos -->
                        <div class="mt-4 shadow-sm card">
                            <div class="card-header bg-light fw-semibold">
                                <i class="bi bi-tags"></i> Assuntos
                            </div>
                            <div class="card-body">
                                <?php if($livro->assuntos->count() > 0): ?>
                                <ul class="list-group">
                                    <?php $__currentLoopData = $livro->assuntos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo e($assunto->descricao); ?>

                                        <a href="<?php echo e(route('assuntos.show', $assunto->codAs)); ?>"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i> Ver Assunto
                                        </a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php else: ?>
                                <p class="mb-0 text-muted">Nenhum assunto associado.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="mt-4">
                <a href="<?php echo e(route('livros.edit', $livro->codl)); ?>" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="<?php echo e(route('livros.index')); ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
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
<?php /**PATH /app/resources/views/livros/show.blade.php ENDPATH**/ ?>