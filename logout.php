<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user_name'])) {
		session_destroy();
		header("Location: login.php");
	} else {
		session_destroy();
		header("Location: login.php");
	}
?>