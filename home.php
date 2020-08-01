<?php
   session_start();
   require_once('essentials/conn.php');
   include('boilerplate.php');

?>
<div class="container">

<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <h3>Price</h3>
            <input type="hidden" id="min_price_hide" value="0" />
            <input type="hidden" id="max_price_hide" value="50000" />
            <p id="price_show">$1 - $50000</p>
            <div id="price_range"></div>
        </div>

        <div class="list-group">
            <h3>categories</h3>
            <?php
            $query = "
            SELECT DISTINCT(categories) FROM product ORDER BY categories DESC
            ";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $row)
            {
            ?>
                <div class="list-group-item checkbox">
                    <label>
                        <input type="checkbox" class="filter_all categories" value="<?php echo $row['categories']; ?>">
                        <?php echo $row['categories']; ?>
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

        <div class="list-group">
            <h3>sub_cat</h3>
            <?php

            $query = "
            SELECT DISTINCT(sub_cat) FROM product ORDER BY sub_cat DESC
            ";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $row)
            {
            ?>
                <div class="list-group-item checkbox">
                    <label>
                        <input type="checkbox" class="filter_all sub_cat" value="<?php echo $row['sub_cat']; ?>">
                        <?php echo $row['sub_cat']; ?>
                    </label>
                </div>
                <?php    
            }

            ?>
        </div>

    </div>

    <div class="col-md-9">

        <div class="row filter_data">

        </div>

    </div>
</div>

</div>

<script>
$(document).ready(function() {

    filter_data();

    function filter_data() {
        $('.filter_data');
        var action = 'fetch_data';
        var minimum_price = $('#min_price_hide').val();
        var maximum_price = $('#max_price_hide').val();
        var brand = get_filter('brand');
        var sub_cat = get_filter('sub_cat');
        var categories = get_filter('categories');
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
                action: action,
                minimum_price: minimum_price,
                maximum_price: maximum_price,
                brand: brand,
                sub_cat: sub_cat,
                categories: categories
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
        min: 1,
        max: 50000,
        values: [1, 50000],
        step: 1000,
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