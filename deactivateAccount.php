<?php include('boilerplate.php');
include "dbConfig.php";
$validation = new validation;
$queries    = new queries;

if (isset($_POST['submit'])) {
  $validation->validate('oldpass', 'Passwords', 'required|min_len|6');
  $validation->validate('confirmMessage', 'New Password', 'required|min_len|10');
  if ($validation->run()) {

    $oldpass = $validation->input('oldpass');
    $confirmMessage = $validation->input('confirmMessage');
    $id = $_SESSION['id'];

    if ($queries->query("SELECT * FROM customer WHERE id = ? ", [$id])) {
      if ($queries->count() > 0) {
        $row = $queries->fetch();
        $dbPassword = $row->password;
        if ($confirmMessage == 'deactivate') {
          if (password_verify($oldpass, $dbPassword)) {
            $update = mysqli_query($connect, "UPDATE customer SET status = '2' WHERE id='$id'");
            $_SESSION['emailVerified'] = "Account successfully deactivated.";
            echo "<script>
      document.location='logout.php';
      </script>";
          } else {
            $_SESSION['unmatched'] = "Invalid Password";
          }
        }
        else{
          $_SESSION['unmatched'] = "Please enter confirmation text correctly"; 
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
            <h1 class="login-title">Deactivate Account</h1>
            <form method="post" action="">
            <div class="form-group mb-4">
                <label for="oldpass">Password</label>
                <input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="********" required />
                <div class="error text-danger text-center">
                  <?php if (!empty($validation->errors['oldpass'])) : echo $validation->errors['oldpass'];
                  endif; ?>
                </div>
              </div>
              <div class="form-group mb-4">
                <label for="confirmMessage">Enter "deactivate" to continue</label>
                <input type="text" name="confirmMessage" id="confirmMessage" class="form-control" placeholder="deactivate" required />
                <div class="error text-danger text-center">
                  <?php if (!empty($validation->errors['confirmMessage'])) : echo $validation->errors['confirmMessage'];
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