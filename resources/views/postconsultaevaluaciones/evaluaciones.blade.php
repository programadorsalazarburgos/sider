
<div ng-controller="ConsultaEvaluacionesTotalGrupoCtrl">
 <style>
        .code {
            height: 80px !important;
        }

        textarea.ng-invalid.ng-dirty{border:1px solid red;}
        select.ng-invalid.ng-dirty{border:1px solid red;}
        option.ng-invalid.ng-dirty{border:1px solid red;}
        input.ng-invalid.ng-dirty{border:1px solid red;}

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
      <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Evaluaciones</h5>
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
              <div class="pagination-panel"><h5 class="box-heading">MONITOR: {{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }} 
                </h5> 
                <span class="label label-primary">CODIGO DE GRUPO: @{{nombre_grupo}}</span>
                <span class="label label-success">GRADO: @{{nombre_grado}}</span>
                <div class="clearfix"></div><br>
               </div>
             <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Evaluaciones
             </div>
           </div>
         </div>

     <div class="table-responsive">
          <div class="portlet-body">
           <div class="actions">
               <a href="{{url('items/export_evaluacion')}}/@{{no_grupo}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>          
           </div>
         </div>
 


{{--  <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter">
      <thead>
        <tr ng-repeat="item in list | limitTo:1">
          <th ng-repeat="(key, val) in item">
            @{{key}}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="item in list">
          <td ng-repeat="(key, val) in item">
            @{{val}}
          </td>
        </tr>
      </tbody>
    </table>
 --}}

         <div class="clearfix"></div>
         <br>
         <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">

          <thead>

            <th>NOMBRE BENEFICIARIO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>FECHA EVALUACIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>CRITERIO EVALUACIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>VALOR EVALUACIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            
            
          </thead>
          <tbody>
            <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
           
              <td>@{{data.nombre_primero | uppercase }} @{{data.apellido_primero | uppercase }}</td>
             <td>@{{data.fecha_evaluacion | uppercase }} </td>
             <td>@{{data.nombre_criterio | uppercase }} </td>
             <td>@{{data.valor_evaluacion | uppercase }} </td>
           
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
<!-- show modal  -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="orange" id="wizardProfile">
          <form method="POST" id="myform" name="myform" class="form-modal" enctype="multipart/form-data">
            <div class="wizard-header">
              <h3>
                <b>@{{ titulo }}</b> CRITERIO <br>
              </h3>
            </div>
            <div class="tab-content">
              <form id="frm" name="frm">
                <div class="form-group">
                  <label for="pwd">Nombre Criterio:</label>
                  <input class="form-control" name="nombre_criterio" value="@{{nombre_criterio}}" ng-model="serie.nombre_criterio" required></input>
                    <span class="label label-danger" ng-show="frm.serie.nombre_criterio.$dirty && frm.serie.nombre_criterio.$error.required">Requerido</span>
                </div>

                <div ng-if="metodo == '1'">
                  <button  ng-click="GuardarCriterio(valor)" class="btn btn-success" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar</button>
                </div>
                <div ng-if="metodo == '2'">
                  <button  ng-click="ActualizarCriterio(valorID)" class="btn btn-warning" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="wizard-footer">
            <div class="pull-right">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
            <div class="clearfix"></div>
          </div>
        </form>
      </div>
    </div> <!-- wizard container -->
  </div>
</div>

</div>

