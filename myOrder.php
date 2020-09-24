<?php
include('boilerplate.php');

if (!isset($_SESSION['email']) ) {
    echo '<script>
    location.href="error.php"
    </script>';
}

$per_page = 12;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $per_page;
$sql = "SELECT * FROM orders WHERE customer_id = '$customer_id' ORDER BY created_date DESC LIMIT $start_from, $per_page";
$run = mysqli_query($connect, $sql);
$count = mysqli_num_rows($run);

if ($count != 0) {

                    echo '<section class="borderless-table carousel-info">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="cart-table">
                              <table>
                                  <thead>
                                      <tr>
                                          <th>Order No</th>
                                          <th>Status</th>
                                          <th>Shipping</th>
                                          <th>Qty</th>
                                          <th>Total</th>
                                          <th>Time</th>
                                          <th>Details</th>
                                          <th>Invoice</th>
                                      </tr>
                                  </thead>
                                  <tbody>';

                    while ($row = mysqli_fetch_assoc($run)) :
                        $id = $row['order_id'];
                ?>

                        <tr>
                            <td class="cart-title first-row">
                            <span  style="font-size:1.1em;" class="badge  badge-light"><?php echo $id ?></span>
                            </td>
                            <td class="cart-title first-row">
                                <?php if ($row['status'] == 0) { ?>
                                    <span class="badge  badge-danger">Cancelled</span>

                                <?php } else if ($row['status'] == 1) { ?>
                                    <span class="badge  badge-warning">Placed</span>

                                <?php } else if ($row['status'] == 2) { ?>
                                    <span class="badge  badge-success">Approved</span>
                      
                                    <?php } else if ($row['status'] == 3) { ?>
                                    <span class="badge  badge-info">Shipped</span>

                                <?php } else if ($row['status'] == 4) { ?>
                                    <span class="badge  badge-success">Deliverd</span>

                                <?php } else if ($row['status'] == 5) { ?>
                                    <span class="badge  badge-info">Refund Requested</span>

                                 <?php } else if ($row['status'] == 6) { ?>
                                    <span class="badge  badge-success">Refunded</span>

                                <?php } else {  ?>
                                    <span class="badge  badge-danger">Error</span>
                                <?php  } ?>

                            </td>
                            <td class="cart-title first-row">
                                <?php if ($row['store_id'] == 0) { ?>
                                    <span class="badge  badge-secondary">Home Delivery</span>

                                <?php } else {
                                    echo '<span class="badge  badge-info">Store Pickup</span>';
                                } ?>
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge  badge-light">
                                <?php echo $row['total_qty'] ?></span>
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge  badge-success">&#x20B9;&nbsp;<?php echo $row['total_amt'] ?></span>
                            </td>

                            <td class="cart-title first-row">
                            <span class="badge  badge-light">
                            <?php echo $row['created_date'] ?></span>                               
                            </td>

                            <td class="cart-title first-row">

                                <a style="color:#F67E29;" href="orderDetail.php?id=<?php echo $id ?>" >
                                    <i class="fas fa-info-circle"></i></a>

                            </td>

                            <td class="cart-title first-row">

                                <a style="color:grey;" href="invoice.php?id=<?php echo $id ?>">
                                    <i class="fas fa-file-alt"></i></a>

                            </td>

                        </tr>
                    <?php endwhile; ?>

                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
</section>
<style>
	.center {
	text-align: center;
	}

	.pagination {
		display: inline-block;
		margin-top: 15px;
		margin-bottom: 15px;
	}

	.pagination a {
		color: grey;
		float: left;
		padding: 8px 16px;
		text-decoration: none;
		transition: .3s;
	}

	.pagination a.active {
		background-color: #66fcf1;
		color: black;

	}

	.pagination a:hover:not(.active) {
		background-color: #66fcf1;
		color: black;
	}
</style>

<?php
$query = "SELECT * FROM orders WHERE customer_id = '$customer_id'";
$result = mysqli_query($connect, $query);
$total_posts = mysqli_num_rows($result);
$total_pages = ceil($total_posts / $per_page);
$page_url = $_SERVER['PHP_SELF'];


echo "<div class='center'><div class='pagination justify-content-center'>";
echo "
	<a  href ='$page_url?page=1'>First</a>";

for ($i = 1; $i <= $total_pages; $i++) : ?>

	<a class="<?php if ($page == $i) {
					echo 'active';
				} ?>" href="<?php echo $page_url ?>?page=<?= $i; ?>"> <?= $i; ?> </a>

<?php endfor;
echo "<a href='$page_url?page=$total_pages' >Last</a>";
echo "</div></div>";
?>
<?php
                } else {
                    echo '
                  <div class="container">
                  <div class="row my-5">
        <div class="col-md-12 text-center">
          <span class="icon-exclamation-circle display-1 text-danger"></span>
          <h2 class="display-3 text-black">No order placed!</h2>
          <p class="display-5 mb-5">You can check our bestseller section</p>
          <p><a href="index.php" class="btn btn-sm btn-info">Continue Shopping</a></p>
        </div>
      </div>
    </div>';
                }
?>
<?php include('footer.php'); ?>