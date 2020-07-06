<html>
    <head>
        <title>Socialis - <?php echo $__env->yieldContent('title'); ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
        <?php echo $__env->yieldContent('head'); ?>
    </head>
    <body>
        <?php echo $__env->yieldContent('navbar', View::make('_navbar')); ?>
        <div id="wrapper">
            <?php echo $__env->yieldContent('content'); ?>
            <div style="margin-bottom: 15%"></div>
            <?php echo $__env->yieldContent('footer', View::make('_footer')); ?>
        </div>
    </body>
</html><?php /**PATH C:\MAMP\htdocs\Milestone1\resources\views/layouts/app.blade.php ENDPATH**/ ?>