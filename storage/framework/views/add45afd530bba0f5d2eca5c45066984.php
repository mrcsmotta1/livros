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
            <?php echo e(__('Relatório de Autores e Livros')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

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

    <div class="container mt-4">
        <form method="GET" action="<?php echo e(route('relatorios.autores.index')); ?>" id="relatorios-autores"
            class="p-3 mb-4 rounded shadow-sm row g-3 bg-light">

            <!-- Autor -->
            <div class="col-md-3">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" value="<?php echo e(old('autor', $filtros['autor'] ?? '')); ?>"
                    class="form-control">
            </div>

            <!-- Editora -->
            <div class="col-md-3">
                <label class="form-label">Editora</label>
                <input type="text" name="editora" value="<?php echo e(old('autor', $filtros['editora'] ?? '')); ?>"
                    class="form-control">
            </div>

            <!-- Livro -->
            <div class="col-md-3">
                <label class="form-label">Título do Livro</label>
                <input type="text" name="titulo_livro" value="<?php echo e(old('autor', $filtros['titulo_livro'] ?? '')); ?>"
                    class="form-control">
            </div>

            <!-- Edição -->
            <div class="col-md-3">
                <label class="form-label">Edição</label>
                <div class="input-group">
                    <select name="operador_edicao" class="form-select" style="max-width: 100px;">
                        <option value="=" <?php echo e((old('operador_edicao', $filtros['operador_edicao'] ?? '' )==='=' )
                            ? 'selected' : ''); ?>>=</option>
                        <option value=">=" <?php echo e((old('operador_edicao', $filtros['operador_edicao'] ?? '' )==='>=' )
                            ? 'selected' : ''); ?>>maior ou igual</option>
                        <option value="<=" <?php echo e((old('operador_edicao', $filtros['operador_edicao'] ?? '' )==='<=' )
                            ? 'selected' : ''); ?>>menor ou igual</option>
                    </select>
                    <input type="number" name="edicao" value="<?php echo e(old('autor', $filtros['edicao'] ?? '')); ?>"
                        class="form-control">
                </div>
            </div>

            <!-- Ano de publicação -->
            <div class="col-md-3">
                <label class="form-label">Ano de Publicação</label>
                <div class="input-group">
                    <select name="operador_ano" class="form-select" style="max-width: 100px;">
                        <option value="=" <?php echo e((old('operador_ano', $filtros['operador_ano'] ?? '' )==='=' ) ? 'selected'
                            : ''); ?>>=</option>
                        <option value=">=" <?php echo e((old('operador_ano', $filtros['operador_ano'] ?? '' )==='>=' )
                            ? 'selected' : ''); ?>>maior ou igual</option>
                        <option value="<=" <?php echo e((old('operador_ano', $filtros['operador_ano'] ?? '' )==='<=' )
                            ? 'selected' : ''); ?>>menor ou igual</option>
                    </select>
                    <input type="text" name="ano_publicacao" id="ano_publicacao" class="form-control"
                        value="<?php echo e(old('ano_publicacao', $filtros['ano_publicacao'] ?? '')); ?>" maxlength="4"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>

            <!-- Valor -->
            <div class="col-md-3">
                <label for="operador_valor" class="form-label">Valor (R$)</label>
                <div class="input-group">
                    <select id="operador_valor" name="operador_valor" class="form-select" style="max-width: 100px;">
                        <option value="=" <?php echo e((old('operador_valor', $filtros['operador_valor'] ?? '' )==='=' )
                            ? 'selected' : ''); ?>>=</option>
                        <option value=">=" <?php echo e((old('operador_valor', $filtros['operador_valor'] ?? '' )==='>=' )
                            ? 'selected' : ''); ?>>maior ou igual</option>
                        <option value="<=" <?php echo e((old('operador_valor', $filtros['operador_valor'] ?? '' )==='<=' )
                            ? 'selected' : ''); ?>>menor ou igual</option>
                    </select>
                    <input type="text" id="valor" name="valor" value="<?php echo e(old('valor', $filtros['valor'] ?? '')); ?>"
                        class="form-control">
                </div>
            </div>

            <!-- Range de data de criação -->
            <div class="col-md-3">
                <label class="form-label">Criado de</label>
                <input type="date" name="data_inicio" value="<?php echo e(request('data_inicio')); ?>" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Até</label>
                <input type="date" name="data_fim" value="<?php echo e(request('data_fim')); ?>" class="form-control">
            </div>

            <!-- Botões -->
            <div class="gap-2 mt-3 col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Filtrar
                </button>

                <button type="button" id="btnExportarCsv" class="btn btn-success">
                    <i class="bi bi-file-earmark-arrow-down"></i> Exportar CSV
                </button>

                <a href="<?php echo e(route('relatorios.autores.index')); ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Limpar
                </a>
            </div>
        </form>



        <div class="table-responsive">
            <table class="table align-middle table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Autor</th>
                        <th>Título</th>
                        <th>Editora</th>
                        <th>Ano Publicação</th>
                        <th>Edição</th>
                        <th>Valor (R$)</th>
                        <th>Assunto</th>
                        <th>Data de Criação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $relatorio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->autor); ?></td>
                        <td><?php echo e($item->titulo_livro); ?></td>
                        <td><?php echo e($item->editora); ?></td>
                        <td><?php echo e($item->ano_publicacao); ?></td>
                        <td><?php echo e($item->edicao); ?></td>
                        <td>R$ <?php echo e(number_format($item->valor, 2, ',', '.')); ?></td>
                        <td><?php echo e($item->assuntos_relacionados); ?></td>
                        <td>
                            <?php echo e(\Carbon\Carbon::parse($item->data_criacao_livro)->format('d/m/Y H:i')); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Nenhum resultado encontrado.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="mt-3 d-flex justify-content-center">
                <?php echo e($relatorio->appends(request()->query())->links('pagination::bootstrap-5')); ?>

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

<script>
    window.ROUTES = {
        exportCsv: "<?php echo e(route('relatorios.autores.csv')); ?>"
    };
</script>
<?php /**PATH /app/resources/views/relatorios/autores/index.blade.php ENDPATH**/ ?>