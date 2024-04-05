SeriesApp.controller('SiderCrtl', function ($scope, $routeParams, $location, SiderService, $http, $timeout, base_api) {
console.log(111111111);
$scope.title = "Sider Home";
$scope.series = [];

  $http.get(base_api + "/programas")
    .success(function(response){

    $scope.programas = response;
    console.log($scope.programas);

  });


$http.get(base_api + "/obtener/escenarios")
  .success(function(response){
    $scope.totalescenarios = response;
 
  });


$http.get(base_api + "/obtener/disciplinassider")
  .success(function(response){
    $scope.totaldisciplinas = response;
 
  });


$http.get(base_api + "/obtener/usuarios_micomunidad")
  .success(function(response){
    $scope.totalusuarios = response;
 
  });



$http.get(base_api + "/obtener/colegios_micomunidad")
  .success(function(response){
    $scope.totalcolegios = response;
 
  });


$http.get(base_api + "/obtener/sedes_sider")
  .success(function(sedes){
    $scope.totalsedes = sedes;
 
  });



$scope.toggle = function(modalstate) {
      $scope.modalstate = modalstate;
      switch(modalstate) {
          case 'VerDescripcion':
          $scope.form_title = "Formulario Rol";
          break;
       
      }

      $('#myModal').modal('show');
  }


$scope.MetasPrograma = function()
{

  console.log($scope.programa.unit);
  $http.get(base_api + "/obtener/metasprograma/" + $scope.programa.unit)
  .success(function(response){
    $scope.metasprogramas = response;
 
  });


}



var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  "dataProvider": [{
    "country": "DEPORVIDA",
    "visits": 3025,
    "color": "#FF0F00"
  }, {
    "country": "VIVIR SIN LIMITES",
    "visits": 1882,
    "color": "#FF6600"
  }, {
    "country": "DEPORTE ESCOLAR Y UNIVERSITARIO",
    "visits": 1809,
    "color": "#FF9E01"
  }, {
    "country": "DEPORTE ASOCIADO",
    "visits": 1322,
    "color": "#FCD202"
  }, {
    "country": "DEPORTE COMUNITARIO",
    "visits": 1122,
    "color": "#F8FF01"
  }, {
    "country": "CALINTEGRA",
    "visits": 1114,
    "color": "#B0DE09"
  }, {
    "country": "CUERPO Y ESPÍRITU",
    "visits": 984,
    "color": "#04D215"
  }, {
    "country": "CARRERAS Y CAMINATAS",
    "visits": 711,
    "color": "#0D8ECF"
  }, {
    "country": "VÍACTIVA",
    "visits": 665,
    "color": "#0D52D1"
  }, {
    "country": "VIVE EL PARQUE",
    "visits": 580,
    "color": "#2A0CD0"
  }, {
    "country": "CALI ACOGE",
    "visits": 443,
    "color": "#8A0CCF"
  }, {
    "country": "CALI SE DIVIERTE Y JUEGA",
    "visits": 441,
    "color": "#CD0D74"
  },
   {
    "country": "CANAS Y GANAS",
    "visits": 442,
    "color": "#CD0D74"
  },
  {
    "country": "MI COMUNIDAD ES ESCUELA",
    "visits": 441,
    "color": "#CD0D74"
  }],

  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": "Cantidad Beneficiarios"
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "visits"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});


var chart = AmCharts.makeChart("chartcomuna", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  "dataProvider": [{
    "country": "DEPORVIDA",
    "visits": 3025,
    "color": "#FF0F00"
  }, {
    "country": "VIVIR SIN LIMITES",
    "visits": 1882,
    "color": "#FF6600"
  }, {
    "country": "DEPORTE ESCOLAR Y UNIVERSITARIO",
    "visits": 1809,
    "color": "#FF9E01"
  }, {
    "country": "DEPORTE ASOCIADO",
    "visits": 1322,
    "color": "#FCD202"
  }, {
    "country": "DEPORTE COMUNITARIO",
    "visits": 1122,
    "color": "#F8FF01"
  }, {
    "country": "CALINTEGRA",
    "visits": 1114,
    "color": "#B0DE09"
  }, {
    "country": "CUERPO Y ESPÍRITU",
    "visits": 984,
    "color": "#04D215"
  }, {
    "country": "CARRERAS Y CAMINATAS",
    "visits": 711,
    "color": "#0D8ECF"
  }, {
    "country": "VÍACTIVA",
    "visits": 665,
    "color": "#0D52D1"
  }, {
    "country": "VIVE EL PARQUE",
    "visits": 580,
    "color": "#2A0CD0"
  }, {
    "country": "CALI ACOGE",
    "visits": 443,
    "color": "#8A0CCF"
  }, {
    "country": "CALI SE DIVIERTE Y JUEGA",
    "visits": 441,
    "color": "#CD0D74"
  },
   {
    "country": "CANAS Y GANAS",
    "visits": 442,
    "color": "#CD0D74"
  },
  {
    "country": "MI COMUNIDAD ES ESCUELA",
    "visits": 441,
    "color": "#CD0D74"
  }],

  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": "Cantidad Beneficiarios"
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "visits"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});



var chart_monitores = AmCharts.makeChart("chartdivmonitores", {
  "type": "pie",
  "startDuration": 0,
   "theme": "light",
  "addClassNames": true,
  "legend":{
    "position":"right",
    "marginRight":100,
    "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
  "dataProvider": [{
    "country": "Fútbol",
    "litres": 50
  }, {
    "country": "Baloncesto",
    "litres": 30
  }, {
    "country": "Tenis",
    "litres": 201
  }, {
    "country": "Ciclismo",
    "litres": 165
  }, {
    "country": "Atletismo",
    "litres": 139
  }, {
    "country": "Voleibol",
    "litres": 128
  }, {
    "country": "Natación",
    "litres": 99
  }],
  "valueField": "litres",
  "titleField": "country",
  "export": {
    "enabled": true
  }
});

chart_monitores.addListener("init", handleInit);

chart_monitores.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});

function handleInit(){
  chart_monitores.legend.addListener("rollOverItem", handleRollOver);
}

function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}


var chart_usuarios = AmCharts.makeChart( "chartdivusuarios", {
  "type": "pie",
  "theme": "light",
  "dataProvider": [ {
    "country": "Monitores",
    "value": 260
  }, {
    "country": "Metodólogos",
    "value": 100
  } ],


  "valueField": "value",
  "titleField": "country",
  "outlineAlpha": 0.4,
  "depth3D": 15,
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 30,
  "export": {
    "enabled": true
  }
} );

$scope.graficoindicadores = false;

$scope.selectedMeta = function(meta) {

  
$scope.graficoindicadores = true;

  var promise = $http.get(base_api + "/metaalcance/" + meta);
promise.then(
function(metaalcance) {

  $scope.metaalcance = metaalcance.data.meta;
  $scope.nombre_meta = metaalcance.data.nombre_meta;

  });

 

  $.ajax({
    url: base_api + "/graficoindicadores/" + meta,
    type: 'GET',
    dataType: 'JSON',
    async: false, 
  }).success(function(response){
    $scope.indicadoremetas = response;
    $scope.indicadoremetas.map(function(indicador) {
        
      indicador.porcentaje = indicador.value * 100 / indicador.meta;
      return indicador;
    })

    console.log($scope.indicadoremetas);

    historicalBarChart = [
      {
          key: "Cumulative Return",
          values: response
      }
  ];

    nv.addGraph(function() {
      var chart = nv.models.discreteBarChart()
          .x(function(d) { return d.label })
          .y(function(d) { return d.value })
          .staggerLabels(true)
          //.staggerLabels(historicalBarChart[0].values.length > 8)
          .showValues(true)
          .duration(250)
          ;

      d3.select('#chart1 svg')
          .datum(historicalBarChart)
          .call(chart);

      nv.utils.windowResize(chart.update);
      return chart;
  });




           
  }).error(function() {
  
   
  });
 
 }
 
    
$scope.selectedMeta2 = function(meta)
{

  $scope.comuna = 1;
$scope.instituciones = [];

var promise = $http.get(base_api + "/metaalcance/" + 1);
promise.then(
function(metaalcance) {

  $scope.metaalcance = metaalcance.data.meta;
  $scope.nombre_meta = metaalcance.data.nombre_meta;

  });


  
    $http.get(base_api + "/graficoindicadores/" + 1)
    .success(function(response){
      $scope.indicadoremetas = response;


  $scope.data = data = [
    {
        "key": "Avance",
        "values": $scope.instituciones
    }]

  $scope.options = {
            chart: {
                type: 'multiBarChart',
                height: 400,
                width: 400,
                formatNumber: 0,
                // x: function(d){return d.label;},
                // y: function(d){return d.value;},
                showControls: true,
                showValues: true,
                   labels: {
        items: [{
            html: 'Total fruit consumption',
            style: {
                left: '50px',
                top: '18px',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
            }
        }]
    },
                // xAxis: {
                //     showMaxMin: false
                // },
                yAxis: {
                    axisLabel: 'Values',
                    formatNumber: 0,

                    tickFormat: function(d){
                        // return d3.format(',.2f')(d);
                    }
                },
                multibar: {
                  dispatch: {
                    renderEnd: function (e) {
                      // d3.select(self.container).selectAll('.nv-bar').attr('width', 40);
                      // console.log('this fires each time window is resized')
                    }
                  }
                },
                callback: function (chart) {
                  self = chart;
                  
                  d3.selectAll('.nv-bar').attr('width', 40);
                  
                  return chart;
                }
            }
        };

 });

 function formatNumber (n) {
	n = String(n).replace(/\D/g, "");
  return n === '' ? n : Number(n).toLocaleString();
}

$scope.selectedValue = "INFORMACIÓN.";
$scope.indicadores = [];
console.log($scope.indicadores);
      $scope.events = {
        dataplotclick: function(ev, props) {
          $scope.$apply(function() {
            $scope.operacion = (props.dataValue * 100) / $scope.metaalcance;
            $scope.colorValue = "background-color:" + props.categoryLabel + ";";
            $scope.selectedValue = "AVANCE "  + formatNumber(props.dataValue) + " EQUIVALENTE AL: " + $scope.operacion + "%";
          });
        }
      };


        $.ajax({
          url: base_api + "/graficoindicadores/" + 1,
          type: 'GET',
          dataType: 'JSON',
          async: false, 
        }).success(function(response){
          $scope.indicadores.push(response);
                 
        }).error(function() {
        
         
        });
    



   
      $scope.dataSource = {
        "chart": {
          "caption": "INDICADORES METAS ",
          "captionFontSize": "16",
          "captionPadding": "25",
          "baseFontSize": "14",
          "canvasBorderAlpha": "0",
          "showPlotBorder": "0",
          "placevaluesInside": "1",
          "valueFontColor": "#2C3E50",
          "captionFontBold": "0",
          "bgColor": "white",  ///fondo 
          "divLineAlpha": "50",
          "plotSpacePercent": "10",
          "bgAlpha": "95",
          "canvasBgAlpha": "0",
          "outCnvBaseFontColor": "#2C3E50",
          "showValues": "0",
          "baseFont": "Open Sans",
          "paletteColors": "#6495ED, #FF6347, #90EE90, #FFD700, #FF1493",
          "theme": "zune",
          
          // tool-tip customization
          "toolTipBorderColor": "#2C3E50",
          "toolTipBorderThickness": "1",
          "toolTipBorderRadius": "2",
          "toolTipBgColor": "#000000",
          "toolTipBgAlpha": "70",
          "toolTipPadding": "12",
          "toolTipSepChar": " Avance: ",

          // axis customization
          "xAxisNameFontSize": "16",
          "yAxisNameFontSize": "16",
          "xAxisNamePadding": "10",
          "yAxisNamePadding": "10",
          // "xAxisName": "Colors",
          "yAxisName": "Valores",
          "xAxisNameFontBold": "0",
          "yAxisNameFontBold": "0",
          "showXAxisLine": "1",
          "xAxisLineColor": "#999999",
          "formatNumber": "0",

        },

        "data": $scope.indicadores
      };

}


});


