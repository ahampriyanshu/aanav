<?php
  session_start();
  include('../essentials/config.php');
  include('../essentials/function.php');
  include('sidebar.php');

error_reporting(E_ALL);

if(!isset($_SESSION['admin']))
{
header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<title>Add Product</title>	
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/add-product.css">
<link rel="stylesheet" href="css/table.css">
</head>
<body >


<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Category List</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
         
        <div class="box-body">

            <a href="cat-list.php" class="btn btn-large btn bg-teal margin"><i class="fa fa-plus-square"></i> &nbsp; Add New Category</a>
        <br><br>

            <table class='table borderless' >
                <tr style='background: whitesmoke;'>
                    <th>No</th>
                    <th>Title</th>
                    <th>Operation</th>
                </tr>

                <?php 
                $count = 1;
                $query = "SELECT * FROM section order by cat_id desc";
                $result = mysqli_query($connect,$query);
                while($row = mysqli_fetch_assoc($result) ){
                    $id = $row['cat_id'];
                    $cat_name = $row['cat_name'];
                    $created_date = $row['created_date'];

                ?>
                
                    <tr>
                        <td align='center'><?= $count ?></td>
                        <td><a href='<?= $created_date ?>' target='_blank'><?= $cat_name ?></a></td>
                        <td align='center'>
                            <a href="cat-edit.php?id=<?php echo $row['cat_id']?>" class="btn btn-default">Edit</a>

                            <button class='delete btn btn-warning' id='del_<?= $id ?>'>Delete</button>

                        </td>
                        
                    </tr>
                <?php
                    $count++;
                }
                ?>
            </table>

        </div>
        <!-- /.box-body -->
       
        <div class="box-footer">
         
        </div>
        <!-- /.box-footer-->
      </div>



<!-- <div id="content" class="pl-5 p-md-5 pt-2"> -->
<!-- <section class="borderless-table carousel-info  m-5">
 <div class="container">    
      <div class="row">
      <div class="col-lg-9 mx-auto">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created</th>
                                <th>Modified</th>
                                <th>Update</th>
                                <th>Del</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                $query = "SELECT * FROM section order by cat_id desc";
                $result = mysqli_query($connect,$query);
                while($row = mysqli_fetch_assoc($result) ){
              
                ?>

                            <tr>
                                <td class="cart-title first-row">
                                    <span style="font-size: 1.1em;" class="badge badge-pill badge-light"><?php echo $row['cat_id'] ?></span>
                                </td>
     

                                <td class="cart-title first-row">
                                    <span class="badge badge-pill badge-info"><?php echo $row['cat_name'] ?></span>
                                </td>

                                <td class="cart-title first-row">
                                    <span class="badge badge-pill badge-light">
                                        <?php echo $row['created_date'] ?></span>
                                </td>

                                <td class="cart-title first-row">
                                    <span class="badge badge-pill badge-success">&#x20B9;&nbsp;<?php echo $row['modified_date']  ?></span>
                                </td>


                            </tr>
                            <?php
                    
                }
                ?>
                        </tbody>
                    </table>
                </div>
            </div>
      </div>     
</div> 
</section>      -->
</body>
</html>