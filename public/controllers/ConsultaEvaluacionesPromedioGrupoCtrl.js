SeriesApp.controller("ConsultaEvaluacionesPromedioGrupoCtrl", function($scope, GrupoService, $routeParams, fileUpload, $http, $location, $timeout, base_api){
  $scope.title = "Evaluaciones Promedio";

   


$scope.series = [];
$scope.no_grupo = $routeParams.id;

  $http.get(base_api + "/obtener/nombre_grupo/" + $routeParams.id)
    .success(function(response_grupo){

      console.log(response_grupo);
      $scope.nombre_grupo = response_grupo.codigo_grupo;
      $scope.nombre_grado = response_grupo.nombre_grado;

    });





$scope.getData = function(){
   $scope.series_grupos = GrupoService.get({id:$routeParams.id});


   $scope.grupo = $routeParams.id;
   $http.get(base_api + "/obtener/misbeneficiarios/" + $routeParams.id)
    .success(function(response){
      console.log(response);
    $scope.list = response;
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 5; //max no of items to display in a page
    $scope.filteredItems = $scope.list.length; //Initially for no filter
    $scope.totalItems = $scope.list.length;
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



$scope.EvaluacionPromedio = function(modalstate, id) {

      $scope.modalstate = modalstate;
      switch(modalstate) {
          case 'promedio':
          $scope.titulo = "PROMEDIO EVALUACIONES";
          $scope.valorID = id;
          $scope.promedio = 1;
          $http.get(base_api + "/obtener/promevaluaciones/" + id)
              .success(function(response){
                $scope.serie = response;

                
          });

          break;
       
      }

      $('#myModal').modal('show');
  }


$scope.EvaluacionPromedioGrafico = function(modalstate, id) {

      $scope.modalstate = modalstate;
      switch(modalstate) {
          case 'promedio':
          $scope.titulo = "PROMEDIO EVALUACIONES";
          $scope.valorID = id;
          $scope.promedio = 2;
          $http.get(base_api + "/obtener/promevaluacionesGrafico/" + id)
              .success(function(response){
                $scope.serie = response;
                


    $scope.serie.map(function(serie) {
      serie.y = parseInt(serie.y);
      return serie;
    })


    console.log($scope.serie);


                $scope.dataPoints= [
                   { label: "Criterio 1", y: 6.17 },
                    { label: "Criterio 2", y: 101.06 },
                    { label: "Criterio 3", y: 21.74 },
                    { label: "Criterio 4", y: 32.93 },
                    { label: "Criterio 5", y: 32.93 },
                    { label: "Criterio 6", y: 32.93 },
                    
                ]

                console.log($scope.dataPoints);



 $scope.chart = new CanvasJS.Chart("chartContainer", {
        theme: 'theme1',
        title:{
            text: "PROMEDIO EVALUACIONES"              
        },
        axisY: {
            title: "Valor evaluación",
            labelFontSize: 14,
        },
        axisX: {
            labelFontSize: 14,
        },
        data: [              
            {
                type: "bar",
                dataPoints: $scope.serie
            }
        ]
    });

    $scope.chart.render(); //render the chart for the first time
            
    $scope.changeChartType = function(chartType) {
        $scope.chart.options.data[0].type = chartType;
        $scope.chart.render(); //re-render the chart to display the new layout
    }

                
          });

          break;
       
      }

      $('#myModal').modal('show');
  }






  });
