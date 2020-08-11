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


p {
    font-family: Roboto, -apple-system, sans-serif;
    font-weight: 700;
    color: #888;
    display: flex;
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
<br>
<div class="container">
    <div class="row">
        <div class="col-md-8">

            <div class="row">
                <div class="col-xs-4 ">

                    <div class="radio_container">
                        <p>Choose Delievery Method</p>
                        <div id="radios">
                            <label for="ship_home">
                                <input type="radio" name="ship" id="ship_home" value="home" required />
                                <span><i class="fas fa-2x fa-truck"></i></span>
                            </label>
                            <label for="ship_store">
                                <input type="radio" name="ship" id="ship_store" value="store" required />
                                <span><i class="fas fa-2x fa-store"></i></span>
                            </label>
                        </div>
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
                                    $("#loader").hide();
                                    $(".address-container").html(returnData);
                                }
                            });
                        }

                    })
                });
                </script>
                <script type="text/javascript">
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
                                    $("#loader").hide();
                                    $(".address-container").html(returnData);
                                }
                            });
                        }

                    })
                });
                </script>
            </div><!--  row end -->
            <hr>

            <div class="col-md-12">
                <div class="address-container">
                </div>
            </div>



            <div class="row">

                <?php

        $query = "SELECT * FROM shipping WHERE shipping_type= 'home'
                         and email = '$customer' ORDER BY shipping_id DESC";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['shipping_id']; ?>


                <div class="col-md-4" style="margin-bottom: 8px">
                    <div class="ship">
                        <table class="table">
                            <input type="hidden" value="<?php echo $row['shipping_id'] ?>">
                            <tr>
                                <td>Name</td>
                                <td><small><?php echo $row['full_name'] ?></small></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><small><?php echo $row['street_address'] ?></small></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><small><?php echo $row['phone'] ?></small></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td><small><?php echo $row['city'] ?>,<?php echo $row['state'] ?></small></td>
                            </tr>
                        </table>

                    </div>

                    <br>
                    <a href="payment.php?id=<?php echo $row['shipping_id'] ?>" class="btn btn-warning"
                        style="margin: 0px 0px">Deliver to this address</a><br>
                    <tr>
                        <td> <a href="shipping_edit.php?id=<?php echo $row['shipping_id'] ?>" class="btn btn-default"
                                style="margin-top: 4px; margin-left: 35px">Edit</a></td>
                        <td><a href="shipping_del.php?id=<?php echo $row['shipping_id'] ?>"
                                class='delete btn btn-default' id='del_<?= $id ?>'
                                style="margin-top: 4px; margin-right: 25px">Delete</a></td>
                    </tr>
                </div>
                <?php
        } ?>

            </div><br><br>


        </div>
        <style type="text/css">
        .table td,
        .table th {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #fff;
        }

        .securepayment {
            font-family: "adihausregular", Helvetica, Verdana, sans-serif;
            font-size: 14px;
            line-height: 20px;
            color: #000;
            font-weight: normal;
            padding-top: 0px;
            margin-top: 4px;
        }

        .order-sum {
            background-color: #f2f3f4;
            width: auto;
            height: auto;


        }

        .inner-order {
            background-color: #fff;
            margin-bottom: 20px;

        }

        .shipping_inner {
            font-size: 14px;
            text-align: left;
            padding-top: 0;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .shipping_inner_style {
            padding-left: 8px;
            margin-left: 10px;
        }

        .shipping_inner b {
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
                if (isset($_SESSION['cart'])) {
                  $total = 0;
                  $itemqty = 0;


                  foreach ($_SESSION['cart'] as $product_id => $quantity) {
                    $result = "SELECT  name, cost, qty, file FROM product WHERE id = '$product_id'";
                    $run = mysqli_query($connect, $result);


                    if ($run) {
                      echo '<ul class="list">';
                      while ($obj = mysqli_fetch_object($run)) {
                        $price = $obj->cost * $quantity;
                        $total = $total + $price;
                        $itemqty = $itemqty + $quantity;


                        echo '<li>';
                        echo '<img src="uploads/' . $obj->file . '" width="100" height="140" align="right" align="right" alt="">';
                        echo '<b>' . $obj->name . '</b>';
                        echo '<h6 class="my-0">&#x20B9;&nbsp;' . $obj->cost . '</h6>';
                        echo '<small>quantity: ' . $quantity . '</small>';
                        echo '<a href="cart.php" style="font-size: 12px;">Edit</a>';
                        echo '</li>';
                      }
                      echo '</ul>';
                    }
                  }

                  echo '<table class="table">';
                  echo '<tr>';
                  echo '<td>Total Quantity</td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td><strong>' . $itemqty . '</strong></td>';
                  echo '</tr>';
                  echo '<tr>';
                  echo '<td>Total Sum</td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td><strong>&#x20B9;&nbsp;' . $total . '</strong></td>';
                  echo '</tr>';

                  echo '</table>';
                  echo '<br>';
                }
                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?></body>

</html>