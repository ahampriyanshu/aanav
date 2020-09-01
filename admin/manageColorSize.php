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
    <title>Color and Sizes</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <div id="content" class=" pl-5 p-md-5 pt-2 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto mt-5">
                    <a href="addColorSize.php" class="btn btn-sm btn-success pull-center">
                        <i class="fa fa-plus-square mr-2"></i> <b>Add New</b></a>
                </div>
                <div class="col-lg-4 mx-auto mt-5">
                <h2 class="text-center mb-4">
                <span class="badge  badge-light">Color  Chart</span>                  
                </h2>
                    <div class="table-responsive">
                        <table class='table table-borderless text-center'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>COLOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM attribute WHERE name='color' order by attr_id ASC";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td>
                                        <?php if ($row['value'] == 'white') {
                                            ?>
                                           <span class="badge" style="color:black; background-color:<?php echo $row['value'] ?>;"><?php echo $row['attr_id'] ?></span>  
                                        <?php } else { ?>
                                            <span class="badge" style="color:white; background-color:<?php echo $row['value'] ?>;"><?php echo $row['attr_id'] ?></span>
                                        <?php }
                                           ?>
                                        </td>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['value'] ?></span>
                                        </td>
                                    </tr>
                                <?php

                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4 mx-auto mt-5">
                <h2 class="text-center mb-4">
                <span class="badge  badge-light">Size  Chart</span>                  
                </h2>
                    <div class="table-responsive">
                        <table class='table table-borderless text-center'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>SIZE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM attribute WHERE name='size' order by attr_id ASC";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['attr_id'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info"><?php echo $row['value'] ?></span>
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
    </div>

</body>
<script src="https://kit.fontawesome.com/77f6dfd46f.js" crossorigin="anonymous"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootbox.min.js"></script>
</html>