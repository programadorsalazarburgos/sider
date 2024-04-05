/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 17);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/indicadores/CreateIndicadorCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateIndicadorCtrl", function ($scope, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q) {

  $scope.reset = function () {
    $scope.state = undefined;
  };

  var year = new Date().getFullYear();
  var range = [];
  range.push(year);
  for (var i = 1; i < 7; i++) {
    range.push(year + i);
  }
  $scope.years = range;

  $http.get(base_api + "/obtener/metasanualidad").success(function (metas) {
    $scope.metas = metas;
  });

  $scope.meses = [{ id: 'Enero', nombre: 'Enero' }, { id: 'Febrero', nombre: 'Febrero' }, { id: 'Marzo', nombre: 'Marzo' }, { id: 'Abril', nombre: 'Abril' }, { id: 'Mayo', nombre: 'Mayo' }, { id: 'Junio', nombre: 'Junio' }, { id: 'Julio', nombre: 'Julio' }, { id: 'Agosto', nombre: 'Agosto' }, { id: 'Septiembre', nombre: 'Septiembre' }, { id: 'Octubre', nombre: 'Octubre' }, { id: 'Noviembre', nombre: 'Noviembre' }, { id: 'Diciembre', nombre: 'Diciembre' }];

  $scope.alcance = false;
  $scope.selectedMeta = function (meta) {

    $http.get(base_api + "/obtener/alcancemeta/" + meta).success(function (alcancemeta) {
      $scope.alcancemeta = alcancemeta.meta;
      $scope.mes = '';
      $scope.alcance = true;
    });
  };

  $scope.selectedMes = function (mes) {
    $http.get(base_api + "/obtener/indicadormeta/" + mes + "/" + $scope.meta).success(function (respuesta) {
      $scope.serie = respuesta;
      swal("Registro existente!", "Este indicador ya existe puedes actualizarlo", "success");
    });
  };

  $scope.title = "Creacion Meta";
  $scope.formsubmit = function () {

    var datos = {

      meta: $scope.meta,
      mes: $scope.mes,
      avance: $scope.serie.avance_meta,
      descripcion: $scope.serie.descripcion

    };

    $.ajax({
      url: base_api + '/postindicadormeta/create',
      type: 'POST',
      dataType: 'JSON',
      data: {
        datos: datos
      }

    }).success(function () {
      swal("Muy bien!", "Su registro ha sido exitoso", "success");
      toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
      window.location = "/admin/postindicadores";
    }).error(function () {
      swal("Registro existente!", "Este registro ya existe", "error");
      toastr.error("Este registro ya existe", "Registro Existente");
    });
  };
});

/***/ }),

/***/ "./resources/assets/controllers/indicadores/EditarIndicadorCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarMetaCtrl", function ($scope, MetasService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Editar Meta";
  $scope.series = [];
  $scope.getData = function () {
    $http.get(base_api + "/admin/postmetas/" + $routeParams.id).success(function (metas) {
      $scope.serie = metas;
      $scope.anualidad = $scope.serie.periodo;
    });
  };

  $scope.getData();
  var year = new Date().getFullYear();
  var range = [];
  range.push(year);
  for (var i = 1; i < 7; i++) {
    range.push(year + i);
  }
  $scope.years = range;

  $http.get(base_api + "/obtener/programaselect").success(function (programas) {

    $scope.programas = programas;
  });

  $scope.data = {
    'id': 1,
    'unit': 14
  };

  $scope.formsubmit = function (id, isValid) {

    if (isValid) {

      var midata = new FormData();
      var nombre_meta = $scope.serie.nombre_meta;
      var programa = $scope.data.unit;
      var anualidad = $scope.anualidad;
      var meta = $scope.serie.meta;
      var descripcion = $scope.serie.descripcion;

      midata.append('nombre_meta', nombre_meta);
      midata.append('programa', programa);
      midata.append('anualidad', anualidad);
      midata.append('meta', meta);
      midata.append('descripcion', descripcion);

      $.ajax({
        url: base_api + '/postmeta/editar/' + id,
        type: 'POST',
        contentType: false,
        data: midata, // mandamos el objeto formdata que se igualo a la variable data
        processData: false,
        cache: false,
        success: function success(respuestaAjax) {
          swal("Almacenado!", "Registro Actualizado.", "success");
          window.location = "/admin/postmetas#/admin/postmetas";
        }
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/indicadores/GraficoIndicadorCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller('GraficoIndicadorCtrl', function ($scope, $routeParams, $location, $http, $timeout, base_api) {

  $scope.title = "Indicadores Metas";
  $scope.comuna = $routeParams.id;
  $scope.instituciones = [];
  $http.get(base_api + "/metaalcance/" + $routeParams.id).success(function (metaalcance) {

    $scope.metaalcance = metaalcance.meta;
    $scope.nombre_meta = metaalcance.nombre_meta;
  });

  $http.get(base_api + "/graficoindicadores/" + $routeParams.id).success(function (response) {
    $scope.indicadoremetas = response;
    console.log($scope.indicadoremetas);
    var self;

    $scope.data = data = [{
      "key": "Avance",
      "values": $scope.instituciones
    }];

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
              color: Highcharts.theme && Highcharts.theme.textColor || 'black'
            }
          }]
        },
        // xAxis: {
        //     showMaxMin: false
        // },
        yAxis: {
          axisLabel: 'Values',
          formatNumber: 0,

          tickFormat: function tickFormat(d) {
            // return d3.format(',.2f')(d);
          }
        },
        multibar: {
          dispatch: {
            renderEnd: function renderEnd(e) {
              // d3.select(self.container).selectAll('.nv-bar').attr('width', 40);
              // console.log('this fires each time window is resized')
            }
          }
        },
        callback: function callback(chart) {
          self = chart;

          d3.selectAll('.nv-bar').attr('width', 40);

          return chart;
        }
      }
    };
  });

  function formatNumber(n) {
    n = String(n).replace(/\D/g, "");
    return n === '' ? n : Number(n).toLocaleString();
  }

  $scope.selectedValue = "INFORMACIÓN.";
  $scope.indicadores = [];
  $scope.events = {
    dataplotclick: function dataplotclick(ev, props) {
      $scope.$apply(function () {
        $scope.operacion = props.dataValue * 100 / $scope.metaalcance;
        $scope.colorValue = "background-color:" + props.categoryLabel + ";";
        $scope.selectedValue = "AVANCE " + formatNumber(props.dataValue) + " EQUIVALENTE AL: " + $scope.operacion + "%";
      });
    }
  };
  $http.get(base_api + "/graficoindicadores/" + $routeParams.id).success(function (response) {
    $scope.indicadores.push(response);
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
      "bgColor": "white", ///fondo 
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
      "formatNumber": "0"

    },

    "data": $scope.indicadores
  };
});

/***/ }),

/***/ "./resources/assets/controllers/indicadores/IndicadoresCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('IndicadoresCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api) {

    //
    $scope.title = "Indicadores";
    $scope.series = [];

    $scope.getData = function () {
        $http.get(base_api + "/admin/postindicadores").success(function (response) {
            $scope.list = response;
            console.log(response);
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter
            $scope.totalItems = $scope.list.length;
        });
    };

    $scope.pageSize = 50;

    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function () {
        $timeout(function () {
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function (predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

    $scope.getData();
});

/***/ }),

/***/ 17:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/indicadores/IndicadoresCrtl.js");
__webpack_require__("./resources/assets/controllers/indicadores/CreateIndicadorCtrl.js");
__webpack_require__("./resources/assets/controllers/indicadores/EditarIndicadorCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/indicadores/GraficoIndicadorCtrl.js");


/***/ })

/******/ });