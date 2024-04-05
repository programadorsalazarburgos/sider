SeriesApp.controller("CreateMetaCtrl", function($scope, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q){
  
  
  $scope.reset = function () {
    $scope.state = undefined;
};

var year = new Date().getFullYear();
    var range = [];
    range.push(year);
    for (var i = 1; i < 7; i++) {
        range.push(year + i);
    }
    $scope.years = range;

$http.get(base_api + "/obtener/programaselect")
            
.success(function(programas){
      
      $scope.programas = programas;
  
});

$scope.title = "Creacion Meta";
$scope.formsubmit = function(){

var datos ={

nombre_meta: $scope.nombre_meta,
programa: $scope.programa,
anualidad: $scope.anualidad,
cantidad_meta: $scope.cantidad_meta,
descripcion: $scope.descripcion

                     
      };


$.ajax({
       url: base_api + '/postmeta/create',
         type: 'POST',
        dataType: 'JSON',
        data: {
          datos
      },
  
      }).success(function(){
          swal("Muy bien!", "Su registro ha sido exitoso", "success");
          toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
          window.location="/admin/postmetas";

      })
      .error(function() {
        swal("Registro existente!", "Este registro ya existe", "error");
        toastr.error("Este registro ya existe", "Registro Existente");
        
      });
    }
  
  });
