<style>
.code {
height: 80px !important;
}
textarea.ng-invalid.ng-dirty{border:1px solid red;}
select.ng-invalid.ng-dirty{border:1px solid red;}
option.ng-invalid.ng-dirty{border:1px solid red;}
input.ng-invalid.ng-dirty{border:1px solid red;}
</style>
<div class = 'container'>
<div class="clearfix"></div>
<br>
<div class="content-wrapper">
<section class="content">
    <div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                <span class="label label-success" id="codigo">Asignación Equipamientos</span> {{-- <span class="label label-primary" ng-model="codigo" id="codigo">Código Grupo: @{{ codigo_grupo dd}}</span> --}}
            </a></li>
            </ul>
            <div class="tab-content">
            <div id="resultados_ajax"></div>
            <div class="tab-pane active" id="details">
                <div class="clearfix"></div>
                <br>
                <div class="form-group">
                <label for="note" class="col-sm-2 control-label">Sedes</label>
                <div class="col-sm-6">

                    <ui-select ng-model="person.id" theme="select2" ng-disabled="disabled" style="min-width: 300px;" ng-change='selectedSede()'>
                    <ui-select-match placeholder="Busqueda Sede con su respectiva Institucion">Institucion: @{{$select.selected.nombre_institucion}} Sede: @{{$select.selected.nombre_sede}} </ui-select-match>
                    <ui-select-choices repeat="person in people | propsFilter: {nombre_institucion: $select.search, nombre_sede: $select.search}">
                        <div ng-bind-html="person.nombre_institucion | highlight: $select.search"></div>
                        <small>
                        Institucion:  @{{ person.nombre_institucion }}
                        Sede: @{{person.nombre_sede}}    
                        </small>
                    </ui-select-choices>
                    </ui-select>
                </div>
                </div>
                <div class="form-group">
                <label for="note" class="col-sm-2 control-label">Tipo Equipamientos</label>
                <div class="col-sm-6">
                    <select name="tipoequipamiento" ng-model="tipoequipamiento" class="form-control" required ng-change='selectedEquipamiento(tipoequipamiento)'>
                    <option value="">Seleccione Tipo Equipamiento</option>
                    <option ng-repeat="tipoequipamiento in tipoequipamientos" value="@{{ tipoequipamiento.id }}">@{{ tipoequipamiento.descripcion }}</option>
                    </select>
                    <span class="label label-danger" ng-show="frm.tipoequipamiento.$dirty && frm.tipoequipamiento.$error.required">Requerido</span>
                </div>
                </div>
                <div class="form-group">
                <label for="note" class="col-sm-2 control-label"></label>
                <div class="col-sm-8">
                    <input id="first" type="radio" name="content" ng-model="content" value="agregar">Agregar Cantidad
                    <input id="other" type="radio" name="content" ng-model="content" value="quitar">Quitar Cantidad              
                </div>
                </div>
                <div class="form-group" ng-show="content == 'agregar'">
                <label for="note" class="col-sm-2 control-label">Agregar Cantidad</label>
                <div  class="col-sm-8">
                    <input class="form-control" placeholder="Digita Cantidad Agregar" name="cantidadAgregar" ng-model="cantidadAgregar" />
                </div>
                </div>                                           
                <div class="form-group" ng-show="content == 'quitar'">
                <label for="note" class="col-sm-2 control-label">Quitar Cantidad</label>
                <div  class="col-sm-8">
                    <input class="form-control" placeholder="Digita Cantidad Eliminar" name="cantidadEliminar" ng-model="cantidadEliminar" />
                </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="form-group">
                <div class="col-sm-6">
                    <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
                    <div ng-repeat="car in cars">
                    <li></li>
                    </div>
                    <button type="submit" class="btn btn-success" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Asignar</button>
                    <a href="{{url('/admin/postfichacolegios#/admin/postfichacolegios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                </div>
                </div>
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
                        <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
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
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
</form>
<div class="messages"></div><br /><br />
<!--div para visualizar en el caso de imagen-->
<div class="showImage"></div>
</div>
</div>
</section>



