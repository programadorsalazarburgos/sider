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
/******/ 	return __webpack_require__(__webpack_require__.s = 25);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/lugar/CreateLugarCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateLugarCtrl", function ($scope, LugarService, fileUpload, $http, $location, base_api) {
    $scope.title = "Agregar Lugar";
    $scope.disable_submit = false;
    $scope.serie = {};

    $http.get(base_api + "/obtener/barrios").success(function (response) {
        $scope.barrios = response;
    });

    $scope.selectedBarrio = function (itemBarrio) {
        $http.get(base_api + "/obtener/estrato/" + itemBarrio).success(function (estratobeneficiario) {
            console.log(estratobeneficiario);
            $scope.comuna = estratobeneficiario.nombre_comuna;
            $scope.comuna_id = estratobeneficiario.comuna_id;
        });
    };

    $http.get(base_api + "/obtener/corregimientos/").success(function (response) {
        $scope.corregimientos = response;
    });

    $scope.selectedCorregimiento = function (itemCorregimiento) {

        var promise = $http.get(base_api + "/obtener/veredas/" + itemCorregimiento);
        promise.then(function (responseveredas) {
            $scope.veredas = responseveredas.data;
        });
    };

    $http.get(base_api + "/obtener/lugaresall/").success(function (response) {
        $scope.lugares = response;
        console.log($scope.lugares);
    });

    $scope.getVal = function () {

        console.log($scope.content);
        if ($scope.content == 'urbano') {
            $scope.corregimiento = '';
            $scope.vereda = '';
        }
        if ($scope.content == 'rural') {
            $scope.barrio = '';
            $scope.comuna = '';
            $scope.comuna_id = '';
        }
    };

    $scope.observaciones = '';
    $scope.formsubmit = function (isValid) {

        if (isValid) {

            var midata = new FormData();
            var lugar = $scope.lugar;
            var barrio = $scope.barrio;
            var comuna_id = $scope.comuna_id;
            var corregimiento = $scope.corregimiento;
            var vereda = $scope.vereda;
            var direccion = $scope.direccion;
            var observaciones = $scope.observaciones;
            var tipo_punto_atencion = $scope.tipo_punto_atencion;

            midata.append('lugar', lugar);
            midata.append('barrio', barrio);
            midata.append('comuna_id', comuna_id);
            midata.append('direccion', direccion);
            midata.append('observaciones', observaciones);
            midata.append('corregimiento', corregimiento);
            midata.append('vereda', vereda);
            midata.append('tipo_punto_atencion', tipo_punto_atencion);

            $.ajax({
                url: base_api + '/postlugar/create',
                type: 'POST',
                contentType: false,
                data: midata, // mandamos el objeto formdata que se igualo a la variable data
                processData: false,
                cache: false,
                success: function success(respuestaAjax) {
                    swal("Almacenado!", "Registro Guardado.", "success");
                    window.location = "/admin/postlugares#/admin/postlugares";
                },
                error: function error(respuestaAjax) {
                    swal("Error!", "Nombre Lugar ya existe.", "error");
                }

            });
        }
    };
});

/***/ }),

/***/ "./resources/assets/controllers/lugar/EditarLugarCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarLugarCtrl", function ($scope, LugarService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
    $scope.title = "Editar Lugar";
    $scope.series = [];
    $scope.getData = function () {
        $http.get(base_api + "/admin/postlugares/" + $routeParams.id).success(function (response) {
            $scope.serie = response;
            $scope.barrio = response.barrio_id;
            $scope.comuna_id = response.comuna_id;
            $scope.comuna = response.nombre_comuna;
            $scope.corregimiento = response.corregimiento_id;
            $scope.vereda = response.vereda_id;
            $scope.lugar = response.nombre_lugar;
            $scope.value = 'urbano';
            $scope.variable = 'urbano';
            if ($scope.barrio != null) {
                $scope.contenido = 1;
            }
            if ($scope.corregimiento != null) {
                $scope.contenido = 2;
            }
        });
    };

    $http.get(base_api + "/obtener/barrios").success(function (response) {
        $scope.barrios = response;
    });

    $scope.selectedBarrio = function (itemBarrio) {

        $http.get(base_api + "/obtener/estrato/" + itemBarrio).success(function (estratobeneficiario) {
            console.log(estratobeneficiario);
            $scope.comuna = estratobeneficiario.nombre_comuna;
            $scope.comuna_id = estratobeneficiario.comuna_id;
        });
    };

    $http.get(base_api + "/obtener/corregimientos/").success(function (response) {
        $scope.corregimientos = response;
    });

    $scope.selectedCorregimiento = function (itemCorregimiento) {

        var promise = $http.get(base_api + "/obtener/veredas/" + itemCorregimiento);
        promise.then(function (responseveredas) {
            $scope.veredas = responseveredas.data;
        });
    };

    $http.get(base_api + "/obtener/lugaresall/").success(function (response) {
        $scope.lugares = response;
        console.log($scope.lugares);
    });

    $scope.getData();

    $scope.getVal = function () {

        if ($scope.contenido == 1) {
            $scope.corregimiento = '';
            $scope.vereda = '';
        }
        if ($scope.contenido == 2) {
            $scope.barrio = '';
            $scope.comuna = '';
            $scope.comuna_id = '';
        }
    };

    $scope.formsubmit = function (id, isValid) {

        if (isValid) {

            if ($scope.barrio == undefined) {
                $scope.barrio = '';
            }

            if ($scope.comuna_id == undefined) {
                $scope.comuna_id = '';
            }

            if ($scope.corregimiento == undefined) {

                $scope.corregimiento = '';
            }

            if ($scope.vereda == undefined) {
                $scope.vereda = '';
            }

            var midata = new FormData();
            var lugar = $scope.lugar;
            var barrio = $scope.barrio;
            var comuna_id = $scope.comuna_id;
            var corregimiento = $scope.corregimiento;
            var vereda = $scope.vereda;
            var direccion = $scope.serie.direccion;
            var observaciones = $scope.serie.observaciones;
            var tipo_punto_atencion = $scope.serie.tipo_punto_atencion;

            midata.append('lugar', lugar);
            midata.append('barrio', barrio);
            midata.append('comuna_id', comuna_id);
            midata.append('corregimiento', corregimiento);
            midata.append('vereda', vereda);
            midata.append('direccion', direccion);
            midata.append('observaciones', observaciones);
            midata.append('tipo_punto_atencion', tipo_punto_atencion);

            $.ajax({
                url: base_api + '/postlugares/editarLugar/' + id,
                type: 'POST',
                contentType: false,
                data: midata, // mandamos el objeto formdata que se igualo a la variable data
                processData: false,
                cache: false,
                success: function success(respuestaAjax) {
                    swal("Almacenado!", "Registro Actualizado.", "success");
                    window.location = "/admin/postlugares#/admin/postlugares";
                }
            });
        }
    };
});

/***/ }),

/***/ "./resources/assets/controllers/lugar/LugaresCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('LugaresCrtl', function ($scope, $routeParams, $location, LugarService, $http, $timeout, base_api) {

  $scope.title = "Lugares";
  $scope.series = [];

  $scope.getData = function () {
    $http.get(base_api + "/admin/postlugares").success(function (response) {
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
  $scope.series = LugarService.query();

  $scope.inactivar = function (id) {

    Swal.fire({ title: 'Desea inactivar este registro?', showCancelButton: true }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: base_api + '/inactivar/lugar/' + id,
          type: 'POST',
          dataType: 'JSON'

        }).success(function (response) {

          Swal.fire('Inactivado!', 'Registro Inactivado', 'success');
          $scope.getData();
        });
      } else {

        Swal.fire({
          title: 'Cancelado!',
          text: 'No inactivo su registro :)',
          type: 'error',
          confirmButtonText: 'Cool'
        });
      }
    });
  };

  $scope.activar = function (id) {

    Swal.fire({ title: 'activaras este lugar de Atención?', showCancelButton: true }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: base_api + '/activar/lugar/' + id,
          type: 'POST',
          dataType: 'JSON'

        }).success(function (response) {

          Swal.fire('Activado!', 'Registro activado', 'success');
          $scope.getData();
        });
      } else {

        Swal.fire({
          title: 'Cancelado!',
          text: 'No activo su registro :)',
          type: 'error',
          confirmButtonText: 'Cool'
        });
      }
    });
  };
});

/***/ }),

/***/ 25:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/lugar/LugaresCrtl.js");
__webpack_require__("./resources/assets/controllers/lugar/CreateLugarCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/lugar/EditarLugarCtrl.js");


/***/ })

/******/ });