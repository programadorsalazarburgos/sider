  <div ng-controller="SiderCrtl">

      <style>
      text {
          font: 12px sans-serif;
      }

      svg {
          display: block;
      }

      html,
      body,
      #chart1,
      svg {
          margin: 0px;
          padding: 0px;
          height: 100%;
          width: 100%;
      }
      </style>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.css" />

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
              content: "";
              margin: 0 auto;
              /* this centers the line to the full width specified */
              position: absolute;
              /* positioning must be absolute here, and relative positioning must be applied to the parent */
              top: 50%;
              left: 0;
              right: 0;
              bottom: 0;
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
          margin: 0 auto;
          /* this centers the line to the full width specified */
          position: absolute;
          top: 45%;
          left: 0;
          right: 0;
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

              &:before,
              &:after {
                  content: '';
                  display: block;
                  width: 1000px;
                  position: absolute;
                  top: 0.73em;
                  border-top: 1px solid red;
              }

              &:before {
                  right: 100%;
              }

              &:after {
                  left: 100%;
              }
          }
      }

      h3.no-span {

          &:before,
          &:after {
              border-top: 1px solid green;
              content: '';
              display: table-cell;
              position: relative;
              top: 0.5em;
              width: 45%;

          }

          &:before {
              right: 1.5%;
          }

          &:after {
              left: 1.5%;
          }
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

      <style type="text/css">
      #chartdiv {
          width: 100%;
          height: 500px;
      }

      #chartcomuna {
          width: 100%;
          height: 500px;
      }


      #chartdivmonitores {
          width: 100%;
          height: 500px;
          font-size: 11px;
      }

      .amcharts-pie-slice {
          transform: scale(1);
          transform-origin: 50% 50%;
          transition-duration: 0.3s;
          transition: all .3s ease-out;
          -webkit-transition: all .3s ease-out;
          -moz-transition: all .3s ease-out;
          -o-transition: all .3s ease-out;
          cursor: pointer;
          box-shadow: 0 0 30px 0 #000;
      }

      .amcharts-pie-slice:hover {
          transform: scale(1.1);
          filter: url(#shadow);
      }

      #chartdivusuarios {
          width: 100%;
          height: 500px;
      }
      </style>
      <div class="container">
          <div class="row">
              <div id="card-stats">
                  <div class="row">
                      <div class="col s12 m6 l3" style=" width: 252px;  height: 92px;">
                          <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
                              <div class="padding-4">
                                  <div class="col s7 m7">
                                      <i class="material-icons background-round mt-5"><span
                                              class="fas fa-users"></span></i>
                                      <p>Beneficiarios</p>
                                  </div>
                                  <div class="col s5 m5 left-align">
                                      <h3 style="font-size: 21px;position: relative;left: -29px; top: -11px;"
                                          class="mb-0">@{{totalbeneficiarios}}</h3>
                                  </div>
                              </div>
                              <div class="revinue-content">
                                  <div id="hybrid_followers"></div>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l3" style=" width: 252px;  height: 92px;">
                          <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text">
                              <div class="padding-4">
                                  <div class="col s7 m7">
                                      <i class="material-icons background-round mt-5">directions_bike</i>
                                      <p>Disciplinas-Actividades</p>
                                  </div>
                                  <div class="col s5 m5 left-align">
                                      <h5 style="font-size: 21px;position: relative;left: -14px;" class="mb-0">
                                          @{{totaldisciplinas}}/72</h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l3" style=" width: 252px;  height: 92px;">
                          <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text">
                              <div class="padding-4">
                                  <div class="col s7 m7">
                                      <i class="material-icons background-round mt-5">account_balance</i>
                                      <p>Inst.Educativas-Sedes</p>
                                  </div>
                                  <div class="col s5 m5 left-align">
                                      <h5 style="font-size: 21px;position: relative;left: -14px;" class="mb-0">
                                          @{{totalcolegios}}/@{{totalsedes}}</h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col s12 m6 l3" style=" width: 253px;  height: 92px;">
                          <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
                              <div class="padding-4">
                                  <div class="col s7 m7">
                                      <i class="material-icons background-round mt-5">toys</i>
                                      <p>Escenarios-Sitios de Atención</p>
                                  </div>
                                  <div class="col s5 m5 left-align">
                                      <h3 style="font-size: 14px;position: relative;left: -29px; top: -11px;"
                                          class="mb-0">@{{totalescenarios}}</h3>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="clearfix"></div><br>
              <!-- <div deckgrid class="deckgrid contenedor" source="programas">
    <div class="contenedor-cards">
        <div class="contenedor-card-item" >
            <div class="a-card contenedor-card-item-wrapper">
                <a ng-href="#/descripcion/@{{card.id}}">
                    <img src="" data-ng-src="@{{card.image}}">
                </a>
                <h5></h5>
                <div class="contenedor-info">
                    <div class="info">
                        <p class="titulo">Programas</p>
		                    <span class="categoria">Categoría</span>
                    </div>
                    <div class="fondo"></div>
                </div>
              </div>
          </div>
     </div>
</div> -->
              <div deckgrid class="deckgrid" source="programas">
                  <div class="a-card">
                      <a ng-href="#/descripcion/@{{card.id}}">
                          <img src="" data-ng-src="@{{card.image}}">
                      </a>
                      <h5></h5>
                  </div>
              </div>
              <div class="divider"></div>
              <div class="clearfix"></div><br>
              <div class="clearfix"></div><br>
              <div class="clearfix"></div><br>
          </div>
      </div>
      <div class="page-content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                      <div class="portlet box">
                          <div class="portlet-header">
                              <h5 style="text-align:center"><strong>TOTAL DE BENEFICIARIOS POR PROGRAMA</strong></h5>
                              <div class="clearfix"></div><br>
                              <div id="chartdiv">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- 
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet box">
                <div class="portlet-header">
                <h5 style="text-align:center"><strong>TOTAL DE BENEFICIARIOS POR PROGRAMA</strong></h5>
<div id="chartdiv">
  
</div>     
<h5 style="text-align:center">Nombre del Programa</h5>
</div>
</div>
</div>
 -->
      <!-- 
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet box">
                <div class="portlet-header">
                <h5 style="text-align:center"><strong>TOTAL DE BENEFICIARIOS POR COMUNA</strong></h5>
<div id="chartcomuna">
  
</div>     
<h5 style="text-align:center">Nombre Comuna</h5>
</div>
</div>
</div>



<div class='row'>
  <div class="col-md-6">
    <label class="control-label" for="empleado-tipo_doc">Programa</label>
    <select class="form-control" name="programa" id="programa" required ng-change="MetasPrograma()" ng-model="programa.unit" ng-options="unit.id as unit.nombre_programa for unit in programas">
      <option value=''>Selecciona Programa</option>
    </select>
  </div>
  <div class="col-md-6">
    <label class="control-label" for="empleado-documento">Metas Programa</label>
        <select name="meta" ng-model="meta" class="form-control" required ng-change='selectedMeta(meta)'>
            <option value="">Seleccione Meta</option>
            <option ng-repeat="meta in metasprogramas" value="@{{ meta.id }}">@{{ meta.nombre_meta }} @{{ meta.periodo }}</option>
        </select>
  </div>
</div>
<div class="bloque" style="text-align:center;" ng-show="graficoindicadores">
  <h3 class="no-span">ALCANCE META @{{ nombre_meta | uppercase }} @{{metaalcance | number : 0}} </h3>
    <div id="chart1" style="height: 500px;">
        <svg></svg>
    </div>
    <div class="clearfix"></div><br>
    <center>
      <table width="60%" border="1" cellspacing="0" cellpadding="2" bordercolor="#fff" style="border-color:  beige;">
        <tbody>
            <tr>
              <td height="20" bgcolor="#3097f3"><center><strong><font color="#FFFFFF" size="2">MES AVANCE</font></strong></center></td>
              <td height="20" bgcolor="#3097f3"><center><strong><font color="#FFFFFF" size="2">AVANCE</font></strong></center></td>
              <td height="50" bgcolor="#3097f3"><center><strong><font color="#FFFFFF" size="2">PORCENTAJE</font></strong></center></td>
            </tr>
            <tr ng-repeat="data in indicadoremetas">
              <td width="50%" height="30"><strong><font color="#003F65" size="2">@{{data.label | uppercase}}</font></strong></td>
              <td width="40%"><center><strong>@{{ data.value | number : 0 }} </a></strong></center></td>
              <td width="60%"><center><strong>@{{ data.porcentaje | number : 0 }} %</strong></center></td>
            </tr>     
          </tbody>
        </table>
      </center>
      </div>
    </div>
  </div> -->
  </div>