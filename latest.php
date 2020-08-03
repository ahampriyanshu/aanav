<?php
    $result = mysqli_query($connect,"SELECT * FROM product ORDER BY id DESC LIMIT 0,12");
?>

<section class="man-banner spad">
        <div class="container"> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-slider owl-carousel">
                        
                    <?php while($row2 = mysqli_fetch_assoc($result)):
                    $product_id = $row2['id'];
                        ?>

                        <div class="product-item">
                            <div class="pi-pic">
                            <a href="product.php?id=<?php echo $row2['id']; ?>">
                            <img src="uploads/<?php echo $row2['file'] ?>" alt="Image" style="width: 250px; height:250px;" class="img-responsive">
                            </a>
                                <div class="icon">
                                <?php
                                    $sql_fav = "SELECT * FROM wishlist WHERE customer_id ='$user_id' AND product_id = '$product_id'";
                                    $run_fav = mysqli_query($connect, $sql_fav);
                                    $row_fav = mysqli_fetch_assoc($run_fav);
                                    $fav = $row_fav['fav_id'];
                                    
                                    if ($fav == null) { ?>
         
         <a href="add-wishlist.php?id=<?php echo $row_r['id']; ?>" ><i class="far fa-heart"></i></a>
<?php } else { ?>
<a href="remove-wishlist.php?id=<?php echo $row_r['id']; ?>" ><i class="fas fa-heart"></i></a>    
<?php } ?>
                                    
                                </div>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name"><?php echo $row2['code']; ?></div>
                                <a href="#">
                                    <h5><?php echo $row2['name']; ?></h5>
                                </a>
                                <div class="product-price">
                                &#x20B9;&nbsp;<?php echo $row2['cost']; ?>
                                <span>&#x20B9;&nbsp;<?php echo $row2['MRP']; ?></span>
                                </div>
                            </div>
                        </div>

                        <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>