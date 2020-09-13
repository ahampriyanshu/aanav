<?php include('boilerplate.php');
include "dbConfig.php";
$validation = new validation;
$queries    = new queries;

if (isset($_POST['submit'])) {
$validation->validate('phone', 'Phone Number', 'uniqueEmail|customer|required|min_len|6');
  if ($validation->run()) {
    $phone = $validation->input('phone');
    $id = $_SESSION['id'];

            $update = mysqli_query($connect, "UPDATE customer SET phone = '$phone' WHERE id='$id'");
            if($update)
            { 
            $_SESSION['updatephone'] = "Mobile number successfully updated.";
          } else {
            $_SESSION['unmatched'] = "Some Error Occured";
          }
        }
 }
?>
  <link rel="stylesheet" href="css/login.css">
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">

        <?php if (isset($_SESSION['updatephone'])) : ?>
            <div class="alert alert-success">
              <?php echo $_SESSION['updatephone']; ?>
            </div>
          <?php endif; ?>
          <?php unset($_SESSION['updatephone']); ?>

          <?php if (isset($_SESSION['unmatched'])) : ?>
            <div class="alert alert-danger">
              <?php echo $_SESSION['unmatched']; ?>
            </div>
          <?php endif; ?>
          <?php unset($_SESSION['unmatched']); ?>

          <div class="login-wrapper my-auto">
            <h1 class="login-title">Upate Mobile Number</h1>
            <form  method="post" action="">
            <div class="form-group mb-4">
                <label for="phone">New Number</label>
                <input type="number" name="phone" id="phone" class="form-control" required />
                <div class="error text-danger text-center">
                  <?php if (!empty($validation->errors['phone'])) : echo $validation->errors['phone'];
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