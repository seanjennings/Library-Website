<!-- Destroy current user session and return to login page -->
<?php
	session_start();
	session_destroy();
	header("Location: login.php");
?>