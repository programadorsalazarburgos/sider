SeriesApp.controller("CreateLugarCtrl", function($scope, LugarService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Lugar";
    $scope.disable_submit = false;
    $scope.serie = {};

    $http.get(base_api + "/obtener/barrios")
        .success(function(response){
        $scope.barrios = response;
    });


    $scope.selectedBarrio = function(itemBarrio)
    {
      $http.get(base_api + "/obtener/estrato/" + itemBarrio) 
      .success(function(estratobeneficiario){
            console.log(estratobeneficiario);
            $scope.comuna = estratobeneficiario.nombre_comuna;
            $scope.comuna_id = estratobeneficiario.comuna_id;

      });

    }


      $http.get(base_api + "/obtener/corregimientos/") 
      .success(function(response){
            $scope.corregimientos = response;

      });

       $scope.selectedCorregimiento=function(itemCorregimiento){

    var promise = $http.get(base_api + "/obtener/veredas/" + itemCorregimiento);
    promise.then(
    function(responseveredas) {
    $scope.veredas = responseveredas.data;
    
      });

    }    


   $http.get(base_api + "/obtener/lugaresall/") 
      .success(function(response){
            $scope.lugares = response;
            console.log($scope.lugares);

      });


$scope.getVal = function()
{

    console.log($scope.content);
    if ($scope.content == 'urbano') 
    {
        $scope.corregimiento = '';
        $scope.vereda = '';
    }
    if ($scope.content == 'rural') 
    {
        $scope.barrio = '';
        $scope.comuna = '';
        $scope.comuna_id = '';
    }
}


$scope.observaciones = '';
$scope.formsubmit = function(isValid) {     
    
    if (isValid) {

        var midata = new FormData();
        var lugar = $scope.lugar;           
        var barrio = $scope.barrio;           
        var comuna_id = $scope.comuna_id;           
        var corregimiento = $scope.corregimiento;           
        var vereda = $scope.vereda;           
        var direccion = $scope.direccion;           
        var observaciones = $scope.observaciones;           
        var tipo_punto_atencion = $scope.tipo_punto_atencion;           


        midata.append('lugar',lugar);
        midata.append('barrio',barrio);
        midata.append('comuna_id',comuna_id);
        midata.append('direccion',direccion);
        midata.append('observaciones',observaciones);
        midata.append('corregimiento',corregimiento);
        midata.append('vereda',vereda);
        midata.append('tipo_punto_atencion',tipo_punto_atencion);
            
          $.ajax({
            url: base_api + '/postlugar/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postlugares#/admin/postlugares";

            },
            error: function (respuestaAjax) {
            swal("Error!", "Nombre Lugar ya existe.", "error");

            },


          });

           }
        };	
	});






