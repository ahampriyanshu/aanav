<?php 
	session_start();
  require_once('essentials/config.php');
  $id = intval($_REQUEST['id']);
  
?>

    
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">

    <div class="container-fluid ">
  <div class="row">
        <div  class="col-md-12 col-sm-12 col-xs-12 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="img/logo_nav.png" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
          <div class="form-group mb-4">
              <label style="color:#222 !important;" for="phone">Enter your email to turn on notification</label>
</div>
            <form method="post" action="notify-backend.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id ?>">
              <div class="form-group mb-4">
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required/>
               </div>
              <input name="submit" id="login" class="btn btn-block login-btn" type="submit" value="Notify">
            </form>
          </div>
        </div>
    </div>
    </div>

  <div class="modal-footer"> 
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>