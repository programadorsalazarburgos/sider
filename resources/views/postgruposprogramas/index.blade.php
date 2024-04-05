<div ng-controller="GruposProgramasCrtl">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
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
<h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Grupos</h5>
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
          <h3 class="box-heading" align="center">LISTAR Y CREAR GRUPOS</h3>
        <h5 class="box-heading">USUARIO: {{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</h5>
        <div class="table-container">
          <div class="row mbm">
            <div class="col-lg-6">
              <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Grupos
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <!--Inicia Boton Nuevo -->
            <div class="portlet-body">
              <div class="actions">
                @if(auth()->user()->can('crear-grupo'))
                <a ng-href="/admin/postgruposprogramas#/admin/postgruposprogramas/create" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                @endif
                <div class="clearfix"></div><br>
                <form class="form-vertical" role="form" method="get" action="{{url('items/asistenciaprogramas')}}">
                  <div class='row'>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Grupo</label>
                        <select name="grupo" ng-model="grupo" required class="form-control">
                          <option value="">Seleccione</option>
                          <option ng-repeat="grupo in grupos_monitores" value="@{{ grupo.id }}">@{{ grupo.nombre_grupo }}</option>
                        </select>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Fecha Busqueda</label>
                        <input type="text" required  class="form-control" name="fechaExport" id="fechaExport-2">
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_lastname"></label>
                        <button type="submit" class="btn btn-success" style="position: relative; top: 22px;">Exportar Asistencia</button>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-12" style="padding-bottom: 60px;">
            <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
              <thead>
                <th>Nombre Grupo&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th>Nombre Lugar&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th>Nombre Disciplina&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th>Observaciones&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th>Estado&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th style="width:100px;"></th>
                <th style="width:100px;"></th>
              </thead>
              <tbody>
                <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                  <td>@{{data.nombre_grupo | uppercase }} </td>
                  <td>@{{data.nombre_lugar | uppercase }} </td>
                  <td>@{{data.nombre_disciplina | uppercase }} </td>
                  <td>@{{data.observaciones | uppercase }}</td>

                  <td ng-if="data.estado == '0'" style="text-align: center;"><span class="label label-primary">Activo</span> </td>
                  <td ng-if="data.estado == '1'" style="text-align: center;"><span class="label label-warning">Inactivo</span> </td>
                  <td>
                    <div class="btn-group pull-center">
                      <a ng-href="/admin/postgruposprogramas#/admin/postgruposprogramas/asistencia/@{{data.id}}" class="btn btn-primary">Asistencia </a>
                    </div>
                  </td>
                  <td>

                    <div ng-if="data.estado == '0'">
                      <div class="btn-group pull-right">
                        <button type="button" style="background-color: #73c8ff; color: white;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu">
                          <li>
                              @if(auth()->user()->can('editar-grupo'))
                            <a ng-href="/admin/postgruposprogramas#/admin/postgruposprogramas/editando/@{{data.id}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar Grupo</a>
                              @endif
                          </li>
                          <li>
                            <a ng-href="/admin/postgruposprogramas#/admin/postgruposprogramas/misbeneficiarios/@{{data.id}}"><i class="fa fa-search-plus"></i>&nbsp;Ver mis Beneficiarios</a>
                          </li>
                          <li>
                            @if(auth()->user()->can('crear-beneficiarios') && Auth::user()->tenantId != "1177624100" && Auth::user()->tenantId != "3365342001" && Auth::user()->tenantId != "2871155601")
                            <a ng-href="/admin/postgruposprogramas#/admin/postgruposprogramas/beneficiarios/@{{data.id}}"><i class="fa fa-plus-square"></i>&nbsp;Crear Beneficiarios</a>
                            @endif
                          </li>
                          <li>
                            @if(auth()->user()->can('crear-beneficiarios') && Auth::user()->tenantId == "1177624100" || Auth::user()->tenantId == "3365342001" || Auth::user()->tenantId == "2871155601")
                            <a ng-href="/admin/postgruposprogramas#/admin/postgruposprogramas/beneficiariosprogramas/@{{data.id}}"><i class="fa fa-plus-square"></i>&nbsp;Crear Beneficiarios</a>
                            @endif
                          </li>
                          <li>
                            @if(auth()->user()->can('inactivar-grupo'))
                            <a ng-click="inactivar(data.id)"><i class="fa fa-chevron-circle-down"></i>&nbsp;Inactivar Grupo</a>
                            @endif
                          </li>
                           <!-- <li>
                            <a ng-click="eliminar(data.id)"><i class="fa fa-trash-o"></i>&nbsp;Eliminar Grupo</a>

                          </li> -->
                        </ul>
                      </div>
                    </div>
                    <div ng-if="data.estado == '1'">
                      <div class="btn-group pull-right">
                        <button type="button" style="background-color: #fbb300; color: white;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu">
                          <li>
                            <a ng-href="/admin/postgruposprogramas#/admin/postgruposprogramas/misbeneficiarios/@{{data.id}}"><i class="fa fa-search-plus"></i>&nbsp;Ver mis Beneficiarios</a>
                          </li>
                          <li>
                            @if(auth()->user()->can('activar-grupo'))
                            <a ng-click="activar(data.id)"><i class="fa fa-chevron-circle-down"></i>&nbsp;Activar Grupo</a>
                            @endif
                          </li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            </div>
            <div class="col-md-12" ng-show="filteredItems == 0">
              <div class="col-md-12">
                <h4>No se encontraron resultados</h4>
              </div>
            </div>
            <div class="col-md-12" ng-show="filteredItems > 0" style="padding: 30px;">
                <dir-pagination-controls></dir-pagination-controls>
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
