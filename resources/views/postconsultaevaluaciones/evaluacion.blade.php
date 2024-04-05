<style>
.code {
  height: 80px !important;
}

textarea.ng-invalid.ng-dirty{border:1px solid red;}
select.ng-invalid.ng-dirty{border:1px solid red;}
option.ng-invalid.ng-dirty{border:1px solid red;}
input.ng-invalid.ng-dirty{border:1px solid red;}


/* bar height */
.styled .switcher-line:before { height: 20px; }
/* bar backgrounds */
.styled         .switcher-line:before { background: #e35144; }
.styled .active .switcher-line:before { background: #4ecb32; }
/* icons opacity */
.styled         .switcher-label.false,
.styled .active .switcher-label.true { opacity: 1; }
.styled         .switcher-label.true,
.styled .active .switcher-label.false { opacity: .4; }
</style>

<div ng-controller="EvaluacionGrupoCtrl">
    <div class="clearfix"></div><br>



<div class="clearfix"></div><br>
    <div id="table-action" class="row">
       <div class="col-lg-12">

<ul id="tableactiondTab" class="nav nav-tabs">
   <li class="active"><a href="#table-table-tab" data-toggle="tab">Evaluación Grupo</a></li>
</ul>



<div id="tableactionTabContent" class="tab-content">
<div id="table-table-tab" class="tab-pane fade in active">
 <div class="row">
  <div class="col-lg-12"><h4 class="box-heading"></h4>




<div class="table-container"> 
  <div class="row mbm">
    <div class="col-lg-6">
     <div class="pagination-panel"><h5 class="box-heading">MONITOR: {{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }} 
      </h5> 
      <span class="label label-primary">CODIGO DE GRUPO: @{{nombre_grupo}}</span>
      <span class="label label-success">GRADO: @{{nombre_grado}}</span>
      <div class="clearfix"></div><br>
     </div>
<div class='col-sm-6'>
    <div class='form-group'>
      <form id="frm" name="frm">
      <label for="user_firstname">FECHA EVALUACIÓN</label>

      <input ui-date="opts" class="form-control" required ng-model="data.valor" ng-change='selectedFecha(data.valor)'></input>


      <span class="label label-danger" ng-show="frm.data.valor.$dirty && frm.data.valor.$error.required">Requerido</span>
      
    </div>
  </div>
</div>
</div>
<div id="tablasave">
<div class="table-responsive">
 <div class="clearfix"></div>
    <br>
    
     <table id="tableasistencia" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
            <thead>
            <th>Nombres y Apellidos&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th ng-repeat="criterio in criterios">@{{criterio.nombre_criterio}}</th>
            </thead>
            <tbody>
                <tr ng-repeat="(i, data) in beneficiarios track by $index">
                    <td>@{{data.nombre_primero}}  @{{data.apellido_primero}}</td>
                    <td ng-repeat="(j, criterio) in criterios track by $index">             
                      <input ng-model="evaluaciones[i][j].valor" value="criterio.valor_evaluacion">                             
                       <div class="slider1" ui-slider min="0"  max="5" ng-model="evaluaciones[i][j].valor"></div>
                    </td>
                  </tr>
              </tbody>
          </table>

        <div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-12">
                <h4>No se encontraron resultados</h4>
            </div>
        </div>
    </div>
    <div class="form-group">
  <div class="col-sm-6">
    <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
    <div ng-repeat="car in cars">
      <li></li>
    </div>
     <div ng-if="boton == '1'">                
        <button type="submit" class="btn btn-success" ng-click="formsubmitEvaluacion(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Evaluación</button>
        <a href="{{url('/admin/postcriterios#/admin/postcriterios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
    </div>
    <div ng-if="boton == '2'">                
        <button type="submit" class="btn btn-warning" ng-click="formupdateEvaluacion(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Evaluación</button>
        <a href="{{url('/admin/postcriterios#/admin/postcriterios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
    </div>
  </div>
</div>
</div>
</div>





<div class="table-responsive2">
  </div>
</div>
  </form>
</div>
</div>
</div>
</div>
</div>
</div>



