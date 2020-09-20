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

    <title>Admin Home</title>

    <link rel="icon" href="../img/favicon.ico" sizes="16x16" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/chart.css">

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
                            <a href="index.php"><i class="fa fa-home mr-3"></i>Home</a>
                        </li>
                        <li>
                            <a href="manageCustomer.php"><i class="fa fa-users mr-3"></i>Customers</a>
                        </li>
                        <li>
                            <a href="manageOrder.php"><i class="fa fa-archive mr-3"></i>Orders</a>
                        </li>
                        <li>
                            <a href="salesReport.php"><i class="fas fa-file-invoice-dollar mr-3"></i>Sales Report</a>
                        </li>
                        <li>
                            <a href="manageProduct.php"><i class="fa fa-cubes mr-3"></i>Product</a>
                        </li>
                        <li>
                            <a href="manageCarousel.php"><i class="fa fa-images mr-3"></i>Carousel</a>
                        </li>
                        <li>
                            <a href="manageColorSize.php"><i class="fa fa-fill-drip mr-3"></i>Color & Size</a>
                        </li>
                        <li>
                            <a href="manageSection.php"><i class="fa fa-sitemap mr-3"></i>Sections</a>
                        </li>
                        <li>
                            <a href="manageCategory.php"><i class="fa fa-ethernet mr-3"></i>category</a>
                        </li>
                        <li>
                            <a href="manageBrand.php"><i class="fa fa-cc-mastercard mr-3"></i>Brands</a>
                        </li>
                        <li>
                            <a href="manageSupplier.php"><i class="fas fa-street-view mr-3"></i>Supplier</a>
                        </li>
                        <li>
                            <a href="manageStore.php"><i class="fa fa-store-alt mr-3"></i>Store</a>
                        </li>
                        <li>
                            <a href="key.php"><i class="fa fa-key mr-3"></i>Regenerate Key</a>
                        </li>
                        <li>
                            <a href="vendorMessages.php"><i class="fa fa-envelope-open-text mr-3"></i>Messages</a>
                        </li>
                    </ul>
                    <div class="footer">
                        <p class="text-center" style="font-size:1.2em;"><a href="logout.php"><i class="fas fa-toggle-off"></i>&nbsp;Logout</a></p>
                        <p class="text-center" style="font-size:0.8em;"><i class="fab fa-github"></i>ahmampriyanshu &copy; MIT Licensed</p>
                    </div>
                </div>
            </nav>

            <div class="container align-content-center text-center">
                <div class="col-lg-9 mx-auto my-4 text-center">
                    <h1><span class="badge badge-dark">Admin Dashboard</span></h1>
                </div>



                <div class="row">

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM orders ");
                    $orders = mysqli_num_rows($result);
                    ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-grow-early">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Orders</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span><?php echo $orders ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM customer ");
                    $customer = mysqli_num_rows($result);
                    ?>


                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-midnight-bloom">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Customers</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span><?php echo $customer ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $result = mysqli_query($connect, 'SELECT SUM(total_amt) AS total_amt_sum FROM orders');
                    $row = mysqli_fetch_assoc($result);
                    $sum = $row['total_amt_sum'];
                    ?>


                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-premium-dark">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Products Sold</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-warning">&#x20B9;&nbsp;<span><?php echo $sum / 1000 ?>K</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 mx-auto mt-2 mb-5 text-center">
                    <h5><span class="badge badge-dark">New Orders</span></h5>
                </div>

                <div class="row">

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM orders WHERE status = 4 ");
                    $delivered = mysqli_num_rows($result);
                    ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Orders Delivered</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-success"><span><?php echo $delivered ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM orders WHERE status = 0 ");
                    $orders = mysqli_num_rows($result);
                    ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Orders Cancelled</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-danger"><span><?php echo $orders ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM orders WHERE status = 6 ");
                    $orders = mysqli_num_rows($result);
                    ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Orders Refunded</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-info"><span><?php echo $orders ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mx-auto my-5">
                    <div class="table-responsive">
                        <table class='table table-borderless text-center'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>STATUS</th>
                                    <th>DETAILS</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>TYPE</th>
                                    <th>PAYMENT</th>
                                    <th>UNITS</th>
                                    <th>PRICE</th>
                                    <th>CREATED</th>
                                    <th>MODIFIED</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = "SELECT * FROM orders ORDER BY order_id DESC LIMIT 12";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <tr>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['order_id'] ?></span>
                                        </td>
                                        <td>
                                            <?php if ($row['status'] == 0) { ?>
                                                <span class="badge  badge-danger">Cancelled</span>

                                            <?php } else if ($row['status'] == 1) { ?>
                                                <span class="badge  badge-warning">Placed</span>

                                            <?php } else if ($row['status'] == 2) { ?>
                                                <span class="badge  badge-success">Approved</span>

                                            <?php } else if ($row['status'] == 3) { ?>
                                                <span class="badge  badge-info">Shipped</span>

                                            <?php } else if ($row['status'] == 4) { ?>
                                                <span class="badge  badge-success">Deliverd</span>

                                            <?php } else if ($row['status'] == 5) { ?>
                                                <span class="badge  badge-info">Refund Requested</span>

                                            <?php } else if ($row['status'] == 6) { ?>
                                                <span class="badge  badge-success">Refunded</span>

                                            <?php } else {  ?>
                                                <span class="badge  badge-danger">Error</span>
                                            <?php  } ?>
                                        </td>

                                        <td>

                                            <a style="color:#F67E29;" href="orderDetail.php?id=<?php echo $row['order_id'] ?>">
                                                <i class="fas fa-info-circle"></i></a>

                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['full_name'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['email'] ?></span>
                                        </td>
                                        <td>
                                            <?php if ($row['store_id'] == 0) { ?>
                                                <span class="badge badge-light">Store Pickup</span>

                                            <?php } else {
                                                echo '<span class="badge badge-light">Home Delivery</span>';
                                            } ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['payment_type'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['total_qty'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light">&#x20B9;&nbsp;<?php echo $row['total_amt'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['created_date'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light"><?php echo $row['modified_date'] ?></span>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="col-lg-9 mx-auto mt-2 mb-5 text-center">
                    <h5><span class="badge badge-dark">New Customer</span></h5>
                </div>

                <div class="row">

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM customer WHERE status = 1 ");
                    $active = mysqli_num_rows($result);
                    ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Active Account</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-success"><span><?php echo $active ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM customer WHERE status = 0 ");
                    $unverified = mysqli_num_rows($result);
                    ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Unverified Account</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-warning"><span><?php echo $unverified ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM customer WHERE status > 1 ");
                    $unactive = mysqli_num_rows($result);
                    ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Unactive Account</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-danger"><span><?php echo $unactive ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 mx-auto my-5">
                    <div class="table-responsive">
                <table class='table table-borderless text-center'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHONE</th>
                            <th>STATUS</th>
                            <th>REGISTERED</th>
                            <th>LAST LOGIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * FROM customer ORDER BY id DESC LIMIT 12";
                        $result = mysqli_query($connect, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <tr>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['id'] ?></span>
                                </td>

                                <td>
                                    <span class="badge  badge-light"><?php echo $row['name'] ?></span>
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['email'] ?></span>
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['phone'] ?></span>
                                </td>
                                <td>
                                    <?php if ($row['status'] == 0) { ?>
                                        <span class="badge badge-warning">Unverified</span>

                                    <?php } else if ($row['status'] == 1) { ?>
                                        <span class="badge badge-success">Active</span>

                                    <?php } else if ($row['status'] == 2) { ?>
                                        <span class="badge badge-success">Unactive</span>

                                    <?php } else if ($row['status'] == 3) { ?>
                                        <span class="badge badge-info">Disabled</span>

                                    <?php } else {  ?>
                                        <span class="badge badge-danger">Error</span>
                                    <?php  } ?>
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['datetym'] ?></span>
                                </td>
                                <td>
                                    <span class="badge  badge-light"><?php echo $row['last_login'] ?></span>
                                </td>
                               
                            </tr>
                        <?php

                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


                <div class="col-lg-9 mx-auto mt-2 mb-5 text-center">
                    <h5><span class="badge badge-dark">New Products</span></h5>
                </div>

                <div class="row">

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM product WHERE status =  1");
                    $actPro = mysqli_num_rows($result);
                    ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Active Product</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-success"><span><?php echo $actPro ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM product WHERE status = 0 ");
                    $unacPro = mysqli_num_rows($result);
                    ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Unactive Product</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-warning"><span><?php echo $unacPro ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $result = mysqli_query($connect, "SELECT * FROM product WHERE qty = 0 ");
                    $soldOut = mysqli_num_rows($result);
                    ?>

                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Sold Out Product</div>
                                              </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-danger"><span><?php echo $soldOut ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mx-auto mt-5">
                    <div class="table-responsive">
                        <table class='table table-borderless text-center'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PRODUCT</th>
                                    <th>NAME</th>
                                    <th>CODE</th>
                                    <th>UNITS</th>
                                    <th>PRICE</th>
                                    <th>CREATED</th>
                                    <th>MODIFIED</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = "SELECT * FROM product ORDER BY id DESC LIMIT 12";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <tr>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['id'] ?></span>
                                        </td>
                                        <td>
                                            <img width="150" height="150" src="../uploads/<?php echo $row['file'] ?>" alt="product image">
                                        </td>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['name'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['code'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['qty'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge  badge-light">&#x20B9;&nbsp;<?php echo $row['cost'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['created_date'] ?></span>
                                        </td>
                                        <td>
                                            <span class="badge  badge-light"><?php echo $row['modified_date'] ?></span>
                                        </td>
                                    </tr>
                                <?php

                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/77f6dfd46f.js" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootbox.min.js"></script>
    <script src="js/jquery-3.3.1.js"></script>
</body>

</html>