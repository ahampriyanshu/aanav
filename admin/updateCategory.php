<?php
session_start();
include('../essentials/config.php');

if (!isset($_SESSION['admin'])) {
    header('location:logout.php');
}
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    
    $sql = "UPDATE categories SET sub_name='$name',modified_date=now() WHERE sub_id=$id";
    mysqli_query($connect, $sql);  

    header("location:manageCategory.php");
