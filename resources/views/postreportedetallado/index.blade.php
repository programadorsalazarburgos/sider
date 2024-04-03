<div ng-controller="BeneficiariosReporteDetalladoCrtl">
  <style>
  .table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-x: auto;
    overflow-y: hidden;

  }
</style>
<div class="clearfix"></div><br>
<div class="row">
  <div class="col-md-3">Busqueda:
    <input type="text" ng-model="search"  placeholder="Buscar" class="form-control" />
  </div>
  <div class="col-md-4">
    <label for="search">Items por pagina:</label>
    <input type="number" min="1" max="100" class="form-control" ng-model="pageSize">
  </div>
  <div class="col-md-5">
    <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Beneficiarios</h5>
  </div>
</div>
<div class="clearfix"></div><br>
<div id="table-action" class="row">
  <div class="col-lg-12">
    <ul id="tableactiondTab" class="nav nav-tabs">
      <li class="active"><a href="#table-table-tab" data-toggle="tab">Información Beneficiarios</a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
      <div id="table-table-tab" class="tab-pane fade in active">
        <div class="row">
          <div class="col-lg-12"><h4 class="box-heading" style="text-align:center;">Reporte Beneficiarios con Asistencias</h4>
            <div class="clearfix"></div><br>
            <div class="table-container">
              <div class="row mbm">
                <div class="col-lg-6">
                  <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Beneficiarios
                  </div>
                </div>
              </div>
              <div class="clearfix"></div><br>
              <form class="form-vertical" role="form" method="get" enctype="multipart/form-data" action="{{url('export/reportedetallado')}}">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <label for="user_firstname" style="color: black;">Tipo Documento:</label>
                    <select name="tipo_doc_persona" ng-model="tipo_doc_persona" style="position:  relative;top: -5px;"
                    ng-change="CargaBeneficiarios()" class="form-control ng-pristine ng-untouched ng-valid">
                    <option value="">Seleccione</option>
                    <option ng-repeat="tip_documento in tipo_documento" value="@{{ tip_documento.id }}">@{{ tip_documento.descripcion }}</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Fecha Inscripción  <span class="label label-primary">Entre</span></label>
                  <input ui-date="opts" class="form-control" name="entre" ng-change="CargaBeneficiarios()" ng-model="entre" readonly="" style="position:  relative; top: -5px;"></input>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Fecha Inscripción  <span class="label label-success">Hasta</span></label>
                  <input ui-date="opts" class="form-control" ng-change="CargaBeneficiarios()" name="hasta" ng-model="hasta" readonly="" style="position:  relative; top: -5px;"></input>
                </div>
              </div>
              <div class="clearfix"></div><br>
              <div class="col-md-12">
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Sexo:</label>
                  <select  ng-model="sexo_persona" name="sexo_persona" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione Sexo</option>
                    <option ng-repeat="sex in sexo" value="@{{ sex.id }}">@{{ sex.nombre }}</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Edad  <span class="label label-primary">Entre</span></label>
                  <input  class="form-control" name="entre_edad" ng-change="CargaBeneficiarios()" ng-model="entre_edad"  style="position:  relative; top: -5px;"></input>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Edad  <span class="label label-success">Hasta</span></label>
                  <input  class="form-control" ng-change="CargaBeneficiarios()" name="hasta_edad" ng-model="hasta_edad"  style="position:  relative; top: -5px;"></input>
                </div>
              </div>
              <div class="clearfix"></div><br>       
              <div class="col-md-12">
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Corregimiento:</label>
                  <select  ng-model="corregimiento" name="corregimiento" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione corregimiento</option>
                    <option ng-repeat="corregimiento in corregimientos" value="@{{ corregimiento.id }}">@{{ corregimiento.descripcion }}</option>
                  </select>
                </div>
                <div class="col-md-4" style="position:  relative;top: -6px;left:  34px;">
                  <label for="user_firstname" style="color: black; position:  relative;right:  31px !important;top: 4px;">Barrio:</label>
                  <select chosen class="form-control" name="barrio" ng-change="CargaBeneficiarios()"  id="barrio"  ng-model="barrio" ng-options="bar.id as bar.nombre_barrio for bar in barrios" ng-change='selectedBarrio(barrio)'>
                    <option value=''>Seleccione Barrio</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Comuna:</label>
                  <select  ng-model="comuna" name="comuna" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione comuna</option>
                    <option ng-repeat="comuna in comunas" value="@{{ comuna.id }}">@{{ comuna.nombre_comuna }}</option>
                  </select>
                </div>
              </div>
              <div class="clearfix"></div><br>
              <div class="col-md-12">
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Estrato:</label>
                  <select  ng-model="estrato" name="estrato" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione estrato</option>
                    <option ng-repeat="estrato in estratos" value="@{{ estrato.id }}">@{{ estrato.nombre }}</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Grado Escolaridad </label>        
                  <select  ng-model="escolaridad" name="escolaridad" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione grado</option>
                    <option ng-repeat="grado in grados" value="@{{ grado.id }}">@{{ grado.nombre_grado }}</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Etnia:</label>
                  <select  ng-model="etnia" name="etnia" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione etnia</option>
                    <option ng-repeat="etnia in etnias" value="@{{ etnia.id }}">@{{ etnia.descripcion }}</option>
                  </select>
                </div>
              </div>
              <div class="clearfix"></div><br>
              <div class="col-md-12">
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Discapacidad:</label>
                  <select  ng-model="discapacidad" name="discapacidad" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione discapacidad</option>
                    <option ng-repeat="discapacidad in discapacidadades" value="@{{ discapacidad.id }}">@{{ discapacidad.descripcion }}</option>
                  </select>
                </div>
                <div class="col-md-4" style="position:  relative;top: -6px;left:  34px;">
                  <label for="user_firstname" style="color: black; position:  relative;right:  31px !important;top: 4px;">Institución:</label>
                  <select chosen class="form-control" name="institucion" ng-change="CargaBeneficiarios()"  id="institucion"  ng-model="institucion" ng-options="institucion.id as institucion.nombre_institucion for institucion in instituciones">
                    <option value=''>Seleccione Institución</option>
                  </select>
                </div>
                <div class="col-md-4" style="position:  relative;top: -6px;left:  34px;">
                  <label for="user_firstname" style="color: black; position:  relative;right:  31px !important;top: 4px;">Sede:</label>
                  <select chosen class="form-control" name="sede" ng-change="CargaBeneficiarios()"  id="sede"  ng-model="sede" ng-options="sede.id as sede.nombre_sede for sede in sedes">
                    <option value=''>Seleccione Sede</option>
                  </select>
                </div>
              </div>
              <div class='col-sm-12'>
                <div class='form-group' style="position:  relative; top: 17px;">
                  <div class="table-responsive">
                    <div class="portlet-body">
                      <div class="actions">
                        <button type="submit" class="btn btn-success" style=""><i class="fa fa-file-excel-o" aria-hidden="true" ></i> Exportar</button>      
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
                      <thead>
                        <th>FORMADOR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>CÓDIGO GRUPO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>GRADO GRUPO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>INSTITUCION&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>SEDE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>ASISTENCIAS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>FALTAS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>TIPO DOCUMENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>No DOCUMENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>No FICHA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>FECHA INSCRIPCIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>      
                        <th>NOMBRES Y APELLIDOS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>CORREO ELECTRONICO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>SEXO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>FECHA NACIMIENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>PAIS PROCEDENCIA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>DEPARTAMENTO PROCEDENCIA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>MUNICIPIO PROCEDENCIA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>CORREGIMIENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>VEREDA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>BARRIO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>ESTRATO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>COMUNA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>DIRECCION&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>TELEFONO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>CELULAR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>NIVEL ESCOLARIDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>ESTADO ESCOLARIDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>OCUPACION ACTUAL&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>ESTADO CIVIL&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>HIJOS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>CANTIDAD HIJOS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>ETNIA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>GRUPO POBLACIONAL&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>ENFERMEDAD PERMANENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>CUAL ENFERMEDAD PERMANENTE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>TOMA MEDICAMENTOS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>MEDICAMENTOS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>TIPO SANGRE&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                      </thead>
                      <tbody id="tablabeneficiarios">
                        <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                          <td>@{{data.primer_nombre_formador | uppercase }} @{{data.primer_apellido_formador | uppercase }} </td>
                          <td>@{{data.codigo_grupo | uppercase }} </td>
                          <td>@{{data.nombre_grado | uppercase }} </td>
                          <td>@{{data.nombre_institucion | uppercase }} </td>
                          <td>@{{data.nombre_sede | uppercase }} </td>
                          <td>@{{data.asistencias}} </td>
                          <td>@{{data.inasistencias}} </td>
                          <td>@{{data.tipo_documento | uppercase }} </td>
                          <td>@{{data.documento | uppercase }} </td>
                          <td>@{{data.no_ficha | uppercase }} </td>
                          <td>@{{data.fecha_inscripcion | uppercase }} </td>
                          <td>@{{data.nombre_primero | uppercase }}  @{{data.apellido_primero | uppercase }}</td>
                          <td>@{{data.correo_electronico}} </td>
                          <td>@{{data.sexo | uppercase }} </td>
                          <td>@{{data.fecha_nacimiento | uppercase }} </td>
                          <td>@{{data.pais_procedencia | uppercase }} </td>
                          <td>@{{data.departamento_procedencia | uppercase }} </td>
                          <td>@{{data.municipio_procedencia | uppercase }} </td>
                          <td>@{{data.nombre_corregimiento | uppercase }} </td>
                          <td>@{{data.nombre_vereda | uppercase }} </td>
                          <td>@{{data.nombre_barrio | uppercase }} </td>
                          <td>@{{data.residencia_estrato | uppercase }} </td>
                          <td>@{{data.nombre_comuna | uppercase }} </td>
                          <td>@{{data.residencia_direccion | uppercase }} </td>
                          <td>@{{data.telefono_fijo | uppercase }} </td>
                          <td>@{{data.telefono_movil | uppercase }} </td>
                          <td>@{{data.nivel_escolaridad | uppercase }} </td>
                          <td>@{{data.estado_escolaridad | uppercase }} </td>
                          <td>@{{data.ocupacion_beneficiario | uppercase }} </td>
                          <td>@{{data.estado_civil | uppercase }} </td>
                          <td>@{{data.hijos_beneficiario | uppercase }} </td>
                          <td>@{{data.cantidad_hijos_beneficiario | uppercase }} </td>
                          <td>@{{data.etnia_beneficiario | uppercase }} </td>
                          <td>@{{data.poblacional}} </td>
                          <td>@{{data.enfermedad_permanente | uppercase }} </td>
                          <td>@{{data.otra_discapacidad_beneficiario | uppercase }} </td>
                          <td>@{{data.toma_medicamentos | uppercase }} </td>
                          <td>@{{data.medicamentos_beneficiario | uppercase }} </td>
                          <td>@{{data.sangre_tipo}} </td>
                        </tr>
                      </tbody>
                    </table>   
                    <div class="col-md-12" ng-show="filteredItems == 0">
                      <div class="col-md-12">
                        <h4>No se encontraron resultados</h4>
                      </div>
                    </div>
                    <dir-pagination-controls></dir-pagination-controls>
                  </div>
                </div>
              </div>
            </form>
            <div class='row'>
              <div class='col-sm-4'>    
                <div class='form-group'>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

