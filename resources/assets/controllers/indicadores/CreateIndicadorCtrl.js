SeriesApp.controller("CreateIndicadorCtrl", function($scope, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q){
  
  
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

$http.get(base_api + "/obtener/metasanualidad")
            
.success(function(metas){
  $scope.metas = metas;
});

$scope.meses = [
  {id: 'Enero', nombre: 'Enero'},
  {id: 'Febrero', nombre: 'Febrero'},
  {id: 'Marzo', nombre: 'Marzo'},
  {id: 'Abril', nombre: 'Abril'},
  {id: 'Mayo', nombre: 'Mayo'},
  {id: 'Junio', nombre: 'Junio'},
  {id: 'Julio', nombre: 'Julio'},
  {id: 'Agosto', nombre: 'Agosto'},
  {id: 'Septiembre', nombre: 'Septiembre'},
  {id: 'Octubre', nombre: 'Octubre'},
  {id: 'Noviembre', nombre: 'Noviembre'},
  {id: 'Diciembre', nombre: 'Diciembre'},

  ];

$scope.alcance = false;
$scope.selectedMeta = function(meta)
{

  $http.get(base_api + "/obtener/alcancemeta/" + meta)
            
  .success(function(alcancemeta){
    $scope.alcancemeta = alcancemeta.meta;
    $scope.mes = '';
    $scope.alcance = true;

  });
}

$scope.selectedMes = function(mes)
{
  $http.get(base_api + "/obtener/indicadormeta/" + mes + "/" + $scope.meta)
            
  .success(function(respuesta){
    $scope.serie = respuesta;
    swal("Registro existente!", "Este indicador ya existe puedes actualizarlo", "success");

  });
}

$scope.title = "Creacion Meta";
$scope.formsubmit = function(){

var datos ={

meta: $scope.meta,
mes: $scope.mes,
avance: $scope.serie.avance_meta,
descripcion: $scope.serie.descripcion
                     
};


$.ajax({
       url: base_api + '/postindicadormeta/create',
         type: 'POST',
        dataType: 'JSON',
        data: {
          datos
      },
  
      }).success(function(){
          swal("Muy bien!", "Su registro ha sido exitoso", "success");
          toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
          window.location="/admin/postindicadores";

      })
      .error(function() {
        swal("Registro existente!", "Este registro ya existe", "error");
        toastr.error("Este registro ya existe", "Registro Existente");
        
      });
    }
  
  });
