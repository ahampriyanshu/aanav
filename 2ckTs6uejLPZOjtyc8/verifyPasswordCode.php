<?php
require_once('essentials/config.php');
include "dbConfig.php";
if (isset($_SESSION['email'])) :
    header("location: index.php");
  endif;
if(isset($_GET['code'])){
$code = $_GET['code'];

$verify = mysqli_query($connect, "SELECT * FROM customer WHERE code='$code' and status <= 1");
if (mysqli_num_rows($verify) < 1) {
    header('location:error.php');
}
}
else
{
    header('location:error.php');
}


$validation = new validation;
$queries    = new queries;

if (isset($_POST['submit'])) {
  $validation->validate('newpass', 'New Password', 'required|min_len|6');
  $validation->validate('cnfrmpass', 'Confirm Password', 'required|min_len|6');
  if ($validation->run()) {

    $newpass = $validation->input('newpass');
    $cnfrmpass = $validation->input('cnfrmpass');

        if ($newpass == $cnfrmpass) {
            $newpass = password_hash($newpass, PASSWORD_DEFAULT);
            $update = mysqli_query($connect, "UPDATE customer SET password = '$newpass' WHERE id='$id'");
            $_SESSION['emailVerified'] = "Password successfully changed.";
            echo "<script>
            header('location:login.php');
      </script>";
          }
        }
        else{
          $_SESSION['unmatched'] = "New password and confirm password did not match"; 
        }
  }
?>
  <link rel="stylesheet" href="css/login.css">
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <?php if (isset($_SESSION['unmatched'])) : ?>
            <div class="alert alert-danger">
              <?php echo $_SESSION['unmatched']; ?>
            </div>
          <?php endif; ?>
          <?php unset($_SESSION['unmatched']); ?>

          <div class="login-wrapper my-auto">
            <h1 class="login-title">Welcome Back</h1>
            <form method="post" action="">
              <div class="form-group mb-4">
                <label for="newpass">New Password</label>
                <input type="password" name="newpass" id="newpass" class="form-control" placeholder="********" required />
                <div class="error text-danger text-center">
                  <?php if (!empty($validation->errors['newpass'])) : echo $validation->errors['newpass'];
                  endif; ?>
                </div>
              </div>
              <div class="form-group mb-4">
                <label for="cnfrmpass">Confirm Password</label>
                <input type="password" name="cnfrmpass" id="cnfrmpass" class="form-control" placeholder="********" required />
                <div class="error text-danger text-center">
                  <?php if (!empty($validation->errors['cnfrmpass'])) : echo $validation->errors['cnfrmpass'];
                  endif; ?>
                </div>
              </div>
              <input name="submit" id="login" class="btn btn-block login-btn" type="submit" value="Proceed">
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>