<?php
  session_start();
  include('../essentials/config.php');
  include('../essentials/function.php');
  include('sidebar.php');



// Report all errors
error_reporting(E_ALL);


if(!isset($_SESSION['admin'])){
header('location:login.php');}
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
<link rel="stylesheet" type="text/css" href="css/201.css">
<link rel="stylesheet" type="text/css" href="css/display.css">
  <!-- Content Wrapper. Contains page content -->
  
</head>
<body >
  <div class="content-wrapper">



    <div class="col-md-6">
      <!-- Default box -->
      <div class="box box-danger">
       
        <div class="box-header with-border">
          <h3 class="box-title">Image Registration</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      
      
     <?php
    $sql = "SELECT * FROM product
        ORDER BY id DESC LIMIT 1";
        $run = mysqli_query($connect,$sql);
        $row2 = mysqli_fetch_assoc($run);

   if(isset($_POST['submit']))
  {

    $id = $_POST['id'];
    $targetFolder = "../uploads/gallery"; 
    $errorMsg = array();
    $successMsg = array();



    foreach($_FILES as $file => $fileArray)
    {
      
      if(!empty($fileArray['name']) && $fileArray['error'] == 0)
      {
        $getFileExtension = pathinfo($fileArray['name'], PATHINFO_EXTENSION);;

        if(($getFileExtension =='jpg') || ($getFileExtension =='jpeg') || ($getFileExtension =='png') || ($getFileExtension =='gif') || ($getFileExtension =='PNG'))
        {
          if ($fileArray["size"] <= 5000000) 
          {
            $breakImgName = explode(".",$fileArray['name']);
            $imageOldNameWithOutExt = $breakImgName[0];
            $imageOldExt = $breakImgName[1];

            $newFileName = strtotime("now")."-".str_replace(" ","-",strtolower($imageOldNameWithOutExt)).".".$imageOldExt;

            
            $targetPath = $targetFolder."/".$newFileName;

            
            if (move_uploaded_file($fileArray["tmp_name"], $targetPath)) 
            {
              
              $qry ="insert into gallery (product_id,image) values ('".$id."','".$newFileName."')";


              $rs  = mysqli_query($connect, $qry);

              if($rs)
              {
                $successMsg[$file] = "Image is uploaded successfully";
              }
              else
              {
                $errorMsg[$file] = "Unable to save ".$file." file ";
              }
            }
            else
            {
              $errorMsg[$file] = "Unable to save ".$file." file ";    
            }
          } 
          else
          {
            $errorMsg[$file] = "Image size is too large in ".$file;
          }

        }
        else
        {
          $errorMsg[$file] = 'Wrong image format!'.$file.'Try png,jpg , jpeg, and gif!';
        } 
      }
      
    }
  }


?>

   <?php 
    if(isset($successMsg) && !empty($successMsg))
    {
      echo "<div class='alert alert-success'>";
      foreach($successMsg as $sMsg)
      {
        echo "<strong><i class='fa fa-check-square-o'> </i></strong>".$sMsg."<br>";
      }
      echo "</div>";
    }
  ?>
  <?php 
    if(isset($errorMsg) && !empty($errorMsg))
    {
   
      echo "<div class='alert alert-danger'>";
      foreach($errorMsg as $eMsg)
      {
        echo "<strong><i class='fa fa-exclamation-triangle'></i></strong>".$eMsg."<br>";
      }

      echo "</div>";
    }
  ?>
      
   <form name="uploadFile" action="" method="post" enctype="multipart/form-data" id="upload-form">
            <?php 
              $result = mysqli_query($connect,"SELECT * FROM product
        ORDER BY id DESC LIMIT 1");
              $row = mysqli_fetch_assoc($result);
            ?>
                    
                    <input type="hidden" name="id"  class="form-control" value="<?php echo $row['id']?>" />

                   
    <div class="input-files">
    <label>Sub Images</label>
    <input type="file" name="image_upload-1">
    </div>
    <br>
    <input type="submit" name="submit" value="save" class="btn btn-warning">
  

  
    
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a href="add-variant.php?id=<?php echo $row['id'] ?>" class="btn btn-warning pull-right">Continue</a>
        </div>
        <!-- /.box-footer-->
        </form>
  
      </div>
      <!-- /.box -->
        </div><!--  col-md-6 end -->
    </div><!--  row end -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script src="jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      var id = 1;
      $("#moreImg").click(function(){
        var showId = ++id;
        if(showId <=10)
        {
          $(".input-files").append('<input type="file" name="image_upload-'+showId+'">');
          
        }
      });
    });
  </script>
</body>
</html>