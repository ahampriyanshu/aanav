<?php
session_start();
include('../essentials/config.php');

if (!isset($_SESSION['admin'])) {
	header('location:logout.php');
}

$total = $_POST['total'];
$total_qty = 0;

for ($i = 1; $i <= $total; $i++) {
	$id = $_POST["id$i"];
	$color_id = $_POST["color$i"];
	$size_id = $_POST["size$i"];
	$qty = $_POST["qty$i"];



	$sql = "INSERT INTO variant(product_id,color,size,qty) 
	        VALUES('" . $id . "','" . $color_id . "','" . $size_id . "','" . $qty . "')";
	$sql = $connect->query($sql);
	$total_qty += $qty;
	
}
if ($connect->query("UPDATE product SET qty = " . $total_qty . " WHERE id = " . $id)) {
if ($sql) {
?>
	<script>
		alert('<?php echo $total . " records was inserted !!!"; ?>');
		window.location.href = 'manageProduct.php';
	</script>
<?php
} else {
?>
	<script>
		alert('error while inserting , TRY AGAIN');
	</script>
<?php
}
}
?>