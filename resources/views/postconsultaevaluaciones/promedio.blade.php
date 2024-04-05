<div ng-controller="ConsultaEvaluacionesPromedioGrupoCtrl">
    <div class="clearfix"></div><br>
 <style>
        .container {
            margin-top: 40px;
            width: 970px !important;
        }
        #chartContainer {
            margin-top: 30px;
            height: 500px; 
            width: 100%;
        }
    </style>
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
   <li class="active"><a href="#table-table-tab" data-toggle="tab">Información</a></li>
</ul>

<div id="tableactionTabContent" class="tab-content">
<div id="table-table-tab" class="tab-pane fade in active">
 <div class="row">
  <div class="col-lg-12"><h5 class="box-heading">USUARIO: {{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</h5>
    <span class="label label-primary">CODIGO DE GRUPO: @{{nombre_grupo}}</span>
    <span class="label label-success">GRADO: @{{nombre_grado}}</span>

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

        {{--        <a href="{{url('items/export_misbeneficiario')}}/@{{no_grupo}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
         --}}  
           </div>

         </div>


 <div class="clearfix"></div>
    <br>
      <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">

            <thead>

            <th>NOMBRES Y APELLIDOS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
         
            <th style="width:100px;"></th>
            <th style="width:100px;"></th>
            <th style="width:100px;"></th>
            </thead>
            <tbody>
                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>@{{data.nombre_primero | uppercase }}  @{{data.apellido_primero | uppercase }}</td>
                    <td>        
                      <div style="text-align: center;">
                        <a class="btn btn-warning" ng-click="EvaluacionPromedio('promedio', data.id)"><i class="fas fa-chart-line"></i>&nbsp;Promedio Evaluaciones</a>
                      </div>
                    </td>
                    <td>        
                      <div style="text-align: center;">
                        <a class="btn btn-primary" ng-click="EvaluacionPromedioGrafico('promedio', data.id)"><i class="fas fa-chart-bar"></i>&nbsp;Gráfico Promedio</a>
                      </div>
                    </td>
                  <td>
                    <div class="btn-group pull-right">  
                     <a href="{{url('items/exportpromedio')}}/@{{data.id}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
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

    
<!-- show modal  -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <div class="card wizard-card ct-wizard-orange" id="wizardProfile">
        <form method="POST" id="f1" name="frm" class="form-modal" enctype="multipart/form-data">
          
         <div class="tab-content">
           
<div ng-if="promedio == '2'">

<div class="container">
        <div class="row">
            <div class="col-xs-8">
                <ul class="nav nav-tabs" mc-toggle-active>
                    <li class="active"><a href="" ng-click="changeChartType('bar')">Barras</a></li>
                    <li><a href="" ng-click="changeChartType('line')">Line</a></li>
                    <li><a href="" ng-click="changeChartType('area')">Area</a></li>
                    <li><a href="" ng-click="changeChartType('pie')">Pie</a></li>
             
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div id="chartContainer"></div>
            </div>
        </div>

    </div>
</div>

<div ng-if="promedio == '1'">
  <div class="wizard-header">
            <h3>
             <b>PROMEDIO EVALUACIONES</b> BENEFICIARIO <br>
            </h3>
         </div>
           <div class='row'>

            <div class='col-sm-4'>
              <div class='form-group'>
                <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()" style="position: relative; left: 154px;">
            <thead>
            <th>CRITERIO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th style="width:100px;">PROMEDIO</th>
            </thead>
            <tbody>
                <tr ng-repeat="data in serie">
                    <td>@{{data.nombre_criterio | uppercase }}</td>
                    <td>@{{data.promedio | uppercase }}</td>
                 </tr>
              </tbody>
            </table>    
            </div>
            </div>
            <div class="clearfix"></div><br>
           
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

