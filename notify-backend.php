 <?php
    session_start();
    require_once('essentials/config.php');

      $email = $_POST['email'];
      $id = $_POST['id'];

     
      $sql = "INSERT INTO notify(email,product_id,created_date)
                   VALUES('$email','$id',NOW())";

      $run=mysqli_query($connect,$sql);
      
     
      header("location:notify-success.php");
    
    
?>