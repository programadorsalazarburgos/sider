SeriesApp.controller("CreateUsuarioCtrl", function($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q){
  
  $scope.reset = function () {
      $scope.state = undefined;
  };

  $scope.title = "Creacion Personal";
  $scope.series = [];
  $scope.selectedPoblacionales = [];
  $scope.selectedDiscapacidades = [];
  $scope.selectedDisciplinas = [];
 
  $scope.getData = function(){
    $scope.serie = GrupoService.get({id:$routeParams.id});
    
 };

$scope.grupo_save = $routeParams.id;
$scope.serie = {};
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


$(document).ready(function () {
  $('[name=integer-data-attribute]').maskNumber({integer: true});
});


$.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha_nacimiento").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "1940:+nn"
 
  }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
});


$.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha_nacimiento_acudiente").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
  });
});


$.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha_inscripcion").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
  });
});


//Inicio Carga de datos Documento Crear
  
   $scope.tipo_doc = {
  'id': 1,
  'unit': null
  }


$http.get(base_api + "/obtenerselect/tipo_documento")
  .success(function(response){
    $scope.tipodocumento = response;
 
  });

//Fin Carga de datos Documento Crear

//inicio tipo documento acudients

  $scope.tipo_doc_acudiente = {
  'id': 1,
  'unit': null
  }




//fin


//Inicio Carga datos sexo crear
  
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

    

//Fin Carga datos sexo crear

//Inicio Carga datos sexo crear
  
  $scope.tipo_sex = {
        'id': 1,
        'unit': null
        }


  $scope.sexo = [
    {id: '1', nombre: 'Mujer'},
    {id: '2', nombre: 'Hombre'},

    ];

//Fin Carga datos sexo crear

//Inicio Carga datos sexo crear
  
  $scope.tipo_sex_acudiente = {
        'id': 1,
        'unit': null
        }


//Fin Carga datos sexo crear

//Inicio Carga datos tipo de sangre

 $scope.tipo_sag = {
        'id': 1,
        'unit': null
        }

  $scope.sangre = [
      {id: '1', nombre: 'O+'},
      {id: '2', nombre: 'O-'},
      {id: '3', nombre: 'A+'},
      {id: '4', nombre: 'A-'},
      {id: '5', nombre: 'B+'},
      {id: '6', nombre: 'B-'},
      {id: '7', nombre: 'AB+'},
      {id: '8', nombre: 'AB-'},

      ];

//Fin Carga datos tipo de sangre


$scope.tipo_com = {
  'id': 1,
  'unit': null
  }


//inicio cargar datos corregimientos

    $scope.data_corregimiento = {
      'id': 1,
      'unit': null
    }


    $.ajax({
      url: base_api + "/obtener/corregimientos",
      type: 'GET',
      dataType: 'JSON',
      async: false, 
    }).success(function(response){
      $scope.corregimientos = response;
        
    }).error(function() {
    
     
    });
    


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



   $scope.selectedCorregimiento=function(itemCorregimiento){

    var promise = $http.get(base_api + "/obtener/veredas/" + itemCorregimiento);
    promise.then(
    function(responseveredas) {
    $scope.veredas = responseveredas.data;
    console.log($scope.veredas);
    
      });

    }    

    $scope.data_vereda = {
      'id': 1,
      'unit': null
    }
 
//fin 


//inicio Data carga estado civl

 $scope.tipo_est = {
        'id': 1,
        'unit': null
        }


  
    $http.get(base_api + "/obtener/estados_civiles")
  .success(function(response){
    $scope.civiles = response;
 
  });

//

//Inicio Carga datos hijos crear
  
  $scope.tipo_hij = {
        'id': 1,
        'unit': null
        }


  $scope.hijo = [
    {id: 1, nombre: 'Si'},
    {id: 2, nombre: 'No'},

    ];

//Fin Carga datos hijos crear

//inicio cargar datos modalidades

    $scope.tipo_ocup = {
      'id': 1,
      'unit': 3
    }

 $http.get(base_api + "/obtener/ocupaciones")
    .success(function(ocupaciones){

      $scope.ocupaciones = ocupaciones;
    
    });


//Inicio Carga de datos Escolaridad Crear
  
   $scope.tipo_esc = {
  'id': 1,
  'unit': null
  }


 $http.get(base_api + "/obtenerselect/escolaridades")
  .success(function(response){

    $scope.escolaridades = response;


  });

//Fin Carga de datos Escolaridad Crear

//Inicio Carga de datos Estado Escolaridad Crear
  
$scope.estado_esc = {
  'id': 1,
  'unit': null
  }


 $http.get(base_api + "/obtenerselect/EstadoEscolaridades")
  .success(function(response){

    $scope.estadoescolaridades = response;


  });


//Inicio Carga datos cultura crear
  
  $scope.tipo_cult = {
        'id': 1,
        'unit': null
        }



    $scope.tipo_etnias = {
      'id': 1,
      'unit': null
      }


  $http.get(base_api + "/obtenerselect/culturas")
  .success(function(response){

    $scope.etnias = response;
    

  });



//Fin Carga datos cultura crear


//inicio carga discapacidad si o no

$scope.tipo_disc = {
        'id': 1,
        'unit': null
        }



 $scope.discapacidades = [
    {id: 1, nombre: 'Si'},
    {id: 2, nombre: 'No'},

    ];


//fin

//inicio carga afiliacion salud si o no

$scope.tipo_afiliacion_salud = {
  'id': 1,
  'unit': null
  }



$scope.afiliacion_salud = [
{id: 1, nombre: 'Si'},
{id: 2, nombre: 'No'},

];


//fin


//inicio carga discapacidad si o no

$scope.tipo_libreta = {
  'id': 1,
  'unit': null
  }



$scope.libreta = [
{id: 1, nombre: 'Primera'},
{id: 2, nombre: 'Segunda'},

];


//fin


//inicio carga salud si o no

$scope.tipo_salud = {
        'id': 1,
        'unit': null
        }



$scope.seguridad_social = [
    {id: 1, nombre: 'Si'},
    {id: 2, nombre: 'No'},

    ];


//fin

//inicio carga alunos regimens



$scope.tipo_salud_otra = {
        'id': 1,
        'unit': null
        }





 $http.get(base_api + "/obtenerselect/salud_sgsss")
  .success(function(response){

    $scope.salud_sgsss = response;

  });


//fin

//inicio carga algunas discapacidades


$scope.tipo_disc_otra = {
        'id': 1,
        'unit': null
        }



 $http.get(base_api + "/obtenerselect/discapacidad")
  .success(function(response){

    $scope.discapacidad_otra = response;

  });

//fin




//Inicio cargar universidades
$scope.selected = undefined;
$http.get(base_api + "/obtenerselect/universidades")
  .success(function(response){

    $scope.universidades = response;
   
  });

//Inicio cargar enfermedad si o no 

$scope.tipo_eferm = {
        'id': 1,
        'unit': null
        }


  $scope.enfermedades = [
    {id: 1, nombre: 'Si'},
    {id: 2, nombre: 'No'},

    ];

//fin

//inicio cargar data medicamentos si o no


$scope.tipo_medic = {
        'id': 1,
        'unit': null
        }



    $scope.medicamentos = [
    {id: 1, nombre: 'Si'},
    {id: 2, nombre: 'No'},

    ];


//fin

//inicio cargar parentesco


//inicio cargar data medicamentos si o no

$scope.tipo_condicion = {
  'id': 1,
  'unit': null
  }



$scope.condiciondiscapacidad = [
{id: 1, nombre: 'Si'},
{id: 2, nombre: 'No'},

];


$scope.selectedCondicion = function(condicion)
{

  if(condicion == 1)
  {
    $scope.ngShowhideDiscapacidad = true;
  }
  else{
    $scope.ngShowhideDiscapacidad = false;
  }
}


//fin



//inicio carga Afiliacion


$scope.tipo_afiliacion = {
  'id': 1,
  'unit': null
  }



$http.get(base_api + "/obtenerselect/afiliaciones")
.success(function(response){

$scope.afiliaciones = response;

});

//fin


$scope.tipo_parent = {
        'id': 1,
        'unit': null
        }


$scope.parentescos = [
    {id: '1', nombre: 'Madre/Padre'},
    {id: '2', nombre: 'Hermana/Hermano'},
    {id: '3', nombre: 'Tia/Tio'},
    {id: '4', nombre: 'Abuela/Abuelo'},
    {id: '5', nombre: 'Cuidador'},
    {id: '6', nombre: 'Otro'},

    ];
//


//inicio cargar poblacionales

 Array.prototype.indexOfObjectWithProperty = function(propertyName, propertyValue)
  {
    for (var i = 0, len = this.length; i < len; i++)
    {
      if (this[i][propertyName] === propertyValue) return i;
    }

    return -1;
  };


  Array.prototype.containsObjectWithProperty = function(propertyName, propertyValue)
  {
    return this.indexOfObjectWithProperty(propertyName, propertyValue) != -1;
  };


 $http.get(base_api + "/obtenerselect/allGrupos_disciplinas")
  .success(function(response){

    $scope.allGrupos_disciplinas = response;
 
  });


 $http.get(base_api + "/obtenerselect/allGrupos_poblacionales")
  .success(function(response){

    $scope.allGrupos_poblacionales = response;
 
  });


  
 $http.get(base_api + "/obtenerselect/discapacidad")
 .success(function(discapacidades){
  
   $scope.allGruposDiscapacidades = discapacidades;

 });

//fin

$http.get(base_api + "/obtener/barrios")
.success(function(response){

  $scope.barrios = response;
  // console.log($scope.barrios);

});


$http.get(base_api + "/obtenerselect/comunas")
    .success(function(response){

      $scope.comunas = response;


    });

    $scope.selectedComuna=function(itemComuna){


      $scope.tipo_barr = {
      'id': 1,
      'unit': null
      }

     
    }    


    $scope.selectedBarrio = function(itemBarrio)
    {


      $http.get(base_api + "/obtener/estrato/" + itemBarrio)
      
      .success(function(estratobeneficiario){
            $scope.tipo_estrato = {
            'id': 1,
            'unit': estratobeneficiario.id_estrato
            }
            $scope.comuna = estratobeneficiario.nombre_comuna;

      });


  
    }

    $scope.ngShowhideBarrio =true;
    $scope.ngShowhideDireccion =true;
    $scope.ngShowhideComplemento =true;
  
  
    
    $scope.selectedVereda = function(veredaselect)
    {

      $http.get(base_api + "/obtener/estratoVereda/" + veredaselect)
      
      .success(function(EstratoVereda){
        console.log(EstratoVereda);
            $scope.tipo_estrato = {
            'id': 1,
            'unit': EstratoVereda.estrato
            }
            $scope.comuna = EstratoVereda.nombre_comuna;
           
      });

      if(veredaselect != null)
      {
        $scope.ngShowhideBarrio =false;
        $scope.ngShowhideDireccion =false;
        $scope.ngShowhideComplemento =false;
        $scope.barrio = undefined;
  


      }else{
        $scope.vereda = undefined;
        $scope.corregimiento = undefined;
        $scope.ngShowhideBarrio =true;
        $scope.ngShowhideDireccion =true;
        $scope.ngShowhideComplemento =true;
        $scope.tipo_estrato = {
          'id': 1,
          'unit': null
          }
        $scope.comuna = null;

      }

    }




    $scope.reset = function () {
      $scope.vereda = undefined;
      $scope.corregimiento = undefined;
      $scope.ngShowhideBarrio =true;
      $scope.ngShowhideDireccion =true;


  };

 $scope.onBlurDocumento = function($event) {
      
      var no_documento_beneficiario = $scope.no_documento_persona;

      $http.get(base_api + "/admin/postpersona/cargar/" + no_documento_beneficiario)
        .success(function(response){

          
          if (response.length != 0) {

            swal("Registro Existente!", "Este registro ya existe puedes actualizarlo si lo deseas!", "success");

        


          $scope.serie = response[0];
          $scope.acudiente = response[0];
          
          // console.log($scope.serie);
          
          $scope.universidad = $scope.serie.nombre_universidad;


        
          $scope.tipo_etnias = {
            'id': 1,
            'unit': $scope.serie.etnia_id
          }

        $scope.tipo_estrato = {
        'id': 1,
        'unit': parseInt($scope.serie.residencia_estrato)
        }
        $scope.tipo_afiliacion_salud = {
        'id': 1,
        'unit': $scope.serie.afiliacion_salud
        }
         $scope.tipo_doc = {
        'id': 1,
        'unit': $scope.serie.id_documento_tipo
        }
         $scope.tipo_condicion = {
        'id': 1,
        'unit': $scope.serie.condicion_discapacidad
        }

      
        if($scope.serie.condicion_discapacidad == 1)
        {
          $scope.ngShowhideDiscapacidad = true;
        }
        else{
          $scope.ngShowhideDiscapacidad = false;
        }



         $scope.tipo_afiliacion = {
        'id': 1,
        'unit': $scope.serie.tipoafiliacion_id
        }

        $scope.tipo_salud_otra = {

        'id': 1,
        'unit': $scope.serie.eps_id

        }

        // console.log($scope.tipo_salud_otra);

        $scope.tipo_sex = {
        'id': 1,
        'unit': $scope.serie.sexo
        }



        $scope.tipo_sag = {
        'id': 1,
        'unit': $scope.serie.sangre_tipo
        }

        $scope.pais = $scope.serie.id_procedencia_pais;
        $scope.departamento = $scope.serie.id_procedencia_departamento; 
        $scope.municipio = $scope.serie.id_procedencia_municipio; 
       
        


      $http.get(base_api + "/obtener/comuna_barrio/" + $scope.serie.id_residencia_barrio)
        .success(function(responseComuna){

         
         $scope.tipo_com = {
          'id': 1,
          'unit': responseComuna[0].id
        }
      
      $scope.barrio = $scope.serie.id_residencia_barrio;
      

      });

      $scope.corregimiento = $scope.serie.id_residencia_corregimiento;


      $http.get(base_api + "/obtener/estrato/" + $scope.serie.id_residencia_barrio)
      
      .success(function(estratobeneficiario){
            $scope.comuna = estratobeneficiario.nombre_comuna;

      });



      $http.get(base_api + "/obtener/veredas/" + $scope.serie.id_residencia_corregimiento)
      .success(function(response){

        $scope.veredas = response;


      });

      $scope.vereda = $scope.serie.id_residencia_vereda;

      if($scope.vereda != null)
      {
        $scope.ngShowhideBarrio =false;
        $scope.ngShowhideDireccion =false;
        $scope.ngShowhideComplemento =false;
        $scope.barrio = undefined;
  

      }else{
        $scope.vereda = undefined;
        $scope.corregimiento = undefined;
        $scope.ngShowhideBarrio =true;
        $scope.ngShowhideDireccion =true;
        $scope.ngShowhideComplemento =true;
      }


      $http.get(base_api + "/obtener/estratoVereda/" + $scope.serie.id_residencia_vereda)
      
      .success(function(EstratoVereda){
            $scope.tipo_estrato = {
            'id': 1,
            'unit': EstratoVereda.estrato
            }
            $scope.comuna = EstratoVereda.nombre_comuna;
           
      });


    

      $scope.tipo_est = {
        'id': 1,
        'unit': $scope.serie.id_estado_civil
        }



        $scope.tipo_hij = {
        'id': 1,
        'unit': $scope.serie.hijos_beneficiario
        }
        if ($scope.serie.hijos_beneficiario == 1) {
        $scope.isDisabled = false;
        }
        else{

        $scope.isDisabled = true;

      } 


      $scope.tipo_ocup = {
        'id': 1,
        'unit': $scope.serie.ocupacion_beneficiario
        }



      if ($scope.serie.ocupacion_beneficiario == 8) {
        $scope.isDisabledOcupacion = false;
      }
      else{

        $scope.isDisabledOcupacion = true;

      }

         $scope.tipo_esc = {
          'id': 1,
          'unit': $scope.serie.escolaridad_id
          }


        $scope.tipo_cult = {
        'id': 1,
        'unit': $scope.serie.cultura_beneficiario
        }

          if ($scope.serie.cultura_beneficiario == 10) {
        $scope.isDisabledCultura = false;
        }
        else{

          $scope.isDisabledCultura = true;

        }

        $http.get(base_api + "/cargar/poblacionalesDocumento/" + no_documento_beneficiario)
          .success(function(response){
            $scope.selectedPoblacionales = response;
            $scope.selectedPoblacionales.map(function(poblacional) {
              
              
                if(poblacional.id == 10)
                {
                  $scope.ngShowhideOtro = true;
                  
                }
                else if(poblacional.id != 10){
                  $scope.ngShowhideOtro = false;
                
                }

            })
        
                 
          });

          $scope.otro_poblacional = $scope.serie.otro_poblacional;

          $http.get(base_api + "/cargar/discapacidadesDocumento/" + no_documento_beneficiario)
          .success(function(response){

            $scope.selectedDiscapacidades = response;

          });


          $http.get(base_api + "/cargar/disciplinasDocumento/" + no_documento_beneficiario)
          .success(function(response){

            $scope.selectedDisciplinas = response;

          });




        $scope.tipo_salud = {
        'id': 1,
        'unit': $scope.serie.seguridad_social_beneficiario
        }

        if ($scope.serie.seguridad_social_beneficiario == 1) {
        // $scope.isDisabledSeguridad = false;
        }
        else{

        // $scope.isDisabledSeguridad = true;
        }

        $scope.tipo_disc = {
        'id': 1,
        'unit': $scope.serie.enfermedad_permanente
        }

        if ($scope.serie.enfermedad_permanente == 1) {
          
          $scope.isDisabledDiscapacidad = false;
          }
          else{
  
          $scope.isDisabledDiscapacidad = true;
  
          }

        $scope.tipo_disc_otra = {
        'id': 1,
        'unit': $scope.serie.discapacidad_id
        }

        // console.log($scope.tipo_disc_otra);
        $scope.tipo_eferm = {
        'id': 1,
        'unit': $scope.serie.enfermedad_permanente_beneficiario
        }


        if ($scope.serie.enfermedad_permanente_beneficiario == 1) {
        $scope.isDisabledEnfermedad = false;
        }
        else{

        $scope.isDisabledEnfermedad = true;

        }


        $scope.tipo_medic = {
        'id': 1,
        'unit': $scope.serie.medicamentos
        }


        if ($scope.serie.medicamentos == 1) {
        $scope.isDisabledMedicamento = false;
        }
        else{

        $scope.isDisabledMedicamento = true;

        }

        $scope.tipo_libreta = {
          'id': 1,
          'unit': $scope.serie.libreta_militar
          }
        

        $scope.estado_esc = {
        'id': 1,
        'unit': $scope.serie.estado_escolaridad
        }



        }

      });

      
    }





 function calcularEdad(birthday) {
  var birthday_arr = birthday.split("/");
  var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
  var ageDifMs = Date.now() - birthday_date.getTime();
  var ageDate = new Date(ageDifMs);
  return Math.abs(ageDate.getUTCFullYear() - 1970);
}

Date.prototype.addDays = function(days) {
  var dat = new Date(this.valueOf());
  dat.setDate(dat.getDate() + days);
  return dat;
}

function init() {
  $scope.startDate = new Date();
  $scope.endDate = $scope.startDate.addDays(14);
  $scope.startDateParentesco = new Date();
  $scope.startDateInscripcion = new Date();
  $scope.endDatep = $scope.startDateParentesco.addDays(14);  
  $scope.endDateInscripcion = $scope.startDateInscripcion.addDays(14);  

}


function load() {

 $scope.fecha_nacimiento = $scope.startDate;
 var d = new Date($scope.fecha_nacimiento); 
 var fecha = $.datepicker.formatDate('dd/mm/yy', d);
 var n = fecha.toString();
 $scope.edad_beneficiario = calcularEdad(n);


}

function load_parentesco() {

 $scope.fecha_nacimiento_pariente = $scope.startDateParentesco;
 var d_pariente = new Date($scope.fecha_nacimiento_pariente); 
 var fecha_pariente = $.datepicker.formatDate('dd/mm/yy', d_pariente);
 var n_pariente = fecha_pariente.toString();
 $scope.edad_pariente = calcularEdad(n_pariente);

}

init();
    // public methods
    $scope.load = load;
    $scope.load_parentesco = load_parentesco;
    $scope.setStart = function(date) {
      $scope.startDate = date;
      $scope.fecha_nacimiento_beneficiario = $scope.startDate;
      var d_beneficiario = new Date($scope.fecha_nacimiento_beneficiario); 
      var fecha_beneficiario = $.datepicker.formatDate('dd/mm/yy', d_beneficiario);
      var n_beneficiario = fecha_beneficiario.toString();
      $scope.edad_beneficiario = calcularEdad(n_beneficiario);
    
    };

    $scope.setStartInscripcion = function(date) {
      $scope.startDateInscripcion = date;
    };


    $scope.setStartParentesco = function(date) {
      $scope.startDateParentesco = date;
      $scope.fecha_nacimiento_acudiente = $scope.startDateParentesco;
      var d_acudiente = new Date($scope.fecha_nacimiento_acudiente); 
      var fecha_acudiente = $.datepicker.formatDate('dd/mm/yy', d_acudiente);
      var n_acudiente = fecha_acudiente.toString();
      $scope.edad_pariente = calcularEdad(n_acudiente);

    };

    $scope.setEnd = function(date) {
      $scope.endDate = date;
      $scope.endDatep = date;
      $scope.endDateInscripcion = date;
    };

    $scope.tipo_documento = [
    {id: '1', nombre: 'Registro Civil'},
    {id: '2', nombre: 'Tarjeta Identidad'},
    {id: '3', nombre: 'Cédula de Ciudadanía'},
    {id: '4', nombre: 'Pasaporte'},
    {id: '5', nombre: 'Sin Información'},

    ];

  

    $scope.grupos_poblacionales = [
    {id: '1', nombre: 'Adulto Mayor'},
    {id: '2', nombre: 'Afrodescendiente/Afrocolombiano'},
    {id: '3', nombre: 'Víctimas del conflicto armado'},
    {id: '4', nombre: 'Habitante calle'},
    {id: '5', nombre: 'LGBTI'},
    {id: '6', nombre: 'Persona con discapacidad'},
    {id: '7', nombre: 'Grupo organizado de Mujeres'},
    {id: '8', nombre: 'Indígenas'},
    {id: '9', nombre: 'Reinsertado'},
    {id: '10', nombre: 'Junta de acción comunal (JAC)'},
    {id: '11', nombre: 'Grupo organizado de Jóvenes'},
    {id: '12', nombre: 'Ninguno'},
    {id: '13', nombre: 'Recluido'},
    {id: '14', nombre: 'Junta de administradora local (JAL)'},
    {id: '15', nombre: 'Otro grupo'},

    ];

    $scope.selected = {
            poblacionales: []
        };
      
    $http.get(base_api + "/obtener/programas")
    .success(function(response){

      $scope.programas = response;


    });



$.ajax({
  url: base_api + "/obtener/paises",
  type: 'GET',
  dataType: 'JSON',
  async: false, 
}).success(function(response){
  $scope.paises = response;
    
}).error(function() {

 
});

  $scope.pais = 1;

  

    $scope.data_paises = {
      'id': 1,
      'unit': 1
    }

    if ($scope.data_paises.unit == 1) {

       $scope.ngShowhide1 =true;
       $scope.ngShowhide2 =false;
    }
    else{

       $scope.ngShowhide1 =false;
       $scope.ngShowhide2 =true;


    }


$scope.departamento = 76;

$.ajax({
  url: base_api + "/obtener/departamentos/" + $scope.data_paises.unit,
  type: 'GET',
  dataType: 'JSON',
  async: false, 
}).success(function(response){
  $scope.departamentos = response;
    
}).error(function() {

 
});

     

 $scope.municipio = 834;
 $http.get(base_api + "/obtener/municipios/" + $scope.departamento)
    .success(function(response){
      $scope.municipios = response;

    });




    $scope.selectedPais=function(itemPais){


if (itemPais == 1) {

       $scope.ngShowhide1 =true;
       $scope.ngShowhide2 =false;
    }
    else{

       $scope.ngShowhide1 =false;
       $scope.ngShowhide2 =true;


    }


      var promise = $http.get(base_api + "/obtener/departamentos/" + itemPais);
        promise.then(
        function(responsedepartamentos) {
        $scope.departamentos = responsedepartamentos.data;
        
  });
}    

    

    $scope.selectedDepartamento=function(itemDepartamento){


      var promise = $http.get(base_api + "/obtener/municipios/" + itemDepartamento);
      promise.then(
      function(responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
      
});

    }    
    
    
   


 

    $scope.isDisabled = true;
    $scope.isDisabledOcupacion = true;
    $scope.isDisabledCultura = true;
    $scope.isDisabledDiscapacidad = true;
    $scope.isDisabledEnfermedad = true;
    $scope.isDisabledMedicamento = true;
    // $scope.isDisabledSeguridad = true;
    $scope.isDisabledParentesco = true;

    $scope.selectedHijos=function(itemHijos){

      if (itemHijos == 1) {
        $scope.isDisabled = false;
      }
      else{

        $scope.isDisabled = true;

      }

    }   

    $scope.selectedOcupacion=function(itemOcupacion){



      if (itemOcupacion == 8) {
        $scope.isDisabledOcupacion = false;
      }
      else{

        $scope.isDisabledOcupacion = true;

      }

    }   

    $scope.selectedCultura=function(itemCultura){


      if (itemCultura == 10) {
        $scope.isDisabledCultura = false;
      }
      else{

        $scope.isDisabledCultura = true;

      }

    }   

    $scope.selectedDiscapacidad=function(itemDiscapacidad){


      if (itemDiscapacidad == 1) {
        $scope.isDisabledDiscapacidad = false;
      }
      else{

        $scope.isDisabledDiscapacidad = true;
        $scope.tipo_disc_otra.unit = null;
        $scope.serie.otra_discapacidad_beneficiario = null;



      }

    }   

    $scope.selectedEnfermedad=function(itemEnfermedad){


      if (itemEnfermedad == 1) {
        $scope.isDisabledEnfermedad = false;
      }
      else{

        $scope.isDisabledEnfermedad = true;
        $scope.serie.enfermedad_beneficiario = null;

      }

    }   

    $scope.selectedMedicamento=function(itemMedicamento){


      if (itemMedicamento == 1) {
        $scope.isDisabledMedicamento = false;
      }
      else{

        $scope.isDisabledMedicamento = true;
        $scope.serie.medicamentos_beneficiario = null;

      }

    }   


    $scope.selectedSeguridad=function(itemSeguridad){


      if (itemSeguridad == 1) {
        // $scope.isDisabledSeguridad = false;
      }
      else{

        // $scope.isDisabledSeguridad = true;
        $scope.tipo_salud_otra.unit = null;
        $scope.serie.nombre_seguridad_beneficiario = null;
      }
    }   

    $scope.selectedParentesco=function(itemParentesco){

      if (itemParentesco == 6) {
        $scope.isDisabledParentesco = false;
      }
      else{

        $scope.isDisabledParentesco = true;
      }
    }   

    $scope.selection = [];
    $scope.today = function () {
      $scope.dt = new Date();
    };
    $scope.today();
    $scope.openCalendar = function ($event) {
      $event.preventDefault();
      $event.stopPropagation();
      $scope.opened = true;
    }

    $scope.openCalendarNacimiento = function ($event) {

      $event.preventDefault();
      $event.stopPropagation();
      $scope.opened = true;
    }

    $scope.keyup = function (IsActive) {
      if (!IsActive) {
        $scope.IsActive = true;                
      } else {
        $scope.IsActive = false;
      }
    }

    $scope.ngShowhideOtro =false;
   

    
  $scope.toggleSelection = function toggleSelection(seleccion)
  {


    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);
    

    if(index == index && seleccion.id == 10)
    {
      $scope.ngShowhideOtro =true;
      $scope.otro_poblacional = '';
    }

    if(seleccion.id == 10)
    {
      $scope.ngShowhideOtro =true;
      
     
    }
    
    
    if (index > -1)
    {
      $scope.selectedPoblacionales.splice(index, 1);

      if(index == 0 && seleccion.id == 10)
      {
        $scope.ngShowhideOtro = false;
        $scope.otro_poblacional = '';
      }

      // console.log($scope.serie.ficha_save);
      // console.log(seleccion.id);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/poblacional/" + $scope.serie.ficha_save,
        data: $.param({
            grupo_pcs: seleccion.id
            
        }),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function (data, status, headers, config) {
        // handle success things
    }).error(function (data, status, headers, config) {
        
    });

  }
    else
    {
      $scope.selectedPoblacionales.push(seleccion);
     
    }
  };
  $scope.toggleSelectionDisciplina = function toggleSelectionDisciplina(seleccion)
  {


    var index = $scope.selectedDisciplinas.indexOfObjectWithProperty('id', seleccion.id);
    
    if (index > -1)
    {
      $scope.selectedDisciplinas.splice(index, 1);

   
      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/poblacional/" + $scope.serie.ficha_save,
        data: $.param({
            grupo_pcs: seleccion.id
            
        }),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function (data, status, headers, config) {
        // handle success things
    }).error(function (data, status, headers, config) {
        
    });

  }
    else
    {
      $scope.selectedDisciplinas.push(seleccion);
     
    }
  };

  $scope.toggleSelectionDiscapacidad = function toggleSelectionDiscapacidad(seleccion)
  {

    var index = $scope.selectedDiscapacidades.indexOfObjectWithProperty('id', seleccion.id);
    // console.log(index);

    if (index > -1)
    {
      $scope.selectedDiscapacidades.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/discapacidad/" + $scope.serie.ficha_save,
        data: $.param({
            grupo_pcs: seleccion.id
            
        }),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function (data, status, headers, config) {
        // handle success things
    }).error(function (data, status, headers, config) {
        
    });

  }
    else
    {
      $scope.selectedDiscapacidades.push(seleccion);
     
    }
  };

  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;

    $scope.formsubmit = function(){

      if($scope.serie.telefono_fijo == undefined)
      {
        $scope.serie.telefono_fijo = null
      }
      else{
          $scope.serie.telefono_fijo = $scope.serie.telefono_fijo;
      }
      
      if($scope.serie.no_libreta == undefined)
      {
        $scope.serie.no_libreta = null
      }
      else{
          $scope.serie.no_libreta = $scope.serie.no_libreta;
      }
      
      if($scope.serie.distrito_militar == undefined)
      {
        $scope.serie.distrito_militar = null
      }
      else{
          $scope.serie.distrito_militar = $scope.serie.distrito_militar;
      }
      
      
      if($scope.serie.skype_empleado == undefined)
      {
        $scope.serie.skype_empleado = null
      }
      else{
          $scope.serie.skype_empleado = $scope.serie.skype_empleado;
      }
      
      if($scope.serie.proyecto_profesional == undefined)
      {
        $scope.serie.proyecto_profesional = null
      }
      else{
          $scope.serie.proyecto_profesional = $scope.serie.proyecto_profesional;
      }
      
      
      if(typeof $scope.universidad === 'object')
      {
      
        if($scope.universidad == null)
        {
           $scope.universidad = null;
       
        }else{
           $scope.universidad = $scope.universidad.nombre;
       
        }
        
      
      }
      if($scope.universidad == undefined)
      {
        $scope.universidad = null;
       
      }
      if($scope.universidad == null)
      {
        $scope.universidad = null;
       
      }
      else{
        $scope.universidad = $scope.universidad;
      }
      
      if($scope.serie.titulo_obtenido == undefined){
        $scope.serie.titulo_obtenido = null;
      }
      else if($scope.serie.titulo_obtenido != null){
      $scope.serie.titulo_obtenido = $scope.serie.titulo_obtenido;
      }

      
        var cantidad_hijos_b = '';
        var  otra_ocupacion = '';
        var  otra_cultura = '';
        var  cual_discapacidad = '';
        var  otra_discapacidad = '';
        var  enfermedad_benec = '';
        var  medicamento_benec = '';
        var  otra_salud = '';
        var  seguridad_benec = '';
        var  parentesco_benec = '';
      
      
        if($scope.serie.titulo_obtenido == undefined){
            $scope.serie.titulo_obtenido = null;
        }
        else if($scope.serie.titulo_obtenido != null){
          $scope.serie.titulo_obtenido = $scope.serie.titulo_obtenido;
        }
        if($scope.otro_poblacional == undefined){
            otro_poblacional = null;
        }
        else if($scope.otro_poblacional != null){
          otro_poblacional = $scope.otro_poblacional;
        }
      
        if($scope.serie.cantidad_hijos_beneficiario == undefined){
            cantidad_hijos_b = null;
        }
        else if($scope.serie.cantidad_hijos_beneficiario != null){
          cantidad_hijos_b = $scope.serie.cantidad_hijos_beneficiario;
        }
        if($scope.serie.otra_ocupacion_beneficiario == undefined){
            otra_ocupacion = null;
        }
        else if ($scope.serie.otra_ocupacion_beneficiario != null) {
          otra_ocupacion = $scope.serie.otra_ocupacion_beneficiario;
        }
      
      
        if($scope.serie.otra_cultura_beneficiario == undefined){
            otra_cultura = null;
        }
        else if ($scope.serie.otra_cultura_beneficiario != null) {
          otra_cultura = $scope.serie.otra_cultura_beneficiario;
        }
      
      
        if($scope.tipo_disc_otra.unit == undefined){
            cual_discapacidad = null;
        }
        else if ($scope.tipo_disc_otra.unit != null) {
          cual_discapacidad = $scope.tipo_disc_otra.unit;
        }
      
      
      
        if($scope.serie.otra_enfermedad == undefined){
            otra_discapacidad = null;
        }
        else if ($scope.serie.otra_enfermedad != null) {
          otra_discapacidad = $scope.serie.otra_enfermedad;
        }
      
      
        if($scope.serie.enfermedad_beneficiario == undefined){
            enfermedad_benec = null;
        }
        else if ($scope.serie.enfermedad_beneficiario != null) {
          enfermedad_benec = $scope.serie.enfermedad_beneficiario;
        }
      
      
      
        if($scope.serie.otros_medicamentos == undefined){
            medicamento_benec = null;
        }
        else if ($scope.serie.otros_medicamentos != null) {
          medicamento_benec = $scope.serie.otros_medicamentos;
        }
      
      
      
        if($scope.tipo_salud_otra.unit == undefined){
            otra_salud = null;
        }
        else if ($scope.tipo_salud_otra.unit != null) {
          otra_salud = $scope.tipo_salud_otra.unit;
      
        }
      
      
      
      
        if($scope.serie.nombre_seguridad_beneficiario == undefined){
            seguridad_benec = null;
        }
        else if ($scope.serie.nombre_seguridad_beneficiario != null) {
          seguridad_benec = $scope.serie.nombre_seguridad_beneficiario;
        }
      
      
      
        if($scope.serie.otro_parentesco_acudiente == undefined){
            parentesco_benec = null;
        }
        else if ($scope.serie.otro_parentesco_acudiente != null) {
          parentesco_benec = $scope.serie.otro_parentesco_acudiente;
        }
      
        if($scope.corregimiento == undefined){
            corregimiento_persona = null;
        }
        else if ($scope.corregimiento != null) {
          corregimiento_persona = $scope.corregimiento;
        }
      
        if($scope.vereda == undefined){
            vereda_persona = null;
        }
        else if ($scope.vereda != null) {
          vereda_persona = $scope.vereda;
        }
        if($scope.barrio == undefined){
            barrio_persona = null;
        }
        else if ($scope.barrio != null) {
          barrio_persona = $scope.barrio;
        }
      
      var ficha_registro = 0;
      if($scope.serie.ficha_save == null){
      
          ficha_registro = 0;
      
        }
      
        else if($scope.serie.ficha_save > 0)
        {
      
          ficha_registro = $scope.serie.ficha_save;
        }
      
      


     var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val()
     var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
     var fecha_inscripcion = $("#fecha_inscripcion").val();
     var SelectPoblacional = $scope.selectedPoblacionales;    
     var SelectDiscapacidad = $scope.selectedDiscapacidades;    
     var SelectDisciplina = $scope.selectedDisciplinas;    
     
         var datos ={

  //Universidad
  universidad: $scope.universidad,
  //Datos Persona
  tipo_doc_persona: $scope.tipo_doc.unit,
  no_documento_persona: $scope.no_documento_persona,
  primer_nombre_persona: $scope.serie.nombre_primero,
  segundo_nombre_persona: $scope.serie.nombre_segundo,
  primer_apellido_persona: $scope.serie.apellido_primero,
  segundo_apellido_persona: $scope.serie.apellido_segundo,
  correo_persona: $scope.serie.correo_electronico,
  sexo_persona: $scope.tipo_sex.unit,
  fecha_nac_persona: fecha_nacimiento_beneficiario,           
  pais_id: $scope.data_paises.unit,           
  departamento_id: $scope.departamento,           
  municipio_id: $scope.municipio,           
  corregimiento: corregimiento_persona,
  vereda: vereda_persona,
  barrio_id: barrio_persona,         
  estrato: $scope.tipo_estrato.unit,
  residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
  complemento: $("#id_persona_beneficiario_residencia_direccion_complemento").val(),
  telefono_fijo_persona: $scope.serie.telefono_fijo,
  telefono_movil_persona : $scope.serie.telefono_movil,
  tip_sangre_persona: $scope.tipo_sag.unit,
  estado_civil_persona: $scope.tipo_est.unit,          
  
  //Datos Beneficiario     
  no_ficha: $scope.serie.no_ficha,
  fecha_inscripcion: fecha_inscripcion,
  escolaridad_beneficiario: $scope.tipo_esc.unit,         
  estado_escolaridad: $scope.estado_esc.unit,         
  titulo_obtenido: $scope.serie.titulo_obtenido,
  universidad: $scope.universidad,
  ocupacion_beneficiario: $scope.tipo_ocup.unit,   
  hijos_beneficiario: $scope.tipo_hij.unit,            
  cantidad_hijos_beneficiario: cantidad_hijos_b, 
  cultura_beneficiario: $scope.tipo_etnias.unit,           
  discapacidad_beneficiario: $scope.tipo_disc.unit,            
  otra_discapacidad_beneficiario: otra_discapacidad,           
  medicamentos_permanente_beneficiario: $scope.tipo_medic.unit,            
  medicamentos_beneficiario: medicamento_benec,    
  condicion_discapacidad:$scope.tipo_condicion.unit,
  afiliacion_salud:$scope.tipo_afiliacion_salud.unit,
  tipo_afiliacion:$scope.tipo_afiliacion.unit,
  salud_sgsss_beneficiario: otra_salud,           
  parentesco_acudiente: $scope.tipo_parent.unit,          
  otro_parentesco_acudiente: parentesco_benec,
  ficha: ficha_registro,
  otro_poblacional: otro_poblacional,
  tipo_libreta:$scope.tipo_libreta.unit,
  no_libreta:$scope.serie.no_libreta,
  distrito_militar:$scope.serie.distrito_militar,
  skype_empleado:$scope.serie.skype_empleado,
  proyecto_profesional:$scope.serie.proyecto_profesional     

                       
        };







 $.ajax({
          url: base_api + '/postbeneficiario/createpersonal',
          type: 'POST',
          dataType: 'JSON',
          data: {
            datos,
            SelectPoblacional,
            SelectDiscapacidad,
            SelectDisciplina
        },
    
        }).success(function(){
            swal("Muy bien!", "Su registro ha sido exitoso", "success");
            toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
            window.location="/admin/postusuarios#/admin/postusuarios";

        })
        .error(function() {
          console.log("success");
        });
      }
    
  });
