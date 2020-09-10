<?php 
session_start();
require_once('essentials/config.php');
if (!isset($_SESSION['email'])) {
    header('location:logout.php');
}
$id = $_GET['id'];
$query = "DELETE FROM shipping WHERE shipping_id=".$id;
mysqli_query($connect,$query);

header("location: checkout.php");


?>