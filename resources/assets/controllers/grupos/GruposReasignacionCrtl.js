SeriesApp.controller('GruposReasignacionCrtl', function ($scope, $routeParams, $location, GrupoService, $http, $timeout, base_api) {


    $scope.title = "Grupos Reasignacion";
    $scope.series = [];
    
    
    
     $http.get(base_api + "/obtenerusuarios/all")
      .success(function(response){
    
        $scope.usuarios = response;
     
      });
    
    
    $scope.getData = function(){
      $http.get(base_api + "/admin/postgrupos/consulta")
        .success(function(response){
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
    $scope.series = GrupoService.query();
    
    
    $scope.selectedUsuario = function(usuario)
    {

        $http.get(base_api + "/admin/postgrupos/consultausuario/" + usuario)
          .success(function(response){
          $scope.list = response;
          $scope.currentPage = 1; //current page
          $scope.entryLimit = 5; //max no of items to display in a page
          $scope.filteredItems = $scope.list.length; //Initially for no filter
          $scope.totalItems = $scope.list.length;
        });

    }
    
    
    $scope.ReasignacionUsuario = function(modalstate, id, codigo_grupo) {

        $scope.modalstate = modalstate;
        switch(modalstate) {
            case 'obtener':
            $scope.titulo = "REASIGNACIÓN USUARIO GRUPO";
            $scope.codigo_grupo = codigo_grupo;
            $scope.metodo = 1;
            $scope.valorID = id;
           
            break;
        }
        $('#myModal').modal('show');
        }
    

    $scope.formReasignacion = function(valorID)
    {

        if($scope.usuariocambio == undefined)
        {
            swal("lo sentimos!", "Verifique que su campo usuario halla sido seleccionado!", "error");
            toastr.error("Verifique que su campo usuario halla sido seleccionado", "Campo Usuario");
          
        }
        else
        {
            $.ajax({
                url: base_api + '/reasignacion/grupo/' + valorID,
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
    
    
    