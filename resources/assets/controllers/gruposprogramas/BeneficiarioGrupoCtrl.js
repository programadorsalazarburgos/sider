SeriesApp.controller("BeneficiarioGrupoCtrl", function($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q){
 
  $scope.reset = function () {
      $scope.state = undefined;
  };

  // $scope.prueba1 = 2;
  // $scope.corregimiento = 2;
  // $scope.vereda = 3;



  // var promise = $http.get(base_api + "/obtener/veredas/" + $scope.corregimiento);
  // promise.then(
  // function(responseveredas) {
  // $scope.veredas = responseveredas.data;
  // });





  $scope.title = "Beneficiario Grupo";
  $scope.series = [];
  $scope.selectedPoblacionales = [];
  $scope.selectedDiscapacidades = [];
 
  $scope.getData = function(){
    $scope.serie = GrupoService.get({id:$routeParams.id});
    console.log();

 };

 $scope.grupo_save = $routeParams.id;

 $scope.serie = {};

 
$scope.title = "Agregar Beneficiario";
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
  $('[name=documento_beneficiario]').maskNumber({integer: true});
});
$(document).ready(function () {
  $('[name=documento_acudiente]').maskNumber({integer: true});
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
      dateFormat: 'yy-mm-dd',
      yearRange: "1940:+nn"
  }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
});


$.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha_inscripcion").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "-99:+0",
      maxDate: "+0m +0d"
  }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
});

var d = new Date();
$scope.fecha_inscripcion = $.datepicker.formatDate( "yy-mm-dd",new Date(d));

$("#direccion_residencia_plugin").show();

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
    {id: 1, nombre: 'Madre/Padre'},
    {id: 2, nombre: 'Hermana/Hermano'},
    {id: 3, nombre: 'Tia/Tio'},
    {id: 4, nombre: 'Abuela/Abuelo'},
    {id: 5, nombre: 'Cuidador'},
    {id: 6, nombre: 'Otro'},

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
            'unit': parseInt(estratobeneficiario.id_estrato)
            }
            $scope.comuna = estratobeneficiario.nombre_comuna;
            $scope.comuna_id = estratobeneficiario.comuna_id;


      });


      


    }

    $scope.ngShowhideBarrio =true;
    $scope.ngShowhideDireccion =true;
    $scope.ngShowhideComplemento =true;
  
  
    $scope.selectedVereda = function(seleccionvereda)
    {

      console.log(seleccionvereda);
      $http.get(base_api + "/obtener/estratoVereda/" + seleccionvereda)
      
      .success(function(EstratoVereda){
            $scope.tipo_estrato = {
            'id': 1,
            'unit': EstratoVereda.estrato
            }
            $scope.comuna = EstratoVereda.nombre_comuna;
            $scope.comuna_id = EstratoVereda.id_comuna;
      });


      if(seleccionvereda != null)
      {
        $scope.ngShowhideBarrio =false;
        $scope.ngShowhideDireccion =false;
        $scope.ngShowhideComplemento =false;
        $scope.barrio = undefined;

      }

      else if(seleccionvereda == null){
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



  //   $scope.reset = function () {
  //     $scope.vereda = undefined;
  //     $scope.ngShowhideBarrio =true;
  //     $scope.ngShowhideDireccion =true;


  // };

 $scope.onBlurDocumento = function($event) {
      
      var no_documento_beneficiario = $scope.no_documento_persona;

      $http.get(base_api + "/admin/postbeneficiarios/cargar/" + no_documento_beneficiario)
        .success(function(response){


          if (response.persona.length != 0 || response.ficha.length != 0 || response.acudiente.length != 0) {

            swal("Registro Existente!", "Este registro ya existe puedes actualizarlo y se agregara a este grupo si lo deseas!", "success");


          $scope.persona = response.persona[0];
      

          if($scope.persona.residencia_direccion != null)
          {
            $("#direccion_residencia_plugin").hide();

          } 
          else if($scope.persona.residencia_direccion == '' || $scope.persona.residencia_direccion == null)
          {
            $("#direccion_residencia_plugin").show();
          } 


          $scope.tipo_doc = {
            'id': 1,
            'unit': $scope.persona.id_documento_tipo
            }

          //sexo genero persona
          $scope.tipo_sex = {
            'id': 1,
            'unit': $scope.persona.sexo
            }
  
          //Pais Departamento Municipios

          $scope.pais = $scope.persona.id_procedencia_pais;
          $scope.departamento = $scope.persona.id_procedencia_departamento;    
          var promise = $http.get(base_api + "/obtener/municipios/" + $scope.departamento);
          promise.then(
          function(responsemunicipios) {
          $scope.municipios = responsemunicipios.data;   
          });          
          $scope.municipio = $scope.persona.id_procedencia_municipio; 
          
          

          //Corregimiento y Vereda
          $scope.corregimiento = $scope.persona.id_residencia_corregimiento;
          $scope.vereda = $scope.persona.id_residencia_vereda;
          console.log($scope.vereda);

            
            var promise = $http.get(base_api + "/obtener/veredas/" + $scope.corregimiento);
              promise.then(
              function(responseveredas) {
              $scope.veredas = responseveredas.data;
              console.log($scope.veredas);
              });
          


          if($scope.vereda != null)
          {
            $scope.ngShowhideBarrio =false;
            $scope.ngShowhideDireccion =false;
            $scope.ngShowhideComplemento =false;
            $scope.barrio = undefined;
      
    
          }else if($scope.vereda == null){
            $scope.vereda = undefined;
            $scope.corregimiento = undefined;
            $scope.ngShowhideBarrio =true;
            $scope.ngShowhideDireccion =true;
            $scope.ngShowhideComplemento =true;
          }
          $http.get(base_api + "/obtener/estratoVereda/" + $scope.persona.id_residencia_vereda)
          
          .success(function(EstratoVereda){
                $scope.tipo_estrato = {
                'id': 1,
                'unit': EstratoVereda.estrato
                }
                $scope.comuna = EstratoVereda.nombre_comuna;
               
          });
    
            $http.get(base_api + "/obtener/barrios")
            .success(function(response){
              $scope.barrios = response;

            });
          //Barrio Estrato y Comuna
          $scope.barrio = $scope.persona.id_residencia_barrio;
      
          $scope.tipo_estrato = {
            'id': 1,
            'unit': parseInt($scope.persona.residencia_estrato)
            }

          $http.get(base_api + "/obtener/estrato/" + $scope.persona.id_residencia_barrio)
          
          .success(function(estratobeneficiario){
                $scope.comuna = estratobeneficiario.comuna_id;
    
          });
    
          $scope.ficha = response.ficha[0];

          $scope.comuna_id = $scope.ficha.comuna_id;

          //Nivel de escolaridad
          $scope.tipo_esc = {
            'id': 1,
            'unit': $scope.persona.escolaridad_id
            }
  
          //Estado Escolaridad
          
        $scope.estado_esc = {
          'id': 1,
          'unit': $scope.persona.estado_escolaridad
          }

          //Ocupacion Actual
          $scope.tipo_ocup = {
            'id': 1,
            'unit': $scope.persona.ocupacion_id
            }
    
            //Estado Civil
            
          $scope.tipo_est = {
            'id': 1,
            'unit': $scope.persona.id_estado_civil
            }

          
           $scope.tipo_hij = {
            'id': 1,
            'unit': $scope.ficha.hijos_beneficiario
            }
            if ($scope.ficha.hijos_beneficiario == 1) {
            $scope.isDisabled = false;
            }
            else{
    
            $scope.isDisabled = true;
           } 
  
           //Se reconoce como

           $scope.tipo_etnias = {
            'id': 1,
            'unit': $scope.ficha.cultura_beneficiario
          }

          //Padece de alguna enfermedad permanente

          $scope.tipo_disc = {
            'id': 1,
            'unit': $scope.ficha.discapacidad_beneficiario
            }
    
            if ($scope.ficha.discapacidad_beneficiario == 1) {
            $scope.isDisabledDiscapacidad = false;
            }
            else{
    
            $scope.isDisabledDiscapacidad = true;
    
            }

            //Tipo Medicamentos
            $scope.tipo_medic = {
              'id': 1,
              'unit': $scope.ficha.medicamentos_permanente_beneficiario
              }
      
      
              if ($scope.ficha.medicamentos_permanente_beneficiario == 1) {
              $scope.isDisabledMedicamento = false;
              }
              else{
      
              $scope.isDisabledMedicamento = true;
      
              }
      
              //Tipo de Sangre
              
              $scope.tipo_sag = {
                'id': 1,
                'unit': $scope.persona.sangre_tipo
                }


              // Tiene Alguna condicion de discpacidad
              $scope.tipo_condicion = {
                'id': 1,
                'unit': $scope.ficha.condicion_discapacidad
                }
        
              
                if($scope.ficha.condicion_discapacidad == 1)
                {
                  $scope.ngShowhideDiscapacidad = true;
                }
                else{
                  $scope.ngShowhideDiscapacidad = false;
                }
        

                //Se encuentra afiliado a la salud

                $scope.tipo_afiliacion_salud = {
                'id': 1,
                'unit': $scope.ficha.afiliacion_salud
                }
                
                //Tipo de Afiliacion

                $scope.tipo_afiliacion = {
                'id': 1,
                'unit': $scope.ficha.tipo_afiliacion
                }


                //Entidad de salud o eps
                  $scope.tipo_salud_otra = {
                'id': 1,
                'unit': $scope.ficha.salud_sgss_id

                }


                // var promise = $http.get(base_api + "/obtener/veredas/" + $scope.ficha.id_residencia_corregimiento);
                //   promise.then(
                //   function(responseveredas) {
                //   $scope.veredas = responseveredas.data;
                
                // });

                $scope.acudiente = response.acudiente[0];

                //Tipo Documento Acudiente                
                $scope.tipo_doc_acudiente = {
                  'id': 1,
                  'unit': $scope.acudiente.tipodocacudiente
                  }
          
                //Sexo genero Acudiente
                  $scope.tipo_sex_acudiente = {
                    'id': 1,
                    'unit': $scope.acudiente.sexoacudiente
                    }
                    
                //Parentesco acudiente
                $scope.tipo_parent = {
                  'id': 1,
                  'unit': parseInt($scope.ficha.parentesco_acudiente)
                  }
          
                  if (parseInt($scope.ficha.parentesco_acudiente) == 6) {
                  $scope.isDisabledParentesco = false;
                  }
                  else{
          
                  $scope.isDisabledParentesco = true;
                  }
                  }
          



        $http.get(base_api + "/obtener/poblacionalesDocumento/" + no_documento_beneficiario)
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

          $scope.otro_poblacional = $scope.ficha.otro_poblacional;

          $http.get(base_api + "/obtener/discapacidadesDocumento/" + no_documento_beneficiario)
          .success(function(response){

            $scope.selectedDiscapacidades = response;

          });




      });

      
    }



$scope.onBlurDocumentoAcudiente = function($event) {
      
      var no_documento_acudiente = $scope.acudiente.documento_acudiente;
      
      $http.get(base_api + "/admin/postbeneficiarios/cargarAcudiente/" + no_documento_acudiente)
        .success(function(acudiente){

          
          if (acudiente.length != 0) {

            swal("Registro Existente!", "Este registro ya existe puedes actualizarlo!", "success");

          $scope.acudiente = acudiente[0];
          
       

        $scope.tipo_doc_acudiente = {
        'id': 1,
        'unit': $scope.acudiente.tipodocacudiente
        }


        $scope.tipo_sex_acudiente = {
        'id': 1,
        'unit': $scope.acudiente.sexoacudiente
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


$scope.pais = 1;

$.ajax({
  url: base_api + "/obtener/paises",
  type: 'GET',
  dataType: 'JSON',
  async: false, 
}).success(function(response){
  $scope.paises = response;
    
}).error(function() {

 
});


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
    $.ajax({
      url: base_api + "/obtener/departamentos/" + itemPais,
      type: 'GET',
      dataType: 'JSON',
      async: false, 
    }).success(function(response){
      $scope.departamentos = response;
        
    }).error(function() {
    
     
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
        $scope.ficha.otra_discapacidad_beneficiario = null;



      }

    }   


    $scope.selectedMedicamento=function(itemMedicamento){


      if (itemMedicamento == 1) {
        $scope.isDisabledMedicamento = false;
      }
      else{

        $scope.isDisabledMedicamento = true;
        $scope.ficha.medicamentos_beneficiario = null;

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

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/poblacional/" + $scope.ficha.ficha_save,
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
        url: base_api + "/eliminar/discapacidadBeneficiario/" + $scope.ficha.ficha_save,
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

  
    $scope.ficha = {
      'no_ficha': null,
      }

    $scope.formsubmit = function(id, isValid){

    if (isValid) {

    var direccion_sider = $("#id_persona_beneficiario_residencia_direccion").val()
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


    var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val()
    var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
    var fecha_inscripcion = $("#fecha_inscripcion").val();
    var SelectPoblacional = $scope.selectedPoblacionales;    
    var SelectDiscapacidad = $scope.selectedDiscapacidades;    


    if($scope.ficha.no_ficha == undefined)
    {
      $scope.ficha.no_ficha = null
    }
    
    else{
      $scope.ficha.no_ficha = $scope.ficha.no_ficha;
    }


    if(fecha_inscripcion == undefined)
    {

      fecha_inscripcion = null
    }
    
    else{
      fecha_inscripcion = fecha_inscripcion;
    }

    if($scope.persona.nombre_segundo == undefined)
    {
      $scope.persona.nombre_segundo = null
    }
    
    else{
      $scope.persona.nombre_segundo = $scope.persona.nombre_segundo;
    }
    
    if($scope.persona.apellido_primero == undefined)
    {
      $scope.persona.apellido_primero = null
    }

    else{
      $scope.persona.apellido_primero = $scope.persona.apellido_primero;
    }
    
    if($scope.persona.apellido_segundo == undefined)
    {
      $scope.persona.apellido_segundo = null
    }

    else{
      $scope.persona.apellido_segundo = $scope.persona.apellido_segundo;
    }


    if($scope.persona.telefono_fijo == undefined)
    {
      $scope.persona.telefono_fijo = null
    }
    else{
        $scope.persona.telefono_fijo = $scope.persona.telefono_fijo;
    }
    
    if($scope.persona.telefono_movil == undefined)
    {
      $scope.persona.telefono_movil = null
    }
    else{
        $scope.persona.telefono_movil = $scope.persona.telefono_movil;
    }


      if($scope.acudiente.telefono_fijo_acudiente == undefined)
  {
    $scope.acudiente.telefono_fijo_acudiente = null
  }
  else{
      $scope.acudiente.telefono_fijo_acudiente = $scope.acudiente.telefono_fijo_acudiente;
  }

  if($scope.acudiente.correo_electronico_acudiente == undefined)
  {
    $scope.acudiente.correo_electronico_acudiente = null
  }
  else{
      $scope.acudiente.correo_electronico_acudiente = $scope.acudiente.correo_electronico_acudiente;
  }

  if($scope.acudiente.nombre_segundo_acudiente == undefined)
  {
    $scope.acudiente.nombre_segundo_acudiente = null
  }
  else{
      $scope.acudiente.nombre_segundo_acudiente = $scope.acudiente.nombre_segundo_acudiente;
  }


  if($scope.acudiente.apellido_segundo_acudiente == undefined)
  {
    $scope.acudiente.apellido_segundo_acudiente = null
  }
  else{
      $scope.acudiente.apellido_segundo_acudiente = $scope.acudiente.apellido_segundo_acudiente;
  }

  if($scope.persona.correo_electronico == undefined)
  {
    $scope.persona.correo_electronico = null
  }
  else{
      $scope.persona.correo_electronico = $scope.persona.correo_electronico;
  }


  if($scope.otro_poblacional == undefined){
      otro_poblacional = null;
  }
  else if($scope.otro_poblacional != null){
    otro_poblacional = $scope.otro_poblacional;
  }

  if($scope.ficha.cantidad_hijos_beneficiario == undefined){
      cantidad_hijos_b = null;
  }
  else if($scope.ficha.cantidad_hijos_beneficiario != null){
    cantidad_hijos_b = $scope.ficha.cantidad_hijos_beneficiario;
  }


  if($scope.tipo_disc_otra.unit == undefined){
      cual_discapacidad = null;
  }
  else if ($scope.tipo_disc_otra.unit != null) {
    cual_discapacidad = $scope.tipo_disc_otra.unit;
  }



  if($scope.ficha.otra_discapacidad_beneficiario == undefined){
      otra_discapacidad = null;
  }
  else if ($scope.ficha.otra_discapacidad_beneficiario != null) {
    otra_discapacidad = $scope.ficha.otra_discapacidad_beneficiario;
  }



  if($scope.ficha.medicamentos_beneficiario == undefined){
      medicamento_benec = null;
  }
  else if ($scope.ficha.medicamentos_beneficiario != null) {
    medicamento_benec = $scope.ficha.medicamentos_beneficiario;
  }



  if($scope.tipo_salud_otra.unit == undefined){
      otra_salud = null;
  }
  else if ($scope.tipo_salud_otra.unit != null) {
    otra_salud = $scope.tipo_salud_otra.unit;

  }
  if($scope.tipo_sag.unit == undefined){
      $scope.tipo_sag.unit = null;
  }
  else if ($scope.tipo_sag.unit != null) {
    $scope.tipo_sag.unit = $scope.tipo_sag.unit;

  }

  if($scope.ficha.otro_parentesco_acudiente == undefined){
      parentesco_benec = null;
  }
  else if ($scope.ficha.otro_parentesco_acudiente != null) {
    parentesco_benec = $scope.ficha.otro_parentesco_acudiente;
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
    $scope.barrio = null;
  }
  else if ($scope.barrio != null) {
    $scope.barrio = $scope.barrio;
  }

var ficha_registro = 0;
if($scope.ficha.ficha_save == null){

    ficha_registro = 0;

  }

  else if($scope.ficha.ficha_save > 0)
  {

    ficha_registro = $scope.ficha.ficha_save;
  }

  var datos ={
  //Datos Persona
  tipo_doc_persona: $scope.tipo_doc.unit,
  no_documento_persona: $scope.no_documento_persona,
  primer_nombre_persona: $scope.persona.nombre_primero,
  segundo_nombre_persona: $scope.persona.nombre_segundo,
  primer_apellido_persona: $scope.persona.apellido_primero,
  segundo_apellido_persona: $scope.persona.apellido_segundo,
  correo_persona: $scope.persona.correo_electronico,
  sexo_persona: $scope.tipo_sex.unit,
  fecha_nac_persona: fecha_nacimiento_beneficiario,           
  pais_id: $scope.data_paises.unit,           
  departamento_id: $scope.departamento,           
  municipio_id: $scope.municipio,           
  corregimiento: corregimiento_persona,
  vereda: vereda_persona,
  barrio_id: $scope.barrio,         
  estrato: $scope.tipo_estrato.unit,
  residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
  complemento: $("#id_persona_beneficiario_residencia_direccion_complemento").val(),
  telefono_fijo_persona: $scope.persona.telefono_fijo,
  telefono_movil_persona : $scope.persona.telefono_movil,
  tip_sangre_persona: $scope.tipo_sag.unit,
  estado_civil_persona: $scope.tipo_est.unit,          
  
  //Acudiente Persona
  primer_nombre_acudiente: $scope.acudiente.nombre_primero_acudiente,
  segundo_nombre_acudiente: $scope.acudiente.nombre_segundo_acudiente,
  primer_apellido_acudiente: $scope.acudiente.apellido_primero_acudiente,
  segundo_apellido_acudiente: $scope.acudiente.apellido_segundo_acudiente,
  sex_pariente: $scope.tipo_sex_acudiente.unit,
  fecha_nac_acudiente: fecha_nacimiento_acudiente,   
  telefono_fijo_acudiente: $scope.acudiente.telefono_fijo_acudiente,
  telefono_movil_acudiente: $scope.acudiente.telefono_movil_acudiente,
  correo_acudiente: $scope.acudiente.correo_electronico_acudiente,
  no_documento_acudiente: $scope.acudiente.documento_acudiente,
  tip_doc_acudiente: $scope.tipo_doc_acudiente.unit,

  //Datos Beneficiario     
  no_ficha: $scope.ficha.no_ficha,
  fecha_inscripcion: fecha_inscripcion,
  escolaridad_beneficiario: $scope.tipo_esc.unit,         
  estado_escolaridad: $scope.estado_esc.unit,         
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
  comuna: $scope.comuna_id               
                       
  };


  if(corregimiento_persona == null  &&  direccion_sider == '')
    {
      
      swal("Algo te hace falta!", "Verifique que su campo Dirección no este vacio!", "error");
      toastr.error("Verifique que su campo Dirección no este vacio", "Campo Dirección");
    
    }

  else{

 $.ajax({
         url: base_api + '/postbeneficiario/create/' + id,
           type: 'POST',
          dataType: 'JSON',
          data: {
            datos,
            SelectPoblacional,
            SelectDiscapacidad
        },
    
        }).success(function(){
            swal("Muy bien!", "Su registro ha sido exitoso", "success");
            toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
            window.location="/admin/postgrupos#/admin/postgrupos";

        })
        .error(function() {
          console.log("success");
        });
      
    };
    }
  }
  });
