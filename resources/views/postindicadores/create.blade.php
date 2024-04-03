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
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Crear Indicadores</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Meta</label>
<div class="col-sm-6">
    <select name="meta" ng-model="meta" class="form-control" required ng-change='selectedMeta(meta)'>
        <option value="">Seleccione Meta</option>
        <option ng-repeat="meta in metas" value="@{{ meta.id }}">@{{ meta.nombre_meta }} @{{ meta.periodo }}</option>
    </select>
    <span class="label label-success" ng-show="alcance">ALCANCE META @{{ alcancemeta | number }}</span>
    <span class="label label-danger" ng-show="frm.meta.$dirty && frm.meta.$error.required">Requerido</span>
    </div>
</div>
     
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Mes</label>
<div class="col-sm-6">
    <select name="mes" ng-model="mes" class="form-control" required ng-change='selectedMes(mes)'>
        <option value="">Seleccione Mes</option>
        <option ng-repeat="mes in meses" value="@{{ mes.id }}">@{{ mes.nombre }}</option>
    </select>
<span class="label label-danger" ng-show="frm.mes.$dirty && frm.mes.$error.required">Requerido</span>
    </div>
</div>


<div class="form-group">
<label for="note" class="col-sm-2 control-label">Avance</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Avance Meta" name="avance" value="@{{avance_meta}}" ng-model="serie.avance_meta" required></input>
    <span class="label label-danger" ng-show="frm.serie.avance_meta.$dirty && frm.serie.avance_meta.$error.required">Requerido</span>
</div>
</div>

<div class="form-group">
<label for="note" class="col-sm-2 control-label">Descripción</label>
<div class="col-sm-8">
    <textarea class="form-control" required placeholder="Digita Descripción" name="descripcion" value="@{{descripcion}}" ng-model="serie.descripcion"></textarea>
    <span class="label label-danger" ng-show="frm.serie.descripcion.$dirty && frm.serie.descripcion.$error.required">Requerido</span>
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

 <button type="submit" class="btn btn-azul" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Indicador</button>

 <a href="{{url('/admin/postindicadores#/admin/postindicadores')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>


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



