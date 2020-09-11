<?php
session_start();
require_once('essentials/config.php');
include "dbConfig.php";
if (isset($_SESSION['customer'])) :
  header("location: profile.php");
endif;
$validation = new validation;
$queries    = new queries;
$sendEmail  = new sendEmail;

if (isset($_POST['submit'])) {

  $validation->validate('fullName', 'Full Name', 'required');
  $validation->validate('email', 'Email', 'uniqueEmail|customer|required');
  $validation->validate('password', 'Password', 'required|min_len|6');
  $validation->validate('phone', 'Phone', 'uniqueEmail|customer|required');


  if ($validation->run()) {

    $fullName = $validation->input('fullName');
    $email    = $validation->input('email');
    $password = $validation->input('password');
    $phone    = $validation->input('phone');
    $password = password_hash($password, PASSWORD_DEFAULT);
    $code     = rand();
    $code     = password_hash($code, PASSWORD_DEFAULT);
    $url      = "http://" . $_SERVER['SERVER_NAME'] . "/aanav/verifyEmail.php?confirmation=" . $code;
    $url2     = "http://" . $_SERVER['SERVER_NAME'] . "/aanav/contact.php";
    $status   = 0;
    $subject  = 'Please confirm your Email';
    $body = '<p style="color:#66FCF1; font-size: 32px;" > Hi ' . $fullName . '</p><p  style="color:grey; font-size: 16px;" > You are almost done.Click below to verify your email address</p> 
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
    href="' . $url . '">Verify Email</a></p><p  style="color:red; font-size: 10px;" > Need Help ? <a  href="' . $url2 . '">Contact Us</a></p>';

    if ($queries->query("INSERT INTO customer (name, email, password, phone, code, status, datetym) VALUES
     ('$fullName', '$email', '$password', '$phone', '$code', '$status', now()) ")) {

      if ($sendEmail->send($fullName, $email, $subject, $body)) {
        $_SESSION['accountCreated'] = "Your account has been created successfully. Please verify your email";
        header("location: login.php");
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">

</head>

<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="img/logo_nav.png" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Hello New User</h1>
            <form name="signupform" method="post">
              <div class="form-group">
                <label for="password">Name</label>
                <input type="text" name="fullName" class="form-control" placeholder="Enter your name" required />
                <div class="error text-center text-danger">
                  <?php if (!empty($validation->errors['fullName'])) : echo $validation->errors['fullName'];
                  endif; ?>
                </div>
              </div>

              <div class="form-group mb-6">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required />
                <div class="error text-center text-danger">
                  <?php if (!empty($validation->errors['email'])) : echo $validation->errors['email'];
                  endif; ?>
                </div>
              </div>
              <div class="form-group mb-6">
                <label for="password">Phone</label>
                <input type="number" name="phone" class="form-control" placeholder="+91">
                <div class="error text-center text-danger">
                  <?php if (!empty($validation->errors['phone'])) : echo $validation->errors['phone'];
                  endif; ?>
                </div>
                <div class="error text-center text-danger">
                  <?php if (!empty($validation->errors['password'])) : echo $validation->errors['password'];
                  endif; ?>
                </div>
              </div>
              <div class="form-group mb-6">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Create new passsword" name="pass" required />
                <div class="error text-center text-danger">
                  <?php if (!empty($validation->errors['password'])) : echo $validation->errors['password'];
                  endif; ?>
                </div>
              </div>
              <input name="submit" id="login" class="btn btn-block login-btn" type="submit" value="Register">
            </form>
            <p class="login-wrapper-footer-text">Already a customer&emsp;<a href="login.php" class="text-reset">Welcome Back</a></p>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>