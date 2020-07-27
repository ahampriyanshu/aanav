<?php
 session_start();

include('essentials/config.php');
$key = $_GET['id'];



header('location: cart.php');

?>
