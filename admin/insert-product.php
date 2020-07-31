<?php
  session_start();
  include('../essentials/config.php');
  include('sidebar.php');

  $total = $_POST['total'];
	   
   for($i=1; $i<=$total; $i++)
   {

		 
		 $id = $_POST["id$i"];
		 $color_id = $_POST["color$i"];
		 $size_id = $_POST["size$i"];
		 $qty = $_POST["qty$i"];

	   

$sql="INSERT INTO variant(product_id,color,size,qty) 
	   VALUES('".$id."','".$color_id."','".$size_id."','".$qty."')";

	   $sql = $connect->query($sql);		
   }
   
   if($sql)
   {
	   ?>
	   <script>
	   alert('<?php echo $total." records was inserted !!!"; ?>');
	   window.location.href='product_display2.php';
	   </script>
	   <?php
   }
   else
   {
	   ?>
	   <script>
	   alert('error while inserting , TRY AGAIN');
	   </script>
	   <?php
   }

?>
