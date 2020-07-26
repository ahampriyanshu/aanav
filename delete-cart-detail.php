<?php
 session_start();

include('essentials/config.php');
$id = $_GET['id'];
$email = $_SESSION['email'];
$sql = "DELETE FROM `cart` WHERE `product_id` = $id and `customer` = $email ";
$run = mysqli_query($mysqli,$sql);
header("location: cart.php");

?>
