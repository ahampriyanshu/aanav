<?php
include('boilerplate.php');
if (!isset($_SESSION['email']) ) {
  echo '<script>
  location.href="error.php"
  </script>';
}
if (!isset($_GET['id']))
{
header('location: error.php');
}
$id = $_GET['id'];
$sql = "SELECT * FROM shipping where shipping_id=$id";
$run = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($run)) {
$_SESSION['shipping'] = $row['shipping_id'];
}
?>
<link rel="stylesheet" type="text/css" href="css/success.css">

<div class="container">
  <div style="margin-top:40px;" class="row">
    <div class="col-md-12 text-center">
      <span class="icon-check_circle display-2 text-success"></span>
      <h2 class="display-5 text-black">Thank you!</h2>
      <p class="text-success mb-5">Your order was successfuly placed</p>
      <p><a href="orderDetail.php?id=<?php echo $id ?>" class="btn btn-sm btn-success">Order Detail</a></p>
      <p  style="vertical-align: middle;" >
      <a style="vertical-align: middle;" href="invoice.php?id=<?php echo $id ?>" class="btn btn-sm btn-info"><i style=" margin-right: 10px;" class="fas fa-2x fa-file-download"></i>Invoice</a></p>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>