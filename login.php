<?php
  require_once('essentials/config.php');
  include('essentials/function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Template</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="essentials/css/login.css">
</head>
<body>

<?php
extract($_POST);

if(isset($submit))
{
  $rs=mysqli_query($mysqli,"SELECT  * FROM customer WHERE email ='$email' and password='$pass'");
  if(mysqli_num_rows($rs)<1)
  {
    $found="N";
    session_destroy();
  }
  else
  {
    session_start();
    $_SESSION['email'] = $email;
    header('location:index.php');
  }
}
?>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="essentials/images/logo.png" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Welcome Back</h1>
            <form name="signupform" method="post" onSubmit="return check();">
              <div class="form-group">
              <label for="password">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter registered Email" required/>
               </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="pass" id="password" class="form-control" placeholder="Enter your passsword" name="pass" required/>
              </div>
              <?php  
		  if(isset($found))
		  {
		  	echo '<p  style="color:#7EF9FF;"><center>Invalid Username or Password</center></p>';
		  }
	?>
              <input name="submit" id="login" class="btn btn-block login-btn" type="submit" value="Login">
            </form>
            <p class="login-wrapper-footer-text">New User&emsp;<a href="#!" class="text-reset">Join Us</a></p>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="essentials/images/login.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>