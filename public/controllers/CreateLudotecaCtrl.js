SeriesApp.controller("CreateLudotecaCtrl", function($scope, LudotecaService, fileUpload, $http, $location, base_api){
    $scope.title = "Agregar Ludoteca";
    $scope.disable_submit = false;

    $scope.serie = {};

    $(function()
        {
            $('#id_persona_beneficiario_residencia_direccion').add_generator({
                direccion: 'id_persona_beneficiario_residencia_direccion',
                complemento: 'id_persona_beneficiario_residencia_direccion_complemento',
            });
        });

    $('.formlista').change(function()
        {
            var direccion='';
            $.each($('.formlista'),function(index,value)
            {
                if($(value).val()!='')
                {
                    direccion = direccion + ' ' + $(value).val();
                }
            });
            $('#id_persona_beneficiario_residencia_direccion').val(direccion);
        });

  $scope.ngShowhideDireccion =true;
  $scope.ngShowhideComplemento =true;
  $scope.disabled = undefined;
  $scope.enable = function() {
    $scope.disabled = false;
  };

  $scope.disable = function() {
    $scope.disabled = true;
  };

  $scope.clear = function() {
    $scope.person.selected = undefined;
    $scope.serie.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.person = {};
  $scope.sede = {};
  $scope.serie = {};


$http.get(base_api + "/obtenerselect/barrios")
  .success(function(response){

    $scope.people = response;

  });


    $http.get(base_api + "/obtener/corregimientos")
    .success(function(response){

      $scope.corregimientos = response;

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


  $scope.getVal=function(){

    if($scope.place == 'corregimientos')
    {
      $scope.requeridoc = true;
      $scope.requeribarr = false;
      $scope.person.id = null;
    }
    else{
      $scope.corregimiento = null;
      $scope.requeridoc = false;
      $scope.requeribarr = true;
    }
  }


$http.get(base_api + "/obtenerselect/sedes")
  .success(function(response){

    $scope.sedes = response;
   
  });

$scope.formsubmit = function(isValid) {     
       
if (isValid) {

        var midata = new FormData();
        var nombre_ludoteca = $scope.nombre_ludoteca;   
        var telefono = $scope.telefono;   
        var obt_barrio = $scope.person.id;   
        if (obt_barrio == undefined) {
          var barrio = '';
        }
        else{
        var barrio = obt_barrio['id'];
        }

        var obt_sede = $scope.sede.id;   
        if (obt_sede == undefined) {
          var sede = '';
        }
        else{
        var sede = obt_sede['id'];
        
        }
        var corregimiento = $scope.corregimiento;
        if(corregimiento == undefined)
        {
          corregimiento = null;
        }

        var direccion = $("#id_persona_beneficiario_residencia_direccion").val();
        var complemento = $("#id_persona_beneficiario_residencia_direccion_complemento").val();
        
        midata.append('nombre_ludoteca',nombre_ludoteca);
        midata.append('telefono',  telefono);
        midata.append('direccion',  direccion);
        midata.append('complemento',  complemento);
        midata.append('barrio',  barrio);
        midata.append('sede',  sede);
        midata.append('corregimiento_ludoteca',  corregimiento);
       
            
          $.ajax({
            url: base_api + '/postludoteca/create',
            type: 'POST',
            contentType: false,
            data: midata,  // mandamos el objeto formdata que se igualo a la variable data
            processData: false,
            cache: false,
            success: function (respuestaAjax) {
            swal("Almacenado!", "Registro Guardado.", "success");
            window.location="/admin/postludotecas#/admin/postludotecas";
         
            }
          });
           }
        };  
    });






