
<?php
  session_start();
  require_once('essentials/config.php');
  
  

  $id = $_REQUEST['id'];
  
  $sql = "SELECT * FROM shipping where shipping_id=$id";
  $run =mysqli_query($connect,$sql);
  while($row = mysqli_fetch_assoc($run)){
  $_SESSION['shipping'] = $row['shipping_id'];

?>

<?php } ?>
<?php include('boilerplate.php'); ?>
    <?php include('navbar.php'); ?> 
   
    <br><br>


<style type="text/css">

  .ship{
            width: 245px;
            height: 255px;
           /*background-color: #ebf5fb;*/
           border-radius: 4px;
           border : 1px solid #aed6f1; 
         }
ul.list{
  list-style: none;
  margin: 20px;
  padding: 0;
  padding-top: 2px;

}
ul.list li{
  overflow: hidden;
  border-bottom: 1px solid #ddd;
  padding-bottom: 10px;
  margin-bottom: 20px;
}
ul.list b{
  display: block;
  font-size: 12px;
  margin-bottom: 5px;
  color: #34495e;
}
ul.list i,ul.list small{
  display: block;
  
}

 
</style>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2>Payment Method</h2> 
    


<hr>
<div class="custom-control custom-radio">
  <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
  <label class="custom-control-label" for="customRadio2">Cash in Hand</label>

  
</div>

<div id="pay-container">
</div>

<hr>
<script src="jquery.min.js" integrity "sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#customRadio2").change(function(){
      var shippingValidation = $(this).val();
      
      if(shippingValidation !='')
      {
        $("#loader").show();
        $(".pay-container").html("");
        
        $.ajax({
          type:'post',
          data:{shipping_validation:shippingValidation},
          url: 'ajax_request_cash.php',
          success:function(returnData){
            $("#loader").hide();  
            $(".pay-container").html(returnData);
          }
        }); 
      }
      
    })
  });

 
</script>


<style type="text/css">
  .pay-lo{
    height: 18px;
  }
</style>
 
    </div>

     
      <style type="text/css">
        .securepayment{
          font-family: "adihausregular",Helvetica,Verdana,sans-serif;
          font-size: 14px;
          line-height: 20px;
          color: #000;
          font-weight: normal;
          padding-top: 0px;
          margin-top: 4px;
        }
        .order-sum{
          background-color: #f2f3f4;
          width: auto;
          height: auto;


        }
        .inner-order{
          background-color: #fff;
           margin-bottom: 20px;

        }
        .shipping_inner{
          font-size: 14px;
          text-align: left;
          padding-top: 0;
          background-color: #fff;
          margin-bottom: 20px;
        }
        .shipping_inner_style{
           padding-left: 8px;
          margin-left: 10px;
        }
        .shipping_inner b{
  display: block;
  font-size: 14px;
  margin-bottom: 5px;
  color: #34495e;
}

      </style>
    <div class="col-md-4">
      <div class="order-sum">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-8">
              <div class="inner-order">
  <?php
      if(isset($_SESSION['cart'])) {

            $total = 0;
            $itemqty = 0;
           
          
            foreach($_SESSION['cart'] as $product_id => $quantity) {

            $result = "SELECT  name, qty, cost,file FROM product WHERE id = $product_id";
            $run = mysqli_query($connect,$result);
               
            if($run){

                echo '<ul class="list">';
              while($obj = mysqli_fetch_object($run)) {
                $cost = $obj->cost * $quantity; //work out the line cost
                $total = $total + $cost; //add to the total cost
                $itemqty = $itemqty+$quantity;
                
                
               echo '<li>';
               echo '<img src="uploads/'.$obj->file.'" width="100" height="140" align="right" align="right" alt="">';
                echo '<b>'.$obj->name.'</b>';
                echo '<h6 class="my-0">&#x20B9;&nbsp;'.$obj->cost.'</h6>';
                echo '<small>quantity: '.$quantity.'</small>';
                // echo 'amount: &#x20B9;&nbsp;'.$cost.'<br>';
                echo '</li>';
              }
              echo '</ul>';
            }

          }

          echo '<table class="table">';
          echo '<tr>';
          echo '<td>TOTAL('.$itemqty.')</td>';
           echo '<td></td>';
           echo '<td></td>';
           echo '<td></td>';
          echo '<td><strong>&#x20B9;&nbsp;'.$total.'</strong></td>';
          echo '</tr>';
          
          echo '</table>';
          echo '<br>';
          
        }
        ?>

    
        </div><!--  inner order end -->
            <?php 
      require_once('essentials/config.php'); 
      $shipping = $_SESSION['shipping'];
      $sql = "SELECT * FROM shipping WHERE shipping_id = $shipping";
      $run = mysqli_query($connect,$sql);
      $row = mysqli_fetch_assoc($run);
      ?>
      <div class="shipping_inner">
        <div class="shipping_inner_style">
      <b>SHIPPING ADDRESS</b>
        <?php echo $row['full_name'] ?><br>
          <span class="fa fa-phone"></span> <?php echo $row['phone'] ?><br>
          <?php echo $row['street_address'] ?><br>
         <?php echo $row['city'] ?> , 
          <?php echo $row['state'] ?><br>
          
           <?php echo $row['country'] ?><br>
          <a href="shipping_info.php">Edit</a><br><br>

          <?php  ?>
          <?php echo "$email"; ?><br>
          <a href="shipping_info.php">Edit</a>
          </div>
          </div> <!-- shipping inner end -->
          </div>

        </div>

      </div> <!-- ====== -->

        </div>
  </div>
  </div>
</div>

<script type="text/javascript" src=""></script>
<style type="text/css">

h3{
	font-family: AdineuePRO,Helvetica,Verdana,sans-serif;
font-style: normal;
color: #000;
font-size: 18px;
margin: 15px 0px;
line-height: 100%;
font-weight: 600;
padding: 4px;

}
h1{
    color: #5d6d7e;
    text-align: center;
}

.box {
        border-radius: 6px;
        border: 2px solid #009689;
        margin : 8px;
        padding: 8px;
        width: 200px;
        height: 100px;
        text-align: center;
        font-size: 45px;
        background-color: #009688;
    }
    .box a{
        color: white;
    }
   

h2{
  font-size: 26px;
line-height: 24px;
letter-spacing: 1.5px;
font-family: AdineuePRO,Helvetica,Verdana,sans-serif;
font-style: normal;
font-weight: 800;
color: #000;
}

</style>



<br><br><br>
<?php include('footer.php'); ?>

<script src='jquery-3.3.1.js' type='text/javascript'></script>
<script src='bootbox.min.js'></script>
<script src='shipping_del_script.js' type='text/javascript'></script>

<?php include('footer.php'); ?></body>
</html>


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
     <div class="container">
   <div class="row">
                        <div class="col-md-9">
                        <div class="cart-buttons">
                            <a href="index.php" class="primary-btn continue-shop">Continue shopping</a>
                            <a href="update-wishlist.php?user=<?php echo $customer_id; ?>&action=empty" 
                            class="primary-btn up-cart">Empty Wishlist</a>
                        </div>
                        </div>
            
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
                  <div class="col-md-6 col-sm-12">
                                         <div class="product-item">
                                         <div class="pi-text">
                            <a href="product.php?id=<?php echo $row_latest['id']; ?>">
                            <img src="uploads/<?php  echo $obj->file; ?>" alt="Image" style="width: 250px; height:250px; border-radius: 3%;" class="img-responsive">
                            <h3><strong><?php echo $obj->name; ?></strong></h3>
                                <div class="product-price">
                                &#x20B9;&nbsp;<?php  echo $obj->cost; ?>
                                <span>&#x20B9;&nbsp;<?php echo $obj->MRP; ?></span>
                                </div>
                                <p><i class="fas fa-cart-plus"></i>
                                &emsp;    <i class="fas fa-trash"></i></p>
                            </div>
                        </div>
                     </div>           
            <?php
              }
          } ?>              
       </div>
     </div>
   </div>
 </div>
 </div>
 </div>
  <?php include('footer.php'); ?>





