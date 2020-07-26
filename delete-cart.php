<?php

session_start();

include('essentials/config.php');
$email = $_SESSION['email'];
$sql = "DELETE FROM cart WHERE customer='$email'";
$run = mysqli_query($mysqli,$sql);


unset($_SESSION['cart']);

header("location: cart.php");

?>
