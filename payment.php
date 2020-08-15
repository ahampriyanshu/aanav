<?php
include('boilerplate.php');

$id = $_GET['id'];

  $id = $_REQUEST['id'];
  
  $sql = "SELECT * FROM shipping where shipping_id=$id";
  $run =mysqli_query($connect,$sql);
  while($row = mysqli_fetch_assoc($run)){
  $_SESSION['shipping'] = $row['shipping_id'];

?>

<?php } ?>
   
    <br><br>


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


<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2>PAYMENT METHOD</h2> 

<div class="custom-control custom-radio form-check">
  <input type="radio" id="customRadio1" name="customRadio" class="option-input radio">
  <label class="custom-control-label" for="customRadio1"><span class="fa fa-credit-card"></span>  CREDIT CARD</label>
  <div class="card-img">
<img src="https://www.adidas.com/static/on/demandware.static/-/Sites/en_US/dw0ea1ad9f/visa_card_icon_new.png">
<img src="https://www.adidas.com/static/on/demandware.static/-/Sites/en_US/dwe5aabfdc/amex_card_icon.png">
<img src="https://www.adidas.com/static/on/demandware.static/-/Sites/en_US/dw8dd2a717/master_card_icon_new.png">
<img src="https://www.adidas.com/static/on/demandware.static/-/Sites/en_US/dw37610a52/discover_card_icon.png">
</div>
</div>


<div class="custom-control custom-radio">
  <input type="radio" id="customRadio2" name="customRadio" class="option-input radio">
  <label class="custom-control-label" for="customRadio2">Cash in Hand</label>
</div>

      <div class="pay-container">
                
            </div>

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
          url: 'COD.php',
          success:function(returnData){
            $("#loader").hide();  
            $(".pay-container").html(returnData);
          }
        }); 
      }
      
    })
  });

    $(document).ready(function(){
    $("#customRadio1").change(function(){
      var shippingValidation = $(this).val();
      
      if(shippingValidation !='')
      {
        $("#loader").show();
        $(".pay-container").html("");
        
        $.ajax({
          type:'post',
          data:{shipping_validation:shippingValidation},
          url: 'COD.php',
          success:function(returnData){
            $("#loader").hide();  
            $(".pay-container").html(returnData);
          }
        }); 
      }
      
    })
  });

</script>
 
    </div>

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
           
          
            foreach($_SESSION['cart'] as $variant_id => $quantity) {
              $find_pro_id = mysqli_query($connect,"SELECT * FROM variant WHERE pro_attr_id='$variant_id'");
              $pro_data = mysqli_fetch_assoc($find_pro_id);
              $product_id = $pro_data['product_id'];

            $result = "SELECT  product_name, qty, price,cover FROM product WHERE id = $product_id";
            $run = mysqli_query($connect,$result);
               
            if($run){

                echo '<ul class="list">';
              while($obj = mysqli_fetch_object($run)) {
                $cost = $obj->price * $quantity;
                $total = $total + $cost;
                $itemqty = $itemqty+$quantity;
                
                
               echo '<li>';
               echo '<img src="admin/cover/'.$obj->cover.'" width="100" height="140" align="right" align="right" alt="">';
                echo '<b>'.$obj->product_name.'</b>';
                echo '<h6 class="my-0">US$'.$obj->price.'</h6>';
                echo '<small>quantity: '.$quantity.'</small>';
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
          echo '<td><strong>US$'.$total.'</strong></td>';
          echo '</tr>';
          
          echo '</table>';
          echo '<br>';
          
        }
        ?>

    
        </div>
            <?php 
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

          <?php $email = $_SESSION['email']; ?>
          <?php echo "$email"; ?><br>
          <a href="shipping_info.php">Edit</a>
          </div>
          </div>
          </div>
        </div>
      </div>

        </div>
         <div class="securepayment"><span class="fa fa-lock"></span> All transactions are safe and secure</div>
         <br>
         <img src="https://www.adidas.com/static/on/demandware.static/-/Sites-adidas-US-Library/en_US/dw88ec105e/us_payment_methods.png" height="40px">
    </div>
  </div>
</div>








<!--
The MIT License (MIT)

Copyright (c) 2015 William Hilton

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
-->
<!-- Vendor libraries -->



<!-- If you're using Stripe for payments -->
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

<?php include('footer.php'); ?>



