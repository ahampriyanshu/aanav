<?php
 session_start();

include('essentials/config.php');
$key = $_GET['id'];

echo $key;

print_r($_SESSION['cart']);

unset($_SESSION['cart'][$key]);

print_r($_SESSION['cart']);
header('location: cart.php');

?>
