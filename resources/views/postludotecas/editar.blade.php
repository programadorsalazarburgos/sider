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
</section>
<section class="content">
<div class="row">
<div class="col-md-10">
<form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Editar Ludoteca</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Ludoteca</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Ludoteca" name="nombre_ludoteca" value="@{{nombre_ludoteca}}" ng-model="serie.nombre_ludoteca" required></input>
    <span class="label label-danger" ng-show="frm.nombre_ludoteca.$dirty && frm.nombre_ludoteca.$error.required">Requerido</span>
</div>
</div>
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Telefono</label>
<div class="col-sm-8">
    <input numbers-only class="form-control" placeholder="Digita Telefono" name="telefono" value="@{{telefono}}" ng-model="serie.telefono" required></input>
    <span class="label label-danger" ng-show="frm.telefono.$dirty && frm.telefono.$error.required">Requerido</span>
</div>
</div>
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Dirección</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Dirección" name="direccion" value="@{{direccion}}" ng-model="serie.direccion" required></input>
    <span class="label label-danger" ng-show="frm.direccion.$dirty && frm.direccion.$error.required">Requerido</span>
</div>
</div>
<div class="form-group">
  <label for="note" class="col-sm-2 control-label">Sedes</label>
   <div class="col-sm-6">
  <span class="label label-primary" id="seleccionado">Seleccionado: Institucion: @{{ datasede2.nombre_institucion }} Sede: @{{ datasede2.nombre_sede }}</span>
    <ui-select ng-model="sede.id" theme="select2" ng-disabled="disabled" style="min-width: 300px;">
      <ui-select-match  placeholder="Elije Otra Sede con su respectiva Institucion">Institucion: @{{$select.selected.nombre_institucion}} Sede: @{{$select.selected.nombre_sede}} 
      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
      <span class="badge badge-secondary" ng-bind="$select.selected.datasede2.nombre_sede"></span>
      </ui-select-match>
      <ui-select-choices  repeat="sede in sedes | propsFilter: {nombre_institucion: $select.search, nombre_sede: $select.search}">
        <div ng-bind-html="sede.nombre_sede | highlight: $select.search"></div>
        <small>  
          Institucion:  @{{ sede.nombre_sede }}
          Sede: @{{sede.nombre_institucion}}    
        </small>
      </ui-select-choices>
    </ui-select>
  </div>
  </div>
  <div class="form-group">
    <label for="note" class="col-sm-2 control-label">Ubicación</label>
    <form>
    <input type="radio" name="place"  ng-value='"barrios"'  ng-model="place"  ng-click="getVal()" class="option-input radio"/>Urbano
    <input type="radio" name="place" ng-value='"corregimientos"' ng-model="place" ng-click="getVal()" class="option-input radio"/>Rural
  </form>
  </div>
  <div class="form-group" ng-show="place === 'barrios'">
    <label for="note" class="col-sm-2 control-label">Barrios</label>
     <div class="col-sm-6">
      <span ng-show="mybarrio" class="label label-primary" id="seleccionado">Seleccionado: Barrio: @{{ data2.nombre_barrio }} Comuna: @{{ data2.nombre_comuna }}</span>
      <ui-select ng-model="person.id" theme="select2" ng-required='requeribarr' ng-disabled="disabled" style="min-width: 300px;">
        <ui-select-match  placeholder="Elije Otro Barrio con su respectiva Comuna">Barrio: @{{$select.selected.nombre_barrio}} Comuna: @{{$select.selected.nombre_comuna}} 
        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        <span class="badge badge-secondary" ng-bind="$select.selected.data2.nombre_barrio"></span>
        </ui-select-match>
        <ui-select-choices  repeat="person in people | propsFilter: {nombre_comuna: $select.search, nombre_barrio: $select.search}">
          <div ng-bind-html="person.nombre_barrio | highlight: $select.search"></div>
          <small>  
            Barrio:  @{{ person.nombre_barrio }}
            Comuna: @{{person.nombre_comuna}}    
          </small>
        </ui-select-choices>
      </ui-select>
    
  </div>
</div>
<div class="form-group" ng-show="place === 'corregimientos'">
  <label for="note" class="col-sm-2 control-label">corregimientos</label>
   <div class="col-sm-6">
      <select chosen ng-model="corregimiento" ng-required='requeridoc' class="form-control" ng-options="s.id as s.descripcion for s in corregimientos">
        <option value="">Seleccione corregimiento</option>
      </select>
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
 <button type="submit" class="btn btn-success" ng-click="formsubmit(serie.id, frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Ludoteca</button>
 <a href="{{url('/admin/postludotecas#/admin/postludotecas')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
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



