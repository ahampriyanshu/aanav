<?php
require('header.php');
include "../dbConfig.php";
if (isset($_POST['submit'])) {
    $admin = $_POST['name'];
    
    $sendEmail  = new sendEmail;
    $fullName = "Admin";
    $email = "tiwarimay2002@gmail.com";
    $password     = rand();
    $password     = password_hash($password, PASSWORD_DEFAULT);
    $url      = "http://" . $_SERVER['SERVER_NAME'] . "/aanav/admin/2B0A3Wu4JOdrx85RJe1nKed.php?password=" . $password;
    $url2      = "http://" . $_SERVER['SERVER_NAME'] . "/aanav/contact.php";
    $subject  = 'Login Key has been updated';
    $body = '<p style="color:#66FCF1; font-size: 32px;" > Hi Admin</p><p  style="color:grey; font-size: 16px;" > Your new login key is '.$password.'</p> 
    <p><a style="background-color: #66FCF1;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;"
    href="' . $url . '">Admin Login</a></p><p  style="color:red; font-size: 10px;" > Need Help ? <a  href="' . $url2 . '">Contact Us</a></p>';

    $sql = "UPDATE admin SET password='$password' WHERE admin='$admin' ";

    $run = mysqli_query($connect, $sql);

    if ($run) {
        $sendEmail->send($fullName, $email, $subject, $body);
        echo "	alert('<?php echo $password . ' is your new key'; ?>');
        <script>window.open('index.php','_self')</script>";
       
    } else {
        echo "Error description: " . mysqli_error($connect) ;
    }
}
?>
  <div class="container">
            <div class="row">
            <div class="col-lg-12 mx-auto mt-5">
                <h2 class="text-left mb-4">
                <span class="badge badge-warning">Regenerate Key</span>
              </h2>
              <div class="login-wrapper">
                        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email">Enter Secret Code</label>
                                <input type="text" name="name" class="form-control" id="email" required />
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