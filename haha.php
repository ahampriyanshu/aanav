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
        <a href="shop.php">
              <img src="img/section/men.png" alt="men" class="img-responsive">
                 </a>
     <h3>SHOP FOR MEN</h3>
       </div> 
       <div class="col-sm-4 col-md-4">
        <a href="shop.php">
         <img src="img/section/kid.png" alt="kid" class="img-responsive">
       </a>
         <h3>SHOP FOR KID</h3>
           </div> 
       <div class="col-sm-4 col-md-4">
        <a href="shop.php">
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
      <a href="shop.php"  style="clear:both; background: #fff; border: none; color: #000; font-size: 1em; padding: 10px; cursor: pointer; font-size: 17px;" >KNOW MORE <span class="fa fa-arrow-right" style="margin-left: 9px;"></span></a>
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


<br>
<?php include('footer.php'); ?>
</body>
</html>

 

 
        
