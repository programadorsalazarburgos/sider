<div ng-controller="MisBeneficiariosGrupoConsultaProgramaCtrl">
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
<li class="active"><a href="#table-table-tab" data-toggle="tab">Información Estudiantes</a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
<div id="table-table-tab" class="tab-pane fade in active">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="box-heading" align="center">INFORMACIÓN BENEFICIARIOS</h3>
      <h5 class="box-heading">USUARIO: {{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</h5>
      <span class="label label-primary">NOMBRE GRUPO: @{{nombre_grupo}}</span>
      <div class="clearfix"></div><br>
      <div class="table-container">
        <div class="row mbm">
          <div class="col-lg-6">
            <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Beneficiarios
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <div class="portlet-body">
          </div>
          <div class="clearfix"></div>
          <br>
          <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
            <thead>
              <th>NOMBRES Y APELLIDOS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
              <th>FECHA INSCRIPCIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
              <th>No FICHA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>   
              <th>ASISTENCIAS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
              <th>FALTAS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
              <th>INASISTENCIA ESCOLAR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            </thead>
            <tbody>
                <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                <td>@{{data.nombre_primero | uppercase }}  @{{data.apellido_primero | uppercase }}</td>
                <td>@{{data.fecha_inscripcion | uppercase }} </td>
                <td>@{{data.no_ficha | uppercase }} </td>
                <td>@{{data.asistencia | uppercase }} </td>
                <td>@{{data.inasistencias | uppercase }} </td>
                <td>        
                  <div style="text-align: center;">
                    <a ng-href="/admin/postgruposprogramas#/admin/postgruposprogramas/infoasistencias/@{{data.id}}/grupo/@{{data.grupo_beneficiario}}" class="btn btn-primary">Info Fechas Asistencias </a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-12">
              <h4>No se encontraron resultados</h4>
            </div>
          </div>
          <dir-pagination-controls></dir-pagination-controls>
          <!-- show modal  -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <div class="card wizard-card ct-wizard-orange" id="wizardProfile">
                  <form method="POST" id="f1" name="frm" class="form-modal" enctype="multipart/form-data">
                    <div class="wizard-header">
                      <h3>
                        <b>CAMBIAR BENEFICIARIO</b> GRUPO <br>
                        <small>@{{ form_contenido }}.</small>
                      </h3>
                    </div>
                    <div class="tab-content">
                      <div class='row'>
                        <div class='col-sm-4'>
                          <div class='form-group'>
                            <label for="user_firstname">Grupo</label>
                            <select name="grupo" ng-model="grupo" class="form-control" required style="width: 250px;">
                              <option value="">Seleccione 
                              Grupo</option>
                              <option ng-repeat="grupo in grupos" value="@{{ grupo.id }}">@{{ grupo.codigo_grupo }}</option>
                            </select>
                            <span class="label label-danger" ng-show="frm.grupo.$dirty && frm.grupo.$error.required">Requerido</span>
                          </div>
                        </div>
                        <div class="clearfix"></div><br>
                        <div align="center">
                          <button type="submit" class="btn btn-success" ng-click="formCambiar(frm.$valid, id)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Cambiar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="wizard-footer">
                    <div class="pull-right">
                      <button type="button"  class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </form>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>

