<?php
if (!isset($_GET['id']))
{
header('location: error.php');
}
include('boilerplate.php');
$id = $_GET['id'];
$sql = "SELECT * FROM shipping where shipping_id=$id";
$run = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($run)) {
$_SESSION['shipping'] = $row['shipping_id'];
}
?>

<style type="text/css">
  @keyframes click-wave {
    0% {
      height: 40px;
      width: 40px;
      opacity: 0.35;
      position: relative;
    }

    100% {
      height: 200px;
      width: 200px;
      margin-left: -80px;
      margin-top: -80px;
      opacity: 0;
    }
  }

  .option-input {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
    appearance: none;
    position: relative;
    top: 13.33333px;
    right: 0;
    bottom: 0;
    left: 0;
    height: 40px;
    width: 40px;
    transition: all 0.15s ease-out 0s;
    background: #cbd1d8;
    border: none;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    margin-right: 0.5rem;
    outline: none;
    position: relative;
    z-index: 1000;
  }

  .option-input:hover {
    background: #9faab7;
  }

  .option-input:checked {
    background: #40e0d0;
  }

  .option-input:checked::before {
    height: 40px;
    width: 40px;
    position: absolute;
    content: '✔';
    display: inline-block;
    font-size: 26.66667px;
    text-align: center;
    line-height: 40px;
  }

  .option-input:checked::after {
    -webkit-animation: click-wave 0.65s;
    -moz-animation: click-wave 0.65s;
    animation: click-wave 0.65s;
    background: #40e0d0;
    content: '';
    display: block;
    position: relative;
    z-index: 100;
  }

  .option-input.radio {
    border-radius: 50%;
  }

  .option-input.radio::after {
    border-radius: 50%;
  }

  .form-check {
    padding: 2rem;
  }

  .form-check {
    display: block;
    line-height: 20px;
  }
</style>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
            <h2>Payment Method</h2>

<div class="form-check">
  <label>
    <input type="radio" class="option-input radio" id="COD_radio" name="COD_radio" />
    Cash On Delivery
  </label>
</div>

<div class="pay-container">
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#COD_radio").change(function() {
      var shippingValidation = $(this).val();

      if (shippingValidation != '') {
        $("#loader").show();
        $(".pay-container").html("");

        $.ajax({
          type: 'post',
          data: {
            shipping_validation: shippingValidation
          },
          url: 'COD.php',
          success: function(returnData) {
            $("#loader").hide();
            $(".pay-container").html(returnData);
          }
        });
      }

    })
  });
</script>
</div>

<style type="text/css">
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

            <div class="col-lg-4">
            <div class="order-sum">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-8">
              <div class="inner-order">
                <?php
                if (isset($_SESSION['cart'])) {

                  $total = 0;
                  $itemqty = 0;


                  foreach ($_SESSION['cart'] as $variant_id => $quantity) {

                    $find_pro_id = mysqli_query($connect,"SELECT * FROM variant WHERE variant_id='$variant_id'");
                    $pro_data = mysqli_fetch_assoc($find_pro_id);
                    $product_id = $pro_data['product_id'];

                    $result = "SELECT  name, qty, cost,file FROM product WHERE id = $product_id";
                    $run = mysqli_query($connect, $result);

                    if ($run) {

                      echo '<ul class="list">';
                      while ($obj = mysqli_fetch_object($run)) {
                        $cost = $obj->cost * $quantity;
                        $total = $total + $cost;
                        $itemqty = $itemqty + $quantity;


                        echo '<li>';
                        echo '<img src="admin/cover/' . $obj->file . '" width="100" height="140" align="right" align="right" alt="">';
                        echo '<b>' . $obj->name . '</b>';
                        echo '<h6 class="my-0">US$' . $obj->cost . '</h6>';
                        echo '<small>quantity: ' . $quantity . '</small>';
                        echo '</li>';
                      }
                      echo '</ul>';
                    }
                  }

                  echo '<table class="table">';
                  echo '<tr>';
                  echo '<td>TOTAL(' . $itemqty . ')</td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td></td>';
                  echo '<td><strong>US$' . $total . '</strong></td>';
                  echo '</tr>';
                  echo '</table>';
                  echo '<br>';
                }
                ?>


              </div>
              <?php
              $shipping = $_SESSION['shipping'];
              $sql = "SELECT * FROM shipping WHERE shipping_id = $shipping";
              $run = mysqli_query($connect, $sql);
              $row = mysqli_fetch_assoc($run);
              ?>
              <div class="shipping_inner">
                <div class="shipping_inner_style">
                  <b>Delivery Location</b><br>
                  <?php echo $row['full_name'] ?><br>
                  <?php echo $row['street_address'] ?><br>
                  <?php echo $row['city'] ?> ,
                  <?php echo $row['state'] ?><br>
                  <span class="fa fa-phone"></span> <?php echo $row['phone'] ?><br>
                  <span class="fa fa-email"></span> <?php echo $row['email'] ?><br>
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

<style type="text/css">
  h3 {
    font-family: AdineuePRO, Helvetica, Verdana, sans-serif;
    font-style: normal;
    color: #000;
    font-size: 18px;
    margin: 15px 0px;
    line-height: 100%;
    font-weight: 600;
    padding: 4px;

  }

  h1 {
    color: #5d6d7e;
    text-align: center;
  }

  .box {
    border-radius: 6px;
    border: 2px solid #009689;
    margin: 8px;
    padding: 8px;
    width: 200px;
    height: 100px;
    text-align: center;
    font-size: 45px;
    background-color: #009688;
  }

  .box a {
    color: white;
  }


  h2 {
    font-size: 26px;
    line-height: 24px;
    letter-spacing: 1.5px;
    font-family: AdineuePRO, Helvetica, Verdana, sans-serif;
    font-style: normal;
    font-weight: 800;
    color: #000;
  }
</style>

<?php include('footer.php'); ?>
