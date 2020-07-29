<?php
 session_start();

require_once('essentials/config.php');
$key = $_GET['id'];



header('location: cart.php');

?>
