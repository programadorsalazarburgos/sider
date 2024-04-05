SeriesApp.controller("GruposConsultaAsistenciaCrtl", function($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Mis Beneficiarios Consulta Asistencias";


$scope.series = [];



$scope.getData = function(){


   $http.get(base_api + "/obtener/misbeneficiariosasistencias")
    .success(function(response){
      console.log(response);
    $scope.list = response;
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 5; //max no of items to display in a page
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
$scope.series = GrupoService.query();



    $http.get(base_api + "/obtenerselect/comunas")
    .success(function(response){

      $scope.comunas = response;


    });



$scope.toggle = function(modalstate, id) {
      $scope.modalstate = modalstate;
      switch(modalstate) {


          case 'CambiarGrupo':
          $scope.form_contenido = "GRUPOS";
          $scope.form_title = "obtener";
          $scope.id = id;
       

          break;
        default:
          break;
      }

      $('#myModal').modal('show');
  }




 $http.get(base_api + "/obtener/allgruposmonitor")
    .success(function(response){
    $scope.grupos = response;
   

  });




  });
