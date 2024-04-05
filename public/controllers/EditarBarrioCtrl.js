SeriesApp.controller("EditarBarrioCtrl", function($scope, BarrioService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Barrio";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = BarrioService.get({id:$routeParams.id});

    

};


$http.get(base_api + "/obtenerselect/estrato/" + $routeParams.id)
  .success(function(response_barrios){
         

  $scope.tipo_estrato = {
        'id': 1,
        'unit': response_barrios.id_estrato
        }


  $scope.estrato = [
    {id: 1, nombre: '1'},
    {id: 2, nombre: '2'},
    {id: 3, nombre: '3'},
    {id: 4, nombre: '4'},
    {id: 5, nombre: '5'},
    {id: 6, nombre: '6'},
    {id: 7, nombre: '7'},

    ];

  });




$http.get(base_api + "/obtenerselect/comuna/" + $routeParams.id)
  .success(function(response){
         $scope.data = {
        'id': 1,
        'unit': response.id
        }

  });


$http.get(base_api + "/obtenerselect/comunas")
  .success(function(response){

    $scope.comunas = response;
  });



$scope.getData();

 $scope.formsubmit = function(id,isValid){
        

if (isValid) {


        var midata = new FormData();
        var codigo_barrio = $scope.serie.codigo;
		    var nombre_barrio = $scope.serie.nombre_barrio;
        var obtener_comuna = $("#comuna").val();    
        var comuna = obtener_comuna.replace('number:', '');
        var estrato = $scope.tipo_estrato.unit;
      
    
        midata.append('codigo_barrio',codigo_barrio);
        midata.append('nombre_barrio',nombre_barrio);
        midata.append('comuna',comuna);
        midata.append('estrato',estrato);
            
          $.ajax({
            url: base_api + '/postbarrios/editarBarrio/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/postbarrios#/admin/postbarrios";

            }
          });

           }


     
   };



});
