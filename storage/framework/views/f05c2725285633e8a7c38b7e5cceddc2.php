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
            <?php echo e(__('Editar Livro')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Editar Livro</h1>
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

        <form id="form-livro" action="<?php echo e(route('livros.update', $livro->codl)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mt-4 shadow-sm card">
                <div class="card-header bg-light fw-semibold">
                    <i class="bi bi-people"></i> Livros
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <!-- Dados principais -->
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="titulo" class="form-label">Título</label>
                                    <input type="text" name="titulo" id="titulo" class="form-control"
                                        value="<?php echo e(old('titulo', $livro->titulo)); ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="editora" class="form-label">Editora</label>
                                    <input type="text" name="editora" id="editora" class="form-control"
                                        value="<?php echo e(old('editora', $livro->editora)); ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label for="edicao" class="form-label">Edição</label>
                                    <input type="number" name="edicao" id="edicao" class="form-control"
                                        value="<?php echo e(old('edicao', $livro->edicao)); ?>" min="1" step="1"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>

                                <div class="col-md-4">
                                    <label for="ano_publicacao" class="form-label">Ano de Publicação</label>
                                    <input type="text" name="ano_publicacao" id="ano_publicacao" maxlength="4"
                                        class="form-control" value="<?php echo e(old('ano_publicacao', $livro->ano_publicacao)); ?>"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>

                                <div class="col-md-4">
                                    <label for="valor" class="form-label">Valor (R$)</label>
                                    <input type="text" name="valor" id="valor" class="form-control"
                                        value="<?php echo e(old('valor', number_format($livro->valor, 2, ',', '.'))); ?>">
                                </div>
                            </div>

                            <!-- Autores -->
                            <div class="mb-3">
                                <label class="form-label">Autores</label>
                                <div id="autores-container">
                                    <?php $__empty_1 = true; $__currentLoopData = $livro->autores->sortBy('pivot.id', SORT_NUMERIC); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="mb-2 input-group autor-field">
                                        <select name="autores[]" class="form-select autor-select"
                                            data-selected="<?php echo e($autor->codAu); ?>"></select>
                                        <button type="button" class="btn btn-danger remove-autor">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="mb-2 input-group autor-field">
                                        <select name="autores[]" class="form-select autor-select"></select>
                                        <button type="button" class="btn btn-danger remove-autor" style="display:none;">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <button type="button" id="add-autor" class="mt-2 btn btn-outline-primary btn-sm"
                                    disabled>
                                    <i class="bi bi-plus-circle"></i> Adicionar Autor
                                </button>
                            </div>

                            <!-- Assuntos -->
                            <div class="mb-3">
                                <label class="form-label">Assuntos</label>
                                <div id="assuntos-container">
                                    <?php $__empty_1 = true; $__currentLoopData = $livro->assuntos->sortBy('pivot.ordem'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="mb-2 input-group assunto-field">
                                        <select name="assuntos[]" class="form-select assunto-select"
                                            data-selected="<?php echo e($assunto->codAs); ?>"></select>
                                        <button type="button" class="btn btn-danger remove-assunto">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="mb-2 input-group assunto-field">
                                        <select name="assuntos[]" class="form-select assunto-select"></select>
                                        <button type="button" class="btn btn-danger remove-assunto"
                                            style="display:none;">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <button type="button" id="add-assunto" class="mt-2 btn btn-outline-primary btn-sm"
                                    disabled>
                                    <i class="bi bi-plus-circle"></i> Adicionar Assunto
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="mt-4 d-flex justify-content-start">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-check-circle"></i> Atualizar
                    </button>
                    <a href="<?php echo e(route('livros.index')); ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
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
<?php /**PATH /app/resources/views/livros/edit.blade.php ENDPATH**/ ?>