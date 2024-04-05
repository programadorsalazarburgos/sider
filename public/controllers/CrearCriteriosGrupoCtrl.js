SeriesApp.controller('CrearCriteriosGrupoCtrl', function ($scope, $routeParams, $location, GrupoService, $http, $timeout, base_api) {


$scope.title = "Crear Criterios";
$scope.series = [];

$scope.valor = $routeParams.id;


  $http.get(base_api + "/obtener/nombre_grupo/" + $routeParams.id)
    .success(function(response_grupo){

      $scope.nombre_grupo = response_grupo.codigo_grupo;
      $scope.nombre_grado = response_grupo.nombre_grado;

    });



$scope.getData = function(){
  $http.get(base_api + "/admin/postcriteriosGrupo/" + $routeParams.id)
    .success(function(response){
    $scope.list = response;
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
$scope.series = GrupoService.query();



$scope.toggle = function(modalstate) {

      $scope.modalstate = modalstate;
      switch(modalstate) {
          case 'CrearRol':
          $scope.titulo = "CREAR";
          $scope.metodo = 1;
          break;
       
      }

      $('#myModal').modal('show');
  }


$scope.EditarCriterio = function(modalstate, id) {

      $scope.modalstate = modalstate;
      switch(modalstate) {
          case 'editar':
          $scope.titulo = "EDITAR";
          $scope.metodo = 2;
          $scope.valorID = id;
          $http.get(base_api + "/obtener/criterio/" + id)
              .success(function(response){
                $scope.serie = response;
          });

          break;
       
      }

      $('#myModal').modal('show');
  }


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
  url: base_api + '/eliminar/criterio/' + id,
  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
    swal("Eliminado!", "Registro Eliminado.", "success");
    $scope.getData();

}).error(function() {

   swal("Cancelado", "No puede eliminar este criterio tiene datos :)", "error");
});



  } else {
    swal("Cancelado", "No elimino su registro :)", "error");
  }
});

  }

$scope.GuardarCriterio = function(valor){


  var midata = new FormData();
  var nombre = $scope.serie.nombre_criterio;
  midata.append('nombre',nombre);
    
  $.ajax({
    url: base_api + '/guardar/criterio/' + valor,
    type: 'POST',
    contentType: false,
    data: midata,  // mandamos el objeto formdata que se igualo a la variable data
    processData: false,
    cache: false,
    success: function (respuestaAjax) {
    swal("Almacenado!", "Registro Guardado.", "success");
    $scope.getData();
    $scope.serie.nombre_criterio = '';
    $('#myModal').modal('hide');
    }
  });
 };



$scope.ActualizarCriterio = function(valorID){

  
  var midata = new FormData();
  var nombre = $scope.serie.nombre_criterio;
  midata.append('nombre',nombre);
    
  $.ajax({
    url: base_api + '/actualizar/criterio/' + valorID,
    type: 'POST',
    contentType: false,
    data: midata,  // mandamos el objeto formdata que se igualo a la variable data
    processData: false,
    cache: false,
    success: function (respuestaAjax) {
    swal("Almacenado!", "Registro Guardado.", "success");
    $scope.getData();
    $('#myModal').modal('hide');
    }
  });
 };


});


