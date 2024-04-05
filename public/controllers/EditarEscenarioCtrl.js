SeriesApp.controller("EditarEscenarioCtrl", function($scope, EscenarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Escenario";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = EscenarioService.get({id:$routeParams.id});

    

};


$http.get(base_api + "/obtenerselect/sede/" + $routeParams.id)
  .success(function(response){


          $scope.data2 = response;
         $scope.data = {
        'id': 1,
        'unit': response.id
        }

   
  });


$http.get(base_api + "/obtenerselect/tipoescenario/" + $routeParams.id)
  .success(function(response){
         $scope.data = {
        'id': 1,
        'unit': response.id
        }

  });


$http.get(base_api + "/obtenerselect/tipoescenarios")
  .success(function(response){

    $scope.tipoescenarios = response;
  });


    $scope.serie = {};


$scope.disabled = undefined;

  $scope.enable = function() {
    $scope.disabled = false;
  };

  $scope.disable = function() {
    $scope.disabled = true;
  };

  $scope.clear = function() {
    $scope.person.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.person = {};
 

$http.get(base_api + "/obtenerselect/sedes")
  .success(function(response){

    $scope.people = response;
    console.log($scope.people);

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



$scope.limpiar = function(){
 
  $('#seleccionado').hide();

 }


$scope.getData();

 $scope.formsubmit = function(id,isValid){
        
if (isValid) {


        var midata = new FormData();
        var nombre_escenario = $scope.serie.nombre_escenario;   
        var descripcion = $scope.serie.descripcion;   
        var obtener_tipoescenario = $("#tipoescenario").val();    
        var tipoescenario = obtener_tipoescenario.replace('number:', '');
        var obt_sede = $scope.person.id;   
       
        if(obt_sede == undefined){

          obt_sede = 0;
          var sede = obt_sede;

        }
        else{
        var sede = obt_sede['id']
        
        }
        midata.append('nombre_escenario',nombre_escenario);
        midata.append('descripcion',  descripcion);
        midata.append('tipoescenario',  tipoescenario);
        midata.append('sede',  sede);
        
       
            
          $.ajax({
            url: base_api + '/postescenarios/EditarEscenario/' + id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/postescenarios#/admin/postescenarios";
         
            }
          });


      


           }

     
   };



});
