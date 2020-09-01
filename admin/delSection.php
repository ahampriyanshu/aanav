<?php
session_start();
include('../essentials/config.php');
$id = $_POST['id'];

$query = "DELETE FROM section WHERE cat_id=" . $id;
mysqli_query($connect, $query);

echo 1;
