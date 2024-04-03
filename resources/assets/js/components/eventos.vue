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

<h4 style="text-align: center;"><strong style="color:black">LISTADO DE ASISTENCIA</strong></h4>
<!-- <button type="button" class="btn btn-success" @click="GenerarTotal()">General Total</button> -->



<div id="table-table-tab" class="tab-pane fade in active">

<div class="clearfix"></div><br>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					 <label for="user_firstname" style="color: black;">Acta de Reunion No</label>
         			 <input id="acta_reunion" v-model="acta_reunion" :disabled="isDisabled1" class="form-control" value=""  />
				</div>
				
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div><br>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<label for="user_firstname" style="color: black;">Fecha</label>
					<datepicker :format="customFormatter" v-model="entre" @selected="fechaEntre" :disabled="isDisabled2"  input-class="datepicker" :language="es"></datepicker>
				</div>
				<div class="col-md-4">
					<label for="user_firstname" style="color: black;">Hora Inicial  </label>
          <input id="hora_inicial" class="form-control" v-model="hora_inicial" :disabled="isDisabled3" data-default="08:45" />
				</div>
				<div class="col-md-4">
					      <label for="user_firstname"  style="color: black;">Hora Final  </label>
          <input id="hora_final" class="form-control" :disabled="isDisabled4" value="" data-default="08:45" />
				</div>
			</div>
		</div>
	</div>
</div>

  <div>


</div>



<div class="clearfix"></div><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-8">
					  <label for="user_firstname" style="color: black;">Objetivo:</label>
  						<textarea class="form-control" :disabled="isDisabled5" rows="5" id="comment"></textarea>
				</div>
				<div class="col-md-4">
					<label for="user_firstname" style="color: black;">Lugar:</label>
                  <input type="text" class="form form-control" :disabled="isDisabled6" v-model="cascos"/>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div><br>
 <div class="col-sm-12">
                  <button v-if="tipoGuardar==1"  @click="GuardarAsistencia()" class="btn btn-success"> Crear Asistencia</button>

                   <button v-if="tipoGuardar==2"  @click="EditarAsistencia()" class="btn btn-warning"> Editar</button>

                   <button v-if="tipoGuardar==3"  @click="ActualizarAsistencia()" class="btn btn-warning"> Actualizar</button>
                
                </div>

<div class="clearfix"></div>
<br>


<div class="container-fluid" v-if="asistentes==2">
	<div class="row">
		<div class="col-md-12">

        <h3>
            Agrega Participantes
        </h3>
        <hr>
        <div class="row">
            <div class="col-xs-2">
                <button type="button" v-on:click="addNewApartment" class="btn btn-block btn-success">
                    Agregar +
                </button>
            </div>
          
        </div>
        <div class="clearfix"></div><br>
        <div v-for="(apartment, index) in apartments">
            <div class="row">
                <div class="col-xs-1">
                    <label>&nbsp;</label>
                    <button type="button" v-on:click="removeApartment(index)" class="btn btn-block btn-danger">
                        -
                    </button>
                </div>
                <div class="form-group col-xs-2">
                    <label>No Documento</label>
                    <input v-model="apartment.price" type="number"
                           name="apartments[][price]" class="form-control" placeholder="No Documento">
                </div>
                <div class="form-group col-xs-3">
                    <label>Nombres</label>
                    <input v-model="apartment.rooms" type="text"
                           name="apartments[][rooms]" class="form-control" placeholder="Nombres">
                </div>
                <div class="form-group col-xs-2">
                    <label>Programa</label>
                    <input v-model="apartment.rooms" type="text"
                           name="apartments[][rooms]" class="form-control" placeholder="Programa">
                </div>
                 <div class="form-group col-xs-2">
                    <label>Telefono</label>
                    <input v-model="apartment.rooms" type="text"
                           name="apartments[][rooms]" class="form-control" placeholder="Telefono">
                </div>
                 <div class="form-group col-xs-2">
                    <label>Email</label>
                    <input v-model="apartment.rooms" type="text"
                           name="apartments[][rooms]" class="form-control" placeholder="Email">
                </div>
            </div>
        </div>
        <div class="clearfix"></div><br>
        <div class="row">
            <div class="col-xs-2">
                <button type="submit" v-on:click.prevent="sumbitForm" class="btn btn-block btn-primary">
                    Guardar Asistentes
                </button>
            </div>
          
        </div>
        <hr>
		</div>
	</div>
</div>


<!-- <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter">
<thead > 
<th scope="col" style="color: white; font-size: 12px;">NO DOCUMENTO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">NOMBRES&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">PROGRAMA&nbsp;</th>   
<th scope="col" style="color: white; font-size: 12px;">TELEFONO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">CORREO ELECTRONICO&nbsp;</th>
<th scope="col" style="color: white; font-size: 12px;">ACCIÓN&nbsp;</th>


</thead>
<tbody>
<tr v-for="rol in arrayRol" :key="rol.id">
<td style="font-size: 12px;" v-text="rol.primer_nombre_usuario + rol.primer_apellido_usuario"></td>
<td style="font-size: 12px;" v-text="rol.codigo_grupo"></td>
<td style="font-size: 12px;" v-text="rol.nombre_grado"></td>
<td style="font-size: 12px;" v-text="rol.nombre_institucion"></td>
<td style="font-size: 12px;" v-text="rol.nombre_sede"></td>
<td style="font-size: 12px;" v-text="rol.tipo_documento"></td>
<td style="text-align: center;">

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
 --><div class="col-md-12"></div>
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
    import VueTimepicker from 'vuejs-timepicker'

Vue.use(VueTimepicker)

export default {
data() {
return {

yourTimeValue: {
        HH: "10",
        mm: "05",
        ss: "00"
      },
isLoading: false,
fullPage: true,

apartment: {
      price: '',
      rooms: ''
    },
    apartments: [],

isDisabled1: false,
isDisabled2: false,
isDisabled3: false,
isDisabled4: false,
isDisabled5: false,
isDisabled6: false,
tipoGuardar:1,
asistentes: 1,
selectedValue: null,
es: es,
hora_inicial:'',
acta_reunion:'',
base:'',
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
cascos : '',
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
Loading,
VueTimepicker 
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


GuardarAsistencia()
{

	let me = this;
	me.hora_inicial = $('#hora_inicial').val();
	console.log(me.hora_inicial);
	me.tipoGuardar = 2;
	me.asistentes = 2;
	me.isDisabled1 = true;
	me.isDisabled2 = true;
	me.isDisabled3 = true;
	me.isDisabled4 = true;
	me.isDisabled5 = true;
	me.isDisabled6 = true;

},

EditarAsistencia()
{

	let me= this;
	me.tipoGuardar = 3;
	me.isDisabled1 = false;
	me.isDisabled2 = false;
	me.isDisabled3 = false;
	me.isDisabled4 = false;
	me.isDisabled5 = false;
	me.isDisabled6 = false;

},

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

 addNewApartment: function () {
      this.apartments.push(Vue.util.extend({}, this.apartment))
    },
    removeApartment: function (index) {
      Vue.delete(this.apartments, index);
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

var input1 = $('#hora_inicial');
	input1.clockpicker({
	    twelvehour: true,
	    donetext: 'Done'
	});

var input2 = $('#hora_final');
	input2.clockpicker({
	    twelvehour: true,
	    donetext: 'Done'
	});

 this.apartments = JSON.parse(this.$el.dataset.apartments)

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
width: 310px;
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
