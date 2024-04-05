<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Beneficiario;
use App\Programa;
use App\PoblacionalBeneficiario;
use App\RoleUser;
use App\Grupo;
use App\Persona;
use App\FichaComunidad;
use App\Vereda;
use App\Escolaridad;
use App\FichaPrograma;
use App\PoblacionalPrograma;
use App\ProgramaDiscapacidad;
use App\Grado;
use App\ProgramaGrupo;
use App\PersonaDiscapacidad;
use App\EmpleadoDiscapacidad;
use App\EmpleadoDisciplina;
use App\VistaReporteGeneral;
use Response;
use DB;
use DateTime;
use Exception;



class PostBeneficiariosController extends Controller
{


	public function __construct()
	{

	
	}

	public function vista(){

		return view("postbeneficiarios.appbeneficiarios");
	}

	public function index()
	{


	$mis_beneficiarios = VistaReporteGeneral::where('vista_reporte_general.tenantId', '=', Auth::user()->tenantId)->groupBy('vista_reporte_general.id')->get();
		return response()->json(
			$mis_beneficiarios 
		);



	}



	public function index_programas()
	{

	$mis_beneficiarios = DB::table('tbl_pr_ficha')
		->leftjoin(
		  'tbl_gen_persona',
		  'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')
		  
		  ->leftjoin(
		  'tbl_gen_persona as acudiente_persona',
		  'acudiente_persona.id', '=', 'tbl_pr_ficha.id_persona_acudiente')

		  ->leftjoin(
		  'tbl_pr_poblacional_beneficiarios',
	      'tbl_pr_ficha.id', '=', 'tbl_pr_poblacional_beneficiarios.ficha_id')
	   
		  ->leftjoin(
		  'tbl_pr_persona_x_discapacidad',
		  'tbl_pr_ficha.id', '=', 'tbl_pr_persona_x_discapacidad.ficha_id')
		  
	      ->leftjoin(
		  'tbl_pr_grupos',
		  'tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')

		  ->leftjoin(
		  'tbl_pr_lugares',
		  'tbl_pr_lugares.id', '=', 'tbl_pr_grupos.lugar_id')

		  ->leftjoin(
		  'tbl_pr_disciplinas',
		  'tbl_pr_disciplinas.id', '=', 'tbl_pr_grupos.disciplina_id')	
	
		  ->leftjoin(
			'comunas',
			'comunas.id', '=', 'tbl_pr_ficha.comuna_id')
	  
			->leftjoin(
			'users',
			'users.id', '=', 'tbl_pr_grupos.user_id')
		
			->leftjoin(
			'tbl_gen_grupo_poblacional',
			'tbl_gen_grupo_poblacional.id', '=', 'tbl_pr_poblacional_beneficiarios.grupo_pcs')
		
	    	->leftjoin(
		    'view_discapacidad_persona_ficha_pr',
		    'tbl_pr_ficha.id', '=', 'view_discapacidad_persona_ficha_pr.ficha_id')

	    	->leftjoin(
		    'view_grupo_poblacional_ficha_pr',
		    'tbl_pr_ficha.id', '=', 'view_grupo_poblacional_ficha_pr.ficha_id')

		  
		    ->leftjoin(
	    	'paises',
	    	'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')
		
	    	->leftjoin(
	    	'departamentos',
    		'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')
		
		->leftjoin(
		  'municipios',
		'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')
		
		
		->leftjoin(
		  'barrios',
		'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')
		
		->leftjoin(
		  'tbl_gen_corregimientos',
		'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
		->leftjoin(
		  'tbl_gen_veredas',  
		'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
		->leftjoin(
		  'tbl_gen_estado_civil',
		'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
		
		->leftjoin(
		  'tbl_gen_escolaridad_nivel',  
		'tbl_gen_escolaridad_nivel.id', '=', 'tbl_gen_persona.escolaridad_id')


		->leftjoin(
		  'tbl_gen_documento_tipo',
		'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
		->leftjoin(
		  'tbl_gen_documento_tipo as tipo_documento_acudiente',
		'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
	
		->leftjoin(
		  'tbl_gen_eps',
		'tbl_gen_eps.id', '=', 'tbl_pr_ficha.salud_sgss_id')
	
		->leftjoin(
		  'tbl_gen_etnia',
		  'tbl_gen_etnia.id', '=', 'tbl_pr_ficha.cultura_beneficiario')	
	
		  ->leftjoin(
		'tbl_gen_escolaridad_estado',
		'tbl_gen_escolaridad_estado.id', '=', 'tbl_gen_persona.estado_escolaridad')
	
		->leftjoin(
		'tbl_gen_ocupacion',
		'tbl_gen_ocupacion.id', '=', 'tbl_pr_ficha.ocupacion_beneficiario')
	  
		->leftjoin(
		  'tbl_gen_salud_regimen',
		  'tbl_gen_salud_regimen.id', '=', 'tbl_pr_ficha.tipo_afiliacion')
		
		  ->select(DB::raw(
		  "tbl_pr_ficha.id, 
			tbl_pr_grupos.nombre_grupo,
			tbl_pr_lugares.nombre_lugar,
   			tbl_pr_disciplinas.nombre_disciplina,
			tbl_gen_documento_tipo.descripcion as tipo_documento,
			tbl_gen_persona.documento,
			tbl_pr_ficha.no_ficha,
			tbl_pr_ficha.fecha_inscripcion,
			tbl_gen_persona.nombre_primero,
			tbl_gen_persona.nombre_segundo,
			tbl_gen_persona.apellido_primero,
			tbl_gen_persona.apellido_segundo,
			tbl_gen_persona.correo_electronico,
			(CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo,
			tbl_gen_persona.fecha_nacimiento,
			TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) AS edad_persona,
			paises.nombre_pais,
			departamentos.nombre_departamento,
			municipios.nombre_municipio,
			tbl_gen_corregimientos.descripcion as nombre_corregimiento,
			tbl_gen_veredas.nombre as nombre_vereda,
			barrios.nombre_barrio,
			tbl_gen_persona.residencia_estrato,
			comunas.nombre_comuna,
			tbl_gen_persona.residencia_direccion,
			tbl_gen_persona.telefono_fijo,
			tbl_gen_persona.telefono_movil,
			tbl_gen_escolaridad_nivel.descripcion as nivel_escolaridad,
			tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
			`tbl_gen_ocupacion`.`descripcion` as ocupacion_beneficiario,
			tbl_gen_estado_civil.descripcion as estado_civil,
			(CASE WHEN (tbl_pr_ficha.hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
			tbl_pr_ficha.cantidad_hijos_beneficiario,
			tbl_gen_etnia.descripcion as etnia_beneficiario,
		    `view_grupo_poblacional_ficha_pr`.`nombre` as poblacional,
			(CASE WHEN (tbl_pr_ficha.discapacidad_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as enfermedad_permanente,
			`tbl_pr_ficha`.`otra_discapacidad_beneficiario`,
			(CASE WHEN (tbl_pr_ficha.medicamentos_permanente_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as toma_medicamentos,
			`tbl_pr_ficha`.`medicamentos_beneficiario`,
			`tbl_gen_persona`.`sangre_tipo`,
		     view_discapacidad_persona_ficha_pr.nombre_discapacidad as discapacidades,
			(CASE WHEN (tbl_pr_ficha.afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as afiliacion_salud,
			`tbl_gen_salud_regimen`.`descripcion` as tipo_afiliacion,
			`tbl_gen_eps`.`descripcion` as nombre_eps,
			tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
			acudiente_persona.documento as documento_acudiente,
			acudiente_persona.nombre_primero as primer_nombre_acudiente,
			acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
			acudiente_persona.apellido_primero as primer_apellido_acudiente,
			acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
				  (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
			acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
			acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
			acudiente_persona.telefono_movil as telefono_movil_acudiente,
			acudiente_persona.correo_electronico as correo_acudiente,   
			(CASE WHEN (tbl_pr_ficha.parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (tbl_pr_ficha.parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (tbl_pr_ficha.parentesco_acudiente = 3) THEN 'Tia/Tio' WHEN (tbl_pr_ficha.parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (tbl_pr_ficha.parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
			tbl_pr_ficha.otro_parentesco_acudiente,
			users.primer_nombre as primer_nombre_usuario, 
			users.primer_apellido as primer_apellido_usuario
	  
		  "))->where('tbl_pr_ficha.tenantId', '=', Auth::user()->tenantId)
		  ->whereNotNull('tbl_pr_ficha.grupo_id')
		  ->whereNotNull('tbl_pr_grupos.tenantId')
		  ->whereNotNull('tbl_pr_ficha.tenantId')
		  ->groupBy('tbl_pr_ficha.id')->get();

		return response()->json(
			$mis_beneficiarios
		);
	}


	public function listado()
	{

	$mis_beneficiarios = DB::table('tbl_cm_ficha')
		->leftjoin(
		  'tbl_gen_persona',
		  'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
		  
		  ->leftjoin(
		  'tbl_gen_persona as acudiente_persona',
		  'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
		  ->leftjoin(
		  'poblacional_beneficiarios',
		'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')
	   
		->leftjoin(
		'tbl_cm_persona_x_discapacidad',
		'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')
		  
		->leftjoin(
		'grupos',
		'grupos.id', '=', 'tbl_cm_ficha.grupo_id')
	
		->leftjoin(
		'tbl_cm_grados',
		'tbl_cm_grados.id', '=', 'grupos.grado_id')
		
		->leftjoin(
		'comunas',
		'comunas.id', '=', 'tbl_cm_ficha.comuna_id')
  
		->leftjoin(
		'users',
		'users.id', '=', 'grupos.user_id')
		
		->leftjoin(
		'tbl_cm_grupo_poblacional',
		'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')
		
		->leftjoin(
		  'tbl_gen_discapacidad',
		  'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')
		  
		->leftjoin(
		'paises',
		'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')
		
		->leftjoin(
		  'departamentos',
		'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')
		
		->leftjoin(
		  'municipios',
		'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')
		
		
		->leftjoin(
		  'barrios',
		'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')
		
		->leftjoin(
		  'tbl_gen_corregimientos',
		'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
		->leftjoin(
		  'tbl_gen_veredas',  
		'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
		->leftjoin(
		  'tbl_gen_estado_civil',
		'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
		->leftjoin(
		  'tbl_gen_escolaridad_nivel',  
		'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
		->leftjoin(
		  'tbl_gen_documento_tipo',
		'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
		->leftjoin(
		  'tbl_gen_documento_tipo as tipo_documento_acudiente',
		'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
	
		->leftjoin(
		  'tbl_gen_eps',
		'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
	
		->leftjoin(
		  'tbl_gen_etnia',
		  'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')	
	
		  ->leftjoin(
		'tbl_gen_escolaridad_estado',
		'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')
	
		->leftjoin(
		'tbl_gen_ocupacion',
		'tbl_gen_ocupacion.id', '=', 'tbl_cm_ficha.ocupacion_beneficiario')
	  
		->leftjoin(
		  'tbl_gen_salud_regimen',
		  'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')
		
		  ->select(DB::raw(
		  "tbl_cm_ficha.id, 
			grupos.codigo_grupo,
			tbl_cm_grados.nombre_grado,
			tbl_gen_documento_tipo.descripcion as tipo_documento,
			tbl_gen_persona.documento,
			tbl_cm_ficha.no_ficha,
			tbl_cm_ficha.fecha_inscripcion,
			tbl_gen_persona.nombre_primero,
			tbl_gen_persona.nombre_segundo,
			tbl_gen_persona.apellido_primero,
			tbl_gen_persona.apellido_segundo,
			tbl_gen_persona.correo_electronico,
			(CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo,
			tbl_gen_persona.fecha_nacimiento,
			TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) AS edad_persona,
			paises.nombre_pais,
			departamentos.nombre_departamento,
			municipios.nombre_municipio,
			tbl_gen_corregimientos.descripcion as nombre_corregimiento,
			tbl_gen_veredas.nombre as nombre_vereda,
			barrios.nombre_barrio,
			tbl_gen_persona.residencia_estrato,
			comunas.nombre_comuna,
			tbl_gen_persona.residencia_direccion,
			tbl_gen_persona.telefono_fijo,
			tbl_gen_persona.telefono_movil,
			tbl_gen_escolaridad_nivel.descripcion as nivel_escolaridad,
			tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
			`tbl_gen_ocupacion`.`descripcion` as ocupacion_beneficiario,
			tbl_gen_estado_civil.descripcion as estado_civil,
			(CASE WHEN (tbl_cm_ficha.hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
			tbl_cm_ficha.cantidad_hijos_beneficiario,
			tbl_gen_etnia.descripcion as etnia_beneficiario,
			group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
			(CASE WHEN (tbl_cm_ficha.discapacidad_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as enfermedad_permanente,
			`tbl_cm_ficha`.`otra_discapacidad_beneficiario`,
			(CASE WHEN (tbl_cm_ficha.medicamentos_permanente_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as toma_medicamentos,
			`tbl_cm_ficha`.`medicamentos_beneficiario`,
			`tbl_gen_persona`.`sangre_tipo`,
			group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
			(CASE WHEN (tbl_cm_ficha.afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as afiliacion_salud,
			`tbl_gen_salud_regimen`.`descripcion` as tipo_afiliacion,
			`tbl_gen_eps`.`descripcion` as nombre_eps,
			tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
			acudiente_persona.documento as documento_acudiente,
			acudiente_persona.nombre_primero as primer_nombre_acudiente,
			acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
			acudiente_persona.apellido_primero as primer_apellido_acudiente,
			acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
				  (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
			acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
			acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
			acudiente_persona.telefono_movil as telefono_movil_acudiente,
			acudiente_persona.correo_electronico as correo_acudiente,   
			(CASE WHEN (tbl_cm_ficha.parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (tbl_cm_ficha.parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (tbl_cm_ficha.parentesco_acudiente = 3) THEN 'Tia/Tio' WHEN (tbl_cm_ficha.parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (tbl_cm_ficha.parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
			tbl_cm_ficha.otro_parentesco_acudiente,
			users.primer_nombre as primer_nombre_usuario, 
			users.primer_apellido as primer_apellido_usuario

	  
		  "))
		  ->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)
		  ->where('grupos.user_id', '=', Auth::id())
		  ->orderBy('grupos.codigo_grupo', 'asc')
		  ->groupBy('tbl_cm_ficha.id')->get();
		return response()->json(
			$mis_beneficiarios
		);



	}

	
public function FichaBeneficiario(Request $request)
{
	

	$no_ficha = FichaComunidad::where('tbl_cm_ficha.no_ficha', '=', $request->input('numero_ficha'))->firstOrfail();

		return response()->json(
			$no_ficha->toArray()
		);




}

public function DocumentoBeneficiario(Request $request)
{
	

	$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('no_documento_beneficiario')));

	
$beneficiario = DB::select('select 
		tbl_gen_persona.nombre_primero,
		tbl_gen_persona.nombre_segundo,
		tbl_gen_persona.apellido_primero,
		tbl_gen_persona.apellido_segundo,
		FORMAT(tbl_gen_persona.documento, 0, \'de_DE\') as documento,
		tbl_gen_persona.fecha_nacimiento,
		tbl_gen_persona.telefono_fijo,
		tbl_gen_persona.telefono_movil,
		tbl_gen_persona.correo_electronico,
		tbl_gen_persona.residencia_direccion,
		tbl_gen_persona.residencia_estrato,
		tbl_gen_persona.sangre_tipo,
		tbl_cm_ficha.id,
		tbl_cm_ficha.fecha_inscripcion,
		tbl_cm_ficha.no_ficha,
		tbl_cm_ficha.modalidad_id,
		tbl_cm_ficha.puntoatencion_id,
		tbl_cm_ficha.cantidad_hijos_beneficiario,
		tbl_cm_ficha.otra_ocupacion_beneficiario,
		tbl_cm_ficha.otra_cultura_beneficiario,
		tbl_cm_ficha.otra_discapacidad_beneficiario,
		tbl_cm_ficha.enfermedad_beneficiario,
		tbl_cm_ficha.medicamentos_beneficiario,
		tbl_cm_ficha.nombre_seguridad_beneficiario,
		tbl_cm_ficha.otro_parentesco_acudiente,
		
		FORMAT(acudiente.documento, 0, \'de_DE\') as documento_acudiente,
		acudiente.nombre_primero as nombre_primero_acudiente,
		acudiente.nombre_segundo as nombre_segundo_acudiente,
		acudiente.apellido_primero as apellido_primero_acudiente,
		acudiente.apellido_segundo as apellido_segundo_acudiente,
		acudiente.fecha_nacimiento as fecha_nacimiento_acudiente,
		acudiente.telefono_fijo as telefono_fijo_acudiente,
		acudiente.telefono_movil as telefono_movil_acudiente,
		acudiente.correo_electronico as correo_electronico_acudiente

 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	    inner join tbl_gen_persona acudiente ON tbl_cm_ficha.id_persona_acudiente = acudiente.id


 		 where tbl_gen_persona.documento =?', [$documento]);

return response()->json(
			$beneficiario
		);

}


	public function CrearBeneficiario(Request $request)
	{



$persona = new Persona();	
$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
$persona->sexo = $request->input('datos')['sexo_persona'];
$persona->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_persona']));
$persona->telefono_fijo = $request->input('datos')['telefono_fijo_persona'];
$persona->telefono_movil = $request->input('datos')['telefono_movil_persona'];
$persona->correo_electronico = $request->input('datos')['correo_persona'];
$persona->id_procedencia_pais = $request->input('datos')['pais_id'];
$persona->id_procedencia_municipio = $request->input('datos')['municipio_id'];
$persona->otro_municipio = (isset($request->input('datos')['otro_municipio'])?$request->input('datos')['otro_municipio']:"");
$persona->id_procedencia_departamento = $request->input('datos')['departamento_id'];
$persona->id_residencia_corregimiento = $request->input('datos')['corregimiento'];
$persona->id_residencia_barrio = $request->input('datos')['barrio_id'];
$persona->id_residencia_vereda = $request->input('datos')['vereda'];
$persona->residencia_direccion = $request->input('datos')['residencia_persona'];
$persona->residencia_estrato = $request->input('datos')['estrato'];
$persona->sangre_tipo  = $request->input('datos')['tip_sangre_persona'];
$persona->id_estado_civil  = $request->input('datos')['estado_civil_persona'];
$persona->tenantId = Auth::user()->tenantId;
$persona->save();



$acudiente_persona = new Persona();	
$acudiente_persona->nombre_primero = $request->input('datos')['primer_nombre_acudiente'];
$acudiente_persona->nombre_segundo = $request->input('datos')['segundo_nombre_acudiente'];
$acudiente_persona->apellido_primero = $request->input('datos')['primer_apellido_acudiente'];
$acudiente_persona->apellido_segundo = $request->input('datos')['segundo_apellido_acudiente'];
$acudiente_persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_acudiente']));

$acudiente_persona->id_documento_tipo = $request->input('datos')['tip_doc_acudiente'];
$acudiente_persona->sexo = $request->input('datos')['sex_pariente'];
$acudiente_persona->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_acudiente']));
$acudiente_persona->telefono_fijo = $request->input('datos')['telefono_fijo_acudiente'];
$acudiente_persona->telefono_movil = $request->input('datos')['telefono_movil_acudiente'];
$acudiente_persona->correo_electronico = $request->input('datos')['correo_acudiente'];
$acudiente_persona->tenantId = Auth::user()->tenantId;
$acudiente_persona->save();



$beneficiario = new FichaComunidad();		
$beneficiario->id_persona_beneficiario = $persona->id;
$beneficiario->grupo_id = null;
$beneficiario->fecha_inscripcion = date('Y-m-d',strtotime($request->input('datos')['fecha_inscripcion']));
$beneficiario->no_ficha = $request->input('datos')['no_ficha'];
$beneficiario->modalidad_id = $request->input('datos')['modalidad'];
$beneficiario->puntoatencion_id = $request->input('datos')['punto_atencion'];
$beneficiario->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
$beneficiario->cantidad_hijos_beneficiario = $request->input('datos')['cantidad_hijos_beneficiario'];




$beneficiario->ocupacion_beneficiario = $request->input('datos')['ocupacion_beneficiario'];
$beneficiario->otra_ocupacion_beneficiario = $request->input('datos')['otra_ocupacion_beneficiario'];
$beneficiario->escolaridad_id = $request->input('datos')['escolaridad_beneficiario'];
$beneficiario->cultura_beneficiario = $request->input('datos')['cultura_beneficiario'];
$beneficiario->otra_cultura_beneficiario = $request->input('datos')['otra_cultura_beneficiario'];
$beneficiario->discapacidad_beneficiario = $request->input('datos')['discapacidad_beneficiario'];
$beneficiario->discapacidad_select_beneficiario = $request->input('datos')['discapacidad_select_beneficiario'];
$beneficiario->otra_discapacidad_beneficiario = $request->input('datos')['otra_discapacidad_beneficiario'];
$beneficiario->enfermedad_permanente_beneficiario = $request->input('datos')['enfermedad_permanente_beneficiario'];
$beneficiario->enfermedad_beneficiario = $request->input('datos')['enfermedad_beneficiario'];
$beneficiario->medicamentos_permanente_beneficiario = $request->input('datos')['medicamentos_permanente_beneficiario'];
$beneficiario->medicamentos_beneficiario = $request->input('datos')['medicamentos_beneficiario'];
$beneficiario->seguridad_social_beneficiario = $request->input('datos')['seguridad_social_beneficiario'];
$beneficiario->salud_sgsss_beneficiario = $request->input('datos')['salud_sgsss_beneficiario'];
$beneficiario->nombre_seguridad_beneficiario = $request->input('datos')['nombre_seguridad_beneficiario'];
$beneficiario->id_persona_acudiente = $acudiente_persona->id;
$beneficiario->parentesco_acudiente = $request->input('datos')['parentesco_acudiente'];
$beneficiario->otro_parentesco_acudiente = $request->input('datos')['otro_parentesco_acudiente'];


$beneficiario->tenantId = Auth::user()->tenantId;
$beneficiario->save();

		foreach ($request->input('SelectPoblacional') as $value) {
			$poblacional = new PoblacionalBeneficiario();
			$poblacional->ficha_id = $beneficiario->id;
			$poblacional->grupo_pcs = $value['id']; 		
			$poblacional->save();			

		}

		return response()->json('Guardado');				


	}


	public function ObtenerBeneficiario($id)
	{


	$beneficiario = DB::select('select 
		tbl_gen_persona.nombre_primero,
		tbl_gen_persona.nombre_segundo,
		tbl_gen_persona.apellido_primero,
		tbl_gen_persona.apellido_segundo,
		FORMAT(tbl_gen_persona.documento, 0, \'de_DE\') as documento,
		tbl_gen_persona.fecha_nacimiento,
		tbl_gen_persona.telefono_fijo,
		tbl_gen_persona.telefono_movil,
		tbl_gen_persona.correo_electronico,
		tbl_gen_persona.residencia_direccion,
		tbl_gen_persona.residencia_estrato,
		tbl_gen_persona.sangre_tipo,
		tbl_cm_ficha.id,
		tbl_cm_ficha.fecha_inscripcion,
		tbl_cm_ficha.no_ficha,
		tbl_cm_ficha.modalidad_id,
		tbl_cm_ficha.puntoatencion_id,
		tbl_cm_ficha.cantidad_hijos_beneficiario,
		tbl_cm_ficha.otra_ocupacion_beneficiario,
		tbl_cm_ficha.otra_cultura_beneficiario,
		tbl_cm_ficha.otra_discapacidad_beneficiario,
		tbl_cm_ficha.enfermedad_beneficiario,
		tbl_cm_ficha.medicamentos_beneficiario,
		tbl_cm_ficha.nombre_seguridad_beneficiario,
		tbl_cm_ficha.otro_parentesco_acudiente,
		tbl_cm_ficha.ocupacion_beneficiario,
		
		FORMAT(acudiente.documento, 0, \'de_DE\') as documento_acudiente,
		acudiente.nombre_primero as nombre_primero_acudiente,
		acudiente.nombre_segundo as nombre_segundo_acudiente,
		acudiente.apellido_primero as apellido_primero_acudiente,
		acudiente.apellido_segundo as apellido_segundo_acudiente,
		acudiente.fecha_nacimiento as fecha_nacimiento_acudiente,
		acudiente.telefono_fijo as telefono_fijo_acudiente,
		acudiente.telefono_movil as telefono_movil_acudiente,
		acudiente.correo_electronico as correo_electronico_acudiente

 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	    inner join tbl_gen_persona acudiente ON tbl_cm_ficha.id_persona_acudiente = acudiente.id


 		 where tbl_cm_ficha.id =?', [$id]);

return response()->json(
			$beneficiario
		);


	}



public function ObtenerBeneficiarioFicha($id)
	{


	$beneficiario = DB::select('select 
		tbl_gen_persona.nombre_primero,
		tbl_gen_persona.nombre_segundo,
		tbl_gen_persona.apellido_primero,
		tbl_gen_persona.apellido_segundo,
		FORMAT(tbl_gen_persona.documento, 0, \'de_DE\') as documento,
		tbl_gen_persona.fecha_nacimiento,
		tbl_gen_persona.telefono_fijo,
		tbl_gen_persona.telefono_movil,
		tbl_gen_persona.correo_electronico,
		tbl_gen_persona.residencia_direccion,
		tbl_gen_persona.residencia_estrato,
		tbl_gen_persona.sangre_tipo,
		tbl_gen_documento_tipo.descripcion as tipo_documento,
		paises.nombre_pais,
		departamentos.nombre_departamento,
		municipios.nombre_municipio,
		barrios.nombre_barrio,
		tbl_gen_corregimientos.descripcion as corregimiento,
		tbl_gen_veredas.nombre as vereda,
		tbl_gen_estado_civil.descripcion as estado_civil,
		tbl_gen_escolaridad_nivel.descripcion as escolaridad,
		tbl_gen_discapacidad.descripcion as discapacidad,
		tbl_gen_eps.descripcion as saludEps,
		tbl_cm_ficha.id,
		tbl_cm_ficha.fecha_inscripcion,
		tbl_cm_ficha.no_ficha,
		tbl_cm_modalidades.nombre as modalidad,
		tbl_cm_punto_atencion.nombre as punto_atencion,
		tbl_cm_ficha.cantidad_hijos_beneficiario,
		tbl_cm_ficha.otra_ocupacion_beneficiario,
		tbl_cm_ficha.otra_cultura_beneficiario,
		tbl_cm_ficha.otra_discapacidad_beneficiario,
		tbl_cm_ficha.enfermedad_beneficiario,
		tbl_cm_ficha.medicamentos_beneficiario,
		tbl_cm_ficha.nombre_seguridad_beneficiario,
		tbl_cm_ficha.otro_parentesco_acudiente,
		
		FORMAT(acudiente.documento, 0, \'de_DE\') as documento_acudiente,
		acudiente.nombre_primero as nombre_primero_acudiente,
		acudiente.nombre_segundo as nombre_segundo_acudiente,
		acudiente.apellido_primero as apellido_primero_acudiente,
		acudiente.apellido_segundo as apellido_segundo_acudiente,
		acudiente.fecha_nacimiento as fecha_nacimiento_acudiente,
		acudiente.telefono_fijo as telefono_fijo_acudiente,
		acudiente.telefono_movil as telefono_movil_acudiente,
		acudiente.correo_electronico as correo_electronico_acudiente

 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	   
	    inner join tbl_gen_persona acudiente ON tbl_cm_ficha.id_persona_acudiente = acudiente.id
	   
	    inner join tbl_gen_documento_tipo ON tbl_gen_persona.id_documento_tipo = tbl_gen_documento_tipo.id
	
		inner join tbl_cm_modalidades ON tbl_cm_modalidades.id = tbl_cm_ficha.modalidad_id

		inner join tbl_cm_punto_atencion ON tbl_cm_punto_atencion.id = tbl_cm_ficha.puntoatencion_id

		inner join paises ON tbl_gen_persona.id_procedencia_pais = paises.id
		inner join departamentos ON tbl_gen_persona.id_procedencia_departamento = departamentos.id
		inner join municipios ON tbl_gen_persona.id_procedencia_municipio = municipios.id
		inner join barrios ON tbl_gen_persona.id_residencia_barrio = barrios.id
		inner join tbl_gen_corregimientos ON tbl_gen_persona.id_residencia_corregimiento = tbl_gen_corregimientos.id
		inner join tbl_gen_veredas ON tbl_gen_persona.id_residencia_vereda = tbl_gen_veredas.id
		left join tbl_gen_estado_civil ON tbl_gen_persona.id_estado_civil = tbl_gen_estado_civil.id


	    left join tbl_gen_escolaridad_nivel ON tbl_cm_ficha.escolaridad_id = tbl_gen_escolaridad_nivel.id

	    left join tbl_gen_discapacidad ON tbl_cm_ficha.discapacidad_id = tbl_gen_discapacidad.id
	    left join tbl_gen_eps ON tbl_cm_ficha.salud_sgss_id = tbl_gen_eps.id
	

	

 		 where tbl_cm_ficha.id =?', [$id]);

return response()->json(
			$beneficiario
		);


	}


public function CargarBeneficiario($id)
	{


	$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
	
	    $persona = DB::select('select 
		tbl_gen_persona.nombre_primero,
		tbl_gen_persona.nombre_segundo,
		tbl_gen_persona.apellido_primero,
		tbl_gen_persona.apellido_segundo,
		FORMAT(tbl_gen_persona.documento, 0, \'de_DE\') as documento,
		tbl_gen_persona.id_documento_tipo,
		tbl_gen_persona.sexo,
		tbl_gen_persona.sangre_tipo,
		tbl_gen_persona.fecha_nacimiento,
		tbl_gen_persona.telefono_fijo,
		tbl_gen_persona.telefono_movil,
		tbl_gen_persona.correo_electronico,
		tbl_gen_persona.id_procedencia_pais,
		tbl_gen_persona.id_procedencia_departamento,
		tbl_gen_persona.id_procedencia_municipio,
		tbl_gen_persona.otro_municipio,
		tbl_gen_persona.residencia_direccion,
		tbl_gen_persona.residencia_estrato,
		tbl_gen_persona.id_residencia_barrio,
		tbl_gen_persona.id_residencia_corregimiento,
		tbl_gen_persona.id_residencia_vereda,
		tbl_gen_persona.id_estado_civil,
		tbl_gen_persona.sangre_tipo,
		tbl_gen_persona.escolaridad_id,
		tbl_gen_persona.estado_escolaridad,
		tbl_gen_persona.ocupacion_id
 		from tbl_gen_persona  	
	    where tbl_gen_persona.documento =?', [$documento]);

		    $ficha = DB::table('tbl_cm_ficha')
          ->join(
            'tbl_gen_persona',
            'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
 
    ->select(DB::raw(
      "
     tbl_cm_ficha.id as ficha_save,
        tbl_cm_ficha.fecha_inscripcion,
        tbl_cm_ficha.no_ficha,
        tbl_cm_ficha.hijos_beneficiario,
        tbl_cm_ficha.cantidad_hijos_beneficiario,
        tbl_cm_ficha.ocupacion_beneficiario,
        tbl_cm_ficha.escolaridad_id,
        tbl_cm_ficha.cultura_beneficiario,
        tbl_cm_ficha.estado_escolaridad,
        tbl_cm_ficha.discapacidad_beneficiario,
        tbl_cm_ficha.discapacidad_id,
        tbl_cm_ficha.otra_discapacidad_beneficiario,
        tbl_cm_ficha.medicamentos_permanente_beneficiario,
        tbl_cm_ficha.medicamentos_beneficiario,
        tbl_cm_ficha.condicion_discapacidad,
		tbl_cm_ficha.condicion_discapacidad_otro,
		
        tbl_cm_ficha.afiliacion_salud,
        tbl_cm_ficha.tipo_afiliacion,
        tbl_cm_ficha.salud_sgss_id,
        tbl_cm_ficha.id_persona_acudiente,
        tbl_cm_ficha.parentesco_acudiente,
        tbl_cm_ficha.otro_parentesco_acudiente,
        tbl_cm_ficha.fecha_retiro,
        tbl_cm_ficha.otro_poblacional,
		tbl_cm_ficha.clubes_deportivos_id,
        tbl_cm_ficha.comuna_id,
        tbl_cm_ficha.tenantId
  ")

)->where('tbl_gen_persona.documento', '=', $documento)->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->get();
		  
	 	$acudiente = DB::select('select 
		FORMAT(acudiente.documento, 0, \'de_DE\') as documento_acudiente,
		acudiente.nombre_primero as nombre_primero_acudiente,
		acudiente.nombre_segundo as nombre_segundo_acudiente,
		acudiente.apellido_primero as apellido_primero_acudiente,
		acudiente.apellido_segundo as apellido_segundo_acudiente,
		acudiente.fecha_nacimiento as fecha_nacimiento_acudiente,
		acudiente.telefono_fijo as telefono_fijo_acudiente,
		acudiente.telefono_movil as telefono_movil_acudiente,
		acudiente.correo_electronico as correo_electronico_acudiente,
		acudiente.id_documento_tipo as tipodocacudiente,
		acudiente.sexo as sexoacudiente,
		acudiente.sexo_acudiente_otro as sexo_acudiente_otro
		from tbl_cm_ficha 
		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
		inner join tbl_gen_persona acudiente ON tbl_cm_ficha.id_persona_acudiente = acudiente.id
		where tbl_gen_persona.documento =? and tbl_cm_ficha.tenantId=?', [$documento, Auth::user()->tenantId]);



		return	Response::json(array('persona'=>$persona,'ficha'=>$ficha,'acudiente'=>$acudiente));

	}


	public function CargarBeneficiarioPrograma($id)
	{

	
	$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
	$where  = array();
  	$wheres = '';
	$where[]  = 'tbl_gen_persona.documento=' . $documento;
	$wheres = 'where ' . implode(' and ', $where);
	$tenanId = Auth::user()->tenantId;
  	$whereTenanId[]  = 'tbl_pr_ficha.tenantId=' . (int)$tenanId;    
  	$wheresTenanId = 'and ' . implode(' and ', $whereTenanId);
	
	    $persona = DB::select('select 
		tbl_gen_persona.nombre_primero,
		tbl_gen_persona.nombre_segundo,
		tbl_gen_persona.apellido_primero,
		tbl_gen_persona.apellido_segundo,
		FORMAT(tbl_gen_persona.documento, 0, \'de_DE\') as documento,
		tbl_gen_persona.id_documento_tipo,
		tbl_gen_persona.sexo,
		tbl_gen_persona.sangre_tipo,
		tbl_gen_persona.fecha_nacimiento,
		tbl_gen_persona.telefono_fijo,
		tbl_gen_persona.telefono_movil,
		tbl_gen_persona.correo_electronico,
		tbl_gen_persona.id_procedencia_pais,
		tbl_gen_persona.id_procedencia_departamento,
		tbl_gen_persona.id_procedencia_municipio,
		tbl_gen_persona.otro_municipio,
		tbl_gen_persona.residencia_direccion,
		tbl_gen_persona.residencia_estrato,
		tbl_gen_persona.id_residencia_barrio,
		tbl_gen_persona.id_residencia_corregimiento,
		tbl_gen_persona.id_residencia_vereda,
		tbl_gen_persona.id_estado_civil,
		tbl_gen_persona.sangre_tipo,
		tbl_gen_persona.escolaridad_id,
		tbl_gen_persona.estado_escolaridad,
		tbl_gen_persona.ocupacion_id

 		from tbl_gen_persona  	
	    where tbl_gen_persona.documento =?', [$documento]);

	 $ficha = DB::select('select 
		tbl_pr_ficha.id as ficha_save,
		tbl_pr_ficha.grupo_id,
		tbl_pr_ficha.fecha_inscripcion,
		tbl_pr_ficha.no_ficha,
		tbl_pr_ficha.hijos_beneficiario,
		tbl_pr_ficha.cantidad_hijos_beneficiario,
		tbl_pr_ficha.ocupacion_beneficiario,
		tbl_pr_ficha.escolaridad_id,
		tbl_pr_ficha.estado_escolaridad,
		tbl_pr_ficha.cultura_beneficiario,
		tbl_pr_ficha.discapacidad_beneficiario,
		tbl_pr_ficha.otra_discapacidad_beneficiario,
		tbl_pr_ficha.medicamentos_permanente_beneficiario,
		tbl_pr_ficha.medicamentos_beneficiario,
		tbl_pr_ficha.condicion_discapacidad,
		tbl_pr_ficha.condicion_discapacidad_otro,
		
		tbl_pr_ficha.afiliacion_salud,
		tbl_pr_ficha.tipo_afiliacion,
		tbl_pr_ficha.salud_sgss_id,
		tbl_pr_ficha.parentesco_acudiente,
		tbl_pr_ficha.otro_parentesco_acudiente,
		tbl_pr_ficha.fecha_retiro,
		tbl_pr_ficha.otro_poblacional,
		tbl_pr_ficha.clubes_deportivos_id,
		tbl_pr_ficha.tenantId,
		tbl_pr_ficha.comuna_id
  
  FROM
  `tbl_pr_ficha`
  inner join `tbl_gen_persona` ON (`tbl_gen_persona`.`id` = `tbl_pr_ficha`.`id_persona_beneficiario`)
 
  '.$wheres.' ' .$wheresTenanId.'');
		  
	 	$acudiente = DB::select('select 
		FORMAT(acudiente.documento, 0, \'de_DE\') as documento_acudiente,
		acudiente.nombre_primero as nombre_primero_acudiente,
		acudiente.nombre_segundo as nombre_segundo_acudiente,
		acudiente.apellido_primero as apellido_primero_acudiente,
		acudiente.apellido_segundo as apellido_segundo_acudiente,
		acudiente.fecha_nacimiento as fecha_nacimiento_acudiente,
		acudiente.telefono_fijo as telefono_fijo_acudiente,
		acudiente.telefono_movil as telefono_movil_acudiente,
		acudiente.correo_electronico as correo_electronico_acudiente,
		acudiente.id_documento_tipo as tipodocacudiente,
		acudiente.sexo as sexoacudiente,
		acudiente.sexo_acudiente_otro as sexo_acudiente_otro
		from tbl_pr_ficha 
		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_pr_ficha.id_persona_beneficiario
		inner join tbl_gen_persona acudiente ON tbl_pr_ficha.id_persona_acudiente = acudiente.id
		'.$wheres.' ' .$wheresTenanId.'');

		return	Response::json(array('persona'=>$persona,'ficha'=>$ficha,'acudiente'=>$acudiente));

	}

	public function CargarFicha($id)
	{


	$beneficiario = DB::select('select 
		tbl_gen_persona.nombre_primero,
		tbl_gen_persona.nombre_segundo,
		tbl_gen_persona.apellido_primero,
		tbl_gen_persona.apellido_segundo,
		FORMAT(tbl_gen_persona.documento, 0, \'de_DE\') as documento,
		tbl_gen_persona.id_documento_tipo,
		tbl_gen_persona.sexo,
		
		tbl_gen_persona.tipo_genero_r,
		tbl_gen_persona.tipo_orientacion_sexual,
		tbl_gen_persona.orientacion_sexual_otro,
		
		tbl_gen_persona.sangre_tipo,
		tbl_gen_persona.fecha_nacimiento,
		tbl_gen_persona.telefono_fijo,
		tbl_gen_persona.telefono_movil,
		tbl_gen_persona.correo_electronico,
		tbl_gen_persona.id_procedencia_pais AS pais,
		tbl_gen_persona.id_procedencia_departamento,
		tbl_gen_persona.id_procedencia_municipio,
		tbl_gen_persona.otro_municipio,
		tbl_gen_persona.residencia_direccion,
		tbl_gen_persona.residencia_estrato,
		tbl_gen_persona.id_residencia_barrio,
		tbl_gen_persona.id_residencia_corregimiento,
		tbl_gen_persona.id_residencia_vereda,
		tbl_gen_persona.id_estado_civil,
		tbl_gen_persona.sangre_tipo,
		tbl_gen_persona.escolaridad_id,
		tbl_gen_persona.estado_escolaridad,
		tbl_gen_persona.ocupacion_id,
		
		tbl_cm_ficha.id as ficha_save,
		tbl_cm_ficha.fecha_inscripcion,
		tbl_cm_ficha.no_ficha,
		tbl_cm_ficha.hijos_beneficiario,
		tbl_cm_ficha.cantidad_hijos_beneficiario,
		tbl_cm_ficha.ocupacion_beneficiario,
		tbl_cm_ficha.cultura_beneficiario,
		tbl_cm_ficha.estado_escolaridad,
		tbl_cm_ficha.discapacidad_beneficiario,
		tbl_cm_ficha.discapacidad_id,
		tbl_cm_ficha.otra_discapacidad_beneficiario,
		tbl_cm_ficha.medicamentos_permanente_beneficiario,
		tbl_cm_ficha.medicamentos_beneficiario,
		tbl_cm_ficha.condicion_discapacidad,
		tbl_cm_ficha.condicion_discapacidad_otro,
		
		tbl_cm_ficha.afiliacion_salud,
		tbl_cm_ficha.tipo_afiliacion,
		tbl_cm_ficha.salud_sgss_id,
		tbl_cm_ficha.id_persona_acudiente,
		tbl_cm_ficha.parentesco_acudiente,
		tbl_cm_ficha.otro_parentesco_acudiente,
		tbl_cm_ficha.fecha_retiro,
		tbl_cm_ficha.otro_poblacional,
		tbl_cm_ficha.clubes_deportivos_id,
		tbl_cm_ficha.comuna_id,
		FORMAT(acudiente.documento, 0, \'de_DE\') as documento_acudiente,
		acudiente.nombre_primero as nombre_primero_acudiente,
		acudiente.nombre_segundo as nombre_segundo_acudiente,
		acudiente.apellido_primero as apellido_primero_acudiente,
		acudiente.apellido_segundo as apellido_segundo_acudiente,
		acudiente.fecha_nacimiento as fecha_nacimiento_acudiente,
		acudiente.telefono_fijo as telefono_fijo_acudiente,
		acudiente.telefono_movil as telefono_movil_acudiente,
		acudiente.correo_electronico as correo_electronico_acudiente,
		acudiente.id_documento_tipo as tipodocacudiente,
		acudiente.sexo as sexoacudiente,
		acudiente.sexo_acudiente_otro as sexo_acudiente_otro

 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	    left join tbl_gen_persona acudiente ON tbl_cm_ficha.id_persona_acudiente = acudiente.id


 		 where tbl_cm_ficha.id =?', [(int)$id]);

return response()->json(
			$beneficiario
		);


	}


	public function CargarFichaPrograma($id)
	
	{

	$beneficiario = DB::select('select 
		tbl_gen_persona.nombre_primero,
		tbl_gen_persona.nombre_segundo,
		tbl_gen_persona.apellido_primero,
		tbl_gen_persona.apellido_segundo,
		FORMAT(tbl_gen_persona.documento, 0, \'de_DE\') as documento,
		tbl_gen_persona.id_documento_tipo,
		tbl_gen_persona.sexo,
		
		tbl_gen_persona.tipo_genero_r,
		tbl_gen_persona.tipo_orientacion_sexual,
		tbl_gen_persona.orientacion_sexual_otro,
		
		tbl_gen_persona.sangre_tipo,
		tbl_gen_persona.fecha_nacimiento,
		tbl_gen_persona.telefono_fijo,
		tbl_gen_persona.telefono_movil,
		tbl_gen_persona.correo_electronico,
		tbl_gen_persona.id_procedencia_pais AS pais,
		tbl_gen_persona.id_procedencia_departamento,
		tbl_gen_persona.id_procedencia_municipio,
		tbl_gen_persona.otro_municipio,
		tbl_gen_persona.residencia_direccion,
		tbl_gen_persona.residencia_estrato,
		tbl_gen_persona.id_residencia_barrio,
		tbl_gen_persona.id_residencia_corregimiento,
		tbl_gen_persona.id_residencia_vereda,
		tbl_gen_persona.id_estado_civil,
		tbl_gen_persona.sangre_tipo,
		tbl_gen_persona.escolaridad_id,
		tbl_gen_persona.estado_escolaridad,
		tbl_gen_persona.ocupacion_id,
		tbl_pr_ficha.id as ficha_save,
		tbl_pr_ficha.id_persona_beneficiario,
		tbl_pr_ficha.grupo_id,
		tbl_pr_ficha.fecha_inscripcion,
		tbl_pr_ficha.no_ficha,
		tbl_pr_ficha.hijos_beneficiario,
		tbl_pr_ficha.cantidad_hijos_beneficiario,
		tbl_pr_ficha.ocupacion_beneficiario,
		tbl_pr_ficha.cultura_beneficiario,
		tbl_pr_ficha.discapacidad_beneficiario,
		tbl_pr_ficha.otra_discapacidad_beneficiario,
		tbl_pr_ficha.medicamentos_permanente_beneficiario,
		tbl_pr_ficha.medicamentos_beneficiario,
		tbl_pr_ficha.condicion_discapacidad,
		tbl_pr_ficha.condicion_discapacidad_otro,
		tbl_pr_ficha.afiliacion_salud,
		tbl_pr_ficha.tipo_afiliacion,
		tbl_pr_ficha.salud_sgss_id,
		tbl_pr_ficha.id_persona_acudiente,
		tbl_pr_ficha.parentesco_acudiente,
		tbl_pr_ficha.otro_parentesco_acudiente,
		tbl_pr_ficha.fecha_retiro,
		tbl_pr_ficha.otro_poblacional,
		tbl_pr_ficha.clubes_deportivos_id,
		tbl_pr_ficha.tenantId,
		tbl_pr_ficha.comuna_id,
		FORMAT(acudiente.documento, 0, \'de_DE\') as documento_acudiente,
		acudiente.nombre_primero as nombre_primero_acudiente,
		acudiente.nombre_segundo as nombre_segundo_acudiente,
		acudiente.apellido_primero as apellido_primero_acudiente,
		acudiente.apellido_segundo as apellido_segundo_acudiente,
		acudiente.fecha_nacimiento as fecha_nacimiento_acudiente,
		acudiente.telefono_fijo as telefono_fijo_acudiente,
		acudiente.telefono_movil as telefono_movil_acudiente,
		acudiente.correo_electronico as correo_electronico_acudiente,
		acudiente.id_documento_tipo as tipodocacudiente,
		acudiente.sexo as sexoacudiente,
		acudiente.sexo_acudiente_otro as sexo_acudiente_otro

 		from tbl_pr_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_pr_ficha.id_persona_beneficiario
	    left join tbl_gen_persona acudiente ON tbl_pr_ficha.id_persona_acudiente = acudiente.id
 		where tbl_pr_ficha.id =?', [$id]);

		return response()->json(
			$beneficiario
		);
}


public function CargarBeneficiarioAcudiente($id)
	{


	$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
	$acudiente = DB::select('select 
		
		FORMAT(acudiente.documento, 0, \'de_DE\') as documento_acudiente,
		acudiente.nombre_primero as nombre_primero_acudiente,
		acudiente.nombre_segundo as nombre_segundo_acudiente,
		acudiente.apellido_primero as apellido_primero_acudiente,
		acudiente.apellido_segundo as apellido_segundo_acudiente,
		acudiente.fecha_nacimiento as fecha_nacimiento_acudiente,
		acudiente.telefono_fijo as telefono_fijo_acudiente,
		acudiente.telefono_movil as telefono_movil_acudiente,
		acudiente.correo_electronico as correo_electronico_acudiente,
		acudiente.id_documento_tipo as tipodocacudiente,
		acudiente.sexo as sexoacudiente,
		acudiente.sexo_acudiente_otro as sexo_acudiente_otro

 		from tbl_gen_persona as acudiente 
	 
 		 where acudiente.documento =?', [$documento]);

return response()->json(
			$acudiente
		);


	}



	public function ObtenerProgramas()
	{

		$programa = Programa::select('programas.id', 'programas.nombre_programa')->get();
		return response()->json(
			$programa->toArray());

	}

	
	public function ObtenerEscolaridades()
	{

		$escolaridad = DB::table('tbl_gen_escolaridad_nivel')
		    ->select(
		         'id',
		          DB::raw('UPPER(descripcion) as descripcion'))
		          ->orderBy('descripcion', 'asc')
		          ->get();
		          
		return response()->json(
			$escolaridad->toArray());

	}

	public function ObtenerEscolaridadesGrados()
	{
		
		$escolaridad = Grado::select('tbl_cm_grados.id', 'tbl_cm_grados.nombre_grado')->get();
		return response()->json(
			$escolaridad->toArray());

	}
	
	public function ObtenerEscolaridadesGrados2()
	{
		
		$datos = Grado::select('tbl_cm_grados.id', 'tbl_cm_grados.nombre_grado')->get();
		return ['datos' => $datos];

	}
	


	public function ObtenerPrograma($id)
	{

		$programa = Beneficiario::select('programas.id', 'programas.nombre_programa')->join('programas',
			'programas.id', '=', 'beneficiarios.programa_id')->where('beneficiarios.id', '=', $id)->firstOrfail();
		return response()->json(
			$programa->toArray());
	}

	public function ObtenerPais($id)
	{


	$pais = DB::select('select 
		paises.id,
		paises.nombre_pais
 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	    inner join paises on paises.id = tbl_gen_persona.id_procedencia_pais
 		 where tbl_cm_ficha.id =?', [$id]);

return response()->json(
			$pais
		);



	}




	public function ObtenerDepartamento($id)
	{

		$departamento = DB::select('select 
		departamentos.id,
		departamentos.nombre_departamento
 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	    inner join departamentos on departamentos.id = tbl_gen_persona.id_procedencia_departamento
 		 where tbl_cm_ficha.id =?', [$id]);

return response()->json(
			$departamento
		);



	}

	public function ObtenerMunicipio($id)
	{



		$municipio = DB::select('select 
		municipios.id,
		municipios.nombre_municipio
 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	    inner join municipios on municipios.id = tbl_gen_persona.id_procedencia_municipio
 		 where tbl_cm_ficha.id =?', [$id]);

		return response()->json(
			$municipio
		);



	}


	public function ObtenerComuna($id)
	{

		$comuna = Beneficiario::select('comunas.id', 'comunas.nombre_comuna')->join('comunas',
			'comunas.id', '=', 'beneficiarios.comuna_id')->where('beneficiarios.id', '=', $id)->firstOrfail();
		return response()->json(
			$comuna->toArray());
	}


	public function ObtenerBarrio($id)
	{


	$barrio = DB::select('select 
		barrios.id,
		barrios.nombre_barrio
 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	    inner join barrios on barrios.id = tbl_gen_persona.id_residencia_barrio
 		 where tbl_cm_ficha.id =?', [$id]);

		return response()->json(
			$barrio
		);

	}




	public function ObtenerComunaBarrio($id)
	{


	$comuna_barrio = DB::select('select 
		comunas.id,
		comunas.nombre_comuna
 		from barrios 
 		inner join comunas on comunas.id = barrios.comuna_id
		 where barrios.id =?', [$id]);

		return response()->json(
			$comuna_barrio
		);

	}




	public function ObtenerCorregimiento($id)
	{


	$corregimiento = DB::select('select 
		tbl_gen_corregimientos.id,
		tbl_gen_corregimientos.descripcion
 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	    inner join tbl_gen_corregimientos on tbl_gen_corregimientos.id = tbl_gen_persona.id_residencia_corregimiento
 		 where tbl_cm_ficha.id =?', [$id]);

		return response()->json(
			$corregimiento
		);

	}


	public function ObtenerVereda($id)
	{

	$vereda = Vereda::select('tbl_gen_veredas.id', 'tbl_gen_veredas.nombre')->join(
					'tbl_gen_corregimientos',
					'tbl_gen_corregimientos.id', '=', 'tbl_gen_veredas.corregimiento_id')->where('tbl_gen_corregimientos.id', '=', $id)->get();
				return response()->json(
					$vereda
				);

	}



	public function ObtenerVeredaID($id)
	{

	$vereda = DB::select('select 
		tbl_gen_veredas.id,
		tbl_gen_veredas.nombre
 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	    inner join tbl_gen_veredas on tbl_gen_veredas.id = tbl_gen_persona.id_residencia_vereda
 		 where tbl_cm_ficha.id =?', [$id]);

		return response()->json(
			$vereda
		);

	}

	public function ObtenerTipoDocumento($id)
	{

	$tipodocumento = DB::select('select 
		tbl_gen_persona.id_documento_tipo as id
 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario


 		 where tbl_cm_ficha.id =?', [$id]);

return response()->json(
			$tipodocumento
		);


	}

	public function ObtenerSexo($id)
	{


$sexo = FichaComunidad::select('tbl_gen_persona.sexo as id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$sexo->toArray());




	}


	public function ObtenerCivil($id)
	{


$civil = FichaComunidad::select('tbl_gen_persona.id_estado_civil as id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$civil->toArray());



	}

	public function ObtenerHijos($id)
	{

	
		$hijos = FichaComunidad::select('tbl_cm_ficha.hijos_beneficiario as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$hijos->toArray());


	}

	public function ObtenerTipoSangre($id)
	{

	


$tiposangre = FichaComunidad::select('tbl_gen_persona.sangre_tipo')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$tiposangre->toArray());



	}

	public function ObtenerOcupacion($id)
	{



		$ocupacion = FichaComunidad::select('tbl_cm_ficha.ocupacion_beneficiario as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$ocupacion->toArray());
		


	}

	public function ObtenerEscolaridad($id)
	{

		$escolaridad = FichaComunidad::select('tbl_cm_ficha.escolaridad_id as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$escolaridad->toArray());

	}

	public function ObtenerCultura($id)
	{


		$cultura = FichaComunidad::select('tbl_cm_ficha.cultura_beneficiario as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$cultura->toArray());



	}


	public function ObtenerPoblacionales($id)
	{

		$poblacionales = PoblacionalBeneficiario::select('poblacional_beneficiarios.grupo_pcs as id', 'poblacional_beneficiarios.id as value_id')->where('poblacional_beneficiarios.ficha_id', '=', $id)->get();
		return response()->json(
			$poblacionales->toArray());
	}


	public function ObtenerPoblacionalesProgramas($id)
	{

		$poblacionales = PoblacionalPrograma::select('tbl_pr_poblacional_beneficiarios.grupo_pcs as id', 'tbl_pr_poblacional_beneficiarios.id as value_id')->where('tbl_pr_poblacional_beneficiarios.ficha_id', '=', $id)->get();
		return response()->json(
			$poblacionales->toArray());
	}

	public function ObtenerPoblacionalesDocumento($id)
	{


		$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
		$poblacionales = PoblacionalBeneficiario::select('poblacional_beneficiarios.grupo_pcs as id', 'poblacional_beneficiarios.id as value_id')->join(
			'tbl_cm_ficha',
			'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->where('tbl_gen_persona.documento', '=', $documento)->get();
		return response()->json(
			$poblacionales->toArray());
	}

	public function ProgramaPoblacionalesDocumento($id)
	{


		$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
		$poblacionales = PoblacionalPrograma::select('tbl_pr_poblacional_beneficiarios.grupo_pcs as id', 'tbl_pr_poblacional_beneficiarios.id as value_id')->join(
			'tbl_pr_ficha',
			'tbl_pr_ficha.id', '=', 'tbl_pr_poblacional_beneficiarios.ficha_id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')->where('tbl_gen_persona.documento', '=', $documento)->get();
		return response()->json(
			$poblacionales->toArray());
	}


	public function ObtenerDiscapacidadesDocumento($id)
	{


		$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
		$discapacidades = PersonaDiscapacidad::select('tbl_cm_persona_x_discapacidad.discapacidad_id as id', 'tbl_cm_persona_x_discapacidad.id as value_id')
		->join(
			'tbl_cm_ficha',
			'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->where('tbl_gen_persona.documento', '=', $documento)->get();
		return response()->json(
			$discapacidades->toArray());
	
	}

	public function ProgramaDiscapacidadesDocumento($id)
	{


		$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
		$discapacidades = ProgramaDiscapacidad::select('tbl_pr_persona_x_discapacidad.discapacidad_id as id', 'tbl_pr_persona_x_discapacidad.id as value_id')
		->join(
			'tbl_pr_ficha',
			'tbl_pr_ficha.id', '=', 'tbl_pr_persona_x_discapacidad.ficha_id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')->where('tbl_gen_persona.documento', '=', $documento)->get();
		return response()->json(
			$discapacidades->toArray());
	
	}


	public function ObtenerDiscapacidadesFicha($id)
	{


		$discapacidades = PersonaDiscapacidad::select('tbl_cm_persona_x_discapacidad.discapacidad_id as id', 'tbl_cm_persona_x_discapacidad.id as value_id')
		->join(
			'tbl_cm_ficha',
			'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->where('tbl_cm_ficha.id', '=', $id)->get();
		return response()->json(
			$discapacidades->toArray());
	
	}


public function ObtenerDiscapacidadesPrograma($id)
	{


		$discapacidades = ProgramaDiscapacidad::select('tbl_pr_persona_x_discapacidad.discapacidad_id as id', 'tbl_pr_persona_x_discapacidad.id as value_id')
		->join(
			'tbl_pr_ficha',
			'tbl_pr_ficha.id', '=', 'tbl_pr_persona_x_discapacidad.ficha_id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')->where('tbl_pr_ficha.id', '=', $id)->get();
		return response()->json(
			$discapacidades->toArray());
	
	}


	public function ActualizarBeneficiario(Request $request, $id)
	{


$persona = Persona::select('tbl_gen_persona.*')->join(
			'tbl_cm_ficha',
			'tbl_cm_ficha.id_persona_beneficiario', '=', 'tbl_gen_persona.id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
$persona->correo_electronico = $request->input('datos')['correo_persona'];

$persona->sexo = $request->input('datos')['sexo_persona'];
$persona->tipo_genero_r = (isset($request->input('datos')['tipo_genero_r'])?$request->input('datos')['tipo_genero_r']:null);
$persona->tipo_orientacion_sexual = (isset($request->input('datos')['tipo_orientacion_sexual'])?$request->input('datos')['tipo_orientacion_sexual']:null);
$persona->orientacion_sexual_otro = (isset($request->input('datos')['orientacion_sexual_otro'])?$request->input('datos')['orientacion_sexual_otro']:null);
			

$persona->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_persona']));
$persona->id_procedencia_pais = $request->input('datos')['pais_id'];
$persona->id_procedencia_departamento = $request->input('datos')['departamento_id'];
$persona->id_procedencia_municipio = $request->input('datos')['municipio_id'];
$persona->otro_municipio = $request->input('datos')['otro_municipio'];
$persona->id_residencia_corregimiento = $request->input('datos')['corregimiento'];
$persona->id_residencia_vereda = $request->input('datos')['vereda'];
$persona->id_residencia_barrio = $request->input('datos')['barrio_id'];
$persona->residencia_estrato = $request->input('datos')['estrato'];
$persona->residencia_direccion = $request->input('datos')['residencia_persona'] . $request->input('datos')['complemento'];
$persona->telefono_fijo = $request->input('datos')['telefono_fijo_persona'];
$persona->telefono_movil = $request->input('datos')['telefono_movil_persona'];
$persona->sangre_tipo  = $request->input('datos')['tip_sangre_persona'];
$persona->id_estado_civil  = $request->input('datos')['estado_civil_persona'];
$persona->escolaridad_id = $request->input('datos')['escolaridad_beneficiario'];
$persona->estado_escolaridad = $request->input('datos')['estado_escolaridad'];
$persona->ocupacion_id = $request->input('datos')['ocupacion_beneficiario'];
$persona->tenantId = Auth::user()->tenantId;	
$persona->save();




if ($request->input('datos')['no_documento_acudiente'] != null) {

	$acudiente_persona = Persona::select('tbl_gen_persona.*')->join(
			'tbl_cm_ficha',
			'tbl_cm_ficha.id_persona_acudiente', '=', 'tbl_gen_persona.id')
			->firstOrNew([
    'tbl_cm_ficha.id' => $id,
]);


$acudiente_persona->nombre_primero = $request->input('datos')['primer_nombre_acudiente'];
$acudiente_persona->nombre_segundo = $request->input('datos')['segundo_nombre_acudiente'];
$acudiente_persona->apellido_primero = $request->input('datos')['primer_apellido_acudiente'];
$acudiente_persona->apellido_segundo = $request->input('datos')['segundo_apellido_acudiente'];
$acudiente_persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_acudiente']));
$acudiente_persona->id_documento_tipo = $request->input('datos')['tip_doc_acudiente'];
$acudiente_persona->sexo = $request->input('datos')['sex_pariente'];
$acudiente_persona->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_acudiente']));
$acudiente_persona->telefono_fijo = $request->input('datos')['telefono_fijo_acudiente'];
$acudiente_persona->telefono_movil = $request->input('datos')['telefono_movil_acudiente'];
$acudiente_persona->correo_electronico = $request->input('datos')['correo_acudiente'];
$acudiente_persona->tenantId = Auth::user()->tenantId;
$acudiente_persona->save();

}





	
$beneficiario = FichaComunidad::where('tbl_cm_ficha.id', '=', $id)->firstOrfail();
$beneficiario->id_persona_beneficiario = $persona->id;
$beneficiario->no_ficha = $request->input('datos')['no_ficha'];
$beneficiario->fecha_inscripcion = date('Y-m-d',strtotime($request->input('datos')['fecha_inscripcion']));
$beneficiario->escolaridad_id = $request->input('datos')['escolaridad_beneficiario'];
$beneficiario->estado_escolaridad = $request->input('datos')['estado_escolaridad'];
$beneficiario->ocupacion_beneficiario = $request->input('datos')['ocupacion_beneficiario'];
$beneficiario->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
$beneficiario->cantidad_hijos_beneficiario = $request->input('datos')['cantidad_hijos_beneficiario'];
$beneficiario->cultura_beneficiario = $request->input('datos')['cultura_beneficiario'];
$beneficiario->discapacidad_beneficiario = $request->input('datos')['discapacidad_beneficiario'];
$beneficiario->otra_discapacidad_beneficiario = $request->input('datos')['otra_discapacidad_beneficiario'];
$beneficiario->medicamentos_permanente_beneficiario = $request->input('datos')['medicamentos_permanente_beneficiario'];
$beneficiario->medicamentos_beneficiario = $request->input('datos')['medicamentos_beneficiario'];
$beneficiario->condicion_discapacidad = $request->input('datos')['condicion_discapacidad'];
$beneficiario->condicion_discapacidad_otro = (!isset($request->input('datos')['condicion_discapacidad_otro'])?null:$request->input('datos')['condicion_discapacidad_otro']);
$beneficiario->afiliacion_salud = $request->input('datos')['afiliacion_salud'];
$beneficiario->tipo_afiliacion = $request->input('datos')['tipo_afiliacion'];
$beneficiario->salud_sgss_id = $request->input('datos')['salud_sgsss_beneficiario'];
$beneficiario->parentesco_acudiente = $request->input('datos')['parentesco_acudiente'];
$beneficiario->otro_parentesco_acudiente = $request->input('datos')['otro_parentesco_acudiente'];

if ($request->input('datos')['no_documento_acudiente'] == null) {

$beneficiario->id_persona_acudiente = null;
}
else
{
$beneficiario->id_persona_acudiente = $acudiente_persona->id;

}

$beneficiario->otro_poblacional = $request->input('datos')['otro_poblacional'];
$beneficiario->clubes_deportivos_id = ($request->input('datos')['clubes_deportivos_id'] == null ? null :$request->input('datos')['clubes_deportivos_id']);
$beneficiario->comuna_id = $request->input('datos')['comuna'];
$beneficiario->tenantId = Auth::user()->tenantId;
$beneficiario->save();

if($request->input('SelectPoblacional') != null)
{
foreach ($request->input('SelectPoblacional') as $value) {
		
	$poblacional = null;					
	if (isset($value['value_id'])) {

		$poblacional = PoblacionalBeneficiario::find($value['value_id']);

	}	
	else {
		$poblacional = new PoblacionalBeneficiario();

	}

	$poblacional->ficha_id	= $beneficiario->id;
	$poblacional->grupo_pcs			= $value['id']; 		
	$poblacional->save();
}
}


if($request->input('SelectDiscapacidad') != null)
{
foreach ($request->input('SelectDiscapacidad') as $value) {

	$discapacidad = null;					
	if (isset($value['value_id'])) {


		$discapacidad = PersonaDiscapacidad::find($value['value_id']);


	}	
	else {
		$discapacidad = new PersonaDiscapacidad();

	}

	$discapacidad->ficha_id	= $beneficiario->id;
	$discapacidad->discapacidad_id			= $value['id']; 		
	$discapacidad->save();
}

}

}


public function ActualizarBeneficiarioPrograma(Request $request, $id)
{



	if ($request->input('datos')['escolaridad_beneficiario'] == 0) {
		$escolaridad = null;
	}
	else {
		$escolaridad = (int)$request->input('datos')['escolaridad_beneficiario'];
	}

	if ($request->input('datos')['estado_escolaridad'] == 0) {
		$Estadoescolaridad = null;
	}
	else {
		$Estadoescolaridad = (int)$request->input('datos')['estado_escolaridad'];
	}


	$persona = Persona::select('tbl_gen_persona.*')->join(
		'tbl_pr_ficha',
		'tbl_pr_ficha.id_persona_beneficiario', '=', 'tbl_gen_persona.id')->where('tbl_pr_ficha.id', '=', (int)$id)->firstOrfail();

	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	
	$persona->sexo = $request->input('datos')['sexo_persona'];
	$persona->tipo_genero_r = (isset($request->input('datos')['tipo_genero_r'])?$request->input('datos')['tipo_genero_r']:null);
	$persona->tipo_orientacion_sexual = (isset($request->input('datos')['tipo_orientacion_sexual'])?$request->input('datos')['tipo_orientacion_sexual']:null);
	$persona->orientacion_sexual_otro = (isset($request->input('datos')['orientacion_sexual_otro'])?$request->input('datos')['orientacion_sexual_otro']:null);
	
	$persona->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_persona']));
	$persona->id_procedencia_pais = $request->input('datos')['pais_id'];
	$persona->id_procedencia_departamento = $request->input('datos')['departamento_id'];
	$persona->id_procedencia_municipio = $request->input('datos')['municipio_id'];
	$persona->otro_municipio = (isset($request->input('datos')['otro_municipio'])?$request->input('datos')['otro_municipio']:"");
	$persona->id_residencia_corregimiento = $request->input('datos')['corregimiento'];
	$persona->id_residencia_vereda = $request->input('datos')['vereda'];
	$persona->id_residencia_barrio = $request->input('datos')['barrio_id'];
	$persona->residencia_estrato = $request->input('datos')['estrato'];
	$persona->residencia_direccion = $request->input('datos')['residencia_persona'] . $request->input('datos')['complemento'];

	$persona->telefono_fijo = $request->input('datos')['telefono_fijo_persona'];
	$persona->telefono_movil = $request->input('datos')['telefono_movil_persona'];
	$persona->sangre_tipo  = $request->input('datos')['tip_sangre_persona'];
	$persona->id_estado_civil  = $request->input('datos')['estado_civil_persona'];
	$persona->escolaridad_id = $escolaridad;
	$persona->estado_escolaridad = $Estadoescolaridad;
	$persona->ocupacion_id = $request->input('datos')['ocupacion_beneficiario'];
	$persona->tenantId = Auth::user()->tenantId;	

	$persona->save();

	$acudiente_persona = Persona::firstOrNew([
    'documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_acudiente'])),
	]);


	$acudiente_persona->nombre_primero = $request->input('datos')['primer_nombre_acudiente'];
	$acudiente_persona->nombre_segundo = $request->input('datos')['segundo_nombre_acudiente'];
	$acudiente_persona->apellido_primero = $request->input('datos')['primer_apellido_acudiente'];
	$acudiente_persona->apellido_segundo = $request->input('datos')['segundo_apellido_acudiente'];
	$acudiente_persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_acudiente']));
	$acudiente_persona->id_documento_tipo = $request->input('datos')['tip_doc_acudiente'];
	$acudiente_persona->sexo = (int)$request->input('datos')['sex_pariente'];
	$acudiente_persona->sexo_acudiente_otro = (!isset($request->input('datos')['sexo_acudiente_otro'])||$request->input('datos')['sexo_acudiente_otro']==null?null:$request->input('datos')['sexo_acudiente_otro']);
	$acudiente_persona->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_acudiente']));
	$acudiente_persona->telefono_fijo = $request->input('datos')['telefono_fijo_acudiente'];
	$acudiente_persona->telefono_movil = $request->input('datos')['telefono_movil_acudiente'];
	$acudiente_persona->correo_electronico = $request->input('datos')['correo_acudiente'];
	$acudiente_persona->tenantId = Auth::user()->tenantId;
	$acudiente_persona->save();


	$beneficiario = FichaPrograma::where('tbl_pr_ficha.id', '=', $id)->firstOrfail();
	$beneficiario->id_persona_beneficiario = $persona->id;
	$beneficiario->no_ficha = $request->input('datos')['no_ficha'];
	$beneficiario->fecha_inscripcion = date('Y-m-d',strtotime($request->input('datos')['fecha_inscripcion']));
	$beneficiario->escolaridad_id = $escolaridad;
	$beneficiario->estado_escolaridad = $Estadoescolaridad;
	$beneficiario->ocupacion_beneficiario = $request->input('datos')['ocupacion_beneficiario'];
	$beneficiario->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
	$beneficiario->cantidad_hijos_beneficiario = $request->input('datos')['cantidad_hijos_beneficiario'];
	$beneficiario->cultura_beneficiario = $request->input('datos')['cultura_beneficiario'];
	$beneficiario->discapacidad_beneficiario = (int)$request->input('datos')['discapacidad_beneficiario'];
	$beneficiario->otra_discapacidad_beneficiario = (int)$request->input('datos')['otra_discapacidad_beneficiario'];
	$beneficiario->medicamentos_permanente_beneficiario = (int)$request->input('datos')['medicamentos_permanente_beneficiario'];
	$beneficiario->medicamentos_beneficiario = (int)$request->input('datos')['medicamentos_beneficiario'];
	$beneficiario->condicion_discapacidad = (int)$request->input('datos')['condicion_discapacidad'];
	$beneficiario->condicion_discapacidad_otro = (!isset($request->input('datos')['condicion_discapacidad_otro'])?null:$request->input('datos')['condicion_discapacidad_otro']);
	
	$beneficiario->afiliacion_salud = (int)$request->input('datos')['afiliacion_salud'];
	$beneficiario->tipo_afiliacion = (int)$request->input('datos')['tipo_afiliacion'];
	$beneficiario->salud_sgss_id = (int)$request->input('datos')['salud_sgsss_beneficiario'];
	$beneficiario->parentesco_acudiente = (int)$request->input('datos')['parentesco_acudiente'];
	$beneficiario->otro_parentesco_acudiente = $request->input('datos')['otro_parentesco_acudiente'];
	$beneficiario->id_persona_acudiente = $acudiente_persona->id;
	
	$beneficiario->otro_poblacional = $request->input('datos')['otro_poblacional'];
	$beneficiario->clubes_deportivos_id = ($request->input('datos')['clubes_deportivos_id'] == null ? null :$request->input('datos')['clubes_deportivos_id']);
	
	$beneficiario->comuna_id = $request->input('datos')['comuna'];
	$beneficiario->tenantId = Auth::user()->tenantId;
	
	$beneficiario->save();

	if($request->input('SelectPoblacional') != null)
	{
		foreach ($request->input('SelectPoblacional') as $value) {

			$poblacional = null;					
			if (isset($value['value_id'])) {

				$poblacional = PoblacionalPrograma::find($value['value_id']);

			}	
			else {
				$poblacional = new PoblacionalPrograma();

			}

			$poblacional->ficha_id	= $beneficiario->id;
			$poblacional->grupo_pcs			= $value['id']; 		
			$poblacional->save();
		}
	}


	if($request->input('SelectDiscapacidad') != null)
	{
		foreach ($request->input('SelectDiscapacidad') as $value) {

			$discapacidad = null;					
			if (isset($value['value_id'])) {


				$discapacidad = ProgramaDiscapacidad::find($value['value_id']);


			}	
			else {
				$discapacidad = new ProgramaDiscapacidad();

			}

			$discapacidad->ficha_id	= $beneficiario->id;
			$discapacidad->discapacidad_id			= $value['id']; 		
			$discapacidad->save();
		}

	}

}


	public function ObtenerDiscapacidad($id)
	{



		$discapacidad = FichaComunidad::select('tbl_cm_ficha.discapacidad_beneficiario as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$discapacidad->toArray());


	}


	public function ObtenerDiscapacidadOtra($id)
	{



		$discapacidadOtra = FichaComunidad::select('tbl_cm_ficha.discapacidad_id as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$discapacidadOtra->toArray());



	}



	public function ObtenerEnfermedad($id)
	{


		$enfermedad = FichaComunidad::select('tbl_cm_ficha.enfermedad_permanente_beneficiario as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$enfermedad->toArray());
	}

	public function ObtenerMedicamento($id)
	{


		$medicamento = FichaComunidad::select('tbl_cm_ficha.medicamentos_permanente_beneficiario as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$medicamento->toArray());

	}

	public function ObtenerSeguridadSocial($id)
	{

		$salud = FichaComunidad::select('tbl_cm_ficha.seguridad_social_beneficiario as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$salud->toArray());

	}

	public function ObtenerSaludSgss($id)
	{


		$salud = FichaComunidad::select('tbl_cm_ficha.salud_sgss_id as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$salud->toArray());

	}

	public function ObtenerDocAcudiente($id)
	{

		$doc_acudiente = FichaComunidad::select('tbl_gen_persona.id_documento_tipo as id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$doc_acudiente->toArray());


	}

	public function ObtenerSexAcudiente($id)
	{


	$sexo_acudiente = FichaComunidad::select('tbl_gen_persona.sexo as id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$sexo_acudiente->toArray());



	}

	public function ObtenerParentescoAcudiente($id)
	{


		$parentesco_acudiente = FichaComunidad::select('tbl_cm_ficha.parentesco_acudiente as id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

		return response()->json(
			$parentesco_acudiente->toArray());
	}


	public function EliminarBeneficiarioGrupo($id){

		$beneficiario = FichaComunidad::findOrfail($id);
		$beneficiario->grupo_id = null;
		$beneficiario->save();
		return response()->json(
			$beneficiario->toArray()
		);

	}

	public function ObtenerAllMonitores()
	{

		$monitores = RoleUser::select('users.id', 'users.primer_nombre', 'users.segundo_nombre', 'users.primer_apellido', 'users.segundo_apellido', 'users.numero_documento')->join(
			'users',
			'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 7)->get();
		return response()->json(
			$monitores->toArray());
	}

	
		public function ObtenerGruposMonitor($id)
	{

		$grupos_monitor = Grupo::select('grupos.id', 'grupos.codigo_grupo')->where('grupos.user_id', '=', $id)->get();
		return response()->json(
			$grupos_monitor->toArray());
	}



		public function obtener_grupos_programas()
	{

		$grupos_monitor = ProgramaGrupo::select('tbl_pr_grupos.id', 'tbl_pr_grupos.nombre_grupo')->where('tbl_pr_grupos.user_id', '=', Auth::id())->get();
		return response()->json(  
			$grupos_monitor->toArray());
	}



	
		public function AsociarGrupoBeneficiario(Request $request, $id){


			$beneficiario = FichaPrograma::findOrfail($id);
			$beneficiario->grupo_id = $request->grupo_id;
			$beneficiario->save();
		
		return response()->json(
			$beneficiario->toArray()
		);

	}

		public function CambiarGrupoBeneficiario(Request $request, $id){


			$beneficiario = FichaComunidad::findOrfail($id);
			$beneficiario->grupo_id = $request->grupo_id;
			$beneficiario->save();
		
		return response()->json(
			$beneficiario->toArray()
		);

	}


	public function EliminarBeneficiario($id)
	{

	$beneficiario = FichaComunidad::findOrfail($id);
		$beneficiario->delete();
		    return response()->json(
		                $beneficiario->toArray()
		            );

	}

			public function ObtenerCountBeneficiarios()
		{

			$beneficiarios = FichaComunidad::all();
			$count_grupos = count($beneficiarios) + 1;
			return response()->json(
				$count_grupos
			);
		}

	public function EliminarPoblacionalBeneficiario(Request $request, $id)

	{




		try {
			 
			$poblacion = PoblacionalBeneficiario::where('ficha_id', '=', $id)->where('grupo_pcs', '=', $request->grupo_pcs)->firstOrfail();


			if(is_null($poblacion)) {
		        return true;    
			    } 
			else {
		    	$poblacion->delete();
		    	return response()->json(
						$poblacion
					);
		        throw new Exception;
		    }
		} 

		catch (Exception $e) {
		  var_dump("error");
		}

	}

	public function EliminarPoblacionalPrograma(Request $request, $id)

	{

		try {
			  
			$poblacion = PoblacionalPrograma::where('ficha_id', '=', $id)->where('grupo_pcs', '=', $request->grupo_pcs)->firstOrfail();

			if(is_null($poblacion)) {
		        return true;    
			    } 
			else {
		    	$poblacion->delete();
		    	return response()->json(
						$poblacion
					);
		        throw new Exception;
		    }
		} 

		catch (Exception $e) {
		  var_dump("error");
		}

	}

	public function EliminarDiscapacidadBeneficiario(Request $request, $id)
	{
		try {
			$discapacidad = PersonaDiscapacidad::where('ficha_id', '=', $id)->where('discapacidad_id', '=', $request->grupo_pcs)->firstOrfail();
			if(is_null($discapacidad)) {
		        return true;    
			    } 
			else {
		    	$discapacidad->delete();
		    	return response()->json(
						$discapacidad
					);
		        throw new Exception;
		    }
		} 
		catch (Exception $e) {
		  var_dump("error");
		}

	}

	public function EliminarDiscapacidadPrograma(Request $request, $id)
	{
		try {
			$discapacidad = ProgramaDiscapacidad::where('ficha_id', '=', $id)->where('discapacidad_id', '=', $request->grupo_pcs)->firstOrfail();
			if(is_null($discapacidad)) {
		        return true;    
			    } 
			else {
		    	$discapacidad->delete();
		    	return response()->json(
						$discapacidad
					);
		        throw new Exception;
		    }
		} 
		catch (Exception $e) {
		  var_dump("error");
		}

	}

	public function EliminarDiscapacidadPersonal(Request $request, $id)
	{
		try {
			$discapacidad = EmpleadoDiscapacidad::where('empleado_id', '=', $id)->where('discapacidad_id', '=', $request->grupo_pcs)->firstOrfail();
			if(is_null($discapacidad)) {
		        return true;    
			    } 
			else {
		    	$discapacidad->delete();
		    	return response()->json(
						$discapacidad
					);
		        throw new Exception;
		    }
		} 
		catch (Exception $e) {
		  var_dump("error");
		}

	}

	
	public function EliminarDisciplinaEmpleado(Request $request, $id)
	{
		try {
			$disciplina = EmpleadoDisciplina::where('empleado_id', '=', $id)->where('disciplina_id', '=', $request->grupo_pcs)->firstOrfail();
			if(is_null($disciplina)) {
		        return true;    
			    } 
			else {
		    	$disciplina->delete();
		    	return response()->json(
						$disciplina
					);
		        throw new Exception;
		    }
		} 
		catch (Exception $e) {
		  var_dump("error");
		}

	}
}
