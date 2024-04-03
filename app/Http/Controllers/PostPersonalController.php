<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;
use App\User;
use App\Programa;
use App\RoleUser;
use App\Universidad;
use App\Persona	;
use App\Empleado;
use App\EmpleadoPoblacional;
use App\EmpleadoDiscapacidad;
use App\EmpleadoDisciplina;
use App\Message;
use App\Notifications\MessageSent;
use App\Notifications\NotifyPostOwner;
use DB;
use Response;

class PostPersonalController extends Controller
{

    public function __construct()
	{

//    $this->middleware('permission:ver-roles', ['only' => 'vista']);

	//	$this->hashids = new Hashids('', 10);
		
	}

	public function vista(){

		return view("postpersonal.apppersonal");
	}

	public function CargarPersona($id)
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
		tbl_gen_persona.residencia_direccion,
		tbl_gen_persona.residencia_estrato,
		tbl_gen_persona.id_residencia_barrio,
		tbl_gen_persona.id_residencia_corregimiento,
		tbl_gen_persona.id_residencia_vereda,
		tbl_gen_persona.id_estado_civil,
		tbl_gen_persona.sangre_tipo,
		tbl_gen_persona.departamento_residencia_id,
		tbl_gen_persona.municipio_residencia_id,
		tbl_gen_persona.direccion_residencia,
		tbl_gen_persona.escolaridad_id,
		tbl_gen_persona.estado_escolaridad,
		tbl_gen_persona.ocupacion_id
 		from tbl_gen_persona 
 		 where tbl_gen_persona.documento =?', [$documento]);

		  $empleado = DB::select('select 
		tbl_cm_empleado.id as ficha_save,  
		tbl_cm_empleado.id_persona,
        tbl_cm_empleado.id_usuario,
        tbl_cm_empleado.hijos_beneficiario,
        tbl_cm_empleado.cantidad_hijos_beneficiario,
        tbl_cm_empleado.ocupacion_beneficiario,
        tbl_cm_empleado.escolaridad_id,
        tbl_cm_empleado.estado_escolaridad,
        tbl_cm_empleado.titulo_obtenido,
        tbl_cm_empleado.universidad_id,
        tbl_cm_empleado.ocupacion_id,
        tbl_cm_empleado.hijos_empleado,
        tbl_cm_empleado.cantidad_hijos,
        tbl_cm_empleado.etnia_id,
        tbl_cm_empleado.enfermedad_permanente,
        tbl_cm_empleado.otra_enfermedad,
        tbl_cm_empleado.medicamentos,
        tbl_cm_empleado.otros_medicamentos,
        tbl_cm_empleado.tipo_sangre,
        tbl_cm_empleado.condicion_discapacidad,
        tbl_cm_empleado.afiliacion_salud,
        tbl_cm_empleado.tipoafiliacion_id,
        tbl_cm_empleado.eps_id,
        tbl_cm_empleado.libreta_militar,
        tbl_cm_empleado.no_libreta,
        tbl_cm_empleado.distrito_militar,
        tbl_cm_empleado.skype_empleado,
		tbl_cm_empleado.proyecto_profesional,
		tbl_cm_empleado.otro_poblacional,
		tbl_cm_empleado.tenantId as programaTenanId,
		tbl_dv_instituciones_educativas.nombre as nombre_universidad
 		from tbl_cm_empleado 
		 inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_empleado.id_persona 
		 left join tbl_dv_instituciones_educativas on tbl_dv_instituciones_educativas.id = tbl_cm_empleado.universidad_id
 		 where tbl_gen_persona.documento =?', [$documento]);

return	Response::json(array('persona'=>$persona,'empleado'=>$empleado));

	}

	public function CargarPersonaUsuario($id)
	{

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
		tbl_cm_empleado.id as ficha_save,
		tbl_cm_empleado.id_persona,
        tbl_cm_empleado.id_usuario,
        tbl_cm_empleado.hijos_beneficiario,
        tbl_cm_empleado.cantidad_hijos,
        tbl_cm_empleado.ocupacion_beneficiario,
        tbl_cm_empleado.escolaridad_id,
        tbl_cm_empleado.estado_escolaridad,
        tbl_cm_empleado.titulo_obtenido,
        tbl_cm_empleado.universidad_id,
        tbl_dv_instituciones_educativas.nombre as nombre_universidad,
        tbl_cm_empleado.ocupacion_id,
        tbl_cm_empleado.hijos_empleado,
        tbl_cm_empleado.cantidad_hijos,
        tbl_cm_empleado.etnia_id,
        tbl_cm_empleado.enfermedad_permanente,
        tbl_cm_empleado.otra_enfermedad,
        tbl_cm_empleado.medicamentos,
        tbl_cm_empleado.otros_medicamentos,
        tbl_cm_empleado.tipo_sangre,
        tbl_cm_empleado.condicion_discapacidad,
        tbl_cm_empleado.afiliacion_salud,
        tbl_cm_empleado.tipoafiliacion_id,
        tbl_cm_empleado.eps_id,
        tbl_cm_empleado.libreta_militar,
        tbl_cm_empleado.no_libreta,
        tbl_cm_empleado.distrito_militar,
        tbl_cm_empleado.skype_empleado,
        tbl_cm_empleado.proyecto_profesional,
		tbl_cm_empleado.otro_poblacional,
		tbl_gen_persona.departamento_residencia_id,
		tbl_gen_persona.municipio_residencia_id,
		tbl_gen_persona.direccion_residencia,
		tbl_gen_persona.escolaridad_id,
		tbl_gen_persona.estado_escolaridad,
		tbl_gen_persona.ocupacion_id

	
 		from tbl_cm_empleado 
 		inner join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_empleado.id_persona
 		left join tbl_dv_instituciones_educativas on tbl_dv_instituciones_educativas.id = tbl_cm_empleado.universidad_id
	 	inner join users on users.id = tbl_cm_empleado.id_usuario

 		 where tbl_cm_empleado.id_usuario =?', [$id]);

return response()->json(
			$beneficiario
		);


	}

	public function EliminarPoblacionalPersonal(Request $request, $id)

	{

		try {
			  
			$poblacion = EmpleadoPoblacional::where('empleado_id', '=', $id)->where('grupopoblacional_id', '=', $request->grupo_pcs)->firstOrfail();

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


	public function PoblacionalesDocumento($id)
	{


		$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
		$poblacionales = EmpleadoPoblacional::select('tbl_cm_empleado_x_grupo_poblacional.grupopoblacional_id as id', 'tbl_cm_empleado_x_grupo_poblacional.id as value_id')->join(
			'tbl_cm_empleado',
			'tbl_cm_empleado.id', '=', 'tbl_cm_empleado_x_grupo_poblacional.empleado_id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->where('tbl_gen_persona.documento', '=', $documento)->get();
		return response()->json(
			$poblacionales->toArray());
	}

	public function PoblacionalesUsuario($id)
	{


		$poblacionales = EmpleadoPoblacional::select('tbl_cm_empleado_x_grupo_poblacional.grupopoblacional_id as id', 'tbl_cm_empleado_x_grupo_poblacional.id as value_id')->join(
			'tbl_cm_empleado',
			'tbl_cm_empleado.id', '=', 'tbl_cm_empleado_x_grupo_poblacional.empleado_id')
			->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')
			->join(
				'users',
				'users.id', '=', 'tbl_cm_empleado.id_usuario')
			->where('tbl_cm_empleado.id_usuario', '=', $id)->get();
		return response()->json(
			$poblacionales->toArray());
	}


	public function DiscapacidadesDocumento($id)
	{

		$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
		$discapacidades = EmpleadoDiscapacidad::select('tbl_cm_empleado_discapacidad.discapacidad_id as id', 'tbl_cm_empleado_discapacidad.id as value_id')
		->join(
			'tbl_cm_empleado',
			'tbl_cm_empleado.id', '=', 'tbl_cm_empleado_discapacidad.empleado_id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->where('tbl_gen_persona.documento', '=', $documento)->get();
		return response()->json(
			$discapacidades->toArray());
	
	}

	public function DiscapacidadesUsuario($id)
	{

		$discapacidades = EmpleadoDiscapacidad::select('tbl_cm_empleado_discapacidad.discapacidad_id as id', 'tbl_cm_empleado_discapacidad.id as value_id')
		->join(
			'tbl_cm_empleado',
			'tbl_cm_empleado.id', '=', 'tbl_cm_empleado_discapacidad.empleado_id')
		->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')
		->join(
				'users',
				'users.id', '=', 'tbl_cm_empleado.id_usuario')
			->where('tbl_cm_empleado.id_usuario', '=', $id)->get();

		return response()->json(
			$discapacidades->toArray());
	
	}


	public function DisciplinasDocumento($id)
	{

		$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));
		$disciplinas = EmpleadoDisciplina::select('tbl_cm_empleado_x_disciplina.disciplina_id as id', 'tbl_cm_empleado_x_disciplina.id as value_id')
		->join(
			'tbl_cm_empleado',
			'tbl_cm_empleado.id', '=', 'tbl_cm_empleado_x_disciplina.empleado_id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->where('tbl_gen_persona.documento', '=', $documento)->get();
		return response()->json(
			$disciplinas->toArray());
	
	}

	public function DisciplinasUsuario($id)
	{

		$disciplinas = EmpleadoDisciplina::select('tbl_cm_empleado_x_disciplina.disciplina_id as id', 'tbl_cm_empleado_x_disciplina.id as value_id')
		->join(
			'tbl_cm_empleado',
			'tbl_cm_empleado.id', '=', 'tbl_cm_empleado_x_disciplina.empleado_id')->join(
			'tbl_gen_persona',
			'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')
		->join(
				'users',
				'users.id', '=', 'tbl_cm_empleado.id_usuario')
			->where('tbl_cm_empleado.id_usuario', '=', $id)->get();

		return response()->json(
			$disciplinas->toArray());
	
	}

	public function AsignarRolUsuario(Request $request, $id)
	{

		$persona = Persona::select(
			'tbl_gen_persona.id',
			'nombre_primero', 
            'nombre_segundo',
            'apellido_primero', 
            'apellido_segundo',
            'documento',
            'id_documento_tipo',
            'tbl_gen_persona.sexo',
            'tbl_gen_persona.fecha_nacimiento',
            'tbl_gen_persona.telefono_fijo',
            'tbl_gen_persona.telefono_movil',
            'tbl_gen_persona.correo_electronico',
            'tbl_gen_persona.id_procedencia_pais',
            'tbl_gen_persona.id_procedencia_municipio',
            'tbl_gen_persona.id_procedencia_departamento',
            'tbl_gen_persona.id_residencia_corregimiento',
            'tbl_gen_persona.id_residencia_barrio',
            'tbl_gen_persona.id_residencia_vereda',
            'tbl_gen_persona.residencia_direccion',
            'tbl_gen_persona.residencia_estrato',
            'tbl_gen_persona.sangre_tipo',
			'tbl_gen_persona.id_estado_civil',
			'tbl_gen_persona.departamento_residencia_id',
			'tbl_gen_persona.municipio_residencia_id',
			'tbl_gen_persona.direccion_residencia',
			'tbl_gen_persona.escolaridad_id',
			'tbl_gen_persona.estado_escolaridad',
			'tbl_gen_persona.ocupacion_id')
			->join(
				'tbl_cm_empleado',
				'tbl_cm_empleado.id_persona', '=', 'tbl_gen_persona.id')
				
			->join(
				'users',
				'users.id', '=', 'tbl_cm_empleado.id_usuario')
        
        
        ->firstOrNew(array('tbl_cm_empleado.id_usuario' => $id));
 
		$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
		$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
		$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
		$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
		$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
		$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
		$persona->correo_electronico = $request->input('datos')['correo_persona'];
		$persona->sexo = $request->input('datos')['sexo_persona'];
		$persona->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_persona']));
		$persona->id_procedencia_pais = $request->input('datos')['pais_id'];
		$persona->id_procedencia_departamento = $request->input('datos')['departamento_id'];
		$persona->id_procedencia_municipio = $request->input('datos')['municipio_id'];
		$persona->id_residencia_corregimiento = $request->input('datos')['corregimiento'];
		$persona->id_residencia_vereda = $request->input('datos')['vereda'];
		$persona->id_residencia_barrio = $request->input('datos')['barrio_id'];
		$persona->residencia_estrato = $request->input('datos')['estrato'];
		$persona->residencia_direccion = $request->input('datos')['residencia_persona'] . $request->input('datos')['complemento'];
		$persona->telefono_fijo = $request->input('datos')['telefono_fijo_persona'];
		$persona->telefono_movil = $request->input('datos')['telefono_movil_persona'];
		$persona->sangre_tipo  = $request->input('datos')['tip_sangre_persona'];
		$persona->id_estado_civil  = $request->input('datos')['estado_civil_persona'];
		//Nuevos campos
		$persona->departamento_residencia_id  = $request->input('datos')['departamento_residencia'];
		$persona->municipio_residencia_id  = $request->input('datos')['municipio_residencia'];
		$persona->direccion_residencia  = $request->input('datos')['direc_residencia'];
		//Nuevos Campos
		$persona->escolaridad_id = $request->input('datos')['escolaridad_beneficiario'];
		$persona->estado_escolaridad = $request->input('datos')['estado_escolaridad'];
		$persona->ocupacion_id = $request->input('datos')['ocupacion_beneficiario'];
		$persona->save();

		$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
		$usuario = User::firstOrNew(array('id' => $id ));
		$usuario->primer_nombre = $request->input('datos')['primer_nombre_persona'];
		$usuario->email = $request->input('datos')['correo_persona'];
		$usuario->password = bcrypt($doc_persona);
		$usuario->remember_token = str_random(50);
		$usuario->segundo_nombre = $request->input('datos')['segundo_nombre_persona'];
		$usuario->primer_apellido = $request->input('datos')['primer_apellido_persona'];
		$usuario->segundo_apellido = $request->input('datos')['segundo_apellido_persona'];
		$usuario->tipo_documento = $request->input('datos')['tipo_doc_persona'];
		$usuario->numero_documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
		$usuario->direccion = $request->input('datos')['residencia_persona'] . $request->input('datos')['complemento'];
		$usuario->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_persona']));
		$usuario->telefono_movil = $request->input('datos')['telefono_movil_persona'];
		$usuario->telefono_fijo = $request->input('datos')['telefono_fijo_persona'];
		$usuario->save();

		$rol_user = RoleUser::firstOrNew(array('user_id' => $usuario->id ));
		$rol_user->user_id = $usuario->id;
		$rol_user->role_id = $request->input('datos')['rol'];
		$rol_user->save();
	
		$message = Message::create([
			'sender_id' => auth()->id(),
			'recipient_id' => $usuario->id,
			'body' => 'Su rol asignado es ejemplo',

		]);
//
		$user = User::find($usuario->id);
		$user->notify(new NotifyPostOwner($user));



		$empleado = Empleado::select(
			'tbl_cm_empleado.id',
			'id_persona',
			'id_usuario',
			'hijos_beneficiario',
			'cantidad_hijos_beneficiario',
			'tbl_cm_empleado.ocupacion_beneficiario',
			'tbl_cm_empleado.escolaridad_id',
			'tbl_cm_empleado.estado_escolaridad',
			'titulo_obtenido',
			'universidad_id',
			'tbl_cm_empleado.ocupacion_id',
			'hijos_empleado',
			'cantidad_hijos',
			'etnia_id',
			'enfermedad_permanente',
			'otra_enfermedad',
			'medicamentos',
			'otros_medicamentos',
			'condicion_discapacidad',
			'afiliacion_salud',
			'tipoafiliacion_id',
			'eps_id',
			'libreta_militar',
			'no_libreta',
			'distrito_militar',
			'skype_empleado',
			'proyecto_profesional',
			'otro_poblacional'
		
 
	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')
		->join(
			'users',
			'users.id', '=', 'tbl_cm_empleado.id_usuario')
				
		->firstOrNew(array('tbl_cm_empleado.id_usuario' => $id ));
 
		$empleado->id_persona = $persona->id;
		$empleado->id_usuario = $usuario->id;
		$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
		$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos_beneficiario'];
		$empleado->ocupacion_beneficiario = $request->input('datos')['ocupacion_beneficiario'];
		$empleado->escolaridad_id = $request->input('datos')['escolaridad_beneficiario'];
		$empleado->estado_escolaridad = $request->input('datos')['estado_escolaridad'];
		$empleado->titulo_obtenido = $request->input('datos')['titulo_obtenido'];
		if ($request->input('datos')['universidad'] != null)
				{
					$empleado->universidad_id = $request->input('datos')['universidad'];
				}
				else{
					$empleado->universidad_id = null;					
				}
		$empleado->ocupacion_id = $request->input('datos')['ocupacion_beneficiario'];
		$empleado->hijos_empleado = $request->input('datos')['hijos_beneficiario'];
		$empleado->cantidad_hijos = $request->input('datos')['cantidad_hijos_beneficiario'];
		$empleado->etnia_id = $request->input('datos')['cultura_beneficiario'];
		$empleado->enfermedad_permanente = $request->input('datos')['discapacidad_beneficiario'];
		$empleado->otra_enfermedad = $request->input('datos')['otra_discapacidad_beneficiario'];
		$empleado->medicamentos = $request->input('datos')['medicamentos_permanente_beneficiario'];
		$empleado->otros_medicamentos = $request->input('datos')['medicamentos_beneficiario'];
		$empleado->condicion_discapacidad = $request->input('datos')['condicion_discapacidad'];
		$empleado->afiliacion_salud = $request->input('datos')['afiliacion_salud'];
		$empleado->tipoafiliacion_id = $request->input('datos')['tipo_afiliacion'];
		$empleado->eps_id = $request->input('datos')['salud_sgsss_beneficiario'];
		$empleado->libreta_militar = $request->input('datos')['tipo_libreta'];
		$empleado->no_libreta = $request->input('datos')['no_libreta'];
		$empleado->distrito_militar = $request->input('datos')['distrito_militar'];
		$empleado->skype_empleado = $request->input('datos')['skype_empleado'];
		$empleado->proyecto_profesional = $request->input('datos')['proyecto_profesional'];
		$empleado->otro_poblacional = $request->input('datos')['otro_poblacional'];
		$empleado->save();


		if ($request->input('SelectPoblacional') != null)
		{

		foreach ($request->input('SelectPoblacional') as $value) {

			$poblacional = null;					
			if (isset($value['value_id'])) {

				$poblacional = EmpleadoPoblacional::find($value['value_id']);

			}	
			else {
				$poblacional = new EmpleadoPoblacional();

			}

			$poblacional->empleado_id	= $empleado->id;
			$poblacional->grupopoblacional_id	= $value['id']; 		
			$poblacional->save();
			}
		}


		if ($request->input('SelectDiscapacidad') != null)
		{

		foreach ($request->input('SelectDiscapacidad') as $value) {

			$discapacidad = null;					
			if (isset($value['value_id'])) {


				$discapacidad = EmpleadoDiscapacidad::find($value['value_id']);


			}	
			else {
				$discapacidad = new EmpleadoDiscapacidad();

			}

			$discapacidad->empleado_id	= $empleado->id;
			$discapacidad->discapacidad_id	= $value['id']; 		
			$discapacidad->save();
			}
		}

		if ($request->input('SelectDisciplina') != null)
		{

		foreach ($request->input('SelectDisciplina') as $value) {

			$disciplina = null;					
			if (isset($value['value_id'])) {

				$disciplina = EmpleadoDisciplina::find($value['value_id']);

			}	
			else {
				$disciplina = new EmpleadoDisciplina();

			}

			$disciplina->empleado_id	= $empleado->id;
			$disciplina->disciplina_id	= $value['id']; 		
			$disciplina->save();
			}
		}
	}

	public function EditarPerfilUsuario(Request $request, $id)
	{

		$persona = Persona::select(
			'tbl_gen_persona.id',
			'nombre_primero', 
            'nombre_segundo',
            'apellido_primero', 
            'apellido_segundo',
            'documento',
            'id_documento_tipo',
            'tbl_gen_persona.sexo',
            'tbl_gen_persona.fecha_nacimiento',
            'tbl_gen_persona.telefono_fijo',
            'tbl_gen_persona.telefono_movil',
            'tbl_gen_persona.correo_electronico',
            'tbl_gen_persona.id_procedencia_pais',
            'tbl_gen_persona.id_procedencia_municipio',
            'tbl_gen_persona.id_procedencia_departamento',
            'tbl_gen_persona.id_residencia_corregimiento',
            'tbl_gen_persona.id_residencia_barrio',
            'tbl_gen_persona.id_residencia_vereda',
            'tbl_gen_persona.residencia_direccion',
            'tbl_gen_persona.residencia_estrato',
            'tbl_gen_persona.sangre_tipo',
			'tbl_gen_persona.id_estado_civil',
			'tbl_gen_persona.departamento_residencia_id',
			'tbl_gen_persona.municipio_residencia_id',
			'tbl_gen_persona.direccion_residencia',
			'tbl_gen_persona.escolaridad_id',
			'tbl_gen_persona.estado_escolaridad',
			'tbl_gen_persona.ocupacion_id')
			->join(
				'tbl_cm_empleado',
				'tbl_cm_empleado.id_persona', '=', 'tbl_gen_persona.id')
				
			->join(
				'users',
				'users.id', '=', 'tbl_cm_empleado.id_usuario')
        
        
        ->firstOrNew(array('tbl_cm_empleado.id_usuario' => $id));
 
		$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
		$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
		$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
		$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
		$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
		$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
		$persona->correo_electronico = $request->input('datos')['correo_persona'];
		$persona->sexo = $request->input('datos')['sexo_persona'];
		$persona->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_persona']));
		$persona->id_procedencia_pais = $request->input('datos')['pais_id'];
		$persona->id_procedencia_departamento = $request->input('datos')['departamento_id'];
		$persona->id_procedencia_municipio = $request->input('datos')['municipio_id'];
		$persona->id_residencia_corregimiento = $request->input('datos')['corregimiento'];
		$persona->id_residencia_vereda = $request->input('datos')['vereda'];
		$persona->id_residencia_barrio = $request->input('datos')['barrio_id'];
		$persona->residencia_estrato = $request->input('datos')['estrato'];
		$persona->residencia_direccion = $request->input('datos')['residencia_persona'] . $request->input('datos')['complemento'];
		$persona->telefono_fijo = $request->input('datos')['telefono_fijo_persona'];
		$persona->telefono_movil = $request->input('datos')['telefono_movil_persona'];
		$persona->sangre_tipo  = $request->input('datos')['tip_sangre_persona'];
		$persona->id_estado_civil  = $request->input('datos')['estado_civil_persona'];
		//Nuevos campos
		$persona->departamento_residencia_id  = $request->input('datos')['departamento_residencia'];
		$persona->municipio_residencia_id  = $request->input('datos')['municipio_residencia'];
		$persona->direccion_residencia  = $request->input('datos')['direc_residencia'];
		//Nuevos Campos
		$persona->escolaridad_id = $request->input('datos')['escolaridad_beneficiario'];
		$persona->estado_escolaridad = $request->input('datos')['estado_escolaridad'];
		$persona->ocupacion_id = $request->input('datos')['ocupacion_beneficiario'];
		$persona->save();

		$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
		$usuario = User::firstOrNew(array('id' => $id ));
		$usuario->primer_nombre = $request->input('datos')['primer_nombre_persona'];
		$usuario->email = $request->input('datos')['correo_persona'];
		$usuario->password = bcrypt($doc_persona);
		$usuario->remember_token = str_random(50);
		$usuario->segundo_nombre = $request->input('datos')['segundo_nombre_persona'];
		$usuario->primer_apellido = $request->input('datos')['primer_apellido_persona'];
		$usuario->segundo_apellido = $request->input('datos')['segundo_apellido_persona'];
		$usuario->tipo_documento = $request->input('datos')['tipo_doc_persona'];
		$usuario->numero_documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
		$usuario->direccion = $request->input('datos')['residencia_persona'] . $request->input('datos')['complemento'];
		$usuario->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_persona']));
		$usuario->telefono_movil = $request->input('datos')['telefono_movil_persona'];
		$usuario->telefono_fijo = $request->input('datos')['telefono_fijo_persona'];
		$usuario->save();

	

		$empleado = Empleado::select(
			'tbl_cm_empleado.id',
			'id_persona',
			'id_usuario',
			'hijos_beneficiario',
			'cantidad_hijos_beneficiario',
			'tbl_cm_empleado.ocupacion_beneficiario',
			'tbl_cm_empleado.escolaridad_id',
			'tbl_cm_empleado.estado_escolaridad',
			'titulo_obtenido',
			'universidad_id',
			'tbl_cm_empleado.ocupacion_id',
			'hijos_empleado',
			'cantidad_hijos',
			'etnia_id',
			'enfermedad_permanente',
			'otra_enfermedad',
			'medicamentos',
			'otros_medicamentos',
			'condicion_discapacidad',
			'afiliacion_salud',
			'tipoafiliacion_id',
			'eps_id',
			'libreta_militar',
			'no_libreta',
			'distrito_militar',
			'skype_empleado',
			'proyecto_profesional',
			'otro_poblacional'
		
 
	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')
		->join(
			'users',
			'users.id', '=', 'tbl_cm_empleado.id_usuario')
				
		->firstOrNew(array('tbl_cm_empleado.id_usuario' => $id ));
 
		$empleado->id_persona = $persona->id;
		$empleado->id_usuario = $usuario->id;
		$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
		$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos_beneficiario'];
		$empleado->ocupacion_beneficiario = $request->input('datos')['ocupacion_beneficiario'];
		$empleado->escolaridad_id = $request->input('datos')['escolaridad_beneficiario'];
		$empleado->estado_escolaridad = $request->input('datos')['estado_escolaridad'];
		$empleado->titulo_obtenido = $request->input('datos')['titulo_obtenido'];
		if ($request->input('datos')['universidad'] != null)
				{
					$empleado->universidad_id = $request->input('datos')['universidad'];
				}
				else{
					$empleado->universidad_id = null;					
				}
		$empleado->ocupacion_id = $request->input('datos')['ocupacion_beneficiario'];
		$empleado->hijos_empleado = $request->input('datos')['hijos_beneficiario'];
		$empleado->cantidad_hijos = $request->input('datos')['cantidad_hijos_beneficiario'];
		$empleado->etnia_id = $request->input('datos')['cultura_beneficiario'];
		$empleado->enfermedad_permanente = $request->input('datos')['discapacidad_beneficiario'];
		$empleado->otra_enfermedad = $request->input('datos')['otra_discapacidad_beneficiario'];
		$empleado->medicamentos = $request->input('datos')['medicamentos_permanente_beneficiario'];
		$empleado->otros_medicamentos = $request->input('datos')['medicamentos_beneficiario'];
		$empleado->condicion_discapacidad = $request->input('datos')['condicion_discapacidad'];
		$empleado->afiliacion_salud = $request->input('datos')['afiliacion_salud'];
		$empleado->tipoafiliacion_id = $request->input('datos')['tipo_afiliacion'];
		$empleado->eps_id = $request->input('datos')['salud_sgsss_beneficiario'];
		$empleado->libreta_militar = $request->input('datos')['tipo_libreta'];
		$empleado->no_libreta = $request->input('datos')['no_libreta'];
		$empleado->distrito_militar = $request->input('datos')['distrito_militar'];
		$empleado->skype_empleado = $request->input('datos')['skype_empleado'];
		$empleado->proyecto_profesional = $request->input('datos')['proyecto_profesional'];
		$empleado->otro_poblacional = $request->input('datos')['otro_poblacional'];
		$empleado->save();


		if ($request->input('SelectPoblacional') != null)
		{

		foreach ($request->input('SelectPoblacional') as $value) {

			$poblacional = null;					
			if (isset($value['value_id'])) {

				$poblacional = EmpleadoPoblacional::find($value['value_id']);

			}	
			else {
				$poblacional = new EmpleadoPoblacional();

			}

			$poblacional->empleado_id	= $empleado->id;
			$poblacional->grupopoblacional_id	= $value['id']; 		
			$poblacional->save();
			}
		}


		if ($request->input('SelectDiscapacidad') != null)
		{

		foreach ($request->input('SelectDiscapacidad') as $value) {

			$discapacidad = null;					
			if (isset($value['value_id'])) {


				$discapacidad = EmpleadoDiscapacidad::find($value['value_id']);


			}	
			else {
				$discapacidad = new EmpleadoDiscapacidad();

			}

			$discapacidad->empleado_id	= $empleado->id;
			$discapacidad->discapacidad_id	= $value['id']; 		
			$discapacidad->save();
			}
		}

		if ($request->input('SelectDisciplina') != null)
		{

		foreach ($request->input('SelectDisciplina') as $value) {

			$disciplina = null;					
			if (isset($value['value_id'])) {

				$disciplina = EmpleadoDisciplina::find($value['value_id']);

			}	
			else {
				$disciplina = new EmpleadoDisciplina();

			}

			$disciplina->empleado_id	= $empleado->id;
			$disciplina->disciplina_id	= $value['id']; 		
			$disciplina->save();
			}
		}
	}

}
