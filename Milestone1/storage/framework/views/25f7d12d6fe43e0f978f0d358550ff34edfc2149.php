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
        Show user information


*/

?>


<?php $__env->startSection('title', 'User'); ?>


<?php $__env->startSection('content'); ?>
    <?php if($users->count() > 0): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Age</th>
                <th>User Since</th>
                <th>Admin?</th>
                <th>Active?</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i < $demographics->count(); $i++): ?>
                <tr>
                    <td><?php echo e($users->get($i)->id); ?></td>
                    <td><?php echo e($users->get($i)->firstname . " " . $users->get($i)->lastname); ?></td>
                    <td><?php echo e($users->get($i)->username); ?></td>
                    <td><?php echo e($demographics->get($i)->age); ?></td>
                    <td><?php echo e($users->get($i)->created_at->format('m-d-Y H:i:s')); ?></td>
                    <td><?php if($users->get($i)->isAdmin): ?> Yes <?php else: ?> No <?php endif; ?></td>
                    <td><?php if($users->get($i)->isActive): ?> Yes <?php else: ?> No <?php endif; ?></td>
                    <td>
                        <?php if($users->get($i)->isActive): ?>
                        <form action="<?php echo e(url('/users/suspend')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <input type="hidden" name="userID" value="<?php echo e($users->get($i)->id); ?>">
                            <input type="submit" class="btn btn-outline-warning" value="Suspend" >
                        </form>
                        <?php else: ?>
                        <form action="<?php echo e(url('/users/reactivate')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="userID" value="<?php echo e($users->get($i)->id); ?>">
                            <input type="submit" class="btn btn-outline-success" value="Reactivate">
                        </form>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($users->get($i)->isAdmin): ?>
                        <form action="<?php echo e(url('/users/admin')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="userID" value="<?php echo e($users->get($i)->id); ?>">
                            <input type="submit" class="btn btn-outline-warning" value="No Admin">
                        </form>
                        <?php else: ?>
                        <form action="<?php echo e(url('/users/admin')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <input type="hidden" name="userID" value="<?php echo e($users->get($i)->id); ?>">
                            <input  type="submit" class="btn btn-outline-success" value="To Admin">
                        </form>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="<?php echo e(url('/users/delete')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('delete'); ?>
                            <input type="hidden" name="userID" value="<?php echo e($users->get($i)->id); ?>">
                            <input type="submit" class="btn btn-outline-danger" value="Delete">
                        </form>
                    </td>
                    <td>
                        <a href="<?php echo e(url('/profile/' . $users->get($i)->id . '/view')); ?>" class="btn btn-primary">View</a>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    <?php if($demographics->count() < $users->count()): ?>
        <div class="d-flex justify-content-center">
            <h3 class="bg-warning">It looks like some users have not activated their accounts by creating profiles yet</h3>
        </div>
    <?php endif; ?>
    <?php else: ?>
        <div class="col bg-danger text-white d-flex justify-content-center">
            <h2>No Users Added yet</h2>
        </div>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\Milestone1\resources\views/users.blade.php ENDPATH**/ ?>