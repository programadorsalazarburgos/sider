SeriesApp.controller("CreateZonaCtrl", function($scope, ZonaService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Zona";
    $scope.disable_submit = false;

    $scope.serie = {};




$(function()
        {
            $('#id_persona_beneficiario_residencia_direccion').add_generator({
                direccion: 'id_persona_beneficiario_residencia_direccion',
                complemento: 'id_persona_beneficiario_residencia_direccion_complemento',
            });
        });


$scope.formsubmit = function(isValid) {     
    
    if (isValid) {


        var midata = new FormData();
        var nombre_zona = $scope.nombre_zona;           

        midata.append('nombre_zona',nombre_zona);
            
          $.ajax({
            url: base_api + '/postzona/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postzonas#/admin/postzonas";

            }
          });

           }
        };	
	});






