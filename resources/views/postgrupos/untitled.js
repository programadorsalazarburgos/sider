$scope.onBlurDocumentoAcudiente = function($event) {
      
      var no_documento_acudiente = $scope.serie.documento_acudiente;

      $http.get(base_api + "/admin/postbeneficiarios/cargar/" + no_documento_acudiente)
        .success(function(response){

          
          if (response.length != 0) {

            swal("Registro Existente!", "Este registro ya existe puedes actualizarlo y se agregara a este grupo si lo deseas!", "success");

          $scope.serie = response[0];
          
          console.log($scope.serie);

          $scope.data_modalidad = {
            'id': 1,
            'unit': $scope.serie.modalidad_id
          }

          $scope.data_puntoatencion = {
            'id': 1,
            'unit': $scope.serie.puntoatencion_id
          }



        $scope.tipo_estrato = {
        'id': 1,
        'unit': $scope.serie.residencia_estrato
        }

         $scope.tipo_doc = {
        'id': 1,
        'unit': $scope.serie.id_documento_tipo
        }



        $scope.tipo_salud_otra = {

        'id': 1,
        'unit': $scope.serie.salud_sgss_id

        }

        console.log($scope.tipo_salud_otra);

        $scope.tipo_sex = {
        'id': 1,
        'unit': $scope.serie.sexo
        }



        $scope.tipo_sag = {
        'id': 1,
        'unit': $scope.serie.sangre_tipo
        }

        $scope.data_paises = {
        'id': 1,
        'unit': $scope.serie.id_procedencia_pais
        }

        $scope.datas = {
        'id': 1,
        'unit': $scope.serie.id_procedencia_departamento
        }

        $scope.data_municipio = {
              'id': 1,
              'unit': $scope.serie.id_procedencia_municipio
            }



      $http.get(base_api + "/obtener/comuna_barrio/" + $scope.serie.id_residencia_barrio)
        .success(function(responseComuna){

         
         $scope.tipo_com = {
          'id': 1,
          'unit': responseComuna[0].id
        }
      

      $http.get(base_api + "/obtener/barrios/" + responseComuna[0].id)
        .success(function(response){

        $scope.barrios = response;

      });


      $scope.tipo_barr = {
      'id': 1,
      'unit': $scope.serie.id_residencia_barrio
      }

   

      });


      $scope.data_corregimiento = {
      'id': 1,
      'unit': $scope.serie.id_residencia_corregimiento
      }
     


         $http.get(base_api + "/obtener/veredas/" + $scope.serie.id_residencia_corregimiento)
      .success(function(response){

        $scope.veredas = response;


      });



      $scope.data_vereda = {
          'id': 1,
          'unit': $scope.serie.id_residencia_vereda
        }


      $scope.tipo_est = {
        'id': 1,
        'unit': $scope.serie.id_estado_civil
        }



        $scope.tipo_hij = {
        'id': 1,
        'unit': $scope.serie.hijos_beneficiario
        }
        if ($scope.serie.hijos_beneficiario == 1) {
        $scope.isDisabled = false;
        }
        else{

        $scope.isDisabled = true;

      } 


      $scope.tipo_ocup = {
        'id': 1,
        'unit': $scope.serie.ocupacion_beneficiario
        }



      if ($scope.serie.ocupacion_beneficiario == 8) {
        $scope.isDisabledOcupacion = false;
      }
      else{

        $scope.isDisabledOcupacion = true;

      }

         $scope.tipo_esc = {
          'id': 1,
          'unit': $scope.serie.escolaridad_id
          }


        $scope.tipo_cult = {
        'id': 1,
        'unit': $scope.serie.cultura_beneficiario
        }

          if ($scope.serie.cultura_beneficiario == 10) {
        $scope.isDisabledCultura = false;
        }
        else{

          $scope.isDisabledCultura = true;

        }

        $http.get(base_api + "/obtener/poblacionalesDocumento/" + no_documento_beneficiario)
          .success(function(response){

            $scope.selectedPoblacionales = response;

          });

        $scope.tipo_salud = {
        'id': 1,
        'unit': $scope.serie.seguridad_social_beneficiario
        }

        if ($scope.serie.seguridad_social_beneficiario == 1) {
        $scope.isDisabledSeguridad = false;
        }
        else{

        $scope.isDisabledSeguridad = true;
        }

        $scope.tipo_disc = {
        'id': 1,
        'unit': $scope.serie.discapacidad_beneficiario
        }

        if ($scope.serie.discapacidad_beneficiario == 1) {
        $scope.isDisabledDiscapacidad = false;
        }
        else{

        $scope.isDisabledDiscapacidad = true;

        }

        $scope.tipo_disc_otra = {
        'id': 1,
        'unit': $scope.serie.discapacidad_id
        }

        console.log($scope.tipo_disc_otra);
        $scope.tipo_eferm = {
        'id': 1,
        'unit': $scope.serie.enfermedad_permanente_beneficiario
        }


        if ($scope.serie.enfermedad_permanente_beneficiario == 1) {
        $scope.isDisabledEnfermedad = false;
        }
        else{

        $scope.isDisabledEnfermedad = true;

        }


        $scope.tipo_medic = {
        'id': 1,
        'unit': $scope.serie.medicamentos_permanente_beneficiario
        }


        if ($scope.serie.medicamentos_permanente_beneficiario == 1) {
        $scope.isDisabledMedicamento = false;
        }
        else{

        $scope.isDisabledMedicamento = true;

        }

        $scope.tipo_doc_acudiente = {
        'id': 1,
        'unit': $scope.serie.tipodocacudiente
        }


        $scope.tipo_sex_acudiente = {
        'id': 1,
        'unit': $scope.serie.sexoacudiente
        }

        $scope.tipo_parent = {
        'id': 1,
        'unit': $scope.serie.parentesco_acudiente
        }

        if ($scope.serie.parentesco_acudiente == 6) {
        $scope.isDisabledParentesco = false;
        }
        else{

        $scope.isDisabledParentesco = true;
        }
        }

      });

      
    }
