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
      <h3>WHILIST</h3>
        <div class="row">
          <?php
    $customer = $_SESSION['email']; 
            $c = "SELECT * FROM customer WHERE email = '$customer'";
            $r = mysqli_query($connect,$c);
            $row_c =mysqli_fetch_assoc($r);
             $customer_id = $row_c['id'];

          $result = mysqli_query($connect,"SELECT distinct product.*,wishlist.product_id,wishlist.customer_id FROM product LEFT JOIN wishlist
          ON product.id = wishlist.product_id
          WHERE wishlist.customer_id = '$customer_id'");

          if($result){

            while($obj = mysqli_fetch_object($result)) {
             $id = $obj->id;

            ?>
              <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th ></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="cart-pic first-row"><img src="uploads/<?php echo $obj->file ?>" width="110" height="140"/></td>
                                    <td class="cart-title first-row">
                                        <h5><a href="detail.php?id=<?php echo  $obj->id ?>"><?php echo $obj->name ?></a></h5>
                                    </td>
                                    <td class="p-price first-row">$60.00</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row">$60.00</td>
                                    <td class="close-td first-row"><i class="ti-close"></i></td>
                                </tr>
                                
                               
                            </tbody>
                        </table>
                    </div>
                    <br>
                            <div class="cart-buttons">
                                <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                                <a href="#" class="primary-btn up-cart">Update cart</a>
                            </div>

          
              <!-- <div class="col-md-6">
              <table class="table haha">
              <tr>
                <td><img src="uploads/<?php echo $obj->file ?>" width="110" height="140"/></td>
                <td>
                <p><strong><i><a href="detail.php?id=<?php echo  $obj->id ?>"><?php echo $obj->name ?></a></i></strong></p>
                <p><strong>&#x20B9;&nbsp; <?php echo  $obj->price ?></strong></p>
                <a href="">Remove</a>
                <?php if($obj->qty < 7 && $obj->qty > 0 ){ ?>
                <span class='badge badge-warning' style='margin-top: 2px;'>Low In Stock</span>
                <?php }elseif($obj->qty == 0){ ?>
                   <span class='badge badge-warning' style='margin-top: 2px;'>SOLD OUT</span>
                 <?php }else{ ?>

                <?php } ?>

              <?php if($obj->qty < 5){ ?>
                  <img src="image/bestseller.png" width="85" height="18" style="margin-left: 2px;">
              <?php }  ?>
              <hr>
                <form method="post" action="adding-to-cart.php" enctype="multipart/form-data">
              
                <input type="hidden" name="id" value="<?php echo $obj->id?>">
                <?php if($obj->qty > 0){ ?>
                <input type="submit" name="submit" value="Add To Cart" style="clear:both; background:
                 #48c9b0; border: none; color: #fff; font-size: 11px; padding: 10px; cursor: pointer;"
                  class="btn btn-primary pull-right" />
                </form>
                <?php }else{ ?>
                  
               <?php 
                 $result2 = mysqli_query($connect,"SELECT * FROM product WHERE id=$id");
                 $row2 = mysqli_fetch_assoc($result2);

                 ?>
                 <?php echo $row2['id']; ?>
                  <button data-toggle="modal" data-target="#view-modal"
                   data-id="<?php echo $row2['id']; ?>" id="getUser" style="clear:both; background: 
                   #48c9b0; border: none; color: #fff; font-size: 11px; padding: 10px;cursor: pointer;"
                    class="btn btn-primary pull-right">Add To Cart</button> -->
     <?php } ?>

       <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                  
                       <div class="modal-header"> 
                        <h4 class="modal-title">
                              <i class="fa fa-envelope-o"></i> SOLD OUT Alert
                            </h4> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            
                       </div> 
                       <div class="modal-body"> 
                       
                            
                           <!-- content will be load here -->                          
                           <div id="dynamic-content">
                           
                           </div>
                             
                        </div> 
                        
                        
                 </div> 
              </div>
       </div><!-- /.modal --> 
       <script>
$(document).ready(function(){
  
  $(document).on('click', '#getUser', function(e){
    
    e.preventDefault();
    
    var uid = $(this).data('id');   // it will get id of clicked row
    
    $('#dynamic-content').html(''); // leave it blank before ajax call
    $('#modal-loader').show();      // load ajax loader
    
    $.ajax({
      url: 'getemail.php',
      type: 'POST',
      data: 'id='+uid,
      dataType: 'html'
    })
    .done(function(data){
      console.log(data);  
      $('#dynamic-content').html('');    
      $('#dynamic-content').html(data); // load response 
      $('#modal-loader').hide();      // hide ajax loader 
    })
    .fail(function(){
      $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
      $('#modal-loader').hide();
    });
    
  });
  
});

</script>
<!--      ----------------------------------- SOLD OUT MODAL DIALOG End------------------------ -->

              </td>
                

                
                <!-- -----------color size & add to cart start---------- -->
    
        
                <!-- -----------color size & add to cart end---------- -->
              
              </tr>
              </table>
                      
              </div><!--  col-md-6 end -->
             
            <?php }} ?>
              
       </div>
    
     </div> <!-- col-md-8 end-->

   </div>
 </div>


  <?php include('footer.php'); ?>
