SeriesApp.controller('GruposCrtl', function ($scope, $routeParams, $location, GrupoService, $http, $timeout, base_api) {


$scope.title = "Grupos";
$scope.series = [];

 $scope.var1 = '07-2013';


$('#fechaExport-1').monthpicker();
$('#fechaExport-2').monthpicker({pattern: 'yyyy-mm', 
    selectedYear: 2018,
    startYear: 1900,
    finalYear: 2212,});
  var options = {
    selectedYear: 2015,
    startYear: 2008,
    finalYear: 2018,
    openOnFocus: false // Let's now use a button to show the widget
};

$('#fechaExport-3').monthpicker(options);

$('#fechaExport-3').monthpicker().bind('monthpicker-change-year', function (e, year) {
    $('#fechaExport-3').monthpicker('disableMonths', []); // (re)enables all
    if (year === '2015') {
        $('#fechaExport-3').monthpicker('disableMonths', [1, 2, 3, 4]);
    }
    if (year === '2014') {
        $('#fechaExport-3').monthpicker('disableMonths', [9, 10, 11, 12]);
    }
});

$('#fechaExport-3-button').bind('click', function () {
    $('#fechaExport-3').monthpicker('show');
});

 var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();



 $http.get(base_api + "/obtenergrupos/monitor")
  .success(function(response){

    $scope.grupos_monitores = response;
    console.log($scope.grupos_monitores);


  });


$scope.getData = function(){
  $http.get(base_api + "/admin/postgrupos")
    .success(function(response){
    $scope.list = response;
    console.log($scope.list);
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 5; //max no of items to display in a page
    $scope.filteredItems = $scope.list.length; //Initially for no filter
    $scope.totalItems = $scope.list.length;
  });
};

$scope.pageSize = 50;


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



$scope.eliminar = function(id){


swal({
  title: "Estas seguro?",
  text: "No podrá recuperar este archivo!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Eliminado!",
  cancelButtonText: "No, lo Elimines!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {

  $.ajax({
  url: base_api + '/eliminar/grupo_monitor/' + id,
  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
    swal("Eliminado!", "Registro Eliminado.", "success");
    $scope.getData();
}).error(function() {

   swal("Cancelado", "No puede eliminar este grupo tiene asociado beneficiarios :)", "error");
});



  } else {
    swal("Cancelado", "No elimino su registro :)", "error");
  }
});

  }






$scope.inactivar = function(id)
{



Swal.fire({title: 'Desea inactivar este grupo?', showCancelButton: true}).then(result => {
  if (result.value) {
     $.ajax({
  url: base_api + "/admin/postgrupos/inactivar/" + id,
  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
   
    Swal.fire(
  'Inactivado!',
  'Registro Inactivado',
  'success'
)
    $scope.getData();
});
  } else {
    
     Swal.fire({
  title: 'Cancelado!',
  text: 'No inactivo su registro :)',
  type: 'error',
  confirmButtonText: 'Cool'
})
  }
})

}

$scope.activar = function(id)
{

Swal.fire({title: 'Desea activar este grupo?', showCancelButton: true}).then(result => {
  if (result.value) {
     $.ajax({
        url: base_api + "/admin/postgrupos/activar/" + id,

  type: 'POST',
  dataType: 'JSON',

}).success(function(response){
   
    Swal.fire(
  'Inactivado!',
  'Registro Activado',
  'success'
)
    $scope.getData();
});
  } else {
    
     Swal.fire({
  title: 'Cancelado!',
  text: 'No Activo su registro :)',
  type: 'error',
  confirmButtonText: 'Cool'
})
  }
})


}



});


