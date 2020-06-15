<?php
/**
 * Created by PhpStorm.
 * User: David Pratt Jr
 * Date: 6/13/2020
 * Time: 3:23 PM
 */
?>


<?php $__env->startSection('title', 'User'); ?>


<?php $__env->startSection('content'); ?>
    <div class="m-4">
        <h3>User: </h3>
        <div class="form-row">
            <div class="form-group my-3 col-5">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" value="<?php echo e($user->firstname); ?>" readonly>
            </div>
            <div class="form-group my-3 col-5">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" value="<?php echo e($user->lastname); ?>" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group my-3 col-4">
                <label for="username">Username</label>
                <input class="form-control" type="text" id="username" value="<?php echo e($user->username); ?>" readonly>
            </div>
            <div class="form-group my-3 col-4">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" value="<?php echo e($user->password); ?>" readonly>
            </div>
            <div class="form-group my-3 col-2">
                <label for="isAdmin">Admin?</label>
                <input type="text" class="form-control" id="" value="<?php if($user->isAdmin) echo "Yes"; else echo "No";?>" readonly>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\Milestone1\resources\views/users.blade.php ENDPATH**/ ?>