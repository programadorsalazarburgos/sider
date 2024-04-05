<template>
<main class="main">
<div class="clearfix"></div>
<br>
<div class="row"></div>
<template v-if="listado==1">
<div id="table-action" class="row">
<div class="col-lg-12">
<ul id="tableactiondTab" class="nav nav-tabs">
<li class="active"><a href="#table-table-tab" data-toggle="tab">Información</a></li>
</ul>
<div id="tableactionTabContent" class="tab-content">
<h5><strong style="color: #d9534f">Fecha de la Consulta y/o del Reporte</strong></h5>
<h5><strong style="color:black">Cantidad Beneficiarios por Rango de Fecha: {{total_beneficiarios}} Beneficiarios</strong></h5>
<button type="button" class="btn btn-success" @click="GenerarTotal()">General Total</button>



<div class="vld-parent">
        <loading :active.sync="isLoading" 
        :can-cancel="true" 
        :on-cancel="onCancel"
        :is-full-page="fullPage"></loading>
        
 
       
    </div>


<div id="table-table-tab" class="tab-pane fade in active">
<div class="row">
<div class="col-lg-12">
<div class="table-container">
<div class="row mbm">
<div class="col-lg-6"></div>
</div>
<div class="table-responsive">
<div class="portlet-body">
<div class="clearfix"></div>
<br>
</div>

<div class="clearfix"></div><br>



<div class="col-md-12">

<div class="col-md-4">

<label for="user_firstname" style="color: black;">Fecha Inscripción  <span class="label label-primary">Entre</span></label>
<datepicker :format="customFormatter" v-model="entre" @selected="fechaEntre"   input-class="datepicker" :language="es"></datepicker>

</div>
<div class="col-md-4">
<label for="user_firstname" style="color: black;">Fecha Inscripción  <span class="label label-success">Hasta</span></label>
<datepicker :format="customFormatter" v-model="hasta" @selected="fechHasta"  input-class="datepicker" :language="es"></datepicker>

</div>

<div class="col-md-4">
<label for="user_firstname" style="color: black;">Tipo Documento:</label>
<select  class="form-control" v-model="tipo_doc_persona">
<option value="">Seleccione</option>
<option v-for="documento in arrayTipoDocumento"  :key="documento.id" :value="documento.id" v-text="documento.descripcion"></option>
</select>
</div>

</div>
<div class="clearfix"></div><br>
<div class="col-md-12">
<div class="col-md-4">
<label for="user_firstname" style="color: black;">Sexo:</label>


<select  class="form-control" v-model="sexo_persona">
<option value="">Seleccione</option>
<option v-for="genero in sexo" :key="genero.id" :value="genero.id" v-text="genero.nombre"></option>
</select>


</div>
<div class="col-md-4">
<label for="user_firstname" style="color: black;">Edad  <span class="label label-primary">Entre</span></label>
<input  class="form-control" v-model="entre_edad"   style="position:  relative; top: -5px;"></input>
</div>
<div class="col-md-4">
<label for="user_firstname" style="color: black;">Edad  <span class="label label-success">Hasta</span></label>
<input  class="form-control"  v-model="hasta_edad"  style="position:  relative; top: -5px;"></input>
</div>
</div>
<div class="clearfix"></div><br>   
<div class="col-md-12">
<div class="col-md-4">
<label for="user_firstname" style="color: black;">Corregimiento:</label>

<select  class="form-control" v-model="corregimiento">
<option value="">Seleccione</option>
<option v-for="corregimiento in arrayCorregimientos" :key="corregimiento.id" :value="corregimiento.id" v-text="corregimiento.descripcion"></option>
</select>



</div>
<div class="col-md-4">
<label for="user_firstname">Barrio:</label>


<autocomplete
:source="arrayBarrios" @selected="cargarBarrio">
</autocomplete>

</div>



<div class="col-md-4">
<label for="user_firstname" style="color: black;">Comuna:</label>

<autocomplete
:source="arrayComunas" @selected="cargarComuna">
</autocomplete>





</div>
</div>
<div class="clearfix"></div><br>
<div class="col-md-12">
<div class="col-md-4">
<label for="user_firstname" style="color: black;">Estrato:</label>


<select  class="form-control" v-model="estrato">
<option value="" disabled>Seleccione</option>
<option v-for="estrato in estratos" :key="estrato.id" :value="estrato.id" v-text="estrato.nombre"></option>
</select>



</div>
<div class="col-md-4">
<label for="user_firstname" style="color: black;">Grado Escolaridad </label>        

<select  class="form-control" v-model="escolaridad">
<option value="" disabled>Seleccione</option>
<option v-for="escolaridad in arrayEscolaridades" :key="escolaridad.id" :value="escolaridad.id" v-text="escolaridad.nombre_grado"></option>
</select>




</div>
<div class="col-md-4">
<label for="user_firstname" style="color: black;">Etnia:</label>

<select  class="form-control" v-model="cultura">
<option value="" disabled>Seleccione</option>
<option v-for="etnia in arrayEtnias" :key="etnia.id" :value="etnia.id" v-text="etnia.descripcion"></option>
</select>



</div>
</div>
<div class="clearfix"></div><br>
<div class="col-md-12">
<div class="col-md-4">
<label for="user_firstname" style="color: black;">Discapacidad:</label>


<select  class="form-control" v-model="discapacidad">
<option value="" disabled>Seleccione</option>
<option v-for="discapacidad in arrayDiscapacidades" :key="discapacidad.id" :value="discapacidad.id" v-text="discapacidad.descripcion"></option>
</select>



</div>
<div class="col-md-4">
<label for="user_firstname">Institución:</label>


<autocomplete
:source="arrayInstituciones" @selected="cargarInstitucion">
</autocomplete>








</div>
<div class="col-md-4">
<label for="user_firstname" >Sede:</label>



<autocomplete
:source="arraySedes" @selected="cargarSede">
</autocomplete>




</div>
</div>
<div class='col-sm-12'>
<div class='form-group' style="position:  relative; top: 17px;">
<div class="table-responsive">
<div class="portlet-body">
<div class="actions">


<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-4" v-if="mostrarExportar">



<downloadexcel
class = "btn btn-success"
:fetch   = "fetchData"
:fields = "json_fields"
:before-generate = "startDownload"
:before-finish = "finishDownload"
name    = "beneficiarios.xls"
type    = "xls">
Descargar Excel
</downloadexcel>
</div>



<div class="col-md-4">
</div>
</div>
</div>
</div>
</div>


<div class="myDiv" id="myDiv" style="display: none;">
<div class="donut"></div>
<h3> Su archivo se esta descargando por favor espere este proceso tardara unos minutos </h3>
</div>
</div>
</div>
</div>
</div>
</div>              
<div class="clearfix"></div>
<br>
<table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter">
<thead > 
<th scope="col" style="color: white; font-size: 12px;">FORMADOR&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">CÓDIGO GRUPO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">GRADO GRUPO&nbsp;</th>   
<th scope="col" style="color: white; font-size: 12px;">INSTITUCION&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">SEDE&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">TIPO DOCUMENTO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">NO DOCUMENTO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">No FICHA&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">FECHA INSCRIPCIÓN&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">NOMBRES Y APELLIDOS&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">SEXO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">FECHA NACIMIENTO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">EDAD&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">CORREGIMIENTO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">VEREDA&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">BARRIO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">ESTRATO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">COMUNA&nbsp;</th>       
<th scope="col" style="color: white; font-size: 12px;">DIRECCION&nbsp;</th>       
<th scope="col" style="color: white; font-size: 12px;">TELEFONO&nbsp;</th>       
<th scope="col" style="color: white; font-size: 12px;">CELULAR&nbsp;</th>       
<th scope="col" style="color: white; font-size: 12px;">NIVEL ESCOLARIDAD&nbsp;</th>       
<th scope="col" style="color: white; font-size: 12px;">ESTADO ESCOLARIDAD&nbsp;</th>       


</thead>
<tbody>
<tr v-for="rol in arrayRol" :key="rol.id">
<td style="font-size: 12px;" v-text="rol.primer_nombre_usuario + rol.primer_apellido_usuario"></td>
<td style="font-size: 12px;" v-text="rol.codigo_grupo"></td>
<td style="font-size: 12px;" v-text="rol.nombre_grado"></td>
<td style="font-size: 12px;" v-text="rol.nombre_institucion"></td>
<td style="font-size: 12px;" v-text="rol.nombre_sede"></td>
<td style="font-size: 12px;" v-text="rol.tipo_documento"></td>
<td style="font-size: 12px;" v-text="rol.documento"></td>
<td style="font-size: 12px;" v-text="rol.no_ficha"></td>
<td style="font-size: 12px;" v-text="rol.fecha_inscripcion"></td>
<td style="font-size: 12px;" v-text="rol.nombre_primero + rol.apellido_primero"></td>
<td style="font-size: 12px;" v-text="rol.sexo"></td>
<td style="font-size: 12px;" v-text="rol.fecha_nacimiento"></td>
<td style="font-size: 12px;" v-text="rol.edad_persona"></td>
<td style="font-size: 12px;" v-text="rol.nombre_corregimiento"></td>
<td style="font-size: 12px;" v-text="rol.nombre_vereda"></td>
<td style="font-size: 12px;" v-text="rol.nombre_barrio"></td>
<td style="font-size: 12px;" v-text="rol.residencia_estrato"></td>
<td style="font-size: 12px;" v-text="rol.nombre_comuna"></td>
<td style="font-size: 12px;" v-text="rol.residencia_direccion"></td>
<td style="font-size: 12px;" v-text="rol.telefono_fijo"></td>
<td style="font-size: 12px;" v-text="rol.telefono_movil"></td>
<td style="font-size: 12px;" v-text="rol.nivel_escolaridad"></td>
<td style="font-size: 12px;" v-text="rol.estado_escolaridad"></td>

<td style="text-align: center;">
<!--                                                         <div class="btn-group pull-center">
<a class="btn btn-success" @click="permisos(rol.id, rol.name)"><i class="fa fa-check-circle"></i>&nbsp;Permisos</a>
<a class="btn btn-warning" @click="abrirModal('rol','actualizar',rol)"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>
</div>
-->                                                    </td>
</tr>
</tbody>
</table>
<nav>
<ul class="pagination">
<li class="page-item" v-if="pagination.current_page > 1">
<a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
</li>
<li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
<a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
</li>
<li class="page-item" v-if="pagination.current_page < pagination.last_page">
<a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
</li>
</ul>
</nav>
<div class="col-md-12"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!--Inicio del modal agregar/actualizar-->
<div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; height: 10000px;" aria-hidden="true">
<div class="modal-dialog modal-primary modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" style="background-color: #f4f4f4;">
<h4 class="modal-title" v-text="tituloModal"></h4>
<button type="button" class="close" @click="cerrarModal()" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
<div class="form-group row">
<label class="col-md-3 form-control-label" for="text-input">Nombre Rol(*)</label>
<div class="col-md-9">
<input type="text" v-model="nombre" class="form-control" placeholder="Nombre Rol">                           
</div>
</div>
<div class="form-group row">
<label class="col-md-3 form-control-label" for="email-input">Descripción</label>
<div class="col-md-9">
<textarea type="text" v-model="descripcion" class="form-control" placeholder="Descripción Rol"></textarea>
</div>
</div>
<div v-show="errorPersona" class="form-group row div-error">
<div class="text-center text-error">
<div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error"></div>
</div>
</div>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" @click="cerrarModal()">Cerrar</button>
<button type="button" v-if="tipoAccion==1" class="btn btn-success" @click="registrarRol()">Guardar</button>
<button type="button" v-if="tipoAccion==2" class="btn btn-success" @click="actualizarRol()">Actualizar</button>
</div>
</div>
</div>
</div>
<!--Fin del modal-->
</div>
</template>

</main>
</template>
<script>



import Vue from 'vue'
import VueSweetalert2 from 'vue-sweetalert2';
import Datepicker from 'vuejs-datepicker';
import { es } from 'vuejs-datepicker/dist/locale'
import VSelect from '@alfsnd/vue-bootstrap-select'
import { ModelListSelect } from 'vue-search-select'
import JsonExcel from 'vue-json-excel'
import _ from 'lodash'
import { MultiSelect } from 'vue-search-select'
Vue.component('downloadExcel', JsonExcel)
import Autocomplete from 'vuejs-auto-complete'
import downloadexcel from "vue-json-excel";
import axios from 'axios';
 import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';


export default {
data() {
return {

isLoading: false,
fullPage: true,
json_fields: {
'codigo_grupo': 'codigo_grupo',
'nombre_grado': 'nombre_grado',
'nombre_institucion': 'nombre_institucion',
'nombre_sede': 'nombre_sede',
'tipo_documento': 'tipo_documento',
'documento': 'documento',
'no_ficha': 'no_ficha',
'fecha_inscripcion': 'fecha_inscripcion',
'nombre_primero': 'nombre_primero',
'nombre_segundo': 'nombre_segundo',
'apellido_primero': 'apellido_primero',
'apellido_segundo': 'apellido_segundo',
'correo_electronico': 'correo_electronico',
'sexo': 'sexo',
'fecha_nacimiento': 'fecha_nacimiento',
'edad_persona': 'edad_persona',
'nombre_pais': 'nombre_pais',
'nombre_departamento': 'nombre_departamento',
'nombre_municipio': 'nombre_municipio',
'nombre_corregimiento': 'nombre_corregimiento',
'nombre_vereda': 'nombre_vereda',
'nombre_barrio': 'nombre_barrio',
'residencia_estrato': 'residencia_estrato',
'nombre_comuna': 'nombre_comuna',
'residencia_direccion': 'residencia_direccion',
'telefono_fijo': 'telefono_fijo',
'telefono_movil': 'telefono_movil',
'nivel_escolaridad': 'nivel_escolaridad',
'estado_escolaridad': 'estado_escolaridad',
'ocupacion_beneficiario': 'ocupacion_beneficiario',
'estado_civil': 'estado_civil',
'hijos_beneficiario': 'hijos_beneficiario',
'cantidad_hijos_beneficiario': 'cantidad_hijos_beneficiario',
'etnia_beneficiario': 'etnia_beneficiario',
'grupo_poblacional': 'grupo_poblacional',
'discapacidades': 'discapacidades',
'enfermedad_permanente': 'enfermedad_permanente',
'otra_discapacidad_beneficiario': 'otra_discapacidad_beneficiario',
'toma_medicamentos': 'toma_medicamentos',
'medicamentos_beneficiario': 'medicamentos_beneficiario',
'sangre_tipo': 'sangre_tipo',
'afiliacion_salud': 'afiliacion_salud',
'tipo_afiliacion': 'tipo_afiliacion',
'nombre_eps': 'nombre_eps',
'tipo_documento_acudiente': 'tipo_documento_acudiente',
'documento_acudiente': 'documento_acudiente',
'primer_nombre_acudiente': 'primer_nombre_acudiente',
'segundo_nombre_acudiente': 'segundo_nombre_acudiente',
'primer_apellido_acudiente': 'primer_apellido_acudiente',
'segundo_apellido_acudiente': 'segundo_apellido_acudiente',
'sexo_acudiente': 'sexo_acudiente',
'fecha_nacimiento_acudiente': 'fecha_nacimiento_acudiente',
'telefono_fijo_acudiente': 'telefono_fijo_acudiente',
'telefono_movil_acudiente': 'telefono_movil_acudiente',
'correo_acudiente': 'correo_acudiente',
'parentesco_acudiente': 'parentesco_acudiente',
'otro_parentesco_acudiente': 'otro_parentesco_acudiente',
'primer_nombre_usuario': 'primer_nombre_usuario',
'primer_apellido_usuario': 'primer_apellido_usuario',



},


// json_fields: {
//         'Complete name': 'name',
//         'Date': 'date',
//       },


// json_data: [
//     {
//         'name': 'Tony Peña',
//         'city': 'New York',

//     },
//     {
//         'name': 'Thessaloniki',
//         'city': 'Athens',


//     }
// ],
json_meta: [
[
{
'key': 'charset',
'value': 'utf-8'
}
]
],



json_data :[],

selectedValue: null,
es: es,
base:'',
tasks: [
{id:1, title: 'generar-factura' },
{id:2, title: 'crear-reserva' },
{id:3, title: 'editar-reserva' },
{id:4, title: 'eliminar-reserva' },
{id:5, title: 'crear-usuario' },
{id:6, title: 'editar-usuario' },
],

estratos: [
{id: 1, nombre: '1'},
{id: 2, nombre: '2'},
{id: 3, nombre: '3'},
{id: 4, nombre: '4'},
{id: 5, nombre: '5'},
{id: 6, nombre: '6'},
{id: 7, nombre: '7'},

],

options: [
{ value: '1', text: 'aa' + ' - ' + '1' },
{ value: '2', text: 'ab' + ' - ' + '2' },
{ value: '3', text: 'bc' + ' - ' + '3' },
{ value: '4', text: 'cd' + ' - ' + '4' },
{ value: '5', text: 'de' + ' - ' + '5' }
],
searchText: '', // If value is falsy, reset searchText & searchItem
items: [],
lastSelectItem: {},
mostrarExportar: false,
loading: false,
anual:'',
mes:'',
escolaridad:'',
cultura:'',
discapacidad:'',
institucion:'',
sede:'',
corregimiento:'',
selectedTasks: [],
rol_id: 0,
nombre : '',
entre : '',
sexo_persona : '',
entre_edad : '',
hasta_edad : '',
hasta : '',
comuna : '',
estrato : '',
tipo_doc_persona : '',
barrio : '',
descripcion : '',
arrayRol : [],
arrayPermisos : [],
arrayPermisosAsignados : [],
arrayTipoDocumento : [],
arrayCorregimientos : [],
arrayBarrios : [],
arrayComunas : [],
arrayEscolaridades : [],
arrayDiscapacidades : [],
arrayInstituciones : [],
arraySedes : [],
arrayEtnias : [],
nombre: '',
modal: 0,
modal2: 0,
tituloModal: '',
tipoAccion: 0,
errorPersona: 0,
errorMostrarMsjPersona: [],
sexo:[
{id: '1', nombre: 'Mujer'},
{id: '2', nombre: 'Hombre'},

],

pagination: {
total: 0,
current_page: 0,
per_page: 0,
last_page: 0,
from: 0,
to: 0,
},
offset: 3,
criterio: 'nombre',
buscar: '',
listado:1,
name_rol: '',
group: '',
selected_comuna: '',
selected_institucion: '',
selected_sede: '',
selected_entre: '',
selected_hasta: '',
total_beneficiarios: '',
};
},

watch: {
selectedUsers: function (newVal, oldVal) {
// Do what you want with the selected objects:
console.log(newVal)
}
},

components: {
Datepicker,
VSelect,
ModelListSelect,
MultiSelect,
Autocomplete,
downloadexcel,
Loading
},

computed: {
isActived: function() {
return this.pagination.current_page;
},
//Calcula los elementos de la paginación
pagesNumber: function() {
if (!this.pagination.to) {
return [];
}

var from = this.pagination.current_page - this.offset;
if (from < 1) {
from = 1;
}

var to = from + this.offset * 2;
if (to >= this.pagination.last_page) {
to = this.pagination.last_page;
}

var pagesArray = [];
while (from <= to) {
pagesArray.push(from);
from++;
}
return pagesArray;
},
},
methods: {


 doAjax() {
                this.isLoading = true;
               
            },
            onCancel() {
              console.log('User cancelled the loader.')
            },

GenerarTotal()
{


let me = this;

var url= '/generar_total?tipo_doc_persona=' + me.tipo_doc_persona + '&entre='+ me.selected_entre + '&hasta='+ me.selected_hasta + '&sexo='+ me.sexo_persona + '&entre_edad='+ me.entre_edad + '&hasta_edad='+ me.hasta_edad + '&corregimiento='+ me.corregimiento + '&barrio='+ me.group + '&comuna='+ me.selected_comuna + '&estrato='+ me.estrato + '&escolaridad='+ me.escolaridad + '&etnia='+ me.cultura + '&discapacidad='+ me.discapacidad + '&institucion='+ me.selected_institucion + '&sede='+ me.selected_sede;


axios.get(me.base+url).then(function (response) {
console.log(response);


var respuesta= response.data.datos;
me.isLoading = true;



  setTimeout(() => {
      me.isLoading = false,
      me.total_beneficiarios = respuesta;
    },4)

})
.catch(function (error) {

});

},


listarRol (page,buscar,criterio){

console.log(buscar)
console.log(criterio)
let me=this;
var url= '/listar_reporte_general?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
axios.get(me.base+url).then(function (response) {
console.log(response);
var respuesta= response.data;
me.arrayRol = respuesta.roles.data;
me.pagination= respuesta.pagination;
})
.catch(function (error) {
// var response = error.response.data;
// console.log(response.message, 
//     response.exception, 
//     response.file, 
//     response.line);
});
},


handleTasks(task) {
// Do what you want with the selected objects:
let me = this;
axios
.post(me.base+'/quitar/permiso', {
permiso: task,
rol_id: me.rol_id

})
.then(function(response) {



})
.catch(function(error) {
var response = error.response.data;
console.log(response.message, response.exception, response.file, response.line);
});

},

onSelect (items, lastSelectItem) {
console.log(items)
},

cargarBarrio (group) {
let me = this;
me.group = group.selectedObject.id;
this.fetchData();
},


cargarComuna (group) {
let me = this;
me.selected_comuna = group.selectedObject.id;
this.fetchData();
},
cargarInstitucion (group) {
let me = this;
me.selected_institucion = group.selectedObject.id;
this.fetchData();
},

cargarSede (group) {
let me = this;
me.selected_sede = group.selectedObject.id;
this.fetchData();
},



seleccionado()
{
console.log(2);
},

fechaEntre(entres)
{
let me = this;
var d = new Date(entres);
me.selected_entre = $.datepicker.formatDate('yy-mm-dd', d);


},
fechHasta(hastas)
{


let me = this;
var d = new Date(hastas);
me.selected_hasta = $.datepicker.formatDate('yy-mm-dd', d);
me.CargaBeneficiarios();
me.cargarTotal(me.selected_entre, me.selected_hasta);

},


cargarTotal(entre, hasta)
{

let me = this;
var url= '/total_beneficiarios?entre=' + entre + '&hasta='+ hasta;
axios.get(me.base+url).then(function (response) {


var respuesta= response.data.datos;

me.isLoading = true;



  setTimeout(() => {
      me.isLoading = false,
      me.total_beneficiarios = respuesta;
    },4)



})
.catch(function (error) {

});


},

async fetchData(){
let me = this;
var url= '/exportar/información_programas1?tipo_doc_persona=' + me.tipo_doc_persona + '&entre='+ me.selected_entre + '&hasta='+ me.selected_hasta + '&sexo='+ me.sexo_persona + '&entre_edad='+ me.entre_edad + '&hasta_edad='+ me.hasta_edad + '&corregimiento='+ me.corregimiento + '&barrio='+ me.group + '&comuna='+ me.selected_comuna + '&estrato='+ me.estrato + '&escolaridad='+ me.escolaridad + '&etnia='+ me.cultura + '&discapacidad='+ me.discapacidad + '&institucion='+ me.selected_institucion + '&sede='+ me.selected_sede;

const response = await axios.get(me.base+url);
console.log(response);
return response.data.datos;
},
startDownload(){

let me = this;
me.isLoading = true;

},
finishDownload(){

    setTimeout(() => {
      this.isLoading = false
    },4)


},

CargaBeneficiarios()
{
let me = this;

if (me.selected_entre != null && me.selected_hasta !=null) 
{
me.mostrarExportar = true;
}



},

// Exportaciones()
// {


// let me = this;
// axios
// .get(me.base+'/admin/postreporteficha', {


// })
// .then(function(response) {
// var respuesta= response.data;
// me.json_data = respuesta[1];            
// console.log(me.json_data)


// })
// .catch(function(error) {

// });


// },

guardarPermisos()
{
let me = this;

axios
.post(me.base+'/asignar/permisos', {
permisos: me.selectedTasks,
rol_id: me.rol_id

})
.then(function(response) {

me.modal2 = 0;
me.listado = 1;
Swal.fire({
position: 'top-end',
type: 'success',
title: 'Registro almacenado',
showConfirmButton: false,
timer: 1500
})

})
.catch(function(error) {
var response = error.response.data;
console.log(response.message, response.exception, response.file, response.line);
});
},

obtenerPermisos()
{

let me = this;
axios
.get(me.base+'/obtener/permisos', {


})
.then(function(response) {

var respuesta= response.data;
me.arrayPermisos = respuesta.permisos;            
console.log(me.arrayPermisos)

})
.catch(function(error) {
var response = error.response.data;
console.log(response.message, response.exception, response.file, response.line);
});
},

simulateAjax() {
let me = this;
this.selectedTasks = me.arrayPermisos;
console.log(this.selectedTasks)
},

customFormatter(date) {
return moment(date).format('YYYY-MM-DD');
},

clear() {

let me = this;
axios
.post(me.base+'/quitar/permisos_all', {
permisos: me.selectedTasks,
rol_id: me.rol_id

})
.then(function(response) {
me.selectedTasks = []


})
.catch(function(error) {
var response = error.response.data;
console.log(response.message, response.exception, response.file, response.line);
});


},

cambiarPagina(page, buscar, criterio) {
let me = this;
//Actualiza la página actual
me.pagination.current_page = page;
//Envia la petición para visualizar la data de esa página
me.listarRol(page, buscar, criterio);
},
registrarRol() {

let me = this;

axios
.post(me.base+'/rol/registrar', {
nombre: this.nombre,
descripcion: this.descripcion,

})
.then(function(response) {
me.cerrarModal();
me.listarRol(1, '', 'nombre');
Swal.fire({
position: 'top-end',
type: 'success',
title: 'Registro almacenado',
showConfirmButton: false,
timer: 1500
})
})
.catch(function(error) {

var response = error.response.data;
});
},
actualizarRol() {


let me = this;

axios
.put('/rol/actualizar', {
nombre: this.nombre,
descripcion: this.descripcion,
id: this.rol_id,
})
.then(function(response) {
me.cerrarModal();
me.listarRol(1, '', 'nombre');
})
.catch(function(error) {
var response = error.response.data;
console.log(response.message, response.exception, response.file, response.line);
});
},
validarPersona() {
this.errorPersona = 0;
this.errorMostrarMsjPersona = [];

if (!this.nombre) this.errorMostrarMsjPersona.push('El nombre de la pesona no puede estar vacío.');
if (!this.usuario) this.errorMostrarMsjPersona.push('El nombre de usuario no puede estar vacío.');
if (!this.password) this.errorMostrarMsjPersona.push('La password del usuario no puede estar vacía.');
if (this.idrol == 0) this.errorMostrarMsjPersona.push('Seleccione una Role.');
if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

return this.errorPersona;
},
cerrarModal() {
this.modal = 0;
this.tituloModal = '';
this.nombre = '';
this.tipo_documento = 'DNI';
this.num_documento = '';
this.direccion = '';
this.telefono = '';
this.email = '';
this.usuario = '';
this.password = '';
this.idrol = 0;
this.errorPersona = 0;
},

cerrarModal2() {
this.modal2 = 0;
this.tituloModal = '';

},
abrirModal(modelo, accion, data = []) {

switch (modelo) {
case 'rol': {
switch (accion) {
case 'registrar': {
this.modal = 1;
this.tituloModal = 'Registrar Rol';
this.nombre = '';
this.descripcion = '';
this.tipoAccion = 1;
break;
}
case 'actualizar': {
console.log(data);
this.modal = 1;
this.tituloModal = 'Actualizar Rol';
this.tipoAccion = 2;
this.rol_id = data['id'];
this.nombre = data['name'];
this.descripcion = data['description'];
break;
}
}
}
}
},

abrirModal2(id) {


this.modal2 = 1;
this.tituloModal = 'Asignar Permisos';
this.tipoAccion = 1;
this.rol_id = id;
this.obtenerPermisos();
this.permisosAsignados(this.rol_id);




},


permisos(id, name)
{

let me = this;
me.listado = 2;
this.rol_id = id;
me.obtenerPermisos();
this.permisosAsignados(this.rol_id);
this.name_rol = name;
},

permisosAsignados(rol_id)
{

let me=this;
var url= '/obtener/permiso_asignado?rol_id=' + rol_id;
axios.get(me.base+url).then(function (response) {

var respuesta= response.data;
me.selectedTasks = respuesta.permisos;
console.log(me.selectedTasks)

})
.catch(function (error) {
var response = error.response.data;
console.log(response.message, 
response.exception, 
response.file, 
response.line);
});


},

Atras()
{

let me = this;
me.listado = 1;

},
desactivarRol(id) {

swal({
title: 'Esta seguro de desactivar este rol?',
icon: "warning",
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Aceptar!',
cancelButtonText: 'Cancelar',
confirmButtonClass: 'btn btn-success',
cancelButtonClass: 'btn btn-danger',
buttonsStyling: false,
reverseButtons: true,
}).then(result => {
if (result.value) {
let me = this;

axios
.put('/rol/desactivar', {
id: id,
})
.then(function(response) {
me.listarRol(1, '', 'nombre');
swal('Desactivado!', 'El registro ha sido desactivado con éxito.', 'success');
})
.catch(function(error) {
var response = error.response.data;
console.log(response.message, response.exception, response.file, response.line);
});
} else if (
// Read more about handling dismissals
result.dismiss === swal.DismissReason.cancel
) {
}
});
},


alertSuccess({title = "Success!", text = "That's all done!", timer = 1000, showConfirmationButton = false} = {}) {
this.alert({
title: title,
text: text,
timer: timer,
showConfirmButton: showConfirmationButton,
type: 'success'
});
},

tipoDocumento()
{

let me=this;
var url= '/obtenerselect/tipo_documento';
axios.get(me.base+url).then(function (response) {

var respuesta= response.data;
me.arrayTipoDocumento = respuesta.documentos;
console.log(response);

})
.catch(function (error) {
var response = error.response.data;
console.log(response.message, 
response.exception, 
response.file, 
response.line);
});


},

Corregimientos()
{

let me=this;
var url= '/obtener/corregimientos';
axios.get(me.base+url).then(function (response) {

var respuesta= response.data;
me.arrayCorregimientos = respuesta.datos;
console.log(response);

})
.catch(function (error) {
var response = error.response.data;
console.log(response.message, 
response.exception, 
response.file, 
response.line);
});


},

Comunas()
{

let me=this;
var url= '/obtenerselect/comunas';
axios.get(me.base+url).then(function (response) {

var respuesta= response.data;
me.arrayComunas = respuesta.datos;
console.log(response);

})
.catch(function (error) {
var response = error.response.data;
console.log(response.message, 
response.exception, 
response.file, 
response.line);
});


},

Barrios()
{

let me=this;
var url= '/obtener/barrios';
axios.get(me.base+url).then(function (response) {

var respuesta= response.data;
me.arrayBarrios = respuesta.datos;
console.log(response);

})
.catch(function (error) {
var response = error.response.data;
console.log(response.message, 
response.exception, 
response.file, 
response.line);
});


},


Escolaridades()
{

let me=this;
var url= '/obtenerselect/gradosEscolaridad';
axios.get(me.base+url).then(function (response) {

var respuesta= response.data;
me.arrayEscolaridades = respuesta.datos;
console.log(response);

})
.catch(function (error) {
var response = error.response.data;
console.log(response.message, 
response.exception, 
response.file, 
response.line);
});

},


Etnias()
{

let me=this;
var url= '/obtenerselect/culturas';
axios.get(me.base+url).then(function (response) {

var respuesta= response.data;
me.arrayEtnias = respuesta.datos;
console.log(response);

})
.catch(function (error) {
var response = error.response.data;
console.log(response.message, 
response.exception, 
response.file, 
response.line);
});

},

Discapacidades()
{

let me=this;
var url= '/obtenerselect/discapacidad';
axios.get(me.base+url).then(function (response) {

var respuesta= response.data;
me.arrayDiscapacidades = respuesta.datos;
console.log(response);

})
.catch(function (error) {
var response = error.response.data;
console.log(response.message, 
response.exception, 
response.file, 
response.line);
});

},


Instituciones()
{

let me=this;
var url= '/obtenerselect/instituciones';
axios.get(me.base+url).then(function (response) {

var respuesta= response.data;
me.arrayInstituciones = respuesta.datos;
console.log(response);

})
.catch(function (error) {
var response = error.response.data;
console.log(response.message, 
response.exception, 
response.file, 
response.line);
});


},

Sedes()
{


let me=this;
var url= '/obtenerselect/sedes';
axios.get(me.base+url).then(function (response) {

var respuesta= response.data;
me.arraySedes = respuesta.datos;
console.log(response);

})
.catch(function (error) {
var response = error.response.data;
console.log(response.message, 
response.exception, 
response.file, 
response.line);
});


},



activarRol(id) {
swal({
title: 'Esta seguro de activar este rol?',
icon: "warning",
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Aceptar!',
cancelButtonText: 'Cancelar',
confirmButtonClass: 'btn btn-success',
cancelButtonClass: 'btn btn-danger',
buttonsStyling: false,
reverseButtons: true,
}).then(result => {
if (result.value) {
let me = this;

axios
.put('/rol/activar', {
id: id,
})
.then(function(response) {
me.listarRol(1, '', 'nombre');
swal('Activado!', 'El registro ha sido activado con éxito.', 'success');
})
.catch(function(error) {
var response = error.response.data;
console.log(response.message, response.exception, response.file, response.line);
});
} else if (
// Read more about handling dismissals
result.dismiss === swal.DismissReason.cancel
) {
}
});
},
},
mounted() {
this.base=base;
this.listarRol(1, this.buscar, this.criterio);
this.tipoDocumento();
this.Corregimientos();
this.Barrios();
this.Comunas();
this.Escolaridades();
this.Etnias();
this.Discapacidades();
this.Instituciones();
this.Sedes();   
// this.Exportaciones();

},
};
</script>
<style>

table { 
width: 750px; 
border-collapse: collapse; 
margin:50px auto;
}

/* Zebra striping */
tr:nth-of-type(odd) { 
background: #eee; 
}

th { 
background: #3498db; 
color: white; 
font-weight: bold; 
}

td, th { 
padding: 10px; 
border: 1px solid #ccc; 
text-align: left; 
font-size: 18px;
}

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

table { 
width: 100%; 
}

/* Force table to not be like tables anymore */
table, thead, tbody, th, td, tr { 
display: block; 
}

/* Hide table headers (but not display: none;, for accessibility) */
thead tr { 
position: absolute;
top: -9999px;
left: -9999px;
}

tr { border: 1px solid #ccc; }

td { 
/* Behave  like a "row" */
border: none;
border-bottom: 1px solid #eee; 
position: relative;
padding-left: 50%; 
}

td:before { 
/* Now like a table header */
position: absolute;
/* Top/left values mimic padding */
top: 6px;
left: 6px;
width: 45%; 
padding-right: 10px; 
white-space: nowrap;
/* Label the data */
content: attr(data-column);

color: #000;
font-weight: bold;
}

}

.modal-content {
width: 100% !important;
position: absolute !important;
}
.mostrar {
display: block !important;
opacity: 1 !important;
position: absolute !important;
background-color: #3c29297a !important;
height: 100vh;
}
.div-error {
display: flex;
justify-content: center;
}
.text-error {
color: red !important;
font-weight: bold;
}

@media (max-width: 768px) {
.mostrar {
height: 150%;
}
}

.gradient-mint {
background-image: linear-gradient(45deg, #23BCBB, #45E994);
background-repeat: repeat-x;
}



@-webkit-keyframes click-wave {
0% {
height: 20px;
width: 20px;
opacity: 0.35;
position: relative;
}
100% {
height: 100px;
width: 100px;
margin-left: -80px;
margin-top: -80px;
opacity: 0;
}
}
@-moz-keyframes click-wave {
0% {
height: 20px;
width: 20px;
opacity: 0.35;
position: relative;
}
100% {
height: 100px;
width: 100px;
margin-left: -80px;
margin-top: -80px;
opacity: 0;
}
}
@keyframes click-wave {
0% {
height: 20px;
width: 20px;
opacity: 0.35;
position: relative;
}
100% {
height: 100px;
width: 100px;
margin-left: -80px;
margin-top: -80px;
opacity: 0;
}
}
.option-input {
-webkit-appearance: none;
-moz-appearance: none;
-ms-appearance: none;
-o-appearance: none;
appearance: none;
position: relative;
top: 13.3333333333px;
right: 0;
bottom: 0;
left: 0;
height: 20px;
width: 20px;
-webkit-transition: all 0.15s ease-out 0s;
-moz-transition: all 0.15s ease-out 0s;
transition: all 0.15s ease-out 0s;
background: #cbd1d8;
border: none;
color: #fff;
cursor: pointer;
display: inline-block;
margin-right: 0.5rem;
outline: none;
position: relative;
z-index: 1000;
}
.option-input:hover {
background: #9faab7;
}
.option-input:checked {
background: #40e0d0;
}
.option-input:checked::before {
height: 20px;
width: 20px;
position: absolute;
content: '\2714';
display: inline-block;
font-size: 26.6666666667px;
text-align: center;
line-height: 20px;
}
.option-input:checked::after {
-webkit-animation: click-wave 0.65s;
-moz-animation: click-wave 0.65s;
animation: click-wave 0.65s;
background: #40e0d0;
content: '';
display: block;
position: relative;
z-index: 100;
}
.option-input.radio {
border-radius: 50%;
}
.option-input.radio::after {
border-radius: 50%;
}
/*
.datepicker {
border: 1px solid #ff0000;  // <-- This code is not working
}*/
.datepicker 
{
padding: 4px;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
direction: ltr;
width: 278px;
height: 34px;
}


#sum_box .icon {
color: #777777;
font-size: 50px;
margin-bottom: 0px;
float: right;
display: none !important;
}

.autocomplete__box {

border: 0 !important;

}

.autocomplete__inputs input {
width: 104% !important;
border: 0;
height: 32px !important;
}

</style>
