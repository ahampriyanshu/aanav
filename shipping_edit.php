<?php
include('boilerplate.php');
$id = $_GET['id'];
$customer_id = $_SESSION['id'];
$result = mysqli_query($connect, "SELECT * FROM shipping WHERE customer_id = '$customer_id' AND shipping_id=$id");
$row = mysqli_fetch_assoc($result);
?>
 <link rel="stylesheet" href="css/login.css">
<div class="col-md-5">
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

    mysqli_query($connect, $sql);

    echo "<div class='alert alert-success'>
          <strong><span class='fa fa-check'></span><strong>Successful Update</strong>
          </div>";
  }
  ?>
  <h3>Update Shipping Address</h3>
  <div class="panel-body">
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
      <input type="text" name="pincode" class="form-control" value="<?php echo $row['pincode'] ?>" />

      <label>Phone Number : </label>
      <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'] ?>" />

      <a href="shipping_info.php" class="my-3 btn btn-default"> Back</a>
      <input type="submit" name="submit" value="Update Address" class="btn btn-warning">

    </form>
  </div>
</div>
<?php include('footer.php'); ?>