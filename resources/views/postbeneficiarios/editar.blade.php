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
                        <span class="label label-success" id="codigo">FICHA DE INSCRIPCIÓN Y CARACTERIZACIÓN DE USUARIOS-
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
                                  <input type="text" class="form-control" value="@{{no_ficha}}" ng-model="serie.no_ficha" placeholder="No Ficha" ng-blur="onBlurFicha($event)">
                              </div>
                            </div>
                              <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Fecha Inscripción</label>
                                <input class="form-control" type="text" id="fecha_inscripcion" value="@{{fecha_inscripcion}}" ng-model="serie.fecha_inscripcion" placeholder="año/mes/día">
                                <span class="label label-danger" ng-show="frm.fecha_inscripcion.$dirty && frm.fecha_inscripcion.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Modalidad</label>
                                <input type="text" class="form-control" value="@{{modalidad}}" ng-model="serie.modalidad"  placeholder="Modalidad">
                                <span class="label label-danger" ng-show="frm.modalidad.$dirty && frm.modalidad.$error.required" >Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Punto de atención</label>
                                <input type="text" class="form-control" value="@{{punto_atencion}}" ng-model="serie.punto_atencion" placeholder="Punto de atención">
                                <span class="label label-danger" ng-show="frm.punto_atencion.$dirty && frm.punto_atencion.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>

                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                              <span class="label label-primary" id="codigo">Identificación del Usuario-Beneficiario</span>
                            </a></li>
                          </ul>

                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">No Documento</label>
                                <input class="form-control" value="@{{documento}}" ng-model="serie.documento" name="integer-data-attribute" data-thousands="." type="text" ng-blur="onBlurDocumento($event)" required="true" size="30" placeholder="No Documento" />
                                 <div id="repetido_no_documento">
                                  <span class="label label-danger" ng-show="frm.no_documento_persona.$dirty &&   frm.no_documento_persona.$error.required">Requerido</span>
                                </div>
                              </div>
                            </div>




                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Tipo Documento</label>                                   
                                  <select class="form-control" name="tipo_dc" id="tipo_dc" required ng-change="unitChanged()" ng-model="tipo_doc.unit" ng-options="unit.id as unit.descripcion for unit in tipodocumento"></select>
                                <span class="label label-danger" ng-show="frm.tipo_doc_persona.$dirty && frm.tipo_doc_persona.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>



                        <div class="clearfix"></div><br>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Primer Nombre</label>
                                <input type="text" class="form-control" value="@{{nombre_primero}}" ng-model="serie.nombre_primero" placeholder="Primer Nombre" required>
                                <span class="label label-danger" ng-show="frm.nombre_primero.$dirty && frm.nombre_primero.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Segundo Nombre</label>
                                <input type="text" class="form-control" value="@{{nombre_segundo}}" ng-model="serie.nombre_segundo" placeholder="Segundo Nombre">
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>    
                              <div class='form-group'>
                                <label for="user_firstname">Primer Apellido</label>
                                <input type="text" class="form-control" value="@{{apellido_primero}}" ng-model="serie.apellido_primero" placeholder="Primer Apellido" required>
                                <span class="label label-danger" ng-show="frm.apellido_primero.$dirty && frm.apellido_primero.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_firstname">Segundo Apellido</label>
                                <input type="text" class="form-control" value="@{{apellido_segundo}}" ng-model="serie.apellido_segundo" placeholder="Segundo Apellido">
                              </div>
                            </div>
                          </div>
                          

                         <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Sexo</span>
                                      <select class="form-control" ng-model="obsexo.sexoId" ng-options="sex.id as sex.nombre for sex in obsexo.sexo" required style="width: 280px; position: relative; top: 6px;"></select>
                                   <span class="label label-danger" ng-show="frm.sexo_persona.$dirty && frm.sexo_persona.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Fecha Nacimiento</label>
                                 <input class="form-control" type="text" id="fecha_nacimiento" value="@{{fecha_nacimiento}}" ng-model="serie.fecha_nacimiento" placeholder="día/mes/año">
                                <span class="label label-danger" ng-show="frm.startDate.$dirty && frm.startDate.$error.required">Requerido</span>
                                
                              </div>
                            </div>

                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Tipo de Sangre</span>
                                    <select class="form-control" ng-model="obtipo_sangre.tipo_sangreId" ng-options="esc.nombre as esc.nombre for esc in obtipo_sangre.tipo_sangre" required style="width: 280px; position: relative; top: 6px;" required></select>

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
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Telefono Fijo</span>
                                      <input class="form-control" required="true" size="30" type="text" placeholder="Telefono Fijo" numbers-only type="number" value="@{{telefono_fijo}}" ng-model="serie.telefono_fijo"/>

                                    <span class="label label-danger" ng-show="frm.telefono_fijo_persona.$dirty && frm.telefono_fijo_persona.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Telefono Movil</label>
                                 <input class="form-control" numbers-only required="true" size="30" type="text" placeholder="Telefono Movil" type="number" value="@{{telefono_movil}}" ng-model="serie.telefono_movil"/>

                                <span class="label label-danger" ng-show="frm.telefono_movil_persona.$dirty && frm.telefono_movil_persona.$error.required">Requerido</span>
                                
                              </div>
                            </div>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">Correo Electronico</span>
                                       <input class="form-control" required size="30" type="email" placeholder="Correo electronico" value="@{{correo_electronico}}" ng-model="serie.correo_electronico" />
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
                                    <select class="form-control" name="pais" id="pais" required ng-change='selectedPais(data.unit)' ng-model="data.unit" ng-options="unit.id as unit.nombre_pais for unit in paises" style="width: 280px; position: relative; top: 6px;"></select>

                                    <span class="label label-danger" ng-show="frm.pais.$dirty && frm.pais.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname">Departamento</label>
                                <select class="form-control" name="departamento" id="departamento" required  ng-model="datas.unit" ng-change='selectedDepartamento(datas.unit)' ng-options="unit.id as unit.nombre_departamento for unit in departamentos" style="width: 280px; position: relative; top: 6px;"></select>
                              
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">Municipio</label>
                               <select class="form-control" name="municipio" id="municipio" required  ng-model="data_municipio.unit" ng-options="unit.id as unit.nombre_municipio for unit in municipios" style="width: 280px; position: relative; top: 6px;"></select>
                                <span class="label label-danger" ng-show="frm.data_municipio.unit.$dirty && frm.data_municipio.unit.$error.required">Requerido</span>
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
                                <input class="form form-control"  size="30" type="text" placeholder="Dirección de residencia"   id="id_persona_beneficiario_residencia_direccion"  name="id_persona_beneficiario[residencia_direccion]" readonly value="@{{residencia_direccion}}" ng-model="serie.residencia_direccion"/>

                                <span class="label label-danger" ng-show="frm.residencia_beneficiario.$dirty && frm.residencia_beneficiario.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Estrato</label>
                                <input class="form-control" required= size="30" type="text" placeholder="Estrato" value="@{{residencia_estrato}}" ng-model="serie.residencia_estrato" />
                                <span class="label label-danger" ng-show="frm.estrato.$dirty && frm.estrato.$error.required">Requerido</span>
                              </div>
                            </div>
                          </div>
                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Comuna</label>
                                  <select class="form-control" name="comuna" id="comuna" required ng-change='selectedComuna(data_comuna.unit)' ng-model="data_comuna.unit" ng-options="unit.id as unit.nombre_comuna for unit in comunas" style="width: 280px; position: relative; top: 6px;"></select>
                                <span class="label label-danger" ng-show="frm.data_comuna.unit.$dirty && frm.data_comuna.unit.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                <label for="user_email">Barrio</label>
                                <select class="form-control" name="barrio" id="barrio" required  ng-model="data_barrio.unit" ng-options="unit.id as unit.nombre_barrio for unit in barrios" style="width: 280px; position: relative; top: 6px;"></select>
                                <span class="label label-danger" ng-show="frm.data_barrio.unit.$dirty && frm.data_barrio.unit.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                          </div>




  <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                     <label for="user_firstname">Corregimiento</label>        <select class="form-control" name="pais" id="pais" required ng-change='selectedCorregimiento(data_corregimiento.unit)' ng-model="data_corregimiento.unit" ng-options="unit.id as unit.descripcion for unit in corregimientos" style="width: 280px; position: relative; top: 6px;"></select>

                                <span class="label label-danger" ng-show="frm.corregimiento.$dirty && frm.corregimiento.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                 <label for="user_firstname">Vereda</label>
                                  <select class="form-control" name="departamento" id="departamento" required  ng-model="datas_veredas.unit" ng-options="unit.id as unit.descripcion for unit in veredas" style="width: 280px; position: relative; top: 6px;"></select>

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
                                    <select class="form-control" name="civil" id="civil" required ng-model="data_civil.unit" ng-options="unit.id as unit.descripcion for unit in estados_civiles" style="width: 280px; position: relative; top: 6px;"></select>
                                    <span class="label label-danger" ng-show="frm.data_civil.unit.$dirty && frm.data_civil.unit.$error.required">Requerido</span>
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
                                 <select class="form-control" ng-model="obhijos.hijosId" ng-options="hijos.id as hijos.nombre for hijos in obhijos.hijos" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedHijos(obhijos.hijosId)'></select>
                                <span class="label label-danger" ng-show="frm.hijo.$dirty && frm.hijo.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                              <label for="user_lastname">¿Cuántos?</label>
                                <input type="text" type="number" class="form-control"  placeholder="Cuantos Hijos?"  ng-disabled="isDisabled" value="@{{cantidad_hijos_beneficiario}}" ng-model="serie.cantidad_hijos_beneficiario">
                               
                                <br>
                              </div>
                            </div>
                          </div>




                          <div class='row'>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                                  <label for="user_firstname">¿Cuál es su ocupación actual?</label>
                                   <select class="form-control" ng-model="obocupacion.ocupacionId" ng-options="esc.id as esc.nombre for esc in obocupacion.ocupacion" ng-change='selectedOcupacion(obocupacion.ocupacionId)' required style="width: 280px; position: relative; top: 6px;" required></select>

                                <span class="label label-danger" ng-show="frm.ocupacion.$dirty && frm.ocupacion.$error.required">Requerido</span>
                                <br>
                              </div>
                            </div>
                            <div class='col-sm-6'>
                              <div class='form-group'>
                               <label for="user_lastname">¿Cuál?</label>
                                <input type="text" class="form-control"   placeholder="Cual?"  ng-disabled="isDisabledOcupacion" value="@{{otra_ocupacion_beneficiario}}" ng-model="serie.otra_ocupacion_beneficiario"> 
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
                                    <select class="form-control" name="escolaridad" id="escolaridad" required  ng-model="data_escolaridad.unit" ng-options="unit.id as unit.descripcion for unit in escolaridades" style="width: 280px; position: relative; top: 6px;"></select>

                                    <span class="label label-danger" ng-show="frm.obescolaridad.escolaridadId.$dirty && frm.obescolaridad.escolaridadId.$error.required">Requerido</span>
                                    <br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_firstname" style="position: relative; top: -17px;">¿De acuerdo con su cultura, pueblo o rasgos físicos, es o se reconoce como?</label>
                                   <select class="form-control" ng-model="obcultura.culturaId" ng-options="cult.id as cult.nombre for cult in obcultura.cultura" required style="width: 280px; position: relative; top: -17px;" required ng-change='selectedCultura(obcultura.culturaId)'></select>

                                <span class="label label-danger" ng-show="frm.cultura.$dirty && frm.cultura.$error.required">Requerido</span>
                              </div>
                            </div>
                            <div class='col-sm-4'>
                              <div class='form-group'>
                                <label for="user_lastname">¿Cuál?</label>
                                <input type="text" class="form-control"  value="@{{otra_cultura_beneficiario  }}" ng-model="serie.otra_cultura_beneficiario" placeholder="Cuál?" ng-disabled="isDisabledCultura">
                              </div>
                            </div>
                          </div>
                          <h4 class="ons  e"><span><b>¿Usted pertenece actualmente a alguno de estos grupos poblacionales, comunitarios y sociales? (Selección múltiple)</b></span></h4>
                          <div class="clearfix"></div><br>
                          <label ng-repeat="grupo_poblacion in grupos_poblacionales" style="margin-bottom: 35px;
                          margin-left: 23px;"><input type="checkbox" checklist-model="selected.poblacionales" checklist-value="grupo_poblacion" />@{{grupo_poblacion.nombre}}<br/> </label>

                        <div class='row'>
                          <div class="col-md-12">
                            <div class='form-group'> 
                            <p ng-repeat="seleccion in allGrupos_poblacionales" class="col-md-6">
                                  <input type="checkbox" ng-checked="selectedPoblacionales.containsObjectWithProperty('id', seleccion.id)" ng-click="toggleSelection(seleccion)" />
                                  @{{seleccion.name}}
                                </p>
                              </div>
                            </div>
                            </div>
                          <hr />

                          <div class="clearfix"></div><br><br>
                          <div class='row'>
                            <div class='col-sm-4'>    
                              <div class='form-group'>
                                <div class="input-group">
                                  <p class="input-group">
                                    <label class="item-input"> <span class="input-label">¿Presenta alguna discapacidad?.</span>
                                     <select class="form-control" ng-model="obdiscapacidad.discapacidadId" ng-options="disc.id as disc.nombre for disc in obdiscapacidad.discapacidad" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedDiscapacidad(obdiscapacidad.discapacidadId)'></select>
                                   <span class="label label-danger" ng-show="frm.obdiscapacidad.discapacidadId.$dirty && frm.obdiscapacidad.discapacidadId.$error.required">Requerido</span>

                                   <br>
                                 </p>
                               </div>
                             </div>
                           </div>
                           <div class='col-sm-4'>
                            <div class='form-group'>
                              <label for="user_firstname" >Cuál?</label>

                                <select class="form-control" name="tipo_dco" id="tipo_dco"  ng-model="tipo_disc_otra.unit" ng-options="unit.id as unit.descripcion for unit in discapacidad_otra"  style="width: 280px; position: relative; top: 6px;" ng-disabled="isDisabledDiscapacidadCual">
                                <option value=''>Seleccione</option>
                              </select>


                            </div>
                          </div>
                          <div class='col-sm-4'>
                            <div class='form-group'>
                              <label for="user_lastname">Otra ¿Cuál?</label>
                              <input type="text" class="form-control" value="@{{otra_discapacidad_beneficiario }}" ng-model="serie.otra_discapacidad_beneficiario" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledDiscapacidad">
                            </div>
                          </div>
                        </div>
                        <div class='row'>
                          <div class='col-sm-6'>
                            <div class='form-group'>
                              <label for="user_email">¿Padece alguna enfermedad permanente (crónica) que limite su actividad física?</label>
                              <select class="form-control" ng-model="obenfermedad.enfermedadId" ng-options="enf.id as enf.nombre for enf in obenfermedad.enfermedad" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedEnfermedad(obenfermedad.enfermedadId)'></select>
                              <span class="label label-danger" ng-show="frm.obenfermedad.enfermedadId.$dirty && frm.obenfermedad.enfermedadId.$error.required">Requerido</span>
                            </div>
                          </div>
                          <div class='col-sm-6'>
                            <div class='form-group'>
                              <label for="user_email">¿Cuál?</label>
                              <input type="text" class="form-control" value="@{{enfermedad_beneficiario }}" ng-model="serie.enfermedad_beneficiario" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledEnfermedad">
                            </div>
                          </div>
                        </div>
                        <div class='row'>
                          <div class='col-sm-6'>
                            <div class='form-group'>
                              <label for="user_email">¿Toma medicamentos de manera permanente?</label>
                             <select class="form-control" ng-model="obmedicamento.medicamentoId" ng-options="medic.id as medic.nombre for medic in obmedicamento.medicamento" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedMedicamento(obmedicamento.medicamentoId)'></select>
                            </div>
                          </div>
                          <div class='col-sm-6'>
                            <div class='form-group'>

                              <label for="user_email">¿Cuál(es)?</label>
                              <input class="form-control" size="30" type="text" placeholder="¿Cuál(es)?" disabled style="position: relative; top: -2px;" ng-disabled="isDisabledMedicamento" value="@{{medicamentos_beneficiario }}" ng-model="serie.medicamentos_beneficiario" />
                            </div>
                          </div>
                        </div>
                        <div class='row'>
                          <div class='col-sm-4'>    
                            <div class='form-group'>
                              <div class="input-group">
                                <p class="input-group">
                                  <label class="item-input"> <span class="input-label">¿Se encuentra afiliado al Sistema General de Seguridad Social en Salud-SGSSS?</span>
                                    <select class="form-control" ng-model="obseguridadsocial.seguridadsocialId" ng-options="seguridad.id as seguridad.nombre for seguridad in obseguridadsocial.seguridadsocial" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedSeguridad(obseguridadsocial.seguridadsocialId)'></select>
                                 <span class="label label-danger" ng-show="frm.obseguridadsocial.seguridadsocialId.$dirty && frm.obseguridadsocial.seguridadsocialId.$error.required">Requerido</span>

                                 <br>
                               </p>
                             </div>
                           </div>
                         </div>
                         <div class='col-sm-4'>
                          <div class='form-group'>
                            <label for="user_firstname" >Cuál?</label>
                              <select class="form-control" ng-model="obsaludsgss.saludsgssId" ng-options="saludsgss.id as saludsgss.nombre for saludsgss in obsaludsgss.saludsgss"  style="width: 280px; position: relative; top: 6px;" ng-change='selectedSaludGgss(obsaludsgss.saludsgssId)' ng-disabled="isDisabledSeguridadCual"></select>
                          <br>
                        </div>
                      </div>
                      <div class='col-sm-4'>
                        <div class='form-group'>
                          <label for="user_lastname">Nombre de la entidad a la que se encuentra afiliado</label>
                          <input type="text" class="form-control" value="@{{nombre_seguridad_beneficiario }}" ng-model="serie.nombre_seguridad_beneficiario" placeholder="Nombre entidad" ng-disabled="isDisabledSeguridad">
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
                        <input class="form-control" type="text" size="30" type="text" / placeholder="No Documento" value="@{{documento_acudiente}}" ng-model="serie.documento_acudiente">
                        <span class="label label-danger" ng-show="frm.no_documento_acudiente.$dirty && frm.no_documento_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Tipo Documento</label>
                          
                          <select class="form-control" name="documento_acudiente" id="documento_acudiente" required  ng-model="data_documento.unit" ng-options="unit.id as unit.descripcion for unit in tipo_documento" style="width: 280px; position: relative; top: 6px;"></select>

                        <span class="label label-danger" ng-show="frm.tip_doc_acudiente.$dirty && frm.tip_doc_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                    
                  </div>
                  <div class='row'>
                    <div class='col-sm-6'>    
                      <div class='form-group'>
                        <label for="user_firstname">Primer Nombre</label>
                        <input type="text" class="form-control" placeholder="Primer Nombre" value="@{{nombre_primero_acudiente}}" ng-model="serie.nombre_primero_acudiente">
                        <span class="label label-danger" ng-show="frm.primer_nombre_acudiente.$dirty && frm.primer_nombre_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Segundo Nombre</label>
                        <input type="text" class="form-control" placeholder="Segundo Nombre" value="@{{nombre_segundo_acudiente}}" ng-model="serie.nombre_segundo_acudiente">

                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-6'>    
                      <div class='form-group'>
                        <label for="user_firstname">Primer Apellido</label>
                        <input type="text" class="form-control" placeholder="Primer Apellido" value="@{{apellido_primero_acudiente}}" ng-model="serie.apellido_primero_acudiente">
                        <span class="label label-danger" ng-show="frm.primer_apellido_acudiente.$dirty && frm.primer_apellido_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Segundo Apellido</label>
                        <input type="text" class="form-control" placeholder="Segundo Apellido" value="@{{apellido_segundo_acudiente}}" ng-model="serie.apellido_segundo_acudiente">

                      </div>
                    </div>
                  </div>
                  

                   <div class='row'>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Sexo</label>
                        <select class="form-control" ng-model="obsexo_acudiente.sexo_acudienteId" ng-options="sexo_acudiente.id as sexo_acudiente.nombre for sexo_acudiente in obsexo_acudiente.sexo_acudiente" required style="width: 280px; position: relative; top: 6px;"></select>
 
                        <span class="label label-danger" ng-show="frm.sex_pariente.$dirty && frm.sex_pariente.$error.required">Requerido</span>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>

                        <label for="user_email">Fecha Nacimiento</label>
                      <input class="form-control" type="text" id="fecha_nacimiento_acudiente" value="@{{fecha_nacimiento_acudiente}}" ng-model="serie.fecha_nacimiento_acudiente" placeholder="día/mes/año">    
                        <span class="label label-danger" ng-show="frm.startDateParentesco.$dirty && frm.startDateParentesco.$error.required">Requerido</span>
                      </div>
                    </div>
                  </div>


                  <div class='row'>
                     <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Telefono Fijo</label>
                        <input type="text" class="form-control"   placeholder="Telefono Fijo" required value="@{{telefono_fijo_acudiente}}" ng-model="serie.telefono_fijo_acudiente">
                         <span class="label label-danger" ng-show="frm.telefono_fijo_acudiente.$dirty && frm.telefono_fijo_acudiente.$error.required">Requerido</span>

                      </div>
                    </div>

                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Telefono Movil</label>
                        <input type="text" class="form-control" placeholder="Telefono Movil" required value="@{{telefono_movil_acudiente}}" ng-model="serie.telefono_movil_acudiente">
                         <span class="label label-danger" ng-show="frm.telefono_movil_acudiente.$dirty && frm.telefono_movil_acudiente.$error.required">Requerido</span>

                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_lastname">Correo Electronico</label>
                        <input type="text" class="form-control" placeholder="Correo Electronico" required value="@{{correo_electronico_acudiente}}" ng-model="serie.correo_electronico_acudiente">
                        <span class="label label-danger" ng-show="frm.correo_acudiente.$dirty && frm.correo_acudiente.$error.required">Requerido</span>
                      </div>
                    </div>
                  </div>

                    <div class='row'>
                      <div class='col-sm-6'>
                        <div class='form-group'>
                          <label for="user_email">Parentesco:</label>
                            <select class="form-control" ng-model="obparentesco.parentescoId" ng-options="parentes.id as parentes.nombre for parentes in obparentesco.parentesco" required style="width: 280px; position: relative; top: 6px;" ng-change='selectedTipoDocAcudiente(obparentesco.parentescoId)'></select>
                          <span class="label label-danger" ng-show="frm.obparentesco.parentescoId.$dirty && frm.obparentesco.parentescoId.$error.required">Requerido</span>
                        </div>
                      </div>
                      <div class='col-sm-6'>
                        <div class='form-group'>
                          <label for="user_email">¿Cuál?</label>
                          <input class="form-control required email" size="30" type="text" placeholder="¿Cuál?" ng-disabled="isDisabledParentesco" value="@{{otro_parentesco_acudiente}}" ng-model="serie.otro_parentesco_acudiente"/>
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
                        <button type="submit" class="btn btn-success" ng-click="formsubmit(serie.id, frm.$valid)" ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar Beneficiario</button>

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



