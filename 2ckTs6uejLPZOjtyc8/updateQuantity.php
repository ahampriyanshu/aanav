<?php
session_start();
include('../essentials/config.php');

if (!isset($_SESSION['admin'])) {
    header('location:logout.php');
}
    
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $newqty = $_POST['newqty'];

    $sql = "UPDATE variant SET qty='$newqty' WHERE variant_id='$id' ";
    mysqli_query($connect, $sql);
    
    $newqty = $newqty - $qty;

    $result = mysqli_query($connect, "SELECT * FROM variant WHERE variant_id='$id'");
    $row = mysqli_fetch_assoc($result);
    $pid = $row['product_id'];


    $connect->query("UPDATE product SET qty = qty + '$newqty' WHERE id = " . $pid);

   header("location:manageProduct.php");
