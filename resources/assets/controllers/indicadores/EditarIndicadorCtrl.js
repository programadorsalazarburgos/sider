SeriesApp.controller("EditarMetaCtrl", function($scope, MetasService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Editar Meta";
  $scope.series = [];
  $scope.getData = function(){
  $http.get(base_api + "/admin/postmetas/" + $routeParams.id)         
  .success(function(metas){
    $scope.serie = metas;
    $scope.anualidad = $scope.serie.periodo;

  });
};

$scope.getData();
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

$scope.data = {
  'id': 1,
  'unit': 14
  }


$scope.formsubmit = function(id,isValid){
      

if (isValid) {


      var midata = new FormData();
      var nombre_meta = $scope.serie.nombre_meta;
      var programa = $scope.data.unit;
      var anualidad = $scope.anualidad;
      var meta = $scope.serie.meta;    
      var descripcion = $scope.serie.descripcion;

      midata.append('nombre_meta',nombre_meta);
      midata.append('programa',programa);
      midata.append('anualidad',anualidad);
      midata.append('meta',meta);
      midata.append('descripcion',descripcion);
          
        $.ajax({
          url: base_api + '/postmeta/editar/'+ id,
          type: 'POST',
          contentType: false,
          data: midata,  // mandamos el objeto formdata que se igualo a la variable data
          processData: false,
          cache: false,
          success: function (respuestaAjax) {
          swal("Almacenado!", "Registro Actualizado.", "success");
          window.location="/admin/postmetas#/admin/postmetas";

          }
        });
    }
 };
});
