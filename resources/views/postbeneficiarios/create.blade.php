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
        <div class="col-md-12" style="width: 98%;">
          <div class="content-wrapper">
            <section class="content">
              <div class="row">
                <form class="" id="f1" name="frm" submit="submitForm()" novalidate>
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                        <span class="label label-success" id="codigo">FICHA DE INSCRIPCIÓN -
                        BENEFICIARIOS</span>
                      </a></li>
                    </ul>
                    <div class="tab-content">
                      <div id="resultados_ajax"></div>
                      <div class="tab-pane active" id="details">
                        <div class="clearfix"></div>
                        <br>
                          <div class="row">
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">No Ficha</label>                     
                                  <input type="text" class="form-control" ng-model="no_ficha" placeholder="No Ficha" ng-blur="onBlurFicha($event)" required>
                                <span class="label label-danger" ng-show="frm.no_ficha.$dirty && frm.no_ficha.$error.required">Requerido</span>
                            
                              </div>
                            </div>
                              <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Fecha Inscripción</label>
                                <input class="form-control" type="text" id="fecha_inscripcion" ng-model="fecha_inscripcion" placeholder="año/mes/día" required>
                                <span class="label label-danger" ng-show="frm.fecha_inscripcion.$dirty && frm.fecha_inscripcion.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Modalidad</label>
                                <input type="text" class="form-control" ng-model="modalidad" placeholder="Modalidad" required>
                                <span class="label label-danger" ng-show="frm.modalidad.$dirty && frm.modalidad.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Punto de atención</label>
                                <input type="text" class="form-control" ng-model="punto_atencion" placeholder="Punto de atención" required>
                                <span class="label label-danger" ng-show="frm.punto_atencion.$dirty && frm.punto_atencion.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>

                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                              <span class="label label-primary" id="codigo">Datos Basicos</span>
                            </a></li>
                          </ul>

                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">No Documento</label>
                                <input class="form-control" placeholder="Digita Número de Documento" type="text" name="integer-data-attribute" data-thousands="." ng-blur="onBlurDocumento($event)" ng-model="no_documento_persona" required="true" />
  
                                 <div id="repetido_no_documento">
                                  <span class="label label-danger" ng-show="frm.no_documento_persona.$dirty &&   frm.no_documento_persona.$error.required">Requerido</span>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Tipo Documento</label>                     
                                <select name="tipo_doc_persona" ng-model="tipo_doc_persona" class="form-control" required>
                                    <option value="">Tipo Documento</option>
                                    <option ng-repeat="tip_documento in tipo_documento" value="@{{ tip_documento.id }}">@{{ tip_documento.descripcion }}</option>

                                </select>
                                <span class="label label-danger" ng-show="frm.tipo_doc_persona.$dirty && frm.tipo_doc_persona.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>


                          <div class="clearfix"></div><br>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Primer Nombre</label>
                                <input type="text" class="form-control" ng-model="primer_nombre_persona" placeholder="Primer Nombre" required>
                                <span class="label label-danger" ng-show="frm.primer_nombre_persona.$dirty && frm.primer_nombre_persona.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Segundo Nombre</label>
                                <input type="text" class="form-control" ng-model="segundo_nombre_persona" placeholder="Segundo Nombre">
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Primer Apellido</label>
                                <input type="text" class="form-control" ng-model="primer_apellido_persona" placeholder="Primer Apellido" required>
                                <span class="label label-danger" ng-show="frm.primer_apellido_persona.$dirty && frm.primer_apellido_persona.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Segundo Apellido</label>
                                <input type="text" class="form-control" ng-model="segundo_apellido_persona" placeholder="Segundo Apellido">
                              </div>
                            </div>
                          </div>
                          
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Sexo</span>
                                     <select  ng-model="sexo_persona" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                      <option value="">Seleccione Sexo</option>
                                      <option ng-repeat="sex in sexo" value="@{{ sex.id }}">@{{ sex.nombre }}</option>
                                    </select>
                                    <span class="label label-danger" ng-show="frm.sexo_persona.$dirty && frm.sexo_persona.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Fecha Nacimiento</label>
                                <input class="form-control" type="text" id="fecha_nacimiento" ng-model="fecha_nacimiento" required placeholder="año/mes/día">
                                <span class="label label-danger" ng-show="frm.fecha_nacimiento.$dirty && frm.fecha_nacimiento.$error.required">Requerido</span>                     
                              </div>
                            </div>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Tipo de Sangre</span>
                                     <select name="tip_sangre" ng-model="tip_sangre_persona" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                      <option value="">Seleccione 
                                      Tipo de Sangre</option>
                                      <option ng-repeat="tip_sangre in tipo_sangre" value="@{{ tip_sangre.id }}">@{{ tip_sangre.nombre }}</option>
                                    </select>
                                    <span class="label label-danger" ng-show="frm.tip_sangre_persona.$dirty && frm.tip_sangre_persona.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                         
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  
                                    <label class="item-input"> <span class="input-label">Telefono Fijo</span>
                                      <input class="form-control" required="true" size="30" type="text" numbers-only  placeholder="Telefono Fijo" type="number" ng-model="telefono_fijo_persona"/>

                                    <span class="label label-danger" ng-show="frm.telefono_fijo_persona.$dirty && frm.telefono_fijo_persona.$error.required">Requerido</span>
                                    <br>
                                  
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Telefono Movil</label>
                                 <input class="form-control" numbers-only  required="true" size="30" type="text" placeholder="Telefono Movil" type="number" ng-model="telefono_movil_persona" style="position:  relative; top: -6px;"/>
                                <span class="label label-danger" ng-show="frm.telefono_movil_persona.$dirty && frm.telefono_movil_persona.$error.required">Requerido</span>
                                
                              </div>
                            </div>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Correo Electronico</span>
                                       <input class="form-control" required size="30" type="email" placeholder="Correo electronico" ng-model="correo_persona" />
                                      <span class="label label-danger" ng-show="frm.correo_persona.$dirty && frm.correo_persona.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                         
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Pais</span>
                                   <select class="form-control" name="pais" id="pais" required ng-change='selectedPais(data_paises.unit)' ng-model="data_paises.unit" ng-options="unit.id as unit.nombre_pais for unit in paises" style="width: 280px; position: relative; top: 6px;"></select>

                                    <span class="label label-danger" ng-show="frm.data_paises.unit.$dirty && frm.data_paises.unit.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>



                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Departamento</label>
                                  <select class="form-control" name="departamento" id="departamento" required  ng-model="datas.unit" ng-change='selectedDepartamento(datas.unit)' ng-options="unit.id as unit.nombre_departamento for unit in departamentos" style="width: 280px; position: relative; top: 6px;"></select>
                                <span class="label label-danger" ng-show="frm.datas.unit.$dirty && frm.datas.unit.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">Municipio</label>
                                 <select class="form-control" name="municipio" id="municipio" required  ng-model="data_municipio.unit" ng-options="unit.id as unit.nombre_municipio for unit in municipios" style="width: 280px; position: relative; top: 6px;"></select>
                                <span class="label label-danger" ng-show="frm.data_municipio.unit.$dirty && frm.data_municipio.unit.$error.required">Requerido</span>
                                <span class="label label-danger" ng-show="frm.municipio.$dirty && frm.municipio.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                          </div>


<div class='row'>
  <div class='col-sm-6'>
    <div class='form-group'>
      <div class="col-lg-12">
        <div class="table-container">
          <div class="table-responsive">
            <table id="example-export" class="controlesDireccion table-hover table-striped table-advanced tablesorter" ng-init="getData()">
           <tbody>
                <tr>
                    <td colspan="10">Dirección de Residencia</td>

                </tr>
                <tr class="trEjemploDireccion">
                    <td>Dg(*)</td>
                    <td>84(*)</td>
                    <td>B</td>
                    <td>Bis</td>
                    <td>A</td>
                    <td>Sur</td>
                    <td>No.8(*)</td>
                    <td>B</td>
                    <td>62</td>
                    <td>Este</td>
                </tr>
                <tr>
                    <td>
                        <select class="formlista" size="1">
                            <option value="" selected="selected">Escoja una Opción</option>
    <option value="AC">Avenida calle</option>
    <option value="AK">Avenida carrera</option>
    <option value="CL">Calle</option>
    <option value="KR">Carrera</option>
    <option value="DG">Diagonal</option>
    <option value="TV">Transversal</option>
</select>
</td>
<td>
<input type="number" title="Acepta solo números." class="formlista" size="3" maxlength="3" >
</td>
<td>
    <select class="formlista" id="letraViaPrincipal" size="1">
        <option value="" selected="selected"></option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
        <option value="H">H</option>
        <option value="I">I</option>
        <option value="J">J</option>
        <option value="K">K</option>
        <option value="L">L</option>
        <option value="M">M</option>
        <option value="N">N</option>
        <option value="O">O</option>
        <option value="P">P</option>
        <option value="Q">Q</option>
        <option value="R">R</option>
        <option value="S">S</option>
        <option value="T">T</option>
        <option value="U">U</option>
        <option value="V">V</option>
        <option value="W">W</option>
        <option value="X">X</option>
        <option value="Y">Y</option>
        <option value="Z">Z</option>
    </select>
</td>
<td>
    <select class="formlista"  size="1">
        <option value="" selected="selected"></option>
        <option value="BIS">BIS</option>
    </select>
</td>
<td>
    <select class="formlista" id="letraBis" size="1">
        <option value="" selected="selected"></option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
        <option value="H">H</option>
        <option value="I">I</option>
        <option value="J">J</option>
        <option value="K">K</option>
        <option value="L">L</option>
        <option value="M">M</option>
        <option value="N">N</option>
        <option value="O">O</option>
        <option value="P">P</option>
        <option value="Q">Q</option>
        <option value="R">R</option>
        <option value="S">S</option>
        <option value="T">T</option>
        <option value="U">U</option>
        <option value="V">V</option>
        <option value="W">W</option>
        <option value="X">X</option>
        <option value="Y">Y</option>
        <option value="Z">Z</option>
    </select>
</td>
<td>
    <select title="&quot;Este&quot;, correponde al Occidente" class="formlista" size="1">
        <option value="" selected="selected"></option>
        <option value="SUR">SUR</option>
        <option value="ESTE">ESTE</option>
    </select>
</td>
<td>{{-- No. --}} 
    <input type="number" style="position: relative; top: 0px;" title="Acepta solo números." class="formlista" size="3" maxlength="3" ">
</td>
<td>
    <select class="formlista" class="form-control" id="letraViaGeneradora" size="1">
        <option value="" selected="selected"></option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
        <option value="H">H</option>
        <option value="I">I</option>
        <option value="J">J</option>
        <option value="K">K</option>
        <option value="L">L</option>
        <option value="M">M</option>
        <option value="N">N</option>
        <option value="O">O</option>
        <option value="P">P</option>
        <option value="Q">Q</option>
        <option value="R">R</option>
        <option value="S">S</option>
        <option value="T">T</option>
        <option value="U">U</option>
        <option value="V">V</option>
        <option value="W">W</option>
        <option value="X">X</option>
        <option value="Y">Y</option>
        <option value="Z">Z</option>
    </select>
</td>
<td>{{-- - --}} 
    <input type="number" min="1" title="Acepta solo números." class="formlista" size="3" maxlength="3" >
</td>
<td>
    <select class="formlista" size="1">
        <option value="" selected="selected"></option>
        <option value="SUR">SUR</option>
        <option value="ESTE">ESTE</option>
    </select>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
<div class="clearfix"></div><br>

  </div>
</div>

                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Dirección de residencia</label>
                                <input class="form form-control" required size="30" type="text" placeholder="Dirección de residencia" ng-model="residencia_persona" id="id_persona_beneficiario_residencia_direccion" name="id_persona_beneficiario[residencia_direccion]" readonly/>
                                <span class="label label-danger" ng-show="frm.residencia_beneficiario.$dirty && frm.residencia_beneficiario.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Estrato</label>
                                <input class="form-control" required= size="30" type="text" placeholder="Estrato" numbers-only  ng-model="estrato" />
                                <span class="label label-danger" ng-show="frm.estrato.$dirty && frm.estrato.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Comuna</label>
                                <select name="comuna" ng-model="comuna" class="form-control" required style="width: 280px; position: relative; top: 6px;"  ng-change='selectedComuna(comuna)'>
                                  <option value="">Seleccione Comuna</option>
                                  <option ng-repeat="comuna in comunas" value="@{{ comuna.id }}">@{{ comuna.nombre_comuna }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.comuna.$dirty && frm.comuna.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Barrio</label>
                                <select name="barrio" ng-model="barrio" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                  <option value="">Seleccione Barrio</option>
                                  <option ng-repeat="barrio in barrios" value="@{{ barrio.id }}">@{{ barrio.nombre_barrio }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.barrio.$dirty && frm.barrio.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                          </div>


                         <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                     <label for="user_firstname">Corregimiento</label>
                                 <select name="corregimiento" ng-model="corregimiento" class="form-control" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedCorregimiento(corregimiento)'>
                                      <option value="">Seleccione Corregimiento</option>
                                      <option ng-repeat="corregimiento in corregimientos" value="@{{ corregimiento.id }}">@{{ corregimiento.descripcion }}</option>
                                    </select>
                                <span class="label label-danger" ng-show="frm.corregimiento.$dirty && frm.corregimiento.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                 <label for="user_firstname">Vereda</label>
                                    <select name="vereda" ng-model="vereda" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                  <option value="">Seleccione Departamento</option>
                                  <option ng-repeat="vereda in veredas" value="@{{ vereda.id }}">@{{ vereda.descripcion }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.vereda.$dirty && frm.vereda.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                   <label class="item-input"> <span class="input-label">
                                    Estado Civil</span>
                                    <select name="est_beneficiario" ng-model="est_beneficiario" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                      <option value="">Seleccione 
                                      Estado Civil</option>
                                      <option ng-repeat="est_beneficiario in estado_civil_beneficiario" value="@{{ est_beneficiario.id }}">@{{ est_beneficiario.nombre }}</option>
                                    </select>
                                    <span class="label label-danger" ng-show="frm.est_beneficiario.$dirty && frm.est_beneficiario.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                              <span class="label label-primary" id="codigo">Ficha</span>
                            </a></li>
                          </ul>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">¿Tiene hijos?</label>
                                <select name="hijo" ng-model="hijo" class="form-control" required style="width: 280px;" ng-change='selectedHijos(hijo)'>
                                  <option value="">Seleccione </option>
                                  <option ng-repeat="hijo in hijos" value="@{{ hijo.id }}">@{{ hijo.nombre }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.hijo.$dirty && frm.hijo.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                              <label for="user_lastname">¿Cuántos?</label>
                                <input type="text" type="number" class="form-control"  ng-model="cantidad_hijos" numbers-only  placeholder="Cuantos Hijos?"  ng-disabled="isDisabled">
                                <span class="label label-danger" ng-show="frm.cantidad_hijos.$dirty && frm.cantidad_hijos.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                  <label for="user_firstname">¿Cuál es su ocupación actual?</label>
                                <select name="ocupacion" ng-model="ocupacion" class="form-control" required style="width: 280px;" ng-change='selectedOcupacion(ocupacion)'>
                                  <option value="">Seleccione 
                                  Ocupación</option>
                                  <option ng-repeat="ocupacion in ocupaciones" value="@{{ ocupacion.id }}">@{{ ocupacion.nombre }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.ocupacion.$dirty && frm.ocupacion.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                               <label for="user_lastname">¿Cuál?</label>
                                <input type="text" class="form-control"  ng-model="ocupacion_otra" placeholder="Cual?"  ng-disabled="isDisabledOcupacion"> 
                                <br>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Nivel de escolaridad</span>
                                     <select name="escolaridad" ng-model="escolaridad" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                                      <option value="">Seleccione Nivel de escolaridad</option>
                                      <option ng-repeat="escolaridad in escolaridades" value="@{{ escolaridad.id }}">@{{ escolaridad.descripcion }}</option>
                                    </select>

                                    <span class="label label-danger" ng-show="frm.escolaridad.$dirty && frm.escolaridad.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname" style="position: relative; top: -17px;">¿De acuerdo con su cultura, pueblo o rasgos físicos, es o se reconoce como?</label>
                                <select name="cultura" ng-model="cultura" class="form-control" required style="width: 280px; position: relative; top: -17px;" ng-change='selectedCultura(cultura)'>
                                  <option value="">Seleccione</option>
                                  <option ng-repeat="cultura in culturas" value="@{{ cultura.id }}">@{{ cultura.nombre }}</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.cultura.$dirty && frm.cultura.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">¿Cuál?</label>
                                <input type="text" class="form-control"  ng-model="cultura_otro" placeholder="Cuál?" ng-disabled="isDisabledCultura">
                              </div>
                            </div>
                          </div>
                          <h4 class="ons  e"><span><b>¿Usted pertenece actualmente a alguno de estos grupos poblacionales, comunitarios y sociales? (Selección múltiple)</b></span></h4>
                          <div class="clearfix"></div><br>
                          <div class='row'>
                          <div class="col-md-12">
                            <div class='form-group'>
                            <p ng-repeat="grupo_poblacion in grupos_poblacionales" class="col-md-6">
                                <input type="checkbox" checklist-model="selected.poblacionales" checklist-value="grupo_poblacion" />
                                @{{grupo_poblacion.nombre}}<br/>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="clearfix"></div><br><br>
                        <div class='row'>
                          <div class='col-sm-4'>    
                            <div class='form-group'>
                              <div class="input-group">
                                <p class="input-group">
                                  <label class="item-input"> <span class="input-label">¿Presenta alguna discapacidad?.</span>
                                   <select name="discapacidad" ng-model="discapacidad" class="form-control" ng-change='selectedDiscapacidad(discapacidad)' required style="position: relative;
                                   top: 6px;">
                                   <option value="">Seleccione</option>
                                   <option ng-repeat="discapacidad in discapacidades" value="@{{ discapacidad.id }}">@{{ discapacidad.nombre }}</option>

                                 </select>
                                 <span class="label label-danger" ng-show="frm.discapacidad.$dirty && frm.discapacidad.$error.required">Requerido</span>

                                 <br>
                               </p>
                             </div>
                           </div>
                         </div>
                         <div class='col-sm-4'>
                          <div class='form-group'>
                            <label for="user_firstname" >Cuál?</label>
                            <select name="discapacidad_otro" ng-model="discapacidad_otro" class="form-control"  style="width: 280px;" ng-change='selectedCulturaOtro(discapacidad_otro)' ng-disabled="isDisabledDiscapacidad">
                              <option value="">Seleccione</option>
                              <option ng-repeat="discapacidad_otro in discapacidad_otra" value="@{{ discapacidad_otro.id }}">@{{ discapacidad_otro.nombre }}</option>
                            </select> 
                          </div>
                        </div>
                        <div class='col-sm-4'>
                          <div class='form-group'>
                            <label for="user_lastname">Otra ¿Cuál?</label>
                            <input type="text" class="form-control" ng-model="otra_discapacidad" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledDiscapacidad">
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_email">¿Padece alguna enfermedad permanente (crónica) que limite su actividad física?</label>
                            <select name="enfermedad" ng-model="enfermedad" class="form-control" required style="width: 280px;" ng-change='selectedEnfermedad(enfermedad)'>
                              <option value="">Seleccione</option>
                              <option ng-repeat="enfermedad in enfermedades" value="@{{ enfermedad.id }}">@{{ enfermedad.nombre }}</option>
                            </select>
                            <span class="label label-danger" ng-show="frm.enfermedad.$dirty && frm.enfermedad.$error.required">Requerido</span>
                          </div>
                        </div>
                        <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_email">¿Cuál?</label>
                            <input type="text" class="form-control" ng-model="otra_enfermedad" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledEnfermedad" style="position:  relative; top: 19px;">
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_email">¿Toma medicamentos de manera permanente?</label>
                            <select name="medicamento" ng-model="medicamento" class="form-control" required style="width: 280px;" ng-change='selectedMedicamento(medicamento)'>
                              <option value="">Seleccione</option>
                              <option ng-repeat="medicamento in medicamentos" value="@{{ medicamento.id }}">@{{ medicamento.nombre }}</option>
                            </select>
                          </div>
                        </div>
                        <div class='col-sm-6'>
                          <div class='form-group'>

                            <label for="user_email">¿Cuál(es)?</label>
                            <input class="form-control" size="30" type="text" placeholder="¿Cuál(es)?" disabled style="position: relative; top: -2px;" ng-disabled="isDisabledMedicamento" ng-model="medicamento_otro" />
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-sm-4'>    
                          <div class='form-group'>
                            <div class="input-group">
                              <p class="input-group">
                                <label class="item-input"> <span class="input-label">¿Se encuentra afiliado al Sistema General de Seguridad Social en Salud-SGSSS?</span>
                                 <select name="seguridad" ng-model="seguridad" class="form-control" required style="    position: relative;
                                 top: 6px" ng-change='selectedSeguridad(seguridad)'>
                                 <option value="">Seleccione</option>
                                 <option ng-repeat="seguridad in seguridad_social" value="@{{ seguridad.id }}">@{{ seguridad.nombre }}</option>

                               </select>
                               <span class="label label-danger" ng-show="frm.seguridad.$dirty && frm.seguridad.$error.required">Requerido</span>

                               <br>
                             </p>
                           </div>
                         </div>
                       </div>
                       <div class='col-sm-4'>
                        <div class='form-group'>
                          <label for="user_firstname" >Cuál?</label>
                          <select name="salud" ng-model="salud" class="form-control"  style="     position: relative;
                          top: 18px" ng-disabled="isDisabledSeguridad">
                          <option value="">Seleccione</option>
                          <option ng-repeat="salud in salud_sgsss" value="@{{ salud.id }}">@{{ salud.nombre }}</option>
                        </select>
                        <br>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_lastname">Nombre de la entidad a la que se encuentra afiliado</label>
                        <input type="text" class="form-control" ng-model="nombre_entidad" placeholder="Nombre entidad" ng-disabled="isDisabledSeguridad">
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div><br>
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                      <span class="label label-success" id="codigo">Identificación del Padre de Familia / Acudiente / Cuidador</span>
                    </a></li>
                  </ul>
                  <div class="clearfix"></div><br>
                  <div class='row'>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">No Documento</label>
                            <input class="form-control" placeholder="Digita Número de Documento" type="text" name="integer-data-attribute" data-thousands="."  ng-model="no_documento_acudiente" required="true" />
  
                        <span class="label label-danger" ng-show="frm.no_documento_acudiente.$dirty && frm.no_documento_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Tipo Documento</label>
                        <select name="tip_doc_acudiente" ng-model="tip_doc_acudiente" class="form-control" required>
                                    <option value="">Tipo Documento</option>
                                    <option ng-repeat="tip_documento_acudiente in tipo_documento" value="@{{ tip_documento_acudiente.id }}">@{{ tip_documento_acudiente.descripcion }}</option>

                                </select>
                        <span class="label label-danger" ng-show="frm.tip_doc_acudiente.$dirty && frm.tip_doc_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                    
                  </div>
                  <div class='row'>
                    <div class='col-sm-6'>    
                      <div class='form-group'>
                        <label for="user_firstname">Primer Nombre</label>
                        <input type="text" class="form-control" ng-model="primer_nombre_acudiente" placeholder="Primer Nombre">
                        <span class="label label-danger" ng-show="frm.primer_nombre_acudiente.$dirty && frm.primer_nombre_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Segundo Nombre</label>
                        <input type="text" class="form-control" ng-model="segundo_nombre_acudiente" placeholder="Segundo Nombre">

                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-6'>    
                      <div class='form-group'>
                        <label for="user_firstname">Primer Apellido</label>
                        <input type="text" class="form-control" ng-model="primer_apellido_acudiente" placeholder="Primer Apellido">
                        <span class="label label-danger" ng-show="frm.primer_apellido_acudiente.$dirty && frm.primer_apellido_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Segundo Apellido</label>
                        <input type="text" class="form-control" ng-model="segundo_apellido_acudiente" placeholder="Segundo Apellido">

                      </div>
                    </div>
                  </div>
                  
                    <div class='row'>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Sexo</label>
                         <select name="sex_pariente" ng-model="sex_pariente" class="form-control" required style="width: 280px; position: relative; top: 6px;">
                              <option value="">Seleccione Sexo</option>
                              <option ng-repeat="sex in sexo" value="@{{ sex.id }}">@{{ sex.nombre }}</option>

                            </select>
 
                        <span class="label label-danger" ng-show="frm.sex_pariente.$dirty && frm.sex_pariente.$error.required">Requerido</span>
                      </div>
                    </div>

                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Fecha Nacimiento</label>
                        <input class="form-control" type="text" id="fecha_nacimiento_acudiente" ng-model="fecha_nacimiento_acudiente" placeholder="año/mes/día">
                        <span class="label label-danger" ng-show="frm.fecha_nacimiento_acudiente.$dirty && frm.fecha_nacimiento_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                  </div>

                  <div class='row'>
                     <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Telefono Fijo</label>
                        <input type="text" class="form-control"  ng-model="telefono_fijo_acudiente" numbers-only  placeholder="Telefono Fijo" required>
                         <span class="label label-danger" ng-show="frm.telefono_fijo_acudiente.$dirty && frm.telefono_fijo_acudiente.$error.required">Requerido</span>

                      </div>
                    </div>

                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Telefono Movil</label>
                        <input type="text" numbers-only  class="form-control"  ng-model="telefono_movil_acudiente" placeholder="Telefono Movil" required>
                         <span class="label label-danger" ng-show="frm.telefono_movil_acudiente.$dirty && frm.telefono_movil_acudiente.$error.required">Requerido</span>

                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_lastname">Correo Electronico</label>
                        <input type="text" class="form-control" ng-model="correo_acudiente" placeholder="Correo Electronico" required>
                        <span class="label label-danger" ng-show="frm.correo_acudiente.$dirty && frm.correo_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Parentesco:</label>
                        <select name="parentesco" ng-model="parentesco" class="form-control" required ng-change='selectedParentesco(parentesco)'>
                          <option value="">Seleccione</option>
                          <option ng-repeat="parentesco in parentescos" value="@{{ parentesco.id }}">@{{ parentesco.nombre }}</option>
                        </select>
                        <span class="label label-danger" ng-show="frm.parentesco.$dirty && frm.parentesco.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">¿Cuál?</label>
                        <input class="form-control" ng-model="otro_parentesco" size="30" type="text" placeholder="¿Cuál?" ng-disabled="isDisabledParentesco"/>
                      </div>
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
                      <button type="submit" class="btn btn-success" ng-click="formsubmit( frm.$valid)" ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Crear Beneficiario</button>
                      <a href="{{url('/admin/postbeneficiarios#/admin/postbeneficiarios')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div><br><br>
              </label>
            </p>
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



