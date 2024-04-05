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
/******/ 	return __webpack_require__(__webpack_require__.s = 27);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/programa/CreateProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateProgramaCtrl", function ($scope, ProgramaService, fileUpload, $http, $location, base_api) {
    $scope.title = "Agregar Programa";
    $scope.disable_submit = false;

    $scope.serie = {};

    $scope.formsubmit = function (isValid) {

        if (isValid) {

            $scope.loading = true;
            var file = $scope.myFile;
            var uploadUrl = base_api + "/postprograma/create";
            var nombre_programa = $scope.nombre_programa;
            var descripcion_programa = $scope.descripcion_programa;
            fileUpload.uploadFileToUrl(file, uploadUrl, nombre_programa, descripcion_programa);
        }
    };
});

/***/ }),

/***/ "./resources/assets/controllers/programa/EditarProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarProgramaCtrl", function ($scope, ProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
    $scope.title = "Editar Programa";
    $scope.series = [];
    $scope.getData = function () {
        $scope.serie = ProgramaService.get({ id: $routeParams.id });
    };

    $scope.getData();

    $scope.formsubmit = function (id) {
        $scope.loading = true;
        var file = $scope.myFile;
        var nombre_programa = $scope.serie.nombre_programa;
        var descripcion_programa = $scope.serie.descripcion_programa;
        var uploadUrl = base_api + "/postprogramas/editarPrograma/" + id;
        fileUpload.uploadFileToUrl(file, uploadUrl, nombre_programa, descripcion_programa);
    };
});

/***/ }),

/***/ "./resources/assets/controllers/programa/ProgramasCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('ProgramasCrtl', function ($scope, $routeParams, $location, ProgramaService, $http, $timeout, base_api) {

  $scope.title = "Programas";
  $scope.series = [];

  $scope.getData = function () {
    $http.get(base_api + "/admin/postprogramas").success(function (response) {
      $scope.list = response;
      $scope.currentPage = 1; //current page
      $scope.entryLimit = 15; //max no of items to display in a page
      $scope.filteredItems = $scope.list.length; //Initially for no filter
      $scope.totalItems = $scope.list.length;
    });
  };

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
  $scope.series = ProgramaService.query();

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
          url: base_api + '/eliminar/programa/' + id,
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

/***/ 27:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/programa/ProgramasCrtl.js");
__webpack_require__("./resources/assets/controllers/programa/CreateProgramaCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/programa/EditarProgramaCtrl.js");


/***/ })

/******/ });