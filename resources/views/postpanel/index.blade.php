
@extends('angular.frontend.master')
@section('title', 'Panel de control')
@section('content')
<script type="text/javascript" src="{{url('js/highcharts.js')}}"></script>
<script type="text/javascript" src="{{url('js/export-data.js')}}"></script>
<script type="text/javascript" src="{{url('js/exporting.js')}}"></script>
<script type="text/javascript" src="{{url('js/offline-exporting.js')}}"></script>

<script type="text/javascript" src="{{url('js/panel.control.js')}}?v=<?= date('YmdHis');?>"></script>

<link rel="stylesheet" type="text/css" href="{{url('css/panel.control.css')}}">
<div class="container-fluid">
	<div class="col-md-12">
		<ul id="tableactiondTab" class="nav nav-tabs">
			<li class="active">
				<a href="#table-table-tab" data-toggle="tab">Panel de control</a>
            </li>
        </ul>
        <div id="tableactionTabContent" class="tab-content">
            <div class="container-fluid">
            	<div class="container-fluid">
            	<div class="panel">
            		<div class="panel-body">
						<div class="row">
							<div class="col-md-2">
								<a href="javascript:graf(1)"><img src="{{url('/graficos/creciente.png')}}"></a> <br>
								<label class="title-icon">Crecimiento Anual</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(2)"><img src="{{url('/graficos/trazar.png')}}" alt=""></a> <br>
								<label class="title-icon">Crecimiento Mensual</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(3)"><img src="{{url('/graficos/vector.png')}}"></a> <br>
								<label class="title-icon">Beneficiarios por Genero</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(4)"><img src="{{url('/graficos/comuna.png')}}"></a> <br>
								<label class="title-icon">Beneficiarios por Comuna</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(1)"><img src="{{url('/graficos/programa.png')}}"></a> <br>
								<label class="title-icon">Beneficiario por Programa</label>
							</div>
						</div>
<!-- 						<div class="row">
							<div class="col-md-2">
								<a href="javascript:graf(6)"><img src="{{url('/data_icons/cobertura.png')}}"></a> <br>
								<label class="title-icon"> Cobertura por comuna de impacto</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(7)"><img src="{{url('/data_icons/disciplinas.png')}}"></a> <br>
								<label class="title-icon">Cobertura por disciplina</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(8)"><img src="{{url('/data_icons/etnicos.png')}}"></a> <br>
								<label class="title-icon">Etnias</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(9)"><img src="{{url('/data_icons/discapacidad.png')}}"></a> <br>
								<label class="title-icon">Discapacidad</label>
							</div>
							<div class="col-md-2">
								<a href="javascript:graf(10)"><img src="{{url('/data_icons/residencia.png')}}"></a> <br>
								<label class="title-icon">Corregimiento de residencia</label>
							</div>
						</div>
 -->            		</div>
            	</div>
            </div>
			<!--MODAL-->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#039be3;color:#FFF">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >



<div class="container-fluid" style="display: none" id="contendor1">
	<div class="row">
		<div class="col-md-12">
			<div class="row">

				<div class="col-md-6">
				<select class="form form-control" id="anualidad" onchange="graficar_data1();">
					<option value="2018">2018</option>
					<option value="2019">2019</option>				
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
				</select>
				</div>
				<div class="col-md-6">

<select class="form form-control" id="tipo_grafico" onchange="graficar_data1();">
					<option value="line">Lineas</option>
					<option value="pie">Torta</option>				
					<option value="spline">puntos</option>
					<option value="column">Columnas</option>
					<option value="bar">Barras</option>
					<option value="semi_pie">Torta</option>
				</select>

				</div>
			</div>
		</div>
	</div>
</div>



<div class="container-fluid" style="display: none" id="contendor2">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
									<select class="form form-control" id="anualidad2" onchange="graficar_data2();">
					<option value="2018">2018</option>
					<option value="2019">2019</option>				
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
				</select>

				</div>
				<div class="col-md-4">
									<select class="form form-control" id="mes" onchange="graficar_data2();">
					<option value="01">Enero</option>
					<option value="02">Febrero</option>				
					<option value="03">Marzo</option>
					<option value="04">Abril</option>
					<option value="05">Mayo</option>
					<option value="06">Junio</option>
					<option value="07">Julio</option>
					<option value="08">Agosto</option>
					<option value="09">Septiembre</option>
					<option value="10">Octubre</option>
					<option value="11">Noviembre</option>
					<option value="12">Diciembre</option>
				</select>

				</div>
				<div class="col-md-4">
					<select class="form form-control" id="tipo_grafico" onchange="graficar_data2();">
					<option value="line">Lineas</option>
					<option value="pie">Torta</option>				
					<option value="spline">puntos</option>
					<option value="column">Columnas</option>
					<option value="bar">Barras</option>
					<option value="semi_pie">Torta</option>
				</select>

				</div>
			</div>
		</div>
	</div>
</div>


<div class="container-fluid" id="contendor3" style="display: none">
	<div class="row">
		<div class="col-md-12">
			<select class="form form-control" id="tipo_grafico4" onchange="graficar_data4();">
					<option value="line">Lineas</option>
					<option value="pie">Torta</option>				
					<option value="spline">puntos</option>
					<option value="column">Columnas</option>
					<option value="bar">Barras</option>
					<option value="semi_pie">Torta</option>
				</select>
		</div>
	</div>
</div>


	  <div class="container-fluid">
			
			<div class="col-md-12">
				<div id="container_grafico">
					Cargando
					<img src="{{url('/images/loading.gif')}}" alt="">
				</div>
			</div>
	  	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--MODAL-->
            </div>
        </div>
    </div>
</div>
<style>
.col-md-2{
    text-align: center;
}


.modal-dialog {
  width: 98%;
  height: 92%;
  min-height: 92%;
  padding: 0;
}

.modal-content {
  height: 99%;
}
.modal-body{
  height: 80%;
}
</style>
@stop