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
    <title>Manage Section</title>
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
                    <a href="addBrand.php" class="btn btn-sm btn-success pull-center">
                        <i class="fa fa-plus-square mr-2"></i> <b>Add New Brand</b></a>
                </div>
                <div class="col-lg-9 mx-auto mt-5">
                    <div class="table-responsive">
                        <table class='table table-borderless text-center'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>CREATED</th>
                                    <th>MODIFIED</th>
                                    <th>UPDATE</th>
                                    <th>DEL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM brand order by brand_id ASC";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <tr>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['brand_id'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge  badge-info"><?php echo $row['brand_name'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['created_date'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['modified_date'] ?></span>
                                        </td>
                                        <td>
                                            <a style="color: #888; 
                                            " href="editBrand.php?id=<?php echo $row['brand_id'] ?>">
                                                <i class="far fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <a style="color: red; " class='delete' id='del_<?= $row['brand_id'] ?>'>
                                                <i class="far fa-trash-alt"></i></a>
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
<script type="text/javascript">
    $(document).ready(function() {

        $('.delete').click(function() {
            var el = this;
            var id = this.id;
            var splitid = id.split("_");
            var deleteid = splitid[1];
            bootbox.confirm({
                message: "Do you really want to delete this record ?",
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
                            url: 'delBrand.php',
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