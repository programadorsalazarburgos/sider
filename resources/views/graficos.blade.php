@extends('angular.frontend.master')
@section('title', 'Inicio')
@section('content')
<!--   <div id="chartdiv31"></div>
--><div class="container" >
  <style>
  #chartdiv {
  width: 100%;
  height: 500px;
  }
  #chartdiv1 {
  width: 100%;
  height: 500px;
  }
  #chartdiv3 {
  width: 100%;
  height: 500px;
  }
  </style>
  <style>
  #chartdiv {
  width: 100%;
  height: 500px;
  }
  #chartdiv33 {
  width: 100%;
  height: 500px;
  }
  </style>
  <style>
    /* ------- DO NOT EDIT BELOW --------- */
  @import url(https://fonts.googleapis.com/css?family=Abel);
  .chart-one {
  width: 200px;
  height: 200px;
  margin: 0;
  position: relative;
  }
  .chart-one.animate svg .circle-foreground {
  -webkit-animation: offset 3s ease-in-out forwards;
  animation: offset 3s ease-in-out forwards;
  -webkit-animation-delay: 1s;
  animation-delay: 1s;
  }
  .chart-one.animate figcaption:after {
  -webkit-animation: chart-one-label 3s steps(32) forwards;
  animation: chart-one-label 3s steps(32) forwards;
  -webkit-animation-delay: 1s;
  animation-delay: 1s;
  }
  .chart-one svg {
  width: 100%;
  height: 100%;
  }
  .chart-one svg .circle-background, .chart-one svg .circle-foreground {
  r: 99.5px;
  cx: 50%;
  cy: 50%;
  fill: none;
  stroke: #305556;
  stroke-width: 1px;
  }
  .chart-one svg .circle-foreground {
  stroke: #79be9b;
  stroke-dasharray: 199.9552px 624.86px;
  stroke-dashoffset: 199.9552px;
  stroke-linecap: round;
  -webkit-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
  -webkit-transform: rotate(-90deg);
  transform: rotate(-90deg);
  }
  .chart-one figcaption {
  display: inline-block;
  width: 100%;
  height: 2.5rem;
  overflow: hidden;
  text-align: center;
  color: #c6e8d7;
  position: absolute;
  top: calc(50% - 1.25rem);
  left: 0;
  font-size: 0;
  }
  .chart-one figcaption:after {
  display: inline-block;
  content: "0%\a 1%\a 2%\a 3%\a 4%\a 5%\a 6%\a 7%\a 8%\a 9%\a 10%\a 11%\a 12%\a 13%\a 14%\a 15%\a 16%\a 17%\a 18%\a 19%\a 20%\a 21%\a 22%\a 23%\a 24%\a 25%\a 26%\a 27%\a 28%\a 29%\a 30%\a 31%\a 32%\a 33%\a 34%\a 35%\a 36%\a 37%\a 38%\a 39%\a 40%\a 41%\a 42%\a 43%\a 44%\a 45%\a 46%\a 47%\a 48%\a 49%\a 50%\a 51%\a 52%\a 53%\a 54%\a 55%\a 56%\a 57%\a 58%\a 59%\a 60%\a 61%\a 62%\a 63%\a 64%\a 65%\a 66%\a 67%\a 68%\a 69%\a 70%\a 71%\a 72%\a 73%\a 74%\a 75%\a 76%\a 77%\a 78%\a 79%\a 80%\a 81%\a 82%\a 83%\a 84%\a 85%\a 86%\a 87%\a 88%\a 89%\a 90%\a 91%\a 92%\a 93%\a 94%\a 95%\a 96%\a 97%\a 98%\a 99%\a 100%\a";
  white-space: pre;
  font-size: 2.5rem;
  line-height: 2.5rem;
  }
  @-webkit-keyframes chart-one-label {
  100% {
  -webkit-transform: translateY(-80rem);
  transform: translateY(-80rem);
  }
  }
  @keyframes chart-one-label {
  100% {
  -webkit-transform: translateY(-80rem);
  transform: translateY(-80rem);
  }
  }
  .chart-two {
  width: 200px;
  height: 200px;
  margin: 0;
  position: relative;
  }
  .chart-two.animate svg .circle-foreground {
  -webkit-animation: offset 3s ease-in-out forwards;
  animation: offset 3s ease-in-out forwards;
  -webkit-animation-delay: 1s;
  animation-delay: 1s;
  }
  .chart-two.animate figcaption:after {
  -webkit-animation: chart-two-label 3s steps(50) forwards;
  animation: chart-two-label 3s steps(50) forwards;
  -webkit-animation-delay: 1s;
  animation-delay: 1s;
  }
  .chart-two svg {
  width: 100%;
  height: 100%;
  }
  .chart-two svg .circle-background, .chart-two svg .circle-foreground {
  r: 92.5px;
  cx: 50%;
  cy: 50%;
  fill: none;
  stroke: #305556;
  stroke-width: 15px;
  }
  .chart-two svg .circle-foreground {
  stroke: #d0f09e;
  stroke-dasharray: 290.45px 580.9px;
  stroke-dashoffset: 290.45px;
  stroke-linecap: round;
  -webkit-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
  -webkit-transform: rotate(-90deg);
  transform: rotate(-90deg);
  }
  .chart-two figcaption {
  display: inline-block;
  width: 100%;
  height: 2.5rem;
  overflow: hidden;
  text-align: center;
  color: #c6e8d7;
  position: absolute;
  top: calc(50% - 1.25rem);
  left: 0;
  font-size: 0;
  }
  .chart-two figcaption:after {
  display: inline-block;
  content: "0%\a 1%\a 2%\a 3%\a 4%\a 5%\a 6%\a 7%\a 8%\a 9%\a 10%\a 11%\a 12%\a 13%\a 14%\a 15%\a 16%\a 17%\a 18%\a 19%\a 20%\a 21%\a 22%\a 23%\a 24%\a 25%\a 26%\a 27%\a 28%\a 29%\a 30%\a 31%\a 32%\a 33%\a 34%\a 35%\a 36%\a 37%\a 38%\a 39%\a 40%\a 41%\a 42%\a 43%\a 44%\a 45%\a 46%\a 47%\a 48%\a 49%\a 50%\a 51%\a 52%\a 53%\a 54%\a 55%\a 56%\a 57%\a 58%\a 59%\a 60%\a 61%\a 62%\a 63%\a 64%\a 65%\a 66%\a 67%\a 68%\a 69%\a 70%\a 71%\a 72%\a 73%\a 74%\a 75%\a 76%\a 77%\a 78%\a 79%\a 80%\a 81%\a 82%\a 83%\a 84%\a 85%\a 86%\a 87%\a 88%\a 89%\a 90%\a 91%\a 92%\a 93%\a 94%\a 95%\a 96%\a 97%\a 98%\a 99%\a 100%\a";
  white-space: pre;
  font-size: 2.5rem;
  line-height: 2.5rem;
  }
  @-webkit-keyframes chart-two-label {
  100% {
  -webkit-transform: translateY(-125rem);
  transform: translateY(-125rem);
  }
  }
  @keyframes chart-two-label {
  100% {
  -webkit-transform: translateY(-125rem);
  transform: translateY(-125rem);
  }
  }
  .chart-three {
  width: 200px;
  height: 200px;
  margin: 0;
  position: relative;
  }
  .chart-three.animate svg .circle-foreground {
  -webkit-animation: offset 3s ease-in-out forwards;
  animation: offset 3s ease-in-out forwards;
  -webkit-animation-delay: 1s;
  animation-delay: 1s;
  }
  .chart-three.animate figcaption:after {
  -webkit-animation: chart-three-label 3s steps(75) forwards;
  animation: chart-three-label 3s steps(75) forwards;
  -webkit-animation-delay: 1s;
  animation-delay: 1s;
  }
  .chart-three svg {
  width: 100%;
  height: 100%;
  }
  .chart-three svg .circle-background, .chart-three svg .circle-foreground {
  r: 87.5px;
  cx: 50%;
  cy: 50%;
  fill: none;
  stroke: #305556;
  stroke-width: 25px;
  }
  .chart-three svg .circle-foreground {
  stroke: #389967;
  stroke-dasharray: 412.125px 549.5px;
  stroke-dashoffset: 412.125px;
  stroke-linecap: round;
  -webkit-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
  -webkit-transform: rotate(-90deg);
  transform: rotate(-90deg);
  }
  .chart-three figcaption {
  display: inline-block;
  width: 100%;
  height: 2.5rem;
  overflow: hidden;
  text-align: center;
  color: #c6e8d7;
  position: absolute;
  top: calc(50% - 1.25rem);
  left: 0;
  font-size: 0;
  }
  .chart-three figcaption:after {
  display: inline-block;
  content: "0%\a 1%\a 2%\a 3%\a 4%\a 5%\a 6%\a 7%\a 8%\a 9%\a 10%\a 11%\a 12%\a 13%\a 14%\a 15%\a 16%\a 17%\a 18%\a 19%\a 20%\a 21%\a 22%\a 23%\a 24%\a 25%\a 26%\a 27%\a 28%\a 29%\a 30%\a 31%\a 32%\a 33%\a 34%\a 35%\a 36%\a 37%\a 38%\a 39%\a 40%\a 41%\a 42%\a 43%\a 44%\a 45%\a 46%\a 47%\a 48%\a 49%\a 50%\a 51%\a 52%\a 53%\a 54%\a 55%\a 56%\a 57%\a 58%\a 59%\a 60%\a 61%\a 62%\a 63%\a 64%\a 65%\a 66%\a 67%\a 68%\a 69%\a 70%\a 71%\a 72%\a 73%\a 74%\a 75%\a 76%\a 77%\a 78%\a 79%\a 80%\a 81%\a 82%\a 83%\a 84%\a 85%\a 86%\a 87%\a 88%\a 89%\a 90%\a 91%\a 92%\a 93%\a 94%\a 95%\a 96%\a 97%\a 98%\a 99%\a 100%\a";
  white-space: pre;
  font-size: 2.5rem;
  line-height: 2.5rem;
  }
  @-webkit-keyframes chart-three-label {
  100% {
  -webkit-transform: translateY(-187.5rem);
  transform: translateY(-187.5rem);
  }
  }
  @keyframes chart-three-label {
  100% {
  -webkit-transform: translateY(-187.5rem);
  transform: translateY(-187.5rem);
  }
  }
  @-webkit-keyframes offset {
  100% {
  stroke-dashoffset: 0;
  }
  }
  @keyframes offset {
  100% {
  stroke-dashoffset: 0;
  }
  }
  </style>
  
  <style>
    .canvas {
      margin-top: 1em;
      text-align: center;
    }
    .circle {
      display: inline-block;
      margin: 1em;
    }
    .circles-decimals {
      font-size: .4em;
    }
    .buttons {
      margin-top: 1em;
    }
    button {
      font-size: .8em;
      padding: .3em .8em;
    }
  #chartdiv2 {
  width: 100%;
  height: 500px;
  }
  </style>
  <!--
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-6">
                      <label for="">Población Atendida</label>
                      <div id="chartdiv33" style="position: relative;height: 225px;"></div>
                  </div>
                  <div class="col-md-6">
                      <label for="">Disicplinas</label>
                      <canvas id="myChart" style="max-width: 500px;"></canvas>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <hr> -->
  <br><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <label for="">Población Atendida</label>
        <div id="chartdiv33" style="position: relative;height: 225px;"></div>
      </div>
    </div>
  </div>
  <br><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12" style="
        position: relative;
        left: 200px;
        ">
        <label for="">Disicplinas</label>
        <canvas id="myChart" style="max-width: 500px;"></canvas>
      </div>
    </div>
  </div>
  <br><br><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <label for="">Población por Género</label>
            <div class="canvas">
              
              
              
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="">Masculino</label>
                        <div class="circle" id="circles-1"></div>
                      </div>
                      <div class="col-md-6">
                        <label for="">Femenino</label>
                        <div class="circle" id="circles-2"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <label for="">Grupo Etareo</label>
            <div id="chartdiv2"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br><br>
  <br><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <label for="">Evolución de Evaluación Psicosocial</label>
          <br>
          <h5 style="color: #0000CC;">Línea Azul: Trabajo en Equipo</h5>
          
          <h5 style="color: red;">Línea Roja: Liderazgo</h5>
        <div id="chartdiv31" style="position: relative;height: 350px;"></div>
      </div>
    </div>
  </div>

<br><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <label for="">Evolución de Evaluación Técnica Deportiva</label>
          <br>
          <h5 style="color: #0000CC;">Línea Azul: Velocidad</h5>
          
          <h5 style="color: red;">Línea Roja: Fuerza</h5>
        <div id="chartdiv35" style="position: relative;height: 350px;"></div>
      </div>
    </div>
  </div>

<br><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <label for="">Evolución de Indice de Masa Corporal</label>
          <br>
        <div id="chartdiv36" style="position: relative;height: 350px;"></div>
      </div>
    </div>
  </div>




  <!-- <canvas id="lineChart"></canvas> -->
</div>
@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawVisualization);
function drawVisualization() {
// Some raw data (not necessarily accurate)
var data = google.visualization.arrayToDataTable([
['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
['2004/05',  165,      938,         522,             998,           450,      614.6],
['2005/06',  135,      1120,        599,             1268,          288,      682],
['2006/07',  157,      1167,        587,             807,           397,      623],
['2007/08',  139,      1110,        615,             968,           215,      609.4],
['2008/09',  136,      691,         629,             1026,          366,      569.6]
]);
var options = {
title : 'Monthly Coffee Production by Country',
vAxis: {title: 'Cups'},
hAxis: {title: 'Month'},
seriesType: 'bars',
series: {5: {type: 'line'}}
};
var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
chart.draw(data, options);
}
</script>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});
// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);
// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {
// Create the data table.
var data = new google.visualization.DataTable();
data.addColumn('string', 'Topping');
data.addColumn('number', 'Slices');
data.addRows([
['Mushrooms', 3],
['Onions', 1],
['Olives', 1],
['Zucchini', 1],
['Pepperoni', 2]
]);
// Set chart options
var options = {'title':'How Much Pizza I Ate Last Night',
'width':400,
'height':300};
// Instantiate and draw our chart, passing in some options.
var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
chart.draw(data, options);
}
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var data = google.visualization.arrayToDataTable([
['Task', 'Hours per Day'],
['Work',     11],
['Eat',      2],
['Commute',  2],
['Watch TV', 2],
['Sleep',    7]
]);
var options = {
title: 'My Daily Activities',
pieHole: 0.4,
};
var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
chart.draw(data, options);
}
</script>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: ["Fútbol", "Natación", "Atletismo", "Tennis", "Baloncesto", "Ciclismo"],
datasets: [{
label: '# of Votes',
data: [12, 19, 3, 5, 2, 3],
backgroundColor: [
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)'
],
borderColor: [
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
borderWidth: 1
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero: true
}
}]
}
}
});
</script>
<script>
//polar
var ctxPA = document.getElementById("polarChart").getContext('2d');
var myPolarChart = new Chart(ctxPA, {
type: 'polarArea',
data: {
labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
datasets: [{
data: [300, 50, 100, 40, 120],
backgroundColor: ["rgba(219, 0, 0, 0.1)", "rgba(0, 165, 2, 0.1)", "rgba(255, 195, 15, 0.2)",
"rgba(55, 59, 66, 0.1)", "rgba(0, 0, 0, 0.3)"
],
hoverBackgroundColor: ["rgba(219, 0, 0, 0.2)", "rgba(0, 165, 2, 0.2)",
"rgba(255, 195, 15, 0.3)", "rgba(55, 59, 66, 0.1)", "rgba(0, 0, 0, 0.4)"
]
}]
},
options: {
responsive: true
}
});
</script>
<script>
//pie
var ctxP = document.getElementById("pieChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
type: 'pie',
data: {
labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
datasets: [{
data: [300, 50, 100, 40, 120],
backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
}]
},
options: {
responsive: true
}
});
</script>
<script>
var ctxBc = document.getElementById('bubbleChart').getContext('2d');
var bubbleChart = new Chart(ctxBc, {
type: 'bubble',
data: {
datasets: [{
label: 'John',
data: [{
x: 3,
y: 7,
r: 10
}],
backgroundColor: "#ff6384",
hoverBackgroundColor: "#ff6384"
}, {
label: 'Peter',
data: [{
x: 5,
y: 7,
r: 10
}],
backgroundColor: "#44e4ee",
hoverBackgroundColor: "#44e4ee"
}, {
label: 'Donald',
data: [{
x: 7,
y: 7,
r: 10
}],
backgroundColor: "#62088A",
hoverBackgroundColor: "#62088A"
}]
}
})
</script>
<script>
var ctxSc = document.getElementById('scatterChart').getContext('2d');
var scatterData = {
datasets: [{
borderColor: 'rgba(99,0,125, .2)',
backgroundColor: 'rgba(99,0,125, .5)',
label: 'V(node2)',
data: [{
x: 1,
y: -1.711e-2,
}, {
x: 1.26,
y: -2.708e-2,
}, {
x: 1.58,
y: -4.285e-2,
}, {
x: 2.0,
y: -6.772e-2,
}, {
x: 2.51,
y: -1.068e-1,
}, {
x: 3.16,
y: -1.681e-1,
}, {
x: 3.98,
y: -2.635e-1,
}, {
x: 5.01,
y: -4.106e-1,
}, {
x: 6.31,
y: -6.339e-1,
}, {
x: 7.94,
y: -9.659e-1,
}, {
x: 10.00,
y: -1.445,
}, {
x: 12.6,
y: -2.110,
}, {
x: 15.8,
y: -2.992,
}, {
x: 20.0,
y: -4.102,
}, {
x: 25.1,
y: -5.429,
}, {
x: 31.6,
y: -6.944,
}, {
x: 39.8,
y: -8.607,
}, {
x: 50.1,
y: -1.038e1,
}, {
x: 63.1,
y: -1.223e1,
}, {
x: 79.4,
y: -1.413e1,
}, {
x: 100.00,
y: -1.607e1,
}, {
x: 126,
y: -1.803e1,
}, {
x: 158,
y: -2e1,
}, {
x: 200,
y: -2.199e1,
}, {
x: 251,
y: -2.398e1,
}, {
x: 316,
y: -2.597e1,
}, {
x: 398,
y: -2.797e1,
}, {
x: 501,
y: -2.996e1,
}, {
x: 631,
y: -3.196e1,
}, {
x: 794,
y: -3.396e1,
}, {
x: 1000,
y: -3.596e1,
}]
}]
}
var config1 = new Chart.Scatter(ctxSc, {
data: scatterData,
options: {
title: {
display: true,
text: 'Scatter Chart - Logarithmic X-Axis'
},
scales: {
xAxes: [{
type: 'logarithmic',
position: 'bottom',
ticks: {
userCallback: function (tick) {
var remain = tick / (Math.pow(10, Math.floor(Chart.helpers.log10(tick))));
if (remain === 1 || remain === 2 || remain === 5) {
return tick.toString() + 'Hz';
}
return '';
},
},
scaleLabel: {
labelString: 'Frequency',
display: true,
}
}],
yAxes: [{
type: 'linear',
ticks: {
userCallback: function (tick) {
return tick.toString() + 'dB';
}
},
scaleLabel: {
labelString: 'Voltage',
display: true
}
}]
}
}
});
</script>
<script>
var ctxBc = document.getElementById('bubbleChart').getContext('2d');
var bubbleChart = new Chart(ctxBc, {
type: 'bubble',
data: {
datasets: [{
label: 'John',
data: [{
x: 3,
y: 7,
r: 10
}],
backgroundColor: "#ff6384",
hoverBackgroundColor: "#ff6384"
}, {
label: 'Peter',
data: [{
x: 5,
y: 7,
r: 10
}],
backgroundColor: "#44e4ee",
hoverBackgroundColor: "#44e4ee"
}, {
label: 'Donald',
data: [{
x: 7,
y: 7,
r: 10
}],
backgroundColor: "#62088A",
hoverBackgroundColor: "#62088A"
}]
}
})
</script>
<script>
var ctxBc = document.getElementById('bubbleChart').getContext('2d');
var bubbleChart = new Chart(ctxBc, {
type: 'bubble',
data: {
datasets: [{
label: 'John',
data: [{
x: 3,
y: 7,
r: 10
}],
backgroundColor: "#ff6384",
hoverBackgroundColor: "#ff6384"
}, {
label: 'Peter',
data: [{
x: 5,
y: 7,
r: 10
}],
backgroundColor: "#44e4ee",
hoverBackgroundColor: "#44e4ee"
}, {
label: 'Donald',
data: [{
x: 7,
y: 7,
r: 10
}],
backgroundColor: "#62088A",
hoverBackgroundColor: "#62088A"
}]
}
})
</script>
<script>
//line
var ctxL = document.getElementById("lineChart").getContext('2d');
var myLineChart = new Chart(ctxL, {
type: 'line',
data: {
labels: ["January", "February", "March", "April", "May", "June", "July"],
datasets: [{
label: "My First dataset",
data: [65, 59, 80, 81, 56, 55, 40],
backgroundColor: [
'rgba(105, 0, 132, .2)',
],
borderColor: [
'rgba(200, 99, 132, .7)',
],
borderWidth: 2
},
{
label: "My Second dataset",
data: [28, 48, 40, 19, 86, 27, 90],
backgroundColor: [
'rgba(0, 137, 132, .2)',
],
borderColor: [
'rgba(0, 10, 130, .7)',
],
borderWidth: 2
}
]
},
options: {
responsive: true
}
});
</script>
<script src="js/circles.min.js"></script>
<script>
  //@ http://jsfromhell.com/array/shuffle [v1.0]
  function shuffle(o){ //v1.0
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
  }
  var colors = [
    ['#D3B6C6', '#4B253A'], ['#FCE6A4', '#EFB917'], ['#BEE3F7', '#45AEEA'], ['#F8F9B6', '#D2D558'], ['#F4BCBF', '#D43A43']
  ], circles = [];
  for (var i = 1; i <= 5; i++) {
    var child = document.getElementById('circles-' + i),
      percentage = 31 + (i * 9);
    circles.push(Circles.create({
      id:         child.id,
          value:    percentage,
      radius:     60,
      width:      10,
      colors:     colors[i - 1]
    }));
  }
  document.getElementById('change-value-button').onclick = function()
  {
  for(var i = 0, l = circles.length; i < l; i++)
      circles[i].update(20, 250);
  };
  document.getElementById('add-width-button').onclick = function()
  {
    for(var i = 0, l = circles.length; i < l; i++) {
      circles[i].updateWidth(20);
    }
  };
  document.getElementById('substract-width-button').onclick = function()
  {
    for(var i = 0, l = circles.length; i < l; i++)
      circles[i].updateWidth(10);
  };
  document.getElementById('colors-button').onclick = function()
  {
    colors = shuffle(colors);
    for(var i = 0, l = circles.length; i < l; i++)
      circles[i].updateColors(colors[i]);
  };
</script>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script>
am4core.ready(function() {
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end
// create chart
var chart = am4core.create("chartdiv", am4charts.GaugeChart);
chart.innerRadius = am4core.percent(82);
/**
* Normal axis
*/
var axis = chart.xAxes.push(new am4charts.ValueAxis());
axis.min = 0;
axis.max = 100;
axis.strictMinMax = true;
axis.renderer.radius = am4core.percent(80);
axis.renderer.inside = true;
axis.renderer.line.strokeOpacity = 1;
axis.renderer.ticks.template.strokeOpacity = 1;
axis.renderer.ticks.template.length = 10;
axis.renderer.grid.template.disabled = true;
axis.renderer.labels.template.radius = 40;
axis.renderer.labels.template.adapter.add("text", function(text) {
return text + "%";
})
/**
* Axis for ranges
*/
var colorSet = new am4core.ColorSet();
var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
axis2.min = 0;
axis2.max = 100;
axis2.renderer.innerRadius = 10
axis2.strictMinMax = true;
axis2.renderer.labels.template.disabled = true;
axis2.renderer.ticks.template.disabled = true;
axis2.renderer.grid.template.disabled = true;
var range0 = axis2.axisRanges.create();
range0.value = 0;
range0.endValue = 50;
range0.axisFill.fillOpacity = 1;
range0.axisFill.fill = colorSet.getIndex(0);
var range1 = axis2.axisRanges.create();
range1.value = 50;
range1.endValue = 100;
range1.axisFill.fillOpacity = 1;
range1.axisFill.fill = colorSet.getIndex(2);
/**
* Label
*/
var label = chart.radarContainer.createChild(am4core.Label);
label.isMeasured = false;
label.fontSize = 45;
label.x = am4core.percent(50);
label.y = am4core.percent(100);
label.horizontalCenter = "middle";
label.verticalCenter = "bottom";
label.text = "50%";
/**
* Hand
*/
var hand = chart.hands.push(new am4charts.ClockHand());
hand.axis = axis2;
hand.innerRadius = am4core.percent(20);
hand.startWidth = 10;
hand.pin.disabled = true;
hand.value = 50;
hand.events.on("propertychanged", function(ev) {
range0.endValue = ev.target.value;
range1.value = ev.target.value;
axis2.invalidate();
});
setInterval(() => {
var value = Math.round(Math.random() * 100);
label.text = value + "%";
var animation = new am4core.Animation(hand, {
property: "value",
to: value
}, 1000, am4core.ease.cubicOut).start();
}, 2000);
}); // end am4core.ready()
</script>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/dataviz.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script>
am4core.ready(function() {
// Themes begin0
am4core.useTheme(am4themes_dataviz);
am4core.useTheme(am4themes_animated);
// Themes end
// Create chart instance
var chart = am4core.create("chartdiv31", am4charts.XYChart);
// Add data
chart.data = [{
"x": 1,
"ay": 4.5,
"by": 2.2,
"aValue": 15,
"bValue": 10
}, {
"x": 2,
"ay": 5.3,
"by": 4.9,
"aValue": 8,
"bValue": 3
}, {
"x": 3,
"ay": 6,
"by": 5.1,
"aValue": 16,
"bValue": 4
},
{
"x": 4,
"ay": 9,
"by": 7.5,
"aValue": 16,
"bValue": 4
}




];
// Create axes
var xAxis = chart.xAxes.push(new am4charts.ValueAxis());
xAxis.renderer.minGridDistance = 40;
// Create value axis
var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
// Create series
var series1 = chart.series.push(new am4charts.LineSeries());
series1.dataFields.valueX = "x";
series1.dataFields.valueY = "ay";
series1.dataFields.value = "aValue";
series1.strokeWidth = 2;
var bullet1 = series1.bullets.push(new am4charts.CircleBullet());
series1.heatRules.push({
target: bullet1.circle,
min: 5,
max: 20,
property: "radius"
});
bullet1.tooltipText = "{valueX} x {valueY}: [bold]{value}[/]";
var series2 = chart.series.push(new am4charts.LineSeries());
series2.dataFields.valueX = "x";
series2.dataFields.valueY = "by";
series2.dataFields.value = "bValue";
series2.strokeWidth = 2;
var bullet2 = series2.bullets.push(new am4charts.CircleBullet());
series2.heatRules.push({
target: bullet2.circle,
min: 5,
max: 20,
property: "radius"
});
bullet2.tooltipText = "{valueX} x {valueY}: [bold]{value}[/]";
//scrollbars
chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();
}); // end am4core.ready()
</script>
<script>
am4core.ready(function() {
// Themes begin0
am4core.useTheme(am4themes_dataviz);
am4core.useTheme(am4themes_animated);
// Themes end
// Create chart instance
var chart = am4core.create("chartdiv36", am4charts.XYChart);
// Add data
chart.data = [{
"x": 1,
"ay": 27,
"aValue": 15,
"bValue": 10
}, {
"x": 2,
"ay": 26,
"aValue": 8,
"bValue": 3
}, {
"x": 3,
"ay": 24,
"aValue": 16,
"bValue": 4
},
{
"x": 4,
"ay": 22,
"aValue": 16,
"bValue": 4
}




];
// Create axes
var xAxis = chart.xAxes.push(new am4charts.ValueAxis());
xAxis.renderer.minGridDistance = 40;
// Create value axis
var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
// Create series
var series1 = chart.series.push(new am4charts.LineSeries());
series1.dataFields.valueX = "x";
series1.dataFields.valueY = "ay";
series1.dataFields.value = "aValue";
series1.strokeWidth = 2;
var bullet1 = series1.bullets.push(new am4charts.CircleBullet());
series1.heatRules.push({
target: bullet1.circle,
min: 5,
max: 20,
property: "radius"
});
bullet1.tooltipText = "{valueX} x {valueY}: [bold]{value}[/]";
var series2 = chart.series.push(new am4charts.LineSeries());
series2.dataFields.valueX = "x";
series2.dataFields.valueY = "by";
series2.dataFields.value = "bValue";
series2.strokeWidth = 2;
var bullet2 = series2.bullets.push(new am4charts.CircleBullet());
series2.heatRules.push({
target: bullet2.circle,
min: 5,
max: 20,
property: "radius"
});
bullet2.tooltipText = "{valueX} x {valueY}: [bold]{value}[/]";
//scrollbars
chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();
}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {
// Themes begin0
am4core.useTheme(am4themes_dataviz);
am4core.useTheme(am4themes_animated);
// Themes end
// Create chart instance
var chart = am4core.create("chartdiv35", am4charts.XYChart);
// Add data
chart.data = [{
"x": 1,
"ay": 2.5,
"by": 2.2,
"aValue": 15,
"bValue": 10
}, {
"x": 2,
"ay": 3.3,
"by": 3.9,
"aValue": 8,
"bValue": 3
}, {
"x": 3,
"ay": 5,
"by": 6.1,
"aValue": 16,
"bValue": 4
},
{
"x": 4,
"ay": 9,
"by": 8.5,
"aValue": 16,
"bValue": 4
}




];
// Create axes
var xAxis = chart.xAxes.push(new am4charts.ValueAxis());
xAxis.renderer.minGridDistance = 40;
// Create value axis
var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
// Create series
var series1 = chart.series.push(new am4charts.LineSeries());
series1.dataFields.valueX = "x";
series1.dataFields.valueY = "ay";
series1.dataFields.value = "aValue";
series1.strokeWidth = 2;
var bullet1 = series1.bullets.push(new am4charts.CircleBullet());
series1.heatRules.push({
target: bullet1.circle,
min: 5,
max: 20,
property: "radius"
});
bullet1.tooltipText = "{valueX} x {valueY}: [bold]{value}[/]";
var series2 = chart.series.push(new am4charts.LineSeries());
series2.dataFields.valueX = "x";
series2.dataFields.valueY = "by";
series2.dataFields.value = "bValue";
series2.strokeWidth = 2;
var bullet2 = series2.bullets.push(new am4charts.CircleBullet());
series2.heatRules.push({
target: bullet2.circle,
min: 5,
max: 20,
property: "radius"
});
bullet2.tooltipText = "{valueX} x {valueY}: [bold]{value}[/]";
//scrollbars
chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();
}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end
// create chart
var chart = am4core.create("chartdiv1", am4charts.GaugeChart);
chart.innerRadius = am4core.percent(82);
/**
* Normal axis
*/
var axis = chart.xAxes.push(new am4charts.ValueAxis());
axis.min = 0;
axis.max = 100;
axis.strictMinMax = true;
axis.renderer.radius = am4core.percent(80);
axis.renderer.inside = true;
axis.renderer.line.strokeOpacity = 1;
axis.renderer.ticks.template.strokeOpacity = 1;
axis.renderer.ticks.template.length = 10;
axis.renderer.grid.template.disabled = true;
axis.renderer.labels.template.radius = 40;
axis.renderer.labels.template.adapter.add("text", function(text) {
return text + "%";
})
/**
* Axis for ranges
*/
var colorSet = new am4core.ColorSet();
var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
axis2.min = 0;
axis2.max = 100;
axis2.renderer.innerRadius = 10
axis2.strictMinMax = true;
axis2.renderer.labels.template.disabled = true;
axis2.renderer.ticks.template.disabled = true;
axis2.renderer.grid.template.disabled = true;
var range0 = axis2.axisRanges.create();
range0.value = 0;
range0.endValue = 50;
range0.axisFill.fillOpacity = 1;
range0.axisFill.fill = colorSet.getIndex(0);
var range1 = axis2.axisRanges.create();
range1.value = 50;
range1.endValue = 100;
range1.axisFill.fillOpacity = 1;
range1.axisFill.fill = colorSet.getIndex(2);
/**
* Label
*/
var label = chart.radarContainer.createChild(am4core.Label);
label.isMeasured = false;
label.fontSize = 45;
label.x = am4core.percent(50);
label.y = am4core.percent(100);
label.horizontalCenter = "middle";
label.verticalCenter = "bottom";
label.text = "50%";
/**
* Hand
*/
var hand = chart.hands.push(new am4charts.ClockHand());
hand.axis = axis2;
hand.innerRadius = am4core.percent(20);
hand.startWidth = 10;
hand.pin.disabled = true;
hand.value = 50;
hand.events.on("propertychanged", function(ev) {
range0.endValue = ev.target.value;
range1.value = ev.target.value;
axis2.invalidate();
});
setInterval(() => {
var value = Math.round(Math.random() * 100);
label.text = value + "%";
var animation = new am4core.Animation(hand, {
property: "value",
to: value
}, 1000, am4core.ease.cubicOut).start();
}, 2000);
}); // end am4core.ready()
</script>
<script>
am4core.ready(function() {
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end
var chart = am4core.create("chartdiv2", am4charts.PieChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
chart.data = [
{
country: "Niños",
value: 2
},
{
country: "Jovenes",
value: 3
},
{
country: "Adultos",
value: 1
}
];
chart.radius = am4core.percent(70);
chart.innerRadius = am4core.percent(40);
chart.startAngle = 180;
chart.endAngle = 360;
var series = chart.series.push(new am4charts.PieSeries());
series.dataFields.value = "value";
series.dataFields.category = "country";
series.slices.template.cornerRadius = 10;
series.slices.template.innerCornerRadius = 3;
series.slices.template.draggable = true;
series.slices.template.inert = true;
series.alignLabels = false;
series.hiddenState.properties.startAngle = 60;
series.hiddenState.properties.endAngle = 60;
chart.legend = new am4charts.Legend();
}); // end am4core.ready()
</script>
<script>
am4core.ready(function() {
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end
// Create chart instance
var chart = am4core.create("chartdiv3", am4charts.XYChart);
// Add data
chart.data = [{
"x": 1,
"ay": 6.5,
"by": 2.2,
"aValue": 15,
"bValue": 10
}, {
"x": 2,
"ay": 12.3,
"by": 4.9,
"aValue": 8,
"bValue": 3
}, {
"x": 3,
"ay": 12.3,
"by": 5.1,
"aValue": 16,
"bValue": 4
}, {
"x": 5,
"ay": 2.9,
"aValue": 9
}, {
"x": 7,
"by": 8.3,
"bValue": 13
}, {
"x": 10,
"ay": 2.8,
"by": 13.3,
"aValue": 9,
"bValue": 13
}, {
"x": 12,
"ay": 3.5,
"by": 6.1,
"aValue": 5,
"bValue": 2
}, {
"x": 13,
"ay": 5.1,
"aValue": 10
}, {
"x": 15,
"ay": 6.7,
"by": 10.5,
"aValue": 3,
"bValue": 10
}, {
"x": 16,
"ay": 8,
"by": 12.3,
"aValue": 5,
"bValue": 13
}, {
"x": 20,
"by": 4.5,
"bValue": 11
}, {
"x": 22,
"ay": 9.7,
"by": 15,
"aValue": 15,
"bValue": 10
}, {
"x": 23,
"ay": 10.4,
"by": 10.8,
"aValue": 1,
"bValue": 11
}, {
"x": 24,
"ay": 1.7,
"by": 19,
"aValue": 12,
"bValue": 3
}];
// Create axes
var xAxis = chart.xAxes.push(new am4charts.ValueAxis());
xAxis.renderer.minGridDistance = 40;
// Create value axis
var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
// Create series
var series1 = chart.series.push(new am4charts.LineSeries());
series1.dataFields.valueX = "x";
series1.dataFields.valueY = "ay";
series1.dataFields.value = "aValue";
series1.strokeWidth = 2;
var bullet1 = series1.bullets.push(new am4charts.CircleBullet());
series1.heatRules.push({
target: bullet1.circle,
min: 5,
max: 20,
property: "radius"
});
bullet1.tooltipText = "{valueX} x {valueY}: [bold]{value}[/]";
var series2 = chart.series.push(new am4charts.LineSeries());
series2.dataFields.valueX = "x";
series2.dataFields.valueY = "by";
series2.dataFields.value = "bValue";
series2.strokeWidth = 2;
var bullet2 = series2.bullets.push(new am4charts.CircleBullet());
series2.heatRules.push({
target: bullet2.circle,
min: 5,
max: 20,
property: "radius"
});
bullet2.tooltipText = "{valueX} x {valueY}: [bold]{value}[/]";
//scrollbars
chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();
}); // end am4core.ready()
</script>
<script>
am4core.ready(function() {
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end
var chart = am4core.create("chartdiv33", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
chart.data = [
{
country: "ENERO",
visits: 23725
},
{
country: "FEBRERO",
visits: 24820
},
{
country: "MARZO",
visits: 28090
},
{
country: "ABRIL",
visits: 32090
},
{
country: "MAYO",
visits: 35090
},

{
country: "JUNIO",
visits: 49090
},
{
country: "META 2019",
visits: 50000
}
];
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.minGridDistance = 40;
categoryAxis.fontSize = 11;
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;
valueAxis.max = 60000;
valueAxis.strictMinMax = true;
valueAxis.renderer.minGridDistance = 30;
// axis break
var axisBreak = valueAxis.axisBreaks.create();
axisBreak.startValue = 2100;
axisBreak.endValue = 22900;
axisBreak.breakSize = 0.005;
// make break expand on hover
var hoverState = axisBreak.states.create("hover");
hoverState.properties.breakSize = 1;
hoverState.properties.opacity = 0.1;
hoverState.transitionDuration = 1500;
axisBreak.defaultState.transitionDuration = 1000;
/*
// this is exactly the same, but with events
axisBreak.events.on("over", function() {
axisBreak.animate(
[{ property: "breakSize", to: 1 }, { property: "opacity", to: 0.1 }],
1500,
am4core.ease.sinOut
);
});
axisBreak.events.on("out", function() {
axisBreak.animate(
[{ property: "breakSize", to: 0.005 }, { property: "opacity", to: 1 }],
1000,
am4core.ease.quadOut
);
});*/
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryX = "country";
series.dataFields.valueY = "visits";
series.columns.template.tooltipText = "{valueY.value}";
series.columns.template.tooltipY = 0;
series.columns.template.strokeOpacity = 0;
// as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
series.columns.template.adapter.add("fill", function(fill, target) {
return chart.colors.getIndex(target.dataItem.index);
});
}); // end am4core.ready()
</script>
@endsection
@stop