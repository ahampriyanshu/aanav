<?php
include('boilerplate.php');
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
        display: block;
        text-align: center;
        align-items: center;
        margin-bottom: 100px;
    }

    #radios {
        align-items: center;
        text-align: center;
        margin: 0 auto;
    }

    .radio_container {
        display: flex;
        align-items: center;
        text-align: center;
    }
</style>
<section class="checkout-section spad">
    <div class="container checkout-form">
        <div class="row">
            <div class="col-lg-6">
                <div class="radio_container">
                    <p class="radio_del">Choose Delievery Method</p>
                    <div id="radios">
                        <label for="ship_home">
                            <input type="radio" name="ship" id="ship_home" value="home" required />
                            <span><i class="fas fa-2x fa-truck"></i>sdfsd;</span>
                        </label>
                        <label for="ship_store">
                            <input type="radio" name="ship" id="ship_store" value="store" required />
                            <span><i class="fas fa-2x fa-store"></i> fkodskfosdf</span>
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
                                    url: 'shipping_ajax_request.php',
                                    success: function(returnData) {
                                        $(".saved_address").hide();
                                        $("#del_charge").show();
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
                                    url: 'store_ajax_request.php',
                                    success: function(returnData) {
                                        $("#del_charge").hide();
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
         and email = '$customer' ORDER BY shipping_id DESC";
                    $result = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['shipping_id']; ?>
                        <div class="container" style="margin-bottom: 30px;">
                            <p>
                                <a href="shipping_del.php?id=<?php echo $row['shipping_id'] ?>" class='pull-right' id='del_<?= $id ?>'>Delete</a>
                                <a href="shipping_edit.php?id=<?php echo $row['shipping_id'] ?>" class="pull-right">Edit</a>
                            </p>

                            <input type="hidden" value="<?php echo $row['shipping_id'] ?>">

                            <p><?php echo $row['full_name'] ?></p>

                            <p><?php echo $row['phone'] ?></p>

                            <p><?php echo $row['street_address'] ?>,<?php echo $row['city'] ?>,<?php echo $row['state'] ?>

                                <a href="payment.php?id=<?php echo $row['shipping_id'] ?>" class="btn btn-sm btn-success pull-right">Proceed</a>

                            </p>
                        </div>
                    <?php
                    } ?>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="place-order">
                    <div class="order-total">
                        <ul class="order-table">
                            <li>Product <span>Total</span></li>
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $total = 0;
                                $itemqty = 0;

                                foreach ($_SESSION['cart'] as $variant_id => $quantity) {

                                    $find_pro_id = mysqli_query($connect, "SELECT * FROM variant WHERE pro_attr_id='$variant_id'");
                                    $pro_data = mysqli_fetch_assoc($find_pro_id);
                                    $product_id = $pro_data['product_id'];

                                    $result = "SELECT  name, cost, qty, file FROM product WHERE id = '$product_id'";
                                    $run = mysqli_query($connect, $result);

                                    if ($run) {
                                        while ($obj = mysqli_fetch_object($run)) {
                                            $price = $obj->cost * $quantity;
                                            $total = $total + $price;
                                            $itemqty = $itemqty + $quantity;

                                            echo '
                          <li class="fw-normal">
                          <img src="uploads/' . $obj->file . '" width="25" height="30" alt="cover image">
                          ' . $obj->name . ' x ' . $quantity . ' 
                          <span>&#x20B9;&nbsp;' . $obj->cost . '</span></li>';
                                        }
                                    }
                                }

                                echo '<li class="fw-normal">Subtotal (' . $itemqty . ') <span>&#x20B9;&nbsp; ' . $total . '</span></li>
                  <li class="total-price">Total <span>&#x20B9;&nbsp;' . $total . '</span></li>
                  <li id = "del_charge" class="fw-normal"><span>+ &#x20B9;&nbsp;100 Delivery Charge </span></li>
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