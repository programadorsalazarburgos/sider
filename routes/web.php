<?php
  
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| conb

tains the "web" middleware group. Now create something great!
|





*/

Route::get('/graficosestadisticos', 'HomeController@graficos');
Route::get('/importar', 'HomeController@importar');
Route::post('/import-excel', 'HomeController@importUsers');
Route::get('/listar_rol', 'RolController@index');
Route::get('/listar_reporte_general', 'RolController@listar_reporte_general');
Route::post('/rol/registrar', 'RolController@store');
Route::put('/rol/actualizar', 'RolController@update');
Route::put('/rol/desactivar', 'RolController@EliminarRol');
Route::get('/obtener/permisos', 'RolController@permisos');
Route::get('/obtener/permiso_asignado', 'RolController@permisos_asignados');
Route::post('/asignar/permisos', 'RolController@asignar_permisos');
Route::post('/quitar/permiso', 'RolController@quitar_permiso');
Route::get('/limpiar', function() {
phpinfo();
   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});
//aqui
Route::get('/usuarios/{any}', 'SinglePageController@index')->where('any', '.*');
//Clear Cache facade value:limpiar
use App\User;
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('/limpiar-cache', function() {
  $exitCode = Artisan::call('cache:clear');
  return '<h1>Cache facade value cleared</h1>';
});
//Reoptimized class loader:
Route::get('/optimizar', function() {
  $exitCode = Artisan::call('optimize');
  return '<h1>Reoptimized class loader</h1>';
});
//Route cache:
Route::get('/route-cache', function() {
  $exitCode = Artisan::call('route:cache');
  return '<h1>Routes cached</h1>';
});
//Clear Route cache:
Route::get('/route-clear', function() {
  $exitCode = Artisan::call('route:clear');
  return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/limpiar-vista', function() {
  $exitCode = Artisan::call('view:clear');
  return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
  $exitCode = Artisan::call('config:cache');
  return '<h1>Clear Config cleared</h1>';
});

Route::get("panelcontrol/index", "PanelControlController@index")->middleware('auth');
Route::get("panelcontrol/datos", "PanelControlController@PanelControl")->middleware('auth');
Route::get("panelcontrol2/datos", "PanelControlController@PanelControl2")->middleware('auth');
Route::get("panelcontrol3/datos", "PanelControlController@PanelControl3")->middleware('auth');
Route::get("panelcontrol4/datos", "PanelControlController@PanelControl4")->middleware('auth');

Route::get('/prueba', function () {
  $usuarios = User::select('users.primer_nombre')->leftjoin('role_user', 'role_user.user_id', '=', 'users.id')->where('tenantId', '=', 2288251678)->whereNull('role_user.user_id')->get();
  foreach ($usuarios as $value) {
    $value->delete();
  }
});


//Select Reutilizables
Route::get('/api/v0/obtenerselect/tipo_documento/', 'SelectedController@ObtenerTipoDocumento');
Route::get('/obtenerselect/tipo_documento/', 'SelectedController@ObtenerTipoDocumento2');
Route::get('/api/v0/obtener/corregimientos/', 'SelectedController@ObtenerCorregimientos');
Route::get('/obtener/corregimientos/', 'SelectedController@ObtenerCorregimientos2');
Route::get('/api/v0/obtener/veredas/{id}', 'SelectedController@ObtenerVeredas');
Route::get('/api/v0/obtener/estados_civiles', 'SelectedController@ObtenerEstadosCiviles');
Route::get('/api/v0/obtenerselect/salud_sgsss', 'SelectedController@ObtenerSaludEps');
Route::get('/api/v0/obtenerselect/allGrupos_poblacionales', 'SelectedController@ObtenerGruposPoblacional');
Route::get('/api/v0/obtenerselect/allGrupos_disciplinas', 'SelectedController@ObtenerGruposDisciplina');
Route::get('/api/v0/obtenerselect/discapacidad', 'SelectedController@ObtenerDiscapacidades');
Route::get('/obtenerselect/discapacidad', 'SelectedController@ObtenerDiscapacidades2');
Route::get('/api/v0/obtenerselect/estrato/{id}', 'SelectedController@ObtenerEstratoBarrio');
Route::get('/api/v0/obtener/modalidades', 'SelectedController@ObtenerModalidades');
Route::get('/api/v0/obtener/puntosatencion', 'SelectedController@ObtenerPuntosAtencion');
Route::get('/api/v0/obtener/ocupaciones', 'SelectedController@ObtenerOcupaciones');
Route::get('/api/v0/obtener/barrios', 'PostGruposController@ObtenerBarriosTotal');
Route::get('/obtener/barrios', 'PostGruposController@ObtenerBarriosTotal2');
Route::get('/api/v0/obtenerselect/EstadoEscolaridades', 'PostGruposController@ObtenerEstadoEscolaridades');
Route::get('/api/v0/obtenerselect/universidades', 'PostGruposController@Universidades');
Route::get('/api/v0/obtenerselect/culturas', 'PostGruposController@ObtenerEtnias');
Route::get('/obtenerselect/culturas', 'PostGruposController@ObtenerEtnias2');
Route::get('/api/v0/obtenerselect/afiliaciones', 'PostGruposController@Afiliaciones');
Route::get('/api/v0/obtener/programaselect', 'SelectedController@ObtenerProgramaSelect');
Route::get('/api/v0/obtener/titulos', 'SelectedController@ObtenerTitulos');
Route::get('/api/v0/obtenerusuarios/all', 'SelectedController@ObtenerUsuariosAll');
Route::get('/api/v0/obtener/clubesdeportivos', 'SelectedController@clubesdeportivos');
Route::get('/api/v0/obtener/nombre_ahdi/{id}', 'SelectedController@nombre_ahdi');
//Datos para index sider mi comunidad
Route::get('/api/v0/obtener/escenarios', 'HomeController@TotalEscenarios');
Route::get('/api/v0/obtener/disciplinassider', 'HomeController@TotalDisciplinas');
Route::get('/api/v0/obtener/usuarios_micomunidad', 'HomeController@TotalUsuarios');
Route::get('/api/v0/obtener/colegios_micomunidad', 'HomeController@TotalColegios');
Route::get('/api/v0/cantidad/sedes_sider', 'HomeController@TotalSedes');
Route::get('/api/v0/obtener/metasprograma/{programa}', 'HomeController@ObtenerMetasPrograma');
Route::get('/api/v0/obtener/programasTotal', 'HomeController@TotalProgramas');
Route::get('/api/v0/obtener/totalbeneficiarios', 'HomeController@TotalBeneficiarios');
Route::get('/api/v0/obtener/programasbeneficiarios', 'HomeController@TotalProgramasBeneficiarios');
Route::get('/api/v0/obtener/comunasbeneficiarios', 'HomeController@TotalComunasBeneficiarios');
// Route::get('/grupos/{slug}', 'HomeController@show');
Route::get('/index/{slug}', 'HomeController@show')->where('slug', '.*');
//Fin
 //Route::get("/", "HomeController@index");
Route::get('items', 'ItemController@index');
Route::get('items/export', 'ItemController@export');
Route::get('export/parrilla_grupos', 'ItemController@export_parrilla_grupos');
Route::get('export/completoinforme', 'ItemController@exportInformeCompleto');
Route::get('export/tipodocumento', 'ItemController@exportTipoDocumento');
Route::get('export/modalidad', 'ItemController@exportModalidad');
Route::get('export/puntoatencion', 'ItemController@exportPuntoAtencion');
Route::get('export/fechainscripcion', 'ItemController@exportFechaInscripcion');
Route::get('export/sexo', 'ItemController@exportSexo');
Route::get('export/edad', 'ItemController@exportEdad');
Route::get('export/estrato', 'ItemController@exportEstrato');
Route::get('export/comuna', 'ItemController@exportComuna');
Route::get('export/corregimiento', 'ItemController@exportCorregimiento');
Route::get('export/hijos', 'ItemController@exportHijos');
Route::get('export/ocupacion', 'ItemController@exportOcupacion');
Route::get('export/escolaridad', 'ItemController@exportEscolaridad');
Route::get('export/cultura', 'ItemController@exportCultura');
Route::get('export/discapacidad', 'ItemController@exportDiscapacidad');
Route::get('export/reportedetallado', 'ItemController@exportDetallado');
Route::get('/api/v0/obtener/beneficiariodetallado', 'ItemController@BeneficiariosDetallado');
Route::get('/api/v0/obtener/beneficiariosgeneral', 'ItemController@BeneficiariosGeneral');//jsb
Route::get('/export/reportgeneral', 'ItemController@ExportBeneficiariosGeneral');
Route::get('items/export_evaluacion/{no_grupo}', 'ItemController@ExportEvaluacionGrupo');
Route::get('items/exportpromedio/{id}', 'ItemController@ExportPromedioBeneficiario');
Route::get('export/parrilla', 'ItemController@ExportarParrilla');
Route::get('export/parrilla2', 'ItemController@ExportarParrilla2');
Route::get('items/export2', 'ItemController@export2');
Route::get('items/asistenciaprogramas', 'ItemController@asistenciaprogramas');
Route::get('items/export_misbeneficiario/{no_grupo}', 'ItemController@ExportMisBeneficiarios');
Route::get('items/exportAsistencia', 'ItemController@exportAsistencia');
Route::get("/", "HomeController@vista");
Route::get('index-sider', function () {
  return view('postsider.index');
});
Route::get('descripcion-programas', function () {
  return view('postsider.descripcion');
});
Route::get('/api/v0/programas', 'HomeController@ObtenerProgramas');
Route::get('/api/v0/{id}', 'HomeController@DescripcionPrograma');
Auth::routes();


//Inicio Roles y Permisos

Route::get('admin/postroles', 'PostRolesController@vista');
Route::get('index-roles', function () {
  return view('postroles.index');
})->middleware('permission:ver-roles');
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postroles", "PostRolesController@index");
});
Route::get('permisos-roles', function () {
  return view('postroles.permisos');
});
Route::get('twinList', function () {
  return view('postroles.twinList');
});
Route::get('/api/v0/admin/postroles/{id}', 'PostRolesController@ObtenerRol');
Route::get('/api/v0/ObtenerPermisos/Rol/{id}', 'PostRolesController@ObtenerPermisosId');
Route::get('/api/v0/ObtenerPermisos/Rol/', 'PostRolesController@ObtenerPermisosTotal');
Route::post('/creacionpermisos/rol/{id}', 'PostRolesController@CrearPermisosRole');
Route::post('/eliminarpermisos/rol/{id}', 'PostRolesController@EliminarPermisosRole');
Route::post('/api/v0/guardar/rol', 'PostRolesController@CrearRol');
Route::post('/api/v0/eliminar/rol/{id}', 'PostRolesController@EliminarRol');
Route::get('/api/v0/obtener/rol/{id}', 'PostRolesController@ObtenerRolUsuario');
Route::post('/api/v0/actualizar/rol/{id}', 'PostRolesController@ActualizarRol');
Route::post('/api/v0/admin/postreporteficha', 'ItemController@ExportBeneficiariosGeneral');
Route::get('/admin/postreporteficha', 'ItemController@ExportBeneficiariosGeneral2');
Route::get('/exportar/información_programas1', 'ItemController@ExportBeneficiariosGeneral2');
Route::get('/generar_total', 'ItemController@generar_total');
Route::post('/api/v0/admin/postreportefichaProgramas', 'ItemController@ExportBeneficiariosGeneralProgramas');

//Fin Roles y Permisos

//Inicio Usuario


Route::get('admin/postusuarios', 'PostUsuariosController@vista');
Route::get('index-usuarios', function () {
  return view('postusuarios.index');
})->middleware('permission:ver-usuarios');

Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postusuarios", "PostUsuariosController@index");
});
Route::get('create-usuarios', function () {
  return view('postusuarios.create');
});
Route::get('editar-usuarios', function () {
  return view('postusuarios.editar');
});

Route::get('editar-usuarios-perfil', function () {
  return view('postusuarios.editarperfil');
});

Route::get('mostrar-usuarios', function () {
  return view('postusuarios.mostrar');
});
Route::get('cambiar-clave', function () {
  return view('postusuarios.resetear');
});
Route::get('/api/v0/obtenerselect/roles/', 'PostUsuariosController@ObtenerRoles');
Route::post('/api/v0/guardar/usuario', 'PostUsuariosController@CrearUsuario');
Route::get('/api/v0/admin/postusuarios/{id}', 'PostUsuariosController@ObtenerUsuario');
Route::get('/api/v0/obtenerselect/rol/{id}', 'PostUsuariosController@ObtenerRolID');
Route::post('/api/v0/actualizar/usuario/{id}', 'PostUsuariosController@ActualizarUsuario');
Route::post('/api/v0/actualizar/clave/{id}', 'PostUsuariosController@ActualizarClave');
Route::post('/api/v0/eliminar/usuario/{id}', 'PostUsuariosController@EliminarUsuario');
Route::post('/api/v0/quitarRol/usuario/{id}', 'PostUsuariosController@QuitarRol');
Route::get('/api/v0/verificar/correo_usuario', 'PostUsuariosController@CorreoUsuario');
Route::get('/api/v0/verificar/documento_usuario/{id}', 'PostUsuariosController@DocumentoUsuario');
Route::get('/api/v0/obtener/tipodocumento_usuario/{id}', 'PostUsuariosController@ObtenerTipoDocumento');
Route::get('usuarios/exportacion', 'ItemController@ExportUsuarios');
Route::get('/api/v0/usuarios/exportacion/', 'ItemController@exportar_usuarios');

//Fin Usuarios

//Inicio Programas

Route::get('admin/postprogramas', 'PostProgramasController@vista');
Route::get('index-programas', function () {
  return view('postprogramas.index');
})->middleware('permission:ver-programas');
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postprogramas", "PostProgramasController@index");
});
Route::get('create-programas', function () {
  return view('postprogramas.create');
});
Route::get('editar-programas', function () {
  return view('postprogramas.editar');
});
Route::post('/api/v0/postprograma/create', 'PostProgramasController@CrearPrograma');
Route::get('/api/v0/admin/postprogramas/{id}', 'PostProgramasController@ObtenerPrograma');
Route::post('/api/v0/postprogramas/editarPrograma/{id}', 'PostProgramasController@EditarPrograma');
Route::post('/api/v0/eliminar/programa/{id}', 'PostProgramasController@EliminarPrograma');
//Fin Programas

//Inicio Zonas
Route::get('admin/postzonas', 'PostZonasController@vista');
Route::get('index-zonas', function () {
  return view('postzonas.index');
})->middleware('permission:ver-zonas');
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postzonas", "PostZonasController@index");
});
Route::get('create-zonas', function () {
  return view('postzonas.create');
});

Route::get('editar-zonas', function () {
  return view('postzonas.editar');
});
Route::post('/api/v0/postzona/create', 'PostZonasController@CrearZona');
Route::get('/api/v0/admin/postzonas/{id}', 'PostZonasController@ObtenerZona');
Route::post('/api/v0/postzonas/editarZona/{id}', 'PostZonasController@EditarZona');
Route::post('/api/v0/eliminar/zona/{id}', 'PostZonasController@EliminarZona');
//Fin Zonas


//Inicio Comunas

Route::get('admin/postcomunas', 'PostComunasController@vista');
Route::get('index-comunas', function () {
  return view('postcomunas.index');
})->middleware('permission:ver-comunas');
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postcomunas", "PostComunasController@index");
});
Route::get('create-comunas', function () {
  return view('postcomunas.create');
});
Route::get('editar-comunas', function () {
  return view('postcomunas.editar');
});
Route::post('/api/v0/postcomuna/create', 'PostComunasController@CrearComuna');
Route::get('/api/v0/admin/postcomunas/{id}', 'PostComunasController@ObtenerComuna');
Route::post('/api/v0/postcomunas/editarComuna/{id}', 'PostComunasController@EditarComuna');
Route::post('/api/v0/eliminar/comuna/{id}', 'PostComunasController@EliminarComuna');
Route::get('/api/v0/obtenerselect/zonas/', 'PostComunasController@ObtenerZonas');
Route::get('/api/v0/obtenerselect/zona/{id}', 'PostComunasController@ObtenerZonaID');
//Fin Comunas


//Inicio Barrios

Route::get('admin/postbarrios', 'PostBarriosController@vista');
Route::get('index-barrios', function () {
  return view('postbarrios.index');
})->middleware('permission:ver-barrios');
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postbarrios", "PostBarriosController@index");
});
Route::get('create-barrios', function () {
  return view('postbarrios.create');
});
Route::get('editar-barrios', function () {
  return view('postbarrios.editar');
});
Route::post('/api/v0/postbarrio/create', 'PostBarriosController@CrearBarrio');
Route::get('/api/v0/admin/postbarrios/{id}', 'PostBarriosController@ObtenerBarrio');
Route::post('/api/v0/postbarrios/editarBarrio/{id}', 'PostBarriosController@EditarBarrio');
Route::post('/api/v0/eliminar/barrio/{id}', 'PostBarriosController@EliminarBarrio');
Route::get('/api/v0/obtenerselect/comunas/', 'PostBarriosController@ObtenerComunas');
Route::get('/obtenerselect/comunas/', 'PostBarriosController@ObtenerComunas2');

Route::get('/api/v0/obtenerselect/comuna/{id}', 'PostBarriosController@ObtenerComunaID');

//Fin Barrios



//Inicio Instituciones

Route::get('admin/postinstituciones', 'PostInstitucionesController@vista');
Route::get('index-instituciones', function () {
  return view('postinstituciones.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postinstituciones", "PostInstitucionesController@index");
});
Route::get('create-instituciones', function () {
  return view('postinstituciones.create');
});
Route::get('editar-instituciones', function () {
  return view('postinstituciones.editar');
});
Route::post('/api/v0/postinstitucion/create', 'PostInstitucionesController@CrearInstitucion');
Route::get('/api/v0/admin/postinstituciones/{id}', 'PostInstitucionesController@ObtenerInstitucionId');
Route::post('/api/v0/postinstituciones/editarInstitucion/{id}', 'PostInstitucionesController@EditarInstitucion');
Route::get('/api/v0/obtenerselect/barrios/', 'PostInstitucionesController@ObtenerBarrios');
Route::get('/api/v0/obtenerselect/barrio/{id}', 'PostInstitucionesController@ObtenerBarrioID');
Route::post('/api/v0/eliminar/institucion/{id}', 'PostInstitucionesController@EliminarInstitucion');
Route::get('/api/v0/obtenerselect/barrios/{id}', 'PostInstitucionesController@obtenerbarriosID');
Route::get('/api/v0/obtenerselect/comunabarrio/{id}', 'PostInstitucionesController@obtenerBarrioComunaID');


Route::get('/api/v0/obtener/corregimientoInstitucion/{id}
', 'PostInstitucionesController@ObtenerCorregimientoInstitucion');

//Fin Instituciones


//Inicio Sede

Route::get('admin/postsedes', 'PostSedesController@vista');
Route::get('index-sedes', function () {
  return view('postsedes.index');
})->middleware('permission:ver-sedes');
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postsedes", "PostSedesController@index");
});
Route::get('create-sedes', function () {
  return view('postsedes.create');
});
Route::get('editar-sedes', function () {
  return view('postsedes.editar');
});
Route::post('/api/v0/postsede/create', 'PostSedesController@CrearSede');
Route::get('/api/v0/admin/postsedes/{id}', 'PostSedesController@ObtenerSede');
Route::post('/api/v0/postsedes/editarSede/{id}', 'PostSedesController@EditarSede');
Route::post('/api/v0/eliminar/sede/{id}', 'PostSedesController@EliminarSede');
Route::get('/api/v0/obtenerselect/instituciones/', 'PostSedesController@ObtenerInstituciones');
Route::get('/obtenerselect/instituciones/', 'PostSedesController@ObtenerInstituciones2');



Route::get('/api/v0/obtenerselect/institucion/{id}', 'PostSedesController@ObtenerInstitucionID');
Route::get('/api/v0/obtener/sedes_sider', 'PostSedesController@obtener_sedes');

//Fin Sede


//Inicio Tipo Escenario

Route::get('admin/posttipoescenarios', 'PostTipoEscenariosController@vista');
Route::get('index-tipoescenarios', function () {
  return view('posttipoescenarios.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/posttipoescenarios", "PostTipoEscenariosController@index");
});
Route::get('create-tipoescenarios', function () {
  return view('posttipoescenarios.create');
});
Route::get('editar-tipoescenarios', function () {
  return view('posttipoescenarios.editar');
});
Route::post('/api/v0/posttipoescenario/create', 'PostTipoEscenariosController@CrearTipoEscenario');
Route::get('/api/v0/admin/posttipoescenarios/{id}', 'PostTipoEscenariosController@ObtenerTipoEscenario');
Route::post('/api/v0/posttipoescenarios/editarTipoEscenario/{id}', 'PostTipoEscenariosController@EditarTipoEscenario');
Route::post('/api/v0/eliminar/tipoescenario/{id}', 'PostTipoEscenariosController@EliminarTipoEscenario');
//Fin Tipo Escenario



//Inicio Escenario

Route::get('admin/postescenarios', 'PostEscenariosController@vista');
Route::get('index-escenarios', function () {
  return view('postescenarios.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postescenarios", "PostEscenariosController@index");
});
Route::get('create-escenarios', function () {
  return view('postescenarios.create');
});
Route::get('editar-escenarios', function () {
  return view('postescenarios.editar');
});
Route::post('/api/v0/postescenario/create', 'PostEscenariosController@CrearEscenario');
Route::get('/api/v0/admin/postescenarios/{id}', 'PostEscenariosController@ObtenerEscenario');
Route::post('/api/v0/postescenarios/EditarEscenario/{id}', 'PostEscenariosController@EditarEscenario');
Route::post('/api/v0/eliminar/escenario/{id}', 'PostEscenariosController@EliminarEscenario');
Route::get('/api/v0/obtenerselect/tipoescenarios/', 'PostEscenariosController@ObtenerTipoEscenarios');
Route::get('/api/v0/obtenerselect/tipoescenario/{id}', 'PostEscenariosController@ObtenerTipoEscenarioID');
Route::get('/api/v0/obtenerselect/sedes', 'PostEscenariosController@ObtenerSedes');
Route::get('/obtenerselect/sedes', 'PostEscenariosController@ObtenerSedes2');


Route::get('/api/v0/obtenerselect/sede/{id}', 'PostEscenariosController@ObtenerSedeID');



//Fin Escenario


//Inicio Grupos

Route::get('admin/postgrupos', 'PostGruposController@vista');
Route::get('index-grupos', function () {
  return view('postgrupos.index');
})->middleware('permission:ver-grupos');;
Route::group(["prefix" => "api/v0"], function () {

  Route::get("admin/postgrupos", "PostGruposController@index");
  Route::get("admin/postgrupos/consulta", "PostGruposController@ConsultaGrupos");
  Route::get("admin/postgrupos/consultausuario/{usuario}", "PostGruposController@ConsultaGruposUsuario");


});

Route::get('create-grupos', function () {
  return view('postgrupos.create');
});
Route::get('editar-grupos', function () {
  return view('postgrupos.editar');
});

Route::get('beneficiario-grupos', function () {
  return view('postgrupos.beneficiario');
});

Route::get('beneficiario-grupos-programas', function () {
  return view('postgrupos.beneficiarios');
});

Route::get('beneficiario-grupos-viactiva', function () {
  return view('postgrupos.beneficiariosvct');
});


Route::get('beneficiario-grupos2', function () {
  return view('postgrupos.beneficiario2');
});
Route::get('misbeneficiarios-grupos', function () {
  return view('postgrupos.misbeneficiarios');
});

Route::get('misbeneficiarios-grupos-consulta', function () {
  return view('postgrupos.misbeneficiariosconsulta');
});

Route::get('grupos-consulta-asistencia', function () {
  return view('postgrupos.misbeneficiariosasistencias');
});

Route::get('asistencias-grupos', function () {
  return view('postgrupos.misasistencias');
});

Route::get('editar-mibeneficiario', function () {
  return view('postgrupos.editarmibeneficiario');
});

Route::get('editar-mibeneficiariopr', function () {
  return view('postgrupos.editarmibeneficiariopr');
});

Route::get('editar-viactiva', function () {
  return view('postgrupos.editarmibeneficiariov');
});

Route::get('infoasistencias-grupos', function () {
  return view('postgrupos.infoasistencias');
});

Route::get('grupos-consulta', function () {
  return view('postgrupos.consulta');
});

Route::get('informacion-grupo', function () {
  return view('postgrupos.informacion');
});

Route::get('grupos-reasignacion', function () {
  return view('postgrupos.reasignacion');
});

Route::post('/api/v0/reasignacion/grupo/{grupo}', 'PostGruposController@ReasignarGrupo');
Route::get('/api/v0/obtenercount/grupos', 'PostGruposController@ObtenerCountGrupos');
Route::get('/api/v0/obtenerusuario/monitor', 'PostGruposController@ObtenerMonitor');
Route::post('/api/v0/postgrupo/create', 'PostGruposController@CrearGrupo');
Route::get('/api/v0/admin/postgrupos/{id}', 'PostGruposController@ObtenerGrupo');
Route::get('/api/v0/obtenerselect/SedeGrupo/{id}', 'PostGruposController@ObtenerSedeGrupoID');
Route::get('/api/v0/obtener/GrupoHorario/{id}', 'PostGruposController@ObtenerGrupoHorarioID');
Route::get('/api/v0/obtener/programas', 'PostGruposController@ObtenerProgramas');
Route::get('/api/v0/obtener/paises', 'PostGruposController@ObtenerPaises');
Route::get('/api/v0/obtener/departamentos/{id}', 'PostGruposController@ObtenerDepartamentos');
Route::get('/api/v0/obtener/municipios/{id}', 'PostGruposController@ObtenerMunicipios');
Route::get('/api/v0/obtener/barrios/{id}', 'PostGruposController@ObtenerBarrios');
Route::post('/api/v0/postgrupo/actualizar/{id}', 'PostGruposController@ActualizarGrupo');
Route::post('/api/v0/postbeneficiario/create/{id}', 'PostGruposController@CrearBeneficiarioGrupo');
Route::post('/api/v0/postbeneficiarioprograma/create/{id}', 'PostGruposController@CrearBeneficiarioGrupoPrograma');


Route::post('/api/v0/postbeneficiario/createpersonal', 'PostGruposController@CrearPersonal');
Route::post('/api/v0/postbeneficiario/createpersonaldeporte', 'PostGruposController@CrearPersonalDeporte');
Route::post('/api/v0/postbeneficiario/createpersonalcaliacoge', 'PostGruposController@CrearPersonalCaliacoge');
Route::post('/api/v0/postbeneficiario/createpersonalcalisedivierte', 'PostGruposController@CrearPersonalCalisedivierte');

Route::post('/api/v0/postbeneficiario/createpersonalcalintegra', 'PostGruposController@CrearPersonalCalintegra');
Route::post('/api/v0/postbeneficiario/createpersonalcanasyganas', 'PostGruposController@CrearPersonalCanasyganas');
Route::post('/api/v0/postbeneficiario/createpersonalcarrerasycaminatas', 'PostGruposController@CrearPersonalCarrerasycaminatas');
Route::post('/api/v0/postbeneficiario/createpersonalcuerpoyespiritu', 'PostGruposController@CrearPersonalCuerpoyespiritu');

Route::post('/api/v0/postbeneficiario/createpersonaldeporteasociado', 'PostGruposController@CrearPersonalDeporteasociado');

Route::post('/api/v0/postbeneficiario/createpersonaldeportecomunitario', 'PostGruposController@CrearPersonalDeportecomunitario');

Route::post('/api/v0/postbeneficiario/createpersonalvertigo', 'PostGruposController@CrearPersonalVertigo');

Route::post('/api/v0/postbeneficiario/createpersonalviactiva', 'PostGruposController@CrearPersonalViactiva');

Route::post('/api/v0/postbeneficiario/createpersonalviveelparque', 'PostGruposController@CrearPersonalViveelparque');


Route::get('/api/v0/obtener/misbeneficiarios/{id}', 'PostGruposController@ObtenerMisBeneficiarios');
Route::get('/api/v0/obtener/misbeneficiariosprograma/{id}', 'PostGruposController@ObtenerMisBeneficiariosPrograma');



Route::get('/api/v0/obtener/misbeneficiariosconsulta/{id}', 'PostGruposController@ObtenerMisBeneficiariosConsulta');
Route::get('/api/v0/obtener/allgruposmonitor', 'PostGruposController@ObtenerAllGrupos');
Route::post('/api/v0/eliminar/grupo_monitor/{id}', 'PostGruposController@EliminarGrupo');
Route::post('/api/v0/sacar/grupo_beneficiario/{id}', 'PostGruposController@EliminarGrupoBeneficiario');
Route::post('/api/v0/sacar/beneficiario/{id}', 'PostGruposController@SacarGrupoBeneficiarioPrograma');

Route::post('/api/v0/asistencias/create/{id}', 'PostGruposController@CrearAsistencias');
Route::post('/api/v0/asistenciasprogramas/create/{id}', 'PostGruposController@CrearAsistenciasProgramas');
Route::get('/api/v0/obtener/asistencia/{id}', 'PostGruposController@ObtenerAsistencias');
Route::get('/api/v0/obtener/asistenciaprograma/{id}', 'PostGruposController@ObtenerAsistenciasPrograma');


Route::post('/api/v0/asistencias/update/{id}', 'PostGruposController@UpdateAsistencias');

Route::post('/api/v0/asistenciasprogramas/update/{id}', 'PostGruposController@UpdateAsistenciasProgramas');



Route::get('/api/v0/obtenerselect/grado/{id}', 'PostGruposController@ObtenerGrado');
Route::get('/api/v0/obtener/nombre_grupo/{id}', 'PostGruposController@ObtenerNombreGrupo');
Route::get('/api/v0/obtener/nombre_grupoprograma/{id}', 'PostGruposController@ObtenerNombreGrupoPrograma');


Route::get('/api/v0/obtener/misasistencias/{ficha}/{grupo}', 'PostGruposController@ObtenerMiAsistencia');

Route::get('/api/v0/obtener/misasistenciasprogramas/{ficha}/{grupo}', 'PostGruposController@ObtenerMiAsistenciaPrograma');







Route::get('/api/v0/obtener/nombre_beneficiario/{id}', 'PostGruposController@ObtenerNombreBeneficiario');

Route::get('/api/v0/obtener/nombre_beneficiarioprograma/{id}', 'PostGruposController@ObtenerNombreBeneficiarioPrograma');




Route::get('/api/v0/obtenergrupos/monitor', 'PostGruposController@ObtenerGrupoMonitor');

Route::get('/api/v0/obtenergruposprogramas/monitor', 'PostGruposController@ObtenerGrupoMonitorPrograma');


Route::get('/api/v0/obtenergrupos/all', 'PostGruposController@ObtenerGruposAll');
Route::get('/api/v0/horario/grupos/{id}', 'PostGruposController@HorarioGrupos');
Route::post('/api/v0/admin/postgrupos/inactivar/{id}', 'PostGruposController@InactivarGrupo');
Route::post('/api/v0/admin/postgrupos/activar/{id}', 'PostGruposController@ActivarGrupo');
Route::post('/api/v0/eliminar/GrupoHorario', 'PostGruposController@EliminarGrupoHorario');
Route::get('/api/v0/obtener/misbeneficiariosasistencias', 'PostGruposController@ObtenerMisBeneficiariosAsistencias');
Route::get('/api/v0/obtener/estrato/{id}', 'PostGruposController@ObtenerEstrato');
Route::get('/api/v0/obtener/estratoVereda/{id}', 'PostGruposController@ObtenerEstratoVereda');




//Fin Grupos

//Inicio Beneficiarios

Route::get('admin/postbeneficiarios', 'PostBeneficiariosController@vista');
Route::get('index-beneficiarios', function () {
  return view('postbeneficiarios.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postbeneficiarios", "PostBeneficiariosController@index");
Route::get("admin/postbeneficiariosprogramas", "PostBeneficiariosController@index_programas");
  Route::get("admin/postbeneficiarioslistado", "PostBeneficiariosController@listado");
});
Route::get('create-beneficiarios', function () {
  return view('postbeneficiarios.create');
});
Route::get('editar-beneficiarios', function () {
  return view('postbeneficiarios.editar');
});
Route::post('/api/v0/postbeneficiario/create', 'PostBeneficiariosController@CrearBeneficiario');

Route::get('/api/v0/admin/postbeneficiarios/{id}', 'PostBeneficiariosController@ObtenerBeneficiario');

Route::get('/api/v0/admin/postbeneficiario/ficha/{id}', 'ReporteFichaController@ObtenerBeneficiarioFicha');

Route::get('/api/v0/admin/postbeneficiarios/cargar/{id}', 'PostBeneficiariosController@CargarBeneficiario');



Route::get('/api/v0/admin/postbeneficiariosprogramas/cargar/{id}', 'PostBeneficiariosController@CargarBeneficiarioPrograma');

Route::get('/api/v0/admin/postpersona/cargar/{id}', 'PostPersonalController@CargarPersona');

Route::get('/api/v0/admin/postbeneficiarios/cargarAcudiente/{id}', 'PostBeneficiariosController@CargarBeneficiarioAcudiente');

Route::get('/api/v0/admin/cargaficha/{id}', 'PostBeneficiariosController@CargarFicha');
Route::get('/api/v0/admin/cargafichaprograma/{id}', 'PostBeneficiariosController@CargarFichaPrograma');

Route::get('/api/v0/obtener/programa/{id}', 'PostBeneficiariosController@ObtenerPrograma');
Route::get('/api/v0/obtener/pais/{id}', 'PostBeneficiariosController@ObtenerPais');
Route::get('/api/v0/obtener/departamento/{id}', 'PostBeneficiariosController@ObtenerDepartamento');
Route::get('/api/v0/obtener/municipio/{id}', 'PostBeneficiariosController@ObtenerMunicipio');
Route::get('/api/v0/obtener/comuna/{id}', 'PostBeneficiariosController@ObtenerComuna');
Route::get('/api/v0/obtener/barrio/{id}', 'PostBeneficiariosController@ObtenerBarrio');
Route::get('/api/v0/obtener/tipodocumento/{id}', 'PostBeneficiariosController@ObtenerTipoDocumento');
Route::get('/api/v0/obtener/sexo/{id}', 'PostBeneficiariosController@ObtenerSexo');
Route::get('/api/v0/obtener/civil/{id}', 'PostBeneficiariosController@ObtenerCivil');
Route::get('/api/v0/obtener/hijos/{id}', 'PostBeneficiariosController@ObtenerHijos');
Route::get('/api/v0/obtener/tiposangre/{id}', 'PostBeneficiariosController@ObtenerTipoSangre');
Route::get('/api/v0/obtener/ocupacion/{id}', 'PostBeneficiariosController@ObtenerOcupacion');
Route::get('/api/v0/obtener/escolaridad/{id}', 'PostBeneficiariosController@ObtenerEscolaridad');
Route::get('/api/v0/obtener/cultura/{id}', 'PostBeneficiariosController@ObtenerCultura');
Route::get('/api/v0/obtener/poblacionales/{id}', 'PostBeneficiariosController@ObtenerPoblacionales');
Route::get('/api/v0/obtener/poblacionalesprogramas/{id}', 'PostBeneficiariosController@ObtenerPoblacionalesProgramas');
Route::get('/api/v0/obtener/poblacionalesDocumento/{id}', 'PostBeneficiariosController@ObtenerPoblacionalesDocumento');
Route::get('/api/v0/obtenerPrograma/poblacionalesDocumento/{id}', 'PostBeneficiariosController@ProgramaPoblacionalesDocumento');
Route::get('/api/v0/obtener/discapacidadesDocumento/{id}', 'PostBeneficiariosController@ObtenerDiscapacidadesDocumento');

Route::get('/api/v0/obtenerPrograma/discapacidadesDocumento/{id}', 'PostBeneficiariosController@ProgramaDiscapacidadesDocumento');


Route::get('/api/v0/obtener/discapacidadesFicha/{id}', 'PostBeneficiariosController@ObtenerDiscapacidadesFicha');
Route::get('/api/v0/obtener/discapacidadesPrograma/{id}', 'PostBeneficiariosController@ObtenerDiscapacidadesPrograma');


Route::post('/api/v0/postbeneficiario/actualizar/{id}', 'PostBeneficiariosController@ActualizarBeneficiario');
Route::post('/api/v0/postbeneficiarioprograma/actualizar/{id}', 'PostBeneficiariosController@ActualizarBeneficiarioPrograma');
Route::get('/api/v0/obtener/discapacidad/{id}', 'PostBeneficiariosController@ObtenerDiscapacidad');
Route::get('/api/v0/obtener/DiscapacidadOtra/{id}', 'PostBeneficiariosController@ObtenerDiscapacidadOtra');
Route::get('/api/v0/obtener/enfermedadpermanente/{id}', 'PostBeneficiariosController@ObtenerEnfermedad');
Route::get('/api/v0/obtener/medicamentopermanente/{id}', 'PostBeneficiariosController@ObtenerMedicamento');
Route::get('/api/v0/obtener/seguridadsocial/{id}', 'PostBeneficiariosController@ObtenerSeguridadSocial');
Route::get('/api/v0/obtener/saludsgss/{id}', 'PostBeneficiariosController@ObtenerSaludSgss');
Route::get('/api/v0/obtener/documentoacudiente/{id}', 'PostBeneficiariosController@ObtenerDocAcudiente');
Route::get('/api/v0/obtener/sexo_acudiente/{id}', 'PostBeneficiariosController@ObtenerSexAcudiente');
Route::get('/api/v0/obtener/parentesco/{id}', 'PostBeneficiariosController@ObtenerParentescoAcudiente');
Route::post('/api/v0/eliminar/grupo/{id}', 'PostBeneficiariosController@EliminarBeneficiarioGrupo');

Route::get('/api/v0/obtener/allmonitores', 'PostBeneficiariosController@ObtenerAllMonitores');

Route::get('/api/v0/obtener/gruposmonitor/{id}', 'PostBeneficiariosController@ObtenerGruposMonitor');
Route::post('/api/v0/postbeneficiario/asociargrupo/{id}', 'PostBeneficiariosController@AsociarGrupoBeneficiario');
Route::post('/api/v0/postbeneficiario/cambiargrupo/{id}', 'PostBeneficiariosController@CambiarGrupoBeneficiario');


Route::post('/api/v0/postbeneficiarioprograma/asociargrupo/{id}', 'PostBeneficiariosController@AsociarGrupoBeneficiario');


Route::get('/api/v0/verificar/ficha_beneficiario
', 'PostBeneficiariosController@FichaBeneficiario');
Route::get('/api/v0/verificar/no_documento_beneficiario
', 'PostBeneficiariosController@DocumentoBeneficiario');

Route::get('/api/v0/obtener/gruposmonitorprogramas
', 'PostBeneficiariosController@obtener_grupos_programas');



Route::post('/api/v0/eliminar/beneficiario/{id}', 'PostBeneficiariosController@EliminarBeneficiario');

Route::get('/api/v0/obtener/corregimiento/{id}
', 'PostBeneficiariosController@ObtenerCorregimiento');


Route::get('/api/v0/obtener/veredas_beneficiario/{id}
', 'PostBeneficiariosController@ObtenerVereda');

Route::get('/api/v0/obtener/vereda_beneficiario/{id}
', 'PostBeneficiariosController@ObtenerVeredaID');

Route::get('/api/v0/obtener/comuna_barrio/{id}
', 'PostBeneficiariosController@ObtenerComunaBarrio');

Route::get('/api/v0/obtenercount/beneficiarios', 'PostBeneficiariosController@ObtenerCountBeneficiarios');

Route::post('/api/v0/eliminar/poblacional/{id}', 'PostBeneficiariosController@EliminarPoblacionalBeneficiario');

Route::post('/api/v0/eliminar/poblacionalPrograma/{id}', 'PostBeneficiariosController@EliminarPoblacionalPrograma');

Route::post('/api/v0/eliminar/poblacionalpersonal/{id}', 'PostPersonalController@EliminarPoblacionalPersonal');
Route::post('/api/v0/eliminar/discapacidad/{id}', 'PostBeneficiariosController@EliminarDiscapacidadPersonal');
Route::post('/api/v0/eliminar/discapacidadBeneficiario/{id}', 'PostBeneficiariosController@EliminarDiscapacidadBeneficiario');

Route::post('/api/v0/eliminar/discapacidadPrograma/{id}', 'PostBeneficiariosController@EliminarDiscapacidadPrograma');

Route::post('/api/v0/eliminar/disciplina/{id}', 'PostBeneficiariosController@EliminarDisciplinaEmpleado');
Route::get('/api/v0/obtenerselect/escolaridades', 'PostBeneficiariosController@ObtenerEscolaridades');
Route::get('/api/v0/obtenerselect/gradosEscolaridad', 'PostBeneficiariosController@ObtenerEscolaridadesGrados');

Route::get('/obtenerselect/gradosEscolaridad', 'PostBeneficiariosController@ObtenerEscolaridadesGrados2');


//Fin Beneficiarios
//Inicio Geolocalizacion
Route::get('admin/postlocalizacion', 'PostLocalizacionController@vista');
Route::get('index-localizacion', function () {
  return view('postlocalizacion.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postlocalizacion", "PostLocalizacionController@index");
});

Route::get('index-localizacion-institucion', function () {
  return view('postlocalizacion.instituciones');
});

Route::get('index-localizacion-corregimiento-institucion', function () {
  return view('postlocalizacion.instituciones_corregimiento');
});

Route::get('index-localizacion-institucion-sede', function () {
  return view('postlocalizacion.instituciones_sedes');
});

Route::get('index-localizacion-sede-beneficiario', function () {
  return view('postlocalizacion.instituciones_sedes_beneficiarios');
});

Route::get('index-localizacion-beneficiario', function () {
  return view('postlocalizacion.beneficiario');
});

Route::get('/api/v0/admin/postlocalizacion_institucion/{id}', 'PostLocalizacionController@index');

Route::get('/api/v0/admin/postlocalizacion_instituciones/{id}', 'PostLocalizacionController@instituciones');

Route::get('/api/v0/admin/postlocalizacion_instituciones_corregimiento/{id}', 'PostLocalizacionController@InstitucionesCorregimiento');

Route::get('/api/v0/admin/postlocalizacion_institucion_sede/{id}', 'PostLocalizacionController@sede');

Route::get('/api/v0/admin/postlocalizacion/institucion/{id}', 'PostLocalizacionController@institucion');

Route::get('/api/v0/admin/postlocalizacion_sede_beneficiarios/{id}', 'PostLocalizacionController@SedeBeneficiario');

//Fin Geolocalizacion


//Inicio Grados

Route::get('admin/postgrados', 'PostGradosController@vista');
Route::get('index-grados', function () {
  return view('postgrados.index');
})->middleware('permission:ver-grados');
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postgrados", "PostGradosController@index");
});
Route::get('create-grados', function () {
  return view('postgrados.create');
});

Route::get('editar-grados', function () {
  return view('postgrados.editar');
});
Route::post('/api/v0/postgrado/create', 'PostGradosController@CrearGrado');
Route::get('/api/v0/admin/postgrados/{id}', 'PostGradosController@ObtenerGrado');
Route::post('/api/v0/postgrados/editarGrado/{id}', 'PostGradosController@EditarGrado');
Route::post('/api/v0/eliminar/grado/{id}', 'PostGradosController@EliminarGrado');
Route::get('/api/v0/obtener/grados', 'PostGradosController@ObtenerGrados');


//Fin Grados

// Reporte General

Route::get('/total_beneficiarios', 'PostBeneficiarioReportesController@total_beneficiarios');
Route::get('admin/postreportegeneral', 'PostBeneficiarioReportesController@vista');
Route::get('index-reporte-general', function () {
  return view('postreportegeneral.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postreportegeneral", "PostBeneficiarioReportesController@index");
});


// Reporte Detallado

Route::get('admin/postreportedetallado', 'PostBeneficiarioReportesController@vistaDetallado');
Route::get('index-reporte-detallado', function () {
  return view('postreportedetallado.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postreportedetallado", "PostBeneficiarioReportesController@indexDetallado");
  Route::get("admin/postbeneficiariosall", "PostBeneficiarioReportesController@BeneficiariosReporteDetallado");

});


//Inicio Criterios


Route::get('admin/postcriterios', 'PostCriteriosController@vista');
Route::get('index-criterios', function () {
  return view('postcriterios.index');
});

Route::get('crear-criterios', function () {
  return view('postcriterios.criterios');
});

Route::get('evaluacion-criterios', function () {
  return view('postcriterios.evaluacion');
});

Route::group(["prefix" => "api/v0"], function () {
Route::get("admin/postcriterios", "PostCriteriosController@index");
Route::get("admin/postcriteriosGrupo/{id}", "PostCriteriosController@CriteriosGrupo");
Route::post('guardar/criterio/{id}', 'PostCriteriosController@CrearCriterio');
Route::get('obtener/criterio/{id}', 'PostCriteriosController@ObtenerCriterioGrupo');
Route::post('actualizar/criterio/{id}', 'PostCriteriosController@ActualizarCriterio');
Route::post('eliminar/criterio/{id}', 'PostCriteriosController@EliminarCriterio');
Route::post('crear/evaluaciones/{id}', 'PostCriteriosController@CrearEvaluaciones');

Route::get('obtener/evaluacion/{id}', 'PostCriteriosController@ObtenerEvaluaciones');
Route::post('actualizar/evaluaciones/{id}', 'PostCriteriosController@ActualizarEvaluaciones');


});


//Inicio Modalidades

Route::get('admin/postmodalidades', 'PostModalidadController@vista');
Route::get('index-modalidades', function () {
  return view('postmodalidades.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postmodalidades", "PostModalidadController@index");
});
Route::get('create-modalidades', function () {
  return view('postmodalidades.create');
});

Route::get('editar-modalidades', function () {
  return view('postmodalidades.editar');
});
Route::post('/api/v0/postmodalidad/create', 'PostModalidadController@CrearModalidad');
Route::get('/api/v0/admin/postmodalidades/{id}', 'PostModalidadController@ObtenerModalidad');
Route::post('/api/v0/postmodalidades/editarModalidad/{id}', 'PostModalidadController@EditarModalidad');
Route::post('/api/v0/eliminar/modalidad/{id}', 'PostModalidadController@EliminarModalidad');
//Fin Modalidades


//Inicio Puntos de Atención
Route::get('admin/postpuntoatencion', 'PostPuntoAtencionController@vista');
Route::get('index-puntoatencion', function () {
  return view('postpuntosatencion.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postpuntoatencion", "PostPuntoAtencionController@index");
});
Route::get('create-puntoatencion', function () {
  return view('postpuntosatencion.create');
});

Route::get('editar-puntoatencion', function () {
  return view('postpuntosatencion.editar');
});
Route::post('/api/v0/postpuntoatencion/create', 'PostPuntoAtencionController@CrearPuntoAtencion');
Route::get('/api/v0/admin/postpuntoatencion/{id}', 'PostPuntoAtencionController@ObtenerPuntoAtencion');
Route::post('/api/v0/postpuntoatencion/editarPuntoAtencion/{id}', 'PostPuntoAtencionController@EditarPuntoAtencion');
Route::post('/api/v0/eliminar/puntoatencion/{id}', 'PostPuntoAtencionController@EliminarPuntoAtencion');
//Fin Puntos de Atención


//Inicio Criterios


Route::get('admin/postconsultaevaluaciones', 'PostConsultaEvaluacionesController@vista');
Route::get('index-consulta-evaluacion', function () {
  return view('postconsultaevaluaciones.index');
});


Route::get('consulta-evaluaciones', function () {
  return view('postconsultaevaluaciones.evaluaciones');
});

Route::get('evaluacion-promedio', function () {
  return view('postconsultaevaluaciones.promedio');
});

Route::group(["prefix" => "api/v0"], function () {
Route::get("admin/postconsultaevaluaciones", "PostConsultaEvaluacionesController@index");
Route::get("obtener/misbeneficiariosevaluaciones/{id}", "PostConsultaEvaluacionesController@misbeneficiariosevaluaciones");
Route::get("obtener/promevaluaciones/{id}", "PostConsultaEvaluacionesController@PromedioEvaluaciones");
Route::get("obtener/promevaluacionesGrafico/{id}", "PostConsultaEvaluacionesController@PromedioEvaluacionesGrafico");

});

//Inicio Personal
Route::get('admin/postpersonal', 'PostPersonalController@vista');
Route::get('create-postpersonal', function () {
  return view('postpersonal.personal');
});

Route::get('create-micomunidad', function () {
  return view('postpersonal.micomunidad');
});

Route::get('create-deporteescolar', function () {
  return view('postpersonal.deporteescolar');
});

Route::get('create-caliacoge', function () {
  return view('postpersonal.caliacoge');
});

Route::get('create-calisedivierte', function () {
  return view('postpersonal.calisedivierte');
});

Route::get('create-calintegra', function () {
  return view('postpersonal.calintegra');
});

Route::get('create-canasyganas', function () {
  return view('postpersonal.canasyganas');
});

Route::get('create-carrerasycaminatas', function () {
  return view('postpersonal.carrerasycaminatas');
});

Route::get('create-cuerpoyespiritu', function () {
  return view('postpersonal.cuerpoyespiritu');
});

Route::get('create-deporteasociado', function () {
  return view('postpersonal.deporteasociado');
});

Route::get('create-deportecomunitario', function () {
  return view('postpersonal.deportecomunitario');
});

Route::get('create-vertigo', function () {
  return view('postpersonal.vertigo');
});

Route::get('create-viactiva', function () {
  return view('postpersonal.viactiva');
});

Route::get('create-viveelparque', function () {
  return view('postpersonal.viveelparque');
});


Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postpersonal", "PostPersonalController@index");
});

Route::get('/api/v0/cargar/poblacionalesDocumento/{id}', 'PostPersonalController@PoblacionalesDocumento');
Route::get('/api/v0/cargar/discapacidadesDocumento/{id}', 'PostPersonalController@DiscapacidadesDocumento');
Route::get('/api/v0/cargar/disciplinasDocumento/{id}', 'PostPersonalController@DisciplinasDocumento');
Route::get('/api/v0/admin/postpersonausuario/cargar/{id}', 'PostPersonalController@CargarPersonaUsuario');
Route::get('/api/v0/cargar/poblacionalesUsuario/{id}', 'PostPersonalController@PoblacionalesUsuario');
Route::get('/api/v0/cargar/discapacidadesUsuario/{id}', 'PostPersonalController@DiscapacidadesUsuario');
Route::get('/api/v0/cargar/disciplinasUsuario/{id}', 'PostPersonalController@DisciplinasUsuario');
Route::post('/api/v0/postusuario/editarpersonal/{id}', 'PostPersonalController@AsignarRolUsuario');
Route::post('/api/v0/postusuario/editarpersonalPerfil/{id}', 'PostPersonalController@EditarPerfilUsuario');
//Inicio Eps
Route::get('admin/posteps', 'PostEpsController@vista');
Route::get('index-eps', function () {
  return view('posteps.index');
})->middleware('permission:ver-eps');
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/posteps", "PostEpsController@index");
});
Route::get('create-eps', function () {
  return view('posteps.create');
});

Route::get('editar-eps', function () {
  return view('posteps.editar');
});
Route::post('/api/v0/posteps/create', 'PostEpsController@CrearEps');
Route::get('/api/v0/admin/posteps/{id}', 'PostEpsController@ObtenerEps');
Route::post('/api/v0/posteps/editarEps/{id}', 'PostEpsController@EditarEps');
Route::post('/api/v0/eliminar/eps/{id}', 'PostEpsController@EliminarEps');
//Fin Eps


//Inicio Ludotecaes
Route::get('admin/postludotecas', 'PostLudotecasController@vista');
Route::get('index-ludotecas', function () {
  return view('postludotecas.index');
})->middleware('permission:ver-ludotecas');
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postludotecas", "PostLudotecasController@index");
});
Route::get('create-ludotecas', function () {
  return view('postludotecas.create');
});
Route::get('editar-ludotecas', function () {
  return view('postludotecas.editar');
});
Route::post('/api/v0/postludoteca/create', 'PostLudotecasController@CrearLudoteca');
Route::get('/api/v0/admin/postludotecas/{id}', 'PostLudotecasController@ObtenerLudotecaId');
Route::post('/api/v0/postludotecas/editarLudoteca/{id}', 'PostLudotecasController@EditarLudoteca');
Route::get('/api/v0/obtenerselect/barrios/', 'PostLudotecasController@ObtenerBarriosLudoteca');
Route::get('/api/v0/obtenerselect/barrio/{id}', 'PostLudotecasController@ObtenerLudotecaBarrioID');
Route::get('/api/v0/obtenerludoteca/sede/{id}', 'PostLudotecasController@ObtenerLudotecaSedeID');
Route::post('/api/v0/eliminar/ludoteca/{id}', 'PostLudotecasController@EliminarLudoteca');
Route::get('/api/v0/obtenerselect/barrios/{id}', 'PostLudotecasController@obtenerbarriosID');
Route::get('/api/v0/obtenerselect/comunabarrio/{id}', 'PostLudotecasController@obtenerBarrioComunaID');
Route::get('/api/v0/obtener/corregimientoLudoteca/{id}
', 'PostLudotecasController@ObtenerCorregimientoLudoteca');
Route::get('/api/v0/obtener/corregimientoLudoteca/{id}', 'PostLudotecasController@LudotecaCorregimiento');

//Fin Ludotecaes



//Inicio Ficha Colegios
Route::get('admin/postfichacolegios', 'PostFichaColegioController@vista');
Route::get('index-fichacolegios', function () {
  return view('postfichacolegios.index');
});
Route::get('create-fichacolegio', function () {
  return view('postfichacolegios.create');
});

Route::get('/api/v0/obtener/tipoequipamientos', 'PostFichaColegioController@ObtenerTipoEquipamiento');
Route::post('/api/v0/fichacolegio/create', 'PostFichaColegioController@CrearFichaColegio');
Route::get('/api/v0/obtener/equipamientos/{sede}', 'PostFichaColegioController@ObtenerEquipamientos');

//fin ficha colegios

//Inicio Implementos
Route::get('admin/postimplementos', 'PostImplementosController@vista');
Route::get('index-implementos', function () {
  return view('postimplementos.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postimplementos", "PostImplementosController@index");
});
Route::get('create-implementos', function () {
  return view('postimplementos.create');
});

Route::get('editar-implementos', function () {
  return view('postimplementos.editar');
});
Route::post('/api/v0/postimplemento/create', 'PostImplementosController@CrearImplemento');
Route::get('/api/v0/admin/postimplementos/{id}', 'PostImplementosController@ObtenerImplemento');
Route::post('/api/v0/postimplementos/editarImplemento/{id}', 'PostImplementosController@EditarImplemento');
Route::post('/api/v0/eliminar/implemento/{id}', 'PostImplementosController@EliminarImplemento');
//Fin Implementos

//Inicio Inventario Colegios
Route::get('admin/postinventariocolegios', 'PostInventarioColegioController@vista');
Route::get('index-inventariocolegios', function () {
  return view('postinventariocolegios.index');
});
Route::get('create-inventariocolegio', function () {
  return view('postinventariocolegios.create');
});
Route::get('/api/v0/obtener/implementos', 'PostInventarioColegioController@ObtenerTipoImplementos');
Route::post('/api/v0/inventariocolegio/create', 'PostInventarioColegioController@CrearInventarioColegio');
Route::get('/api/v0/obtener/implementos/{sede}', 'PostInventarioColegioController@ObtenerImplementos');
//Fin Inventario colegios

//tenanId
Route::get('/api/v0/admin/tenanId', 'PostUsuariosController@ObtenerTenanId');
//tenenId

//Notificaciones
Route::post('/notification/get', 'NotificationController@get');

//Inicio Metas
Route::get('admin/postmetas', 'PostMetasController@vista');
Route::get('index-metas', function () {
  return view('postmetas.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postmetas", "PostMetasController@index");
});
Route::get('create-metas', function () {
  return view('postmetas.create');
});
Route::get('editar-metas', function () {
  return view('postmetas.editar');
});

Route::post('/api/v0/postmeta/create', 'PostMetasController@CrearMeta');
Route::get('/api/v0/admin/postmetas/{id}', 'PostMetasController@ObtenerMeta');
Route::post('/api/v0/postmeta/editar/{id}', 'PostMetasController@EditarMeta');
Route::post('/api/v0/eliminar/meta/{id}', 'PostMetasController@EliminarMeta');
//Fin Metas

//Inicio Indicadores
Route::get('admin/postindicadores', 'PostIndicadoresController@vista');
Route::get('index-indicadores', function () {
  return view('postindicadores.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postindicadores", "PostIndicadoresController@index");
});
Route::get('create-indicadores', function () {
  return view('postindicadores.create');
});
Route::get('editar-indicadores', function () {
  return view('postindicadores.editar');
});
Route::get('grafico-indicadores', function () {
  return view('postindicadores.graficos');
});
Route::get('/api/v0/obtener/metasanualidad', 'PostIndicadoresController@ObtenerMetaAnualidad');
Route::get('/api/v0/obtener/alcancemeta/{meta}', 'PostIndicadoresController@AlcanceMeta');
Route::get('/api/v0/obtener/indicadormeta/{mes}/{meta}', 'PostIndicadoresController@IndicadorMeta');
Route::post('/api/v0/postindicadormeta/create', 'PostIndicadoresController@CrearIndicador');
Route::get('/api/v0/graficoindicadores/{id}', 'PostIndicadoresController@GraficoIndicador');
Route::get('/api/v0/metaalcance/{id}', 'PostIndicadoresController@MetaAlcance');
Route::get('items/export_asistencias', 'ItemController@exportAsistencias');

//Inicio Titulos
Route::get('admin/posttitulos', 'PostTitulosController@vista');
Route::get('index-titulos', function () {
  return view('posttitulos.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/posttitulos", "PostTitulosController@index");
});
Route::get('create-titulos', function () {
  return view('posttitulos.create');
});

Route::get('editar-titulos', function () {
  return view('posttitulos.editar');
});
Route::post('/api/v0/posttitulo/create', 'PostTitulosController@CrearTitulo');
Route::get('/api/v0/admin/posttitulos/{id}', 'PostTitulosController@ObtenerTitulo');
Route::post('/api/v0/posttitulos/editarTitulo/{id}', 'PostTitulosController@EditarTitulo');
Route::post('/api/v0/eliminar/titulo/{id}', 'PostTitulosController@EliminarTitulo');
//Fin Titulos

//Inicio Universidades
Route::get('admin/postuniversidades', 'PostUniversidadesController@vista');
Route::get('index-universidades', function () {
  return view('postuniversidades.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postuniversidades", "PostUniversidadesController@index");
});
Route::get('create-universidades', function () {
  return view('postuniversidades.create');
});

Route::get('editar-universidades', function () {
  return view('postuniversidades.editar');
});
Route::post('/api/v0/postuniversidad/create', 'PostUniversidadesController@CrearUniversidad');
Route::get('/api/v0/admin/postuniversidades/{id}', 'PostUniversidadesController@ObtenerUniversidad');
Route::post('/api/v0/postuniversidades/editarUniversidad/{id}', 'PostUniversidadesController@EditarUniversidad');
Route::post('/api/v0/eliminar/universidades/{id}', 'PostUniversidadesController@EliminarUniversidad');
//Fin Universidades

//Soporte
Route::get('admin/postsoporte', 'PostUsuariosController@soporte');

Route::get('index-soporte', function () {
  return view('postsoporte.index');
});



//Inicio Lugares
Route::get('admin/postlugares', 'PostLugaresController@vista');
Route::get('index-lugares', function () {
  return view('postlugares.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postlugares", "PostLugaresController@index");
});
Route::get('create-lugares', function () {
  return view('postlugares.create');
});

Route::get('editar-lugares', function () {
  return view('postlugares.editar');
});
Route::post('/api/v0/postlugar/create', 'PostLugaresController@CrearLugar');
Route::get('/api/v0/admin/postlugares/{id}', 'PostLugaresController@ObtenerLugar');
Route::post('/api/v0/postlugares/editarLugar/{id}', 'PostLugaresController@EditarLugar');
Route::post('/api/v0/inactivar/lugar/{id}', 'PostLugaresController@InactivarLugar');
Route::post('/api/v0/activar/lugar/{id}', 'PostLugaresController@ActivarLugar');
Route::get('/api/v0/obtener/lugaresall', 'PostLugaresController@obtenerlugaresall');

//Fin Lugares


//Inicio Disciplinas
Route::get('admin/postdisciplinas', 'PostDisciplinasController@vista');
Route::get('index-disciplinas', function () {
  return view('postdisciplinas.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postdisciplinas", "PostDisciplinasController@index");
});
Route::get('create-disciplinas', function () {
  return view('postdisciplinas.create');
});

Route::get('editar-disciplinas', function () {
  return view('postdisciplinas.editar');
});
Route::post('/api/v0/postdisciplina/create', 'PostDisciplinasController@CrearDisciplina');
Route::get('/api/v0/admin/postdisciplinas/{id}', 'PostDisciplinasController@ObtenerDisciplina');
Route::post('/api/v0/postdisciplinas/editarDisciplina/{id}', 'PostDisciplinasController@EditarDisciplina');
Route::post('/api/v0/inactivar/disciplinas/{id}', 'PostDisciplinasController@InactivarDisciplina');
Route::post('/api/v0/activar/disciplinas/{id}', 'PostDisciplinasController@ActivarDisciplina');
//Fin Disciplinas

//Inicio Grupos Programas
Route::get('admin/postgruposprogramas', 'PostGruposProgramasController@vista');
Route::get('index-gruposprogramas', function () {
  return view('postgruposprogramas.index');
});

Route::get('grupos-consulta-programa', function () {
  return view('postgruposprogramas.consulta');
});

Route::get('misbeneficiarios-grupos-consulta-programa', function () {
  return view('postgruposprogramas.misbeneficiariosconsulta');
});

Route::get('grupos-consulta-asistencia-programa', function () {
  return view('postgruposprogramas.misbeneficiariosasistenciasprogramas');
});

Route::get('adicional-mibeneficiario', function () {
  return view('postgruposprogramas.adicionalmibeneficiario');
});

Route::group(["prefix" => "api/v0"], function () {

  Route::get("admin/postgruposprogramas", "PostGruposProgramasController@index");
  Route::get("admin/postgruposprogramas/consulta", "PostGruposProgramasController@ConsultaGrupos");
  Route::get("admin/postgruposprogramas/consultausuario/{usuario}", "PostGruposProgramasController@ConsultaGruposUsuario");

Route::post('/eliminar/grupo_programa/{id}', 'PostGruposProgramasController@EliminarGrupoPrograma');


});

Route::get('create-gruposprogramas', function () {
  return view('postgruposprogramas.create');
});
Route::get('editar-gruposprogramas', function () {
  return view('postgruposprogramas.editar');
});

Route::get('asistencias-grupos-programas', function () {
  return view('postgruposprogramas.misasistenciasprogramas');
});

Route::get('misbeneficiarios-grupos-programas', function () {
  return view('postgruposprogramas.misbeneficiariosprogramas');
});


Route::get('infoasistencias-grupos-programas', function () {
  return view('postgruposprogramas.infoasistenciasprogramas');
});

Route::get('informacion-grupoprogramas', function () {
  return view('postgruposprogramas.informaciongrupo');
});

Route::get('grupos-reasignacion-programa', function () {
  return view('postgruposprogramas.reasignacion');
});


Route::get('/api/v0/obtenerselect/lugares_grupos', 'PostGruposProgramasController@ObtenerLugares');
Route::get('/api/v0/obtenerselect/disciplinas_grupos', 'PostGruposProgramasController@ObtenerDisciplinas');
Route::post('/api/v0/postgrupoprograma/create', 'PostGruposProgramasController@CrearGrupo');
Route::get('/api/v0/admin/postgruposprogramas/{id}', 'PostGruposProgramasController@ObtenerGrupoPrograma');
Route::get('/api/v0/obtener/GrupoHorarioPrograma/{id}', 'PostGruposProgramasController@GrupoHorarioPrograma');
Route::post('/api/v0/postgrupoprograma/actualizar/{id}', 'PostGruposProgramasController@ActualizarGrupoPrograma');
Route::post('/api/v0/eliminar/GrupoHorarioPrograma', 'PostGruposProgramasController@EliminaHorarioPrograma');
Route::post('/api/v0/admin/postgruposprogramas/inactivar/{id}', 'PostGruposProgramasController@InactivarGrupoPrograma');
Route::post('/api/v0/admin/postgruposprogramas/activar/{id}', 'PostGruposProgramasController@ActivarGrupoPrograma');



// Reporte General Programa

Route::get('admin/postreportegeneralprogramas/', 'PostBeneficiarioReportesProgramasController@vista');
Route::get('index-reporte-general-programas', function () {
  return view('postreportegeneralprogramas.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postreportegeneralprogramas", "PostBeneficiarioReportesProgramasController@index");
});
Route::get('/api/v0/obtener/beneficiariosgeneralprogramas', 'ItemController@BeneficiariosGeneralPrograma');

Route::get('/api/v0/obtenerselect/lugares', 'PostBeneficiarioReportesProgramasController@ObtenerLugares');
Route::get('/api/v0/obtenerselect/disciplinas', 'PostBeneficiarioReportesProgramasController@ObtenerDisciplinas');
Route::get('/export/reportgeneralprogramas', 'ItemController@ExportBeneficiariosGeneralProgramas');


// Reporte Detallado Programas

Route::get('admin/postreportedetalladoprogramas', 'PostBeneficiarioReportesProgramasController@vistaDetallado');
Route::get('index-reporte-detallado-programa', function () {
  return view('postreportedetalladoprogramas.index');
});
Route::group(["prefix" => "api/v0"], function () {
  Route::get("admin/postreportedetalladoprogramas", "PostBeneficiarioReportesProgramasController@indexDetallado");
  Route::get("admin/postbeneficiariosallprogramas", "PostBeneficiarioReportesProgramasController@BeneficiariosReporteDetalladoPrograma");
});
Route::get('/api/v0/obtener/beneficiariodetalladoprogramas', 'ItemController@BeneficiariosDetalladoProgramas');
Route::get('export/reportedetalladoprogramas', 'ItemController@exportDetalladoProgramas');
Route::get('/api/v0/obtener/nombre_grupoprograma/{id}', 'PostGruposProgramasController@ObtenerNombreGrupo');
Route::get('/api/v0/obtener/misbeneficiariosconsultaprograma/{id}', 'PostGruposProgramasController@ObtenerMisBeneficiariosConsulta');
Route::get('/api/v0/selectgruposprogramas/monitor', 'PostGruposProgramasController@ObtenerGrupoMonitorPrograma');
Route::get('items/asistenciaprogramasall', 'ItemController@asistenciaprogramas_all');
Route::get('/api/v0/obtener/misbeneficiariosasistenciasprogramas', 'PostGruposProgramasController@ObtenerMisBeneficiariosAsistenciasProgramas');
Route::get('items/export_asistencias_programas', 'ItemController@exportAsistenciasProgramas');
Route::post('/api/v0/reasignacion/grupoprograma/{grupo}', 'PostGruposProgramasController@ReasignarGrupo');

Route::get('/api/v0/obtener/disciplinas', 'PostGruposProgramasController@exportAsistenciasProgramas');

Route::get('/api/v0/obtener/disciplinasdeportivas', 'PostGruposProgramasController@obtenerdisciplinas_deportivas');


Route::post('/api/v0/create/adicional/{id}', 'PostGruposProgramasController@crear_adicional');
Route::post('/api/v0/actualizar/adicional/{id}', 'PostGruposProgramasController@editar_adicional');

Route::get('/api/v0/obtener/informacion_adicional/{id}', 'PostGruposProgramasController@obtener_adicional');
