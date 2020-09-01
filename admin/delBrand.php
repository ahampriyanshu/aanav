<?php
session_start();
include('../essentials/config.php');
$id = $_POST['id'];

$query = "DELETE FROM brand WHERE brand_id=" . $id;
mysqli_query($connect, $query);

echo 1;
