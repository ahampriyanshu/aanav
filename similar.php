<?php
    $result = mysqli_query($connect, "SELECT * FROM product WHERE section='$section' ORDER BY id DESC LIMIT 0,4");

    if($result === FALSE){
        mysqli_close($connect);
}
else {
?>
<section class="carousel-banner carousel-info">
        <div class="container"> 
        <div class="row">
                <div class="col-lg-12">
                        <h3 style="text-align: center; color: #5d6d7e; font-weight: bold; padding:20px;">Similar Products</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-slider owl-carousel">
                    
                    <?php while ($row_product = mysqli_fetch_assoc($result)):
                        ?>

                        <div class="product-item">
                            <div class="pi-pic">
                            <a href="product.php?id=<?php echo $row_product ['id']; ?>">
                            <img src="uploads/<?php echo $row_product ['file'] ?>" alt="Image" style="width: 250px; height:250px; border-radius: 3%;" class="img-responsive">
                            </a>
                                <div class="icon">
                                <?php
                                    $sql_fav = "SELECT * FROM wishlist WHERE customer_id ='$customer_id' AND product_id = '$product_id'";
                                    $run_fav = mysqli_query($connect, $sql_fav);
                                    $row_fav = mysqli_fetch_assoc($run_fav);
                                  
                                     if ($row_fav['fav_id'] == null) { ?>
                                        <a href="updateWishlist.php?user=<?php echo $customer_id ?>&action=add&id=<?php echo $product_id ?>" ><i class="far fa-heart" style="color:red"></i></a>
                 <?php } else { ?>
                    <a href="updateWishlist.php?user=<?php echo $customer_id ?>&action=remove&id=<?php echo $product_id ?>" ><i class="fas fa-heart" style="color:red"></i></a>    
                 <?php } ?>
</div>
                            </div>
                            <div class="pi-text">
                            <a href="product.php?id=<?php echo $row_product['id']; ?>">
                            <h4><span class="badge badge-light"><?php echo $row_product['name']; ?>
                            </span></h4>
                                </a>
                                <div class="product-price">
                                &#x20B9;&nbsp;<?php echo $row_product['cost']; ?>
                                <span class="MRP">&#x20B9;&nbsp;<?php echo $row_product['MRP']; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php } ?>