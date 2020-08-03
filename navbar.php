    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="essentials/fonts/icomoon/style.css">
    <link rel="stylesheet" href="essentials/css/bootstrap.min.css">
    <link rel="stylesheet" href="essentials/css/magnific-popup.css">
    <link rel="stylesheet" href="essentials/css/jquery-ui.css">
    <link rel="stylesheet" href="essentials/css/owl.carousel.min.css">
    <link rel="stylesheet" href="essentials/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="essentials/css/aos.css">
    <link rel="stylesheet" href="essentials/css/style.css">
    
  
  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              
              <div action="" class="site-block-top-search search-box">
                <input type="text" autocomplete="off" class="form-control border-0" placeholder="Search...">
                <div class="result"></div>
              </div>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
        
                <a href="index.php" class="js-logo-clone"><img src="img/logo_nav.png" width="200" height="95"></a>
            
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <li><a href="#"><i class="far fa-user"></i></a></li>
                  <li>
                  <a href="wishlist.php" class="site-cart">
                  <i class="fas fa-heart"></i>
                  <span class="count">2</span>
                  </a></li>
                  <li>
                    <a href="cart.php" class="site-cart">
                    <i class="fas fa-shopping-cart"></i>
                      <span class="count">2</span>
                    </a>
                  </li> 
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" 
                  class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                </ul>
              </div> 
            </div>

          </div>
        </div>
      </div> 
      <nav class="site-navigation text-right text-md-center" role="navigation">
      <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="home.php">Categories</a></li>
            <li><a href="home.php?key=best">Bestseller</a></li>
            <li><a href="home.php?key=new">New Arrivals</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>
  </div>
  <script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
  <script src="essentials/js/jquery-3.3.1.min.js"></script>
  <script src="essentials/js/jquery-ui.js"></script>
  <script src="essentials/js/popper.min.js"></script>
  <script src="essentials/js/bootstrap.min.js"></script>
  <script src="essentials/js/owl.carousel.min.js"></script>
  <script src="essentials/js/jquery.magnific-popup.min.js"></script>
  <script src="essentials/js/aos.js"></script>
  <script src="essentials/js/main.js"></script>