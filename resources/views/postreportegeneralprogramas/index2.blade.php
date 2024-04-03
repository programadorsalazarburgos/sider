<div ng-controller="BeneficiariosReporteProgramasCrtl">
  


<script>
  
function convertToCSV(objArray) 
{
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';
    for (var i = 0; i < array.length; i++) 
    {
        var line = '';
        for (var index in array[i]) 
        {
            if (line != '') 
            {line += ';';}
            try
            {
                line += array[i][index];
                //line += utf8_decode(array[i][index]);
            }
            catch(Exception)
            {
                line += array[i][index];
            }
        }
        line=line.replace(/\á/g, 'a').replace(/\é/g, 'e').replace(/\í/g, 'i').replace(/\ó/g, 'o').replace(/\ú/g, 'u');
        line=line.replace(/\Á/g, 'A').replace(/\É/g, 'E').replace(/\Í/g, 'I').replace(/\Ó/g, 'O').replace(/\Ú/g, 'U');
        str += line + '\r\n';
    }
    return str;
}


function exportCSVFile(headers, items, fileTitle) {
    if (headers) {
        items.unshift(headers);
    }

    // Convert Object to JSON
    var jsonObject = JSON.stringify(items);

    var csv = this.convertToCSV(jsonObject);

    var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}


function CargarImagen()
{

  $('#myDiv').show();
}


function download(){

  CargarImagen();

  $.ajax({
            url:'{{url('')}}/api/v0/admin/postreportefichaProgramas',
            type:'POST',
            dataType:'json',
            data:$('form').serialize(),
           //  beforeSend: function() {
           //    $("#loading-image").show();
           // },
            success:function(data)
            {



var headers = {
      nombre_formador: 'nombre_formador', // remove commas to avoid errors
      apellido_formador: 'apellido_formador', // remove commas to avoid errors
      nombre_grupo: 'nombre_grupo', // remove commas to avoid errors
      nombre_lugar: "nombre_lugar",
      nombre_disciplina: "nombre_disciplina",
      fecha_inscripcion: "fecha_inscripcion",
      documento: "documento",
      nombre_primero: "nombre_primero",
      nombre_segundo: "nombre_segundo",
      apellido_primero: "apellido_primero",
      apellido_segundo: "apellido_segundo",
      sexo: "sexo",
      fecha_nacimiento: "fecha_nacimiento",
      edad_persona: "edad_persona",
      nombre_corregimiento: "nombre_corregimiento",
      nombre_vereda: "nombre_vereda",
      nombre_barrio: "nombre_barrio",
      residencia_estrato: "residencia_estrato",
      nombre_comuna: "nombre_comuna",
      nivel_escolaridad: "nivel_escolaridad",
      estado_escolaridad: "estado_escolaridad",
      ocupacion_beneficiario: "ocupacion_beneficiario",
      estado_civil: "estado_civil",
      etnia_beneficiario: "etnia_beneficiario",
      poblacional: "poblacional",
      enfermedad_permanente: "enfermedad_permanente",
      discapacidades: "discapacidades",
      otra_discapacidad_beneficiario: "otra_discapacidad_beneficiario",
      toma_medicamentos: "toma_medicamentos",
      medicamentos_beneficiario: "medicamentos_beneficiario",
      sangre_tipo: "sangre_tipo",
      afiliacion_salud: "afiliacion_salud",
      tipo_afiliacion: "tipo_afiliacion",
      nombre_eps: "nombre_eps"




  };

  var itemsFormatted = [];

  // format the data
  data.forEach((item) => {
      itemsFormatted.push({
          nombre_formador: item.nombre_formador, // remove commas to avoid errors,
          apellido_formador: item.apellido_formador, // remove commas to avoid errors,
          nombre_grupo: item.nombre_grupo, // remove commas to avoid errors,
          nombre_lugar: item.nombre_lugar,
          nombre_disciplina: item.nombre_disciplina,
          fecha_inscripcion: item.fecha_inscripcion,
          documento: item.documento,
          nombre_primero: item.nombre_primero,
          nombre_segundo: item.nombre_segundo,
          apellido_primero: item.apellido_primero,
          apellido_segundo: item.apellido_segundo,
          sexo: item.sexo,
          fecha_nacimiento: item.fecha_nacimiento,
          edad_persona: item.edad_persona,
          nombre_corregimiento: item.nombre_corregimiento,
          nombre_vereda: item.nombre_vereda,
          nombre_barrio: item.nombre_barrio,
          residencia_estrato: item.residencia_estrato,
          nombre_comuna: item.nombre_comuna,
          nivel_escolaridad: item.nivel_escolaridad,
          estado_escolaridad: item.estado_escolaridad,
          ocupacion_beneficiario: item.ocupacion_beneficiario,
          estado_civil: item.estado_civil,
          etnia_beneficiario: item.etnia_beneficiario,
          poblacional: item.poblacional,
          enfermedad_permanente: item.enfermedad_permanente,
          discapacidades: item.discapacidades,
          otra_discapacidad_beneficiario: item.otra_discapacidad_beneficiario,
          toma_medicamentos: item.toma_medicamentos,
          medicamentos_beneficiario: item.medicamentos_beneficiario,
          sangre_tipo: item.sangre_tipo,
          afiliacion_salud: item.afiliacion_salud,
          tipo_afiliacion: item.tipo_afiliacion,
          nombre_eps: item.nombre_eps

      });
  });


  var fileTitle = 'Reporte_General'; // or 'my-unique-title'

  exportCSVFile(headers, itemsFormatted, fileTitle); // call the exportCSVFile() function to process the JSON and trigger the download
  $('#myDiv').hide();
   }
  
  })


  
}
</script>

<style>


.myDiv {
  
  height: 150px;
  /*IMPORTANTE*/
  display: flex;
  justify-content: center;
  align-items: center;
}

/*.hijo {
  background: red;
  width: 120px;
}
*/

.donut {
  margin: auto;
  width: 50px;
  height: 50px;
  display: block;
  background: transparent;
  border-radius: 50%;
  border: 7px solid rgba(128, 128, 128, 0.2);
  border-left: 7px solid #ff0080;
  -webkit-animation: 2s rotate infinite linear;
          animation: 2s rotate infinite linear;
}

.donut-abs {
  width: 65px;
  height: 65px;
  position: relative;
  display: block;
  box-sizing: border-box;
}
.donut-abs .spinner,
.donut-abs .circle {
  position: absolute;
  border-radius: 50%;
  box-sizing: border-box;
}
.donut-abs .spinner {
  width: 100%;
  height: 100%;
  border: 9px solid transparent;
  border-top: 9px solid #1d1d1d;
  -webkit-animation: 2s rotate infinite linear;
          animation: 2s rotate infinite linear;
}
.donut-abs .circle {
  width: 100%;
  height: 100%;
  border: 7px solid rgba(128, 128, 128, 0.2);
}

@-webkit-keyframes rotate {
  from {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}

@keyframes rotate {
  from {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}

/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

    .table-responsive {
      width: 100%;
      margin-bottom: 15px;
      overflow-x: auto;
      overflow-y: hidden;

  }
</style>
<div class="clearfix"></div><br>
<div class="row">
  <div class="col-md-3">Busqueda:
    <input type="text" ng-model="search"  placeholder="Buscar" class="form-control" />
  </div>
  <div class="col-md-4">
    <label for="search">Items por pagina:</label>
    <input type="number" min="1" max="100" class="form-control" ng-model="pageSize">
  </div>
  <div class="col-md-5">
    <h5>Resultado @{{ filtered.length }} de @{{ totalItems}} total Beneficiarios</h5>
  </div>
</div>
<div class="clearfix"></div><br>
<div id="table-action" class="row">
  <div class="col-lg-12">
    <ul id="tableactiondTab" class="nav nav-tabs">
      <li class="active"><a href="#table-table-tab" data-toggle="tab">Información</a></li>
    </ul>
    <div id="tableactionTabContent" class="tab-content">
      <div id="table-table-tab" class="tab-pane fade in active">
        <div class="row">
          <div class="col-lg-12"><h4 class="box-heading" style="text-align:center;">Reporte General Beneficiarios</h4>
            <div class="clearfix"></div><br>
            <div class="table-container">
              <div class="row mbm">
                <div class="col-lg-6">
                  <div class="clearfix"></div><br>
                  <div class="pagination-panel">Resultado @{{ filtered.length }} de @{{ totalItems}} total Beneficiarios
                  </div>
                </div>
                <div class="clearfix"></div><br>
              </div>
              <form class="form-vertical" role="form" method="get" enctype="multipart/form-data" action="{{url('export/reportgeneralprogramas')}}">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <label for="user_firstname" style="color: black;">Tipo Documento:</label>
                    <select name="tipo_doc_persona" ng-model="tipo_doc_persona" style="position:  relative;top: -5px;"
                    ng-change="CargaBeneficiarios()" class="form-control ng-pristine ng-untouched ng-valid">
                    <option value="">Seleccione</option>
                    <option ng-repeat="tip_documento in tipo_documento" value="@{{ tip_documento.id }}">@{{ tip_documento.descripcion }}</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Fecha Inscripción  <span class="label label-primary">Entre</span></label>
                  <input ui-date="opts" class="form-control" name="entre" ng-change="CargaBeneficiarios()" ng-model="entre" readonly="" style="position:  relative; top: -5px;"></input>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Fecha Inscripción  <span class="label label-success">Hasta</span></label>
                  <input ui-date="opts" class="form-control" name="hasta" ng-change="CargaBeneficiarios()" ng-model="hasta" readonly="" style="position:  relative; top: -5px;"></input>
                </div>
              </div>
              <div class="clearfix"></div><br>
              <div class="col-md-12">
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Sexo:</label>
                  <select  ng-model="sexo_persona" name="sexo_persona" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione Sexo</option>
                    <option ng-repeat="sex in sexo" value="@{{ sex.id }}">@{{ sex.nombre }}</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Edad  <span class="label label-primary">Entre</span></label>
                  <input  class="form-control" name="entre_edad" ng-change="CargaBeneficiarios()" ng-model="entre_edad"  style="position:  relative; top: -5px;"></input>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Edad  <span class="label label-success">Hasta</span></label>
                  <input  class="form-control" ng-change="CargaBeneficiarios()" name="hasta_edad" ng-model="hasta_edad"  style="position:  relative; top: -5px;"></input>
                </div>
              </div>
              <div class="clearfix"></div><br>       
              <div class="col-md-12">
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Corregimiento:</label>
                  <select  ng-model="corregimiento" name="corregimiento" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione corregimiento</option>
                    <option ng-repeat="corregimiento in corregimientos" value="@{{ corregimiento.id }}">@{{ corregimiento.descripcion }}</option>
                  </select>
                </div>
                <div class="col-md-4" style="position:  relative;top: -6px;left:  34px;">
                  <label for="user_firstname" style="color: black; position:  relative;right:  31px !important;top: 4px;">Barrio:</label>
                  <select chosen class="form-control" name="barrio" ng-change="CargaBeneficiarios()"  id="barrio"  ng-model="barrio" ng-options="bar.id as bar.nombre_barrio for bar in barrios">
                    <option value=''>Seleccione Barrio</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Comuna:</label>
                  <select  ng-model="comuna" name="comuna" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione comuna</option>
                    <option ng-repeat="comuna in comunas" value="@{{ comuna.id }}">@{{ comuna.nombre_comuna }}</option>
                  </select>
                </div>
              </div>
              <div class="clearfix"></div><br>
              <div class="col-md-12">
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Estrato:</label>
                  <select  ng-model="estrato" name="estrato" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione estrato</option>
                    <option ng-repeat="estrato in estratos" value="@{{ estrato.id }}">@{{ estrato.nombre }}</option>
                  </select>
                </div>
              <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Etnia:</label>
                  <select  ng-model="cultura" name="cultura" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione etnia</option>
                    <option ng-repeat="etnia in etnias" value="@{{ etnia.id }}">@{{ etnia.descripcion }}</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="user_firstname" style="color: black;">Discapacidad:</label>
                  <select  ng-model="discapacidad" name="discapacidad" ng-change="CargaBeneficiarios()" class="form-control"  style="width: 280px; position: relative; top: -6px;">
                    <option value="">Seleccione discapacidad</option>
                    <option ng-repeat="discapacidad in discapacidadades" value="@{{ discapacidad.id }}">@{{ discapacidad.descripcion }}</option>
                  </select>
                </div>
              </div>
              <div class="clearfix"></div><br>
              <div class="col-md-12">
                <div class="col-md-4" style="position:  relative;top: -6px;left:  34px;">
                  <label for="user_firstname" style="color: black; position:  relative;right:  31px !important;top: 4px;">Lugar:</label>
                  <select chosen class="form-control" name="lugar" ng-change="CargaBeneficiarios()"  id="lugar"  ng-model="lugar" ng-options="lugar.id as lugar.nombre_lugar for lugar in lugares">
                    <option value=''>Seleccione Lugar</option>
                  </select>
                </div>
                <div class="col-md-4" style="position:  relative;top: -6px;left:  34px;">
                  <label for="user_firstname" style="color: black; position:  relative;right:  31px !important;top: 4px;">Disciplina y/o Actividad:</label>
                  <select chosen class="form-control" name="disciplina" ng-change="CargaBeneficiarios()"  id="disciplina"  ng-model="disciplina" ng-options="disciplina.id as disciplina.nombre_disciplina for disciplina in disciplinas">
                    <option value=''>Seleccione Disciplina y/o Actividad</option>
                  </select>
                </div>
              </div>
              <div class='col-sm-12'>
                  <div class='form-group' style="position:  relative; top: 17px;">
              <div class="table-responsive">
              <div class="portlet-body">
                 <div class="actions">
                  <button type="button" class="btn btn-success" onclick="download()">
                      <i class="fa fa-file-excel-o" aria-hidden="true" ></i> Exportar Excel
                  </button>   

                   
           
              
<div class="myDiv" id="myDiv" style="display: none;">
   <section>
  <div class="donut"></div>
  <h3> Su archivo se esta descargando por favor espere este proceso tardara unos minutos </h3>
</section>

</div>
</div>
              </div>              
              <div class="clearfix"></div>
                <br>
                <table id="example-export" class="table table-hover table-striped table-bordered table-advanced tablesorter" ng-init="getData()">
                  <thead>
                    <th>FORMADOR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>CÓDIGO GRUPO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>LUGAR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>DISCIPLINA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>TIPO DOCUMENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>NO DOCUMENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>No FICHA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>FECHA INSCRIPCIÓN&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>NOMBRES Y APELLIDOS&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>SEXO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>FECHA NACIMIENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>EDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>CORREGIMIENTO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>VEREDA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>BARRIO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>ESTRATO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>COMUNA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>       
                    <th>DIRECCION&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>       
                    <th>TELEFONO&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>       
                    <th>CELULAR&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>       
                    <th>NIVEL ESCOLARIDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>       
                    <th>ESTADO ESCOLARIDAD&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>       
                    <th>ETNIA&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>GRUPO POBLACIONAL&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    <th>DISCAPACIDADES&nbsp;<a ng-click="sort_by('customerName');"><i class="glyphicon glyphicon-sort"></i></a></th>
                  </thead>
                  <tbody>
                    <tr dir-paginate="data in list|orderBy:sortKey:reverse|filter:search|itemsPerPage: pageSize">
                      <td>@{{data.primer_nombre_usuario | uppercase }} @{{data.primer_apellido_usuario | uppercase }} </td>
                      <td>@{{data.nombre_grupo | uppercase }} </td>
                      <td>@{{data.nombre_lugar | uppercase }} </td>
                      <td>@{{data.nombre_disciplina | uppercase }} </td>
                      <td>@{{data.tipo_documento | uppercase }} </td>
                      <td>@{{data.documento | uppercase }} </td>
                      <td>@{{data.no_ficha | uppercase }} </td>
                      <td>@{{data.fecha_inscripcion | uppercase }} </td>
                      <td>@{{data.nombre_primero | uppercase }}  @{{data.apellido_primero | uppercase }}</td>
                      <td>@{{data.sexo | uppercase }} </td>
                      <td>@{{data.fecha_nacimiento | uppercase }} </td>
                      <td>@{{data.edad_persona | uppercase }} </td>
                      <td>@{{data.nombre_corregimiento | uppercase }} </td>
                      <td>@{{data.nombre_vereda | uppercase }} </td>
                      <td>@{{data.nombre_barrio | uppercase }} </td>
                      <td>@{{data.residencia_estrato | uppercase }} </td>
                      <td>@{{data.nombre_comuna | uppercase }} </td>
                      <td>@{{data.residencia_direccion | uppercase }} </td>
                      <td>@{{data.telefono_fijo | uppercase }} </td>
                      <td>@{{data.telefono_movil | uppercase }} </td>
                      <td>@{{data.nivel_escolaridad | uppercase }} </td>
                      <td>@{{data.estado_escolaridad | uppercase }} </td>
                      <td>@{{data.etnia_beneficiario | uppercase }} </td>
                      <td>@{{data.poblacional | uppercase }} </td>
                      <td>@{{data.discapacidades | uppercase }} </td>
                    </tr>
                  </tbody>
                </table>
                <div class="col-md-12" ng-show="filteredItems == 0">
                  <div class="col-md-12">
                    <h4>No se encontraron resultados</h4>
                  </div>
                </div>
                <dir-pagination-controls></dir-pagination-controls>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

