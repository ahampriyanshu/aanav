<?php
include('boilerplate.php');

$order_id = $_GET['id'];

$sql = "SELECT * FROM order_detail WHERE customer_id = '$customer_if' ORDER BY created_date DESC";
$run = mysqli_query($connect, $sql);
$count = mysqli_num_rows($run);

?>
                <?php 

                    echo '<section class="shopping-cart carousel-info">
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
                            <p style="font-size:larger; " ><span class="badge badge-pill badge-light"><?php echo $id ?></span></p>
                            </td>
                            <td class="cart-title first-row">
                                <?php if ($row['status'] == 1) { ?>
                                    <span class="badge badge-pill badge-warning">Placed</span>

                                <?php } else if ($row['status'] == 2) { ?>
                                    <span class="badge badge-pill badge-success">Approved</span>

                                <?php } else if ($row['status'] == 3) { ?>
                                    <span class="badge badge-pill badge-info">Deliverd</span>

                                <?php } else if ($row['status'] == 4) { ?>
                                    <span class="badge badge-pill badge-success">Refunded</span>

                                <?php } else if ($row['status'] == 0) { ?>
                                    <span class="badge badge-pill badge-danger">Cancelled</span>

                                <?php } else {  ?>
                                    <span class="badge badge-pill badge-danger">Error</span>
                                <?php  } ?>

                            </td>
                            <td class="cart-title first-row">
                            <span class="badge badge-pill badge-info"><?php echo $row['payment_type'] ?></span>
                                <?php if ($row['store_id'] == 0) { ?>
                                    <span class="badge badge-pill badge-secondary">Store Pickup</span>

                                <?php } else {
                                    echo '<span class="badge badge-pill badge-secondary">Home Delivery</span>';
                                } ?>
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge badge-pill badge-light">
                                <?php echo $row['total_qty'] ?></span>
                                
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge badge-pill badge-success">&#x20B9;&nbsp;<?php echo $row['total_amt'] ?></span>
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge badge-pill badge-light">
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
<?php include('footer.php'); ?>