<?php
include('boilerplate.php');
if (!isset($_GET['id']) || !isset($_SESSION['email']) || !$_SESSION['cart'] ) {
  echo '<script>
  location.href="error.php"
  </script>';
}
$id = $_GET['id'];
$sql = "SELECT * FROM shipping where shipping_id=$id";
$run = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($run)) {
  $_SESSION['shipping'] = $row['shipping_id'];
}
?>

<style type="text/css">
  @keyframes click-wave {
    0% {
      height: 40px;
      width: 40px;
      opacity: 0.35;
      position: relative;
    }

    100% {
      height: 200px;
      width: 200px;
      margin-left: -80px;
      margin-top: -80px;
      opacity: 0;
    }
  }

  .option-input {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
    appearance: none;
    position: relative;
    top: 13.33333px;
    right: 0;
    bottom: 0;
    left: 0;
    height: 40px;
    width: 40px;
    transition: all 0.15s ease-out 0s;
    background: #cbd1d8;
    border: none;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    margin-right: 0.5rem;
    outline: none;
    position: relative;
    z-index: 1000;
  }

  .option-input:hover {
    background: #9faab7;
  }

  .option-input:checked {
    background: #40e0d0;
  }

  .option-input:checked::before {
    height: 40px;
    width: 40px;
    position: absolute;
    content: '✔';
    display: inline-block;
    font-size: 26.66667px;
    text-align: center;
    line-height: 40px;
  }

  .option-input:checked::after {
    -webkit-animation: click-wave 0.65s;
    -moz-animation: click-wave 0.65s;
    animation: click-wave 0.65s;
    background: #40e0d0;
    content: '';
    display: block;
    position: relative;
    z-index: 100;
  }

  .option-input.radio {
    border-radius: 50%;
  }

  .option-input.radio::after {
    border-radius: 50%;
  }

  .form-check {
    padding: 2rem;
  }

  .form-check {
    display: block;
    line-height: 20px;
  }
</style>

  <div class="container mb-5">
    <div class="row">
      <div class="col-lg-8">
        <h2>Payment Method</h2>
        
        <div class="panel-body my-5">
              
                <div class="notice notice-warning">
                        <p>Dear <?php echo $_SESSION['name'] ?>,</p>
                        <p>It is to be informed that some of our merchant doesn't support COD for some specific locations.<br>
                        In some cases the order may get cancelled</p>
                </div>
                <a href="placeOrder.php" class="btn btn-sm btn-success pull-right" style="margin-left: 4px">Place Order
                        <i style=" margin-left: 10px;" class="fas fa-arrow-right"></i></a>
                <a href="checkout.php" class="btn btn-sm pull-right">
                        <i style=" margin-right: 10px;" class="fas fa-arrow-left"></i>Back
                </a>
        </div>
      </div>

      <div class="col-lg-4">
            <?php
            $shipping = $_SESSION['shipping'];
            $sql = "SELECT * FROM shipping WHERE shipping_id = $shipping";
            $run = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($run);
            ?>
                            <table class="table table-borderless">
                            <?php
              if (isset($_SESSION['cart'])) {

                $total = 0;
                $itemqty = 0;


                foreach ($_SESSION['cart'] as $variant_id => $quantity) {

                  $find_pro_id = mysqli_query($connect, "SELECT * FROM variant WHERE variant_id='$variant_id'");
                  $pro_data = mysqli_fetch_assoc($find_pro_id);
                  $product_id = $pro_data['product_id'];

                  $result = "SELECT qty, cost FROM product WHERE id = $product_id";
                  $run = mysqli_query($connect, $result);

                  if ($run) {

                    while ($obj = mysqli_fetch_object($run)) {
                      $cost = $obj->cost * $quantity;
                      $total = $total + $cost;
                      $itemqty = $itemqty + $quantity;
                    }
                  }
                }
              
              ?>
  			<tr>
  				<th><span class="badge badge-info"><?php echo $itemqty ?>&nbsp;unit</th>
  				<td><span class="badge badge-success">&#x20B9;&nbsp;<?php echo $total ?></td>
          <?php  }  ?>
          </tr>
              		<tr>
  				<th><span class="badge badge-dark">Name</th>
  				<td><span class="badge badge-light"><?php echo $row['full_name'] ?></td>
              </tr>
              <tr>
  				<th><span class="badge badge-dark">Email</th>
  				<td><span class="badge badge-light"><?php echo $row['email'] ?></td>
              </tr>
              <tr>
  				<th><span class="badge badge-dark">Phone</th>
  				<td><span class="badge badge-light"><?php echo $row['phone'] ?></td>
              </tr>

              <?php if ($row['store_id'] == 0) { ?>

                <tr>
  				<th><span class="badge badge-dark">Delivery Type</th>
  				<td><span class="badge badge-light">Home Delivery </td>
  			</tr>
  			<tr>
  				<th><span class="badge badge-dark">Address</th>
  				<td><span class="badge badge-light"><?php echo $row['street_address'] ?></td>
  			</tr>
  			<tr>
  				<th><span class="badge badge-dark">City</th>
  				<td><span class="badge badge-light"><?php echo $row['city'] ?></td>
              </tr>
              <tr>
  				<th><span class="badge badge-dark">State</th>
  				<td><span class="badge badge-light"><?php echo $row['state'] ?></td>
              </tr>
              <tr>
  				<th><span class="badge badge-dark">Pincode</th>
  				<td><span class="badge badge-light"><?php echo $row['pincode'] ?></td>
              </tr>
              <tr>

                                <?php } else { ?>
                                    <tr>
  				<th><span class="badge badge-dark">Delivery Type</th>
  				<td><span class="badge badge-light">Store Pickup</td>
              </tr>
              <?php $store_sql = "SELECT * FROM store WHERE store_id =".$row['store_id'];
            $store_query = mysqli_query($connect, $store_sql);
            while ($store_row = mysqli_fetch_array($store_query)) {
            ?>
            
  			<tr>
  				<th><span class="badge badge-dark">Store Name</th>
  				<td><span class="badge badge-light"><?php echo $store_row['store_name'] ?></td>
  			</tr>
  			<tr>
  				<th><span class="badge badge-dark">Store Email</th>
  				<td><span class="badge badge-light"><?php echo $store_row['email'] ?></td>
              </tr>
              <tr>
  				<th><span class="badge badge-dark">Store Phone</th>
  				<td><span class="badge badge-light"><?php echo $store_row['phone'] ?></td>
              </tr>
              <tr>
  				<th><span class="badge badge-dark">Store Address</th>
  				<td><span class="badge badge-light"><?php echo $store_row['address'] ?></td>
  			</tr>
                            <?php } 
                          } ?>
           
  		
          </table>
            </div>
  </div>
  </div>

<?php include('footer.php'); ?>