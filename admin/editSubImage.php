<?php
require('header.php');
$id = $_GET['id'];

?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 pt-5 ">
            <div class="login-wrapper align-content-center">
                <h2 class="text-center mb-4 ">
                    <span class="badge badge-light">Add Images</span>
                </h2>

                <?php

                $result = mysqli_query($connect, "SELECT * FROM product where id = $id");
                $row = mysqli_fetch_assoc($result);

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
                    <div class="form-group mb-4">
                        <label for="email">Product Title</label>
                        <input type="text" value="<?php echo $row['name'] ?>" class="form-control" id="email" disabled />
                    </div>
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
                    <input type="submit" name="submit" value="Upload" class="btn btn-block login-btn">
                  
                </form>
            </div>
        </div>
        <div class="col-sm-6 pt-5 ">
        
                        <table class='table table-borderless text-center'>
                            <thead>
                                <tr>
                                    <th>IMAGE</th>
                                    <th>DEL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

$per_page = 12;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$start_from = ($page-1) * $per_page;

                                $query = "SELECT * FROM gallery WHERE product_id='$id' ORDER BY img_id ASC LIMIT $start_from, $per_page";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <tr>
                                        <td>
                                            <img width="150" height="150" src="../uploads/gallery/<?php echo $row['image'] ?>" alt="product image">
                                        </td>
                                        <td>
                                            <a style="color: red; " class='delete' id='del_<?= $row['img_id'] ?>'>
                                               aa <i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php

                                }
                                ?>
                            </tbody>
                        </table>
                    
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
    btnUpload.on("change", function(e) {
        var ext = btnUpload.val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            $(".error_msg").text("Not an Image...");
        } else {
            $(".error_msg").text("");
            btnOuter.addClass("file_uploading");
            setTimeout(function() {
                btnOuter.addClass("file_uploaded");
            }, 3000);
            var uploadedFile = URL.createObjectURL(e.target.files[0]);
            setTimeout(function() {
                $("#uploaded_view").append('<img src="' + uploadedFile + '" />').addClass("show");
            }, 3500);
        }
    });
    $(".file_remove").on("click", function(e) {
        $("#uploaded_view").removeClass("show");
        $("#uploaded_view").find("img").remove();
        btnOuter.removeClass("file_uploading");
        btnOuter.removeClass("file_uploaded");
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.delete').click(function() {
            var el = this;
            var id = this.id;
            var splitid = id.split("_");
            var deleteid = splitid[1];
            bootbox.confirm({
                message: "Do you really want to delete this image?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function(result) {

                    if (result) {

                        $.ajax({
                            url: 'delSubImage.php',
                            type: 'POST',
                            data: {
                                id: deleteid
                            },
                            success: function(response) {


                                if (response == 1) {
                                    $(el).closest('tr').css('background', 'tomato');
                                    $(el).closest('tr').fadeOut(800, function() {
                                        $(this).remove();
                                    });
                                } else {
                                    bootbox.alert('Error ! Record not deleted');
                                }

                            }
                        });
                    }

                }
            });

        });


    });
</script>
</html>