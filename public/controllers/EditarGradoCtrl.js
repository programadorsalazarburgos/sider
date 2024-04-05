SeriesApp.controller("EditarGradoCtrl", function($scope, GradoService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Grado";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = GradoService.get({id:$routeParams.id});

    

};

$scope.getData();

 $scope.formsubmit = function(id,isValid){
        

if (isValid) {


        var midata = new FormData();
		var nombre_grado = $scope.serie.nombre_grado;

        midata.append('nombre_grado',nombre_grado);
            
          $.ajax({
            url: base_api + '/postgrados/editarGrado/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/postgrados#/admin/postgrados";

            }
          });

           }


     
   };



});
