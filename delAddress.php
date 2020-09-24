<?php 
session_start();
require_once('essentials/config.php');
if (!isset($_SESSION['email'])) {
    header('location:logout.php');
}
$customer_id = $_SESSION['id'];
$id = $_GET['id'];
$query = "DELETE FROM shipping WHERE customer_id = '$customer_id' AND shipping_id=".$id;
mysqli_query($connect,$query);
header("location: checkout.php");