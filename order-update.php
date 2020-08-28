<?php
session_start();
include "inc.php";
require_once('essentials/config.php');
date_default_timezone_set('Asia/Kolkata');
$customer = $_SESSION['email'];
$customer_id = $_SESSION['id'];
$shipping = $_SESSION['shipping'];
$sql = "SELECT * FROM shipping WHERE shipping_id = $shipping";
$run = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($run);
$full_name =      $row['full_name'];
$email_address =      $row['email'];
$street_address =      $row['street_address'];
$city =     $row['city'];
$state =     $row['state'];
$phone =    $row['phone'];
$pincode = $row['pincode'];
$sendEmail  = new sendEmail;

if (isset($_SESSION['cart'])) {
  $total = 0;
  $itemqty = 0;
  $query = $connect->query("INSERT INTO orders(customer_id,email,full_name, store_id, phone, street_address, state, city, pincode,status,total_amt,total_qty,payment_type,created_date,modified_date) 
                           VALUES('$customer_id','$email_address','$full_name',1,'$phone','$street_address','$state','$city','$pincode',1,0,0,'COD',NOW(),NOW())");

  $order_id = mysqli_insert_id($connect);
  echo $order_id;

  foreach ($_SESSION['cart'] as $variant_id => $quantity) {

    $find_pro_id = mysqli_query($connect, "SELECT * FROM variant WHERE pro_attr_id='$variant_id'");
    $pro_data = mysqli_fetch_assoc($find_pro_id);
    $product_id = $pro_data['product_id'];

    $result = $connect->query("SELECT * FROM product WHERE id = " . $product_id);

    if ($result) {

      if ($obj = $result->fetch_object()) {

        $cost = $obj->cost * $quantity;
        $total += $cost;
        $itemqty += $quantity;

        $query2 = $connect->query("INSERT INTO order_items (order_id,product_id, product_name, price, units, total, customer) 
                                 VALUES('$order_id','$obj->id', '$obj->name', $obj->cost, $quantity, $cost, '$customer')");
        if ($query2) {
          $newqty = $obj->qty - $quantity;
          if ($connect->query("UPDATE product SET qty = " . $newqty . " WHERE id = " . $product_id) )
          {
            $connect->query("UPDATE variant SET qty = " . $newqty . " WHERE pro_attr_id = ". $variant_id);
          }
        }
        if ($connect->query("UPDATE orders SET total_amt = " . $total . ",total_qty =" . $itemqty . " WHERE order_id = " . $order_id)) {
        }
      }
    }
  }
}

$sendEmail->send($full_name, $email, $subject, $body);
$sendEmail->send($full_name, $email, $subject, $body);

// unset($_SESSION['shipping']);
// unset($_SESSION['cart']);
// header("location:order-placed.php");