<div ng-controller="GruposCrtl">
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
                @if(auth()->user()->can('crear-grupos'))
                <a ng-href="/admin/postgrupos#/admin/postgrupos/create" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                @endif
                <div class="clearfix"></div><br>
                <form class="form-vertical" role="form" method="get" action="{{url('items/export2')}}">
                  <div class='row'>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Grupo</label>
                        <select name="grupo" ng-model="grupo" required class="form-control">
                          <option value="">Seleccione</option>
                          <option ng-repeat="grupo in grupos_monitores" value="@{{ grupo.id }}">@{{ grupo.codigo_grupo }}</option>
                        </select>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Fecha Busqueda</label>
                        <input type="text" required  class="form-control" name="fechaExport" id="fechaExport-2" >
                        <span class="label label-danger" ng-show="frm.telefono_movil_acudiente.$dirty && frm.telefono_movil_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_lastname"></label>
                        <button type="submit" class="btn btn-success" style="position: relative; top: 22px;">Exportar Asistencia</button>          
                        <span class="label label-danger" ng-show="frm.correo_acudiente.$dirty && frm.correo_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div class="clearfix"></div>
            <br>
            <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
              <thead>
                <th>Código Grupo&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th>Grado&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th>Institución&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th>Sede&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th>Observaciones&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th>Estado&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                <th style="width:100px;"></th>
                <th style="width:100px;"></th>
              </thead>
              <tbody>
                <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">  
                  <td>@{{data.codigo_grupo | uppercase }} </td>
                  <td>@{{data.nombre_grado | uppercase }} </td>
                  <td>@{{data.nombre_institucion | uppercase }} </td>
                  <td>@{{data.nombre_sede | uppercase }} </td>
                  <td>@{{data.observaciones | uppercase }} </td>
                  <td ng-if="data.estado == '0'" style="text-align: center;"><span class="label label-primary">Activo</span> </td>         
                  <td ng-if="data.estado == '1'" style="text-align: center;"><span class="label label-warning">Inactivo</span> </td>       
                  <td>
                    <div class="btn-group pull-center">
                      <a ng-href="/admin/postgrupos#/admin/postgrupos/asistencia/@{{data.id}}" class="btn btn-primary">Asistencia </a>
                    </div>
                  </td>  
                  <td>
                    <div ng-if="data.estado == '0'">                
                      <div class="btn-group pull-right">
                        <button type="button" style="background-color: #73c8ff; color: white;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu">             
                          <li>
                              @if(auth()->user()->can('editar-grupos'))
                            <a ng-href="/admin/postgrupos#/admin/postgrupos/editando/@{{data.id}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar Grupo</a>
                              @endif
                          </li>
                          <li>
                            <a ng-href="/admin/postgrupos#/admin/postgrupos/misbeneficiarios/@{{data.id}}"><i class="fa fa-search-plus"></i>&nbsp;Ver mis Beneficiarios</a>
                          </li>
                          <li>
                              @if(auth()->user()->can('crear-beneficiarios'))
                            <a ng-href="/admin/postgrupos#/admin/postgrupos/beneficiarios/@{{data.id}}"><i class="fa fa-plus-square"></i>&nbsp;Crear Beneficiarios</a>
                            @endif
                          </li>

                          <li>
                            @if(auth()->user()->can('inactivar-grupo'))
                            <a ng-click="inactivar(data.id)"><i class="fa fa-chevron-circle-down"></i>&nbsp;Inactivar Grupo</a>
                            @endif
                          </li>
                          <li>
                              @if(auth()->user()->can('eliminar-grupos'))
                            <a ng-click="eliminar(data.id)"><i class="fa fa-trash-o"></i>&nbsp;Eliminar Grupo</a>
                              @endif
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div ng-if="data.estado == '1'">                
                      <div class="btn-group pull-right">
                        <button type="button" style="background-color: #fbb300; color: white;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu">             

                          <li>
                            <a ng-href="/admin/postgrupos#/admin/postgrupos/misbeneficiarios/@{{data.id}}"><i class="fa fa-search-plus"></i>&nbsp;Ver mis Beneficiarios</a>
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
            <div class="col-md-12" ng-show="filteredItems == 0">
              <div class="col-md-12">
                <h4>No se encontraron resultados</h4>
              </div>
            </div>
            <div class="col-md-12" ng-show="filteredItems > 0">
                <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
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
