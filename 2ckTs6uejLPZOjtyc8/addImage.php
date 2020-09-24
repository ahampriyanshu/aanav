<?php
require('header.php');
?>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper pt-5 ">
          <div class="login-wrapper align-content-center">
            <h2 class="text-center mb-4 ">
              <span class="badge badge-light">Add Images</span>
            </h2>

            <?php

            if (isset($_POST['submit'])) {

              $id = $_POST['id'];
              $targetFolder = "../uploads/gallery";
              $errorMsg = array();
              $successMsg = array();

              foreach ($_FILES as $file => $fileArray) {

                if (!empty($fileArray['name']) && $fileArray['error'] == 0) {
                  $getFileExtension = pathinfo($fileArray['name'], PATHINFO_EXTENSION);   

                  if (($getFileExtension == 'jpg') || ($getFileExtension == 'jpeg') || ($getFileExtension == 'png') || ($getFileExtension == 'gif') || ($getFileExtension == 'PNG')) {
                    if ($fileArray["size"] <= 5000000) {
                      $breakImgName = explode(".", $fileArray['name']);
                      $imageOldNameWithOutExt = $breakImgName[0];
                      $imageOldExt = $breakImgName[1];
                      $newFileName = strtotime("now") . "." . $imageOldExt;
                      $targetPath = $targetFolder . "/" . $newFileName;
                      if (move_uploaded_file($fileArray["tmp_name"], $targetPath)) {
                        $qry = "INSERT INTO gallery (product_id,image) values ('" . $id . "','" . $newFileName . "')";
                        $rs  = mysqli_query($connect, $qry);

                        if ($rs) {
                          $successMsg[$file] = "Image uploaded successfully";
                        } else {
                          $errorMsg[$file] = "Unable to save " . $file . " file ";
                        }
                      } else {
                        $errorMsg[$file] = "Unable to save " . $file . " file ";
                      }
                    } else {
                      $errorMsg[$file] = "Image size is too large in " . $file;
                    }
                  } else {
                    $errorMsg[$file] = 'Wrong image format!' . $file . 'Try png,jpg , jpeg, and gif!';
                  }
                }
              }
            }


            ?>

            <?php
            if (isset($successMsg) && !empty($successMsg)) {
              echo "<div class='alert alert-success'>";
              foreach ($successMsg as $sMsg) {
                echo "<strong><i class='fa fa-check'> </i> &nbsp;</strong>" . $sMsg . "<br>";
              }
              echo "</div>";
            }
            ?>
            <?php
            if (isset($errorMsg) && !empty($errorMsg)) {

              echo "<div class='alert alert-danger'>";
              foreach ($errorMsg as $eMsg) {
                echo "<strong><i class='fa fa-exclamation-triangle'>&nbsp;</i></strong>" . $eMsg . "<br>";
              }
              echo "</div>";
            }
            ?>

            <form name="uploadFile" action="" method="post" enctype="multipart/form-data" id="upload-form">
              <?php
              $result = mysqli_query($connect, "SELECT * FROM product ORDER BY id DESC LIMIT 1");
              $row = mysqli_fetch_assoc($result);
              ?>
              <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ?>" />  
              <file class="main_full">
	<div class="container-file">
		<div class="panel">
			<div class="button_outer">
				<div class="btn_upload">
					<input type="file" id="upload_file" name="image_upload-1" required />
          <b> Select Images <b> 
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
              <input type="submit" name="submit" value="Add" class="btn btn-block login-btn">
            <a href="addVariant.php?id=<?php echo $row['id'] ?>" class="btn btn-block login-btn">Next</a>
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