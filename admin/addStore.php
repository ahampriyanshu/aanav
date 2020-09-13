<?php
require('header.php');
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 login-section-wrapper pl-5 ">
                    <div class="login-wrapper">
                    <?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO store (store_name, email, phone, address, created_date, modified_date) 
    VALUES ('$name','$email','$phone','$address', NOW(), NOW())";
    $run = mysqli_query($connect, $sql);

    if ($run) {
        header('location:manageStore.php');
    } else {
        echo '  <div class="alert alert-danger text-center">
    <strong><i class="fa fa-exclamation-triangle"> </i> Error !</strong>
    </div>';
    }
}
?>
                        <h1 class="login-title my-4">Add New store</h1>
                        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email">store Title</label>
                                <input type="text" name="name" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">store Email</label>
                                <input type="text" name="email" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">store Phone</label>
                                <input type="number" name="phone" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">store Address</label>
                                <input type="text" name="address" class="form-control" id="email" required />
                            </div>

                            <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Add">
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