<?php
include('boilerplate.php');
$sql = "SELECT * FROM orders WHERE email = '$customer' ORDER BY created_date DESC";
$run = mysqli_query($connect, $sql);
$count = mysqli_num_rows($run);

$sql2 = "SELECT * FROM wishlist WHERE customer_id='$customer_id'";
$run2 = mysqli_query($connect, $sql2);
$count_fav = mysqli_num_rows($run2);

?>
<div class="container-fluid d-flex">
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


            <div class="col-md-6">
                <?php if (isset($_SESSION['alertMsg'])) : ?>
                    <div class=" mx-auto text-center">
                        <div class="alert alert-success">
                            <?php echo $_SESSION['alertMsg']; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['alertMsg']); ?>

                <?php
                $customer = $_SESSION['email'];
                $c = "SELECT * FROM customer WHERE email = '$customer'";
                $r = mysqli_query($connect, $c);
                $row_c = mysqli_fetch_assoc($r);
                $customer_id = $row_c['id'];

                $result = mysqli_query($connect, "SELECT distinct product.*,wishlist.product_id,wishlist.customer_id FROM product LEFT JOIN wishlist
          ON product.id = wishlist.product_id
          WHERE wishlist.customer_id = '$customer_id'");

                if ($count_fav) {
                    while ($obj = mysqli_fetch_object($result)) {
                        $id = $obj->id; ?>

                        <div class="container " style="margin-top: 30px;">

                            <div class="row ">
                                <div class="col-6">
                                    <a href="product.php?id=<?php echo  $obj->id ?>">
                                        <img width="150" height="150" src="uploads/<?php echo $obj->file; ?>" alt="product image"></a>
                                </div>
                                <div class="col-4 text-center my-auto">

                                    <p style="color:grey; font-size:1.2em; font-weight:bolder;"><?php echo $obj->name; ?></p>
                                    <p><span style="color:#62F7F1; font-size:1.2em; font-weight:bolder;">
                                            &#x20B9;&nbsp;<?php echo $obj->cost; ?></span>
                                        <strong style="text-decoration: line-through; color:grey; font-size:.8em;">
                                            &#x20B9;&nbsp;<?php echo $obj->MRP; ?></strong></p>

                                    <p>
                                        <a style="color: #888;  margin-left: 10px;" href="update-wishlist.php?action=remove&id=<?php echo $id ?>">
                                            <i class="far fa-trash-alt"></i></a>
                                    </p>

                                </div>

                            </div>
                        </div>
                <?php
                    }
                } else {
                    unset($_SESSION['alertMsg']);
                    echo '
              <div class="container">
              <div style="margin-top:40px;" class="row">
    <div class="col-md-12 text-center">
      <span class="icon-exclamation-triangle display-1 text-danger"></span>
      <h2 class="display-4 text-black">Your wishlist is empty !</h2>
      <p class="display-5 mb-5">You can check our trending section</p>
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