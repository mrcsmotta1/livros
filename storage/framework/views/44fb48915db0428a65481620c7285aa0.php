<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Bootstrap CSS -->
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('storage/images/book.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/custom-alerts.css')); ?>">

</head>
<body class="bg-light text-dark d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Page Header -->
    <?php if(isset($header)): ?>
        <header class="mb-4 text-white bg-secondary">
            <div class="container py-4">
                <?php echo e($header); ?>

            </div>
        </header>
    <?php endif; ?>

    <!-- Page Content -->
    <main class="container py-4 flex-grow-1">
       <?php echo e($slot); ?>

    </main>

    <!-- Bootstrap JS via Mix -->
    <script src="<?php echo e(mix('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom-alerts.js')); ?>"></script>

</body>
</html>
<?php /**PATH /app/resources/views/layouts/app.blade.php ENDPATH**/ ?>