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

        <div class="form-check">
          <label>
            <input type="radio" class="option-input radio" id="COD_radio" name="COD_radio" />
            Cash On Delivery
          </label>
        </div>

        <div class="pay-container mb-5">
        </div>

        <script type="text/javascript">
          $(document).ready(function() {
            $("#COD_radio").change(function() {
              var shippingValidation = $(this).val();

              if (shippingValidation != '') {
                $("#loader").show();
                $(".pay-container").html("");

                $.ajax({
                  type: 'post',
                  data: {
                    shipping_validation: shippingValidation
                  },
                  url: 'placeOrderCod.php',
                  success: function(returnData) {
                    $("#loader").hide();
                    $(".pay-container").html(returnData);
                  }
                });
              }

            })
          });
        </script>
      </div>

      <style type="text/css">
        .shipping_inner {
          font-size: 14px;
          text-align: left;
          padding-top: 0;
          background-color: #fff;
          margin-bottom: 20px;
        }

        .shipping_inner_style {
          padding-left: 8px;
          margin-left: 10px;
        }

        .shipping_inner b {
          display: block;
          font-size: 14px;
          margin-bottom: 5px;
          color: #34495e;
        }
      </style>

      <div class="col-lg-4">
            <?php
            $shipping = $_SESSION['shipping'];
            $sql = "SELECT * FROM shipping WHERE shipping_id = $shipping";
            $run = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($run);
            ?>
                            <table class="table table-borderless">
  			<tr>
  				<th>Name</th>
  				<td><?php echo $row['full_name'] ?></td>
              </tr>
              <tr>
  				<th>Email</th>
  				<td><?php echo $row['email'] ?></td>
              </tr>
              <tr>
  				<th>Phone</th>
  				<td><?php echo $row['phone'] ?></td>
              </tr>

              <?php if ($row['store_id'] == 0) { ?>

                <tr>
  				<th>Delivery Type</th>
  				<td> Home Delivery </td>
  			</tr>
  			<tr>
  				<th>Address</th>
  				<td><?php echo $row['street_address'] ?></td>
  			</tr>
  			<tr>
  				<th>City</th>
  				<td><?php echo $row['city'] ?></td>
              </tr>
              <tr>
  				<th>State</th>
  				<td><?php echo $row['state'] ?></td>
              </tr>
              <tr>
  				<th>Pincode</th>
  				<td><?php echo $row['pincode'] ?></td>
              </tr>
              <tr>

                                <?php } else { ?>
                                    <tr>
  				<th>Delivery Type</th>
  				<td>Store Pickup</td>
              </tr>
              <?php $store_sql = "SELECT * FROM store WHERE store_id =".$row['store_id'];
            $store_query = mysqli_query($connect, $store_sql);
            while ($store_row = mysqli_fetch_array($store_query)) {
            ?>
            
  			<tr>
  				<th>Store Name</th>
  				<td><?php echo $store_row['store_name'] ?></td>
  			</tr>
  			<tr>
  				<th>Store Email</th>
  				<td><?php echo $store_row['email'] ?></td>
              </tr>
              <tr>
  				<th>Store Phone</th>
  				<td><?php echo $store_row['phone'] ?></td>
              </tr>
              <tr>
  				<th>Store Address</th>
  				<td><?php echo $store_row['address'] ?></td>
  			</tr>
                            <?php } 
                          } ?>
           
  		
          </table>
            </div>
  </div>
  </div>

<?php include('footer.php'); ?>