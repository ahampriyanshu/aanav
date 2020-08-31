<?php
include "inc.php";
require_once('essentials/config.php');
date_default_timezone_set('Asia/Kolkata');
$time_now = date("d-m-Y h:i:s A");
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
                           VALUES('$customer_id','$email_address','$full_name',0,'$phone','$street_address','$state','$city','$pincode',1,0,0,'COD',NOW(),NOW())");

  $order_id = mysqli_insert_id($connect);
  echo $order_id;

  foreach ($_SESSION['cart'] as $variant_id => $quantity) {

    $find_pro_id = mysqli_query($connect, "SELECT * FROM variant WHERE variant_id='$variant_id'");
    $pro_data = mysqli_fetch_assoc($find_pro_id);
    $product_id = $pro_data['product_id'];

    $result = $connect->query("SELECT * FROM product WHERE id = " . $product_id);

    if ($result) {

      if ($obj = $result->fetch_object()) {

        $cost = $obj->cost * $quantity;
        $total += $cost;
        $itemqty += $quantity;
        $query2 = $connect->query("INSERT INTO order_items (order_id,product_id, variant_id, customer_id, product_name, price, units, total, customer) 
                                 VALUES('$order_id','$obj->id','$variant_id','$customer_id','$obj->name', '$obj->cost', '$quantity', '$cost', '$customer')");
        if ($query2) {
          $newqty = $obj->qty - $quantity;
          if ($connect->query("UPDATE product SET qty = " . $newqty . " WHERE id = " . $product_id)) {
            $connect->query("UPDATE variant SET qty = " . $newqty . " WHERE variant_id = " . $variant_id);
          }
        }
        if ($connect->query("UPDATE orders SET total_amt = " . $total . ",total_qty =" . $itemqty . " WHERE order_id = " . $order_id)) {
        }
      }
    }
  }
}

$url      = "http://" . $_SERVER['SERVER_NAME'] . "/aanav/myorders.php?id=" . $order_id;
$subject  = 'New Order successfully placed';
$body = '<p style="color:#66FCF1; font-size: 32px;" > Hi ' . $full_name . '</p><p 
 style="color:grey; font-size: 16px;" > Your order worth <span style="color:green;" > &#x20B9;&nbsp; ' . $total . '</span> was placed successfully at 
 <span style="color:green;"> ' . $time_now . '</span>.<br> Merchant may contact you in 2 to 3 working days.Happy Shopping</p> 
    <p><a style="background-color: #66FCF1;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;"
    href="' . $url . '">View Order Details</a></p><p  style="color:grey; font-size: 10px;" > Ordered by mistake ? <a style="color:red; font-family:bolder; font-size: 10px;text-decoration: none;"  href="' . $url . '"> Cancel Order </a></p>';


$sendEmail->send($full_name, $customer, $subject, $body);

$admin_name = "Admin";
$admin_email = "ahampriyanshu@gmail.com";
$subject = "A new order was placed";
$body = '<p style="color:#66FCF1; font-size: 32px;" > Hi ' . $admin_name . '</p><p 
 style="color:grey; font-size: 16px;" >A new order worth <span style="color:green;" > &#x20B9;&nbsp;' . 
 $total . '</span> was placed by ' . $full_name . ' at <span style="color:green;"> ' . $time_now . ' </p> 
<p><a style="background-color: #66FCF1;
border: none;
color: white;
padding: 15px 32px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin: 4px 2px;
cursor: pointer;
-webkit-transition-duration: 0.4s;
transition-duration: 0.4s;"
href="' . $url . '"> Approve Order </a></p><p  style="color:grey; font-size: 10px;" > Out of stock ? <a style="color:red; font-family:bolder; font-size: 10px;text-decoration: none;"  href="' . $url . '"> Cancel Order </a></p>';
$sendEmail->send($admin_name, $admin_email, $subject, $body);

unset($_SESSION['shipping']);
unset($_SESSION['cart']);
header("location:order-placed.php?id=".$order_id);