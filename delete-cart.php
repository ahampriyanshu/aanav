<?php

session_start();

include('essentials/config.php');

unset($_SESSION['cart']);

header("location: cart.php");

?>
