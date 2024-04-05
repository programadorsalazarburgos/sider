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
use App\Lugar;
use App\ProgramaDisciplina;
use response;
use DB;
use DateTime;
use Exception;



class PostBeneficiarioReportesProgramasController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postreportegeneralprogramas.appreportegeneralprogramas");
	}

	public function vistaDetallado(){

		return view("postreportedetalladoprogramas.appreportedetalladoprogramas");
	}

	public function index()
	{

		$mis_beneficiarios = FichaComunidad::select('tbl_cm_ficha.id', 'tbl_cm_ficha.fecha_inscripcion' , 'tbl_cm_ficha.no_ficha', 'grupos.id as grupo', 'grupos.user_id', 'grupos.codigo_grupo', 'grupos.observaciones', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'users.primer_nombre as primer_nombre_usuario', 'users.primer_apellido as primer_apellido_usuario')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->leftJoin(
			'grupos',
			'grupos.id', '=', 'tbl_cm_ficha.grupo_id')->leftJoin('users', 'users.id', '=', 'grupos.user_id')->where('tbl_gen_persona.tenantId', '=', Auth::user()->tenantId)->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->get();
		return response()->json(
			$mis_beneficiarios
		);
	}



	public function indexDetallado()
	{

		$mis_beneficiarios = FichaComunidad::select('tbl_cm_ficha.id', 'tbl_cm_ficha.fecha_inscripcion' , 'tbl_cm_ficha.no_ficha', 'grupos.id as grupo', 'grupos.user_id', 'grupos.codigo_grupo', 'grupos.observaciones', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'users.primer_nombre as primer_nombre_usuario', 'users.primer_apellido as primer_apellido_usuario')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->leftJoin(
			'grupos',
			'grupos.id', '=', 'tbl_cm_ficha.grupo_id')->leftJoin('users', 'users.id', '=', 'grupos.user_id')->where('tbl_gen_persona.tenantId', '=', Auth::user()->tenantId)->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->get();
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
		tbl_cm_ficha.modalidad,
		tbl_cm_ficha.punto_atencion,
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
$beneficiario->modalidad = $request->input('datos')['modalidad'];
$beneficiario->punto_atencion = $request->input('datos')['punto_atencion'];

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
		tbl_cm_ficha.modalidad,
		tbl_cm_ficha.punto_atencion,
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
		tbl_cm_ficha.modalidad,
		tbl_cm_ficha.punto_atencion,
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
	$beneficiario = DB::select('select 
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
		tbl_gen_persona.residencia_direccion,
		tbl_gen_persona.residencia_estrato,
		tbl_gen_persona.id_residencia_barrio,
		tbl_gen_persona.id_residencia_corregimiento,
		tbl_gen_persona.id_residencia_vereda,
		tbl_gen_persona.id_estado_civil,
		tbl_gen_persona.sangre_tipo,
		tbl_cm_ficha.id as ficha_save,
		tbl_cm_ficha.fecha_inscripcion,
		tbl_cm_ficha.no_ficha,
		tbl_cm_ficha.modalidad,
		tbl_cm_ficha.punto_atencion,
		tbl_cm_ficha.hijos_beneficiario,
		tbl_cm_ficha.cantidad_hijos_beneficiario,
		tbl_cm_ficha.ocupacion_beneficiario,
		tbl_cm_ficha.escolaridad_id,
		tbl_cm_ficha.cultura_beneficiario,
		tbl_cm_ficha.otra_ocupacion_beneficiario,
		tbl_cm_ficha.otra_cultura_beneficiario,
		tbl_cm_ficha.discapacidad_beneficiario,
		tbl_cm_ficha.discapacidad_id,
		tbl_cm_ficha.otra_discapacidad_beneficiario,
		tbl_cm_ficha.enfermedad_permanente_beneficiario,
		tbl_cm_ficha.enfermedad_beneficiario,
		tbl_cm_ficha.medicamentos_permanente_beneficiario,
		tbl_cm_ficha.medicamentos_beneficiario,
		tbl_cm_ficha.seguridad_social_beneficiario,
		tbl_cm_ficha.salud_sgss_id,
		tbl_cm_ficha.nombre_seguridad_beneficiario,
		tbl_cm_ficha.parentesco_acudiente,
		tbl_cm_ficha.otro_parentesco_acudiente,
		
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
		acudiente.sexo as sexoacudiente

 		from tbl_cm_ficha 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_ficha.id_persona_beneficiario
	    inner join tbl_gen_persona acudiente ON tbl_cm_ficha.id_persona_acudiente = acudiente.id


 		 where tbl_gen_persona.documento =?', [$documento]);

return response()->json(
			$beneficiario
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

		$escolaridad = Escolaridad::select('tbl_gen_escolaridad_nivel.id', 'tbl_gen_escolaridad_nivel.descripcion')->get();
		return response()->json(
			$escolaridad->toArray());

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



	public function ActualizarBeneficiario(Request $request, $id)
	{


$persona = Persona::select('tbl_gen_persona.*')->join(
			'tbl_cm_ficha',
			'tbl_cm_ficha.id_persona_beneficiario', '=', 'tbl_gen_persona.id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

$persona->nombre_primero = $persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));

$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
$persona->sexo = $request->input('datos')['sexo_persona'];


$persona->fecha_nacimiento = $request->input('datos')['fecha_nac_persona'];

$persona->telefono_fijo = $request->input('datos')['telefono_fijo_persona'];
$persona->telefono_movil = $request->input('datos')['telefono_movil_persona'];
$persona->correo_electronico = $request->input('datos')['correo_persona'];
$persona->id_procedencia_pais = $request->input('datos')['pais_id'];
$persona->id_procedencia_municipio = $request->input('datos')['municipio_id'];
$persona->id_procedencia_departamento = $request->input('datos')['departamento_id'];
$persona->id_residencia_corregimiento = $request->input('datos')['corregimiento'];
$persona->id_residencia_barrio = $request->input('datos')['barrio_id'];
$persona->id_residencia_vereda = $request->input('datos')['vereda'];
$persona->residencia_direccion = $request->input('datos')['residencia_persona'];
$persona->residencia_estrato = $request->input('datos')['estrato'];
$persona->sangre_tipo  = $request->input('datos')['tip_sangre_persona'];
$persona->id_estado_civil  = $request->input('datos')['estado_civil_persona'];
$persona->save();



$acudiente_persona = Persona::select('tbl_gen_persona.*')->join(
			'tbl_cm_ficha',
			'tbl_cm_ficha.id_persona_acudiente', '=', 'tbl_gen_persona.id')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();

$acudiente_persona->nombre_primero = $request->input('datos')['primer_nombre_acudiente'];
$acudiente_persona->nombre_segundo = $request->input('datos')['segundo_nombre_acudiente'];
$acudiente_persona->apellido_primero = $request->input('datos')['primer_apellido_acudiente'];
$acudiente_persona->apellido_segundo = $request->input('datos')['segundo_apellido_acudiente'];
$acudiente_persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_acudiente']));


$acudiente_persona->id_documento_tipo = $request->input('datos')['tip_doc_acudiente'];
$acudiente_persona->sexo = $request->input('datos')['sex_pariente'];
$acudiente_persona->fecha_nacimiento = $request->input('datos')['fecha_nac_acudiente'];
$acudiente_persona->telefono_fijo = $request->input('datos')['telefono_fijo_acudiente'];
$acudiente_persona->telefono_movil = $request->input('datos')['telefono_movil_acudiente'];
$acudiente_persona->correo_electronico = $request->input('datos')['correo_acudiente'];
$acudiente_persona->save();


	
$beneficiario = FichaComunidad::where('tbl_cm_ficha.id', '=', $id)->firstOrfail();
$beneficiario->fecha_inscripcion = $request->input('datos')['fecha_inscripcion'];
$beneficiario->no_ficha = $request->input('datos')['no_ficha'];
$beneficiario->modalidad = $request->input('datos')['modalidad'];
$beneficiario->punto_atencion = $request->input('datos')['punto_atencion'];
$beneficiario->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
$beneficiario->cantidad_hijos_beneficiario = $request->input('datos')['cantidad_hijos_beneficiario'];
$beneficiario->ocupacion_beneficiario = $request->input('datos')['ocupacion_beneficiario'];
$beneficiario->otra_ocupacion_beneficiario = $request->input('datos')['otra_ocupacion_beneficiario'];
$beneficiario->escolaridad_id = $request->input('datos')['escolaridad_beneficiario'];
$beneficiario->cultura_beneficiario = $request->input('datos')['cultura_beneficiario'];
$beneficiario->otra_cultura_beneficiario = $request->input('datos')['otra_cultura_beneficiario'];
$beneficiario->discapacidad_beneficiario = $request->input('datos')['discapacidad_beneficiario'];
$beneficiario->discapacidad_id = $request->input('datos')['discapacidad_select_beneficiario'];
$beneficiario->otra_discapacidad_beneficiario = $request->input('datos')['otra_discapacidad_beneficiario'];
$beneficiario->enfermedad_permanente_beneficiario = $request->input('datos')['enfermedad_permanente_beneficiario'];
$beneficiario->enfermedad_beneficiario = $request->input('datos')['enfermedad_beneficiario'];
$beneficiario->medicamentos_permanente_beneficiario = $request->input('datos')['medicamentos_permanente_beneficiario'];

$beneficiario->medicamentos_beneficiario = $request->input('datos')['medicamentos_beneficiario'];
$beneficiario->seguridad_social_beneficiario = $request->input('datos')['seguridad_social_beneficiario'];
$beneficiario->salud_sgss_id = $request->input('datos')['salud_sgsss_beneficiario'];
$beneficiario->nombre_seguridad_beneficiario = $request->input('datos')['nombre_seguridad_beneficiario'];
$beneficiario->parentesco_acudiente = $request->input('datos')['parentesco_acudiente'];
$beneficiario->otro_parentesco_acudiente = $request->input('datos')['otro_parentesco_acudiente'];




		$beneficiario->save();




		foreach ($request->input('poblacionales') as $value) {

			$poblacional = null;					
			if (isset($value['value_id'])) {

				$poblacional = PoblacionalBeneficiario::find($value['value_id']);
			}	
			else {
				$poblacional = new PoblacionalBeneficiario();

			}	
			$poblacional->ficha_id	= $request->id;
			$poblacional->grupo_pcs			= $value['id']; 		
			$poblacional->save();
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

	
		public function AsociarGrupoBeneficiario(Request $request, $id){


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

		var_dump($id);
		var_dump($request->grupo_pcs);

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


	public function BeneficiariosReporteDetalladoPrograma()
	{
		$tenanId = Auth::user()->tenantId;
		$wheres = (int)$tenanId;
		$data = DB::select('select 
		`tbl_pr_asistencias`.`ficha_id`,
		`tbl_pr_grupos`.`nombre_grupo`,
		 tbl_pr_lugares.nombre_lugar,
         tbl_pr_disciplinas.nombre_disciplina,
		((count(`tbl_pr_asistencias`.`fecha_asistencia`))-SUM(`tbl_pr_asistencias`.`asistencia`) ) AS `inasistencias`,
		SUM(`tbl_pr_asistencias`.`asistencia`) AS `asistencias`,
		(count(`tbl_pr_asistencias`.`fecha_asistencia`)) AS `total`,
		`tbl_gen_documento_tipo`.`descripcion` AS `tipo_documento`,
		`tbl_gen_persona`.`documento`,
		`tbl_pr_ficha`.`no_ficha`,
		`tbl_pr_ficha`.`fecha_inscripcion`,
		`tbl_gen_persona`.`nombre_primero`,
		`tbl_gen_persona`.`nombre_segundo`,
		`tbl_gen_persona`.`apellido_primero`,
		`tbl_gen_persona`.`apellido_segundo`,
		`tbl_gen_persona`.`correo_electronico`,
		(CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "F" END) as sexo,
		`tbl_gen_persona`.`fecha_nacimiento`,
		`paises`.`nombre_pais` as pais_procedencia,
		`departamentos`.`nombre_departamento` as departamento_procedencia,
		`municipios`.`nombre_municipio` as municipio_procedencia,
		`tbl_gen_corregimientos`.`descripcion` AS `nombre_corregimiento`,
		`tbl_gen_veredas`.`nombre` as nombre_vereda,
		`barrios`.`nombre_barrio`,
		`tbl_gen_persona`.`residencia_estrato`,
		`comunas`.`nombre_comuna`,	
		`tbl_gen_persona`.`residencia_direccion`,
		`tbl_gen_persona`.`telefono_fijo`,
		`tbl_gen_persona`.`telefono_movil`,
		`tbl_gen_escolaridad_nivel`.`descripcion` as nivel_escolaridad,
		`tbl_gen_escolaridad_estado`.`descripcion` as estado_escolaridad,
		`tbl_gen_ocupacion`.`descripcion` as ocupacion_beneficiario,
		`tbl_gen_estado_civil`.`descripcion` as estado_civil,
		(CASE WHEN (tbl_pr_ficha.hijos_beneficiario = 1) THEN "Si"  ELSE "No" END) as hijos_beneficiario,
		`tbl_pr_ficha`.`cantidad_hijos_beneficiario`,
		`tbl_gen_etnia`.`descripcion` as etnia_beneficiario,
		`view_grupo_poblacional_ficha_pr`.`nombre` as poblacional,
		(CASE WHEN (tbl_pr_ficha.discapacidad_beneficiario = 1) THEN "Si"  ELSE "No" END) as enfermedad_permanente,
		`tbl_pr_ficha`.`otra_discapacidad_beneficiario`,
		(CASE WHEN (tbl_pr_ficha.medicamentos_permanente_beneficiario = 1) THEN "Si"  ELSE "No" END) as toma_medicamentos,
		`tbl_pr_ficha`.`medicamentos_beneficiario`,
		`tbl_gen_persona`.`sangre_tipo`,
	     view_discapacidad_persona_ficha_pr.nombre_discapacidad as discapacidades,
		(CASE WHEN (tbl_pr_ficha.afiliacion_salud = 1) THEN "Si"  ELSE "No" END) as afiliacion_salud,
		`tbl_gen_salud_regimen`.`descripcion` as tipo_afiliacion,
		`tbl_gen_eps`.`descripcion` as nombre_eps,
		`tbl_gen_documento_tipo_acudiente`.`descripcion` as tipo_documento_acudiente,	
		`acudiente_persona`.`documento` as documento_acudiente,
		`acudiente_persona`.`nombre_primero` as nombre_primero_acudiente,
		`acudiente_persona`.`nombre_segundo` as nombre_segundo_acudiente,
		`acudiente_persona`.`apellido_primero` as apellido_primero_acudiente,
		`acudiente_persona`.`apellido_segundo` as apellido_segundo_acudiente,
		`acudiente_persona`.`fecha_nacimiento` as fecha_nacimiento_acudiente,
		`acudiente_persona`.`telefono_fijo` as telefono_fijo_acudiente,
		`acudiente_persona`.`telefono_movil` as telefono_movil_acudiente,
		`acudiente_persona`.`correo_electronico` as correo_electronico_acudiente,
		(CASE WHEN (tbl_pr_ficha.parentesco_acudiente = 1) THEN "Madre/Padre" WHEN (tbl_pr_ficha.parentesco_acudiente = 2) THEN "Hermana/Hermano" WHEN (tbl_pr_ficha.parentesco_acudiente = 3) THEN "Tia/Tio" WHEN (tbl_pr_ficha.parentesco_acudiente = 4) THEN "Abuela/Abuelo" WHEN (tbl_pr_ficha.parentesco_acudiente = 5) THEN "Cuidador" ELSE "Otro" END) as parentesco_acudiente,
		tbl_pr_ficha.otro_parentesco_acudiente,
		`users`.`primer_nombre` as primer_nombre_formador,
		`users`.`primer_apellido` as primer_apellido_formador
		
	  FROM
		`tbl_pr_asistencias`
		LEFT JOIN `tbl_pr_ficha` ON (`tbl_pr_asistencias`.`ficha_id` = `tbl_pr_ficha`.`id`)
		LEFT JOIN `tbl_gen_persona` ON (`tbl_pr_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
		LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo`.`id`)
		LEFT JOIN `paises` ON (`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)
		LEFT OUTER JOIN `departamentos` ON (`tbl_gen_persona`.`id_procedencia_departamento` = `departamentos`.`id`)
		LEFT OUTER JOIN `municipios` ON (`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)
		LEFT OUTER JOIN `tbl_gen_corregimientos` ON (`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)
		LEFT OUTER JOIN `tbl_gen_veredas` ON (`tbl_gen_persona`.`id_residencia_vereda` = `tbl_gen_veredas`.`id`)
		LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
		LEFT OUTER JOIN `tbl_gen_estado_civil` ON (`tbl_gen_persona`.`id_estado_civil` = `tbl_gen_estado_civil`.`id`)
		LEFT OUTER JOIN `tbl_pr_grupos` ON (`tbl_pr_ficha`.`grupo_id` = `tbl_pr_grupos`.`id`)
		LEFT JOIN `tbl_pr_lugares` ON (`tbl_pr_lugares`.`id` = `tbl_pr_grupos`.`lugar_id`)
  		LEFT JOIN `tbl_pr_disciplinas` ON (`tbl_pr_disciplinas`.`id` = `tbl_pr_grupos`.`disciplina_id`)
		LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_pr_ficha`.`comuna_id`)
		LEFT OUTER JOIN `users` ON (`tbl_pr_grupos`.`user_id` = `users`.`id`)
		LEFT OUTER JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_pr_ficha`.`escolaridad_id` = `tbl_gen_escolaridad_nivel`.`id`)
		LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_pr_ficha`.`estado_escolaridad`)
		LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_pr_ficha`.`ocupacion_beneficiario`)
		LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_pr_ficha`.`cultura_beneficiario`)
		LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_pr_ficha`.`tipo_afiliacion`)
 		LEFT JOIN `view_discapacidad_persona_ficha_pr` ON (`tbl_pr_ficha`.`id` = `view_discapacidad_persona_ficha_pr`.`ficha_id`)
		LEFT OUTER JOIN `tbl_gen_eps` ON (`tbl_pr_ficha`.`salud_sgss_id` = `tbl_gen_eps`.`id`)
		LEFT JOIN `tbl_gen_persona` `acudiente_persona` ON (`tbl_pr_ficha`.`id_persona_acudiente` = `acudiente_persona`.`id`)
		LEFT JOIN `tbl_gen_documento_tipo` `tbl_gen_documento_tipo_acudiente` ON (`acudiente_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo_acudiente`.`id`)
		LEFT JOIN `view_grupo_poblacional_ficha_pr` ON (`tbl_pr_ficha`.`id` = `view_grupo_poblacional_ficha_pr`.`ficha_id`)
		WHERE `tbl_pr_grupos`.`tenantId` = '.$wheres.'
	  GROUP BY
		`tbl_pr_asistencias`.`ficha_id`');
	 
		return response()->json(
			$data
		);

	}

	public function ObtenerLugares()
	{

		$lugares = DB::table('tbl_pr_lugares')
         ->select(
         'id',
          DB::raw('UPPER(nombre_lugar) as nombre_lugar'))
          ->where('tbl_pr_lugares.estado', '=', 0)
          ->orderBy('nombre_lugar', 'asc')
          ->get();
		  return response()->json(
		                $lugares->toArray()
		            );
	}


		public function ObtenerDisciplinas()
	{


		$disciplinas = DB::table('tbl_pr_disciplinas')
         ->select(
         'id',
          DB::raw('UPPER(nombre_disciplina) as nombre_disciplina'))
          ->where('tbl_pr_disciplinas.tenantId', '=', Auth::user()->tenantId)
          ->orderBy('nombre_disciplina', 'asc')
          ->get();
		  return response()->json(
		                $disciplinas->toArray()
		            );
	}
}
