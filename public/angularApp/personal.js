'use strict';
// Declare app level module which depends on views, and components
var SeriesApp = angular.module('SeriesApp', ['ui.bootstrap', 'ngRoute', 'ngResource', 'ngCkeditor','truncate', 'ngMessages', 'selector', 'ui.select', 'timepickerPop', 'toggle-switch', 'uiSwitch', 'jkuri.datepicker', 'switcher', 'ngMaterial', 'angularUtils.directives.dirPagination', 'AxelSoft', 'localytics.directives']).constant('API_URL');


SeriesApp.directive('uppercased', function() {
  return {
      require: 'ngModel',        
      link: function(scope, element, attrs, modelCtrl) {
          modelCtrl.$parsers.push(function(input) {
              return input ? input.toUpperCase() : "";
          });
          element.css("text-transform","uppercase");
      }
  };
});




SeriesApp.run(['customSelectDefaults', function(customSelectDefaults) {
	customSelectDefaults.displayText = 'Seleccionar...';
	customSelectDefaults.emptyListText = 'No hay resultados';
	customSelectDefaults.emptySearchResultText = 'Ningún resultado para "$0"';
	customSelectDefaults.addText = 'Agregar';
	customSelectDefaults.searchDelay = 500;
}]);

SeriesApp.directive('ngCustomblur', ['$parse', function($parse) {
  return function(scope, element, attr) {
    var fn = $parse(attr['ngCustomblur']);      
    element.bind('blur', function(event) {        
      scope.$apply(function() {
        fn(scope, {$event:event});
      });
    });
  }
}]);

SeriesApp.directive("onlyNumber", function () {
  return {
      restrict: "A",
      link: function (scope, element, attr) {
          element.bind('input', function () {
              var position = this.selectionStart - 1;

              //remove all but number and .
              var fixed = this.value.replace(/[^0-9\.]/g, '');  
              if (fixed.charAt(0) === '.')                  //can't start with .
                  fixed = fixed.slice(1);

              var pos = fixed.indexOf(".") + 1;
              if (pos >= 0)               //avoid more than one .
                  fixed = fixed.substr(0, pos) + fixed.slice(pos).replace('.', '');  

              if (this.value !== fixed) {
                  this.value = fixed;
                  this.selectionStart = position;
                  this.selectionEnd = position;
              }
          });
      }
  };
});

SeriesApp.directive('numbersOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    var transformedInput = text.replace(/[^0-9]/g, '');

                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }            
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});


SeriesApp.directive('datetimez', function() {
    return {
        restrict: 'A',
        require : 'ngModel',
        link: function(scope, element, attrs, ngModelCtrl) {
          element.datetimepicker({
           format: "MM-yyyy",
           viewMode: "months", 
            minViewMode: "months",
              pickTime: false,
          }).on('changeDate', function(e) {
            ngModelCtrl.$setViewValue(e.date);
            scope.$apply();
          });
        }
    };
});

SeriesApp.directive('iosSwitch', function () {
  return {
    require: 'ngModel',
    restrict: 'A',
    template: '<span class="iosSwitchInner"><span class="iosSwitchHandle"></span></span>'
  };
});

 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };

SeriesApp.directive('clockPicker', function() {
  return {
    restrict: 'A',
    link: function(scope, element, attrs) {
       // element.clockpicker();
    }
  }
})

SeriesApp.directive('checklistModel', ['$parse', '$compile', function($parse, $compile) {
  // contains
  function contains(arr, item, comparator) {
    if (angular.isArray(arr)) {
      for (var i = arr.length; i--;) {
        if (comparator(arr[i], item)) {
          return true;
        }
      }
    }
    return false;
  }

  // add
  function add(arr, item, comparator) {
    arr = angular.isArray(arr) ? arr : [];
      if(!contains(arr, item, comparator)) {
          arr.push(item);
      }
    return arr;
  }

  // remove
  function remove(arr, item, comparator) {
    if (angular.isArray(arr)) {
      for (var i = arr.length; i--;) {
        if (comparator(arr[i], item)) {
          arr.splice(i, 1);
          break;
        }
      }
    }
    return arr;
  }

  // http://stackoverflow.com/a/19228302/1458162
  function postLinkFn(scope, elem, attrs) {
     // exclude recursion, but still keep the model
    var checklistModel = attrs.checklistModel;
    attrs.$set("checklistModel", null);
    // compile with `ng-model` pointing to `checked`
    $compile(elem)(scope);
    attrs.$set("checklistModel", checklistModel);

    // getter for original model
    var checklistModelGetter = $parse(checklistModel);
    var checklistChange = $parse(attrs.checklistChange);
    var checklistBeforeChange = $parse(attrs.checklistBeforeChange);
    var ngModelGetter = $parse(attrs.ngModel);



    var comparator = function (a, b) {
      if(!isNaN(a) && !isNaN(b)) {
        return String(a) === String(b);
      } else {
        return angular.equals(a,b);
      }
    };

    if (attrs.hasOwnProperty('checklistComparator')){
      if (attrs.checklistComparator[0] == '.') {
        var comparatorExpression = attrs.checklistComparator.substring(1);
        comparator = function (a, b) {
          return a[comparatorExpression] === b[comparatorExpression];
        };

      } else {
        comparator = $parse(attrs.checklistComparator)(scope.$parent);
      }
    }

    // watch UI checked change
    var unbindModel = scope.$watch(attrs.ngModel, function(newValue, oldValue) {
      if (newValue === oldValue) {
        return;
      }

      if (checklistBeforeChange && (checklistBeforeChange(scope) === false)) {
        ngModelGetter.assign(scope, contains(checklistModelGetter(scope.$parent), getChecklistValue(), comparator));
        return;
      }

      setValueInChecklistModel(getChecklistValue(), newValue);

      if (checklistChange) {
        checklistChange(scope);
      }
    });

    // watches for value change of checklistValue
    var unbindCheckListValue = scope.$watch(getChecklistValue, function(newValue, oldValue) {
      if( newValue != oldValue && angular.isDefined(oldValue) && scope[attrs.ngModel] === true ) {
        var current = checklistModelGetter(scope.$parent);
        checklistModelGetter.assign(scope.$parent, remove(current, oldValue, comparator));
        checklistModelGetter.assign(scope.$parent, add(current, newValue, comparator));
      }
    }, true);

    var unbindDestroy = scope.$on('$destroy', destroy);

    function destroy() {
      unbindModel();
      unbindCheckListValue();
      unbindDestroy();
    }

    function getChecklistValue() {
      return attrs.checklistValue ? $parse(attrs.checklistValue)(scope.$parent) : attrs.value;
    }

    function setValueInChecklistModel(value, checked) {
      var current = checklistModelGetter(scope.$parent);
      if (angular.isFunction(checklistModelGetter.assign)) {
        if (checked === true) {
          checklistModelGetter.assign(scope.$parent, add(current, value, comparator));
        } else {
          checklistModelGetter.assign(scope.$parent, remove(current, value, comparator));
        }
      }

    }

    // declare one function to be used for both $watch functions
    function setChecked(newArr, oldArr) {
      if (checklistBeforeChange && (checklistBeforeChange(scope) === false)) {
        setValueInChecklistModel(getChecklistValue(), ngModelGetter(scope));
        return;
      }
      ngModelGetter.assign(scope, contains(newArr, getChecklistValue(), comparator));
    }

    // watch original model change
    // use the faster $watchCollection method if it's available
    if (angular.isFunction(scope.$parent.$watchCollection)) {
        scope.$parent.$watchCollection(checklistModel, setChecked);
    } else {
        scope.$parent.$watch(checklistModel, setChecked, true);
    }
  }

  return {
    restrict: 'A',
    priority: 1000,
    terminal: true,
    scope: true,
    compile: function(tElement, tAttrs) {

      if (!tAttrs.checklistValue && !tAttrs.value) {
        throw 'You should provide `value` or `checklist-value`.';
      }

      // by default ngModel is 'checked', so we set it if not specified
      if (!tAttrs.ngModel) {
        // local scope var storing individual checkbox model
        tAttrs.$set("ngModel", "checked");
      }

      return postLinkFn;
    }
  };
}]);



//var base = "{{ url('/') }}";
SeriesApp.filter('propsFilter', function() {
  return function(items, props) {
    var out = [];

    if (angular.isArray(items)) {
      items.forEach(function(item) {
        var itemMatches = false;

        var keys = Object.keys(props);
        for (var i = 0; i < keys.length; i++) {
          var prop = keys[i];
          var text = props[prop].toLowerCase();
          if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
            itemMatches = true;
            break;
          }
        }

        if (itemMatches) {
          out.push(item);
        }
      });
    } else {
      // Let the output be the input untouched
      out = items;
    }

    return out;
  }
});

SeriesApp.directive('confirmPwd', function($interpolate, $parse) {
  return {
    require: 'ngModel',
    link: function(scope, elem, attr, ngModelCtrl) {

      var pwdToMatch = $parse(attr.confirmPwd);
      var pwdFn = $interpolate(attr.confirmPwd)(scope);

      scope.$watch(pwdFn, function(newVal) {
          ngModelCtrl.$setValidity('password', ngModelCtrl.$viewValue == newVal);
      })

      ngModelCtrl.$validators.password = function(modelValue, viewValue) {
        var value = modelValue || viewValue;
        return value == pwdToMatch(scope);
      };

    }
  }
});

SeriesApp.directive('attachmentFile', function($parse){

  return {
    restrict: 'A',
    link: function(scope, element, attributes){
      var model = $parse(attributes.attachmentFile);
      var assign = model.assign;
      element.bind('change', function(){
        var files = [];
        angular.forEach(element[0].files, function(file){
            files.push(file);
        });
        scope.$apply(function(){
          assign(scope, files);
        });
      });

    }
  }

})


SeriesApp.directive('validFile',function(){
    return {
        require:'ngModel',
        link:function(scope,el,attrs,ctrl){
            ctrl.$setValidity('validFile', el.val() != '');
            //change event is fired when file is selected
            el.bind('change',function(){
                ctrl.$setValidity('validFile', el.val() != '');
                scope.$apply(function(){
                    ctrl.$setViewValue(el.val());
                    ctrl.$render();
                });
            });
        }
    }
})



  SeriesApp.directive('ckEditor', function () {
  return {
    require: '?ngModel',
    link: function (scope, elm, attr, ngModel) {
      var ck = CKEDITOR.replace(elm[0]);
      if (!ngModel) return;
      ck.on('instanceReady', function () {
        ck.setData(ngModel.$viewValue);
      });
      function updateModel() {
        scope.$apply(function () {
          ngModel.$setViewValue(ck.getData());
        });
      }
      ck.on('change', updateModel);
      ck.on('key', updateModel);
      ck.on('dataReady', updateModel);

      ngModel.$render = function (value) {
        ck.setData(ngModel.$viewValue);
      };
    }
  };
});

SeriesApp.directive('fileModel', ['$parse', function ($parse) {
    return {
    restrict: 'A',
    link: function(scope, element, attrs) {
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind('change', function(){
            scope.$apply(function(){
                modelSetter(scope, element[0].files[0]);
            });
        });
    }
   };
}]);

// We can write our own fileUpload service to reuse it in the controller
SeriesApp.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl, nombre_programa, descripcion_programa){
         var fd = new FormData();
         fd.append('file', file);
         fd.append('nombre_programa', nombre_programa);
         fd.append('descripcion_programa', descripcion_programa);

         $http.post(uploadUrl, fd, {
             transformRequest: angular.identity,
             headers: {'Content-Type': undefined,'Process-Data': false}
         })
         .success(function(){
            document.getElementById("cargando").style.display="none";
            toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
            window.location="/admin/postprogramas#/admin/postprogramas";

         })
         .error(function(){
            console.log("Success");
         });
     }
 }]);

SeriesApp.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});

SeriesApp.constant("base_api", "/api/v0");
SeriesApp.config(['$routeProvider', function ($routeProvider) {
$routeProvider.when("/admin/postpersonal", {redirectTo:"/admin/postpersonal"});

$routeProvider.when("/admin/postpersonal/create", {
        controller: "PersonalCtrl",
        templateUrl: "create-micomunidad"
    });

$routeProvider.when("/admin/postpersonal/deporteescolar", {
      controller: "PersonalDeporteCtrl",
      templateUrl: "create-deporteescolar"
  });

$routeProvider.when("/admin/postpersonal/caliacoge", {
      controller: "PersonalCaliacogeCtrl",
      templateUrl: "create-caliacoge"
  });

$routeProvider.when("/admin/postpersonal/calisedivierte", {
      controller: "PersonalCalisedivierteCtrl",
      templateUrl: "create-calisedivierte"
  });

$routeProvider.when("/admin/postpersonal/calintegra", {
      controller: "PersonalCalintegraCtrl",
      templateUrl: "create-calintegra"
  });

$routeProvider.when("/admin/postpersonal/canasyganas", {
      controller: "PersonalCanasyganasCtrl",
      templateUrl: "create-canasyganas"
  });

$routeProvider.when("/admin/postpersonal/carrerasycaminatas", {
      controller: "PersonalCarrerasycaminatasCtrl",
      templateUrl: "create-carrerasycaminatas"
  });

$routeProvider.when("/admin/postpersonal/cuerpoyespiritu", {
      controller: "PersonalCuerpoyespirituCtrl",
      templateUrl: "create-cuerpoyespiritu"
  });

$routeProvider.when("/admin/postpersonal/deporteasociado", {
      controller: "PersonalDeporteasociadoCtrl",
      templateUrl: "create-deporteasociado"
  });

$routeProvider.when("/admin/postpersonal/deportecomunitario", {
      controller: "PersonalDeportecomunitarioCtrl",
      templateUrl: "create-deportecomunitario"
  });

$routeProvider.when("/admin/postpersonal/vertigo", {
      controller: "PersonalVertigoCtrl",
      templateUrl: "create-vertigo"
  });

$routeProvider.when("/admin/postpersonal/viactiva", {
      controller: "PersonalViactivaCtrl",
      templateUrl: "create-viactiva"
  });

$routeProvider.when("/admin/postpersonal/viveelparque", {
      controller: "PersonalViveelparqueCtrl",
      templateUrl: "create-viveelparque"
  });


    $routeProvider.otherwise("/admin/postpersonal");

}]);




