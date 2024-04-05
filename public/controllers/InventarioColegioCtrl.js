SeriesApp.controller('InventarioColegioCtrl', function ($scope, $routeParams, $location, SedeService, $http, $timeout, base_api) {

$scope.title = "Inventario Colegio";
$scope.series = [];

$scope.getData = function(){
  $http.get(base_api + "/admin/postsedes")
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
$scope.series = SedeService.query();

$scope.ObtenerImplementos = function(modalstate, id) {

    $scope.modalstate = modalstate;
    switch(modalstate) {
        case 'obtener':
        $scope.titulo = "IMPLEMENTOS";
        $scope.metodo = 1;
        $scope.valorID = id;
       
        $http.get(base_api + "/obtener/implementos/" + id)
        .success(function(response){
        $scope.implementosedes = response;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter
        $scope.totalItems = $scope.list.length;
        $scope.pageSize = 50;
        });
        break;
    }
    $('#myModal').modal('show');
    }
});


