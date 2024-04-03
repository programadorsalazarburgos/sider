SeriesApp.controller('BeneficiariosReporteDetalladoCrtl', function ($scope, $routeParams, $location, BeneficiarioService, $http, $timeout, base_api) {

$scope.title = "Beneficiarios";
$scope.series = [];

 $scope.opts = {
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true
  };
  
// $(function () {
//   $('.selectpicker').selectpicker();
// });


 $http.get(base_api + "/obtenerselect/allGrupos_poblacionales")
  .success(function(response){

    $scope.multiSelectData = response;
 
  });



  $scope.selectedItems = [

  ];

  $scope.multiSelectOutput = [];


$.datepicker.setDefaults($.datepicker.regional['es']);

$scope.getData = function(){
  $http.get(base_api + "/admin/postbeneficiariosall")
    .success(function(response){
    $scope.list = response;
   console.log($scope.list);
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 5; //max no of items to display in a page
    $scope.filteredItems = $scope.list.length; //Initially for no filter
    $scope.totalItems = $scope.list.length;
     
  });
};


$scope.pageSize = 50;



//inicio cargar datos modalidades

    $scope.data_modalidad = {
      'id': 1,
      'unit': null
    }

 $http.get(base_api + "/obtener/modalidades")
    .success(function(modalidades){

      $scope.modalidades = modalidades;

    });


//inicio cargar datos puntos de atencion

    $scope.data_puntoatencion = {
      'id': 1,
      'unit': null
    }



 $http.get(base_api + "/obtener/puntosatencion")
    .success(function(puntosatencion){

      $scope.puntosatencion = puntosatencion;

    });

    $scope.sangres = [
      {id: '1', nombre: 'O+'},
      {id: '2', nombre: 'O-'},
      {id: '3', nombre: 'A+'},
      {id: '4', nombre: 'A-'},
      {id: '5', nombre: 'B+'},
      {id: '6', nombre: 'B-'},
      {id: '7', nombre: 'AB+'},
      {id: '8', nombre: 'AB-'},

      ];


 $http.get(base_api + "/obtenerselect/tipo_documento")
  .success(function(response){

    $scope.tipo_documento = response;
    

  });




$http.get(base_api + "/obtenerselect/comunas")
    .success(function(response){

      $scope.comunas = response;


    });


 $http.get(base_api + "/obtener/corregimientos")
    .success(function(response){

      $scope.corregimientos = response;

    });



  $scope.estratos = [
    {id: 1, nombre: '1'},
    {id: 2, nombre: '2'},
    {id: 3, nombre: '3'},
    {id: 4, nombre: '4'},
    {id: 5, nombre: '5'},
    {id: 6, nombre: '6'},
    {id: 7, nombre: '7'},

    ];


$scope.ocupaciones = [
    {id: 1, nombre: 'Ama de casa'},
    {id: 2, nombre: 'Empleado'},
    {id: 3, nombre: 'Estudiante'},
    {id: 4, nombre: 'Desempleado'},
    {id: 5, nombre: 'Independiente'},
    {id: 6, nombre: 'Pensionado-Jubilado'},
    {id: 7, nombre: 'Servidor Público'},
  
    ];


 $http.get(base_api + "/obtenerselect/escolaridades")
  .success(function(response){

    $scope.escolaridades = response;


  });


      $scope.culturas = [
    {id: 1, nombre: 'Negro'},
    {id: 2, nombre: 'Blanco'},
    {id: 3, nombre: 'Índigena'},
    {id: 4, nombre: 'Mestizo'},
    {id: 5, nombre: 'Mulato'},
    {id: 6, nombre: 'ROM, Gitano'},
    {id: 7, nombre: 'Palenquero'},
    {id: 8, nombre: 'Raizal'},
    {id: 9, nombre: 'No sabe-No responde'},

    ];



 $http.get(base_api + "/obtenerselect/discapacidad")
  .success(function(response){

    $scope.discapacidadades = response;

  });



$scope.sort = function(keyname){
    $scope.sortKey = keyname;   //set the sortKey to the param passed
    $scope.reverse = !$scope.reverse; //if true make it false and vice versa
  }

$scope.setPage = function(pageNo) {
      $scope.currentPage = pageNo;
     console.log($scope.currentPage); 

    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filteredItems = $scope.filtered.length;
              console.log($scope.filteredItems); 

        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

$scope.getData();
$scope.series = BeneficiarioService.query();

$scope.toggle = function(modalstate, id) {
      $scope.modalstate = modalstate;
      switch(modalstate) {

          case 'AgregarGrupo':
          $scope.form_contenido = "GRUPOS";
          $scope.form_title = "obtener";
          $scope.id = id;

          break;
        default:
          break;
      }

      $('#myModal').modal('show');
  }




 $http.get(base_api + "/obtener/allmonitores")
    .success(function(response){
    $scope.monitores = response;
   

  });



    $scope.selectedMonitor=function(item){

      $http.get(base_api + "/obtener/gruposmonitor/" + item)
      .success(function(response){

        $scope.monitores_grupo = response;



      });
    }    

$scope.formAsociar = function(isValid, id){


 if (isValid) {

 $.ajax({
          url: base_api + '/postbeneficiario/asociargrupo/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            grupo_id:$scope.grupo_monitor
        },
    
        }).success(function(){
         
            $scope.getData();
            toastr.success("Su registro ha sido exitoso", "Grupo Asociado");
            window.location="/admin/postbeneficiarios#/admin/postbeneficiarios";


        })
        .error(function() {
          console.log("success");
        });

 }

}


$scope.SacarGrupo = function(id) {
swal({
  title: "Sacar del Grupo?",
  text: "Desea sacar del grupo a este beneficiario!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Sacalo!",
  cancelButtonText: "No, cancela!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {

      $.ajax({
        url: base_api + '/eliminar/grupo/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {param1: 'value1'},
      }).success(function(){
        swal("Eliminado!", "Has sacado del grupo este beneficiario.", "success");
        $scope.getData();

      });

  } else {
    swal("Cancelado", "Has decidido que no sacarlo del grupo :)", "error");
  }
});

  }

  $scope.tipo_doc_persona = '';
  $scope.modalidad = '';
  $scope.punto_atencion = '';
  $scope.entre = '';
  $scope.hasta = '';
  $scope.sexo_persona = '';
  $scope.edad = '';
  $scope.estrato = '';
  $scope.comuna = '';
  $scope.corregimiento = '';
  $scope.hijos = '';
  $scope.ocupacion = '';
  $scope.escolaridad = '';
  $scope.cultura = '';
  $scope.discapacidad = '';
 
$scope.CargaBeneficiarios = function()
{

  $http({
    url: base_api + '/obtener/beneficiariodetallado/',
    method: "GET",
    params: {
      tipo_doc_persona: $scope.tipo_doc_persona, 
      modalidad:$scope.modalidad,
      punto_atencion: $scope.punto_atencion,
      entre: $scope.entre,
      hasta: $scope.hasta,
      sexo: $scope.sexo_persona,
      edad: $scope.edad,
      estrato: $scope.estrato,
      comuna: $scope.comuna,
      corregimiento: $scope.corregimiento,
      hijos: $scope.hijos,
      ocupacion: $scope.ocupacion,
      escolaridad: $scope.escolaridad,
      cultura: $scope.cultura,
      discapacidad: $scope.discapacidad,
      sangre: $scope.sangre
    },
 })
 .success(function(data) {
  $scope.list = data;
  $scope.currentPage = 1; //current page
  $scope.entryLimit = 5; //max no of items to display in a page
  $scope.filteredItems = $scope.list.length; //Initially for no filter
  $scope.totalItems = $scope.list.length;
 

})
.error(function() {
	console.log("error");
});

}


  $scope.sexo = [
    {id: '1', nombre: 'Mujer'},
    {id: '2', nombre: 'Hombre'},

    ];


}).config(function($sceDelegateProvider) {
   $sceDelegateProvider.resourceUrlWhitelist([
     'self',
     'http://*./**',
     'https://rawgit.com/**',
     'http://rawgit.com/**'
   ]);
  
 });



