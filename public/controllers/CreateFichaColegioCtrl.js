SeriesApp.controller("CreateFichaColegioCtrl", function($scope, GrupoService, fileUpload, $http, $location, base_api, $q){
  $scope.title = "Agregar Ficha Colegio";
  $scope.disable_submit = false;

  $scope.serie = {};


$scope.disabled = undefined;

$scope.enable = function() {
  $scope.disabled = false;
};

$scope.disable = function() {
  $scope.disabled = true;
};

$scope.clear = function() {
  $scope.person.selected = undefined;
  $scope.address.selected = undefined;
  $scope.country.selected = undefined;
};

$scope.person = {};

$http.get(base_api + "/obtener/tipoequipamientos")
.success(function(response){


  $scope.tipoequipamientos = response;


});



$http.get(base_api + "/obtenerselect/sedes")
.success(function(response){

  $scope.people = response;
 
});


$scope.address = {};
$scope.refreshAddresses = function(address) {
  var params = {address: address, sensor: false};
  return $http.get(
    'http://maps.googleapis.com/maps/api/geocode/json',
    {params: params}
  ).then(function(response) {
    $scope.addresses = response.data.results
  });
};

$scope.addItem = function() {
  $scope.items.push({id: $scope.items.length, text: 'item '+$scope.items.length});
};

$scope.removeItem = function() {
  $scope.items.pop();
};  

$scope.changeItems = function() {
  //$scope.items[0].id = 123;
  $scope.items[0].text = 'item 123';
  $scope.items1[0] = 'item 123';
};    

$scope.reorder = function() {
  var t = $scope.items[2];
  $scope.items[2] = $scope.items[3];
  $scope.items[3] = t;
};

$scope.check = function() {
  $scope.user.values1 = [1,4];
};


$scope.time1 = new Date();
      
      $scope.time2 = new Date();
      $scope.time2.setHours(7, 30);
      $scope.showMeridian = true;
      
      $scope.disabled = false;





$scope.selectedSede = function()
{

  var obt_sede = $scope.person.id;  
  var sede = obt_sede['id'];

  $http.get(base_api + "/obtener/equipamientos/" + sede)
    .success(function(response){
    $scope.list = response;
    console.log($scope.list);
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 5; //max no of items to display in a page
    $scope.filteredItems = $scope.list.length; //Initially for no filter
    $scope.totalItems = $scope.list.length;

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

  });

}



$scope.formsubmit = function(isValid) {     
  
      var obt_sede = $scope.person.id;  
      var sede = obt_sede['id'];
      var equipamiento = $scope.tipoequipamiento;
      var cantidad = $scope.cantidad;

      if($scope.content == 'agregar')
      {
        $scope.cantidadEliminar = null;
      }
      else if($scope.content == 'quitar')
      {
        $scope.cantidadAgregar = null;
      }
      
      $.ajax({
        url: base_api + '/fichacolegio/create',
        type: 'POST',
        dataType: 'JSON',
        data: {
          sede: sede, 
          equipamiento:equipamiento, 
          cantidadAgregar:$scope.cantidadAgregar,
          cantidadEliminar:$scope.cantidadEliminar
        },
      })
      .success(function() {
    
        toastr.success("Su registro ha sido exitoso", "Registro Almacenado");
        
        
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        $scope.selectedSede();
        console.log("complete");
      });

  }
}); 







    


         

      






