SeriesApp.controller("CreateModalidadCtrl", function($scope, ModalidadService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Modalidad";
    $scope.disable_submit = false;

    $scope.serie = {};





$scope.formsubmit = function(isValid) {     
    
    if (isValid) {


        var midata = new FormData();
        var nombre = $scope.nombre;           

        midata.append('nombre',nombre);
            
          $.ajax({
            url: base_api + '/postmodalidad/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postmodalidades#/admin/postmodalidades";

            }
          });

           }
        };	
	});






