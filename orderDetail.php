<?php
include('boilerplate.php');

if (!$customer_id) {
echo '<script>
location.href="login.php"
</script>';
}
if (!$_GET['id']) {
    echo '<script>
    location.href="error.php"
    </script>';
}

$order_id = $_GET['id'];

?>
<section class="shopping-cart carousel-info">
              <div class="container">
                  <div class="row">
                
        <?php
        $orders = mysqli_query($connect, "SELECT * FROM orders WHERE customer_id = '$customer_id' and order_id = '$order_id'");
        $order_prop = mysqli_fetch_assoc($orders);
        ?>
                        <div class="col-lg-9 mx-auto my-3" >

                        <p>
                        <span class="badge badge-pill badge-info pull-right mx-3"><?php echo $order_prop['payment_type'] ?></span>
                                <?php if ($order_prop['store_id'] == 0) { ?>
                                    <span class="badge badge-pill badge-secondary  pull-right">Store Pickup</span>

                                <?php } else {
                                    echo '<span class="badge badge-pill badge-secondary  pull-right">Home Delivery</span>';
                                } ?>
                        <span class="badge badge-pill badge-secondary  pull-right"><?php echo $order_prop['total_amt'] ?></span>
                        <span class="badge badge-pill badge-secondary  pull-right"><?php echo $order_prop['total_qty'] ?></span>
                        <span class="badge badge-pill badge-secondary  pull-right"><?php echo $order_prop['created_date'] ?></span>
                        <span class="badge badge-pill badge-secondary  pull-right"><?php echo $order_prop['modified_date'] ?></span>
                        </p>
                    
                            <p><span class="badge badge-pill badge-light">
                            <?php echo $order_prop['full_name'] ?></span></p>
                            <p><span class="badge badge-pill badge-light">
                            <?php echo $order_prop['email'] ?></span></p>
                            <p><span class="badge badge-pill badge-light">
                            <?php echo $order_prop['phone'] ?></span></p>
                            <p>
                            <span class="badge badge-pill badge-light">
                            <?php echo $order_prop['street_address'] ?>,<?php echo $order_prop['city'] ?>,
                            <?php echo $order_prop['state'] ?>,<?php echo $order_prop['pincode'] ?></span>
                            </p>
 
                        </div>

                      <div class="col-lg-9 mx-auto">
                          <div class="cart-table">
                              <table>
                                  <thead>
                                      <tr>
                                      <th>Product</th>
                                          <th>Name</th>
                                          <th>Specs</th>
                                          <th>Cost</th>
                                          <th>Qty</th>
                                          <th>Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
           <?php
           $sql = "SELECT * FROM order_detail WHERE customer_id = '$customer_id' and order_id = '$order_id' 
           ORDER BY order_item_id DESC";
           $run = mysqli_query($connect, $sql);
           $count = mysqli_num_rows($run);
           if (!$count) {
               echo '<script>
               location.href="error.php"
               </script>';
           }
                   while ($row = mysqli_fetch_assoc($run)) : { 
                        $id = $row['order_item_id'];
                        $pid = $row['product_id'];
                        $vid = $row['variant_id'];
                        

                        $img_sql = mysqli_query($connect, "SELECT file FROM product where id='$pid'");
                        $pro_prop = mysqli_fetch_assoc($img_sql);

                        $result_2 = mysqli_query($connect, "SELECT color,size FROM variant where variant_id='$vid'");
                        $attr_prop = mysqli_fetch_assoc($result_2);
                        $color_id = $attr_prop['color'];
                        $size_id = $attr_prop['size'];

                        $result_3 = mysqli_query($connect, "SELECT value FROM attribute where attr_id='$color_id'");
                        $variant_prop = mysqli_fetch_assoc($result_3);
                        $color = $variant_prop['value'];
                        
                        $result_4 = mysqli_query($connect, "SELECT value FROM attribute where attr_id='$size_id'");
                        $variant_prop = mysqli_fetch_assoc($result_4);
                        $size = $variant_prop['value'];

                ?>
 <tr>
                        <td class="cart-pic first-row"><a href="product.php?id=<?php echo $pid ?>" > 
                        <img width="150" height="150" src="uploads/<?php echo $pro_prop['file'] ?>" alt="product image"></a></td>
                           
                            <td class="cart-title first-row">
                            <span style="font-size: 1.1em;" class="badge badge-pill badge-light"><?php echo $row['product_name'] ?></span>
                            </td>
                            <td class="cart-title first-row">
                            <a style="color:white; background-color:<?php echo $color ?>;"
                                                class="badge "><b><?php echo $size ?></b></a>
                                
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge badge-pill badge-info">&#x20B9;&nbsp;<?php echo $row['price'] ?></span>
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge badge-pill badge-light">
                            <?php echo $row['units'] ?></span>
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge badge-pill badge-success">&#x20B9;&nbsp;<?php echo $row['total'] ?></span>
                            </td>


                        </tr>
                    <?php } endwhile; ?>

                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
</section>    
<?php include('footer.php'); ?>