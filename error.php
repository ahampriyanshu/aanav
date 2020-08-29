<?php
include('boilerplate.php');
?>
<link rel="stylesheet" type="text/css" href="css/success.css">
<div class="container">
              <div style="margin-top:40px;" class="row">
    <div class="col-md-12 text-center">
      <span class="icon-exclamation-circle display-2 text-danger"></span>
      <h2 class="display-5 text-danger">Some error occured</h2>
      <p class="text-success mb-5">Sorry we couldn't handle your request</p>
      <p><a href="dashboard.php" class="btn btn-sm btn-success">Veiw Your dashboard</a></p>
      <p><a href="index.php" class="btn btn-sm btn-info">Home</a></p>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>