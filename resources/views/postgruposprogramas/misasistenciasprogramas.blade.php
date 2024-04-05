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
<div ng-controller="AsistenciaGrupoProgramaCtrl">
  <div class="clearfix"></div><br>
  <div class="clearfix"></div><br>
  <div id="table-action" class="row">
    <div class="col-lg-12">
      <ul id="tableactiondTab" class="nav nav-tabs">
        <li class="active"><a href="#table-table-tab" data-toggle="tab">REGISTRO DE ASISTENCIA BENEFICIARIOS</a></li>
      </ul>
      <div id="tableactionTabContent" class="tab-content">
        <div id="table-table-tab" class="tab-pane fade in active">
          <div class="row">
            <div class="col-lg-12"><h4 class="box-heading"></h4>
              <div class="table-container"> 
                {{-- <pre>@{{persona|json}}</pre> --}}
                <div class="row mbm">
                  <div class="col-lg-6">
                    <div class="pagination-panel"><h5 class="box-heading">USUARIO: {{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }} 
                    </h5> 
                    <span class="label label-primary">NOMBRE DE GRUPO: @{{nombre_grupo}}</span>
                    <span class="label label-success">LUGAR: @{{nombre_lugar}}</span>
                    <span class="label label-success">DISCIPLINA: @{{nombre_disciplina}}</span>
                    <div class="clearfix"></div><br>
                  </div>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <form id="frm" name="frm">
                        <label for="user_firstname">FECHA DE ASISTENCIA</label>
                        <input class="form-control" type="text" id="fecha_asistencia" ng-model="fecha_asistencia" placeholder="día/mes/año" onchange="myFunction()" required>
                        <span class="label label-danger" ng-show="frm.fecha_asistencia.$dirty && frm.fecha_asistencia.$error.required">Requerido</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">Busqueda:
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



              </div>
              <div id="tablasave">
                <div class="table-responsive">
                  <div class="clearfix"></div>
                  <br>
                  <table id="tableasistencia" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
                    <thead>
                      <th>Nombres y Apellidos&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>    
                      <th>No Documento&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                      <th>Observaciones&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                      <th style="width:100px;">Asistencia</th>
                    </thead>
                    <tbody>
                      <tr dir-paginate="data in beneficiarios|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">  

                        <td>@{{data.nombre_primero}}  @{{data.apellido_primero}} 
                        </td>
                        <td>@{{data.documento}}   
                        </td>
                        <td><textarea class="form-control" ng-model="data.observaciones_asistencia"> </textarea></td>
                        <td> 
                          <switch  ng-model="data.assist"  name="onoffswitch[@{{data.id}}]" id="myonoffswitch@{{data.id}}"  on="SI" off="NO" class="green"></switch>
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
                    <button type="submit" class="btn btn-azul" ng-click="formsubmitAsistencia(frm.$valid)" {{-- ng-disabled="frm.$invalid" --}}><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Asistencia</button>
                    <a href="{{url('/admin/postgruposprogramas#/admin/postgruposprogramas')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                  </div>
                </div>
              </div>
            </div>
            <div id="tablaupdate" style="display: none">
              <div class="table-responsive2">
                <div class="clearfix"></div>
                <br>
                <table id="tableasistenciaupdate" class="table table-hover table-striped table-bordered table-advanced tablesorter">
                  <thead>
                    <th>Nombre Grupo&nbsp;<a ng-click="sort_by('customerCodigo');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Nombres y Apellidos&nbsp;<a ng-click="sort_by('customerNombres');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Observaciones&nbsp;<a ng-click="sort_by('customerObservaciones');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th style="width:100px;">Asistencia</th>
                  </thead>
                  <tbody>
                    <tr ng-repeat="data2 in persona">
                      <td>@{{data2.nombre_grupo}}</td>
                      <td>@{{data2.nombre_primero}}  @{{data2.apellido_primero}}</td>
                      <td><textarea class="form-control" value="@{{data2.observaciones}}" ng-model="data2.observaciones"> </textarea></td>
                      <td>
                        <switch  ng-model="data2.asistencia" name="onoffswitch4[@{{data.ficha_id}}]" id="myonoffswitch2@{{data2.ficha_id}}"  on="SI" off="NO" class="green"></switch>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="form-group">
                <div class="col-sm-6">
                  <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
                  <div ng-repeat="car in cars">
                    <li></li>
                  </div>
                  <button type="submit" class="btn btn-warning" ng-click="formsubmitUpdate(frm.$valid)" {{-- ng-disabled="frm.$invalid" --}}><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Asistencia</button>
                  <a href="{{url('/admin/postgruposprogramas#/admin/postgruposprogramas')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>
</div>
</div>



