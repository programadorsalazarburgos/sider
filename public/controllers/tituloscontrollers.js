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
/******/ 	return __webpack_require__(__webpack_require__.s = 19);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/titulos/CreateTituloCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateTituloCtrl", function ($scope, TituloService, fileUpload, $http, $location, base_api) {
    $scope.title = "Agregar Titulo";
    $scope.disable_submit = false;
    $scope.serie = {};

    $scope.formsubmit = function (isValid) {

        if (isValid) {

            var midata = new FormData();
            var descripcion = $scope.descripcion;

            midata.append('descripcion', descripcion);

            $.ajax({
                url: base_api + '/posttitulo/create',
                type: 'POST',
                contentType: false,
                data: midata, // mandamos el objeto formdata que se igualo a la variable data
                processData: false,
                cache: false,
                success: function success(respuestaAjax) {
                    swal("Almacenado!", "Registro Guardado.", "success");
                    window.location = "/admin/posttitulos#/admin/posttitulos";
                }
            });
        }
    };
});

/***/ }),

/***/ "./resources/assets/controllers/titulos/EditarTituloCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarTituloCtrl", function ($scope, TituloService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
    $scope.title = "Editar Titulo";
    $scope.series = [];
    $scope.getData = function () {
        $scope.serie = TituloService.get({ id: $routeParams.id });
    };

    $scope.getData();
    $scope.formsubmit = function (id, isValid) {

        if (isValid) {

            var midata = new FormData();
            var descripcion = $scope.serie.descripcion;

            midata.append('descripcion', descripcion);

            $.ajax({
                url: base_api + '/posttitulos/editarTitulo/' + id,
                type: 'POST',
                contentType: false,
                data: midata, // mandamos el objeto formdata que se igualo a la variable data
                processData: false,
                cache: false,
                success: function success(respuestaAjax) {
                    swal("Almacenado!", "Registro Actualizado.", "success");
                    window.location = "/admin/posttitulos#/admin/posttitulos";
                }
            });
        }
    };
});

/***/ }),

/***/ "./resources/assets/controllers/titulos/TitulosCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('TitulosCrtl', function ($scope, $routeParams, $location, TituloService, $http, $timeout, base_api) {

	$scope.title = "Titulos";
	$scope.series = [];

	$scope.getData = function () {
		$http.get(base_api + "/admin/posttitulos").success(function (response) {
			$scope.list = response;
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
	$scope.series = TituloService.query();

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
		}).then(function (isConfirm) {
			if (isConfirm.value != undefined && isConfirm.value) {

				$.ajax({
					url: base_api + '/eliminar/titulo/' + id,
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

/***/ 19:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/titulos/TitulosCrtl.js");
__webpack_require__("./resources/assets/controllers/titulos/CreateTituloCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/titulos/EditarTituloCtrl.js");


/***/ })

/******/ });