<div ng-controller="LocalizacionInstitucionSedeCtrl">
    <div class="clearfix"></div><br>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.css"/> 

<style type="text/css">
	* {
	font-family: "Open Sans", sans-serif;
	margin: 0;
	padding: 0;
}
.statusbar {
	background-color: #2299ec;
	color: #FFFFFF;
	font-size: 1.5rem;
	text-align: center;
	padding: 20px 5px;
}

.learnMore {
	text-align: center;
	font-size: 1.2rem;
	padding: 20px 0;
}

#container {
    height: 400px;
    min-width: 310px;
    max-width: 800px;
    margin: 0 auto;
}
</style>
  


    <table width="100%" border="1">
  <tbody><tr>
    <td bgcolor="#003F65"><center><font color="#FFFFFF" size="4"><strong>INSTITUCIÓN @{{ serie.nombre_institucion }}</strong></font></center></td>
  </tr>
</tbody></table>
    <div><fusioncharts  id="mychartcontainer" chartid="angularChart" width="100%"  height="500" type="column2d" dataSource="@{{dataSource}}" events="events"></fusioncharts></div>
	<div class="statusbar" style="@{{ colorValue }}">@{{ selectedValue }}</div>
  
<div class="clearfix"></div><br>
<center>
 <table width="60%" border="1" cellspacing="0" cellpadding="2" bordercolor="#fff">
  <tbody><tr>
    <td height="30" bgcolor="#3097f3"><center><strong><font color="#FFFFFF" size="2">SEDE EDUCATVA</font></strong></center></td>
    <td height="30" bgcolor="#3097f3"><center><strong><font color="#FFFFFF" size="2">NÚMERO DE ESTUDIANTES</font></strong></center></td>
  </tr>

  @{{ instituciones_table }}
     <tr ng-repeat="data in instituciones">
    <td width="50%" height="30"><strong><font color="#003F65" size="2">@{{data.label}}</font></strong></td>
    <td width="50%"><center><strong><a ng-href="/admin/postlocalizacion#/admin/postlocalizacion/sede/@{{data.id}}"> @{{ data.value }} </a></strong></center></td>
  </tr>
    <tr>
          <td colspan="1"><strong style="color: #b73131;">TOTAL ESTUDIANTES INSTITUCIÓN</strong></td>
          <td align="center"><strong style="color: #b73131;">@{{total_estudiantes}}</strong></td>
        </tr>
 </tbody></table> </center>
 </div>
 <div class="clearfix"></div><br>
  <div class="form-group">
                    <div class="col-sm-6">
                   
                      <a href="/admin/postlocalizacion#/admin/postlocalizacion" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                    </div>
                  </div>
                </div>
 <div class="clearfix"></div><br>