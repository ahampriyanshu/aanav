<?php

session_start();

include('config/config.php');
$email = $_SESSION['email'];
$sql = "DELETE FROM cart WHERE customer='$email'";
$run = mysqli_query($mysqli,$sql);

if($run){
  echo "success";
}else{
  echo "error";
}
unset($_SESSION['cart']);
//header("location: cart.php");

?>
