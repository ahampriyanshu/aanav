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

// http://localhost/aanav/admin/2B0A3Wu4JOdrx85RJe1nKed.php?password=$2y$10$CKY7WqfPgzuP7T5FOPmoKe2j2BCBvohjmULjnkz3TdzpQOsbFXe9S
// A0YX=zwHeAe6[U(r