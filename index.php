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
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <div class="banner-section carousel-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="img/section/men.png" alt="">
                        <div class="inner-text">
                            <h4>Men’s</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="img/section/women.png" alt="">
                        <div class="inner-text">
                            <h4>Women’s</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="img/section/kid.png" alt="">
                        <div class="inner-text">
                            <h4>Kid’s</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <script type="text/javascript">
    $(function(){
        $('work').carousel({
            interval: 3000
        });
    });
</script>

<div id="work" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
    <img class="d-block w-100" src="img/cover/work.png" alt="Second slide">
      
      <div class="carousel-caption d-none d-md-block">
    <h1 style="font-weight: 600; margin-bottom: 120px; margin-right: 515px; font-size: 38px;">SELL WITH US
      <p style="font-size: 14px;">Grow Your Business Online</p>
      <a href="home.php"  style="clear:both; background: #fff; border: none; color: #000; font-size: 1em; padding: 10px; cursor: pointer; font-size: 17px;" >KNOW MORE <span class="fa fa-arrow-right" style="margin-left: 9px;"></span></a>
    </h1>
  </div>
    </div>
  </div>
</div>

<?php include('latest.php'); ?>
<?php include('trending.php'); ?>
<?php include('recently-viewed.php'); ?>
<?php include('footer.php'); ?>