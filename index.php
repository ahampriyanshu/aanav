<?php
include('boilerplate.php');
?>
<section class="hero-section">
    <div class="hero-items owl-carousel">
        <?php
        $query = "SELECT * FROM carousel ORDER BY carousel_id ASC ";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="single-hero-items set-bg" data-setbg="uploads/<?php echo $row['file'] ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <h1><?php echo $row['heading'] ?></h1>
                            <p><?php echo $row['subheading'] ?></p>
                            <a href="<?php echo $row['link'] ?>" class="primary-btn"><?php echo $row['text'] ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<style>
    .single-banner {

        transition: transform .3s;
        opacity: 1;
    }

    .single-banner:hover {
        transform: scale(1.05);
        opacity: 1;
    }
</style>
<div class="banner-section carousel-info">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="single-banner">
                    <img src="img/section/men.png" height='300' alt="men section">
                    <div class="inner-text">
                        <h4>Men</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-banner">
                    <img src="img/section/women.png" height='300' alt="women section">
                    <div class="inner-text">
                        <h4>Women</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-banner">
                    <img src="img/section/kid.png" height='300' alt="kid section">
                    <div class="inner-text">
                        <h4>Kids</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('work').carousel({
            interval: 3000
        });
    });
</script>
<?php include('latest.php'); ?>
<?php include('trending.php'); ?>
<?php include('recentlyViewed.php'); ?>
<?php include('bestSeller.php'); ?>
<div class="carousel-inner">
    <div class="carousel-item active">
        <img class="float-lg-right" src="img/work.png" alt="work">
        <div class="d-none d-md-block">
            <div style="top: 30%;" class="carousel-caption">
                <div class="float-lg-left">
                    <h1 style=" font-size: 35px; font-weight: 700; color: #2C44A1;">
                        Grow Your Business<br>Online
                        <p style="font-size: 14px; color: #2C44A1;">Experience Exponential Increase</p>
                        <p><a href="work.php" class="btn btn-sm btn-success">Work With Us<span class="fa fa-arrow-right" style="margin-left: 9px;"></span></a></p>
                    </h1>
                </div>
            </div>
        </div>
        <div class="d-block d-md-none text-center">
            <h1 style=" font-size: 25px; font-weight: 600; color: #2C44A1;">
                Grow Your Business Online
                <div style="bottom: 15%;" class="carousel-caption">

                    <div class="float-lg-left">
                        <p><a href="work.php" class="btn btn-sm btn-success">Work With Us<span class="fa fa-arrow-right" style="margin-left: 9px;"></span></a></p>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>