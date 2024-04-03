SeriesApp.controller("EditarModalidadCtrl", function($scope, ModalidadService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Modaliad";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = ModalidadService.get({id:$routeParams.id});

    

};

$scope.getData();

 $scope.formsubmit = function(id,isValid){
        

if (isValid) {


        var midata = new FormData();
		var nombre = $scope.serie.nombre;

        midata.append('nombre',nombre);
            
          $.ajax({
            url: base_api + '/postmodalidades/editarModalidad/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/postmodalidades#/admin/postmodalidades";

            }
          });

           }


     
   };



});
