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
/******/ 	return __webpack_require__(__webpack_require__.s = 26);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/disciplina/CreateDisciplinaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateDisciplinaCtrl", function ($scope, DisciplinaService, fileUpload, $http, $location, base_api) {
    $scope.title = "Agregar Disciplina";
    $scope.disable_submit = false;
    $scope.serie = {};

    $scope.descripcion = '';

    $scope.formsubmit = function (isValid) {

        if (isValid) {

            var midata = new FormData();
            var nombre_disciplina = $scope.nombre_disciplina;
            var descripcion = $scope.descripcion;

            midata.append('nombre_disciplina', nombre_disciplina);
            midata.append('descripcion', descripcion);

            $.ajax({
                url: base_api + '/postdisciplina/create',
                type: 'POST',
                contentType: false,
                data: midata, // mandamos el objeto formdata que se igualo a la variable data
                processData: false,
                cache: false,
                success: function success(respuestaAjax) {
                    swal("Almacenado!", "Registro Guardado.", "success");
                    window.location = "/admin/postdisciplinas#/admin/postdisciplinas";
                },
                error: function error(respuestaAjax) {
                    swal("Error!", "Nombre Disciplina ya existe.", "error");
                }

            });
        }
    };
});

/***/ }),

/***/ "./resources/assets/controllers/disciplina/DisciplinasCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('DisciplinasCrtl', function ($scope, $routeParams, $location, DisciplinaService, $http, $timeout, base_api) {

  $scope.title = "Disciplinas";
  $scope.series = [];

  $scope.getData = function () {
    $http.get(base_api + "/admin/postdisciplinas").success(function (response) {
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
  $scope.series = DisciplinaService.query();

  $scope.inactivar = function (id) {

    swal({
      title: "Estas seguro?",
      text: "Inactivaras esta disciplina!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Inactivalo!",
      cancelButtonText: "No, lo Inactive!",
      closeOnConfirm: false,
      closeOnCancel: false
    }, function (isConfirm) {
      if (isConfirm) {

        $.ajax({
          url: base_api + '/inactivar/disciplinas/' + id,
          type: 'POST',
          dataType: 'JSON'

        }).success(function (response) {
          swal("Inactivado!", "Registro Inactivado.", "success");
          $scope.getData();
        });
      } else {
        swal("Cancelado", "No inactivo su registro :)", "error");
      }
    });
  };

  $scope.activar = function (id) {

    swal({
      title: "Estas seguro?",
      text: "activaras esta disciplina!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, activalo!",
      cancelButtonText: "No, lo active!",
      closeOnConfirm: false,
      closeOnCancel: false
    }, function (isConfirm) {
      if (isConfirm) {

        $.ajax({
          url: base_api + '/activar/disciplinas/' + id,
          type: 'POST',
          dataType: 'JSON'

        }).success(function (response) {
          swal("Activado!", "Registro activado.", "success");
          $scope.getData();
        });
      } else {
        swal("Cancelado", "No activo su registro :)", "error");
      }
    });
  };
});

/***/ }),

/***/ "./resources/assets/controllers/disciplina/EditarDisciplinaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarDisciplinaCtrl", function ($scope, DisciplinaService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Editar Disciplina";
  $scope.series = [];
  $scope.getData = function () {
    $http.get(base_api + "/admin/postdisciplinas/" + $routeParams.id).success(function (response) {
      $scope.serie = response;
    });
  };

  $scope.getData();
  $scope.formsubmit = function (id, isValid) {

    if (isValid) {

      var midata = new FormData();
      var nombre_disciplina = $scope.serie.nombre_disciplina;
      var descripcion = $scope.serie.descripcion;

      midata.append('nombre_disciplina', nombre_disciplina);
      midata.append('descripcion', descripcion);

      $.ajax({
        url: base_api + '/postdisciplinas/editarDisciplina/' + id,
        type: 'POST',
        contentType: false,
        data: midata, // mandamos el objeto formdata que se igualo a la variable data
        processData: false,
        cache: false,
        success: function success(respuestaAjax) {
          swal("Almacenado!", "Registro Actualizado.", "success");
          window.location = "/admin/postdisciplinas#/admin/postdisciplinas";
        }
      });
    }
  };
});

/***/ }),

/***/ 26:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/disciplina/CreateDisciplinaCtrl.js");
__webpack_require__("./resources/assets/controllers/disciplina/EditarDisciplinaCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/disciplina/DisciplinasCrtl.js");


/***/ })

/******/ });