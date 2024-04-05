<div ng-controller="GruposReasignacionProgramaCrtl">
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
          <h3 class="box-heading" align="center">REASIGNACIÓN GRUPOS</h3>
          <div class="col-lg-12">
            <h5 class="box-heading">USUARIO: {{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</h5>
            <div class="table-container">
              <div class="row mbm">
                <div class="col-lg-6">
                  <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Grupos Programa
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <!--Inicia Boton Nuevo -->
                <div class="portlet-body">
                  <div class="actions">
                    <div class="clearfix"></div><br>
                    <form class="form-vertical" role="form" method="get" action="{{url('items/export2')}}">
                      <div class='row'>
                        <div class='col-sm-4'>
                          <div class='form-group' style="position:relative;left:34px;">
                            <label for="user_firstname" style="position:relative;right:30px;">Usuarios</label>
                            <select chosen ng-model="usuario" class="form-control" ng-options="s.id as s.full_name for s in usuarios" ng-change='selectedUsuario(usuario)'>
                                <option value="">Seleccione usuario</option>
                            </select>
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
                    <th>Formador&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Nombre Grupo&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Lugar Atención&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Disciplina&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>Observaciones&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th style="width:200px;"></th>
                  </thead>
                  <tbody>
                    <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">  
                      <td>@{{data.primer_nombre | uppercase }}  @{{data.primer_apellido | uppercase }} </td>
                      <td align="center"><span class="label label-warning">@{{data.nombre_grupo | uppercase }} </span></td>
                      <td>@{{data.nombre_lugar | uppercase }} </td>
                      <td>@{{data.nombre_disciplina | uppercase }} </td>
                      <td>@{{data.observaciones | uppercase }} </td>
                      <td>      
                          <div class="btn-group pull-right">
                              <a class="btn btn-primary" ng-click="ReasignacionUsuario('obtener', data.id, data.nombre_grupo)"><i class="fas fa-user"></i>&nbsp;Reasignación Usuario</a>
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
                <b>@{{ titulo }}</b> @{{ nombre_grupo | uppercase }}<br>
              </h3>
            </div>
            <div class="tab-content">
              
              <form id="frm" name="frm">
                  <div class="col-lg-12">

                <div class="form-group">
                  <h5><span class="label label-info">ELIGE USUARIO PARA ASIGNAR A ESTE GRUPO</span></h5>
                  <hr/>
                  
                  <div class="table-responsive">
                    <!--Inicia Boton Nuevo -->
                    <div class="portlet-body">
                      <div class="row">
                        <div class="col-md-6">
                            <label class="control-label" for="empleado-estrato">Usuarios</label>
                            <select class="form-control" name="usuariocambio" id="usuariocambio" required ng-model="usuariocambio" ng-options="unit.id as unit.full_name for unit in usuarios">
                              <option value=''>Seleccione usuario</option>
                            </select>
                          </div>
                        <div class="col-md-6">
                            <div class="clearfix"></div><br>
                            <button type="submit" class="btn btn-azul" style="position:  relative; top: 5px;" ng-click="formReasignacion(valorID)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Reasignar</button>
                          </div>
                        </div>
                     </div>
                      <div class="actions">  
                        <div class="clearfix"></div>
                        <br>
                      </div>
                    </div>
                  </div>
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
</div>
</div>

