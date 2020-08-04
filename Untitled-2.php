
                </ul>
                <?php

   $id = $_GET['id'];
   $result = mysqli_query($connect,"SELECT * FROM product WHERE id=$id");
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

       <form method="post" action="adding-to-cart.php" enctype="multipart/form-data">
       
       <input type="hidden" name="id" value="<?php echo $id?>">
         <?php

            $sql ="SELECT distinct a.*,p.color,p.product_id FROM variant p
                   LEFT JOIN attribute a
                   ON p.color = a.attr_id
                   WHERE p.product_id = '$id'";
                   $ret = mysqli_query($connect,$sql);
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
            $sql = mysqli_query($connect,$result);
            $row = mysqli_fetch_assoc($sql);             
          ?>
￼

           <div class="col-md-6 mb-3">
            <p class="col_size">Size</p>
         
                <select name="size" class="custom-select d-block w-100" id="size" required>
                  <option value="">Choose...</option>
                           <?php

                                    $sql ="SELECT distinct a.*,p.size,p.product_id FROM variant p
                                     LEFT JOIN attribute a
                                     ON p.size = a.attr_id
                                     WHERE p.product_id = '$id'";

                               $result = mysqli_query($connect,$sql);

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

             $result = mysqli_query($connect,$sql);

             while($row = mysqli_fetch_assoc($result)){

        ?>
   

         <?php } ?>

         <?php 
      $s = "SELECT * FROM product WHERE id = '$id'";
      $r = mysqli_query($connect,$s);
      $row_r = mysqli_fetch_assoc($r);
        $product_id = $row_r['id'];
        $customer = $_SESSION['email'];

    
      $sql5 = "SELECT * FROM customer WHERE email = '$customer'";
      $run5 = mysqli_query($connect,$sql5);
      $row5 =mysqli_fetch_assoc($run5);
      $customer_id = $row5['id'];
      $customer_name = $row5['name'];      
      
      $sql_fav = "SELECT * FROM wishlist WHERE customer_id ='$customer_id' AND product_id = '$product_id'";
      $run_fav = mysqli_query($connect,$sql_fav);
      $row_fav = mysqli_fetch_assoc($run_fav);
      $fav = $row_fav['fav_id'];
       
        ?>
      
<?php if($qty > 0){ ?>
              <input type="submit" name="submit" value="Add To Cart" style="clear:both; background: #48c9b0; border: none; color: #fff; font-size: 14px; padding: 10px; cursor: pointer;" /> <a href="product.php">Back</a>
      <?php }else{ ?>
     </form>

      <?php

   $id = $_GET['id'];
   $result = mysqli_query($connect,"SELECT * FROM product WHERE id=$id");
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
                                                    
                           <div id="dynamic-content">
                           
                           </div>
                             
                        </div> 
                        
                        
                 </div> 
              </div>
       </div>

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
         
         <a href="update-wishlist.php?id=<?php echo $row_r['id']; ?>" ><i class="material-icons">favorite</i></a>

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

    $smilar = mysqli_query($connect,"SELECT * FROM product WHERE section='$section' ORDER BY id DESC LIMIT 0,4");
    
    
?>
<div class="ftr2">
  <h2 style="text-align: center; color: #5d6d7e; font-weight: bold; font-size: 17px;">Similar Products</h2>
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
                                        <p><strong>&#x20B9;&nbsp;<?php echo $row_similar['cost']; ?></strong></p>
                                    </div>
                                  <?php endwhile; ?>
                             
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                            <div class="carousel-item">
                                <div class="row">
                  <?php

               
                  $smilar2 = mysqli_query($connect,"SELECT * FROM product WHERE section='$section' ORDER BY id DESC LIMIT 4,4");
                  while($row_similar2 = mysqli_fetch_assoc($smilar2)):
    
                  ?>
          
                                    <div class="col-md-3">
                                        <a href="product.php?id=<?php echo $row_similar2['id'] ?>">
                                           <img src="uploads/<?php echo $row_similar2['file'] ?>" alt="Image" style="width: 250px; height:250px;">
                                        </a>
                                        <p><?php echo $row_similar2['name']; ?></p>
                                        <p><strong  style="color: #DC3545" >&#x20B9;&nbsp;<?php echo $row_similar2['cost']; ?></strong>
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
<?php include('footer.php'); ?></body>
</html>