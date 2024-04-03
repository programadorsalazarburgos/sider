var tipo=0;
function render(container,data_object,title,type_render)
	{
		$('#exampleModalLabel').html(title);
		var xAxis=[];
		if(
			type_render=='pie'
			||
			type_render=='semi_pie'
		)
		{
			var datatemp=[];
			$.each(data_object,function(index,value)
			{
				xAxis.push(value.name);
				datatemp.push({
					name:value.name,
					y:value.data[0]
				});
			});
			var temp=[{
				name: 'Valor',
				colorByPoint: true,
				data:datatemp,
			}];
			if(type_render=="semi_pie")
			{
				type_render='pie';
				temp.push({
					type:'pie',
					innerSize : '50%'
				});
			}
			data_object=temp;
		}
		else if(
			type_render=='line'
			||
			type_render=='spline'
		)
		{
			var datatemp=[];
			$.each(data_object,function(index,value)
			{
				xAxis.push(value.name);
				datatemp.push(value.data[0]);
			});
			var temp=[{
				name: title,
				data:datatemp,
			}];
			data_object=temp
		}
		else{
			xAxis=[title];
		}
		Highcharts.chart(container,
		{
			exporting: {
				chartOptions: { // specific options for the exported image
					plotOptions: {
						series: {
							dataLabels: {
								enabled: true
							}
						}
					}
				},
				fallbackToExportServer: false
			},
		    chart: {
		        type: type_render,
			},
			credits: {
				enabled: false
			},
			xAxis: {
				categories: xAxis
			},
		    title: {
		        text: title
			},
			
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b>: {point.percentage:.1f} %',
						style: {
							color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
						}
					}
				}
			},
		    series:data_object,
			tooltip: 
			{
				formatter: function() 
				{
					var nStr=this.point.y;
					nStr += '';
					x = nStr.split('.');
					x1 = x[0];
					x2 = x.length > 1 ? '.' + x[1] : '';
					var rgx = /(\d+)(\d{3})/;
					while (rgx.test(x1)) {
						x1 = x1.replace(rgx, '$1' + ',' + '$2');
					}
					var y = x1 + x2;
			   		return this.series.name +  ': <b>' + y + '</b>';
           		}
    		}
		});
	} 
	function search()
	{
		$('#search').click(function(){filtrar()});
	}
	function export_pdf()
	{
		$('#exportar').hide();
		$('#exportar').click(function()
		{
			//html2canvas(document.querySelector("informes")).then(canvas => {document.body.appendChild(canvas)});
		});
	}
	function graficar_data1()
	{

		var anualidad = $('#anualidad').val();
		$('#tipo_grafico').hide();
		$('#exampleModalLabel').html('');
		$('#container_grafico').html('<center><h3>Cargando </h3><br/><img src="'+base+'/images/loading.gif" style="width:100px !important"></center>');
		$('#exampleModal1').modal('show');
		$( "#contendor1" ).show();

		$.ajax({
			url:base+'/panelcontrol/datos?data=' + anualidad,
			dataType:'json',
			success:function(data)
			{
				//$('#TotalBeneficiarios').html(data.TotalBeneficiarios);
				$("container_grafico").html('');
				switch(tipo)
				{

					case 1://Nivel de escolaridad
						render('container_grafico',data.anualidad,'Nivel de escolaridad',$('#tipo_grafico').val())
					break;
				}
				$('#tipo_grafico').show();
			},
			error:function(data)
			{
				$('#search').show();
			}
		});
	}

	function graficar_data2()
	{


		var anualidad2 = $('#anualidad2').val();
		var mes = $('#mes').val();
		$('#tipo_grafico').hide();
		$('#exampleModalLabel').html('');
		$('#container_grafico').html('<center><h3>Cargando </h3><br/><img src="'+base+'/images/loading.gif" style="width:100px !important"></center>');
		$('#exampleModal1').modal('show');
		$( "#contendor2" ).show();
		$( "#contendor1" ).hide();

		$.ajax({
			url:base+'/panelcontrol2/datos?data=' + anualidad2 + '&mes='+ mes,
			dataType:'json',
			success:function(data)
			{
				//$('#TotalBeneficiarios').html(data.TotalBeneficiarios);
				$("container_grafico").html('');
				switch(tipo)
				{

					case 2://Nivel de escolaridad
						render('container_grafico',data.anualidad2,'Nivel de escolaridad',$('#tipo_grafico').val())
					break;
				}
				$('#tipo_grafico').show();
			},
			error:function(data)
			{
				$('#search').show();
			}
		});
	}
	

function graficar_data3()
	{


		var anualidad2 = $('#anualidad2').val();
		var mes = $('#mes').val();
		$('#tipo_grafico').hide();
		$('#exampleModalLabel').html('');
		$('#container_grafico').html('<center><h3>Cargando </h3><br/><img src="'+base+'/images/loading.gif" style="width:100px !important"></center>');
		$('#exampleModal1').modal('show');
		$( "#contendor2" ).hide();
		$( "#contendor1" ).hide();

		$.ajax({
			url:base+'/panelcontrol3/datos',
			dataType:'json',
			success:function(data)
			{
				//$('#TotalBeneficiarios').html(data.TotalBeneficiarios);
				$("container_grafico").html('');
				switch(tipo)
				{

					case 3://Nivel de escolaridad
						render('container_grafico',data.genero,'Genero',$('#tipo_grafico').val())
					break;
				}
				$('#tipo_grafico').show();
			},
			error:function(data)
			{
				$('#search').show();
			}
		});
	}
	


function graficar_data4()
	{


		$('#tipo_grafico4').hide();
		$('#exampleModalLabel').html('');
		$('#container_grafico').html('<center><h3>Cargando </h3><br/><img src="'+base+'/images/loading.gif" style="width:100px !important"></center>');
		$('#exampleModal1').modal('show');
		$( "#contendor2" ).hide();
		$( "#contendor1" ).hide();
		$( "#contendor3" ).show();

		$.ajax({
			url:base+'/panelcontrol4/datos',
			dataType:'json',
			success:function(data)
			{
				//$('#TotalBeneficiarios').html(data.TotalBeneficiarios);
				$("container_grafico").html('');
				switch(tipo)
				{

					case 4://Nivel de escolaridad
						render('container_grafico',data.comuna,'Comuna',$('#tipo_grafico4').val())
					break;
				}
				$('#tipo_grafico4').show();
			},
			error:function(data)
			{
				$('#search').show();
			}
		});
	}
	


	function graf(thetipo)
	{

		if (thetipo == 1)
		 {
		tipo=thetipo;
		graficar_data1();		 	
		 }

		 if(thetipo == 2)
		 {
		tipo=thetipo;
		graficar_data2();		 	
		 }

		 if(thetipo == 3)
		 {
		tipo=thetipo;
		graficar_data3();		 	
		 }


		 if(thetipo == 4)
		 {
		tipo=thetipo;
		graficar_data4();		 	
		 }

	}
	
