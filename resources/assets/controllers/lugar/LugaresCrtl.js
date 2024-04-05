SeriesApp.controller('LugaresCrtl', function ($scope, $routeParams, $location, LugarService, $http, $timeout, base_api) {


$scope.title = "Lugares";
$scope.series = [];

$scope.getData = function(){
  $http.get(base_api + "/admin/postlugares")
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
$scope.series = LugarService.query();



$scope.inactivar = function(id){


Swal.fire({title: 'Desea inactivar este registro?', showCancelButton: true}).then(result => {
  if (result.value) {
     $.ajax({
  url: base_api + '/inactivar/lugar/' + id,
  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
   
    Swal.fire(
  'Inactivado!',
  'Registro Inactivado',
  'success'
)
    $scope.getData();
});
  } else {
    
     Swal.fire({
  title: 'Cancelado!',
  text: 'No inactivo su registro :)',
  type: 'error',
  confirmButtonText: 'Cool'
})
  }
})


  }

$scope.activar = function(id){


Swal.fire({title: 'activaras este lugar de Atención?', showCancelButton: true}).then(result => {
  if (result.value) {
     $.ajax({
  url: base_api + '/activar/lugar/' + id,
  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
   
    Swal.fire(
  'Activado!',
  'Registro activado',
  'success'
)
    $scope.getData();
});
  } else {
    
     Swal.fire({
  title: 'Cancelado!',
  text: 'No activo su registro :)',
  type: 'error',
  confirmButtonText: 'Cool'
})
  }
})



  }



});


