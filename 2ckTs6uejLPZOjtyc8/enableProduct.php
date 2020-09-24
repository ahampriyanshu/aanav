<?php
session_start();
include('../essentials/config.php');
$id = $_POST['id'];
if (!isset($_SESSION['admin'])) {
    header('location:logout.php');
}

$connect->query("UPDATE product SET status =1 WHERE id = " . $id);

echo 1;