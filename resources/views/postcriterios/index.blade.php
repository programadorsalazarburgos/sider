<div ng-controller="CriteriosCrtl">

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
        <div class="col-lg-12"><h5 class="box-heading">USUARIO: {{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</h5>


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
        <div class="clearfix"></div><br>
          
        
 <div class="clearfix"></div>
    <br>
      <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">

            <thead>

            <th>Código Grupo&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Grado&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Institución&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Sede&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Observaciones&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th style="width:240px;"></th>
            </thead>
            <tbody>
               <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">              
                    <td>@{{data.codigo_grupo | uppercase }} </td>
                    <td>@{{data.nombre_grado | uppercase }} </td>
                    <td>@{{data.nombre_institucion | uppercase }} </td>
                    <td>@{{data.nombre_sede | uppercase }} </td>
                    <td>@{{data.observaciones | uppercase }} </td>
  

               <td>
          
      <div class="btn-group pull-right">
         <a type="button" ng-href="/admin/postcriterios#/admin/postcriterios/criterios/@{{data.id}}" style="color: white;" class="btn btn-warning"> <i class="fa fa-plus-circle"></i>&nbsp; Criterios</a>
         <a type="button" ng-href="/admin/postcriterios#/admin/postcriterios/evaluacion/@{{data.id}}" style="color: white;" class="btn btn-success"> <i class="fa fa-plus-circle"></i>&nbsp; Evaluación</a>
                       
    </div>
    <div ng-if="data.estado == '1'">                
      <div class="btn-group pull-right">
         <button type="button" style="background-color: #fbb300; color: white;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
             <ul class="dropdown-menu">             
                
                 <li>
                    <a ng-href="/admin/postgrupos#/admin/postgrupos/misbeneficiarios/@{{data.id}}"><i class="fa fa-search-plus"></i>&nbsp;Ver mis Beneficiarios</a>
                 </li>
                
                 <li>
                   <a ng-click="activar(data.id)"><i class="fa fa-chevron-circle-down"></i>&nbsp;Activar Grupo</a>
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
