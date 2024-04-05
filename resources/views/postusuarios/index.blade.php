<div ng-controller="UsuariosCrtl">
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
                <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Usuarios</h5>
            </div>
        </div>
        <div class="clearfix"></div><br>
        <div id="table-action" class="row">
            <div class="col-lg-12">
                <ul id="tableactiondTab" class="nav nav-tabs">
                    <li class="active"><a href="#table-table-tab" data-toggle="tab">Información Usuarios</a></li>
                </ul>
                <div id="tableactionTabContent" class="tab-content">
                    <div id="table-table-tab" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-lg-12"><h4 class="box-heading">Paginación</h4>
                                <div class="table-container">
                                    <div class="row mbm">
                                        <div class="col-lg-6">
                                            <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Usuarios
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <!--Inicia Boton Nuevo -->
                                        <div class="portlet-body">
                                            <div class="actions" ng-if="tenanId == 5467829281">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/crearcomunidad" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>
    
                                            <div class="actions" ng-if="tenanId == 2767829213">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/deporteescolar" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>



                                            <div class="actions" ng-if="tenanId == 3651901612">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/caliacoge" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>
                                        
                                             <div class="actions" ng-if="tenanId == 9108237611">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/calisedivierte" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>


                                            <div class="actions" ng-if="tenanId == 7233109821">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/calintegra" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>

                                            <div class="actions" ng-if="tenanId == 1240916273">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/canasyganas" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>

                                            <div class="actions" ng-if="tenanId == 2871155601">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/carrerasycaminatas" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>

                                           <div class="actions" ng-if="tenanId == 8762109662">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/cuerpoyespiritu" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>


                                            <div class="actions" ng-if="tenanId == 4432891188">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/deporteasociado" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>
                                            
                                            <div class="actions" ng-if="tenanId == 2288251678">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/deportecomunitario" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>

                                            <div class="actions" ng-if="tenanId == 3365342001">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/vertigo" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div> 
                                            
                                            <div class="actions" ng-if="tenanId == 1177624100">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/viactiva" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>

                                            <div class="actions" ng-if="tenanId == 7765533102">
                                                @if(auth()->user()->can('crear-usuarios'))
                                                <a ng-href="/admin/postusuarios#/admin/postusuarios/viveelparque" class="btn btn-info"><i class='fa fa-plus'></i> Nuevo</a>
                                                @endif
                                                <a href="{{url('/api/v0/usuarios/exportacion/')}}" class="btn btn-success" type="submit"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar Excel</a>
                                            </div>



                                        </div>
                                        <div class="clearfix"></div>
                                        <br>
                                        <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
                                            <thead>
                                                <th>Nombre Usuario&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                                <th>Correo Electronico&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                                <th>Telefono Movil&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                                <th>Dirección&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                                <th>Rol&nbsp;<a ng-click="sort_by('addressLine1');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                                <th style="width:100px;"></th>
                                            </thead>
                                            <tbody>
                                                <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                                                    <td>@{{data.primer_nombre | uppercase }} @{{data.primer_apellido | uppercase }} </td>
                                                    <td>@{{data.email | uppercase }}</td>
                                                    <td>@{{data.telefono_movil | uppercase }}</td>
                                                    <td>@{{data.direccion | uppercase}}</td>
                                                    <td>@{{data.display_name | uppercase}}</td>
                                                    <td>
                                                        <div class="btn-group pull-right">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    @if(auth()->user()->can('editar-usuarios'))
                                                                    <a ng-href="/admin/postusuarios#/admin/postusuarios/editando/@{{data.id}}"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    @if(auth()->user()->can('cambiar-password'))
                                                                    <a ng-href="/admin/postusuarios#/admin/postusuarios/clave/@{{data.id}}"><i class="fa fa-spinner"></i>&nbsp;Cambiar Password</a>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    @if(auth()->user()->can('eliminar-usuarios'))
                                                                    <a ng-click="eliminar(data.id)"><i class="fa fa-trash-o"></i>&nbsp;Eliminar</a>
                                                                    @endif
                                                                </li>
                                                                 <li>
                                                                   
                                                                    <a ng-click="QuitarRol(data.id)"><i class="fa fa-trash-o"></i>&nbsp;Quitar Rol</a>
                                                                  
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
    