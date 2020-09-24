<?php
session_start();
include('../essentials/config.php');
$id = $_POST['id'];
if (!isset($_SESSION['admin'])) {
    header('location:logout.php');
}
$query = "UPDATE category SET status=0 WHERE category_id = " . $id;
mysqli_query($connect, $query);

echo 1;