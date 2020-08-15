<?php
  include('boilerplate.php');
?>
 <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="img/cover/1.png">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <h1>Top Brands</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="img/cover/2.png">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <h1>Quality Prodects</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="img/cover/3.png">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <h1>Best Rates</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="img/cover/4.png">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <h1>Quality</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="banner-section carousel-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="img/section/men.png"  height='300' alt="">
                        <div class="inner-text">
                            <h4>Men’s</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="img/section/women.png"  height='300' alt="">
                        <div class="inner-text">
                            <h4>Women’s</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="img/section/kid.png" height='300' alt="">
                        <div class="inner-text">
                            <h4>Kid’s</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(function(){
        $('work').carousel({
            interval: 3000
        });
    });
</script>

<?php include('latest.php'); ?>
<?php include('trending.php'); ?>
<?php include('recently-viewed.php'); ?>

<div class="carousel-inner">
    <div class="carousel-item active">
    <img class="float-lg-right" src="img/work.png" alt="work" >
    <div  class="d-none d-md-block">
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

    <div class="d-block d-md-none">
    <div style="bottom: 15%;" class="carousel-caption">
    <div class="float-lg-left">
    <p><a href="work.php" class="btn btn-sm btn-success">Work With Us<span class="fa fa-arrow-right" style="margin-left: 9px;"></span></a></p>
</div>
    </div>
  </div>
    </div>
  </div>
  
<?php include('footer.php'); ?>