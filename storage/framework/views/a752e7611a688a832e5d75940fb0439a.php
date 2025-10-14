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
            <?php echo e(__('Cadastrar Livro')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="container mt-4">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h1>Cadastrar Livro</h1>
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

        <!-- Formulário -->
        <form id="form-livro" action="<?php echo e(route('livros.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mt-4 shadow-sm card">
                <div class="card-header bg-light fw-semibold">
                    <i class="bi bi-tags"></i> Livro
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">

                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="titulo" class="form-label"><strong>Título </strong></label>
                                    <input type="text" name="titulo" id="titulo"
                                        class="form-control <?php $__errorArgs = ['titulo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('titulo')); ?>">
                                    <?php $__errorArgs = ['titulo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-6">
                                    <label for="editora" class="form-label"><strong>Editora</strong></label>
                                    <input type="text" name="editora" id="editora"
                                        class="form-control <?php $__errorArgs = ['editora'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('editora')); ?>">
                                    <?php $__errorArgs = ['editora'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label for="edicao" class="form-label"><strong>Edição</strong></label>
                                    <input type="number" name="edicao" id="edicao"
                                        class="form-control <?php $__errorArgs = ['edicao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('edicao')); ?>" min="1" step="1"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <?php $__errorArgs = ['edicao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-4">
                                    <label for="ano_publicacao" class="form-label"><strong>Ano de
                                            Publicação</strong></label>
                                    <input type="text" name="ano_publicacao" id="ano_publicacao"
                                        class="form-control <?php $__errorArgs = ['ano_publicacao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('ano_publicacao')); ?>" maxlength="4"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <?php $__errorArgs = ['ano_publicacao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-4">
                                    <label for="valor" class="form-label"><strong>Valor (R$)</strong></label>
                                    <input type="text" name="valor" id="valor"
                                        class="form-control <?php $__errorArgs = ['valor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('valor')); ?>">
                                    <?php $__errorArgs = ['valor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Autores -->
                            <div class="mb-3">
                                <label class="form-label"><strong>Autores</strong></label>
                                <div id="autores-container"
                                    class="<?php $__errorArgs = ['autores'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border border-danger rounded p-2 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <div class="mb-2 input-group autor-field">
                                        <select name="autores[]" class="form-select autor-select"></select>
                                        <button type="button" class="btn btn-danger remove-autor" style="displaynone;">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['autores'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="mt-1 text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <button type="button" id="add-autor" class="mt-2 btn btn-outline-primary btn-sm"
                                    disabled>
                                    <i class="bi bi-plus-circle"></i> Adicionar Autor
                                </button>
                            </div>

                            <!-- Assuntos -->
                            <div class="mb-3">
                                <label class="form-label"><strong>Assuntos</strong></label>
                                <div id="assuntos-container"
                                    class="<?php $__errorArgs = ['assuntos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border border-danger rounded p-2 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <div class="mb-2 input-group assunto-field">
                                        <select name="assuntos[]" class="form-select assunto-select"></select>
                                        <button type="button" class="btn btn-danger remove-assunto"
                                            style="displaynone;">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['assuntos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="mt-1 text-danger small"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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
                        <i class="bi bi-check-circle"></i> Salvar Alterações
                    </button>
                    <a href="<?php echo e(route('livros.index')); ?>" class="btn btn-secondary">Cancelar</a>
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
<?php /**PATH /app/resources/views/livros/create.blade.php ENDPATH**/ ?>