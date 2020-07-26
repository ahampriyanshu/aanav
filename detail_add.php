<?php
   session_start();
   include('config/config.php');



     $id = $_POST['id'];
     $color = $_POST['rdocolor'];
     $size = $_POST['size'];

     

     // GET COLOR
     $result = mysqli_query($mysqli,"SELECT * FROM attribute where value='$color'");
     $row = mysqli_fetch_assoc($result);
     $attr = $row['attr_id'];
     $attr_img = $row['attr_img'];

     // GET SIZE
     $result2 = mysqli_query($mysqli,"SELECT * FROM attribute where value='$size'");
     $row2 = mysqli_fetch_assoc($result2);
     $attr2 = $row2['attr_id'];
     

     
     $_SESSION['color'] = $attr;
     $_SESSION['size'] = $attr2;

     // Product Attribute
     $result3 = mysqli_query($mysqli,"SELECT * FROM variant where color='$attr' AND size='$attr2' AND product_id = '$id'");
     $row3 = mysqli_fetch_assoc($result3);

     $variant = $row3['pro_attr_id'];

     $_SESSION['variant'] = $variant;

 

             







print_r($_SESSION);
echo "<pre>$id <br>$color <br>Color : <b>$attr</b>, $attr_img <br> SIZE : $attr2
<br> variant : $variant</pre>";


echo "<script>window.location='update-cart.php?action=add&id=$id'</script>";



// header("location: cart.php");