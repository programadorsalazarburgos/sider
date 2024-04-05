SeriesApp.controller('SiderCrtl', function ($scope, $routeParams, $location, SiderService, $http, $timeout, base_api) {


$scope.title = "Sider Home";
$scope.series = [];

  $http.get(base_api + "/programas")
    .success(function(response){
      console.log(11);
    $scope.programas = response;
  
  });

  $http.get(base_api + "/obtener/totalbeneficiarios")
  .success(function(response){
    $scope.totalbeneficiarios = response;
    console.log($scope.totalbeneficiarios);
    console.log(22);
  });


  $http.get(base_api + "/obtener/escenarios")
  .success(function(response){
    $scope.totalescenarios = response;
    console.log(33);
  });



$http.get(base_api + "/obtener/disciplinassider")
  .success(function(response){
    $scope.totaldisciplinas = response;
    console.log(44);
  });

  $http.get(base_api + "/obtener/programasTotal")
  .success(function(response){
    $scope.totalprogramas = response;
 
  });

$http.get(base_api + "/obtener/usuarios_micomunidad")
  .success(function(response){
    $scope.totalusuarios = response;
 
  });



$http.get(base_api + "/obtener/colegios_micomunidad")
  .success(function(response){
    $scope.totalcolegios = response;
  
 
  });



$http.get(base_api + "/cantidad/sedes_sider")
  .success(function(response){
    $scope.totalsedes = response;
    
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

$http.get(base_api + "/obtener/programasbeneficiarios")
  .success(function(response){
   

$scope.deporvida = {
  "country": "DEPORVIDA",
  "visits": response.TotalDeporvida,
  "color": "#FF0F00"

}


$scope.DeporteEscolar = {
  "country": "DEPORTE ESCOLAR UNIVERSITARIO",
  "visits": response.TotalDeporteEscolar,
  "color": "#FF9E01"

}

$scope.DeporteAsociado = {
  "country": "DESAFIO ELITE",
  "visits": response.TotalDeporteAsociado,
  "color": "#FCD202"

}


$scope.CaliIntegra = {
  "country": "CALI INCLUYENTE",
  "visits": response.TotalCaliIntegra,
  "color": "#B0DE09"

}

$scope.CuerpoyEspiritu = {
  "country": "ACTIVAMENTE",
  "visits": response.TotalCuerpoyEspiritu,
  "color": "#04D215"

}

$scope.CarrerasyCamintas = {
  "country": "CARRERAS Y CAMINATAS",
  "visits": response.TotalCarrerasyCamintas,
  "color": "#0D8ECF"

}

$scope.Viactiva = {
  "country": "SOBRERUEDAS",
  "visits": response.TotalViactiva,
  "color": "#0D52D1"

}

$scope.ViveelParque = {
  "country": "CALI JUEGA",
  "visits": response.TotalViveelParque,
  "color": "#2A0CD0"

}

$scope.CaliAcoge = {
  "country": "POBLACIONES Y ETNIAS",
  "visits": response.TotalCaliAcoge,
  "color": "#8A0CCF"

}


$scope.CanasyGanas = {
  "country": "DEPORTE AL BARRIO",
  "visits": response.TotalCanasyGanas,
  "color": "#8A0CCF"

}


var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  "dataProvider": [
    $scope.deporvida, 
    $scope.DeporteAsociado, 
    $scope.DeporteEscolar, 
    $scope.CanasyGanas,
    $scope.CuerpoyEspiritu, 
    $scope.CaliIntegra, 
    $scope.CarrerasyCamintas, 
    $scope.Viactiva, 
    $scope.ViveelParque, 
    $scope.CaliAcoge, 

 ],

  "valueAxes": [{
    "axisAlpha": 10,
    "position": "left",
    "title": "Total Beneficiarios"
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


});


$http.get(base_api + "/obtener/comunasbeneficiarios")
  .success(function(response){
   
console.log(response);
$scope.totalComuna1 = {
  "country": "COMUNA 1",
   "fontSize": 5,
  "visits": response.totalComuna1,
  "color": "#FFFF00",
   "adjustBorderColor": false,
    "horizontalPadding": 10,
    "verticalPadding": 8,

}


$scope.totalComuna2 = {
  "country": "COMUNA 2",
  "visits": response.totalComuna2,
  "color": "#FF9E01"

}

$scope.totalComuna3 = {
  "country": "COMUNA 3",
  "visits": response.totalComuna3,
  "color": "#FCD202"

}

$scope.totalComuna4 = {
  "country": "COMUNA 4",
  "fontSize": 5,
  "visits": response.totalComuna4,
  "color": "#F8FF01"

}

$scope.totalComuna5 = {
  "country": "COMUNA 5",
  "visits": response.totalComuna5,
  "color": "#B0DE09"

}

$scope.totalComuna6 = {
  "country": "COMUNA 6",
  "visits": response.totalComuna6,
  "color": "#04D215"

}

$scope.totalComuna7 = {
  "country": "COMUNA 7",
  "visits": response.totalComuna7,
  "color": "#0D8ECF"

}

$scope.totalComuna8 = {
  "country": "COMUNA 8",
  "visits": response.totalComuna8,
  "color": "#0D52D1"

}

$scope.totalComuna9 = {
  "country": "COMUNA 9",
  "visits": response.totalComuna9,
  "color": "#2A0CD0"

}

$scope.totalComuna10 = {
  "country": "COMUNA 10",
  "visits": response.totalComuna10,
  "color": "#8A0CCF"

}

$scope.totalComuna11 = {
  "country": "COMUNA 11",
  "visits": response.totalComuna11,
  "color": "#2A0CD0"

}

$scope.totalComuna12 = {
  "country": "COMUNA 12",
  "visits": response.totalComuna12,
  "color": "#8A0CCF"

}

$scope.totalComuna13 = {
  "country": "COMUNA 13",
  "visits": response.totalComuna13,
  "color": "#0D8ECF"

}


$scope.totalComuna14 = {
  "country": "COMUNA 14",
  "visits": response.totalComuna14,
  "color": "#CD0D74"

}

$scope.totalComuna15 = {
  "country": "COMUNA 15",
  "visits": response.totalComuna15,
  "color": "#CD0D74"

}

$scope.totalComuna16 = {
  "country": "COMUNA 16",
  "visits": response.totalComuna16,
  "color": "#CD0D74"

}

$scope.totalComuna17 = {
  "country": "COMUNA 17",
  "visits": response.totalComuna17,
  "color": "#CD0D74"

}

$scope.totalComuna18 = {
  "country": "COMUNA 18",
  "visits": response.totalComuna18,
  "color": "#CD0D74"

}

$scope.totalComuna19 = {
  "country": "COMUNA 19",
  "visits": response.totalComuna19,
  "color": "#CD0D74"

}

$scope.totalComuna20 = {
  "country": "COMUNA 20",
  "visits": response.totalComuna20,
  "color": "#CD0D74"

}

$scope.totalComuna21 = {
  "country": "COMUNA 21",
  "visits": response.totalComuna21,
  "color": "#CD0D74"

}

$scope.totalComuna22 = {
  "country": "COMUNA 22",
  "visits": response.totalComuna22,
  "color": "#CD0D74"

}

$scope.TotalCorregimientos = {
  "country": "CORREGIMIENTOS",
  "visits": response.TotalCorregimientos,
  "color": "#CD0D74"

}

var chart = AmCharts.makeChart("chartcomuna", {

 "type": "serial",
  "addClassNames": true,
  "theme": "light",
  "autoMargins": false,
  "marginLeft": 5,
  "marginRight": 18,
  "marginTop": 10,
  "marginBottom": 115,


  "dataProvider": [
$scope.totalComuna1,
$scope.totalComuna2,
$scope.totalComuna3,
$scope.totalComuna4,
$scope.totalComuna5,
$scope.totalComuna6,
$scope.totalComuna7,
$scope.totalComuna8,
$scope.totalComuna9,
$scope.totalComuna10,
$scope.totalComuna11,
$scope.totalComuna12,
$scope.totalComuna13,
$scope.totalComuna14,
$scope.totalComuna15,
$scope.totalComuna16,
$scope.totalComuna17,
$scope.totalComuna18,
$scope.totalComuna19,
$scope.totalComuna20,
$scope.totalComuna21,
$scope.totalComuna22,
$scope.TotalCorregimientos,

 ],

  "valueAxes": [{
    "axisAlpha": 10,
    "position": "left",
    "title": "Total Beneficiarios"
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.90,
    "lineAlpha": 0.20,
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
    "labelRotation": 90
  },
  "export": {
    "enabled": true
  }

});


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

// $scope.selectedMeta = function(meta) {

  
// $scope.graficoindicadores = true;

//   var promise = $http.get(base_api + "/metaalcance/" + meta);
// promise.then(
// function(metaalcance) {

//   $scope.metaalcance = metaalcance.data.meta;
//   $scope.nombre_meta = metaalcance.data.nombre_meta;

//   });

 

//   $.ajax({
//     url: base_api + "/graficoindicadores/" + meta,
//     type: 'GET',
//     dataType: 'JSON',
//     async: false, 
//   }).success(function(response){
//     $scope.indicadoremetas = response;
//     $scope.indicadoremetas.map(function(indicador) {
        
//       indicador.porcentaje = indicador.value * 100 / indicador.meta;
//       return indicador;
//     })


//     historicalBarChart = [
//       {
//           key: "Cumulative Return",
//           values: response
//       }
//   ];

//     nv.addGraph(function() {
//       var chart = nv.models.discreteBarChart()
//           .x(function(d) { return d.label })
//           .y(function(d) { return d.value })
//           .staggerLabels(true)
//           //.staggerLabels(historicalBarChart[0].values.length > 8)
//           .showValues(true)
//           .duration(250)
//           ;

//       d3.select('#chart1 svg')
//           .datum(historicalBarChart)
//           .call(chart);

//       nv.utils.windowResize(chart.update);
//       return chart;
//   });




           
//   }).error(function() {
  
   
//   });

//  }
 
  
// $scope.selectedMeta2 = function(meta)
// {

//   $scope.comuna = 1;
// $scope.instituciones = [];

// var promise = $http.get(base_api + "/metaalcance/" + 1);
// promise.then(
// function(metaalcance) {

//   $scope.metaalcance = metaalcance.data.meta;
//   $scope.nombre_meta = metaalcance.data.nombre_meta;

//   });


  
//     $http.get(base_api + "/graficoindicadores/" + 1)
//     .success(function(response){
//       $scope.indicadoremetas = response;




  
//   $scope.data = data = [
//     {
//         "key": "Avance",
//         "values": $scope.instituciones
//     }]

//   $scope.options = {
//             chart: {
//                 type: 'multiBarChart',
//                 height: 400,
//                 width: 400,
//                 formatNumber: 0,
//                 // x: function(d){return d.label;},
//                 // y: function(d){return d.value;},
//                 showControls: true,
//                 showValues: true,
//                    labels: {
//         items: [{
//             html: 'Total fruit consumption',
//             style: {
//                 left: '50px',
//                 top: '18px',
//                 color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
//             }
//         }]
//     },
//                 // xAxis: {
//                 //     showMaxMin: false
//                 // },
//                 yAxis: {
//                     axisLabel: 'Values',
//                     formatNumber: 0,

//                     tickFormat: function(d){
//                         // return d3.format(',.2f')(d);
//                     }
//                 },
//                 multibar: {
//                   dispatch: {
//                     renderEnd: function (e) {
//                       // d3.select(self.container).selectAll('.nv-bar').attr('width', 40);
//                       // console.log('this fires each time window is resized')
//                     }
//                   }
//                 },
//                 callback: function (chart) {
//                   self = chart;
                  
//                   d3.selectAll('.nv-bar').attr('width', 40);
                  
//                   return chart;
//                 }
//             }
//         };

//  });

//  function formatNumber (n) {
// 	n = String(n).replace(/\D/g, "");
//   return n === '' ? n : Number(n).toLocaleString();
// }

// $scope.selectedValue = "INFORMACIÓN.";
// $scope.indicadores = [];
// console.log($scope.indicadores);
//       $scope.events = {
//         dataplotclick: function(ev, props) {
//           $scope.$apply(function() {
//             $scope.operacion = (props.dataValue * 100) / $scope.metaalcance;
//             $scope.colorValue = "background-color:" + props.categoryLabel + ";";
//             $scope.selectedValue = "AVANCE "  + formatNumber(props.dataValue) + " EQUIVALENTE AL: " + $scope.operacion + "%";
//           });
//         }
//       };


//         $.ajax({
//           url: base_api + "/graficoindicadores/" + 1,
//           type: 'GET',
//           dataType: 'JSON',
//           async: false, 
//         }).success(function(response){
//           $scope.indicadores.push(response);
                 
//         }).error(function() {
        
         
//         });
    
   
//       $scope.dataSource = {
//         "chart": {
//           "caption": "INDICADORES METAS ",
//           "captionFontSize": "16",
//           "captionPadding": "25",
//           "baseFontSize": "14",
//           "canvasBorderAlpha": "0",
//           "showPlotBorder": "0",
//           "placevaluesInside": "1",
//           "valueFontColor": "#2C3E50",
//           "captionFontBold": "0",
//           "bgColor": "white",  ///fondo 
//           "divLineAlpha": "50",
//           "plotSpacePercent": "10",
//           "bgAlpha": "95",
//           "canvasBgAlpha": "0",
//           "outCnvBaseFontColor": "#2C3E50",
//           "showValues": "0",
//           "baseFont": "Open Sans",
//           "paletteColors": "#6495ED, #FF6347, #90EE90, #FFD700, #FF1493",
//           "theme": "zune",
          
//           // tool-tip customization
//           "toolTipBorderColor": "#2C3E50",
//           "toolTipBorderThickness": "1",
//           "toolTipBorderRadius": "2",
//           "toolTipBgColor": "#000000",
//           "toolTipBgAlpha": "70",
//           "toolTipPadding": "12",
//           "toolTipSepChar": " Avance: ",

//           // axis customization
//           "xAxisNameFontSize": "16",
//           "yAxisNameFontSize": "16",
//           "xAxisNamePadding": "10",
//           "yAxisNamePadding": "10",
//           // "xAxisName": "Colors",
//           "yAxisName": "Valores",
//           "xAxisNameFontBold": "0",
//           "yAxisNameFontBold": "0",
//           "showXAxisLine": "1",
//           "xAxisLineColor": "#999999",
//           "formatNumber": "0",

//         },

//         "data": $scope.indicadores
//       };

// }


});


