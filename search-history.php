<?php
   session_start();
   require_once('essentials/config.php');
   date_default_timezone_set('Asia/Kolkata');
   error_reporting(E_ALL);
if($_SESSION['email']){
    $customer = $_SESSION['email'];

    $find_data = "
SELECT * FROM customer WHERE email = '$customer' LIMIT 1
";
    $found_data =$connect->query($find_data);
    $customer_id_array = $found_data ->fetch_assoc();
    $customer_id = $customer_id_array['id'];
}
else{
  $customer_id = '0';
}

  $product_id = $_GET['id'];

  $find_product_data = "SELECT * FROM product WHERE id = '$product_id' LIMIT 1";

      $found_product_data =$connect->query($find_product_data);
      $product_id_array = $found_product_data ->fetch_assoc();
      $product_section = $product_id_array['section'];
      $product_brand = $product_id_array['brand'];
      $product_categories = $product_id_array['categories'];

    $sql = "INSERT INTO search ( product_id, customer_id, section, brand, categories, datetym)
  			VALUES('$product_id', '$customer_id', '$product_section', '$product_brand ',
              '$product_categories',NOW())";

echo $sql;

        mysqli_query($connect, $sql);
     

    header('location: product.php?id='.$product_id);
    ?>