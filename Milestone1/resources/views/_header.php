<?php
session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin']) {
    require_once '_adminNavbar.php';
} else {
    require_once '_navbar.blade.php';
}

?>

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