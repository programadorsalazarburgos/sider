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
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Crear Meta</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Meta</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Meta" value="@{{nombre_meta}}" ng-model="serie.nombre_meta" required></input>
    <span class="label label-danger" ng-show="frm.serie.nombre_meta.$dirty && frm.serie.nombre_meta.$error.required">Requerido</span>
</div>
</div>

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Programa</label>
    <div class="col-sm-6">
    <select class="form-control" name="programas" id="programas" required  ng-model="data.unit" ng-options="unit.id as unit.nombre_programa for unit in programas"></select>
    <span class="label label-danger" ng-show="frm.data.unit.$dirty && frm.data.unit.$error.required">Requerido</span>    
</div>
</div>
        


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Año</label>
<div class="col-sm-8">
    <select class="form-control" ng-model="anualidad" required>
        <option value="">Seleccione Año</option>
        <option ng-repeat="year in years" value="@{{ year }}">@{{ year }}</option>
    </select>
    <span class="label label-danger" ng-show="frm.anualidad.$dirty && frm.anualidad.$error.required">Requerido</span>
</div>
</div>

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Meta</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita cantidad Meta" name="meta" value="@{{meta}}" ng-model="serie.meta" required></input>
    <span class="label label-danger" ng-show="frm.meta.$dirty && frm.meta.$error.required">Requerido</span>
</div>
</div>
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Descripción</label>
<div class="col-sm-8">
    <textarea class="form-control" placeholder="Digita Descripción" name="descripcion" value="@{{descripcion}}" ng-model="serie.descripcion"></textarea>
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
<button type="submit" class="btn btn-success" ng-click="formsubmit(serie.id, frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Meta</button>
 <a href="{{url('/admin/postmetas#/admin/postmetas')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
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



