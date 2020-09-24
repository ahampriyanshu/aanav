<?php include('boilerplate.php'); ?>
<?php
if (!$_SESSION['cart'] ) {
    echo '<script>
location.href="cart.php"
</script>';
}
if (!isset($_SESSION['email']) ) {
    echo '<script>
location.href="login.php"
</script>';
}
?>

<style type="text/css">
    #radios label {
        cursor: pointer;
        position: relative;
    }

    #radios label+label {
        margin-left: 50px;
    }

    input[type="radio"] {
        opacity: 0;
        position: absolute;
    }

    input[type="radio"]+span {
        color: #888;
        transition: all 0.4s;
        -webkit-transition: all 0.4s;
    }

    input[type="radio"]:checked+span {
        font-size: 1.5em;
        color: #888;
    }


    .radio_del {
        font-family: Roboto, -apple-system, sans-serif;
        font-weight: 700;
        color: #888;
        margin-bottom: 25px;
    }

    #radios {
        margin-bottom: 25px;
    }

    .radio_container {
        text-align: center;
        align-items: center;
    }
</style>
<section class="checkout-section spad">
    <div class="container checkout-form">
        <div class="row">
            <div class="col-lg-6">
                <div class="radio_container">
                    <h4 class="radio_del">Choose Delievery Method</h4>
                    <div id="radios">
                        <label for="ship_home">
                            <input type="radio" name="ship" id="ship_home" value="home" required />
                            <span>New address<br><i class="fas fa-2x fa-truck"></i></span>
                        </label>
                        <label for="ship_store">
                            <input type="radio" name="ship" id="ship_store" value="store" required />
                            <span>Store Pickup<br><i class="fas fa-2x fa-store-alt"></i></span>
                        </label>
                    </div>
                </div>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#ship_home").change(function() {
                            var shippingValidation = $(this).val();

                            if (shippingValidation != '') {
                                $("#loader").show();
                                $(".address-container").html("");

                                $.ajax({
                                    type: 'post',
                                    data: {
                                        shipping_validation: shippingValidation
                                    },
                                    url: 'formHome.php',
                                    success: function(returnData) {
                                        $(".saved_address").hide();
                                        $(".address-container").html(returnData);
                                    }
                                });
                            }

                        })
                    });


                    $(document).ready(function() {
                        $("#ship_store").change(function() {
                            var shippingValidation = $(this).val();
                            console.log(shippingValidation);
                            if (shippingValidation != '') {
                                $("#loader").show();
                                $(".address-container").html("");

                                $.ajax({
                                    type: 'post',
                                    data: {
                                        shipping_validation: shippingValidation
                                    },
                                    url: 'formStore.php',
                                    success: function(returnData) {
                                        $(".saved_address").hide();
                                        $(".address-container").html(returnData);
                                    }
                                });
                            }

                        })
                    });
                </script>

                <div class="address-container">
                </div>

                <div class="saved_address row">

                    <?php
                    $query = "SELECT * FROM shipping WHERE shipping_type= 'home'
                        and customer_id = '$customer_id' ORDER BY shipping_id DESC";
                    $result = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['shipping_id']; ?>
                        <div class="container" style="margin-bottom: 30px;">
                            <p>
                                <a style="color: #888; margin-left: 10px;" href="delAddress.php?id=<?php echo $row['shipping_id'] ?>" class='pull-right' id='del_<?= $id ?>'>
                                    <i class="far fa-trash-alt"></i></a>
                                <a style="color: #888;  margin-left: 10px;" href="updateAddress.php?id=<?php echo $row['shipping_id'] ?>" class="pull-right">
                                    <i class="fas fa-wrench"></i></a>
                            </p>
                            <input type="hidden" value="<?php echo $row['shipping_id'] ?>">
                            <p><?php echo $row['full_name'] ?></p>
                            <p><?php echo $row['phone'] ?></p>
                            <p><?php echo $row['street_address'] ?>,<?php echo $row['city'] ?>,<?php echo $row['state'] ?>
                                <a href="payment.php?id=<?php echo $row['shipping_id'] ?>" class="btn btn-sm btn-success pull-right">Proceed<i style=" margin-left: 10px;" class="fas fa-arrow-right"></i></a>
                            </p>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-5 ml-auto">
                <div class="place-order">
                    <div class="order-total">
                        <ul class="order-table">
                            <li>Product <span>Total</span></li>
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $total = 0;
                                $itemqty = 0;
                                foreach ($_SESSION['cart'] as $variant_id => $quantity) {

                                    $find_pro_id = mysqli_query($connect, "SELECT * FROM variant WHERE variant_id='$variant_id'");
                                    $pro_data = mysqli_fetch_assoc($find_pro_id);
                                    $product_id = $pro_data['product_id'];
                                    $result = "SELECT  name, cost, qty, file FROM product WHERE id = '$product_id'";

                                    $result_2 = mysqli_query($connect, "SELECT color,size FROM variant where variant_id='$variant_id'");
                                    $attr_prop = mysqli_fetch_assoc($result_2);
                                    $color_id = $attr_prop['color'];
                                    $size_id = $attr_prop['size'];

                                    $result_3 = mysqli_query($connect, "SELECT value FROM attribute where attr_id='$color_id'");
                                    $variant_prop = mysqli_fetch_assoc($result_3);
                                    $color = $variant_prop['value'];
                                    
                                    $result_4 = mysqli_query($connect, "SELECT value FROM attribute where attr_id='$size_id'");
                                    $variant_prop = mysqli_fetch_assoc($result_4);
                                    $size = $variant_prop['value'];

                                    $run = mysqli_query($connect, $result);
                                    if ($run) {
                                        while ($obj = mysqli_fetch_object($run)) {
                                            $price = $obj->cost * $quantity;
                                            $total = $total + $price;
                                            $itemqty = $itemqty + $quantity;
                                            echo '<li class="fw-normal">
                                                <img src="uploads/' . $obj->file . '" width="25" height="30" alt="cover image">
                                                <b>' . $obj->name . '</b>&nbsp;';  
                                                 if ($color == 'white') {
                                
                            echo'<a class="badge" style="color:black; background-color:' .$color .';">' . $size .'</a>';  
                             } else { 
                            echo'<a class="badge" style="color:white; background-color:' .$color .';">' . $size .'</a>';
                             } 
                            echo' (' . $quantity . ')<span>&#x20B9;&nbsp;' . $obj->cost . '</span></li>';
                                        }
                                    }
                                }
                                echo '<li class="fw-normal">Total Quantity<span>' . $itemqty . ' pcs</span></li>
                  <li class="total-price">Total <span class="text-success"> &#x20B9;&nbsp;' . $total . '</span></li>
              </ul>';
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>