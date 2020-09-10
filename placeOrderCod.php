<?php
session_start();
include('essentials/config.php');
$shipping = $_SESSION['shipping'];
$result = mysqli_query($connect, "SELECT * FROM shipping where shipping_id='$shipping'");
$row = mysqli_fetch_assoc($result);
if (isset($_POST['shipping_validation']) && $_POST['shipping_validation'] != '') { ?>
        <div class="panel-body mb-5">

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

                echo '<table class="table text-center table-borderless">';
                echo '<tr>';
                echo '<td>Total [' . $itemqty . ' pcs]</td>';;
                echo '<td></td>';
                echo '<td><strong>&#x20B9;&nbsp;' . $total . '</strong></td>';
                echo '</tr>';
                echo '</table>';
                echo '<br>';
              }
              ?>
              
                <div class="notice notice-warning">
                        <p>Dear <?php echo $row['full_name'] ?>,</p>
                        <p>It is to be informed that some of our merchant doesn't support COD for some specific locations.<br>
                        In some cases the order may get cancelled</p>
                </div>
                <a href="placeOrder.php" class="btn btn-sm btn-success pull-right" style="margin-left: 4px">Place Order
                        <i style=" margin-left: 10px;" class="fas fa-arrow-right"></i></a>
                <a href="checkout.php" class="btn btn-sm pull-right">
                        <i style=" margin-right: 10px;" class="fas fa-arrow-left"></i>Back
                </a>
        </div>
<?php  } ?>