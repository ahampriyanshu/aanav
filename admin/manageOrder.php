<?php
require('header.php');
?>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto mt-5 text-center">
                    <a href="addProduct.php" class="m-2 btn btn-sm btn-danger">
                        <i class="fa fa-plus-square mr-2"></i> <b>Cancelled Orders</b></a>

                        <a href="soldOut.php" class="m-2 btn btn-sm btn-success">
                        <i class="fa fa-plus-square mr-2"></i> <b>Completed Orders</b></a>

                        <a href="soldOut.php" class="m-2 btn btn-sm btn-warning">
                        <i class="fa fa-plus-square mr-2"></i> <b>Unapproved Orders</b></a>

                        <a href="deactivatedProduct.php" class="m-2 btn btn-sm btn-info">
                        <i class="fa fa-plus-square mr-2"></i> <b>Refunded Orders</b></a>
                </div>
                <div class="col-lg-12 mx-auto mt-5">
                    <div class="table-responsive">
                        <table class='table table-borderless text-center'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>STATUS</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>TYPE</th>
                                    <th>PAYMENT</th>
                                    <th>UNITS</th>
                                    <th>PRICE</th>
                                    <th>CREATED</th>
                                    <th>MODIFIED</th>
                                    <th>UPDATE</th>
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

                                $query = "SELECT * FROM orders ORDER BY order_id ASC LIMIT $start_from, $per_page";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <tr>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['order_id'] ?></span>
                                        </td>
                                        <td>
                                        <?php if ($row['status'] == 1) { ?>
                                    <span class="badge  badge-warning">Placed</span>

                                <?php } else if ($row['status'] == 2) { ?>
                                    <span class="badge  badge-success">Approved</span>

                                <?php } else if ($row['status'] == 3) { ?>
                                    <span class="badge  badge-info">Deliverd</span>

                                <?php } else if ($row['status'] == 4) { ?>
                                    <span class="badge  badge-success">Refunded</span>

                                <?php } else if ($row['status'] == 0) { ?>
                                    <span class="badge  badge-danger">Cancelled</span>

                                <?php } else {  ?>
                                    <span class="badge  badge-danger">Error</span>
                                <?php  } ?>

                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['full_name'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['email'] ?></span>
                                        </td>
                                        <td>
                                        <?php if ($row['store_id'] == 0) { ?>
                                    <span class="badge badge-light">Store Pickup</span>

                                <?php } else {
                                    echo '<span class="badge badge-light">Home Delivery</span>';
                                } ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['payment_type'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['total_qty'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light">&#x20B9;&nbsp;<?php echo $row['total_amt'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['created_date'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['modified_date'] ?></span>
                                        </td>
                                        <td>
                                            <a style="color: #888; 
                                            " href="editProduct.php?id=<?php echo $row['id'] ?>">
                                                <i class="far fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <a style="color: red; " class='delete' id='del_<?= $row['id'] ?>'>
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
    <?php include('pagination.php'); ?>
    
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
                            url: 'delProduct.php',
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