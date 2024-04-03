  SeriesApp.controller("AsistenciaGrupoCtrl", function($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Mis Beneficiarios";





  $http.get(base_api + "/obtener/nombre_grupo/" + $routeParams.id)
    .success(function(response_grupo){

      console.log(response_grupo);
      $scope.nombre_grupo = response_grupo.codigo_grupo;
      $scope.nombre_grado = response_grupo.nombre_grado;

    });




ko.bindingHandlers.bootstrapSwitchOn = {
    init: function (element, valueAccessor, allBindingsAccessor, viewModel) {
        $elem = $(element);
        $(element).bootstrapSwitch('setState', ko.utils.unwrapObservable(valueAccessor())); // Set intial state
        $elem.on('switch-change', function (e, data) {
            valueAccessor()(data.value);
        }); // Update the model when changed.
    },
    update: function (element, valueAccessor, allBindingsAccessor, viewModel) {
        var vStatus = $(element).bootstrapSwitch('status');
        var vmStatus = ko.utils.unwrapObservable(valueAccessor());
        if (vStatus != vmStatus) {
            $(element).bootstrapSwitch('setState', vmStatus);
        }
    }
};

var vm = {
    on: ko.observable(true),
    
    items: ko.observableArray([
     

        {Name: "Dave", Old: ko.observable(false)},
        {Name: "Richard", Old: ko.observable(true)},
        {Name: "John", Old: ko.observable(false)}
    ])    
}

ko.applyBindings(vm);

$(function() {
$('.switch2').bootstrapSwitch();
});


  $scope.enabled = true;
  $scope.onOff = true;
  $scope.yesNo = true;
  $scope.disabled = true;


  $scope.changeCallback = function() {
   // console.log('This is the state of my model ' + $scope.enabled);
  };


$scope.series = [];

$scope.getData = function(){
   $scope.series_grupos = GrupoService.get({id:$routeParams.id});

   $scope.grupo = $routeParams.id;
   $http.get(base_api + "/obtener/misbeneficiarios/" + $routeParams.id)
    .success(function(response){

    $scope.beneficiarios = response;

    $scope.beneficiarios.map(function(beneficiario) {
      beneficiario.assist = true;
      return beneficiario;
    })

    console.log($scope.beneficiarios);

  });
};


function noExcursion(date){ 

 
    $scope.day = date.getDay();
    return [($scope.day == 1), ''];


};
//Asistencia Update

$.datepicker.setDefaults($.datepicker.regional['es']);

$(function () {

 var dates;
 var pruebas;

$("#fecha_asistencia").datepicker({
     
    yearRange: "-99:+0",
    maxDate: "+0m +0d",


      onSelect: function (date) {   

      $http.get(base_api + '/obtener/asistencia/' + $routeParams.id, {
              params:  {date: date},
              headers: {'Authorization': 'Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=='}
          }
      )
      .then(function(response) {
    
       $scope.persona = response.data;
       console.log($scope.persona);

      if ($scope.persona.length > 0) {
          swal({
        title: "Asistencia Registrada",
        text: "Puedes Actualizar esta asistencia si lo deseas!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })

      $('#tablasave').hide();
      $('#tablaupdate').show();

      }
      
      else {
      $('#tablasave').show();
      $('#tablaupdate').hide();
      }

    // Request completed successfully
}, function(x) {
    // Request error
      });
     }
  });
});
      


$scope.setPage = function(pageNo) {
      $scope.currentPage = pageNo;

    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

$scope.getData();
$scope.series = GrupoService.query();



    $http.get(base_api + "/obtenerselect/comunas")
    .success(function(response){

      $scope.comunas = response;


    });



$scope.toggle = function(modalstate, id) {
      $scope.modalstate = modalstate;
      switch(modalstate) {


          case 'CambiarGrupo':
          $scope.form_contenido = "GRUPOS";
          $scope.form_title = "obtener";
          $scope.id = id;
       

          break;
        default:
          break;
      }

      $('#myModal').modal('show');
  }

 $http.get(base_api + "/obtener/allgruposmonitor")
    .success(function(response){
    $scope.grupos = response;
   

  });

$scope.formCambiar = function(isValid, id){

 if (isValid) {

 $.ajax({
          url: base_api + '/postbeneficiario/asociargrupo/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            grupo_id: $scope.grupo
        },
    
        }).success(function(){
         
            $scope.getData();
            toastr.success("Su registro ha sido exitoso", "Grupo Asociado");
            window.location="/admin/postgrupos#/admin/postgrupos/misbeneficiarios/" + $routeParams.id;
           $('#myModal').modal('hide');


        })
        .error(function() {
          console.log("success");
        });

 }

}

$scope.SacarGrupo = function(id){


swal({
  title: "Estas seguro?",
  text: "No podrá recuperar este archivo!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Eliminado del Grupo!",
  cancelButtonText: "No, lo Elimines!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {

  $.ajax({
  url: base_api + '/sacar/grupo_beneficiario/' + id,
  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
    swal("Eliminado!", "Registro Eliminado del grupo.", "success");
    $scope.getData();
});


  } else {
    swal("Cancelado", "No elimino su registro :)", "error");
  }
});


  }

$scope.formsubmitUpdate = function(isValid){


$scope.persona.forEach(function(persona) {


if (persona.observaciones_update == null) {

    persona.observaciones_update = null;
}

   if (persona.asistencia == false){

     persona.asistencia = 0;
   } else {

    persona.asistencia = 1;
   }

  });


 var datos_update = $scope.persona;  
 console.log(datos_update);
 var fecha_asistencia = $('#fecha_asistencia').val();

$.ajax({
  url: base_api + '/asistencias/update/' + $routeParams.id,
  type: 'POST',
  dataType: 'JSON',
   data: {
            datos_update,
            fecha_asistencia : fecha_asistencia
        },
}).success(function(){

      toastr.success("Su registro ha sido exitoso", "Almacenada asistencia ");
      window.location="/admin/postgrupos#/admin/postgrupos";


});


 

}


 $scope.questions = [];
    var quest1 = {name:"teste", status: true};
    var quest2 = {name:"teste2", status:false};
    $scope.questions.push(quest1);
    $scope.questions.push(quest2);


$scope.onChange = function (newValue, oldValue) {
    $log.log('Switch:', newValue, oldValue);
};

$scope.getCheckedFalse = function(){
    return true;
};

$scope.formsubmitAsistencia = function(isValid){



  $scope.beneficiarios.forEach(function(beneficiario) {


if (beneficiario.observaciones_asistencia == null) {

    beneficiario.observaciones_asistencia = null;
}

if (!beneficiario.assist){

    beneficiario.assist = false;
  }

 if (beneficiario.assist == false){

     beneficiario.assist = 0;
   } else if (beneficiario.assist == true)  {

    beneficiario.assist = 1;
   }

  });

  var datos = $scope.beneficiarios;  
  console.log(datos); 
  var fecha_asistencia = $('#fecha_asistencia').val();

$.ajax({
  url: base_api + '/asistencias/create/' + $routeParams.id,
  type: 'POST',
  dataType: 'JSON',
   data: {
            datos,
            fecha_asistencia : fecha_asistencia
        },
}).success(function(){

      toastr.success("Su registro ha sido exitoso", "Almacenada asistencia ");
      window.location="/admin/postgrupos#/admin/postgrupos";


});


}

    $scope.formsubmit = function(id, isValid){
    

     $scope.fecha_iscrip = $scope.startDateInscripcion;
     var d_inscripcion_date = new Date($scope.fecha_iscrip); 
     var fecha_inscripcion_date = $.datepicker.formatDate('yy/mm/dd', d_inscripcion_date);
     $scope.fecha_nac_benef = $scope.startDate;
     var d_nacimiento_beneficiario = new Date($scope.fecha_nac_benef); 
     var fecha_nacimiento_beneficiario = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_beneficiario);
     $scope.fecha_nac_acud = $scope.startDateParentesco;
     var d_nacimiento_acudiente = new Date($scope.fecha_nac_acud); 
     var fecha_nacimiento_acudiente = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_acudiente);
     var SelectPoblacional = $scope.selected.poblacionales;     


       if (isValid) {


         var datos ={
          fecha_inscripcion: fecha_inscripcion_date,
          no_ficha: $scope.numero_ficha,
          programa_id: $scope.programa,
          modalidad: $scope.modalidad,
          punto_atencion: $scope.punto_atencion,
          nombres_beneficiario: $scope.nombres_beneficiario,
          apellidos_beneficiario: $scope.apellidos_beneficiario,
          tipo_documento_beneficiario: $scope.tipo_documento_beneficiario,
          no_documento_beneficiario: $scope.no_documento_beneficiario,
          sexo_beneficiario: $scope.sexo_beneficiario,
          fecha_nac_beneficiario: fecha_nacimiento_beneficiario,           
          edad_beneficiario: $scope.edad_beneficiario,           
          telefono_beneficiario: $scope.telefono_beneficiario,           
          correo_beneficiario: $scope.correo_beneficiario,          
          pais_id: $scope.pais,           
          departamento_id: $scope.departamento,           
          municipio_id: $scope.municipio,            
          direccion_beneficiario: $scope.residencia_beneficiario,          
          estrato_beneficiario: $scope.estrato,          
          comuna_id: $scope.comuna,          
          barrio_id: $scope.barrio,         
          corregimiento_beneficiario: $scope.corregimiento,          
          vereda_beneficiario: $scope.vereda,            
          estado_civil_beneficiario: $scope.est_beneficiario,          
          hijos_beneficiario: $scope.hijo,            
          cantidad_hijos_beneficiario: $scope.cantidad_hijos,                    
          tipo_sangre_beneficiario: $scope.tip_sangre,            
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
          nombres_acudiente: $scope.nombres_familiar,           
          apellidos_acudiente: $scope.apellidos_familiar,           
          tipo_doc_acudiente: $scope.tipo_familiar,           
          documento_acudiente: $scope.no_documento_pariente,            
          sexo_acudiente: $scope.sex_pariente,           
          fecha_nac_acudiente: fecha_nacimiento_acudiente,           
          edad_acudiente: $scope.edad_pariente,           
          telefono_acudiente: $scope.telefono_pariente,            
          correo_acudiente: $scope.email_pariente,           
          parentesco_acudiente: $scope.parentesco,          
          otro_parentesco_acudiente: $scope.otro_parentesco            
        };

 $.ajax({
          url: base_api + '/postbeneficiario/create/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            datos,
            SelectPoblacional
        },
    
        }).success(function(){
         
            toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
            window.location="/admin/postgrupos#/admin/postgrupos";


        })
        .error(function() {
          console.log("success");
        });
      }
    };
  });
