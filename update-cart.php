<?php
 session_start();
 require_once('essentials/config.php');
 
 $variant_id = $_GET['id'];
 $action = $_GET['action'];
 $product_attribute = $_SESSION['variant'];

if($action === 'empty')
unset($_SESSION['cart']);

$result = $connect->query("SELECT qty FROM variant WHERE pro_attr_id = ".$variant_id);

if($result){
 
  if($obj = $result->fetch_object()) {
 
    switch($action) {
 
       case "add":
       if($_SESSION['cart'][$variant_id]+1 <= $obj->qty)
         $_SESSION['cart'][$variant_id]++;
       break;
 
       case "remove":
       $_SESSION['cart'][$variant_id]--;
       if($_SESSION['cart'][$variant_id] == 0)
         unset($_SESSION['cart'][$variant_id]);
         break;

         case "del":
          unset($_SESSION['cart'][$variant_id]);
            break;

 
     }
   }
 }

header("location: cart.php");
 
 ?>
 