SeriesApp.controller('IndicadoresCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api) {

//
  $scope.title = "Indicadores";
  $scope.series = [];
  
  $scope.getData = function(){
    $http.get(base_api + "/admin/postindicadores")
      .success(function(response){
      $scope.list = response;
      console.log(response);
      $scope.currentPage = 1; //current page
      $scope.entryLimit = 5; //max no of items to display in a page
      $scope.filteredItems = $scope.list.length; //Initially for no filter
      $scope.totalItems = $scope.list.length;
    });
  };
  
  $scope.pageSize = 50;
  
  $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
  
      };
      $scope.filter = function() {
          $timeout(function() {
              $scope.filteredItems = $scope.filtered.length;
          }, 10);
      };
      $scope.sort_by = function(predicate) {
          $scope.predicate = predicate;
          $scope.reverse = !$scope.reverse;
      };
  
  $scope.getData();
  
  
  });
  
  
  