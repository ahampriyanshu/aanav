 <?php
  session_start();
  require_once('essentials/config.php');

  $email = $_POST['email'];
  $id = $_POST['id'];

  $result = mysqli_query($connect, "SELECT sold_out_id FROM sold_out WHERE email = '$email' AND product_id = '$id' ");
  $num = mysqli_num_rows($result);

  echo $num;

  if ($num > 1) {
    $_SESSION['exist'] = "You have been already notified for this product";
    header("location: product.php?id=$id");
  } else {
    $run = mysqli_query($connect, "INSERT INTO sold_out (email,product_id,created_date) VALUES ('$email','$id',NOW()) ");
    if ($run) {
      $_SESSION['soldOut'] = "You will be notified once the product is back in stock";
      header("location: product.php?id=$id");
    }
  }

  ?>