SeriesApp.controller("CreateGrupoProgramaCtrl", function($scope, GrupoProgramaService, fileUpload, $http, $location, base_api, $q){
    $scope.title = "Agregar Grupo Programa";
    $scope.disable_submit = false;

    $scope.serie = {};

$(function()
{
  $('.martes-lunes').clockpicker({


    donetext: 'Guardar',
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        twelvehour: true,
        vibrate: true
  });
})

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

$http.get(base_api + "/obtenerselect/lugares_grupos")
  .success(function(response){

    $scope.lugares = response;
   


  });


$http.get(base_api + "/obtenerselect/disciplinas_grupos")
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

$scope.addItem = function() {
    $scope.items.push({id: $scope.items.length, text: 'item '+$scope.items.length});
  };

  $scope.removeItem = function() {
    $scope.items.pop();
  };  

  $scope.changeItems = function() {
    //$scope.items[0].id = 123;
    $scope.items[0].text = 'item 123';
    $scope.items1[0] = 'item 123';
  };    

  $scope.reorder = function() {
    var t = $scope.items[2];
    $scope.items[2] = $scope.items[3];
    $scope.items[3] = t;
  };

  $scope.check = function() {
    $scope.user.values1 = [1,4];
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
  


  $scope.time1 = new Date();
        
        $scope.time2 = new Date();
        $scope.time2.setHours(7, 30);
        $scope.showMeridian = true;
        
        $scope.disabled = false;

$scope.observaciones = '';
$scope.formsubmit = function(isValid) {     
    
     if (isValid) {
      let dias_horario = []

      $scope.dias.forEach(function (dia) {
        if(dia.inicio || dia.final){
          dias_horario.push(dia)
        }
      });

        var observaciones = $scope.observaciones;   
             
           
        $.ajax({
          url: base_api + '/postgrupoprograma/create',
          type: 'POST',
          dataType: 'JSON',
          data: {
            nombre_grupo: $scope.nombre_grupo,
            lugar: $scope.lugar,
            disciplina: $scope.disciplina,
            observaciones: observaciones,
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
    }
  }); 







      


           

        






