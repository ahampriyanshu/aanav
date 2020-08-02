<?php
  session_start();
  include('../essentials/config.php');
  include('../essentials/function.php');
  include('sidebar.php');

error_reporting(E_ALL);

if(!isset($_SESSION['admin']))
{
header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="ecommerce in php7 , bootstrap4 and mysql">
  <meta name="keywords" content="amazon clone,flpikart clone, php7, mysql, ecommerce website">
  <meta name="author" content="PriyanshuMay,priyanshumay">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<title>Add Product</title>	
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/add-product.css">
  
</head>
<body >

<?php

if(isset($_POST['submit'])){

  date_default_timezone_set('Asia/Kolkata');
  $name = $_POST['name'];
  $code = $_POST['code'];
  $cat = $_POST['cat'];
  $categories = $_POST['categories'];
  $brand = $_POST['brand'];
  $supplier = $_POST['supplier'];
  $qty = $_POST['qty'];
  $MRP = $_POST['MRP'] ;
  $cost = $_POST['cost'];
  $description = $_POST['description'];
  $temp = explode(".", $_FILES["file"]["name"]);
  $file = round(microtime(true)) . '.' . end($temp);
  $date = date('d/m/Y h:i:s', time());
  $dirpath = realpath(dirname(getcwd()));

  if ($file) {
    move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/" . $file);
}

  $sql = "INSERT INTO product (name,code,section,categories,brand,supplier,description,MRP,cost,qty,file,created)
             VALUES ('$name','$code','$cat','$categories','$brand','$supplier','$description','$MRP','$cost','$qty','$file','$date')";

  $run=mysqli_query($connect, $sql);

  if ($run) {
      echo "<script>window.open('add-image.php','_self')</script>";
  } else {
      echo "error";
  }
}
?>

<div id="content" class="pl-5 p-md-5 pt-2">
     
      <div class="row">
        <div class="col-sm-6 login-section-wrapper pl-5 ">
          <div class="login-wrapper">
            <h1 class="login-title">Step 1</h1>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
              <div class="form-group">
				<label for="email">Title</label>
        <input type="text" name="name"  class="form-control" id="email" placeholder="Product Name"  required/>  
              </div>
              <div class="form-group">
				<label for="email">Code</label>
        <input type="text" name="code"  class="form-control" id="email" placeholder=" XYZ-000"  required/>  
              </div>
              <div class="form-group mb-4">
				<label for="password">Category</label>
        <select id="email" class="form-control" name="cat">
                                                <option>Select Something</option>
                                               <?php
                                                $get_cat = "SELECT * FROM section";
                                                $run_cat = mysqli_query($connect, $get_cat);
                                                while ($row_cat= mysqli_fetch_array($run_cat)) {
                                                    $id = $row_cat['cat_id'];
                                                    $name = $row_cat['cat_name'];

                                                    echo "
                                                    <option value='$id'>$name</option>
                                                  ";
                                                }
                                                ?>
                                          </select>  
            </div>

        <div class="form-group mb-4">
				<label for="password">Sub - Category</label>
        <select id="email" class="form-control" name="categories">
                                                <option>Select Something</option>
                                               <?php
                                                $get_categories = "SELECT * FROM categoriesogories";
                                                $run_categories = mysqli_query($connect, $get_categories);
                                                while ($row_categories= mysqli_fetch_array($run_categories)) {
                                                    $sub_id = $row_categories['sub_id'];
                                                    $sub_name = $row_categories['sub_name'];

                                                    echo "
                                                    <option value='$sub_id'>$sub_name</option>
                                                  ";
                                                }
                                                ?>
                                          </select>  
            </div>

            <div class="form-group mb-4">
            <label for="email">Brand</label>
            <select class="form-control" name="brand">
                                                <option>Select a brand</option>
                                               <?php

                                                $get_brand = "SELECT * FROM brand";
                                                $run_brand = mysqli_query($connect, $get_brand);
                                                while ($row_brand= mysqli_fetch_array($run_brand)) {
                                                    $brand_id = $row_brand['brand_id'];
                                                    $brand_title = $row_brand['brand_name'];

                                                    echo "
                                                    <option value='$brand_id'>$brand_title</option>
                                                  ";
                                                }
                                                ?>
                                          </select>
                                          </div> 

                                          <div class="form-group mb-4">
                                          <label for="email">Supplier</label>
                                          <select class="form-control" name="supplier">
                                                <option>Select a supplier</option>
                                               <?php

                                                $get_brand = "SELECT * FROM supplier";
                                                $run_brand = mysqli_query($connect, $get_brand);
                                                while ($row_brand= mysqli_fetch_array($run_brand)) {
                                                    $supplier_id = $row_brand['supplier_id'];
                                                    $supplier_title = $row_brand['supplier_name'];

                                                    echo "
                                                    <option value='$supplier_id'>$supplier_title</option>
                                                  ";
                                                }
                                                ?>
                                          </select> 
                                          </div> 
                                          </div>
                                          </div>

      <div class="col-sm-6 login-section-wrapper pl-1">
          <div class="login-wrapper">
            <h1 class="login-title">Step 2</h1> 


            <div class="form-group mb-4">
                                          <label for="email">Quantity</label>
                                          <input type="number" name="qty" class="form-control" id="email" placeholder="200" required/> 
                                          </div> 

                                          <div class="form-group mb-4">
                                          <label for="email">Other's Price</label>
                                          <input type="number" name="MRP"  class="form-control" id="email" placeholder="1000"required/>  
                                          </div> 

                                          <div class="form-group mb-4">
                                          <label for="email">Your's Price</label>
                                          <input type="number" name="cost"  class="form-control" id="email" placeholder="750"required/>  
                                          </div> 

                                          <div class="form-group mb-4">
                                          <label for="email">Provide A Description</label>
                                          <textarea type="text" name="description"  class="form-control" id="email" rows="4" cols="50" required/> </textarea>
                                          </div> 

                                          <div class="form-group mb-4">
                                          <label for="email">Cover Image</label>
                                          <input type="file" name="file" id="email" required />
                                          </div> 

              <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Add Product">
            </form>
	        </div>
        </div>

      </div>     
</div>    

<?php include('footer.php'); ?></body>
</html>