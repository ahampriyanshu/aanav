<?php
session_start();
error_reporting(0);
require_once('essentials/config.php');
date_default_timezone_set('Asia/Kolkata');
if ($_SESSION['email']) {
  $customer = $_SESSION['email'];
  $find_data = "
SELECT * FROM customer WHERE email = '$customer' LIMIT 1
";
  $found_data = $connect->query($find_data);
  $customer_id_array = $found_data->fetch_assoc();
  $_SESSION['id'] = $customer_id_array['id'];
  $customer_id = $customer_id_array['id'];
  $_SESSION['name']  = $customer_id_array['name'];
  $_SESSION['phone']  = $customer_id_array['phone'];
  $customer_created = $customer_id_array['datetym'];
  $customer_login = $customer_id_array['last_login'];
} else {
  $customer_id = '0';
}
?>
<style type="text/css">

input {

  border: none;
  border: none transparent;
  outline: none;
}
  .result {
    width: 100%;
    position: absolute;
    margin: 0;
    opacity: 20;
    z-index: 10;
    font-size: 12px;
    text-transform: uppercase;
    color: #888;
    background: #fff;
    text-align: left;
  } 

  .result p {
    background: #fff;
    color: #888;
    padding: 4px;
    font-weight:bolder;
    border-radius: 2px;

  }

  .result p:nth-child(even) {
    background: #fff;
    color: #888;
  }

  .result p a:hover {
    cursor: pointer;
    color: black !important;
  }

</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
<link rel="stylesheet" href="essentials/fonts/icomoon/style.css">
<link rel="stylesheet" href="essentials/css/bootstrap.min.css">
<link rel="stylesheet" href="essentials/css/magnific-popup.css">
<link rel="stylesheet" href="essentials/css/jquery-ui.css">
<link rel="stylesheet" href="essentials/css/owl.carousel.min.css">
<link rel="stylesheet" href="essentials/css/owl.theme.default.min.css">
<link rel="stylesheet" href="essentials/css/aos.css">
<link rel="stylesheet" href="essentials/css/style.css">

<div class="site-wrap mb-4">
  <header class="site-navbar" role="banner">
    <div class="site-navbar-top">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-center">
            
          <div class="site-block-top-search search-box">
              <input type="text" class="border-0" placeholder="Search" />
              <div class="result"></div>
            </div>
          </div>

          <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
            <a href="index.php" class="js-logo-clone">
            <img src="img/logo_nav.png" alt="logo" width="200" height="95"></a>
          </div>

          <div class="col-6 col-md-4 order-3 order-md-3 text-right">
            <div class="site-top-icons">
              <ul>
                <?php
                if ($_SESSION['email'] == null) {
                  echo "
                <li>
                <a href='login.php'>
                <i class='fas fa-user'></i>
                </a>
                </li>";
                } else {
                  $fav_sql = mysqli_query($connect, "SELECT * FROM wishlist WHERE customer_id=".$_SESSION['id']);
                  $count_fav = mysqli_num_rows($fav_sql);
                  echo '
                  <li>
                  <a href="dashboard.php"><i class="fas fa-user-check"></i></a>
                  </li>
                  <li>
                  <a href="wishlist.php" class="site-cart">
                  <i class="fas fa-heart"></i>
                  <span class="count">' . $count_fav . '</span>
                  </a>
                  </li>';
                } ?>
                <?php
                if (isset($_SESSION['cart'])) {

                  $total = 0;
                  foreach ($_SESSION['cart'] as $variant => $quantity) {
                    $total = $total + $quantity;
                  }
                } else {
                  $total = 0;
                }
                ?>
                <li>
                  <a href="cart.php" class="site-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="count"><?php echo $total; ?></span>
                  </a>
                </li>
                <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><i class="fas fa-bars"></i></a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
    <nav class="site-navigation text-right text-md-center" role="navigation">
      <div class="container">
        <ul class="site-menu js-clone-nav d-none d-md-block">
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="shop.php">Shop</a></li>
          <li><a href="bestSellerPage.php">Bestseller</a></li>
          <li><a href="newArrival.php">New Arrivals</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php
                if ($_SESSION['email'] == null) {
                  echo ' 
                  <li  style="margin-top: 50px;" class="log_button" ><a href="login.php" style="color:red; font-weight:bolder; " class="btn btn-sm pull-center">
                  signin / signup
        </a></li>';
                } else {
                  echo ' 
                  <li  style="margin-top: 50px;" class="log_button" ><a href="logout.php" style="color:red; font-weight:bolder; " class="btn btn-sm pull-center">
                  Logout
        </a></li>';
                } ?>
        </ul>
      </div>
    </nav>
  </header>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.search-box input[type="text"]').on("keyup input", function() {

      var inputVal = $(this).val();
      var resultDropdown = $(this).siblings(".result");
      if (inputVal.length) {
        $.get("backend-search.php", {
          term: inputVal
        }).done(function(data) {

          resultDropdown.html(data);
        });
      } else {
        resultDropdown.empty();
      }
    });

    $(document).on("click", ".result p", function() {
      $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
      $(this).parent(".result").empty();
    });
  });
</script>
<script src="essentials/js/jquery-3.3.1.min.js"></script>
<script src="essentials/js/jquery-ui.js"></script>
<script src="essentials/js/popper.min.js"></script>
<script src="essentials/js/bootstrap.min.js"></script>
<script src="essentials/js/owl.carousel.min.js"></script>
<script src="essentials/js/jquery.magnific-popup.min.js"></script>
<script src="essentials/js/aos.js"></script>
<script src="essentials/js/main.js"></script>