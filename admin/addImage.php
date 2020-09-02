<?php
session_start();
include('../essentials/config.php');
include('sidebar.php');

error_reporting(E_ALL);

if (!isset($_SESSION['admin'])) {
  header('location:logout.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Add Section</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/admin.css">

</head>

<body>

  <div id="content" class="pl-5 p-md-5 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper pl-5 ">
          <div class="login-wrapper align-content-center">
            <h2 class="text-center mb-4 ">
              <span class="badge badge-light">Add Images</span>
            </h2>

            <?php
            $sql = "SELECT * FROM product
        ORDER BY id DESC LIMIT 1";
            $run = mysqli_query($connect, $sql);
            $row2 = mysqli_fetch_assoc($run);

            if (isset($_POST['submit'])) {

              $id = $_POST['id'];
              $targetFolder = "../uploads/gallery";
              $errorMsg = array();
              $successMsg = array();

              foreach ($_FILES as $file => $fileArray) {

                if (!empty($fileArray['name']) && $fileArray['error'] == 0) {
                  $getFileExtension = pathinfo($fileArray['name'], PATHINFO_EXTENSION);;

                  if (($getFileExtension == 'jpg') || ($getFileExtension == 'jpeg') || ($getFileExtension == 'png') || ($getFileExtension == 'gif') || ($getFileExtension == 'PNG')) {
                    if ($fileArray["size"] <= 5000000) {
                      $breakImgName = explode(".", $fileArray['name']);
                      $imageOldNameWithOutExt = $breakImgName[0];
                      $imageOldExt = $breakImgName[1];
                      $newFileName = strtotime("now") . "." . $imageOldExt;
                      $targetPath = $targetFolder . "/" . $newFileName;
                      if (move_uploaded_file($fileArray["tmp_name"], $targetPath)) {
                        $qry = "insert into gallery (product_id,image) values ('" . $id . "','" . $newFileName . "')";
                        $rs  = mysqli_query($connect, $qry);

                        if ($rs) {
                          $successMsg[$file] = "Image is uploaded successfully";
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
              $result = mysqli_query($connect, "SELECT * FROM product
        ORDER BY id DESC LIMIT 1");
              $row = mysqli_fetch_assoc($result);
              ?>
              <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ?>" />  
              <file class="main_full">
	<div class="container-file">
		<div class="panel">
			<div class="button_outer">
				<div class="btn_upload">
					<input type="file" id="upload_file" name="image_upload-1" required />
					Select Images
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
              <input type="submit" name="submit" value="Add More" class="btn btn-block login-btn">
            <a href="addVariant.php?id=<?php echo $row['id'] ?>" class="btn btn-block login-btn">Step IV</a>
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