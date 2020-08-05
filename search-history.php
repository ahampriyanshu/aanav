<?php
session_start();
require_once('essentials/config.php');
if ($_SESSION['email'] == null) {
    $customer = "guest";
}
else
{
  $customer = $_SESSION['email'];
  $product_id = $_GET['id'];

  echo $customer_id.$customer.$product_id;

    $sql = "INSERT INTO wishlist( product_id,customer_id,fav_date)
  			VALUES('$product_id','$customer_id',NOW())";

        mysqli_query($connect, $sql);
     

    // header('location: product.php?id='.$product_id);
}