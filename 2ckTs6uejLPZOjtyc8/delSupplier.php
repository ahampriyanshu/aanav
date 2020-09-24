<?php
session_start();
include('../essentials/config.php');
$id = $_POST['id'];
if (!isset($_SESSION['admin'])) {
    header('location:logout.php');
}
$query = "UPDATE supplier SET status=0 WHERE supplier_id = " . $id;
mysqli_query($connect, $query);

echo 1;
