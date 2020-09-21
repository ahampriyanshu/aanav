<?php 
include('boilerplate.php');
if (!isset($_SESSION['email']) ) {
  echo '<script>
  location.href="error.php"
  </script>';
}
include "dbConfig.php";
$validation = new validation;
$queries    = new queries;

if (isset($_POST['submit'])) {
  $validation->validate('oldpass', 'Passwords', 'required|min_len|6');
  $validation->validate('newpass', 'New Password', 'required|min_len|6');
  $validation->validate('cnfrmpass', 'Confirm Password', 'required|min_len|6');
  if ($validation->run()) {

    $oldpass = $validation->input('oldpass');
    $newpass = $validation->input('newpass');
    $cnfrmpass = $validation->input('cnfrmpass');
    $id = $_SESSION['id'];

    if ($queries->query("SELECT * FROM customer WHERE id = ? ", [$id])) {
      if ($queries->count() > 0) {
        $row = $queries->fetch();
        $dbPassword = $row->password;
        if ($newpass == $cnfrmpass) {
          if (password_verify($oldpass, $dbPassword)) {
            $newpass = password_hash($newpass, PASSWORD_DEFAULT);
            $update = mysqli_query($connect, "UPDATE customer SET password = '$newpass' WHERE id='$id'");
            $_SESSION['emailVerified'] = "Password successfully changed.";
            echo "<script>
      document.location='logout.php';
      </script>";
          } else {
            $_SESSION['unmatched'] = "Sorry Wrong Password";
          }
        }
        else{
          $_SESSION['unmatched'] = "New password and confirm password did not match"; 
        }
      }
    }
    else{
      $_SESSION['unmatched'] = "Invalid Credentials"; 
    }
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
                <label for="oldpass">Old Password</label>
                <input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="********" required />
                <div class="error text-danger text-center">
                  <?php if (!empty($validation->errors['oldpass'])) : echo $validation->errors['oldpass'];
                  endif; ?>
                </div>
              </div>
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
  <?php include('footer.php'); ?>