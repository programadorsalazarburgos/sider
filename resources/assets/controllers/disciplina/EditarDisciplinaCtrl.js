SeriesApp.controller("EditarDisciplinaCtrl", function($scope, DisciplinaService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Disciplina";
    $scope.series = [];
    $scope.getData = function(){
      $http.get(base_api + "/admin/postdisciplinas/" +  $routeParams.id)
        .success(function(response){
        $scope.serie = response;

        });
};


$scope.getData();
$scope.formsubmit = function(id,isValid){
    
if (isValid) {

        var midata = new FormData();
        var nombre_disciplina = $scope.serie.nombre_disciplina;
        var descripcion = $scope.serie.descripcion;
   
        midata.append('nombre_disciplina',nombre_disciplina);
        midata.append('descripcion',descripcion);
            
          $.ajax({
            url: base_api + '/postdisciplinas/editarDisciplina/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/postdisciplinas#/admin/postdisciplinas";

            }
          });
        }
   };
});
