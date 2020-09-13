<?php
require('header.php');
?>
<?php
	if(isset($_POST['search'])){
		$start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
		$fromdate = date('Y-m-d',strtotime($start_date));
    $todate = date('Y-m-d',strtotime($end_date));

    $query = "SELECT * FROM orders WHERE created_date Between '$fromdate' and '$todate'
     ORDER BY order_id DESC";
    $result = mysqli_query($connect, $query);
		
	}
?>
<div class="container">
    <div class="row">
    <div class="col-lg-9 mx-auto my-4 text-center">
         <h2><span class="badge badge-light">Sales Report</span></h2>
      </div>
        <div class="col-lg-12 mx-auto text-center">

            <a href="customerList.php" class="m-2 btn btn-sm btn-info">
            <i class="fa fa-download mr-2"></i> <b>Customer List PDF</b></a>

            <a href="productList.php" class="m-2 btn btn-sm btn-info">
            <i class="fa fa-download mr-2"></i><b>Product List PDF</b></a>

            <a href="orderList.php" class="m-2 btn btn-sm btn-info">
            <i class="fa fa-download mr-2"></i><b>Order List PDF</b></a>

        </div>
        <div class="col-lg-9 mx-auto my-4 text-center">
         <h2><span class="badge badge-light">View Order</span></h2>
      </div>

      <div class="col-lg-12 mx-auto my-3 text-center">
      <div class="table-responsive">
                <table class='table table-borderless text-center'>
	<form method="post" action="salesReport.php">
		<tr>
			<td><span class="badge badge-light">Starting Date</span></td>
			<td><input type="date" name="start_date" value="<?php echo date("Y-m-d") ?>"></td>

			<td><span class="badge badge-light">Ending Date</span></td>
			<td><input type="date" name="end_date" value="<?php echo date("Y-m-d") ?>"></td>
			<td><input type="submit" name="search" value="Search" class="btn btn-sm btn-success"></td>
		</tr>
  </form>
</table>
      </div>
      </div>

      <?php
	if(isset($_POST['search'])){
    ?>
      <div class="col-lg-12 mx-auto my-3 text-center">
     <h4> <span class="badge badge-light">FROM</span><span class="badge badge-light"> <?php echo "$fromdate"; ?></span>
      <span class="badge badge-light">TO</span><span class="badge badge-light"><?php echo "$todate"; ?></span> 
     </h4>
    </div>
    
        <div class="col-lg-12 mx-auto ">
            <div class="table-responsive">
                <table class='table table-borderless text-center'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>STATUS</th>
                            <th>DETAILS</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>TYPE</th>
                            <th>PAYMENT</th>
                            <th>UNITS</th>
                            <th>PRICE</th>
                            <th>CREATED</th>
                            <th>MODIFIED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)):
                        ?>

                            <tr>
                                <td>
                                    <span class="badge badge-light"><?php echo $row['order_id'] ?></span>
                                </td>
                                <td>
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

                                <td>

                                    <a style="color:#F67E29;" href="orderDetail.php?id=<?php echo $row['order_id'] ?>">
                                        <i class="fas fa-info-circle"></i></a>

                                </td>
                                <td>
                                    <span class="badge badge-light"><?php echo $row['full_name'] ?></span>
                                </td>
                                <td>
                                    <span class="badge badge-light"><?php echo $row['email'] ?></span>
                                </td>
                                <td>
                                    <?php if ($row['store_id'] == 0) { ?>
                                        <span class="badge badge-light">Store Pickup</span>

                                    <?php } else {
                                        echo '<span class="badge badge-light">Home Delivery</span>';
                                    } ?>
                                </td>
                                <td>
                                    <span class="badge badge-light"><?php echo $row['payment_type'] ?></span>
                                </td>
                                <td>
                                    <span class="badge badge-light"><?php echo $row['total_qty'] ?></span>
                                </td>
                                <td>
                                    <span class="badge badge-light">&#x20B9;&nbsp;<?php echo $row['total_amt'] ?></span>
                                </td>
                                <td>
                                    <span class="badge badge-light"><?php echo $row['created_date'] ?></span>
                                </td>
                                <td>
                                    <span class="badge badge-light"><?php echo $row['modified_date'] ?></span>
                                </td>
                            </tr>
                        <?php
                       endwhile;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php  } ?>
    </div>
</div>
</div>
</body>
<script src="https://kit.fontawesome.com/77f6dfd46f.js" crossorigin="anonymous"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</html>