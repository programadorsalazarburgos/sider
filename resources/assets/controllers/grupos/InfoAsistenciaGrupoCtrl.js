SeriesApp.controller("InfoAsistenciaGrupoCtrl", function($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Mis Beneficiarios";



console.log($routeParams.grupo);
console.log($routeParams.id);



$scope.series = [];
$scope.no_grupo = $routeParams.id;

  $http.get(base_api + "/obtener/nombre_grupo/" + $routeParams.grupo)
    .success(function(response_grupo){

      console.log(response_grupo);
      $scope.nombre_grupo = response_grupo.codigo_grupo;
      $scope.nombre_grado = response_grupo.nombre_grado;

    });


  $http.get(base_api + "/obtener/nombre_beneficiario/" + $routeParams.id)
    .success(function(response_beneficiario){

      console.log(response_beneficiario);
      $scope.nombre_primero = response_beneficiario.nombre_primero;
      $scope.apellido_primero = response_beneficiario.apellido_primero;

    });



$scope.getData = function(){
   

   $scope.grupo = $routeParams.id;
   $http.get(base_api + "/obtener/misasistencias/" + $routeParams.id + "/" + $routeParams.grupo)
    .success(function(response){
      console.log(response);
    $scope.list = response;
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 35; //max no of items to display in a page
    $scope.filteredItems = $scope.list.length; //Initially for no filter
    $scope.totalItems = $scope.list.length;
  });
};

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
