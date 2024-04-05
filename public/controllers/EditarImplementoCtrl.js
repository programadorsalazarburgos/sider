SeriesApp.controller("EditarImplementoCtrl", function($scope, ImplementoService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Implementos";
    $scope.series = [];
    $scope.getData = function(){
    $scope.serie = ImplementoService.get({id:$routeParams.id});

    

};

$scope.getData();
$scope.formsubmit = function(id,isValid){
        
if (isValid) {

        var midata = new FormData();
		var nombre_implemento = $scope.serie.nombre_implemento;

        midata.append('nombre_implemento',nombre_implemento);
           
          $.ajax({
    
            url: base_api + '/postimplementos/editarImplemento/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
        })
        .done(function() {
            swal("Almacenado!", "Registro Actualizado.", "success");
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
