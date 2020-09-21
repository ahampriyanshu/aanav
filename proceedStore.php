<?php
session_start();
require_once('essentials/config.php');
$name = $_POST['name'];
$customer_email = $_POST['email'];
$phone = $_POST['phone'];
$store_id = $_POST['store_id'];
$customer_id = $_SESSION['id'];
mysqli_query($connect, "INSERT INTO shipping (customer_id,full_name, email, store_id, phone, shipping_type, street_address, state, city, pincode, created_date, modified_date) VALUES('$customer_id', '$name', '$customer_email', $store_id, '$phone', 'store', 'null', 'null', 'null', '0', NOW(), NOW())");

$query = "SELECT * FROM shipping WHERE customer_id = '$customer_id' ORDER BY shipping_id DESC LIMIT 0,1";
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['shipping_id'];
  echo "<script>window.location='payment.php?id=$id'</script>";
}
