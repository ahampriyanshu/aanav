<?php
require('header.php');
?>
        <div class="container">
            <div class="row">

            <div class="col-lg-9 mx-auto my-4 text-center">
         <h2><span class="badge badge-light">Sold Out </span></h2>
      </div>

            <div class="col-lg-9 mx-auto text-center">
                    <a href="addProduct.php" class="m-2 btn btn-sm btn-success">
                        <i class="fa fa-plus-square mr-2"></i> <b>Add New Product</b></a>

                        <a href="soldOut.php" class="m-2 btn btn-sm btn-danger">
                        <i class="fa fa-box-open mr-2"></i> <b>Sold Out Product</b></a>

                        <a href="deactivatedProduct.php" class="m-2 btn btn-sm btn-warning">
                        <i class="fa fa-ban mr-2"></i> <b>Deactivated Product</b></a>

                        <a href="notify.php" class="m-2 btn btn-sm btn-info">
                        <i class="fas fa-bell mr-2"></i> <b>Out Of Stock Notification</b></a>
                </div>

                <div class="col-lg-12 mx-auto mt-5">
                    <div class="table-responsive">
                        <table class='table table-borderless text-center'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PRODUCT</th>
                                    <th>NAME</th>
                                    <th>CODE</th>
                                    <th>UNITS</th>
                                    <th>PRICE</th>
                                    <th>CREATED</th>
                                    <th>MODIFIED</th>
                                    <th>EDIT</th>
                                    <th>ENABLE</th>
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

                                $query = "SELECT * FROM product WHERE status=0 ORDER BY id ASC LIMIT $start_from, $per_page";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['id'] ?></span>
                                        </td>
                                        <td>
                                            <img width="150" height="150" src="../uploads/<?php echo $row['file'] ?>" alt="product image">
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['name'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['code'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['qty'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light">&#x20B9;&nbsp;<?php echo $row['cost'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['created_date'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['modified_date'] ?></span>
                                        </td>
                                        <td>
                                            <a style="color: #888; 
                                            " href="editSection.php?id=<?php echo $row['id'] ?>">
                                                <i class="fas fa-wrench"></i></a>
                                        </td>
                                        <td>
                                            <a style="color: green; " class='delete' id='del_<?= $row['id'] ?>'>
                                            <i class="fas fa-undo"></i></a>
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
</html>