<?php
include("header.php");
include("essentials/database.php");
?>
<?php
date_default_timezone_set('Asia/Kolkata');
$email = $_POST['email'];
$pass = $_POST['pass'];
$name  = $_POST['name'];
$secu  = $_POST['security'];
$phone = $_POST['phone'];
$date = date('m/d/Y h:i:s', time());
$sql = "INSERT INTO customer (name,email,password,phone,datetym) VALUES
('$name','$email','$pass','$phone','$email','$date')";
$q = "select * from userbase where username = '$newuser'";
$result = mysqli_query($mysqli,$q);
$num = mysqli_num_rows($result);
if ($num == 1) {
echo "<script>
alert('Username already taken');
document.location='signup.php';
</script>";
}
else {
$qy = "INSERT INTO userbase(name,password,security,phone,email,datetym) VALUES ('$a$newuser','$pass','$name','$secu','$phone','$email','$date')";
mysqli_query($mysqli,$qy);
echo "<script>
alert('Login ID successfully created');
document.location='login.php';
</script>";

}
?>