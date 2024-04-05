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
                  <span class="label label-success" id="codigo">Asignación Grupos</span> <span class="label label-primary" ng-model="codigo_grupo" id="codigo">Código Grupo: @{{ serie.codigo_grupo }}</span>
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
                      <span class="label label-primary" id="seleccionado">Seleccionado: Institución: @{{ dataSede.nombre_institucion }} Sede: @{{ dataSede.nombre_sede }}</span>
                      <ui-select {{-- ng-click="limpiar();" id="sede" --}} ng-model="person.id" theme="select2" ng-disabled="disabled" style="min-width: 300px;">
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
                    <label for="note" class="col-sm-2 control-label">Grados</label>
                    <div class="col-sm-6">
                      <select class="form-control" name="rol" id="rol" required ng-change="unitChanged()" ng-model="data.unit" ng-options="unit.id as unit.nombre_grado for unit in grados"></select>
                      <span class="label label-danger" ng-show="frm.grado.$dirty && frm.grado.$error.required">Requerido</span>
                    </div>
                  </div>




                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Observaciones</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" placeholder="Digita Observaciones" name="observaciones" value="@{{observaciones}}" ng-model="serie.observaciones"></textarea>

                    </div>
                  </div>


                  <h5><span class="label label-info">Ingrese Horario para este grupo</span></h5>
                  <hr/>
                  <fieldset class="scheduler-border" data-ng-repeat="dia in dias">

                    <legend class="scheduler-border">Horario</legend>
                    <div class="control-group">

                      <input type="checkbox" id="lunes" ng-checked="dia.checked" ng-model="dia.checked" ng-change="avisar(dia)" name="form_animal" class="micheckbox" value="1" />
                      <label class="control-label input-label" for="startTime">@{{dia.id}}</label>
                    </div>

                    <timepicker-pop input-time="dia.inicio" ng-show="dia.checked" class="input-group"  ng-model="dia.inicio"
                    show-meridian='showMeridian' ng-required="checked == true"> </timepicker-pop>
                    <timepicker-pop input-time="dia.fin" ng-show="dia.checked" class="input-group" disabled="disabled"
                    show-meridian='showMeridian' ng-model="dia.fin" ng-required="checked == true"> </timepicker-pop>


                  </fieldset>
                </div>

                <div class="clearfix"></div>
                <br>
                <div class="form-group">
                  <div class="col-sm-6">
                    <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
                    <div ng-repeat="car in cars">
                      <li></li>
                    </div>

                    <button type="submit" class="btn btn-azul" ng-click="formsubmit(serie.id, frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Grupo</button>

                    <a href="{{url('/admin/postgrupos#/admin/postgrupos')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>

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



