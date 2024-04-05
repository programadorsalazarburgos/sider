<!DOCTYPE html>
<html class="bootstrap-layout">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>

  <!-- Prevent the demo from appearing in search engines (REMOVE THIS) -->
  <meta name="robots" content="noindex">

  <!-- Material Design Icons  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Roboto Web Font -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">

  <!-- App CSS -->
  <link type="text/css" href="{{ asset('assets2/css/style.min.css') }}" rel="stylesheet">

  <!-- Charts CSS -->
  <link rel="stylesheet" href="{{ asset('examples/css/morris.min.css') }}">

</head>

<body>
<div align="center"><img src="http://www.sidercali.com/images/BANNER.png" width="100%"></div>
<div class="layout-container ls-top-navbar si-l3-md-up breakpoint-1200">

  <!-- Navbar -->
  <nav class="navbar navbar-light bg-white navbar-full navbar-fixed-up ls-left-sidebar" style="position: initial;">

    <!-- Sidebar toggle -->
    <button class="navbar-toggler pull-xs-left hidden-lg-up" type="button" data-toggle="sidebar" data-target="#sidebarLeft"><span class="material-icons">menu</span></button>

    <!-- Menu -->
    <ul class="nav navbar-nav pull-xs-right hidden-md-down">

      <!-- Notifications dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" style="display: none;" data-caret="false" data-toggle="dropdown" role="button" aria-haspopup="false"><i class="material-icons email">mail_outline</i></a>
        <ul class="dropdown-menu dropdown-menu-right notifications" aria-labelledby="Preview">
          <li class="dropdown-title">Emails</li>
          <li class="dropdown-item email-item">
            <a class="nav-link" href="index.html">
				<span class="media">
					<span class="media-left media-middle"><i class="material-icons">mail</i></span>
					<span class="media-body media-middle">
						<small class="pull-xs-right text-muted">12:20</small>
						<strong>Adrian Demian</strong>
						Enhance your website with
					</span>
				</span>
			</a>
          </li>
          <li class="dropdown-item email-item">
            <a class="nav-link" href="index.html">
				<span class="media">
					<span class="media-left media-middle">
						<i class="material-icons">mail</i>
					</span>
					<span class="media-body media-middle">
						<small class="text-muted pull-xs-right">30 min</small>
						<strong>Michael Brain</strong>
						Partnership proposal
					</span>
				</span>
			</a>
          </li>
          <li class="dropdown-item email-item">
            <a class="nav-link" href="index.html">
				<span class="media">
					<span class="media-left media-middle">
						<i class="material-icons">mail</i>
					</span>
					<span class="media-body media-middle">
						<small class="text-muted pull-xs-right">1 hr</small>
						<strong>Sammie Downey</strong>
						UI Design
					</span>
				</span>
			</a>
          </li>
          <li class="dropdown-action center">
            <a href="email.html">Go to inbox</a>
          </li>
        </ul>
      </li>
      <!-- // END Notifications dropdown -->

      <!-- User dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle p-a-0" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false">
          <img src="{{ asset('images/admin-icon.png') }}" alt="Avatar" class="img-circle" width="40">
        </a>
         @guest
          
           <div class="dropdown-menu dropdown-menu-right dropdown-menu-list" aria-labelledby="Preview">
          <a class="dropdown-item" href="{{ route('login') }}"><i class="material-icons md-18">lock</i> <span class="icon-text">Login</span></a>
            </div>
         @else



   <div class="dropdown-menu dropdown-menu-right dropdown-menu-list" aria-labelledby="Preview">
          <a class="dropdown-item" href="/admin/postusuarios#/admin/postusuarios/editandoperfil/{{Auth::user()->id}}"><i class="material-icons md-18">lock</i> <span class="icon-text">Editar mi perfil</span></a>
            </div>


 <div class="dropdown-menu dropdown-menu-right dropdown-menu-list" aria-labelledby="Preview">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="material-icons md-18">lock</i> <span class="icon-text">Editar mi perfil</span></a>
            </div>
 
             
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>

         @endguest

      </li>
      <!-- // END User dropdown -->

    </ul>
    <!-- // END Menu -->

  </nav>
  <!-- // END Navbar -->

  <!-- Sidebar -->
  <div class="sidebar sidebar-left si-si-3 sidebar-visible-md-up sidebar-dark bg-primary" id="sidebarLeft" data-scrollable>

    <!-- Brand -->
   
    <a href="index.html" class="sidebar-brand">
    <span class="logo-text" style="text-align: center; position: relative; left: -7px;"><h4 style="font-size:  18px; position: relative;top: 4px;">SIDER</h4> 
      <h5 style="font-size:  12px; width: 235px; text-align: center; position: relative;top: -2px;">Sistema Integrado del Deporte y la Recreación</h5>
        </span>
        <span style="display: none" class="logo-text-icon">µ</span> 
</a>
    <!-- User -->
 @if(Auth::check())
    
    @if(Auth::user()->tenantId == "5467829281")
      <a href="#" class="sidebar-link sidebar-user">
        <img src="{{ asset('images/admin-icon.png') }}" alt="user" class="img-circle"> <p align="center" style="font-size: 12px;">MI COMUNIDAD</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
      </a>
    @endif


 @if(Auth::user()->tenantId == "2767829213")
          

 <a href="#" class="sidebar-link sidebar-user">
        <img src="{{ asset('images/admin-icon.png') }}" alt="user" class="img-circle">DEPORTE ESCOLAR
                  <h5 style="font-size:12px; align:center; position: relative; left: 45px; top: 2px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</h5>
      </a>

                @endif


              @if(Auth::user()->tenantId == "3651901612")
              <div class="info">
                  <p align="center" style="font-size: 12px;">CALI ACOGE</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "9108237611")
              <div class="info">
                  <p align="center" style="font-size: 12px;">CALI SE DIVIERTE</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "7233109821")
              <div class="info">
                  <p align="center" style="font-size: 12px;">CALINTEGRA</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "1240916273")
              <div class="info">
                  <p align="center" style="font-size: 12px;">CANAS Y GANAS</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "2871155601")
              <div class="info">
                  <p align="center" style="font-size: 12px;">CARRERAS Y CAMINATAS</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "8762109662")
              <div class="info">
                  <p align="center" style="font-size: 12px;">CUERPO Y ESPIRITU</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "4432891188")
              <div class="info">
                  <p align="center" style="font-size: 12px;">DEPORTE ASOCIADO</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "2288251678")
              <div class="info">
                  <p align="center" style="font-size: 12px;">DEPORTE COMUNITARIO</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "3365342001")
              <div class="info">
                  <p align="center" style="font-size: 12px;">VERTIGO</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "1177624100")
              <div class="info">
                  <p align="center" style="font-size: 12px;">VIACTIVA</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


             @if(Auth::user()->tenantId == "7765533102")
              <div class="info">
                  <p align="center" style="font-size: 12px;">VIVE EL PARQUE</p>    
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif







@endif


           {{--  <div class="info">
                <p align="center" style="font-size: 12px;">MI COMUNIDAD</p>    
                <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                <ul class="list-inline list-unstyled">
                </ul>
            </div>
 --}}



    <!-- // END User -->

    <!-- Menu -->
    <ul class="sidebar-menu sm-bordered sm-active-button-bg">
     @include('angular.template.menu2')
      
     
    </ul>
  </div>
  <!-- // END Sidebar -->

  <!-- Right Sidebars -->

  <!-- Content -->
  <div class="layout-content" data-scrollable>
    <div class="container-fluid">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li><a href="index.html#">Dashboard</a></li>
        <li class="active">Data</li>
      </ol>

      <!-- Row -->
      <div class="row">

        <!-- Column -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-block center">
              <h5 class="card-title">Volume Trend</h5>
              <p class="card-subtitle">340 Highest</p>
              <div id="line1" style="height: 130px; margin:0 -10px;"></div>
              <a href="index.html#" class="btn btn-primary btn-rounded-deep btn-sm">More Details</a>
            </div>
          </div>
        </div>
        <!-- // END Column -->

        <!-- Column -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-button-wrapper">
              <a href="index.html#" class="card-button"><i class="material-icons">settings</i></a>
            </div>
            <div class="card-block center">
              <h5 class="card-title">Receipts</h5>
              <p class="card-subtitle">482 Prescribed</p>
              <div id="bar2" style="height: 130px; margin:0 -10px;"></div>
              <a href="index.html#" class="btn btn-primary btn-rounded-deep btn-sm">View Report</a>
            </div>
          </div>
        </div>
        <!-- // END Column -->

        <!-- Column -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-white center">
              <h5 class="card-title">Top Member</h5>
              <p class="card-subtitle m-b-0">Adrian Demian</p>
            </div>
            <table class="table table-sm m-b-0">
              <tr>
                <td><i class="material-icons text-primary">person</i> <span class="icon-text"><a href="index.html#">Adrian Demian</a></span></td>
                <td class="right">
                  <div class="label label-success">49</div>
                </td>
                <td class="right" width="1"><a href="index.html#" class="btn btn-xs btn-white"><i class="material-icons md-18">chevron_right</i></a></td>
              </tr>
              <tr>
                <td class="text-muted"><i class="material-icons text-muted">person</i> <span class="icon-text">Michelle Smith</span></td>
                <td class="right">
                  <div class="label label-default">24</div>
                </td>
                <td class="right" width="1"><a href="index.html#" class="btn btn-xs btn-white"><i class="material-icons md-18">chevron_right</i></a></td>
              </tr>

              <tr>
                <td class="text-muted"><i class="material-icons text-muted">person</i> <span class="icon-text">Jonny Clint</span></td>
                <td class="right">
                  <div class="label label-default">16</div>
                </td>
                <td class="right" width="1"><a href="index.html#" class="btn btn-xs btn-white"><i class="material-icons md-18">chevron_right</i></a></td>
              </tr>
              <tr>
                <td class="text-muted"><i class="material-icons text-muted">person</i> <span class="icon-text">Andrew Brain</span></td>
                <td class="right">
                  <div class="label label-default">13</div>
                </td>
                <td class="right" width="1"><a href="index.html#" class="btn btn-xs btn-white"><i class="material-icons md-18">chevron_right</i></a></td>
              </tr>
              <tr>
                <td class="text-muted"><i class="material-icons text-muted">person</i> <span class="icon-text">Bill Carter</span></td>
                <td class="right">
                  <div class="label label-default">5</div>
                </td>
                <td class="right"><a href="index.html#" class="btn btn-xs btn-white"><i class="material-icons md-18">chevron_right</i></a></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- // END Column -->

      </div>
      <!-- // END Row -->

      <!-- Row -->
      <div class="row">

        <!-- Column -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-block">
              <p class="text-muted pull-xs-right">5 of 10</p>
              <h5 class="m-b-1"><i class="material-icons">list</i> <span class="icon-text">Tasks</span></h5>
              <progress class="progress progress-animated progress-primary m-a-0" value="50" max="100">50%
              </progress>
            </div>
          </div>
        </div>
        <!-- // END Column -->

        <!-- Column -->
        <div class="col-md-6">
          <div class="card-primary">
            <div class="card-block">
              <i class="material-icons pull-xs-right md-48">group</i>
              <h5 class="m-b-0">$12,129</h5>
              <p class="m-a-0">Sales by Reps</p>
            </div>
          </div>
        </div>
        <!-- // END Column -->

      </div>
      <!-- // END Row -->

      <!-- Row -->
      <div class="row">

        <!-- Column -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-button-wrapper">
              <div class="dropdown">
                <a href="index.html#" class="card-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="index.html#">Action</a>
                  <a class="dropdown-item" href="index.html#">Another action</a>
                  <a class="dropdown-item" href="index.html#">Something else here</a>
                </div>
              </div>
            </div>
            <div class="card-block">
              <h5 class="card-title">Current Stats</h5>
              <p class="card-subtitle">Quick summary of this month's activity</p>

              <div id="stats" style="height:240px;"></div>
            </div>
          </div>
          <div class="card">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" id="history-tab" data-toggle="tab" href="index.html#history">
						<i class="material-icons">schedule</i> <span class="icon-text">History</span>
					</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="customers-tab" data-toggle="tab" href="index.html#customers">
						<i class="material-icons">person_add</i> <span class="icon-text">Sign Ups</span>
					</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade in active" id="history">
                <ul class="list-group list-group-fit">
                  <li class="list-group-item">
                    <div class="media">
                      <div class="media-left media-middle">
                        <i class="material-icons md-36 text-muted">receipt</i>
                      </div>
                      <div class="media-body">
                        <p class="m-a-0">
                          <a href="index.html#">Sam</a> added a new invoice <a href="index.html#">#9591</a>
                        </p>
                        <small class="text-muted">
                          <i class="material-icons md-18">timer</i> <span class="icon-text">5 hrs ago</span>
                        </small>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="media">
                      <div class="media-left media-middle">
                        <i class="material-icons md-36 text-muted">dns</i>
                      </div>
                      <div class="media-body">
                        <p class="m-a-0">
                          <a href="index.html#">John</a> created a new <a href="index.html#">task</a>
                        </p>
                        <small class="text-muted">
                          <i class="material-icons md-18">today</i> <span class="icon-text">1 day ago</span>
                        </small>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="media">
                      <div class="media-left media-middle">
                        <i class="material-icons md-36 text-muted">group</i>
                      </div>
                      <div class="media-body">
                        <p class="m-a-0">
                          <a href="index.html#">Partick</a> added <a href="index.html#">Sam</a> are now friends.
                        </p>
                        <small class="text-muted">
                          <i class="material-icons md-18">today</i> <span class="icon-text">2 days ago</span>
                        </small>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="tab-pane" id="customers">
                <table class="table  m-b-0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Company</th>
                      <th width="120" class="center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="index.html#"> Derek S.</a></td>
                      <td>Reel Ltd.</td>
                      <td class="text-xs-center">
                        <a href="index.html#" class="btn btn-white btn-sm">
										<i class="material-icons md-18">edit</i>
									</a>
                        <a href="index.html#" class="btn btn-white btn-sm">
										<i class="material-icons md-18">email</i>
									</a>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="index.html#"> Paul M.</a></td>
                      <td>Places Ltd.</td>
                      <td class="text-xs-center">
                        <a href="index.html#" class="btn btn-white btn-sm">
										<i class="material-icons md-18">edit</i>
									</a>
                        <a href="index.html#" class="btn btn-white btn-sm">
										<i class="material-icons md-18">email</i>
									</a>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="index.html#"> John D.</a></td>
                      <td>Woot Ltd.</td>
                      <td class="text-xs-center">
                        <a href="index.html#" class="btn btn-white btn-sm">
										<i class="material-icons md-18">edit</i>
									</a>
                        <a href="index.html#" class="btn btn-white btn-sm">
										<i class="material-icons md-18">email</i>
									</a>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="index.html#">Amy T.</a></td>
                      <td>Scoop Ltd.</td>
                      <td class="text-xs-center">
                        <a href="index.html#" class="btn btn-white btn-sm">
										<i class="material-icons md-18">edit</i>
									</a>
                        <a href="index.html#" class="btn btn-white btn-sm">
										<i class="material-icons md-18">email</i>
									</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- // END Column -->

        <!-- Column -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-white">
              <div class="media">
                <div class="media-body ">
                  <h5 class="card-title">My Staff</h5>
                  <p class="card-subtitle">December 2015</p>
                </div>
                <div class="media-right media-middle">
                  <a href="index.html#" class="btn btn-circle btn-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="material-icons">add</i></a>
                </div>
              </div>
            </div>
            <table class="table table-md m-a-0">
              <tr>
                <td>
                  <a href="index.html#">Sam Donahue </a>
                </td>
                <td class="right">
                  <span class="label label-success">$12,571</span>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="index.html#">Adrian Demian</a>
                </td>
                <td class="right">
                  <span class="label label-default">$11,953</span>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="index.html#">Jeff Gavin</a>
                </td>
                <td class="right">
                  <span class="label label-default">$6,631</span>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="index.html#">Michelle Smith</a>
                </td>
                <td class="right">
                  <span class="label label-danger">$3,278</span>
                </td>
              </tr>
            </table>
          </div>
          <div class="card card-stats-primary">
            <div class="card-block">
              <p class="pull-xs-right text-primary">
                <strong>70%</strong>
              </p>
              <h5 class="m-b-1">Performance</h5>
              <progress class="progress progress-primary progress-animated m-a-0" value="70" max="100">70%</progress>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <div class="media">
                <div class="media-body media-middle">
                  <h5 class="card-title m-b-0">Todo's</h5>
                </div>
                <div class="media-right media-middle">
                  <a href="index.html#" class="btn btn-white">
							<i class="material-icons">add</i> <span class="icon-text">Add</span>
						</a>
                </div>
              </div>
            </div>
            <div class="card-block">
              <div class="c-inputs-stacked">
                <label class="c-input c-checkbox">
                  <input type="checkbox">
                  <span class="c-indicator"></span> Admin Plus in Ruby on Rails
                </label>
                <label class="c-input c-checkbox">
                  <input type="checkbox">
                  <span class="c-indicator"></span> Create a Map UI
                </label>
                <label class="c-input c-checkbox">
                  <input type="checkbox">
                  <span class="c-indicator"></span> Extend Timeline with Chat
                </label>
                <label class="c-input c-checkbox">
                  <input type="checkbox" checked>
                  <span class="c-indicator"></span> Extend Timeline with Chat
                </label>
                <label class="c-input c-checkbox">
                  <input type="checkbox" checked>
                  <span class="c-indicator"></span> Refactor Spacings
                </label>
              </div>
            </div>
            <div class="card-footer">
              <div class="pull-right">
                <a href="index.html#">Completed <span class="text-muted">(24)</span></a>
              </div>
              Pending (3)
            </div>
          </div>
        </div>
        <!-- // END Column -->

      </div>
      <!-- // END Row -->

    </div>
  </div>

  <!-- jQuery -->
  <script src="assets2/vendor/jquery.min.js"></script>

  <!-- Bootstrap -->
  <script src="assets2/vendor/tether.min.js"></script>
  <script src="assets2/vendor/bootstrap.min.js"></script>

  <!-- AdminPlus -->
  <script src="assets2/vendor/adminplus.js"></script>

  <!-- App JS -->
  <script src="assets2/js/main.min.js"></script>

  <!-- Theme Colors -->
  <script src="assets2/js/colors.js"></script>

  <!-- Charts JS -->
  <script src="assets2/vendor/raphael.min.js"></script>
  <script src="assets2/vendor/morris.min.js"></script>

  <!-- Initialize Charts -->
  <script src="examples/js/chart.js"></script>
</div>
</body>

</html>