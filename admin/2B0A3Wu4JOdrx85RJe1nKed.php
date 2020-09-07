<?php
require_once('../essentials/config.php');
if (isset($_SESSION['admin'])) {
  header('location: index.php');
}
if(isset($_GET['password'])){
$password = $_GET['password'];

$verify = mysqli_query($connect, "SELECT * FROM admin WHERE password='$password' and status = 0");
if (mysqli_num_rows($verify) == 1) {
  session_start();
  $_SESSION["admin"] = $username;
  header('location:index.php');
}

        if($connect->query("SELECT * FROM admin WHERE code = '$code' and status = 0")){
            if($this->count() == 1){

                $row = $this->fetch();
                $userId = $row->id;
                if($this->query("UPDATE customer SET status = ? WHERE id = ? ", [$status, $userId])){

                    $_SESSION['emailVerified'] = "Your account has been verified successfully please login";
                    header("location:login.php");

                }

            }
        }
    }