<div ng-controller="LugaresCrtl">
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
        <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Lugares de Atención</h5>
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
     <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Lugares de Atención
     </div>
   </div>

</div>

<div class="table-responsive">
<!--Inicia Boton Nuevo -->
<div class="portlet-body">
   <div class="actions">
       <a ng-href="/admin/postlugares#/admin/postlugares/create" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
   </div>
</div>
 <div class="clearfix"></div>
    <br>
      <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
            <thead>
            <th>NOMBRE LUGAR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>            
            <th>BARRIO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>COMUNA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>CORREGIMIENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>VEREDA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>DIRECCIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>OBSERVACIONES&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>TIPO PUNTO ATENCIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>ESTADO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th style="width:100px;"></th>
            </thead>
            <tbody>
            <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                    <td>@{{data.nombre_lugar | uppercase }} </td>
                    <td>@{{data.nombre_barrio | uppercase }} </td>
                    <td>@{{data.nombre_comuna | uppercase }} </td>
                    <td>@{{data.corregimiento | uppercase }} </td>
                    <td>@{{data.vereda | uppercase }} </td>
                    <td>@{{data.direccion | uppercase }} </td>
                    <td>@{{data.observaciones | uppercase }} </td>
                    <td>@{{data.tipo_punto_atencion | uppercase }} </td>
                     <td ng-if="data.estado == '0'" style="text-align: center;"><span class="label label-primary">Activo</span> </td>         
                     <td ng-if="data.estado == '1'" style="text-align: center;"><span class="label label-warning">Inactivo</span> </td>       
                     <td>
                                              
      <div class="btn-group pull-right">
         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
             <ul class="dropdown-menu">
                 
                 <li>
                    <a ng-href="/admin/postlugares#/admin/postlugares/editando/@{{data.id}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>
                 </li>
                 
                 <li ng-if="data.estado == '0'">
                   <a ng-click="inactivar(data.id)"><i class="fas fa-adjust"></i>&nbsp;Inactivar</a>
                 </li>
                  <li ng-if="data.estado == '1'">
                   <a ng-click="activar(data.id)"><i class="fa fa-adn"></i>&nbsp;Activar</a>
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
