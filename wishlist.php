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
                        <a href="order.php">
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
        <div class="col-md-6 mx-auto text-center">
            <div class="alert alert-success">
                <?php echo $_SESSION['alertMsg']; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['alertMsg']); ?>

                                  <?php
    $customer = $_SESSION['email']; 
            $c = "SELECT * FROM customer WHERE email = '$customer'";
            $r = mysqli_query($connect,$c);
            $row_c =mysqli_fetch_assoc($r);
             $customer_id = $row_c['id'];

          $result = mysqli_query($connect,"SELECT distinct product.*,wishlist.product_id,wishlist.customer_id FROM product LEFT JOIN wishlist
          ON product.id = wishlist.product_id
          WHERE wishlist.customer_id = '$customer_id'");

          echo $result;

if ($result) {
    while ($obj = mysqli_fetch_object($result)) {
        $id = $obj->id; ?>

<div class="container" style="margin-top: 30px;">

                        <p>
                        <a style="color: #888; margin-left: 10px;" href="shipping_del.php?id=<?php echo $row['shipping_id'] ?>" class='pull-right' id='del_<?= $id ?>'>
                        <i class="far fa-edit"></i></a>
                        <a style="color: #888;  margin-left: 10px;" href="update-wishlist.php?action=remove&id=<?php echo $id ?>" class="pull-right">
                        <i class="far fa-trash-alt"></i></a>
                        </p>
<div class="row ">
<div class="col-8">
<a href="product.php?id=<?php echo  $obj->id ?>" >
<img width="150" height="150"src="uploads/<?php echo $obj->file; ?>" alt="product image"></a>
</div>
  <div class="col-4">
                        <p><?php echo $obj->name; ?></p>
                        
                        <td class="total-price first-row">&#x20B9;&nbsp;<?php  echo $obj->cost; ?>
                                                      <strong style="text-decoration: line-through; color:grey; font-size:.8em;">
                                                       &#x20B9;&nbsp;<?php echo $obj->MRP; ?></strong></td>

                                                    </div>
                       <p> <a href="payment.php?id=<?php echo $row['shipping_id'] ?>" class="btn btn-sm btn-success pull-right">Buy Now<i style=" margin-left: 10px;" class="fas fa-arrow-right"></i></a>
                        </p>
                        </div>
                        </div>

<!-- 
              <tr>
                                                      <td class="cart-pic first-row"><a href="product.php?id=<?php echo  $obj->id ?>" >
                                                      <img width="150" height="150"src="uploads/<?php echo $obj->file; ?>" alt="product image"></a>
                                                    </td>

                                                      <td class="cart-title first-row">
                                                          <h5><?php echo $obj->name; ?></h5>
                                                      </td>

                                                      
                          
                           <td ><p><a href="update-cart.php?action=remove&id=<?php echo $product_id ?>" >
                          <i style="color:#888;" class="fas fa-cart-plus"></a></i></p>
                          <p><a href="update-wishlist.php?user=<?php echo $customer_id ?>&action=remove&id=<?php echo $product_id ?>" >
                          <i style="color:#888;" class="fas fa-trash"></i></a></p></td>  
                         </tr> -->
                         <?php
    }
} 
else {
    unset($_SESSION['alertMsg']);
    echo '
              <div class="container">
              <div style="margin-top:40px;" class="row">
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
</div> 
</div>
</div>
</div>
  <?php include('footer.php'); ?>
