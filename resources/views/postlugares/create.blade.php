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
    <section class="content-header">
      <!-- <h3><i class='fa fa-edit'></i> Agregar nuevo producto</h3> -->
    </section>
    <section class="content">
      <div class="row">


        <div class="col-md-10">
          <form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Creación Lugar de Atención</a></li>
              </ul>
              <div class="tab-content">
                <div id="resultados_ajax"></div>
                <div class="tab-pane active" id="details">
                  <div class="clearfix"></div>
                  <br>


                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Nombre Lugar Atención</label>
                    <div class="col-sm-8">
        
                      <input type="text" ng-model="lugar" placeholder="Digita Nombre Lugar Atención" typeahead="lugar.nombre_lugar for lugar in lugares | filter:$viewValue | limitTo:8" class="form-control" required>

                      <span class="label label-danger" ng-show="frm.nombre_lugar.$dirty && frm.nombre_lugar.$error.required">Requerido</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                      <input id="first" type="radio" name="content" ng-model="content" ng-value='"urbano"' ng-click="getVal()" class="">Urbano
                      <input id="other" type="radio" name="content" ng-model="content" ng-value='"rural"' ng-click="getVal()" class="">Rural              
                    </div>
                  </div>
                  <div class="clearfix"></div><br>
                  <div class="form-group" ng-show="content == 'urbano'">

                    <div class="form-group">
                      <label for="note" class="col-sm-2 control-label">Barrio</label>
                      <div class="col-sm-8" style="position:  relative;left:34px;">
                        <select chosen class="form-control" ng-required="@{{ requiredBarrio }}" name="barrio" ng-change='selectedBarrio(barrio)'  id="barrio"  ng-model="barrio" ng-options="bar.id as bar.nombre_barrio for bar in barrios">
                          <option value=''>Seleccione Barrio</option>
                        </select>
                        <span class="label label-danger" ng-show="frm.barrio.$dirty && frm.barrio.$error.required">Requerido</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="note" class="col-sm-2 control-label">Comuna</label>
                      <div class="col-sm-8">
                        <input value="@{{comuna}}" ng-model="comuna"  type="text" class="form form-control" id="comuna" readonly="true"  style="background-color: #FFF;"/>
                      
                      </div>
                    </div>

                  </div>                                           
                  <div class="form-group" ng-show="content == 'rural'">
                    <div class="form-group">
                      <label for="note" class="col-sm-2 control-label">Corregimiento</label>
                      <div class="col-sm-8" style="position:  relative;left:34px;">
                        <select chosen class="form-control"  name="corregimiento" ng-change='selectedCorregimiento(corregimiento)'  id="corregimiento"  ng-model="corregimiento" ng-options="corregimiento.id as corregimiento.descripcion for corregimiento in corregimientos">
                          <option value=''>Seleccione Corregimiento</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="note" class="col-sm-2 control-label">Vereda</label>
                      <div class="col-sm-8" style="position:  relative;left:34px;">
                        <select chosen class="form-control" name="vereda" id="vereda"  ng-model="vereda" ng-options="vereda.id as vereda.nombre for vereda in veredas">
                          <option value=''>Seleccione Vereda</option>
                        </select>
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Dirección</label>
                    <div class="col-sm-8">
                      <input class="form-control" placeholder="Digita Dirección" name="direccion" ng-model="direccion" required></input>
                      <span class="label label-danger" ng-show="frm.direccion.$dirty && frm.direccion.$error.required">Requerido</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Observaciones</label>
                    <div class="col-sm-8">
                      <textarea  name="observaciones" ng-model="observaciones" class="form-control"  rows="6" uppercased style="height:76px;"></textarea>

                    </div>
                  </div>

   <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Tipo Punto Atención</label>
                    <div class="col-sm-8">

                      <input class="form-control" placeholder="Digita Tipo Punto Atención" name="tipo_punto_atencion" ng-model="tipo_punto_atencion" required></input>
                      <span class="label label-danger" ng-show="frm.tipo_punto_atencion.$dirty && frm.tipo_punto_atencion.$error.required">Requerido</span>
                    </div>
                  </div>



                  <input value="@{{comuna_id}}" ng-model="comuna_id"  type="text" class="form form-control" style="display:none" readonly="true"/>


                  <div class="clearfix"></div>
                  <br>
                  <div class="form-group">
                    <div class="col-sm-6">
                      <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
                      <div ng-repeat="car in cars">
                        <li></li>
                      </div>


                      <button type="submit" class="btn btn-azul" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Lugar de Atención</button>

                      <a href="{{url('/admin/postlugares#/admin/postlugares')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>


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



