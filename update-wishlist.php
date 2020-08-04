<?php
session_start();
require_once('essentials/config.php');
$customer = $_SESSION['email'];
if($customer == null){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
  $customer = $_SESSION['email'];
  $product_id = $_GET['id'];


    $sql = "SELECT * FROM customer WHERE email = '$customer'";
    $run = mysqli_query($connect, $sql);
    $row =mysqli_fetch_assoc($run);
    $customer_id = $row['id'];

    $sql_fav = "SELECT * FROM wishlist WHERE customer_id ='$customer_id' AND product_id = '$product_id'";
    $run_fav = mysqli_query($connect, $sql_fav);
    $row_fav = mysqli_fetch_assoc($run_fav);
    $fav = $row_fav['fav_id'];

    if ($fav == null) {

        $sql2 = "INSERT INTO wishlist( product_id,customer_id,fav_date)
  			VALUES('$product_id','$customer_id',NOW())";

        mysqli_query($connect, $sql2);
    } else {
    
      $sql2 = "DELETE FROM wishlist	WHERE `customer_id` = $customer_id and `product_id`=$product_id ";
    
      mysqli_query($connect,$sql2);
    }

    header('location: wishlist.php');
}