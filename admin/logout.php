<?php

	session_start();
	unset($_SESSION['cart']);
	unset($_SESSION['email']);
	unset($_SESSION['shipping']);
	unset($_SESSION['customer_email']);
	unset($_SESSION['customer_id']);
	unset($_SESSION['admin_id']);

	header("location: login.php");

?>