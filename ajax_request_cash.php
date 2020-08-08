<?php 
  session_start();
  include('essentials/config.php');

        $shipping = $_SESSION['shipping'];
        $result = mysqli_query($connect,"SELECT * FROM shipping where shipping_id='$shipping'");
        $row = mysqli_fetch_assoc($result);


	if(isset($_POST['shipping_validation']) && $_POST['shipping_validation'] !='')
	{ ?>
                
	    				<div class="panel-body">
                <div class="notice notice-warning">
        <strong><p>Dear <?php echo $row['full_name'] ?>,</p></strong> 
        <p>It is required of you to pay be</a></p>
    </div>
                        <a href="order-update.php" class="btn btn-info pull-right" style="margin-left: 4px">Place In Order</a>
                        <a href="shipping_info.php" class="btn btn-outline-info pull-right">Back</a>
                        
                        </div> 
                
                        
		
<?php	}

?>





