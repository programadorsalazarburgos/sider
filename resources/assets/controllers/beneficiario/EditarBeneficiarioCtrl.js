SeriesApp.controller("EditarBeneficiarioCtrl", function($scope, BeneficiarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Editar Beneficiario";
  $scope.series = [];


$scope.onBlurFicha = function($event) {
      
        
      if ($scope.serie.no_ficha != $scope.ficha) {

        var numero_ficha = $scope.serie.no_ficha;

        $.ajax({
          url: base_api + '/verificar/ficha_beneficiario',
          type: 'GET',
          dataType: 'JSON',
          data: {numero_ficha: numero_ficha},
          async: false, 
        }).success(function(response){

          console.log(response);
       
             $scope.serie.no_ficha = null;
            toastr.warning('Este registro ya se encuentra en el sistema.', 'No Ficha: ' + response.no_ficha);
            $scope.serie.no_ficha = null;
       
            
        }).error(function() {

          $('#repetido_ficha').hide(); 
        });
      }
    }



 $scope.onBlurDocumento = function($event) {


 if ($scope.serie.documento != $scope.doc) {

      
        var no_documento_beneficiario = $scope.serie.documento;


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
      
    }



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
      dateFormat: 'yy-mm-dd'
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

  $scope.getData = function(){

    $http.get(base_api + "/admin/postbeneficiarios/" + $routeParams.id)
    .success(function(response){

      $scope.serie = response[0];

    });
  };

  $scope.serie = {};
  $scope.getData();
  
  $http.get(base_api + "/obtener/paises")
  .success(function(response){
    $scope.paises = response;

  });


  $http.get(base_api + "/obtener/pais/" + $routeParams.id)
  .success(function(response){
    $scope.data = {
      'id': 1,
      'unit': response[0].id
    }

  
    $http.get(base_api + "/obtener/departamentos/" + $scope.data.unit)
    .success(function(response){
      $scope.departamentos = response;

    });

  });


  $http.get(base_api + "/obtener/departamento/" + $routeParams.id)
  .success(function(response){
    $scope.datas = {
      'id': 1,
      'unit': response[0].id
    }

    $http.get(base_api + "/obtener/municipios/" + $scope.datas.unit)
    .success(function(response){
      $scope.municipios = response;

    });

  });


$http.get(base_api + "/obtener/municipio/" + $routeParams.id)
  .success(function(response){
    $scope.data_municipio = {
      'id': 1,
      'unit': response[0].id
    }
  });


  $scope.selectedPais=function(item){

    $http.get(base_api + "/obtener/departamentos/" + item)
    .success(function(response){
      $scope.departamentos = response;

    });
  }    

  $scope.selectedDepartamento=function(item){

    $http.get(base_api + "/obtener/municipios/" + item)
    .success(function(response){
      $scope.municipios = response;

    });
  }    



  $http.get(base_api + "/obtenerselect/comunas")
  .success(function(response){
    $scope.comunas = response;
 
});


  $http.get(base_api + "/obtener/barrio/" + $routeParams.id)
  .success(function(response_barrio){
   
   $scope.data_barrio = {
      'id': 1,
      'unit': response_barrio[0].id
    }

    $http.get(base_api + "/obtener/comuna_barrio/" + response_barrio[0].id)
    .success(function(response){

     $scope.data_comuna = {
      'id': 1,
      'unit': response[0].id
    }


    $http.get(base_api + "/obtener/barrios/" + $scope.data_comuna.unit)
    .success(function(response){
      $scope.barrios = response;

    });



    });

  });





$http.get(base_api + "/obtener/tipodocumento/" + $routeParams.id)
  .success(function(response){
   
         $scope.tipo_doc = {
        'id': 1,
        'unit': response[0].id
        }

  });

$http.get(base_api + "/obtenerselect/tipo_documento")
  .success(function(response){
    $scope.tipodocumento = response;
    // console.log($scope.roles);
  });





  $http.get(base_api + "/obtener/corregimientos")
  .success(function(response){
    $scope.corregimientos = response;

  });


  $http.get(base_api + "/obtener/corregimiento/" + $routeParams.id)
  .success(function(response){

    console.log(response);
    $scope.data_corregimiento = {
      'id_corregimiento': 1,
      'unit': response[0].id
    }

    
    $http.get(base_api + "/obtener/veredas_beneficiario/" + $scope.data_corregimiento.unit)
    .success(function(response){
      $scope.veredas = response;
    });

  });



  $http.get(base_api + "/obtener/vereda_beneficiario/" + $routeParams.id)
  .success(function(response){
    $scope.datas_veredas = {
      'id': 1,
      'unit': response[0].id
    }

 });



    $scope.selectedCorregimiento=function(item){

      $http.get(base_api + "/obtener/veredas/" + item)
      .success(function(response){

        $scope.veredas = response;


      });
    }    




  $http.get(base_api + "/obtener/sexo/" + $routeParams.id)
  .success(function(response){

    $scope.obsexo = {};
    $scope.obsexo.sexoId = response.id.toString();

    $scope.obsexo.sexo = [
    {id: '1', nombre: 'Mujer'},
    {id: '2', nombre: 'Hombre'},

    ];

  });


  // $http.get(base_api + "/obtener/civil/" + $routeParams.id)
  // .success(function(response){


  //   $scope.obcivil = {};
  //   $scope.obcivil.civilId = response.id.toString();

  //   $scope.obcivil.civil = [
  //   {id: '1', nombre: 'Casado'},
  //   {id: '2', nombre: 'Soltero'},
  //   {id: '3', nombre: 'Unión Libre'},
  //   {id: '4', nombre: 'Viudo'},
  //   ];


  // });



  $http.get(base_api + "/obtener/hijos/" + $routeParams.id)
  .success(function(response){

    $scope.obhijos = {};
    $scope.obhijos.hijosId = response.id.toString();

    $scope.obhijos.hijos = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];



    if (response.id == 2) {

        $scope.isDisabled = true;
        $scope.serie.cantidad_hijos_beneficiario = null;

    }



  });


  $http.get(base_api + "/obtener/tiposangre/" + $routeParams.id)
  .success(function(response){

      

    $scope.obtipo_sangre = {};
    $scope.obtipo_sangre.tipo_sangreId = response.sangre_tipo.toString();

    
    $scope.obtipo_sangre.tipo_sangre = [
    {id: '1', nombre: 'O+'},
    {id: '2', nombre: 'O-'},
    {id: '3', nombre: 'A+'},
    {id: '4', nombre: 'A-'},
    {id: '5', nombre: 'B+'},
    {id: '6', nombre: 'B-'},
    {id: '7', nombre: 'AB+'},
    {id: '8', nombre: 'AB-'},

    ];
  });




  $http.get(base_api + "/obtener/estados_civiles")
  .success(function(response){
    $scope.estados_civiles = response;
   
  });


  $http.get(base_api + "/obtener/civil/" + $routeParams.id)
  .success(function(response){

    $scope.data_civil = {
      'id': 1,
      'unit': response.id
    }

});



 $http.get(base_api + "/obtenerselect/escolaridades")
  .success(function(response){

    $scope.escolaridades = response;

  });


  $http.get(base_api + "/obtener/escolaridad/" + $routeParams.id)
  .success(function(response){


    $scope.data_escolaridad = {
      'id': 1,
      'unit': response.id
    }



});





  $http.get(base_api + "/obtener/ocupacion/" + $routeParams.id)
  .success(function(response){


    $scope.obocupacion = {};
    $scope.obocupacion.ocupacionId = response.id.toString();
   
    $scope.obocupacion.ocupacion = [
    {id: '1', nombre: 'Ama de casa'},
    {id: '2', nombre: 'Empleado'},
    {id: '3', nombre: 'Estudiante'},
    {id: '4', nombre: 'Desempleado'},
    {id: '5', nombre: 'Independiente'},
    {id: '6', nombre: 'Pensionado-Jubilado'},
    {id: '7', nombre: 'Servidor Público'},
    {id: '8', nombre: 'Otro'},

    ];

 if (response.id !== 8) {

        $scope.isDisabledOcupacion = true;

    }

  });


  $http.get(base_api + "/obtener/cultura/" + $routeParams.id)
  .success(function(response){

    $scope.obcultura = {};
    $scope.obcultura.culturaId = response.id.toString();

    $scope.obcultura.cultura = [
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

        if (response.id !== 10) {

        $scope.isDisabledCultura = true;
        $scope.otra_cultura_beneficiario = null;

    }

  });


  $http.get(base_api + "/obtener/discapacidad/" + $routeParams.id)
  .success(function(response){

    $scope.obdiscapacidad = {};
    $scope.obdiscapacidad.discapacidadId = response.id.toString();

    $scope.obdiscapacidad.discapacidad = [
    {id: '1', nombre: 'Si'},
    {id: '2', nombre: 'No'},

    ];

    if (response.id == 2) {

    $scope.isDisabledDiscapacidadCual = true;
    $scope.isDisabledDiscapacidad = true;
    // $scope.obdiscapacidadotro = {};
    // $scope.obdiscapacidadotro.discapacidadotro = null;
    // $scope.obdiscapacidadotro.discapacidadotroId = null;
    // $scope.serie.otra_discapacidad_beneficiario = null;

    }

  });


  $http.get(base_api + "/obtener/DiscapacidadOtra/" + $routeParams.id)
  .success(function(response){
    

$scope.tipo_disc_otra = {
        'id': 1,
        'unit': response.id
        }


console.log($scope.tipo_disc_otra);


  });

 $http.get(base_api + "/obtenerselect/discapacidad")
  .success(function(response){

    $scope.discapacidad_otra = response;

  });


    $scope.selectedDiscapacidad=function(itemDiscapacidad){

      if (itemDiscapacidad == 1) {

          $scope.obdiscapacidadotro.discapacidadotro = [
          {id: '1', nombre: 'Auditiva'},
          {id: '2', nombre: 'Cognitiva'},
          {id: '3', nombre: 'Mental'},
          {id: '4', nombre: 'Motriz'},
          {id: '5', nombre: 'Oral'},
          {id: '6', nombre: 'Visual'},        

          ];

        $scope.required_discapacidad = true; 
        $scope.isDisabledDiscapacidadCual = false;
        $scope.isDisabledDiscapacidad = false;
      }
      else{

        $scope.isDisabledDiscapacidadCual = true;
        $scope.isDisabledDiscapacidad = true;
        $scope.obdiscapacidadotro.discapacidadotro = null;
      }

    }   


    $scope.selectedEnfermedad=function(item){


      if (item == 1) {
        
        $scope.isDisabledEnfermedad = false;

      }
      else{

        $scope.isDisabledEnfermedad = true;
        $scope.serie.enfermedad_beneficiario = null;
      }

    }   


    $scope.isDisabledMedicamento=function(item){


      if (item == 1) {
        
        $scope.isDisabledMedicamento = false;

      }
      else{

        $scope.isDisabledMedicamento = true;
        $scope.serie.medicamentos_beneficiario = null;
      }

    }   


    $scope.selectedOcupacion=function(item){
      
      if (item == 8) {
        $scope.isDisabledOcupacion = false;
    
      }
      else {
        $scope.isDisabledOcupacion = true;
        $scope.serie.otra_ocupacion_beneficiario = null;

      }

    }   

    $scope.selectedSeguridad=function(item){


      if (item == 1) {

      $scope.obsaludsgss.saludsgss = [

        {id: '1', nombre: 'Regimen Contributivo (EPS)'},
        {id: '2', nombre: 'Regimen Subsidiado (SISBEN-EPS-S)'},
        {id: '3', nombre: 'Especial (FFMM, Policia, etc)'},

        ];

        $scope.isDisabledSeguridadCual = false;
        $scope.isDisabledSeguridad = false;
      }
      else{

        $scope.isDisabledSeguridadCual = true;
        $scope.isDisabledSeguridad = true;
        $scope.obsaludsgss.saludsgssId = null;
        $scope.serie.nombre_seguridad_beneficiario = null;
      }

    }   


    $scope.selectedCultura=function(item){


        if (item == 10) {
        $scope.isDisabledCultura = false;
    
      }
      else {
        $scope.isDisabledCultura = true;
        $scope.serie.otra_cultura_beneficiario = null;

      }

    }   

    $scope.selectedHijos=function(item){


      if (item == 1) {
        
        $scope.isDisabled = false;

      }
      else{

        $scope.isDisabled = true;
        $scope.serie.cantidad_hijos_beneficiario = null;
      }

    }   


  $http.get(base_api + "/obtener/enfermedadpermanente/" + $routeParams.id)
  .success(function(response){

    $scope.obenfermedad = {};
    $scope.obenfermedad.enfermedadId = response.id.toString();

    $scope.obenfermedad.enfermedad = [
      {id: '1', nombre: 'Si'},
      {id: '2', nombre: 'No'},
      
    ];

 if (response.id == 2) {

        $scope.isDisabledEnfermedad = true;
        $scope.serie.enfermedad_beneficiario = null;

    }

  });


  $http.get(base_api + "/obtener/medicamentopermanente/" + $routeParams.id)
  .success(function(response){

    $scope.obmedicamento = {};
    $scope.obmedicamento.medicamentoId = response.id.toString();

    $scope.obmedicamento.medicamento = [
      {id: '1', nombre: 'Si'},
      {id: '2', nombre: 'No'},
      

    ];


 if (response.id == 2) {

        $scope.isDisabledMedicamento = true;
        $scope.serie.medicamentos_beneficiario = null;

    }

  });


  $http.get(base_api + "/obtener/seguridadsocial/" + $routeParams.id)
  .success(function(response){

    $scope.obseguridadsocial = {};
    $scope.obseguridadsocial.seguridadsocialId = response.id.toString();

    $scope.obseguridadsocial.seguridadsocial = [
      {id: '1', nombre: 'Si'},
      {id: '2', nombre: 'No'},
      
    ];

    if (response.id == 2) {


        $scope.isDisabledSeguridadCual = true;
        $scope.isDisabledSeguridad = true;
        $scope.obsaludsgss.saludsgssId = null;
        $scope.nombre_seguridad_beneficiario = null;
      
    }

  });


  $http.get(base_api + "/obtener/saludsgss/" + $routeParams.id)
  .success(function(response){

    console.log(response);
    $scope.obsaludsgss = {};
    $scope.obsaludsgss.saludsgssId = response.id.toString();




 $http.get(base_api + "/obtenerselect/salud_sgsss")
  .success(function(response){

    $scope.obsaludsgss.saludsgss = response;
    // console.log($scope.salud_sgsss);

  });
    // $scope.obsaludsgss.saludsgss = [

    //   {id: '1', nombre: 'Regimen Contributivo (EPS)'},
    //   {id: '2', nombre: 'Regimen Subsidiado (SISBEN-EPS-S)'},
    //   {id: '3', nombre: 'Especial (FFMM, Policia, etc)'},

    // ];
  });


  $http.get(base_api + "/obtener/sexo_acudiente/" + $routeParams.id)
  .success(function(response){

    $scope.obsexo_acudiente = {};
    $scope.obsexo_acudiente.sexo_acudienteId = response.id.toString();
    $scope.obsexo_acudiente.sexo_acudiente = [

     {id: '1', nombre: 'Mujer'},
     {id: '2', nombre: 'Hombre'},
 

    ];
  });


  $http.get(base_api + "/obtener/parentesco/" + $routeParams.id)
  .success(function(response){

    $scope.obparentesco = {};
    $scope.obparentesco.parentescoId = response.id.toString();
    $scope.obparentesco.parentesco = [
 
        {id: '1', nombre: 'Madre/Padre'},
        {id: '2', nombre: 'Hermana/Hermano'},
        {id: '3', nombre: 'Tia/Tio'},
        {id: '4', nombre: 'Abuela/Abuelo'},
        {id: '5', nombre: 'Cuidador'},
        {id: '6', nombre: 'Otro'},


    ];
  });


 $http.get(base_api + "/obtenerselect/tipo_documento")
  .success(function(response){

    $scope.tipo_documento = response;

  });


  $http.get(base_api + "/obtener/documentoacudiente/" + $routeParams.id)
  .success(function(response){
    
    $scope.data_documento = {
      'id_documento_tipo': 1,
      'unit': response.id
    }

});


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
    console.log($scope.allGrupos_poblacionales);

  });





  $http.get(base_api + "/obtener/poblacionales/" + $routeParams.id)
  .success(function(response){

    $scope.selectedPoblacionales = response;


  });


  $scope.toggleSelection = function toggleSelection(seleccion)
  {


    console.log(seleccion);
    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);
    console.log(index);

    if (index > -1)
    {
      $scope.selectedPoblacionales.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/poblacional/" + $routeParams.id,
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
      console.log($scope.selectedPoblacionales);
     
    }
  };


  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;


  $scope.formsubmit = function(id, isValid){



if ($scope.obsaludsgss.saludsgssId == undefined) {

    $scope.obsaludsgss.saludsgssId = null;
}



 $scope.fecha_iscrip = $scope.startDateInscripcion;

     var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val()
     var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
     var fecha_inscripcion = $("#fecha_inscripcion").val();



       if (isValid) {

         var datos ={

  //persona          
  no_documento_persona: $scope.serie.documento,
  tipo_doc_persona: $scope.tipo_doc.unit,
  primer_nombre_persona: $scope.serie.nombre_primero,
  segundo_nombre_persona: $scope.serie.nombre_segundo,
  primer_apellido_persona: $scope.serie.apellido_primero,
  segundo_apellido_persona: $scope.serie.apellido_segundo,
  sexo_persona: $scope.obsexo.sexoId,
  fecha_nac_persona: fecha_nacimiento_beneficiario,
  tip_sangre_persona: $scope.obtipo_sangre.tipo_sangreId,
  telefono_fijo_persona: $scope.serie.telefono_fijo,
  telefono_movil_persona : $scope.serie.telefono_movil,
  correo_persona: $scope.serie.correo_electronico,
  pais_id: $scope.data.unit,
  departamento_id: $scope.datas.unit,
  municipio_id: $scope.data_municipio.unit, 
  residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
  estrato: $scope.serie.residencia_estrato,
  barrio_id: $scope.data_barrio.unit,         
  corregimiento: $scope.data_corregimiento.unit,
  vereda: $scope.datas_veredas.unit,
  estado_civil_persona: $scope.data_civil.unit,          
  
  //Acudiente Persona
  no_documento_acudiente: $scope.serie.documento_acudiente,
  tip_doc_acudiente: $scope.data_documento.unit,
  primer_nombre_acudiente: $scope.serie.nombre_primero_acudiente,
  segundo_nombre_acudiente: $scope.serie.nombre_segundo_acudiente,
  primer_apellido_acudiente: $scope.serie.apellido_primero_acudiente,
  segundo_apellido_acudiente: $scope.serie.apellido_segundo_acudiente,
  sex_pariente: $scope.obsexo_acudiente.sexo_acudienteId,
  fecha_nac_acudiente: fecha_nacimiento_acudiente,   
  telefono_fijo_acudiente: $scope.serie.telefono_fijo_acudiente,
  telefono_movil_acudiente: $scope.serie.telefono_movil_acudiente,
  correo_acudiente: $scope.serie.correo_electronico_acudiente,
      
  //beneficiario
          
  modalidad: $scope.serie.modalidad,
  punto_atencion: $scope.serie.punto_atencion,
  hijos_beneficiario: $scope.obhijos.hijosId,
  cantidad_hijos_beneficiario: $scope.serie.cantidad_hijos_beneficiario, 
  ocupacion_beneficiario: $scope.obocupacion.ocupacionId,
  otra_ocupacion_beneficiario: $scope.serie.otra_ocupacion_beneficiario,
  escolaridad_beneficiario: $scope.data_escolaridad.unit,         
  cultura_beneficiario: $scope.obcultura.culturaId,
  otra_cultura_beneficiario: $scope.serie.otra_cultura_beneficiario,
  discapacidad_beneficiario: $scope.obdiscapacidad.discapacidadId,
  discapacidad_select_beneficiario: $scope.tipo_disc_otra.unit,
  otra_discapacidad_beneficiario: $scope.serie.otra_discapacidad_beneficiario,           
  enfermedad_permanente_beneficiario: $scope.obenfermedad.enfermedadId,           
  enfermedad_beneficiario: $scope.serie.enfermedad_beneficiario,                  
  medicamentos_permanente_beneficiario: $scope.obmedicamento.medicamentoId,            
  medicamentos_beneficiario: $scope.serie.medicamentos_beneficiario,    
  seguridad_social_beneficiario: $scope.obseguridadsocial.seguridadsocialId,           
  salud_sgsss_beneficiario: $scope.obsaludsgss.saludsgssId,           
  nombre_seguridad_beneficiario: $scope.serie.nombre_seguridad_beneficiario,        
  parentesco_acudiente: $scope.obparentesco.parentescoId,          
  otro_parentesco_acudiente: $scope.serie.otro_parentesco_acudiente,
  fecha_inscripcion:fecha_inscripcion,
  no_ficha: $scope.serie.no_ficha                
              
        
        };

    var poblacionales = $scope.selectedPoblacionales;

    $.ajax({
      url: base_api + '/postbeneficiario/actualizar/' + id,
      type: 'POST',
      dataType: 'JSON',
      data: {

        datos,
        poblacionales
      },
    }).success(function(){
      toastr.success("Su registro ha sido exitoso", "Registro Actualizado");
      window.location="/admin/postbeneficiarios#/admin/postbeneficiarios";

    })
    .error(function() {
      console.log("success");
    });

    }

  };

});
