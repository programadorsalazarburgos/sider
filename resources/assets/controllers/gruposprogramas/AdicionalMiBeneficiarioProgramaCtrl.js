SeriesApp.controller("AdicionalMiBeneficiarioProgramaCtrl", function($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q){
 


$scope.parametro = $routeParams.id;

 $http.get(base_api + "/obtener/disciplinasdeportivas")
    .success(function(disciplinas){

      $scope.disciplinas = disciplinas;

    });


 $scope.selecciones = [
    {id: 1, nombre: 'SELECCIONES CALI'},
    {id: 2, nombre: 'SELECCIONES VALLE'},
    {id: 3, nombre: 'CLUB DEPORTIVO PARTICULAR'},

    ];


 $http.get(base_api + "/obtener/clubesdeportivos")
    .success(function(clubesdeportivos){

      $scope.clubesdeportivos = clubesdeportivos;

    });



 $scope.beneficiario = function(seleccion)
 {


 	if (seleccion == 3) {

		$scope.contentido = true;
 	}
 	else
 	{
 		$scope.contentido = false;
 	}

 }

  $scope.formsubmit = function(isValid, parametro){
        

if (isValid) {

  if($scope.no_tajeta == undefined){
      $scope.no_tajeta = '';
  }
  else if ($scope.no_tajeta != null) {
    $scope.no_tajeta = $scope.no_tajeta;
  }

if($scope.club == undefined){
      $scope.club = '';
  }
  else if ($scope.club != null) {
    $scope.club = $scope.club;
  }


        var midata = new FormData();
        var no_tajeta = $scope.no_tajeta;
		    var disciplina = $scope.disciplina;
		    var seleccion = $scope.seleccion;
	     	var club = $scope.club;
      
      
    
        midata.append('no_tajeta',no_tajeta);
        midata.append('disciplina',disciplina);
        midata.append('seleccion',seleccion);
        midata.append('club',club);
            
          $.ajax({
            url: base_api + '/create/adicional/'+ parametro,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/postgruposprogramas#/admin/postgruposprogramas";
            },
            error: function(data)
            {
              swal("Registro Existente!", "Ya Ingresaste Información Adicional.", "error");
            }
          });

           }


     
   };


});
