<?php
require_once('../essentials/config.php');
if (isset($_SESSION['admin'])) {
  header('location: index.php');
}
if(isset($_GET['password'])){
$password = $_GET['password'];

$verify = mysqli_query($connect, "SELECT * FROM admin WHERE password='$password' and status = 1");
if (mysqli_num_rows($verify) < 1) {
  header('logout.php');
} else {
  session_start();
  $_SESSION["admin"] = $password;
  header('location:index.php');
}
}

// http://localhost/aanav/admin/2B0A3Wu4JOdrx85RJe1nKed.php?password=$2y$10$KmUYETr9.2ckTs6uejLPZOjtyc8.qpypvj0S3yKe8h.Xp5Ha9dNnK
// A0YX=zwHeAe6[U(r