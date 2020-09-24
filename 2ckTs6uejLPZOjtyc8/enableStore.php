<?php
session_start();
include('../essentials/config.php');
$id = $_POST['id'];
if (!isset($_SESSION['admin'])) {
    header('location:logout.php');
}
$query = "UPDATE store SET status=1 WHERE store_id = " . $id;
mysqli_query($connect, $query);

echo 1;
