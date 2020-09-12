<?php
require('header.php');
$id = $_GET['id'];
$result = mysqli_query($connect,"SELECT * FROM carousel WHERE carousel_id=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {

    $heading = $_POST['heading'];
    $subheading = $_POST['subheading'];
    $link = $_POST['link'];
    $text = $_POST['text'];
    $temp = explode(".", $_FILES["file"]["name"]);
    $file = round(microtime(true)) . '.' . end($temp);
    $dirpath = realpath(dirname(getcwd()));

    if($_FILES["file"]["name"]){
        move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/" . $file);
    }
    else{
        $file = $row['file'];
    }

    $sql = "UPDATE carousel SET heading='$heading',subheading='$subheading',link='$link',text='$text',
    file='$file',modified_date=now() WHERE carousel_id = $id ";

    $run = mysqli_query($connect, $sql);

    if ($run) {
        echo "<script>window.open('manageCarousel.php','_self')</script>";
       
    } else {
        echo "Error description: " . mysqli_error($connect) ;
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 login-section-wrapper pl-5 p-md-5 pt-2">
            <div class="login-wrapper ml-5">
                
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['carousel_id'] ?>">
                <div class="form-group">
                        <label for="email">Heading</label>
                        <input type="text" name="heading" class="form-control"  value="<?php echo $row['heading'] ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Sub Heading</label>
                        <input type="text" name="subheading" class="form-control"  value="<?php echo $row['subheading'] ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Link</label>
                        <input type="text" name="link" class="form-control"  value="<?php echo $row['link'] ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Text</label>
                        <input type="text" name="text" class="form-control"  value="<?php echo $row['text'] ?>" required />
                    </div>
            </div>
        </div>
        <div class="col-lg-6 login-section-wrapper p-md-5 pt-2">
            <div class="login-wrapper">
            <h2 class="text-center mb-4">
                <span class="badge badge-light">Cover Image</span>
              </h2>
                <file class="main_full">
                    <div class="container-file">
                        <div class="panel">
                        <img class="mb-3" width="200" height="200" src="../uploads/<?php echo $row['file'] ?>" alt="carousel image">
                        <br>   
                            <div class="button_outer">
                                <div class="btn_upload">
                                    <input type="file" id="upload_file" name="file" />
                                <b> Change Image </b>
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
                <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Update">
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