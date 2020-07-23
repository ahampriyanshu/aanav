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

<!--  2nd nav bar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><img alt="logo_nav" src="image/logo_nav.png" width="100" height="40"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="home.php">Customers</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="best-seller.php">Products</a>
      </li>

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

      
  </div>
</nav>