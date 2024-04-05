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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/roles/PermisosRolesCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("PermisosRolesCtrl", function ($scope, RoleService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Visualizar  cuentas";
  $scope.form_title = "User Detail";
  $scope.series = [];
  $scope.getData = function () {
    $scope.serie = RoleService.get({ id: $routeParams.id });
  };
  $scope.role = $routeParams.id;
  $http.get(base_api + "/admin/postroles/" + $scope.role).success(function (response) {
    $scope.rol = response;
  });
  $http.get(base_api + "/ObtenerPermisos/Rol/").success(function (response) {

    $scope.myData = [];
    $scope.mySelectedData = [];
    var permisos = response;

    $http.get(base_api + "/ObtenerPermisos/Rol/" + $routeParams.id).success(function (response) {

      var permisosID = response;

      for (var i = 0; i < permisos.length; i++) {
        var uno = [permisos[i].id];
        var dos = [permisos[i].name];
        var alphaNumeric1 = uno.concat(dos);
        $scope.myData.push(alphaNumeric1);

        for (var e = 0; e < permisosID.length; e++) {
          var tres = [permisosID[e].id];
          var cuatro = [permisosID[e].name];
          var alphaNumeric2 = tres.concat(cuatro);
          if (alphaNumeric1[0] == alphaNumeric2[0]) {
            $scope.mySelectedData.push(alphaNumeric2);
            var prueba2 = $scope.myData.splice(_.indexOf($scope.myData, _.findWhere($scope.myData, [1, $scope.mySelectedData])), 1);
          }
        }
      }
    });
  });
});

/***/ }),

/***/ "./resources/assets/controllers/roles/RolesCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('RolesCrtl', function ($scope, $routeParams, $location, RoleService, $http, $timeout, base_api) {

  $scope.title = "Roles y Permisos";
  $scope.series = [];

  $scope.getData = function () {
    $http.get(base_api + "/admin/postroles").success(function (response) {
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
  $scope.series = RoleService.query();

  $scope.toggle = function (modalstate) {
    $scope.modalstate = modalstate;
    switch (modalstate) {
      case 'CrearRol':
        $scope.titulo = "CREACIÓN";
        $scope.form_title = "Formulario Rol";
        $scope.metodo = 1;
        break;

    }

    $('#myModal').modal('show');
  };

  $scope.EditarRol = function (modalstate, id) {

    $scope.modalstate = modalstate;
    switch (modalstate) {
      case 'editar':
        $scope.titulo = "EDITAR";
        $scope.form_title = "Formulario Rol";
        $scope.metodo = 2;
        $scope.valor = id;
        $http.get(base_api + "/obtener/rol/" + id).success(function (response) {
          $scope.serie = response;
        });

        break;

    }

    $('#myModal').modal('show');
  };

  $scope.GuardarRol = function () {

    var midata = new FormData();
    var nombre = $scope.serie.name;
    var descripcion = $scope.serie.description;
    midata.append('nombre', nombre);
    midata.append('descripcion', descripcion);

    $.ajax({
      url: base_api + '/guardar/rol',
      type: 'POST',
      contentType: false,
      data: midata, // mandamos el objeto formdata que se igualo a la variable data
      processData: false,
      cache: false,
      success: function success(respuestaAjax) {
        swal("Almacenado!", "Registro Guardado.", "success");
        $scope.getData();
        $('#myModal').modal('hide');
      }
    });
  };

  $scope.ActualizarRol = function (valor) {

    var midata = new FormData();
    var nombre = $scope.serie.name;
    var descripcion = $scope.serie.description;
    midata.append('nombre', nombre);
    midata.append('descripcion', descripcion);

    $.ajax({
      url: base_api + '/actualizar/rol/' + valor,
      type: 'POST',
      contentType: false,
      data: midata, // mandamos el objeto formdata que se igualo a la variable data
      processData: false,
      cache: false,
      success: function success(respuestaAjax) {
        swal("Almacenado!", "Registro Guardado.", "success");
        $scope.getData();
        $('#myModal').modal('hide');
      }
    });
  };

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
          url: base_api + '/eliminar/rol/' + id,
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

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/roles/RolesCrtl.js");
module.exports = __webpack_require__("./resources/assets/controllers/roles/PermisosRolesCtrl.js");


/***/ })

/******/ });