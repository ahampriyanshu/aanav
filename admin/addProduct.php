<?php
require('header.php');
?>
      <?php

      if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $code = $_POST['code'];
        $section = $_POST['cat'];
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

        $sql = "INSERT INTO product (name,code,status,section,categories,brand,supplier,description,MRP,cost,qty,file,created_date,modified_date)
           VALUES ('$name','$code',1,'$section','$categories','$brand','$supplier','$description','$MRP','$cost',0,'$file',NOW(), NOW())";

        $run = mysqli_query($connect, $sql);

        if ($run) {
          echo "<script>window.open('addImage.php','_self')</script>";
        } else {
          echo "error";
        }
      }
      ?>

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 login-section-wrapper pl-5 p-md-5 pt-2">
            <div class="login-wrapper ml-5">
              <h2 class="text-center mb-4">
                <span class="badge badge-light">Step 1</span>
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
                      $id = $row_cat['section_id'];
                      $name = $row_cat['section_name'];

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
                      $category_id = $row_categories['category_id'];
                      $category_name = $row_categories['category_name'];
                      echo "<option value='$category_id'>$category_name</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group mb-4">
                  <label for="email">Brand</label>
                  <select class="form-control" name="brand">
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
          <div class="col-lg-6 login-section-wrapper p-md-5 pt-2">
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
              <main class="main_full">
	<div class="container">
		<div class="panel">
			<div class="button_outer">
				<div class="btn_upload">
					<input type="file" id="upload_file" name="file" required />
					<b> Upload Image </b>
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
</main>
              <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Add Product">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/77f6dfd46f.js" crossorigin="anonymous"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootbox.min.js"></script>
<script src="js/jquery-3.3.1.js"></script>
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