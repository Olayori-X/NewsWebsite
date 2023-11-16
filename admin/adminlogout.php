<?php
//This is not a page. This implements the server functionality for logging out
	session_start();
	session_unset();
	session_destroy();
	header("Location: adminlogin.php");
?>