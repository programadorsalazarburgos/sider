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
/******/ 	return __webpack_require__(__webpack_require__.s = 14);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/usuarios/CreateUsuarioCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateUsuarioCtrl", function ($scope, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q) {

  $scope.reset = function () {
    $scope.state = undefined;
  };

  $scope.title = "Creacion Personal";
  $scope.series = [];
  $scope.empleado = [];
  $scope.persona = [];
  $scope.selectedPoblacionales = [];
  $scope.selectedDiscapacidades = [];
  $scope.selectedDisciplinas = [];
  $scope.corregimiento = '';
  $scope.vereda = '';
  $scope.barrio = null;
  $scope.persona = {
    'id': 1,
    'residencia_direccion': null
  };

  $scope.empleado.titulo_obtenido = null;
  $scope.persona.nombre_segundo = null;
  $scope.persona.apellido_segundo = null;
  $scope.persona.telefono_fijo = null;
  $scope.empleado.no_libreta = null;
  $scope.empleado.distrito_militar = null;
  $scope.empleado.skype_empleado = null;
  $scope.empleado.proyecto_profesional = null;
  $scope.grupo_save = $routeParams.id;
  $scope.serie = {};
  $scope.disable_submit = false;
  $scope.serie = {};
  $scope.departamentos = 1;

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
    $('[name=documento_personal]').maskNumber({ integer: true });
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

  $("#direccion_residencia_plugin").show();

  //Inicio Carga de datos Documento Crear

  $scope.tipo_doc = {
    'id': 1,
    'unit': null

    //Obtener Titulos
  };$http.get(base_api + "/obtener/titulos").success(function (titulos) {

    $scope.titulos = titulos;
  });

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

  $scope.sexo = [{ id: '1', nombre: 'Mujer' }, { id: '2', nombre: 'Hombre' }];

  //Fin Carga datos sexo crear

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

  $scope.tipo_esc = {
    'id': 1,
    'unit': null
  };

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

  $http.get(base_api + "/obtenerselect/allGrupos_disciplinas").success(function (response) {

    $scope.allGrupos_disciplinas = response;
  });

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
      $scope.comuna = estratobeneficiario.comuna_id;
    });
  };

  $scope.ngShowhideBarrio = true;
  $scope.ngShowhideDireccion = true;
  $scope.ngShowhideComplemento = true;

  $scope.selectedVereda = function (veredaselect) {

    console.log(veredaselect);
    $http.get(base_api + "/obtener/estratoVereda/" + veredaselect).success(function (EstratoVereda) {
      $scope.tipo_estrato = {
        'id': 1,
        'unit': EstratoVereda.estrato
      };
      $scope.comuna = EstratoVereda.nombre_comuna;
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
    $scope.corregimiento = undefined;
    $scope.ngShowhideBarrio = true;
    $scope.ngShowhideDireccion = true;
  };

  $scope.onBlurDocumento = function ($event) {

    var no_documento_beneficiario = $scope.no_documento_persona;

    $http.get(base_api + "/admin/postpersona/cargar/" + no_documento_beneficiario).success(function (response) {
      if (response.persona.length != 0 || response.empleado.length != 0) {

        //DATOS BASICOS PERSONA
        $scope.persona = response.persona[0];
        //Tipo Documento
        $scope.tipo_doc = {
          'id': 1,
          'unit': $scope.persona.id_documento_tipo
          // Genero 
        };$scope.tipo_sex = {
          'id': 1,
          'unit': $scope.persona.sexo

          //Pais
        };$scope.pais = $scope.persona.id_procedencia_pais;
        //Departamento
        $scope.departamento = $scope.persona.id_procedencia_departamento;
        //Municipio
        $scope.municipio = $scope.persona.id_procedencia_municipio;
        //Corregimiento
        $scope.corregimiento = $scope.persona.id_residencia_corregimiento;
        $http.get(base_api + "/obtener/veredas/" + $scope.persona.id_residencia_corregimiento).success(function (response) {
          $scope.veredas = response;
        });
        $scope.vereda = $scope.persona.id_residencia_vereda;

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

        $scope.departamento_residencia = $scope.persona.departamento_residencia_id;
        $scope.municipio_residencia = $scope.persona.municipio_residencia_id;
        $scope.residencia = $scope.persona.direccion_residencia;

        if ($scope.residencia != null || $scope.municipio_residencia != 834) {

          $('#hide-div1').css('display', 'none');
          $('#hide-br1').css('display', 'none');
          $('#hide-div2').css('display', 'none');
          $('#hide-div3').css('display', 'none');
          $('#hide-br2').css('display', 'none');
          $('#hide-div4').css('display', 'none');
          $('#hide-br4').css('display', 'none');
          $('#hide-me').css('display', 'none');
          $('#hide-me2').css('display', 'none');
          $('#hide-me3').css('display', 'none');
          $('#hide-div5').css('display', 'none');
          $('#hide-br5').css('display', 'none');
          $scope.direccionRequired = false;
          $scope.residencia1 = true;
          $scope.residencia2 = true;
          $scope.residencia3 = false;
          $scope.direcc = false;
          $scope.isDisabledDirecionresidencia = false;
          $scope.residenciaRequired = true;
          $scope.estilo = {
            backgroundColor: 'white'
          };
          $scope.personal_residencia = true;
          $scope.residencia_personal = false;
        } else if ($scope.municipio_residencia == 834) {

          $('#hide-div1').css('display', 'block');
          $('#hide-br1').css('display', 'block');
          $('#hide-div2').css('display', 'block');
          $('#hide-div3').css('display', 'block');
          $('#hide-br2').css('display', 'block');
          $('#hide-div4').css('display', 'block');
          $('#hide-br4').css('display', 'block');
          $('#hide-me').css('display', 'block');
          $('#hide-me2').css('display', 'block');
          $('#hide-me3').css('display', 'block');
          $('#hide-div5').css('display', 'block');
          $('#hide-br5').css('display', 'block');
          $scope.municipio_residencia = 834;
          $scope.residencia1 = false;
          $scope.residencia2 = false;
          $scope.residencia3 = true;
          $scope.isDisabledDirecionresidencia = true;
          $scope.residenciaRequired = false;
          $scope.personal_residencia = false;
          $scope.residencia_personal = false;
          $scope.direcc = true;
          $scope.residencia = null;
          $scope.estilo = {
            color: "#FF0000",
            backgroundColor: 'rgb(238, 238, 238)'
          };
        }

        $http.get(base_api + "/obtener/estratoVereda/" + $scope.persona.id_residencia_vereda).success(function (EstratoVereda) {
          console.log(EstratoVereda);

          $scope.tipo_estrato = {
            'id': 1,
            'unit': EstratoVereda.estrato
          };
          $scope.comuna = EstratoVereda.nombre_comuna;
        });

        $scope.barrio = $scope.persona.id_residencia_barrio;

        $http.get(base_api + "/obtener/comuna_barrio/" + $scope.persona.id_residencia_barrio).success(function (responseComuna) {

          $scope.tipo_com = {
            'id': 1,
            'unit': responseComuna[0].id
          };
        });

        $http.get(base_api + "/obtener/estrato/" + $scope.persona.id_residencia_barrio).success(function (estratobeneficiario) {

          $scope.comuna = estratobeneficiario.comuna_id;
          $scope.tipo_estrato = {
            'id': 1,
            'unit': estratobeneficiario.id_estrato
          };
        });

        //FIN DATOS BASICOS PERSONA

        //DATOS EMPLEADO
        $scope.empleado = response.empleado[0];
        //Universidad
        if ($scope.empleado.programaTenanId != '5467829281') {
          swal("Registro Existente!", "Ya estas registrado en otro programa si actualizas tu información aqui automaticamente seras nuevo usuario de mi comunidad!", "success");
        } else if ($scope.empleado.programaTenanId == '5467829281') {
          swal("Registro Existente!", "Ya estas registrado actualiza tu información si lo deseas!", "success");
        }

        $scope.titulo_obtenido = $scope.empleado.titulo_obtenido;

        $scope.otro_poblacional = $scope.empleado.otro_poblacional;

        $scope.tipo_univ = {
          'id': 1,
          'universidad': $scope.empleado.universidad_id
          //Nivel de escolaridad 
        };$scope.tipo_esc = {
          'id': 1,
          'unit': $scope.persona.escolaridad_id
        };
        console.log($scope.persona);
        //Estado Escolaridad
        $scope.estado_esc = {
          'id': 1,
          'unit': $scope.persona.estado_escolaridad

          //Ocupacion Actual
        };$scope.tipo_ocup = {
          'id': 1,
          'unit': $scope.persona.ocupacion_id

          //Estado Civil
        };$scope.tipo_est = {
          'id': 1,
          'unit': $scope.persona.id_estado_civil

          //Tiene Hijos
        };$scope.tipo_hij = {
          'id': 1,
          'unit': $scope.empleado.hijos_beneficiario
        };
        if ($scope.empleado.hijos_beneficiario == 1) {
          $scope.isDisabled = false;
        } else {

          $scope.isDisabled = true;
        }

        //Se reconoce como 
        $scope.tipo_etnias = {
          'id': 1,
          'unit': $scope.empleado.etnia_id

          //Padece de alguna enfermedad que limite actividad fisica

        };$scope.tipo_disc = {
          'id': 1,
          'unit': $scope.empleado.enfermedad_permanente
        };

        if ($scope.empleado.enfermedad_permanente == 1) {

          $scope.isDisabledDiscapacidad = false;
        } else {

          $scope.isDisabledDiscapacidad = true;
        }

        //Toma Medicamentos
        $scope.tipo_medic = {
          'id': 1,
          'unit': $scope.empleado.medicamentos
        };

        if ($scope.empleado.medicamentos == 1) {
          $scope.isDisabledMedicamento = false;
        } else {

          $scope.isDisabledMedicamento = true;
        }

        //Tipo de Sangre
        $scope.tipo_sag = {
          'id': 1,
          'unit': $scope.persona.sangre_tipo

          //Tiene Alguna condicion de discapacidad
        };$scope.tipo_condicion = {
          'id': 1,
          'unit': $scope.empleado.condicion_discapacidad
        };

        if ($scope.empleado.condicion_discapacidad == 1) {
          $scope.ngShowhideDiscapacidad = true;
        } else {
          $scope.ngShowhideDiscapacidad = false;
        }

        //Se encuentra afiliado al sistema general de salud
        $scope.tipo_afiliacion_salud = {
          'id': 1,
          'unit': $scope.empleado.afiliacion_salud

          //Tipo Afiliacion
        };$scope.tipo_afiliacion = {
          'id': 1,
          'unit': $scope.empleado.tipoafiliacion_id

          //Entidad de salud o Eps
        };$scope.tipo_salud_otra = {
          'id': 1,
          'unit': $scope.empleado.eps_id

          //Libreta Militar 
        };$scope.tipo_libreta = {
          'id': 1,
          'unit': $scope.empleado.libreta_militar

          //Estrato
        };$scope.tipo_estrato = {
          'id': 1,
          'unit': parseInt($scope.persona.residencia_estrato)
        };

        $http.get(base_api + "/cargar/poblacionalesDocumento/" + no_documento_beneficiario).success(function (response) {
          $scope.selectedPoblacionales = response;
          $scope.selectedPoblacionales.map(function (poblacional) {

            if (poblacional.id == 10) {
              $scope.ngShowhideOtro = true;
            } else if (poblacional.id != 10) {
              $scope.ngShowhideOtro = false;
            }
          });
        });

        $scope.otro_poblacional = $scope.empleado.otro_poblacional;

        $http.get(base_api + "/cargar/discapacidadesDocumento/" + no_documento_beneficiario).success(function (response) {

          $scope.selectedDiscapacidades = response;
        });

        $http.get(base_api + "/cargar/disciplinasDocumento/" + no_documento_beneficiario).success(function (response) {

          $scope.selectedDisciplinas = response;
        });
      }
    });
  };

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

  $.ajax({
    url: base_api + "/obtener/paises",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.paises = response;
  }).error(function () {});

  $scope.pais = 1;

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
  $scope.departamento_residencia = 76;

  $.ajax({
    url: base_api + "/obtener/departamentos/" + $scope.data_paises.unit,
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.departamentos = response;
    $scope.residencia_departamentos = response;
  }).error(function () {});

  $scope.municipio = 834;
  $scope.municipio_residencia = 834;
  $http.get(base_api + "/obtener/municipios/" + $scope.departamento).success(function (response) {
    $scope.municipios = response;
  });

  $http.get(base_api + "/obtener/municipios/" + $scope.departamento_residencia).success(function (response) {
    $scope.residencia_municipios = response;
  });

  $scope.selectedPais = function (itemPais) {

    if (itemPais == 1) {

      $scope.ngShowhide1 = true;
      $scope.ngShowhide2 = false;
    } else {
      $scope.ngShowhide1 = false;
      $scope.ngShowhide2 = true;
    }

    var promise = $http.get(base_api + "/obtener/departamentos/" + itemPais);
    promise.then(function (responsepaises) {
      $scope.departamentos = responsepaises.data;
    });
  };

  $scope.selectedDepartamento = function (itemDepartamento) {

    var promise = $http.get(base_api + "/obtener/municipios/" + itemDepartamento);
    promise.then(function (responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
    });
  };

  $scope.isDisabledDirecionresidencia = true;
  $scope.residenciaRequired = false;
  $scope.direc1 = false;
  $scope.direc2 = false;
  $scope.estilo = {
    color: "#FF0000",
    backgroundColor: 'rgb(238, 238, 238)'
  };

  $scope.onBlurResidencia = function (direccion_residencia) {

    if (direccion_residencia != null) {
      $scope.residencia_personal = false;
      $scope.direc1 = false;
      $scope.direc2 = false;
    } else {

      $scope.direc1 = true;
      $scope.direc2 = true;
      $scope.residencia_personal = true;
    }
  };

  $scope.residencia1 = false;
  $scope.residencia2 = false;
  $scope.residencia3 = true;
  $scope.direcc = true;
  $scope.direccionRequired = true;

  $scope.selectedMunicipioResidencia = function (ItemMunicipioResidencia) {

    if (ItemMunicipioResidencia != 834) {
      $('#hide-div1').css('display', 'none');
      $('#hide-br1').css('display', 'none');
      $('#hide-div2').css('display', 'none');
      $('#hide-div3').css('display', 'none');
      $('#hide-br2').css('display', 'none');
      $('#hide-div4').css('display', 'none');
      $('#hide-br4').css('display', 'none');
      $('#hide-me').css('display', 'none');
      $('#hide-me2').css('display', 'none');
      $('#hide-me3').css('display', 'none');
      $('#hide-div5').css('display', 'none');
      $('#hide-br5').css('display', 'none');
      $scope.direccionRequired = false;
      $scope.residencia1 = true;
      $scope.residencia2 = true;
      $scope.residencia3 = false;
      $scope.direcc = false;
      $scope.isDisabledDirecionresidencia = false;
      $scope.residenciaRequired = true;
      $scope.estilo = {
        backgroundColor: 'white'
      };
      $scope.personal_residencia = true;
      $scope.residencia_personal = true;
    } else {

      $('#hide-div1').css('display', 'block');
      $('#hide-br1').css('display', 'block');
      $('#hide-div2').css('display', 'block');
      $('#hide-div3').css('display', 'block');
      $('#hide-br2').css('display', 'block');
      $('#hide-div4').css('display', 'block');
      $('#hide-br4').css('display', 'block');
      $('#hide-me').css('display', 'block');
      $('#hide-me2').css('display', 'block');
      $('#hide-me3').css('display', 'block');
      $('#hide-div5').css('display', 'block');
      $('#hide-br5').css('display', 'block');
      $scope.municipio_residencia = 834;
      $scope.residencia1 = false;
      $scope.residencia2 = false;
      $scope.residencia3 = true;
      $scope.isDisabledDirecionresidencia = true;
      $scope.residenciaRequired = false;
      $scope.personal_residencia = false;
      $scope.residencia_personal = false;
      $scope.direcc = true;
      $scope.residencia = null;
      $scope.estilo = {
        color: "#FF0000",
        backgroundColor: 'rgb(238, 238, 238)'
      };
    }
  };

  $scope.selectedDepartamentoResidencia = function (departamento_residencia) {

    var promise = $http.get(base_api + "/obtener/municipios/" + departamento_residencia);
    promise.then(function (responsemunicipiosresidencia) {
      $scope.residencia_municipios = responsemunicipiosresidencia.data;
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
      // $scope.empleado.otra_enfermedad = null;
      $scope.empleado = {
        'id': 1,
        'otra_enfermedad': null
      };
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
      $scope.empleado.otros_medicamentos = null;
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
        url: base_api + "/eliminar/poblacionalpersonal/" + $scope.empleado.ficha_save,
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
  $scope.toggleSelectionDisciplina = function toggleSelectionDisciplina(seleccion) {

    var index = $scope.selectedDisciplinas.indexOfObjectWithProperty('id', seleccion.id);

    if (index > -1) {
      $scope.selectedDisciplinas.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/disciplina/" + $scope.empleado.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedDisciplinas.push(seleccion);
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
        url: base_api + "/eliminar/discapacidad/" + $scope.empleado.ficha_save,
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

  $scope.tipo_univ = {
    'universidad': null
  };

  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;

  $scope.formsubmit = function (isValid) {

    if (isValid) {

      var direccion_sider = $("#id_persona_beneficiario_residencia_direccion").val();

      if ($scope.residencia == undefined) {
        $scope.residencia = null;
      } else {
        $scope.residencia = $scope.residencia;
      }

      if ($scope.tipo_salud_otra.unit == undefined) {
        $scope.tipo_salud_otra.unit = null;
      } else {
        $scope.tipo_salud_otra.unit = $scope.tipo_salud_otra.unit;
      }

      if ($scope.empleado.titulo_obtenido == undefined) {
        $scope.empleado.titulo_obtenido = null;
      } else {
        $scope.empleado.titulo_obtenido = $scope.empleado.titulo_obtenido;
      }

      if ($scope.persona.nombre_segundo == undefined) {
        $scope.persona.nombre_segundo = null;
      } else {
        $scope.persona.nombre_segundo = $scope.persona.nombre_segundo;
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

      if ($scope.empleado.no_libreta == undefined) {
        $scope.empleado.no_libreta = null;
      } else {
        $scope.empleado.no_libreta = $scope.empleado.no_libreta;
      }

      if ($scope.empleado.distrito_militar == undefined) {
        $scope.empleado.distrito_militar = null;
      } else {
        $scope.empleado.distrito_militar = $scope.empleado.distrito_militar;
      }

      if ($scope.empleado.skype_empleado == undefined) {
        $scope.empleado.skype_empleado = null;
      } else {
        $scope.empleado.skype_empleado = $scope.empleado.skype_empleado;
      }

      if ($scope.empleado.proyecto_profesional == undefined) {
        $scope.empleado.proyecto_profesional = null;
      } else {
        $scope.empleado.proyecto_profesional = $scope.empleado.proyecto_profesional;
      }

      if ($scope.corregimiento == undefined) {
        $scope.corregimiento = null;
      } else {
        $scope.corregimiento = $scope.corregimiento;
      }

      if ($scope.vereda == undefined) {
        $scope.vereda = null;
      } else {
        $scope.vereda = $scope.vereda;
      }

      if ($scope.barrio == undefined) {
        $scope.barrio = null;
      } else {
        $scope.barrio = $scope.barrio;
      }

      //Nuevos campos
      if ($scope.empleado.cantidad_hijos == undefined) {
        $scope.empleado.cantidad_hijos = null;
      } else {
        $scope.empleado.cantidad_hijos = $scope.empleado.cantidad_hijos;
      }

      if ($scope.titulo_obtenido == undefined) {
        $scope.titulo_obtenido = null;
      } else {
        $scope.titulo_obtenido = $scope.titulo_obtenido;
      }

      var otra_ocupacion = '';
      var otra_cultura = '';
      var cual_discapacidad = '';
      var otra_discapacidad = '';
      var enfermedad_benec = '';
      var medicamento_benec = '';
      var otra_salud = '';
      var seguridad_benec = '';
      var parentesco_benec = '';

      if ($scope.otro_poblacional == undefined) {
        otro_poblacional = null;
      } else if ($scope.otro_poblacional != null) {
        otro_poblacional = $scope.otro_poblacional;
      }

      var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val();
      var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
      var fecha_inscripcion = $("#fecha_inscripcion").val();
      var SelectPoblacional = $scope.selectedPoblacionales;
      var SelectDiscapacidad = $scope.selectedDiscapacidades;
      var SelectDisciplina = $scope.selectedDisciplinas;

      var datos = {

        //Datos Persona
        tipo_doc_persona: $scope.tipo_doc.unit,
        no_documento_persona: $scope.no_documento_persona,
        primer_nombre_persona: $scope.persona.nombre_primero,
        segundo_nombre_persona: $scope.persona.nombre_segundo,
        primer_apellido_persona: $scope.persona.apellido_primero,
        segundo_apellido_persona: $scope.persona.apellido_segundo,
        correo_persona: $scope.persona.correo_electronico,
        sexo_persona: $scope.tipo_sex.unit,
        fecha_nac_persona: fecha_nacimiento_beneficiario,
        pais_id: $scope.data_paises.unit,
        departamento_id: $scope.departamento,
        municipio_id: $scope.municipio,
        corregimiento: $scope.corregimiento,
        vereda: $scope.vereda,
        barrio_id: $scope.barrio,
        estrato: $scope.tipo_estrato.unit,
        residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
        complemento: $("#id_persona_beneficiario_residencia_direccion_complemento").val(),
        telefono_fijo_persona: $scope.persona.telefono_fijo,
        telefono_movil_persona: $scope.persona.telefono_movil,
        tip_sangre_persona: $scope.tipo_sag.unit,
        estado_civil_persona: $scope.tipo_est.unit,
        departamento_residencia: $scope.departamento_residencia,
        municipio_residencia: $scope.municipio_residencia,
        direc_residencia: $scope.residencia,

        //Datos Empleado     
        escolaridad_beneficiario: $scope.tipo_esc.unit,
        estado_escolaridad: $scope.estado_esc.unit,
        titulo_obtenido: $scope.titulo_obtenido,
        universidad: $scope.tipo_univ.universidad,
        ocupacion_beneficiario: $scope.tipo_ocup.unit,
        hijos_beneficiario: $scope.tipo_hij.unit,
        cantidad_hijos: $scope.empleado.cantidad_hijos,
        cultura_beneficiario: $scope.tipo_etnias.unit,
        discapacidad_beneficiario: $scope.tipo_disc.unit,
        otra_discapacidad_beneficiario: otra_discapacidad,
        medicamentos_permanente_beneficiario: $scope.tipo_medic.unit,
        medicamentos_beneficiario: medicamento_benec,
        condicion_discapacidad: $scope.tipo_condicion.unit,
        afiliacion_salud: $scope.tipo_afiliacion_salud.unit,
        tipo_afiliacion: $scope.tipo_afiliacion.unit,
        salud_sgsss_beneficiario: $scope.tipo_salud_otra.unit,
        parentesco_acudiente: $scope.tipo_parent.unit,
        otro_parentesco_acudiente: parentesco_benec,
        otro_poblacional: otro_poblacional,
        tipo_libreta: $scope.tipo_libreta.unit,
        no_libreta: $scope.empleado.no_libreta,
        distrito_militar: $scope.empleado.distrito_militar,
        skype_empleado: $scope.empleado.skype_empleado,
        proyecto_profesional: $scope.empleado.proyecto_profesional

      };

      if ($scope.municipio_residencia == 834 && $scope.corregimiento == '' && direccion_sider == '') {

        swal("Algo te hace falta!", "Verifique que su campo Dirección no este vacio!", "error");
        toastr.error("Verifique que su campo Dirección no este vacio", "Campo Dirección");
      } else {

        $.ajax({
          url: base_api + '/postbeneficiario/createpersonal',
          type: 'POST',
          dataType: 'JSON',
          data: {
            datos: datos,
            SelectPoblacional: SelectPoblacional,
            SelectDiscapacidad: SelectDiscapacidad,
            SelectDisciplina: SelectDisciplina
          }

        }).success(function () {
          swal("Muy bien!", "Su registro ha sido exitoso", "success");
          toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
          window.location = "/";
        }).error(function () {});
      }
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/usuarios/CreateUsuarioDeporteCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("CreateUsuarioDeporteCtrl", function ($scope, $routeParams, fileUpload, $http, $location, $timeout, base_api, $q) {

  $scope.reset = function () {
    $scope.state = undefined;
  };

  $scope.title = "Creacion Personal";
  $scope.series = [];
  $scope.empleado = [];
  $scope.persona = [];
  $scope.selectedPoblacionales = [];
  $scope.selectedDiscapacidades = [];
  $scope.selectedDisciplinas = [];
  $scope.corregimiento = '';
  $scope.vereda = '';
  $scope.barrio = null;
  $scope.persona = {
    'id': 1,
    'residencia_direccion': null
  };

  $scope.empleado.titulo_obtenido = null;
  $scope.persona.nombre_segundo = null;
  $scope.persona.apellido_segundo = null;
  $scope.persona.telefono_fijo = null;
  $scope.empleado.no_libreta = null;
  $scope.empleado.distrito_militar = null;
  $scope.empleado.skype_empleado = null;
  $scope.empleado.proyecto_profesional = null;
  $scope.grupo_save = $routeParams.id;
  $scope.serie = {};
  $scope.disable_submit = false;
  $scope.serie = {};
  $scope.departamentos = 1;

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
    $('[name=documento_personal]').maskNumber({ integer: true });
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

  $("#direccion_residencia_plugin").show();

  //Inicio Carga de datos Documento Crear

  $scope.tipo_doc = {
    'id': 1,
    'unit': null

    //Obtener Titulos
  };$http.get(base_api + "/obtener/titulos").success(function (titulos) {

    $scope.titulos = titulos;
  });

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

  $scope.sexo = [{ id: '1', nombre: 'Mujer' }, { id: '2', nombre: 'Hombre' }];

  //Fin Carga datos sexo crear

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

  $scope.tipo_esc = {
    'id': 1,
    'unit': null
  };

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

  $http.get(base_api + "/obtenerselect/allGrupos_disciplinas").success(function (response) {

    $scope.allGrupos_disciplinas = response;
  });

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
      $scope.comuna = estratobeneficiario.comuna_id;
    });
  };

  $scope.ngShowhideBarrio = true;
  $scope.ngShowhideDireccion = true;
  $scope.ngShowhideComplemento = true;

  $scope.selectedVereda = function (veredaselect) {

    console.log(veredaselect);
    $http.get(base_api + "/obtener/estratoVereda/" + veredaselect).success(function (EstratoVereda) {
      $scope.tipo_estrato = {
        'id': 1,
        'unit': EstratoVereda.estrato
      };
      $scope.comuna = EstratoVereda.nombre_comuna;
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
    $scope.corregimiento = undefined;
    $scope.ngShowhideBarrio = true;
    $scope.ngShowhideDireccion = true;
  };

  $scope.onBlurDocumento = function ($event) {

    var no_documento_beneficiario = $scope.no_documento_persona;

    $http.get(base_api + "/admin/postpersona/cargar/" + no_documento_beneficiario).success(function (response) {
      if (response.persona.length != 0 || response.empleado.length != 0) {

        //DATOS BASICOS PERSONA
        $scope.persona = response.persona[0];
        //Tipo Documento
        $scope.tipo_doc = {
          'id': 1,
          'unit': $scope.persona.id_documento_tipo
          // Genero 
        };$scope.tipo_sex = {
          'id': 1,
          'unit': $scope.persona.sexo

          //Pais
        };$scope.pais = $scope.persona.id_procedencia_pais;
        //Departamento
        $scope.departamento = $scope.persona.id_procedencia_departamento;
        //Municipio
        $scope.municipio = $scope.persona.id_procedencia_municipio;
        //Corregimiento
        $scope.corregimiento = $scope.persona.id_residencia_corregimiento;
        $http.get(base_api + "/obtener/veredas/" + $scope.persona.id_residencia_corregimiento).success(function (response) {
          $scope.veredas = response;
        });
        $scope.vereda = $scope.persona.id_residencia_vereda;

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

        $scope.departamento_residencia = $scope.persona.departamento_residencia_id;
        $scope.municipio_residencia = $scope.persona.municipio_residencia_id;
        $scope.residencia = $scope.persona.direccion_residencia;

        if ($scope.residencia != null || $scope.municipio_residencia != 834) {

          $('#hide-div1').css('display', 'none');
          $('#hide-br1').css('display', 'none');
          $('#hide-div2').css('display', 'none');
          $('#hide-div3').css('display', 'none');
          $('#hide-br2').css('display', 'none');
          $('#hide-div4').css('display', 'none');
          $('#hide-br4').css('display', 'none');
          $('#hide-me').css('display', 'none');
          $('#hide-me2').css('display', 'none');
          $('#hide-me3').css('display', 'none');
          $('#hide-div5').css('display', 'none');
          $('#hide-br5').css('display', 'none');
          $scope.direccionRequired = false;
          $scope.residencia1 = true;
          $scope.residencia2 = true;
          $scope.residencia3 = false;
          $scope.direcc = false;
          $scope.isDisabledDirecionresidencia = false;
          $scope.residenciaRequired = true;
          $scope.estilo = {
            backgroundColor: 'white'
          };
          $scope.personal_residencia = true;
          $scope.residencia_personal = false;
        } else if ($scope.municipio_residencia == 834) {

          $('#hide-div1').css('display', 'block');
          $('#hide-br1').css('display', 'block');
          $('#hide-div2').css('display', 'block');
          $('#hide-div3').css('display', 'block');
          $('#hide-br2').css('display', 'block');
          $('#hide-div4').css('display', 'block');
          $('#hide-br4').css('display', 'block');
          $('#hide-me').css('display', 'block');
          $('#hide-me2').css('display', 'block');
          $('#hide-me3').css('display', 'block');
          $('#hide-div5').css('display', 'block');
          $('#hide-br5').css('display', 'block');
          $scope.municipio_residencia = 834;
          $scope.residencia1 = false;
          $scope.residencia2 = false;
          $scope.residencia3 = true;
          $scope.isDisabledDirecionresidencia = true;
          $scope.residenciaRequired = false;
          $scope.personal_residencia = false;
          $scope.residencia_personal = false;
          $scope.direcc = true;
          $scope.residencia = null;
          $scope.estilo = {
            color: "#FF0000",
            backgroundColor: 'rgb(238, 238, 238)'
          };
        }

        $http.get(base_api + "/obtener/estratoVereda/" + $scope.persona.id_residencia_vereda).success(function (EstratoVereda) {
          console.log(EstratoVereda);

          $scope.tipo_estrato = {
            'id': 1,
            'unit': EstratoVereda.estrato
          };
          $scope.comuna = EstratoVereda.nombre_comuna;
        });

        $scope.barrio = $scope.persona.id_residencia_barrio;

        $http.get(base_api + "/obtener/comuna_barrio/" + $scope.persona.id_residencia_barrio).success(function (responseComuna) {

          $scope.tipo_com = {
            'id': 1,
            'unit': responseComuna[0].id
          };
        });

        $http.get(base_api + "/obtener/estrato/" + $scope.persona.id_residencia_barrio).success(function (estratobeneficiario) {

          $scope.comuna = estratobeneficiario.comuna_id;
          $scope.tipo_estrato = {
            'id': 1,
            'unit': estratobeneficiario.id_estrato
          };
        });

        //FIN DATOS BASICOS PERSONA

        //DATOS EMPLEADO
        $scope.empleado = response.empleado[0];
        //Universidad
        if ($scope.empleado.programaTenanId != '2767829213') {
          swal("Registro Existente!", "Ya estas registrado en otro programa si actualizas tu información aqui automaticamente seras nuevo usuario de deporte escolar!", "success");
        } else if ($scope.empleado.programaTenanId == '2767829213') {
          swal("Registro Existente!", "Ya estas registrado actualiza tu información si lo deseas!", "success");
        }

        $scope.titulo_obtenido = $scope.empleado.titulo_obtenido;

        $scope.otro_poblacional = $scope.empleado.otro_poblacional;

        $scope.tipo_univ = {
          'id': 1,
          'universidad': $scope.empleado.universidad_id
          //Nivel de escolaridad 
        };$scope.tipo_esc = {
          'id': 1,
          'unit': $scope.persona.escolaridad_id
        };
        console.log($scope.persona);
        //Estado Escolaridad
        $scope.estado_esc = {
          'id': 1,
          'unit': $scope.persona.estado_escolaridad

          //Ocupacion Actual
        };$scope.tipo_ocup = {
          'id': 1,
          'unit': $scope.persona.ocupacion_id

          //Estado Civil
        };$scope.tipo_est = {
          'id': 1,
          'unit': $scope.persona.id_estado_civil

          //Tiene Hijos
        };$scope.tipo_hij = {
          'id': 1,
          'unit': $scope.empleado.hijos_beneficiario
        };
        if ($scope.empleado.hijos_beneficiario == 1) {
          $scope.isDisabled = false;
        } else {

          $scope.isDisabled = true;
        }

        //Se reconoce como 
        $scope.tipo_etnias = {
          'id': 1,
          'unit': $scope.empleado.etnia_id

          //Padece de alguna enfermedad que limite actividad fisica

        };$scope.tipo_disc = {
          'id': 1,
          'unit': $scope.empleado.enfermedad_permanente
        };

        if ($scope.empleado.enfermedad_permanente == 1) {

          $scope.isDisabledDiscapacidad = false;
        } else {

          $scope.isDisabledDiscapacidad = true;
        }

        //Toma Medicamentos
        $scope.tipo_medic = {
          'id': 1,
          'unit': $scope.empleado.medicamentos
        };

        if ($scope.empleado.medicamentos == 1) {
          $scope.isDisabledMedicamento = false;
        } else {

          $scope.isDisabledMedicamento = true;
        }

        //Tipo de Sangre
        $scope.tipo_sag = {
          'id': 1,
          'unit': $scope.persona.sangre_tipo

          //Tiene Alguna condicion de discapacidad
        };$scope.tipo_condicion = {
          'id': 1,
          'unit': $scope.empleado.condicion_discapacidad
        };

        if ($scope.empleado.condicion_discapacidad == 1) {
          $scope.ngShowhideDiscapacidad = true;
        } else {
          $scope.ngShowhideDiscapacidad = false;
        }

        //Se encuentra afiliado al sistema general de salud
        $scope.tipo_afiliacion_salud = {
          'id': 1,
          'unit': $scope.empleado.afiliacion_salud

          //Tipo Afiliacion
        };$scope.tipo_afiliacion = {
          'id': 1,
          'unit': $scope.empleado.tipoafiliacion_id

          //Entidad de salud o Eps
        };$scope.tipo_salud_otra = {
          'id': 1,
          'unit': $scope.empleado.eps_id

          //Libreta Militar 
        };$scope.tipo_libreta = {
          'id': 1,
          'unit': $scope.empleado.libreta_militar

          //Estrato
        };$scope.tipo_estrato = {
          'id': 1,
          'unit': parseInt($scope.persona.residencia_estrato)
        };

        $http.get(base_api + "/cargar/poblacionalesDocumento/" + no_documento_beneficiario).success(function (response) {
          $scope.selectedPoblacionales = response;
          $scope.selectedPoblacionales.map(function (poblacional) {

            if (poblacional.id == 10) {
              $scope.ngShowhideOtro = true;
            } else if (poblacional.id != 10) {
              $scope.ngShowhideOtro = false;
            }
          });
        });

        $scope.otro_poblacional = $scope.empleado.otro_poblacional;

        $http.get(base_api + "/cargar/discapacidadesDocumento/" + no_documento_beneficiario).success(function (response) {

          $scope.selectedDiscapacidades = response;
        });

        $http.get(base_api + "/cargar/disciplinasDocumento/" + no_documento_beneficiario).success(function (response) {

          $scope.selectedDisciplinas = response;
        });
      }
    });
  };

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

  $.ajax({
    url: base_api + "/obtener/paises",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.paises = response;
  }).error(function () {});

  $scope.pais = 1;

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
  $scope.departamento_residencia = 76;

  $.ajax({
    url: base_api + "/obtener/departamentos/" + $scope.data_paises.unit,
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.departamentos = response;
    $scope.residencia_departamentos = response;
  }).error(function () {});

  $scope.municipio = 834;
  $scope.municipio_residencia = 834;
  $http.get(base_api + "/obtener/municipios/" + $scope.departamento).success(function (response) {
    $scope.municipios = response;
  });

  $http.get(base_api + "/obtener/municipios/" + $scope.departamento_residencia).success(function (response) {
    $scope.residencia_municipios = response;
  });

  $scope.selectedPais = function (itemPais) {

    if (itemPais == 1) {

      $scope.ngShowhide1 = true;
      $scope.ngShowhide2 = false;
    } else {
      $scope.ngShowhide1 = false;
      $scope.ngShowhide2 = true;
    }

    var promise = $http.get(base_api + "/obtener/departamentos/" + itemPais);
    promise.then(function (responsepaises) {
      $scope.departamentos = responsepaises.data;
    });
  };

  $scope.selectedDepartamento = function (itemDepartamento) {

    var promise = $http.get(base_api + "/obtener/municipios/" + itemDepartamento);
    promise.then(function (responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
    });
  };

  $scope.isDisabledDirecionresidencia = true;
  $scope.residenciaRequired = false;
  $scope.direc1 = false;
  $scope.direc2 = false;
  $scope.estilo = {
    color: "#FF0000",
    backgroundColor: 'rgb(238, 238, 238)'
  };

  $scope.onBlurResidencia = function (direccion_residencia) {

    if (direccion_residencia != null) {
      $scope.residencia_personal = false;
      $scope.direc1 = false;
      $scope.direc2 = false;
    } else {

      $scope.direc1 = true;
      $scope.direc2 = true;
      $scope.residencia_personal = true;
    }
  };

  $scope.residencia1 = false;
  $scope.residencia2 = false;
  $scope.residencia3 = true;
  $scope.direcc = true;
  $scope.direccionRequired = true;

  $scope.selectedMunicipioResidencia = function (ItemMunicipioResidencia) {

    if (ItemMunicipioResidencia != 834) {
      $('#hide-div1').css('display', 'none');
      $('#hide-br1').css('display', 'none');
      $('#hide-div2').css('display', 'none');
      $('#hide-div3').css('display', 'none');
      $('#hide-br2').css('display', 'none');
      $('#hide-div4').css('display', 'none');
      $('#hide-br4').css('display', 'none');
      $('#hide-me').css('display', 'none');
      $('#hide-me2').css('display', 'none');
      $('#hide-me3').css('display', 'none');
      $('#hide-div5').css('display', 'none');
      $('#hide-br5').css('display', 'none');
      $scope.direccionRequired = false;
      $scope.residencia1 = true;
      $scope.residencia2 = true;
      $scope.residencia3 = false;
      $scope.direcc = false;
      $scope.isDisabledDirecionresidencia = false;
      $scope.residenciaRequired = true;
      $scope.estilo = {
        backgroundColor: 'white'
      };
      $scope.personal_residencia = true;
      $scope.residencia_personal = true;
    } else {

      $('#hide-div1').css('display', 'block');
      $('#hide-br1').css('display', 'block');
      $('#hide-div2').css('display', 'block');
      $('#hide-div3').css('display', 'block');
      $('#hide-br2').css('display', 'block');
      $('#hide-div4').css('display', 'block');
      $('#hide-br4').css('display', 'block');
      $('#hide-me').css('display', 'block');
      $('#hide-me2').css('display', 'block');
      $('#hide-me3').css('display', 'block');
      $('#hide-div5').css('display', 'block');
      $('#hide-br5').css('display', 'block');
      $scope.municipio_residencia = 834;
      $scope.residencia1 = false;
      $scope.residencia2 = false;
      $scope.residencia3 = true;
      $scope.isDisabledDirecionresidencia = true;
      $scope.residenciaRequired = false;
      $scope.personal_residencia = false;
      $scope.residencia_personal = false;
      $scope.direcc = true;
      $scope.residencia = null;
      $scope.estilo = {
        color: "#FF0000",
        backgroundColor: 'rgb(238, 238, 238)'
      };
    }
  };

  $scope.selectedDepartamentoResidencia = function (departamento_residencia) {

    var promise = $http.get(base_api + "/obtener/municipios/" + departamento_residencia);
    promise.then(function (responsemunicipiosresidencia) {
      $scope.residencia_municipios = responsemunicipiosresidencia.data;
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
      // $scope.empleado.otra_enfermedad = null;
      $scope.empleado = {
        'id': 1,
        'otra_enfermedad': null
      };
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
      $scope.empleado.otros_medicamentos = null;
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
        url: base_api + "/eliminar/poblacionalpersonal/" + $scope.empleado.ficha_save,
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
  $scope.toggleSelectionDisciplina = function toggleSelectionDisciplina(seleccion) {

    var index = $scope.selectedDisciplinas.indexOfObjectWithProperty('id', seleccion.id);

    if (index > -1) {
      $scope.selectedDisciplinas.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/disciplina/" + $scope.empleado.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedDisciplinas.push(seleccion);
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
        url: base_api + "/eliminar/discapacidad/" + $scope.empleado.ficha_save,
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

  $scope.tipo_univ = {
    'universidad': null
  };

  $scope.time1 = new Date();
  $scope.time2 = new Date();
  $scope.time2.setHours(7, 30);
  $scope.showMeridian = true;
  $scope.disabled = false;

  $scope.formsubmit = function (isValid) {

    if (isValid) {

      var direccion_sider = $("#id_persona_beneficiario_residencia_direccion").val();

      if ($scope.residencia == undefined) {
        $scope.residencia = null;
      } else {
        $scope.residencia = $scope.residencia;
      }

      if ($scope.tipo_salud_otra.unit == undefined) {
        $scope.tipo_salud_otra.unit = null;
      } else {
        $scope.tipo_salud_otra.unit = $scope.tipo_salud_otra.unit;
      }

      if ($scope.empleado.titulo_obtenido == undefined) {
        $scope.empleado.titulo_obtenido = null;
      } else {
        $scope.empleado.titulo_obtenido = $scope.empleado.titulo_obtenido;
      }

      if ($scope.persona.nombre_segundo == undefined) {
        $scope.persona.nombre_segundo = null;
      } else {
        $scope.persona.nombre_segundo = $scope.persona.nombre_segundo;
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

      if ($scope.empleado.no_libreta == undefined) {
        $scope.empleado.no_libreta = null;
      } else {
        $scope.empleado.no_libreta = $scope.empleado.no_libreta;
      }

      if ($scope.empleado.distrito_militar == undefined) {
        $scope.empleado.distrito_militar = null;
      } else {
        $scope.empleado.distrito_militar = $scope.empleado.distrito_militar;
      }

      if ($scope.empleado.skype_empleado == undefined) {
        $scope.empleado.skype_empleado = null;
      } else {
        $scope.empleado.skype_empleado = $scope.empleado.skype_empleado;
      }

      if ($scope.empleado.proyecto_profesional == undefined) {
        $scope.empleado.proyecto_profesional = null;
      } else {
        $scope.empleado.proyecto_profesional = $scope.empleado.proyecto_profesional;
      }

      if ($scope.corregimiento == undefined) {
        $scope.corregimiento = null;
      } else {
        $scope.corregimiento = $scope.corregimiento;
      }

      if ($scope.vereda == undefined) {
        $scope.vereda = null;
      } else {
        $scope.vereda = $scope.vereda;
      }

      if ($scope.barrio == undefined) {
        $scope.barrio = null;
      } else {
        $scope.barrio = $scope.barrio;
      }

      //Nuevos campos
      if ($scope.empleado.cantidad_hijos == undefined) {
        $scope.empleado.cantidad_hijos = null;
      } else {
        $scope.empleado.cantidad_hijos = $scope.empleado.cantidad_hijos;
      }

      if ($scope.titulo_obtenido == undefined) {
        $scope.titulo_obtenido = null;
      } else {
        $scope.titulo_obtenido = $scope.titulo_obtenido;
      }

      var otra_ocupacion = '';
      var otra_cultura = '';
      var cual_discapacidad = '';
      var otra_discapacidad = '';
      var enfermedad_benec = '';
      var medicamento_benec = '';
      var otra_salud = '';
      var seguridad_benec = '';
      var parentesco_benec = '';

      if ($scope.otro_poblacional == undefined) {
        otro_poblacional = null;
      } else if ($scope.otro_poblacional != null) {
        otro_poblacional = $scope.otro_poblacional;
      }

      var fecha_nacimiento_beneficiario = $("#fecha_nacimiento").val();
      var fecha_nacimiento_acudiente = $("#fecha_nacimiento_acudiente").val();
      var fecha_inscripcion = $("#fecha_inscripcion").val();
      var SelectPoblacional = $scope.selectedPoblacionales;
      var SelectDiscapacidad = $scope.selectedDiscapacidades;
      var SelectDisciplina = $scope.selectedDisciplinas;

      var datos = {

        //Datos Persona
        tipo_doc_persona: $scope.tipo_doc.unit,
        no_documento_persona: $scope.no_documento_persona,
        primer_nombre_persona: $scope.persona.nombre_primero,
        segundo_nombre_persona: $scope.persona.nombre_segundo,
        primer_apellido_persona: $scope.persona.apellido_primero,
        segundo_apellido_persona: $scope.persona.apellido_segundo,
        correo_persona: $scope.persona.correo_electronico,
        sexo_persona: $scope.tipo_sex.unit,
        fecha_nac_persona: fecha_nacimiento_beneficiario,
        pais_id: $scope.data_paises.unit,
        departamento_id: $scope.departamento,
        municipio_id: $scope.municipio,
        corregimiento: $scope.corregimiento,
        vereda: $scope.vereda,
        barrio_id: $scope.barrio,
        estrato: $scope.tipo_estrato.unit,
        residencia_persona: $("#id_persona_beneficiario_residencia_direccion").val(),
        complemento: $("#id_persona_beneficiario_residencia_direccion_complemento").val(),
        telefono_fijo_persona: $scope.persona.telefono_fijo,
        telefono_movil_persona: $scope.persona.telefono_movil,
        tip_sangre_persona: $scope.tipo_sag.unit,
        estado_civil_persona: $scope.tipo_est.unit,
        departamento_residencia: $scope.departamento_residencia,
        municipio_residencia: $scope.municipio_residencia,
        direc_residencia: $scope.residencia,

        //Datos Empleado     
        escolaridad_beneficiario: $scope.tipo_esc.unit,
        estado_escolaridad: $scope.estado_esc.unit,
        titulo_obtenido: $scope.titulo_obtenido,
        universidad: $scope.tipo_univ.universidad,
        ocupacion_beneficiario: $scope.tipo_ocup.unit,
        hijos_beneficiario: $scope.tipo_hij.unit,
        cantidad_hijos: $scope.empleado.cantidad_hijos,
        cultura_beneficiario: $scope.tipo_etnias.unit,
        discapacidad_beneficiario: $scope.tipo_disc.unit,
        otra_discapacidad_beneficiario: otra_discapacidad,
        medicamentos_permanente_beneficiario: $scope.tipo_medic.unit,
        medicamentos_beneficiario: medicamento_benec,
        condicion_discapacidad: $scope.tipo_condicion.unit,
        afiliacion_salud: $scope.tipo_afiliacion_salud.unit,
        tipo_afiliacion: $scope.tipo_afiliacion.unit,
        salud_sgsss_beneficiario: $scope.tipo_salud_otra.unit,
        parentesco_acudiente: $scope.tipo_parent.unit,
        otro_parentesco_acudiente: parentesco_benec,
        otro_poblacional: otro_poblacional,
        tipo_libreta: $scope.tipo_libreta.unit,
        no_libreta: $scope.empleado.no_libreta,
        distrito_militar: $scope.empleado.distrito_militar,
        skype_empleado: $scope.empleado.skype_empleado,
        proyecto_profesional: $scope.empleado.proyecto_profesional

      };

      if ($scope.municipio_residencia == 834 && $scope.corregimiento == '' && direccion_sider == '') {

        swal("Algo te hace falta!", "Verifique que su campo Dirección no este vacio!", "error");
        toastr.error("Verifique que su campo Dirección no este vacio", "Campo Dirección");
      } else {

        $.ajax({
          url: base_api + '/postbeneficiario/createpersonaldeporte',
          type: 'POST',
          dataType: 'JSON',
          data: {
            datos: datos,
            SelectPoblacional: SelectPoblacional,
            SelectDiscapacidad: SelectDiscapacidad,
            SelectDisciplina: SelectDisciplina
          }

        }).success(function () {
          swal("Muy bien!", "Su registro ha sido exitoso", "success");
          toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
          window.location = "/admin/postusuarios";
        }).error(function () {
          console.log("success");
        });
      }
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/usuarios/EditarUsuarioCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarUsuarioCtrl", function ($scope, UsuarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Editar Usuario";
  $scope.series = [];
  $scope.getData = function () {
    // $scope.serie = UsuarioService.get({id:$routeParams.id});
    // console.log($scope.serie);

  };
  $("#direccion_residencia_plugin").show();

  $scope.departamento_residencia = 76;

  $http.get(base_api + "/obtener/municipios/" + $scope.departamento_residencia).success(function (response) {
    $scope.residencia_municipios = response;
  });

  $(document).ready(function () {

    $('[name=integer-data-attribute]').maskNumber({ integer: true });
  });

  $scope.reset = function () {
    $scope.state = undefined;
  };

  $scope.title = "Creacion Personal";
  $scope.series = [];
  $scope.selectedPoblacionales = [];
  $scope.selectedDiscapacidades = [];
  $scope.selectedDisciplinas = [];

  $scope.getData = function () {
    $scope.serie = GrupoService.get({ id: $routeParams.id });
  };

  $scope.grupo_save = $routeParams.id;

  $scope.serie = {};

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

  //Obtener Titulos
  $http.get(base_api + "/obtener/titulos").success(function (titulos) {

    $scope.titulos = titulos;
  });

  //Inicio Carga de datos Documento Crear
  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {
    $scope.tipodocumento = response;
  });

  //Fin Carga de datos Documento Crear

  //inicio tipo documento acudients


  //fin


  //Inicio Carga datos sexo crear


  $scope.estrato = [{ id: 1, nombre: '1' }, { id: 2, nombre: '2' }, { id: 3, nombre: '3' }, { id: 4, nombre: '4' }, { id: 5, nombre: '5' }, { id: 6, nombre: '6' }, { id: 7, nombre: '7' }];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo crear


  $scope.sexo = [{ id: 1, nombre: 'Mujer' }, { id: 2, nombre: 'Hombre' }];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo crear


  //Fin Carga datos sexo crear

  //Inicio Carga datos tipo de sangre


  $scope.sangre = [{ id: '1', nombre: 'O+' }, { id: '2', nombre: 'O-' }, { id: '3', nombre: 'A+' }, { id: '4', nombre: 'A-' }, { id: '5', nombre: 'B+' }, { id: '6', nombre: 'B-' }, { id: '7', nombre: 'AB+' }, { id: '8', nombre: 'AB-' }];

  //Fin Carga datos tipo de sangre


  //inicio cargar datos corregimientos


  $.ajax({
    url: base_api + "/obtener/corregimientos",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.corregimientos = response;
  }).error(function () {});

  $scope.selectedCorregimiento = function (itemCorregimiento) {

    var promise = $http.get(base_api + "/obtener/veredas/" + itemCorregimiento);
    promise.then(function (responseveredas) {
      $scope.veredas = responseveredas.data;
    });
  };

  $http.get(base_api + "/obtener/estados_civiles").success(function (response) {
    $scope.civiles = response;
  });

  //


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


  $http.get(base_api + "/obtenerselect/culturas").success(function (response) {

    $scope.etnias = response;
  });

  //Fin Carga datos cultura crear


  //inicio carga discapacidad si o no


  $scope.discapacidades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio carga afiliacion salud si o no


  $scope.afiliacion_salud = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin
  //inicio carga discapacidad si o no

  $scope.libreta = [{ id: 1, nombre: 'Primera' }, { id: 2, nombre: 'Segunda' }];
  //fin
  //inicio carga salud si o no  
  $scope.seguridad_social = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];
  //fin
  $http.get(base_api + "/obtenerselect/salud_sgsss").success(function (response) {

    $scope.salud_sgsss = response;
  });
  //fin
  //inicio carga algunas discapacidades

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


  $scope.enfermedades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar data medicamentos si o no


  $scope.medicamentos = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar parentesco


  //inicio cargar data medicamentos si o no


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

  $http.get(base_api + "/obtenerselect/afiliaciones").success(function (response) {

    $scope.afiliaciones = response;
  });
  //fin
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

  $http.get(base_api + "/obtenerselect/allGrupos_disciplinas").success(function (response) {

    $scope.allGrupos_disciplinas = response;
  });

  $http.get(base_api + "/obtenerselect/allGrupos_poblacionales").success(function (response) {

    $scope.allGrupos_poblacionales = response;
  });

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (discapacidades) {
    $scope.allGruposDiscapacidades = discapacidades;
  });
  //fin

  $http.get(base_api + "/obtener/barrios").success(function (response) {
    $scope.barrios = response;
  });

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

    $scope.comunas = response;
  });

  $scope.selectedComuna = function (itemComuna) {};
  $scope.selectedBarrio = function (itemBarrio) {
    if (itemBarrio != null) {

      $http.get(base_api + "/obtener/estrato/" + itemBarrio).success(function (estratobeneficiario) {
        $scope.tipo_estrato = {
          'id': 1,
          'unit': parseInt(estratobeneficiario.id_estrato)
        };
        $scope.comuna = estratobeneficiario.comuna_id;
      });
    }
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
    $scope.corregimiento = undefined;
    $scope.ngShowhideBarrio = true;
    $scope.ngShowhideDireccion = true;
  };

  $http.get(base_api + "/admin/postpersonausuario/cargar/" + $routeParams.id).success(function (response) {
    $scope.serie = response[0];
    $scope.acudiente = response[0];
    console.log($scope.serie);
    if ($scope.serie.titulo_obtenido == null) {
      $scope.serie.titulo_obtenido == null;
    }

    if ($scope.serie.residencia_direccion == '') {
      $("#direccion_residencia_plugin").show();
    } else if ($scope.serie.residencia_direccion != '') {
      $("#direccion_residencia_plugin").hide();
    }

    $scope.tipo_univ = {
      'id': 1,
      'universidad': $scope.serie.universidad_id
    };
    $scope.tipo_etnias = {
      'id': 1,
      'unit': $scope.serie.etnia_id
    };

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
      'unit': $scope.serie.tipoafiliacion_id
    };

    $scope.tipo_salud_otra = {

      'id': 1,
      'unit': $scope.serie.eps_id

    };

    $scope.tipo_sex = {
      'id': 1,
      'unit': $scope.serie.sexo
    };

    $scope.tipo_sag = {
      'id': 1,
      'unit': $scope.serie.sangre_tipo

      //direccion de residencia si es fuera de cali
    };$scope.residencia = $scope.serie.direccion_residencia;
    $scope.departamento_residencia = $scope.serie.departamento_residencia_id;
    $scope.municipio_residencia = $scope.serie.municipio_residencia_id;
    $scope.pais = $scope.serie.id_procedencia_pais;
    $scope.departamento = $scope.serie.id_procedencia_departamento;

    if ($scope.serie.municipio_residencia_id == null) {
      $scope.municipio_residencia_id = 834;
    }

    if ($scope.serie.municipio_residencia_id == 834) {
      $scope.municipio_residencia = 834;
      $scope.residencia1 = false;
      $scope.residencia2 = false;
      $scope.residencia3 = true;
      $scope.isDisabledDirecionresidencia = true;
      $scope.residenciaRequired = false;
      $scope.personal_residencia = false;
      $scope.residencia_personal = false;
      $scope.direcc = true;
      $scope.residencia = null;
      $scope.estilo = {
        color: "#FF0000",
        backgroundColor: 'rgb(238, 238, 238)'
      };
    }

    if ($scope.serie.municipio_residencia_id != 834) {

      $scope.direccionRequired = false;
      $scope.residencia1 = true;
      $scope.residencia2 = true;
      $scope.residencia3 = false;
      $scope.direcc = false;
      $scope.isDisabledDirecionresidencia = false;
      $scope.residenciaRequired = true;
      $scope.estilo = {
        backgroundColor: 'white'
      };
      $scope.personal_residencia = true;
      $scope.residencia_personal = false;
    }

    $scope.municipio = $scope.serie.id_procedencia_municipio;

    var promise = $http.get(base_api + "/obtener/municipios/" + $scope.serie.id_procedencia_departamento);
    promise.then(function (responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
    });
    $scope.municipio = $scope.serie.id_procedencia_municipio;

    if ($scope.serie.id_residencia_barrio != null) {

      $http.get(base_api + "/obtener/comuna_barrio/" + $scope.serie.id_residencia_barrio).success(function (responseComuna) {

        $scope.tipo_com = {
          'id': 1,
          'unit': responseComuna[0].id
        };

        $scope.barrio = $scope.serie.id_residencia_barrio;
      });
    }
    $scope.otro_poblacional = $scope.serie.otro_poblacional;

    $scope.corregimiento = $scope.serie.id_residencia_corregimiento;

    if ($scope.serie.id_residencia_barrio != null) {
      $http.get(base_api + "/obtener/estrato/" + $scope.serie.id_residencia_barrio).success(function (estratobeneficiario) {
        $scope.comuna = estratobeneficiario.comuna_id;
      });
    }

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
      'unit': $scope.serie.ocupacion_beneficiario
    };

    if ($scope.serie.ocupacion_beneficiario == 8) {
      $scope.isDisabledOcupacion = false;
    } else {

      $scope.isDisabledOcupacion = true;
    }

    $scope.tipo_esc = {
      'id': 1,
      'unit': $scope.serie.escolaridad_id
    };

    $scope.tipo_cult = {
      'id': 1,
      'unit': $scope.serie.cultura_beneficiario
    };

    if ($scope.serie.cultura_beneficiario == 10) {
      $scope.isDisabledCultura = false;
    } else {

      $scope.isDisabledCultura = true;
    }

    $http.get(base_api + "/cargar/poblacionalesUsuario/" + $routeParams.id).success(function (response) {
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

    $http.get(base_api + "/cargar/discapacidadesUsuario/" + $routeParams.id).success(function (response) {

      $scope.selectedDiscapacidades = response;
    });

    $http.get(base_api + "/cargar/disciplinasUsuario/" + $routeParams.id).success(function (response) {

      $scope.selectedDisciplinas = response;
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
      'unit': $scope.serie.enfermedad_permanente
    };

    if ($scope.serie.enfermedad_permanente == 1) {

      $scope.isDisabledDiscapacidad = false;
    } else {

      $scope.isDisabledDiscapacidad = true;
    }

    // if ($scope.serie.discapacidad_beneficiario == 1) {
    // $scope.isDisabledDiscapacidad = false;
    // }
    // else{

    // $scope.isDisabledDiscapacidad = true;

    // }

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
      'unit': $scope.serie.medicamentos
    };

    if ($scope.serie.medicamentos == 1) {
      $scope.isDisabledMedicamento = false;
    } else {

      $scope.isDisabledMedicamento = true;
    }

    $scope.tipo_libreta = {
      'id': 1,
      'unit': $scope.serie.libreta_militar
    };

    $scope.estado_esc = {
      'id': 1,
      'unit': $scope.serie.estado_escolaridad
    };
  });

  $http.get(base_api + "/obtenerselect/rol/" + $routeParams.id).success(function (response) {

    $scope.data = {
      'id': 1,
      'unit': response.id
    };
  });

  $http.get(base_api + "/obtenerselect/roles").success(function (response) {
    $scope.roles = response;
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

  var promise = $http.get(base_api + "/obtener/departamentos/" + $scope.data_paises.unit);
  promise.then(function (responsedepartamentos) {
    $scope.departamentos = responsedepartamentos.data;
    $scope.residencia_departamentos = responsedepartamentos.data;
  });

  var promise = $http.get(base_api + "/obtener/municipios/" + $scope.municipio);
  promise.then(function (responsemunicipios) {
    $scope.municipios = responsemunicipios.data;
  });

  $scope.data_municipio = {
    'id': 1,
    'unit': 131
  };

  $scope.selectedDepartamentoResidencia = function (departamento_residencia) {

    var promise = $http.get(base_api + "/obtener/municipios/" + departamento_residencia);
    promise.then(function (responsemunicipiosresidencia) {
      $scope.residencia_municipios = responsemunicipiosresidencia.data;
    });
  };

  $scope.onBlurResidencia = function (direccion_residencia) {

    if (direccion_residencia != null) {
      $scope.residencia_personal = false;
      $scope.direc1 = false;
      $scope.direc2 = false;
    } else {

      $scope.direc1 = true;
      $scope.direc2 = true;
      $scope.residencia_personal = true;
    }
  };

  $scope.residencia1 = false;
  $scope.residencia2 = false;
  $scope.residencia3 = true;
  $scope.direcc = true;
  $scope.direccionRequired = true;

  $scope.selectedMunicipioResidencia = function (ItemMunicipioResidencia) {

    if (ItemMunicipioResidencia != 834) {
      $scope.direccionRequired = false;
      $scope.residencia1 = true;
      $scope.residencia2 = true;
      $scope.residencia3 = false;
      $scope.direcc = false;
      $scope.isDisabledDirecionresidencia = false;
      $scope.residenciaRequired = true;
      $scope.estilo = {
        backgroundColor: 'white'
      };
      $scope.personal_residencia = true;
      $scope.residencia_personal = true;
      $scope.corregimiento = null;
      $scope.vereda = null;
      $scope.barrio = null;
      $scope.tipo_estrato = {
        'id': 1,
        'unit': null
      };
      $scope.comuna = null;
    } else {

      $scope.municipio_residencia = 834;
      $scope.residencia1 = false;
      $scope.residencia2 = false;
      $scope.residencia3 = true;
      $scope.isDisabledDirecionresidencia = true;
      $scope.residenciaRequired = false;
      $scope.personal_residencia = false;
      $scope.residencia_personal = false;
      $scope.direcc = true;
      $scope.residencia = null;
      $scope.estilo = {
        color: "#FF0000",
        backgroundColor: 'rgb(238, 238, 238)'
      };
    }
  };

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
        url: base_api + "/eliminar/poblacionalpersonal/" + $scope.serie.ficha_save,
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
  $scope.toggleSelectionDisciplina = function toggleSelectionDisciplina(seleccion) {

    var index = $scope.selectedDisciplinas.indexOfObjectWithProperty('id', seleccion.id);

    if (index > -1) {
      $scope.selectedDisciplinas.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/disciplina/" + $scope.serie.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedDisciplinas.push(seleccion);
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
        url: base_api + "/eliminar/discapacidad/" + $scope.serie.ficha_save,
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

  $scope.formsubmit = function () {

    var direccion_sider = $("#id_persona_beneficiario_residencia_direccion").val();

    if ($scope.residencia == undefined) {
      $scope.residencia = null;
    } else {
      $scope.residencia = $scope.residencia;
    }

    if ($scope.serie.telefono_fijo == undefined) {
      $scope.serie.telefono_fijo = null;
    } else {
      $scope.serie.telefono_fijo = $scope.serie.telefono_fijo;
    }

    if ($scope.serie.no_libreta == undefined) {
      $scope.serie.no_libreta = null;
    } else {
      $scope.serie.no_libreta = $scope.serie.no_libreta;
    }

    if ($scope.serie.distrito_militar == undefined) {
      $scope.serie.distrito_militar = null;
    } else {
      $scope.serie.distrito_militar = $scope.serie.distrito_militar;
    }

    if ($scope.serie.skype_empleado == undefined) {
      $scope.serie.skype_empleado = null;
    } else {
      $scope.serie.skype_empleado = $scope.serie.skype_empleado;
    }

    if ($scope.serie.proyecto_profesional == undefined) {
      $scope.serie.proyecto_profesional = null;
    } else {
      $scope.serie.proyecto_profesional = $scope.serie.proyecto_profesional;
    }

    if ($scope.serie.titulo_obtenido == undefined) {
      $scope.serie.titulo_obtenido = null;
    } else if ($scope.serie.titulo_obtenido != null) {
      $scope.serie.titulo_obtenido = $scope.serie.titulo_obtenido;
    }

    var otra_ocupacion = '';
    var otra_cultura = '';
    var cual_discapacidad = '';
    var otra_discapacidad = '';
    var enfermedad_benec = '';
    var medicamento_benec = '';
    var otra_salud = '';
    var seguridad_benec = '';
    var parentesco_benec = '';

    if ($scope.otro_poblacional == undefined) {
      otro_poblacional = null;
    } else if ($scope.otro_poblacional != null) {
      otro_poblacional = $scope.otro_poblacional;
    }

    if ($scope.serie.cantidad_hijos == undefined) {
      $scope.serie.cantidad_hijos = null;
    } else if ($scope.serie.cantidad_hijos != null) {
      $scope.serie.cantidad_hijos = $scope.serie.cantidad_hijos;
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

    if ($scope.serie.otra_enfermedad == undefined) {
      otra_discapacidad = null;
    } else if ($scope.serie.otra_enfermedad != null) {
      otra_discapacidad = $scope.serie.otra_enfermedad;
    }

    if ($scope.serie.enfermedad_beneficiario == undefined) {
      enfermedad_benec = null;
    } else if ($scope.serie.enfermedad_beneficiario != null) {
      enfermedad_benec = $scope.serie.enfermedad_beneficiario;
    }

    if ($scope.serie.otros_medicamentos == undefined) {
      medicamento_benec = null;
    } else if ($scope.serie.otros_medicamentos != null) {
      medicamento_benec = $scope.serie.otros_medicamentos;
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
    var SelectDisciplina = $scope.selectedDisciplinas;

    var datos = {

      //Datos Persona
      tipo_doc_persona: $scope.tipo_doc.unit,
      no_documento_persona: $scope.serie.documento,
      primer_nombre_persona: $scope.serie.nombre_primero,
      segundo_nombre_persona: $scope.serie.nombre_segundo,
      primer_apellido_persona: $scope.serie.apellido_primero,
      segundo_apellido_persona: $scope.serie.apellido_segundo,
      correo_persona: $scope.serie.correo_electronico,
      sexo_persona: $scope.tipo_sex.unit,
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
      departamento_residencia: $scope.departamento_residencia,
      municipio_residencia: $scope.municipio_residencia,
      direc_residencia: $scope.residencia,

      //Datos Beneficiario     
      no_ficha: $scope.serie.no_ficha,
      fecha_inscripcion: fecha_inscripcion,
      escolaridad_beneficiario: $scope.tipo_esc.unit,
      estado_escolaridad: $scope.estado_esc.unit,
      titulo_obtenido: $scope.serie.titulo_obtenido,
      universidad: $scope.tipo_univ.universidad,
      ocupacion_beneficiario: $scope.tipo_ocup.unit,
      hijos_beneficiario: $scope.tipo_hij.unit,
      cantidad_hijos_beneficiario: $scope.serie.cantidad_hijos,
      cultura_beneficiario: $scope.tipo_etnias.unit,
      discapacidad_beneficiario: $scope.tipo_disc.unit,
      otra_discapacidad_beneficiario: otra_discapacidad,
      medicamentos_permanente_beneficiario: $scope.tipo_medic.unit,
      medicamentos_beneficiario: medicamento_benec,
      condicion_discapacidad: $scope.tipo_condicion.unit,
      afiliacion_salud: $scope.tipo_afiliacion_salud.unit,
      tipo_afiliacion: $scope.tipo_afiliacion.unit,
      salud_sgsss_beneficiario: otra_salud,
      ficha: ficha_registro,
      otro_poblacional: otro_poblacional,
      tipo_libreta: $scope.tipo_libreta.unit,
      no_libreta: $scope.serie.no_libreta,
      distrito_militar: $scope.serie.distrito_militar,
      skype_empleado: $scope.serie.skype_empleado,
      proyecto_profesional: $scope.serie.proyecto_profesional,
      rol: $scope.data.unit

    };

    if ($scope.municipio_residencia == 834 && corregimiento_persona == null && direccion_sider == '') {

      swal("Algo te hace falta!", "Verifique que su campo Dirección no este vacio!", "error");
      toastr.error("Verifique que su campo Dirección no este vacio", "Campo Dirección");
    } else {

      $.ajax({
        url: base_api + '/postusuario/editarpersonal/' + $routeParams.id,
        type: 'POST',
        dataType: 'JSON',
        data: {
          datos: datos,
          SelectPoblacional: SelectPoblacional,
          SelectDiscapacidad: SelectDiscapacidad,
          SelectDisciplina: SelectDisciplina
        }

      }).success(function () {
        swal("Muy bien!", "Su registro ha sido exitoso", "success");
        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location = "/admin/postusuarios#/admin/postusuarios";
      }).error(function () {
        console.log("success");
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/usuarios/EditarUsuarioPerfilCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("EditarUsuarioPerfilCtrl", function ($scope, UsuarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Editar Usuario";
  $scope.series = [];
  $scope.getData = function () {};
  $("#direccion_residencia_plugin").show();

  $scope.departamento_residencia = 76;

  $http.get(base_api + "/obtener/municipios/" + $scope.departamento_residencia).success(function (response) {
    $scope.residencia_municipios = response;
  });

  $(document).ready(function () {

    $('[name=integer-data-attribute]').maskNumber({ integer: true });
  });

  $scope.reset = function () {
    $scope.state = undefined;
  };

  $scope.title = "Creacion Personal";
  $scope.series = [];
  $scope.selectedPoblacionales = [];
  $scope.selectedDiscapacidades = [];
  $scope.selectedDisciplinas = [];

  $scope.getData = function () {
    $scope.serie = GrupoService.get({ id: $routeParams.id });
  };

  $scope.grupo_save = $routeParams.id;

  $scope.serie = {};

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

  //Obtener Titulos
  $http.get(base_api + "/obtener/titulos").success(function (titulos) {

    $scope.titulos = titulos;
  });

  //Inicio Carga de datos Documento Crear
  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {
    $scope.tipodocumento = response;
  });

  //Fin Carga de datos Documento Crear

  //inicio tipo documento acudients


  //fin


  //Inicio Carga datos sexo crear


  $scope.estrato = [{ id: 1, nombre: '1' }, { id: 2, nombre: '2' }, { id: 3, nombre: '3' }, { id: 4, nombre: '4' }, { id: 5, nombre: '5' }, { id: 6, nombre: '6' }, { id: 7, nombre: '7' }];

  //Fin Carga datos sexo crear

  //Inicio Carga datos sexo crear


  $scope.sexo = [{ id: 1, nombre: 'Mujer' }, { id: 2, nombre: 'Hombre' }];

  //Fin Carga datos sexo crear


  //Fin Carga datos sexo crear

  //Inicio Carga datos tipo de sangre


  $scope.sangre = [{ id: '1', nombre: 'O+' }, { id: '2', nombre: 'O-' }, { id: '3', nombre: 'A+' }, { id: '4', nombre: 'A-' }, { id: '5', nombre: 'B+' }, { id: '6', nombre: 'B-' }, { id: '7', nombre: 'AB+' }, { id: '8', nombre: 'AB-' }];

  //Fin Carga datos tipo de sangre


  //inicio cargar datos corregimientos


  $.ajax({
    url: base_api + "/obtener/corregimientos",
    type: 'GET',
    dataType: 'JSON',
    async: false
  }).success(function (response) {
    $scope.corregimientos = response;
  }).error(function () {});

  $scope.selectedCorregimiento = function (itemCorregimiento) {

    var promise = $http.get(base_api + "/obtener/veredas/" + itemCorregimiento);
    promise.then(function (responseveredas) {
      $scope.veredas = responseveredas.data;
    });
  };

  $http.get(base_api + "/obtener/estados_civiles").success(function (response) {
    $scope.civiles = response;
  });

  //


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


  $http.get(base_api + "/obtenerselect/culturas").success(function (response) {

    $scope.etnias = response;
  });

  //Fin Carga datos cultura crear


  //inicio carga discapacidad si o no


  $scope.discapacidades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio carga afiliacion salud si o no


  $scope.afiliacion_salud = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin
  //inicio carga discapacidad si o no

  $scope.libreta = [{ id: 1, nombre: 'Primera' }, { id: 2, nombre: 'Segunda' }];
  //fin
  //inicio carga salud si o no  
  $scope.seguridad_social = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];
  //fin
  $http.get(base_api + "/obtenerselect/salud_sgsss").success(function (response) {

    $scope.salud_sgsss = response;
  });
  //fin
  //inicio carga algunas discapacidades

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


  $scope.enfermedades = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar data medicamentos si o no


  $scope.medicamentos = [{ id: 1, nombre: 'Si' }, { id: 2, nombre: 'No' }];

  //fin

  //inicio cargar parentesco


  //inicio cargar data medicamentos si o no


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

  $http.get(base_api + "/obtenerselect/afiliaciones").success(function (response) {

    $scope.afiliaciones = response;
  });
  //fin
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

  $http.get(base_api + "/obtenerselect/allGrupos_disciplinas").success(function (response) {

    $scope.allGrupos_disciplinas = response;
  });

  $http.get(base_api + "/obtenerselect/allGrupos_poblacionales").success(function (response) {

    $scope.allGrupos_poblacionales = response;
  });

  $http.get(base_api + "/obtenerselect/discapacidad").success(function (discapacidades) {
    $scope.allGruposDiscapacidades = discapacidades;
  });
  //fin

  $http.get(base_api + "/obtener/barrios").success(function (response) {
    $scope.barrios = response;
  });

  $http.get(base_api + "/obtenerselect/comunas").success(function (response) {

    $scope.comunas = response;
  });

  $scope.selectedComuna = function (itemComuna) {};
  $scope.selectedBarrio = function (itemBarrio) {
    if (itemBarrio != null) {

      $http.get(base_api + "/obtener/estrato/" + itemBarrio).success(function (estratobeneficiario) {
        $scope.tipo_estrato = {
          'id': 1,
          'unit': parseInt(estratobeneficiario.id_estrato)
        };
        $scope.comuna = estratobeneficiario.comuna_id;
      });
    }
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
    $scope.corregimiento = undefined;
    $scope.ngShowhideBarrio = true;
    $scope.ngShowhideDireccion = true;
  };

  $http.get(base_api + "/admin/postpersonausuario/cargar/" + $routeParams.id).success(function (response) {
    $scope.serie = response[0];
    $scope.acudiente = response[0];

    if ($scope.serie.titulo_obtenido == null) {
      $scope.serie.titulo_obtenido == null;
    }

    if ($scope.serie.residencia_direccion == '') {
      $("#direccion_residencia_plugin").show();
    } else if ($scope.serie.residencia_direccion != '') {
      $("#direccion_residencia_plugin").hide();
    }

    $scope.tipo_univ = {
      'id': 1,
      'universidad': $scope.serie.universidad_id
    };
    $scope.tipo_etnias = {
      'id': 1,
      'unit': $scope.serie.etnia_id
    };

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
      'unit': $scope.serie.tipoafiliacion_id
    };

    $scope.tipo_salud_otra = {

      'id': 1,
      'unit': $scope.serie.eps_id

    };

    $scope.sexo = [{ id: 1, nombre: 'Mujer' }, { id: 2, nombre: 'Hombre' }];

    $scope.tipo_sex = {
      'id': 1,
      'unit': $scope.serie.sexo
    };
    console.log($scope.serie.sexo);

    $scope.tipo_sag = {
      'id': 1,
      'unit': $scope.serie.sangre_tipo

      //direccion de residencia si es fuera de cali
    };$scope.residencia = $scope.serie.direccion_residencia;
    $scope.departamento_residencia = $scope.serie.departamento_residencia_id;
    $scope.municipio_residencia = $scope.serie.municipio_residencia_id;
    $scope.pais = $scope.serie.id_procedencia_pais;
    $scope.departamento = $scope.serie.id_procedencia_departamento;

    if ($scope.serie.municipio_residencia_id == null) {
      $scope.municipio_residencia_id = 834;
    }

    if ($scope.serie.municipio_residencia_id == 834) {
      $scope.municipio_residencia = 834;
      $scope.residencia1 = false;
      $scope.residencia2 = false;
      $scope.residencia3 = true;
      $scope.isDisabledDirecionresidencia = true;
      $scope.residenciaRequired = false;
      $scope.personal_residencia = false;
      $scope.residencia_personal = false;
      $scope.direcc = true;
      $scope.residencia = null;
      $scope.estilo = {
        color: "#FF0000",
        backgroundColor: 'rgb(238, 238, 238)'
      };
    }

    if ($scope.serie.municipio_residencia_id != 834) {

      $scope.direccionRequired = false;
      $scope.residencia1 = true;
      $scope.residencia2 = true;
      $scope.residencia3 = false;
      $scope.direcc = false;
      $scope.isDisabledDirecionresidencia = false;
      $scope.residenciaRequired = true;
      $scope.estilo = {
        backgroundColor: 'white'
      };
      $scope.personal_residencia = true;
      $scope.residencia_personal = false;
    }

    $scope.municipio = $scope.serie.id_procedencia_municipio;

    var promise = $http.get(base_api + "/obtener/municipios/" + $scope.serie.id_procedencia_departamento);
    promise.then(function (responsemunicipios) {
      $scope.municipios = responsemunicipios.data;
    });
    $scope.municipio = $scope.serie.id_procedencia_municipio;

    if ($scope.serie.id_residencia_barrio != null) {

      $http.get(base_api + "/obtener/comuna_barrio/" + $scope.serie.id_residencia_barrio).success(function (responseComuna) {

        $scope.tipo_com = {
          'id': 1,
          'unit': responseComuna[0].id
        };

        $scope.barrio = $scope.serie.id_residencia_barrio;
      });
    }
    $scope.otro_poblacional = $scope.serie.otro_poblacional;

    $scope.corregimiento = $scope.serie.id_residencia_corregimiento;

    if ($scope.serie.id_residencia_barrio != null) {
      $http.get(base_api + "/obtener/estrato/" + $scope.serie.id_residencia_barrio).success(function (estratobeneficiario) {
        $scope.comuna = estratobeneficiario.comuna_id;
      });
    }

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
      'unit': $scope.serie.ocupacion_beneficiario
    };

    if ($scope.serie.ocupacion_beneficiario == 8) {
      $scope.isDisabledOcupacion = false;
    } else {

      $scope.isDisabledOcupacion = true;
    }

    $scope.tipo_esc = {
      'id': 1,
      'unit': $scope.serie.escolaridad_id
    };

    $scope.tipo_cult = {
      'id': 1,
      'unit': $scope.serie.cultura_beneficiario
    };

    if ($scope.serie.cultura_beneficiario == 10) {
      $scope.isDisabledCultura = false;
    } else {

      $scope.isDisabledCultura = true;
    }

    $http.get(base_api + "/cargar/poblacionalesUsuario/" + $routeParams.id).success(function (response) {
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

    $http.get(base_api + "/cargar/discapacidadesUsuario/" + $routeParams.id).success(function (response) {

      $scope.selectedDiscapacidades = response;
    });

    $http.get(base_api + "/cargar/disciplinasUsuario/" + $routeParams.id).success(function (response) {

      $scope.selectedDisciplinas = response;
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
      'unit': $scope.serie.enfermedad_permanente
    };

    if ($scope.serie.enfermedad_permanente == 1) {

      $scope.isDisabledDiscapacidad = false;
    } else {

      $scope.isDisabledDiscapacidad = true;
    }

    // if ($scope.serie.discapacidad_beneficiario == 1) {
    // $scope.isDisabledDiscapacidad = false;
    // }
    // else{

    // $scope.isDisabledDiscapacidad = true;

    // }

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
      'unit': $scope.serie.medicamentos
    };

    if ($scope.serie.medicamentos == 1) {
      $scope.isDisabledMedicamento = false;
    } else {

      $scope.isDisabledMedicamento = true;
    }

    $scope.tipo_libreta = {
      'id': 1,
      'unit': $scope.serie.libreta_militar
    };

    $scope.estado_esc = {
      'id': 1,
      'unit': $scope.serie.estado_escolaridad
    };
  });

  $http.get(base_api + "/obtenerselect/rol/" + $routeParams.id).success(function (response) {

    $scope.data = {
      'id': 1,
      'unit': response.id
    };
  });

  $http.get(base_api + "/obtenerselect/roles").success(function (response) {
    $scope.roles = response;
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

  var promise = $http.get(base_api + "/obtener/departamentos/" + $scope.data_paises.unit);
  promise.then(function (responsedepartamentos) {
    $scope.departamentos = responsedepartamentos.data;
    $scope.residencia_departamentos = responsedepartamentos.data;
  });

  var promise = $http.get(base_api + "/obtener/municipios/" + $scope.municipio);
  promise.then(function (responsemunicipios) {
    $scope.municipios = responsemunicipios.data;
  });

  $scope.data_municipio = {
    'id': 1,
    'unit': 131
  };

  $scope.selectedDepartamentoResidencia = function (departamento_residencia) {

    var promise = $http.get(base_api + "/obtener/municipios/" + departamento_residencia);
    promise.then(function (responsemunicipiosresidencia) {
      $scope.residencia_municipios = responsemunicipiosresidencia.data;
    });
  };

  $scope.onBlurResidencia = function (direccion_residencia) {

    if (direccion_residencia != null) {
      $scope.residencia_personal = false;
      $scope.direc1 = false;
      $scope.direc2 = false;
    } else {

      $scope.direc1 = true;
      $scope.direc2 = true;
      $scope.residencia_personal = true;
    }
  };

  $scope.residencia1 = false;
  $scope.residencia2 = false;
  $scope.residencia3 = true;
  $scope.direcc = true;
  $scope.direccionRequired = true;

  $scope.selectedMunicipioResidencia = function (ItemMunicipioResidencia) {

    if (ItemMunicipioResidencia != 834) {
      $scope.direccionRequired = false;
      $scope.residencia1 = true;
      $scope.residencia2 = true;
      $scope.residencia3 = false;
      $scope.direcc = false;
      $scope.isDisabledDirecionresidencia = false;
      $scope.residenciaRequired = true;
      $scope.estilo = {
        backgroundColor: 'white'
      };
      $scope.personal_residencia = true;
      $scope.residencia_personal = true;
      $scope.corregimiento = null;
      $scope.vereda = null;
      $scope.barrio = null;
      $scope.tipo_estrato = {
        'id': 1,
        'unit': null
      };
      $scope.comuna = null;
    } else {

      $scope.municipio_residencia = 834;
      $scope.residencia1 = false;
      $scope.residencia2 = false;
      $scope.residencia3 = true;
      $scope.isDisabledDirecionresidencia = true;
      $scope.residenciaRequired = false;
      $scope.personal_residencia = false;
      $scope.residencia_personal = false;
      $scope.direcc = true;
      $scope.residencia = null;
      $scope.estilo = {
        color: "#FF0000",
        backgroundColor: 'rgb(238, 238, 238)'
      };
    }
  };

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
        url: base_api + "/eliminar/poblacionalpersonal/" + $scope.serie.ficha_save,
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
  $scope.toggleSelectionDisciplina = function toggleSelectionDisciplina(seleccion) {

    var index = $scope.selectedDisciplinas.indexOfObjectWithProperty('id', seleccion.id);

    if (index > -1) {
      $scope.selectedDisciplinas.splice(index, 1);

      $http({
        method: 'POST',
        type: 'JSON',
        url: base_api + "/eliminar/disciplina/" + $scope.serie.ficha_save,
        data: $.param({
          grupo_pcs: seleccion.id

        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      }).success(function (data, status, headers, config) {
        // handle success things
      }).error(function (data, status, headers, config) {});
    } else {
      $scope.selectedDisciplinas.push(seleccion);
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
        url: base_api + "/eliminar/discapacidad/" + $scope.serie.ficha_save,
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

  $scope.formsubmit = function () {

    var direccion_sider = $("#id_persona_beneficiario_residencia_direccion").val();

    if ($scope.residencia == undefined) {
      $scope.residencia = null;
    } else {
      $scope.residencia = $scope.residencia;
    }

    if ($scope.serie.telefono_fijo == undefined) {
      $scope.serie.telefono_fijo = null;
    } else {
      $scope.serie.telefono_fijo = $scope.serie.telefono_fijo;
    }

    if ($scope.serie.no_libreta == undefined) {
      $scope.serie.no_libreta = null;
    } else {
      $scope.serie.no_libreta = $scope.serie.no_libreta;
    }

    if ($scope.serie.distrito_militar == undefined) {
      $scope.serie.distrito_militar = null;
    } else {
      $scope.serie.distrito_militar = $scope.serie.distrito_militar;
    }

    if ($scope.serie.skype_empleado == undefined) {
      $scope.serie.skype_empleado = null;
    } else {
      $scope.serie.skype_empleado = $scope.serie.skype_empleado;
    }

    if ($scope.serie.proyecto_profesional == undefined) {
      $scope.serie.proyecto_profesional = null;
    } else {
      $scope.serie.proyecto_profesional = $scope.serie.proyecto_profesional;
    }

    if ($scope.serie.titulo_obtenido == undefined) {
      $scope.serie.titulo_obtenido = null;
    } else if ($scope.serie.titulo_obtenido != null) {
      $scope.serie.titulo_obtenido = $scope.serie.titulo_obtenido;
    }

    var otra_ocupacion = '';
    var otra_cultura = '';
    var cual_discapacidad = '';
    var otra_discapacidad = '';
    var enfermedad_benec = '';
    var medicamento_benec = '';
    var otra_salud = '';
    var seguridad_benec = '';
    var parentesco_benec = '';

    if ($scope.otro_poblacional == undefined) {
      otro_poblacional = null;
    } else if ($scope.otro_poblacional != null) {
      otro_poblacional = $scope.otro_poblacional;
    }

    if ($scope.serie.cantidad_hijos == undefined) {
      $scope.serie.cantidad_hijos = null;
    } else if ($scope.serie.cantidad_hijos != null) {
      $scope.serie.cantidad_hijos = $scope.serie.cantidad_hijos;
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

    if ($scope.serie.otra_enfermedad == undefined) {
      otra_discapacidad = null;
    } else if ($scope.serie.otra_enfermedad != null) {
      otra_discapacidad = $scope.serie.otra_enfermedad;
    }

    if ($scope.serie.enfermedad_beneficiario == undefined) {
      enfermedad_benec = null;
    } else if ($scope.serie.enfermedad_beneficiario != null) {
      enfermedad_benec = $scope.serie.enfermedad_beneficiario;
    }

    if ($scope.serie.otros_medicamentos == undefined) {
      medicamento_benec = null;
    } else if ($scope.serie.otros_medicamentos != null) {
      medicamento_benec = $scope.serie.otros_medicamentos;
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
    var SelectDisciplina = $scope.selectedDisciplinas;

    var datos = {

      //Datos Persona
      tipo_doc_persona: $scope.tipo_doc.unit,
      no_documento_persona: $scope.serie.documento,
      primer_nombre_persona: $scope.serie.nombre_primero,
      segundo_nombre_persona: $scope.serie.nombre_segundo,
      primer_apellido_persona: $scope.serie.apellido_primero,
      segundo_apellido_persona: $scope.serie.apellido_segundo,
      correo_persona: $scope.serie.correo_electronico,
      sexo_persona: $scope.tipo_sex.unit,
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
      departamento_residencia: $scope.departamento_residencia,
      municipio_residencia: $scope.municipio_residencia,
      direc_residencia: $scope.residencia,

      //Datos Beneficiario     
      no_ficha: $scope.serie.no_ficha,
      fecha_inscripcion: fecha_inscripcion,
      escolaridad_beneficiario: $scope.tipo_esc.unit,
      estado_escolaridad: $scope.estado_esc.unit,
      titulo_obtenido: $scope.serie.titulo_obtenido,
      universidad: $scope.tipo_univ.universidad,
      ocupacion_beneficiario: $scope.tipo_ocup.unit,
      hijos_beneficiario: $scope.tipo_hij.unit,
      cantidad_hijos_beneficiario: $scope.serie.cantidad_hijos,
      cultura_beneficiario: $scope.tipo_etnias.unit,
      discapacidad_beneficiario: $scope.tipo_disc.unit,
      otra_discapacidad_beneficiario: otra_discapacidad,
      medicamentos_permanente_beneficiario: $scope.tipo_medic.unit,
      medicamentos_beneficiario: medicamento_benec,
      condicion_discapacidad: $scope.tipo_condicion.unit,
      afiliacion_salud: $scope.tipo_afiliacion_salud.unit,
      tipo_afiliacion: $scope.tipo_afiliacion.unit,
      salud_sgsss_beneficiario: otra_salud,
      ficha: ficha_registro,
      otro_poblacional: otro_poblacional,
      tipo_libreta: $scope.tipo_libreta.unit,
      no_libreta: $scope.serie.no_libreta,
      distrito_militar: $scope.serie.distrito_militar,
      skype_empleado: $scope.serie.skype_empleado,
      proyecto_profesional: $scope.serie.proyecto_profesional

    };

    if ($scope.municipio_residencia == 834 && corregimiento_persona == null && direccion_sider == '') {

      swal("Algo te hace falta!", "Verifique que su campo Dirección no este vacio!", "error");
      toastr.error("Verifique que su campo Dirección no este vacio", "Campo Dirección");
    } else {

      $.ajax({
        url: base_api + '/postusuario/editarpersonalPerfil/' + $routeParams.id,
        type: 'POST',
        dataType: 'JSON',
        data: {
          datos: datos,
          SelectPoblacional: SelectPoblacional,
          SelectDiscapacidad: SelectDiscapacidad,
          SelectDisciplina: SelectDisciplina
        }

      }).success(function () {
        swal("Muy bien!", "Su registro ha sido exitoso", "success");
        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        window.location = "/";
      }).error(function () {
        console.log("success");
      });
    }
  };
});

/***/ }),

/***/ "./resources/assets/controllers/usuarios/SoporteCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('SoporteCrtl', function ($scope, $routeParams, $location, $http, $timeout, base_api) {

  $scope.title = "Soporte";
});

/***/ }),

/***/ "./resources/assets/controllers/usuarios/UsuariosCrtl.js":
/***/ (function(module, exports) {

SeriesApp.controller('UsuariosCrtl', function ($scope, $routeParams, $location, UsuarioService, $http, $timeout, base_api) {

  $scope.title = "Usuarios";
  $scope.series = [];

  $http.get(base_api + "/admin/tenanId").success(function (response) {
    $scope.tenanId = response;
  });

  $scope.getData = function () {
    $http.get(base_api + "/admin/postusuarios").success(function (response) {
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
  $scope.series = UsuarioService.query();

  $scope.toggle = function (modalstate) {
    $scope.modalstate = modalstate;
    switch (modalstate) {
      case 'CrearRol':
        $scope.form_title = "Formulario Rol";
        break;

    }

    $('#myModal').modal('show');
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
      closeOnConfirm: true,
      closeOnCancel: true
    }).then(function (isConfirm) {
      if (isConfirm.value != undefined && isConfirm.value) {
        $.ajax({
          url: base_api + '/eliminar/usuario/' + id,
          type: 'POST',
          dataType: 'JSON'

        }).success(function (response) {
          swal("Eliminado!", "Registro Eliminado.", "success");
          $scope.getData();
        });
      } else {
        //swal("Cancelado", "No elimino su registro :)", "error");
        Swal.fire({
          title: 'Cancelado!',
          text: 'No elimino su registro :)',
          type: 'error',
          confirmButtonText: 'Cool'
        });
      }
    });
  };

  $scope.QuitarRol = function (id) {

    Swal.fire({ title: 'Estas seguro?', showCancelButton: true }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: base_api + '/quitarRol/usuario/' + id,
          type: 'POST',
          dataType: 'JSON'

        }).success(function (response) {
          $scope.getData();
          Swal.fire('Sin Rol!', 'Usuario sin Rol', 'success');
          $scope.getData();
        });
      } else {

        Swal.fire({
          title: 'Cancelado!',
          text: 'No quito Rol :)',
          type: 'error',
          confirmButtonText: 'Cool'
        });
      }
    });
  };
});

/***/ }),

/***/ 14:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/usuarios/UsuariosCrtl.js");
__webpack_require__("./resources/assets/controllers/usuarios/CreateUsuarioCtrl.js");
__webpack_require__("./resources/assets/controllers/usuarios/CreateUsuarioDeporteCtrl.js");
__webpack_require__("./resources/assets/controllers/usuarios/EditarUsuarioCtrl.js");
__webpack_require__("./resources/assets/controllers/usuarios/EditarUsuarioPerfilCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/usuarios/SoporteCrtl.js");


/***/ })

/******/ });