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


<div class="col-md-10">
<form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Crear Barrio</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>



<div class="form-group">
<label for="note" class="col-sm-2 control-label">Codigo Barrio</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Codigo Barrio" name="codigo_barrio" ng-model="codigo_barrio" required></input>
    <span class="label label-danger" ng-show="frm.codigo_barrio.$dirty && frm.codigo_barrio.$error.required">Requerido</span>
</div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Barrio</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Barrio" name="nombre_barrio" ng-model="nombre_barrio" required></input>
    <span class="label label-danger" ng-show="frm.nombre_barrio.$dirty && frm.nombre_barrio.$error.required">Requerido</span>
</div>
</div>

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Comuna</label>
 <div class="col-sm-6">

<select name="comuna" ng-model="comuna" class="form-control" required>
    <option value="">Seleccione Comuna</option>
    <option ng-repeat="comuna in comunas" value="@{{ comuna.id }}">@{{ comuna.nombre_comuna }}</option>

</select>
<span class="label label-danger" ng-show="frm.zona.$dirty && frm.zona.$error.required">Requerido</span>
  </div>
</div>



<div class="form-group">
<label for="note" class="col-sm-2 control-label">Estrato</label>
 <div class="col-sm-6">

<select class="form-control" name="tipo_sx" id="tipo_sx" required  ng-model="tipo_estrato.unit" ng-options="unit.id as unit.nombre for unit in estrato" style="width: 280px; position: relative; top: 0px;">
    <option value=''>Seleccione estrato</option>
</select>

<span class="label label-danger" ng-show="frm.tipo_estrato.unit.$dirty && frm.tipo_estrato.unit.$error.required">Requerido</span>
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

 <button type="submit" class="btn btn-success" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Crear Barrio</button>

 <a href="{{url('/admin/postbarrios#/admin/postbarrios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>


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



