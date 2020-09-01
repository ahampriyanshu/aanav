<?php
require_once('essentials/config.php');


if (isset($_POST["action"])) {
    $query = "
  SELECT * FROM product WHERE id > 0
 ";
    if (isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
        $query .= "
   AND cost BETWEEN '" . $_POST["minimum_price"] . "' AND '" . $_POST["maximum_price"] . "'
  ";
    }
    if (isset($_POST["brand"])) {
        $brand_filter = implode("','", $_POST["brand"]);
        $query .= "
   AND brand IN('" . $brand_filter . "')
  ";
    }
    if (isset($_POST["categories"])) {
        $categories_filter = implode("','", $_POST["categories"]);
        $query .= "
   AND categories IN('" . $categories_filter . "')
  ";
    }
    if (isset($_POST["section"])) {
        $section_filter = implode("','", $_POST["section"]);
        $query .= "
   AND section IN('" . $section_filter . "')
  ";
    }

    if (isset($_POST["start_from"])) {
        $start_from = $_POST['start_from'];
        $per_page = $_POST['per_page'];
        $query .= "
ORDER BY 1 DESC LIMIT $start_from, $per_page
  ";
    }

    $statement = $con->prepare($query);
    $statement->execute();
    $result    = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output    = '';
    if ($total_row > 0) {
        foreach ($result as $row) {
            $output .= '
            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                    <a href="product.php?id=' .  $row['id'] . '">
                                        <img width="200" height="300" src="uploads/' .  $row['file'] . '" alt="' .  $row['file'] . '"></a>
                                        <div class="icon">
                                        <i class="far fa-heart"></i>
                                        </div>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">' .  $row['code'] . '</div>
                                        <a href="#">
                                        <h5>' .  $row['name'] . '</h5>
                                        </a>
                                        <div class="product-price">
                                        &#x20B9;' .  $row['cost'] . '&nbsp;
                                        <span>&#x20B9;' .  $row['MRP'] . '</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
        }
    } else {
        $output = '<div  class="container">
        <div style="margin-top:40px;" class="row">
          <div class="col-md-12 text-center">
          <span class="icon-exclamation-triangle display-3 text-danger"></span>
          <h2 class="display-4 text-black">No matching items found !</h2>
          <p class="display-5 mb-5">Alter your filters and try again</p>
        </div>
        </div>
      </div>';
    }
    echo $output;
}
