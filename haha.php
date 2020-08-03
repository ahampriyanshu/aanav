<?php
  session_start();
  require_once('essentials/config.php');
  include('essentials/function.php');
  include('boilerplate.php');
  include('navbar.php');
?>

<!-- carousel start -->
<script type="text/javascript">
    $(function(){
        $('#carouselExampleIndicators').carousel({
            interval: 3000
        });
    });
</script>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
  </ol>

  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/main_banner/1.jpg" alt="First slide" style="width:100%; height: 800px; ">
      
      <div class="carousel-caption d-none d-md-block">
    <h1 style="font-weight: 600; margin-bottom: 350px; margin-left: 400px; font-size: 50px;">20% OFF EVERY MONDAY THROUGH
    	<p style="font-size: 12px;">SATISFIED FOR VARIOUS APPAREAL</p>
    </h1>
    
  </div>
    </div>

     <div class="carousel-item">
      <img src="img/main_banner/2.jpg" alt="First slide" style="width:100%; height: 800px; ">
      
      
      <div class="carousel-caption d-none d-md-block">
    <h1 style="font-size: 80px; font-weight: 900; margin-bottom: 350px; margin-left: 400px;">JACKET & SNEAKERS
    	<p style="font-size: 12px;">CHUNKY SOLE SNEAKER IN CONSTRATION COLORS</p>
    </h1>
  </div>
    </div>
    <div class="carousel-item">
      <img src="img/main_banner/3.jpg" alt="First slide" style="width:100%; height: 800px; ">
        <div class="carousel-caption d-none d-md-block">
    <h1 style="font-size: 50px; font-weight: 900; margin-bottom: 140px; margin-right: 290px; color: #000;">YEEZY BOOST 350 V2 <br>TRIPLE WHITE
<p style="font-size: 14px; color: #000;">September 21st.</p>
 <a href=""  style="clear:both; background: #000; border: none; color: #fff; font-size: 1em; padding: 10px; cursor: pointer; font-size: 17px;" />GET DISCOUNT <span class="fa fa-arrow-right" style="margin-left: 9px;"></span></a>
    </h1>
    
  </div>
    </div>
       <div class="carousel-item">
       <img src="img/main_banner/4.jpg" alt="First slide" style="width:100%; height: 800px; ">

      <div class="carousel-caption d-none d-md-block">
    <h1 style="font-size: 68px; font-weight: 900; margin-bottom: 400px; margin-left: 640px;">STATEMENT
    	<p style="font-size: 16px;">FLASH OF COLORS</p>
    </h1>
  </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  <style type="text/css">
    .uni img{
  
     
      width: 350px;
      height: 380px;
    
    }
    .uni{
      padding: 5px 15px;

    }

  </style>


<div class="container uni ">
    <div class="row">
       <div class="col-sm-4 col-md-4">
        <a href="home.php">
              <img src="img/section/men.png" alt="men" class="img-responsive">
                 </a>
     <h3>SHOP FOR MEN</h3>
       </div> 
       <div class="col-sm-4 col-md-4">
        <a href="home.php">
         <img src="img/section/kid.png" alt="kid" class="img-responsive">
       </a>
         <h3>SHOP FOR KID</h3>
           </div> 
       <div class="col-sm-4 col-md-4">
        <a href="home.php">
         <img src="img/section/women.png" alt="women" class="img-responsive">
       </a>
         <h3 align="center">SHOP FOR WOMEN</h3>
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

<div id="work" class="carousel slide" data-ride="carousel">
  

  <div class="carousel-inner">
    <div class="carousel-item active">
    <img class="d-block w-100" src="img/textile.jpeg" alt="Second slide" style=" height: 500px;">
      
      <div class="carousel-caption d-none d-md-block">
    <h1 style="font-weight: 600; margin-bottom: 120px; margin-right: 515px; font-size: 38px;">SELL WITH US
      <p style="font-size: 14px;">Grow Your Business Online</p>
      <a href="home.php"  style="clear:both; background: #fff; border: none; color: #000; font-size: 1em; padding: 10px; cursor: pointer; font-size: 17px;" >KNOW MORE <span class="fa fa-arrow-right" style="margin-left: 9px;"></span></a>
    </h1>
  </div>
    </div>
 
  </div>

</div>
<br>
<?php include('latest.php'); ?>
<style type="text/css">
  .forever21{
     padding: 15px 0px;
  }
  .forever21 img{
     width: 300px;
     height: 500px;
  }
</style>
<br>
<?php include('bestseller.php'); ?>

<style type="text/css">

.box21{text-align:center;position:relative}
.box21:after,.box21:before{content:"";width:2px;height:2px;border-radius:50%;background:rgba(0,0,0,.35);position:absolute;top:50%;left:50%;-webkit-transform:scale(0);-moz-transform:scale(0);-ms-transform:scale(0);-o-transform:scale(0);transform:scale(0)}
.box21:hover:after,.box21:hover:before{-webkit-transform:scale(400);-moz-transform:scale(400);-ms-transform:scale(400);-o-transform:scale(400);transform:scale(400)}
.box21:before{-o-transition:all .5s linear .3s;-moz-transition:all .5s linear .3s;-ms-transition:all .5s linear .3s;-webkit-transition:all .5s linear .3s;transition:all .5s linear .3s}
.box21:hover:before{-moz-transition-delay:0s;-webkit-transition-delay:0s;-o-transition-delay:0s;-ms-transition-delay:0s;transition-delay:0s}
.box21:after{-o-transition:all .5s linear .6s;-moz-transition:all .5s linear .6s;-ms-transition:all .5s linear .6s;-webkit-transition:all .5s linear .6s;transition:all .5s linear .6s}
.box21:hover:after{-moz-transition-delay:.2s;-webkit-transition-delay:.2s;-o-transition-delay:.2s;-ms-transition-delay:.2s;transition-delay:.2s}
.box21 img{width:100%;height:auto}
.box21 .box-content{width:100%;height:100%;position:absolute;top:0;left:0;background:0 0;color:#fff;padding-top:25px;-webkit-transform:scale(0);-moz-transform:scale(0);-ms-transform:scale(0);-o-transform:scale(0);transform:scale(0);-ms-transition:all .3s linear 0s;-o-transition:all .3s linear 0s;-webkit-transition:all .3s linear 0s;-moz-transition:all .3s linear 0s;transition:all .3s linear 0s;z-index:1}
.box21:hover .box-content{-webkit-transform:scale(1);-moz-transform:scale(1);-ms-transform:scale(1);-o-transform:scale(1);transform:scale(1);-moz-transition-delay:.4s;-webkit-transition-delay:.4s;-o-transition-delay:.4s;-ms-transition-delay:.4s;transition-delay:.4s}
.box21 .title{font-size:21px;font-weight:700;text-transform:uppercase;border-bottom:1px solid #fff;padding-bottom:20px;margin-top:20px}
.box21 .description{font-size:14px;font-style:italic;padding:0 10px;margin:15px 0}
.box21 .read-more{display:block;width:120px;background:#fff;border-radius:5px;font-size:12px;color:#000;text-transform:capitalize;padding:10px 0;margin:0 auto}
@media only screen and (max-width:990px){.box21{margin-bottom:30px}
}
@media only screen and (max-width:479px){.box21 .box-content{padding-top:0}
}
@media only screen and (max-width:359px){.box21 .title{padding-bottom:10px}
}
/*********************** haha*******************/
box1 img,.box1:after,.box1:before{width:100%;transition:all .3s ease 0s}
.box1 .icon,.box2,.box3,.box4,.box5 .icon li a{text-align:center}
.box10:after,.box10:before,.box1:after,.box1:before,.box2 .inner-content:after,.box3:after,.box3:before,.box4:before,.box5:after,.box5:before,.box6:after,.box7:after,.box7:before{content:""}
.box1,.box11,.box12,.box13,.box14,.box16,.box17,.box18,.box2,.box20,.box21,.box3,.box4,.box5,.box5 .icon li a,.box6,.box7,.box8{overflow:hidden}
.box1 .title,.box10 .title,.box4 .title,.box7 .title{letter-spacing:1px}
.box3 .post,.box4 .post,.box5 .post,.box7 .post{font-style:italic}

.mt-30{margin-top:30px}
.mt-40{margin-top:40px}
.mb-30{margin-bottom:30px}

</style>       
<br>
<?php include('footer.php'); ?>
</body>
</html>

 

 
        
