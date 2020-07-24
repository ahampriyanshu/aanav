<?php
  session_start();
  include('../config/config.php');
  include('../function/function.php');
  include('sidebar.php');
  
if(!isset($_SESSION['admin'])){
echo "not admin";
header('location:login.php');}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="ecommerce in php7 , bootstrap4 and mysql">
  <meta name="keywords" content="amazon clone,flpikart clone, php7, mysql, ecommerce website">
  <meta name="author" content="PriyanshuMay,priyanshumay">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Add Product</title>	
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/add-product.css">
  
</head>
<body >

<div id="content" class="p-5 p-md-5 pt-5">
     
      <div class="row">
        <div class="col-sm-8 login-section-wrapper">
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
                                                <option>Select a Category</option>
                                               <?php
                                                $get_cat = "SELECT * FROM categories";
                                                $run_cat = mysqli_query($mysqli, $get_cat);
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
            <select class="form-control" name="brand">
                                                <option>Select a brand</option>
                                               <?php

                                                $get_brand = "SELECT * FROM brand";
                                                $run_brand = mysqli_query($mysqli, $get_brand);
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
                                          </div> 

                                          <div class="form-group mb-4">
                                          </div> 

                                          <div class="form-group mb-4">
                                          </div> 

                                          <div class="form-group mb-4">
                                          </div> 

              <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Add Product">
            </form>
	        </div>
        </div>

      </div>     
</div>    


<form class="form-horizontal" method="post" action="product_add.php" enctype="multipart/form-data">
              <div class="box-body">
                <!-- FORM START -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Product Title</label>
                  <div class="col-sm-10">
                  <input type="text" name="name"  class="form-control" id="inputEmail3" placeholder="Product Name"/> 
                  </div>
                </div>
                <!-- FORM ENDS -->
                <!-- FORM START -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                  <div class="col-sm-10">
                  <select id="cat" class="form-control" name="cat">
                                                <option>Select a category</option>
                                               <?php
                                                $get_cat = "SELECT * FROM categories";
                                                $run_cat = mysqli_query($mysqli, $get_cat);
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
                </div>

                 <div class="form-group" id="cities-container">
                                 
                                  </div>
                <!-- FORM ENDS -->

                   <!-- FORM START -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Brand</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="brand">
                                                <option>Select a brand</option>
                                               <?php

                                                $get_brand = "SELECT * FROM brand";
                                                $run_brand = mysqli_query($mysqli, $get_brand);
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
                </div>
                <!-- FORM ENDS -->

                 <!-- FORM START -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Supplier</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="supplier">
                                                <option>Select a supplier</option>
                                               <?php

                                                $get_brand = "SELECT * FROM supplier";
                                                $run_brand = mysqli_query($mysqli, $get_brand);
                                                while ($row_brand= mysqli_fetch_array($run_brand)) {
                                                    $brand_id = $row_brand['supplier_id'];
                                                    $brand_title = $row_brand['supplier_name'];

                                                    echo "
                                                    <option value='$brand_id'>$brand_title</option>
                                                  ";
                                                }
                                                ?>
                                          </select> 
                  </div>
                </div>
  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
                  <div class="col-sm-10">
                  <input type="text" name="price"  class="form-control" id="inputEmail3" placeholder="Price"/> 
                  </div>
                </div>
         
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
                  <div class="col-sm-10">
                  <input type="text" name="qty"  class="form-control" id="inputEmail3" placeholder="Qty"/> 
                  </div>
                </div>
       
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                  <textarea type="text" name="description"  class="form-control" id="inputEmail3"/></textarea>
                  </div>
                </div>
                <!-- FORM ENDS -->

                 <div class="form_group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-10">
                            <input type="file" name="cover" >
                            </div>
                            </div>
                            <!-- FORM ENDS -->

               
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" name="submit" class="btn btn-warning pull-right" style="margin: 0 4px">Save</button>
                <a href="home.php" class="btn btn-default pull-right" >Back</a>
              </div>
              <!-- /.box-footer -->
            </form>


</body>
</html>