<?php
require('header.php');
$id = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM store WHERE store_id=$id ");
$row = mysqli_fetch_assoc($result);
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 mt-5 login-section-wrapper pl-5 ">
                    <div class="login-wrapper">
                    <h1 class="login-title mb-4">Edit Store</h1>
                        <form class="form-horizontal" method="post" action="updateStore.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['store_id'] ?>">
                        <div class="form-group">
                                <label for="email">Store Title</label>
                                <input type="text" name="name"  value="<?php echo $row['store_name'] ?>" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Store Email</label>
                                <input type="text" name="email"  value="<?php echo $row['email'] ?>" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Store Phone</label>
                                <input type="number" name="phone"  value="<?php echo $row['phone'] ?>" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Store Address</label>
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
<script src="https://kit.fontawesome.com/77f6dfd46f.js" crossorigin="anonymous"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootbox.min.js"></script>
</html>