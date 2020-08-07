<?php
error_reporting(E_ALL); 
    $result = mysqli_query($connect, "SELECT DISTINCT(product_id) FROM search WHERE customer_id = '$customer_id' ORDER BY product_id DESC LIMIT 0,12");
?>

<section class="carousel-banner carousel-info">
        <div class="container"> 
        <div class="row">
                <div class="col-lg-12">
                  
                        <h3 style="text-align: center; color: #5d6d7e; font-weight: bold; padding:20px;">Recently Viewed</h3>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-slider owl-carousel">
                    
                    <?php while ($row_product = mysqli_fetch_assoc($result)):
                    $product_id = $row_product['product_id'];
                    $find_product_data = "SELECT * FROM product WHERE id = '$product_id' ";

                    $found_product_data =$connect->query($find_product_data);
                    $product_id_array = $found_product_data ->fetch_assoc();
                        ?>

                        <div class="product-item">
                            <div class="pi-pic">
                            <a href="product.php?id=<?php echo $product_id_array ['id']; ?>">
                            <img src="uploads/<?php echo $product_id_array ['file'] ?>" alt="Image" style="width: 250px; height:250px; border-radius: 3%;" class="img-responsive">
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
                                <div class="catagory-name"><?php echo $product_id_array ['code']; ?></div>
                                <a href="#">
                                    <h5><strong><?php echo $product_id_array ['name']; ?></strong></h5>
                                </a>
                                <div class="product-price">
                                &#x20B9;&nbsp;<?php echo $product_id_array ['cost']; ?>
                                <span>&#x20B9;&nbsp;<?php echo $product_id_array ['MRP']; ?></span>
                                </div>
                            </div>
                        </div>

                        <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>