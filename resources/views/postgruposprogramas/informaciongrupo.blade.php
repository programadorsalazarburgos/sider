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
                  <span class="label label-success" id="codigo">Información Grupo</span>
                </a></li>
              </ul>
              <div class="tab-content">
                <div id="resultados_ajax"></div>
                <h3 class="box-heading" align="center">INFORMACIÓN GRUPO</h3>
                <div class="tab-pane active" id="details">
                  <div class="clearfix"></div>
                  <br>
                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Nombre Grupo</label>
                    <div class="col-sm-6">
                      <input class="form-control" placeholder="Digita Nombre Grupo" name="nombre_grupo" value="@{{nombre_grupo}}" ng-model="serie.nombre_grupo" required disabled="true"></input>
                      <span class="label label-danger" ng-show="frm.serie.nombre_grupo.$dirty && frm.serie.nombre_grupo.$error.required">Requerido</span>
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Lugar de Atención</label>
                    <div class="col-sm-6">
                      <select class="form-control" name="tipo_univ" id="tipo_univ" ng-model="lugar" ng-options="lugar.id as lugar.nombre_lugar for lugar in lugares" required disabled="true">
                            <option value=''>Seleccione Lugar</option>
                          </select>
                      <span class="label label-danger" ng-show="frm.lugar.$dirty && frm.lugar.$error.required">Requerido</span>
                    </div>
                  </div>

                                

                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Disciplina</label>
                    <div class="col-sm-6">
                      <select class="form-control" name="tipo_univ" id="tipo_univ" ng-model="disciplina" ng-options="disciplina.id as disciplina.nombre_disciplina for disciplina in disciplinas" required disabled="true">
                            <option value=''>Seleccione Disciplina</option>
                      </select>
                      <span class="label label-danger" ng-show="frm.disciplina.$dirty && frm.disciplina.$error.required">Requerido</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Observaciones</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" placeholder="Digita Observaciones" name="observaciones" value="@{{observaciones}}" ng-model="serie.observaciones" disabled="true"></textarea>
                    </div>
                  </div>
                  <h5><span class="label label-info">Ingrese Horario para este grupo</span></h5>
                  <hr/>
                  <fieldset class="scheduler-border" data-ng-repeat="dia in dias" disabled="true">

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

                    <a href="{{url('/admin/postgruposprogramas#/admin/postgruposprogramas/consulta')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="messages"></div><br /><br />
    <div class="showImage"></div>
  </div>
</div>
</section>



