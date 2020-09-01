<?php
session_start();
include('../essentials/config.php');
include('sidebar.php');

error_reporting(E_ALL);

if (!isset($_SESSION['admin'])) {
    header('location:logout.php');
}
$id = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM supplier WHERE supplier_id=$id ");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Supplier</title>
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
                    <div class="login-wrapper">
                    <h1 class="login-title mb-4">Edit Supplier</h1>
                        <form class="form-horizontal" method="post" action="updateSupplier.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['supplier_id'] ?>">
                        <div class="form-group">
                                <label for="email">Supplier Title</label>
                                <input type="text" name="name"  value="<?php echo $row['supplier_name'] ?>" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Supplier Email</label>
                                <input type="text" name="email"  value="<?php echo $row['email'] ?>" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Supplier Phone</label>
                                <input type="number" name="phone"  value="<?php echo $row['phone'] ?>" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Supplier Address</label>
                                <input type="text" name="address"  value="<?php echo $row['address'] ?>" class="form-control" id="email" required />
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