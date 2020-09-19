<?php
require('header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-9 mx-auto my-4 text-center">
            <h2><span class="badge badge-success">Vendor Messages</span></h2>
        </div>
        <div class="col-lg-9 mx-auto text-center">
            <a href="customerMessages.php" class="m-2 btn btn-sm btn-info">
                <i class="fa fa-exclamation-triangle mr-2"></i> <b>Customer Messages</b></a>

        </div>
        <div class="col-lg-12  mt-5">
            <div class="table-responsive">
                <table class='table table-borderless text-center'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHONE</th>
                            <th>SENT ON</th>
                            <th>VEIW</th>
                            <th>DELETE</th>
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
                        $start_from = ($page - 1) * $per_page;
                        $query = "SELECT * FROM msg WHERE type='work' ORDER BY msg_id DESC LIMIT $start_from, $per_page";
                        $result = mysqli_query($connect, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <tr>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['msg_id'] ?></span>
                                </td>

                                <td>
                                    <span class="badge  badge-light"><?php echo $row['name'] ?></span>
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['email'] ?></span>
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['phone'] ?></span>
                                </td>
                              
                                <td>
                                <span class="badge  badge-light"><?php echo $row['created_date'] ?></span>
                                </td>

                                <td>
                                    <a style="color:#333;" href="viewMessage.php?id=<?php echo $row['msg_id'] ?>">
                                        <i class="fas fa-envelope-open-text"></i></a>
                                </td>
                                <td>
                                <a style="color: red; " class='disable' id='disable_<?= $row['msg_id'] ?>'>
                                <i class="far fa-trash-alt"></i></i></a>
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

        $('.disable').click(function() {
            var el = this;
            var id = this.id;
            var splitid = id.split("_");
            var deleteid = splitid[1];
            bootbox.confirm({
                message: "Do you really want to delete this message ?",
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
                            url: 'delMessage.php',
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
                                    bootbox.alert('Error! Query Not Executed');
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