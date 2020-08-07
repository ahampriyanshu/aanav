<?php
error_reporting(E_ALL); 
    $result = mysqli_query($connect, "SELECT * FROM product ORDER BY id DESC LIMIT 0,12");
?>

<section class="carousel-banner carousel-info">
        <div class="container"> 
        <div class="row">
                <div class="col-lg-12">
                  
                        <h3 style="text-align: center; color: #5d6d7e; font-weight: bold; padding:20px;"><i class="fas fa-bolt"></i> Latest Products</h3>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-slider owl-carousel">
                    
                    <?php while ($row_latest = mysqli_fetch_assoc($result)):
                    $product_id = $row_latest['id'];
                        ?>

                        <div class="product-item">
                            <div class="pi-pic">
                            <a href="product.php?id=<?php echo $row_latest['id']; ?>">
                            <img src="uploads/<?php echo $row_latest['file'] ?>" alt="Image" style="width: 250px; height:250px; border-radius: 3%;" class="img-responsive">
                            </a>
                                <div class="icon">
                                <?php
                                    $sql_fav = "SELECT * FROM wishlist WHERE customer_id ='$customer_id' AND product_id = '$product_id'";
                                    $run_fav = mysqli_query($connect, $sql_fav);
                                    $row_fav = mysqli_fetch_assoc($run_fav);
                                  
                                     if ($row_fav['fav_id'] == null) { ?>
                                        <a href="update-wishlist.php?user=<?php echo $customer_id ?>&action=add&id=<?php echo $product_id ?>" ><i class="far fa-heart" style="color:red"></i></a>
                 <?php } else { ?>
                    <a href="update-wishlist.php?user=<?php echo $customer_id ?>&action=remove&id=<?php echo $product_id ?>" ><i class="fas fa-heart" style="color:red"></i></a>    
                 <?php } ?>
</div>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name"><?php echo $row_latest['code']; ?></div>
                                <a href="#">
                                    <h5><strong><?php echo $row_latest['name']; ?></strong></h5>
                                </a>
                                <div class="product-price">
                                &#x20B9;&nbsp;<?php echo $row_latest['cost']; ?>
                                <span>&#x20B9;&nbsp;<?php echo $row_latest['MRP']; ?></span>
                                </div>
                            </div>
                        </div>

                        <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>