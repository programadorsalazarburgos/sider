<div ng-controller="GraficoIndicadorCtrl">
    <div class="clearfix"></div><br>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.css"/> 

<style type="text/css">
	* {
	font-family: "Open Sans", sans-serif;
	margin: 0;
	padding: 0;
}
.statusbar {
	background-color: #bf4346;
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

/**
 * Horizontal Type Line Behind Text
 * Inspired by this discussion @ CSS-Tricks: https://css-tricks.com/forums/topic/css-trick-for-a-horizontal-type-line-behind-text/#post-151970
 * Available on jsFiddle: http://jsfiddle.net/ericrasch/jAXXA/
 * Available on Dabblet: http://dabblet.com/gist/2045198
 * Available on GitHub Gist: https://gist.github.com/2045198
 */

 h2 {
  font: 33px sans-serif;
  margin-top: 30px;
  text-align: center;
  text-transform: uppercase;
}

h2.background {
  position: relative;
  z-index: 1;
  
  &:before {
      border-top: 2px solid #dfdfdf;
      content:"";
      margin: 0 auto; /* this centers the line to the full width specified */
      position: absolute; /* positioning must be absolute here, and relative positioning must be applied to the parent */
      top: 50%; left: 0; right: 0; bottom: 0;
      width: 95%;
      z-index: -1;
  }

  span { 
      /* to hide the lines from behind the text, you have to set the background color the same as the container */ 
      background: #fff; 
      padding: 0 15px; 
  }
}

h2.double:before { 
  /* this is just to undo the :before styling from above */
  border-top: none; 
}

h2.double:after {
  border-bottom: 1px solid blue;
  -webkit-box-shadow: 0 1px 0 0 red;
  -moz-box-shadow: 0 1px 0 0 red;
  box-shadow: 0 1px 0 0 red;
  content: "";
  margin: 0 auto; /* this centers the line to the full width specified */
  position: absolute;
  top: 45%; left: 0; right: 0;
  width: 95%;
  z-index: -1;
}

h2.no-background {
  position: relative;
  overflow: hidden;
  
  span {
      display: inline-block;
      vertical-align: baseline;
      zoom: 1;
      *display: inline;
      *vertical-align: auto;
      position: relative;
      padding: 0 20px;

      &:before, &:after {
          content: '';
          display: block;
          width: 1000px;
          position: absolute;
          top: 0.73em;
          border-top: 1px solid red;
      }

      &:before { right: 100%; }
      &:after { left: 100%; }
  }
}

h3.no-span {

  &:before, &:after {
    border-top: 1px solid green;
    content: '';
    display: table-cell;
    position: relative;
    top: 0.5em;
    width: 45%;

  }
  &:before { right: 1.5%; }
  &:after { left: 1.5%; }
}

.bloque {

  overflow: hidden;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  /* user-select: none; */
  cursor: default;
  position: relative;
  left: -0.5px;
  top: 1.985px;
  background-color: rgb(255, 255, 255);

}
</style>
  

<!-- <h4>Intituciones Segun Comuna 1</h4> -->
<!-- <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto">
	
	<nvd3 options="options" data="data"></nvd3>

</div>
 -->
 <div class="bloque" style="text-align:center;">
    <h3 class="no-span">ALCANCE META @{{ nombre_meta | uppercase }} @{{metaalcance | number : 0}} </h3>
 </div>
  <input   type="text" value="@{{metaalcance}}" ng-model="metaalcance" id="ficha_distrito_militar" class="form-control"  style="display:none">
    <div><fusioncharts  id="mychartcontainer" chartid="angularChart" width="100%"  height="500" type="column2d" dataSource="@{{dataSource}}" events="events"></fusioncharts></div>
	<div class="statusbar" style="@{{ colorValue }}">@{{ selectedValue }}</div>
  
<div class="clearfix"></div><br>
<center>
 <table width="60%" border="1" cellspacing="0" cellpadding="2" bordercolor="#fff">
  <tbody><tr>
    <td height="30" bgcolor="#3097f3"><center><strong><font color="#FFFFFF" size="2">MES AVANCE</font></strong></center></td>
    <td height="30" bgcolor="#3097f3"><center><strong><font color="#FFFFFF" size="2">AVANCE</font></strong></center></td>
  </tr>
     <tr ng-repeat="data in indicadoremetas">
    <td width="50%" height="30"><strong><font color="#003F65" size="2">@{{data.label | uppercase}}</font></strong></td>
    <td width="50%"><center><strong> @{{ data.value | number : 0 }}</strong></center></td>
  </tr>
  
 </tbody></table> </center>
 </div>
 <div class="clearfix"></div><br>
  <div class="form-group">
                    <div class="col-sm-6">
                   
                      <a href="/admin/postindicadores#/admin/postindicadores" type="submit" class="btn btn-orange"><i class="fa fa-reply-all"></i>&nbsp;&nbsp;Atras</a>
                    </div>
                  </div>
                </div>
 <div class="clearfix"></div><br>