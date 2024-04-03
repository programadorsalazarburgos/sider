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
                        <span class="label label-success" id="codigo">Registro del personal</span>
                        </a>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div id="resultados_ajax"></div>
                      <div class="tab-pane active" id="details">
                        <div class="clearfix"></div>
                        <br>
                        <fieldset>
                          <legend>Datos básicos</legend>
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-tipo_doc">Tipo documento</label>
                            <select class="form-control" name="tipo_dc" id="tipo_dc" required ng-change="unitChanged()" ng-model="tipo_doc.unit" ng-options="unit.id as unit.descripcion for unit in tipodocumento">
                              <option value=''>Seleccione tipo documento</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-documento">Documento</label>
                            <div class="input-group">
                              <input class="form-control" placeholder="Digita Número de Documento" type="text" name="integer-data-attribute" data-thousands="." ng-blur="onBlurDocumento($event)" ng-model="no_documento_persona" required="true" />
                              <span class="input-group-btn">
                              <button onclick="change_documento()" class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                              </span>
                            </div>
                          </div>
                        </fieldset>
                        <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_firstname">Primer Nombre</label>
                            <input type="text" class="form-control" value="@{{nombre_primero}}" ng-model="serie.nombre_primero"  placeholder="Primer Nombre" required>
                            <span class="label label-danger" ng-show="frm.serie.nombre_primero.$dirty && frm.serie.nombre_primero.$error.required">Requerido</span>
                          </div>
                        </div>
                        <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_firstname">Segundo Nombre</label>
                            <input type="text" class="form-control" value="@{{nombre_segundo}}" ng-model="serie.nombre_segundo" placeholder="Segundo Nombre">
                          </div>
                        </div>
                        <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_firstname">Primer Apellido</label>
                            <input type="text" class="form-control" value="@{{apellido_primero}}" ng-model="serie.apellido_primero" placeholder="Primer Apellido" required>
                            <span class="label label-danger" ng-show="frm.primer_apellido_persona.$dirty && frm.primer_apellido_persona.$error.required">Requerido</span>
                          </div>
                        </div>
                        <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_firstname">Segundo Apellido</label>
                            <input type="text" class="form-control" value="@{{apellido_segundo}}" ng-model="serie.apellido_segundo" placeholder="Segundo Apellido">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-email">Email</label>
                          <input type="text" class="form-control" value="@{{correo_electronico}}" ng-model="serie.correo_electronico" placeholder="Correo Electronico">
                        </div>
                        <div class="col-md-3">
                          <label class="control-label" for="empleado-sexo">Genero</label>
                          <select class="form-control" name="tipo_sx" id="tipo_sx" required  ng-model="tipo_sex.unit" ng-options="unit.id as unit.nombre for unit in sexo">
                            <option value=''>Seleccione sexo</option>
                          </select>
                          <span class="label label-danger" ng-show="frm.tipo_sex.unit.$dirty && frm.tipo_sex.unit.$error.required">Requerido</span>
                        </div>
                        <div class="col-md-3">
                          <label class="control-label" for="empleado-fecha_nacimiento">Fecha Nacimiento</label>
                          <input class="form-control" type="text" id="fecha_nacimiento" value="@{{fecha_nacimiento}}" ng-model="serie.fecha_nacimiento" placeholder="año/mes/día">
                          <span class="label label-danger" ng-show="frm.fecha_nacimiento.$dirty && frm.fecha_nacimiento.$error.required">Requerido</span> 
                        </div>
                        <div class="panel">
                          <div class="panel-heading" style="position:relative: top:8px;">Datos de nacimiento</div>
                          <div class="panel-body">
                            <div class="container-fluid">
                              <div class="col-md-4">
                                 
                                <label class="control-label" for="empleado-id_pais" style="position:  relative; right: 31px;">Pais de procedencia</label>
                                <select chosen ng-model="pais" class="form-control" ng-options="s.id as s.nombre_pais for s in paises" ng-change='selectedPais(pais)'>
                                  <option value="">Seleccione Pais</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.pais.$dirty && frm.pais.$error.required">Requerido</span>
                              </div>
                              <div ng-show="ngShowhide1">
                                <div class="col-md-4">
                                  <label class="control-label" for="empleado-id_departamento" style="position:  relative; right: 31px;">Departamentos</label>
                                  <select chosen class="form-control" name="dept" id="dept" required  ng-model="departamento" ng-options="unit.id as unit.nombre_departamento for unit in departamentos" ng-change='selectedDepartamento(departamento)'>
                                      <option value=''>Seleccione Departamento</option>
                                  </select>
                                  <span class="label label-danger" ng-show="frm.departamento.$dirty && frm.departamento.$error.required">Requerido</span>
                                </div>
                                <div class="col-md-4">
                                  <label class="control-label" for="empleado-id_ciudad" style="position:  relative; right: 31px;">Ciudad</label>
                                  <select chosen class="form-control" name="munic" id="munic" required  ng-model="municipio" ng-options="munc.id as munc.nombre_municipio for munc in municipios">
                                      <option value=''>Seleccione municipio</option>
                                  </select>
                                  <span class="label label-danger" ng-show="frm.municipio.$dirty && frm.municipio.unit.$error.required">Requerido</span>
                                </div>
                              </div>
                              <div ng-show="ngShowhide2">
                                <div class="col-md-8">
                                  <label class="control-label" for="empleado-id_ciudad">Departamento/Ciudad</label>
                                  
                                  <input type="text" ng-model="otro_municipio" placeholder="Departamento/municipio" class="form form-control"/>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading" style="position:relative: top:8px;">Residencia</div>
                            <div class="panel-body">
                              <div class="container-fluid">
                                <div class="col-md-6">
                                   
                                  <label class="control-label" for="empleado-id_pais" style="position:  relative; right: 31px;">Corregimiento</label>
                                  <select chosen class="form-control" name="correg" id="correg"  ng-model="corregimiento" ng-options="correg.id as correg.descripcion for correg in corregimientos" ng-change='selectedCorregimiento(corregimiento)'>
                                      <option value=''>Seleccione Corregimiento</option>
                                  </select>
    
                                </div>
                                <div ng-show="ngShowhide1">
                                  <div class="col-md-6">
                                    <label class="control-label" for="empleado-id_departamento" style="position:  relative; right: 31px;">Vereda</label>
                                    <select chosen class="form-control" name="vered" id="vered"   ng-model="vereda" ng-options="verd.id as verd.nombre for verd in veredas" ng-change='selectedVereda(vereda)'>
                                        <option value=''>Seleccione Vereda</option>
                                    </select>
    
                                  </div>
                                  
                        <div class="clearfix"><br><br><br><br>
                          <div class="col-md-4" id="div_persona_id_residencia_barrio" ng-show="ngShowhideBarrio">
                            <label class="control-label" for="empleado-barrio" style="position:  relative; right: 30px;">Barrio</label>
                            <select chosen class="form-control" name="barr"  id="barr"   ng-model="barrio" ng-options="bar.id as bar.nombre_barrio for bar in barrios" ng-change='selectedBarrio(barrio)'>
                                <option value=''>Seleccione Barrio</option>
                            </select>
                            <span class="label label-danger" ng-show="frm.barrio.unit.$dirty && frm.barrio.unit.$error.required">Requerido</span>
                          </div>
                          <div class="col-md-4">
                            <label class="control-label" for="empleado-estrato">Estrato</label>
                            <select class="form-control" name="tipo_sx" id="tipo_sx" required  ng-model="tipo_estrato.unit" ng-options="unit.id as unit.nombre for unit in estrato">
                              <option value=''>Seleccione estrato</option>
                            </select>
                            <span class="label label-danger" ng-show="frm.tipo_estrato.unit.$dirty && frm.tipo_estrato.unit.$error.required">Requerido</span>
                          </div>
                          <div class="col-md-4">
                            <label class="control-label" for="empleado-Comuna">Comuna</label>
                            <input value="@{{residencia_direccion}}" ng-model="comuna"  type="text" class="form form-control" id="comuna" readonly="true" style="background-color: #FFF;"/>
                          </div>
                          
                        </div>
                                
                      </div>
                    </div>
                    </div>
    
    
                          <div class="col-md-12">
                            <div id="modalIngresoDireccion" class="modal fade modal-change" role="dialog" aria-hidden="true" ></div>
                          </div>
                          <div class="col-md-6" id="div_direccion" ng-show="ngShowhideDireccion">
                            <label class="control-label" for="empleado-direccion">Direccion</label>
                            <input type="text" id="id_persona_beneficiario_residencia_direccion" class="form form-control" value="@{{residencia_direccion}}" ng-model="serie.residencia_direccion" style="background-color: #FFF;">
                          </div>
                          <div class="col-md-6" id="div_complemento" ng-show="ngShowhideComplemento">
                            <label class="control-label" for="empleado-direccion">Complemento</label>
                            <input type="text" id="id_persona_beneficiario_residencia_direccion_complemento" placeholder="Complemento de la direccion" class="form form-control" ng-model="complemento" style="background-color: #FFF;">
                          </div>
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-telefono">Telefono</label>
                            <input placeholder="Telefono" type="text" class="form-control" only-number value="@{{telefono_fijo}}" ng-model="serie.telefono_fijo" />
                          </div>
                         
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-celular">Celular</label>
                            <input class="form-control" numbers-only  required="true" size="30" type="text" placeholder="Telefono Movil" type="number" value="@{{telefono_movil}}" ng-model="serie.telefono_movil"/>
                            <span class="label label-danger" ng-show="frm.telefono_movil_persona.$dirty && frm.telefono_movil_persona.$error.required">Requerido</span>
                          </div>
                          
        
                          <div class="clearfix"></div>
                          <br>
                          <legend>Académicos</legend>
                          <div class="row">
                            <div class="col-md-6">
                              <label class="control-label" for="empleado-nivel_formacion">Nivel de escolaridad</label>
                              <select class="form-control" name="tipo_es" id="tipo_es"  ng-model="tipo_esc.unit" ng-options="unit.id as unit.descripcion for unit in escolaridades" required>
                                <option value=''>Seleccione</option>
                              </select>
                              <span class="label label-danger" ng-show="frm.tipo_esc.unit.$dirty && frm.tipo_esc.unit.$error.required">Requerido</span>
                            </div>
                            <div class="col-md-6">
                              <label class="control-label" for="empleado-sit_prof_act">Estado de escolaridad</label>
                              <select class="form-control" name="est_esc" id="est_esc"  ng-model="estado_esc.unit" ng-options="unit.id as unit.descripcion for unit in estadoescolaridades" required>
                                <option value=''>Seleccione</option>
                              </select>
                              <span class="label label-danger" ng-show="frm.estado_esc.unit.$dirty && frm.estado_esc.unit.$error.required">Requerido</span>
                            </div>
                            <div class="col-md-6">
                              <label class="control-label" for="empleado-profesion">Título Obtenido : </label>
                              <input value=""  type="text" id="ficha_profesion" class="form-control" ng-model="serie.titulo_obtenido" maxlength="100">
                            </div>
                            <div class="col-md-6">
                              <label class="control-label" for="empleado-nivel_formacion">Universidad</label>
                              <select class="form-control" name="tipo_univ" id="tipo_univ" ng-model="tipo_univ.universidad" ng-options="universidad.id as universidad.nombre for universidad in universidades">
                                <option value=''>Seleccione Universidad</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label class="control-label" for="empleado-sit_prof_act">Ocupación actual</label>
                              <select class="form-control" name="tipo_oc" id="tipo_oc" required  ng-model="tipo_ocup.unit" ng-options="unit.id as unit.descripcion for unit in ocupaciones" ng-change='selectedOcupacion(tipo_ocup.unit)'>
                                <option value=''>Seleccione</option>
                              </select>
                              <span class="label label-danger" ng-show="frm.ocupacion.$dirty && frm.ocupacion.$error.required">Requerido</span>
                            </div>
                          </div>
                          <legend>Familia</legend>
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-estado_civil">Estado Civil</label>
                            <select class="form-control" name="tipo_est" id="tipo_est" required  ng-model="tipo_est.unit" ng-options="unit.id as unit.descripcion for unit in civiles">
                              <option value=''>Seleccione estado civil</option>
                            </select>
                            <span class="label label-danger" ng-show="frm.est_beneficiario.$dirty && frm.est_beneficiario.$error.required">Requerido</span>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-tiene_hijos">Tiene Hijos</label>
                            <select class="form-control" name="tipo_hj" id="tipo_hj" required  ng-model="tipo_hij.unit" ng-options="unit.id as unit.nombre for unit in hijo" ng-change='selectedHijos(tipo_hij.unit)'>
                              <option value=''>Seleccione</option>
                            </select>
                            <span class="label label-danger" ng-show="frm.hijo.$dirty && frm.hijo.$error.required">Requerido</span>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-cuantos_hijos">¿Cuántos hijos?</label>
                            <input type="text" type="number" class="form-control"  value="@{{cantidad_hijos_beneficiario}}" ng-model="serie.cantidad_hijos_beneficiario" numbers-only  placeholder="Cuantos Hijos?"  ng-disabled="isDisabled">
                            <span class="label label-danger" ng-show="frm.serie.cantidad_hijos_beneficiario.$dirty && frm.serie.cantidad_hijos_beneficiario.$error.required">Requerido</span> 
                          </div>
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-identidad_cultural">¿Se reconoce cómo?</label>
                            <select class="form-control" name="tipo_etn" id="tipo_etn" required  ng-model="tipo_etnias.unit" ng-options="unit.id as unit.descripcion for unit in etnias">
                              <option value=''>Seleccione</option>
                            </select>
                            <span class="label label-danger" ng-show="frm.tipo_etnias.unit.$dirty && frm.tipo_etnias.unit.$error.required">Requerido</span>
                          </div>
                          <legend>Grupo poblacional</legend>
                          <div class='row'>
                            <div class="col-md-12">
                              <div class='form-group'>
                                <p ng-repeat="seleccion in allGrupos_poblacionales" class="col-md-6">
                                  <input type="checkbox" ng-checked="selectedPoblacionales.containsObjectWithProperty('id', seleccion.id)"  ng-click="toggleSelection(seleccion)" />
                                  @{{seleccion.descripcion}}
                                </p>
                                <div ng-show="ngShowhideOtro">
                                  <input type="text" class="form-control" ng-model="otro_poblacional" placeholder="Digita otro grupo poblacional">
                                </div>
                              </div>
                            </div>
                          </div>
                          <hr />
                          <legend>Salud</legend>
                          <div class="row">
                            <div class="container-fluid">
                              <div class="col-md-6">
                                <label class="control-label" for="empleado-padece_enfermedad">¿Padece alguna enfermedad permanente que limite su actividad f&#237;sica?</label>
                                <select class="form-control" name="tipo_dc" id="tipo_dc"  ng-model="tipo_disc.unit" ng-options="unit.id as unit.nombre for unit in discapacidades" required  ng-change='selectedDiscapacidad(tipo_disc.unit)'>
                                  <option value=''>Seleccione</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.tipo_disc.unit.$dirty && frm.tipo_disc.unit.$error.required">Requerido</span>
                              </div>
                              <div class="col-md-6" id="div_enfermedad">
                                <label id="label_ficha_enfermedad" class="control-label" for="empleado-enfermedad">Escriba la enfermedad</label>
                                <input type="text" class="form-control" value="@{{otra_enfermedad}}" ng-model="serie.otra_enfermedad" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledDiscapacidad">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="container-fluid">
                              <div class="col-md-6">
                                <label class="control-label" for="empleado-toma_medicamentos">Toma medicamentos</label>
                                <select class="form-control" name="tipo_med" id="tipo_med"  ng-model="tipo_medic.unit" ng-options="unit.id as unit.nombre for unit in medicamentos" required  ng-change='selectedMedicamento(tipo_medic.unit)'>
                                  <option value=''>Seleccione</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.tipo_medic.unit.$dirty && frm.tipo_medic.unit.$error.required">Requerido</span>
                              </div>
                              <div class="col-md-6">
                                <label id="label_ficha_toma_medicamentos"  class="control-label" for="empleado-medicamentos">Mencione los medicamentos</label>
                                <input class="form-control" size="30" type="text" placeholder="¿Cuál(es)?" disabled ng-disabled="isDisabledMedicamento" value="@{{otros_medicamentos}}" ng-model="serie.otros_medicamentos" />
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="container-fluid">
                              <div class="col-md-6">
                                <label class="control-label" for="empleado-tipo_sangre">Tipo de sangre</label>
                                <select class="form-control" name="tipo_sg" id="tipo_sg" required  ng-model="tipo_sag.unit" ng-options="unit.nombre as unit.nombre for unit in sangre">
                                  <option value=''>Seleccione tipo sangre</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.tipo_sag.unit.$dirty && frm.tipo_sag.unit.$error.required">Requerido</span>
                              </div>
                              <div class="col-md-6">
                                <label class="control-label" for="empleado-tiene_discapacidad">¿Tiene alguna condición de discapacidad?</label>
                                <select class="form-control" name="tipo_cond" id="tipo_cond"  ng-model="tipo_condicion.unit" ng-options="unit.id as unit.nombre for unit in condiciondiscapacidad" required  ng-change='selectedCondicion(tipo_condicion.unit)'>
                                  <option value=''>Seleccione</option>
                                </select>
                                <span class="label label-danger" ng-show="frm.tipo_condicion.unit.$dirty && frm.tipo_condicion.unit.$error.required">Requerido</span>
                              </div>
                              <hr/>
                              <div class="row" id="posee_discapacidad" ng-show="ngShowhideDiscapacidad">
                                <div class="container-fluid">
                                  <div class="col-md-12">
                                    <div class="panel panel-primary">
                                      <div class="panel-heading">
                                        Discapacidades
                                      </div>
                                      <div class="panel-body">
                                        <label style="text-transform: uppercase">
                                          <p ng-repeat="seleccion in allGruposDiscapacidades" class="col-md-6">
                                            <input type="checkbox"  ng-checked="selectedDiscapacidades.containsObjectWithProperty('id', seleccion.id)"  ng-click="toggleSelectionDiscapacidad(seleccion)" />
                                            @{{seleccion.descripcion}}
                                          </p>
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label class="control-label" for="empleado-afiliado_sgsss">¿Se encuentra afiliado al sistema general de afiliación de salud?</label>
                          <select class="form-control" name="tipo_afl" id="tipo_afl"  ng-model="tipo_afiliacion_salud.unit" ng-options="unit.id as unit.nombre for unit in afiliacion_salud" required>
                            <option value=''>Seleccione</option>
                          </select>
                          <span class="label label-danger" ng-show="frm.tipo_afiliacion_salud.unit.$dirty && frm.tipo_afiliacion_salud.unit.$error.required">Requerido</span>
                        </div>
                        <div class="col-md-4">
                          <label class="control-label" style="position:relative; top:16px;" for="empleado-tipo_afiliacion">Tipo afiliación</label>
                          <select class="form-control" style="position:relative; top:17px;" name="tipo_afl" id="tipo_afl" required  ng-model="tipo_afiliacion.unit" ng-options="unit.id as unit.descripcion for unit in afiliaciones">
                            <option value=''>Seleccione</option>
                          </select>
                          <span class="label label-danger" ng-show="frm.tipo_afiliacion.unit.$dirty && frm.tipo_afiliacion.unit.$error.required">Requerido</span>
                        </div>
                        <div class="col-md-4">
                          <label class="control-label" style="position:relative; top:16px;" for="empleado-entidad_eps">Entidad de salud o EPS</label>
                          <select class="form-control" style="position:relative; top:16px;" name="tipo_salotra" id="tipo_salotra"  ng-model="tipo_salud_otra.unit" ng-options="unit.id as unit.descripcion for unit in salud_sgsss"   ng-disabled="isDisabledSeguridad">
                            <option value=''>Seleccione</option>
                          </select>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <legend>Varios</legend>
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-libreta_militar">Libreta militar</label>
                          <select class="form-control"  name="tipo_librt" id="tipo_librt"  ng-model="tipo_libreta.unit" ng-options="unit.id as unit.nombre for unit in libreta">
                            <option value=''>Seleccione</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group field-empleado-no_libreta_militar">
                            <label class="control-label" for="empleado-no_libreta_militar">Número libreta militar</label>
                            <input value=""  type="text" value="@{{no_libreta}}" ng-model="serie.no_libreta" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-distrito_militar">Distrito militar</label>
                          <input value=""  type="text" value="@{{distrito_militar}}" ng-model="serie.distrito_militar" id="ficha_distrito_militar" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-skype">Skype</label>
                          <input value=""  type="text"  value="@{{skype_empleado}}" ng-model="serie.skype_empleado" id="ficha_skype" class="form-control" maxlength="50" >
                        </div>
                        <div class="col-md-12">
                          <label class="control-label" for="empleado-proyecto_profesional">Proyecto profesional</label>
                          <textarea id="ficha_proyecto_profesional" value="@{{proyecto_profesional}}" ng-model="serie.proyecto_profesional" class="form-control"  rows="6"></textarea>
                        </div>
                        <legend>Disciplina (Opcional)</legend>
                        <div class='row'>
                          <div class="col-md-12">
                            <div class='form-group'>
                              <p ng-repeat="seleccion in allGrupos_disciplinas" class="col-md-4">
                                <input type="checkbox" ng-checked="selectedDisciplinas.containsObjectWithProperty('id', seleccion.id)"  ng-click="toggleSelectionDisciplina(seleccion)" />
                                @{{seleccion.descripcion}}
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="jumbotron">En cumplimiento de la ley estatutaria 1581 del 17 de octubre de 2012 "Por la cual se dictan disposiciones generales para la protección de datos personales", la Alcaldía de Santiago de Cali informa, que siendo responsable y encargada del tratamiento de los datos personales de los habitantes del municipio, estos serán utilizados únicamente en el desarrollo de las funciones propias y no se compartirán con nadie para fines diferentes. Esta información es y será utilizada para conocer más al ciudadano que se acerca a la Alcaldía de Santiago de Cali. Para mayor información consulte: <a href="https://goo.gl/VrJ7Bw">https://goo.gl/VrJ7Bw</a>
                        </div>
                        <hr />
                        <div class="clearfix"></div>
                        <br>
                      </div>
                      <input type="text" value="@{{ficha_save}}" ng-model="serie.ficha_save" style="display:none">
                      <div class="clearfix"></div>
                      <br>
                      <div class="form-group">
                        <div class="col-sm-6">
                          <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
                          {{--  <button type="submit" class="btn btn-primary" ng-click="formsubmit( grupo_save, frm.$valid)" ng-disabled="frm.$invalid"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar</button>  --}}
                          <button type="submit" class="btn btn-azul" ng-click="formsubmit()"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar</button>             
                        </div>
                      </div>
                      <hr>
                    </div>
                    <div class="clearfix"></div>
                    <br><br><br>
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