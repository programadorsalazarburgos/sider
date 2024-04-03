SeriesApp.controller("CreateUniversidadCtrl", function($scope, UniversidadService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Universidad";
    $scope.disable_submit = false;
    $scope.serie = {};

$scope.formsubmit = function(isValid) {     
    
    if (isValid) {

        var midata = new FormData();
        var nombre = $scope.nombre;           

        midata.append('nombre',nombre);
            
          $.ajax({
            url: base_api + '/postuniversidad/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postuniversidades#/admin/postuniversidades";

            }
          });

           }
        };	
	});






