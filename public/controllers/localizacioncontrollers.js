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
/******/ 	return __webpack_require__(__webpack_require__.s = 22);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/controllers/localizacion/LocalizacionBeneficiarioCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller("LocalizacionBeneficiarioCtrl", function ($scope, BeneficiarioService, $routeParams, fileUpload, $http, $location, $timeout, base_api) {
  $scope.title = "Editar Beneficiario";
  $scope.series = [];
  $scope.getData = function () {

    $http.get(base_api + "/admin/postbeneficiario/ficha/" + $routeParams.id).success(function (response) {

      $scope.serie = response[0];

      console.log($scope.serie);
    });
  };

  $http.get(base_api + "/obtener/tipodocumento/" + $routeParams.id).success(function (response) {

    $scope.data_documento = {
      'id': 1,
      'unit': response[0].id
    };

    console.log($scope.data_documento);
  });

  $http.get(base_api + "/obtenerselect/tipo_documento").success(function (response) {

    $scope.tipo_documentos = response;
    console.log($scope.tipo_documentos);
  });

  $http.get(base_api + "/obtener/sexo/" + $routeParams.id).success(function (response) {

    var caseSexo = response.id;

    if (caseSexo == 1) {
      $scope.sexo_benef = 'Mujer';
    } else if (caseSexo == 2) {
      $scope.sexo_benef = 'Hombre';
    }
  });

  $http.get(base_api + "/obtener/civil/" + $routeParams.id).success(function (response) {

    var caseCivil = response.id;

    if (caseCivil == 1) {
      $scope.estado_civ_benef = 'Casado';
    } else if (caseCivil == 2) {
      $scope.estado_civ_benef = 'Soltero';
    } else if (caseCivil == 3) {
      $scope.estado_civ_benef = 'Unión Libre';
    } else if (caseCivil == 4) {
      $scope.estado_civ_benef = 'Viudo';
    }
  });

  $http.get(base_api + "/obtener/hijos/" + $routeParams.id).success(function (response) {

    var caseHijos = response.id;

    if (caseHijos == 1) {
      $scope.hijos_benef = 'Si';
    } else if (caseHijos == 2) {
      $scope.hijos_benef = 'No';
    }
  });

  $http.get(base_api + "/obtener/tiposangre/" + $routeParams.id).success(function (response) {

    var caseSangre = response.id;

    if (caseSangre == 1) {
      $scope.sangre_benef = 'O+';
    } else if (caseSangre == 2) {
      $scope.sangre_benef = 'O-';
    } else if (caseSangre == 3) {
      $scope.sangre_benef = 'A+';
    } else if (caseSangre == 4) {
      $scope.sangre_benef = 'A-';
    } else if (caseSangre == 5) {
      $scope.sangre_benef = 'B+';
    } else if (caseSangre == 6) {
      $scope.sangre_benef = 'B-';
    } else if (caseSangre == 7) {
      $scope.sangre_benef = 'AB+';
    } else if (caseSangre == 8) {
      $scope.sangre_benef = 'AB-';
    }
  });

  $http.get(base_api + "/obtener/ocupacion/" + $routeParams.id).success(function (response) {

    var caseOcupacion = response.id;

    if (caseOcupacion == 1) {
      $scope.ocupacion_benef = 'Ama de casa';
    } else if (caseOcupacion == 2) {
      $scope.ocupacion_benef = 'Empleado';
    } else if (caseOcupacion == 3) {
      $scope.ocupacion_benef = 'Estudiante';
    } else if (caseOcupacion == 4) {
      $scope.ocupacion_benef = 'Desempleado';
    } else if (caseOcupacion == 5) {
      $scope.ocupacion_benef = 'Independiente';
    } else if (caseOcupacion == 6) {
      $scope.ocupacion_benef = 'Pensionado-Jubilado';
    } else if (caseOcupacion == 7) {
      $scope.ocupacion_benef = 'Servidor Público';
    } else if (caseOcupacion == 8) {
      $scope.ocupacion_benef = 'Otro';
    }
  });

  $http.get(base_api + "/obtener/escolaridad/" + $routeParams.id).success(function (response) {

    var caseEscolaridad = response.id;

    if (caseEscolaridad == 1) {
      $scope.escolaridad_benef = 'Educación inicial';
    } else if (caseEscolaridad == 2) {
      $scope.escolaridad_benef = 'Preescolar';
    } else if (caseEscolaridad == 3) {
      $scope.escolaridad_benef = 'Primaria';
    } else if (caseEscolaridad == 4) {
      $scope.escolaridad_benef = 'Secundaria';
    } else if (caseEscolaridad == 5) {
      $scope.escolaridad_benef = 'Técnico';
    } else if (caseEscolaridad == 6) {
      $scope.escolaridad_benef = 'Tecnológico';
    } else if (caseEscolaridad == 7) {
      $scope.escolaridad_benef = 'Universitario';
    } else if (caseEscolaridad == 8) {
      $scope.escolaridad_benef = 'Posgrado';
    } else if (caseEscolaridad == 9) {
      $scope.escolaridad_benef = 'Ninguno';
    }
  });

  $http.get(base_api + "/obtener/cultura/" + $routeParams.id).success(function (response) {

    var caseCultura = response.id;

    if (caseCultura == 1) {
      $scope.cultura_benef = 'Negro';
    } else if (caseCultura == 2) {
      $scope.cultura_benef = 'Blanco';
    } else if (caseCultura == 3) {
      $scope.cultura_benef = 'Índigena';
    } else if (caseCultura == 4) {
      $scope.cultura_benef = 'Mestizo';
    } else if (caseCultura == 5) {
      $scope.cultura_benef = 'Mulato';
    } else if (caseCultura == 6) {
      $scope.cultura_benef = 'ROM, Gitano';
    } else if (caseCultura == 7) {
      $scope.cultura_benef = 'Palenquero';
    } else if (caseCultura == 8) {
      $scope.cultura_benef = 'Raizal';
    } else if (caseCultura == 9) {
      $scope.cultura_benef = 'No sabe-No responde';
    } else if (caseCultura == 10) {
      $scope.cultura_benef = 'Otro';
    }
  });

  $http.get(base_api + "/obtener/discapacidad/" + $routeParams.id).success(function (response) {

    var caseDiscapacidad = response.id;

    if (caseDiscapacidad == 1) {
      $scope.discapacidad_benef = 'Si';
    } else if (caseDiscapacidad == 2) {
      $scope.discapacidad_benef = 'No';
    }
  });

  $http.get(base_api + "/obtener/DiscapacidadOtra/" + $routeParams.id).success(function (response) {

    var caseDiscapacidadOtra = response.id;

    if (caseDiscapacidadOtra == 1) {
      $scope.discapacidad_otra_benef = 'Auditiva';
    } else if (caseDiscapacidadOtra == 2) {
      $scope.discapacidad_otra_benef = 'Cognitiva';
    } else if (caseDiscapacidadOtra == 3) {
      $scope.discapacidad_otra_benef = 'Mental';
    } else if (caseDiscapacidadOtra == 4) {
      $scope.discapacidad_otra_benef = 'Motriz';
    } else if (caseDiscapacidadOtra == 5) {
      $scope.discapacidad_otra_benef = 'Oral';
    } else if (caseDiscapacidadOtra == 6) {
      $scope.discapacidad_otra_benef = 'Visual';
    }
  });

  $http.get(base_api + "/obtener/enfermedadpermanente/" + $routeParams.id).success(function (response) {

    var caseEnfemerdad = response.id;

    if (caseEnfemerdad == 1) {
      $scope.enfermedad_benef = 'Si';
    } else if (caseEnfemerdad == 2) {
      $scope.enfermedad_benef = 'No';
    }
  });

  $http.get(base_api + "/obtener/medicamentopermanente/" + $routeParams.id).success(function (response) {

    var caseMedicamento = response.id;

    if (caseMedicamento == 1) {
      $scope.medicamento_benef = 'Si';
    } else if (caseMedicamento == 2) {
      $scope.medicamento_benef = 'No';
    }
  });

  $http.get(base_api + "/obtener/seguridadsocial/" + $routeParams.id).success(function (response) {

    var caseSeguridad = response.id;

    if (caseSeguridad == 1) {
      $scope.seguridad_benef = 'Si';
    } else if (caseSeguridad == 2) {
      $scope.seguridad_benef = 'No';
    }
  });

  $http.get(base_api + "/obtener/saludsgss/" + $routeParams.id).success(function (response) {

    var caseSalud = response.id;

    if (caseSalud == 1) {
      $scope.salud_benef = 'Regimen Contributivo (EPS)';
    } else if (caseSalud == 2) {
      $scope.salud_benef = 'Regimen Subsidiado (SISBEN-EPS-S)';
    } else if (caseSalud == 3) {
      $scope.salud_benef = 'Especial (FFMM, Policia, etc)';
    }
  });

  $http.get(base_api + "/obtener/documentoacudiente/" + $routeParams.id).success(function (response) {

    $scope.data_tipo_doc_acudiente = {
      'id': 1,
      'unit': response.id
    };
  });

  $http.get(base_api + "/obtener/sexo_acudiente/" + $routeParams.id).success(function (response) {

    var caseSexoAcudiente = response.id;

    if (caseSexoAcudiente == 1) {
      $scope.sexo_acudient = 'Mujer';
    } else if (caseSexoAcudiente == 2) {
      $scope.sexo_acudient = 'Hombre';
    }
  });

  $http.get(base_api + "/obtener/parentesco/" + $routeParams.id).success(function (response) {

    var caseParentesco = response.id;

    if (caseParentesco == 1) {
      $scope.parentesco_acudient = 'Madre/Padre';
    } else if (caseParentesco == 2) {
      $scope.parentesco_acudient = 'Hermana/Hermano';
    } else if (caseParentesco == 3) {
      $scope.parentesco_acudient = 'Tia/Tio';
    } else if (caseParentesco == 4) {
      $scope.parentesco_acudient = 'Abuela/Abuelo';
    } else if (caseParentesco == 5) {
      $scope.parentesco_acudient = 'Cuidador';
    } else if (caseParentesco == 6) {
      $scope.parentesco_acudient = 'Otro';
    }
  });

  $scope.serie = {};
  $scope.getData();
  $http.get(base_api + "/obtenerselect/SedeGrupo/" + $routeParams.id).success(function (response) {
    $scope.dataSede = response;
  });

  // $http.get(base_api + "/obtener/pais/" + $routeParams.id)
  // .success(function(response){
  //   $scope.data = {
  //     'id': 1,
  //     'unit': response.id
  //   }

  //   $http.get(base_api + "/obtener/departamentos/" + $scope.data.unit)
  //   .success(function(response){
  //     $scope.departamentos = response;

  //   });

  // });


  // $http.get(base_api + "/obtener/paises")
  // .success(function(response){
  //   $scope.paises = response;

  // });

  // $scope.selectedPais=function(item){

  //   $http.get(base_api + "/obtener/departamentos/" + item)
  //   .success(function(response){
  //     $scope.departamentos = response;

  //   });
  // }    

  // $scope.selectedDepartamento=function(item){

  //   $http.get(base_api + "/obtener/municipios/" + item)
  //   .success(function(response){
  //     $scope.municipios = response;

  //   });
  // }    

  // $http.get(base_api + "/obtener/departamento/" + $routeParams.id)
  // .success(function(response){
  //   $scope.datas = {
  //     'id': 1,
  //     'unit': response.id
  //   }

  //   $http.get(base_api + "/obtener/municipios/" + $scope.datas.unit)
  //   .success(function(response){
  //     $scope.municipios = response;

  //   });

  // });

  // $http.get(base_api + "/obtener/municipio/" + $routeParams.id)
  // .success(function(response){
  //   $scope.data_municipio = {
  //     'id': 1,
  //     'unit': response.id
  //   }
  // });


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

  $http.get(base_api + "/obtener/corregimientos").success(function (response) {
    $scope.corregimientos = response;
  });

  $http.get(base_api + "/obtener/corregimiento/" + $routeParams.id).success(function (response) {
    $scope.data_corregimiento = {
      'id': 1,
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

  Array.prototype.indexOfObjectWithProperty = function (propertyName, propertyValue) {
    for (var i = 0, len = this.length; i < len; i++) {
      if (this[i][propertyName] === propertyValue) return i;
    }

    return -1;
  };

  Array.prototype.containsObjectWithProperty = function (propertyName, propertyValue) {
    return this.indexOfObjectWithProperty(propertyName, propertyValue) != -1;
  };

  $scope.allGrupos_poblacionales = [{ id: 1, name: 'Adulto Mayor' }, { id: 2, name: 'Afrodescendiente/Afrocolombiano' }, { id: 3, name: 'Víctimas del conflicto armado' }, { id: 4, name: 'Habitante calle' }, { id: 5, name: 'LGBTI' }, { id: 6, name: 'Persona con discapacidad' }, { id: 7, name: 'Grupo organizado de Mujeres' }, { id: 8, name: 'Indígenas' }, { id: 9, name: 'Reinsertado' }, { id: 10, name: 'Junta de acción comunal (JAC)' }, { id: 11, name: 'Grupo organizado de Jóvenes' }, { id: 12, name: 'Ninguno' }, { id: 13, name: 'Recluido' }, { id: 14, name: 'Junta de administradora local (JAL)' }, { id: 15, name: 'Otro grupo' }];

  $http.get(base_api + "/obtener/poblacionales/" + $routeParams.id).success(function (response) {

    $scope.selectedPoblacionales = response;
  });

  $scope.toggleSelection = function toggleSelection(seleccion) {

    var index = $scope.selectedPoblacionales.indexOfObjectWithProperty('id', seleccion.id);

    if (index > -1) {
      $scope.selectedPoblacionales.splice(index, 1);
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

    $scope.fecha_iscrip = $scope.fecha_inscripcions;
    var d_inscripcion_date = new Date($scope.fecha_iscrip);
    var fecha_inscripcion_date = $.datepicker.formatDate('yy/mm/dd', d_inscripcion_date);
    var d_nacimiento_beneficiario = new Date($scope.fecha_nac);
    var fecha_nacimiento_beneficiario = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_beneficiario);
    $scope.fecha_nac_acud = $scope.fecha_acudiente;
    var d_nacimiento_acudiente = new Date($scope.fecha_nac_acud);
    var fecha_nacimiento_acudiente = $.datepicker.formatDate('yy/mm/dd', d_nacimiento_acudiente);

    if (isValid) {

      var datos = {

        grupo_id: $scope.serie.grupo_id,
        fecha_inscripcion: fecha_inscripcion_date,
        no_ficha: $scope.serie.no_ficha,
        programa_id: $scope.data_programa.unit,
        modalidad: $scope.serie.modalidad,
        punto_atencion: $scope.serie.punto_atencion,
        nombres_beneficiario: $scope.serie.nombres_beneficiario,
        apellidos_beneficiario: $scope.serie.apellidos_beneficiario,
        tipo_documento_beneficiario: $scope.obtener.documentoId,
        no_documento_beneficiario: $scope.serie.no_documento_beneficiario,
        sexo_beneficiario: $scope.obsexo.sexoId,
        fecha_nac_beneficiario: fecha_nacimiento_beneficiario,
        edad_beneficiario: $scope.serie.edad_beneficiario,
        telefono_beneficiario: $scope.serie.telefono_beneficiario,
        correo_beneficiario: $scope.serie.correo_beneficiario,
        pais_id: $scope.data.unit,
        departamento_id: $scope.datas.unit,
        municipio_id: $scope.data_municipio.unit,
        direccion_beneficiario: $scope.serie.direccion_beneficiario,
        estrato_beneficiario: $scope.serie.estrato_beneficiario,
        comuna_id: $scope.data_comuna.unit,
        barrio_id: $scope.data_barrio.unit,
        corregimiento_beneficiario: $scope.serie.corregimiento_beneficiario,
        vereda_beneficiario: $scope.serie.vereda_beneficiario,
        estado_civil_beneficiario: $scope.obcivil.civilId,
        hijos_beneficiario: $scope.obhijos.hijosId,
        cantidad_hijos_beneficiario: $scope.serie.cantidad_hijos_beneficiario,
        tipo_sangre_beneficiario: $scope.obtipo_sangre.tipo_sangreId,
        ocupacion_beneficiario: $scope.obocupacion.ocupacionId,
        otra_ocupacion_beneficiario: $scope.serie.ocupacion_beneficiario,
        escolaridad_beneficiario: $scope.obescolaridad.escolaridadId,
        cultura_beneficiario: $scope.obcultura.culturaId,
        otra_cultura_beneficiario: $scope.serie.otra_cultura_beneficiario,
        discapacidad_beneficiario: $scope.obdiscapacidad.discapacidadId,
        discapacidad_select_beneficiario: $scope.obdiscapacidadotro.discapacidadotroId,
        otra_discapacidad_beneficiario: $scope.serie.otra_discapacidad_beneficiario,
        enfermedad_permanente_beneficiario: $scope.obenfermedad.enfermedadId,
        enfermedad_beneficiario: $scope.serie.enfermedad_beneficiario,
        medicamentos_permanente_beneficiario: $scope.obmedicamento.medicamentoId,
        medicamentos_beneficiario: $scope.serie.medicamentos_beneficiario,
        seguridad_social_beneficiario: $scope.obseguridadsocial.seguridadsocialId,
        salud_sgsss_beneficiario: $scope.obsaludsgss.saludsgssId,
        nombre_seguridad_beneficiario: $scope.serie.nombre_seguridad_beneficiario,
        nombres_acudiente: $scope.serie.nombres_acudiente,
        apellidos_acudiente: $scope.serie.apellidos_acudiente,
        tipo_doc_acudiente: $scope.obdoc_acudiente.doc_acudienteId,
        documento_acudiente: $scope.serie.documento_acudiente,
        sexo_acudiente: $scope.obsexo_acudiente.sexo_acudienteId,
        fecha_nac_acudiente: fecha_nacimiento_acudiente,
        edad_acudiente: $scope.serie.edad_acudiente,
        telefono_acudiente: $scope.serie.telefono_acudiente,
        correo_acudiente: $scope.serie.correo_acudiente,
        parentesco_acudiente: $scope.obparentesco.parentescoId,
        otro_parentesco_acudiente: $scope.serie.otro_parentesco_acudiente
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

/***/ "./resources/assets/controllers/localizacion/LocalizacionCorregimientoInstitucionCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller('LocalizacionCorregimientoInstitucionCtrl', function ($scope, $routeParams, $location, LocalizacionService, $http, $timeout, base_api) {

    $scope.title = "Localizacion Institución";
    $scope.comuna = $routeParams.id;
    $scope.instituciones = [];

    $http.get(base_api + "/admin/postlocalizacion_instituciones_corregimiento/" + $routeParams.id).success(function (response) {

        $scope.instituciones = response;
        console.log($scope.instituciones);

        var self;

        $scope.data = data = [{
            "key": "Cantidad Sedes",
            "values": $scope.instituciones
        }];

        $scope.options = {
            chart: {
                type: 'multiBarChart',
                height: 400,
                width: 400,
                x: function x(d) {
                    return d.label;
                },
                y: function y(d) {
                    return d.value;
                },
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
                    tickFormat: function tickFormat(d) {
                        return d3.format(',.2f')(d);
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

    $scope.selectedValue = "INFORMACIÓN.";

    $scope.instituciones2 = [];

    $scope.events = {
        dataplotclick: function dataplotclick(ev, props) {

            $scope.$apply(function () {

                $scope.colorValue = "background-color:" + props.categoryLabel + ";";
                $scope.selectedValue = "Institución " + props.categoryLabel + " cantidad de sedes " + props.dataValue;
            });
        }
    };

    $http.get(base_api + "/admin/postlocalizacion_instituciones_corregimiento/" + $routeParams.id).success(function (response) {

        $scope.instituciones2.push(response);
    });

    $scope.dataSource = {
        "chart": {
            "caption": "INSTITUCIONES CORREGIMIENTO ",
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
            "toolTipSepChar": " Sedes ",

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
            "xAxisLineColor": "#999999"

        },

        "data": $scope.instituciones2
    };
});

/***/ }),

/***/ "./resources/assets/controllers/localizacion/LocalizacionCrtl.js":
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

SeriesApp.controller('LocalizacionCrtl', function ($scope, $routeParams, $location, LocalizacionService, $http, $timeout, base_api) {

  $scope.title = "Localizacion";
  $scope.series = [];

  $http.get(base_api + "/obtener/corregimientos").success(function (response) {

    $scope.corregimientos = response;
  });

  $scope.selectedCorregimiento = function (corregimiento) {

    var url_local = "admin/postlocalizacion#/admin/postlocalizacion/corregimiento/instituciones/" + corregimiento;
    window.location.href = url_local;
  };

  $(function () {
    var _ref;

    function pointClick() {

      var comuna = this;
      var url_local = "admin/postlocalizacion#/admin/postlocalizacion/instituciones/" + comuna.name;
      window.location.href = url_local;
    }
    // Initiate the chart
    $('#container').highcharts('Map', {
      title: {
        text: "<strong>Comunas Cali<strong>"
      },
      legend: {
        id: "null",
        align: 'right',
        verticalAlign: 'middle',
        layout: 'vertical',
        width: 120,
        height: 240
      },
      formatter: function formatter() {
        return "nombre";
      },
      mapNavigation: {
        enabled: true
      },
      series: [{
        name: 'Comuna 1',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [(_ref = {
          name: "comuna1",
          path: "M156,-632,126,-630,116,-633,114,-635,104,-636,91,-636,87,-640,54,-640,37,-641,31,-642,28,-647,26,-652,25,-656,22,-658,18,-663,14,-666,0,-667,1,-681,6,-686,11,-689,17,-694,22,-699,27,-701,29,-703,37,-703,40,-697,45,-699,51,-703,54,-701,57,-696,59,-692,66,-692,72,-691,71,-687,74,-684,76,-681,91,-681,101,-682,110,-680,116,-677,122,-678,121,-687,125,-693,130,-700,136,-705,138,-714,135,-721,137,-723,154,-723,159,-719,165,-715,169,-713,174,-712,176,-708,181,-708,189,-704,194,-702,202,-696,206,-688,210,-683,203,-675,195,-673,191,-675,182,-670,176,-664,168,-658,160,-653,152,-648,151,-642,155,-635z"
        }, _defineProperty(_ref, "name", "1"), _defineProperty(_ref, "events", {
          click: pointClick
        }), _ref)]
      }, {
        name: 'Comuna 2',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "2",
          path: "M192,-628,188,-636,185,-641,179,-639,172,-638,168,-635,163,-633,159,-637,157,-643,160,-648,168,-652,174,-657,183,-665,190,-669,196,-670,205,-671,215,-678,220,-681,235,-681,243,-685,241,-690,246,-695,251,-699,252,-708,253,-716,256,-721,256,-727,259,-730,262,-734,270,-734,275,-731,279,-727,283,-727,289,-731,292,-735,294,-744,297,-747,299,-754,302,-760,303,-769,307,-772,308,-776,309,-791,313,-793,317,-799,319,-804,321,-818,324,-821,324,-829,314,-828,306,-830,304,-834,303,-839,298,-840,297,-848,292,-852,291,-857,286,-861,282,-864,272,-865,271,-869,266,-872,269,-876,275,-881,284,-880,286,-885,292,-885,297,-881,306,-880,310,-875,314,-870,324,-870L324,-919L329,-919,336,-916,347,-914,356,-905,358,-901L363,-901L364,-897,368,-895L382,-895L388,-891,390,-891L403,-891L407,-888,409,-886,418,-884,419,-881,430,-879,433,-877,436,-875,447,-874,451,-872,458,-869,463,-870,464,-867,465,-854,464,-845,461,-838,454,-836,448,-833,442,-832,437,-828,422,-804,417,-797,412,-791,407,-786,403,-781,397,-772,392,-763,378,-736,375,-727,371,-721,366,-716L358,-716L348,-717,345,-715,343,-711,337,-706,332,-703,322,-691,319,-690L309,-690L305,-684,303,-678,301,-671,294,-666,287,-663,277,-657,269,-652,260,-649,250,-652,243,-653,235,-652,230,-646,227,-638,222,-632,221,-626,218,-622,211,-619L204,-619L197,-624z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 3',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "3",
          path: "M266,-587,255,-594,250,-599,239,-598,226,-599,220,-603,213,-606,209,-609,209,-613,213,-617,220,-618,226,-628,229,-635,235,-645,242,-649,247,-648,252,-647,261,-646,270,-648,299,-665,307,-670,308,-677,309,-683,314,-687,321,-687,327,-689,342,-705,345,-709,350,-714L357,-714L362,-714,363,-709,364,-700,367,-687,369,-676,371,-672,372,-668,355,-663,336,-657,325,-654,321,-650,322,-643,328,-625,330,-617,333,-611,324,-610L311,-610L301,-609,292,-606,282,-603,271,-592z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 4',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "4",
          path: "M469,-863,476,-862,480,-860,489,-859,496,-856,505,-853,509,-851,507,-848,505,-844,499,-836,490,-826,479,-818,472,-811,467,-806,463,-802,461,-800,460,-797,461,-794,463,-787,465,-783,466,-778,465,-775,462,-774,460,-772,455,-771,452,-771,449,-769,448,-767,450,-762,474,-709,472,-707,465,-706,462,-705,461,-703,454,-699,442,-694,415,-685,404,-683,394,-680,386,-679,382,-678,379,-676,375,-676,373,-678,372,-685,370,-688,368,-702,367,-709,367,-713,369,-714,374,-719,388,-746,395,-761,399,-768,411,-786,420,-794,425,-802,433,-816,438,-823,443,-828,449,-830,460,-834,464,-838,466,-841,467,-858,467,-862L467,-863z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 5',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "5",
          path: "M573,-738,553,-804,550,-808,549,-818,547,-822,547,-832,544,-839,542,-842,536,-844,529,-850,524,-852,521,-854,517,-855,512,-854,511,-851,510,-846,507,-842,504,-836,496,-827,490,-821,484,-816,464,-798,464,-794,467,-789,470,-782,470,-776,468,-771,463,-770,458,-768,454,-768,453,-766,453,-761,457,-754,479,-708,480,-707z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 6',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "6",
          path: "M471,-873,475,-881,480,-883,494,-909,502,-920L502,-932L506,-937,508,-944,515,-945,520,-950L520,-959L521,-967L531,-967L537,-964,539,-956,538,-947,537,-935,558,-924,576,-912,581,-907,584,-897,585,-891,586,-881,588,-869,594,-859,595,-844,594,-836,602,-830,609,-825,610,-819,612,-811,613,-806,618,-797,624,-790,630,-784L630,-756L620,-753,615,-748,606,-750,599,-747,587,-744,580,-739,577,-740,554,-811,553,-822,551,-827,550,-834,548,-840,545,-844,540,-847,537,-847,528,-853,524,-856,513,-858,508,-858,504,-860,498,-862,494,-864,483,-863,479,-864,472,-865,469,-868z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 7',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "7",
          path: "M636,-745,637,-733,633,-728,629,-721,623,-717,619,-711,619,-701,625,-696,626,-686,625,-677,626,-671,631,-665,627,-657,625,-646,617,-644,612,-642,605,-641,598,-633,590,-621,579,-619,574,-615,566,-612L552,-612L542,-614,546,-625,554,-638,561,-649,563,-659,550,-660,548,-663,532,-662,480,-663,468,-665L456,-665L437,-667,430,-673,428,-677,429,-687,573,-734,585,-735,590,-735,594,-741,600,-743,606,-745,616,-744,622,-748,630,-752,633,-752z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 8',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "8",
          path: "M377,-568,379,-584,379,-601,381,-606,382,-626,383,-643,381,-651,379,-660,378,-665,376,-672,385,-676,397,-677,405,-680,411,-682,417,-683,422,-685,426,-684,425,-676,427,-672,429,-669,435,-665,444,-663,452,-662,465,-660L471,-660L480,-659L544,-659L547,-657,552,-656L558,-656L559,-653,554,-645,548,-635,543,-625,540,-618,538,-613,531,-612,527,-612,525,-611,524,-607,522,-604,516,-602,511,-602,509,-599,507,-593,505,-591,504,-593L504,-601L504,-607,500,-610L494,-610L487,-610,482,-612,470,-612,466,-610,467,-604,469,-600,471,-596,473,-593,472,-591,468,-589,458,-586,450,-583,444,-582,439,-581,436,-581,434,-576,428,-572,421,-566,416,-565,412,-569,408,-571,396,-570,389,-569,382,-568z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 9',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "9",
          path: "M328,-650,346,-656,360,-661,368,-664,374,-664,375,-662,376,-659L376,-657L377,-652,378,-648,378,-616,379,-607,376,-604,376,-599,374,-568,373,-566,365,-565,356,-563,350,-561,344,-558,333,-550,327,-547,320,-546,309,-546,299,-549,285,-559,278,-562,265,-567,256,-572,256,-576,262,-578,268,-580,270,-586,273,-590,281,-598,286,-602,299,-606,311,-606,336,-607,337,-609,333,-618,328,-632,326,-640,324,-646,325,-648,326,-649z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 10',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "10",
          path: "M351,-392,339,-392,332,-394,324,-397,313,-402,299,-408,292,-412,282,-414,276,-416,269,-417,264,-418,265,-426,270,-441,281,-470,288,-492,291,-499,295,-501,302,-503,308,-511,309,-517,314,-520,315,-525,316,-530,318,-533,320,-537,324,-541,331,-545,340,-551,348,-557,358,-561,364,-562,371,-562,370,-538,369,-532,366,-528,365,-522,364,-518,362,-502,362,-495,360,-487L360,-479L360,-473,358,-468,357,-444,356,-439,355,-438,354,-419,354,-411,352,-409z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 11',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "11",
          path: "M381,-417,367,-403,358,-395,357,-391,360,-433,361,-459,362,-467,364,-479,365,-487,366,-495,369,-523,372,-530,375,-560,378,-564,393,-566L406,-566L413,-562,418,-559,421,-555L421,-552L420,-549,425,-545,428,-542,426,-539,428,-534,432,-533,437,-527,439,-522,441,-517,443,-514L448,-514L451,-517,454,-518,457,-515,462,-510,467,-505,467,-502,463,-497,456,-490,452,-486,449,-482,446,-478,443,-477,430,-465,426,-461,423,-458,420,-455,420,-453,417,-450z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 12',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "12",
          path: "M469,-507,461,-517,456,-522,450,-521,447,-519,443,-522,440,-528,435,-534,431,-537,431,-542,428,-546,425,-551,427,-552L427,-557L423,-559,421,-561,425,-564,433,-568,438,-573,441,-577,453,-580,469,-586,473,-588,476,-592,475,-597,472,-601,471,-605,470,-609,479,-609,485,-607,495,-607,500,-606,501,-599,500,-594,500,-590,503,-587L508,-587L511,-594,514,-599,520,-600,524,-603,528,-607,534,-609,535,-608,530,-597,518,-574,511,-560,498,-535,495,-529,493,-525,490,-521,484,-516,479,-511,472,-505,470,-504z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 13',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "13",
          path: "M476,-438,467,-447,467,-450,473,-455,473,-461,454,-478,453,-481,459,-488,471,-501,481,-508,492,-518,499,-527,508,-546,523,-576,531,-591,536,-603,538,-609,577,-608,578,-600,579,-594,579,-578,578,-565,579,-551,579,-535,580,-520,577,-513,573,-502,569,-490,565,-482,561,-475,560,-470,557,-469,551,-468,546,-466,540,-464,536,-463,533,-460,530,-456,526,-455,518,-455,515,-455,511,-452,502,-441,497,-440,494,-439,489,-436,487,-433,484,-430,482,-430z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 14',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "14",
          path: "M644,-435,662,-457,671,-469,675,-479,680,-499,684,-510,673,-522,665,-530,657,-538,651,-544,652,-547L661,-547L666,-549,661,-555,642,-562,633,-565,620,-574,606,-583,598,-588,592,-589,587,-587,582,-583,583,-543,584,-529L584,-520L579,-508,575,-495,570,-483,567,-476,570,-474,574,-473,577,-470,581,-462,584,-459,585,-453,591,-449,600,-446,605,-441,604,-437,607,-433,621,-429,629,-427,635,-428,640,-428z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 15',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "15",
          path: "M454,-306,448,-300,443,-294,440,-293,437,-292,433,-289,429,-288,425,-293,425,-298,404,-329,398,-337,395,-342,400,-347,413,-360,419,-364,430,-374,436,-380,446,-387,449,-392,453,-396,465,-404,470,-412,483,-423,487,-427,489,-431,497,-436,503,-437,507,-442,514,-450,524,-451,530,-451,537,-458,542,-460,547,-462,550,-464,562,-465,567,-467,570,-469,576,-467,579,-461,581,-458,582,-451,583,-449,589,-446,589,-443,586,-438,580,-434,561,-426,550,-418,541,-413,536,-408,528,-398,525,-392,517,-390,511,-386,505,-381,498,-374,492,-367,486,-356,483,-350,473,-333,468,-322,463,-313,460,-308z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 16',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "16",
          path: "M392,-300,387,-302,382,-301,376,-303,371,-305,368,-307,363,-305,360,-303,354,-299,351,-293,350,-289,350,-287,345,-286,341,-289L341,-295L343,-305,344,-308,347,-315,350,-320L350,-345L353,-358,357,-386L357,-391L363,-396,378,-408,404,-435,422,-450,424,-455,431,-460,450,-476,469,-458,470,-456,462,-449,462,-447,478,-430,480,-427,479,-424,464,-409,459,-404,453,-401,450,-400,447,-396,442,-389,438,-387,434,-383,431,-380,427,-377,413,-364,407,-358,403,-354,397,-348,392,-345,388,-347,384,-350,382,-354,376,-352,376,-345,376,-337,373,-336,373,-322L373,-318L370,-316,371,-310,373,-309,379,-310,383,-307,388,-306,392,-303,395,-301z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 17',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "17",
          path: "M350,-120,213,-97,215,-101,222,-108,232,-115,235,-118,230,-123,231,-129,238,-133,242,-137,239,-142,218,-169L214,-169L214,-175L211,-177,207,-178,203,-184,203,-190,208,-189,210,-187,212,-185,219,-186,225,-187,229,-189,236,-193,235,-197,232,-201,231,-204,235,-208,239,-210,244,-212,243,-237,238,-263,228,-300,226,-318,224,-333,222,-342,222,-357,227,-360,232,-362,245,-361,251,-367L251,-373L256,-385,259,-391,262,-397,259,-403,264,-408,266,-414,279,-411,290,-409,301,-403,318,-395,334,-391,346,-388,354,-387,352,-377,352,-371,350,-358,348,-353,347,-351,347,-327,345,-322,342,-315,340,-307,338,-298,337,-291,340,-285,347,-283,353,-284,354,-290,358,-297,363,-301,368,-303,372,-299,376,-298L387,-298L397,-291,396,-159,393,-154,390,-150,381,-145,370,-145,366,-148,364,-151,359,-150,354,-146,349,-145z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 18',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "18",
          path: "M188,-197,169,-198,157,-202,143,-208,135,-213,131,-215L131,-221L136,-222,142,-222,145,-222,147,-225,150,-226,151,-228,144,-232,142,-237,142,-245,139,-252,136,-258,136,-270,141,-274,138,-278,131,-280,133,-288,140,-292,148,-292,156,-293,160,-298,152,-301,146,-303,141,-310,137,-314,136,-322,140,-326,148,-327,219,-334,222,-329,221,-324,224,-307,227,-288,230,-275,236,-253,237,-242,239,-233,239,-216,236,-213L231,-213L229,-210,229,-206L228,-206L224,-204,226,-200,230,-198,229,-193,224,-191,218,-190,209,-192,202,-193,197,-196,195,-197z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 19',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "19",
          path: "M218,-338,154,-332,157,-359,161,-387,163,-400,162,-420,163,-426,168,-429,173,-445,182,-481,188,-505,192,-510,194,-513,193,-523,189,-526,186,-535,181,-539,161,-553,155,-558,157,-565,165,-569,174,-576,181,-584,181,-590,178,-596,171,-602,166,-610,160,-623,159,-628,172,-632,176,-635L184,-635L187,-627,190,-623,194,-619L199,-619L201,-616,201,-612,204,-607,210,-603,221,-597,227,-595,249,-595,262,-583,261,-581,255,-579,248,-576L248,-573L252,-570,264,-565,282,-556,290,-552,294,-546,300,-542,318,-543,321,-542,315,-535,311,-529L311,-524L310,-521,307,-520,305,-515,304,-511,301,-508,296,-505,290,-505,287,-501,285,-499,283,-492,262,-432,261,-427,261,-419,261,-411,256,-406,255,-402,256,-398L256,-394L254,-390,249,-379,247,-373,244,-366,237,-363,228,-365,224,-363,220,-362,219,-357z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 20',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "20",
          path: "M95,-404,80,-404,72,-405,68,-400,66,-391,60,-388,54,-388,52,-405,53,-416,58,-425,72,-426,81,-424,94,-424,102,-429,114,-430,121,-434,126,-440,127,-447,119,-452,106,-462,95,-471,96,-479,108,-494,115,-503,119,-508,128,-506,137,-503,151,-505,154,-512,153,-520,159,-522,162,-526,160,-535,160,-549,174,-539,182,-534,184,-529,185,-525,190,-523,191,-518,189,-514,187,-508,184,-503,166,-433,163,-430,158,-428,156,-426,152,-427,145,-426,141,-420,136,-415,131,-412,125,-406,121,-402,117,-400,112,-403,108,-398,107,-389,105,-384,96,-382L96,-396L100,-400,101,-404z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 21',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "21",
          path: "M759,-200,582,-600,580,-606,579,-613,584,-615,592,-616,596,-621,600,-629,607,-636L614,-636L617,-639,624,-640,629,-639,629,-631,628,-627,625,-621,625,-610L625,-604L626,-600,633,-596,641,-593L661,-593L668,-592,684,-574,693,-567,699,-560,702,-553,704,-543,705,-536,708,-529,711,-525,712,-512,711,-509,709,-501,708,-494,704,-483,703,-477,700,-462,695,-453,689,-448,683,-438,679,-432,677,-424,675,-420,677,-412,679,-405,681,-400,679,-393,675,-386,674,-380,672,-377,671,-372,671,-366,675,-362,675,-359,661,-359,646,-360,641,-359,637,-357,635,-352,630,-351,626,-355,622,-359,620,-370,621,-379,620,-387,615,-391,607,-397,605,-401,601,-407,599,-415,600,-430,604,-431,613,-427,623,-426,629,-424,641,-424,667,-457,675,-468,683,-495,687,-504,688,-510,685,-514,682,-519,665,-535,658,-541,658,-544,665,-544,669,-546,669,-551,665,-555,660,-560,655,-563,647,-564,639,-566,633,-569,610,-584,602,-590,597,-592,589,-591z",
          events: {
            click: pointClick
          }
        }]
      }, {
        name: 'Comuna 22',
        dataLabels: { enabled: true,
          format: '<b>{point.name}</b>'
        },
        type: "map",
        data: [{
          name: "22",
          path: "M349,-115,347,-38,344,13,332,14,318,13,310,17,296,26,278,26,266,25,261,28,245,28,217,29,211,33,199,32,193,31L193,17L196,7,198,-1L198,-8L192,-16,190,-29,192,-42,204,-68,218,-95z",
          events: {
            click: pointClick
          }
        }]
      }]
    });
  });

  $(window).load(function () {
    $('g.highcharts-data-labels.highcharts-series-20 g').attr('transform', 'translate(529,300)');
    $('g.highcharts-data-labels.highcharts-series-13 g').attr('opacity', '1').attr('visibility', '');
  });
});

/***/ }),

/***/ "./resources/assets/controllers/localizacion/LocalizacionInstitucionCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller('LocalizacionInstitucionCtrl', function ($scope, $routeParams, $location, LocalizacionService, $http, $timeout, base_api) {

    $scope.title = "Localizacion Institución";
    $scope.comuna = $routeParams.id;
    $scope.instituciones = [];

    $http.get(base_api + "/admin/postlocalizacion_instituciones/" + $routeParams.id).success(function (response) {

        $scope.instituciones = response;
        console.log($scope.instituciones);

        var self;

        $scope.data = data = [{
            "key": "Cantidad Sedes",
            "values": $scope.instituciones
        }];

        $scope.options = {
            chart: {
                type: 'multiBarChart',
                height: 400,
                width: 400,
                x: function x(d) {
                    return d.label;
                },
                y: function y(d) {
                    return d.value;
                },
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
                    tickFormat: function tickFormat(d) {
                        return d3.format(',.2f')(d);
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

    $scope.selectedValue = "INFORMACIÓN.";

    $scope.instituciones2 = [];

    $scope.events = {
        dataplotclick: function dataplotclick(ev, props) {

            $scope.$apply(function () {

                $scope.colorValue = "background-color:" + props.categoryLabel + ";";
                $scope.selectedValue = "Institución " + props.categoryLabel + " cantidad de sedes " + props.dataValue;
            });
        }
    };

    $http.get(base_api + "/admin/postlocalizacion_institucion/" + $routeParams.id).success(function (response) {

        $scope.instituciones2.push(response);
    });

    $scope.dataSource = {
        "chart": {
            "caption": "INSTITUCIONES EDUCATIVAS OFICIALES - COMUNA " + $routeParams.id,
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
            "toolTipSepChar": " Sedes ",

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
            "xAxisLineColor": "#999999"

        },

        "data": $scope.instituciones2
    };
});

/***/ }),

/***/ "./resources/assets/controllers/localizacion/LocalizacionInstitucionSedeCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller('LocalizacionInstitucionSedeCtrl', function ($scope, $routeParams, $location, LocalizacionInstitucionService, $http, $timeout, base_api) {

  $scope.title = "Localizacion Institución Sede";
  $scope.institucion = $routeParams.id;
  $scope.serie = LocalizacionInstitucionService.get({ id: $routeParams.id });
  //console.log($scope.serie);


  $scope.instituciones = [];

  $http.get(base_api + "/admin/postlocalizacion_institucion_sede/" + $routeParams.id).success(function (response) {

    $scope.instituciones = response;
    console.log($scope.instituciones);

    var suma = 0;
    for (var i = 0; i < $scope.instituciones.length; i++) {
      suma = suma + $scope.instituciones[i].value;
    }
    $scope.total_estudiantes = suma;
  });

  $scope.selectedValue = "INFORMACIÓN.";

  $scope.sedes_bar = [];

  $scope.events = {
    dataplotclick: function dataplotclick(ev, props) {

      $scope.$apply(function () {

        $scope.colorValue = "background-color:" + props.categoryLabel + ";";
        $scope.selectedValue = "Sede " + props.categoryLabel + " cantidad de estudiantes " + props.dataValue;
      });
    }
  };

  $http.get(base_api + "/admin/postlocalizacion_institucion_sede/" + $routeParams.id).success(function (response) {

    $scope.sedes_bar.push(response);
    //console.log(response);
  });

  $scope.dataSource = {
    "chart": {
      "caption": "ESTADÍSTICAS POR SEDE",
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
      "toolTipSepChar": " Estudiantes ",

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
      "xAxisLineColor": "#999999"

    },

    "data": $scope.sedes_bar
  };
});

/***/ }),

/***/ "./resources/assets/controllers/localizacion/LocalizacionSedeBeneficiarioCtrl.js":
/***/ (function(module, exports) {

SeriesApp.controller('LocalizacionSedeBeneficiarioCtrl', function ($scope, $routeParams, $location, LocalizacionInstitucionService, $http, $timeout, base_api) {

    $scope.title = "Beneficiarios";
    $scope.series = [];

    $scope.getData = function () {
        $http.get(base_api + "/admin/postlocalizacion_sede_beneficiarios/" + $routeParams.id).success(function (response) {
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
});

/***/ }),

/***/ 22:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/controllers/localizacion/LocalizacionBeneficiarioCtrl.js");
__webpack_require__("./resources/assets/controllers/localizacion/LocalizacionCorregimientoInstitucionCtrl.js");
__webpack_require__("./resources/assets/controllers/localizacion/LocalizacionCrtl.js");
__webpack_require__("./resources/assets/controllers/localizacion/LocalizacionInstitucionCtrl.js");
__webpack_require__("./resources/assets/controllers/localizacion/LocalizacionInstitucionSedeCtrl.js");
module.exports = __webpack_require__("./resources/assets/controllers/localizacion/LocalizacionSedeBeneficiarioCtrl.js");


/***/ })

/******/ });