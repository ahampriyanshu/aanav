<?php
   session_start();
   require_once('essentials/config.php');

     $id = $_POST['id'];
     $color = $_POST['radio_color'];
     $size = $_POST['size'];

     $result = mysqli_query($connect,"SELECT * FROM attribute where value='$color'");
     $row = mysqli_fetch_assoc($result);
     $color_attr = $row['attr_id'];

     $result2 = mysqli_query($connect,"SELECT * FROM attribute where value='$size'");
     $row2 = mysqli_fetch_assoc($result2);
     $size_attr = $row2['attr_id'];

     $result3 = mysqli_query($connect,"SELECT * FROM variant where color='$color_attr' AND size='$size_attr' AND product_id = '$id'");
     $row3 = mysqli_fetch_assoc($result3);

     if ($row3){
     $variant_id = $row3['variant_id'];
     echo "<script>
     window.location='updateCart.php?action=add&id=$variant_id';
     </script>";
     }
     else
     {
      $_SESSION['alertMsg'] = "Selected Variant is currently out of stock! Please try different color or size!";
      echo "<script>
      window.location='product.php?id=$id';
      </script>";
     }
?>