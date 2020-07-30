<style type="text/css">
  .form-inline .form-control {
    display: inline-block;
    width: 400px;
    vertical-align: middle;
}


#searchResult{
 list-style: none;
 padding: 0px;
 width: 407px;
 position: absolute;
 margin: 0;
  opacity: 10.95;
  z-index: 10;
  font-size: 12px;
}

#searchResult li{
 background: #fff;
 color: #000;
 padding: 4px;
 margin-bottom: 1px solid white;
 border-radius: 2px;

}

#searchResult li:nth-child(even){
 background: #fff;
 color: #000;
}

#searchResult li a{
 cursor: pointer;
 color: #666;
}

#searchResult li a:hover{
 cursor: pointer;
 color: teal;
}

.bg-light {
    background-color: #FFF !important;
}
.navbar-light .navbar-nav .nav-link {
    color: #000;
}
.bg-dark {
    background-color: #000 !important;
}

</style>

<div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" placeholder="Search">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="index.html" class="js-logo-clone">AANAV</a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <li><a href="#"><span class="icon icon-person"></span></a></li>
                  <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                  <li>
                    <a href="cart.html" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count">2</span>
                    </a>
                  </li> 
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                </ul>
              </div> 
            </div>

          </div>
        </div>
      </div> 
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li class="has-children active">
              <a href="index.html">Home</a>
              <ul class="dropdown">
                <li><a href="#">Menu One</a></li>
                <li><a href="#">Menu Two</a></li>
                <li><a href="#">Menu Three</a></li>
                <li class="has-children">
                  <a href="#">Sub Menu</a>
                  <ul class="dropdown">
                    <li><a href="#">Menu One</a></li>
                    <li><a href="#">Menu Two</a></li>
                    <li><a href="#">Menu Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="has-children">
              <a href="about.html">About</a>
              <ul class="dropdown">
                <li><a href="#">Menu One</a></li>
                <li><a href="#">Menu Two</a></li>
                <li><a href="#">Menu Three</a></li>
              </ul>
            </li>
            <li><a href="shop.html">Shop</a></li>
            <li><a href="#">Catalogue</a></li>
            <li><a href="#">New Arrivals</a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>
</div>

<!--<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><img alt="logo_nav" src="img/logo_nav.png" width="100" height="40"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="home.php">New Arrivals</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="best-seller.php">Best Seller</a>
      </li>
      
      
   <form method="get" action="search.php" class="form-inline my-2 my-lg-0">
   <div class="soso" ng-controller="fetchCtrl" ng-click='containerClicked();' >
        
           <input type='text' name="user_query" class="form-control mr-sm-2" ng-keyup='fetchUsers()' ng-click='searchboxClicked($event);' ng-model='searchText' placeholder='Search'><br>
            <ul id='searchResult' >
                <li ng-click='setValue($index,$event)' ng-repeat="result in searchResult" >
                  <a href="product.php?id={{result.id}}">
                  <img ng-src="uploads/{{ result.file }}" alt="search_image_result" width="30px" height="40px"> {{ result.name }}</a>
                </li>
            </ul>  
        </div>
       </form>
    </ul>
    
        <script>
        var fetch = angular.module('myapp', []);

        fetch.controller('fetchCtrl', ['$scope', '$http', function ($scope, $http) {
            
            $scope.fetchUsers = function(){
                
                var searchText_len = $scope.searchText.trim().length;

                if(searchText_len > 0){
                    $http({
                    method: 'post',
                    url: 'getData.php',
                    data: {searchText:$scope.searchText}
                    }).then(function successCallback(response) {
                        $scope.searchResult = response.data;
                    });
                }else{
                    $scope.searchResult = {};
                }
                
            }

            $scope.setValue = function(index,$event){
                $scope.searchText = $scope.searchResult[index].name;
                $scope.searchResult = {};
                $event.stopPropagation();
            }

            $scope.searchboxClicked = function($event){
                $event.stopPropagation();
            }

            $scope.containerClicked = function(){
                $scope.searchResult = {};
            }
            
        }]);

        </script>

      <ul class="navbar-nav">
       <?php if (!isset($_SESSION['email'])) { ?>
        
         
            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          LOGIN/REGISTER
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="login.php">LOGIN</a>
          <a class="dropdown-item" href="register.php">REGISTER</a>
          
        </div>
      </li>
       <?php } else { ?>

        <?php
      //get user
    $email = $_SESSION['email'];
    $sql_customer = mysqli_query($mysqli, "SELECT * FROM customer WHERE email = '$email'");
    $row_customer = mysqli_fetch_assoc($sql_customer);

?>   
      <li class="nav-item dropdown">
        <a class="dropdown-item" href="cart.php"><i class="material-icons">shopping_cart</i></a>
      </li>
      <li class="nav-item dropdown">
        <a class="dropdown-item" href="dashboard.php"><i class="material-icons">dashboard</i></a>
      </li>
      <li>
          <a class="dropdown-item" href="logout.php">LOGOUT</a>
          </li>
          
        </div>
      </li>
        <?php } ?>
      </ul>
  </div>
</nav>
       -->