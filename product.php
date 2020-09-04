<?php
include('navbar.php');

$product_id = $_GET['id'];
$find_product_data = "SELECT * FROM product WHERE id = '$product_id' LIMIT 1";
$found_product_data = $connect->query($find_product_data);
$product_id_array = $found_product_data->fetch_assoc();
$product_section = $product_id_array['section'];
$product_brand = $product_id_array['brand'];
$product_categories = $product_id_array['categories'];
$sql = "INSERT INTO search ( product_id, customer_id, section, brand, categories, datetym)
  			VALUES('$product_id', '$customer_id', '$product_section', '$product_brand ','$product_categories',NOW())";
mysqli_query($connect, $sql);

?>
<?php
$email = $_SESSION['email'];
$id = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM product LEFT JOIN section 
    ON section.section_id = product.section WHERE product.id=$id");
$row2 = mysqli_fetch_assoc($result);
$section_id = $row2['section_id'];
$section_name = $row2['section_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php

  $id = $_GET['id'];
  $result = mysqli_query($connect, "SELECT * FROM product WHERE id=$id");
  $product = mysqli_fetch_assoc($result);
  ?>
  <meta name="description" content="<?php echo $product['description']; ?>">
  <meta name="keywords" content="ecommerce, php, wholesale, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $product['name']; ?></title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
  <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="css/nice-select.css" type="text/css">
  <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
  <?php
  $id = $_GET['id'];

  if (!$id) {
    echo "<script>
    document.location='error.php';
    </script>";
  }

  $result = mysqli_query($connect, "SELECT * FROM product WHERE id=$id");
  $row = mysqli_fetch_assoc($result);
  $product_id = $row['id'];
  $section = $row['section'];
  $qty = $row['qty'];
  ?>
  <section class="product-shop carousel-info page-details">
  <?php if (isset($_SESSION['alertMsg'])) : ?>
        <div class="col-md-6 mx-auto text-center">
            <div class="alert alert-danger">
                <?php echo $_SESSION['alertMsg']; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['alertMsg']); ?>
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
                  <img height="100" src="uploads/<?php echo $row2['file'] ?>" alt=""></div>
                  <?php
                  $sql2 = "SELECT * FROM gallery
                              WHERE product_id = $id";
                  $run = mysqli_query($connect, $sql2);
                  while ($row2 = mysqli_fetch_assoc($run)) :
                    { 
                  ?>
                    <div class="pt active" data-imgbigurl="uploads/gallery/<?php echo $row2['image'] ?>">
                      <img height="100" src="uploads/gallery/<?php echo $row2['image'] ?>" alt="gallery"></div>

                  <?php } endwhile; ?>
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


                      <form method="post" action="adding-to-cart.php" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?php echo $id ?>">

                        <?php

                        $sql = "SELECT DISTINCT a.*,p.color,p.product_id FROM variant p
            LEFT JOIN attribute a
            ON p.color = a.attr_id
            WHERE p.product_id = '$id'";
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

                            .custom-radio-button input[type="radio"]:checked+label span {
                              opacity: 1;
                              background: url("https://www.positronx.io/wp-content/uploads/2019/06/tick-icon-4657-01.png") center center no-repeat;
                              width: 35px;
                              height: 35px;
                              display: inline-block;
                            }
                          </style>
                        <?php
                        }
                        ?>
                    </div>
                  </div>
                </div>
                <div class="pd-size-choose">
                  <?php
                  $result = "SELECT * FROM variant where product_id = $id";
                  $sql = mysqli_query($connect, $result);
                  $row = mysqli_fetch_assoc($sql);


                  $sql = "SELECT DISTINCT a.*,p.size,p.product_id FROM variant p
                                     LEFT JOIN attribute a
                                     ON p.size = a.attr_id
                                     WHERE p.product_id = '$id'";

                  $result = mysqli_query($connect, $sql);

                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="sc-item">
 <input type="radio" name="size" value=\'' . $row["value"] . '\' id="' . $row["value"] . '" required>
 <label for="' . $row["value"] . '">' . $row['value'] . '</label>
</div>';
                  }  ?>
                </div>
                <?php
                $s = "SELECT * FROM product WHERE id = '$id'";
                $r = mysqli_query($connect, $s);
                $row_r = mysqli_fetch_assoc($r);
                $product_id = $row_r['id'];
                $customer = $_SESSION['email'];

                $sql_fav = "SELECT * FROM wishlist WHERE customer_id ='$customer_id' AND product_id = '$product_id'";
                $run_fav = mysqli_query($connect, $sql_fav);
                $row_fav = mysqli_fetch_assoc($run_fav);
                $fav = $row_fav['fav_id'];
                ?>

                <p> <?php if ($product['qty'] < 0) {
                      echo "<script>window.open('error.php','_self')</script>";
                    } else {
                      if ( $product['qty'] == 0 ) {
                        echo "<span class='badge badge-info'>Sold Out</span>";
                      } else 
                      if ( $product['qty'] < 0 && $product['qty'] < 10) {
                        echo "<span class='badge badge-info'>Few Left</span>";
                      }
                      else {
                        echo "<span class='badge badge-success'>In Stock</span>";
                      }
                    }
                    ?>
                  <br><br>

                  <?php if ($fav == null) { ?>
                    <a href="update-wishlist.php?user=<?php echo $customer_id ?>&action=add&id=<?php echo $product_id ?>"><i class="far fa-2x fa-heart" style="color:red"></i></a>
                  <?php } else { ?>
                    <a href="update-wishlist.php?user=<?php echo $customer_id ?>&action=remove&id=<?php echo $product_id ?>"><i class="fas fa-2x fa-heart" style="color:red"></i></a>
                  <?php } ?>

                  &emsp;

                  <a rel="noopener noreferrer" href="https://web.whatsapp.com/send?text=urlencodedtext" target="_blank">
                    <i style="color: green;" class="fab fa-2x fa-whatsapp"></i>
                  </a>

                  &emsp;

                  <?php
                  $title = urlencode("REal");
                  $url = urlencode("https://www.daddydesign.com/how-to-create-a-custom-facebook-share-button-with-a-custom-counter/");
                  $summary = urlencode("Learn how to create a custom Facebook 'Share' button, complete with a custom counter, for your website!");
                  $image = urlencode("https://www.daddydesign.com/ClientsTemp/Tutorials/custom-iframe-share-button/images/thumbnail.jpg");
                  ?>
                  <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title; ?>&amp;p[summary]=<?php echo $summary; ?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">

                    <i style="color: blue;" class="fab fa-2x fa-facebook"></i>
                  </a>
                </p>


                <?php
                $sql = "SELECT DISTINCT a.*,p.color,p.product_id FROM variant p
                     LEFT JOIN attribute a
                     ON p.size = a.attr_id
                     WHERE p.product_id = '$id'";

                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) ?>


                <?php if ($qty > 0) { ?>

                  <input type="submit" name="submit" value="Add To Cart" style="clear:both;  border: none;" class="primary-btn pd-cart">
                  </form>

                <?php } else { ?>
                  </form>

                  <?php
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include('similar.php'); ?>
  <?php include('recently-viewed.php'); ?>
  <?php include('footer.php'); ?>