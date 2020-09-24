<?php
    date_default_timezone_set('Asia/Kolkata');
    $host = "localhost";
    $db_user = "root";
    $db_pass = "Django@1212";
    $dbname = "aanav";
    $connect = new mysqli($host, $db_user, $db_pass, $dbname);
    $con = new PDO("mysql:host=$host; dbname=$dbname", $db_user, $db_pass);
?>