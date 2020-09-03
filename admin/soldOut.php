<?php
require('header.php');
?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto mt-5">
                <h2 class="text-center mb-4">
                <span class="badge badge-warning">Sold Out Products</span>
              </h2>
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
                                    <th>UPDATE</th>
                                    <th>RENEW</th>
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

                                $query = "SELECT * FROM product WHERE qty=0 ORDER BY id ASC LIMIT $start_from, $per_page";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['id'] ?></span>
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
                            url: 'renewProduct.php',
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