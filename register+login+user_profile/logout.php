<?php
ob_start();
session_start();
if(isset($_SESSION['id'])) {
	session_destroy();
	header("Location: login.php");
} else {
	session_destroy();
	header("Location: login.php");
}
?>