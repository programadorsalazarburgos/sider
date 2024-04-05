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
/******/ 	return __webpack_require__(__webpack_require__.s = 28);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/gruposprogramas/AdicionalEditarBeneficiarioCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("AdicionalEditarBeneficiarioCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q) {

  $scope.parametro = $routeParams.id;

  $http.get(base_api + "/obtener/informacion_adicional/" + $routeParams.id).success(function (data) {

    console.log(data.adicional);

    if (data.adicional == null) {
      swal("Registro no Existente!", "Agrega Información Adicional", "error");
      window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
    } else {
      $scope.disciplina = data.adicional.disciplina_id;
      $scope.seleccion = data.adicional.pertenece_a;
      $scope.club = data.adicional.nombre_club;

      if (data.adicional.codigo != null) {
        $scope.content = 'si';
        $scope.no_tajeta = data.adicional.codigo;
      }

      if ($scope.seleccion == 3) {
        $scope.contentido = true;
        $scope.club = data.adicional.nombre_club;
      } else if ($scope.seleccion != 3) {
        $scope.contentido = false;
        $scope.club = data.adicional.nombre_club;
      }
    }
  });

  $http.get(base_api + "/obtener/clubesdeportivos").success(function (clubesdeportivos) {

    $scope.clubesdeportivos = clubesdeportivos;
  });

  $http.get(base_api + "/obtener/disciplinasdeportivas").success(function (disciplinas) {

    $scope.disciplinas = disciplinas;
  });

  $scope.selecciones = [{ id: 1, nombre: 'SELECCIONES CALI' }, { id: 2, nombre: 'SELECCIONES VALLE' }, { id: 3, nombre: 'CLUB DEPORTIVO PARTICULAR' }];

  $scope.beneficiario = function (seleccion) {

    if (seleccion == 3) {

      $scope.contentido = true;
    } else {
      $scope.contentido = false;
    }
  };

  $scope.formsubmit = function (isValid, parametro) {

    if (isValid) {

      if ($scope.no_tajeta == undefined) {
        $scope.no_tajeta = '';
      } else if ($scope.no_tajeta != null) {
        $scope.no_tajeta = $scope.no_tajeta;
      }

      if ($scope.club == undefined) {
        $scope.club = '';
      } else if ($scope.club != null) {
        $scope.club = $scope.club;
      }

      var midata = new FormData();
      var no_tajeta = $scope.no_tajeta;
      var disciplina = $scope.disciplina;
      var seleccion = $scope.seleccion;
      var nombre_club = $scope.club;

      midata.append('no_tajeta', no_tajeta);
      midata.append('disciplina', disciplina);
      midata.append('seleccion', seleccion);
      midata.append('nombre_club', nombre_club);

      $.ajax({
        url: base_api + '/actualizar/adicional/' + parametro,
        type: 'POST',
        contentType: false,
        data: midata, // mandamos el objeto formdata que se igualo a la variable data
        processData: false,
        cache: false,
        success: function success(respuestaAjax) {
          swal("Almacenado!", "Registro Actualizado.", "success");
          window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
        },
        error: function error(data) {
          swal("Registro Existente!", "Ya Ingresaste Información Adicional.", "error");
        }
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/AdicionalMiBeneficiarioProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("AdicionalMiBeneficiarioProgramaCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q) {

  $scope.parametro = $routeParams.id;

  $http.get(base_api + "/obtener/disciplinasdeportivas").success(function (disciplinas) {

    $scope.disciplinas = disciplinas;
  });

  $scope.selecciones = [{ id: 1, nombre: 'SELECCIONES CALI' }, { id: 2, nombre: 'SELECCIONES VALLE' }, { id: 3, nombre: 'CLUB DEPORTIVO PARTICULAR' }];

  $http.get(base_api + "/obtener/clubesdeportivos").success(function (clubesdeportivos) {

    $scope.clubesdeportivos = clubesdeportivos;
  });

  $scope.beneficiario = function (seleccion) {

    if (seleccion == 3) {

      $scope.contentido = true;
    } else {
      $scope.contentido = false;
    }
  };

  $scope.formsubmit = function (isValid, parametro) {

    if (isValid) {

      if ($scope.no_tajeta == undefined) {
        $scope.no_tajeta = '';
      } else if ($scope.no_tajeta != null) {
        $scope.no_tajeta = $scope.no_tajeta;
      }

      if ($scope.club == undefined) {
        $scope.club = '';
      } else if ($scope.club != null) {
        $scope.club = $scope.club;
      }

      var midata = new FormData();
      var no_tajeta = $scope.no_tajeta;
      var disciplina = $scope.disciplina;
      var seleccion = $scope.seleccion;
      var club = $scope.club;

      midata.append('no_tajeta', no_tajeta);
      midata.append('disciplina', disciplina);
      midata.append('seleccion', seleccion);
      midata.append('club', club);

      $.ajax({
        url: base_api + '/create/adicional/' + parametro,
        type: 'POST',
        contentType: false,
        data: midata, // mandamos el objeto formdata que se igualo a la variable data
        processData: false,
        cache: false,
        success: function success(respuestaAjax) {
          swal("Almacenado!", "Registro Actualizado.", "success");
          window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
        },
        error: function error(data) {
          swal("Registro Existente!", "Ya Ingresaste Información Adicional.", "error");
        }
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/AsistenciaGrupoProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("AsistenciaGrupoProgramaCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
    $scope.title = "Mis Beneficiarios";

    $http.get(base_api + "/obtener/nombre_grupoprograma/" + $routeParams.id).success(function (response_grupo) {

        $scope.nombre_grupo = response_grupo.nombre_grupo;
        $scope.nombre_lugar = response_grupo.nombre_lugar;
        $scope.nombre_disciplina = response_grupo.nombre_disciplina;
    });

    ko.bindingHandlers.bootstrapSwitchOn = {
        init: function init(element, valueAccessor, allBindingsAccessor, viewModel) {
            $elem = $(element);
            $(element).bootstrapSwitch('setState', ko.utils.unwrapObservable(valueAccessor())); // Set intial state
            $elem.on('switch-change', function (e, data) {
                valueAccessor()(data.value);
            }); // Update the model when changed.
        },
        update: function update(element, valueAccessor, allBindingsAccessor, viewModel) {
            var vStatus = $(element).bootstrapSwitch('status');
            var vmStatus = ko.utils.unwrapObservable(valueAccessor());
            if (vStatus != vmStatus) {
                $(element).bootstrapSwitch('setState', vmStatus);
            }
        }
    };

    var vm = {
        on: ko.observable(true),

        items: ko.observableArray([{ Name: "Dave", Old: ko.observable(false) }, { Name: "Richard", Old: ko.observable(true) }, { Name: "John", Old: ko.observable(false) }])
    };

    ko.applyBindings(vm);

    $(function () {
        $('.switch2').bootstrapSwitch();
    });

    $scope.enabled = true;
    $scope.onOff = true;
    $scope.yesNo = true;
    $scope.disabled = true;

    $scope.changeCallback = function () {
        // console.log('This is the state of my model ' + $scope.enabled);
    };

    $scope.series = [];
    $scope.pageSize = 300;

    $scope.getData = function () {
        $scope.series_grupos = GrupoProgramaService.get({ id: $routeParams.id });

        $scope.grupo = $routeParams.id;
        $http.get(base_api + "/obtener/misbeneficiariosprograma/" + $routeParams.id).success(function (response) {

            $scope.beneficiarios = response;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.beneficiarios.length; //Initially for no filter
            $scope.totalItems = $scope.beneficiarios.length;

            $scope.beneficiarios.map(function (beneficiario) {

                beneficiario.assist = true;
                return beneficiario;
            });
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

    function noExcursion(date) {

        $scope.day = date.getDay();
        return [$scope.day == 1, ''];
    };
    //Asistencia Update

    $.datepicker.setDefaults($.datepicker.regional['es']);

    $(function () {

        var dates;
        var pruebas;

        $("#fecha_asistencia").datepicker({

            yearRange: "-99:+0",
            maxDate: "+0m +0d",

            onSelect: function onSelect(date) {

                $http.get(base_api + '/obtener/asistenciaprograma/' + $routeParams.id, {
                    params: { date: date },
                    headers: { 'Authorization': 'Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==' }
                }).then(function (response) {

                    $scope.persona = response.data;
                    console.log($scope.persona);

                    if ($scope.persona.length > 0) {
                        swal({
                            title: "Asistencia Registrada",
                            text: "Puedes Actualizar esta asistencia si lo deseas!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true
                        });

                        $('#tablasave').hide();
                        $('#tablaupdate').show();
                    } else {
                        $('#tablasave').show();
                        $('#tablaupdate').hide();
                    }

                    // Request completed successfully
                }, function (x) {
                    // Request error
                });
            }
        }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
    });

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
    $scope.series = GrupoProgramaService.query();

    $scope.formsubmitUpdate = function (isValid) {
        //
        $scope.persona.forEach(function (persona) {

            if (persona.observaciones_update == null) {

                persona.observaciones_update = null;
            }

            if (persona.asistencia == false) {

                persona.asistencia = 0;
            } else {

                persona.asistencia = 1;
            }
        });

        var datos_update = $scope.persona;
        console.log(datos_update);
        var fecha_asistencia = $('#fecha_asistencia').val();

        if (fecha_asistencia == '') {

            swal("Algo te hace falta!", "Verifique que su campo fecha asistencia no este vacio!", "error");
            toastr.error("Verifique que su campo fecha asistencia no este vacio", "Campo fecha asistencia");
        } else {

            $.ajax({
                url: base_api + '/asistenciasprogramas/update/' + $routeParams.id,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    datos_update: datos_update,
                    fecha_asistencia: fecha_asistencia
                }
            }).success(function () {

                toastr.success("Su registro ha sido exitoso", "Almacenada asistencia ");
                window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
            });
        }
    };

    $scope.questions = [];
    var quest1 = { name: "teste", status: true };
    var quest2 = { name: "teste2", status: false };
    $scope.questions.push(quest1);
    $scope.questions.push(quest2);

    $scope.onChange = function (newValue, oldValue) {
        $log.log('Switch:', newValue, oldValue);
    };

    $scope.getCheckedFalse = function () {
        return true;
    };

    $scope.formsubmitAsistencia = function (isValid) {

        console.log($scope.beneficiarios);

        $scope.beneficiarios.forEach(function (beneficiario) {

            if (beneficiario.observaciones_asistencia == null) {

                beneficiario.observaciones_asistencia = null;
            }

            if (beneficiario.observaciones_asistencia == undefined) {

                beneficiario.observaciones_asistencia = null;
            }

            if (!beneficiario.assist) {

                beneficiario.assist = false;
            }

            if (beneficiario.assist == false) {

                beneficiario.assist = 0;
            } else if (beneficiario.assist == true) {

                beneficiario.assist = 1;
            }
        });

        var datos = $scope.beneficiarios;
        console.log(datos);
        var fecha_asistencia = $('#fecha_asistencia').val();

        if (fecha_asistencia == '') {

            swal("Algo te hace falta!", "Verifique que su campo fecha asistencia no este vacio!", "error");
            toastr.error("Verifique que su campo fecha asistencia no este vacio", "Campo fecha asistencia");
        } else {

            $.ajax({
                url: base_api + '/asistenciasprogramas/create/' + $routeParams.id,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    datos: datos,
                    fecha_asistencia: fecha_asistencia
                }
            }).success(function () {

                toastr.success("Su registro ha sido exitoso", "Almacenada asistencia ");
                window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
            });
        }
    };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/BeneficiarioProgramaGrupoCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("BeneficiarioProgramaGrupoCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q) {

  $scope.reset = function () {
    $scope.state = undefined;
  };

  $scope.ngShowhide1Vereda = true;
  $scope.title = "Beneficiario Grupo";
  $scope.series = [];
  $scope.selectedPoblacionales = [];
  $scope.selectedDiscapacidades = [];

  $scope.getData = function () {
    $scope.serie = GrupoService.get({ id: $routeParams.id });
    console.log();
  };

  $scope.grupo_save = $routeParams.id;

  $scope.serie = {};

  $scope.title = "Agregar Beneficiario";
  $scope.disable_submit = false;
  $scope.serie = {};

  $(function () {
    $('#id_persona_beneficiario_residencia_direccion').add_generator({
      direccion: 'id_persona_beneficiario_residencia_direccion',
      complemento: 'id_persona_beneficiario_residencia_direccion_complemento'
    });
  });

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
    $('[name=documento_beneficiario]').maskNumber({ integer: true });
  });
  $(document).ready(function () {
    $('[name=documento_acudiente]').maskNumber({ integer: true });
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_nacimiento").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "1910:+nn",
      maxDate: $("#hdnTID").val() == "1240916273" ? "-54y" : "0"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_nacimiento_acudiente").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "1940:+nn"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_inscripcion").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "-99:+0",
      maxDate: "+0m +0d"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  var d = new Date();
  $scope.fecha_inscripcion = $.datepicker.formatDate("yy-mm-dd", new Date(d));

  $("#direccion_residencia_plugin").show();

  //Inicio Carga de datos Documento Crear

  $scope.tipo_doc = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {
    $scope.tipodocumento = response;
  });

  //Fin Carga de datos Documento Crear

  //inicio tipo documento acudients

  $scope.tipo_doc_acudiente = {
    'id': 1,
    'unit': null

    //fin
    //Inicio Carga datos sexo crear

  };$scope.estrato = [{ id: 1, nombre: '1' }, { id: 2, nombre: '2' }, { id: 3, nombre: '3' }, { id: 4, nombre: '4' }, { id: 5, nombre: '5' }, { id: 6, nombre: '6' }, { id: 7, nombre: '7' }];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo crear

  $scope.sexo = [{ id: 1, nombre: 'Mujer' }, { id: 2, nombre: 'Hombre' }];

  // $scope.ficha = [
  //    {fecha_inscripcion: '2017-01-01'},

  //    ];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo real crear

  $scope.tipo_sex_real = {
    'id': 1,
    'unit': null
  };

  $scope.sexo_real = [{ id: 1, nombre: 'Heterosexual' }, { id: 2, nombre: 'Homosexual' }, { id: 3, nombre: 'Bisexual' }];

  //Fin Carga datos sexo real crear

  //Inicio Carga datos orientacion sexual crear

  $scope.tipo_orientacion_sexual = {
    'id': 1,
    'unit': null
  };

  $scope.sexo_orientacion_sexual = [{ id: 1, nombre: 'Lesbiana' }, { id: 2, nombre: 'Gay' }, { id: 3, nombre: 'Bisexual' }, { id: 4, nombre: 'Transformista' }, { id: 5, nombre: 'Transvestido' }, { id: 6, nombre: 'Transgenerista' }, { id: 7, nombre: 'Transexual' }, { id: 8, nombre: 'Intersexual' }, { id: 9, nombre: 'Querés' }, { id: 10, nombre: 'Pansexual' }, { id: 11, nombre: 'HSH' }, { id: 12, nombre: 'Queers' }, { id: 13, nombre: 'Otro' }];

  //Fin Carga datos orientacion sexual crear


  //Inicio Carga datos sexo crear

  $scope.tipo_sex_acudiente = {
    'id': 1,
    'unit': null

    //Fin Carga datos sexo crear

    //Inicio Carga datos tipo de sangre

  };$scope.sangre = [{ id: '1', nombre: 'O+' }, { id: '2', nombre: 'O-' }, { id: '3', nombre: 'A+' }, { id: '4', nombre: 'A-' }, { id: '5', nombre: 'B+' }, { id: '6', nombre: 'B-' }, { id: '7', nombre: 'AB+' }, { id: '8', nombre: 'AB-' }];

  //Fin Carga datos tipo de sangre


  $scope.tipo_com = {
    'id': 1,
    'unit': null

    //inicio cargar datos corregimientos

  };$scope.data_corregimiento = {
    'id': 1,
    'unit': null
  };

  $.ajax({
    url: base_api + "/obtener/corregimientos",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.corregimientos = response;
  }).error(function () {});

  //inicio cargar datos modalidades

  $scope.data_modalidad = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtener/modalidades").success(function (modalidades) {

    $scope.modalidades = modalidades;
  });

  //inicio cargar datos puntos de atencion

  $scope.data_puntoatencion = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtener/puntosatencion").success(function (puntosatencion) {

    $scope.puntosatencion = puntosatencion;
  });

  $scope.selectedCorregimiento = function (itemCorregimiento) {

    var promise = $http.get(base_api + "/obtener/veredas/" + itemCorregimiento);
    promise.then(function (responseveredas) {
      $scope.veredas = responseveredas.data;
    });
  };

  $scope.data_vereda = {
    'id': 1,
    'unit': null

    //fin 
    //inicio Data carga estado civl


  };$http.get(base_api + "/obtener/estados_civiles").success(function (response) {
    $scope.civiles = response;
  });
  //
  //Inicio Carga datos hijos crear

  $scope.tipo_hij = {
    'id': 1,
    'unit': null
  };

  $scope.hijo = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //Fin Carga datos hijos crear

  //inicio cargar datos modalidades

  $http.get(base_api + "/obtener/ocupaciones").success(function (ocupaciones) {

    $scope.ocupaciones = ocupaciones;
  });

  //Inicio Carga de datos Escolaridad Crear

  $http.get(base_api + "/obtenerselect/escolaridades").success(function (response) {

    $scope.escolaridades = response;
  });

  //Fin Carga de datos Escolaridad Crear

  //Inicio Carga de datos Estado Escolaridad Crear


  $http.get(base_api + "/obtenerselect/EstadoEscolaridades").success(function (response) {

    $scope.estadoescolaridades = response;
  });

  //Inicio Carga datos cultura crear

  $scope.tipo_cult = {
    'id': 1,
    'unit': null
  };

  $scope.clubes_deportivos = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/culturas").success(function (response) {

    $scope.etnias = response;
  });

  $http.get(base_api + "/obtener/clubesdeportivos").success(function (response) {
    $scope.clubes_deportivos_bd = response;
  });

  //Fin Carga datos cultura crear

  //inicio carga discapacidad si o no

  $scope.tipo_disc = {
    'id': 1,
    'unit': null
  };

  $scope.discapacidades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio carga afiliacion salud si o no

  $scope.tipo_afiliacion_salud = {
    'id': 1,
    'unit': null
  };

  $scope.afiliacion_salud = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin


  //inicio carga discapacidad si o no

  $scope.tipo_libreta = {
    'id': 1,
    'unit': null
  };

  $scope.libreta = [{ id: 1, nombre: 'Primera' }, { id: 2, nombre: 'Segunda' }];

  //fin


  //inicio carga salud si o no

  $scope.tipo_salud = {
    'id': 1,
    'unit': null
  };

  $scope.seguridad_social = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio carga alunos regimens


  $http.get(base_api + "/obtenerselect/salud_sgsss").success(function (response) {

    $scope.salud_sgsss = response;
  });

  //fin

  //inicio carga algunas discapacidades


  $scope.tipo_disc_otra = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (response) {

    $scope.discapacidad_otra = response;
  });

  //fin


  //Inicio cargar universidades
  $scope.selected = undefined;
  $http.get(base_api + "/obtenerselect/universidades").success(function (response) {

    $scope.universidades = response;
  });

  //Inicio cargar enfermedad si o no 

  $scope.tipo_eferm = {
    'id': 1,
    'unit': null
  };

  $scope.enfermedades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar data medicamentos si o no


  $scope.tipo_medic = {
    'id': 1,
    'unit': null
  };

  $scope.medicamentos = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar parentesco


  //inicio cargar data medicamentos si o no

  $scope.tipo_condicion = {
    'id': 1,
    'unit': null
  };

  $scope.condiciondiscapacidad = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  $scope.selectedCondicion = function (condicion) {

    if (condicion == 1) {
      $scope.ngShowhideDiscapacidad = true;
    } else {
      $scope.ngShowhideDiscapacidad = false;
    }
  };

  //fin


  //inicio carga Afiliacion


  $scope.tipo_afiliacion = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/afiliaciones").success(function (response) {

    $scope.afiliaciones = response;
  });

  //fin


  $scope.tipo_parent = null;

  $scope.parentescos = [{ id: 1, nombre: 'Madre/Padre' }, { id: 2, nombre: 'Hermana/Hermano' }, { id: 3, nombre: 'Tia/Tio' }, { id: 4, nombre: 'Abuela/Abuelo' }, { id: 5, nombre: 'Cuidador' }, { id: 6, nombre: 'Otro' }];
  //


  //inicio cargar poblacionales

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
  });

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (discapacidades) {

    $scope.allGruposDiscapacidades = discapacidades;
  });

  //fin

  $http.get(base_api + "/obtener/barrios").success(function (response) {

    $scope.barrios = response;
    // console.log($scope.barrios);
  });

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

    $scope.comunas = response;
  });

  $scope.selectedComuna = function (itemComuna) {

    $scope.tipo_barr = {
      'id': 1,
      'unit': null
    };
  };

  $scope.selectedBarrio = function (itemBarrio) {

    $http.get(base_api + "/obtener/nombre_ahdi/" + itemBarrio).success(function (response) {

      $scope.nombre_barrio = response.nombre_barrio.substring(0, 4);

      if ($scope.nombre_barrio == 'AHDI') {
        $("#direccion_residencia_plugin").hide();
        $scope.asentamiento = 1;
      }

      if ($scope.nombre_barrio != 'AHDI') {
        $("#direccion_residencia_plugin").show();
        $scope.asentamiento = null;
      }
    });

    $http.get(base_api + "/obtener/estrato/" + itemBarrio).success(function (estratobeneficiario) {
      $scope.tipo_estrato = parseInt(estratobeneficiario.id_estrato);
      $scope.comuna = estratobeneficiario.nombre_comuna;
      $scope.comuna_id = estratobeneficiario.comuna_id;
    });
  };

  $scope.ngShowhideBarrio = true;
  $scope.ngShowhideDireccion = true;
  $scope.ngShowhideComplemento = true;

  $scope.selectedVereda = function (seleccionvereda) {

    console.log(seleccionvereda);
    $http.get(base_api + "/obtener/estratoVereda/" + seleccionvereda).success(function (EstratoVereda) {
      $scope.tipo_estrato = EstratoVereda.estrato;
      $scope.comuna = EstratoVereda.nombre_comuna;
      $scope.comuna_id = EstratoVereda.id_comuna;
    });

    if (seleccionvereda != null) {
      $scope.ngShowhideBarrio = false;
      $scope.ngShowhideDireccion = false;
      $scope.ngShowhideComplemento = false;
      $scope.barrio = undefined;
    } else if (seleccionvereda == null) {
      $scope.vereda = undefined;
      $scope.corregimiento = undefined;
      $scope.ngShowhideBarrio = true;
      $scope.ngShowhideDireccion = true;
      $scope.ngShowhideComplemento = true;
      $scope.comuna = null;
    }
  };

  $scope.onBlurDocumento = function ($event) {

    var no_documento_beneficiario = $scope.no_documento_persona;

    $http.get(base_api + "/admin/postbeneficiariosprogramas/cargar/" + no_documento_beneficiario).success(function (response) {

      console.log(response);
      if (response.persona.length != 0 || response.ficha.length != 0 || response.acudiente.length != 0) {

        swal("Registro Existente!", "Este registro ya existe puedes actualizarlo y se agregara a este grupo si lo deseas!", "success");

        $scope.persona = response.persona[0];
        //Inicio Carga Persona
        //////////////////////
        //////////////////////
        //////////////////////
        //////////////////////
        $scope.tipo_doc = $scope.persona.id_documento_tipo;
        $scope.tipo_sex = $scope.persona.sexo;
        $scope.pais = $scope.persona.id_procedencia_pais;
        if ($scope.persona.id_procedencia_pais == 1) {

          $scope.ngShowhide1 = true;
          $scope.ngShowhide2 = false;
        } else if ($scope.persona.id_procedencia_pais != 1) {

          $scope.ngShowhide1 = false;
          $scope.ngShowhide2 = true;
        }

        $scope.departamento = $scope.persona.id_procedencia_departamento;
        var promise = $http.get(base_api + "/obtener/municipios/" + $scope.departamento);
        promise.then(function (responsemunicipios) {
          $scope.municipios = responsemunicipios.data;
        });
        $scope.municipio = $scope.persona.id_procedencia_municipio;
        $scope.corregimiento = $scope.persona.id_residencia_corregimiento;
        $scope.vereda = $scope.persona.id_residencia_vereda;
        var promise = $http.get(base_api + "/obtener/veredas/" + $scope.corregimiento);
        promise.then(function (responseveredas) {
          $scope.veredas = responseveredas.data;
        });
        if ($scope.vereda != null) {
          $scope.ngShowhideBarrio = false;
          $scope.ngShowhideDireccion = false;
          $scope.ngShowhideComplemento = false;
          $scope.barrio = undefined;
        }if ($scope.vereda == null) {
          $scope.vereda = undefined;
          $scope.corregimiento = undefined;
          $scope.ngShowhideBarrio = true;
          $scope.ngShowhideDireccion = true;
          $scope.ngShowhideComplemento = true;
        }

        if ($scope.persona.id_residencia_vereda != null) {
          $http.get(base_api + "/obtener/estratoVereda/" + $scope.persona.id_residencia_vereda).success(function (EstratoVereda) {

            $scope.tipo_estrato = EstratoVereda.estrato;
            $scope.comuna = EstratoVereda.nombre_comuna;
            $scope.comuna_id = EstratoVereda.id_comuna;
          });
        }

        $http.get(base_api + "/obtener/barrios").success(function (response) {
          $scope.barrios = response;
        });

        //Barrio Estrato y Comuna
        $scope.barrio = $scope.persona.id_residencia_barrio;
        $scope.tipo_estrato = $scope.persona.residencia_estrato;

        if ($scope.persona.id_residencia_barrio != null) {
          $http.get(base_api + "/obtener/estrato/" + $scope.persona.id_residencia_barrio).success(function (estratobeneficiario) {
            console.log(estratobeneficiario);
            $scope.comuna = estratobeneficiario.comuna_id;
            $scope.comuna_id = estratobeneficiario.comuna_id;
            $scope.tipo_estrato = estratobeneficiario.id_estrato;
          });
        }
        if ($scope.persona.residencia_direccion != null) {
          $("#direccion_residencia_plugin").hide();
        } else if ($scope.persona.residencia_direccion == '' || $scope.persona.residencia_direccion == null) {
          $("#direccion_residencia_plugin").show();
        }

        $scope.tipo_esc = $scope.persona.escolaridad_id;
        $scope.estado_esc = $scope.persona.estado_escolaridad;
        $scope.tipo_ocup = $scope.persona.ocupacion_id;
        $scope.tipo_est = $scope.persona.id_estado_civil;
        $scope.tipo_sag = $scope.persona.sangre_tipo;

        //Fin Carga Persona
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////          


        //Inicio Carga Ficha
        ////////////////////  
        ////////////////////  
        ////////////////////  
        ////////////////////  

        $scope.ficha = response.ficha[0];

        //tiene hijos?
        $scope.tipo_hij = {
          'id': 1,
          'unit': $scope.ficha.hijos_beneficiario
        };
        if ($scope.ficha.hijos_beneficiario == 1) {
          $scope.isDisabled = false;
        } else {
          $scope.isDisabled = true;
        }
        //fin tiene hijos
        //Se reconoce como
        $scope.tipo_etnias = $scope.ficha.cultura_beneficiario;
        $scope.clubes_deportivos_id = $scope.ficha.clubes_deportivos;

        $scope.tipo_disc = {
          'id': 1,
          'unit': $scope.ficha.discapacidad_beneficiario
        };

        if ($scope.ficha.discapacidad_beneficiario == 1) {
          $scope.isDisabledDiscapacidad = false;
        } else if ($scope.ficha.discapacidad_beneficiario != 1) {

          $scope.isDisabledDiscapacidad = true;
        }

        //Tipo Medicamentos
        $scope.tipo_medic = {
          'id': 1,
          'unit': $scope.ficha.medicamentos_permanente_beneficiario
        };
        if ($scope.ficha.medicamentos_permanente_beneficiario == 1) {
          $scope.isDisabledMedicamento = false;
        } else if ($scope.ficha.medicamentos_permanente_beneficiario != 1) {

          $scope.isDisabledMedicamento = true;
        }

        // Tiene Alguna condicion de discpacidad
        $scope.tipo_condicion = {
          'id': 1,
          'unit': $scope.ficha.condicion_discapacidad
        };
        if ($scope.ficha.condicion_discapacidad == 1) {
          $scope.ngShowhideDiscapacidad = true;
        } else {
          $scope.ngShowhideDiscapacidad = false;
        }

        //Se encuentra afiliado a la salud
        $scope.tipo_afiliacion_salud = {
          'id': 1,
          'unit': $scope.ficha.afiliacion_salud

          //Tipo de Afiliacion
        };$scope.tipo_afiliacion = $scope.ficha.tipo_afiliacion;

        //Entidad de salud o eps
        $scope.tipo_salud_otra = $scope.ficha.salud_sgss_id;

        //Parentesco acudiente
        $scope.tipo_parent = parseInt($scope.ficha.parentesco_acudiente);

        if (parseInt($scope.ficha.parentesco_acudiente) == 6) {
          $scope.isDisabledParentesco = false;
        } else {

          $scope.isDisabledParentesco = true;
        }

        //Fin Carga Ficha
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////    

        //Inicio Carga Acudiente
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////  

        $scope.acudiente = response.acudiente[0];
        $scope.tipo_doc_acudiente = $scope.acudiente.tipodocacudiente;
        $scope.tipo_sex_acudiente = $scope.acudiente.sexoacudiente;
      }

      $http.get(base_api + "/obtenerPrograma/poblacionalesDocumento/" + no_documento_beneficiario).success(function (response) {
        console.log(response);
        $scope.selectedPoblacionales = response;
        $scope.selectedPoblacionales.map(function (poblacional) {

          if (poblacional.id == 10) {
            $scope.ngShowhideOtro = true;
          }
          if (poblacional.id == 11) {
            $scope.ngShowhideClub = true;
          }
        });
      });

      $scope.otro_poblacional = $scope.ficha.otro_poblacional;
      $scope.club_poblacional = $scope.ficha.club_poblacional;

      $http.get(base_api + "/obtenerPrograma/discapacidadesDocumento/" + no_documento_beneficiario).success(function (response) {

        $scope.selectedDiscapacidades = response;
      });
    });
  };

  $scope.onBlurDocumentoAcudiente = function ($event) {

    var no_documento_acudiente = $scope.documento_acudiente;

    $http.get(base_api + "/admin/postbeneficiarios/cargarAcudiente/" + no_documento_acudiente).success(function (acudiente) {

      if (acudiente.length != 0) {

        swal("Registro Existente!", "Este registro ya existe puedes actualizarlo!", "success");

        $scope.acudiente = acudiente[0];

        $scope.tipo_doc_acudiente = $scope.acudiente.tipodocacudiente;
        $scope.tipo_sex_acudiente = $scope.acudiente.sexoacudiente;
      }
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
  };

  $scope.setEnd = function (date) {
    $scope.endDate = date;
    $scope.endDatep = date;
    $scope.endDateInscripcion = date;
  };

  $scope.tipo_documento = [{ id: '1', nombre: 'Registro Civil' }, { id: '2', nombre: 'Tarjeta Identidad' }, { id: '3', nombre: 'Cédula de Ciudadanía' }, { id: '4', nombre: 'Pasaporte' }, { id: '5', nombre: 'Sin Información' }];

  $scope.grupos_poblacionales = [{ id: '1', nombre: 'Adulto Mayor' }, { id: '2', nombre: 'Afrodescendiente/Afrocolombiano' }, { id: '3', nombre: 'Víctimas del conflicto armado' }, { id: '4', nombre: 'Habitante calle' }, { id: '5', nombre: 'LGBTI' }, { id: '6', nombre: 'Persona con discapacidad' }, { id: '7', nombre: 'Grupo organizado de Mujeres' }, { id: '8', nombre: 'Indígenas' }, { id: '9', nombre: 'Reinsertado' }, { id: '10', nombre: 'Junta de acción comunal (JAC)' }, { id: '11', nombre: 'Grupo organizado de Jóvenes' }, { id: '12', nombre: 'Ninguno' }, { id: '13', nombre: 'Recluido' }, { id: '14', nombre: 'Junta de administradora local (JAL)' }, { id: '15', nombre: 'Otro grupo' }];

  $scope.selected = {
    poblacionales: []
  };

  $http.get(base_api + "/obtener/programas").success(function (response) {

    $scope.programas = response;
  });

  $scope.pais = 1;

  $.ajax({
    url: base_api + "/obtener/paises",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.paises = response;
  }).error(function () {});

  $scope.data_paises = {
    'id': 1,
    'unit': 1
  };

  if ($scope.data_paises.unit == 1) {

    $scope.ngShowhide1 = true;
    $scope.ngShowhide2 = false;
  } else {

    $scope.ngShowhide1 = false;
    $scope.ngShowhide2 = true;
  }

  $scope.departamento = 76;
  $.ajax({
    url: base_api + "/obtener/departamentos/" + $scope.data_paises.unit,
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.departamentos = response;
  }).error(function () {});

  $scope.municipio = 834;
  $http.get(base_api + "/obtener/municipios/" + $scope.departamento).success(function (response) {
    $scope.municipios = response;
  });

  $scope.selectedPais = function (itemPais) {

    if (itemPais == 1) {

      $scope.ngShowhide1 = true;
      $scope.ngShowhide2 = false;
    } else {

      $scope.ngShowhide1 = false;
      $scope.ngShowhide2 = true;
    }

    $.ajax({
      url: base_api + "/obtener/departamentos/" + itemPais,
      type: 'GET',
      dataType: 'JSON',
      async: false
    }).success(function (response) {
      $scope.departamentos = response;
    }).error(function () {});
  };

  $scope.selectedDepartamento = function (itemDepartamento) {

    var promise = $http.get(base_api + "/obtener/municipios/" + itemDepartamento);
    promise.then(function (responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
    });
  };

  $scope.isDisabled = true;
  $scope.isDisabledOcupacion = true;
  $scope.isDisabledCultura = true;
  $scope.isDisabledDiscapacidad = true;
  $scope.isDisabledEnfermedad = true;
  $scope.isDisabledMedicamento = true;
  // $scope.isDisabledSeguridad = true;
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
      $scope.tipo_disc_otra.unit = null;
      $scope.ficha.otra_discapacidad_beneficiario = null;
    }
  };

  $scope.selectedMedicamento = function (itemMedicamento) {

    if (itemMedicamento == 1) {
      $scope.isDisabledMedicamento = false;
    } else {

      $scope.isDisabledMedicamento = true;
      $scope.ficha.medicamentos_beneficiario = null;
    }
  };

  // evento cambia orientacion sexual
  $scope.selectedOrientacionSexual = function (item) {
    $("#rowOtroOrientacionSexual").hide();
    $("#rowOtroOrientacionSexual").val("");
    $("#orientacion_sexual_otro").val("N/A").change();
    if (parseInt(item) == 13) {
      $("#rowOtroOrientacionSexual").show(500, "");
      $("#orientacion_sexual_otro").val("").change();
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

  $scope.ngShowhideOtro = false;
  $scope.ngShowhideClub = false;

  $scope.toggleSelection = function toggleSelection(seleccion) {

    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);

    // otro poblacional
    if (index == index && seleccion.id == 10) {
      $scope.ngShowhideOtro = true;
      $scope.otro_poblacional = '';
    }

    if (seleccion.id == 10) {
      $scope.ngShowhideOtro = true;
    }

    // club deportivo
    if (index == index && seleccion.id == 11) {
      $scope.ngShowhideClub = true;
      $scope.club_poblacional = '';
    }
    if (seleccion.id == 11) {
      $scope.ngShowhideClub = true;
    }

    if (index > -1) {
      $scope.selectedPoblacionales.splice(index, 1);

      if (index == 0 && seleccion.id == 10) {
        $scope.ngShowhideOtro = false;
        $scope.otro_poblacional = '';
      }
      if (index == 0 && seleccion.id == 11) {
        $scope.ngShowhideClub = false;
        $scope.club_poblacional = '';
      }

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/poblacionalPrograma/" + $scope.ficha.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedPoblacionales.push(seleccion);
    }
  };

  $scope.toggleSelectionDiscapacidad = function toggleSelectionDiscapacidad(seleccion) {

    var index = $scope.selectedDiscapacidades.indexOfObjectWithProperty('id', seleccion.id);
    // console.log(index);

    if (index > -1) {
      $scope.selectedDiscapacidades.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/discapacidadPrograma/" + $scope.ficha.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedDiscapacidades.push(seleccion);
    }
  };

  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;

  $scope.ficha = {
    'no_ficha': null
  };

  $scope.formsubmit = function (id, isValid) {

    if (isValid) {

      var direccion_sider = $("#id_persona_beneficiario_residencia_direccion").val();
      var cantidad_hijos_b = '';
      var otra_ocupacion = '';
      var otra_cultura = '';
      var cual_discapacidad = '';
      var otra_discapacidad = '';
      var enfermedad_benec = '';
      var medicamento_benec = '';
      var otra_salud = '';
      var seguridad_benec = '';
      var parentesco_benec = '';

      var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val();
      var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
      var fecha_inscripcion = $("#fecha_inscripcion").val();
      var SelectPoblacional = $scope.selectedPoblacionales;
      var SelectDiscapacidad = $scope.selectedDiscapacidades;

      if ($scope.no_ficha == undefined) {
        $scope.no_ficha = null;
      } else {
        $scope.no_ficha = $scope.no_ficha;
      }

      if ($scope.persona.nombre_segundo == undefined) {
        $scope.persona.nombre_segundo = null;
      } else {
        $scope.persona.nombre_segundo = $scope.persona.nombre_segundo;
      }

      if ($scope.persona.apellido_primero == undefined) {
        $scope.persona.apellido_primero = null;
      } else {
        $scope.persona.apellido_primero = $scope.persona.apellido_primero;
      }

      if ($scope.persona.apellido_segundo == undefined) {
        $scope.persona.apellido_segundo = null;
      } else {
        $scope.persona.apellido_segundo = $scope.persona.apellido_segundo;
      }

      if ($scope.persona.telefono_fijo == undefined) {
        $scope.persona.telefono_fijo = null;
      } else {
        $scope.persona.telefono_fijo = $scope.persona.telefono_fijo;
      }

      if ($scope.persona.telefono_movil == undefined) {
        $scope.persona.telefono_movil = null;
      } else {
        $scope.persona.telefono_movil = $scope.persona.telefono_movil;
      }

      if ($scope.persona.correo_electronico == undefined) {
        $scope.persona.correo_electronico = null;
      } else {
        $scope.persona.correo_electronico = $scope.persona.correo_electronico;
      }

      if ($scope.otro_poblacional == undefined) {
        otro_poblacional = null;
      } else if ($scope.otro_poblacional != null) {
        otro_poblacional = $scope.otro_poblacional;
      }

      if ($scope.club_poblacional == undefined) {
        club_poblacional = null;
      } else if ($scope.club_poblacional != null) {
        club_poblacional = $scope.club_poblacional;
      }

      if ($scope.cantidad_hijos_beneficiario == undefined) {
        cantidad_hijos_b = null;
      } else if ($scope.cantidad_hijos_beneficiario != null) {
        cantidad_hijos_b = $scope.cantidad_hijos_beneficiario;
      }

      if ($scope.tipo_disc_otra.unit == undefined) {
        cual_discapacidad = null;
      } else if ($scope.tipo_disc_otra.unit != null) {
        cual_discapacidad = $scope.tipo_disc_otra.unit;
      }

      if ($scope.otra_discapacidad_beneficiario == undefined) {
        otra_discapacidad = null;
      } else if ($scope.otra_discapacidad_beneficiario != null) {
        otra_discapacidad = $scope.otra_discapacidad_beneficiario;
      }

      if ($scope.medicamentos_beneficiario == undefined) {
        medicamento_benec = null;
      } else if ($scope.medicamentos_beneficiario != null) {
        medicamento_benec = $scope.medicamentos_beneficiario;
      }

      if ($scope.otro_parentesco_acudiente == undefined) {
        parentesco_benec = null;
      } else if ($scope.otro_parentesco_acudiente != null) {
        parentesco_benec = $scope.otro_parentesco_acudiente;
      }

      if ($scope.corregimiento == undefined) {
        corregimiento_persona = null;
      } else if ($scope.corregimiento != null) {
        corregimiento_persona = $scope.corregimiento;
      }

      if ($scope.vereda == undefined) {
        vereda_persona = null;
      } else if ($scope.vereda != null) {
        vereda_persona = $scope.vereda;
      }
      if ($scope.barrio == undefined) {
        $scope.barrio = null;
      } else if ($scope.barrio != null) {
        $scope.barrio = $scope.barrio;
      }

      var ficha_registro = 0;
      if ($scope.ficha_save == null) {

        ficha_registro = 0;
      }

      if ($scope.ficha_save == undefined) {
        ficha_registro = 0;
      } else if ($scope.ficha_save > 0) {

        ficha_registro = $scope.ficha_save;
      }

      if ($scope.persona.otro_municipio == undefined) {
        $scope.persona.otro_municipio = null;
      } else if ($scope.persona.otro_municipio != null) {
        $scope.persona.otro_municipio = $scope.persona.otro_municipio;
      }

      if ($scope.documento_acudiente == undefined) {
        $scope.documento_acudiente = null;
      } else if ($scope.documento_acudiente != null) {
        $scope.documento_acudiente = $scope.documento_acudiente;
      }

      if ($scope.tipo_etnias == undefined) {
        $scope.tipo_etnias = null;
      } else if ($scope.tipo_etnias != null) {
        $scope.tipo_etnias = $scope.tipo_etnias;
      }

      if ($scope.clubes_deportivos == undefined) {
        $scope.clubes_deportivos = null;
      } else if ($scope.clubes_deportivos != null) {
        $scope.clubes_deportivos = $scope.clubes_deportivos;
      }

      if ($scope.tipo_sag == undefined) {
        $scope.tipo_sag = null;
      } else if ($scope.tipo_sag != null) {
        $scope.tipo_sag = $scope.tipo_sag;
      }

      if ($scope.tipo_est == undefined) {
        $scope.tipo_est = null;
      } else if ($scope.tipo_est != null) {
        $scope.tipo_est = $scope.tipo_est;
      }

      if ($scope.tipo_esc == undefined) {
        $scope.tipo_esc = null;
      } else if ($scope.tipo_esc != null) {
        $scope.tipo_esc = $scope.tipo_esc;
      }

      if ($scope.estado_esc == undefined) {
        $scope.estado_esc = null;
      } else if ($scope.estado_esc != null) {
        $scope.estado_esc = $scope.estado_esc;
      }

      if ($scope.tipo_ocup == undefined) {
        $scope.tipo_ocup = null;
      } else if ($scope.tipo_ocup != null) {
        $scope.tipo_ocup = $scope.tipo_ocup;
      }

      if ($scope.tipo_sex == undefined) {
        $scope.tipo_sex = null;
      } else if ($scope.tipo_sex != null) {
        $scope.tipo_sex = $scope.tipo_sex;
      }

      if ($scope.tipo_salud_otra == undefined) {
        $scope.tipo_salud_otra = null;
      } else if ($scope.tipo_salud_otra != null) {
        $scope.tipo_salud_otra = $scope.tipo_salud_otra;
      }

      var datos = {
        //Datos Persona
        tipo_doc_persona: $scope.tipo_doc,
        no_documento_persona: $scope.no_documento_persona,
        primer_nombre_persona: $scope.persona.nombre_primero,
        segundo_nombre_persona: $scope.persona.nombre_segundo,
        primer_apellido_persona: $scope.persona.apellido_primero,
        segundo_apellido_persona: $scope.persona.apellido_segundo,
        correo_persona: $scope.persona.correo_electronico,
        otro_municipio: $scope.persona.otro_municipio,

        sexo_persona: $scope.tipo_sex,

        tipo_genero_r: $scope.tipo_sex_real.unit,
        tipo_orientacion_sexual: $scope.tipo_orientacion_sexual.unit,
        orientacion_sexual_otro: $scope.persona.orientacion_sexual_otro,

        fecha_nac_persona: fecha_nacimiento_beneficiario,
        pais_id: $scope.pais,
        departamento_id: $scope.departamento,
        municipio_id: $scope.municipio,
        corregimiento: corregimiento_persona,
        vereda: vereda_persona,
        barrio_id: $scope.barrio,
        estrato: $scope.tipo_estrato,
        residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
        complemento: $("#id_persona_beneficiario_residencia_direccion_complemento").val(),
        telefono_fijo_persona: $scope.persona.telefono_fijo,
        telefono_movil_persona: $scope.persona.telefono_movil,
        tip_sangre_persona: $scope.tipo_sag,
        estado_civil_persona: $scope.tipo_est,

        //Acudiente Persona
        primer_nombre_acudiente: $('#nombre_primero_acudiente').val(),
        segundo_nombre_acudiente: $('#nombre_segundo_acudiente').val(),
        primer_apellido_acudiente: $('#apellido_primero_acudiente').val(),
        segundo_apellido_acudiente: $('#apellido_segundo_acudiente').val(),
        sex_pariente: $scope.tipo_sex_acudiente,
        fecha_nac_acudiente: fecha_nacimiento_acudiente,
        telefono_fijo_acudiente: $('#telefono_fijo_acudiente').val(),
        telefono_movil_acudiente: $('#telefono_movil_acudiente').val(),
        correo_acudiente: $('#correo_electronico_acudiente').val(),
        no_documento_acudiente: $('#documento_acudiente').val(),
        tip_doc_acudiente: $scope.tipo_doc_acudiente,

        //Datos Beneficiario     
        no_ficha: $scope.no_ficha,
        fecha_inscripcion: fecha_inscripcion,
        escolaridad_beneficiario: $scope.tipo_esc,
        estado_escolaridad: $scope.estado_esc,
        ocupacion_beneficiario: $scope.tipo_ocup,
        hijos_beneficiario: $scope.tipo_hij.unit,
        cantidad_hijos_beneficiario: cantidad_hijos_b,

        cultura_beneficiario: $scope.tipo_etnias,
        clubes_deportivos_id: $scope.clubes_deportivos,

        discapacidad_beneficiario: $scope.tipo_disc.unit,
        otra_discapacidad_beneficiario: otra_discapacidad,
        medicamentos_permanente_beneficiario: $scope.tipo_medic.unit,
        medicamentos_beneficiario: medicamento_benec,
        condicion_discapacidad: $scope.tipo_condicion.unit,
        afiliacion_salud: $scope.tipo_afiliacion_salud.unit,
        tipo_afiliacion: $scope.tipo_afiliacion,
        salud_sgsss_beneficiario: $scope.tipo_salud_otra,
        parentesco_acudiente: $scope.tipo_parent,
        otro_parentesco_acudiente: parentesco_benec,
        ficha: ficha_registro,
        otro_poblacional: otro_poblacional,

        comuna: $scope.comuna_id

      };

      // console.log($scope.acudiente.nombre_primero_acudiente);

      if (corregimiento_persona == null && direccion_sider == '' && $scope.asentamiento == null) {

        swal("Algo te hace falta!", "Verifique que su campo Dirección no este vacio!", "error");
        toastr.error("Verifique que su campo Dirección no este vacio", "Campo Dirección");
      }

      if ($scope.tipo_doc_acudiente.unit == 2 || $scope.tipo_doc_acudiente.unit == 3) {
        swal("Verifica tu información!", "Tipo de documento no valido!", "error");
        toastr.error("Tipo de documento no valido", "Tipo Documento");
      } else {

        $.ajax({
          url: base_api + '/postbeneficiarioprograma/create/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            datos: datos,
            SelectPoblacional: SelectPoblacional,
            SelectDiscapacidad: SelectDiscapacidad
          }

        }).success(function () {
          //mensaje almacenado
          swal("Muy bien!", "Su registro ha sido exitoso", "success");
          toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
          window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
        }).error(function () {
          console.log("success");
        });
      };
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/BeneficiarioViactivaGrupoCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("BeneficiarioViactivaGrupoCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q) {

  $scope.reset = function () {
    $scope.state = undefined;
  };

  $scope.ngShowhide1Vereda = true;
  $scope.title = "Beneficiario Grupo";
  $scope.series = [];
  $scope.selectedPoblacionales = [];
  $scope.selectedDiscapacidades = [];

  $scope.getData = function () {
    $scope.serie = GrupoService.get({ id: $routeParams.id });
    console.log();
  };

  $scope.grupo_save = $routeParams.id;

  $scope.serie = {};

  $scope.title = "Agregar Beneficiario";
  $scope.disable_submit = false;
  $scope.serie = {};

  $(function () {
    $('#id_persona_beneficiario_residencia_direccion').add_generator({
      direccion: 'id_persona_beneficiario_residencia_direccion',
      complemento: 'id_persona_beneficiario_residencia_direccion_complemento'
    });
  });

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
    $('[name=documento_beneficiario]').maskNumber({ integer: true });
  });
  $(document).ready(function () {
    $('[name=documento_acudiente]').maskNumber({ integer: true });
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_nacimiento").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "1910:+nn"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_nacimiento_acudiente").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "1910:+nn"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_inscripcion").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "-99:+0",
      maxDate: "+0m +0d"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  var d = new Date();
  $scope.fecha_inscripcion = $.datepicker.formatDate("yy-mm-dd", new Date(d));

  $("#direccion_residencia_plugin").show();

  //Inicio Carga de datos Documento Crear

  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {
    $scope.tipodocumento = response;
  });

  //Fin Carga de datos Documento Crear

  //inicio tipo documento acudients

  $scope.tipo_doc_acudiente = {
    'id': 1,
    'unit': null

    //fin
    //Inicio Carga datos sexo crear

  };$scope.estrato = [{ id: 1, nombre: '1' }, { id: 2, nombre: '2' }, { id: 3, nombre: '3' }, { id: 4, nombre: '4' }, { id: 5, nombre: '5' }, { id: 6, nombre: '6' }, { id: 7, nombre: '7' }];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo crear

  $scope.sexo = [{ id: 1, nombre: 'Mujer' }, { id: 2, nombre: 'Hombre' }];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo crear

  $scope.tipo_sex_acudiente = {
    'id': 1,
    'unit': null

    //Fin Carga datos sexo crear

    //Inicio Carga datos sexo real crear

  };$scope.tipo_sex_real = {
    'id': 1,
    'unit': null
  };

  $scope.sexo_real = [{ id: 1, nombre: 'Heterosexual' }, { id: 2, nombre: 'Homosexual' }, { id: 3, nombre: 'Bisexual' }];

  //Fin Carga datos sexo real crear

  //Inicio Carga datos orientacion sexual crear

  $scope.tipo_orientacion_sexual = {
    'id': 1,
    'unit': null
  };

  $scope.sexo_orientacion_sexual = [{ id: 1, nombre: 'Lesbiana' }, { id: 2, nombre: 'Gay' }, { id: 3, nombre: 'Bisexual' }, { id: 4, nombre: 'Transformista' }, { id: 5, nombre: 'Transvestido' }, { id: 6, nombre: 'Transgenerista' }, { id: 7, nombre: 'Transexual' }, { id: 8, nombre: 'Intersexual' }, { id: 9, nombre: 'Querés' }, { id: 10, nombre: 'Pansexual' }, { id: 11, nombre: 'HSH' }, { id: 12, nombre: 'Queers' }, { id: 13, nombre: 'Otro' }];

  //Fin Carga datos orientacion sexual crear


  //Inicio Carga datos tipo de sangre

  $scope.sangre = [{ id: '1', nombre: 'O+' }, { id: '2', nombre: 'O-' }, { id: '3', nombre: 'A+' }, { id: '4', nombre: 'A-' }, { id: '5', nombre: 'B+' }, { id: '6', nombre: 'B-' }, { id: '7', nombre: 'AB+' }, { id: '8', nombre: 'AB-' }];

  //Fin Carga datos tipo de sangre


  $scope.tipo_com = {
    'id': 1,
    'unit': null

    //inicio cargar datos corregimientos

  };$scope.data_corregimiento = {
    'id': 1,
    'unit': null
  };

  $.ajax({
    url: base_api + "/obtener/corregimientos",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.corregimientos = response;
  }).error(function () {});

  //inicio cargar datos modalidades

  $scope.data_modalidad = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtener/modalidades").success(function (modalidades) {

    $scope.modalidades = modalidades;
  });

  //inicio cargar datos puntos de atencion

  $scope.data_puntoatencion = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtener/puntosatencion").success(function (puntosatencion) {

    $scope.puntosatencion = puntosatencion;
  });

  $scope.selectedCorregimiento = function (itemCorregimiento) {

    var promise = $http.get(base_api + "/obtener/veredas/" + itemCorregimiento);
    promise.then(function (responseveredas) {
      $scope.veredas = responseveredas.data;
    });
  };

  $scope.data_vereda = {
    'id': 1,
    'unit': null

    //fin 
    //inicio Data carga estado civl


  };$http.get(base_api + "/obtener/estados_civiles").success(function (response) {
    $scope.civiles = response;
  });
  //
  //Inicio Carga datos hijos crear

  $scope.tipo_hij = {
    'id': 1,
    'unit': null
  };

  $scope.hijo = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //Fin Carga datos hijos crear

  //inicio cargar datos modalidades

  $http.get(base_api + "/obtener/ocupaciones").success(function (ocupaciones) {

    $scope.ocupaciones = ocupaciones;
  });

  //Inicio Carga de datos Escolaridad Crear

  $http.get(base_api + "/obtenerselect/escolaridades").success(function (response) {

    $scope.escolaridades = response;
  });

  //Fin Carga de datos Escolaridad Crear

  //Inicio Carga de datos Estado Escolaridad Crear


  $http.get(base_api + "/obtenerselect/EstadoEscolaridades").success(function (response) {

    $scope.estadoescolaridades = response;
  });

  //Inicio Carga datos cultura crear

  $scope.tipo_cult = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/culturas").success(function (response) {

    $scope.etnias = response;
  });

  //Fin Carga datos cultura crear

  //inicio carga discapacidad si o no

  $scope.tipo_disc = {
    'id': 1,
    'unit': null
  };

  $scope.discapacidades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio carga afiliacion salud si o no

  $scope.tipo_afiliacion_salud = {
    'id': 1,
    'unit': null
  };

  $scope.afiliacion_salud = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin


  //inicio carga discapacidad si o no

  $scope.tipo_libreta = {
    'id': 1,
    'unit': null
  };

  $scope.libreta = [{ id: 1, nombre: 'Primera' }, { id: 2, nombre: 'Segunda' }];

  //fin


  //inicio carga salud si o no

  $scope.tipo_salud = {
    'id': 1,
    'unit': null
  };

  $scope.seguridad_social = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio carga alunos regimens


  $http.get(base_api + "/obtenerselect/salud_sgsss").success(function (response) {

    $scope.salud_sgsss = response;
  });

  //fin

  //inicio carga algunas discapacidades


  $scope.tipo_disc_otra = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (response) {

    $scope.discapacidad_otra = response;
  });

  //fin


  //Inicio cargar universidades
  $scope.selected = undefined;
  $http.get(base_api + "/obtenerselect/universidades").success(function (response) {

    $scope.universidades = response;
  });

  //Inicio cargar enfermedad si o no 

  $scope.tipo_eferm = {
    'id': 1,
    'unit': null
  };

  $scope.enfermedades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar data medicamentos si o no


  $scope.tipo_medic = {
    'id': 1,
    'unit': null
  };

  $scope.medicamentos = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar parentesco


  //inicio cargar data medicamentos si o no

  $scope.tipo_condicion = {
    'id': 1,
    'unit': null
  };

  $scope.condiciondiscapacidad = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  $scope.selectedCondicion = function (condicion) {

    if (condicion == 1) {
      $scope.ngShowhideDiscapacidad = true;
    } else {
      $scope.ngShowhideDiscapacidad = false;
    }
  };

  //fin


  //inicio carga Afiliacion


  $scope.tipo_afiliacion = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/afiliaciones").success(function (response) {

    $scope.afiliaciones = response;
  });

  //fin


  $scope.tipo_parent = null;

  $scope.parentescos = [{ id: 1, nombre: 'Madre/Padre' }, { id: 2, nombre: 'Hermana/Hermano' }, { id: 3, nombre: 'Tia/Tio' }, { id: 4, nombre: 'Abuela/Abuelo' }, { id: 5, nombre: 'Cuidador' }, { id: 6, nombre: 'Otro' }];
  //


  //inicio cargar poblacionales

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
  });

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (discapacidades) {

    $scope.allGruposDiscapacidades = discapacidades;
  });

  //fin

  $http.get(base_api + "/obtener/barrios").success(function (response) {

    $scope.barrios = response;
    // console.log($scope.barrios);
  });

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

    $scope.comunas = response;
  });

  $scope.selectedComuna = function (itemComuna) {

    $scope.tipo_barr = {
      'id': 1,
      'unit': null
    };
  };

  $scope.selectedBarrio = function (itemBarrio) {

    $http.get(base_api + "/obtener/estrato/" + itemBarrio).success(function (estratobeneficiario) {
      $scope.tipo_estrato = parseInt(estratobeneficiario.id_estrato);
      $scope.comuna = estratobeneficiario.nombre_comuna;
      $scope.comuna_id = estratobeneficiario.comuna_id;
    });
  };

  $scope.ngShowhideBarrio = true;
  $scope.ngShowhideDireccion = true;
  $scope.ngShowhideComplemento = true;

  $scope.selectedVereda = function (seleccionvereda) {

    console.log(seleccionvereda);
    $http.get(base_api + "/obtener/estratoVereda/" + seleccionvereda).success(function (EstratoVereda) {
      $scope.tipo_estrato = EstratoVereda.estrato;
      $scope.comuna = EstratoVereda.nombre_comuna;
      $scope.comuna_id = EstratoVereda.id_comuna;
    });

    if (seleccionvereda != null) {
      $scope.ngShowhideBarrio = false;
      $scope.ngShowhideDireccion = false;
      $scope.ngShowhideComplemento = false;
      $scope.barrio = undefined;
    } else if (seleccionvereda == null) {
      $scope.vereda = undefined;
      $scope.corregimiento = undefined;
      $scope.ngShowhideBarrio = true;
      $scope.ngShowhideDireccion = true;
      $scope.ngShowhideComplemento = true;
      $scope.comuna = null;
    }
  };

  $scope.onBlurDocumento = function ($event) {

    var no_documento_beneficiario = $scope.no_documento_persona;

    $http.get(base_api + "/admin/postbeneficiariosprogramas/cargar/" + no_documento_beneficiario).success(function (response) {

      console.log(response);
      if (response.persona.length != 0 || response.ficha.length != 0 || response.acudiente.length != 0) {

        swal("Registro Existente!", "Este registro ya existe puedes actualizarlo y se agregara a este grupo si lo deseas!", "success");

        $scope.persona = response.persona[0];
        //Inicio Carga Persona
        //////////////////////
        //////////////////////
        //////////////////////
        //////////////////////
        $scope.tipo_doc = $scope.persona.id_documento_tipo;
        $scope.tipo_sex = $scope.persona.sexo;
        $scope.pais = $scope.persona.id_procedencia_pais;
        if ($scope.persona.id_procedencia_pais == 1) {

          $scope.ngShowhide1 = true;
          $scope.ngShowhide2 = false;
        } else if ($scope.persona.id_procedencia_pais != 1) {

          $scope.ngShowhide1 = false;
          $scope.ngShowhide2 = true;
        }

        $scope.departamento = $scope.persona.id_procedencia_departamento;
        var promise = $http.get(base_api + "/obtener/municipios/" + $scope.departamento);
        promise.then(function (responsemunicipios) {
          $scope.municipios = responsemunicipios.data;
        });
        $scope.municipio = $scope.persona.id_procedencia_municipio;
        $scope.corregimiento = $scope.persona.id_residencia_corregimiento;
        $scope.vereda = $scope.persona.id_residencia_vereda;
        var promise = $http.get(base_api + "/obtener/veredas/" + $scope.corregimiento);
        promise.then(function (responseveredas) {
          $scope.veredas = responseveredas.data;
        });
        if ($scope.vereda != null) {
          $scope.ngShowhideBarrio = false;
          $scope.ngShowhideDireccion = false;
          $scope.ngShowhideComplemento = false;
          $scope.barrio = undefined;
        }if ($scope.vereda == null) {
          $scope.vereda = undefined;
          $scope.corregimiento = undefined;
          $scope.ngShowhideBarrio = true;
          $scope.ngShowhideDireccion = true;
          $scope.ngShowhideComplemento = true;
        }

        if ($scope.persona.id_residencia_vereda != null) {
          $http.get(base_api + "/obtener/estratoVereda/" + $scope.persona.id_residencia_vereda).success(function (EstratoVereda) {

            $scope.tipo_estrato = EstratoVereda.estrato;
            $scope.comuna = EstratoVereda.nombre_comuna;
            $scope.comuna_id = EstratoVereda.id_comuna;
          });
        }

        $http.get(base_api + "/obtener/barrios").success(function (response) {
          $scope.barrios = response;
        });

        //Barrio Estrato y Comuna
        $scope.barrio = $scope.persona.id_residencia_barrio;
        $scope.tipo_estrato = $scope.persona.residencia_estrato;

        if ($scope.persona.id_residencia_barrio != null) {
          $http.get(base_api + "/obtener/estrato/" + $scope.persona.id_residencia_barrio).success(function (estratobeneficiario) {
            console.log(estratobeneficiario);
            $scope.comuna = estratobeneficiario.comuna_id;
            $scope.comuna_id = estratobeneficiario.comuna_id;
            $scope.tipo_estrato = estratobeneficiario.id_estrato;
          });
        }
        if ($scope.persona.residencia_direccion != null) {
          $("#direccion_residencia_plugin").hide();
        } else if ($scope.persona.residencia_direccion == '' || $scope.persona.residencia_direccion == null) {
          $("#direccion_residencia_plugin").show();
        }

        $scope.tipo_esc = $scope.persona.escolaridad_id;
        $scope.estado_esc = $scope.persona.estado_escolaridad;
        $scope.tipo_ocup = $scope.persona.ocupacion_id;
        $scope.tipo_est = $scope.persona.id_estado_civil;
        $scope.tipo_sag = $scope.persona.sangre_tipo;

        //Fin Carga Persona
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////          


        //Inicio Carga Ficha
        ////////////////////  
        ////////////////////  
        ////////////////////  
        ////////////////////  

        $scope.ficha = response.ficha[0];

        //tiene hijos?
        $scope.tipo_hij = {
          'id': 1,
          'unit': $scope.ficha.hijos_beneficiario
        };
        if ($scope.ficha.hijos_beneficiario == 1) {
          $scope.isDisabled = false;
        } else {
          $scope.isDisabled = true;
        }
        //fin tiene hijos
        //Se reconoce como
        $scope.tipo_etnias = $scope.ficha.cultura_beneficiario;

        $scope.tipo_disc = {
          'id': 1,
          'unit': $scope.ficha.discapacidad_beneficiario
        };

        if ($scope.ficha.discapacidad_beneficiario == 1) {
          $scope.isDisabledDiscapacidad = false;
        } else if ($scope.ficha.discapacidad_beneficiario != 1) {

          $scope.isDisabledDiscapacidad = true;
        }

        //Tipo Medicamentos
        $scope.tipo_medic = {
          'id': 1,
          'unit': $scope.ficha.medicamentos_permanente_beneficiario
        };
        if ($scope.ficha.medicamentos_permanente_beneficiario == 1) {
          $scope.isDisabledMedicamento = false;
        } else if ($scope.ficha.medicamentos_permanente_beneficiario != 1) {

          $scope.isDisabledMedicamento = true;
        }

        // Tiene Alguna condicion de discpacidad
        $scope.tipo_condicion = {
          'id': 1,
          'unit': $scope.ficha.condicion_discapacidad
        };
        if ($scope.ficha.condicion_discapacidad == 1) {
          $scope.ngShowhideDiscapacidad = true;
        } else {
          $scope.ngShowhideDiscapacidad = false;
        }

        //Se encuentra afiliado a la salud
        $scope.tipo_afiliacion_salud = {
          'id': 1,
          'unit': $scope.ficha.afiliacion_salud

          //Tipo de Afiliacion
        };$scope.tipo_afiliacion = $scope.ficha.tipo_afiliacion;

        //Entidad de salud o eps
        $scope.tipo_salud_otra = $scope.ficha.salud_sgss_id;

        //Parentesco acudiente
        $scope.tipo_parent = parseInt($scope.ficha.parentesco_acudiente);

        if (parseInt($scope.ficha.parentesco_acudiente) == 6) {
          $scope.isDisabledParentesco = false;
        } else {

          $scope.isDisabledParentesco = true;
        }

        //Fin Carga Ficha
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////    

        //Inicio Carga Acudiente
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////
        ///////////////////  

        $scope.acudiente = response.acudiente[0];
        $scope.tipo_doc_acudiente = $scope.acudiente.tipodocacudiente;
        $scope.tipo_sex_acudiente = $scope.acudiente.sexoacudiente;
      }

      console.log(no_documento_beneficiario);

      $http.get(base_api + "/obtenerPrograma/poblacionalesDocumento/" + no_documento_beneficiario).success(function (response) {
        console.log(response);
        $scope.selectedPoblacionales = response;
        $scope.selectedPoblacionales.map(function (poblacional) {

          if (poblacional.id == 10) {
            $scope.ngShowhideOtro = true;
          } else if (poblacional.id != 10) {
            $scope.ngShowhideOtro = false;
          }
        });
      });

      $scope.otro_poblacional = $scope.ficha.otro_poblacional;

      $http.get(base_api + "/obtenerPrograma/discapacidadesDocumento/" + no_documento_beneficiario).success(function (response) {

        $scope.selectedDiscapacidades = response;
      });
    });
  };

  $scope.onBlurDocumentoAcudiente = function ($event) {

    var no_documento_acudiente = $scope.documento_acudiente;

    $http.get(base_api + "/admin/postbeneficiarios/cargarAcudiente/" + no_documento_acudiente).success(function (acudiente) {

      if (acudiente.length != 0) {

        swal("Registro Existente!", "Este registro ya existe puedes actualizarlo!", "success");

        $scope.acudiente = acudiente[0];

        $scope.tipo_doc_acudiente = $scope.acudiente.tipodocacudiente;
        $scope.tipo_sex_acudiente = $scope.acudiente.sexoacudiente;
      }
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
  };

  $scope.setEnd = function (date) {
    $scope.endDate = date;
    $scope.endDatep = date;
    $scope.endDateInscripcion = date;
  };

  $scope.tipo_documento = [{ id: '1', nombre: 'Registro Civil' }, { id: '2', nombre: 'Tarjeta Identidad' }, { id: '3', nombre: 'Cédula de Ciudadanía' }, { id: '4', nombre: 'Pasaporte' }, { id: '5', nombre: 'Sin Información' }];

  $scope.grupos_poblacionales = [{ id: '1', nombre: 'Adulto Mayor' }, { id: '2', nombre: 'Afrodescendiente/Afrocolombiano' }, { id: '3', nombre: 'Víctimas del conflicto armado' }, { id: '4', nombre: 'Habitante calle' }, { id: '5', nombre: 'LGBTI' }, { id: '6', nombre: 'Persona con discapacidad' }, { id: '7', nombre: 'Grupo organizado de Mujeres' }, { id: '8', nombre: 'Indígenas' }, { id: '9', nombre: 'Reinsertado' }, { id: '10', nombre: 'Junta de acción comunal (JAC)' }, { id: '11', nombre: 'Grupo organizado de Jóvenes' }, { id: '12', nombre: 'Ninguno' }, { id: '13', nombre: 'Recluido' }, { id: '14', nombre: 'Junta de administradora local (JAL)' }, { id: '15', nombre: 'Otro grupo' }];

  $scope.selected = {
    poblacionales: []
  };

  $http.get(base_api + "/obtener/programas").success(function (response) {

    $scope.programas = response;
  });

  $scope.pais = 1;

  $.ajax({
    url: base_api + "/obtener/paises",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.paises = response;
  }).error(function () {});

  $scope.data_paises = {
    'id': 1,
    'unit': 1
  };

  if ($scope.data_paises.unit == 1) {

    $scope.ngShowhide1 = true;
    $scope.ngShowhide2 = false;
  } else {

    $scope.ngShowhide1 = false;
    $scope.ngShowhide2 = true;
  }

  $scope.departamento = 76;
  $.ajax({
    url: base_api + "/obtener/departamentos/" + $scope.data_paises.unit,
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.departamentos = response;
  }).error(function () {});

  $scope.municipio = 834;
  $http.get(base_api + "/obtener/municipios/" + $scope.departamento).success(function (response) {
    $scope.municipios = response;
  });

  $scope.selectedPais = function (itemPais) {

    if (itemPais == 1) {

      $scope.ngShowhide1 = true;
      $scope.ngShowhide2 = false;
    } else {

      $scope.ngShowhide1 = false;
      $scope.ngShowhide2 = true;
    }

    $.ajax({
      url: base_api + "/obtener/departamentos/" + itemPais,
      type: 'GET',
      dataType: 'JSON',
      async: false
    }).success(function (response) {
      $scope.departamentos = response;
    }).error(function () {});
  };

  $scope.selectedDepartamento = function (itemDepartamento) {

    var promise = $http.get(base_api + "/obtener/municipios/" + itemDepartamento);
    promise.then(function (responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
    });
  };

  $scope.isDisabled = true;
  $scope.isDisabledOcupacion = true;
  $scope.isDisabledCultura = true;
  $scope.isDisabledDiscapacidad = true;
  $scope.isDisabledEnfermedad = true;
  $scope.isDisabledMedicamento = true;
  // $scope.isDisabledSeguridad = true;
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
      $scope.tipo_disc_otra.unit = null;
      $scope.ficha.otra_discapacidad_beneficiario = null;
    }
  };

  $scope.selectedMedicamento = function (itemMedicamento) {

    if (itemMedicamento == 1) {
      $scope.isDisabledMedicamento = false;
    } else {

      $scope.isDisabledMedicamento = true;
      $scope.ficha.medicamentos_beneficiario = null;
    }
  };

  // evento cambia orientacion sexual
  $scope.selectedOrientacionSexual = function (item) {
    console.log("aca-->");
    $("#rowOtroOrientacionSexual").hide();
    $("#rowOtroOrientacionSexual").val("");
    $("#orientacion_sexual_otro").val("N/A").change();
    if (parseInt(item) == 13) {
      $("#rowOtroOrientacionSexual").show(500, "");
      $("#orientacion_sexual_otro").val("").change();
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

  $scope.ngShowhideOtro = false;

  $scope.toggleSelection = function toggleSelection(seleccion) {

    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);

    if (index == index && seleccion.id == 10) {
      $scope.ngShowhideOtro = true;
      $scope.otro_poblacional = '';
    }

    if (seleccion.id == 10) {
      $scope.ngShowhideOtro = true;
    }

    if (index > -1) {
      $scope.selectedPoblacionales.splice(index, 1);

      if (index == 0 && seleccion.id == 10) {
        $scope.ngShowhideOtro = false;
        $scope.otro_poblacional = '';
      }

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/poblacionalPrograma/" + $scope.ficha.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedPoblacionales.push(seleccion);
    }
  };

  $scope.toggleSelectionDiscapacidad = function toggleSelectionDiscapacidad(seleccion) {

    var index = $scope.selectedDiscapacidades.indexOfObjectWithProperty('id', seleccion.id);
    // console.log(index);

    if (index > -1) {
      $scope.selectedDiscapacidades.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/discapacidadPrograma/" + $scope.ficha.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedDiscapacidades.push(seleccion);
    }
  };

  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;

  $scope.ficha = {
    'no_ficha': null
  };

  $scope.formsubmit = function (id, isValid) {

    if (isValid) {

      var direccion_sider = $("#id_persona_beneficiario_residencia_direccion").val();
      var cantidad_hijos_b = '';
      var otra_ocupacion = '';
      var otra_cultura = '';
      var cual_discapacidad = '';
      var otra_discapacidad = '';
      var enfermedad_benec = '';
      var medicamento_benec = '';
      var otra_salud = '';
      var seguridad_benec = '';
      var parentesco_benec = '';

      var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val();
      var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
      var fecha_inscripcion = $("#fecha_inscripcion").val();
      var SelectPoblacional = $scope.selectedPoblacionales;
      var SelectDiscapacidad = $scope.selectedDiscapacidades;

      if ($scope.no_ficha == undefined) {
        $scope.no_ficha = null;
      } else {
        $scope.no_ficha = $scope.no_ficha;
      }

      if ($scope.persona.nombre_segundo == undefined) {
        $scope.persona.nombre_segundo = null;
      } else {
        $scope.persona.nombre_segundo = $scope.persona.nombre_segundo;
      }

      if ($scope.persona.apellido_primero == undefined) {
        $scope.persona.apellido_primero = null;
      } else {
        $scope.persona.apellido_primero = $scope.persona.apellido_primero;
      }

      if ($scope.persona.apellido_segundo == undefined) {
        $scope.persona.apellido_segundo = null;
      } else {
        $scope.persona.apellido_segundo = $scope.persona.apellido_segundo;
      }

      if ($scope.persona.telefono_fijo == undefined) {
        $scope.persona.telefono_fijo = null;
      } else {
        $scope.persona.telefono_fijo = $scope.persona.telefono_fijo;
      }

      if ($scope.persona.telefono_movil == undefined) {
        $scope.persona.telefono_movil = null;
      } else {
        $scope.persona.telefono_movil = $scope.persona.telefono_movil;
      }

      if ($scope.persona.correo_electronico == undefined) {
        $scope.persona.correo_electronico = null;
      } else {
        $scope.persona.correo_electronico = $scope.persona.correo_electronico;
      }

      if ($scope.otro_poblacional == undefined) {
        otro_poblacional = null;
      } else if ($scope.otro_poblacional != null) {
        otro_poblacional = $scope.otro_poblacional;
      }

      if ($scope.cantidad_hijos_beneficiario == undefined) {
        cantidad_hijos_b = null;
      } else if ($scope.cantidad_hijos_beneficiario != null) {
        cantidad_hijos_b = $scope.cantidad_hijos_beneficiario;
      }

      if ($scope.tipo_disc_otra.unit == undefined) {
        cual_discapacidad = null;
      } else if ($scope.tipo_disc_otra.unit != null) {
        cual_discapacidad = $scope.tipo_disc_otra.unit;
      }

      if ($scope.otra_discapacidad_beneficiario == undefined) {
        otra_discapacidad = null;
      } else if ($scope.otra_discapacidad_beneficiario != null) {
        otra_discapacidad = $scope.otra_discapacidad_beneficiario;
      }

      if ($scope.medicamentos_beneficiario == undefined) {
        medicamento_benec = null;
      } else if ($scope.medicamentos_beneficiario != null) {
        medicamento_benec = $scope.medicamentos_beneficiario;
      }

      if ($scope.otro_parentesco_acudiente == undefined) {
        parentesco_benec = null;
      } else if ($scope.otro_parentesco_acudiente != null) {
        parentesco_benec = $scope.otro_parentesco_acudiente;
      }

      if ($scope.corregimiento == undefined) {
        corregimiento_persona = null;
      } else if ($scope.corregimiento != null) {
        corregimiento_persona = $scope.corregimiento;
      }

      if ($scope.vereda == undefined) {
        vereda_persona = null;
      } else if ($scope.vereda != null) {
        vereda_persona = $scope.vereda;
      }
      if ($scope.barrio == undefined) {
        $scope.barrio = null;
      } else if ($scope.barrio != null) {
        $scope.barrio = $scope.barrio;
      }

      var ficha_registro = 0;
      if ($scope.ficha_save == null) {

        ficha_registro = 0;
      }

      if ($scope.ficha_save == undefined) {
        ficha_registro = 0;
      } else if ($scope.ficha_save > 0) {

        ficha_registro = $scope.ficha_save;
      }

      if ($scope.persona.otro_municipio == undefined) {
        $scope.persona.otro_municipio = null;
      } else if ($scope.persona.otro_municipio != null) {
        $scope.persona.otro_municipio = $scope.persona.otro_municipio;
      }

      if ($scope.documento_acudiente == undefined) {
        $scope.documento_acudiente = null;
      } else if ($scope.documento_acudiente != null) {
        $scope.documento_acudiente = $scope.documento_acudiente;
      }

      if ($scope.tipo_etnias == undefined) {
        $scope.tipo_etnias = null;
      } else if ($scope.tipo_etnias != null) {
        $scope.tipo_etnias = $scope.tipo_etnias;
      }

      if ($scope.tipo_sag == undefined) {
        $scope.tipo_sag = null;
      } else if ($scope.tipo_sag != null) {
        $scope.tipo_sag = $scope.tipo_sag;
      }

      if ($scope.tipo_est == undefined) {
        $scope.tipo_est = null;
      } else if ($scope.tipo_est != null) {
        $scope.tipo_est = $scope.tipo_est;
      }

      if ($scope.tipo_esc == undefined) {
        $scope.tipo_esc = null;
      } else if ($scope.tipo_esc != null) {
        $scope.tipo_esc = $scope.tipo_esc;
      }

      if ($scope.estado_esc == undefined) {
        $scope.estado_esc = null;
      } else if ($scope.estado_esc != null) {
        $scope.estado_esc = $scope.estado_esc;
      }

      if ($scope.tipo_ocup == undefined) {
        $scope.tipo_ocup = null;
      } else if ($scope.tipo_ocup != null) {
        $scope.tipo_ocup = $scope.tipo_ocup;
      }

      if ($scope.tipo_sex == undefined) {
        $scope.tipo_sex = null;
      } else if ($scope.tipo_sex != null) {
        $scope.tipo_sex = $scope.tipo_sex;
      }

      if ($scope.tipo_estrato == undefined) {
        $scope.tipo_estrato = null;
      } else if ($scope.tipo_estrato != null) {
        $scope.tipo_estrato = $scope.tipo_estrato;
      }

      if ($scope.comuna_id == undefined) {
        $scope.comuna_id = null;
      } else if ($scope.comuna_id != null) {
        $scope.comuna_id = $scope.comuna_id;
      }
      if ($scope.tipo_salud_otra == undefined) {
        $scope.tipo_salud_otra = null;
      } else if ($scope.tipo_salud_otra != null) {
        $scope.tipo_salud_otra = $scope.tipo_salud_otra;
      }

      var datos = {
        //Datos Persona
        tipo_doc_persona: $scope.tipo_doc,
        no_documento_persona: $scope.no_documento_persona,
        primer_nombre_persona: $scope.persona.nombre_primero,
        segundo_nombre_persona: $scope.persona.nombre_segundo,
        primer_apellido_persona: $scope.persona.apellido_primero,
        segundo_apellido_persona: $scope.persona.apellido_segundo,
        correo_persona: $scope.persona.correo_electronico,
        otro_municipio: $scope.persona.otro_municipio,

        sexo_persona: $scope.tipo_sex,

        tipo_genero_r: $scope.tipo_sex_real.unit,
        tipo_orientacion_sexual: $scope.tipo_orientacion_sexual.unit,
        orientacion_sexual_otro: $scope.persona.orientacion_sexual_otro,

        fecha_nac_persona: fecha_nacimiento_beneficiario,
        pais_id: $scope.pais,
        departamento_id: $scope.departamento,
        municipio_id: $scope.municipio,
        corregimiento: corregimiento_persona,
        vereda: vereda_persona,
        barrio_id: $scope.barrio,
        estrato: $scope.tipo_estrato,
        residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
        complemento: $("#id_persona_beneficiario_residencia_direccion_complemento").val(),
        telefono_fijo_persona: $scope.persona.telefono_fijo,
        telefono_movil_persona: $scope.persona.telefono_movil,
        tip_sangre_persona: $scope.tipo_sag,
        estado_civil_persona: $scope.tipo_est,

        //Acudiente Persona
        primer_nombre_acudiente: $('#nombre_primero_acudiente').val(),
        segundo_nombre_acudiente: $('#nombre_segundo_acudiente').val(),
        primer_apellido_acudiente: $('#apellido_primero_acudiente').val(),
        segundo_apellido_acudiente: $('#apellido_segundo_acudiente').val(),
        sex_pariente: $scope.tipo_sex_acudiente,
        fecha_nac_acudiente: fecha_nacimiento_acudiente,
        telefono_fijo_acudiente: $('#telefono_fijo_acudiente').val(),
        telefono_movil_acudiente: $('#telefono_movil_acudiente').val(),
        correo_acudiente: $('#correo_electronico_acudiente').val(),
        no_documento_acudiente: $('#documento_acudiente').val(),
        tip_doc_acudiente: $scope.tipo_doc_acudiente,

        //Datos Beneficiario     
        no_ficha: $scope.no_ficha,
        fecha_inscripcion: fecha_inscripcion,
        escolaridad_beneficiario: $scope.tipo_esc,
        estado_escolaridad: $scope.estado_esc,
        ocupacion_beneficiario: $scope.tipo_ocup,
        hijos_beneficiario: $scope.tipo_hij.unit,
        cantidad_hijos_beneficiario: cantidad_hijos_b,
        cultura_beneficiario: $scope.tipo_etnias,
        discapacidad_beneficiario: $scope.tipo_disc.unit,
        otra_discapacidad_beneficiario: otra_discapacidad,
        medicamentos_permanente_beneficiario: $scope.tipo_medic.unit,
        medicamentos_beneficiario: medicamento_benec,
        condicion_discapacidad: $scope.tipo_condicion.unit,
        afiliacion_salud: $scope.tipo_afiliacion_salud.unit,
        tipo_afiliacion: $scope.tipo_afiliacion,
        salud_sgsss_beneficiario: $scope.tipo_salud_otra,
        parentesco_acudiente: $scope.tipo_parent,
        otro_parentesco_acudiente: parentesco_benec,
        ficha: ficha_registro,
        otro_poblacional: otro_poblacional,
        comuna: $scope.comuna_id

      };

      // console.log($scope.acudiente.nombre_primero_acudiente);


      if ($scope.tipo_doc_acudiente.unit == 2 || $scope.tipo_doc_acudiente.unit == 3) {
        swal("Verifica tu información!", "Tipo de documento no valido!", "error");
        toastr.error("Tipo de documento no valido", "Tipo Documento");
      } else {

        $.ajax({
          url: base_api + '/postbeneficiarioprograma/create/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            datos: datos,
            SelectPoblacional: SelectPoblacional,
            SelectDiscapacidad: SelectDiscapacidad
          }

        }).success(function () {
          //mensaje almacenado
          swal("Muy bien!", "Su registro ha sido exitoso", "success");
          toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
          window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
        }).error(function () {
          console.log("success");
        });
      };
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/CreateGrupoProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateGrupoProgramaCtrl", function ($scope, GrupoProgramaService, fileUpload, $http, $location, base_api, $q) {
  $scope.title = "Agregar Grupo Programa";
  $scope.disable_submit = false;

  $scope.serie = {};

  $(function () {
    $('.martes-lunes').clockpicker({

      donetext: 'Guardar',
      placement: 'bottom',
      align: 'left',
      autoclose: true,
      twelvehour: true,
      vibrate: true
    });
  });

  $scope.disabled = undefined;

  $scope.enable = function () {
    $scope.disabled = false;
  };

  $scope.disable = function () {
    $scope.disabled = true;
  };

  $scope.clear = function () {
    $scope.person.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.person = {};

  $http.get(base_api + "/obtenerselect/lugares_grupos").success(function (response) {

    $scope.lugares = response;
  });

  $http.get(base_api + "/obtenerselect/disciplinas_grupos").success(function (response) {

    $scope.disciplinas = response;
  });

  $scope.address = {};
  $scope.refreshAddresses = function (address) {
    var params = { address: address, sensor: false };
    return $http.get('http://maps.googleapis.com/maps/api/geocode/json', { params: params }).then(function (response) {
      $scope.addresses = response.data.results;
    });
  };

  $scope.addItem = function () {
    $scope.items.push({ id: $scope.items.length, text: 'item ' + $scope.items.length });
  };

  $scope.removeItem = function () {
    $scope.items.pop();
  };

  $scope.changeItems = function () {
    //$scope.items[0].id = 123;
    $scope.items[0].text = 'item 123';
    $scope.items1[0] = 'item 123';
  };

  $scope.reorder = function () {
    var t = $scope.items[2];
    $scope.items[2] = $scope.items[3];
    $scope.items[3] = t;
  };

  $scope.check = function () {
    $scope.user.values1 = [1, 4];
  };

  $scope.dias = [{ id: 'lunes' }, { id: 'martes' }, { id: 'miercoles' }, { id: 'jueves' }, { id: 'viernes' }, { id: 'sabado' }, { id: 'domingo' }];

  $scope.time1 = new Date();

  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;

  $scope.disabled = false;

  $scope.observaciones = '';
  $scope.formsubmit = function (isValid) {

    if (isValid) {
      var dias_horario = [];

      $scope.dias.forEach(function (dia) {
        if (dia.inicio || dia.final) {
          dias_horario.push(dia);
        }
      });

      var observaciones = $scope.observaciones;

      $.ajax({
        url: base_api + '/postgrupoprograma/create',
        type: 'POST',
        dataType: 'JSON',
        data: {
          nombre_grupo: $scope.nombre_grupo,
          lugar: $scope.lugar,
          disciplina: $scope.disciplina,
          observaciones: observaciones,
          dias_horario: dias_horario
        }

      }).success(function () {

        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
      }).error(function () {
        swal("lo sentimos!", "Cambia tu nombre de grupo porque este ya existe!", "error");
        toastr.error("Verifique su campo nombre de grupo porque ya existe", "Nombre Grupo");
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/EditarGrupoProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarGrupoProgramaCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Información Grupo";
  $scope.series = [];
  $scope.getData = function () {

    $http.get(base_api + "/admin/postgruposprogramas/" + $routeParams.id).success(function (response) {
      $scope.serie = response;
      $scope.lugar = response.lugar_id;
      $scope.disciplina = response.disciplina_id;
    });
  };

  $scope.serie = {};
  $scope.getData();

  $scope.disabled = undefined;

  $scope.enable = function () {
    $scope.disabled = false;
  };

  $scope.disable = function () {
    $scope.disabled = true;
  };

  $scope.clear = function () {
    $scope.person.selected = undefined;
    $scope.address.selected = undefined;
    $scope.country.selected = undefined;
  };

  $scope.person = {};

  $http.get(base_api + "/obtenerselect/lugares").success(function (response) {

    $scope.lugares = response;
  });

  $http.get(base_api + "/obtenerselect/disciplinas").success(function (response) {

    $scope.disciplinas = response;
  });

  $scope.address = {};
  $scope.refreshAddresses = function (address) {
    var params = { address: address, sensor: false };
    return $http.get('http://maps.googleapis.com/maps/api/geocode/json', { params: params }).then(function (response) {
      $scope.addresses = response.data.results;
    });
  };

  $scope.dias = [{ id: 'lunes' }, { id: 'martes' }, { id: 'miercoles' }, { id: 'jueves' }, { id: 'viernes' }, { id: 'sabado' }, { id: 'domingo' }];

  $http.get(base_api + "/obtener/GrupoHorarioPrograma/" + $routeParams.id).success(function (response) {

    response.forEach(function (element) {
      var dia = $scope.dias.find(function (d) {
        return d.id == element.dia;
      });
      if (dia) {

        dia.checked = true;
        dia._id = element.id;
        dia.inicio = new Date();
        dia.inicio.setHours(element.hora_inicio.split(":")[0]);
        dia.inicio.setMinutes(element.hora_inicio.split(":")[1]);
        //dia.inicio = element.hora_inicio;
        dia.fin = new Date();
        dia.fin.setHours(element.hora_fin.split(":")[0]);
        dia.fin.setMinutes(element.hora_fin.split(":")[1]);
        //dia.fin = element.hora_fin;
      }
    });
  });

  $scope.time1 = new Date();

  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);

  $scope.showMeridian = true;

  $scope.disabled = false;

  $scope.avisar = function (dia) {

    // console.log(dia);

    if (dia.checked == false && dia._id != null) {

      $http({
        url: base_api + "/eliminar/GrupoHorarioPrograma",
        method: "POST",
        data: { 'dato': dia._id }
      }).then(function (response) {

        dia._id = null;
      }, function (response) {// optional
        // failed
      });
    }
  };

  $scope.formsubmit = function (id, isValid) {

    if (isValid) {

      var dias_horario = [];

      $scope.dias.forEach(function (dia) {

        console.log(dia);
        if (dia.checked == true) {

          if (dia.inicio || dia.final) {
            dias_horario.push(dia);
          }
        }
      });

      $.ajax({
        url: base_api + '/postgrupoprograma/actualizar/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {
          nombre_grupo: $scope.serie.nombre_grupo,
          lugar: $scope.lugar,
          disciplina: $scope.disciplina,
          observaciones: $scope.serie.observaciones,
          dias_horario: dias_horario
        }

      }).success(function () {

        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
      }).error(function () {
        swal("lo sentimos!", "Cambia tu nombre de grupo porque este ya existe!", "error");
        toastr.error("Verifique su campo nombre de grupo porque ya existe", "Nombre Grupo");
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/EditarMiBeneficiarioProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarMiBeneficiarioProgramaCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q) {

  $scope.reset = function () {
    $scope.state = undefined;
  };

  $scope.title = "Beneficiario Grupo";
  $scope.series = [];
  $scope.selectedPoblacionales = [];
  $scope.selectedDiscapacidades = [];

  $scope.getData = function () {
    $scope.serie = GrupoProgramaService.get({ id: $routeParams.id });
  };

  $scope.grupo_save = $routeParams.id;
  $scope.serie = {};
  $scope.title = "Editar Beneficiario";
  $scope.disable_submit = false;
  $scope.serie = {};

  $(function () {
    $('#id_persona_beneficiario_residencia_direccion').add_generator({
      direccion: 'id_persona_beneficiario_residencia_direccion',
      complemento: 'id_persona_beneficiario_residencia_direccion_complemento'
    });
  });

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
      yearRange: "1910:+nn"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_nacimiento_acudiente").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "1940:+nn"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_inscripcion").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "-99:+0",
      maxDate: "+0m +0d"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  //Inicio Carga de datos Documento Crear

  $scope.tipo_doc = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {
    $scope.tipodocumento = response;
  });

  //Fin Carga de datos Documento Crear

  //inicio tipo documento acudients

  $scope.tipo_doc_acudiente = '';

  //fin


  //Inicio Carga datos sexo crear

  $scope.tipo_estrato = {
    'id': 1,
    'unit': null
  };

  $scope.estrato = [{ id: 1, nombre: '1' }, { id: 2, nombre: '2' }, { id: 3, nombre: '3' }, { id: 4, nombre: '4' }, { id: 5, nombre: '5' }, { id: 6, nombre: '6' }, { id: 7, nombre: '7' }];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo crear


  $scope.tipo_sex = {
    'id': 1,
    'unit': null
  };

  $scope.sexo = [{ id: 1, nombre: 'Mujer' }, { id: 2, nombre: 'Hombre' }];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo real crear

  $scope.tipo_sex_real = {
    'id': 1,
    'unit': null
  };

  $scope.sexo_real = [{ id: 1, nombre: 'Heterosexual' }, { id: 2, nombre: 'Homosexual' }, { id: 3, nombre: 'Bisexual' }];

  //Fin Carga datos sexo real crear

  //Inicio Carga datos orientacion sexual crear

  $scope.tipo_orientacion_sexual = {
    'id': 1,
    'unit': null
  };

  $scope.sexo_orientacion_sexual = [{ id: 1, nombre: 'Lesbiana' }, { id: 2, nombre: 'Gay' }, { id: 3, nombre: 'Bisexual' }, { id: 4, nombre: 'Transformista' }, { id: 5, nombre: 'Transvestido' }, { id: 6, nombre: 'Transgenerista' }, { id: 7, nombre: 'Transexual' }, { id: 8, nombre: 'Intersexual' }, { id: 9, nombre: 'Querés' }, { id: 10, nombre: 'Pansexual' }, { id: 11, nombre: 'HSH' }, { id: 12, nombre: 'Queers' }, { id: 13, nombre: 'Otro' }];

  //Fin Carga datos orientacion sexual crear


  //Inicio Carga datos sexo crear

  $scope.tipo_sex_acudiente = '';

  //Fin Carga datos sexo crear

  //Inicio Carga datos tipo de sangre

  $scope.tipo_sag = {
    'id': 1,
    'unit': null
  };

  $scope.sangre = [{ id: '1', nombre: 'O+' }, { id: '2', nombre: 'O-' }, { id: '3', nombre: 'A+' }, { id: '4', nombre: 'A-' }, { id: '5', nombre: 'B+' }, { id: '6', nombre: 'B-' }, { id: '7', nombre: 'AB+' }, { id: '8', nombre: 'AB-' }];

  //Fin Carga datos tipo de sangre


  $scope.tipo_com = {
    'id': 1,
    'unit': null

    //inicio cargar datos corregimientos

  };$scope.data_corregimiento = {
    'id': 1,
    'unit': null
  };

  $.ajax({
    url: base_api + "/obtener/corregimientos",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.corregimientos = response;
  }).error(function () {});

  //inicio cargar datos modalidades

  $scope.data_modalidad = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtener/modalidades").success(function (modalidades) {

    $scope.modalidades = modalidades;
  });

  //inicio cargar datos puntos de atencion

  $scope.data_puntoatencion = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtener/puntosatencion").success(function (puntosatencion) {

    $scope.puntosatencion = puntosatencion;
  });

  $scope.selectedCorregimiento = function (itemCorregimiento) {

    var promise = $http.get(base_api + "/obtener/veredas/" + itemCorregimiento);
    promise.then(function (responseveredas) {
      $scope.veredas = responseveredas.data;
    });
  };

  $scope.data_vereda = {
    'id': 1,
    'unit': null

    //fin 


    //inicio Data carga estado civl

  };$scope.tipo_est = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtener/estados_civiles").success(function (response) {
    $scope.civiles = response;
  });

  //

  //Inicio Carga datos hijos crear

  $scope.tipo_hij = {
    'id': 1,
    'unit': null
  };

  $scope.hijo = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //Fin Carga datos hijos crear

  //inicio cargar datos modalidades

  $scope.tipo_ocup = {
    'id': 1,
    'unit': 3
  };

  $http.get(base_api + "/obtener/ocupaciones").success(function (ocupaciones) {

    $scope.ocupaciones = ocupaciones;
  });

  //Inicio Carga de datos Escolaridad Crear


  $http.get(base_api + "/obtenerselect/escolaridades").success(function (response) {

    $scope.escolaridades = response;
  });

  //Fin Carga de datos Escolaridad Crear

  //Inicio Carga de datos Estado Escolaridad Crear

  $scope.estado_esc = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/EstadoEscolaridades").success(function (response) {

    $scope.estadoescolaridades = response;
  });

  //Inicio Carga datos cultura crear

  $scope.tipo_cult = {
    'id': 1,
    'unit': null
  };

  $scope.tipo_etnias = {
    'id': 1,
    'unit': null
  };

  $scope.clubes_deportivos = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/culturas").success(function (response) {
    $scope.etnias = response;
  });

  $http.get(base_api + "/obtener/clubesdeportivos").success(function (response) {
    $scope.clubes_deportivos_bd = response;
  });

  //Fin Carga datos cultura crear


  //inicio carga discapacidad si o no

  $scope.tipo_disc = {
    'id': 1,
    'unit': null
  };

  $scope.discapacidades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio carga afiliacion salud si o no

  $scope.tipo_afiliacion_salud = {
    'id': 1,
    'unit': null
  };

  $scope.afiliacion_salud = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin


  //inicio carga discapacidad si o no

  $scope.tipo_libreta = {
    'id': 1,
    'unit': null
  };

  $scope.libreta = [{ id: 1, nombre: 'Primera' }, { id: 2, nombre: 'Segunda' }];

  //fin


  //inicio carga salud si o no

  $scope.tipo_salud = {
    'id': 1,
    'unit': null
  };

  $scope.seguridad_social = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio carga alunos regimens


  $scope.tipo_salud_otra = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/salud_sgsss").success(function (response) {

    $scope.salud_sgsss = response;
  });

  //fin

  //inicio carga algunas discapacidades


  $scope.tipo_disc_otra = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (response) {

    $scope.discapacidad_otra = response;
  });

  //fin


  //Inicio cargar universidades
  $scope.selected = undefined;
  $http.get(base_api + "/obtenerselect/universidades").success(function (response) {

    $scope.universidades = response;
  });

  //Inicio cargar enfermedad si o no 

  $scope.tipo_eferm = {
    'id': 1,
    'unit': null
  };

  $scope.enfermedades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar data medicamentos si o no


  $scope.tipo_medic = {
    'id': 1,
    'unit': null
  };

  $scope.medicamentos = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar parentesco


  //inicio cargar data medicamentos si o no

  $scope.tipo_condicion = {
    'id': 1,
    'unit': null
  };

  $scope.condiciondiscapacidad = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  $scope.selectedCondicion = function (condicion) {

    if (condicion == 1) {
      $scope.ngShowhideDiscapacidad = true;
    } else {
      $scope.ngShowhideDiscapacidad = false;
    }
  };

  //fin


  //inicio carga Afiliacion


  $scope.tipo_afiliacion = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/afiliaciones").success(function (response) {

    $scope.afiliaciones = response;
  });

  //fin

  $scope.tipo_parent = '';

  $scope.parentescos = [{ id: 1, nombre: 'Madre/Padre' }, { id: 2, nombre: 'Hermana/Hermano' }, { id: 3, nombre: 'Tia/Tio' }, { id: 4, nombre: 'Abuela/Abuelo' }, { id: 5, nombre: 'Cuidador' }, { id: 6, nombre: 'Otro' }];
  //


  //inicio cargar poblacionales

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
  });

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (discapacidades) {

    $scope.allGruposDiscapacidades = discapacidades;
  });

  //fin

  $http.get(base_api + "/obtener/barrios").success(function (response) {

    $scope.barrios = response;
    // console.log($scope.barrios);
  });

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

    $scope.comunas = response;
  });

  $scope.selectedComuna = function (itemComuna) {

    $scope.tipo_barr = {
      'id': 1,
      'unit': null
    };
  };

  $scope.selectedBarrio = function (itemBarrio) {

    $http.get(base_api + "/obtener/estrato/" + itemBarrio).success(function (estratobeneficiario) {
      $scope.tipo_estrato = {
        'id': 1,
        'unit': parseInt(estratobeneficiario.id_estrato)
      };
      $scope.comuna = estratobeneficiario.nombre_comuna;
      $scope.comuna_id = estratobeneficiario.comuna_id;
    });
  };

  $scope.ngShowhideBarrio = true;
  $scope.ngShowhideDireccion = true;
  $scope.ngShowhideComplemento = true;

  $scope.selectedVereda = function (veredaselect) {

    $http.get(base_api + "/obtener/estratoVereda/" + veredaselect).success(function (EstratoVereda) {
      $scope.tipo_estrato = {
        'id': 1,
        'unit': EstratoVereda.estrato
      };
      $scope.comuna = EstratoVereda.nombre_comuna;
      $scope.comuna_id = EstratoVereda.id_comuna;
    });

    if (veredaselect != null) {
      $scope.ngShowhideBarrio = false;
      $scope.ngShowhideDireccion = false;
      $scope.ngShowhideComplemento = false;
      $scope.barrio = undefined;
    } else {
      $scope.vereda = undefined;
      $scope.corregimiento = undefined;
      $scope.ngShowhideBarrio = true;
      $scope.ngShowhideDireccion = true;
      $scope.ngShowhideComplemento = true;
      $scope.tipo_estrato = {
        'id': 1,
        'unit': null
      };
      $scope.comuna = null;
    }
  };

  $scope.reset = function () {
    $scope.vereda = undefined;
    $scope.ngShowhideBarrio = true;
    $scope.ngShowhideDireccion = true;
  };

  $http.get(base_api + "/admin/cargafichaprograma/" + $routeParams.id).success(function (response) {

    $scope.serie = response[0];
    $scope.acudiente = response[0];
    $scope.ficha = response[0].no_ficha;
    $scope.doc = response[0].documento;

    if ($scope.serie.residencia_direccion != null) {
      $("#direccion_residencia_plugin").hide();
    } else if ($scope.serie.residencia_direccion == '' || $scope.serie.residencia_direccion == null) {
      $("#direccion_residencia_plugin").show();
    }

    $scope.tipo_doc = {
      'id': 1,
      'unit': $scope.serie.id_documento_tipo
    };

    $scope.no_documento_persona = $scope.serie.documento;
    $scope.comuna_id = $scope.serie.comuna_id;

    $scope.tipo_etnias = {
      'id': 1,
      'unit': $scope.serie.cultura_beneficiario
    };
    $scope.clubes_deportivos = {
      'id': 1,
      'unit': parseInt($scope.serie.clubes_deportivos_id)
    };

    $scope.estado_esc = $scope.serie.estado_escolaridad;

    $scope.tipo_estrato = {
      'id': 1,
      'unit': parseInt($scope.serie.residencia_estrato)
    };
    $scope.tipo_afiliacion_salud = {
      'id': 1,
      'unit': $scope.serie.afiliacion_salud
    };
    $scope.tipo_doc = {
      'id': 1,
      'unit': $scope.serie.id_documento_tipo
    };
    $scope.tipo_condicion = {
      'id': 1,
      'unit': $scope.serie.condicion_discapacidad
    };

    if ($scope.serie.condicion_discapacidad == 1) {
      $scope.ngShowhideDiscapacidad = true;
    } else {
      $scope.ngShowhideDiscapacidad = false;
    }

    $scope.tipo_afiliacion = {
      'id': 1,
      'unit': $scope.serie.tipo_afiliacion
    };

    $scope.tipo_salud_otra = {

      'id': 1,
      'unit': $scope.serie.salud_sgss_id

      // console.log($scope.tipo_salud_otra);

    };$scope.tipo_sex = {
      'id': 1,
      'unit': $scope.serie.sexo
    };

    $scope.tipo_sag = {
      'id': 1,
      'unit': $scope.serie.sangre_tipo

      //Inicio Carga datos sexo real crear
    };$scope.tipo_sex_real = {
      'id': 1,
      'unit': $scope.serie.tipo_genero_r
      //Fin Carga datos sexo real crear

      //Inicio Carga datos orientacion sexual crear
    };$scope.tipo_orientacion_sexual = {
      'id': 1,
      'unit': $scope.serie.tipo_orientacion_sexual
      //Fin Carga datos orientacion sexual crear
    };if (parseInt($scope.serie.tipo_orientacion_sexual) == 13) {
      $scope.orientacion_sexual_otro = $scope.serie.orientacion_sexual_otro;
      $("#orientacion_sexual_otro").val($scope.serie.orientacion_sexual_otro);
      $("#rowOtroOrientacionSexual").show();
    }

    $scope.pais = $scope.serie.id_procedencia_pais;
    $scope.departamento = $scope.serie.id_procedencia_departamento;

    var promise = $http.get(base_api + "/obtener/municipios/" + $scope.departamento);
    promise.then(function (responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
    });

    $scope.municipio = $scope.serie.id_procedencia_municipio;

    $http.get(base_api + "/obtener/comuna_barrio/" + $scope.serie.id_residencia_barrio).success(function (responseComuna) {

      $scope.tipo_com = {
        'id': 1,
        'unit': responseComuna.length > 0 ? responseComuna[0].id : null
      };

      $scope.barrio = $scope.serie.id_residencia_barrio;
    });

    $scope.corregimiento = $scope.serie.id_residencia_corregimiento;

    $http.get(base_api + "/obtener/estrato/" + $scope.serie.id_residencia_barrio).success(function (estratobeneficiario) {
      $scope.comuna = estratobeneficiario.nombre_comuna;
    });

    var promise = $http.get(base_api + "/obtener/veredas/" + $scope.serie.id_residencia_corregimiento);
    promise.then(function (responseveredas) {
      $scope.veredas = responseveredas.data;
    });

    $scope.vereda = $scope.serie.id_residencia_vereda;
    if ($scope.vereda != null) {
      $scope.ngShowhideBarrio = false;
      $scope.ngShowhideDireccion = false;
      $scope.ngShowhideComplemento = false;
      $scope.barrio = undefined;
    } else {
      $scope.vereda = undefined;
      $scope.corregimiento = undefined;
      $scope.ngShowhideBarrio = true;
      $scope.ngShowhideDireccion = true;
      $scope.ngShowhideComplemento = true;
    }

    $http.get(base_api + "/obtener/estratoVereda/" + $scope.serie.id_residencia_vereda).success(function (EstratoVereda) {
      $scope.tipo_estrato = {
        'id': 1,
        'unit': EstratoVereda.estrato
      };
      $scope.comuna = EstratoVereda.nombre_comuna;
    });

    $scope.tipo_est = {
      'id': 1,
      'unit': $scope.serie.id_estado_civil
    };

    $scope.tipo_hij = {
      'id': 1,
      'unit': $scope.serie.hijos_beneficiario
    };
    if ($scope.serie.hijos_beneficiario == 1) {
      $scope.isDisabled = false;
    } else {

      $scope.isDisabled = true;
    }

    $scope.tipo_ocup = {
      'id': 1,
      'unit': $scope.serie.ocupacion_id
    };

    if ($scope.serie.ocupacion_beneficiario == 8) {
      $scope.isDisabledOcupacion = false;
    } else {

      $scope.isDisabledOcupacion = true;
    }

    $scope.tipo_esc = $scope.serie.escolaridad_id;

    $scope.tipo_cult = {
      'id': 1,
      'unit': $scope.serie.cultura_beneficiario
    };

    if ($scope.serie.cultura_beneficiario == 10) {
      $scope.isDisabledCultura = false;
    } else {
      $scope.isDisabledCultura = true;
    }

    $http.get(base_api + "/obtener/poblacionalesprogramas/" + $routeParams.id).success(function (response) {

      $scope.selectedPoblacionales = response;
      $scope.selectedPoblacionales.map(function (poblacional) {

        if (poblacional.id == 10) {
          $scope.ngShowhideOtro = true;
        }
        if (poblacional.id == 11) {
          $scope.ngShowhideClub = true;
        }
      });
    });

    $scope.otro_poblacional = $scope.serie.otro_poblacional;

    $http.get(base_api + "/obtener/discapacidadesPrograma/" + $routeParams.id).success(function (response) {

      $scope.selectedDiscapacidades = response;
    });

    $scope.tipo_salud = {
      'id': 1,
      'unit': $scope.serie.seguridad_social_beneficiario
    };

    if ($scope.serie.seguridad_social_beneficiario == 1) {
      // $scope.isDisabledSeguridad = false;
    } else {

        // $scope.isDisabledSeguridad = true;
      }

    $scope.tipo_disc = {
      'id': 1,
      'unit': $scope.serie.discapacidad_beneficiario
    };

    if ($scope.serie.discapacidad_beneficiario == 1) {
      $scope.isDisabledDiscapacidad = false;
    } else {

      $scope.isDisabledDiscapacidad = true;
    }

    $scope.tipo_disc_otra = {
      'id': 1,
      'unit': $scope.serie.discapacidad_id

      // console.log($scope.tipo_disc_otra);
    };$scope.tipo_eferm = {
      'id': 1,
      'unit': $scope.serie.enfermedad_permanente_beneficiario
    };

    if ($scope.serie.enfermedad_permanente_beneficiario == 1) {
      $scope.isDisabledEnfermedad = false;
    } else {

      $scope.isDisabledEnfermedad = true;
    }

    $scope.tipo_medic = {
      'id': 1,
      'unit': $scope.serie.medicamentos_permanente_beneficiario
    };

    if ($scope.serie.medicamentos_permanente_beneficiario == 1) {
      $scope.isDisabledMedicamento = false;
    } else {

      $scope.isDisabledMedicamento = true;
    }

    $scope.tipo_doc_acudiente = parseInt($scope.serie.tipodocacudiente);

    $scope.tipo_sex_acudiente = parseInt($scope.serie.sexoacudiente);

    $scope.tipo_parent = 1;

    if ($scope.serie.parentesco_acudiente == 6) {
      $scope.isDisabledParentesco = false;
    } else {

      $scope.isDisabledParentesco = true;
    }
  });

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
  };

  $scope.setEnd = function (date) {
    $scope.endDate = date;
    $scope.endDatep = date;
    $scope.endDateInscripcion = date;
  };

  $scope.tipo_documento = [{ id: '1', nombre: 'Registro Civil' }, { id: '2', nombre: 'Tarjeta Identidad' }, { id: '3', nombre: 'Cédula de Ciudadanía' }, { id: '4', nombre: 'Pasaporte' }, { id: '5', nombre: 'Sin Información' }];

  $scope.grupos_poblacionales = [{ id: '1', nombre: 'Adulto Mayor' }, { id: '2', nombre: 'Afrodescendiente/Afrocolombiano' }, { id: '3', nombre: 'Víctimas del conflicto armado' }, { id: '4', nombre: 'Habitante calle' }, { id: '5', nombre: 'LGBTI' }, { id: '6', nombre: 'Persona con discapacidad' }, { id: '7', nombre: 'Grupo organizado de Mujeres' }, { id: '8', nombre: 'Indígenas' }, { id: '9', nombre: 'Reinsertado' }, { id: '10', nombre: 'Junta de acción comunal (JAC)' }, { id: '11', nombre: 'Grupo organizado de Jóvenes' }, { id: '12', nombre: 'Ninguno' }, { id: '13', nombre: 'Recluido' }, { id: '14', nombre: 'Junta de administradora local (JAL)' }, { id: '15', nombre: 'Otro grupo' }];

  $scope.selected = {
    poblacionales: []
  };

  $http.get(base_api + "/obtener/programas").success(function (response) {

    $scope.programas = response;
  });

  $scope.pais = 1;

  $.ajax({
    url: base_api + "/obtener/paises",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.paises = response;
  }).error(function () {});

  $scope.data_paises = {
    'id': 1,
    'unit': 1
  };

  if ($scope.data_paises.unit == 1) {

    $scope.ngShowhide1 = true;
    $scope.ngShowhide2 = false;
  } else {

    $scope.ngShowhide1 = false;
    $scope.ngShowhide2 = true;
  }

  $scope.departamento = 76;
  $.ajax({
    url: base_api + "/obtener/departamentos/" + $scope.data_paises.unit,
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.departamentos = response;
  }).error(function () {});

  $scope.municipio = 834;
  $http.get(base_api + "/obtener/municipios/" + $scope.departamento).success(function (response) {
    $scope.municipios = response;
  });

  $scope.selectedPais = function (itemPais) {

    if (itemPais == 1) {

      $scope.ngShowhide1 = true;
      $scope.ngShowhide2 = false;
    } else {

      $scope.ngShowhide1 = false;
      $scope.ngShowhide2 = true;
    }
    $.ajax({
      url: base_api + "/obtener/departamentos/" + itemPais,
      type: 'GET',
      dataType: 'JSON',
      async: false
    }).success(function (response) {
      $scope.departamentos = response;
    }).error(function () {});
  };

  $scope.selectedDepartamento = function (itemDepartamento) {

    var promise = $http.get(base_api + "/obtener/municipios/" + itemDepartamento);
    promise.then(function (responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
    });
  };

  $scope.isDisabled = true;
  $scope.isDisabledOcupacion = true;
  $scope.isDisabledCultura = true;
  $scope.isDisabledDiscapacidad = true;
  $scope.isDisabledEnfermedad = true;
  $scope.isDisabledMedicamento = true;
  // $scope.isDisabledSeguridad = true;
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
      $scope.tipo_disc_otra.unit = null;
      $scope.serie.otra_discapacidad_beneficiario = null;
    }
  };

  $scope.selectedEnfermedad = function (itemEnfermedad) {

    if (itemEnfermedad == 1) {
      $scope.isDisabledEnfermedad = false;
    } else {

      $scope.isDisabledEnfermedad = true;
      $scope.serie.enfermedad_beneficiario = null;
    }
  };

  $scope.selectedMedicamento = function (itemMedicamento) {

    if (itemMedicamento == 1) {
      $scope.isDisabledMedicamento = false;
    } else {

      $scope.isDisabledMedicamento = true;
      $scope.serie.medicamentos_beneficiario = null;
    }
  };

  $scope.selectedSeguridad = function (itemSeguridad) {

    if (itemSeguridad == 1) {
      // $scope.isDisabledSeguridad = false;
    } else {

      // $scope.isDisabledSeguridad = true;
      $scope.tipo_salud_otra.unit = null;
      $scope.serie.nombre_seguridad_beneficiario = null;
    }
  };

  // evento cambia orientacion sexual
  $scope.selectedOrientacionSexual = function (item) {
    $("#rowOtroOrientacionSexual").hide();
    $("#rowOtroOrientacionSexual").val("");
    $("#orientacion_sexual_otro").val("N/A").change();
    if (parseInt(item) == 13) {
      $("#rowOtroOrientacionSexual").show(500, "");
      $("#orientacion_sexual_otro").val("").change();
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

  $scope.ngShowhideOtro = false;
  $scope.ngShowhideClub = false;

  $scope.toggleSelection = function toggleSelection(seleccion) {

    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);

    if (index == index && seleccion.id == 10) {
      $scope.ngShowhideOtro = true;
      $scope.otro_poblacional = '';
    }

    if (seleccion.id == 10) {
      $scope.ngShowhideOtro = true;
    }

    // club deportivo
    if (index == index && seleccion.id == 11) {
      $scope.ngShowhideClub = true;
      $scope.club_poblacional = '';
    }
    if (seleccion.id == 11) {
      $scope.ngShowhideClub = true;
    }

    if (index > -1) {
      $scope.selectedPoblacionales.splice(index, 1);

      if (index == 0 && seleccion.id == 10) {
        $scope.ngShowhideOtro = false;
        $scope.otro_poblacional = '';
      }
      if (index == 0 && seleccion.id == 11) {
        $scope.ngShowhideClub = false;
        $scope.club_poblacional = '';
      }

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/poblacionalPrograma/" + $scope.serie.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedPoblacionales.push(seleccion);
    }
  };

  $scope.toggleSelectionDiscapacidad = function toggleSelectionDiscapacidad(seleccion) {

    var index = $scope.selectedDiscapacidades.indexOfObjectWithProperty('id', seleccion.id);
    // console.log(index);

    if (index > -1) {
      $scope.selectedDiscapacidades.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/discapacidadBeneficiario/" + $scope.serie.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedDiscapacidades.push(seleccion);
    }
  };

  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;

  $scope.formsubmit = function (id, isValid) {

    if (isValid) {
      var direccion_sider = $("#id_persona_beneficiario_residencia_direccion").val();
      var cantidad_hijos_b = '';
      var otra_ocupacion = '';
      var otra_cultura = '';
      var cual_discapacidad = '';
      var otra_discapacidad = '';
      var enfermedad_benec = '';
      var medicamento_benec = '';
      var otra_salud = '';
      var seguridad_benec = '';
      var parentesco_benec = '';

      if ($scope.universidad == undefined) {
        $scope.universidad = null;
      }
      if ($scope.universidad == null) {
        $scope.universidad = null;
      } else {
        $scope.universidad = $scope.universidad;
      }

      if ($scope.serie.telefono_fijo == undefined) {
        $scope.serie.telefono_fijo = null;
      } else {
        $scope.serie.telefono_fijo = $scope.serie.telefono_fijo;
      }

      if ($scope.acudiente.telefono_fijo_acudiente == undefined) {
        $scope.acudiente.telefono_fijo_acudiente = null;
      } else {
        $scope.acudiente.telefono_fijo_acudiente = $scope.acudiente.telefono_fijo_acudiente;
      }

      if ($scope.otro_poblacional == undefined) {
        otro_poblacional = null;
      } else if ($scope.otro_poblacional != null) {
        otro_poblacional = $scope.otro_poblacional;
      }

      if ($scope.serie.cantidad_hijos_beneficiario == undefined) {
        cantidad_hijos_b = null;
      } else if ($scope.serie.cantidad_hijos_beneficiario != null) {
        cantidad_hijos_b = $scope.serie.cantidad_hijos_beneficiario;
      }
      if ($scope.serie.otra_ocupacion_beneficiario == undefined) {
        otra_ocupacion = null;
      } else if ($scope.serie.otra_ocupacion_beneficiario != null) {
        otra_ocupacion = $scope.serie.otra_ocupacion_beneficiario;
      }

      if ($scope.serie.otra_cultura_beneficiario == undefined) {
        otra_cultura = null;
      } else if ($scope.serie.otra_cultura_beneficiario != null) {
        otra_cultura = $scope.serie.otra_cultura_beneficiario;
      }

      if ($scope.tipo_disc_otra.unit == undefined) {
        cual_discapacidad = null;
      } else if ($scope.tipo_disc_otra.unit != null) {
        cual_discapacidad = $scope.tipo_disc_otra.unit;
      }

      if ($scope.serie.otra_discapacidad_beneficiario == undefined) {
        otra_discapacidad = null;
      } else if ($scope.serie.otra_discapacidad_beneficiario != null) {
        otra_discapacidad = $scope.serie.otra_discapacidad_beneficiario;
      }

      if ($scope.serie.enfermedad_beneficiario == undefined) {
        enfermedad_benec = null;
      } else if ($scope.serie.enfermedad_beneficiario != null) {
        enfermedad_benec = $scope.serie.enfermedad_beneficiario;
      }

      if ($scope.serie.medicamentos_beneficiario == undefined) {
        medicamento_benec = null;
      } else if ($scope.serie.medicamentos_beneficiario != null) {
        medicamento_benec = $scope.serie.medicamentos_beneficiario;
      }

      if ($scope.tipo_salud_otra.unit == undefined) {
        otra_salud = null;
      } else if ($scope.tipo_salud_otra.unit != null) {
        otra_salud = $scope.tipo_salud_otra.unit;
      }

      if ($scope.serie.nombre_seguridad_beneficiario == undefined) {
        seguridad_benec = null;
      } else if ($scope.serie.nombre_seguridad_beneficiario != null) {
        seguridad_benec = $scope.serie.nombre_seguridad_beneficiario;
      }

      if ($scope.tipo_sag.unit == undefined) {
        $scope.tipo_sag.unit = null;
      } else if ($scope.tipo_sag.unit != null) {
        $scope.tipo_sag.unit = $scope.tipo_sag.unit;
      }

      if ($scope.serie.otro_parentesco_acudiente == undefined) {
        parentesco_benec = null;
      } else if ($scope.serie.otro_parentesco_acudiente != null) {
        parentesco_benec = $scope.serie.otro_parentesco_acudiente;
      }

      if ($scope.corregimiento == undefined) {
        corregimiento_persona = null;
      } else if ($scope.corregimiento != null) {
        corregimiento_persona = $scope.corregimiento;
      }

      if ($scope.vereda == undefined) {
        vereda_persona = null;
      } else if ($scope.vereda != null) {
        vereda_persona = $scope.vereda;
      }
      if ($scope.barrio == undefined) {
        barrio_persona = null;
      } else if ($scope.barrio != null) {
        barrio_persona = $scope.barrio;
      }

      var ficha_registro = 0;
      if ($scope.serie.ficha_save == null) {

        ficha_registro = 0;
      } else if ($scope.serie.ficha_save > 0) {

        ficha_registro = $scope.serie.ficha_save;
      }

      var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val();
      var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
      var fecha_inscripcion = $("#fecha_inscripcion").val();
      var SelectPoblacional = $scope.selectedPoblacionales;
      var SelectDiscapacidad = $scope.selectedDiscapacidades;

      var datos = {

        //Datos Persona
        tipo_doc_persona: $scope.tipo_doc.unit,
        no_documento_persona: $scope.no_documento_persona,
        primer_nombre_persona: $scope.serie.nombre_primero,
        segundo_nombre_persona: $scope.serie.nombre_segundo,
        primer_apellido_persona: $scope.serie.apellido_primero,
        segundo_apellido_persona: $scope.serie.apellido_segundo,
        correo_persona: $scope.serie.correo_electronico,

        sexo_persona: $scope.tipo_sex.unit,

        tipo_genero_r: $scope.tipo_sex_real.unit,
        tipo_orientacion_sexual: $scope.tipo_orientacion_sexual.unit,
        orientacion_sexual_otro: $scope.orientacion_sexual_otro,

        fecha_nac_persona: fecha_nacimiento_beneficiario,
        pais_id: $scope.data_paises.unit,
        departamento_id: $scope.departamento,
        municipio_id: $scope.municipio,
        corregimiento: corregimiento_persona,
        vereda: vereda_persona,
        barrio_id: barrio_persona,
        estrato: $scope.tipo_estrato.unit,
        residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
        complemento: $("#id_persona_beneficiario_residencia_direccion_complemento").val(),
        telefono_fijo_persona: $scope.serie.telefono_fijo,
        telefono_movil_persona: $scope.serie.telefono_movil,
        tip_sangre_persona: $scope.tipo_sag.unit,
        estado_civil_persona: $scope.tipo_est.unit,

        //Acudiente Persona
        primer_nombre_acudiente: $scope.acudiente.nombre_primero_acudiente,
        segundo_nombre_acudiente: $scope.acudiente.nombre_segundo_acudiente,
        primer_apellido_acudiente: $scope.acudiente.apellido_primero_acudiente,
        segundo_apellido_acudiente: $scope.acudiente.apellido_segundo_acudiente,
        sex_pariente: $scope.tipo_sex_acudiente,
        fecha_nac_acudiente: fecha_nacimiento_acudiente,
        telefono_fijo_acudiente: $scope.acudiente.telefono_fijo_acudiente,
        telefono_movil_acudiente: $scope.acudiente.telefono_movil_acudiente,
        correo_acudiente: $scope.acudiente.correo_electronico_acudiente,
        no_documento_acudiente: $scope.acudiente.documento_acudiente,
        tip_doc_acudiente: $scope.tipo_doc_acudiente,

        //Datos Beneficiarios     
        no_ficha: $scope.serie.no_ficha,
        fecha_inscripcion: fecha_inscripcion,
        escolaridad_beneficiario: $scope.tipo_esc,
        estado_escolaridad: $scope.estado_esc,
        titulo_obtenido: $scope.serie.titulo_obtenido,
        universidad: $scope.universidad,
        ocupacion_beneficiario: $scope.tipo_ocup.unit,
        hijos_beneficiario: $scope.tipo_hij.unit,
        cantidad_hijos_beneficiario: cantidad_hijos_b,

        cultura_beneficiario: $scope.tipo_etnias.unit,
        clubes_deportivos_id: $scope.clubes_deportivos.unit,

        discapacidad_beneficiario: $scope.tipo_disc.unit,
        otra_discapacidad_beneficiario: otra_discapacidad,
        medicamentos_permanente_beneficiario: $scope.tipo_medic.unit,
        medicamentos_beneficiario: medicamento_benec,
        condicion_discapacidad: $scope.tipo_condicion.unit,
        afiliacion_salud: $scope.tipo_afiliacion_salud.unit,
        tipo_afiliacion: $scope.tipo_afiliacion.unit,
        salud_sgsss_beneficiario: otra_salud,
        parentesco_acudiente: $scope.tipo_parent,
        otro_parentesco_acudiente: parentesco_benec,
        ficha: ficha_registro,
        otro_poblacional: otro_poblacional,
        comuna: $scope.comuna_id

      };

      if (corregimiento_persona == null && direccion_sider == '') {

        swal("Algo te hace falta!", "Verifique que su campo Dirección no este vacio!", "error");
        toastr.error("Verifique que su campo Dirección no este vacio", "Campo Dirección");
      } else {

        $.ajax({
          url: base_api + '/postbeneficiarioprograma/actualizar/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            datos: datos,
            SelectPoblacional: SelectPoblacional,
            SelectDiscapacidad: SelectDiscapacidad
          }

        }).success(function () {
          swal("Muy bien!", "Su registro ha sido exitoso", "success");
          toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
          window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
        }).error(function () {
          console.log("success");
        });
      };
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/EditarViactivaProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarViactivaProgramaCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q) {

  $scope.reset = function () {
    $scope.state = undefined;
  };

  $scope.title = "Beneficiario Grupo";
  $scope.series = [];
  $scope.selectedPoblacionales = [];
  $scope.selectedDiscapacidades = [];

  $scope.getData = function () {
    $scope.serie = GrupoProgramaService.get({ id: $routeParams.id });
    console.log();
  };

  $scope.grupo_save = $routeParams.id;
  $scope.serie = {};
  $scope.title = "Editar Beneficiario";
  $scope.disable_submit = false;
  $scope.serie = {};

  $(function () {
    $('#id_persona_beneficiario_residencia_direccion').add_generator({
      direccion: 'id_persona_beneficiario_residencia_direccion',
      complemento: 'id_persona_beneficiario_residencia_direccion_complemento'
    });
  });

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
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_nacimiento_acudiente").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "1940:+nn"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  $.datepicker.setDefaults($.datepicker.regional['es']);
  $(function () {
    $("#fecha_inscripcion").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      yearRange: "-99:+0",
      maxDate: "+0m +0d"
    }).attr('readonly', 'readonly').attr('style', 'background-color:#FFF;cursor:text');
  });

  //Inicio Carga de datos Documento Crear

  $scope.tipo_doc = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {
    $scope.tipodocumento = response;
  });

  //Fin Carga de datos Documento Crear

  //inicio tipo documento acudients

  $scope.tipo_doc_acudiente = {
    'id': 1,
    'unit': null

    //fin


    //Inicio Carga datos sexo crear

  };$scope.tipo_estrato = {
    'id': 1,
    'unit': null
  };

  $scope.estrato = [{ id: 1, nombre: '1' }, { id: 2, nombre: '2' }, { id: 3, nombre: '3' }, { id: 4, nombre: '4' }, { id: 5, nombre: '5' }, { id: 6, nombre: '6' }, { id: 7, nombre: '7' }];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo crear

  $scope.tipo_sex = {
    'id': 1,
    'unit': null
  };

  $scope.sexo = [{ id: 1, nombre: 'Mujer' }, { id: 2, nombre: 'Hombre' }];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo real crear

  $scope.tipo_sex_real = {
    'id': 1,
    'unit': null
  };

  $scope.sexo_real = [{ id: 1, nombre: 'Heterosexual' }, { id: 2, nombre: 'Homosexual' }, { id: 3, nombre: 'Bisexual' }];

  //Fin Carga datos sexo real crear

  //Inicio Carga datos orientacion sexual crear

  $scope.tipo_orientacion_sexual = {
    'id': 1,
    'unit': null
  };

  $scope.sexo_orientacion_sexual = [{ id: 1, nombre: 'Lesbiana' }, { id: 2, nombre: 'Gay' }, { id: 3, nombre: 'Bisexual' }, { id: 4, nombre: 'Transformista' }, { id: 5, nombre: 'Transvestido' }, { id: 6, nombre: 'Transgenerista' }, { id: 7, nombre: 'Transexual' }, { id: 8, nombre: 'Intersexual' }, { id: 9, nombre: 'Querés' }, { id: 10, nombre: 'Pansexual' }, { id: 11, nombre: 'HSH' }, { id: 12, nombre: 'Queers' }, { id: 13, nombre: 'Otro' }];

  //Fin Carga datos orientacion sexual crear


  //Inicio Carga datos sexo crear

  $scope.tipo_sex_acudiente = {
    'id': 1,
    'unit': null

    //Fin Carga datos sexo crear

    //Inicio Carga datos tipo de sangre

  };$scope.tipo_sag = {
    'id': 1,
    'unit': null
  };

  $scope.sangre = [{ id: '1', nombre: 'O+' }, { id: '2', nombre: 'O-' }, { id: '3', nombre: 'A+' }, { id: '4', nombre: 'A-' }, { id: '5', nombre: 'B+' }, { id: '6', nombre: 'B-' }, { id: '7', nombre: 'AB+' }, { id: '8', nombre: 'AB-' }];

  //Fin Carga datos tipo de sangre


  $scope.tipo_com = {
    'id': 1,
    'unit': null

    //inicio cargar datos corregimientos

  };$scope.data_corregimiento = {
    'id': 1,
    'unit': null
  };

  $.ajax({
    url: base_api + "/obtener/corregimientos",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.corregimientos = response;
  }).error(function () {});

  //inicio cargar datos modalidades

  $scope.data_modalidad = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtener/modalidades").success(function (modalidades) {

    $scope.modalidades = modalidades;
  });

  //inicio cargar datos puntos de atencion

  $scope.data_puntoatencion = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtener/puntosatencion").success(function (puntosatencion) {

    $scope.puntosatencion = puntosatencion;
  });

  $scope.selectedCorregimiento = function (itemCorregimiento) {

    var promise = $http.get(base_api + "/obtener/veredas/" + itemCorregimiento);
    promise.then(function (responseveredas) {
      $scope.veredas = responseveredas.data;
    });
  };

  $scope.data_vereda = {
    'id': 1,
    'unit': null

    //fin 


    //inicio Data carga estado civl

  };$scope.tipo_est = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtener/estados_civiles").success(function (response) {
    $scope.civiles = response;
  });

  //

  //Inicio Carga datos hijos crear

  $scope.tipo_hij = {
    'id': 1,
    'unit': null
  };

  $scope.hijo = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //Fin Carga datos hijos crear

  //inicio cargar datos modalidades

  $scope.tipo_ocup = {
    'id': 1,
    'unit': 3
  };

  $http.get(base_api + "/obtener/ocupaciones").success(function (ocupaciones) {

    $scope.ocupaciones = ocupaciones;
  });

  //Inicio Carga de datos Escolaridad Crear


  $http.get(base_api + "/obtenerselect/escolaridades").success(function (response) {

    $scope.escolaridades = response;
  });

  //Fin Carga de datos Escolaridad Crear

  //Inicio Carga de datos Estado Escolaridad Crear


  $http.get(base_api + "/obtenerselect/EstadoEscolaridades").success(function (response) {

    $scope.estadoescolaridades = response;
  });

  //Inicio Carga datos cultura crear

  $scope.tipo_cult = {
    'id': 1,
    'unit': null
  };

  $scope.tipo_etnias = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/culturas").success(function (response) {

    $scope.etnias = response;
  });

  //Fin Carga datos cultura crear


  //inicio carga discapacidad si o no

  $scope.tipo_disc = {
    'id': 1,
    'unit': null
  };

  $scope.discapacidades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio carga afiliacion salud si o no

  $scope.tipo_afiliacion_salud = {
    'id': 1,
    'unit': null
  };

  $scope.afiliacion_salud = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin


  //inicio carga discapacidad si o no

  $scope.tipo_libreta = {
    'id': 1,
    'unit': null
  };

  $scope.libreta = [{ id: 1, nombre: 'Primera' }, { id: 2, nombre: 'Segunda' }];

  //fin


  //inicio carga salud si o no

  $scope.tipo_salud = {
    'id': 1,
    'unit': null
  };

  $scope.seguridad_social = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio carga alunos regimens


  $scope.tipo_salud_otra = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/salud_sgsss").success(function (response) {

    $scope.salud_sgsss = response;
  });

  //fin

  //inicio carga algunas discapacidades


  $scope.tipo_disc_otra = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (response) {

    $scope.discapacidad_otra = response;
  });

  //fin


  //Inicio cargar universidades
  $scope.selected = undefined;
  $http.get(base_api + "/obtenerselect/universidades").success(function (response) {

    $scope.universidades = response;
  });

  //Inicio cargar enfermedad si o no 

  $scope.tipo_eferm = {
    'id': 1,
    'unit': null
  };

  $scope.enfermedades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar data medicamentos si o no


  $scope.tipo_medic = {
    'id': 1,
    'unit': null
  };

  $scope.medicamentos = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar parentesco


  //inicio cargar data medicamentos si o no

  $scope.tipo_condicion = {
    'id': 1,
    'unit': null
  };

  $scope.condiciondiscapacidad = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  $scope.selectedCondicion = function (condicion) {

    if (condicion == 1) {
      $scope.ngShowhideDiscapacidad = true;
    } else {
      $scope.ngShowhideDiscapacidad = false;
    }
  };

  //fin


  //inicio carga Afiliacion


  $scope.tipo_afiliacion = {
    'id': 1,
    'unit': null
  };

  $http.get(base_api + "/obtenerselect/afiliaciones").success(function (response) {

    $scope.afiliaciones = response;
  });

  //fin


  $scope.tipo_parent = {
    'id': 1,
    'unit': null
  };

  $scope.parentescos = [{ id: '1', nombre: 'Madre/Padre' }, { id: '2', nombre: 'Hermana/Hermano' }, { id: '3', nombre: 'Tia/Tio' }, { id: '4', nombre: 'Abuela/Abuelo' }, { id: '5', nombre: 'Cuidador' }, { id: '6', nombre: 'Otro' }];
  //


  //inicio cargar poblacionales

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
  });

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (discapacidades) {

    $scope.allGruposDiscapacidades = discapacidades;
  });

  //fin

  $http.get(base_api + "/obtener/barrios").success(function (response) {

    $scope.barrios = response;
    // console.log($scope.barrios);
  });

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

    $scope.comunas = response;
  });

  $scope.selectedComuna = function (itemComuna) {

    $scope.tipo_barr = {
      'id': 1,
      'unit': null
    };
  };

  $scope.selectedBarrio = function (itemBarrio) {

    $http.get(base_api + "/obtener/estrato/" + itemBarrio).success(function (estratobeneficiario) {
      console.log(estratobeneficiario);
      $scope.tipo_estrato = {
        'id': 1,
        'unit': parseInt(estratobeneficiario.id_estrato)
      };
      $scope.comuna = estratobeneficiario.nombre_comuna;
      $scope.comuna_id = estratobeneficiario.comuna_id;
    });
  };

  $scope.ngShowhideBarrio = true;
  $scope.ngShowhideDireccion = true;
  $scope.ngShowhideComplemento = true;

  $scope.selectedVereda = function (veredaselect) {

    $http.get(base_api + "/obtener/estratoVereda/" + veredaselect).success(function (EstratoVereda) {
      console.log(EstratoVereda);
      $scope.tipo_estrato = {
        'id': 1,
        'unit': EstratoVereda.estrato
      };
      $scope.comuna = EstratoVereda.nombre_comuna;
      $scope.comuna_id = EstratoVereda.id_comuna;
    });

    if (veredaselect != null) {
      $scope.ngShowhideBarrio = false;
      $scope.ngShowhideDireccion = false;
      $scope.ngShowhideComplemento = false;
      $scope.barrio = undefined;
    } else {
      $scope.vereda = undefined;
      $scope.corregimiento = undefined;
      $scope.ngShowhideBarrio = true;
      $scope.ngShowhideDireccion = true;
      $scope.ngShowhideComplemento = true;
      $scope.tipo_estrato = {
        'id': 1,
        'unit': null
      };
      $scope.comuna = null;
    }
  };

  $scope.reset = function () {
    $scope.vereda = undefined;
    $scope.ngShowhideBarrio = true;
    $scope.ngShowhideDireccion = true;
  };

  $http.get(base_api + "/admin/cargafichaprograma/" + $routeParams.id).success(function (response) {

    console.log(response);

    $scope.serie = response[0];
    $scope.acudiente = response[0];
    $scope.ficha = response[0].no_ficha;
    $scope.doc = response[0].documento;

    if ($scope.serie.residencia_direccion != null) {
      $("#direccion_residencia_plugin").hide();
    } else if ($scope.serie.residencia_direccion == '' || $scope.serie.residencia_direccion == null) {
      $("#direccion_residencia_plugin").show();
    }

    $scope.tipo_doc = {
      'id': 1,
      'unit': $scope.serie.id_documento_tipo
    };

    $scope.no_documento_persona = $scope.serie.documento;
    $scope.comuna_id = $scope.serie.comuna_id;

    $scope.tipo_etnias = {
      'id': 1,
      'unit': $scope.serie.cultura_beneficiario
    };

    $scope.estado_esc = $scope.serie.estado_escolaridad;

    $scope.tipo_estrato = {
      'id': 1,
      'unit': parseInt($scope.serie.residencia_estrato)
    };
    $scope.tipo_afiliacion_salud = {
      'id': 1,
      'unit': $scope.serie.afiliacion_salud
    };
    $scope.tipo_doc = {
      'id': 1,
      'unit': $scope.serie.id_documento_tipo
    };
    $scope.tipo_condicion = {
      'id': 1,
      'unit': $scope.serie.condicion_discapacidad
    };

    if ($scope.serie.condicion_discapacidad == 1) {
      $scope.ngShowhideDiscapacidad = true;
    } else {
      $scope.ngShowhideDiscapacidad = false;
    }

    $scope.tipo_afiliacion = {
      'id': 1,
      'unit': $scope.serie.tipo_afiliacion
    };

    $scope.tipo_salud_otra = {

      'id': 1,
      'unit': $scope.serie.salud_sgss_id

      // console.log($scope.tipo_salud_otra);

    };$scope.tipo_sex = {
      'id': 1,
      'unit': $scope.serie.sexo
    };

    $scope.tipo_sag = {
      'id': 1,
      'unit': $scope.serie.sangre_tipo

      //Inicio Carga datos sexo real crear
    };$scope.tipo_sex_real = {
      'id': 1,
      'unit': $scope.serie.tipo_genero_r
      //Fin Carga datos sexo real crear

      //Inicio Carga datos orientacion sexual crear
    };$scope.tipo_orientacion_sexual = {
      'id': 1,
      'unit': $scope.serie.tipo_orientacion_sexual
      //Fin Carga datos orientacion sexual crear
    };if (parseInt($scope.serie.tipo_orientacion_sexual) == 13) {
      $scope.orientacion_sexual_otro = $scope.serie.orientacion_sexual_otro;
      $("#orientacion_sexual_otro").val($scope.serie.orientacion_sexual_otro);
      $("#rowOtroOrientacionSexual").show();
    }

    $scope.pais = $scope.serie.id_procedencia_pais;
    $scope.departamento = $scope.serie.id_procedencia_departamento;

    var promise = $http.get(base_api + "/obtener/municipios/" + $scope.departamento);
    promise.then(function (responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
    });

    $scope.municipio = $scope.serie.id_procedencia_municipio;

    $http.get(base_api + "/obtener/comuna_barrio/" + $scope.serie.id_residencia_barrio).success(function (responseComuna) {

      $scope.tipo_com = {
        'id': 1,
        'unit': responseComuna[0].id
      };

      $scope.barrio = $scope.serie.id_residencia_barrio;
    });

    $scope.corregimiento = $scope.serie.id_residencia_corregimiento;

    $http.get(base_api + "/obtener/estrato/" + $scope.serie.id_residencia_barrio).success(function (estratobeneficiario) {
      $scope.comuna = estratobeneficiario.nombre_comuna;
    });

    var promise = $http.get(base_api + "/obtener/veredas/" + $scope.serie.id_residencia_corregimiento);
    promise.then(function (responseveredas) {
      $scope.veredas = responseveredas.data;
    });

    $scope.vereda = $scope.serie.id_residencia_vereda;
    if ($scope.vereda != null) {
      $scope.ngShowhideBarrio = false;
      $scope.ngShowhideDireccion = false;
      $scope.ngShowhideComplemento = false;
      $scope.barrio = undefined;
    } else {
      $scope.vereda = undefined;
      $scope.corregimiento = undefined;
      $scope.ngShowhideBarrio = true;
      $scope.ngShowhideDireccion = true;
      $scope.ngShowhideComplemento = true;
    }

    $http.get(base_api + "/obtener/estratoVereda/" + $scope.serie.id_residencia_vereda).success(function (EstratoVereda) {
      console.log(EstratoVereda);
      $scope.tipo_estrato = {
        'id': 1,
        'unit': EstratoVereda.estrato
      };
      $scope.comuna = EstratoVereda.nombre_comuna;
    });

    $scope.tipo_est = {
      'id': 1,
      'unit': $scope.serie.id_estado_civil
    };

    $scope.tipo_hij = {
      'id': 1,
      'unit': $scope.serie.hijos_beneficiario
    };
    if ($scope.serie.hijos_beneficiario == 1) {
      $scope.isDisabled = false;
    } else {

      $scope.isDisabled = true;
    }

    $scope.tipo_ocup = {
      'id': 1,
      'unit': $scope.serie.ocupacion_id
    };

    if ($scope.serie.ocupacion_beneficiario == 8) {
      $scope.isDisabledOcupacion = false;
    } else {

      $scope.isDisabledOcupacion = true;
    }

    $scope.tipo_esc = $scope.serie.escolaridad_id;

    $scope.tipo_cult = {
      'id': 1,
      'unit': $scope.serie.cultura_beneficiario
    };

    if ($scope.serie.cultura_beneficiario == 10) {
      $scope.isDisabledCultura = false;
    } else {

      $scope.isDisabledCultura = true;
    }

    $http.get(base_api + "/obtener/poblacionalesprogramas/" + $routeParams.id).success(function (response) {

      $scope.selectedPoblacionales = response;
      $scope.selectedPoblacionales.map(function (poblacional) {

        if (poblacional.id == 10) {
          $scope.ngShowhideOtro = true;
        } else if (poblacional.id != 10) {
          $scope.ngShowhideOtro = false;
        }
      });
    });

    $scope.otro_poblacional = $scope.serie.otro_poblacional;

    $http.get(base_api + "/obtener/discapacidadesPrograma/" + $routeParams.id).success(function (response) {

      $scope.selectedDiscapacidades = response;
    });

    $scope.tipo_salud = {
      'id': 1,
      'unit': $scope.serie.seguridad_social_beneficiario
    };

    if ($scope.serie.seguridad_social_beneficiario == 1) {
      // $scope.isDisabledSeguridad = false;
    } else {

        // $scope.isDisabledSeguridad = true;
      }

    $scope.tipo_disc = {
      'id': 1,
      'unit': $scope.serie.discapacidad_beneficiario
    };

    if ($scope.serie.discapacidad_beneficiario == 1) {
      $scope.isDisabledDiscapacidad = false;
    } else {

      $scope.isDisabledDiscapacidad = true;
    }

    $scope.tipo_disc_otra = {
      'id': 1,
      'unit': $scope.serie.discapacidad_id

      // console.log($scope.tipo_disc_otra);
    };$scope.tipo_eferm = {
      'id': 1,
      'unit': $scope.serie.enfermedad_permanente_beneficiario
    };

    if ($scope.serie.enfermedad_permanente_beneficiario == 1) {
      $scope.isDisabledEnfermedad = false;
    } else {

      $scope.isDisabledEnfermedad = true;
    }

    $scope.tipo_medic = {
      'id': 1,
      'unit': $scope.serie.medicamentos_permanente_beneficiario
    };

    if ($scope.serie.medicamentos_permanente_beneficiario == 1) {
      $scope.isDisabledMedicamento = false;
    } else {

      $scope.isDisabledMedicamento = true;
    }

    $scope.tipo_doc_acudiente = {
      'id': 1,
      'unit': $scope.serie.tipodocacudiente

      // $scope.estado_esc = {
      // 'id': 1,
      // 'unit': $scope.serie.estado_escolaridad
      // }

    };$scope.tipo_sex_acudiente = {
      'id': 1,
      'unit': $scope.serie.sexoacudiente
    };

    $scope.tipo_parent = {
      'id': 1,
      'unit': $scope.serie.parentesco_acudiente
    };

    if ($scope.serie.parentesco_acudiente == 6) {
      $scope.isDisabledParentesco = false;
    } else {

      $scope.isDisabledParentesco = true;
    }
  });

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
  };

  $scope.setEnd = function (date) {
    $scope.endDate = date;
    $scope.endDatep = date;
    $scope.endDateInscripcion = date;
  };

  $scope.tipo_documento = [{ id: '1', nombre: 'Registro Civil' }, { id: '2', nombre: 'Tarjeta Identidad' }, { id: '3', nombre: 'Cédula de Ciudadanía' }, { id: '4', nombre: 'Pasaporte' }, { id: '5', nombre: 'Sin Información' }];

  $scope.grupos_poblacionales = [{ id: '1', nombre: 'Adulto Mayor' }, { id: '2', nombre: 'Afrodescendiente/Afrocolombiano' }, { id: '3', nombre: 'Víctimas del conflicto armado' }, { id: '4', nombre: 'Habitante calle' }, { id: '5', nombre: 'LGBTI' }, { id: '6', nombre: 'Persona con discapacidad' }, { id: '7', nombre: 'Grupo organizado de Mujeres' }, { id: '8', nombre: 'Indígenas' }, { id: '9', nombre: 'Reinsertado' }, { id: '10', nombre: 'Junta de acción comunal (JAC)' }, { id: '11', nombre: 'Grupo organizado de Jóvenes' }, { id: '12', nombre: 'Ninguno' }, { id: '13', nombre: 'Recluido' }, { id: '14', nombre: 'Junta de administradora local (JAL)' }, { id: '15', nombre: 'Otro grupo' }];

  $scope.selected = {
    poblacionales: []
  };

  $http.get(base_api + "/obtener/programas").success(function (response) {

    $scope.programas = response;
  });

  $scope.pais = 1;

  $.ajax({
    url: base_api + "/obtener/paises",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.paises = response;
  }).error(function () {});

  $scope.data_paises = {
    'id': 1,
    'unit': 1
  };

  if ($scope.data_paises.unit == 1) {

    $scope.ngShowhide1 = true;
    $scope.ngShowhide2 = false;
  } else {

    $scope.ngShowhide1 = false;
    $scope.ngShowhide2 = true;
  }

  $scope.departamento = 76;
  $.ajax({
    url: base_api + "/obtener/departamentos/" + $scope.data_paises.unit,
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.departamentos = response;
  }).error(function () {});

  $scope.municipio = 834;
  $http.get(base_api + "/obtener/municipios/" + $scope.departamento).success(function (response) {
    $scope.municipios = response;
  });

  $scope.selectedPais = function (itemPais) {

    if (itemPais == 1) {

      $scope.ngShowhide1 = true;
      $scope.ngShowhide2 = false;
    } else {

      $scope.ngShowhide1 = false;
      $scope.ngShowhide2 = true;
    }
    $.ajax({
      url: base_api + "/obtener/departamentos/" + itemPais,
      type: 'GET',
      dataType: 'JSON',
      async: false
    }).success(function (response) {
      $scope.departamentos = response;
    }).error(function () {});
  };

  $scope.selectedDepartamento = function (itemDepartamento) {

    var promise = $http.get(base_api + "/obtener/municipios/" + itemDepartamento);
    promise.then(function (responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
    });
  };

  $scope.isDisabled = true;
  $scope.isDisabledOcupacion = true;
  $scope.isDisabledCultura = true;
  $scope.isDisabledDiscapacidad = true;
  $scope.isDisabledEnfermedad = true;
  $scope.isDisabledMedicamento = true;
  // $scope.isDisabledSeguridad = true;
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
      $scope.tipo_disc_otra.unit = null;
      $scope.serie.otra_discapacidad_beneficiario = null;
    }
  };

  $scope.selectedEnfermedad = function (itemEnfermedad) {

    if (itemEnfermedad == 1) {
      $scope.isDisabledEnfermedad = false;
    } else {

      $scope.isDisabledEnfermedad = true;
      $scope.serie.enfermedad_beneficiario = null;
    }
  };

  $scope.selectedMedicamento = function (itemMedicamento) {

    if (itemMedicamento == 1) {
      $scope.isDisabledMedicamento = false;
    } else {

      $scope.isDisabledMedicamento = true;
      $scope.serie.medicamentos_beneficiario = null;
    }
  };

  $scope.selectedSeguridad = function (itemSeguridad) {

    if (itemSeguridad == 1) {
      // $scope.isDisabledSeguridad = false;
    } else {

      // $scope.isDisabledSeguridad = true;
      $scope.tipo_salud_otra.unit = null;
      $scope.serie.nombre_seguridad_beneficiario = null;
    }
  };

  // evento cambia orientacion sexual
  $scope.selectedOrientacionSexual = function (item) {
    $("#rowOtroOrientacionSexual").hide();
    $("#rowOtroOrientacionSexual").val("");
    $("#orientacion_sexual_otro").val("N/A").change();
    if (parseInt(item) == 13) {
      $("#rowOtroOrientacionSexual").show(500, "");
      $("#orientacion_sexual_otro").val("").change();
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

  $scope.ngShowhideOtro = false;

  $scope.toggleSelection = function toggleSelection(seleccion) {

    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);

    if (index == index && seleccion.id == 10) {
      $scope.ngShowhideOtro = true;
      $scope.otro_poblacional = '';
    }

    if (seleccion.id == 10) {
      $scope.ngShowhideOtro = true;
    }

    if (index > -1) {
      $scope.selectedPoblacionales.splice(index, 1);

      if (index == 0 && seleccion.id == 10) {
        $scope.ngShowhideOtro = false;
        $scope.otro_poblacional = '';
      }

      // console.log($scope.serie.ficha_save);
      // console.log(seleccion.id);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/poblacional/" + $scope.serie.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedPoblacionales.push(seleccion);
    }
  };

  $scope.toggleSelectionDiscapacidad = function toggleSelectionDiscapacidad(seleccion) {

    var index = $scope.selectedDiscapacidades.indexOfObjectWithProperty('id', seleccion.id);
    // console.log(index);

    if (index > -1) {
      $scope.selectedDiscapacidades.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/discapacidadBeneficiario/" + $scope.serie.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedDiscapacidades.push(seleccion);
    }
  };

  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;

  $scope.formsubmit = function (id, isValid) {

    if (isValid) {
      var direccion_sider = $("#id_persona_beneficiario_residencia_direccion").val();
      var cantidad_hijos_b = '';
      var otra_ocupacion = '';
      var otra_cultura = '';
      var cual_discapacidad = '';
      var otra_discapacidad = '';
      var enfermedad_benec = '';
      var medicamento_benec = '';
      var otra_salud = '';
      var seguridad_benec = '';
      var parentesco_benec = '';

      if ($scope.universidad == undefined) {
        $scope.universidad = null;
      }
      if ($scope.universidad == null) {
        $scope.universidad = null;
      } else {
        $scope.universidad = $scope.universidad;
      }

      if ($scope.serie.telefono_fijo == undefined) {
        $scope.serie.telefono_fijo = null;
      } else {
        $scope.serie.telefono_fijo = $scope.serie.telefono_fijo;
      }

      if ($scope.acudiente.telefono_fijo_acudiente == undefined) {
        $scope.acudiente.telefono_fijo_acudiente = null;
      } else {
        $scope.acudiente.telefono_fijo_acudiente = $scope.acudiente.telefono_fijo_acudiente;
      }

      if ($scope.otro_poblacional == undefined) {
        otro_poblacional = null;
      } else if ($scope.otro_poblacional != null) {
        otro_poblacional = $scope.otro_poblacional;
      }

      if ($scope.serie.cantidad_hijos_beneficiario == undefined) {
        cantidad_hijos_b = null;
      } else if ($scope.serie.cantidad_hijos_beneficiario != null) {
        cantidad_hijos_b = $scope.serie.cantidad_hijos_beneficiario;
      }
      if ($scope.serie.otra_ocupacion_beneficiario == undefined) {
        otra_ocupacion = null;
      } else if ($scope.serie.otra_ocupacion_beneficiario != null) {
        otra_ocupacion = $scope.serie.otra_ocupacion_beneficiario;
      }

      if ($scope.serie.otra_cultura_beneficiario == undefined) {
        otra_cultura = null;
      } else if ($scope.serie.otra_cultura_beneficiario != null) {
        otra_cultura = $scope.serie.otra_cultura_beneficiario;
      }

      if ($scope.tipo_disc_otra.unit == undefined) {
        cual_discapacidad = null;
      } else if ($scope.tipo_disc_otra.unit != null) {
        cual_discapacidad = $scope.tipo_disc_otra.unit;
      }

      if ($scope.serie.otra_discapacidad_beneficiario == undefined) {
        otra_discapacidad = null;
      } else if ($scope.serie.otra_discapacidad_beneficiario != null) {
        otra_discapacidad = $scope.serie.otra_discapacidad_beneficiario;
      }

      if ($scope.serie.enfermedad_beneficiario == undefined) {
        enfermedad_benec = null;
      } else if ($scope.serie.enfermedad_beneficiario != null) {
        enfermedad_benec = $scope.serie.enfermedad_beneficiario;
      }

      if ($scope.serie.medicamentos_beneficiario == undefined) {
        medicamento_benec = null;
      } else if ($scope.serie.medicamentos_beneficiario != null) {
        medicamento_benec = $scope.serie.medicamentos_beneficiario;
      }

      if ($scope.tipo_salud_otra.unit == undefined) {
        otra_salud = null;
      } else if ($scope.tipo_salud_otra.unit != null) {
        otra_salud = $scope.tipo_salud_otra.unit;
      }

      if ($scope.serie.nombre_seguridad_beneficiario == undefined) {
        seguridad_benec = null;
      } else if ($scope.serie.nombre_seguridad_beneficiario != null) {
        seguridad_benec = $scope.serie.nombre_seguridad_beneficiario;
      }

      if ($scope.tipo_sag.unit == undefined) {
        $scope.tipo_sag.unit = null;
      } else if ($scope.tipo_sag.unit != null) {
        $scope.tipo_sag.unit = $scope.tipo_sag.unit;
      }

      if ($scope.serie.otro_parentesco_acudiente == undefined) {
        parentesco_benec = null;
      } else if ($scope.serie.otro_parentesco_acudiente != null) {
        parentesco_benec = $scope.serie.otro_parentesco_acudiente;
      }

      if ($scope.corregimiento == undefined) {
        corregimiento_persona = null;
      } else if ($scope.corregimiento != null) {
        corregimiento_persona = $scope.corregimiento;
      }

      if ($scope.vereda == undefined) {
        vereda_persona = null;
      } else if ($scope.vereda != null) {
        vereda_persona = $scope.vereda;
      }
      if ($scope.barrio == undefined) {
        barrio_persona = null;
      } else if ($scope.barrio != null) {
        barrio_persona = $scope.barrio;
      }

      if ($scope.tipo_esc == undefined) {
        $scope.tipo_esc = null;
      } else if ($scope.tipo_esc != null) {
        $scope.tipo_esc = $scope.tipo_esc;
      }

      if ($scope.estado_esc == undefined) {
        $scope.estado_esc = null;
      } else if ($scope.estado_esc != null) {
        $scope.estado_esc = $scope.estado_esc;
      }

      var ficha_registro = 0;
      if ($scope.serie.ficha_save == null) {

        ficha_registro = 0;
      } else if ($scope.serie.ficha_save > 0) {

        ficha_registro = $scope.serie.ficha_save;
      }

      var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val();
      var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
      var fecha_inscripcion = $("#fecha_inscripcion").val();
      var SelectPoblacional = $scope.selectedPoblacionales;
      var SelectDiscapacidad = $scope.selectedDiscapacidades;

      var datos = {

        //Datos Persona
        tipo_doc_persona: $scope.tipo_doc.unit,
        no_documento_persona: $scope.no_documento_persona,
        primer_nombre_persona: $scope.serie.nombre_primero,
        segundo_nombre_persona: $scope.serie.nombre_segundo,
        primer_apellido_persona: $scope.serie.apellido_primero,
        segundo_apellido_persona: $scope.serie.apellido_segundo,
        correo_persona: $scope.serie.correo_electronico,

        sexo_persona: $scope.tipo_sex.unit,

        tipo_genero_r: $scope.tipo_sex_real.unit,
        tipo_orientacion_sexual: $scope.tipo_orientacion_sexual.unit,
        orientacion_sexual_otro: $scope.orientacion_sexual_otro,

        fecha_nac_persona: fecha_nacimiento_beneficiario,
        pais_id: $scope.data_paises.unit,
        departamento_id: $scope.departamento,
        municipio_id: $scope.municipio,
        corregimiento: corregimiento_persona,
        vereda: vereda_persona,
        barrio_id: barrio_persona,
        estrato: $scope.tipo_estrato.unit,
        residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
        complemento: $("#id_persona_beneficiario_residencia_direccion_complemento").val(),
        telefono_fijo_persona: $scope.serie.telefono_fijo,
        telefono_movil_persona: $scope.serie.telefono_movil,
        tip_sangre_persona: $scope.tipo_sag.unit,
        estado_civil_persona: $scope.tipo_est.unit,

        //Acudiente Persona
        primer_nombre_acudiente: $scope.acudiente.nombre_primero_acudiente,
        segundo_nombre_acudiente: $scope.acudiente.nombre_segundo_acudiente,
        primer_apellido_acudiente: $scope.acudiente.apellido_primero_acudiente,
        segundo_apellido_acudiente: $scope.acudiente.apellido_segundo_acudiente,
        sex_pariente: $scope.tipo_sex_acudiente.unit,
        fecha_nac_acudiente: fecha_nacimiento_acudiente,
        telefono_fijo_acudiente: $scope.acudiente.telefono_fijo_acudiente,
        telefono_movil_acudiente: $scope.acudiente.telefono_movil_acudiente,
        correo_acudiente: $scope.acudiente.correo_electronico_acudiente,
        no_documento_acudiente: $scope.acudiente.documento_acudiente,
        tip_doc_acudiente: $scope.tipo_doc_acudiente.unit,

        //Datos Beneficiario     
        no_ficha: $scope.serie.no_ficha,
        fecha_inscripcion: fecha_inscripcion,
        escolaridad_beneficiario: $scope.tipo_esc,
        estado_escolaridad: $scope.estado_esc,
        titulo_obtenido: $scope.serie.titulo_obtenido,
        universidad: $scope.universidad,
        ocupacion_beneficiario: $scope.tipo_ocup.unit,
        hijos_beneficiario: $scope.tipo_hij.unit,
        cantidad_hijos_beneficiario: cantidad_hijos_b,
        cultura_beneficiario: $scope.tipo_etnias.unit,
        discapacidad_beneficiario: $scope.tipo_disc.unit,
        otra_discapacidad_beneficiario: otra_discapacidad,
        medicamentos_permanente_beneficiario: $scope.tipo_medic.unit,
        medicamentos_beneficiario: medicamento_benec,
        condicion_discapacidad: $scope.tipo_condicion.unit,
        afiliacion_salud: $scope.tipo_afiliacion_salud.unit,
        tipo_afiliacion: $scope.tipo_afiliacion.unit,
        salud_sgsss_beneficiario: otra_salud,
        parentesco_acudiente: $scope.tipo_parent.unit,
        otro_parentesco_acudiente: parentesco_benec,
        ficha: ficha_registro,
        otro_poblacional: otro_poblacional,
        comuna: $scope.comuna_id

      };

      $.ajax({
        url: base_api + '/postbeneficiarioprograma/actualizar/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {
          datos: datos,
          SelectPoblacional: SelectPoblacional,
          SelectDiscapacidad: SelectDiscapacidad
        }

      }).success(function () {
        swal("Muy bien!", "Su registro ha sido exitoso", "success");
        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas";
      }).error(function () {
        console.log("success");
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/GruposConsultaProgramaAsistenciaCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller("GruposConsultaProgramaAsistenciaCrtl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
    $scope.title = "Mis Beneficiarios Consulta Asistencias";

    $scope.series = [];
    $scope.getData = function () {

        $http.get(base_api + "/obtener/misbeneficiariosasistenciasprogramas").success(function (response) {
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
    $scope.series = GrupoProgramaService.query();

    $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

        $scope.comunas = response;
    });

    $scope.toggle = function (modalstate, id) {
        $scope.modalstate = modalstate;
        switch (modalstate) {

            case 'CambiarGrupo':
                $scope.form_contenido = "GRUPOS";
                $scope.form_title = "obtener";
                $scope.id = id;

                break;
            default:
                break;
        }

        $('#myModal').modal('show');
    };

    $http.get(base_api + "/obtener/allgruposmonitor").success(function (response) {
        $scope.grupos = response;
    });
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/GruposConsultaProgramaCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('GruposConsultaProgramaCrtl', function ($scope, $routeParams, $location, GrupoProgramaService, $http, $timeout, base_api) {

    $scope.title = "Grupos Consulta";
    $scope.series = [];
    $scope.var1 = '07-2013';

    $(document).ready(function () {

        $.datepicker.setDefaults($.datepicker.regional['es']);

        $('#txtDate').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'mm-yy',
            showButtonPanel: true,

            onClose: function onClose() {
                var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
                $(this).datepicker('refresh');
            },

            beforeShow: function beforeShow() {
                if ((selDate = $(this).val()).length > 0) {
                    iYear = selDate.substring(selDate.length - 4, selDate.length);
                    iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
                    $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
                    $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
                }
            }
        });

        $("#txtDate").focus(function () {
            $(".ui-datepicker-calendar").hide();
            $("#ui-datepicker-div").position({
                my: "center top",
                at: "center bottom",
                of: $(this)
            });
        });

        $("#txtDate").blur(function () {
            $(".ui-datepicker-calendar").hide();
        });
    });

    $('#fechaExport-1').monthpicker();
    $('#fechaExport-2').monthpicker({ pattern: 'yyyy-mm',
        selectedYear: 2018,
        startYear: 1900,
        finalYear: 2212 });
    var options = {
        selectedYear: 2015,
        startYear: 2008,
        finalYear: 2018,
        openOnFocus: false // Let's now use a button to show the widget
    };

    $('#fechaExport-3').monthpicker(options);

    $('#fechaExport-3').monthpicker().bind('monthpicker-change-year', function (e, year) {
        $('#fechaExport-3').monthpicker('disableMonths', []); // (re)enables all
        if (year === '2015') {
            $('#fechaExport-3').monthpicker('disableMonths', [1, 2, 3, 4]);
        }
        if (year === '2014') {
            $('#fechaExport-3').monthpicker('disableMonths', [9, 10, 11, 12]);
        }
    });

    $('#fechaExport-3-button').bind('click', function () {
        $('#fechaExport-3').monthpicker('show');
    });

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');ga.type = 'text/javascript';ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga, s);
    })();

    $http.get(base_api + "/selectgruposprogramas/monitor").success(function (response) {

        $scope.grupos_monitores = response;
    });

    $scope.getData = function () {
        $http.get(base_api + "/admin/postgruposprogramas/consulta").success(function (response) {
            console.log(response);
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
    $scope.series = GrupoProgramaService.query();

    $scope.CargaParrilla = function () {

        $http({
            url: base_api + '/obtener/carga_parrilla',
            method: "GET",
            params: {
                grupo: $scope.grupo,
                fecha: $('#fechaExport-2').val()

            }
        }).success(function (data) {
            $scope.list = data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter
            $scope.totalItems = $scope.list.length;
        }).error(function () {
            console.log("error");
        });
    };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/GruposProgramasCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('GruposProgramasCrtl', function ($scope, $routeParams, $location, GrupoProgramaService, $http, $timeout, base_api) {

  $scope.title = "Grupos Programas";
  $scope.series = [];

  $scope.var1 = '07-2013';

  $('#fechaExport-1').monthpicker();
  $('#fechaExport-2').monthpicker({ pattern: 'yyyy-mm',
    selectedYear: 2019,
    startYear: 1900,
    finalYear: 2212 });
  var options = {
    selectedYear: 2015,
    startYear: 2008,
    finalYear: 2018,
    openOnFocus: false // Let's now use a button to show the widget
  };

  $('#fechaExport-3').monthpicker(options);

  $('#fechaExport-3').monthpicker().bind('monthpicker-change-year', function (e, year) {
    $('#fechaExport-3').monthpicker('disableMonths', []); // (re)enables all
    if (year === '2015') {
      $('#fechaExport-3').monthpicker('disableMonths', [1, 2, 3, 4]);
    }
    if (year === '2014') {
      $('#fechaExport-3').monthpicker('disableMonths', [9, 10, 11, 12]);
    }
  });

  $('#fechaExport-3-button').bind('click', function () {
    $('#fechaExport-3').monthpicker('show');
  });

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function () {
    var ga = document.createElement('script');ga.type = 'text/javascript';ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga, s);
  })();

  $http.get(base_api + "/obtenergruposprogramas/monitor").success(function (response) {

    $scope.grupos_monitores = response;
  });

  $scope.getData = function () {
    $http.get(base_api + "/admin/postgruposprogramas").success(function (response) {
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
  $scope.series = GrupoProgramaService.query();

  $scope.inactivar = function (id) {

    Swal.fire({ title: 'Desea inactivar este grupo!', showCancelButton: true }).then(function (result) {
      if (result.value) {
        $http({
          url: base_api + "/admin/postgruposprogramas/inactivar/" + id,
          method: "POST"
        }).then(function (response) {
          Swal.fire('Inactivado!', 'Registro Inactivado', 'success');
          $scope.getData();
        }, function (response) {// optional
          // failed
        });
      } else {
        Swal.fire('Cancelado!', 'No activo su registro :)', 'error');
      }
    });
  };

  $scope.activar = function (id) {

    Swal.fire({ title: 'Desea activar este grupo!', showCancelButton: true }).then(function (result) {
      if (result.value) {

        $http({
          url: base_api + "/admin/postgruposprogramas/activar/" + id,
          method: "POST"
        }).then(function (response) {

          Swal.fire('Activado!', 'Registro Activado', 'success');
          $scope.getData();
        }, function (response) {// optional
          // failed
        });
      } else {

        Swal.fire('Cancelado!', 'No activo su registro :)', 'error');
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
          url: base_api + '/eliminar/grupo_programa/' + id,
          type: 'POST',
          dataType: 'JSON'

        }).success(function (response) {
          swal("Eliminado!", "Registro Eliminado.", "success");
          $scope.getData();
        }).error(function () {

          swal("Cancelado", "No puede eliminar este grupo tiene asociado beneficiarios :)", "error");
        });
      } else {
        swal("Cancelado", "No elimino su registro :)", "error");
      }
    });
  };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/GruposReasignacionProgramaCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('GruposReasignacionProgramaCrtl', function ($scope, $routeParams, $location, GrupoProgramaService, $http, $timeout, base_api) {

    $scope.title = "Grupos Reasignacion";
    $scope.series = [];

    $http.get(base_api + "/obtenerusuarios/all").success(function (response) {

        $scope.usuarios = response;
    });

    $scope.getData = function () {
        $http.get(base_api + "/admin/postgruposprogramas/consulta").success(function (response) {
            console.log(response);
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
    $scope.series = GrupoProgramaService.query();

    $scope.selectedUsuario = function (usuario) {

        $http.get(base_api + "/admin/postgruposprogramas/consultausuario/" + usuario).success(function (response) {
            console.log(response);
            $scope.list = response;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter
            $scope.totalItems = $scope.list.length;
        });
    };

    $scope.ReasignacionUsuario = function (modalstate, id, nombre_grupo) {

        $scope.modalstate = modalstate;
        switch (modalstate) {
            case 'obtener':
                $scope.titulo = "REASIGNACIÓN USUARIO GRUPO";
                $scope.nombre_grupo = nombre_grupo;
                $scope.metodo = 1;
                $scope.valorID = id;

                break;
        }
        $('#myModal').modal('show');
    };

    $scope.formReasignacion = function (valorID) {

        console.log($scope.usuariocambio);
        if ($scope.usuariocambio == undefined) {
            swal("lo sentimos!", "Verifique que su campo usuario halla sido seleccionado!", "error");
            toastr.error("Verifique que su campo usuario halla sido seleccionado", "Campo Usuario");
        } else {
            $.ajax({
                url: base_api + '/reasignacion/grupoprograma/' + valorID,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    usuario: $scope.usuariocambio

                }

            }).success(function (response) {
                swal("Muy bien!", "Registro reasignado.", "success");
                $scope.usuario = '';
                $scope.getData();
            });
        }
    };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/InfoAsistenciaGrupoProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("InfoAsistenciaGrupoProgramaCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Mis Beneficiarios";

  $scope.series = [];
  $scope.no_grupo = $routeParams.id;

  $http.get(base_api + "/obtener/nombre_grupoprograma/" + $routeParams.id).success(function (response_grupo) {

    $scope.nombre_grupo = response_grupo.nombre_grupo;
    $scope.nombre_lugar = response_grupo.nombre_lugar;
    $scope.nombre_disciplina = response_grupo.nombre_disciplina;
  });

  $http.get(base_api + "/obtener/nombre_beneficiarioprograma/" + $routeParams.id).success(function (response_beneficiario) {

    $scope.nombre_primero = response_beneficiario.nombre_primero;
    $scope.apellido_primero = response_beneficiario.apellido_primero;
  });

  $scope.getData = function () {

    $scope.grupo = $routeParams.id;
    $http.get(base_api + "/obtener/misasistenciasprogramas/" + $routeParams.id + "/" + $routeParams.grupo).success(function (response) {
      console.log(response);
      $scope.list = response;
      $scope.currentPage = 1; //current page
      $scope.entryLimit = 35; //max no of items to display in a page
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
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/MisBeneficiariosGrupoConsultaProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("MisBeneficiariosGrupoConsultaProgramaCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Mis Beneficiarios";

  $scope.series = [];
  $scope.no_grupo = $routeParams.id;

  $http.get(base_api + "/obtener/nombre_grupoprograma/" + $routeParams.id).success(function (response_grupo) {

    console.log(response_grupo);
    $scope.nombre_grupo = response_grupo.nombre_grupo;
  });

  $scope.getData = function () {
    $scope.series_grupos = GrupoProgramaService.get({ id: $routeParams.id });

    $scope.grupo = $routeParams.id;
    $http.get(base_api + "/obtener/misbeneficiariosconsultaprograma/" + $routeParams.id).success(function (response) {
      console.log(response);
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
  $scope.series = GrupoProgramaService.query();

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

    $scope.comunas = response;
  });

  $scope.toggle = function (modalstate, id) {
    $scope.modalstate = modalstate;
    switch (modalstate) {

      case 'CambiarGrupo':
        $scope.form_contenido = "GRUPOS";
        $scope.form_title = "obtener";
        $scope.id = id;

        break;
      default:
        break;
    }

    $('#myModal').modal('show');
  };

  $http.get(base_api + "/obtener/allgruposmonitor").success(function (response) {
    $scope.grupos = response;
  });

  $scope.formCambiar = function (isValid, id) {

    console.log(id);

    if (isValid) {

      $.ajax({
        url: base_api + '/postbeneficiario/asociargrupo/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {
          grupo_id: $scope.grupo
        }

      }).success(function () {

        $scope.getData();
        toastr.success("Su registro ha sido exitoso", "Grupo Asociado");
        window.location = "/admin/postgrupos#/admin/postgrupos/misbeneficiarios/" + $routeParams.id;
        $('#myModal').modal('hide');
      }).error(function () {
        console.log("success");
      });
    }
  };

  $scope.SacarGrupo = function (id) {

    swal({
      title: "Estas seguro?",
      text: "No podrá recuperar este archivo!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, Eliminado del Grupo!",
      cancelButtonText: "No, lo Elimines!",
      closeOnConfirm: false,
      closeOnCancel: false
    }, function (isConfirm) {
      if (isConfirm) {

        $.ajax({
          url: base_api + '/sacar/grupo_beneficiario/' + id,
          type: 'POST',
          dataType: 'JSON'

        }).success(function (response) {
          swal("Eliminado!", "Registro Eliminado del grupo.", "success");
          $scope.getData();
        });
      } else {
        swal("Cancelado", "No elimino su registro :)", "error");
      }
    });
  };

  $scope.formsubmit = function (id, isValid) {
    $scope.fecha_iscrip = $scope.startDateInscripcion;
    var d_inscripcion_date = new Date($scope.fecha_iscrip);
    var fecha_inscripcion_date = $.datepicker.formatDate('yy/mm/dd', d_inscripcion_date);
    $scope.fecha_nac_benef = $scope.startDate;
    var d_nacimiento_beneficiario = new Date($scope.fecha_nac_benef);
    var fecha_nacimiento_beneficiario = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_beneficiario);
    $scope.fecha_nac_acud = $scope.startDateParentesco;
    var d_nacimiento_acudiente = new Date($scope.fecha_nac_acud);
    var fecha_nacimiento_acudiente = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_acudiente);
    var SelectPoblacional = $scope.selected.poblacionales;

    if (isValid) {

      var datos = {
        fecha_inscripcion: fecha_inscripcion_date,
        no_ficha: $scope.numero_ficha,
        programa_id: $scope.programa,
        modalidad: $scope.modalidad,
        punto_atencion: $scope.punto_atencion,
        nombres_beneficiario: $scope.nombres_beneficiario,
        apellidos_beneficiario: $scope.apellidos_beneficiario,
        tipo_documento_beneficiario: $scope.tipo_documento_beneficiario,
        no_documento_beneficiario: $scope.no_documento_beneficiario,
        sexo_beneficiario: $scope.sexo_beneficiario,
        fecha_nac_beneficiario: fecha_nacimiento_beneficiario,
        edad_beneficiario: $scope.edad_beneficiario,
        telefono_beneficiario: $scope.telefono_beneficiario,
        correo_beneficiario: $scope.correo_beneficiario,
        pais_id: $scope.pais,
        departamento_id: $scope.departamento,
        municipio_id: $scope.municipio,
        direccion_beneficiario: $scope.residencia_beneficiario,
        estrato_beneficiario: $scope.estrato,
        comuna_id: $scope.comuna,
        barrio_id: $scope.barrio,
        corregimiento_beneficiario: $scope.corregimiento,
        vereda_beneficiario: $scope.vereda,
        estado_civil_beneficiario: $scope.est_beneficiario,
        hijos_beneficiario: $scope.hijo,
        cantidad_hijos_beneficiario: $scope.cantidad_hijos,
        tipo_sangre_beneficiario: $scope.tip_sangre,
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
        nombres_acudiente: $scope.nombres_familiar,
        apellidos_acudiente: $scope.apellidos_familiar,
        tipo_doc_acudiente: $scope.tipo_familiar,
        documento_acudiente: $scope.no_documento_pariente,
        sexo_acudiente: $scope.sex_pariente,
        fecha_nac_acudiente: fecha_nacimiento_acudiente,
        edad_acudiente: $scope.edad_pariente,
        telefono_acudiente: $scope.telefono_pariente,
        correo_acudiente: $scope.email_pariente,
        parentesco_acudiente: $scope.parentesco,
        otro_parentesco_acudiente: $scope.otro_parentesco
      };

      $.ajax({
        url: base_api + '/postbeneficiario/create/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {
          datos: datos,
          SelectPoblacional: SelectPoblacional
        }

      }).success(function () {

        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location = "/admin/postgrupos#/admin/postgrupos";
      }).error(function () {
        console.log("success");
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/gruposprogramas/MisBeneficiariosGrupoProgramaCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("MisBeneficiariosGrupoProgramaCtrl", function ($scope, GrupoProgramaService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Mis Beneficiarios";

  $scope.series = [];
  $scope.no_grupo = $routeParams.id;

  $http.get(base_api + "/obtener/nombre_grupoprograma/" + $routeParams.id).success(function (response_grupo) {
    console.log(response_grupo);
    $scope.nombre_grupo = response_grupo.nombre_grupo;
    $scope.nombre_lugar = response_grupo.nombre_lugar;
    $scope.nombre_disciplina = response_grupo.nombre_disciplina;
  });

  $scope.getData = function () {
    $scope.series_grupos = GrupoProgramaService.get({ id: $routeParams.id });

    $scope.grupo = $routeParams.id;
    $http.get(base_api + "/obtener/misbeneficiariosprograma/" + $routeParams.id).success(function (response) {
      console.log(response);
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
  $scope.series = GrupoProgramaService.query();

  $scope.toggle = function (modalstate, id) {
    $scope.modalstate = modalstate;
    switch (modalstate) {

      case 'CambiarGrupo':
        $scope.form_contenido = "GRUPOS";
        $scope.form_title = "obtener";
        $scope.id = id;
        $http.get(base_api + "/obtener/gruposmonitorprogramas").success(function (response) {
          console.log(response);
          $scope.grupos = response;
        });

        break;
      default:
        break;
    }

    $('#myModal').modal('show');
  };

  $http.get(base_api + "/obtener/allgruposmonitor").success(function (response) {
    $scope.grupos = response;
  });

  $scope.formCambiar = function (isValid, id) {

    console.log(id);

    if (isValid) {

      $.ajax({
        url: base_api + '/postbeneficiarioprograma/asociargrupo/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {
          grupo_id: $scope.grupo
        }

      }).success(function () {

        $scope.getData();
        toastr.success("Su registro ha sido exitoso", "Grupo Asociado");
        window.location = "/admin/postgruposprogramas#/admin/postgruposprogramas/misbeneficiarios/" + $routeParams.id;
        $('#myModal').modal('hide');
      }).error(function () {
        console.log("success");
      });
    }
  };

  $scope.SacarGrupo = function (id) {

    Swal.fire({ title: 'Desea sacarlo del grupo?', showCancelButton: true }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: base_api + '/sacar/beneficiario/' + id,
          type: 'POST',
          dataType: 'JSON'

        }).success(function (response) {

          Swal.fire('Eliminado!', 'Registro Eliminado del grupo', 'success');
          $scope.getData();
        });
      } else {

        Swal.fire({
          title: 'Cancelado!',
          text: 'No elimino su registro :)',
          type: 'error',
          confirmButtonText: 'Cool'
        });
      }
    });
  };

  $scope.formsubmit = function (id, isValid) {
    $scope.fecha_iscrip = $scope.startDateInscripcion;
    var d_inscripcion_date = new Date($scope.fecha_iscrip);
    var fecha_inscripcion_date = $.datepicker.formatDate('yy/mm/dd', d_inscripcion_date);
    $scope.fecha_nac_benef = $scope.startDate;
    var d_nacimiento_beneficiario = new Date($scope.fecha_nac_benef);
    var fecha_nacimiento_beneficiario = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_beneficiario);
    $scope.fecha_nac_acud = $scope.startDateParentesco;
    var d_nacimiento_acudiente = new Date($scope.fecha_nac_acud);
    var fecha_nacimiento_acudiente = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_acudiente);
    var SelectPoblacional = $scope.selected.poblacionales;

    if (isValid) {

      var datos = {
        fecha_inscripcion: fecha_inscripcion_date,
        no_ficha: $scope.numero_ficha,
        programa_id: $scope.programa,
        modalidad: $scope.modalidad,
        punto_atencion: $scope.punto_atencion,
        nombres_beneficiario: $scope.nombres_beneficiario,
        apellidos_beneficiario: $scope.apellidos_beneficiario,
        tipo_documento_beneficiario: $scope.tipo_documento_beneficiario,
        no_documento_beneficiario: $scope.no_documento_beneficiario,
        sexo_beneficiario: $scope.sexo_beneficiario,
        fecha_nac_beneficiario: fecha_nacimiento_beneficiario,
        edad_beneficiario: $scope.edad_beneficiario,
        telefono_beneficiario: $scope.telefono_beneficiario,
        correo_beneficiario: $scope.correo_beneficiario,
        pais_id: $scope.pais,
        departamento_id: $scope.departamento,
        municipio_id: $scope.municipio,
        direccion_beneficiario: $scope.residencia_beneficiario,
        estrato_beneficiario: $scope.estrato,
        comuna_id: $scope.comuna,
        barrio_id: $scope.barrio,
        corregimiento_beneficiario: $scope.corregimiento,
        vereda_beneficiario: $scope.vereda,
        estado_civil_beneficiario: $scope.est_beneficiario,
        hijos_beneficiario: $scope.hijo,
        cantidad_hijos_beneficiario: $scope.cantidad_hijos,
        tipo_sangre_beneficiario: $scope.tip_sangre,
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
        nombres_acudiente: $scope.nombres_familiar,
        apellidos_acudiente: $scope.apellidos_familiar,
        tipo_doc_acudiente: $scope.tipo_familiar,
        documento_acudiente: $scope.no_documento_pariente,
        sexo_acudiente: $scope.sex_pariente,
        fecha_nac_acudiente: fecha_nacimiento_acudiente,
        edad_acudiente: $scope.edad_pariente,
        telefono_acudiente: $scope.telefono_pariente,
        correo_acudiente: $scope.email_pariente,
        parentesco_acudiente: $scope.parentesco,
        otro_parentesco_acudiente: $scope.otro_parentesco
      };

      $.ajax({
        url: base_api + '/postbeneficiario/create/' + id,
        type: 'POST',
        dataType: 'JSON',
        data: {
          datos: datos,
          SelectPoblacional: SelectPoblacional
        }

      }).success(function () {

        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location = "/admin/postgrupos#/admin/postgrupos";
      }).error(function () {
        console.log("success");
      });
    }
  };
});

/***/ }),

/***/ 28:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/gruposprogramas/GruposProgramasCrtl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/CreateGrupoProgramaCtrl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/EditarGrupoProgramaCtrl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/BeneficiarioProgramaGrupoCtrl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/BeneficiarioViactivaGrupoCtrl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/AsistenciaGrupoProgramaCtrl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/MisBeneficiariosGrupoProgramaCtrl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/InfoAsistenciaGrupoProgramaCtrl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/EditarMiBeneficiarioProgramaCtrl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/EditarViactivaProgramaCtrl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/GruposConsultaProgramaCrtl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/MisBeneficiariosGrupoConsultaProgramaCtrl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/GruposConsultaProgramaAsistenciaCrtl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/GruposReasignacionProgramaCrtl.js");
__webpack_require__("./resources/assets/controllers/gruposprogramas/AdicionalMiBeneficiarioProgramaCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/gruposprogramas/AdicionalEditarBeneficiarioCtrl.js");


/***/ })

/******/ });