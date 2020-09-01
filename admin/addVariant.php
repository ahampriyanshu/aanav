<?php
  session_start();
  include('../essentials/config.php');
  
  include('sidebar.php');

error_reporting(E_ALL);


if(!isset($_SESSION['admin'])){
header('location:login.php');}

   $id = $_GET['id'];
   $result = mysqli_query($connect,"SELECT * FROM product where id = $id");
   $row = mysqli_fetch_assoc($result);

?>
<link rel="stylesheet" type="text/css" href="css/201.css">
<link rel="stylesheet" type="text/css" href="css/display.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product 3rd Registration
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-warning">
       
        <div class="box-header with-border">
          <h3 class="box-title">Product Size&color Option</h3>

        </div>
        <div class="box-body">
        <span class="badge progress-bar-warning">
        ProductID : <?php echo $_SESSION['id']=$row['id']; ?>
        </span>
         <form method="post" action="">
           <!-- FORM START -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Row No</label>
                  <div class="col-sm-10">
                  <input type="text" name="variants" placeholder="how many records u want to enter ? ex : 1 , 2 , 3 , 5"  class="form-control" id="inputEmail3" required />
                  </div>
                </div>
                <!-- FORM ENDS -->
                <br><br>
                <td align="right"><button type="submit" name="continue" class="btn btn-warning pull-right">Generate</button> 
                  </form>
                  <br><br>
                
                

        <div class="row">
        

            
        <?php
        if(isset($_POST['continue']))
        {
          ?>
        <form method="post" action="insert-product.php" enctype="multipart/form-data">
        
        <input type="hidden" name="total" value="<?php echo $_POST["variants"]; ?>" />
        <table class='table table-bordered'>
        <?php
        for($i=1; $i<=$_POST["variants"]; $i++) 
        {
          ?>
           
                    
                  
                       <div class="col-md-3">
                       <input type="hidden" name="id<?php echo $i; ?>"  class="form-control" value="<?php echo $row['id']?>" />
                          <div class="form-group">
                          <label>COLOR:</label>
                                     <select class="form-control" name="color<?php echo $i; ?>">
                                            <option>Select a color</option>
                                           <?php

                                            $get_brand = "SELECT * FROM attribute 
                                                          WHERE name LIKE '%color%'";
                                            $run_brand = mysqli_query($connect,$get_brand);
                                            while($row_brand= mysqli_fetch_array($run_brand)){
                                              $color_id = $row_brand['attr_id'];
                                              $color_name = $row_brand['name'];
                                              $color_value = $row_brand['value'];
                                              $attr_img = $row_brand['attr_img'];
                                              ?>
                                              echo "
                       <option value='<?php echo $color_id ?>'>
                          
                       <?php echo $color_value ?></option>
                       <img src='images/<?php echo $attr_img; ?>' width='50' height='50'>
                                         
<?php   
}

                                            ?>
                                      
                                      </select>
                        </div>
        </div>
        

        <div class="col-md-3">
                          <div class="form-group">
                          <label>SIZE:</label>
                                     <select class="form-control" name="size<?php echo $i; ?>">
                                            <option>Select a size</option>
                                           <?php

                                            $get_brand = "SELECT * FROM attribute 
                                                          WHERE name LIKE '%size%'";
                                            $run_brand = mysqli_query($connect,$get_brand);
                                            while($row_brand= mysqli_fetch_array($run_brand)){
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
        </div>


      

        <div class="col-md-1">
        <div class="form-group">
        <label for="email">Quantity</label>
                                          <input type="number" name="qty<?php echo $i; ?>" class="form-control" id="email" placeholder="200" required/> 
                                          </div> 
                                      </div>
                                      
                        </div>
                          
                         
                 
                         <?php
                            } ?>
                                <hr>
                      <input type="submit" name="submit" class="btn btn-warning pull-right" value="Save">
              </form>
                         <?php }
                            ?>
                        
                      
                            
                        
                      
                  
    </div>



      
      
   
  
          






 
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->

  
      </div>
      <!-- /.box -->
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --
    

 
