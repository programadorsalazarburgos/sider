SeriesApp.controller("BeneficiarioProgramaGrupoCtrl", function($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q){
 
  $scope.reset = function () {
      $scope.state = undefined;
  };


  $scope.ngShowhide1Vereda =true;
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
      yearRange: "1910:+nn",
	  maxDate:($("#hdnTID").val()=="1240916273"?"-54y":"0")
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

  $scope.sexo = [
    {id: 1, nombre: 'Mujer'},
    {id: 2, nombre: 'Hombre'},
	{id: 3, nombre: 'Otro'}
    ];

 // $scope.ficha = [
 //    {fecha_inscripcion: '2017-01-01'},

 //    ];

//Fin Carga datos sexo crear

//Inicio Carga datos sexo real crear
  
	$scope.tipo_sex_real = {
        'id': 1,
        'unit': null
	}

	$scope.sexo_real = [
		{id: 1, nombre: 'Heterosexual'},
		{id: 2, nombre: 'Homosexual'},
		{id: 3, nombre: 'Bisexual'}
    ];

//Fin Carga datos sexo real crear

//Inicio Carga datos orientacion sexual crear
  
	$scope.tipo_orientacion_sexual = {
        'id': 1,
        'unit': null
	}

	$scope.sexo_orientacion_sexual = [
		{id: 1, nombre: 'Lesbiana'},
		{id: 2, nombre: 'Gay'},
		{id: 3, nombre: 'Bisexual'},
		{id: 4, nombre: 'Transformista'},
		{id: 5, nombre: 'Transvestido'},
		{id: 6, nombre: 'Transgenerista'},
		{id: 7, nombre: 'Transexual'},
		{id: 8, nombre: 'Intersexual'},
		{id: 9, nombre: 'Querés'},
		{id: 10, nombre: 'Pansexual'},
		{id: 11, nombre: 'HSH'},
		{id: 13, nombre: 'Otro'},
    ];

//Fin Carga datos orientacion sexual crear



//Inicio Carga datos sexo crear
  
  $scope.tipo_sex_acudiente = {
        'id': 1,
        'unit': null
        }


//Fin Carga datos sexo crear

//Inicio Carga datos tipo de sangre

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

 $http.get(base_api + "/obtener/ocupaciones")
    .success(function(ocupaciones){

      $scope.ocupaciones = ocupaciones;
    
    });


//Inicio Carga de datos Escolaridad Crear
  
 $http.get(base_api + "/obtenerselect/escolaridades")
  .success(function(response){

    $scope.escolaridades = response;


  });

//Fin Carga de datos Escolaridad Crear

//Inicio Carga de datos Estado Escolaridad Crear
  


 $http.get(base_api + "/obtenerselect/EstadoEscolaridades")
  .success(function(response){

    $scope.estadoescolaridades = response;


  });


//Inicio Carga datos cultura crear
  
    $scope.tipo_cult = {
        'id': 1,
        'unit': null
        }
		
	$scope.clubes_deportivos = {
      'id': 1,
      'unit': null
      }


  $http.get(base_api + "/obtenerselect/culturas")
  .success(function(response){

    $scope.etnias = response;
    

  });
  
  $http.get(base_api + "/obtener/clubesdeportivos")
	.success(function(response){
		$scope.clubes_deportivos_bd = response;
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


$scope.tipo_parent = null;

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



   $http.get(base_api + "/obtener/nombre_ahdi/" + itemBarrio)
      
      .success(function(response){

        $scope.nombre_barrio = response.nombre_barrio.substring(0,4);
        
        if ($scope.nombre_barrio == 'AHDI') 
        {
          $("#direccion_residencia_plugin").hide();
          $scope.asentamiento = 1;
        }
        
        if ($scope.nombre_barrio != 'AHDI') 
        {
          $("#direccion_residencia_plugin").show();
          $scope.asentamiento = null;
        }

      });


      $http.get(base_api + "/obtener/estrato/" + itemBarrio)
      
      .success(function(estratobeneficiario){
            $scope.tipo_estrato = parseInt(estratobeneficiario.id_estrato);
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
            $scope.tipo_estrato = EstratoVereda.estrato;
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
        $scope.comuna = null;

      }
 
    }



 $scope.onBlurDocumento = function($event) {
      
      var no_documento_beneficiario = $scope.no_documento_persona;

      $http.get(base_api + "/admin/postbeneficiariosprogramas/cargar/" + no_documento_beneficiario)
        .success(function(response){

        console.log(response);
          if (response.persona.length != 0 || response.ficha.length != 0 || response.acudiente.length != 0) {


            swal("Registro Existente!", "Este registro ya existe puedes actualizarlo y se agregara a este grupo si lo deseas!", "success");

     
          $scope.persona = response.persona[0];
          //Inicio Carga Persona
          //////////////////////
          //////////////////////
          //////////////////////
          //////////////////////
          $scope.tipo_doc = $scope.persona.id_documento_tipo;
          $scope.tipo_sex = $scope.persona.sexo;
          $scope.pais = $scope.persona.id_procedencia_pais;
          if ($scope.persona.id_procedencia_pais == 1) {

             $scope.ngShowhide1 =true;
             $scope.ngShowhide2 =false;
          }
          else if($scope.persona.id_procedencia_pais != 1){
            
             $scope.ngShowhide1 =false;
             $scope.ngShowhide2 =true;
          }

          $scope.departamento = $scope.persona.id_procedencia_departamento;    
          var promise = $http.get(base_api + "/obtener/municipios/" + $scope.departamento);
          promise.then(
          function(responsemunicipios) {
          $scope.municipios = responsemunicipios.data;   
          });          
          $scope.municipio = $scope.persona.id_procedencia_municipio; 
          $scope.corregimiento = $scope.persona.id_residencia_corregimiento;
          $scope.vereda = $scope.persona.id_residencia_vereda;
          var promise = $http.get(base_api + "/obtener/veredas/" + $scope.corregimiento);
            promise.then(
            function(responseveredas) {
            $scope.veredas = responseveredas.data;
          });
          if($scope.vereda != null)
          {
            $scope.ngShowhideBarrio =false;
            $scope.ngShowhideDireccion =false;
            $scope.ngShowhideComplemento =false;
            $scope.barrio = undefined;
      
    
          }if($scope.vereda == null){
            $scope.vereda = undefined;
            $scope.corregimiento = undefined;
            $scope.ngShowhideBarrio =true;
            $scope.ngShowhideDireccion =true;
            $scope.ngShowhideComplemento =true;
          }

         if($scope.persona.id_residencia_vereda != null)
          {
          $http.get(base_api + "/obtener/estratoVereda/" + $scope.persona.id_residencia_vereda)
          
          .success(function(EstratoVereda){
            
                $scope.tipo_estrato = EstratoVereda.estrato;
                $scope.comuna = EstratoVereda.nombre_comuna;
                $scope.comuna_id = EstratoVereda.id_comuna; 
               
            });
           }

          $http.get(base_api + "/obtener/barrios")
            .success(function(response){
              $scope.barrios = response;

            });

            //Barrio Estrato y Comuna
            $scope.barrio = $scope.persona.id_residencia_barrio;
            $scope.tipo_estrato = $scope.persona.residencia_estrato;

            if($scope.persona.id_residencia_barrio != null)
            {  
            $http.get(base_api + "/obtener/estrato/" + $scope.persona.id_residencia_barrio)  
             .success(function(estratobeneficiario){
                console.log(estratobeneficiario);
                $scope.comuna = estratobeneficiario.comuna_id;
                $scope.comuna_id = estratobeneficiario.comuna_id; 
                $scope.tipo_estrato = estratobeneficiario.id_estrato;
            });
            } 
            if($scope.persona.residencia_direccion != null)
            {
              $("#direccion_residencia_plugin").hide();

            } 
            else if($scope.persona.residencia_direccion == '' || $scope.persona.residencia_direccion == null)
            {
              $("#direccion_residencia_plugin").show();
            } 

             $scope.tipo_esc = $scope.persona.escolaridad_id;
             $scope.estado_esc = $scope.persona.estado_escolaridad;
             $scope.tipo_ocup = $scope.persona.ocupacion_id;
             $scope.tipo_est = $scope.persona.id_estado_civil;
             $scope.tipo_sag =  $scope.persona.sangre_tipo;

            //Fin Carga Persona
            ///////////////////
            ///////////////////
            ///////////////////
            ///////////////////
            ///////////////////          
        

            //Inicio Carga Ficha
            ////////////////////  
            ////////////////////  
            ////////////////////  
            ////////////////////  

            $scope.ficha = response.ficha[0];
            
			if($scope.ficha != null && $scope.ficha != undefined){
				//tiene hijos?
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
				//fin tiene hijos
				//Se reconoce como
				$scope.tipo_etnias = $scope.ficha.cultura_beneficiario
				$scope.clubes_deportivos_id = $scope.ficha.clubes_deportivos
           
				$scope.tipo_disc = {
				'id': 1,
				'unit': $scope.ficha.discapacidad_beneficiario
				}

				if ($scope.ficha.discapacidad_beneficiario == 1) {
					$scope.isDisabledDiscapacidad = false;
				}
				else if($scope.ficha.discapacidad_beneficiario != 1){
		
				$scope.isDisabledDiscapacidad = true;
		
				}
			} // ver ficha undefined
			if($scope.ficha != null && $scope.ficha != undefined){
				//Tipo Medicamentos
				$scope.tipo_medic = {
				  'id': 1,
				  'unit': $scope.ficha.medicamentos_permanente_beneficiario
				  }    
				  if ($scope.ficha.medicamentos_permanente_beneficiario == 1) {
				  $scope.isDisabledMedicamento = false;
				  }
				  else if($scope.ficha.medicamentos_permanente_beneficiario != 1){
		  
				  $scope.isDisabledMedicamento = true;
		  
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
			} // edn ver ficha undefined

			if($scope.ficha != null && $scope.ficha != undefined){
                //Se encuentra afiliado a la salud
                $scope.tipo_afiliacion_salud = {
                'id': 1,
                'unit': $scope.ficha.afiliacion_salud
                }

                //Tipo de Afiliacion
                $scope.tipo_afiliacion = $scope.ficha.tipo_afiliacion;

                //Entidad de salud o eps
                $scope.tipo_salud_otra = $scope.ficha.salud_sgss_id;

                //Parentesco acudiente
                $scope.tipo_parent = parseInt($scope.ficha.parentesco_acudiente);
                
                if (parseInt($scope.ficha.parentesco_acudiente) == 6) {
                $scope.isDisabledParentesco = false;
                }
                else{
        
                $scope.isDisabledParentesco = true;
                }
			} // END ver ficha undefined
               //Fin Carga Ficha
               ///////////////////
               ///////////////////
               ///////////////////
               ///////////////////
               ///////////////////    
           
               //Inicio Carga Acudiente
               ///////////////////
               ///////////////////
               ///////////////////
               ///////////////////
               ///////////////////  

				if(response.acudiente[0] != undefined){
				   $scope.acudiente = response.acudiente[0];
				   $scope.tipo_doc_acudiente = $scope.acudiente.tipodocacudiente;
				   $scope.tipo_sex_acudiente = $scope.acudiente.sexoacudiente;
				}

  
            }

        $http.get(base_api + "/obtenerPrograma/poblacionalesDocumento/" + no_documento_beneficiario)
          .success(function(response){
            console.log(response);
            $scope.selectedPoblacionales = response;
            $scope.selectedPoblacionales.map(function(poblacional) {
              
              
                if(poblacional.id == 10)
                {
                  $scope.ngShowhideOtro = true;
                  
                }
                if(poblacional.id == 11)
                {
                  $scope.ngShowhideClub = true;
                  
                }
                

            })
        
                 
          });

			if($scope.ficha != undefined){
			  $scope.otro_poblacional = $scope.ficha.otro_poblacional;
			  $scope.club_poblacional = $scope.ficha.club_poblacional;
			  $scope.condicion_discapacidad_otro = $scope.ficha.condicion_discapacidad_otro;
			}

          $http.get(base_api + "/obtenerPrograma/discapacidadesDocumento/" + no_documento_beneficiario)
          .success(function(response){

            $scope.selectedDiscapacidades = response;
			$scope.selectedDiscapacidades.map(function(poblacional) {
                if(poblacional.id == 12)
                {
                  $scope.ngShowhideOtroDiscapacidad = true;
                  
                }
            })

          });

      });

      
    }



$scope.onBlurDocumentoAcudiente = function($event) {
      
      var no_documento_acudiente = $scope.documento_acudiente;
      
      $http.get(base_api + "/admin/postbeneficiarios/cargarAcudiente/" + no_documento_acudiente)
        .success(function(acudiente){

          
          if (acudiente.length != 0) {

            swal("Registro Existente!", "Este registro ya existe puedes actualizarlo!", "success");

          $scope.acudiente = acudiente[0];
          
       
        $scope.tipo_doc_acudiente = $scope.acudiente.tipodocacudiente;
        $scope.tipo_sex_acudiente = $scope.acudiente.sexoacudiente;
  

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

	// evento cambia orientacion sexual
	$scope.selectedOrientacionSexual = function(item){
		$("#rowOtroOrientacionSexual").hide();
		$("#rowOtroOrientacionSexual").val("");
		$("#orientacion_sexual_otro").val("N/A").change();
		if(parseInt(item) == 13){
			$("#rowOtroOrientacionSexual").show(500,"");
			$("#orientacion_sexual_otro").val("").change();
		}
	};
	

    $scope.selectedParentesco=function(itemParentesco){

      if (itemParentesco == 6) {
        $scope.isDisabledParentesco = false;
      }
      else{

        $scope.isDisabledParentesco = true;
      }
    };
	
	// change de sexo
	$scope.selectedSexAcudiente = function(item){
		$scope.sexo_acudiente_otro = '';
		if(item == 3){
			$scope.ngShowhideOtroSexoAcudiente = true;
		}else{
			$scope.ngShowhideOtroSexoAcudiente = false;
		}
	};


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
	$scope.ngShowhideClub =false;
	$scope.ngShowhideOtroDiscapacidad =false;
	$scope.ngShowhideOtroSexoAcudiente = false;
   

    
  $scope.toggleSelection = function toggleSelection(seleccion)
  {


    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);
    
	// otro poblacional
    if(index == index && seleccion.id == 10){
      $scope.ngShowhideOtro =true;
      $scope.otro_poblacional = '';
    }

    if(seleccion.id == 10){
      $scope.ngShowhideOtro =true;
    }
	
	// club deportivo
	if(index == index && seleccion.id == 11){
      $scope.ngShowhideClub =true;
      $scope.club_poblacional = '';
    }
    if(seleccion.id == 11){
      $scope.ngShowhideClub =true;
    }
    
    
    if (index > -1)
    {
      $scope.selectedPoblacionales.splice(index, 1);

      if(index == 0 && seleccion.id == 10)
      {
        $scope.ngShowhideOtro = false;
        $scope.otro_poblacional = '';
      }
	  if(index == 0 && seleccion.id == 11)
      {
        $scope.ngShowhideClub = false;
		$scope.club_poblacional = '';
      }

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/poblacionalPrograma/" + $scope.ficha.ficha_save,
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
	
	// verificar discapacidad otro
	if(seleccion.id == 12){
      $scope.ngShowhideOtroDiscapacidad =true;
    }
	

    if (index > -1)
    {
      $scope.selectedDiscapacidades.splice(index, 1);
	  
	  if(index == 0 && seleccion.id == 12)
      {
        $scope.ngShowhideOtroDiscapacidad = false;
        $scope.condicion_discapacidad_otro = '';
      }

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/discapacidadPrograma/" + $scope.ficha.ficha_save,
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


    if($scope.no_ficha == undefined)
    {
      $scope.no_ficha = null
    }
    
    else{
      $scope.no_ficha = $scope.no_ficha;
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
  
  if($scope.condicion_discapacidad_otro == undefined){
      condicion_discapacidad_otro = null;
  }
  else if($scope.condicion_discapacidad_otro != null){
    condicion_discapacidad_otro = $scope.condicion_discapacidad_otro;
  }
  
  if($scope.club_poblacional == undefined){
      club_poblacional = null;
  }
  else if($scope.club_poblacional != null){
    club_poblacional = $scope.club_poblacional;
  }

  if($scope.cantidad_hijos_beneficiario == undefined){
      cantidad_hijos_b = null;
  }
  else if($scope.cantidad_hijos_beneficiario != null){
    cantidad_hijos_b = $scope.cantidad_hijos_beneficiario;
  }


  if($scope.tipo_disc_otra.unit == undefined){
      cual_discapacidad = null;
  }
  else if ($scope.tipo_disc_otra.unit != null) {
    cual_discapacidad = $scope.tipo_disc_otra.unit;
  }



  if($scope.otra_discapacidad_beneficiario == undefined){
      otra_discapacidad = null;
  }
  else if ($scope.otra_discapacidad_beneficiario != null) {
    otra_discapacidad = $scope.otra_discapacidad_beneficiario;
  }



  if($scope.medicamentos_beneficiario == undefined){
      medicamento_benec = null;
  }
  else if ($scope.medicamentos_beneficiario != null) {
    medicamento_benec = $scope.medicamentos_beneficiario;
  }


  if($scope.otro_parentesco_acudiente == undefined){
      parentesco_benec = null;
  }
  else if ($scope.otro_parentesco_acudiente != null) {
    parentesco_benec = $scope.otro_parentesco_acudiente;
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
if($scope.ficha_save == null){

    ficha_registro = 0;

  }

if($scope.ficha_save == undefined)
{
  ficha_registro = 0;
}  

  else if($scope.ficha_save > 0)
  {

    ficha_registro = $scope.ficha_save;
  }

  if($scope.persona.otro_municipio == undefined){
      $scope.persona.otro_municipio = null;
  }
  else if ($scope.persona.otro_municipio != null) {
    $scope.persona.otro_municipio = $scope.persona.otro_municipio;
  }

if($scope.documento_acudiente == undefined){
      $scope.documento_acudiente = null;
  }
  else if ($scope.documento_acudiente != null) {
    $scope.documento_acudiente = $scope.documento_acudiente;
  }


if($scope.tipo_etnias == undefined){
      $scope.tipo_etnias = null;
  }
  else if ($scope.tipo_etnias != null) {
    $scope.tipo_etnias = $scope.tipo_etnias;
  }
  
if($scope.clubes_deportivos == undefined){
      $scope.clubes_deportivos = null;
  }
  else if ($scope.clubes_deportivos != null) {
    $scope.clubes_deportivos = $scope.clubes_deportivos;
  }



  if($scope.tipo_sag == undefined){
      $scope.tipo_sag = null;
  }
  else if ($scope.tipo_sag != null) {
    $scope.tipo_sag = $scope.tipo_sag;
  }

 if($scope.tipo_est == undefined){
      $scope.tipo_est = null;
  }
  else if ($scope.tipo_est != null) {
    $scope.tipo_est = $scope.tipo_est;
  }

  if($scope.tipo_esc == undefined){
      $scope.tipo_esc = null;
  }
  else if ($scope.tipo_esc != null) {
    $scope.tipo_esc = $scope.tipo_esc;
  }

  if($scope.estado_esc == undefined){
      $scope.estado_esc = null;
  }
  else if ($scope.estado_esc != null) {
    $scope.estado_esc = $scope.estado_esc;
  }

  if($scope.tipo_ocup == undefined){
      $scope.tipo_ocup = null;
  }
  else if ($scope.tipo_ocup != null) {
    $scope.tipo_ocup = $scope.tipo_ocup;
  }

  if($scope.tipo_sex == undefined){
      $scope.tipo_sex = null;
  }
  else if ($scope.tipo_sex != null) {
    $scope.tipo_sex = $scope.tipo_sex;
  }

if($scope.tipo_salud_otra == undefined){
      $scope.tipo_salud_otra = null;
  }
  else if ($scope.tipo_salud_otra != null) {
    $scope.tipo_salud_otra = $scope.tipo_salud_otra;
  }



  var datos ={
  //Datos Persona
  tipo_doc_persona: $scope.tipo_doc,
  no_documento_persona: $scope.no_documento_persona,
  primer_nombre_persona: $scope.persona.nombre_primero,
  segundo_nombre_persona: $scope.persona.nombre_segundo,
  primer_apellido_persona: $scope.persona.apellido_primero,
  segundo_apellido_persona: $scope.persona.apellido_segundo,
  correo_persona: $scope.persona.correo_electronico,
  otro_municipio: $scope.persona.otro_municipio,
  
  sexo_persona: $scope.tipo_sex,
  
  tipo_genero_r: $scope.tipo_sex_real.unit,
  tipo_orientacion_sexual: $scope.tipo_orientacion_sexual.unit,
  orientacion_sexual_otro: $scope.persona.orientacion_sexual_otro,
  
  fecha_nac_persona: fecha_nacimiento_beneficiario,           
  pais_id: $scope.pais,           
  departamento_id: $scope.departamento,           
  municipio_id: $scope.municipio,           
  corregimiento: corregimiento_persona,
  vereda: vereda_persona,
  barrio_id: $scope.barrio,         
  estrato: $scope.tipo_estrato,
  residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
  complemento: $("#id_persona_beneficiario_residencia_direccion_complemento").val(),
  telefono_fijo_persona: $scope.persona.telefono_fijo,
  telefono_movil_persona : $scope.persona.telefono_movil,
  tip_sangre_persona: $scope.tipo_sag,
  estado_civil_persona: $scope.tipo_est,          
  
  //Acudiente Persona
  primer_nombre_acudiente: $('#nombre_primero_acudiente').val(), 
  segundo_nombre_acudiente: $('#nombre_segundo_acudiente').val(),
  primer_apellido_acudiente: $('#apellido_primero_acudiente').val(),
  segundo_apellido_acudiente: $('#apellido_segundo_acudiente').val(), 
  
  sex_pariente: $scope.tipo_sex_acudiente,
  sexo_acudiente_otro: $scope.sexo_acudiente_otro,
  
  fecha_nac_acudiente: fecha_nacimiento_acudiente,   
  telefono_fijo_acudiente: $('#telefono_fijo_acudiente').val(), 
  telefono_movil_acudiente: $('#telefono_movil_acudiente').val(),
  correo_acudiente: $('#correo_electronico_acudiente').val(),
  no_documento_acudiente: $('#documento_acudiente').val(),
  tip_doc_acudiente: $scope.tipo_doc_acudiente,

  //Datos Beneficiario     
  no_ficha: $scope.no_ficha,
  fecha_inscripcion: fecha_inscripcion,
  escolaridad_beneficiario: $scope.tipo_esc,         
  estado_escolaridad: $scope.estado_esc,         
  ocupacion_beneficiario: $scope.tipo_ocup,   
  hijos_beneficiario: $scope.tipo_hij.unit,            
  cantidad_hijos_beneficiario: cantidad_hijos_b, 
  
  cultura_beneficiario: $scope.tipo_etnias,           
  clubes_deportivos_id: $scope.clubes_deportivos.unit,
  
  discapacidad_beneficiario: $scope.tipo_disc.unit,            
  otra_discapacidad_beneficiario: otra_discapacidad,           
  medicamentos_permanente_beneficiario: $scope.tipo_medic.unit,            
  medicamentos_beneficiario: medicamento_benec,    
  condicion_discapacidad:$scope.tipo_condicion.unit,
  afiliacion_salud:$scope.tipo_afiliacion_salud.unit,
  tipo_afiliacion:$scope.tipo_afiliacion,
  salud_sgsss_beneficiario: $scope.tipo_salud_otra,           
  parentesco_acudiente: $scope.tipo_parent,          
  otro_parentesco_acudiente: parentesco_benec,
  ficha: ficha_registro,
  otro_poblacional: otro_poblacional,
  condicion_discapacidad_otro:condicion_discapacidad_otro,
  
  comuna: $scope.comuna_id               
                       
  };

  

// console.log($scope.acudiente.nombre_primero_acudiente);

  if(corregimiento_persona == null  &&  direccion_sider == '' && $scope.asentamiento == null)
    {
      
      swal("Algo te hace falta!", "Verifique que su campo Dirección no este vacio!", "error");
      toastr.error("Verifique que su campo Dirección no este vacio", "Campo Dirección");
    
    }

 if($scope.tipo_doc_acudiente.unit == 2 || $scope.tipo_doc_acudiente.unit == 3)

  {
      swal("Verifica tu información!", "Tipo de documento no valido!", "error");
      toastr.error("Tipo de documento no valido", "Tipo Documento");
  }
 

  else{

 $.ajax({
          url: base_api + '/postbeneficiarioprograma/create/' + id,
           type: 'POST',
          dataType: 'JSON',
          data: {
            datos,
            SelectPoblacional,
            SelectDiscapacidad
        },
    
        }).success(function(){
            //mensaje almacenado
            swal("Muy bien!", "Su registro ha sido exitoso", "success");
            toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
            window.location="/admin/postgruposprogramas#/admin/postgruposprogramas";

        })
        .error(function() {
          console.log("success");
        });
      
    };
    }
  }
  });
