

<?php $__env->startSection('title', 'Login Or Register'); ?>

<style>

</style>


<?php $__env->startSection('content'); ?>
	<div class=row style="margin-top: 5%">

		<div class="col-6" >
            <?php if (isset($loginFailureMessage)) { ?>
                <div class="hideable">
                    <h1 style="border-radius: 10px;" class="bg-danger text-white"><?php echo e($FailureMessage); ?></h1>
                </div>
            <?php unset($loginFailureMessage);} ?>
            <form method="post" action="<?php echo e(url('/login')); ?>">
        		<h3>Login</h3>
				<?php echo csrf_field(); ?>
    			<div class=form-group>
    				<label for=loginUsername>Username</label>
        			<input type=text class=form-control id=loginUsername name=loginUsername>
        		</div>
        		<div class=form-group>
        			<label for=loginPassword>Password</label>
        			<input type=text class=form-control id=loginPassword name=loginPassword>
        		</div>
        		<input type=submit class="btn btn-outline-success" value="Login">
        	</form>
    	</div>
        <div class="col-6">
            <?php if (isset($registerFailureMessage)) { ?>
                <div class="hideable d-flex justify-content-center">
                    <h1 style="border-radius: 10px;" class="bg-danger text-white"><?php echo e($registerFailureMessage); ?></h1>
                </div>
            <?php unset($registerFailureMessage);} ?>
            <form method="post" action="<?php echo e(url('/register')); ?>">
                <h3>Register</h3>
                <?php echo csrf_field(); ?>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                    </div>
                    <div class="form-group col-6">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group col-6">
                        <label for="passwordconf">Confirm Password</label>
                        <input type="password" class="form-control" id="passwordconf" name="passwordconf">
                    </div>
                </div>
                <div class="form-group col">
                    <input type="checkbox"  class="form-check-input" id="isAdmin" name="isAdmin" value="1">
                    <label for="isAdmin" class="form-check-label">Is Admin?</label>
                </div>
                <input type="submit" class="btn btn-outline-success" value="Submit">
            </form>
        </div>
    </div>
    <script>
        $(document).on('click', function() {
            $('.hideable').hide();
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\Milestone1\resources\views/loginRegister.blade.php ENDPATH**/ ?>