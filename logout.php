<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['id']);
unset($_SESSION['phone']);
unset($_SESSION['admin']);
unset($_SESSION['name']);
unset($_SESSION['admin']);
unset($_SESSION['shipping_id']);
header("location: login.php");
?>