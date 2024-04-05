'use strict';
// Declare app level module which depends on views, and components
var SeriesApp = angular.module('SeriesApp', ['ui.bootstrap', 'ngRoute', 'ngResource', 'ngCkeditor','truncate', 'ngMessages']).constant('API_URL');




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
    $routeProvider.when("/admin/postproductos", {redirectTo:"/admin/postproductos"});

    $routeProvider.when("/admin/postproductos", {
        controller: "ProductoCrtl",
        templateUrl: "index-productos"
    });



//     $routeProvider.when("/admin/postsedes/create", {
//         controller: "CreateSedeCtrl",
//         templateUrl: "create-sedes"
//     });


// $routeProvider.when("/admin/postsedes/editando/:id", {
//         controller: "EditarSedeCtrl",
//         templateUrl: "editar-sedes"
//     });



    $routeProvider.otherwise("/admin/postproductos");
}]);





