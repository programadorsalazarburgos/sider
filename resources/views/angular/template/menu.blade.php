@guest
  <div class="sidebar-collapse menu-scroll">
        <ul id="side-menu" class="nav">
            <div class="clearfix"></div><br>
        </li>
            <li><a href="http://sider.cali.gov.co:8082"><i class="fa fa-book" aria-hidden="false">
                <div class="icon-bg bg-orange"></div>
            </i><span class="menu-title">Semilleros</span><span class="fa arrow"></span><span
            class="label label-yellow"></span></a>
        </li>
        <li><a href="{{ route('login') }}"><i class="fa fa-book" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Más Recreo</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        </li>
        <li><a href="{{ route('login') }}"><i class="fa fa-book" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Team Cali</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        </li>
        
        <li><a href="{{ route('login') }}"><i class="fa fa-book" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">In Cali</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        </li>
        <li><a href="{{ route('login') }}"><i class="fa fa-book" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Cali en forma</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        </li>
        <li><a href="{{ route('login') }}"><i class="fa fa-book" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Rutas de vida</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        </li>
        <li><a href="{{ route('login') }}"><i class="fa fa-book" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Ciclo Vida</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        </li>
        <li><a href="{{ route('login') }}"><i class="fa fa-book" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Cali juega</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        </li>
        <li><a href="{{ route('login') }}"><i class="fa fa-book" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Cali incluye</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        </li>
        <li><a href="{{ route('login') }}"><i class="fa fa-book" aria-hidden="false">

            <div class="icon-bg bg-orange"></div>

        </i><span class="menu-title">Más vitales</span><span class="fa arrow"></span><span

        class="label label-yellow"></span></a>
        </li>
        <li><a href="http://18.116.147.172/" target="_blank"><i class="fa fa-book" aria-hidden="false">

<div class="icon-bg bg-orange"></div>

</i><span class="menu-title">Gestión de escenarios</span><span class="fa arrow"></span><span

class="label label-yellow"></span></a>
</li>
</ul>
</div>

@else

<!-- @if(Auth::user()->numero_documento != "20190902")
<li>
    <a href="{{url('/admin/postlocalizacion#/admin/postlocalizacion')}}"><i class="fa fa-codepen" aria-hidden="false">
        <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Reportes Por Comuna</span><span class="fa arrow"></span><span
        class="label label-yellow"></span>
    </a>
</li>
@endif -->

<div class="sidebar-collapse menu-scroll">
    <ul id="side-menu" class="nav">
        <li class="user-panel">
            <div class="thumb"><img src="{{ asset('images/admin-icon.png') }}" alt="" class="img-circle"></div>
            @if(Auth::check())
             @if(Auth::user()->tenantId == "5467829281")
            <div class="info">
                <p align="center" style="font-size: 12px;">MI COMUNIDAD</p>
                <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                <ul class="list-inline list-unstyled">
                </ul>
            </div>
              @endif
              @if(Auth::user()->tenantId == "2767829213")
              <div class="info">
                  <p align="center" style="font-size: 12px;">MAS RECREO</p>
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "3651901612")
              <div class="info">
                  <p align="center" style="font-size: 12px;">CALI INCLUYE</p>
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
                  <p align="center" style="font-size: 12px;">IN CALI</p>
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "1240916273")
              <div class="info">
                  <p align="center" style="font-size: 12px;">MAS VITALES</p>
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "2871155601")
              <div class="info">
                  <p align="center" style="font-size: 12px;">RUTAS DE VIDA</p>
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "8762109662")
              <div class="info">
                  <p align="center" style="font-size: 12px;">CALI EN FORMA</p>
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


              @if(Auth::user()->tenantId == "4432891188")
              <div class="info">
                  <p align="center" style="font-size: 12px;">TEAM CALI</p>
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
                  <p align="center" style="font-size: 12px;">CICLO VIDA</p>
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif


             @if(Auth::user()->tenantId == "7765533102")
              <div class="info">
                  <p align="center" style="font-size: 12px;">CALI JUEGA</p>
                  <p style="font-size: 12px;">{{ strtoupper(Auth::user()->primer_nombre) }} {{ strtoupper(Auth::user()->primer_apellido) }}</p>
                  <ul class="list-inline list-unstyled">
                  </ul>
              </div>
                @endif



            @endif
            <div class="clearfix"></div>
        </li>
        @if(auth()->user()->can('ver-roles') || auth()->user()->can('crear-roles') || auth()->user()->can('editar-roles') || auth()->user()->can('eliminar-roles') || auth()->user()->can('generar-permisos') || auth()->user()->can('ver-usuarios') || auth()->user()->can('crear-usuarios') || auth()->user()->can('editar-usuarios') || auth()->user()->can('cambiar-password') || auth()->user()->can('eliminar-usuarios'))
        <li><a href="#"><i class="fa fa-user aria-hidden='false'">
            <div class="icon-bg bg-orange"></div>
            </i><span class="menu-title">Gestión Usuarios</span><span class="fa arrow"></span><span
            class="label label-yellow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="{{url('/usuarios/roles_permisos')}}"><i class="fa fa-list-ol"></i><span
               class="submenu-title">Roles y Permisos</span></a></li>
                <li><a href="{{url('/admin/postusuarios#/admin/postusuarios')}}"><i class="fa fa-plus-square"></i><span
                class="submenu-title">Usuarios</span></a></li>
            </ul>
        </li>
        @endif
        @if(auth()->user()->can('ver-programas') || auth()->user()->can('crear-programas') || auth()->user()->can('editar-programas') || auth()->user()->can('eliminar-programas'))
        <li><a href="{{url('/admin/postprogramas#/admin/postprogramas')}}"><i class="fa fa-book" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Programas</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        </li>
        @endif
        <li>
            @if(Auth::user()->numero_documento != "20190902")
            <a href="#"><i class="fa fa-wrench" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>

        </i>

        <span class="menu-title">Gest. Administrativa</span>

        <span class="fa arrow"></span><span
          class="label label-yellow"></span>

      </a>
      @endif
        <ul class="nav nav-second-level">
            @if(auth()->user()->can('ver-zonas') || auth()->user()->can('crear-zonas') || auth()->user()->can('editar-zonas') || auth()->user()->can('eliminar-zonas'))
             @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postzonas#/admin/postzonas')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Zonas</span></a>
            </li>
            @endif
            @endif
            @if(auth()->user()->can('ver-comunas') || auth()->user()->can('crear-comunas') || auth()->user()->can('editar-comunas') || auth()->user()->can('eliminar-comunas'))
             @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postcomunas#/admin/postcomunas')}}"><i class="fa fa-plus-square"></i><span
                class="submenu-title">Comunas</span></a>
            </li>
            @endif
            @endif
            @if(auth()->user()->can('ver-barrios') || auth()->user()->can('crear-barrios') || auth()->user()->can('editar-barrios') || auth()->user()->can('eliminar-barrios'))
             @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postbarrios#/admin/postbarrios')}}"><i class="fa fa-plus-square"></i><span
                class="submenu-title">Barrios</span></a>
            </li>
            @endif
            @endif
            @if(auth()->user()->can('ver-grados') || auth()->user()->can('crear-grados') || auth()->user()->can('editar-grados') || auth()->user()->can('eliminar-grados'))
             @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postgrados#/admin/postgrados')}}"><i class="fa fa-plus-square"></i><span
                class="submenu-title">Grados</span></a>
            </li>
            @endif
            @endif
            @if(auth()->user()->can('ver-eps') || auth()->user()->can('crear-eps') || auth()->user()->can('editar-eps') || auth()->user()->can('eliminar-eps'))
             @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/posteps#/admin/posteps')}}"><i class="fa fa-plus-square"></i><span
                class="submenu-title">Eps</span></a>
            </li>
            @endif
            @endif
            @if(auth()->user()->can('ver-ludotecas') || auth()->user()->can('crear-ludotecas') || auth()->user()->can('editar-ludotecas') || auth()->user()->can('eliminar-ludotecas'))
             @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postludotecas#/admin/postludotecas')}}"><i class="fa fa-plus-square"></i><span
                class="submenu-title">Ludotecas</span></a>
            </li>
            @endif
            @endif
            @if(auth()->user()->can('implementos-deportivos'))
             @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postimplementos#/admin/postimplementos')}}"><i class="fa fa-plus-square"></i><span
                class="submenu-title">Implementos Deportivos</span></a>
            </li>
            @endif
            @endif
            @if(auth()->user()->can('crear-titulos'))
            <li><a href="{{url('/admin/posttitulos#/admin/posttitulos')}}"><i class="fa fa-plus-square"></i><span
                class="submenu-title">Titulos</span></a>
            </li>
            @endif
            @if(auth()->user()->can('crear-universidades'))
            <li><a href="{{url('/admin/postuniversidades#/admin/postuniversidades')}}"><i class="fa fa-plus-square"></i><span
                class="submenu-title">Inst. de nivel superior</span></a>
            </li>
            @endif
            @if(auth()->user()->can('ver-instituciones') || auth()->user()->can('crear-instituciones') || auth()->user()->can('editar-instituciones') || auth()->user()->can('eliminar-instituciones'))  @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postinstituciones#/admin/postinstituciones')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Inst. Educativas Oficiales </span></a>
            </li>
            @endif
            @endif
            @if(auth()->user()->can('ver-sedes') || auth()->user()->can('crear-sedes') || auth()->user()->can('editar-sedes') || auth()->user()->can('eliminar-sedes'))
            @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postsedes#/admin/postsedes')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Sedes de I.E.O</span></a>
            </li>
            @endif
            @endif
            @if(auth()->user()->can('gestion-lugares'))
            <li><a href="{{url('/admin/postlugares#/admin/postlugares')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Sitios de Atención</span></a>
            </li>
            @endif
            @if(auth()->user()->can('gestion-disciplinas'))
            <li><a href="{{url('/admin/postdisciplinas#/admin/postdisciplinas')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Disciplinas/Actividades</span></a>
            </li>
            @endif
        </ul>
      </li>

    @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
    <li>
        @if(Auth::user()->numero_documento != "20190902")
        <a href="#"><i class="fa fa-group" aria-hidden="false">
        <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Gest. Beneficiarios</span><span class="fa arrow"></span><span
                class="label label-yellow"></span></a>
        @endif
        <ul class="nav nav-second-level">
            <li><a href="{{url('/admin/postbeneficiarios#/admin/postbeneficiarios')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Listar Beneficiarios</span></a>
            </li>
        </ul>
    </li>
    @endif
    <li>
      @if(Auth::user()->numero_documento != "20190902")
        <a href="#"><i class="fa fa-th-large" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
            </i><span class="menu-title">Gest. Grupos</span><span class="fa arrow"></span><span
            class="label label-yellow"></span></a>
      @endif
        <ul class="nav nav-second-level">
            @if(auth()->user()->can('ver-grupos') || auth()->user()->can('crear-grupos') || auth()->user()->can('editar-grupos') || auth()->user()->can('eliminar-grupos'))
            <li><a href="{{url('/admin/postgrupos#/admin/postgrupos')}}"><i class="fa fa-list-ol"></i><span
            class="submenu-title">Crear Grupos</span></a>
            </li>
            @endif


            @if(auth()->user()->can('ver-grupo') || auth()->user()->can('crear-grupo') || auth()->user()->can('editar-grupo') || auth()->user()->can('eliminar-grupo'))
            <li><a href="{{url('/admin/postgruposprogramas#/admin/postgruposprogramas')}}"><i class="fa fa-list-ol"></i><span
            class="submenu-title">Crear Grupos</span></a>
            </li>
            @endif


            @if(auth()->user()->can('reasignación-grupos'))
            <li><a href="{{url('/admin/postgrupos#/admin/postgrupos/reasignacion')}}"><i class="fa fa-list-ol"></i><span
            class="submenu-title">Reasignación Grupos</span></a>
            </li>
            @endif

            @if(auth()->user()->can('reasignación-grupo'))
            <li><a href="{{url('/admin/postgruposprogramas#/admin/postgruposprogramas/reasignacion')}}"><i class="fa fa-list-ol"></i><span
            class="submenu-title">Reasignación Grupos</span></a>
            </li>
            @endif

        </ul>
    </li>

    @if(auth()->user()->can('ver-georreferenciación'))
    @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
    <li>
        <a href="{{url('/admin/postlocalizacion#/admin/postlocalizacion')}}"><i class="fa fa-codepen" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
            </i><span class="menu-title">Reportes Por Comuna</span><span class="fa arrow"></span><span
            class="label label-yellow"></span>
        </a>
    </li>
    @endif
    @endif
    @if(auth()->user()->can('ver-consultas'))
    <li>
        <a href="#"><i class="fa fa-th-large" aria-hidden="false">
        <div class="icon-bg bg-orange"></div>
        </i><span class="menu-title">Reportes y Consultas</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        <ul class="nav nav-second-level">
            @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/usuarios/reportegeneral')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Reporte Beneficiarios</span></a>
            </li>
            @endif
            @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postreportedetallado#/admin/postreportedetallado')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Reporte Asistencias</span></a>
            </li>
            @endif
            @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postconsultaevaluaciones#/admin/postconsultaevaluaciones')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Consulta Evaluaciones</span></a>
            </li>
            @endif
            @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postgrupos#/admin/postgrupos/consulta')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Consultas Grupos</span></a>
            </li>
            @endif
            @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
            <li><a href="{{url('/admin/postgrupos#/admin/postgrupos/asistencias')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Consultas Asistencias</span></a>
            </li>
            @endif

            @if(Auth::user()->tenantId != "2767829213" AND Auth::user()->tenantId != "5467829281")
            <li><a href="{{url('/admin/postreportegeneralprogramas#/admin/postreportegeneralprogramas')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Reporte Beneficiarios</span></a>
            </li>
            @endif
            @if(Auth::user()->tenantId != "5467829281" AND Auth::user()->tenantId != "2767829213")
            <li><a href="{{url('/admin/postreportedetalladoprogramas#/admin/postreportedetalladoprogramas')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Consulta Asistencias</span></a>
            </li>
            @endif
            @if(Auth::user()->tenantId != "5467829281" AND Auth::user()->tenantId != "2767829213")
            <li><a href="{{url('/admin/postgruposprogramas#/admin/postgruposprogramas/consulta')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Consultas Grupos</span></a>
            </li>
            @endif




           {{--  @if(Auth::user()->tenantId != "5467829281" || Auth::user()->tenantId != "2767829213")
            <li><a href="{{url('/admin/postgruposprogramas#/admin/postgruposprogramas/asistencias')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Consultas Asistencias</span></a>
            </li>
            @endif --}}
        </ul>
    </li>
    @endif
    @if(auth()->user()->can('criterios-evaluacion'))
    @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
    <li><a href="#"><i class="fa fa-clipboard" aria-hidden="false">
        <div class="icon-bg bg-orange"></div>
         </i><span class="menu-title">Evaluación</span><span class="fa arrow"></span><span
        class="label label-yellow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="{{url('/admin/postcriterios#/admin/postcriterios')}}"><i class="fa fa-list-ol"></i><span
            class="submenu-title">Criterios y Evaluación</span></a>
            </li>
        </ul>
    </li>
    @endif
    @endif
    @if(auth()->user()->can('inventario-colegios'))
    @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
    <li>
        <a href="{{url('/admin/postfichacolegios#/admin/postfichacolegios')}}"><i class="fa fa-codepen" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
            </i><span class="menu-title">Ficha Colegio</span><span class="fa arrow"></span><span
            class="label label-yellow"></span>
        </a>
    </li>
    @endif
    @endif
    @if(auth()->user()->can('inventario-colegios'))
    @if(Auth::user()->tenantId == "5467829281" || Auth::user()->tenantId == "2767829213")
    <li>
        <a href="{{url('/admin/postinventariocolegios#/admin/postinventariocolegios')}}"><i class="fas fa-clipboard-list" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
            </i><span class="menu-title">Inventario Colegios</span><span class="fa arrow"></span><span
            class="label label-yellow"></span>
        </a>
    </li>
    @endif
    @endif
    @if(auth()->user()->can('indicador-metas'))
    <li><a href="#"><i class="fa fa-clipboard" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
             </i><span class="menu-title">Indicadores y metas</span><span class="fa arrow"></span><span
            class="label label-yellow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="{{url('/admin/postmetas#/admin/postmetas')}}"><i class="fa fa-list-ol"></i><span
                class="submenu-title">Ingreso Metas</span></a>
                </li>
                <li><a href="{{url('/admin/postindicadores#/admin/postindicadores')}}"><i class="fa fa-list-ol"></i><span
                    class="submenu-title">Ingreso Indicadores</span></a>
                </li>
            </ul>
    </li>
    @endif


<li>
    @if(Auth::user()->numero_documento != "20190902")
        <a href="{{url('/panelcontrol/index')}}"><i class="fa fa-codepen" aria-hidden="false">
            <div class="icon-bg bg-orange"></div>
            </i><span class="menu-title">Tablero de Control</span><span class="fa arrow"></span><span
            class="label label-yellow"></span>
        </a>
      @endif
    </li>

</div>

@endguest
