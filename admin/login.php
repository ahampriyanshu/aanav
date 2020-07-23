<?php
session_start();
  include('../config/config.php');
  include('../function/function.php');
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="ecommerce in php7 , bootstrap4 and mysql">
  <meta name="keywords" content="amazon clone,flpicart clone, php7, mysql, ecoomerce website">
  <meta name="author" content="PriyanshuMay,priyanshumay">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin login</title>	
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">

</head>
<body >
<?php
extract($_POST);

if(isset($submit))
{
  $rs=mysqli_query($mysqli,"select * from admin where admin_id ='$username' and password='$password'");
  if(mysqli_num_rows($rs)<1)
  {
    $found="N";
  }
  else
  {
    session_start();
    $_SESSION["admin"] = $username;
    header('location:index.php');
  }
}
?>
<main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="img/logo.png" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Hello Admin</h1>
            <form method="post" name="login_form" action="" >
              <div class="form-group">
				<label for="email">Email</label> 
                <input type="text" id="email" class="form-control login_text_box" placeholder="Admin Id" name="username" required/>
              </div>
              <div class="form-group mb-4">
				<label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control login_text_box" placeholder="enter your passsword"required/>
              </div>
              <?php  
		  if(isset($found))
		  {
		  	echo '<p class="inva" style="font"><center>Invalid Username or password</center></p>';
		  }
	?>
              <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Login">
            </form>
	        </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="img/tree.png" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>