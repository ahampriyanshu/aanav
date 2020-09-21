<?php
include('boilerplate.php');
if (!isset($_SESSION['email']) ) {
  echo '<script>
  location.href="error.php"
  </script>';
}
$id = $_GET['id'];
$customer_id = $_SESSION['id'];
$result = mysqli_query($connect, "SELECT * FROM shipping WHERE customer_id = '$customer_id' AND shipping_id=$id");
$row = mysqli_fetch_assoc($result);
?>
 <link rel="stylesheet" href="css/login.css">
  <?php

  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $street = $_POST['street'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $phone = $_POST['phone'];

    $sql = "UPDATE shipping SET full_name='$name',street_address='$street',state='$state',city='$city',pincode='$pincode',phone='$phone',modified_date=now() 
          WHERE shipping_id = $id ";

    $run = mysqli_query($connect, $sql);

    if ($run) {
      echo "<script>window.open('checkout.php','_self')</script>"; 
  } else {
      echo "Error description: " . mysqli_error($connect) ;
  }

    
  }
  ?>
   <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
        <div class="login-wrapper my-auto">
            <h1 class="login-title">Update Address</h1>
    <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $row['shipping_id'] ?>">

      <label>Full Name : </label>
      <input type="text" name="name" class="form-control" value="<?php echo $row['full_name'] ?>" />

      <label>Street Address : </label>
      <textarea type="text" name="street" class="form-control"><?php echo $row['street_address'] ?></textarea>

      <label>State : </label>
      <input type="text" name="state" class="form-control" value="<?php echo $row['state'] ?>" />

      <label>City : </label>
      <input type="text" name="city" class="form-control" value="<?php echo $row['city'] ?>" />

      <label>Pincode Code : </label>
      <input type="text" name="pincode" pattern="[0-9]{6}" class="form-control" value="<?php echo $row['pincode'] ?>" />

      <label>Phone Number : </label>
      <input type="text" pattern="[0-9]{10}" name="phone" class="form-control" value="<?php echo $row['phone'] ?>" />

      <a href="checkout.php" class="my-3 btn btn-default"> Back</a>
      <input type="submit" name="submit" value="Update Address" class="btn btn-warning">

    </form>
    </div>
        </div>
      </div>
    </div>
<?php include('footer.php'); ?>