
<div class="container cart-style">
  <div class="row">
    <div class="col-md-9">

<?php
          if(isset($_SESSION['cart'])) {

            $total = 0;
            $itemqty = 0;
      
            foreach($_SESSION['cart'] as $product_id => $quantity) {

            $result = "SELECT  name, qty, price FROM product WHERE id = $product_id";
            $run = mysqli_query($connect,$result);

            if($run){

              while($obj = mysqli_fetch_object($run)) {
                $cost = $obj->price * $quantity; //work out the line cost
                $total = $total + $cost; //add to the total cost
                $itemqty = $itemqty+$quantity;               
              }
            }
          }
           echo "&#x20B9;&nbsp; $total<br>";
          echo "
                <a href='cart.php'>($itemqty) items in your cart</a>";
        }
        ?>

<br>
</div>
  </div>
</div>

 <div class="container">
   <div class="row">
     <div class="col-md-2">

        
       <ul class="cats">
        <li>
            <b><a href="index.php">SHOP BY CATEGORY</a></b>
          </li>
          <?php getcat(); ?>
        </ul><br><br>

        <ul class="cats">
        <li>
            <b><a href="index.php">All Brands</a></b>
          </li>
          
           <?php getbrand(); ?>
        </ul>
     </div> 

     <div class="col-md-10">
      <div class="row">
        <?php product(); ?>
       <?php productsection(); ?>
       <?php productBrand(); ?>
       </div>
     </div>
   </div>
 </div>