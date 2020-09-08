<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['customer_email']);;
unset($_SESSION['admin']);
header("location: login.php");
?>