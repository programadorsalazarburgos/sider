SeriesApp.controller("CreateImplementoCtrl", function($scope, ImplementoService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Implemantacion";
    $scope.disable_submit = false;
    $scope.serie = {};


$scope.formsubmit = function(isValid) {     
    
    if (isValid) {

        var midata = new FormData();
        var nombre_implemento = $scope.nombre_implemento;           
        midata.append('nombre_implemento',nombre_implemento);
            
        $.ajax({
    
            url: base_api + '/postimplemento/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
        })
        .done(function() {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postimplementos#/admin/postimplementos";
        
        })
        .fail(function() {
            swal("Lo sentimos!", "Este registro ya existe", "error");
        })
        .always(function() {
            console.log("complete");
        });
        

           }
        };	
	});






