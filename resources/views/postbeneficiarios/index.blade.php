<div ng-controller="BeneficiariosCrtl">
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
    <li class="active"><a href="#table-table-tab" data-toggle="tab">Información</a></li>
  </ul>
  <div id="tableactionTabContent" class="tab-content">
    <div id="table-table-tab" class="tab-pane fade in active">
      <div class="row">
        <div class="col-lg-12"><h4 class="box-heading">Paginación</h4>
          <div class="table-container">
            <div class="row mbm">
              <div class="col-lg-6">
                <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Beneficiarios
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <div class="portlet-body">
                <div class="actions">
                  <a href="{{url('items/export')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>          
                </div>
              </div>
              <div class="clearfix"></div>
              <br>
              <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
                <thead>
                  <th>CÓDIGO GRUPO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                  <th>FECHA INSCRIPCIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                  <th>No FICHA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                  <th>NOMBRES Y APELLIDOS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                  <th>MONITOR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                </thead>
                <tbody>
                  <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                    <td>@{{data.codigo_grupo | uppercase }} </td>
                    <td>@{{data.fecha_inscripcion | uppercase }} </td>
                    <td>@{{data.no_ficha | uppercase }} </td>
                    <td>@{{data.nombre_primero | uppercase }}  @{{data.apellido_primero | uppercase }}</td>
                    <td>@{{data.primer_nombre_usuario | uppercase }} @{{data.primer_apellido_usuario | uppercase }} </td>
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
      </div>
    </div>
  </div>
</div>

