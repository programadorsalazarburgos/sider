  SeriesApp.controller("EvaluacionGrupoCtrl", function($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Mis Beneficiarios";



$scope.opts = {
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
    yearRange: "-99:+0",
    maxDate: "+0m +0d",

  };
  $scope.data = {
    valor: ''
  };


$scope.todos = [
    
  ];
  $scope.min = 10;
  $scope.max = 50;
  $scope.step = 2;



  $http.get(base_api + "/obtener/nombre_grupo/" + $routeParams.id)
    .success(function(response_grupo){

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


 $http.get(base_api + "/admin/postcriteriosGrupo/" + $routeParams.id)
    .success(function(response){
    $scope.criterios = response;
   // console.log($scope.criterios);

  });

$scope.evaluaciones = [];


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

    // console.log($scope.beneficiarios);

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
     
      onSelect: function (date) {   
        
      $http.get(base_api + '/obtener/asistencia/' + $routeParams.id, {
              params:  {date: date},
              headers: {'Authorization': 'Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=='}
          }
      )
      .then(function(response) {
    
       $scope.persona = response.data;
       // console.log($scope.persona);

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


$scope.formsubmitEvaluacion = function(){


 $scope.evaluaciones.map(function(evaluacion, index1) {

    
    Object.keys(evaluacion).map(function (key) { 
      eval = evaluacion[key];
      eval.beneficiario_id = $scope.beneficiarios[index1].id;
      eval.criterio_id = $scope.criterios[key].id;

      });

  });

  var datos = $scope.evaluaciones;

  $http({
        url: base_api + "/crear/evaluaciones/" + $routeParams.id,
        method: "POST",
        data: { 

          datos,
          fecha_evaluacion: $scope.data.valor


         }
    })
    .then(function(response) {
      swal("Almacenado!", "Registros evaluación guardado.", "success");
      $scope.evaluaciones = '';
      $scope.data.valor = '';
      window.location="/admin/postcriterios#/admin/postcriterios";

     
    }, 
    function(response) { // optional
            // failed
    });

}


$scope.formupdateEvaluacion = function(){



 $scope.evaluaciones.map(function(evaluacion, index1) {
    
    Object.keys(evaluacion).map(function (key) { 
      eval = evaluacion[key];
      eval.beneficiario_id = $scope.beneficiarios[index1].id;
      eval.criterio_id = $scope.criterios[key].id;
      // eval.prueba = $scope.usuarioscriterio[key].id;

      });

  });

  var datos_ev = $scope.evaluaciones;
  console.log(datos_ev);

  

  $http({
        url: base_api + "/actualizar/evaluaciones/" + $routeParams.id,
        method: "POST",
        data: { 

          datos_ev,
          fecha_evaluacion: $scope.data.valor

       

         }
    })
    .then(function(response) {
      swal("Almacenado!", "Registros evaluación guardado.", "success");
      $scope.evaluaciones = '';
      $scope.data.valor = '';
      window.location="/admin/postcriterios#/admin/postcriterios";

     
    }, 
    function(response) { // optional
            // failed
    });

}






$scope.boton = 1;

$scope.selectedFecha = function(fecha)
{


  $http.get(base_api + '/obtener/evaluacion/' + $routeParams.id, {
              params:  {date: fecha},
              headers: {'Authorization': 'Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=='}
          }
      )
      .then(function(response) {

      $scope.boton = 2;
      $scope.usuarioscriterio = response.data;


         if ($scope.usuarioscriterio.length > 0) {


           swal({
        title: "Evaluacion Registrada",
        text: "Puedes Actualizar esta evaluación si lo deseas!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
     

      $scope.usuarioscriterio.map(function(elem) {
        array_benef = '';
        $scope.evaluaciones.map(function(eval) {
          res = eval.find(function(el){
            return el.beneficiario_id === elem.ficha_id

          })
          if(res){
            array_benef = eval
          }
        })
      
        if(array_benef){
          array_benef.push(
            {

          'beneficiario_id': elem.ficha_id,
          'criterio_id': elem.criterio_id,
          'valor': elem.valor_evaluacion,
          'evaluacion_id': elem.id
            }
          )
        }else{
          $scope.evaluaciones.push([{

            'beneficiario_id': elem.ficha_id,
            'criterio_id': elem.criterio_id,
            'valor': elem.valor_evaluacion,
            'evaluacion_id': elem.id
          }])
        }




      })
    

      console.log($scope.evaluaciones);


} 

else if($scope.usuarioscriterio.length == 0)
{


$scope.evaluaciones = [];
$scope.boton = 1;

console.log($scope.usuarioscriterio.length);


}




});


}




  });
