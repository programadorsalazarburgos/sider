SeriesApp.controller('GruposReasignacionProgramaCrtl', function ($scope, $routeParams, $location, GrupoProgramaService, $http, $timeout, base_api) {


    $scope.title = "Grupos Reasignacion";
    $scope.series = [];
    
    
    
     $http.get(base_api + "/obtenerusuarios/all")
      .success(function(response){
    
        $scope.usuarios = response;
     
      });

    
    $scope.getData = function(){
      $http.get(base_api + "/admin/postgruposprogramas/consulta")
        .success(function(response){
          console.log(response);
        $scope.list = response;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter
        $scope.totalItems = $scope.list.length;
      });
    };
    
    $scope.pageSize = 50;
    
    
    $scope.setPage = function(pageNo) {
          $scope.currentPage = pageNo;
    
        };
        $scope.filter = function() {
            $timeout(function() {
                $scope.filteredItems = $scope.filtered.length;
            }, 10);
        };
        $scope.sort_by = function(predicate) {
            $scope.predicate = predicate;
            $scope.reverse = !$scope.reverse;
        };
    
    $scope.getData();
    $scope.series = GrupoProgramaService.query();
    
    
    $scope.selectedUsuario = function(usuario)
    {

        $http.get(base_api + "/admin/postgruposprogramas/consultausuario/" + usuario)
          .success(function(response){
            console.log(response);
          $scope.list = response;
          $scope.currentPage = 1; //current page
          $scope.entryLimit = 5; //max no of items to display in a page
          $scope.filteredItems = $scope.list.length; //Initially for no filter
          $scope.totalItems = $scope.list.length;
        });

    }
    
    
    $scope.ReasignacionUsuario = function(modalstate, id, nombre_grupo) {

        $scope.modalstate = modalstate;
        switch(modalstate) {
            case 'obtener':
            $scope.titulo = "REASIGNACIÓN USUARIO GRUPO";
            $scope.nombre_grupo = nombre_grupo;
            $scope.metodo = 1;
            $scope.valorID = id;
           
            break;
        }
        $('#myModal').modal('show');
        }
    

    $scope.formReasignacion = function(valorID)
    {

console.log($scope.usuariocambio);
        if($scope.usuariocambio == undefined)
        {
            swal("lo sentimos!", "Verifique que su campo usuario halla sido seleccionado!", "error");
            toastr.error("Verifique que su campo usuario halla sido seleccionado", "Campo Usuario");
          
        }
        else
        {
            $.ajax({
                url: base_api + '/reasignacion/grupoprograma/' + valorID,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    usuario: $scope.usuariocambio,
                    
                },
              
              }).success(function(response){
                  swal("Muy bien!", "Registro reasignado.", "success");
                  $scope.usuario = '';
                  $scope.getData();
              });
              
        }
    }
    
    });
    
    
    