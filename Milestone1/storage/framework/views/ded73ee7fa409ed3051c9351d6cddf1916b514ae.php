<html>
    <head>
        <title>Socialis - <?php echo $__env->yieldContent('title'); ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <?php echo $__env->yieldContent('head'); ?>
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