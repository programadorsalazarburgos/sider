<style>
.code {
  height: 80px !important;
}

textarea.ng-invalid.ng-dirty{border:1px solid red;}
select.ng-invalid.ng-dirty{border:1px solid red;}
option.ng-invalid.ng-dirty{border:1px solid red;}
input.ng-invalid.ng-dirty{border:1px solid red;}

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    cursor: not-allowed;
    background-color: #fff;
    opacity: 1;
}

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
                    
                    <div class="tab-content">
                      <div id="resultados_ajax"></div>
                      <div class="tab-pane active" id="details">
                        <div class="clearfix"></div>
                        <br>
                       

<center>
                        <table width="90%" border="1" cellspacing="4" cellpadding="2" bordercolor="#eeeeee">
<tbody><tr>
    <th colspan="2" height="30" bgcolor="#039be5" scope="row"><center>
  <font color="#FFFFFF" size="5"><strong>HISTORIA DEL BENEFICIARIO</strong></font>  
</center></th>
  </tr>

  
  </tbody></table>
</center>
<div class="clearfix"></div><br>
<center>

<table width="80%" border="0" cellspacing="2">
  <tbody><tr>
    <th colspan="2" height="30" bgcolor="#039be5" scope="row"><center style="
    color:  white;
">INFORMACIÓN IED</center></th>
  </tr>
  <tr>
    <th height="30" width="50%" scope="row">Fecha de Inscripción :</th>
    <td width="50%"><font color="#000000" size="2">@{{ serie.fecha_inscripcion }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Ficha No:</th>
    <td><font color="#000000" size="2">@{{serie.no_ficha}}</font></td>
  </tr> 
  
  </tbody></table>
<div class="clearfix"></div><br>
</center>


<center>
  <table width="80%" border="1" cellspacing="4" cellpadding="2" bordercolor="#eeeeee">
  <tbody><tr>
    <th height="30" bgcolor="#039be5" colspan="2" scope="row"><center style="
    color:  white;
">DATOS BASICOS DEL BENEFICIARIO</center></th>
  </tr>
  <tr>
    <th height="30" width="50%" scope="row">Primer Nombre:</th>
    <td width="50%"><font color="#000000" size="2">@{{serie.nombre_primero}}</font></td>
  </tr>
  <tr>
    <th height="30" width="50%" scope="row">Segundo Nombre:</th>
    <td width="50%"><font color="#000000" size="2">@{{serie.nombre_segundo}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Primer Apellido:</th>
    <td><font color="#000000" size="2">@{{serie.apellido_primero}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Segundo Apellido:</th>
    <td><font color="#000000" size="2">@{{serie.apellido_segundo}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Tipo Documento:</th>
     <td><font color="#000000" size="2">@{{serie.tipo_documento}}</font></td>
 
  </tr>
  <tr>
    <th height="30" scope="row">No Documento: </th>
    <td><font color="#000000" size="2">@{{serie.documento}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Sexo:</th>
    <td><font color="#000000" size="2">@{{sexo_benef}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Fecha Nacimiento:</th>
    <td><font color="#000000" size="2">@{{serie.fecha_nacimiento}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Telefono Fijo:</th>
    <td><font color="#000000" size="2">@{{serie.telefono_fijo}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Telefono Movil:</th>
    <td><font color="#000000" size="2">@{{serie.telefono_movil}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Correo Electronico:</th>
    <td><font color="#000000" size="2">@{{serie.correo_electronico}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Pais:</th>
  <td><font color="#000000" size="2">@{{serie.nombre_pais}}</font></td>
  
  </tr>
  <tr>
    <th height="30" scope="row">Departamento:</th>
   <td><font color="#000000" size="2">@{{serie.nombre_departamento}}</font></td>
 
  </tr>
  <tr>
    <th height="30" scope="row">Municipio:</th>
    <td><font color="#000000" size="2">@{{serie.nombre_municipio}}</font></td>
 
  </tr>
  <tr>
    <th height="30" scope="row">Dirección de residencia:</th>
    <td><font color="#000000" size="2">@{{serie.residencia_direccion}} </font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Estrato:</th>
    <td><font color="#000000" size="2">@{{serie.residencia_estrato}}</font></td>
  </tr>

  <tr>
    <th height="30" scope="row">Comuna:</th>
    <td><font color="#000000" size="2"><select class="form-control" disabled name="comuna" id="comuna" required ng-change='selectedComuna(data_comuna.unit)' ng-model="data_comuna.unit" ng-options="unit.id as unit.nombre_comuna for unit in comunas" style="border: 0px solid white; position: relative; left: -9px;"></select></font></td>
  </tr>

  <tr>
    <th height="30" scope="row">Barrio:</th>
    <td><font color="#000000" size="2">@{{serie.nombre_barrio}}</font></td>
 
  </tr>

  <tr>
    <th height="30" scope="row">Corregimiento:</th>
    <td><font color="#000000" size="2">@{{serie.corregimiento}}</font></td>
 
  </tr>
  <tr>
    <th height="30" scope="row">Vereda:</th>
     <td><font color="#000000" size="2">@{{serie.vereda}}</font></td>
 
  <tr>
    <th height="30" scope="row">¿Tiene hijos?:</th>
    <td><font color="#000000" size="2">@{{hijos_benef}}</font></td>
  </tr>

<tr>
    <th height="30" scope="row">¿Cuántos?:</th>
    <td><font color="#000000" size="2">@{{serie.cantidad_hijos_beneficiario}}</font></td>
  </tr>
<tr>
    <th height="30" scope="row">Tipo de Sangre:</th>
    <td><font color="#000000" size="2">@{{serie.sangre_tipo}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Nivel de escolaridad:</th>
    <td><font color="#000000" size="2">@{{escolaridad_benef}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Estado escolaridad:</th>
    <td><font color="#000000" size="2">@{{serie.estado_escolaridad}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Ocupación actual:</th>
    <td><font color="#000000" size="2">@{{ocupacion_benef}}</font></td>
  </tr>

  
<tr>
  <th height="30" scope="row">¿Cuál?:</th>
  <td><font color="#000000" size="2">@{{serie.otra_ocupacion_beneficiario}}</font></td>
</tr>

</tr>
<th height="30" scope="row">Estado Civil:</th>
<td><font color="#000000" size="2">@{{estado_civ_benef}}</font></td>
</tr>


<tr>
    <th height="30" scope="row">¿De acuerdo con su cultura, pueblo o rasgos físicos, es o se reconoce como?:</th>
    <td><font color="#000000" size="2">@{{serie.etnia_beneficiario}}</font></td>
  </tr>

<tr>
    <th height="30" scope="row">Grupo Poblacional:</th>
    <td><font color="#000000" size="2">@{{serie.grupo_poblacional  }}</font></td>
</tr>

<tr>
  <th height="30" scope="row">¿Padece alguna enfermedad permanente (crónica) que limite su actividad física?:</th>
  <td><font color="#000000" size="2">@{{serie.Discapacidad}}</font></td>
</tr>

<tr>
  <th height="30" scope="row">¿Cuál?:</th>
  <td><font color="#000000" size="2">@{{serie.otra_discapacidad_beneficiario }}</font></td>
</tr>


<tr>
  <th height="30" scope="row">¿Toma medicamentos de manera permanente?:</th>
  <td><font color="#000000" size="2">@{{medicamento_benef}}</font></td>
</tr>

<tr>
  <th height="30" scope="row">¿Cuál(es)?:</th>
  <td><font color="#000000" size="2">@{{serie.medicamentos_beneficiario }}</font></td>
</tr>

<tr>
    <th height="30" scope="row">¿Presenta alguna discapacidad?:</th>
    <td><font color="#000000" size="2">@{{discapacidad_benef}}</font></td>
</tr>

<tr>
    <th height="30" scope="row">Discapacidades:</th>
    <td><font color="#000000" size="2">@{{serie.discapacidades}}</font></td>
</tr>


<tr>
    <th height="30" scope="row">¿Se encuentra afiliado al Sistema General de Seguridad Social en Salud-SGSSS? :</th>
    <td><font color="#000000" size="2">@{{serie.Afiliacion_Salud}}</font></td>
</tr>
<tr>
    <th height="30" scope="row">Tipo Afiliación?:</th>
    <td><font color="#000000" size="2">@{{serie.tipo_afiliacion}}</font></td>
</tr>
<tr>
    <th height="30" scope="row">Entidad de salud o EPS:</th>
    <td><font color="#000000" size="2">@{{serie.nombre_eps }}</font></td>
</tr>


  </tbody></table>
</center>


<center>
  <table width="80%" border="1" cellspacing="4" cellpadding="2" bordercolor="#eeeeee">
  <tbody><tr>
    <th height="30" bgcolor="#039be5" colspan="2" scope="row"><center style="
    color:  white;
">DATOS BASICOS DEL ACUDIENTE</center></th>
  </tr>
  <tr>
    <th height="30" width="50%" scope="row">Primer Nombre:</th>
    <td width="50%"><font color="#000000" size="2">@{{serie.primer_nombre_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" width="50%" scope="row">Segundo Nombre:</th>
    <td width="50%"><font color="#000000" size="2">@{{serie.segundo_nombre_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Primer Apellido:</th>
    <td><font color="#000000" size="2">@{{serie.primer_apellido_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Segundo Apellido:</th>
    <td><font color="#000000" size="2">@{{serie.segundo_apellido_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Tipo Documento:</th>
    <td><font color="#000000" size="2">@{{serie.tipo_documento_acudiente }}</font></td>
 </font></td>
  </tr>
  <tr>
    <th height="30" scope="row">No Documento: </th>
    <td><font color="#000000" size="2">@{{serie.documento_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Sexo:</th>
    <td><font color="#000000" size="2">@{{serie.sexo_acudiente}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Fecha Nacimiento:</th>
    <td><font color="#000000" size="2">@{{ serie.fecha_nacimiento_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Telefono Fijo:</th>
    <td><font color="#000000" size="2">@{{ serie.telefono_fijo_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Telefono Movil:</th>
    <td><font color="#000000" size="2">@{{ serie.telefono_movil_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Correo Electronico:</th>
    <td><font color="#000000" size="2">@{{ serie.correo_acudiente }}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">Parentesco:</th>
    <td><font color="#000000" size="2">@{{parentesco_acudient}}</font></td>
  </tr>
  <tr>
    <th height="30" scope="row">¿Cuál?:</th>
    <td><font color="#000000" size="2">@{{ serie.otro_parentesco_acudiente }}</font></td>
  </tr>


 


  </tbody></table>
</center>



      <div class="messages"></div><br /><br />
      <!--div para visualizar en el caso de imagen-->
      <div class="showImage"></div>
    </div>
  </div>
</section> 



