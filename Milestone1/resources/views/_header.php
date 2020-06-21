<?php
session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin']) {
    require_once '_adminNavbar.php';
} else {
    require_once '_navbar.blade.php';
}

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		if (<?php if (isset($_SESSION['username'])) echo 1; else echo 0;?>){
			$('#login').hide();
			$('#logout').show();
		} else {
			$('#login').show();
			$('#logout').hide();
		}
	})
</script>