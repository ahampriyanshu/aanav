<?php
  session_start();
  include('essentials/config.php');
  

  
  
?>

<?php
        if(!isset($_SESSION['email'])){

          include("login.php");
        }
        else{
          include("shipping_info.php");
        }

?>