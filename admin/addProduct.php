<?php
session_start();
include('../essentials/config.php');
include('sidebar.php');

error_reporting(E_ALL);

if (!isset($_SESSION['admin'])) {
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
  <link rel="stylesheet" href="css/admin.css">

</head>

<body>

  <?php

  if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $code = $_POST['code'];
    $cat = $_POST['cat'];
    $categories = $_POST['categories'];
    $brand = $_POST['brand'];
    $supplier = $_POST['supplier'];
    $MRP = $_POST['MRP'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    $temp = explode(".", $_FILES["file"]["name"]);
    $file = round(microtime(true)) . '.' . end($temp);
    $dirpath = realpath(dirname(getcwd()));

    if ($file) {
      move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/" . $file);
    }

    $sql = "INSERT INTO product (name,code,status,section,categories,brand,supplier,description,MRP,cost,qty,file,created_date)
             VALUES ('$name','$code',1,'$cat','$categories','$brand','$supplier','$description','$MRP','$cost',0,'$file',NOW())";

    $run = mysqli_query($connect, $sql);

    if ($run) {
      echo "<script>window.open('addImage.php','_self')</script>";
    } else {
      echo "error";
    }
  }
  ?>

  <div id="content" class="pl-5 p-md-5 pt-2">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper pl-5 ">
          <div class="login-wrapper">

            <h2 class="text-center mb-4">
              <span class="badge  badge-light">Step 1</span>
            </h2>

            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
              <div class="form-group">
                <label for="email">Title</label>
                <input type="text" name="name" class="form-control" id="email" placeholder="Product Name" required />
              </div>
              <div class="form-group">
                <label for="email">Code</label>
                <input type="text" name="code" class="form-control" id="email" placeholder=" XYZ-000" required />
              </div>
              <div class="form-group mb-4">
                <label for="password">Section</label>
                <select id="email" class="form-control" name="cat">
                  <?php
                  $get_cat = "SELECT * FROM section";
                  $run_cat = mysqli_query($connect, $get_cat);
                  while ($row_cat = mysqli_fetch_array($run_cat)) {
                    $id = $row_cat['cat_id'];
                    $name = $row_cat['cat_name'];

                    echo "<option value='$id'>$name</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="form-group mb-4">
                <label for="password">Category</label>
                <select id="email" class="form-control" name="categories">
                  <?php
                  $get_categories = "SELECT * FROM categories";
                  $run_categories = mysqli_query($connect, $get_categories);
                  while ($row_categories = mysqli_fetch_array($run_categories)) {
                    $sub_id = $row_categories['sub_id'];
                    $sub_name = $row_categories['sub_name'];
                    echo "<option value='$sub_id'>$sub_name</option>";
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
                  while ($row_brand = mysqli_fetch_array($run_brand)) {
                    $brand_id = $row_brand['brand_id'];
                    $brand_title = $row_brand['brand_name'];

                    echo "<option value='$brand_id'>$brand_title</option>";
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
                  while ($row_brand = mysqli_fetch_array($run_brand)) {
                    $supplier_id = $row_brand['supplier_id'];
                    $supplier_title = $row_brand['supplier_name'];

                    echo "<option value='$supplier_id'>$supplier_title</option>";
                  }
                  ?>
                </select>
              </div>
          </div>
        </div>

        <div class="col-sm-6 login-section-wrapper pl-1">
          <div class="login-wrapper">
            <h2 class="text-center mb-4">
              <span class="badge  badge-light">Step 2</span>
            </h2>
            <div class="form-group mb-4">
              <label for="email">Provide A Description</label>
              <textarea type="text" name="description" class="form-control" id="email" rows="4" cols="50" required /> </textarea>
            </div>
            <div class="form-group mb-4">
              <label for="email">Other's Price</label>
              <input type="number" name="MRP" class="form-control" id="email" placeholder="1000" required />
            </div>
            <div class="form-group mb-4">
              <label for="email">Your's Price</label>
              <input type="number" name="cost" class="form-control" id="email" placeholder="750" required />
            </div>
            <file class="main_full">
	<div class="container-file">
		<div class="panel">
			<div class="button_outer">
				<div class="btn_upload">
					<input type="file" id="upload_file" name="file" required />
					Upload Image
				</div>
				<div class="processing_bar"></div>
				<div class="success_box"></div>
			</div>
		</div>
		<div class="error_msg"></div>
		<div class="uploaded_file_view" id="uploaded_view">
			<span class="file_remove">X</span>
		</div>
	</div>
                </file>
            <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Add Product">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  var btnUpload = $("#upload_file"),
		btnOuter = $(".button_outer");
	btnUpload.on("change", function(e){
		var ext = btnUpload.val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
			$(".error_msg").text("Not an Image...");
		} else {
			$(".error_msg").text("");
			btnOuter.addClass("file_uploading");
			setTimeout(function(){
				btnOuter.addClass("file_uploaded");
			},3000);
			var uploadedFile = URL.createObjectURL(e.target.files[0]);
			setTimeout(function(){
				$("#uploaded_view").append('<img src="'+uploadedFile+'" />').addClass("show");
			},3500);
		}
	});
	$(".file_remove").on("click", function(e){
		$("#uploaded_view").removeClass("show");
		$("#uploaded_view").find("img").remove();
		btnOuter.removeClass("file_uploading");
		btnOuter.removeClass("file_uploaded");
  });
</script>
</html>