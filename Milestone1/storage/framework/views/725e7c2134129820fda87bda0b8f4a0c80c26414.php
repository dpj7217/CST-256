<?php
/*
    Project:
        Socialis: V1.0
    Module:
        Socialis: V1.0
    Author:
        David Pratt Jr.
    Date:
        6/14/2020
    Synopsis:
        Simple welcome page as index page for project


*/
?>


<?php $__env->startSection('title', 'Hello'); ?>


<?php $__env->startSection('content'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\Milestone1\resources\views/welcome.blade.php ENDPATH**/ ?>