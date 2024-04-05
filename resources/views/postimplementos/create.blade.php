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
<div class="col-md-10">
<form class="form-horizontal" id="f1" name="frm" submit="submitForm()" novalidate>
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Formulario Creación Implementos</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="clearfix"></div>
<br>
<div class="form-group">
<label for="note" class="col-sm-2 control-label">Nombre Implementos</label>
<div class="col-sm-8">
    <input class="form-control" placeholder="Digita Nombre Implemento" name="nombre_implemento" ng-model="nombre_implemento" required></input>
    <span class="label label-danger" ng-show="frm.nombre_implemento.$dirty && frm.nombre_implemento.$error.required">Requerido</span>
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

 <button type="submit" class="btn btn-azul" ng-click="formsubmit(frm.$valid)"  ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Implementos</button>

 <a href="{{url('/admin/postimplementos#/admin/postimplementos')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>


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



