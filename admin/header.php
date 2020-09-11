<?php
session_start();
include('../essentials/config.php');
error_reporting(E_ALL);
if (!isset($_SESSION['admin'])) {
  header('location:logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin Panel</title>

  <link rel="icon" href="../img/favicon.ico" sizes="16x16" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/admin.css">

</head>
<body>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebar">
        <div class="custom-menu">
          <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
          </button>
        </div>
        <div class="p-4">
          <h1><a href="index.php" class="logo">Hello, Admin</a></h1>
          <ul class="list-unstyled components">
            <li>
              <a href="manageCustomer.php"><i class="fa fa-user mr-3"></i>Customers</a>
            </li>
            <li>
              <a href="manageOrder.php"><i class="fa fa-briefcase mr-3"></i>Orders</a>
            </li>
            <li>
              <a href="salesReport.php"><i class="fa fa-sticky-note mr-3"></i>Sales Report</a>
            </li>
            <li>
              <a href="manageProduct.php"><i class="fa fa-suitcase mr-3"></i>Product</a>
            </li>
            <li>
              <a href="manageColorSize.php"><i class="fa fa-cogs mr-3"></i>Color & Size</a>
            </li>
            <li>
              <a href="manageSection.php"><i class="fa fa-cogs mr-3"></i>Sections</a>
            </li>
            <li>
              <a href="manageCategory.php"><i class="fa fa-paper-plane mr-3"></i>Categories</a>
            </li>
            <li>
              <a href="manageBrand.php"><i class="fa fa-paper-plane mr-3"></i>Brands</a>
            </li>
            <li>
              <a href="manageSupplier.php"><i class="fa fa-paper-plane mr-3"></i>Supplier</a>
            </li>
            <li>
              <a href="manageStore.php"><i class="fa fa-paper-plane mr-3"></i>Store</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-paper-plane mr-3"></i>Index Carousel</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-paper-plane mr-3"></i>Regenerate Key</a>
            </li>
          </ul>

          <div class="footer">
            <p class="text-center" style="font-size:1.2em;"><a href="logout.php"><i class="fas fa-toggle-off"></i>&nbsp;Logout</a></p>
            <p class="text-center" style="font-size:0.8em;"><i class="fab fa-github"></i>ahmampriyanshu &copy; MIT Licensed</p>
          </div>
        </div>
      </nav>