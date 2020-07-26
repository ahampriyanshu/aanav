<?php
  require_once('config/config.php');
  include('function/function.php');
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
<script language="javascript">
    function check()
    {
  
    }
    
    </script>

<?php
extract($_POST);

if(isset($submit))
{
  date_default_timezone_set('Asia/Kolkata');
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $name  = $_POST['name'];
  $phone = $_POST['phone'];
  $date = date('m/d/Y h:i:s', time());

  $sql = "INSERT INTO customer (name,email,password,phone,datetym) VALUES
  ('$name','$email','$pass','$phone','$date')";

  $check = "SELECT * FROM customer WHERE `email` = '$email'";
  $result = mysqli_query($mysqli,$check);
  $num = mysqli_num_rows($result);

  if ($num > 0) {
    $found="N";
  }
  else {
  $create = "INSERT INTO customer (name,email,password,phone,datetym) VALUES
  ('$name','$email','$pass','$phone','$date')";
  mysqli_query($mysqli,$create);
  echo "<script>
  alert('New User Created');
  document.location='login.php';
  </script>";  
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
            <h1 class="login-title">Hello New User</h1>
            <form name="signupform" method="post" onSubmit="return check();">
              <div class="form-group">
              <label for="password">Name</label>
                <input type="text" name="name" id="email" class="form-control" placeholder="Enter your name" required/>
               </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="pass" id="password" class="form-control" placeholder="Create new passsword" name="pass" required/>
              </div>
              <div class="form-group mb-4">
              <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required/>
               </div>
              <div class="form-group mb-4">
                <label for="password">Phone</label>
                <input type="text" name="phone" id="email" class="form-control" placeholder="+91">
              </div>
              <?php  
		  if(isset($found))
		  {
		  	echo '<p  style="color:#7EF9FF;"><center>Email Already Taken</center></p>';
		  }
	?>
              <input name="submit" id="login" class="btn btn-block login-btn" type="submit" value="Join Us">
            </form>
            <p class="login-wrapper-footer-text">Already a customer&emsp;<a href="#!" class="text-reset">Welcome Back</a></p>
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