<?php
session_start();
include('../essentials/config.php');
include('sidebar.php');

error_reporting(E_ALL);

if (!isset($_SESSION['admin'])) {
    header('location:logout.php');
}
$id = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM brand WHERE brand_id=$id ");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Brand</title>
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
                    <h1 class="login-title mb-4">Edit Brand</h1>
                        <form class="form-horizontal" method="post" action="updateBrand.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $row['brand_id'] ?>">
                                <label for="email">Brand Title</label>
                                <input type="text" name="name" class="form-control" id="email" value="<?php echo $row['brand_name'] ?>" required />
                            </div>
                            <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>