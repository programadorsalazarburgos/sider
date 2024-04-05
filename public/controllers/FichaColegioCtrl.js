SeriesApp.controller('FichaColegioCtrl', function ($scope, $routeParams, $location, SedeService, $http, $timeout, base_api) {

$scope.title = "Ficha Colegio";
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

$scope.ObtenerEquipamientos = function(modalstate, id) {

    $scope.modalstate = modalstate;
    switch(modalstate) {
        case 'obtener':
        $scope.titulo = "EQUIPAMIENTOS";
        $scope.metodo = 1;
        $scope.valorID = id;
       
        $http.get(base_api + "/obtener/equipamientos/" + id)
        .success(function(response){
        $scope.equipamientosedes = response;
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


