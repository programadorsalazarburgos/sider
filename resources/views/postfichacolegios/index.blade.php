<div ng-controller="FichaColegioCtrl">
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
        <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Sedes</h5>
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
                      <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Sedes
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <!--Inicia Boton Nuevo -->
                    <div class="portlet-body">
                      <div class="actions">
                        <a ng-href="/admin/postfichacolegios#/admin/postfichacolegios/create" class="btn btn-info"><i class='fa fa-plus'></i> Crear Equipamiento</a>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
                      <thead>
                        <th>Nombre Institucion&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Nombre Sede&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Direccion Sede&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th style="width:100px;"></th>
                      </thead>
                      <tbody>
                        <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                          <td>@{{data.nombre_institucion | uppercase }} </td>
                          <td>@{{data.nombre_sede | uppercase }} </td>
                          <td>@{{data.direccion | uppercase }} </td>
                          <td>
                            <div class="btn-group pull-right">
                              <a class="btn btn-primary" ng-click="ObtenerEquipamientos('obtener', data.id)">&nbsp;Equipamientos</a>
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
                  <b>@{{ titulo }}</b> COLEGIO SEDE <br>
                </h3>
              </div>
              <div class="tab-content">
                <form id="frm" name="frm">
                  <div class="form-group">
                    <h5><span class="label label-info">Equipamientos Colegio Sede</span></h5>
                    <hr/>
                    <div class="table-responsive">
                      <!--Inicia Boton Nuevo -->
                      <div class="portlet-body">
                        <div class="actions">  
                          <div class="clearfix"></div>
                          <br>
                          <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
                            <thead>
                              <th>Colegio&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                              <th>Sede&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                              <th>Equipamiento&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                              <th>Cantidad&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
  
                            </thead>
                            <tbody>
                              <tr dir-paginate="data in equipamientosedes|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                                <td>@{{data.nombre_institucion | uppercase }}  </td>
                                <td>@{{data.nombre_sede | uppercase }}  </td>
                                <td>@{{data.descripcion | uppercase }}  </td>
                                <td>@{{data.cantidad | uppercase }} </td>            
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
  