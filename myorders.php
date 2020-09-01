<?php
include('boilerplate.php');
$sql = "SELECT * FROM orders WHERE email = '$customer' ORDER BY created_date DESC";
$run = mysqli_query($connect, $sql);
$count = mysqli_num_rows($run);

?>
                <?php if ($count != 0) {

                    echo '<section class="borderless-table carousel-info">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="cart-table">
                              <table>
                                  <thead>
                                      <tr>
                                          <th>Order No</th>
                                          <th>Status</th>
                                          <th>Payment</th>
                                          <th>Qty</th>
                                          <th>Total</th>
                                          <th>Time</th>
                                          <th>Details</th>
                                          <th>Invoice</th>
                                      </tr>
                                  </thead>
                                  <tbody>';

                    while ($row = mysqli_fetch_assoc($run)) :
                        $id = $row['order_id'];
                ?>

                        <tr>
                            <td class="cart-title first-row">
                            <span  style="font-size:1.1em;" class="badge  badge-light"><?php echo $id ?></span>
                            </td>
                            <td class="cart-title first-row">
                                <?php if ($row['status'] == 1) { ?>
                                    <span class="badge  badge-warning">Placed</span>

                                <?php } else if ($row['status'] == 2) { ?>
                                    <span class="badge  badge-success">Approved</span>

                                <?php } else if ($row['status'] == 3) { ?>
                                    <span class="badge  badge-info">Deliverd</span>

                                <?php } else if ($row['status'] == 4) { ?>
                                    <span class="badge  badge-success">Refunded</span>

                                <?php } else if ($row['status'] == 0) { ?>
                                    <span class="badge  badge-danger">Cancelled</span>

                                <?php } else {  ?>
                                    <span class="badge  badge-danger">Error</span>
                                <?php  } ?>

                            </td>
                            <td class="cart-title first-row">
                                <?php if ($row['store_id'] == 0) { ?>
                                    <span class="badge  badge-secondary">Store Pickup</span>

                                <?php } else {
                                    echo '<span class="badge  badge-info">Home Delivery</span>';
                                } ?>
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge  badge-light">
                                <?php echo $row['total_qty'] ?></span>
                                
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge  badge-success">&#x20B9;&nbsp;<?php echo $row['total_amt'] ?></span>
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge  badge-light">
                            <?php echo $row['created_date'] ?></span>
                                
                               
                            </td>

                            <td class="cart-title first-row">

                                <a style="color:#F67E29;" href="orderDetail.php?id=<?php echo $id ?>" >
                                    <i class="fas fa-info-circle"></i></a>

                            </td>

                            <td class="cart-title first-row">

                                <a style="color:grey;" href="invoice.php">
                                    <i class="fas fa-file-alt"></i></a>

                            </td>

                        </tr>
                    <?php endwhile; ?>

                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
</section>
<?php
                } else {
                    echo '
                  <div class="container">
                  <div class="row my-5">
        <div class="col-md-12 text-center">
          <span class="icon-exclamation-circle display-1 text-danger"></span>
          <h2 class="display-3 text-black">Your cart is empty !</h2>
          <p class="display-5 mb-5">You can check our bestseller section</p>
          <p><a href="index.php" class="btn btn-sm btn-info">Continue Shopping</a></p>
        </div>
      </div>
    </div>';
                }
?>
<?php include('footer.php'); ?>