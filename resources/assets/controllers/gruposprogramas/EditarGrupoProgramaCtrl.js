SeriesApp.controller("EditarGrupoProgramaCtrl", function($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Información Grupo";
    $scope.series = [];
    $scope.getData = function(){

    $http.get(base_api + "/admin/postgruposprogramas/" +  $routeParams.id)
        .success(function(response){
        $scope.serie = response;
        $scope.lugar = response.lugar_id;
        $scope.disciplina = response.disciplina_id;

        });

};

$scope.serie = {};
$scope.getData();


$scope.disabled = undefined;

  $scope.enable = function() {
    $scope.disabled = false;
  };

  $scope.disable = function() {
    $scope.disabled = true;
  };

  $scope.clear = function() {
    $scope.person.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.person = {};


$http.get(base_api + "/obtenerselect/lugares")
  .success(function(response){


    $scope.lugares = response;

  });




$http.get(base_api + "/obtenerselect/disciplinas")
  .success(function(response){

    $scope.disciplinas = response;
   
  });




  $scope.address = {};
  $scope.refreshAddresses = function(address) {
    var params = {address: address, sensor: false};
    return $http.get(
      'http://maps.googleapis.com/maps/api/geocode/json',
      {params: params}
    ).then(function(response) {
      $scope.addresses = response.data.results
    });
  };



$scope.dias = [
  {id: 'lunes'},
  {id: 'martes'},
  {id: 'miercoles'},
  {id: 'jueves'},
  {id: 'viernes'},
  {id: 'sabado'},
  {id: 'domingo'},
  ];




$http.get(base_api + "/obtener/GrupoHorarioPrograma/" + $routeParams.id)
  .success(function(response){

          response.forEach((element) => {
            var dia = $scope.dias.find((d) => d.id == element.dia);
            if (dia) {

              dia.checked = true;
              dia._id = element.id;
              dia.inicio = new Date();
              dia.inicio.setHours(element.hora_inicio.split(":")[0]);
              dia.inicio.setMinutes(element.hora_inicio.split(":")[1]);
              //dia.inicio = element.hora_inicio;
              dia.fin = new Date();
              dia.fin.setHours(element.hora_fin.split(":")[0]);
              dia.fin.setMinutes(element.hora_fin.split(":")[1]);
              //dia.fin = element.hora_fin;
            }
          });          
  });




  $scope.time1 = new Date();
        
        $scope.time2 = new Date();
        $scope.time2.setHours(7, 30);

        $scope.showMeridian = true;
        
        $scope.disabled = false;



$scope.avisar = function(dia){

// console.log(dia);

  if (dia.checked == false && dia._id != null) {



 $http({
        url: base_api + "/eliminar/GrupoHorarioPrograma",
        method: "POST",
        data: { 'dato' : dia._id }
    })
    .then(function(response) {
    
        dia._id = null;
    
    }, 
    function(response) { // optional
            // failed
    });

  }

}


 $scope.formsubmit = function(id,isValid){
        

if (isValid) {

  
       let dias_horario = []

      $scope.dias.forEach(function (dia) {

        console.log(dia);
        if (dia.checked == true) {

        if(dia.inicio || dia.final){
          dias_horario.push(dia)

        }

          }
      });
    


 $.ajax({
          url: base_api + '/postgrupoprograma/actualizar/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            nombre_grupo: $scope.serie.nombre_grupo,
            lugar: $scope.lugar,
            disciplina: $scope.disciplina,
            observaciones: $scope.serie.observaciones,
            dias_horario
        },

    
        }).success(function(){
         
            toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
            window.location="/admin/postgruposprogramas#/admin/postgruposprogramas";


        })
        .error(function() {
          swal("lo sentimos!", "Cambia tu nombre de grupo porque este ya existe!", "error");
          toastr.error("Verifique su campo nombre de grupo porque ya existe", "Nombre Grupo");
        });
      }

     
   };



});
