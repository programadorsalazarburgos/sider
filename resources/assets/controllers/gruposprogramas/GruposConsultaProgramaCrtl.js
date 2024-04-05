SeriesApp.controller('GruposConsultaProgramaCrtl', function ($scope, $routeParams, $location, GrupoProgramaService, $http, $timeout, base_api) {


$scope.title = "Grupos Consulta";
$scope.series = [];
$scope.var1 = '07-2013';


$(document).ready(function () {
   
$.datepicker.setDefaults($.datepicker.regional['es']);

    $('#txtDate').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'mm-yy',
        showButtonPanel: true,


        onClose: function () {
            var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
            $(this).datepicker('refresh');
        },

        beforeShow: function () {
            if ((selDate = $(this).val()).length > 0) {
                iYear = selDate.substring(selDate.length - 4, selDate.length);
                iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
                $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
                $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
            }
        }
    });

    $("#txtDate").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });

    $("#txtDate").blur(function () {
        $(".ui-datepicker-calendar").hide();
    });
});

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



 
 $http.get(base_api + "/selectgruposprogramas/monitor")
  .success(function(response){

    $scope.grupos_monitores = response;


  });


$scope.getData = function(){
  $http.get(base_api + "/admin/postgruposprogramas/consulta")
    .success(function(response){
      console.log(response);
    $scope.list = response;
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
$scope.series = GrupoProgramaService.query();

$scope.CargaParrilla = function()
{

  $http({
    url: base_api + '/obtener/carga_parrilla',
    method: "GET",
    params: {
      grupo: $scope.grupo, 
      fecha: $('#fechaExport-2').val()
     

    },
 })
 .success(function(data) {
  $scope.list = data;
  $scope.currentPage = 1; //current page
  $scope.entryLimit = 5; //max no of items to display in a page
  $scope.filteredItems = $scope.list.length; //Initially for no filter
  $scope.totalItems = $scope.list.length;
 

})
.error(function() {
  console.log("error");
});

}





});


