SeriesApp.controller("CreateGrupoCtrl", function($scope, GrupoService, fileUpload, $http, $location, base_api, $q){
    $scope.title = "Agregar Grupo";
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

$http.get(base_api + "/obtener/grados")
  .success(function(response){


    $scope.grados = response;


  });

$http.get(base_api + "/obtenercount/grupos")
  .success(function(response){

    var numero = [response];

    var largo_numero = numero.length;
    var largo_maximo = 4;
    var agregar = largo_maximo - largo_numero;
    
    for(i =0; i<agregar; i++){
    numero = "0"+numero;
 }

 $scope.codigo_grupo = 'CM' + numero;

  });

$http.get(base_api + "/obtener/sedes_sider")
  .success(function(response){

    $scope.people = response;
    console.log($scope.people);
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

  ];
  


  $scope.time1 = new Date();
        
        $scope.time2 = new Date();
        $scope.time2.setHours(7, 30);
        $scope.showMeridian = true;
        
        $scope.disabled = false;

  
$scope.formsubmit = function(isValid) {     
      console.log($scope.person.id);
     if (isValid) {
      let dias_horario = []

      $scope.dias.forEach(function (dia) {
        if(dia.inicio || dia.final){
          dias_horario.push(dia)
        }
      });

        var obt_sede = $scope.person.id;  
        var grado = $scope.grado;   
        var sede = obt_sede['id']
        var observaciones = $scope.observaciones;   
             
           
        $.ajax({
          url: base_api + '/postgrupo/create',
          type: 'POST',
          dataType: 'JSON',
          data: {
            codigo_grupo: $scope.codigo_grupo,
            sede: sede,
            grado: grado,
            observaciones: observaciones,
            dias_horario
        },
    
        }).success(function(){
         
            toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
            window.location="/admin/postgrupos#/admin/postgrupos";


        })
        .error(function() {
          console.log("errorres");
        });
      }
    }
  }); 







      


           

        






