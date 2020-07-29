<?php
session_start();
require_once('essentials/config.php');
$customer = $_SESSION['email'];
if($customer == null){
  echo "<script>window.open('checkout.php','_self')</script>";
}
else{

$id = $_GET['id'];

  $customer = $_SESSION['email']; 
  $sql = "SELECT * FROM customer WHERE email = '$customer'";
  $run = mysqli_query($mysqli,$sql);
  $row =mysqli_fetch_assoc($run);

  $customer_id = $row['id'];



  $sql2 = "INSERT INTO wishlist( product_id,customer_id,fav_date)
  			VALUES('$id','$customer_id',NOW())";

  mysqli_query($mysqli,$sql2);

  unset($_SESSION['cart'][$id]);

    header('location: dashboard.php');


}