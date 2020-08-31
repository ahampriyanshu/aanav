<?php
include('boilerplate.php');
$sql = "SELECT * FROM orders WHERE email = '$customer' ORDER BY created_date DESC";
$run = mysqli_query($connect, $sql);
$count = mysqli_num_rows($run);

$sql2 = "SELECT * FROM wishlist WHERE customer_id='$customer_id'";
$run2 = mysqli_query($connect, $sql2);
$count_fav = mysqli_num_rows($run2);

?>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="contact-widget">
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="far fa-address-card"></i>
                        </div>
                        <div class="ci-text">
                            <span>Hello, </span>
                            <p><?php echo $_SESSION['name']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="fas fa-barcode"></i>
                        </div>
                        <div class="ci-text">
                            <span>Manage Orders</span>
                            <p>Dashboard</p>
                        </div><br>
                        <a href="myorders.php">
                            <p>My Orders(<?php echo $count ?>)</p>
                        </a>
                        <a href='cart.php'>
                            <p>My Cart(<?php echo $total ?>)</p>
                        </a>
                        <a href='wishlist.php'>
                            <p>My Wishlist(<?php echo $count_fav ?>)</p>
                        </a>

                    </div>
                    <hr>

                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="ci-text">
                            <span>Change</span>
                            <p>User Setting</p>
                        </div><br>
                        <p>Email:&nbsp;<span style="color:#444;"><?php echo $customer ?></span></p>
                        <p>Phone:&nbsp;<span style="color:#444;"><?php echo $_SESSION['phone']; ?></span></p>
                        <p>Since:&nbsp;<span style="color:#444;"><?php echo $customer_created  ?></span></p>
                        <p>Last Visited:&nbsp;<span style="color:#444;"><?php echo $customer_login ?></span></p>
                        <p><a style="text-decoration: none; color:#444;" href="changePassword.php">Change Password</a></p>
                        <p><a style="text-decoration: none; color:#444;" href="changePhone.php">Change Phone Number</a></p>
                        <p><a style="text-decoration: none; color:#444;" href="deactivateAccount.php">Account deactivation</a></p>
                    </div>
                    <hr>
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="fas fa-toggle-off"></i>
                        </div>
                        <div class="ci-text">
                            <span>Done Shopping,</span>
                            <a href="logout.php">
                                <p>Logout</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
            <?php if ($count != 0) {

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

                                 while($row = mysqli_fetch_assoc($run)): 
                                    $status = $row['status'];
?>

                <tr>
                            <td class="qua-col">
                            <p><span style="font-size:1.1em;"
                             class="badge badge-pill badge-light"><?php echo $row['order_id'] ?></span></p>             
                            </td>
                                                      <td class="qua-col">
                                                      <?php if($status == 2) { ?>
    				<span class="badge badge-pill badge-warning">UnPaid</span>
    			 
			          <?php } else if($status == 3){ ?>
			            <span class="badge badge-pill badge-info">Paid</span>

			              <?php } else if($status == 4){ ?>
			            <span class="badge badge-pill badge-light">Shipping</span>
			         
			          <?php }else{  ?>
			           <span class="badge badge-pill badge-dark"> Delivered</span>
                      <?php  }?>

                                                      </td>
                                                      <td class="qua-col">
                                                      <?php echo $row['payment_type'] ?>
                                                      <?php if($row['store_id'] == 0) { ?>
    				<span class="badge badge-pill badge-warning">Store Pickup</span>
    			 
                      <?php } else { 
                          echo'<span class="badge badge-pill badge-warning">Home Delivery</span>';
                          }?>
                                                  </td>

                                                  <td class="qua-col">
                                                      <?php echo $row['total_qty'] ?>
                                                  </td>

                                                  <td class="qua-col">
                                                      <?php echo $row['total_amt'] ?>
                                                  </td>

                                                  <td class="qua-col">
                                                      <?php echo $row['created_date'] ?>
                                                  </td>

                                                  <td class="qua-col">
                                                     
                                                  Order Details
                        
                                                  </td>

                                                    </tr>
   	<?php endwhile ; ?>
              
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

            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>