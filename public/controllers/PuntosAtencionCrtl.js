SeriesApp.controller('PuntosAtencionCrtl', function ($scope, $routeParams, $location, PuntoAtencionService, $http, $timeout, base_api) {


$scope.title = "Punto Atencion";
$scope.series = [];

$scope.getData = function(){
  $http.get(base_api + "/admin/postpuntoatencion")
    .success(function(response){
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
$scope.series = PuntoAtencionService.query();



$scope.eliminar = function(id){


swal({
  title: "Estas seguro?",
  text: "No podrá recuperar este archivo!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Eliminado!",
  cancelButtonText: "No, lo Elimines!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {

  $.ajax({
  url: base_api + '/eliminar/puntoatencion/' + id,
  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
    swal("Eliminado!", "Registro Eliminado.", "success");
    $scope.getData();
});


  } else {
    swal("Cancelado", "No elimino su registro :)", "error");
  }
});


  }




});


