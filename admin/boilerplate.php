<?php
  session_start();
  require_once('../essentials/config.php');
  include('sidebar.php');
  
if(!isset($_SESSION['admin'])){
header('location: logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../favicon.ico">
    <title>Admin Panel</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/login.css">
  

    </head>
    <body>
    <script src="https://kit.fontawesome.com/77f6dfd46f.js" crossorigin="anonymous"></script>