<div ng-controller="GruposConsultaProgramaAsistenciaCrtl">
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
        <div class="col-lg-12">
          <h3 class="box-heading" align="center">CONSULTA ASISTENCIAS</h3>
          <h5 class="box-heading">USUARIO: {{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</h5>
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
                <div class="actions">
                  <a href="{{url('items/export_asistencias_programas')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                </div>
              </div>
              <div class="clearfix"></div>
              <br>
              <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
                <tr>
                  <th COLSPAN=4>DATOS GRUPO</th>
                  <th COLSPAN=3>DATOS BENEFICIARIO</th>
                  <th COLSPAN=2>ASISTENCIAS</th>
                  <th COLSPAN=1>FECHAS ASISTENCIAS</th>
                </tr>
                <tr>
                  <th>NOMBRE GRUPO</th> 
                  <th>LUGAR ATENCIÓN</th> 
                  <th>DISCIPLINA</th> 
                  <th>FORMADOR</th> 
                  <th>NO FICHA</th> 
                  <th>DOCUMENTO</th> 
                  <th>NOMBRE BENEFICIARIO</th> 
                  <th>ASISTENCIAS</th> 
                  <th>FALTAS</th> 
                  <th style="width:100px;"></th>
                </tr>
                <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                  <td>@{{data.nombre_grupo | uppercase }} </td> 
                  <td>@{{data.nombre_lugar | uppercase }} </td>
                  <td>@{{data.nombre_disciplina | uppercase }} </td>               
                  <td>@{{data.primer_nombre | uppercase }} @{{data.primer_apellido | uppercase }}</td>
                  <td>@{{data.no_ficha | uppercase }} </td>
                  <td>@{{data.documento | uppercase }}</td> 
                  <td>@{{data.nombre_primero | uppercase }}  @{{data.apellido_primero | uppercase }}</td>
                  <td>@{{data.asistencia | uppercase }} </td>
                  <td>@{{data.inasistencias | uppercase }} </td>
                  <td>        
                    <div style="text-align: center;">
                      <a ng-href="/admin/postgruposprogramas#/admin/postgruposprogramas/infoasistencias/@{{data.id}}/grupo/@{{data.grupo_beneficiario}}" class="btn btn-primary">Fechas</a>
                    </div>
                  </td>
                </tr>
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

