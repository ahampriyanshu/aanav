<?php
include('boilerplate.php');
?>
<?php if ($total != 0) {
    $total = 0;
    $itemqty = 0;

    echo '<section class="borderless-table carousel-info">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12">';
?>

    <?php if (isset($_SESSION['alertMsg'])) : ?>
        <div class="col-md-6 mx-auto text-center">
            <div class="alert alert-success">
                <?php echo $_SESSION['alertMsg']; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['alertMsg']); ?>

    <?php echo '
                          <div class="cart-table">
                              <table>
                                  <thead>
                                      <tr>
                                          <th>Product</th>
                                          <th>Name</th>
                                          <th>Price</th>
                                          <th>Quantity</th>
                                          <th>Total</th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody>';

    foreach ($_SESSION['cart'] as $variant_id => $quantity) {

        $find_pro_id = mysqli_query($connect, "SELECT * FROM variant WHERE variant_id='$variant_id'");
        $pro_data = mysqli_fetch_assoc($find_pro_id);
        $product_id = $pro_data['product_id'];

        $result = "SELECT  name,code, qty, MRP, cost, file FROM product WHERE id = $product_id";
        $run = mysqli_query($connect, $result);

        if ($run) {
            while ($obj = mysqli_fetch_object($run)) {
                $code = $obj->code;
                $price = $obj->cost * $quantity;
                $total = $total + $price;
                $itemqty = $itemqty + $quantity;
                $color = $pro_data['color'];
                $size = $pro_data['size'];
                $result_c = mysqli_query($connect, "SELECT * FROM attribute where attr_id='$color'");
                $row_c = mysqli_fetch_assoc($result_c);
                $attr = $row_c['attr_id'];
                $value_c = $row_c['value'];
                $result_s = mysqli_query($connect, "SELECT * FROM attribute where attr_id='$size'");
                $row_s = mysqli_fetch_assoc($result_s);
                $attr = $row_s['attr_id'];
                $value_s = $row_s['value'];

                echo '<tr>
                             <td class="cart-pic first-row"><a href="product.php?id=' . $product_id . '" ><img width="150" height="150" src="uploads/' . $obj->file . '" alt="product image"></a></td>
                            <td class="cart-title first-row">
                            <p><span style="font-size:1.1em;" class="badge  badge-light">' . $obj->name . '</span></p>';

                             if ($value_c == 'white') {
                                
                            echo'<span class="badge" style="color:black; background-color:' .$value_c .';">' . $value_s .'</span>';  
                             } else { 
                            echo'<span class="badge" style="color:white; background-color:' .$value_c .';">' . $value_s .'</span>';
                             }
                                      
                                                      echo'</td>
                                                      <td class="total-price first-row">&#x20B9;&nbsp;' . $obj->cost . '
                                                      <strong style="text-decoration: line-through; color:grey; font-size:.8em;">
                                                       &#x20B9;&nbsp;' . $obj->MRP . '</strong></td>
                                                      <td class="qua-col">
                                                      <div class="quantity">
                                                          <div class="pro-qty">
                                                             
                                                      <a  class="dec qtybtn" href="updateCart.php?action=remove&id=' . $variant_id . '">-</a>
                                                             <input type="text" value="' . $quantity . '">
                                                             <a class="inc qtybtn" href="updateCart.php?action=add&id=' . $variant_id . '">+</a>
                                                        </div>
                                                      </div>
                                                  </td>';

                $selling_price = $obj->cost * $quantity;
                $savings = ($obj->MRP - $obj->cost) * $quantity;
                $selling_MRP = $obj->MRP * $quantity;

                echo '<td class="total-price first-row">&#x20B9;&nbsp;' . $selling_price . '
                                                      <strong style="text-decoration: line-through; color:grey; font-size:.8em;"> &#x20B9;&nbsp;' . $selling_MRP . '</strong></td>

                                                      <td class="close-td first-row"><a style="color:grey" href="updateCart.php?action=del&id=' . $variant_id . '"<i class="far fa-trash-alt"></i></a></td>';
            }
        }
    }
    echo '   
    </tr>
    </tbody>
    </table>
    </div>
    <div class="row">
    <div class="cart-buttons">
    <a href="shop.php" class="primary-btn continue-shop">Continue shopping</a>
    <a href="delCart.php" class="primary-btn up-cart">Empty cart</a>
    </div>';
    if (isset($_SESSION['cart'])) {
        $total = 0;
        $itemqty = 0;
        $saving = 0;
        $MRP = 0;


        foreach ($_SESSION['cart'] as $variant_id => $quantity) {

            $find_pro_id = mysqli_query($connect, "SELECT * FROM variant WHERE variant_id='$variant_id'");
            $pro_data = mysqli_fetch_assoc($find_pro_id);
            $product_id = $pro_data['product_id'];

            $result = "SELECT  name, qty, MRP, cost,file FROM product WHERE id = $product_id";
            $run = mysqli_query($connect, $result);

            if ($run) {
                while ($obj = mysqli_fetch_object($run)) {

                    $price = $obj->cost * $quantity;
                    $MRP += $obj->MRP * $quantity;
                    $total += $price;
                    $itemqty += $quantity;
                    $saving = $MRP - $total;
                }
            }
        }

        echo '<div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                <li class="subtotal">Quantity <span>' . $itemqty . '</span></li>
                                <li class="subtotal">Cost<span>&#x20B9;&nbsp;' . $MRP . '</span></li>
                                    <li class="subtotal">Savings <span>&#x20B9;&nbsp;' . $saving . '</span></li>
                                    <li class="cart-total">Total <span>&#x20B9;&nbsp;' . $total . '</span></li>
                                </ul>
                                <a href="checkout.php" class="proceed-btn">CHECK OUT</a>
                            </div>
                        </div>';
    }
} else {
    unset($_SESSION['alertMsg']);
    echo '
              <div class="container">
              <div class="row my-5">
    <div class="col-md-12 text-center">
      <span class="icon-exclamation-triangle display-1 text-danger"></span>
      <h2 class="display-3 text-black">Your cart is empty !</h2>
      <p class="display-5 mb-5">You can check our bestseller section</p>
      <p><a href="index.php" class="btn btn-sm btn-info">Continue Shopping</a></p>
    </div>
  </div>
</div>';
}
?>
</div>
</div>
</div>
</div>
</section>
<?php include('footer.php'); ?>
</body>

</html>