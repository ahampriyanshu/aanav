<?php
session_start();
include('../essentials/config.php');
$id = $_POST['id'];

$query = "DELETE FROM categories WHERE sub_id=" . $id;
mysqli_query($connect, $query);

echo 1;
