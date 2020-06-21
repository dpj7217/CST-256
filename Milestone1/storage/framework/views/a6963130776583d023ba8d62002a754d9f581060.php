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
        Login Register Forms


*/

?>



<?php $__env->startSection('title', 'Login Or Register'); ?>


<?php $__env->startSection('content'); ?>
	<div class=row style="margin-top: 5%">



		<div class="col-6" >
            <form method="post" action="<?php echo e(url('/login')); ?>">
        		<h3>Login</h3>
				<?php echo csrf_field(); ?>
    			<div class=form-group>
    				<label <?php echo e($errors->has('loginUsername') ? 'style=color:#dc3545;' : ''); ?> for=loginUsername>Username</label>
        			<input type=text class="<?php echo e($errors->has('loginUsername') ? 'border border-danger' : ''); ?> form-control" id=loginUsername name=loginUsername>
                    <?php if($errors->has('loginUsername')): ?>
                        <p class="text-danger"><?php echo e($errors->first('loginUsername')); ?></p>
                    <?php endif; ?>
        		</div>
        		<div class=form-group>
        			<label <?php echo e($errors->has('loginPassword') ? 'style=color:#dc3545' : ''); ?> for=loginPassword>Password</label>
        			<input type=text class="<?php echo e($errors->has('loginPassword') ? 'border border-danger' : ''); ?> form-control" id=loginPassword name=loginPassword>
                    <?php if($errors->has('loginPassword')): ?>
                        <p class="text-danger"><?php echo e($errors->first('loginPassword')); ?></p>
                    <?php endif; ?>
                </div>
        		<input type=submit class="btn btn-outline-success" value="Login">
        	</form>
    	</div>





        <div class="col-6">
            <form method="POST" action="<?php echo e(url('/register')); ?>">
                <h3>Register</h3>
                <?php echo csrf_field(); ?>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="firstname" <?php echo e($errors->has('firstname') ? 'style=color:#db3545' : ''); ?>>First Name</label>
                        <input type="text" class="<?php echo e($errors->has('firstname') ? 'border border-danger' : ''); ?> form-control" id="firstname" name="firstname">
                        <?php if($errors->has('firstname')): ?>
                            <p class="text-danger"><?php echo e($errors->first('firstname')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-6">
                        <label for="lastname" <?php echo e($errors->has('lastname') ? 'style=color:#db3545' : ''); ?> >Last Name</label>
                        <input type="text" class="<?php echo e($errors->has('lastname') ? 'border border-danger' : ''); ?> form-control" id="lastname" name="lastname">
                        <?php if($errors->has('lastname')): ?>
                            <p class="text-danger"><?php echo e($errors->first('lastname')); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" <?php echo e($errors->has('email') ? 'style=color:#db3545' : ''); ?>>Email</label>
                    <input type="email" class="<?php echo e($errors->has('email') ? 'border border-danger' : ''); ?> form-control" id="email" name="email">
                    <?php if($errors->has('email')): ?>
                        <p class="text-danger
"><?php echo e($errors->first('email')); ?></p>
                    <?php endif; ?>

                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="username" <?php echo e($errors->has('username') ? 'style=color:#db3545' : ''); ?>>Username</label>
                        <input type="text" class="<?php echo e($errors->has('username') ? 'border border-danger' : ''); ?> form-control" id="username" name="username">
                        <?php if($errors->has('username')): ?>
                            <p class="text-danger"><?php echo e($errors->first('username')); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="password" <?php echo e($errors->has('password') ? 'style=color:#db3545' : ''); ?>>Password</label>
                        <input type="password" class="<?php echo e($errors->has('password') ? 'border border-danger' : ''); ?> form-control" id="password" name="password">
                        <?php if($errors->has('password')): ?>
                            <p class="text-danger"><?php echo e($errors->first('password')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-6">
                        <label for="passwordconf" <?php echo e($errors->has('passwordconf') ? 'style=color:#db3545' : ''); ?>>Confirm Password</label>
                        <input type="password" class="<?php echo e($errors->has('passwordconf') ? 'border border-danger' : ''); ?> form-control" id="passwordconf" name="passwordconf">
                        <?php if($errors->has('passwordconf')): ?>
                            <p class="text-danger"><?php echo e($errors->first('passwordconf')); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <input type="submit" class="btn btn-outline-success" value="Submit">
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\Milestone1\resources\views/loginRegister.blade.php ENDPATH**/ ?>