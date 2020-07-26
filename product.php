<?php
   session_start();
   include('essentials/config.php');
   include('essentials/function.php');
?>
<?php  include('boilerplate.php'); ?>
<?php  include('navbar.php'); ?>
<?php
   $id = $_GET['id'];
   $result = mysqli_query($mysqli,"SELECT * FROM product WHERE id=$id");
   $row = mysqli_fetch_assoc($result);
   $product_id = $row['id'];
   $categories = $row['categories'];
   $qty = $row['qty'];

?>


    
     



<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
<link rel="stylesheet" type="text/css" href="css/detail.css">


    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="jquery-3.2.1.min.js"></script>
   
  <style>

.price_dis{
  text-decoration: line-through; 
  font-size: 12px;
}
    .input-hidden {
  position: absolute;
  left: -9999px;
}

input[type=radio]:checked + label>img {
  border: 1px solid #FFC107;
  box-shadow: 0 0 2px 0px #FFC107;
}

input[type=radio] + label>img {
  border: 1px solid #000;
  width: 45px;
  height: 35px;
  border-radius: 2px;
}


</style>

<script type="text/javascript">
      $("a").click(function() {
    $(this).next().prop("checked", "checked");
});

  $('a').click(function() {
        $('li:has(input:radio:checked)').addClass('active');
        $('li:has(input:radio:not(:checked))').removeClass('active');
    });
    </script>
<style class="cp-pen-styles">
</style>

<style type="text/css">
  .product-details .product-images img {

    display: block;
    width: 500px;

}
</style>

<?php

   $id = $_GET['id'];
   $result = mysqli_query($mysqli,"SELECT * FROM product LEFT JOIN categories 
                                   ON categories.cat_id = product.categories WHERE product.id=$id");
   $row2 = mysqli_fetch_assoc($result);
   $cat_id = $row2['cat_id'];
   $cat_name = $row2['cat_name'];
?>

<main>
    <div class="section section-gray">
        <div class="section-content">
            <div class="product-details">
                <ul class="product-images">
                    <li class="preview"><img src="uploads/<?php echo $row2['file'] ?> " alt="file image" ></li>
                    <li class="javascript:void(0)"><img src="uploads/<?php echo $row2['file'] ?> " alt="file image" ></li>
                    <!-- Don't show small pictures if there's only 1 -->
                    <?php
                      $sql2 = "SELECT * FROM image_attributes
                              WHERE product_id = $id";
                      $run = mysqli_query($mysqli,$sql2);
                    while($row2 = mysqli_fetch_assoc($run)):
                    ?>
                    
                    <li>
                        <a href="javascript:void(0)"><img src="uploads/gallery/<?php echo $row2['image'] ?> " alt="file image" ></a>
                    </li>
                    <?php endwhile; ?> 
                    
                </ul>
                <?php

   $id = $_GET['id'];
   $result = mysqli_query($mysqli,"SELECT * FROM product WHERE id=$id");
   $row3 = mysqli_fetch_assoc($result);
?>              

                <ul class="product-info">

                  <p style="font-size: 12px;">
                    <li><p id="title"><?php echo $row3['name']?><br>
                  <?php echo $row3['cost']?>
                  </p></li>


              <div class="row">  
                <div class="col-md-6 mb-3">
                  <p>Colors</p>
       <div class="form-group">

       <form method="post" action="detail_add.php" enctype="multipart/form-data">
       
       <input type="hidden" name="id" value="<?php echo $id?>">
         <?php

            $sql ="SELECT distinct a.*,p.color,p.product_id FROM variant p
                   LEFT JOIN attribute a
                   ON p.color = a.attr_id
                   WHERE p.product_id = '$id'";
                   $ret = mysqli_query($mysqli,$sql);
                  $num_results=mysqli_num_rows($ret);
                  for($i=0;$i<$num_results;$i++)
  {
    $row=mysqli_fetch_array($ret);

    echo"<input type=\"radio\" name=\"rdocolor\" value=\"".$row['value']."\"
  id=\"happy_".$row['attr_id']."\" class=\"custom-control-input\"/>";
    echo "<label for=\"happy_".$row['attr_id']."\">";
    ?>
     
     <img 
    src="admin/images/<?php echo $row['attr_img'] ?>" 
    alt="<?php echo $row['value'] ?>" />
    <?php

    echo "<label>";
  
  }
 ?>
           
                          </div>
                            </div>
                          </div>  
                          <!-- Image check box start -->

     <!-- size option start -->
      <div class="row">

          <?php 
            $result = "SELECT * FROM variant where product_id = $id";
            $sql = mysqli_query($mysqli,$result);
            $row = mysqli_fetch_assoc($sql);             
          ?>

           <div class="col-md-6 mb-3">
            <p class="col_size">Size</p>
         
                <select name="size" class="custom-select d-block w-100" id="size" required>
                  <option value="">Choose...</option>
                           <?php

                                    $sql ="SELECT distinct a.*,p.size,p.product_id FROM variant p
                                     LEFT JOIN attribute a
                                     ON p.size = a.attr_id
                                     WHERE p.product_id = '$id'";

                               $result = mysqli_query($mysqli,$sql);

                               while($row = mysqli_fetch_assoc($result)){
                                    $size = $row['size'];
                                                  ?>

                                    
                                 
                                                                                 
                                  <option value='<?php echo $row['value']; ?>'><?php echo $row['value']; ?></option>
                                        <?php } ?>          
                                          
                </select>
              </div>

                          <div class="col-md-8">

                     <style type="text/css">
                          
                          </style>
<!--      ----------------------------------- In stock & sold out ------------------------ -->
                          <?php if($qty == 0){
                            echo "<span class='badge badge-light'>SOLD OUT</span>";
                          }
                          else{
                            echo "<span class='badge badge-info'>In Stock</span>";
                          }

                          ?>

         <?php
              $sql ="SELECT distinct a.*,p.color,p.product_id FROM variant p
                     LEFT JOIN attribute a
                     ON p.size = a.attr_id
                     WHERE p.product_id = '$id'";

             $result = mysqli_query($mysqli,$sql);

             while($row = mysqli_fetch_assoc($result)){

        ?>
   

         <?php } ?>

          
          <?php 
      $s = "SELECT * FROM product WHERE id = '$id'";
      $r = mysqli_query($mysqli,$s);
      $row_r = mysqli_fetch_assoc($r);
        $product_id = $row_r['id'];
        $customer_id = $_SESSION['email'];
      
      
      $sql_fav = "SELECT * FROM wishlist WHERE customer_id ='$customer_id' AND product_id = '$product_id'";
      $run_fav = mysqli_query($mysqli,$sql_fav);
      $row_fav = mysqli_fetch_assoc($run_fav);
        $fav = $row_fav['fav_id'];
       
        ?>
       
       
      
 
<!--      ----------------------------------- Add To cart Button------------------------ -->
<?php if($qty > 0){ ?>
              <input type="submit" name="submit" value="Add To Cart" style="clear:both; background: #48c9b0; border: none; color: #fff; font-size: 14px; padding: 10px; cursor: pointer;" /> <a href="product.php">Back</a>
      <?php }else{ ?>
     </form>
<!--      ----------------------------------- Add To cart Button end ------------------------ -->

<!--      ----------------------------------- SOLD OUT MODAL DIALOG ------------------------ -->
      <?php

   $id = $_GET['id'];
   $result = mysqli_query($mysqli,"SELECT * FROM product WHERE id=$id");
   $row = mysqli_fetch_assoc($result);
   
   ?>
     <button data-toggle="modal" data-target="#view-modal" 
     data-id="<?php echo $row['id']; ?>" id="getUser" style="clear:both; background: #48c9b0; 
     border: none; color: #fff; font-size: 14px; padding: 10px;cursor: pointer;">Add To Cart</button>
     <?php } ?>

       <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                  
                       <div class="modal-header"> 
                        <h4 class="modal-title">
                             
                            </h4> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            
                       </div> 
                       <div class="modal-body"> 
                       
                           <div id="modal-loader" style="display: none; text-align: center;">
                            <img src="ajax-loader.gif">
                           </div>
                            
                           <!-- content will be load here -->                          
                           <div id="dynamic-content">
                           
                           </div>
                             
                        </div> 
                        
                        
                 </div> 
              </div>
       </div><!-- /.modal --> 
<!--      ----------------------------------- SOLD OUT MODAL DIALOG End------------------------ -->

       


<script>
$(document).ready(function(){
  
  $(document).on('click', '#getUser', function(e){
    
    e.preventDefault();
    
    var uid = $(this).data('id');   // it will get id of clicked row
    
    $('#dynamic-content').html(''); // leave it blank before ajax call
    $('#modal-loader').show();      // load ajax loader
    
    $.ajax({
      url: 'getemail.php',
      type: 'POST',
      data: 'id='+uid,
      dataType: 'html'
    })
    .done(function(data){
      console.log(data);  
      $('#dynamic-content').html('');    
      $('#dynamic-content').html(data); // load response 
      $('#modal-loader').hide();      // hide ajax loader 
    })
    .fail(function(){
      $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
      $('#modal-loader').hide();
    });
    
  });
  
});

</script>

<!--      -----------------------------------Add To Whilist ------------------------ -->
       <br><br>

       <?php  if ($fav == null) { ?>
         
         <a href="add-wishlist.php?id=<?php echo $row_r['id']; ?>" ><i class="material-icons">favorite</i></a>

     <?php } else { ?>
         <a href="remove-wishlist.php?id=<?php echo $row_r['id']; ?>" ><i class="material-icons">favorite_border</i></a>
     
     <?php } ?>
    
      </div>
          
    </div><!-- col8 -->
                    <li class="product-description">
                       
                    </li>
                </ul>
            </div>
        </div>
    </div>
   
</main>
<style type="text/css">
  .cat_cat{
    
  }
  .cat_cat img{
    width: auto;
    height: 350px;
    margin: 30px 100px;
  }
</style>

<!-- -------------------- similar product ---------------------------------- -->
<style type="text/css">
    .blog .carousel-indicators {
    left: 0;
    top: auto;
    bottom: -40px;

}


/* The colour of the indicators */
.blog .carousel-indicators li {
    background: #a3a3a3;
    border-radius: 5px;
    width: 25px;
    height: 2px;
}

.blog .carousel-indicators .active {
background: teal;

}
.ftr2{
  background-color: #fff;
  height: 450px;

}
.ftr2 p{
    font-size: 12px;
    color: #7F8C8D;
}

.ftr2 p strong {
    color: #2E405E;
    font-size: 12px;
}
</style>
<script type="text/javascript">
    // optional
        $('#blogCarousel').carousel({
                interval: 5000
        });
</script>
<?php

    $smilar = mysqli_query($mysqli,"SELECT * FROM product WHERE categories='$categories' ORDER BY id DESC LIMIT 0,4");
    
    
?>
<div class="ftr2">
  <h2 style="text-align: center; color: #5d6d7e; font-weight: bold; font-size: 17px;">Similar Product</h2>
  <br>
<div class="container">
            <div class="row blog">
                <div class="col-md-12">
                    <div id="blogCarousel" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">
                            <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#blogCarousel" data-slide-to="1"></li>
                        </ol>

                        <!-- Carousel items -->
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="row">
                                  <?php while($row_similar = mysqli_fetch_assoc($smilar)):?>
                                    <div class="col-md-3">
                                        <a href="product.php?id=<?php echo $row_similar['id'] ?>">
                                            <img src="uploads/<?php echo $row_similar['file'] ?>" alt="Image" style="width: 250px; height:250px;">
                                            
                                        </a>
                                        <p><?php echo $row_similar['name']; ?></p>
                                        <p><strong>US$<?php echo $row_similar['cost']; ?></strong></p>
                                    </div>
                                  <?php endwhile; ?>
                             
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                            <div class="carousel-item">
                                <div class="row">
                  <?php

               
                  $smilar2 = mysqli_query($mysqli,"SELECT * FROM product WHERE categories='$categories' ORDER BY id DESC LIMIT 4,4");
                  while($row_similar2 = mysqli_fetch_assoc($smilar2)):
    
                  ?>
          
                                    <div class="col-md-3">
                                        <a href="product.php?id=<?php echo $row_similar2['id'] ?>">
                                           <img src="uploads/<?php echo $row_similar2['file'] ?>" alt="Image" style="width: 250px; height:250px;">
                                        </a>
                                        <p><?php echo $row_similar2['product_name']; ?></p>
                                        <p><strong  style="color: #DC3545" >&#x20B9;&nbsp;<?php echo $row_similar2['price']; ?></strong>
                                        <strong class="price_dis">&#x20B9;&nbsp;<?php echo $row_similar2['MRP']; ?></strong></p>
                                    </div>
                                    <?php endwhile; ?>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                        </div>
                      
                            <a class="carousel-control-prev" href="#blogCarousel" role="button" data-slide="prev" style="margin-bottom: 100px; font-size: 10px;">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#blogCarousel" role="button" data-slide="next" style="margin-bottom: 100px; font-size: 10px;">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                    </div>
                

                </div>
            </div>
</div>
</div> 
<?php include('footer.php'); ?>
</body>
</html>