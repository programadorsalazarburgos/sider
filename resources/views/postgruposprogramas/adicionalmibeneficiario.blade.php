<style>
.code {
  height: 80px !important;
}

textarea.ng-invalid.ng-dirty{border:1px solid red;}
select.ng-invalid.ng-dirty{border:1px solid red;}
option.ng-invalid.ng-dirty{border:1px solid red;}
input.ng-invalid.ng-dirty{border:1px solid red;}

@keyframes click-wave {
  0% {
    height: 40px;
    width: 40px;
    opacity: 0.35;
    position: relative;
  }
  100% {
    height: 200px;
    width: 200px;
    margin-left: -80px;
    margin-top: -80px;
    opacity: 0;
  }
}

.option-input {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
  position: relative;
  top: 13.33333px;
  right: 0;
  bottom: 0;
  left: 0;
  height: 40px;
  width: 40px;
  transition: all 0.15s ease-out 0s;
  background: #cbd1d8;
  border: none;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  margin-right: 0.5rem;
  outline: none;
  position: relative;
  z-index: 1000;
}
.option-input:hover {
  background: #9faab7;
}
.option-input:checked {
  background: #40e0d0;
}
.option-input:checked::before {
  height: 40px;
  width: 40px;
  position: absolute;
  content: '✔';
  display: inline-block;
  font-size: 26.66667px;
  text-align: center;
  line-height: 40px;
}
.option-input:checked::after {
  -webkit-animation: click-wave 0.65s;
  -moz-animation: click-wave 0.65s;
  animation: click-wave 0.65s;
  background: #40e0d0;
  content: '';
  display: block;
  position: relative;
  z-index: 100;
}
.option-input.radio {
  border-radius: 50%;
}
.option-input.radio::after {
  border-radius: 50%;
}

</style>
<div class = 'container'>
  <div class="clearfix"></div>
  <br>
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-11">
          <form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Información Adicional</a></li>
              </ul>
              <div class="tab-content">
                <div id="resultados_ajax"></div>
                <div class="tab-pane active" id="details">
                  <div class="clearfix"></div>
                  <br>
                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Es beneficiario  de la tarjeta Mio</label>
                    <div class="col-sm-8">
                      <input id="first" type="radio" name="content" ng-model="content" ng-value='"si"' ng-click="getVal()" class="">Si
                      <input id="other" type="radio" name="content" ng-model="content" ng-value='"no"' ng-click="getVal()" class="">No              
                    </div>
                  </div>
                  <div class="clearfix"></div><br>
                  <div class="form-group"  ng-show="content == 'si'">
                    <label for="note" class="col-sm-2 control-label">No Tarjeta o Código</label>
                    <div class="col-sm-8" style="position:  relative;left:34px;">
                      <input type="text" class="form-control" name="no_tarjeta" ng-model="no_tajeta" style="position:  relative; right:  35px;">
                      
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <br>
                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Disciplinas Deportivas</label>
                    <div class="col-sm-8" style="position:  relative;left:34px;">
                     <select chosen ng-model="disciplina" class="form-control" ng-options="disciplina.id as disciplina.descripcion for disciplina in disciplinas">
                              <option value="">Seleccione Disciplina</option>
                      </select>
                    
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">beneficiario pertenece a:</label>
                    <div class="col-sm-8" style="position:  relative;left:34px;">
                     <select chosen ng-model="seleccion" class="form-control" ng-options="seleccion.id as seleccion.nombre for seleccion in selecciones" ng-change="beneficiario(seleccion)">
                              <option value="">beneficiario pertenece a</option>
                      </select>
                     
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Nombre del Club</label>
                    <div class="col-sm-8" style="position:  relative;left:34px;">
                      <select chosen ng-model="club" class="form-control" ng-options="club.id as club.nombre_club for club in clubesdeportivos" ng-change="beneficiario(seleccion)">
                          <option value="">Nombre del Club</option>
                      </select>
                     
                    </div>
                  </div>

                     
                  <div class="form-group">
                    <div class="col-sm-6">
                      <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
                      
                      <button type="submit" class="btn btn-azul" ng-click="formsubmit(frm.$valid, parametro)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Información Adicional</button>
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
      <div class="showImage"></div>
    </div>
  </div>
</section>



