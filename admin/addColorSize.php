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
    $value = $_POST['value'];
    $sql = "INSERT INTO attribute (name, value) VALUES ('$name','$value')";
    $run = mysqli_query($connect, $sql);
    echo $name.$value;
    if ($run) {
        header('location:manageColorSize.php');
    } else {
        echo '  <div class="alert alert-danger text-center">
    <strong><i class="fa fa-exclamation-triangle"> </i> Error !</strong>
    </div>';
    }
}
?>
                        <h1 class="login-title mb-4">Add New Color/Size</h1>
                        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="value">Value</label>
                                <input type="text" name="value" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="name">Type</label>
                                <select id="name" class="form-control" name="name" required >
                                                <option>color</option>
                                                <option>size</option>
                                          </select>  
                            </div>
                            <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Add">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>