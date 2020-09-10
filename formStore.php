<?php
session_start();
require_once('essentials/config.php');

if (isset($_POST['shipping_validation']) && $_POST['shipping_validation'] != '') { ?>
  <h3>Contact Information</h3>
  <div class="panel-body">
    <form method="post" action="proceedStore.php" enctype="multipart/form-data">

      <label for="lastName">Full Name<span>*</span></label>
      <input type="text" name="name" class="form-control" id="lastName" placeholder="" value="<?php echo $_SESSION['name'] ?>" required>
      <div class="invalid-feedback">
        Valid last name is required.
      </div>

      <label for="lastName">Email<span>*</span></label>
      <input type="email" name="email" class="form-control" id="lastName" placeholder="" value="<?php echo $_SESSION['email'] ?>" required>
      <div class="invalid-feedback">
        Valid last name is required.
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="country">Phone<span>*</span></label>
          <input type="text" name="phone" class="form-control" id="lastName" placeholder="" value="<?php echo $_SESSION['phone'] ?>" required>
          <div class="invalid-feedback">
            Valid last name is required.
          </div>

        </div>
        <div class="col-md-6 mb-3">
          <label for="state">Store<span>*</span></label>

          <select name="store_id" class="custom-select d-block w-100" id="state" required>
          <?php
            $sql = "SELECT * FROM store";
            $run = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_array($run)) {
              $store_id = $row['store_id'];
              $store_name = $row['store_name'];
              echo "<option value='$store_id'>".$row['store_name']." , ".$row['address']." 
              ,".$row['email'].",".$row['phone']."</option>";
            }
            ?>
          </select>
   
        </div>
      </div>
      <br>
      <input type="submit" name="submit" value="Proceed to Pay" class="btn btn-success">
      <a href="" class="btn btn-outline-primary">Back</a>
    </form>
  </div>
<?php  }

?>