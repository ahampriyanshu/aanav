<?php
session_start();
include('essentials/config.php');

$shipping = $_SESSION['shipping'];

$result = mysqli_query($connect, "SELECT * FROM shipping where shipping_id='$shipping'");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['shipping_validation']) && $_POST['shipping_validation'] != '') { ?>

        <div class="panel-body">
                <div class="notice notice-warning">
                        <strong>
                                <p>Dear <?php echo $row['full_name'] ?>,</p>
                        </strong>
                        <p>It is to be informed that some of our merchant doesn't support COD for some specific locations.
                                That said you in some cases your order might get cancelled.Cheers </p>
                </div>
                <a href="order-update.php" class="btn btn-sm btn-success pull-right" style="margin-left: 4px">Place Order
                <i style=" margin-left: 10px;" class="fas fa-arrow-right"></i></a>
                <a href="checkout.php" class="btn btn-sm pull-right">
                <i style=" margin-right: 10px;" class="fas fa-arrow-left"></i>Back
                </a>
        </div>
<?php  } ?>