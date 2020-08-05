<?php
session_start();
require_once('essentials/config.php');
if($_SESSION['email'] == null){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
  $customer = $_SESSION['email'];
  $product_id = $_GET['id'];
  $action = $_GET['action'];
  $customer_id = $_GET['user'];

  echo $customer_id.$action;

    switch($action) {
 
      case "add":
        $sql = "INSERT INTO wishlist( product_id,customer_id,fav_date)
  			VALUES('$product_id','$customer_id',NOW())";

        mysqli_query($connect, $sql);
      break;

      case "remove":
        $sql = "DELETE FROM wishlist	WHERE `customer_id` = $customer_id and `product_id`=$product_id ";
    
        mysqli_query($connect,$sql);
        break;

        case "empty":
          $sql = "DELETE FROM wishlist WHERE `customer_id` = $customer_id ";
    
          mysqli_query($connect,$sql);
           break;
    }

     header('location: wishlist.php');
}