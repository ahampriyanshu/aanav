<style type="text/css">
    .blog .carousel-indicators {
    left: 0;
    top: auto;
    bottom: -40px;

}

/* The colour of the indicators */
.blog .carousel-indicators li {
    background: #a3a3a3;
    border-radius: 2px;
    width: 25px;
    height: 2px;
}

.blog .carousel-indicators .active {
background: #000;
}
.ftr2{
 padding: 5px 0;

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

    include('essentials/config.php');
    $result = mysqli_query($mysqli,"SELECT * FROM product ORDER BY id DESC LIMIT 0,4");
    
?>
<div class="ftr2">
  <h2 style="text-align: center; color: #5d6d7e; font-weight: bold; font-size: 19px;">Latest Product</h2>
  <br>
<div class="container">
            <div class="blog">
                
                    <div id="blogCarousel" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">
                            <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#blogCarousel" data-slide-to="1"></li>
                        </ol>

                        <!-- Carousel items -->
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="row">
                                  <?php while($row2 = mysqli_fetch_assoc($result)):?>
                                    <div class="col-sm-3 col-xs-6">
                                        <a href="product.php?id=<?php echo $row2['id']; ?>">
                                            <img src="uploads/<?php echo $row2['file'] ?>" alt="Image" style="width: 250px; height:250px;" class="img-responsive">
                                        </a>
                                        <p><?php echo $row2['name']; ?></p>
                                        <p><strong>&#x20B9;&nbsp;<?php echo $row2['cost']; ?></strong></p>
                                    </div>
                                  <?php endwhile; ?>
                             
                                </div>
                            </div>
                            
                            <div class="carousel-item">
                                <div class="row">
                  <?php

                  include('essentials/config.php');
                  $result3 = mysqli_query($mysqli,"SELECT * FROM product ORDER BY id DESC LIMIT 4,4");
                  while($row3 = mysqli_fetch_assoc($result3)):
                  ?>
          
                                    <div class="col-sm-3 col-xs-6">
                                        <a href="product.php?id=<?php echo $row3['id']; ?>">
                                           <img src="uploads/<?php echo $row3['file'] ?>" alt="Image" style="width: 250px; height:250px;" class="img-responsive">
                                        </a>
                                         <p><?php echo $row3['name']; ?></p>
                                        <p><strong>&#x20B9;&nbsp;<?php echo $row3['cost']; ?></strong></p>
                                    </div>
                                    <?php endwhile; ?>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                        </div>
                        <!--.carousel-inner-->
                         <a class="carousel-control-prev" href="#blogCarousel" role="button" data-slide="prev" style="margin-bottom: 100px; font-size: 10px;">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#blogCarousel" role="button" data-slide="next" style="margin-bottom: 100px; font-size: 10px;">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
                    </div>
                    <!--.Carousel-->

             
            </div>
</div>
</div> <!-- ftr2 end -->