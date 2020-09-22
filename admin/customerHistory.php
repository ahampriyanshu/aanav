<?php
require('header.php');
?>

<?php
$id = $_GET['id'];
?>
<div class="container">
    <div class="row">
    <div class="col-lg-9 mx-auto my-4 text-center">
         <h2><span class="badge badge-light">Search History</span></h2>
      </div>
        <div class="col-lg-12 mx-auto mt-5">
            <div class="table-responsive">
                <table class='table table-borderless text-center'>
                    <thead>
                        <tr>
                            <th>PRO ID</th>
                            <th>PRODUCT</th>
                            <th>NAME</th>
                            <th>CODE</th>
                            <th>DATED</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $per_page = 24;

                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $start_from = ($page - 1) * $per_page;

                        $query = "SELECT * FROM search WHERE customer_id='$id' ORDER BY search_id ASC LIMIT $start_from, $per_page";
                        $result = mysqli_query($connect, $query);


                        while ($row = mysqli_fetch_assoc($result)) { 
                            $pro_query = "SELECT * FROM product WHERE  id =".$row['product_id'];
                            $pro_result = mysqli_query($connect, $pro_query);
                            $pro = mysqli_fetch_assoc($pro_result);
                            ?>

                            <tr>
                                <td>
                                    <span class="badge  badge-light"><?php echo $pro['id'] ?></span>
                                </td>
                                <td>
                                    <img width="150" height="150" src="../uploads/<?php echo $pro['file'] ?>" alt="product image">
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $pro['name'] ?></span>
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $pro['code'] ?></span>
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['datetym']  ?></span>
                                </td>
                                <td>
                                    <a style="color: red; " class='delete' id='del_<?= $row['search_id'] ?>'>
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
<?php
$query = "SELECT * from search WHERE customer_id='$id' ";
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
                            url: 'delHistory.php',
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