SeriesApp.controller("CreateGradoCtrl", function($scope, GradoService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Grado";
    $scope.disable_submit = false;

    $scope.serie = {};



$scope.formsubmit = function(isValid) {     
    
    if (isValid) {


        var midata = new FormData();
        var nombre_grado = $scope.nombre_grado;           

        midata.append('nombre_grado',nombre_grado);
            
          $.ajax({
            url: base_api + '/postgrado/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postgrados#/admin/postgrados";

            }
          });

           }
        };	
	});






