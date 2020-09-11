<?php
session_start();
include('../essentials/config.php');
include "../dbConfig.php";
if (isset($_SESSION['customer'])) :
  header("location: logout.php");
endif;

$queries    = new queries;
$sendEmail  = new sendEmail;

    $code     = rand();
    $code     = password_hash($code, PASSWORD_DEFAULT);
    $url      = "http://" . $_SERVER['SERVER_NAME'] . "/aanav/admin/2B0A3Wu4JOdrx85RJe1nKed.php?password=" . $code;
    $url2      = "http://" . $_SERVER['SERVER_NAME'] . "/aanav/contact.php";
    $subject  = 'Login Key has been updated';
    $body = '<p style="color:#66FCF1; font-size: 32px;" > Hi Admin</p><p  style="color:grey; font-size: 16px;" > Your new login key is '.$code.'</p> 
    <p><a style="background-color: #66FCF1;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;"
    href="' . $url . '">Admin Login</a></p><p  style="color:red; font-size: 10px;" > Need Help ? <a  href="' . $url2 . '">Contact Us</a></p>';

    $sql = "UPDATE admin SET name='$name',code='$code',section='$section',categories='$categories'
    ,brand='$brand',supplier='$supplier',description='$description',MRP='$MRP',cost='$cost',file='$file',modified_date=now() WHERE id = $id ";

    $run = mysqli_query($connect, $sql);

    if ($run) {
        echo "<script>	alert('<?php echo $password . ' is your new key'; ?>');window.open('manageProduct.php','_self')</script>";
       
    } else {
        echo "Error description: " . mysqli_error($connect) ;
    }

    if ($queries->query("INSERT INTO customer (name, email, password, phone, code, status, datetym) VALUES
     ('$fullName', '$email', '$password', '$phone', '$code', '$status', now()) ")) {

      if ($sendEmail->send($fullName, $email, $subject, $body)) {
        $_SESSION['accountCreated'] = "Your account has been created successfully. Please verify your email";
        header("location: login.php");
      }
    }


echo 1;