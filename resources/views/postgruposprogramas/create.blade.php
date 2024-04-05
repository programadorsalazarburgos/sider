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
    <section class="content-header">
      <!-- <h3><i class='fa fa-edit'></i> Agregar nuevo producto</h3> -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                  <span class="label label-success" id="codigo">Asignación Grupos</span> 

                </a></li>
              </ul>
              <div class="tab-content">
                <div id="resultados_ajax"></div>
                <div class="tab-pane active" id="details">
                  <div class="clearfix"></div>
                  <br>
                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Nombre Grupo</label>
                    <div class="col-sm-6">
                      <input class="form-control" placeholder="Digita Nombre Grupo" name="nombre_grupo" ng-model="nombre_grupo" required capitalize></input>
                      <span class="label label-danger" ng-show="frm.nombre_grupo.$dirty && frm.nombre_grupo.$error.required">Requerido</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Lugar</label>
                    <div class="col-sm-6" style="position: relative; left: 34px;">
                      <select chosen ng-model="lugar" name="lugar" class="form-control" ng-options="lugar.id as lugar.nombre_lugar for lugar in lugares" required>
                            <option value="">Seleccione Lugar</option>
                      </select>
                      <span class="label label-danger" ng-show="frm.lugar.$dirty && frm.lugar.$error.required">Requerido</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Disciplina</label>
                    <div class="col-sm-6" style="position: relative; left: 34px;">
                      <select chosen ng-model="disciplina" name="disciplina" class="form-control" ng-options="disciplina.id as disciplina.nombre_disciplina for disciplina in disciplinas" required>
                            <option value="">Seleccione Disciplina</option>
                      </select>

                      <span class="label label-danger" ng-show="frm.disciplina.$dirty && frm.disciplina.$error.required">Requerido</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Observaciones</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" placeholder="Digita Observaciones" name="observaciones" ng-model="observaciones" capitalize></textarea>
                    </div>
                  </div>
                  <h5><span class="label label-info">Ingrese Horario para este grupo</span></h5>
                  <hr/>
                  <div class="col-sm-6">
                    <fieldset class="scheduler-border" data-ng-repeat="dia in dias">
                      <legend class="scheduler-border">Horario</legend>
                      <div class="control-group">
                        <input type="checkbox" id="lunes" ng-model="checked" ng-change="avisar()" name="form_animal" class="micheckbox" value="1" />
                        <label class="control-label input-label" for="startTime">@{{dia.id}}</label>
                      </div>
                      <timepicker-pop input-time="dia.inicio" ng-show="checked" class="input-group"  ng-model="dia.inicio"
                      show-meridian='showMeridian' ng-required="checked == true"> </timepicker-pop>
                      <timepicker-pop input-time="dia.fin" ng-show="checked" class="input-group" disabled="disabled"
                      show-meridian='showMeridian' ng-model="dia.fin" ng-required="checked == true"> </timepicker-pop>
                    </div>
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
                    <button type="submit" class="btn btn-azul" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Grupo</button>
                    <a href="{{url('/admin/postgruposprogramas#/admin/postgruposprogramas')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
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



