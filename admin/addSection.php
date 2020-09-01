<?php
session_start();
include('../essentials/config.php');
include('sidebar.php');

error_reporting(E_ALL);

if (!isset($_SESSION['admin'])) {
    header('location:logout.php');
}
?>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    $sql = "INSERT INTO section (cat_name,created_date) VALUES ($name,NOW())";
    $run = mysqli_query($connect, $sql);

    if ($run) {
        //   echo "<script>window.open('add-image.php','_self')</script>";
        header('location:manageSection.php');
    } else {
        echo '  <div class="alert alert-danger">
    <strong><i class="fa fa-check-circle-o"> </i> Category Added Successfully</strong>
    </div>';
    }
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

<body>

    <div id="content" class="pl-5 p-md-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 login-section-wrapper pl-5 ">
                    <div class="login-wrapper">
                        <h1 class="login-title mb-4">Add New Section</h1>
                        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email">Section Title</label>
                                <input type="text" name="name" class="form-control" id="email" required />
                            </div>
                            <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Add">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>