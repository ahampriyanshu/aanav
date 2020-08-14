foreach ($_SESSION['cart'] as $variant_id => $quantity) {

$find_pro_id = mysqli_query($connect,"SELECT * FROM variant WHERE pro_attr_id='$variant_id'");
$pro_data = mysqli_fetch_assoc($find_pro_id);
$product_id = $pro_data['product_id'];

  $result = "SELECT  name,code, qty, MRP, cost, file FROM product WHERE id = $product_id";
  $run = mysqli_query($connect, $result);

  if ($run) {
      while ($obj = mysqli_fetch_object($run)) {
        $code = $obj->code;
          $price = $obj->cost * $quantity; //work out the line price

          $total = $total + $price; //add to the total price
          $itemqty = $itemqty+$quantity;

          $color = $pro_data['product_id'];
          $size =$pro_data['product_id'];

          $result_c = mysqli_query($connect, "SELECT * FROM attribute where attr_id='$color'");
          $row_c = mysqli_fetch_assoc($result_c);
          $attr = $row_c['attr_id'];
          $value_c = $row_c['value'];

          $result_s = mysqli_query($connect, "SELECT * FROM attribute where attr_id='$size'");
          $row_s = mysqli_fetch_assoc($result_s);
          $attr = $row_s['attr_id'];
          $value_s = $row_s['value'];

echo'<tr>
                                      <td class="cart-pic first-row"><img width="150" height="150" src="uploads/'.$obj->file.'" alt=""></td>
                                      <td class="cart-title first-row">
                                          <h5>'.$obj->name.'</h5>
                                           
                             <h6 style="color:'.$value_c.';" > '.$value_c.'</h6>
              <h6 ><strong> '.$value_s.'<strong> </h6>
              <h6 ><fat> '.$code.'<fat> </h6>

                                      </td>

                                      <td class="total-price first-row">&#x20B9;&nbsp;'.$obj->cost.'
                                      <strong style="text-decoration: line-through; color:grey; font-size:.8em;">
                                       &#x20B9;&nbsp;'.$obj->MRP.'</strong></td>
                                      
                                      <td class="qua-col">
                                      <div class="quantity">
                                          <div class="pro-qty">
                                             
                                      <a class="dec qtybtn" href="update-cart.php?action=remove&id='.$variant_id.'">-</a>
                                             <input type="text" value="'.$quantity.'">
                                             <a class="inc qtybtn" href="update-cart.php?action=add&id='.$variant_id.'">+</a>
                                        </div>
                                      </div>
                                  </td>';

                                  $selling_price = $obj->cost * $quantity;
                                  $savings = ($obj->MRP - $obj->cost) * $quantity;
                                  $selling_MRP = $obj->MRP * $quantity;



                                  <?php
 session_start();
 require_once('essentials/config.php');
 error_reporting(E_ALL);
 
 $product_id = $_GET['id'];
 $action = $_GET['action'];
 $product_attribute = $_SESSION['variant'];

 
 echo "product = ".$product_id;
 printf("\n");
 echo "attribute = ".$product_attribute;
 printf("\n");

 if($action === 'empty')
   unset($_SESSION['cart']);

 $result = $connect->query("SELECT qty FROM variant WHERE pro_attr_id = ".$product_attribute);

 if($result){
 
   if($obj = $result->fetch_object()) {
 
     switch($action) {
 
       case "add":
       if($_SESSION['cart'][$product_attribute]+1 <= $obj->qty)
         $_SESSION['cart'][$product_attribute]++;
       break;
 
       case "remove":
       $_SESSION['cart'][$product_attribute]--;
       if($_SESSION['cart'][$product_attribute] == 0)
         unset($_SESSION['cart'][$product_attribute]);
         break;

         case "del":
          unset($_SESSION['cart'][$product_attribute]);
            break; 
     }
   }
 }

print_r($_SESSION['cart']);

header("location: cart.php");
 
?>



<?php
   session_start();
   require_once('essentials/config.php');

     $id = $_POST['id'];
     $color = $_POST['radio_color'];
     $size = $_POST['size'];

    echo $id.$color.$size;
    printf("\n");

     $result = mysqli_query($connect,"SELECT * FROM attribute where value='$color'");
     $row = mysqli_fetch_assoc($result);
     $attr = $row['attr_id'];

     $result2 = mysqli_query($connect,"SELECT * FROM attribute where value='$size'");
     $row2 = mysqli_fetch_assoc($result2);
     $attr2 = $row2['attr_id'];

     echo $attr.$attr2;
     printf("\n"); 

     $_SESSION['color'] = $attr;
     $_SESSION['size'] = $attr2;

     $result3 = mysqli_query($connect,"SELECT * FROM variant where color='$attr' AND size='$attr2' AND product_id = '$id'");
     $row3 = mysqli_fetch_assoc($result3);

     $variant = $row3['pro_attr_id'];

     $_SESSION['variant'] = $variant;
    
     echo "variant = ".$variant;
     printf("\n");

     echo "<script>window.location='update-cart.php?action=add&id=$variant'</script>";

?>