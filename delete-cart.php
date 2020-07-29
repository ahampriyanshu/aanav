<?php

session_start();

require_once('essentials/config.php');

unset($_SESSION['cart']);

header("location: cart.php");

?>
