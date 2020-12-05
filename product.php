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

$product_id = $_GET['id'];
$email = $_SESSION['email'];

if (!$product_id) {
  echo "<script>
    document.location='error.php';
    </script>";
}

$find_product_data = "SELECT * FROM product WHERE id = '$product_id'";
$found_product_data = $connect->query($find_product_data);
$product_id_array = $found_product_data->fetch_assoc();
$product_section = $product_id_array['section'];
$product_brand = $product_id_array['brand'];
$product_category = $product_id_array['category'];
$product_description = $product_id_array['description'];
$product_title  = $product_id_array['name'];
$product_image = $product_id_array['file'];
$sql = "INSERT INTO search ( product_id, customer_id, section, brand, category, datetym) VALUES ('$product_id', '$customer_id', '$product_section', '$product_brand ','$product_category',NOW())";

mysqli_query($connect, $sql);

$result = mysqli_query($connect, "SELECT * FROM product LEFT JOIN section ON section.section_id = product.section WHERE product.id='$product_id'");

$row2 = mysqli_fetch_assoc($result);
$section_id = $row2['section_id'];
$section_name = $row2['section_name'];

$result = mysqli_query($connect, "SELECT * FROM product WHERE id='$product_id'");
$product = mysqli_fetch_assoc($result);

$section = $product['section'];
$qty = $product['qty'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="favicon.ico" sizes="16x16" type="image/png">
  <meta name="description" content="<?php echo $product['description']; ?>">
  <meta name="keywords" content="ecommerce, php, wholesale, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $product['name']; ?></title>
  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
  <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="css/nice-select.css" type="text/css">
  <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <link rel="stylesheet" href="essentials/fonts/icomoon/style.css">
  <link rel="stylesheet" href="essentials/css/bootstrap.min.css">
  <link rel="stylesheet" href="essentials/css/magnific-popup.css">
  <link rel="stylesheet" href="essentials/css/jquery-ui.css">
  <link rel="stylesheet" href="essentials/css/owl.carousel.min.css">
  <link rel="stylesheet" href="essentials/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="essentials/css/aos.css">
  <link rel="stylesheet" href="essentials/css/style.css">

</head>

<body>
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
      font-weight: bolder;
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
  <div class="site-wrap mb-2">
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
                    $fav_sql = mysqli_query($connect, "SELECT * FROM wishlist WHERE customer_id=" . $_SESSION['id']);
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
  <section class="product-shop carousel-info page-details">

    <?php if (isset($_SESSION['alertMsg'])) : ?>
      <div class="col-md-6 mx-auto text-center">
        <div class="alert alert-danger">
          <?php echo $_SESSION['alertMsg']; ?>
        </div>
      </div>
    <?php endif; ?>
    <?php unset($_SESSION['alertMsg']); ?>

    <?php if (isset($_SESSION['soldOut'])) : ?>
      <div class="col-md-6 mx-auto text-center">
        <div class="alert alert-success">
          <?php echo $_SESSION['soldOut']; ?>
        </div>
      </div>
    <?php endif; ?>
    <?php unset($_SESSION['soldOut']); ?>

    <?php if (isset($_SESSION['exist'])) : ?>
      <div class="col-md-6 mx-auto text-center">
        <div class="alert alert-warning">
          <?php echo $_SESSION['exist']; ?>
        </div>
      </div>
    <?php endif; ?>
    <?php unset($_SESSION['exist']); ?>

    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-6">
              <div class="product-pic-zoom">
                <img height="400" class="product-big-img" src="uploads/<?php echo $row2['file'] ?>" alt="main">
              </div>
              <div class="product-thumbs">
                <div class="product-thumbs-track ps-slider owl-carousel">
                  <div class="pt active" data-imgbigurl="uploads/<?php echo $row2['file'] ?>">
                    <img src="uploads/<?php echo $row2['file'] ?>" alt="cover_image"></div>
                  <?php
                  $sql = "SELECT * FROM gallery WHERE product_id = '$product_id' ";
                  $run = mysqli_query($connect, $sql);
                  while ($gallery = mysqli_fetch_assoc($run)) : {
                  ?>
                      <div class="pt active" data-imgbigurl="uploads/gallery/<?php echo $gallery['image'] ?>">
                        <img src="uploads/gallery/<?php echo $gallery['image'] ?>" alt="gallery"></div>

                  <?php }
                  endwhile; ?>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="product-details">
                <div class="pd-title">
                  <span><?php echo $product['code'] ?></span>
                  <h3><?php echo $product['name'] ?></h3>
                </div>
                <div class="pd-desc">
                  <p><?php echo $product['description'] ?></p>
                  <h4>&#x20B9;&nbsp; <?php echo $product['cost'] ?><span>
                      &#x20B9;&nbsp; <?php echo $product['MRP'] ?></span></h4>
                </div>

                <div class="pd-color">

                  <div class="pd-color-choose">

                    <div class="custom-radio-button">

                      <form method="post" action="addCart.php" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?php echo $product_id ?>">

                        <?php
                        $sql = "SELECT DISTINCT a.*,p.color,p.product_id FROM variant p
                        LEFT JOIN attribute a
                        ON p.color = a.attr_id
                        WHERE p.product_id = '$product_id'";
                        $ret = mysqli_query($connect, $sql);
                        $num_results = mysqli_num_rows($ret);
                        for ($i = 0; $i < $num_results; $i++) {
                          $row = mysqli_fetch_array($ret);
                        ?>
                          <input type="radio" id="color-<?php echo $row["value"]; ?>" name="radio_color" value="<?php echo $row["value"]; ?>" required>
                          <label for="color-<?php echo $row["value"]; ?>">
                            <span>
                            </span>
                          </label>
                          &nbsp;
                          <style>
                            .custom-radio-button div {
                              display: inline-block;
                            }

                            .custom-radio-button input[type="radio"] {
                              display: none;
                            }

                            .custom-radio-button input[type="radio"]+label {
                              color: #333;
                              font-family: Arial, sans-serif;
                              font-size: 14px;
                            }

                            .custom-radio-button input[type="radio"]+label span {
                              display: inline-block;
                              width: 35px;
                              height: 35px;
                              margin: -1px 4px 0 0;
                              vertical-align: middle;
                              cursor: pointer;
                              border-radius: 50%;
                              box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
                              background-repeat: no-repeat;
                              background-position: center;
                              text-align: center;
                              line-height: 44px;
                            }

                            .custom-radio-button input[type="radio"]+label span img {
                              opacity: 0;
                              transition: all .4s ease;
                            }

                            .custom-radio-button input[type="radio"]#color-<?php echo $row["value"]; ?>+label span {
                              background-color: <?php echo $row["value"]; ?>;
                            }

                            <?php if ($row["value"] == 'white') { ?>.custom-radio-button input[type="radio"]:checked+label span {
                              opacity: 1;
                              background: url("img/blackCheck.svg");
                              background-position: center;
                              background-repeat: no-repeat;
                              background-size: 50%;
                              width: 35px;
                              height: 35px;
                              display: inline-block;
                            }

                            <?php } else { ?>.custom-radio-button input[type="radio"]:checked+label span {
                              opacity: 1;
                              background: url("img/whiteCheck.png") center center no-repeat;

                              width: 35px;
                              height: 35px;
                              display: inline-block;
                            }

                            <?php } ?>
                          </style>
                        <?php
                        }
                        ?>
                    </div>
                  </div>
                </div>
                <div class="pd-size-choose">
                  <?php
                  $result = "SELECT * FROM variant where product_id = $product_id";
                  $sql = mysqli_query($connect, $result);
                  $row = mysqli_fetch_assoc($sql);


                  $sql = "SELECT DISTINCT a.*,p.size,p.product_id FROM variant p
                                     LEFT JOIN attribute a
                                     ON p.size = a.attr_id
                                     WHERE p.product_id = '$product_id'";

                  $result = mysqli_query($connect, $sql);

                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="sc-item">
 <input type="radio" name="size" value=\'' . $row["value"] . '\' id="' . $row["value"] . '" required>
 <label for="' . $row["value"] . '">' . $row['value'] . '</label>
</div>';
                  }  ?>
                </div>
                <?php
                $sql_fav = "SELECT * FROM wishlist WHERE customer_id ='$customer_id' AND product_id = '$product_id'";
                $run_fav = mysqli_query($connect, $sql_fav);
                $row_fav = mysqli_fetch_assoc($run_fav);
                ?>

                <p> <?php if ($qty < 0) {
                      echo "<script>window.open('error.php','_self')</script>";
                    } else {
                      if ($qty == 0) {
                        echo "<span class='badge badge-info'>Sold Out</span>";
                      } else 
                      if ($qty > 0 && $qty < 10) {
                        echo "<span class='badge badge-info'>Few Left</span>";
                      } else {
                        echo "<span class='badge badge-success'>In Stock</span>";
                      }
                    }
                    ?>
                  <br>
                  <br>
                  <?php if (!$row_fav) { ?>
                    <a href="updateWishlist.php?user=<?php echo $customer_id ?>&action=add&id=<?php echo $product_id ?>"><i class="far fa-2x fa-heart" style="color:red"></i></a>
                  <?php } else { ?>
                    <a href="updateWishlist.php?user=<?php echo $customer_id ?>&action=remove&id=<?php echo $product_id ?>"><i class="fas fa-2x fa-heart" style="color:red"></i></a>
                  <?php } ?>

                  &emsp;

                  <a rel="noopener noreferrer" href="https://wa.me/?text=https://ahampriyanshu.000webhostapp.com/aanav/product.php?id=<?php echo $product_id ?>" target="_blank">
                    <i style="color: green;" class="fab fa-2x fa-whatsapp"></i>
                  </a>

                  &emsp;

                  <a href="https://www.facebook.com/sharer/sharer.php?u=https://ahampriyanshu.000webhostapp.com/aanav/product.php?=<?php echo $product_id ?>&t=<?php echo $product_title ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=900');return false;" target="_blank" title="Share on Facebook" rel="noopener noreferrer">
                    <i style="color: blue;" class="fab fa-2x fa-facebook"></i>
                  </a>
                </p>


                <?php
                $sql = "SELECT DISTINCT a.*,p.color,p.product_id FROM variant p
                     LEFT JOIN attribute a
                     ON p.size = a.attr_id
                     WHERE p.product_id = '$product_id'";

                $result = mysqli_query($connect, $sql);

                $row = mysqli_fetch_assoc($result) ?>


                <?php if ($qty > 0) { ?>

                  <input type="submit" name="submit" value="Add To Cart" style="clear:both;  border: none;" class="primary-btn pd-cart">
                  </form>

                  <?php } else { 

                  $id = $_GET['id'];
                  $result = mysqli_query($connect, "SELECT * FROM product WHERE id=$id");
                  $row = mysqli_fetch_assoc($result);
                  ?>

                  <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['id']; ?>" id="getUser" style="clear:both; background: #48c9b0; 
  border: none; color: #fff; font-size: 14px; padding: 10px;cursor: pointer;">Notify me</button>
                <?php } ?>

                <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h4 class="modal-title">

                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                      </div>
                      <div class="modal-body">
                        <div id="dynamic-content">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="essentials/js/jquery-3.3.1.min.js"></script>
  <script src="essentials/js/jquery-ui.js"></script>
  <script src="essentials/js/popper.min.js"></script>
  <script src="essentials/js/bootstrap.min.js"></script>
  <script src="essentials/js/owl.carousel.min.js"></script>
  <script src="essentials/js/jquery.magnific-popup.min.js"></script>
  <script src="essentials/js/aos.js"></script>
  <script src="essentials/js/main.js"></script>
  <script>
    $(document).ready(function() {

      $(document).on('click', '#getUser', function(e) {

        e.preventDefault();

        var uid = $(this).data('id');

        $('#dynamic-content').html('');
        $('#modal-loader').show();
        $.ajax({
            url: 'notify.php',
            type: 'POST',
            data: 'id=' + uid,
            dataType: 'html'
          })
          .done(function(data) {
            console.log(data);
            $('#dynamic-content').html('');
            $('#dynamic-content').html(data);
            $('#modal-loader').hide();
          })
          .fail(function() {
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
          });

      });

    });
  </script>
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
  <?php include('similar.php'); ?>
  <?php include('recentlyViewed.php'); ?>
  <?php include('footer.php'); ?>