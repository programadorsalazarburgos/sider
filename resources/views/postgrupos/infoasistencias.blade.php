<div ng-controller="InfoAsistenciaGrupoCtrl">
<div class="clearfix"></div><br>
<div class="row">
<div class="col-md-2">Lista:
<select ng-model="entryLimit" class="form-control" style="text-align: left;">
<option>5</option>
<option>10</option>
<option>20</option>
<option>50</option>
<option>100</option>
</select>
</div>
<div class="col-md-3">Busqueda:
<input type="text" ng-model="search" ng-change="filter()" placeholder="Buscar" class="form-control" />
</div>
<div class="col-md-4">
<h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Beneficiarios</h5>
</div>
</div>
<div class="clearfix"></div><br>
<div id="table-action" class="row">
<div class="col-lg-12">
<ul id="tableactiondTab" class="nav nav-tabs">
<li class="active"><a href="#table-table-tab" data-toggle="tab">INFORMACIÓN ASISTENCIA BENEFICIARIO</a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
<div id="table-table-tab" class="tab-pane fade in active">
<div class="row">
    <div class="col-lg-12">
    <h3 class="box-heading" align="center">INFORMACIÓN ASISTENCIA BENEFICIARIO</h3>
    <h5 class="box-heading">USUARIO: {{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</h5>
    <span class="label label-primary">CODIGO DE GRUPO: @{{nombre_grupo}}</span>
    <span class="label label-success">GRADO: @{{nombre_grado}}</span>
    <div class="clearfix"></div><br>
    <div class="table-container">
        <span class="label label-info">NOMBRE BENEFICIARIO: @{{nombre_primero}} @{{apellido_primero}}</span>
        <div class="row mbm">
        <div class="col-lg-6">
        </div>
        </div>
        <div class="table-responsive">
        <div class="portlet-body">
            <div class="actions">
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
        <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
            <thead>
            <th>FECHA ASISTENCIA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>OBSERVACIONES&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>   
            <th>ASISTENCIA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>

            </thead>
            <tbody>
            <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                <td>@{{data.fecha_asistencia}}</td>
                <td>
                <textarea class="form-control" disabled>@{{data.observaciones}}</textarea>
                </td>
                <td style="text-align: center;">
                <div ng-if="data.asistencia == 'ASISTIO'">
                    <span class="label label-default">@{{data.asistencia}}</span>
                </div>
                <div ng-if="data.asistencia == 'FALTO'">
                    <span class="label label-danger">@{{data.asistencia}}</span>
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

