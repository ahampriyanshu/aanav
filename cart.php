<?php
  session_start();
  require_once('essentials/config.php');
  error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="ecommerce cart">
    <meta name="keywords" content="Aanav, php, mysql, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <style>

 body{
  text-decoration: none;
}

      </style>
</head>

<body>

    <div id="preloder">
        <div class="loader"></div>
    </div>
<?php    if (isset($_SESSION['cart'])) {
            $variant = $_SESSION['variant'];
              $total = 0;
              $itemqty = 0;

              echo'<section class="shopping-cart spad">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="cart-table">
                              <table>
                                  <thead>
                                      <tr>
                                          <th>Image</th>
                                          <th class="p-name">Product Name</th>
                                          <th>Price</th>
                                          <th>Quantity</th>
                                          <th>Total</th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody>';
            
              foreach ($_SESSION['cart'] as $product_id => $quantity) {
               
                  $result = "SELECT  name,code, qty, MRP, cost, file FROM product WHERE id = $product_id";
                  $run = mysqli_query($mysqli, $result);

                  $email=$_SESSION['email'];

                  if ($run) {
                      while ($obj = mysqli_fetch_object($run)) {
                        $code = $obj->code;
                          $price = $obj->cost * $quantity; //work out the line price

                          $total = $total + $price; //add to the total price
                          $itemqty = $itemqty+$quantity;

                          $color = $_SESSION['color'];
                          $size = $_SESSION['size'];

                          $result_c = mysqli_query($mysqli, "SELECT * FROM attribute where attr_id='$color'");
                          $row_c = mysqli_fetch_assoc($result_c);
                          $attr = $row_c['attr_id'];
                          $value_c = $row_c['value'];

                          $result_s = mysqli_query($mysqli, "SELECT * FROM attribute where attr_id='$size'");
                          $row_s = mysqli_fetch_assoc($result_s);
                          $attr = $row_s['attr_id'];
                          $value_s = $row_s['value'];

echo'<tr>
                                                      <td class="cart-pic first-row"><img width="150" height="150" src="uploads/'.$obj->file.'" alt=""></td>
                                                      <td class="cart-title first-row">
                                                          <h5>Pure Pineapple</h5>
                                                           
                                             <h6 style="color:'.$value_c.';" > '.$value_c.'</h6>
                              <h6 ><strong> '.$value_s.'<strong> </h6>
                              <h6 ><fat> '.$code.'<fat> </h6>
              
                                                      </td>

                                                      <td class="p-price">&#x20B9;&nbsp;'.$obj->cost .'</td>
                                                      
                                                      <td class="qua-col">
                                                      <div class="quantity">
                                                          <div class="pro-qty">
                                                             <a class="inc qtybtn" href="update-cart.php?action=add&id='.$product_id.'">+</a>&nbsp;'.$quantity.'&nbsp;
                                                      <a class="dec qtybtn" href="update-cart.php?action=remove&id='.$product_id.'">-</a></td>
                                                        </div>
                                                      </div>
                                                  </td>';

                                                  $selling_price = $obj->cost * $quantity;
                                                  $savings = ($obj->MRP - $obj->cost) * $quantity;
                                                  $selling_MRP = $obj->MRP * $quantity;

                                                      echo'<td class="total-price first-row">&#x20B9;&nbsp;'.$selling_price.'
                                                      <strong style="text-decoration: line-through; color:grey; font-size:.8em;"> &#x20B9;&nbsp;'.$selling_MRP.'</strong></td>
                                                      <td class="close-td first-row"><a href="update-cart.php?action=del&id='.$product_id.'"<i class="ti-close"></i></a></td>';
                                               

                      }
                  }
              }
              echo'   </tr>
              </tbody>
          </table>
      </div>';
            } else {
              echo "<div class='alert alert-info'><span class='fa fa-exclamation'> You have no items in your shopping cart.</span></div>";
          }  
              ?>

              
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="home.php" class="primary-btn continue-shop">Continue shopping</a>
                                <a href="delete-cart.php" class="primary-btn up-cart">Empty cart</a>
                            </div>
             
                        </div>

                        <?php
      if (isset($_SESSION['cart'])) {
          $total = 0;
          $itemqty = 0;
           
          
          foreach ($_SESSION['cart'] as $product_id => $quantity) {
              $result = "SELECT  name, qty, MRP, cost,file FROM product WHERE id = $product_id";
              $run = mysqli_query($mysqli, $result);
               
              if ($run) {
                  while ($obj = mysqli_fetch_object($run)) {

                      $price = $obj->cost * $quantity; 
                      $saving = ($obj->MRP - $obj->cost) * $quantity;
                      $savings = $savings + $saving;
                      $total = $total + $price; 
                      $itemqty = $itemqty+$quantity;
                  }
              }
          }

                        echo'<div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                <li class="subtotal">Quantity <span>'.$itemqty.'</span></li>
                                    <li class="subtotal">Savings <span>&#x20B9;&nbsp;'.$savings.'</span></li>
                                    <li class="cart-total">Total <span>&#x20B9;&nbsp;'.$total.'</span></li>
                                </ul>
                                <a href="checkout.php" class="proceed-btn">CHECK OUT</a>
                            </div>
                        </div>';
                      }
                      ?>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/jquery.dd.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/vendor/modernizr.js"></script>
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>
    <?php include('footer.php'); ?> 
</body>
</html>
