<?php
	require_once('essentials/config.php');
	$query = "select * from product";
	$result = mysqli_query($connect, $query);



	$total_posts = mysqli_num_rows($result);

	$total_pages = ceil($total_posts / $per_page);
	
	$page_url = $_SERVER['PHP_SELF'];
	

	echo "<ul class='pagination'>";

    if ($page != 1) {
        echo"
	<li class='page-item'><a  class='page-link' href ='$page_url?page=1'>First</a></li>";
	}
	
	?>
	<?php for($i = 1; $i <= $total_pages; $i++ ): ?>
		<li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
			<a class="page-link" href="<?php echo $page_url ?>?page=<?= $i; ?>"> <?= $i; ?> </a>
		</li>
		<?php endfor; 
		
        if ($page != $total_pages) {
            echo"<li class='page-item'><a href='$page_url?page=$total_pages' class='page-link'>Last</a></li>";
        }

	echo "</ul>";


	?>