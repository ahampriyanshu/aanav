<?php
require_once('essentials/config.php');
?>
<?php
include "inc.php";
$validation = new validation;
$queries    = new queries;
$sendEmail  = new sendEmail;

if (isset($_POST['submit'])) {
  $validation->validate('fullName', 'Full Name', 'required|min_len|5');
  $validation->validate('email', 'Email', 'required|min_len|10');
  $validation->validate('phone', 'Phone', 'required|min_len|10');
  $validation->validate('msg', 'Message', 'required|min_len|50');

  if ($validation->run()) {
    $fullName = $validation->input('fullName');
    $email    = $validation->input('email');
    $msg      = $validation->input('msg');
    $phone    = $validation->input('phone');
    $url      = "http://" . $_SERVER['SERVER_NAME'] . "/aanav/shop.php";
    $subject  = 'Thank you';
    $body = '<p style="color:#66FCF1; font-size: 32px;" >Hi ' . $fullName . '</p><p  style="color:grey; font-size: 16px;" > Thank you for .We will contact you as soon as possible</p> 
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
    href="' . $url . '">Visit Site</a></p><p  style="color:red; font-size: 10px;" > Need Help ? <a>Contact Us</a></p>';

    if ($queries->query("INSERT INTO msg (name, email, phone, msg, type, created_date) VALUES
     ('$fullName', '$email', '$phone', '$msg', 'work', now()) ")) {

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
  <title>Work With Us</title>
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
            <h1 class="login-title">Hello New Vendor</h1>
            <form method="post">
              <div class="form-group">
                <label for="name">Name</label>
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
                <label for="phone">Phone</label>
                <input type="number" name="phone" class="form-control" placeholder="+91">
                <div class="error text-center text-danger">
                  <?php if (!empty($validation->errors['phone'])) : echo $validation->errors['phone'];
                  endif; ?>
                </div>
              </div>
              <div class="form-group mb-6">
                <label for="msg">Your Message</label>
                <textarea class="form-control" name="msg" placeholder="Your message" required></textarea>
                <div class="error text-center text-danger">
                  <?php if (!empty($validation->errors['msg'])) : echo $validation->errors['msg'];
                  endif; ?>
                </div>
              </div>
              <input name="submit" id="login" class="btn btn-block login-btn" type="submit" value="Apply">
            </form>
            <p class="login-wrapper-footer-text"><a href="login.php" class="text-reset">Back</a></p>
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