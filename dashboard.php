<?php
  include('boilerplate.php');

  $sql = "SELECT * FROM orders WHERE customer = '$customer' ORDER BY created_date DESC";
  $run = mysqli_query($connect,$sql);
  $count = mysqli_num_rows($run);

  $sql2 = "SELECT * FROM wishlist WHERE customer_id='$customer_id'";
  $run2 =mysqli_query($connect,$sql2);
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
                                <p><?php echo $customer_name;?></p>
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
                                <a href="order.php"><p>My Orders(<?php echo $count ?>)</p></a>
                                <a href='cart.php'><p>My Cart(<?php echo $total ?>)</p></a>
                                <a href='wishlist.php'><p>My Wishlist(<?php echo $count_fav ?>)</p></a>
                            
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
                                <p>Phone:&nbsp;<span style="color:#444;"><?php echo $customer_phone ?></span></p>
                                <p>Since:&nbsp;<span style="color:#444;"><?php echo $customer_created  ?></span></p>
                                <p>Last visited:&nbsp;<span style="color:#444;"><?php echo $customer_login ?></span></p>
                            
                        </div>
                        <hr>
                        <div class="cw-item">
                            <div class="ci-icon">
                            <i class="fas fa-toggle-off"></i>
                            </div>
                            <div class="ci-text">
                                <span>Done Shopping,</span>
                                <a href="logout.php"><p>Logout</p></a>
                            </div>
                        </div>
                    </div>
                </div>
         
     <div class="col-md-9">
              <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th ></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
    $customer = $_SESSION['email']; 
            $c = "SELECT * FROM customer WHERE email = '$customer'";
            $r = mysqli_query($connect,$c);
            $row_c =mysqli_fetch_assoc($r);
             $customer_id = $row_c['id'];

          $result = mysqli_query($connect,"SELECT distinct product.*,wishlist.product_id,wishlist.customer_id FROM product LEFT JOIN wishlist
          ON product.id = wishlist.product_id
          WHERE wishlist.customer_id = '$customer_id'");

          if ($result) {
              while ($obj = mysqli_fetch_object($result)) {
                  $id = $obj->id; ?>
                                <tr>
                                    <td><img src="uploads/<?php echo $obj->file ?>" width="150" height="150"/></td>
                                    <td>
                                        <h5><a href="product.php?id=<?php echo  $obj->id ?>"><?php echo $obj->name ?></a></h5>
                                        <p> <?php echo $obj->cost ?></p>
                                    </td>
                                    <td><i class="fas fa-2x fa-cart-plus"></i></td>
                                    <td><i class="fas fa-2x fa-trash"></i></td>
                                </tr>
                                
            <?php
              }
          } ?>
                            </tbody>
                        </table>
               
                    <br>
                            <div class="cart-buttons">
                                <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                                <a href="#" class="primary-btn up-cart">Update cart</a>
                            </div>
              
       </div>
    
     </div>

   </div>
 </div>
  <?php include('footer.php'); ?>