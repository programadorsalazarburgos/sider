SeriesApp.controller("CreateDisciplinaCtrl", function($scope, DisciplinaService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Disciplina";
    $scope.disable_submit = false;
    $scope.serie = {};

$scope.descripcion = '';

$scope.formsubmit = function(isValid) {     
    
    if (isValid) {

        var midata = new FormData();
        var nombre_disciplina = $scope.nombre_disciplina;           
        var descripcion = $scope.descripcion;           

        midata.append('nombre_disciplina',nombre_disciplina);
        midata.append('descripcion',descripcion);
            
          $.ajax({
            url: base_api + '/postdisciplina/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postdisciplinas#/admin/postdisciplinas";

            },
            error: function (respuestaAjax) {
            swal("Error!", "Nombre Disciplina ya existe.", "error");

            },


          });

           }
        };	
	});






