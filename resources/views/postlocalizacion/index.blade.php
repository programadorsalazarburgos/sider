<div ng-controller="LocalizacionCrtl">
    <div class="clearfix"></div><br>


  <style>


    
</style>


<div id="container"></div>
<div class='col-sm-6'>
  <div class='form-group'>
    <label for="user_email"><span class="label label-default">Corregimientos</span></label>                     
     <select name="corregimiento" ng-model="corregimiento" ng-change='selectedCorregimiento(corregimiento)' id="corregimiento" class="form-control">
    <option value="">Seleccione Corregimiento</option>
    <option ng-repeat="corregimiento in corregimientos" value="@{{ corregimiento.id }}">@{{ corregimiento.descripcion }}</option>
  </select>

  </div>

</div>
  


</div>
</div>
