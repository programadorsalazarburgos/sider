SeriesApp.controller("EditarLugarCtrl", function($scope, LugarService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
    $scope.title = "Editar Lugar";
    $scope.series = [];
    $scope.getData = function(){
      $http.get(base_api + "/admin/postlugares/" +  $routeParams.id)
        .success(function(response){
        $scope.serie = response;
        $scope.barrio = response.barrio_id;
        $scope.comuna_id = response.comuna_id;
        $scope.comuna = response.nombre_comuna;
        $scope.corregimiento = response.corregimiento_id;
        $scope.vereda = response.vereda_id;
        $scope.lugar = response.nombre_lugar;
        $scope.value='urbano';
        $scope.variable = 'urbano';
        if ($scope.barrio != null) 
        {
            $scope.contenido = 1;
        }
        if ($scope.corregimiento != null) 
        {
            $scope.contenido = 2;
        }
        });
};

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

$scope.getData();





$scope.getVal = function()
{

    if ($scope.contenido == 1) 
    {
        $scope.corregimiento = '';
        $scope.vereda = '';
    }
    if ($scope.contenido == 2) 
    {
        $scope.barrio = '';
        $scope.comuna = '';
        $scope.comuna_id = '';
    }
}




$scope.formsubmit = function(id,isValid){
 


if (isValid) {

        if ($scope.barrio == undefined) 
        {
            $scope.barrio = '';
        }

        if ($scope.comuna_id == undefined) 
        {
            $scope.comuna_id = '';
        }

        if ($scope.corregimiento == undefined) 
        {
            
            $scope.corregimiento = '';
        }

        if ($scope.vereda == undefined) 
        {
            $scope.vereda = '';
        }

        var midata = new FormData();
        var lugar = $scope.lugar;
        var barrio = $scope.barrio;
        var comuna_id = $scope.comuna_id;
        var corregimiento = $scope.corregimiento;
        var vereda = $scope.vereda;
        var direccion = $scope.serie.direccion;
		var observaciones = $scope.serie.observaciones;
        var tipo_punto_atencion = $scope.serie.tipo_punto_atencion;

        midata.append('lugar',lugar);
        midata.append('barrio',barrio);
        midata.append('comuna_id',comuna_id);
        midata.append('corregimiento',corregimiento);
        midata.append('vereda',vereda);
        midata.append('direccion',direccion);
        midata.append('observaciones',observaciones);
        midata.append('tipo_punto_atencion',tipo_punto_atencion);
            
          $.ajax({
            url: base_api + '/postlugares/editarLugar/'+ id,
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Actualizado.", "success");
            window.location="/admin/postlugares#/admin/postlugares";

            }
          });
        }
   };
});
