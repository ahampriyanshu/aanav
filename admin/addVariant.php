<?php
require('header.php');
?>

<?php
$id = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM product where id = $id");
$row = mysqli_fetch_assoc($result);
?>
<div class="container">
  <div class="row">
    <div id="insert-form" class="col-sm-6 login-section-wrapper pl-5 ">
      <div class="login-wrapper">
        <h2 class="text-center mb-4 ">
          <span class="badge badge-light">Add Variants</span>
        </h2>
        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
          <div class="form-group">
            <label for="variants">ProductID : <?php echo $_SESSION['id'] = $row['id']; ?></label>
            <input type="number" name="variants" placeholder="Total no. of variants" class="form-control" id="email" required />
          </div>
          <input type="submit" name="insert" id="insert" class="btn btn-block login-btn" value="insert">
        </form>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    $(document).ready(function() {
          $("#insert").change(function() {
              var shippingValidation = $(this).val();

              $("#insert-form").hide();
            }
          });
  </script>

  <div class="col-sm-6 login-section-wrapper pl-5 ">
    <div class="login-wrapper">
      <?php
      if (isset($_POST['insert'])) {
      ?>
        <form class="form-horizontal" method="post" action="insertProduct.php" enctype="multipart/form-data">
          <input type="hidden" name="total" value="<?php echo $_POST["variants"]; ?>" />
          <?php
          for ($i = 1; $i <= $_POST["variants"]; $i++) {
          ?>
            <h4 class="text-center mb-3 pt-5">
              <span class="badge badge-light">Variant No: <?php echo $i; ?></span>
            </h4>
            <input type="hidden" name="id<?php echo $i; ?>" class="form-control" value="<?php echo $row['id'] ?>" />

            <div class="form-group">
              <label for="color">Color</label>
              <select class="form-control color" name="color<?php echo $i; ?>">
                <?php
                $get_brand = "SELECT * FROM attribute WHERE name LIKE '%color%'";
                $run_brand = mysqli_query($connect, $get_brand);
                while ($row_brand = mysqli_fetch_array($run_brand)) {
                  $color_id = $row_brand['attr_id'];
                  $color_name = $row_brand['name'];
                  $color_value = $row_brand['value'];
                ?>
                  <option value='<?php echo $color_id ?>'>
                    <?php echo $color_value ?>
                  </option>
                <?php
                }

                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="color">Size</label>
              <select class="form-control color" name="size<?php echo $i; ?>">
                <?php

                $get_brand = "SELECT * FROM attribute WHERE name LIKE '%size%'";
                $run_brand = mysqli_query($connect, $get_brand);
                while ($row_brand = mysqli_fetch_array($run_brand)) {
                  $size_id = $row_brand['attr_id'];
                  $size_name = $row_brand['name'];
                  $size_value = $row_brand['value'];

                  echo "
                                                <option value='$size_id'>$size_value</option>
                                              ";
                }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label for="email">Quantity</label>
              <input type="number" name="qty<?php echo $i; ?>" class="form-control" id="email" placeholder="200" required />
            </div>
          <?php } ?>
          <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Save">
        </form>
    </div>
  <?php } ?>
  </div>
</div>
</body>
<script src="https://kit.fontawesome.com/77f6dfd46f.js" crossorigin="anonymous"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootbox.min.js"></script>
<script src="js/jquery-3.3.1.js"></script>
</html>