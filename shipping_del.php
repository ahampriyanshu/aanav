<?php 
 require_once('essentials/config.php');

$id = $_GET['id'];

// Delete record
$query = "DELETE FROM shipping WHERE shipping_id=".$id;
mysqli_query($connect,$query);

header("location: checkout.php");


?>