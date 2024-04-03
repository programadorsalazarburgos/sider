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
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-10">
        <form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Editar Disciplina</a></li>
            </ul>
            <div class="tab-content">
              <div id="resultados_ajax"></div>
              <div class="tab-pane active" id="details">
                <div class="clearfix"></div>
                <br>
                <div class="form-group">
                  <label for="note" class="col-sm-2 control-label">Nombre Disciplina</label>
                  <div class="col-sm-8">
                    <input class="form-control" placeholder="Digita Nombre Disciplina" name="nombre_disciplina" value="@{{nombre_disciplina}}" ng-model="serie.nombre_disciplina" required></input>
                    <span class="label label-danger" ng-show="frm.serie.nombre_disciplina.$dirty && frm.serie.nombre_disciplina.$error.required">Requerido</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="note" class="col-sm-2 control-label">Descripción</label>
                  <div class="col-sm-8">
                    <textarea  name="descripcion" value="@{{descripcion}}" ng-model="serie.descripcion" class="form-control"  rows="6" uppercased style="height:76px;"></textarea>
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
                    <button type="submit" class="btn btn-azul" ng-click="formsubmit(serie.id, frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Disciplina</button>
                    <a href="{{url('/admin/postdisciplinas#/admin/postdisciplinas')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
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



