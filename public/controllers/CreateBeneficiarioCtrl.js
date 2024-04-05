SeriesApp.controller("CreateBeneficiarioCtrl", function($scope, BeneficiarioService, fileUpload, $http, $location, base_api, $q){

$scope.title = "Agregar Beneficiario";
$scope.disable_submit = false;
$scope.serie = {};
$scope.cantidad_hijos = null;
$scope.ocupacion_otra = null;
$scope.cultura_otro = null;
$scope.discapacidad_otro = null;
$scope.otra_discapacidad = null;
$scope.otra_enfermedad = null;
$scope.medicamento_otro = null;
$scope.salud = null;
$scope.nombre_entidad = null;
$scope.otro_parentesco = null;


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
  });
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


 $http.get(base_api + "/obtenerselect/tipo_documento")
  .success(function(response){

    $scope.tipo_documento = response;


  });

 $scope.onBlurFicha = function($event) {
      
        var numero_ficha = $scope.no_ficha;


        $.ajax({
          url: base_api + '/verificar/ficha_beneficiario',
          type: 'GET',
          dataType: 'JSON',
          data: {numero_ficha: numero_ficha},
          async: false, 
        }).success(function(response){

          console.log(response);
       
             $scope.no_ficha = null;
            toastr.warning('Este registro ya se encuentra en el sistema.', 'No Ficha: ' + response.no_ficha);
            $scope.no_ficha = null;
       
            
        }).error(function() {

          $('#repetido_ficha').hide(); 
        });
      
    }

 $scope.onBlurDocumento = function($event) {
      
        var no_documento_beneficiario = $scope.no_documento_persona;


        $.ajax({
          url: base_api + '/verificar/no_documento_beneficiario',
          type: 'GET',
          dataType: 'JSON',
          data: {no_documento_beneficiario: no_documento_beneficiario},
          async: false, 
        }).success(function(response){
              console.log(response);
          if (response.length > 0) {
            
             $scope.no_documento_persona = null;
            toastr.warning('Este registro ya se encuentra en el sistema.', 'No Documento: ' + response[0].documento);
            $scope.no_documento_persona = null;
       
          }
          
        }).error(function() {
          $('#repetido_no_documento').hide(); 
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
      console.log($scope.edad_pariente);    

    };

    $scope.setEnd = function(date) {
      $scope.endDate = date;
      $scope.endDatep = date;
      $scope.endDateInscripcion = date;
    };

    // $scope.tipo_documento = [
    // {id: '1', nombre: 'Registro Civil'},
    // {id: '2', nombre: 'Tarjeta Identidad'},
    // {id: '3', nombre: 'Cédula de Ciudadanía'},
    // {id: '4', nombre: 'Pasaporte'},
    // {id: '5', nombre: 'Sin Información'},

    // ];

    $scope.sexo = [
    {id: '1', nombre: 'Mujer'},
    {id: '2', nombre: 'Hombre'},

    ];


    $scope.estado_civil_beneficiario = [
    {id: '1', nombre: 'Casado'},
    {id: '2', nombre: 'Soltero'},
    {id: '3', nombre: 'Unión Libre'},
    {id: '4', nombre: 'Viudo'},

    ];


    $scope.tipo_sangre = [
    {id: '1', nombre: 'O+'},
    {id: '2', nombre: 'O-'},
    {id: '3', nombre: 'A+'},
    {id: '4', nombre: 'A-'},
    {id: '5', nombre: 'B+'},
    {id: '6', nombre: 'B-'},
    {id: '7', nombre: 'AB+'},
    {id: '8', nombre: 'AB-'},

    ];

    $scope.ocupaciones = [
    {id: '1', nombre: 'Ama de casa'},
    {id: '2', nombre: 'Empleado'},
    {id: '3', nombre: 'Estudiante'},
    {id: '4', nombre: 'Desempleado'},
    {id: '5', nombre: 'Independiente'},
    {id: '6', nombre: 'Pensionado-Jubilado'},
    {id: '7', nombre: 'Servidor Público'},
    {id: '8', nombre: 'Otro'},

    ];





 $http.get(base_api + "/obtenerselect/escolaridades")
  .success(function(response){

    $scope.escolaridades = response;


  });


    $scope.culturas = [
    {id: '1', nombre: 'Negro'},
    {id: '2', nombre: 'Blanco'},
    {id: '3', nombre: 'Índigena'},
    {id: '4', nombre: 'Mestizo'},
    {id: '5', nombre: 'Mulato'},
    {id: '6', nombre: 'ROM, Gitano'},
    {id: '7', nombre: 'Palenquero'},
    {id: '8', nombre: 'Raizal'},
    {id: '9', nombre: 'No sabe-No responde'},
    {id: '10', nombre: 'Otro'},

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
      
    $scope.hijos = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];

    $scope.discapacidades = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];

    $scope.discapacidad_otra = [
    {id: '1', nombre: 'Auditiva'},
    {id: '2', nombre: 'Cognitiva'},
    {id: '3', nombre: 'Mental'},
    {id: '4', nombre: 'Motriz'},
    {id: '5', nombre: 'Oral'},
    {id: '6', nombre: 'Visual'},

    ];

    $scope.enfermedades = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];

    $scope.medicamentos = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];

    $scope.medicamentos = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];

    $scope.seguridad_social = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];

    $scope.salud_sgsss = [
    {id: '1', nombre: 'Regimen Contributivo (EPS)'},
    {id: '2', nombre: 'Regimen Subsidiado (SISBEN-EPS-S)'},
    {id: '3', nombre: 'Especial (FFMM, Policia, etc)'},

    ];

    $scope.parentescos = [
    {id: '1', nombre: 'Madre/Padre'},
    {id: '2', nombre: 'Hermana/Hermano'},
    {id: '3', nombre: 'Tia/Tio'},
    {id: '4', nombre: 'Abuela/Abuelo'},
    {id: '5', nombre: 'Cuidador'},
    {id: '6', nombre: 'Otro'},

    ];

    $http.get(base_api + "/obtener/programas")
    .success(function(response){

      $scope.programas = response;


    });


$http.get(base_api + "/obtener/paises")
  .success(function(response){
    $scope.paises = response;

  });


    $scope.data_paises = {
      'id': 1,
      'unit': 1
    }

$http.get(base_api + "/obtener/departamentos/" + $scope.data_paises.unit)
    .success(function(response){
      $scope.departamentos = response;

      console.log($scope.departamentos);

    });


      $scope.datas = {
      'id': 1,
      'unit': 3
    }


 $http.get(base_api + "/obtener/municipios/" + $scope.datas.unit)
    .success(function(response){
      $scope.municipios = response;

    });


 $scope.data_municipio = {
      'id': 1,
      'unit': 131
    }


    $scope.selectedPais=function(itemPais){

      $http.get(base_api + "/obtener/departamentos/" + itemPais)
      .success(function(response){

        $scope.departamentos = response;

      });
    }    

    $scope.selectedDepartamento=function(itemDepartamento){


      $http.get(base_api + "/obtener/municipios/" + itemDepartamento)
      .success(function(response){

        $scope.municipios = response;
      });
    }    
    
    $http.get(base_api + "/obtenerselect/comunas")
    .success(function(response){

      $scope.comunas = response;


    });

    $scope.selectedComuna=function(itemComuna){

      $http.get(base_api + "/obtener/barrios/" + itemComuna)
      .success(function(response){

        $scope.barrios = response;

      });
    }    

    $http.get(base_api + "/obtener/corregimientos")
    .success(function(response){

      $scope.corregimientos = response;

    });

    $scope.selectedCorregimiento=function(itemCorregimiento){

      $http.get(base_api + "/obtener/veredas/" + itemCorregimiento)
      .success(function(response){

        $scope.veredas = response;

      });
    }    

    $scope.isDisabled = true;
    $scope.isDisabledOcupacion = true;
    $scope.isDisabledCultura = true;
    $scope.isDisabledDiscapacidad = true;
    $scope.isDisabledEnfermedad = true;
    $scope.isDisabledMedicamento = true;
    $scope.isDisabledSeguridad = true;
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

      }

    }   

    $scope.selectedEnfermedad=function(itemEnfermedad){


      if (itemEnfermedad == 1) {
        $scope.isDisabledEnfermedad = false;
      }
      else{

        $scope.isDisabledEnfermedad = true;

      }

    }   

    $scope.selectedMedicamento=function(itemMedicamento){


      if (itemMedicamento == 1) {
        $scope.isDisabledMedicamento = false;
      }
      else{

        $scope.isDisabledMedicamento = true;

      }

    }   


    $scope.selectedSeguridad=function(itemSeguridad){


      if (itemSeguridad == 1) {
        $scope.isDisabledSeguridad = false;
      }
      else{

        $scope.isDisabledSeguridad = true;
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


    

    $scope.formsubmit = function(isValid){



     var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val()
     var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
     var fecha_inscripcion = $("#fecha_inscripcion").val();
     var SelectPoblacional = $scope.selected.poblacionales;     
     

       if (isValid) {


         var datos ={


  //Datos Persona
  primer_nombre_persona: $scope.primer_nombre_persona,
  segundo_nombre_persona: $scope.segundo_nombre_persona,
  primer_apellido_persona: $scope.primer_apellido_persona,
  segundo_apellido_persona: $scope.segundo_apellido_persona,
  no_documento_persona: $scope.no_documento_persona,
  tipo_doc_persona: $scope.tipo_doc_persona,
  sexo_persona: $scope.sexo_persona,
  fecha_nac_persona: fecha_nacimiento_beneficiario,           
  telefono_fijo_persona: $scope.telefono_fijo_persona,
  telefono_movil_persona : $scope.telefono_movil_persona,
  correo_persona: $scope.correo_persona,
  pais_id: $scope.data_paises.unit,           
  departamento_id: $scope.datas.unit,           
  municipio_id: $scope.data_municipio.unit,            
  barrio_id: $scope.barrio,         
  corregimiento: $scope.corregimiento,
  vereda: $scope.vereda,
  residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
  estrato: $scope.estrato,
  tip_sangre_persona: $scope.tip_sangre_persona,
  estado_civil_persona: $scope.est_beneficiario,          
  
  //Acudiente Persona
  primer_nombre_acudiente: $scope.primer_nombre_acudiente,
  segundo_nombre_acudiente: $scope.segundo_nombre_acudiente,
  primer_apellido_acudiente: $scope.primer_apellido_acudiente,
  segundo_apellido_acudiente: $scope.segundo_apellido_acudiente,
  sex_pariente: $scope.sex_pariente,
  fecha_nac_acudiente: fecha_nacimiento_acudiente,   
  telefono_fijo_acudiente: $scope.telefono_fijo_acudiente,
  telefono_movil_acudiente: $scope.telefono_movil_acudiente,
  correo_acudiente: $scope.correo_acudiente,
  no_documento_acudiente: $scope.no_documento_acudiente,
  tip_doc_acudiente: $scope.tip_doc_acudiente,

  //Datos Beneficiario     
  no_ficha: $scope.no_ficha,
  modalidad: $scope.modalidad,
  punto_atencion: $scope.punto_atencion,
  hijos_beneficiario: $scope.hijo,            
  cantidad_hijos_beneficiario: $scope.cantidad_hijos, 
  ocupacion_beneficiario: $scope.ocupacion,   
  otra_ocupacion_beneficiario: $scope.ocupacion_otra,          
  escolaridad_beneficiario: $scope.escolaridad,         
  cultura_beneficiario: $scope.cultura,           
  otra_cultura_beneficiario: $scope.cultura_otro,           
  discapacidad_beneficiario: $scope.discapacidad,            
  discapacidad_select_beneficiario: $scope.discapacidad_otro,           
  otra_discapacidad_beneficiario: $scope.otra_discapacidad,           
  enfermedad_permanente_beneficiario: $scope.enfermedad,           
  enfermedad_beneficiario: $scope.otra_enfermedad,                  
  medicamentos_permanente_beneficiario: $scope.medicamento,            
  medicamentos_beneficiario: $scope.medicamento_otro,    
  seguridad_social_beneficiario: $scope.seguridad,           
  salud_sgsss_beneficiario: $scope.salud,           
  nombre_seguridad_beneficiario: $scope.nombre_entidad,        
  parentesco_acudiente: $scope.parentesco,          
  otro_parentesco_acudiente: $scope.otro_parentesco,
  fecha_inscripcion: fecha_inscripcion                
                       
        };

 $.ajax({
          url: base_api + '/postbeneficiario/create',
          type: 'POST',
          dataType: 'JSON',
          data: {
            datos,
            SelectPoblacional
        },
    
        }).success(function(){
         
            toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
            window.location="/admin/postbeneficiarios#/admin/postbeneficiarios";

        })
        .error(function() {
          console.log("success");
        });
      }
    };
  });
