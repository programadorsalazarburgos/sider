SeriesApp.controller('DisciplinasCrtl', function ($scope, $routeParams, $location, DisciplinaService, $http, $timeout, base_api) {

$scope.title = "Disciplinas";
$scope.series = [];

$scope.getData = function(){
  $http.get(base_api + "/admin/postdisciplinas")
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
$scope.series = DisciplinaService.query();



$scope.inactivar = function(id){


swal({
  title: "Estas seguro?",
  text: "Inactivaras esta disciplina!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Inactivalo!",
  cancelButtonText: "No, lo Inactive!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {

  $.ajax({
  url: base_api + '/inactivar/disciplinas/' + id,
  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
    swal("Inactivado!", "Registro Inactivado.", "success");
    $scope.getData();
});


  } else {
    swal("Cancelado", "No inactivo su registro :)", "error");
  }
});


  }

$scope.activar = function(id){


swal({
  title: "Estas seguro?",
  text: "activaras esta disciplina!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, activalo!",
  cancelButtonText: "No, lo active!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {

  $.ajax({
  url: base_api + '/activar/disciplinas/' + id,
  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
    swal("Activado!", "Registro activado.", "success");
    $scope.getData();
});


  } else {
    swal("Cancelado", "No activo su registro :)", "error");
  }
});


  }



});


