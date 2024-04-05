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
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Editar Escenario</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>



<div class="form-group">
<label for="note" class="col-sm-2 control-label">Tipo Escenario</label>
 <div class="col-sm-6">
  <select class="form-control" name="tipoescenario" id="tipoescenario" required ng-change="unitChanged()" ng-model="data.unit" ng-options="unit.id as unit.nombre_tipo_escenario for unit in tipoescenarios"></select>

  </div>
</div>




<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Escenario</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Escenario" name="nombre_escenario" value="@{{nombre_escenario}}" ng-model="serie.nombre_escenario" required></input>
    <span class="label label-danger" ng-show="frm.nombre_escenario.$dirty && frm.nombre_escenario.$error.required">Requerido</span>
</div>
</div>





<div class="form-group">
<label for="note" class="col-sm-2 control-label">Sedes</label>
 <div class="col-sm-6">
<span class="label label-primary" id="seleccionado">Seleccionado: Barrio: @{{ data2.nombre_institucion }} Comuna: @{{ data2.nombre_sede }}</span>
  <ui-select ng-click="limpiar();" ng-model="person.id" theme="select2" ng-disabled="disabled" style="min-width: 300px;">
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
<label for="note" class="col-sm-2 control-label">Descripción</label>
<div class="col-sm-8">
    <textarea class="form-control" placeholder="descripción" name="descripcion" value="@{{descripcion}}" ng-model="serie.descripcion" required></textarea>
    <span class="label label-danger" ng-show="frm.descripcion.$dirty && frm.descripcion.$error.required">Requerido</span>
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

 <button type="submit" class="btn btn-success" ng-click="formsubmit(serie.id, frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Escenario</button>

 <a href="{{url('/admin/postescenarios#/admin/postescenarios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>



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



