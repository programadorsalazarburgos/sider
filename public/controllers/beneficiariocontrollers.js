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
/******/ 	return __webpack_require__(__webpack_require__.s = 24);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/beneficiario/BeneficiariosCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('BeneficiariosCrtl', function ($scope, $routeParams, $location, BeneficiarioService, $http, $timeout, base_api) {

  $scope.title = "Beneficiarios";
  $scope.series = [];

  $scope.opts = {
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true
  };

  $.datepicker.setDefaults($.datepicker.regional['es']);

  $scope.getData = function () {
    $http.get(base_api + "/admin/postbeneficiarioslistado").success(function (response) {
      $scope.list = response;
      // console.log($scope.list);
      $scope.currentPage = 1; //current page
      $scope.entryLimit = 5; //max no of items to display in a page
      $scope.filteredItems = $scope.list.length; //Initially for no filter
      $scope.totalItems = $scope.list.length;
    });
  };

  $scope.pageSize = 50;

  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {

    $scope.tipo_documento = response;
  });

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

    $scope.comunas = response;
  });

  $http.get(base_api + "/obtener/corregimientos").success(function (response) {

    $scope.corregimientos = response;
  });

  $scope.ocupaciones = [{ id: 1, nombre: 'Ama de casa' }, { id: 2, nombre: 'Empleado' }, { id: 3, nombre: 'Estudiante' }, { id: 4, nombre: 'Desempleado' }, { id: 5, nombre: 'Independiente' }, { id: 6, nombre: 'Pensionado-Jubilado' }, { id: 7, nombre: 'Servidor Público' }];

  $http.get(base_api + "/obtenerselect/escolaridades").success(function (response) {

    $scope.escolaridades = response;
  });

  $scope.culturas = [{ id: 1, nombre: 'Negro' }, { id: 2, nombre: 'Blanco' }, { id: 3, nombre: 'Índigena' }, { id: 4, nombre: 'Mestizo' }, { id: 5, nombre: 'Mulato' }, { id: 6, nombre: 'ROM, Gitano' }, { id: 7, nombre: 'Palenquero' }, { id: 8, nombre: 'Raizal' }, { id: 9, nombre: 'No sabe-No responde' }];

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (response) {

    $scope.discapacidadades = response;
  });

  $scope.sort = function (keyname) {
    $scope.sortKey = keyname; //set the sortKey to the param passed
    $scope.reverse = !$scope.reverse; //if true make it false and vice versa
  };

  $scope.setPage = function (pageNo) {
    $scope.currentPage = pageNo;
    console.log($scope.currentPage);
  };
  $scope.filter = function () {
    $timeout(function () {
      $scope.filteredItems = $scope.filtered.length;
      console.log($scope.filteredItems);
    }, 10);
  };
  $scope.sort_by = function (predicate) {
    $scope.predicate = predicate;
    $scope.reverse = !$scope.reverse;
  };

  $scope.getData();
  $scope.series = BeneficiarioService.query();

  $scope.toggle = function (modalstate, id) {
    $scope.modalstate = modalstate;
    switch (modalstate) {

      case 'AgregarGrupo':
        $scope.form_contenido = "GRUPOS";
        $scope.form_title = "obtener";
        $scope.id = id;

        break;
      default:
        break;
    }

    $('#myModal').modal('show');
  };

  $http.get(base_api + "/obtener/allmonitores").success(function (response) {
    $scope.monitores = response;
  });

  $scope.selectedMonitor = function (item) {

    $http.get(base_api + "/obtener/gruposmonitor/" + item).success(function (response) {

      $scope.monitores_grupo = response;
    });
  };

  $scope.formAsociar = function (isValid, id) {

    if (isValid) {

      $.ajax({
        url: base_api + '/postbeneficiario/asociargrupo/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {
          grupo_id: $scope.grupo_monitor
        }

      }).success(function () {

        $scope.getData();
        toastr.success("Su registro ha sido exitoso", "Grupo Asociado");
        window.location = "/admin/postbeneficiarios#/admin/postbeneficiarios";
      }).error(function () {
        console.log("success");
      });
    }
  };

  $scope.SacarGrupo = function (id) {
    swal({
      title: "Sacar del Grupo?",
      text: "Desea sacar del grupo a este beneficiario!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Sacalo!",
      cancelButtonText: "No, cancela!",
      closeOnConfirm: false,
      closeOnCancel: false
    }, function (isConfirm) {
      if (isConfirm) {

        $.ajax({
          url: base_api + '/eliminar/grupo/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: { param1: 'value1' }
        }).success(function () {
          swal("Eliminado!", "Has sacado del grupo este beneficiario.", "success");
          $scope.getData();
        });
      } else {
        swal("Cancelado", "Has decidido que no sacarlo del grupo :)", "error");
      }
    });
  };

  $scope.exportarPrueba = function () {

    // $http.get(base_api + "/items/export")
    //     .success(function(response){


    //   });

    // $http({
    //    method: 'POST',
    //    url: base_api + "/items/export",
    //    dataType: 'json',
    //    // data: {
    //    //     data:data
    //    // },
    //    responseType: 'arraybuffer',
    //    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    // }).success(function (data) {
    //    // var blob = new Blob([data], {type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"});

    //    // saveAs(blob, title + ".xlsx");
    // }).error(function (data) {
    //    console.log("failed");
    // });

    var data = 1;

    $http({
      method: 'POST',
      url: base_api + "/items/export",
      dataType: 'json',
      data: {
        data: data
      },
      responseType: 'arraybuffer',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    }).success(function (data) {
      var blob = new Blob([data], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });

      saveAs(blob, title + ".xlsx");
    }).error(function (data) {
      console.log("failed");
    });
  };

  $scope.downloadexcel = function (id) {

    $http({
      method: 'POST',
      url: base_api + "/items/export",
      dataType: 'obj',
      data: 1,
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    }).success(function (data) {
      console.log(data);
    }).error(function (data) {
      console.log("failed");
    });
  };

  $scope.sexo = [{ id: '1', nombre: 'Mujer' }, { id: '2', nombre: 'Hombre' }];

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
          url: base_api + '/eliminar/beneficiario/' + id,
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

  $scope.myDataSource = {
    chart: {
      caption: "Age profile of website visitors",
      subcaption: "Last Year",
      startingangle: "120",
      showlabels: "0",
      showlegend: "1",
      enablemultislicing: "0",
      slicingdistance: "15",
      showpercentvalues: "1",
      showpercentintooltip: "0",
      plottooltext: "Age group : $label Total visit : $datavalue",
      theme: "fint"
    },
    data: [{
      label: "Teenage",
      value: "1250400"
    }, {
      label: "Adult",
      value: "1463300"
    }, {
      label: "Mid-age",
      value: "1050700"
    }, {
      label: "Senior",
      value: "491000"
    }]
  };
});

/***/ }),

/***/ "./resources/assets/controllers/beneficiario/CreateBeneficiarioCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateBeneficiarioCtrl", function ($scope, BeneficiarioService, fileUpload, $http, $location, base_api, $q) {

  $scope.title = "Agregar Beneficiario";
  $scope.disable_submit = false;
  $scope.serie = {};
  $scope.cantidad_hijos = null;
  $scope.ocupacion_otra = null;
  $scope.cultura_otro = null;
  $scope.discapacidad_otro = null;
  $scope.otra_discapacidad = null;
  $scope.otra_enfermedad = null;
  $scope.medicamento_otro = null;
  $scope.salud = null;
  $scope.nombre_entidad = null;
  $scope.otro_parentesco = null;

  $('.formlista').change(function () {
    var direccion = '';
    $.each($('.formlista'), function (index, value) {
      if ($(value).val() != '') {
        direccion = direccion + ' ' + $(value).val();
      }
    });
    $('#id_persona_beneficiario_residencia_direccion').val(direccion);
  });

  $(document).ready(function () {
    $('[name=integer-data-attribute]').maskNumber({ integer: true });
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_nacimiento").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "1940:+nn"
    });
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_nacimiento_acudiente").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_inscripcion").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
  });

  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {

    $scope.tipo_documento = response;
  });

  $scope.onBlurFicha = function ($event) {

    var numero_ficha = $scope.no_ficha;

    $.ajax({
      url: base_api + '/verificar/ficha_beneficiario',
      type: 'GET',
      dataType: 'JSON',
      data: { numero_ficha: numero_ficha },
      async: false
    }).success(function (response) {

      console.log(response);

      $scope.no_ficha = null;
      toastr.warning('Este registro ya se encuentra en el sistema.', 'No Ficha: ' + response.no_ficha);
      $scope.no_ficha = null;
    }).error(function () {

      $('#repetido_ficha').hide();
    });
  };

  $scope.onBlurDocumento = function ($event) {

    var no_documento_beneficiario = $scope.no_documento_persona;

    $.ajax({
      url: base_api + '/verificar/no_documento_beneficiario',
      type: 'GET',
      dataType: 'JSON',
      data: { no_documento_beneficiario: no_documento_beneficiario },
      async: false
    }).success(function (response) {
      console.log(response);
      if (response.length > 0) {

        $scope.no_documento_persona = null;
        toastr.warning('Este registro ya se encuentra en el sistema.', 'No Documento: ' + response[0].documento);
        $scope.no_documento_persona = null;
      }
    }).error(function () {
      $('#repetido_no_documento').hide();
    });
  };

  function calcularEdad(birthday) {
    var birthday_arr = birthday.split("/");
    var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
    var ageDifMs = Date.now() - birthday_date.getTime();
    var ageDate = new Date(ageDifMs);
    return Math.abs(ageDate.getUTCFullYear() - 1970);
  }

  Date.prototype.addDays = function (days) {
    var dat = new Date(this.valueOf());
    dat.setDate(dat.getDate() + days);
    return dat;
  };

  function init() {
    $scope.startDate = new Date();
    $scope.endDate = $scope.startDate.addDays(14);
    $scope.startDateParentesco = new Date();
    $scope.startDateInscripcion = new Date();
    $scope.endDatep = $scope.startDateParentesco.addDays(14);
    $scope.endDateInscripcion = $scope.startDateInscripcion.addDays(14);
  }

  function load() {

    $scope.fecha_nacimiento = $scope.startDate;
    var d = new Date($scope.fecha_nacimiento);
    var fecha = $.datepicker.formatDate('dd/mm/yy', d);
    var n = fecha.toString();
    $scope.edad_beneficiario = calcularEdad(n);
  }

  function load_parentesco() {

    $scope.fecha_nacimiento_pariente = $scope.startDateParentesco;
    var d_pariente = new Date($scope.fecha_nacimiento_pariente);
    var fecha_pariente = $.datepicker.formatDate('dd/mm/yy', d_pariente);
    var n_pariente = fecha_pariente.toString();
    $scope.edad_pariente = calcularEdad(n_pariente);
  }

  init();
  // public methods
  $scope.load = load;
  $scope.load_parentesco = load_parentesco;
  $scope.setStart = function (date) {
    $scope.startDate = date;
    $scope.fecha_nacimiento_beneficiario = $scope.startDate;
    var d_beneficiario = new Date($scope.fecha_nacimiento_beneficiario);
    var fecha_beneficiario = $.datepicker.formatDate('dd/mm/yy', d_beneficiario);
    var n_beneficiario = fecha_beneficiario.toString();
    $scope.edad_beneficiario = calcularEdad(n_beneficiario);
  };

  $scope.setStartInscripcion = function (date) {
    $scope.startDateInscripcion = date;
  };

  $scope.setStartParentesco = function (date) {
    $scope.startDateParentesco = date;
    $scope.fecha_nacimiento_acudiente = $scope.startDateParentesco;
    var d_acudiente = new Date($scope.fecha_nacimiento_acudiente);
    var fecha_acudiente = $.datepicker.formatDate('dd/mm/yy', d_acudiente);
    var n_acudiente = fecha_acudiente.toString();
    $scope.edad_pariente = calcularEdad(n_acudiente);
    console.log($scope.edad_pariente);
  };

  $scope.setEnd = function (date) {
    $scope.endDate = date;
    $scope.endDatep = date;
    $scope.endDateInscripcion = date;
  };

  // $scope.tipo_documento = [
  // {id: '1', nombre: 'Registro Civil'},
  // {id: '2', nombre: 'Tarjeta Identidad'},
  // {id: '3', nombre: 'Cédula de Ciudadanía'},
  // {id: '4', nombre: 'Pasaporte'},
  // {id: '5', nombre: 'Sin Información'},

  // ];

  $scope.sexo = [{ id: '1', nombre: 'Mujer' }, { id: '2', nombre: 'Hombre' }];

  $scope.estado_civil_beneficiario = [{ id: '1', nombre: 'Casado' }, { id: '2', nombre: 'Soltero' }, { id: '3', nombre: 'Unión Libre' }, { id: '4', nombre: 'Viudo' }];

  $scope.tipo_sangre = [{ id: '1', nombre: 'O+' }, { id: '2', nombre: 'O-' }, { id: '3', nombre: 'A+' }, { id: '4', nombre: 'A-' }, { id: '5', nombre: 'B+' }, { id: '6', nombre: 'B-' }, { id: '7', nombre: 'AB+' }, { id: '8', nombre: 'AB-' }];

  $scope.ocupaciones = [{ id: '1', nombre: 'Ama de casa' }, { id: '2', nombre: 'Empleado' }, { id: '3', nombre: 'Estudiante' }, { id: '4', nombre: 'Desempleado' }, { id: '5', nombre: 'Independiente' }, { id: '6', nombre: 'Pensionado-Jubilado' }, { id: '7', nombre: 'Servidor Público' }, { id: '8', nombre: 'Otro' }];

  $http.get(base_api + "/obtenerselect/escolaridades").success(function (response) {

    $scope.escolaridades = response;
  });

  $scope.culturas = [{ id: '1', nombre: 'Negro' }, { id: '2', nombre: 'Blanco' }, { id: '3', nombre: 'Índigena' }, { id: '4', nombre: 'Mestizo' }, { id: '5', nombre: 'Mulato' }, { id: '6', nombre: 'ROM, Gitano' }, { id: '7', nombre: 'Palenquero' }, { id: '8', nombre: 'Raizal' }, { id: '9', nombre: 'No sabe-No responde' }, { id: '10', nombre: 'Otro' }];

  $scope.grupos_poblacionales = [{ id: '1', nombre: 'Adulto Mayor' }, { id: '2', nombre: 'Afrodescendiente/Afrocolombiano' }, { id: '3', nombre: 'Víctimas del conflicto armado' }, { id: '4', nombre: 'Habitante calle' }, { id: '5', nombre: 'LGBTI' }, { id: '6', nombre: 'Persona con discapacidad' }, { id: '7', nombre: 'Grupo organizado de Mujeres' }, { id: '8', nombre: 'Indígenas' }, { id: '9', nombre: 'Reinsertado' }, { id: '10', nombre: 'Junta de acción comunal (JAC)' }, { id: '11', nombre: 'Grupo organizado de Jóvenes' }, { id: '12', nombre: 'Ninguno' }, { id: '13', nombre: 'Recluido' }, { id: '14', nombre: 'Junta de administradora local (JAL)' }, { id: '15', nombre: 'Otro grupo' }];

  $scope.selected = {
    poblacionales: []
  };

  $scope.hijos = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

  $scope.discapacidades = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

  $scope.discapacidad_otra = [{ id: '1', nombre: 'Auditiva' }, { id: '2', nombre: 'Cognitiva' }, { id: '3', nombre: 'Mental' }, { id: '4', nombre: 'Motriz' }, { id: '5', nombre: 'Oral' }, { id: '6', nombre: 'Visual' }];

  $scope.enfermedades = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

  $scope.medicamentos = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

  $scope.medicamentos = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

  $scope.seguridad_social = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

  $scope.salud_sgsss = [{ id: '1', nombre: 'Regimen Contributivo (EPS)' }, { id: '2', nombre: 'Regimen Subsidiado (SISBEN-EPS-S)' }, { id: '3', nombre: 'Especial (FFMM, Policia, etc)' }];

  $scope.parentescos = [{ id: '1', nombre: 'Madre/Padre' }, { id: '2', nombre: 'Hermana/Hermano' }, { id: '3', nombre: 'Tia/Tio' }, { id: '4', nombre: 'Abuela/Abuelo' }, { id: '5', nombre: 'Cuidador' }, { id: '6', nombre: 'Otro' }];

  $http.get(base_api + "/obtener/programas").success(function (response) {

    $scope.programas = response;
  });

  $http.get(base_api + "/obtener/paises").success(function (response) {
    $scope.paises = response;
  });

  $scope.data_paises = {
    'id': 1,
    'unit': 1
  };

  $http.get(base_api + "/obtener/departamentos/" + $scope.data_paises.unit).success(function (response) {
    $scope.departamentos = response;

    console.log($scope.departamentos);
  });

  $scope.datas = {
    'id': 1,
    'unit': 3
  };

  $http.get(base_api + "/obtener/municipios/" + $scope.datas.unit).success(function (response) {
    $scope.municipios = response;
  });

  $scope.data_municipio = {
    'id': 1,
    'unit': 131
  };

  $scope.selectedPais = function (itemPais) {

    $http.get(base_api + "/obtener/departamentos/" + itemPais).success(function (response) {

      $scope.departamentos = response;
    });
  };

  $scope.selectedDepartamento = function (itemDepartamento) {

    $http.get(base_api + "/obtener/municipios/" + itemDepartamento).success(function (response) {

      $scope.municipios = response;
    });
  };

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

    $scope.comunas = response;
  });

  $scope.selectedComuna = function (itemComuna) {

    $http.get(base_api + "/obtener/barrios/" + itemComuna).success(function (response) {

      $scope.barrios = response;
    });
  };

  $http.get(base_api + "/obtener/corregimientos").success(function (response) {

    $scope.corregimientos = response;
  });

  $scope.selectedCorregimiento = function (itemCorregimiento) {

    $http.get(base_api + "/obtener/veredas/" + itemCorregimiento).success(function (response) {

      $scope.veredas = response;
    });
  };

  $scope.isDisabled = true;
  $scope.isDisabledOcupacion = true;
  $scope.isDisabledCultura = true;
  $scope.isDisabledDiscapacidad = true;
  $scope.isDisabledEnfermedad = true;
  $scope.isDisabledMedicamento = true;
  $scope.isDisabledSeguridad = true;
  $scope.isDisabledParentesco = true;

  $scope.selectedHijos = function (itemHijos) {

    if (itemHijos == 1) {
      $scope.isDisabled = false;
    } else {

      $scope.isDisabled = true;
    }
  };

  $scope.selectedOcupacion = function (itemOcupacion) {

    if (itemOcupacion == 8) {
      $scope.isDisabledOcupacion = false;
    } else {

      $scope.isDisabledOcupacion = true;
    }
  };

  $scope.selectedCultura = function (itemCultura) {

    if (itemCultura == 10) {
      $scope.isDisabledCultura = false;
    } else {

      $scope.isDisabledCultura = true;
    }
  };

  $scope.selectedDiscapacidad = function (itemDiscapacidad) {

    if (itemDiscapacidad == 1) {
      $scope.isDisabledDiscapacidad = false;
    } else {

      $scope.isDisabledDiscapacidad = true;
    }
  };

  $scope.selectedEnfermedad = function (itemEnfermedad) {

    if (itemEnfermedad == 1) {
      $scope.isDisabledEnfermedad = false;
    } else {

      $scope.isDisabledEnfermedad = true;
    }
  };

  $scope.selectedMedicamento = function (itemMedicamento) {

    if (itemMedicamento == 1) {
      $scope.isDisabledMedicamento = false;
    } else {

      $scope.isDisabledMedicamento = true;
    }
  };

  $scope.selectedSeguridad = function (itemSeguridad) {

    if (itemSeguridad == 1) {
      $scope.isDisabledSeguridad = false;
    } else {

      $scope.isDisabledSeguridad = true;
    }
  };

  $scope.selectedParentesco = function (itemParentesco) {

    if (itemParentesco == 6) {
      $scope.isDisabledParentesco = false;
    } else {

      $scope.isDisabledParentesco = true;
    }
  };

  $scope.selection = [];
  $scope.today = function () {
    $scope.dt = new Date();
  };
  $scope.today();
  $scope.openCalendar = function ($event) {
    $event.preventDefault();
    $event.stopPropagation();
    $scope.opened = true;
  };

  $scope.openCalendarNacimiento = function ($event) {

    $event.preventDefault();
    $event.stopPropagation();
    $scope.opened = true;
  };

  $scope.keyup = function (IsActive) {
    if (!IsActive) {
      $scope.IsActive = true;
    } else {
      $scope.IsActive = false;
    }
  };

  $scope.formsubmit = function (isValid) {

    var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val();
    var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
    var fecha_inscripcion = $("#fecha_inscripcion").val();
    var SelectPoblacional = $scope.selected.poblacionales;

    if (isValid) {

      var datos = {

        //Datos Persona
        primer_nombre_persona: $scope.primer_nombre_persona,
        segundo_nombre_persona: $scope.segundo_nombre_persona,
        primer_apellido_persona: $scope.primer_apellido_persona,
        segundo_apellido_persona: $scope.segundo_apellido_persona,
        no_documento_persona: $scope.no_documento_persona,
        tipo_doc_persona: $scope.tipo_doc_persona,
        sexo_persona: $scope.sexo_persona,
        fecha_nac_persona: fecha_nacimiento_beneficiario,
        telefono_fijo_persona: $scope.telefono_fijo_persona,
        telefono_movil_persona: $scope.telefono_movil_persona,
        correo_persona: $scope.correo_persona,
        pais_id: $scope.data_paises.unit,
        departamento_id: $scope.datas.unit,
        municipio_id: $scope.data_municipio.unit,
        barrio_id: $scope.barrio,
        corregimiento: $scope.corregimiento,
        vereda: $scope.vereda,
        residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
        estrato: $scope.estrato,
        tip_sangre_persona: $scope.tip_sangre_persona,
        estado_civil_persona: $scope.est_beneficiario,

        //Acudiente Persona
        primer_nombre_acudiente: $scope.primer_nombre_acudiente,
        segundo_nombre_acudiente: $scope.segundo_nombre_acudiente,
        primer_apellido_acudiente: $scope.primer_apellido_acudiente,
        segundo_apellido_acudiente: $scope.segundo_apellido_acudiente,
        sex_pariente: $scope.sex_pariente,
        fecha_nac_acudiente: fecha_nacimiento_acudiente,
        telefono_fijo_acudiente: $scope.telefono_fijo_acudiente,
        telefono_movil_acudiente: $scope.telefono_movil_acudiente,
        correo_acudiente: $scope.correo_acudiente,
        no_documento_acudiente: $scope.no_documento_acudiente,
        tip_doc_acudiente: $scope.tip_doc_acudiente,

        //Datos Beneficiario     
        no_ficha: $scope.no_ficha,
        modalidad: $scope.modalidad,
        punto_atencion: $scope.punto_atencion,
        hijos_beneficiario: $scope.hijo,
        cantidad_hijos_beneficiario: $scope.cantidad_hijos,
        ocupacion_beneficiario: $scope.ocupacion,
        otra_ocupacion_beneficiario: $scope.ocupacion_otra,
        escolaridad_beneficiario: $scope.escolaridad,
        cultura_beneficiario: $scope.cultura,
        otra_cultura_beneficiario: $scope.cultura_otro,
        discapacidad_beneficiario: $scope.discapacidad,
        discapacidad_select_beneficiario: $scope.discapacidad_otro,
        otra_discapacidad_beneficiario: $scope.otra_discapacidad,
        enfermedad_permanente_beneficiario: $scope.enfermedad,
        enfermedad_beneficiario: $scope.otra_enfermedad,
        medicamentos_permanente_beneficiario: $scope.medicamento,
        medicamentos_beneficiario: $scope.medicamento_otro,
        seguridad_social_beneficiario: $scope.seguridad,
        salud_sgsss_beneficiario: $scope.salud,
        nombre_seguridad_beneficiario: $scope.nombre_entidad,
        parentesco_acudiente: $scope.parentesco,
        otro_parentesco_acudiente: $scope.otro_parentesco,
        fecha_inscripcion: fecha_inscripcion

      };

      $.ajax({
        url: base_api + '/postbeneficiario/create',
        type: 'POST',
        dataType: 'JSON',
        data: {
          datos: datos,
          SelectPoblacional: SelectPoblacional
        }

      }).success(function () {

        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location = "/admin/postbeneficiarios#/admin/postbeneficiarios";
      }).error(function () {
        console.log("success");
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/beneficiario/EditarBeneficiarioCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarBeneficiarioCtrl", function ($scope, BeneficiarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Editar Beneficiario";
  $scope.series = [];

  $scope.onBlurFicha = function ($event) {

    if ($scope.serie.no_ficha != $scope.ficha) {

      var numero_ficha = $scope.serie.no_ficha;

      $.ajax({
        url: base_api + '/verificar/ficha_beneficiario',
        type: 'GET',
        dataType: 'JSON',
        data: { numero_ficha: numero_ficha },
        async: false
      }).success(function (response) {

        console.log(response);

        $scope.serie.no_ficha = null;
        toastr.warning('Este registro ya se encuentra en el sistema.', 'No Ficha: ' + response.no_ficha);
        $scope.serie.no_ficha = null;
      }).error(function () {

        $('#repetido_ficha').hide();
      });
    }
  };

  $scope.onBlurDocumento = function ($event) {

    if ($scope.serie.documento != $scope.doc) {

      var no_documento_beneficiario = $scope.serie.documento;

      $.ajax({
        url: base_api + '/verificar/no_documento_beneficiario',
        type: 'GET',
        dataType: 'JSON',
        data: { no_documento_beneficiario: no_documento_beneficiario },
        async: false
      }).success(function (response) {
        console.log(response);
        if (response.length > 0) {

          $scope.no_documento_persona = null;
          toastr.warning('Este registro ya se encuentra en el sistema.', 'No Documento: ' + response[0].documento);
          $scope.no_documento_persona = null;
        }
      }).error(function () {
        $('#repetido_no_documento').hide();
      });
    }
  };

  $('.formlista').change(function () {
    var direccion = '';
    $.each($('.formlista'), function (index, value) {
      if ($(value).val() != '') {
        direccion = direccion + ' ' + $(value).val();
      }
    });
    $('#id_persona_beneficiario_residencia_direccion').val(direccion);
  });

  $(document).ready(function () {
    $('[name=integer-data-attribute]').maskNumber({ integer: true });
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_nacimiento").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_nacimiento_acudiente").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_inscripcion").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
  });

  $scope.getData = function () {

    $http.get(base_api + "/admin/postbeneficiarios/" + $routeParams.id).success(function (response) {

      $scope.serie = response[0];
    });
  };

  $scope.serie = {};
  $scope.getData();

  $http.get(base_api + "/obtener/paises").success(function (response) {
    $scope.paises = response;
  });

  $http.get(base_api + "/obtener/pais/" + $routeParams.id).success(function (response) {
    $scope.data = {
      'id': 1,
      'unit': response[0].id
    };

    $http.get(base_api + "/obtener/departamentos/" + $scope.data.unit).success(function (response) {
      $scope.departamentos = response;
    });
  });

  $http.get(base_api + "/obtener/departamento/" + $routeParams.id).success(function (response) {
    $scope.datas = {
      'id': 1,
      'unit': response[0].id
    };

    $http.get(base_api + "/obtener/municipios/" + $scope.datas.unit).success(function (response) {
      $scope.municipios = response;
    });
  });

  $http.get(base_api + "/obtener/municipio/" + $routeParams.id).success(function (response) {
    $scope.data_municipio = {
      'id': 1,
      'unit': response[0].id
    };
  });

  $scope.selectedPais = function (item) {

    $http.get(base_api + "/obtener/departamentos/" + item).success(function (response) {
      $scope.departamentos = response;
    });
  };

  $scope.selectedDepartamento = function (item) {

    $http.get(base_api + "/obtener/municipios/" + item).success(function (response) {
      $scope.municipios = response;
    });
  };

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {
    $scope.comunas = response;
  });

  $http.get(base_api + "/obtener/barrio/" + $routeParams.id).success(function (response_barrio) {

    $scope.data_barrio = {
      'id': 1,
      'unit': response_barrio[0].id
    };

    $http.get(base_api + "/obtener/comuna_barrio/" + response_barrio[0].id).success(function (response) {

      $scope.data_comuna = {
        'id': 1,
        'unit': response[0].id
      };

      $http.get(base_api + "/obtener/barrios/" + $scope.data_comuna.unit).success(function (response) {
        $scope.barrios = response;
      });
    });
  });

  $http.get(base_api + "/obtener/tipodocumento/" + $routeParams.id).success(function (response) {

    $scope.tipo_doc = {
      'id': 1,
      'unit': response[0].id
    };
  });

  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {
    $scope.tipodocumento = response;
    // console.log($scope.roles);
  });

  $http.get(base_api + "/obtener/corregimientos").success(function (response) {
    $scope.corregimientos = response;
  });

  $http.get(base_api + "/obtener/corregimiento/" + $routeParams.id).success(function (response) {

    console.log(response);
    $scope.data_corregimiento = {
      'id_corregimiento': 1,
      'unit': response[0].id
    };

    $http.get(base_api + "/obtener/veredas_beneficiario/" + $scope.data_corregimiento.unit).success(function (response) {
      $scope.veredas = response;
    });
  });

  $http.get(base_api + "/obtener/vereda_beneficiario/" + $routeParams.id).success(function (response) {
    $scope.datas_veredas = {
      'id': 1,
      'unit': response[0].id
    };
  });

  $scope.selectedCorregimiento = function (item) {

    $http.get(base_api + "/obtener/veredas/" + item).success(function (response) {

      $scope.veredas = response;
    });
  };

  $http.get(base_api + "/obtener/sexo/" + $routeParams.id).success(function (response) {

    $scope.obsexo = {};
    $scope.obsexo.sexoId = response.id.toString();

    $scope.obsexo.sexo = [{ id: '1', nombre: 'Mujer' }, { id: '2', nombre: 'Hombre' }];
  });

  // $http.get(base_api + "/obtener/civil/" + $routeParams.id)
  // .success(function(response){


  //   $scope.obcivil = {};
  //   $scope.obcivil.civilId = response.id.toString();

  //   $scope.obcivil.civil = [
  //   {id: '1', nombre: 'Casado'},
  //   {id: '2', nombre: 'Soltero'},
  //   {id: '3', nombre: 'Unión Libre'},
  //   {id: '4', nombre: 'Viudo'},
  //   ];


  // });


  $http.get(base_api + "/obtener/hijos/" + $routeParams.id).success(function (response) {

    $scope.obhijos = {};
    $scope.obhijos.hijosId = response.id.toString();

    $scope.obhijos.hijos = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    if (response.id == 2) {

      $scope.isDisabled = true;
      $scope.serie.cantidad_hijos_beneficiario = null;
    }
  });

  $http.get(base_api + "/obtener/tiposangre/" + $routeParams.id).success(function (response) {

    $scope.obtipo_sangre = {};
    $scope.obtipo_sangre.tipo_sangreId = response.sangre_tipo.toString();

    $scope.obtipo_sangre.tipo_sangre = [{ id: '1', nombre: 'O+' }, { id: '2', nombre: 'O-' }, { id: '3', nombre: 'A+' }, { id: '4', nombre: 'A-' }, { id: '5', nombre: 'B+' }, { id: '6', nombre: 'B-' }, { id: '7', nombre: 'AB+' }, { id: '8', nombre: 'AB-' }];
  });

  $http.get(base_api + "/obtener/estados_civiles").success(function (response) {
    $scope.estados_civiles = response;
  });

  $http.get(base_api + "/obtener/civil/" + $routeParams.id).success(function (response) {

    $scope.data_civil = {
      'id': 1,
      'unit': response.id
    };
  });

  $http.get(base_api + "/obtenerselect/escolaridades").success(function (response) {

    $scope.escolaridades = response;
  });

  $http.get(base_api + "/obtener/escolaridad/" + $routeParams.id).success(function (response) {

    $scope.data_escolaridad = {
      'id': 1,
      'unit': response.id
    };
  });

  $http.get(base_api + "/obtener/ocupacion/" + $routeParams.id).success(function (response) {

    $scope.obocupacion = {};
    $scope.obocupacion.ocupacionId = response.id.toString();

    $scope.obocupacion.ocupacion = [{ id: '1', nombre: 'Ama de casa' }, { id: '2', nombre: 'Empleado' }, { id: '3', nombre: 'Estudiante' }, { id: '4', nombre: 'Desempleado' }, { id: '5', nombre: 'Independiente' }, { id: '6', nombre: 'Pensionado-Jubilado' }, { id: '7', nombre: 'Servidor Público' }, { id: '8', nombre: 'Otro' }];

    if (response.id !== 8) {

      $scope.isDisabledOcupacion = true;
    }
  });

  $http.get(base_api + "/obtener/cultura/" + $routeParams.id).success(function (response) {

    $scope.obcultura = {};
    $scope.obcultura.culturaId = response.id.toString();

    $scope.obcultura.cultura = [{ id: '1', nombre: 'Negro' }, { id: '2', nombre: 'Blanco' }, { id: '3', nombre: 'Índigena' }, { id: '4', nombre: 'Mestizo' }, { id: '5', nombre: 'Mulato' }, { id: '6', nombre: 'ROM, Gitano' }, { id: '7', nombre: 'Palenquero' }, { id: '8', nombre: 'Raizal' }, { id: '9', nombre: 'No sabe-No responde' }, { id: '10', nombre: 'Otro' }];

    if (response.id !== 10) {

      $scope.isDisabledCultura = true;
      $scope.otra_cultura_beneficiario = null;
    }
  });

  $http.get(base_api + "/obtener/discapacidad/" + $routeParams.id).success(function (response) {

    $scope.obdiscapacidad = {};
    $scope.obdiscapacidad.discapacidadId = response.id.toString();

    $scope.obdiscapacidad.discapacidad = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    if (response.id == 2) {

      $scope.isDisabledDiscapacidadCual = true;
      $scope.isDisabledDiscapacidad = true;
      // $scope.obdiscapacidadotro = {};
      // $scope.obdiscapacidadotro.discapacidadotro = null;
      // $scope.obdiscapacidadotro.discapacidadotroId = null;
      // $scope.serie.otra_discapacidad_beneficiario = null;
    }
  });

  $http.get(base_api + "/obtener/DiscapacidadOtra/" + $routeParams.id).success(function (response) {

    $scope.tipo_disc_otra = {
      'id': 1,
      'unit': response.id
    };

    console.log($scope.tipo_disc_otra);
  });

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (response) {

    $scope.discapacidad_otra = response;
  });

  $scope.selectedDiscapacidad = function (itemDiscapacidad) {

    if (itemDiscapacidad == 1) {

      $scope.obdiscapacidadotro.discapacidadotro = [{ id: '1', nombre: 'Auditiva' }, { id: '2', nombre: 'Cognitiva' }, { id: '3', nombre: 'Mental' }, { id: '4', nombre: 'Motriz' }, { id: '5', nombre: 'Oral' }, { id: '6', nombre: 'Visual' }];

      $scope.required_discapacidad = true;
      $scope.isDisabledDiscapacidadCual = false;
      $scope.isDisabledDiscapacidad = false;
    } else {

      $scope.isDisabledDiscapacidadCual = true;
      $scope.isDisabledDiscapacidad = true;
      $scope.obdiscapacidadotro.discapacidadotro = null;
    }
  };

  $scope.selectedEnfermedad = function (item) {

    if (item == 1) {

      $scope.isDisabledEnfermedad = false;
    } else {

      $scope.isDisabledEnfermedad = true;
      $scope.serie.enfermedad_beneficiario = null;
    }
  };

  $scope.isDisabledMedicamento = function (item) {

    if (item == 1) {

      $scope.isDisabledMedicamento = false;
    } else {

      $scope.isDisabledMedicamento = true;
      $scope.serie.medicamentos_beneficiario = null;
    }
  };

  $scope.selectedOcupacion = function (item) {

    if (item == 8) {
      $scope.isDisabledOcupacion = false;
    } else {
      $scope.isDisabledOcupacion = true;
      $scope.serie.otra_ocupacion_beneficiario = null;
    }
  };

  $scope.selectedSeguridad = function (item) {

    if (item == 1) {

      $scope.obsaludsgss.saludsgss = [{ id: '1', nombre: 'Regimen Contributivo (EPS)' }, { id: '2', nombre: 'Regimen Subsidiado (SISBEN-EPS-S)' }, { id: '3', nombre: 'Especial (FFMM, Policia, etc)' }];

      $scope.isDisabledSeguridadCual = false;
      $scope.isDisabledSeguridad = false;
    } else {

      $scope.isDisabledSeguridadCual = true;
      $scope.isDisabledSeguridad = true;
      $scope.obsaludsgss.saludsgssId = null;
      $scope.serie.nombre_seguridad_beneficiario = null;
    }
  };

  $scope.selectedCultura = function (item) {

    if (item == 10) {
      $scope.isDisabledCultura = false;
    } else {
      $scope.isDisabledCultura = true;
      $scope.serie.otra_cultura_beneficiario = null;
    }
  };

  $scope.selectedHijos = function (item) {

    if (item == 1) {

      $scope.isDisabled = false;
    } else {

      $scope.isDisabled = true;
      $scope.serie.cantidad_hijos_beneficiario = null;
    }
  };

  $http.get(base_api + "/obtener/enfermedadpermanente/" + $routeParams.id).success(function (response) {

    $scope.obenfermedad = {};
    $scope.obenfermedad.enfermedadId = response.id.toString();

    $scope.obenfermedad.enfermedad = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    if (response.id == 2) {

      $scope.isDisabledEnfermedad = true;
      $scope.serie.enfermedad_beneficiario = null;
    }
  });

  $http.get(base_api + "/obtener/medicamentopermanente/" + $routeParams.id).success(function (response) {

    $scope.obmedicamento = {};
    $scope.obmedicamento.medicamentoId = response.id.toString();

    $scope.obmedicamento.medicamento = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    if (response.id == 2) {

      $scope.isDisabledMedicamento = true;
      $scope.serie.medicamentos_beneficiario = null;
    }
  });

  $http.get(base_api + "/obtener/seguridadsocial/" + $routeParams.id).success(function (response) {

    $scope.obseguridadsocial = {};
    $scope.obseguridadsocial.seguridadsocialId = response.id.toString();

    $scope.obseguridadsocial.seguridadsocial = [{ id: '1', nombre: 'Si' }, { id: '2', nombre: 'No' }];

    if (response.id == 2) {

      $scope.isDisabledSeguridadCual = true;
      $scope.isDisabledSeguridad = true;
      $scope.obsaludsgss.saludsgssId = null;
      $scope.nombre_seguridad_beneficiario = null;
    }
  });

  $http.get(base_api + "/obtener/saludsgss/" + $routeParams.id).success(function (response) {

    console.log(response);
    $scope.obsaludsgss = {};
    $scope.obsaludsgss.saludsgssId = response.id.toString();

    $http.get(base_api + "/obtenerselect/salud_sgsss").success(function (response) {

      $scope.obsaludsgss.saludsgss = response;
      // console.log($scope.salud_sgsss);
    });
    // $scope.obsaludsgss.saludsgss = [

    //   {id: '1', nombre: 'Regimen Contributivo (EPS)'},
    //   {id: '2', nombre: 'Regimen Subsidiado (SISBEN-EPS-S)'},
    //   {id: '3', nombre: 'Especial (FFMM, Policia, etc)'},

    // ];
  });

  $http.get(base_api + "/obtener/sexo_acudiente/" + $routeParams.id).success(function (response) {

    $scope.obsexo_acudiente = {};
    $scope.obsexo_acudiente.sexo_acudienteId = response.id.toString();
    $scope.obsexo_acudiente.sexo_acudiente = [{ id: '1', nombre: 'Mujer' }, { id: '2', nombre: 'Hombre' }];
  });

  $http.get(base_api + "/obtener/parentesco/" + $routeParams.id).success(function (response) {

    $scope.obparentesco = {};
    $scope.obparentesco.parentescoId = response.id.toString();
    $scope.obparentesco.parentesco = [{ id: '1', nombre: 'Madre/Padre' }, { id: '2', nombre: 'Hermana/Hermano' }, { id: '3', nombre: 'Tia/Tio' }, { id: '4', nombre: 'Abuela/Abuelo' }, { id: '5', nombre: 'Cuidador' }, { id: '6', nombre: 'Otro' }];
  });

  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {

    $scope.tipo_documento = response;
  });

  $http.get(base_api + "/obtener/documentoacudiente/" + $routeParams.id).success(function (response) {

    $scope.data_documento = {
      'id_documento_tipo': 1,
      'unit': response.id
    };
  });

  Array.prototype.indexOfObjectWithProperty = function (propertyName, propertyValue) {
    for (var i = 0, len = this.length; i < len; i++) {
      if (this[i][propertyName] === propertyValue) return i;
    }

    return -1;
  };

  Array.prototype.containsObjectWithProperty = function (propertyName, propertyValue) {
    return this.indexOfObjectWithProperty(propertyName, propertyValue) != -1;
  };

  $http.get(base_api + "/obtenerselect/allGrupos_poblacionales").success(function (response) {

    $scope.allGrupos_poblacionales = response;
    console.log($scope.allGrupos_poblacionales);
  });

  $http.get(base_api + "/obtener/poblacionales/" + $routeParams.id).success(function (response) {

    $scope.selectedPoblacionales = response;
  });

  $scope.toggleSelection = function toggleSelection(seleccion) {

    console.log(seleccion);
    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);
    console.log(index);

    if (index > -1) {
      $scope.selectedPoblacionales.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/poblacional/" + $routeParams.id,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedPoblacionales.push(seleccion);
      console.log($scope.selectedPoblacionales);
    }
  };

  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;

  $scope.formsubmit = function (id, isValid) {

    if ($scope.obsaludsgss.saludsgssId == undefined) {

      $scope.obsaludsgss.saludsgssId = null;
    }

    $scope.fecha_iscrip = $scope.startDateInscripcion;

    var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val();
    var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
    var fecha_inscripcion = $("#fecha_inscripcion").val();

    if (isValid) {

      var datos = {

        //persona          
        no_documento_persona: $scope.serie.documento,
        tipo_doc_persona: $scope.tipo_doc.unit,
        primer_nombre_persona: $scope.serie.nombre_primero,
        segundo_nombre_persona: $scope.serie.nombre_segundo,
        primer_apellido_persona: $scope.serie.apellido_primero,
        segundo_apellido_persona: $scope.serie.apellido_segundo,
        sexo_persona: $scope.obsexo.sexoId,
        fecha_nac_persona: fecha_nacimiento_beneficiario,
        tip_sangre_persona: $scope.obtipo_sangre.tipo_sangreId,
        telefono_fijo_persona: $scope.serie.telefono_fijo,
        telefono_movil_persona: $scope.serie.telefono_movil,
        correo_persona: $scope.serie.correo_electronico,
        pais_id: $scope.data.unit,
        departamento_id: $scope.datas.unit,
        municipio_id: $scope.data_municipio.unit,
        residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
        estrato: $scope.serie.residencia_estrato,
        barrio_id: $scope.data_barrio.unit,
        corregimiento: $scope.data_corregimiento.unit,
        vereda: $scope.datas_veredas.unit,
        estado_civil_persona: $scope.data_civil.unit,

        //Acudiente Persona
        no_documento_acudiente: $scope.serie.documento_acudiente,
        tip_doc_acudiente: $scope.data_documento.unit,
        primer_nombre_acudiente: $scope.serie.nombre_primero_acudiente,
        segundo_nombre_acudiente: $scope.serie.nombre_segundo_acudiente,
        primer_apellido_acudiente: $scope.serie.apellido_primero_acudiente,
        segundo_apellido_acudiente: $scope.serie.apellido_segundo_acudiente,
        sex_pariente: $scope.obsexo_acudiente.sexo_acudienteId,
        fecha_nac_acudiente: fecha_nacimiento_acudiente,
        telefono_fijo_acudiente: $scope.serie.telefono_fijo_acudiente,
        telefono_movil_acudiente: $scope.serie.telefono_movil_acudiente,
        correo_acudiente: $scope.serie.correo_electronico_acudiente,

        //beneficiario

        modalidad: $scope.serie.modalidad,
        punto_atencion: $scope.serie.punto_atencion,
        hijos_beneficiario: $scope.obhijos.hijosId,
        cantidad_hijos_beneficiario: $scope.serie.cantidad_hijos_beneficiario,
        ocupacion_beneficiario: $scope.obocupacion.ocupacionId,
        otra_ocupacion_beneficiario: $scope.serie.otra_ocupacion_beneficiario,
        escolaridad_beneficiario: $scope.data_escolaridad.unit,
        cultura_beneficiario: $scope.obcultura.culturaId,
        otra_cultura_beneficiario: $scope.serie.otra_cultura_beneficiario,
        discapacidad_beneficiario: $scope.obdiscapacidad.discapacidadId,
        discapacidad_select_beneficiario: $scope.tipo_disc_otra.unit,
        otra_discapacidad_beneficiario: $scope.serie.otra_discapacidad_beneficiario,
        enfermedad_permanente_beneficiario: $scope.obenfermedad.enfermedadId,
        enfermedad_beneficiario: $scope.serie.enfermedad_beneficiario,
        medicamentos_permanente_beneficiario: $scope.obmedicamento.medicamentoId,
        medicamentos_beneficiario: $scope.serie.medicamentos_beneficiario,
        seguridad_social_beneficiario: $scope.obseguridadsocial.seguridadsocialId,
        salud_sgsss_beneficiario: $scope.obsaludsgss.saludsgssId,
        nombre_seguridad_beneficiario: $scope.serie.nombre_seguridad_beneficiario,
        parentesco_acudiente: $scope.obparentesco.parentescoId,
        otro_parentesco_acudiente: $scope.serie.otro_parentesco_acudiente,
        fecha_inscripcion: fecha_inscripcion,
        no_ficha: $scope.serie.no_ficha

      };

      var poblacionales = $scope.selectedPoblacionales;

      $.ajax({
        url: base_api + '/postbeneficiario/actualizar/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {

          datos: datos,
          poblacionales: poblacionales
        }
      }).success(function () {
        toastr.success("Su registro ha sido exitoso", "Registro Actualizado");
        window.location = "/admin/postbeneficiarios#/admin/postbeneficiarios";
      }).error(function () {
        console.log("success");
      });
    }
  };
});

/***/ }),

/***/ 24:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/beneficiario/BeneficiariosCrtl.js");
__webpack_require__("./resources/assets/controllers/beneficiario/CreateBeneficiarioCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/beneficiario/EditarBeneficiarioCtrl.js");


/***/ })

/******/ });