<?php
require_once('essentials/config.php');
?>

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
$query = "select * from product";
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