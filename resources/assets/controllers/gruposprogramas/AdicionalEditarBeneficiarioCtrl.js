SeriesApp.controller("AdicionalEditarBeneficiarioCtrl", function($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q){
 

$scope.parametro = $routeParams.id;

$http.get(base_api + "/obtener/informacion_adicional/" + $routeParams.id)
    .success(function(data){

    console.log(data.adicional);
   
    if(data.adicional == null)
    {
      swal("Registro no Existente!", "Agrega Información Adicional", "error");
      window.location="/admin/postgruposprogramas#/admin/postgruposprogramas";

    }
 
    else
    {
    $scope.disciplina = data.adicional.disciplina_id;
    $scope.seleccion = data.adicional.pertenece_a;
    $scope.club = data.adicional.nombre_club;

    

    if(data.adicional.codigo != null)
    {
      $scope.content = 'si';
      $scope.no_tajeta = data.adicional.codigo;
    }

    if ($scope.seleccion == 3) 
    {
      $scope.contentido = true;
      $scope.club = data.adicional.nombre_club;
    }
    else if ($scope.seleccion != 3)
    {
      $scope.contentido = false;
      $scope.club = data.adicional.nombre_club;
    }   

    }
    });



 $http.get(base_api + "/obtener/clubesdeportivos")
    .success(function(clubesdeportivos){

      $scope.clubesdeportivos = clubesdeportivos;

    });


 $http.get(base_api + "/obtener/disciplinasdeportivas")
    .success(function(disciplinas){

      $scope.disciplinas = disciplinas;

    });


 $scope.selecciones = [
    {id: 1, nombre: 'SELECCIONES CALI'},
    {id: 2, nombre: 'SELECCIONES VALLE'},
    {id: 3, nombre: 'CLUB DEPORTIVO PARTICULAR'},

    ];

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
        var nombre_club = $scope.club;
      
      
    
        midata.append('no_tajeta',no_tajeta);
        midata.append('disciplina',disciplina);
        midata.append('seleccion',seleccion);
        midata.append('nombre_club',nombre_club);
            
          $.ajax({
            url: base_api + '/actualizar/adicional/'+ parametro,
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
