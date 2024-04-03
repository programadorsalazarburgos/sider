  SeriesApp.controller("AsistenciaGrupoProgramaCtrl", function($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Mis Beneficiarios";


  $http.get(base_api + "/obtener/nombre_grupoprograma/" + $routeParams.id)
    .success(function(response_grupo){

      $scope.nombre_grupo = response_grupo.nombre_grupo;
      $scope.nombre_lugar = response_grupo.nombre_lugar;
      $scope.nombre_disciplina = response_grupo.nombre_disciplina;

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
$scope.pageSize = 300;

$scope.getData = function(){
   $scope.series_grupos = GrupoProgramaService.get({id:$routeParams.id});

   $scope.grupo = $routeParams.id;
   $http.get(base_api + "/obtener/misbeneficiariosprograma/" + $routeParams.id)
    .success(function(response){

    $scope.beneficiarios = response;
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 5; //max no of items to display in a page
    $scope.filteredItems = $scope.beneficiarios.length; //Initially for no filter
    $scope.totalItems = $scope.beneficiarios.length;

    $scope.beneficiarios.map(function(beneficiario) {
    
      beneficiario.assist = true;
      return beneficiario;
    })



  });
};

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

      $http.get(base_api + '/obtener/asistenciaprograma/' + $routeParams.id, {
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
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
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
$scope.series = GrupoProgramaService.query();


$scope.formsubmitUpdate = function(isValid){
//
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

 if(fecha_asistencia == '')
 {
   
   swal("Algo te hace falta!", "Verifique que su campo fecha asistencia no este vacio!", "error");
   toastr.error("Verifique que su campo fecha asistencia no este vacio", "Campo fecha asistencia");
 
 }

 else{

$.ajax({
  url: base_api + '/asistenciasprogramas/update/' + $routeParams.id,
  type: 'POST',
  dataType: 'JSON',
   data: {
            datos_update,
            fecha_asistencia : fecha_asistencia
        },
}).success(function(){

      toastr.success("Su registro ha sido exitoso", "Almacenada asistencia ");
      window.location="/admin/postgruposprogramas#/admin/postgruposprogramas";

    });
   }
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

console.log($scope.beneficiarios);

  $scope.beneficiarios.forEach(function(beneficiario) {



if (beneficiario.observaciones_asistencia == null) {

    beneficiario.observaciones_asistencia = null;
}

if (beneficiario.observaciones_asistencia == undefined) {

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

  if(fecha_asistencia == '')
  {
    
    swal("Algo te hace falta!", "Verifique que su campo fecha asistencia no este vacio!", "error");
    toastr.error("Verifique que su campo fecha asistencia no este vacio", "Campo fecha asistencia");
  
  }

  else{


$.ajax({
  url: base_api + '/asistenciasprogramas/create/' + $routeParams.id,
  type: 'POST',
  dataType: 'JSON',
   data: {
            datos,
            fecha_asistencia : fecha_asistencia
        },
}).success(function(){

      toastr.success("Su registro ha sido exitoso", "Almacenada asistencia ");
      window.location="/admin/postgruposprogramas#/admin/postgruposprogramas";


});



  }


}

  });
