<?php
   session_start();
   require_once('essentials/config.php');
   include('essentials/function.php');  
   include('boilerplate.php');

?>



    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
         
                <div class="list-group">
                    <h3>Price</h3>
                    <input type="hidden" id="min_price_hide" value="0" />
                    <input type="hidden" id="max_price_hide" value="300" />
                    <p id="price_show">$10 - $300</p>
                    <div id="price_range"></div>
                </div>
 
                <div class="list-group">
                    <h3>Sections</h3>
                    <?php
                    $query = "
                    SELECT DISTINCT(categories) FROM product  ORDER BY categories DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                        <div class="list-group-item checkbox">
                            <label>
                                <input type="checkbox" class="filter_all gender" value="<?php echo $row['categories']; ?>">
                                <?php echo $row['categories']; ?>
                            </label>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="list-group">
                    <h3>categories</h3>
                    <?php
                    $query = "
                    SELECT DISTINCT(sub_cat) FROM product  ORDER BY sub_cat DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                        <div class="list-group-item checkbox">
                            <label>
                                <input type="checkbox" class="filter_all gender" value="<?php echo $row['sub_cat']; ?>">
                                <?php echo $row['sub_cat']; ?>
                            </label>
                        </div>
                        <?php
                    }
                    ?>
                </div>
 
                <div class="list-group">
                    <h3>Brand</h3>
                         <?php
 
                    $query = "
                    SELECT DISTINCT(brand) FROM product ORDER BY brand DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                            <div class="list-group-item checkbox">
                                <label>
                                    <input type="checkbox" class="filter_all brand" value="<?php echo $row['brand']; ?>">
                                    <?php echo $row['brand']; ?>
                                </label>
                            </div>
                            <?php
                    }
 
                    ?>
                 </div>
 
              <!--  <div class="list-group">
                    <h3>Color</h3>
                    <?php
 
                    $query = "
                    SELECT DISTINCT(color) FROM variant  ORDER BY color DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                        <div class="list-group-item checkbox">
                            <label>
                                <input type="checkbox" class="filter_all color" value="<?php echo $row['color']; ?>">
                                <?php echo $row['color']; ?>
                            </label>
                        </div>
                        <?php    
                    }
 
                    ?>
                </div> -->

                </div>

                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row filter_data">
                </div>
                </div>
                </div>
                </section>



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
 
    <script src="js/jquery-ui.js"></script>
 
    <script>
        $(document).ready(function() {
 
            filter_data();
 
            function filter_data() {
                $('.filter_data');
                var action = 'fetch_data';
                var minimum_price = $('#min_price_hide').val();
                var maximum_price = $('#max_price_hide').val();
                var brand = get_filter('brand');
                var color = get_filter('color');
                var gender = get_filter('gender');
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        action: action,
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        brand: brand,
                        color: color,
                        gender: gender
                    },
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });
            }
 
            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }
 
            $('.filter_all').click(function() {
                filter_data();
            });
 
            $('#price_range').slider({
                range: true,
                min: 10,
                max: 300,
                values: [10, 300],
                step: 10,
                stop: function(event, ui) {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#min_price_hide').val(ui.values[0]);
                    $('#max_price_hide').val(ui.values[1]);
                    filter_data();
                }
            });
 
        });
    </script>
 
                
</body>

</html>