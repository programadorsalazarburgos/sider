SeriesApp.controller("CreateBarrioCtrl", function($scope, BarrioService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Barrio";
    $scope.disable_submit = false;

    $scope.serie = {};


$http.get(base_api + "/obtenerselect/comunas")
  .success(function(response){

    $scope.comunas = response;


  });



  $scope.tipo_estrato = {
        'id': 1,
        'unit': null
        }


  $scope.estrato = [
    {id: 1, nombre: '1'},
    {id: 2, nombre: '2'},
    {id: 3, nombre: '3'},
    {id: 4, nombre: '4'},
    {id: 5, nombre: '5'},
    {id: 6, nombre: '6'},
    {id: 7, nombre: '7'},

    ];

$scope.formsubmit = function(isValid) {     
    
   
if (isValid) {


        var midata = new FormData();
        var codigo_barrio = $scope.codigo_barrio;           
        var nombre_barrio = $scope.nombre_barrio;           
        var comuna = $scope.comuna;           
        var estrato = $scope.tipo_estrato.unit;           


        midata.append('codigo_barrio',codigo_barrio);
        midata.append('nombre_barrio',nombre_barrio);
        midata.append('comuna',  comuna);
        midata.append('estrato',  estrato);
       
            
          $.ajax({
            url: base_api + '/postbarrio/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postbarrios#/admin/postbarrios";
         
            }
          });



           }


        };  
    });






