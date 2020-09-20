<?php
require('header.php');
$product_id = $_GET['id'];
?>
<div class="container">
    <div class="row">
        <div class="col-lg-9 mx-auto mt-4 text-center">
            <h2><span class="badge badge-light">Edit Product</span></h2>
        </div>
        <div class="col-lg-9 mx-auto mt-3 text-center">
            <a href="editProduct.php?id=<?php echo $product_id ?>" class="m-2 btn btn-sm btn-success">
                <i class="fas fa-wrench mr-2"></i> <b>Edit Product</b></a>

            <a href="editSubImage.php?id=<?php echo $product_id ?>" class="m-2 btn btn-sm btn-info">
                <i class="fas fa-wrench  mr-2"></i> <b>Update Sub-Images</b></a>

        </div>
        <div class="col-lg-12 mx-auto mt-5">
            <div class="table-responsive">
                <table class='table table-borderless text-center'>
                    <thead>
                        <tr>
                            <th>VARIANT</th>
                            <th>PRODUCT</th>
                            <th>COLOR</th>
                            <th>SIZE</th>
                            <th>UNITS</th>
                            <th>EDIT</th>
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

                        $query = "SELECT * FROM variant WHERE product_id='$product_id'  ORDER BY variant_id ASC LIMIT $start_from, $per_page";
                        $result = mysqli_query($connect, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $color =  $row['color'] ;
                            $size =  $row['size'] ;
                $result_c = mysqli_query($connect, "SELECT * FROM attribute where attr_id='$color'");
                $row_c = mysqli_fetch_assoc($result_c);
                $attr = $row_c['attr_id'];
                $color = $row_c['value'];
                $result_s = mysqli_query($connect, "SELECT * FROM attribute where attr_id='$size'");
                $row_s = mysqli_fetch_assoc($result_s);
                $attr = $row_s['attr_id'];
                $size = $row_s['value'];
                        ?>

                            <tr>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['variant_id'] ?></span>
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['product_id'] ?></span>
                                </td>
                                <td>
                                        <?php if ($color == 'white') {
                                            ?>
                                           <span class="badge" style="color:black; background-color:<?php echo $color ?>;"><?php echo $color ?></span>  
                                        <?php } else { ?>
                                            <span class="badge" style="color:white; background-color:<?php echo $color ?>;"><?php echo $color ?></span>
                                        <?php }
                                           ?>
                                        </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $size  ?></span>
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['qty'] ?></span>
                                </td>
                                <td>
                                    <a style="color: #888;" href="editQuantity.php?id=<?php echo $row['variant_id'] ?>">
                                        <i class="fas fa-wrench"></i></a>
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
<?php
$query = "SELECT * FROM variant WHERE product_id='$product_id' ";
$result = mysqli_query($connect, $query);
$total_posts = mysqli_num_rows($result);
$total_pages = ceil($total_posts / $per_page);
$page_url = $_SERVER['PHP_SELF'];


echo "<div class='center'><div class='pagination justify-content-center'><a href ='$page_url?page=1'>First</a>";

for ($i = 1; $i <= $total_pages; $i++) : ?>

    <a class="<?php if ($page == $i) {
                    echo 'active';
                } ?>" href="<?php echo $page_url ?>?page=<?= $i; ?>"> <?= $i; ?> </a>

<?php endfor;
echo "<a href='$page_url?page=$total_pages' >Last</a></div></div>";
?>
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