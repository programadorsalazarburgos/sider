SeriesApp.controller("EditarLudotecaCtrl", function($scope, LudotecaService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Ludoteca";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = LudotecaService.get({id:$routeParams.id});

  
};
 
 $scope.mostrarPistos = function() { 
     
    obtenerPistos($http,$scope,$scope.selCategorias)

};


function obtenerPistos($http,$scope,id){
   
 var url = base_api + "/obtenerselect/barrios/" + id;

 $http.get(url ,{ metodo : 'obtenerPistos' , id : id })
        .success(function(data) {
            $scope.JSONPistos  = data;
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });


  }


$http.get(base_api + "/obtenerselect/comunabarrio/" + $routeParams.id)
  .success(function(response){

        $scope.data3 = response;
         $scope.data2 = {
        'id': 1,
        'unit': response.id
        }

     
  });

  
$http.get(base_api + "/obtenerselect/sedes")
.success(function(response){

  $scope.sedes = response;
 
});



  $http.get(base_api + "/obtenerludoteca/sede/" + $routeParams.id)
  .success(function(response){

         $scope.datasede2 = response;
         $scope.data = {
        'id': 1,
        'unit': response.id
        }

   
  });

$http.get(base_api + "/obtenerselect/barrio/" + $routeParams.id)
  .success(function(response){

if (response.length != 0)
  {
  $scope.place = 'barrios';
  }
  $scope.data2 = response;
  $scope.data = {
  'id': 1,
  'unit': response.id
  }
});

$scope.requeridoc = false;
$scope.requeribarr = false;
$scope.mybarrio = true;
$scope.getVal=function(){

  if($scope.place == 'corregimientos')
  {
    $scope.requeridoc = true;
    $scope.requeribarr = false;
    $scope.mybarrio = false;
    $scope.person.id = null;
  }
  else{
    $scope.corregimiento = null;
    $scope.requeridoc = false;
    $scope.requeribarr = true;
  }
}

  $scope.serie = {};

  $http.get(base_api + "/obtener/corregimientoLudoteca/" + $routeParams.id)
  .success(function(response){
   
  if (response.length != 0)
  {
  $scope.place = 'corregimientos';
  }
  
  $scope.corregimiento = response.id;

    });

$scope.disabled = undefined;

  $scope.enable = function() {
    $scope.disabled = false;
  };

  $scope.disable = function() {
    $scope.disabled = true;
  };

  $scope.clear = function() {
    $scope.person.selected = undefined;
    $scope.sede.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.person = {};
  $scope.sede = {};
 


$http.get(base_api + "/obtenerselect/barrios")
  .success(function(response){

    $scope.people = response;

  });


  $scope.address = {};
  $scope.refreshAddresses = function(address) {
    var params = {address: address, sensor: false};
    return $http.get(
      'http://maps.googleapis.com/maps/api/geocode/json',
      {params: params}
    ).then(function(response) {
      $scope.addresses = response.data.results
    });
  };



$scope.getData();

$.ajax({
  url: base_api + "/obtener/corregimientos",
  type: 'GET',
  dataType: 'JSON',
  async: false, 
}).success(function(response){
  $scope.corregimientos = response;
    
}).error(function() {

 
});

 $scope.formsubmit = function(id,isValid){
        
if (isValid) {

        var midata = new FormData();
        var nombre_ludoteca = $scope.serie.nombre_ludoteca;   
        var telefono = $scope.serie.telefono;   
        var direccion = $scope.serie.direccion ;   
        var obt_barrio = $scope.person.id;   
        var corregimiento = $scope.corregimiento;
        if(corregimiento == undefined)
        {
          corregimiento = null;
        }
        if(obt_barrio == undefined){

          obt_barrio = 0;
          var barrio = obt_barrio;

        }
        else{
        var barrio = obt_barrio['id']
        
        }

        var obt_sede = $scope.sede.id;   
       
        if(obt_sede == undefined){

          obt_sede = 0;
          var sede = obt_sede;

        }
        else{
        var sede = obt_sede['id']
        console.log(sede);
        }

        midata.append('nombre_ludoteca',nombre_ludoteca);
        midata.append('telefono',  telefono);
        midata.append('direccion',  direccion);
        midata.append('barrio',  barrio);
        midata.append('sede',  sede);
        midata.append('corregimiento',  corregimiento);
       
            
          $.ajax({
            url: base_api + '/postludotecas/editarLudoteca/' + id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postludotecas#/admin/postludotecas";
         
            }
          });
        }
      };
});
