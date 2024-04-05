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
                    <div class="col-lg-12">
                      <h5 class="box-heading" align="center" style="font-size: 18px;">REGISTRO DE USUARIOS: <span class="label label-warning" style="font-size: 15px;">PROGRAMA-MAS VITALES</span></h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <fieldset>
                      <legend>Datos Básicos</legend>
                      <div class='row'>
                      <div class="col-md-6">
                        <label class="control-label" for="empleado-tipo_doc">Tipo documento</label>
                        <select class="form-control" name="tipo_dc" id="tipo_dc" required ng-change="unitChanged()" ng-model="tipo_doc.unit" ng-options="unit.id as unit.descripcion for unit in tipodocumento">
                          <option value=''>Seleccione tipo documento</option>
                        </select>
                        <div ng-show="frm.$submitted || frm.tipo_dc.$untouched">
                          <span class="label label-danger" ng-show="frm.tipo_dc.$error.required">Dato Requerido.</span>
                        </div>
                      </div>
                      <div class='col-sm-6'>
                          <div class='form-group'>
                            <label for="user_firstname">Documento</label>
                            <input class="form-control" placeholder="Digita Número de Documento" type="text" name="documento_personal" data-thousands="." ng-blur="onBlurDocumento($event)" ng-model="no_documento_persona" required/>
                            <div ng-show="frm.$submitted || frm.documento_personal.$untouched">
                                <span class="label label-danger" ng-show="frm.documento_personal.$error.required">Dato Requerido.</span>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="clearfix"></div><br>
                    </fieldset>
                    <div class='row'>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Primer Nombre</label>
                        <input type="text" class="form-control" name="nombre_primero" value="@{{nombre_primero}}" ng-model="persona.nombre_primero"  placeholder="Primer Nombre" required uppercased>
                        <div ng-show="frm.$submitted || frm.nombre_primero.$untouched">
                          <span class="label label-danger" ng-show="frm.nombre_primero.$error.required">Dato Requerido.</span>
                        </div>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Segundo Nombre</label>
                        <input type="text" class="form-control" value="@{{nombre_segundo}}" ng-model="persona.nombre_segundo" placeholder="Segundo Nombre" uppercased>
                      </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Primer Apellido</label>
                        <input type="text" class="form-control" name="apellido_primero" value="@{{apellido_primero}}" ng-model="persona.apellido_primero" placeholder="Primer Apellido" required uppercased>
                        <div ng-show="frm.$submitted || frm.apellido_primero.$untouched">
                          <span class="label label-danger" ng-show="frm.apellido_primero.$error.required">Dato Requerido.</span>
                        </div>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Segundo Apellido</label>
                        <input type="text" class="form-control" value="@{{apellido_segundo}}" ng-model="persona.apellido_segundo" placeholder="Segundo Apellido" uppercased>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                      <label class="control-label" for="empleado-email">Email</label>
                      <input type="text" class="form-control" name="correo_electronico" required value="@{{correo_electronico}}" ng-model="persona.correo_electronico" placeholder="Correo Electronico" uppercased>
                      <div ng-show="frm.$submitted || frm.correo_electronico.$untouched">
                        <span class="label label-danger" ng-show="frm.correo_electronico.$error.required">Dato Requerido.</span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label" for="empleado-sexo">Sexo</label>
                      <select class="form-control" name="genero" id="genero" required  ng-model="tipo_sex.unit" ng-options="unit.id as unit.nombre for unit in sexo">
                        <option value=''>Seleccione sexo</option>
                      </select>
                      <div ng-show="frm.$submitted || frm.genero.$untouched">
                        <span class="label label-danger" ng-show="frm.genero.$error.required">Dato Requerido.</span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label" for="empleado-fecha_nacimiento">Fecha Nacimiento</label>
                      <input class="form-control" type="text" id="fecha_nacimiento" required name="fecha_nacimiento" value="@{{fecha_nacimiento}}" ng-model="persona.fecha_nacimiento" placeholder="año/mes/día">
                      <div ng-show="frm.$submitted || frm.fecha_nacimiento.$untouched">
                        <span class="label label-danger" ng-show="frm.fecha_nacimiento.$error.required">Dato Requerido.</span>
                      </div>
                    </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <fieldset>
                        <legend>Datos de Procedencia</legend>
                      <div class="panel-body" style="position:  relative; top: -19px;">
                        <div class="container-fluid">
                          <div class="row">
                          <div class="col-md-4">
                            <label class="control-label" for="empleado-id_pais" style="position:  relative; right: 31px;">Pais de procedencia</label>
                            <select chosen ng-model="pais" class="form-control" ng-options="s.id as s.nombre_pais for s in paises" ng-change='selectedPais(pais)'>
                              <option value="">Seleccione Pais</option>
                            </select>
                            <span class="label label-danger" ng-show="frm.pais.$dirty && frm.pais.$error.required">Requerido</span>
                          </div>
                          <div ng-show="ngShowhide1">
                            <div class="col-md-4">
                              <label class="control-label" for="empleado-id_departamento" style="position:  relative; right: 31px;">Departamento de procedencia</label>
                              <select chosen class="form-control" name="dept" id="dept" required  ng-model="departamento" ng-options="unit.id as unit.nombre_departamento for unit in departamentos" ng-change='selectedDepartamento(departamento)'>
                                  <option value=''>Seleccione Departamento</option>
                              </select>
                              <span class="label label-danger" ng-show="frm.departamento.$dirty && frm.departamento.$error.required">Requerido</span>
                            </div>
                            <div class="col-md-4">
                              <label class="control-label" for="empleado-id_ciudad" style="position:  relative; right: 31px;">Municipio de procedencia</label>
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
                  </fieldset>
                  <fieldset>
                      <legend>Datos de Residencia</legend>
                      <div class="panel-body" style="position:  relative; top: -19px;">
                          <div class="container-fluid">
                         
                              <div class="row">
                              <div class="col-md-4">
                                  <label class="control-label" for="empleado-id_pais" style="position:  relative; right: 31px;">Departamento de residencia</label>
                                  <select chosen class="form-control" name="dept" id="dept" required  ng-model="departamento_residencia" ng-options="unit.id as unit.nombre_departamento for unit in residencia_departamentos" ng-change='selectedDepartamentoResidencia(departamento_residencia)'>
                                    <option value=''>Seleccione Departamento</option>
                                  </select>
                                  <span class="label label-danger" ng-show="frm.pais.$dirty && frm.pais.$error.required">Requerido</span>
                                </div>
                                <div class="col-md-4">
                                  <label class="control-label" for="empleado-id_departamento" style="position:  relative; right: 31px;">Municipio de residencia</label>
                                  <select chosen class="form-control" name="munic_residencia" id="munic_residencia"  ng-model="municipio_residencia" ng-options="munc.id as munc.nombre_municipio for munc in residencia_municipios" ng-change="selectedMunicipioResidencia(municipio_residencia)">
                                    <option value=''>Seleccione municipio</option>
                                  </select>
                                  <span class="label label-danger" ng-show="frm.munic_residencia.$dirty && frm.munic_residencia.$error.required">Requerido</span>
                                </div>
                                <div class="col-md-4">
                                  <label class="control-label" for="empleado-id_ciudad">Dirección de residencia</label>
                                  <input value="@{{direccion_residencia}}" ng-style="estilo"  ng-model="residencia" ng-blur="onBlurResidencia(residencia)" ng-required="@{{residenciaRequired}}"  type="text" class="form form-control" name="direccion_residencia" id="direccion_residencia" style="background-color: #FFF;" ng-disabled="isDisabledDirecionresidencia"/>
                                  <div ng-show="personal_residencia">
                                    <span class="label label-danger" ng-show="residencia_personal">Dato Requerido.</span>
                                  </div>

                                </div>
                              </div>
                              <div class="clearfix" id="hide-div1"></div><br id="hide-br1">
                              <div class="row" id="hide-me">
                                  <div class="col-md-6">
                                    <label class="control-label" for="empleado-id_pais" style="position:  relative; right: 31px;">Corregimiento</label>
                                    <select chosen class="form-control" name="correg" id="correg"  ng-model="corregimiento" ng-options="correg.id as correg.descripcion for correg in corregimientos" ng-change='selectedCorregimiento(corregimiento)'>
                                      <option value=''>Seleccione Corregimiento</option>
                                    </select>
                                  </div>
                                    <div class="col-md-6">
                                      <label class="control-label" for="empleado-id_departamento" style="position:  relative; right: 31px;">Vereda</label>
                                      <select chosen class="form-control" name="vered" id="vered"   ng-model="vereda" ng-options="verd.id as verd.nombre for verd in veredas" ng-change='selectedVereda(vereda)'>
                                        <option value=''>Seleccione Vereda</option>
                                      </select>
                                    </div>
                                 </div>
                                 <div class="clearfix" id="hide-div2"></div><br id="hide-br2">
                                    <div class="row" id="hide-me2">
                                    <div class="col-md-4" id="div_persona_id_residencia_barrio" ng-show="ngShowhideBarrio">
                                      <label class="control-label" for="empleado-barrio" style="position:  relative; right: 30px;">Barrio</label>
                                      <select chosen class="form-control" name="barr"  id="barr"  ng-model="barrio" ng-options="bar.id as bar.nombre_barrio for bar in barrios" ng-change='selectedBarrio(barrio)'>
                                        <option value=''>Seleccione Barrio</option>
                                      </select>
                                      <span class="label label-danger" ng-show="frm.barrio.unit.$dirty && frm.barrio.unit.$error.required">Requerido</span>
                                    </div> 
                                    <div class="col-md-4">
                                      <label class="control-label" for="empleado-estrato">Estrato</label>
                                      <select class="form-control" name="tipo_estrato" id="tipo_estrato"  ng-model="tipo_estrato.unit" ng-options="unit.id as unit.nombre for unit in estrato">
                                        <option value=''>Seleccione estrato</option>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <label class="control-label" for="empleado-Comuna">Comuna</label>
                                      <input value="@{{comuna}}" ng-model="comuna"  type="text" class="form form-control" id="comuna" readonly="true" style="background-color: #FFF;"/>
                                    </div>
                                </div>  
                                 <div class="col-md-12" id="hide-div3">
                                    <div id="modalIngresoDireccion" class="modal fade modal-change" role="dialog" aria-hidden="true" ></div>
                                </div>    
                           </div>
                          </div>
                          <div class="clearfix" id="hide-div4"></div><br id="hide-br4">
                          <div class="row" style="position:  relative; top: -28px;" id="hide-me3"> 
                          <div class="col-md-6" id="div_direccion" ng-show="ngShowhideDireccion">
                        <label class="control-label" for="empleado-direccion">Dirección</label>
                        <input type="text" id="id_persona_beneficiario_residencia_direccion" onchage='selectedDireccion()'  class="form form-control" value="@{{residencia_direccion}}" name="residencia_direccion" ng-model="persona.residencia_direccion" style="background-color: #FFF;">
                        <div id="direccion_residencia_plugin">
                            <span class="label label-danger">Dato Requerido.</span>
                        </div>

                      </div>

                      <div class="col-md-6" id="div_complemento" ng-show="ngShowhideComplemento">
                          <label class="control-label" for="empleado-direccion">Complemento</label>
                          <input type="text" id="id_persona_beneficiario_residencia_direccion_complemento" placeholder="Complemento de la direccion" class="form form-control" ng-model="complemento" style="background-color: #FFF;">
                        </div>
                      </div>
                      <div class="clearfix" id="hide-div5"></div><br id="hide-br5">
                      <div class="row" style="position:  relative; top: -28px;">                      
                        <div class="col-md-6">
                            <label class="control-label" for="empleado-telefono">Telefono</label>
                            <input placeholder="Telefono" type="text" class="form-control" only-number value="@{{telefono_fijo}}" ng-model="persona.telefono_fijo" />
                          </div>
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-celular">Celular</label>
                            <input class="form-control" numbers-only  required="true" size="30" type="text" placeholder="Telefono Movil" type="number" name="telefono_movil" value="@{{telefono_movil}}" ng-model="persona.telefono_movil"/>
                            <div ng-show="frm.$submitted || frm.telefono_movil.$untouched">
                                <span class="label label-danger" ng-show="frm.telefono_movil.$error.required">Dato Requerido.</span>
                          </div>
                      </div>
                    </fieldset>
                      <legend>Datos Académicos</legend>
                      <div class="row">
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-nivel_formacion">Ultimo nivel de escolaridad</label>
                          <select class="form-control" name="nivel_esc" id="nivel_esc"  ng-model="tipo_esc.unit" ng-options="unit.id as unit.descripcion for unit in escolaridades" required>
                            <option value=''>Seleccione</option>
                          </select>
                          <div ng-show="frm.$submitted || frm.nivel_esc.$untouched">
                              <span class="label label-danger" ng-show="frm.nivel_esc.$error.required">Dato Requerido.</span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-sit_prof_act">Estado de escolaridad</label>
                          <select class="form-control" name="est_esc" id="est_esc"  ng-model="estado_esc.unit" ng-options="unit.id as unit.descripcion for unit in estadoescolaridades" required>
                            <option value=''>Seleccione</option>
                          </select>
                          <div ng-show="frm.$submitted || frm.est_esc.$untouched">
                              <span class="label label-danger" ng-show="frm.est_esc.$error.required">Dato Requerido.</span>
                          </div>
                        </div>
                        <div class="clearfix"></div><br>  
                        <div class="col-md-6" style="position: relative; left: 35px;">
                            <label class="control-label" style="position: relative; right:32px;" for="empleado-nivel_formacion">Titulo obtenido</label>
                           <select chosen ng-model="titulo_obtenido" id="titulo_obtenido" class="form-control" ng-options="titulo.id as titulo.descripcion for titulo in titulos">
                              <option value="">Seleccione titulo obtenido</option>
                            </select>
                        </div>

                         <div class="col-md-6" style="position: relative; left: 35px;">
                            <label class="control-label" style="position: relative; right:32px;" for="empleado-nivel_formacion">Institución educativa superior</label>
                           <select chosen ng-model="tipo_univ.universidad" name="tipo_univ" id="tipo_univ" class="form-control" ng-options="universidad.id as universidad.nombre for universidad in universidades">
                              <option value="">Seleccione Institución educativa superior</option>
                            </select>
                        </div>

                        <div class="clearfix"></div><br>  
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-sit_prof_act">Ocupación actual</label>
                          <select class="form-control" name="tipo_oc" id="tipo_oc" required  ng-model="tipo_ocup.unit" ng-options="unit.id as unit.descripcion for unit in ocupaciones" ng-change='selectedOcupacion(tipo_ocup.unit)'>
                            <option value=''>Seleccione</option>
                          </select>
                          <div ng-show="frm.$submitted || frm.tipo_oc.$untouched">
                              <span class="label label-danger" ng-show="frm.tipo_oc.$error.required">Dato Requerido.</span>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div><br>
                      <legend>Datos de Familia</legend>
                      <div class="row">
                      <div class="col-md-6">
                        <label class="control-label" for="empleado-estado_civil">Estado Civil</label>
                        <select class="form-control" name="estado_civil" id="estado_civil" required  ng-model="tipo_est.unit" ng-options="unit.id as unit.descripcion for unit in civiles">
                          <option value=''>Seleccione estado civil</option>
                        </select>
                        <div ng-show="frm.$submitted || frm.estado_civil.$untouched">
                            <span class="label label-danger" ng-show="frm.estado_civil.$error.required">Dato Requerido.</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label class="control-label" for="empleado-tiene_hijos">Tiene Hijos</label>
                        <select class="form-control" name="tipo_hj" id="tipo_hj"   ng-model="tipo_hij.unit" ng-options="unit.id as unit.nombre for unit in hijo" ng-change='selectedHijos(tipo_hij.unit)'>
                          <option value=''>Seleccione</option>
                        </select>
                      </div>
                      </div>
                      <div class="clearfix"></div><br>
                      <div class="row">
                      <div class="col-md-6">
                        <label class="control-label" for="empleado-cuantos_hijos">¿Cuántos hijos?</label>
                        <input type="text" type="number" class="form-control"  value="@{{cantidad_hijos}}" ng-model="empleado.cantidad_hijos" numbers-only  placeholder="Cuantos Hijos?"  ng-disabled="isDisabled" uppercased>
                      </div>
                      <div class="col-md-6">
                        <label class="control-label" for="empleado-identidad_cultural">¿De acuerdo a sus usos y costumbres, usted se auto-reconoce cómo?</label>
                        <select class="form-control" name="tipo_etn" id="tipo_etn"  ng-model="tipo_etnias.unit" ng-options="unit.id as unit.descripcion for unit in etnias">
                          <option value=''>Seleccione</option>
                        </select>
                      </div>
                      </div>
                      <div class="clearfix"></div><br>
                      <legend>Pertenece a grupos u organizaciones poblacionales, sociales o comunitarias</legend>
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
                      <legend>Datos de Salud</legend>
                      <div class="row">
                        <div class="container-fluid">
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-padece_enfermedad">¿Padece alguna enfermedad permanente que limite su actividad f&#237;sica?</label>
                            <select class="form-control" name="enfermedad_permanente" id="enfermedad_permanente"  ng-model="tipo_disc.unit" ng-options="unit.id as unit.nombre for unit in discapacidades"  ng-change='selectedDiscapacidad(tipo_disc.unit)'>
                              <option value=''>Seleccione</option>
                            </select>
                          </div>
                          <div class="col-md-6" id="div_enfermedad">
                            <label id="label_ficha_enfermedad" class="control-label" for="empleado-enfermedad">Escriba la enfermedad</label>
                            <input type="text" class="form-control" value="@{{otra_enfermedad}}" ng-model="empleado.otra_enfermedad" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledDiscapacidad">
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div><br>
                      <div class="row">
                        <div class="container-fluid">
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-toma_medicamentos">Toma medicamentos</label>
                            <select class="form-control" name="tipo_med" id="tipo_med"  ng-model="tipo_medic.unit" ng-options="unit.id as unit.nombre for unit in medicamentos"  ng-change='selectedMedicamento(tipo_medic.unit)'>
                              <option value=''>Seleccione</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label id="label_ficha_toma_medicamentos"  class="control-label" for="empleado-medicamentos">Mencione los medicamentos</label>
                            <input class="form-control" size="30" type="text" placeholder="¿Cuál(es)?" disabled ng-disabled="isDisabledMedicamento" value="@{{otros_medicamentos}}" ng-model="empleado.otros_medicamentos" />
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div><br>
                      <div class="row">
                        <div class="container-fluid">
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-tipo_sangre">Tipo de sangre</label>
                            <select class="form-control" name="tipo_sg" id="tipo_sg" required  ng-model="tipo_sag.unit" ng-options="unit.nombre as unit.nombre for unit in sangre">
                              <option value=''>Seleccione tipo sangre</option>
                            </select>
                            <div ng-show="frm.$submitted || frm.tipo_sg.$untouched">
                                <span class="label label-danger" ng-show="frm.tipo_sg.$error.required">Dato Requerido.</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-tiene_discapacidad">¿Presenta algun tipo de discapacidad permanente?</label>
                            <select class="form-control" name="tipo_cond" id="tipo_cond"  ng-model="tipo_condicion.unit" ng-options="unit.id as unit.nombre for unit in condiciondiscapacidad"  ng-change='selectedCondicion(tipo_condicion.unit)'>
                              <option value=''>Seleccione</option>
                            </select>
                          </div>
                          <hr/>
                          <div class="clearfix"></div><br>
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
                      <select class="form-control" name="tipo_afl" id="tipo_afl"  ng-model="tipo_afiliacion_salud.unit" ng-options="unit.id as unit.nombre for unit in afiliacion_salud">
                        <option value=''>Seleccione</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label class="control-label" style="position:relative; top:16px;" for="empleado-tipo_afiliacion">Tipo afiliación</label>
                      <select class="form-control" style="position:relative; top:17px;" name="tipo_afl" id="tipo_afl"   ng-model="tipo_afiliacion.unit" ng-options="unit.id as unit.descripcion for unit in afiliaciones">
                        <option value=''>Seleccione</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label class="control-label" style="position:relative; top:16px;" for="empleado-entidad_eps">Entidad de salud o EPS</label>
                      <select class="form-control" style="position:relative; top:16px;" name="tipo_salotra" id="tipo_salotra"  ng-model="tipo_salud_otra.unit" ng-options="unit.id as unit.descripcion for unit in salud_sgsss"   ng-disabled="isDisabledSeguridad">
                        <option value=''>Seleccione</option>
                      </select>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <legend>Datos Varios</legend>
                    <div class="col-md-6">
                      <label class="control-label" for="empleado-libreta_militar">Libreta militar</label>
                      <select class="form-control"  name="tipo_librt" id="tipo_librt"  ng-model="tipo_libreta.unit" ng-options="unit.id as unit.nombre for unit in libreta">
                        <option value=''>Seleccione</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group field-empleado-no_libreta_militar">
                        <label class="control-label" for="empleado-no_libreta_militar">Número libreta militar</label>
                        <input value=""  type="text" value="@{{no_libreta}}" ng-model="empleado.no_libreta" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="control-label" for="empleado-distrito_militar">Distrito militar</label>
                      <input value=""  type="text" value="@{{distrito_militar}}" ng-model="empleado.distrito_militar" id="ficha_distrito_militar" class="form-control" uppercased>
                    </div>
                    <div class="col-md-6">
                      <label class="control-label" for="empleado-skype">Skype</label>
                      <input value=""  type="text"  value="@{{skype_empleado}}" ng-model="empleado.skype_empleado" id="ficha_skype" class="form-control" maxlength="50" uppercased>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="col-md-12">
                      <label class="control-label" for="empleado-proyecto_profesional">Proyecto profesional</label>
                      <textarea id="ficha_proyecto_profesional" value="@{{proyecto_profesional}}" ng-model="empleado.proyecto_profesional" class="form-control"  rows="6" uppercased style="height:76px;"></textarea>
                    </div>
                    <div class="clearfix"></div><br>
                    <legend>Disciplinas (Opcional)</legend>
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
                  <input type="text" value="@{{ficha_save}}" ng-model="serie.ficha_save" style="display:none">
                  <div class="clearfix"></div>
                  <br>
                  <div class="form-group">
                    <div class="col-sm-6">
                      <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
                      <button type="submit" class="btn btn-azul" ng-click="formsubmit(frm.$valid)"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar</button>    
                      <a href="{{url('/login')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>         
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
    </div>

      </form>
      <div class="messages"></div><br /><br />
      <!--div para visualizar en el caso de imagen-->
      <div class="showImage"></div>
    </div>
  </div>
  </section>