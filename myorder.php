<?php
  session_start();
  require_once('essentials/config.php');
  include('essentials/function.php');
  include('boilerplate.php');
  include('navbar.php');
  $customer = $_SESSION['email']; 
  
  $c = "SELECT * FROM customer WHERE email = '$customer'";
  $r = mysqli_query($connect,$c);
  $row_c =mysqli_fetch_assoc($r);
   $customer_id = $row_c['id'];
   $customer_name = $row_c['name'];

  $sql = "SELECT * FROM orders WHERE customer = '$customer' ORDER BY created_date DESC";
  $run = mysqli_query($connect,$sql);
  $count = mysqli_num_rows($run);

  $sql2 = "SELECT * FROM wishlist WHERE customer_id='$customer_id'";
  $run2 =mysqli_query($connect,$sql2);
  $count_fav = mysqli_num_rows($run2);
  
?>
<style type="text/css">
	/*sidebar*/
.dash {
  list-style: none;
  padding: 0;
}

</style>
<br>
 <div class="container">
   <div class="row">
  
     <div class="col-md-9">
     	<h4 style="text-align: center; color: grey;">All Order Detail</h4>
     	Total Orders : <?php echo $count ?>
       <table class="table">
				<tr>
					<th>OrderID</th>
					<th>Total Amount</th>
					<th>Total Qty</th>
					<th>Payment Type</th>
					<th>Status</th>
					<th>Order Time</th>
					<th></th>
				</tr>
				<?php while($row = mysqli_fetch_assoc($run)): 
					$status = $row['status'];
				?>
				<tr>
					<td>ORD_<?php echo $row['order_id'] ?></td>
					<td>&#x20B9;&nbsp;<?php echo $row['total_amt'] ?></td>
					<td><?php echo $row['total_qty'] ?></td>
					<td><?php echo $row['payment_type'] ?></td>
					<td>
						<?php if($status == 2) { ?>
    				<span class="badge badge-pill badge-warning">UnPaid</span>
    			 
			          <?php } else if($status == 3){ ?>
			            <span class="badge badge-pill badge-info">Paid</span>

			              <?php } else if($status == 4){ ?>
			            <span class="badge badge-pill badge-light">Shipping</span>
			         
			          <?php }else{  ?>
			           <span class="badge badge-pill badge-dark"> Delivered</span>
			          <?php  }?>
					</td>
					<td><span class="fa fa-clock-o"></span> <?php echo $row['created_date'] ?></td>
					<td>
						<a href="order_detail.php?id=<?php echo $row['order_id'] ?>">Detail</a>
					</td>
				</tr>
			<?php endwhile ; ?>
			</table>
     </div> <!-- col-md-8 end-->
        <div class="col-md-3">

        
       <ul class="dash">
        <li>
            <b><a href="index.php">DashBoard</a></b>
          </li>
          <li><a href='myorder.php'>My Order<span class='label label-warning' style='margin-left: 8px;'><?php echo $count ?></a></li>
          <li><a href='dashboard.php'>Favourite Items<span class='label label-danger' style='margin-left: 8px;'><?php echo $count_fav ?></a></li>
        </ul><br><br>
        <hr>
         <ul class="dash">
        <li>
            <b><a href="index.php">Account Options</a></b>
          </li>
          <li><a href=''>View Profile</a></li>
          <li><a href=''>Edit Profile</a></li>
          <li><a href=''>Logout</a></li>
        </ul><br><br>

        <hr>
         <ul class="dash">
        <li>
            <b><a href="index.php">Account Info</a></b>
          </li>

          <li><?php echo $customer_name ?></li>
          <li><?php echo $customer ?></li>
          <li>Member Since : </li>
        </ul>
     </div> 
   </div>
 </div>

 <?php   include('footer.php'); ?>




  
