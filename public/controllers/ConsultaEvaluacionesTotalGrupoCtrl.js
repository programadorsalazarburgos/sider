SeriesApp.controller("ConsultaEvaluacionesTotalGrupoCtrl", function($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Consulta Total Evaluaciones";


$scope.series = [];
$scope.no_grupo = $routeParams.id;

  $http.get(base_api + "/obtener/nombre_grupo/" + $routeParams.id)
    .success(function(response_grupo){

      $scope.nombre_grupo = response_grupo.codigo_grupo;
      $scope.nombre_grado = response_grupo.nombre_grado;

    });



 $http.get(base_api + "/admin/postcriteriosGrupo/" + $routeParams.id)
    .success(function(response){
    $scope.criterios = response;
   // console.log($scope.criterios);

  });


 $scope.items = [{
      Name: "Soap",
      Price: "25",
      Quantity: "10"
    }, {
      Name: "Bag",
      Price: "100",
      Quantity: "15"
    }, {
      Name: "Pen",
      Price: "15",
      Quantity: "13"
    }];



$scope.pageSize = 50;


$scope.getData = function(){
   $scope.series_grupos = GrupoService.get({id:$routeParams.id});


   $scope.grupo = $routeParams.id;
   $http.get(base_api + "/obtener/misbeneficiariosevaluaciones/" + $routeParams.id)
    .success(function(response){
    $scope.list = response;
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 5; //max no of items to display in a page
    $scope.filteredItems = $scope.list.length; //Initially for no filter
    $scope.totalItems = $scope.list.length;
 



$scope.list.map(function(beneficiario) {
    
$scope.prueba = beneficiario;
// console.log(beneficiario);
 
      if (beneficiario.no_ficha == 'TOTAL') {

        beneficiario.nombre_primero = '';

      }

      return beneficiario;
    })






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
$scope.series = GrupoService.query();






  });
