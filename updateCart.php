<?php
 session_start();
 require_once('essentials/config.php');
 $variant_id = $_GET['id'];
 $action = $_GET['action'];
 $product_attribute = $_SESSION['variant'];

if($action === 'empty')
{unset($_SESSION['cart']);}

$result = $connect->query("SELECT qty FROM variant WHERE variant_id = ".$variant_id);

if($result && $obj = $result->fetch_object()) {
 
    switch($action) {
 
       case "add":
       if($_SESSION['cart'][$variant_id]+1 <= $obj->qty)
       {  $_SESSION['cart'][$variant_id]++;}
       else
         {$_SESSION['alertMsg'] = "Maximum available quantity reached !";}
       break;
 
       case "remove":
       $_SESSION['cart'][$variant_id]--;
       if($_SESSION['cart'][$variant_id] == 0)
        { unset($_SESSION['cart'][$variant_id]);}
         break;

         case "del":
          unset($_SESSION['cart'][$variant_id]);
          {$_SESSION['alertMsg'] = "Item removed from your cart !";}
            break;

            default:
            header('location: error.php');

 
     }
   }

header("location: cart.php");
 
 ?>
 