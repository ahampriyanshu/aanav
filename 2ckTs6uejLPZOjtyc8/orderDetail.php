<?php
require('header.php');
include "../dbConfig.php";
$queries    = new queries;
$sendEmail  = new sendEmail;

if (!$_GET['id']) {
   echo '<script>
    location.href="logout.php"
    </script>';
}
$order_id = $_GET['id'];
$orders = mysqli_query($connect, "SELECT * FROM orders WHERE order_id = '$order_id'");
$order_prop = mysqli_fetch_assoc($orders);
$customer_id = $order_prop['customer_id'];
$total = $order_prop['total_amt'];
$find_data = "SELECT email,name FROM customer WHERE id = '$customer_id' ";
$found_data = $connect->query($find_data);
$customer_id_array = $found_data->fetch_assoc();
$customer_email = $customer_id_array['email'];
$customer_name  = $customer_id_array['name'];

if (isset($_POST['cancel'])) {

   $fullName = $customer_name;
   $email    = $customer_email;
   $url      = "https://" . $_SERVER['SERVER_NAME'] . "/aanav/orderDetail.php?id=" . $order_id;
   $url2     = "https://" . $_SERVER['SERVER_NAME'] . "/aanav/contact.php";
   $subject  = 'Important update for your order  ORD_' . $order_id;
   $body = '<p style="color:#66FCF1; font-size: 32px;" >Hi ' . $fullName . '</p><p  style="color:grey; font-size: 16px;" >Your order ORD_' . $order_id . ' worth <span style="color:green;" >&#x20B9; ' . $total . '</span> has been cancelled by the vendor.</p> 
    <p><a style="background-color: #66FCF1;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;"
    href="' . $url . '">Order Details</a></p><p  style="color:red; font-size: 10px;" > Need Help ? <a href="' . $url2 . '" >Contact Us</a></p>';

   $sql = "UPDATE orders SET status='0',modified_date=now() WHERE customer_id = '$customer_id' AND status<4 AND order_id=" . $order_id;

   if (mysqli_query($connect, $sql)) {

      $sendEmail->send($fullName, $email, $subject, $body);
      $_SESSION['order'] = "Order has been updated";
      echo '<script>location.href="orderDetail.php?id=' . $order_id . '"</script>';
   }
}

if (isset($_POST['approve'])) {

   $fullName = $customer_name;
   $email    = $customer_email;
   $url      = "https://" . $_SERVER['SERVER_NAME'] . "/aanav/orderDetail.php?id=" . $order_id;
   $url2     = "https://" . $_SERVER['SERVER_NAME'] . "/aanav/contact.php";
   $subject  = 'Important update for your order  ORD_' . $order_id;
   $body = '<p style="color:#66FCF1; font-size: 32px;" >Hi ' . $fullName . '</p><p  style="color:grey; font-size: 16px;" >Your order ORD_' . $order_id . ' worth <span style="color:green;" >&#x20B9; ' . $total . '</span>  has been approved.</p> 
    <p><a style="background-color: #66FCF1;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;"
    href="' . $url . '">Order Details</a></p><p  style="color:red; font-size: 10px;" > Need Help ? <a href="' . $url2 . '" >Contact Us</a></p>';

   $sql = "UPDATE orders SET status='2',modified_date=now() WHERE customer_id = '$customer_id' AND status=1 AND order_id=" . $order_id;

   if (mysqli_query($connect, $sql)) {

      $sendEmail->send($fullName, $email, $subject, $body);
      $_SESSION['order'] = "Order has been updated";
      echo '<script>location.href="orderDetail.php?id=' . $order_id . '"</script>';
   }
}

if (isset($_POST['ship'])) {

   $fullName = $customer_name;
   $email    = $customer_email;
   $url      = "https://" . $_SERVER['SERVER_NAME'] . "/aanav/orderDetail.php?id=" . $order_id;
   $url2     = "https://" . $_SERVER['SERVER_NAME'] . "/aanav/contact.php";
   $subject  = 'Important update for your order  ORD_' . $order_id;
   $body = '<p style="color:#66FCF1; font-size: 32px;" >Hi ' . $fullName . '</p><p  style="color:grey; font-size: 16px;" >Your order ORD_' . $order_id . ' worth <span style="color:green;" >&#x20B9; ' . $total . '</span>  has been shipped successfully.</p> 
    <p><a style="background-color: #66FCF1;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;"
    href="' . $url . '">Order Details</a></p><p  style="color:red; font-size: 10px;" > Need Help ? <a href="' . $url2 . '" >Contact Us</a></p>';

   $sql = "UPDATE orders SET status='3',modified_date=now() WHERE customer_id = '$customer_id' AND status=2 AND order_id=" . $order_id;

   if (mysqli_query($connect, $sql)) {

      $sendEmail->send($fullName, $email, $subject, $body);
      $_SESSION['order'] = "Order has been updated";
      echo '<script>location.href="orderDetail.php?id=' . $order_id . '"</script>';
   }
}

if (isset($_POST['delivery'])) {

   $fullName = $customer_name;
   $email    = $customer_email;
   $url      = "https://" . $_SERVER['SERVER_NAME'] . "/aanav/orderDetail.php?id=" . $order_id;
   $url2     = "https://" . $_SERVER['SERVER_NAME'] . "/aanav/contact.php";
   $subject  = 'Important update for your order  ORD_' . $order_id;
   $body = '<p style="color:#66FCF1; font-size: 32px;" >Hi ' . $fullName . '</p><p  style="color:grey; font-size: 16px;" >Your order ORD_' . $order_id . ' worth <span style="color:green;" >&#x20B9; ' . $total . '</span>  has been delivered successfully.</p> 
    <p><a style="background-color: #66FCF1;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;"
    href="' . $url . '">Order Details</a></p><p  style="color:red; font-size: 10px;" > Need Help ? <a href="' . $url2 . '" >Contact Us</a></p>';

   $sql = "UPDATE orders SET status='4',modified_date=now() WHERE customer_id = '$customer_id' AND status=3 AND order_id=" . $order_id;

   if (mysqli_query($connect, $sql)) {

      $sendEmail->send($fullName, $email, $subject, $body);
      $_SESSION['order'] = "Order has been updated";
      echo '<script>location.href="orderDetail.php?id=' . $order_id . '"</script>';
   }
}

if (isset($_POST['accept'])) {

   $fullName = $customer_name;
   $email    = $customer_email;
   $url      = "https://" . $_SERVER['SERVER_NAME'] . "/aanav/orderDetail.php?id=" . $order_id;
   $url2     = "https://" . $_SERVER['SERVER_NAME'] . "/aanav/contact.php";
   $subject  = 'Important update for your order  ORD_' . $order_id;
   $body = '<p style="color:#66FCF1; font-size: 32px;" >Hi ' . $fullName . '</p><p  style="color:grey; font-size: 16px;" >Your refund has been initiated successfully</p> 
   <p><a style="background-color: #66FCF1;
   border: none;
   color: white;
   padding: 15px 32px;
   text-align: center;
   text-decoration: none;
   display: inline-block;
   font-size: 16px;
   margin: 4px 2px;
   cursor: pointer;
   -webkit-transition-duration: 0.4s;
   transition-duration: 0.4s;"
   href="' . $url . '">Order Details</a></p><p  style="color:red; font-size: 10px;" > Need Help ? <a href="' . $url2 . '">Contact Us</a></p>';

   $sql = "UPDATE orders SET status='6',modified_date=now() WHERE customer_id = '$customer_id' AND status=5 AND order_id=" . $order_id;

   if (mysqli_query($connect, $sql)) {

      $sendEmail->send($fullName, $email, $subject, $body);
      $_SESSION['order'] = "Order has been updated";
      echo '<script>location.href="orderDetail.php?id=' . $order_id . '"</script>';
   }
}
?>

<div class="container">
   <div class="row">
      <div class="col-lg-9 mx-auto my-5 text-center">
         <h2><span class="badge badge-info"><i class="fas fa-box"></i> Order Information</span></h2>
      </div>
      <?php if (isset($_SESSION['order'])) : ?>
         <div class="col-md-6 mx-auto text-center">
            <div class="alert alert-success">
               <?php echo $_SESSION['order']; ?>
            </div>
         </div>
      <?php endif; ?>
      <?php unset($_SESSION['order']); ?>

      <div class="col-lg-12 mx-auto my-3">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <table class="table table-borderless">
                     <tr>
                        <th>Name</th>
                        <td><span class="badge badge-light"><?php echo $order_prop['full_name'] ?></span></td>
                     </tr>
                     <tr>
                        <th>Email</th>
                        <td><span class="badge badge-light"><?php echo $order_prop['email'] ?></span></td>
                     </tr>
                     <tr>
                        <th>Phone</th>
                        <td><span class="badge badge-light"><?php echo $order_prop['phone'] ?></span></td>
                     </tr>
                     <tr>
                        <th>Order placed at</th>
                        <td><span class="badge badge-light"><?php echo $order_prop['created_date'] ?></span></td>
                     </tr>
                     <tr>
                        <th>Order updated at</th>
                        <td><span class="badge badge-light"><?php echo $order_prop['modified_date'] ?></span></td>
                     </tr>
                     <tr>
                        <th>Quantity</th>
                        <td><span class="badge badge-info"><?php echo $order_prop['total_qty'] ?> pcs</span></td>
                     </tr>
                     <tr>
                        <th>Total</th>
                        <td><span class="badge badge-success">&#x20B9;&nbsp;<?php echo $order_prop['total_amt'] ?></span>
                        </td>
                     </tr>
                  </table>
               </div>
               <div class="col-lg-6">
                  <table class="table table-borderless">
                     <?php if ($order_prop['store_id'] == 0) { ?>
                        <tr>
                           <th>Order Status</th>
                           <td>
                              <?php if ($order_prop['status'] == 0) { ?>
                                 <span class="badge  badge-danger">Cancelled</span>

                              <?php } else if ($order_prop['status'] == 1) { ?>
                                 <span class="badge  badge-warning">Placed</span>

                              <?php } else if ($order_prop['status'] == 2) { ?>
                                 <span class="badge  badge-success">Approved</span>

                              <?php } else if ($order_prop['status'] == 3) { ?>
                                 <span class="badge  badge-info">Shipped</span>

                              <?php } else if ($order_prop['status'] == 4) { ?>
                                 <span class="badge  badge-success">Deliverd</span>

                              <?php } else if ($order_prop['status'] == 5) { ?>
                                 <span class="badge  badge-info">Refund Requested</span>

                              <?php } else if ($order_prop['status'] == 6) { ?>
                                 <span class="badge  badge-success">Refunded</span>

                              <?php } else {  ?>
                                 <span class="badge  badge-danger">Error</span>
                              <?php  } ?>
                           </td>
                        </tr>
                        <tr>
                           <th>Payment Type</th>
                           <td><span class="badge badge-light"><?php echo $order_prop['payment_type'] ?></td>
                        </tr>
                        <tr>
                           <th>Delivery Type</th>
                           <td><span class="badge badge-light">Home Delivery </td>
                        </tr>
                        <tr>
                           <th>Address</th>
                           <td><span class="badge badge-light"><?php echo $order_prop['street_address'] ?><?php echo $order_prop['street_address'] ?></td>
                        </tr>
                        <tr>
                           <th>City</th>
                           <td><span class="badge badge-light"><?php echo $order_prop['city'] ?></td>
                        </tr>
                        <tr>
                           <th>State</th>
                           <td><span class="badge badge-light"><?php echo $order_prop['state'] ?></td>
                        </tr>
                        <tr>
                           <th>Pincode</th>
                           <td><span class="badge badge-light"><?php echo $order_prop['pincode'] ?></td>
                        </tr>
                        <tr>


                        <?php } else { ?>
                        <tr>
                           <th>Order Status</th>
                           <td>
                              <?php if ($order_prop['status'] == 0) { ?>
                                 <span class="badge  badge-danger">Cancelled</span>

                              <?php } else if ($order_prop['status'] == 1) { ?>
                                 <span class="badge  badge-warning">Placed</span>

                              <?php } else if ($order_prop['status'] == 2) { ?>
                                 <span class="badge  badge-success">Approved</span>

                              <?php } else if ($order_prop['status'] == 3) { ?>
                                 <span class="badge  badge-info">Shipped</span>

                              <?php } else if ($order_prop['status'] == 4) { ?>
                                 <span class="badge  badge-success">Deliverd</span>

                              <?php } else if ($order_prop['status'] == 5) { ?>
                                 <span class="badge  badge-info">Refund Requested</span>

                              <?php } else if ($order_prop['status'] == 6) { ?>
                                 <span class="badge  badge-success">Refunded</span>

                              <?php } else {  ?>
                                 <span class="badge  badge-danger">Error</span>
                              <?php  } ?>

                           </td>
                        </tr>
                        <tr>
                           <th>Payment Type</th>
                           <td><span class="badge badge-light"><?php echo $order_prop['payment_type'] ?></td>
                        </tr>
                        <tr>
                           <th>Delivery Type</th>
                           <td><span class="badge badge-light">Store Pickup</td>
                        </tr>
                        <?php $store_sql = "SELECT * FROM store WHERE store_id =" . $order_prop['store_id'];
                        $store_query = mysqli_query($connect, $store_sql);
                        $store_row = mysqli_fetch_array($store_query)
                        ?>

                           <tr>
                              <th>Store Name</th>
                              <td><span class="badge badge-light"><?php echo $store_row['store_name'] ?></td>
                           </tr>
                           <tr>
                              <th>Store Email</th>
                              <td><span class="badge badge-light"><?php echo $store_row['email'] ?></td>
                           </tr>
                           <tr>
                              <th>Store Phone</th>
                              <td><span class="badge badge-light"><?php echo $store_row['phone'] ?></td>
                           </tr>
                           <tr>
                              <th>Store Address</th>
                              <td><span class="badge badge-light"><?php echo $store_row['address'] ?></td>
                           </tr>
                     <?php }
                      ?>
                  </table>
               </div>
            </div>
            <div class="col-lg-6 mx-auto mt-5 text-center">

               <a href="invoice.php?id=<?php echo $order_id ?>" class="m-2 btn btn-sm btn-success">
                  <i class="fa fa-download mr-2"></i> <b>&nbsp;Download Invoice</b></a>

               <?php if ($order_prop['status'] > 0 && $order_prop['status'] < 4) {  ?>
                  <form method="post" class="comment-form">
                     <button type="submit" name="cancel" class="m-2 btn btn-sm btn-danger">
                        <i class="fa fa-window-close mr-2"></i><b>&nbsp;Cancel Order</b></button>
                  </form>
               <?php } ?>
               <?php if ($order_prop['status'] == 1) { ?>
                  <form method="post" class="comment-form">
                     <button type="submit" name="approve" class="m-2 btn btn-sm btn-info">
                        <i class="fas fa-check"></i><b>&nbsp;Approve Order</b></button>
                  </form>
               <?php } else if ($order_prop['status'] == 2) { ?>
                  <form method="post" class="comment-form">
                     <button type="submit" name="ship" class="m-2 btn btn-sm btn-info">
                        <i class="fas fa-dolly"></i><b>&nbsp;Confirm Shipping</b></button>
                  </form>
               <?php } else if ($order_prop['status'] == 3) { ?>
                  <form method="post" class="comment-form">
                     <button type="submit" name="delivery" class="m-2 btn btn-sm btn-info">
                        <i class="fas fa-truck"></i><b>&nbsp;Confirm Delivery</b></button>
                  </form>
               <?php } else if ($order_prop['status'] == 5) { ?>
                  <form method="post" class="comment-form">
                     <button type="submit" name="accept" class="m-2 btn btn-sm btn-info">
                        <i class="fas fa-exchange-alt"></i><b>&nbsp;Confirm Return</b></button>
                  </form>
               <?php }  ?>

            </div>
            <div class="col-lg-9 mt-5 mx-auto">
               <div class="table-responsive">
                  <table class='table table-borderless text-center'>
                     <thead>
                        <tr>
                           <th>Product</th>
                           <th>Name</th>
                           <th>Specs</th>
                           <th>Cost</th>
                           <th>Qty</th>
                           <th>Total</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $sql = "SELECT * FROM order_detail WHERE customer_id = '$customer_id' and order_id = '$order_id' ORDER BY order_item_id DESC";
                        $run = mysqli_query($connect, $sql);
                        $count = mysqli_num_rows($run);
                        if (!$count) {
                           echo '<script>
                           location.href="logout.php"
                           </script>';
                        }
                        while ($row = mysqli_fetch_assoc($run)) : {
                              $id = $row['order_item_id'];
                              $pid = $row['product_id'];
                              $vid = $row['variant_id'];


                              $img_sql = mysqli_query($connect, "SELECT file FROM product where id='$pid'");
                              $pro_prop = mysqli_fetch_assoc($img_sql);

                              $result_2 = mysqli_query($connect, "SELECT color,size FROM variant where variant_id='$vid'");
                              $attr_prop = mysqli_fetch_assoc($result_2);
                              $color_id = $attr_prop['color'];
                              $size_id = $attr_prop['size'];

                              $result_3 = mysqli_query($connect, "SELECT value FROM attribute where attr_id='$color_id'");
                              $variant_prop = mysqli_fetch_assoc($result_3);
                              $color = $variant_prop['value'];

                              $result_4 = mysqli_query($connect, "SELECT value FROM attribute where attr_id='$size_id'");
                              $variant_prop = mysqli_fetch_assoc($result_4);
                              $size = $variant_prop['value'];

                        ?>
                              <tr>
                                 <td>
                                    <img width="150" height="150" src="../uploads/<?php echo $pro_prop['file'] ?>" alt="product image"></a></td>
                                 <td>
                                    <span style="font-size: 1.1em;" class="badge  badge-light"><?php echo $row['product_name'] ?></span>
                                 </td>
                                 <td>
                                    <a style="color:white; background-color:<?php echo $color ?>;" class="badge "><b><?php echo $size ?></b></a>
                                 </td>

                                 <td>
                                    <span class="badge  badge-secondary">&#x20B9;&nbsp;<?php echo $row['price'] ?></span>
                                 </td>

                                 <td>
                                    <span class="badge  badge-info">
                                       <?php echo $row['units'] ?></span>
                                 </td>

                                 <td>
                                    <span class="badge  badge-success">&#x20B9;&nbsp;<?php echo $row['total'] ?></span>
                                 </td>
                              </tr>
                        <?php }
                        endwhile; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
</div>
</body>
<script src="https://kit.fontawesome.com/77f6dfd46f.js" crossorigin="anonymous"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</html>