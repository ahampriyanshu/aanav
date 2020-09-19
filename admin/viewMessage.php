<?php
require('header.php');
if (!$_GET['id']) {
    echo '<script>
     location.href="logout.php"
     </script>';
 }
 $msg_id = $_GET['id'];
?>
<div class="container">
    <div class="row">
        <div class="col-lg-9 mx-auto my-4 text-center">
            <h2><span class="badge badge-success"><i class="fas fa-envelope-open-text"></i>  Inbox</span></h2>
        </div>
        <div class="col-lg-9 mx-auto text-center">

                <?php
$query = "SELECT * FROM msg WHERE msg_id='$msg_id' ";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
?>
<div class="text-left">
                                   <p><span class="badge badge-dark">NAME</span> <span class="badge  badge-light"><?php echo $row['name'] ?></span></p>
                                   <p><span class="badge badge-dark">EMAIL</span>  <span class="badge badge-light"><?php echo $row['email'] ?></span></p>
                                   <p> <span class="badge badge-dark">PHONE</span> <span class="badge badge-light"><?php echo $row['phone'] ?></span></p>
                                   <p><span class="badge badge-dark">DATED</span>  <span class="badge badge-light"><?php echo $row['created_date'] ?></span></p>
                                 
                                   <p><span class="badge badge-dark">MESSAGE</span>  <span class="badge  badge-light"><?php echo $row['msg'] ?></span></p>
                                   </div>

        </div>
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