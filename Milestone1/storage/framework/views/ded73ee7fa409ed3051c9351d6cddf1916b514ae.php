<html>
    <head>
        <title>App Name - <?php echo $__env->yieldContent('title'); ?></title>
    </head>
    <body>
        <?php echo $__env->yieldContent('navbar', View::make('_header')); ?>

        <div class="container">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </body>
    <footer>
        <?php echo $__env->yieldContent('footer', View::make('_footer')); ?>
    </footer>
</html><?php /**PATH C:\MAMP\htdocs\Milestone1\resources\views/layouts/app.blade.php ENDPATH**/ ?>