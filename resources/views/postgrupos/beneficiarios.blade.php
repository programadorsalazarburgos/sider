<!-- 1 caliacoge,2 mas vitales,3 calijuega,6 calienforma,7 incali,8 team cali -->
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
			<input type="hidden" id="hdnTID" value="{{Auth::user()->tenantId}}"/>
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">
                  <span class="label label-success" id="codigo">FICHA DE INSCRIPCIÓN -
                  BENEFICIARIOS--123678-></span>
                </a></li>
              </ul>
              <div class="tab-content">
                <div id="resultados_ajax"></div>
                <div class="tab-pane active" id="details">
                  <div class="clearfix"></div>
                  <br>

                  <fieldset>
                    <legend>Datos básicos</legend>
                    <div class="row">
                    <div class="col-md-6">
                      <label class="control-label" for="empleado-tipo_doc">Tipo documento</label>
                      <select class="form-control" name="tipo_doc" id="tipo_doc" required ng-change="unitChanged()" ng-model="tipo_doc" ng-options="tipo_doc.id as tipo_doc.descripcion for tipo_doc in tipodocumento">
                        <option value=''>Seleccione tipo documento</option>
                      </select>
                      <div ng-show="frm.$submitted || frm.tipo_doc.$untouched">
                          <span class="label label-danger" ng-show="frm.tipo_doc.$error.required">Dato Requerido.</span>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label class="control-label" for="empleado-documento">Documento</label>
                      <div class="input-group">
                        <input class="form-control" placeholder="Digita Número de Documento" type="text" name="documento_beneficiario" data-thousands="." ng-blur="onBlurDocumento($event)" ng-model="no_documento_persona" required="true" />
                        <div ng-show="frm.$submitted || frm.documento_beneficiario.$untouched">
                            <span class="label label-danger" ng-show="frm.documento_beneficiario.$error.required">Dato Requerido.</span>
                        </div>
                        <span class="input-group-btn">
                          <button onclick="change_documento()" class="btn btn-default" type="button" style="position:  relative;top:  0px;"><i class="glyphicon glyphicon-search"></i></button>
                        </span>
                      </div>
                    </div>
                    </div>
                  </fieldset>
                  <div class="clearfix"></div><br>
                  <div class="row">
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <label for="user_email">No Ficha</label>                     
                      <input type="text" class="form-control"  name="no_ficha" value="@{{ficha.no_ficha}}" ng-model="no_ficha"  placeholder="No Ficha">
                    </div>
                  </div>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <label for="user_firstname">Fecha Inscripción</label>
                      <input class="form-control" type="text" id="fecha_inscripcion" value="" ng-model="fecha_inscripcion" placeholder="año/mes/día">
                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class='col-sm-6'>    
                    <div class='form-group'>
                      <label for="user_firstname">Primer Nombre</label>
                      <input type="text" class="form-control" name="primer_nombre" value="@{{nombre_primero}}" ng-model="persona.nombre_primero"  placeholder="Primer Nombre" required uppercased>
                      <div ng-show="frm.$submitted || frm.primer_nombre.$untouched">
                          <span class="label label-danger" ng-show="frm.primer_nombre.$error.required">Dato Requerido.</span>
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
                  <div class="row">
                  <div class='col-sm-6'>    
                    <div class='form-group'>
                      <label for="user_firstname">Primer Apellido</label>
                      <input type="text" class="form-control" value="@{{apellido_primero}}" ng-model="persona.apellido_primero" placeholder="Primer Apellido" uppercased>
                    </div>
                  </div>
                  <div class='col-sm-6'>
                    <div class='form-group'>
                      <label for="user_firstname">Segundo Apellido</label>
                      <input type="text" class="form-control" value="@{{apellido_segundo}}" ng-model="persona.apellido_segundo" placeholder="Segundo Apellido" uppercased>
                    </div>
                  </div>
                  </div>
                  <!-- END ROW -->
				  <div class="row">
					  <div class="col-md-6">
						<label class="control-label" for="empleado-email">Email</label>
						<input type="email" class="form-control" value="@{{correo_electronico}}" ng-model="persona.correo_electronico" placeholder="Correo Electronico" uppercased>
					  </div>
					  <div class="col-md-6">
						<label class="control-label" for="empleado-fecha_nacimiento">Fecha Nacimiento</label>
						<input class="form-control" type="text" name="fecha_nac" id="fecha_nacimiento" required value="@{{fecha_nacimiento}}" ng-model="persona.fecha_nacimiento" placeholder="año/mes/día">
						<div ng-show="frm.$submitted || frm.fecha_nac.$untouched">
							<span class="label label-danger" ng-show="frm.fecha_nac.$error.required">Dato Requerido.</span>
						</div>
					  </div>
				  </div>
				  <!-- END ROW -->
				  <div class="row">
					  <div class="col-md-4">
						<label class="control-label" for="empleado-sexo">Sexo</label>
						<select class="form-control" name="tipo_sex" id="tipo_sex" ng-model="tipo_sex" ng-options="tipo_sex.id as tipo_sex.nombre for tipo_sex in sexo">
						  <option value=''>Seleccione sexo</option>
						</select>
						<div ng-show="frm.$submitted || frm.tipo_genero.$untouched">
							<span class="label label-danger" ng-show="frm.tipo_genero.$error.required">Dato Requerido.</span>
						</div>
					  </div>
					  <div class="col-md-4">
						<label class="control-label" for="tipo_genero_r">Genero</label>
						<select class="form-control" name="tipo_genero_r" id="tipo_genero_r" required  ng-model="tipo_sex_real.unit" ng-options="unit.id as unit.nombre for unit in sexo_real">
						  <option value=''>Seleccione genero</option>
						</select>
						<div ng-show="frm.$submitted || frm.tipo_genero_r.$untouched">
							<span class="label label-danger" ng-show="frm.tipo_genero_r.$error.required">Dato Requerido.</span>
						</div>
					  </div>
					  <div class="col-md-4">
						<label class="control-label" for="tipo_orientacion_sexual">Or. Sexual</label>
						<select class="form-control" name="tipo_orientacion_sexual" id="tipo_orientacion_sexual"  ng-model="tipo_orientacion_sexual.unit" ng-options="unit.id as unit.nombre for unit in sexo_orientacion_sexual" ng-change='selectedOrientacionSexual(tipo_orientacion_sexual.unit)'>
						  <option value=''>Seleccione orientación</option>
						</select>
						<div ng-show="frm.$submitted || frm.tipo_orientacion_sexual.$untouched">
							<span class="label label-danger" ng-show="frm.tipo_orientacion_sexual.$error.required">Dato Requerido.</span>
						</div>
					  </div>
                  
                  </div>
				  <!-- END ROW -->
				  <div class="row" id="rowOtroOrientacionSexual" style="display:none;">
						<div class="col-md-4"></div>
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<label class="control-label" for="orientacion_sexual">¿Cual?</label>
							<input type="text" id="orientacion_sexual_otro" name="orientacion_sexual_otro" class="form-control" ng-model="persona.orientacion_sexual_otro" uppercased maxlength="255" value="N/A"/>
						</div>
				  </div>
				  <!-- END ROW -->
                  <div class="panel">
                    <legend>Datos de procedencia</legend>
                    <div class="panel-body">
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
                            <select chosen class="form-control" name="dept" id="dept" ng-model="departamento" ng-options="unit.id as unit.nombre_departamento for unit in departamentos" ng-change='selectedDepartamento(departamento)'>
                              <option value=''>Seleccione Departamento</option>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <label class="control-label" for="empleado-id_ciudad" style="position:  relative; right: 31px;">Municipio de procedencia</label>
                            <select chosen class="form-control" name="munic" id="munic" ng-model="municipio" ng-options="munc.id as munc.nombre_municipio for munc in municipios">
                              <option value=''>Seleccione municipio</option>
                            </select>
                          </div>
                        </div>
                        <div ng-show="ngShowhide2">
                          <div class="col-md-8">
                            <label class="control-label" for="empleado-id_ciudad">Departamento/Ciudad</label>

                            <input type="text" value="@{{otro_municipio}}" ng-model="persona.otro_municipio" placeholder="Departamento/municipio" class="form form-control"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="panel">
                      <legend>Datos de residencia</legend>
                      <div class="panel-body">
                      <div class="container-fluid">
                       <div class="row">
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-id_pais" style="position:  relative; right: 31px;">Corregimiento</label>
                          <select chosen class="form-control" name="correg" id="correg"  ng-model="corregimiento" ng-options="correg.id as correg.descripcion for correg in corregimientos" ng-change='selectedCorregimiento(corregimiento)'>
                            <option value=''>Seleccione Corregimiento</option>
                          </select>
                        </div>
                        <div ng-show="ngShowhide1Vereda">
                          <div class="col-md-6">
                            <label class="control-label" for="empleado-id_departamento" style="position:  relative; right: 31px;">Vereda</label>
                            <select chosen class="form-control" name="vered" id="vered"   ng-model="vereda" ng-options="verd.id as verd.nombre for verd in veredas" ng-change='selectedVereda(vereda)'>
                              <option value=''>Seleccione Vereda</option>
                            </select>
                          </div>
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
                              <select class="form-control" name="tipo_estrato" id="tipo_estrato" ng-model="tipo_estrato" ng-options="tipo_estrato.id as tipo_estrato.nombre for tipo_estrato in estrato">
                                <option value=''>Seleccione estrato</option>
                              </select>
                            </div>
                            <div class="col-md-4">
                              <label class="control-label" for="empleado-Comuna">Comuna</label>
                              <input value="@{{residencia_direccion}}" ng-model="comuna"  type="text" class="form form-control" id="comuna" readonly="true" style="background-color: #FFF;"/>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <input value="@{{comuna_id}}" ng-model="comuna_id"  type="text" class="form form-control" style="display:none" readonly="true"/>
                    <div class="row">
                    <div class="col-md-12">
                      <div id="modalIngresoDireccion" class="modal fade modal-change" role="dialog" aria-hidden="true" ></div>
                    </div>
                    <div class="col-md-6" id="div_direccion" ng-show="ngShowhideDireccion">
                      <label class="control-label" for="empleado-direccion">Direccion</label>
                      <input type="text" id="id_persona_beneficiario_residencia_direccion" name="direccion"  class="form form-control" value="@{{residencia_direccion}}" ng-model="persona.residencia_direccion" style="background-color: #FFF;">
                      <div id="direccion_residencia_plugin">
                          <span class="label label-danger">Dato Requerido.</span>
                      </div>

                    </div>
                    <div class="col-md-6" id="div_complemento" ng-show="ngShowhideComplemento">
                      <label class="control-label" for="empleado-direccion">Complemento</label>
                      <input type="text" id="id_persona_beneficiario_residencia_direccion_complemento" placeholder="Complemento de la direccion" class="form form-control" ng-model="complemento" style="background-color: #FFF;">
                    </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="row">
                    <div class="col-md-6">
                      <label class="control-label" for="empleado-telefono">Telefono</label>
                      <input placeholder="Telefono" type="text" class="form-control" only-number value="@{{telefono_fijo}}" ng-model="persona.telefono_fijo" />
                    </div>

                    <div class="col-md-6">
                      <label class="control-label" for="empleado-celular">Celular</label>
                      <input class="form-control" numbers-only size="30" type="text" name="celular" placeholder="Telefono Movil" type="number" value="@{{telefono_movil}}" ng-model="persona.telefono_movil"/>
                    </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <legend>Datos Académicos</legend>
                    <div class="row">
                      <div class="col-md-6">
                        <label class="control-label" for="empleado-nivel_formacion">Ultimo nivel de escolaridad</label>
                        <select class="form-control" name="tipo_esc" id="tipo_esc"  ng-model="tipo_esc" ng-options="tipo_esc.id as tipo_esc.descripcion for tipo_esc in escolaridades" required>
                          <option value=''>Seleccione</option>
                        </select>
                        <div ng-show="frm.$submitted || frm.tipo_esc.$untouched">
                            <span class="label label-danger" ng-show="frm.tipo_esc.$error.required">Dato Requerido.</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label class="control-label" for="empleado-sit_prof_act">Estado de escolaridad</label>
                        <select class="form-control" name="estado_esc" id="estado_esc"  ng-model="estado_esc" ng-options="estado_esc.id as estado_esc.descripcion for estado_esc in estadoescolaridades" required>
                          <option value=''>Seleccione</option>
                        </select>
                        <div ng-show="frm.$submitted || frm.estado_esc.$untouched">
                            <span class="label label-danger" ng-show="frm.estado_esc.$error.required">Dato Requerido.</span>
                        </div>
                      </div>
                      <div class="clearfix"></div><br>
                      <div class="col-md-6">
                        <label class="control-label" for="empleado-sit_prof_act">Ocupación actual</label>
                        <select class="form-control" name="tipo_ocup" id="tipo_ocup"  ng-model="tipo_ocup" ng-options="tipo_ocup.id as tipo_ocup.descripcion for tipo_ocup in ocupaciones" ng-change='selectedOcupacion(tipo_ocup)'>
                          <option value=''>Seleccione</option>
                        </select>
                      </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <legend>Datos de Familia</legend>
                    <div class="row">
                    <div class="col-md-6">
                      <label class="control-label" for="empleado-estado_civil">Estado Civil</label>
                      <select class="form-control" name="tipo_est" id="tipo_est"   ng-model="tipo_est" ng-options="tipo_est.id as tipo_est.descripcion for tipo_est in civiles">
                        <option value=''>Seleccione estado civil</option>
                      </select>
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
                      <input type="text" type="number" class="form-control"  value="@{{ficha.cantidad_hijos_beneficiario}}" ng-model="cantidad_hijos_beneficiario" numbers-only  placeholder="Cuantos Hijos?"  ng-disabled="isDisabled">
                    </div>
                    <div class="col-md-6">
                      <label class="control-label" for="empleado-identidad_cultural">¿De acuerdo a sus usos y costumbres, usted se auto-reconoce cómo?</label>
                      <select class="form-control" name="tipo_etn" id="tipo_etn"   ng-model="tipo_etnias" ng-options="tipo_etnias.id as tipo_etnias.descripcion for tipo_etnias in etnias">
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
						  <div ng-show="ngShowhideClub">
								<select class="form-control" name="club_poblacional" id="club_poblacional"   ng-model="clubes_deportivos.unit" ng-options="unit.id as unit.nombre_club for unit in clubes_deportivos_bd">
									<option value=''>Seleccione club deportivo</option>
								</select>
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
                          <select class="form-control" name="tipo_dc" id="tipo_dc"  ng-model="tipo_disc.unit" ng-options="unit.id as unit.nombre for unit in discapacidades" ng-change='selectedDiscapacidad(tipo_disc.unit)'>
                            <option value=''>Seleccione</option>
                          </select>            
                        </div>
                        <div class="col-md-6" id="div_enfermedad">
                          <label id="label_ficha_enfermedad" class="control-label" for="empleado-enfermedad">Escriba la enfermedad</label>
                          <input type="text" class="form-control" value="@{{ficha.otra_discapacidad_beneficiario}}" ng-model="otra_discapacidad_beneficiario" placeholder="Otra ¿Cuál?" ng-disabled="isDisabledDiscapacidad" uppercased>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="row">
                      <div class="container-fluid">
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-toma_medicamentos">Toma medicamentos</label>
                          <select class="form-control" name="tipo_med" id="tipo_med"  ng-model="tipo_medic.unit" ng-options="unit.id as unit.nombre for unit in medicamentos"   ng-change='selectedMedicamento(tipo_medic.unit)'>
                            <option value=''>Seleccione</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label id="label_ficha_toma_medicamentos"  class="control-label" for="empleado-medicamentos">Mencione los medicamentos</label>
                          <input class="form-control" size="30" type="text" placeholder="¿Cuál(es)?" disabled ng-disabled="isDisabledMedicamento" value="@{{ficha.medicamentos_beneficiario}}" ng-model="medicamentos_beneficiario" uppercased/>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="row">
                      <div class="container-fluid">
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-tipo_sangre">Tipo de sangre</label>
                          <select class="form-control" name="tipo_sg" id="tipo_sg" ng-model="tipo_sag" ng-options="tipo_sag.nombre as tipo_sag.nombre for tipo_sag in sangre">
                            <option value=''>Seleccione tipo sangre</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="control-label" for="empleado-tiene_discapacidad">¿Presenta algun tipo de discapacidad permanente?</label>
                          <select class="form-control" name="tipo_cond" id="tipo_cond"  ng-model="tipo_condicion.unit" ng-options="unit.id as unit.nombre for unit in condiciondiscapacidad"   ng-change='selectedCondicion(tipo_condicion.unit)'>
                            <option value=''>Seleccione</option>
                          </select>
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
									<div ng-show="ngShowhideOtroDiscapacidad">
										<input type="text" class="form-control" ng-model="condicion_discapacidad_otro" placeholder="Digita otra discapacidad">
									</div>
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
                    <select class="form-control" style="position:relative; top:17px;" name="tipo_afiliacion" id="tipo_afiliacion"   ng-model="tipo_afiliacion" ng-options="tipo_afiliacion.id as tipo_afiliacion.descripcion for tipo_afiliacion in afiliaciones">
                      <option value=''>Seleccione</option>
                    </select>
                  </div>
              
                   <div class="col-md-4" style="position: relative; top: 18px; left: 25px;">
                          <label class="control-label" for="empleado-id_pais" style="position: relative; right: 35px;">Entidad de salud o EPS</label>
                          <select chosen class="form-control" name="tipo_salud_otra" id="tipo_salud_otra"  ng-model="tipo_salud_otra" ng-options="tipo_salud_otra.id as tipo_salud_otra.descripcion for tipo_salud_otra in salud_sgsss" ng-disabled="isDisabledSeguridad">
                            <option value=''>Seleccione</option>
                          </select>
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
                        <label for="user_email">Tipo Documento</label>
                        <select class="form-control" name="tipo_doc_acudiente" id="tipo_doc_acudiente" ng-model="tipo_doc_acudiente" ng-options="tipo_doc_acudiente.id as tipo_doc_acudiente.descripcion for tipo_doc_acudiente in tipodocumento">
                          <option value=''>Seleccione tipo documento</option>
                        </select>
                      
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">No Documento</label>
                        <input class="form-control" placeholder="Digita Número de Documento"  type="text" name="documento_acudiente" data-thousands="."  value="@{{acudiente.documento_acudiente}}" ng-blur="onBlurDocumentoAcudiente($event)" id="documento_acudiente" ng-model="documento_acudiente" />
                       
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-6'>    
                      <div class='form-group'>
                        <label for="user_firstname">Primer Nombre</label>
                        <input type="text" class="form-control" value="@{{acudiente.nombre_primero_acudiente}}" ng-model="nombre_primero_acudiente" id="nombre_primero_acudiente" placeholder="Primer Nombre" uppercased>
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Segundo Nombre</label>
                        <input type="text" class="form-control" value="@{{acudiente.nombre_segundo_acudiente}}" ng-model="nombre_segundo_acudiente" id="nombre_segundo_acudiente" placeholder="Segundo Nombre" uppercased>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-6'>    
                      <div class='form-group'>
                        <label for="user_firstname">Primer Apellido</label>
                        <input type="text" class="form-control" name="primer_apellido_acudiente" value="@{{acudiente.apellido_primero_acudiente}}" ng-model="apellido_primero_acudiente" id="apellido_primero_acudiente"  placeholder="Primer Apellido" uppercased>
                      
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_firstname">Segundo Apellido</label>
                        <input type="text" class="form-control" value="@{{acudiente.apellido_segundo_acudiente}}" ng-model="apellido_segundo_acudiente" id="apellido_segundo_acudiente"  placeholder="Segundo Apellido" uppercased>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_email">Sexo</label>
                        <select class="form-control" name="tipo_sex_acudiente" id="tipo_sex_acudiente" ng-model="tipo_sex_acudiente" ng-options="tipo_sex_acudiente.id as tipo_sex_acudiente.nombre for tipo_sex_acudiente in sexo" style="width: 280px; position: relative; top: 0px;" ng-change='selectedSexAcudiente(tipo_sex_acudiente)'>
                          <option value=''>Seleccione sexo</option>
                        </select>
                     
                      </div>
                    </div>
					<div class='col-sm-2'>
						<div class='form-group' ng-show="ngShowhideOtroSexoAcudiente">
							<label for="user_email">-</label>
							<input type="text" class="form-control" value="@{{acudiente.sexo_acudiente_otro}}" ng-model="sexo_acudiente_otro" id="sexo_acudiente_otro"  placeholder="Otro sexo" uppercased>
						</div>
					</div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Fecha Nacimiento</label>
                        <input class="form-control" type="text" id="fecha_nacimiento_acudiente" name="fecha_nac_acudiente" value="@{{acudiente.fecha_nacimiento_acudiente}}" ng-model="fecha_nacimiento_acudiente" placeholder="año/mes/día">
                      
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Telefono Fijo</label>
                        <input type="text" class="form-control"  value="@{{acudiente.telefono_fijo_acudiente}}" ng-model="telefono_fijo_acudiente" id="telefono_fijo_acudiente" only-number placeholder="Telefono Fijo">
                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_firstname">Telefono Movil</label>
                        <input type="text" numbers-only  class="form-control" name="telefono_movil_acudiente"  value="@{{acudiente.telefono_movil_acudiente}}" ng-model="telefono_movil_acudiente" id="telefono_movil_acudiente"  placeholder="Telefono Movil">

                      </div>
                    </div>
                    <div class='col-sm-4'>
                      <div class='form-group'>
                        <label for="user_lastname">Correo Electronico</label>
                        <input type="text" class="form-control" value="@{{acudiente.correo_electronico_acudiente}}" ng-model="correo_electronico_acudiente" id="correo_electronico_acudiente" placeholder="Correo Electronico" uppercased>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">Parentesco:</label>
                        <select class="form-control" name="tipo_parent_ac" id="tipo_parent_ac"ng-model="tipo_parent" ng-options="tipo_parent.id as tipo_parent.nombre for tipo_parent in parentescos" style="width: 280px; position: relative; top: 0px;" ng-change='selectedParentesco(tipo_parent)'>
                          <option value=''>Seleccione parentesco</option>
                        </select>
                   
                      </div>
                    </div>
                    <div class='col-sm-6'>
                      <div class='form-group'>
                        <label for="user_email">¿Cuál?</label>
                        <input class="form-control" value="@{{ficha.otro_parentesco_acudiente}}" ng-model="otro_parentesco_acudiente" size="30" type="text" placeholder="¿Cuál?" ng-disabled="isDisabledParentesco" uppercased/>
                      </div>
                    </div>
                     <div class='col-sm-6' style="display: none;">
                      <div class='form-group'>
                        <label for="user_email">Ficha Save</label>
                        <input class="form-control" value="@{{ficha.ficha_save}}" ng-model="ficha_save" size="30" style="display: none;" ng-disabled="isDisabledParentesco" uppercased/>
                      </div>
                    </div>
                  </div>
                  <div class="jumbotron">En cumplimiento de la ley estatutaria 1581 del 17 de octubre de 2012 "Por la cual se dictan disposiciones generales para la protección de datos personales", la Alcaldía de Santiago de Cali informa, que siendo responsable y encargada del tratamiento de los datos personales de los habitantes del municipio, estos serán utilizados únicamente en el desarrollo de las funciones propias y no se compartirán con nadie para fines diferentes. Esta información es y será utilizada para conocer más al ciudadano que se acerca a la Alcaldía de Santiago de Cali. Para mayor información consulte: <a href="https://goo.gl/VrJ7Bw">https://goo.gl/VrJ7Bw</a>
                  </div>
                  <input type="text" value="@{{ficha_save}}" ng-model="serie.ficha_save" style="display:none">
                  <div class="clearfix"></div>
                  <br>
                  <div class="form-group">
                    <div class="col-sm-6">
                      <div ng-show="loading" id="cargando" class="loading"><img src="{{ asset('/images/cargando.gif') }}">LOADING...</div>
                      <button type="submit" class="btn btn-azul" ng-click="formsubmit( grupo_save, frm.$valid)"><i class="fa fa-save"></i>&nbsp;&nbsp;Crear Beneficiario</button>
                      <a href="{{url('/admin/postgrupos#/admin/postgrupos')}}" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                    </div>
                  </div>
                  <hr>
                </div>
                <div class="clearfix"></div><br><br><br>
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


