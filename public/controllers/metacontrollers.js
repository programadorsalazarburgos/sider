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
/******/ 	return __webpack_require__(__webpack_require__.s = 16);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/metas/CreateMetaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateMetaCtrl", function ($scope, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q) {

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

  $http.get(base_api + "/obtener/programaselect").success(function (programas) {

    $scope.programas = programas;
  });

  $scope.title = "Creacion Meta";
  $scope.formsubmit = function () {

    var datos = {

      nombre_meta: $scope.nombre_meta,
      programa: $scope.programa,
      anualidad: $scope.anualidad,
      cantidad_meta: $scope.cantidad_meta,
      descripcion: $scope.descripcion

    };

    $.ajax({
      url: base_api + '/postmeta/create',
      type: 'POST',
      dataType: 'JSON',
      data: {
        datos: datos
      }

    }).success(function () {
      swal("Muy bien!", "Su registro ha sido exitoso", "success");
      toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
      window.location = "/admin/postmetas";
    }).error(function () {
      swal("Registro existente!", "Este registro ya existe", "error");
      toastr.error("Este registro ya existe", "Registro Existente");
    });
  };
});

/***/ }),

/***/ "./resources/assets/controllers/metas/EditarMetaCtrl.js":
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

/***/ "./resources/assets/controllers/metas/MetasCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('MetasCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api) {

  //
  $scope.title = "Metas";
  $scope.series = [];

  $scope.getData = function () {
    $http.get(base_api + "/admin/postmetas").success(function (response) {
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
  $scope.eliminar = function (id) {

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
    }, function (isConfirm) {
      if (isConfirm) {

        $.ajax({
          url: base_api + '/eliminar/meta/' + id,
          type: 'POST',
          dataType: 'JSON'

        }).success(function (response) {
          swal("Eliminado!", "Registro Eliminado.", "success");
          $scope.getData();
        });
      } else {
        swal("Cancelado", "No elimino su registro :)", "error");
      }
    });
  };
});

/***/ }),

/***/ 16:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/metas/MetasCrtl.js");
__webpack_require__("./resources/assets/controllers/metas/CreateMetaCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/metas/EditarMetaCtrl.js");


/***/ })

/******/ });