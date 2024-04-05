<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Grupo;
use App\ProgramaGrupo;
use App\HorarioGrupo;
use App\Programa;
use App\Pais;
use App\Departamento;
use App\Municipio;
use App\Barrio;
use App\Beneficiario;
use App\PoblacionalBeneficiario;
use Response;
use App\Persona;
use App\FichaComunidad;
use App\FichaPrograma;
use App\Vereda;
use App\TblCmConfig;
use App\Asistencia;
use App\AsistenciaPrograma;
use App\BeneficiarioGrupo;
use App\EstadoEscolaridad;
use App\Universidad;
use App\Etnia;
use App\User;
use App\Empleado;
use App\Afiliacion;
use App\PersonaDiscapacidad;
use App\EmpleadoPoblacional;
use App\EmpleadoDiscapacidad;
use App\EmpleadoDisciplina;
use App\PoblacionalPrograma;
use App\ProgramaDiscapacidad;
use DB;
use DateTime;

class PostGruposController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postgrupos.appgrupos");
	}

	public function index()
	{

		$grupos = Grupo::select('grupos.id', 'grupos.user_id', 'grupos.codigo_grupo', 'grupos.observaciones', 'grupos.estado', 'sedes.nombre_sede', 'instituciones.nombre_institucion', 'tbl_cm_grados.nombre_grado')->leftJoin(
			'sedes',
			'sedes.id', '=', 'grupos.sede_id')->leftJoin(
				'instituciones',
				'instituciones.id', '=', 'sedes.institucion_id')->leftJoin(
				'tbl_cm_grados',
				'tbl_cm_grados.id', '=', 'grupos.grado_id')->where('grupos.user_id', '=', Auth::id())
				->where('grupos.tenantId', '=', Auth::user()->tenantId)
				->where('grupos.estado', '=', 0)
				->get();

			return response()->json(
				$grupos->toArray()
			);
		}

	public function ConsultaGrupos()
	{

		$grupos = Grupo::select('grupos.id', 'grupos.user_id', 'grupos.codigo_grupo', 'grupos.observaciones', 'grupos.estado', 'sedes.nombre_sede', 'instituciones.nombre_institucion', 'tbl_cm_grados.nombre_grado', 'users.primer_nombre', 'users.primer_apellido')
			->join(
			'sedes',
			'sedes.id', '=', 'grupos.sede_id')
			->join(
				'instituciones',
				'instituciones.id', '=', 'sedes.institucion_id')
			->join(
				'tbl_cm_grados',
				'tbl_cm_grados.id', '=', 'grupos.grado_id')
			->join(
				'users',
				'users.id', '=', 'grupos.user_id')->where('users.tenantId', '=', Auth::user()->tenantId)
				->where('grupos.estado', 0)
				->get();

			return response()->json(
				$grupos->toArray()
			);
		}

		public function ConsultaGruposUsuario($usuario)
	{

		$grupos = Grupo::select('grupos.id', 'grupos.user_id', 'grupos.codigo_grupo', 'grupos.observaciones', 'grupos.estado', 'sedes.nombre_sede', 'instituciones.nombre_institucion', 'tbl_cm_grados.nombre_grado', 'users.primer_nombre', 'users.primer_apellido')
			->join(
			'sedes',
			'sedes.id', '=', 'grupos.sede_id')
			->join(
				'instituciones',
				'instituciones.id', '=', 'sedes.institucion_id')
			->join(
				'tbl_cm_grados',
				'tbl_cm_grados.id', '=', 'grupos.grado_id')
			->join(
				'users',
				'users.id', '=', 'grupos.user_id')->where('grupos.user_id', '=', $usuario)->where('users.tenantId', '=', Auth::user()->tenantId)->get();

			return response()->json(
				$grupos->toArray()
			);
		}


		public function ObtenerCountGrupos()
		{

			$grupos = Grupo::all();
			$count_grupos = count($grupos) + 1;
			return response()->json(
				$count_grupos
			);
		}




		public function CrearGrupo(Request $request){


			if(Auth::user()->tenantId == '5467829281')
			{
				$inicial = 'cm';
			}
			else if (Auth::user()->tenantId == '2767829213')
			{
				$inicial = 'de';
			}
			$inicial = "";

			$codigo   = TblCmConfig::where('name', '=', 'codigo_grupo')->firstOrFail();
        	$codigo->value = $codigo->value + 1;
        	$codigo->save();
			$grupo = new Grupo();
			$grupo->codigo_grupo = $inicial.str_pad($codigo->value, 4, '0', STR_PAD_LEFT);
			$grupo->grado_id = $request->input('grado');
			$grupo->user_id = Auth::id();
			$grupo->sede_id = $request->input('sede');
			$grupo->observaciones = $request->input('observaciones');
			$grupo->tenantId = Auth::user()->tenantId;
			$grupo->save();



			foreach ($request->input('dias_horario') as $value) {

				$inicio = explode(' ', $value['inicio']);
				$fin = explode(' ', $value['fin']);

				$horario_grupo = new HorarioGrupo();
				$horario_grupo->grupo_id	= $grupo->id;
				$horario_grupo->dia			= $value['id'];
				$horario_grupo->hora_inicio	= $inicio[4];
				$horario_grupo->hora_fin	= $fin[4];
				$horario_grupo->save();
			}

			return response()->json(["mensaje"=>"guardado"]);
		}





		public function ObtenerGrupoMonitor(){

			$grupo = Grupo::where('grupos.user_id', '=', Auth::id())
			->where('grupos.tenantId', '=', Auth::user()->tenantId)
			->get();
			return response()->json(
				$grupo->toArray()
			);
		}

		public function ObtenerGrupoMonitorPrograma(){

			$grupo = ProgramaGrupo::where('tbl_pr_grupos.user_id', '=', Auth::id())
			->where('tbl_pr_grupos.tenantId', '=', Auth::user()->tenantId)
			->get();
			return response()->json(
				$grupo->toArray()
			);
		}

		public function ObtenerGruposAll(){

			$grupo = Grupo::all();
			return response()->json(
				$grupo->toArray()
			);
		}


		public function ObtenerGrupo($id){




			$grupo = Grupo::where('grupos.id', '=', $id)->firstOrfail();
			return response()->json(
				$grupo->toArray()
			);
		}



		public function ObtenerGrado($id){


			$grados = Grupo::select('tbl_cm_grados.id', 'tbl_cm_grados.nombre_grado')->join(
				'tbl_cm_grados',
				'tbl_cm_grados.id', '=', 'grupos.grado_id')->where('grupos.id', '=', $id)->firstOrfail();
				return response()->json(
					$grados->toArray()
				);

		}


		public function ObtenerSedeGrupoID($id){

			$sedes = Grupo::select('sedes.id', 'sedes.nombre_sede', 'instituciones.nombre_institucion')->join(
				'sedes',
				'sedes.id', '=', 'grupos.sede_id')->join('instituciones',
				'instituciones.id', '=', 'sedes.institucion_id')->where('grupos.id', '=', $id)->firstOrfail();
				return response()->json(
					$sedes->toArray()
				);

			}



			public function ObtenerGrupoHorarioID($id){

				$horario = HorarioGrupo::select('horario_grupos.id', 'horario_grupos.dia', 'horario_grupos.hora_inicio','horario_grupos.hora_fin')->join(
					'grupos',
					'grupos.id', '=', 'horario_grupos.grupo_id')->where('horario_grupos.grupo_id', '=', $id)->get();
				return response()->json(
					$horario->toArray()
				);

			}


			public function ObtenerProgramas()
			{

				$programas = Programa::all();
				return response()->json(
					$programas
				);
			}

			public function ObtenerPaises()
			{

				$paises = Pais::all();
				return response()->json(
					$paises
				);
			}


			public function ObtenerDepartamentos($id)
			{

				$departamentos = Departamento::select('departamentos.id', 'departamentos.nombre_departamento')->join(
					'paises',
					'paises.id', '=', 'departamentos.pais_id')->where('paises.id', '=', $id)->get();
				return response()->json(
					$departamentos
				);
			}

			public function ObtenerMunicipios($id)
			{

				$municipios = Municipio::select('municipios.id','municipios.nombre_municipio')->join(
					'departamentos',
					'departamentos.id', '=', 'municipios.departamento_id')->where('departamentos.id', '=', $id)->get();
				return response()->json(
					$municipios
				);
			}

			public function ObtenerBarrios($id)
			{

				$barrios = Barrio::select('barrios.id','barrios.nombre_barrio')->join(
					'comunas',
					'comunas.id', '=', 'barrios.comuna_id')->where('comunas.id', '=', $id)->get();
				return response()->json(
					$barrios
				);
			}
			public function ObtenerBarriosTotal()
			{

				$barrios = DB::table('barrios')
   				 ->select(
		         'id',
		          DB::raw('UPPER(nombre_barrio) as nombre_barrio'))
		          ->orderBy('nombre_barrio', 'asc')
		          ->get();
				return response()->json(
					$barrios
				);
			}


				public function ObtenerBarriosTotal2()
			{

				$datos = DB::table('barrios')
   				 ->select(
		         'id',
		          DB::raw('UPPER(nombre_barrio) as name'))
		          ->orderBy('name', 'asc')
		          ->get();

				return ['datos' => $datos];
			}
			public function ObtenerEstrato($id)
			{

				$estrato= Barrio::select('barrios.id_estrato', 'barrios.comuna_id', 'comunas.nombre_comuna'
				)->join('comunas',
				'comunas.id', '=', 'barrios.comuna_id')
				->where('barrios.id', '=', $id)->firstOrfail();
				return response()->json(
					$estrato);
			}

			public function ObtenerEstratoVereda($id)
			{

				$estrato= Vereda::select('tbl_gen_veredas.estrato', 'tbl_gen_veredas.id_comuna', 'comunas.nombre_comuna')
				->join('comunas',
				'comunas.id', '=', 'tbl_gen_veredas.id_comuna')->where('tbl_gen_veredas.id', '=', $id)->firstOrfail();
				return response()->json(
					$estrato);
			}



			public function ActualizarGrupo(Request $request, $id)
			{



				if ($request->input('datos')['sede'] == 0) {


					$grupo = Grupo::findOrfail($id);
					$grupo->codigo_grupo = $request->input('datos')['codigo_grupo'];
					$grupo->grado_id = $request->input('datos')['grado'];
					$grupo->user_id = Auth::id();
					$grupo->observaciones = $request->input('datos')['observaciones'];
					$grupo->save();


				}
				else {

					$grupo = Grupo::findOrfail($id);
					$grupo->codigo_grupo = $request->input('datos')['codigo_grupo'];
					$grupo->user_id = Auth::id();
					$grupo->sede_id = $request->input('datos')['sede'];
					$grupo->grado_id = $request->input('datos')['grado'];
					$grupo->observaciones = $request->input('observaciones')['observaciones'];
					$grupo->save();

				}

				foreach ($request->input('dias_horario') as $value) {



					$inicio = explode(' ', $value['inicio']);
					$fin = explode(' ', $value['fin']);

					$horario_grupo = null;

					if (isset($value['_id'])) {

						$horario_grupo =HorarioGrupo::find($value['_id']);

					}	else {

						$horario_grupo = new HorarioGrupo();

					}

					$horario_grupo->grupo_id	= $request->id;
					$horario_grupo->dia			= $value['id'];
					$horario_grupo->hora_inicio	= $inicio[4];
					$horario_grupo->hora_fin	= $fin[4];
					$horario_grupo->save();


				}

			}

			public function CrearPersonal(Request $request)
			{

				$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
				$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
				$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
				$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
				$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
				$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
				$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
				$persona->correo_electronico = $request->input('datos')['correo_persona'];
				$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
				$persona->tenantId = '5467829281';
				$persona->save();

				$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
                $usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
            	$usuario->tenantId = '5467829281';
				$usuario->save();

				$empleado = Empleado::select(
					'tbl_cm_empleado.id',
					'id_persona',
					'id_usuario',
					'hijos_beneficiario',
					'cantidad_hijos_beneficiario',
					'ocupacion_beneficiario',
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
					'tbl_cm_empleado.tenantId'


			)->join(
				'tbl_gen_persona',
				'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
				$empleado->id_persona = $persona->id;
				$empleado->id_usuario = $usuario->id;
				$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
				$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
				$empleado->tenantId = '5467829281';
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

			if($request->input('SelectDiscapacidad') != null)
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


		if($request->input('SelectDisciplina') != null)
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

			public function CrearPersonalDeporte(Request $request)
			{


				$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
				$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
				$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
				$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
				$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
				$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
				$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
				$persona->correo_electronico = $request->input('datos')['correo_persona'];
				$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
				$persona->tenantId = '2767829213';
				$persona->save();

				$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
                $usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
            	$usuario->tenantId = '2767829213';
				$usuario->save();

				$empleado = Empleado::select(
					'tbl_cm_empleado.id',
					'id_persona',
					'id_usuario',
					'hijos_beneficiario',
					'cantidad_hijos_beneficiario',
					'ocupacion_beneficiario',
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
					'tbl_cm_empleado.tenantId'


			)->join(
				'tbl_gen_persona',
				'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
				$empleado->id_persona = $persona->id;
				$empleado->id_usuario = $usuario->id;
				$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
				$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
				$empleado->tenantId = '2767829213';
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

			if($request->input('SelectDiscapacidad') != null)
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


		if($request->input('SelectDisciplina') != null)
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

	public function CrearPersonalCaliacoge(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '3651901612';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '3651901612';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '3651901612';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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


public function CrearPersonalCalisedivierte(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '9108237611';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '9108237611';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '9108237611';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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


public function CrearPersonalCalintegra(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '7233109821';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '7233109821';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '7233109821';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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


public function CrearPersonalCanasyganas(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '1240916273';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '1240916273';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '1240916273';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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





public function CrearPersonalCarrerasycaminatas(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '2871155601';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '2871155601';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '2871155601';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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



public function CrearPersonalCuerpoyespiritu(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '8762109662';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '8762109662';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '8762109662';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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

public function CrearPersonalDeporteasociado(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '4432891188';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '4432891188';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '4432891188';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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


public function CrearPersonalDeportecomunitario(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '2288251678';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '2288251678';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '2288251678';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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

public function CrearPersonalVertigo(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '3365342001';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '3365342001';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '3365342001';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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


public function CrearPersonalViactiva(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '1177624100';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '1177624100';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '1177624100';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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





public function CrearPersonalViveelparque(Request $request)
{


	$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$persona->id_documento_tipo = $request->input('datos')['tipo_doc_persona'];
	$persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$persona->nombre_primero = $request->input('datos')['primer_nombre_persona'];
	$persona->nombre_segundo = $request->input('datos')['segundo_nombre_persona'];
	$persona->apellido_primero = $request->input('datos')['primer_apellido_persona'];
	$persona->apellido_segundo = $request->input('datos')['segundo_apellido_persona'];
	$persona->correo_electronico = $request->input('datos')['correo_persona'];
	$persona->sexo = (int)$request->input('datos')['sexo_persona'];
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
	$persona->tenantId = '7765533102';
	$persona->save();

	$doc_persona = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']));
	$usuario = User::firstOrNew(array('numero_documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
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
	$usuario->tenantId = '7765533102';
	$usuario->save();

	$empleado = Empleado::select(
		'tbl_cm_empleado.id',
		'id_persona',
		'id_usuario',
		'hijos_beneficiario',
		'cantidad_hijos_beneficiario',
		'ocupacion_beneficiario',
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
		'tbl_cm_empleado.tenantId'


	)->join(
		'tbl_gen_persona',
		'tbl_gen_persona.id', '=', 'tbl_cm_empleado.id_persona')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));
	$empleado->id_persona = $persona->id;
	$empleado->id_usuario = $usuario->id;
	$empleado->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
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
	$empleado->cantidad_hijos = (int)$request->input('datos')['cantidad_hijos'];
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
	$empleado->tenantId = '7765533102';
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

	if($request->input('SelectDiscapacidad') != null)
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


	if($request->input('SelectDisciplina') != null)
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

	public function CrearBeneficiarioGrupo(Request $request, $id)
			{

			$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));


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
			//Nuevos Campos
			$persona->escolaridad_id = $request->input('datos')['escolaridad_beneficiario'];
			$persona->estado_escolaridad = $request->input('datos')['estado_escolaridad'];
			$persona->ocupacion_id = $request->input('datos')['ocupacion_beneficiario'];
			$persona->save();


			if($request->input('datos')['no_documento_acudiente'] != null){

			$acudiente_persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_acudiente']))));
			$acudiente_persona->nombre_primero = $request->input('datos')['primer_nombre_acudiente'];
			$acudiente_persona->nombre_segundo = $request->input('datos')['segundo_nombre_acudiente'];
			$acudiente_persona->apellido_primero = $request->input('datos')['primer_apellido_acudiente'];
			$acudiente_persona->apellido_segundo = $request->input('datos')['segundo_apellido_acudiente'];
			$acudiente_persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_acudiente']));
			$acudiente_persona->id_documento_tipo = $request->input('datos')['tip_doc_acudiente'];
			
			$acudiente_persona->sexo = $request->input('datos')['sex_pariente'];
			$acudiente_persona->sexo_acudiente_otro = $request->input('datos')['sexo_acudiente_otro'];
			
			$acudiente_persona->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_acudiente']));
			$acudiente_persona->telefono_fijo = $request->input('datos')['telefono_fijo_acudiente'];
			$acudiente_persona->telefono_movil = $request->input('datos')['telefono_movil_acudiente'];
			$acudiente_persona->correo_electronico = $request->input('datos')['correo_acudiente'];
			$acudiente_persona->save();


			}




   $beneficiario_copia = FichaComunidad::join(
   	'tbl_gen_persona',
   	'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->where('tbl_gen_persona.documento', '=', trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona'])))->get();


   if (count($beneficiario_copia) === 0) {

   	$BeneficiarioGrupo = new BeneficiarioGrupo();
   	$BeneficiarioGrupo->grupo_id = $request->id;
   	$BeneficiarioGrupo->id_persona_beneficiario = $persona->id;
   	$BeneficiarioGrupo->fecha_inscripcion = date('Y-m-d',strtotime($request->input('datos')['fecha_inscripcion']));
   	$BeneficiarioGrupo->save();

   }


   $beneficiario = FichaComunidad::select(
   		'tbl_cm_ficha.id',
   		'id_persona_beneficiario',
        'grupo_id',
        'fecha_inscripcion',
        'no_ficha',
        'modalidad_id',
        'puntoatencion_id',
        'hijos_beneficiario',
        'cantidad_hijos_beneficiario',
        'tbl_cm_ficha.ocupacion_beneficiario',
		'tbl_cm_ficha.escolaridad_id',
		'tbl_cm_ficha.estado_escolaridad',
		'tbl_cm_ficha.cultura_beneficiario',
		'discapacidad_beneficiario',
		'discapacidad_id',
		'otra_discapacidad_beneficiario',
		'medicamentos_permanente_beneficiario',
		'medicamentos_beneficiario',
		'condicion_discapacidad',
		'afiliacion_salud',
		'tipo_afiliacion',
		'salud_sgss_id',
		'id_persona_acudiente',
		'parentesco_acudiente',
		'otro_parentesco_acudiente',
		'fecha_retiro',
		'otro_poblacional',
		'tbl_cm_ficha.tenantId',
		'tbl_cm_ficha.comuna_id',
    	'tbl_cm_ficha.created_at',
    	'tbl_cm_ficha.updated_at'

   )->join(
   	'tbl_gen_persona',
   	'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona'])), 'tbl_cm_ficha.tenantId' => Auth::user()->tenantId, 'tbl_cm_ficha.grupo_id' => (int)$request->id));

		$beneficiario->id_persona_beneficiario = $persona->id;
		$beneficiario->grupo_id = $request->id;
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
		$beneficiario->afiliacion_salud = $request->input('datos')['afiliacion_salud'];
		$beneficiario->tipo_afiliacion = $request->input('datos')['tipo_afiliacion'];
		$beneficiario->salud_sgss_id = $request->input('datos')['salud_sgsss_beneficiario'];
		
		
		$beneficiario->otro_poblacional = $request->input('datos')['otro_poblacional'];
		$beneficiario->condicion_discapacidad_otro = (isset($request->input('datos')['condicion_discapacidad_otro'])?$request->input('datos')['condicion_discapacidad_otro']:null);
		$beneficiario->clubes_deportivos_id = (!isset($request->input('datos')['clubes_deportivos_id'])||$request->input('datos')['clubes_deportivos_id'] == null ? null :$request->input('datos')['clubes_deportivos_id']);

		$beneficiario->comuna_id = $request->input('datos')['comuna'];
		$beneficiario->tenantId = Auth::user()->tenantId;
		$beneficiario->parentesco_acudiente = $request->input('datos')['parentesco_acudiente'];

		$beneficiario->otro_parentesco_acudiente = $request->input('datos')['otro_parentesco_acudiente'];

		if($request->input('datos')['no_documento_acudiente'] == null){
		$beneficiario->id_persona_acudiente = null;

		}
		else{
		$beneficiario->id_persona_acudiente = $acudiente_persona->id;

		}
		$beneficiario->save();



if ($request->input('SelectPoblacional') != null)
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

  if ($request->input('SelectDiscapacidad') != null)
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

		return	Response::json(array('persona'=>$persona,'beneficiario'=>$beneficiario));
	}


public function CrearBeneficiarioGrupoPrograma(Request $request, $id)
			{


			$fecha_inscripcion = date('Y-m-d',strtotime($request->input('datos')['fecha_inscripcion']));


			if ($fecha_inscripcion == '1970-01-01') {
				$fecha_inscripcion = date('Y-m-d');

			}

			$persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona']))));

			$persona->id_documento_tipo = (int)$request->input('datos')['tipo_doc_persona'];
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
			$persona->otro_municipio = $request->input('datos')['otro_municipio'];
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
			//Nuevos Campos
			$persona->escolaridad_id = (int)$request->input('datos')['escolaridad_beneficiario'];
			$persona->estado_escolaridad = (int)$request->input('datos')['estado_escolaridad'];
			$persona->ocupacion_id = (int)$request->input('datos')['ocupacion_beneficiario'];
			$persona->tenantId = Auth::user()->tenantId;
			$persona->save();

			if($request->input('datos')['no_documento_acudiente'] != null)
			{
			$acudiente_persona = Persona::firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_acudiente']))));

			$acudiente_persona->nombre_primero = $request->input('datos')['primer_nombre_acudiente'];
			$acudiente_persona->nombre_segundo = $request->input('datos')['segundo_nombre_acudiente'];
			$acudiente_persona->apellido_primero = $request->input('datos')['primer_apellido_acudiente'];
			$acudiente_persona->apellido_segundo = $request->input('datos')['segundo_apellido_acudiente'];
			$acudiente_persona->documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_acudiente']));
			$acudiente_persona->id_documento_tipo = $request->input('datos')['tip_doc_acudiente'];
			
			$acudiente_persona->sexo = $request->input('datos')['sex_pariente'];
			$acudiente_persona->sexo_acudiente_otro = (isset($request->input('datos')['sexo_acudiente_otro'])?$request->input('datos')['sexo_acudiente_otro']:null);
			
			$acudiente_persona->fecha_nacimiento = date('Y-m-d',strtotime($request->input('datos')['fecha_nac_acudiente']));
			$acudiente_persona->telefono_fijo = $request->input('datos')['telefono_fijo_acudiente'];
			$acudiente_persona->telefono_movil = $request->input('datos')['telefono_movil_acudiente'];
			$acudiente_persona->correo_electronico = $request->input('datos')['correo_acudiente'];
			$acudiente_persona->tenantId = Auth::user()->tenantId;
			$acudiente_persona->save();

			}
			else if($request->input('datos')['no_documento_acudiente'] == null)
			{
				$acudiente_persona = null;
			}


   $beneficiario_copia = FichaPrograma::join(
   	'tbl_gen_persona',
   	'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')->where('tbl_gen_persona.documento', '=', trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona'])))->get();



   $beneficiario = FichaPrograma::select(
   		'tbl_pr_ficha.id',
		'tbl_pr_ficha.id_persona_beneficiario',
		'tbl_pr_ficha.grupo_id',
		'tbl_pr_ficha.fecha_inscripcion',
		'tbl_pr_ficha.no_ficha',
		'tbl_pr_ficha.hijos_beneficiario',
		'tbl_pr_ficha.cantidad_hijos_beneficiario',
		'tbl_pr_ficha.ocupacion_beneficiario',
		'tbl_pr_ficha.cultura_beneficiario',
		'tbl_pr_ficha.discapacidad_beneficiario',
		'tbl_pr_ficha.otra_discapacidad_beneficiario',
		'tbl_pr_ficha.medicamentos_permanente_beneficiario',
		'tbl_pr_ficha.medicamentos_beneficiario',
		'tbl_pr_ficha.condicion_discapacidad',
		'tbl_pr_ficha.afiliacion_salud',
		'tbl_pr_ficha.tipo_afiliacion',
		'tbl_pr_ficha.salud_sgss_id',
		'tbl_pr_ficha.id_persona_acudiente',
		'tbl_pr_ficha.parentesco_acudiente',
		'tbl_pr_ficha.otro_parentesco_acudiente',
		'tbl_pr_ficha.fecha_retiro',
		'tbl_pr_ficha.otro_poblacional',
		'tbl_pr_ficha.tenantId',
		'tbl_pr_ficha.comuna_id',
    	'tbl_pr_ficha.created_at',
    	'tbl_pr_ficha.updated_at'

   )->join(
   	'tbl_gen_persona',
   	'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')->firstOrNew(array('tbl_gen_persona.documento' => trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('datos')['no_documento_persona'])), 'tbl_pr_ficha.tenantId' => Auth::user()->tenantId, 'tbl_pr_ficha.grupo_id' => (int)$request->id));

$beneficiario->id_persona_beneficiario = $persona->id;
$beneficiario->grupo_id = (int)$request->id;
$beneficiario->no_ficha = $request->input('datos')['no_ficha'];
$beneficiario->fecha_inscripcion = $fecha_inscripcion;
$beneficiario->ocupacion_beneficiario = $request->input('datos')['ocupacion_beneficiario'];
$beneficiario->hijos_beneficiario = $request->input('datos')['hijos_beneficiario'];
$beneficiario->cantidad_hijos_beneficiario = $request->input('datos')['cantidad_hijos_beneficiario'];
$beneficiario->discapacidad_beneficiario = $request->input('datos')['discapacidad_beneficiario'];
$beneficiario->otra_discapacidad_beneficiario = $request->input('datos')['otra_discapacidad_beneficiario'];
$beneficiario->medicamentos_permanente_beneficiario = $request->input('datos')['medicamentos_permanente_beneficiario'];
$beneficiario->medicamentos_beneficiario = $request->input('datos')['medicamentos_beneficiario'];
$beneficiario->condicion_discapacidad = $request->input('datos')['condicion_discapacidad'];
$beneficiario->afiliacion_salud = $request->input('datos')['afiliacion_salud'];
$beneficiario->salud_sgss_id = $request->input('datos')['salud_sgsss_beneficiario'];
$beneficiario->parentesco_acudiente = $request->input('datos')['parentesco_acudiente'];
$beneficiario->otro_parentesco_acudiente = $request->input('datos')['otro_parentesco_acudiente'];

if($acudiente_persona != null)
{
$beneficiario->id_persona_acudiente = $acudiente_persona->id;
}
$beneficiario->otro_poblacional = $request->input('datos')['otro_poblacional'];
$beneficiario->clubes_deportivos_id = ($request->input('datos')['clubes_deportivos_id'] == null ? null :(int)$request->input('datos')['clubes_deportivos_id']);
$beneficiario->condicion_discapacidad_otro = (!isset($request->input('datos')['condicion_discapacidad_otro']) || $request->input('datos')['condicion_discapacidad_otro'] == null ? null :$request->input('datos')['condicion_discapacidad_otro']);
$beneficiario->comuna_id = $request->input('datos')['comuna'];
$beneficiario->tenantId = Auth::user()->tenantId;
$beneficiario->cultura_beneficiario = (int)$request->input('datos')['cultura_beneficiario'];
$beneficiario->tipo_afiliacion = (int)$request->input('datos')['tipo_afiliacion'];
$beneficiario->save();




if ($request->input('SelectPoblacional') != null)
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

  if ($request->input('SelectDiscapacidad') != null)
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


	public function ObtenerMisBeneficiarios($id)
	{

    $beneficiario = DB::table('tbl_cm_ficha')
    ->select('tbl_gen_persona.id as persona',
    		 'tbl_gen_persona.nombre_primero as label',
    		 'tbl_cm_ficha.id',
    		 'tbl_gen_persona.nombre_primero',
    		 'tbl_gen_persona.apellido_primero',
    		 'tbl_cm_ficha.fecha_inscripcion',
    		 'tbl_cm_ficha.no_ficha',
    		 'grupos.id as grupo_beneficiario',
    		 'grupos.user_id',
    		 'grupos.codigo_grupo',
    		 'grupos.observaciones',
    		 'grupos.estado',


    DB::raw('SUM(tbl_gen_asistencias.`asistencia`) as asistencia, (- SUM(tbl_gen_asistencias.`asistencia`) + COUNT(tbl_gen_asistencias.`id`)) as inasistencias, COUNT(tbl_gen_asistencias.`id`) as total'))
    ->join('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
    ->leftJoin('tbl_gen_asistencias', 'tbl_cm_ficha.id', '=', 'tbl_gen_asistencias.ficha_id')

	->leftJoin('grupos','grupos.id', '=', 'tbl_cm_ficha.grupo_id')


    ->groupBy('tbl_gen_persona.nombre_primero', 'persona', 'tbl_cm_ficha.id', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_cm_ficha.fecha_inscripcion', 'tbl_cm_ficha.no_ficha', 'grupo_beneficiario', 'user_id', 'codigo_grupo', 'grupos.observaciones')->where('grupos.user_id', '=', Auth::id())->where('tbl_cm_ficha.grupo_id', '=', $id)
    	->get();

			return response()->json(
						$beneficiario
					);

				}


public function ObtenerMisBeneficiariosPrograma($id)
	{

    $beneficiario = DB::table('tbl_pr_ficha')
    ->select('tbl_gen_persona.id as persona',
    		 'tbl_gen_persona.nombre_primero as label',
    		 'tbl_pr_ficha.id',
    		 'tbl_gen_persona.nombre_primero',
    		 'tbl_gen_persona.apellido_primero',
    		 'tbl_gen_persona.documento',
    		 'tbl_pr_ficha.fecha_inscripcion',
    		 'tbl_pr_ficha.no_ficha',
    		 'tbl_pr_grupos.id as grupo_beneficiario',
    		 'tbl_pr_grupos.user_id',
    		 'tbl_pr_grupos.nombre_grupo',
    		 'tbl_pr_grupos.observaciones',
    		 'tbl_pr_grupos.estado',


    DB::raw('SUM(tbl_pr_asistencias.`asistencia`) as asistencia, (- SUM(tbl_pr_asistencias.`asistencia`) + COUNT(tbl_pr_asistencias.`id`)) as inasistencias, COUNT(tbl_pr_asistencias.`id`) as total'))
    ->join('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')
    ->leftJoin('tbl_pr_asistencias', 'tbl_pr_ficha.id', '=', 'tbl_pr_asistencias.ficha_id')

	->leftJoin('tbl_pr_grupos','tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')


    ->groupBy('tbl_gen_persona.nombre_primero', 'persona', 'tbl_pr_ficha.id', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_pr_ficha.fecha_inscripcion', 'tbl_pr_ficha.no_ficha', 'grupo_beneficiario', 'user_id', 'nombre_grupo', 'tbl_pr_grupos.observaciones')->where('tbl_pr_grupos.user_id', '=', Auth::id())->where('tbl_pr_ficha.grupo_id', '=', $id)
    	->get();

			return response()->json(
						$beneficiario
					);

				}



	public function ObtenerMisBeneficiariosConsulta($id)
	{

	$beneficiario = DB::table('tbl_cm_ficha')
	->select('tbl_gen_persona.id as persona',
				'tbl_gen_persona.nombre_primero as label',
				'tbl_cm_ficha.id',
				'tbl_gen_persona.nombre_primero',
				'tbl_gen_persona.apellido_primero',
				'tbl_cm_ficha.fecha_inscripcion',
				'tbl_cm_ficha.no_ficha',
				'grupos.id as grupo_beneficiario',
				'grupos.user_id',
				'grupos.codigo_grupo',
				'grupos.observaciones',
				'grupos.estado',


	DB::raw('SUM(tbl_gen_asistencias.`asistencia`) as asistencia, (- SUM(tbl_gen_asistencias.`asistencia`) + COUNT(tbl_gen_asistencias.`id`)) as inasistencias, COUNT(tbl_gen_asistencias.`id`) as total'))
	->join('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
	->leftJoin('tbl_gen_asistencias', 'tbl_cm_ficha.id', '=', 'tbl_gen_asistencias.ficha_id')

	->leftJoin('grupos','grupos.id', '=', 'tbl_cm_ficha.grupo_id')


	->groupBy('tbl_gen_persona.nombre_primero', 'persona', 'tbl_cm_ficha.id', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_cm_ficha.fecha_inscripcion', 'tbl_cm_ficha.no_ficha', 'grupo_beneficiario', 'user_id', 'codigo_grupo', 'grupos.observaciones')->where('tbl_gen_persona.tenantId', '=', Auth::user()->tenantId)->where('tbl_cm_ficha.grupo_id', '=', $id)
		->get();

			return response()->json(
						$beneficiario
					);

	}


	public function ObtenerMisBeneficiariosAsistencias()
	{

    $beneficiario = DB::table('tbl_cm_ficha')
    ->select(

    		 'tbl_gen_persona.id as persona',
    		 'tbl_gen_persona.documento',
    		 'tbl_gen_persona.nombre_primero as label',
    		 'tbl_cm_ficha.id',
    		 'tbl_gen_persona.nombre_primero',
    		 'tbl_gen_persona.apellido_primero',
    		 'tbl_cm_ficha.fecha_inscripcion',
    		 'tbl_cm_ficha.no_ficha',
    		 'grupos.id as grupo_beneficiario',
    		 'grupos.user_id',
    		 'grupos.codigo_grupo',
    		 'grupos.observaciones',
    		 'grupos.estado',
    		 'grupos.created_at as fecha_creacion_grupo',
    		 'instituciones.nombre_institucion',
    		 'sedes.nombre_sede',
    		 'users.primer_nombre',
    		 'users.primer_apellido',



    DB::raw('SUM(tbl_gen_asistencias.`asistencia`) as asistencia, (- SUM(tbl_gen_asistencias.`asistencia`) + COUNT(tbl_gen_asistencias.`id`)) as inasistencias, COUNT(tbl_gen_asistencias.`id`) as total'))
    ->leftJoin('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
    ->leftJoin('tbl_gen_asistencias', 'tbl_cm_ficha.id', '=', 'tbl_gen_asistencias.ficha_id')
	->join('grupos','grupos.id', '=', 'tbl_cm_ficha.grupo_id')
	->leftJoin('sedes','sedes.id', '=', 'grupos.sede_id')
	->leftJoin('instituciones','instituciones.id', '=', 'sedes.institucion_id')
	->leftJoin('users','users.id', '=', 'grupos.user_id')
    ->groupBy('tbl_gen_persona.nombre_primero', 'persona', 'tbl_cm_ficha.id', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_cm_ficha.fecha_inscripcion', 'tbl_cm_ficha.no_ficha', 'grupo_beneficiario', 'user_id', 'codigo_grupo', 'grupos.observaciones')->where('users.tenantId', '=', Auth::user()->tenantId)->get();

			return response()->json(
						$beneficiario
					);

				}


			public function ObtenerAllGrupos()
			{

				$grupos_monitor = Grupo::select('grupos.id', 'grupos.codigo_grupo')->where('grupos.user_id', '=', Auth::id())->get();
				return response()->json(
					$grupos_monitor->toArray());
			}

			public function EliminarGrupo($id)
			{


				$beneficiarios = FichaComunidad::where('grupo_id', '=', $id)->exists();

				if ($beneficiarios == false) {

				$horario_grupo = HorarioGrupo::where('horario_grupos.grupo_id', '=', $id)->get();

				foreach ($horario_grupo as $value) {

					$value->delete();

				}

				$BeneficiarioGrupo = BeneficiarioGrupo::where('beneficiario_grupos.grupo_id', '=', $id)->get();

				foreach ($BeneficiarioGrupo as $copia) {

					$copia->delete();

				}



				$grupo = Grupo::findOrfail($id);
				$grupo->delete();
				return response()->json(
					$grupo->toArray()
		);
			}

			else
				{
					  $returnData = array(
		              'status' => 'error',
		              'message' => 'An error occurred!'
         			   );
           				 return Response::json($returnData, 500);
				}



			}


			public function EliminarGrupoBeneficiario($id)

			{

			$beneficiario = FichaComunidad::findOrfail($id);
			$beneficiario->grupo_id = null;
			$beneficiario->save();
			return response()->json(
			$beneficiario->toArray()
		);

			}


			public function SacarGrupoBeneficiarioPrograma($id)

			{

			$beneficiario = FichaPrograma::findOrfail($id);
			$beneficiario->grupo_id = null;
			$beneficiario->save();
			return response()->json(
			$beneficiario->toArray()
		);

			}




			public function CrearAsistencias(Request $request)

			{


				$fecha_asistencia_beneficiario = $request->input('fecha_asistencia');
				$date_asistencia_beneficiario = str_replace('/', '-', $fecha_asistencia_beneficiario);
				$result_fecha_asistencia = date('Y-m-d', strtotime($date_asistencia_beneficiario));

				foreach ($request->input('datos') as $value) {

						$asistencia_beneficiario = new Asistencia();
						$asistencia_beneficiario->fecha_asistencia = $result_fecha_asistencia;
						$asistencia_beneficiario->grupo_id = $value['grupo_beneficiario'];
						$asistencia_beneficiario->ficha_id = $value['id'];
						$asistencia_beneficiario->observaciones = $value['observaciones_asistencia'];
						$asistencia_beneficiario->asistencia = $value['assist'];
						$asistencia_beneficiario->save();

						}
						return response()->json(
						$asistencia_beneficiario->toArray()
					);

				}


					public function CrearAsistenciasProgramas(Request $request)

			{


				$fecha_asistencia_beneficiario = $request->input('fecha_asistencia');
				$date_asistencia_beneficiario = str_replace('/', '-', $fecha_asistencia_beneficiario);
				$result_fecha_asistencia = date('Y-m-d', strtotime($date_asistencia_beneficiario));

				foreach ($request->input('datos') as $value) {

						$asistencia_beneficiario = new AsistenciaPrograma();
						$asistencia_beneficiario->fecha_asistencia = $result_fecha_asistencia;
						$asistencia_beneficiario->grupo_id = $value['grupo_beneficiario'];
						$asistencia_beneficiario->ficha_id = $value['id'];

						if($value['observaciones_asistencia'] == null)
						{
						$asistencia_beneficiario->observaciones = null;
						}
						else if($value['observaciones_asistencia'] != null)
						{
						$asistencia_beneficiario->observaciones = $value['observaciones_asistencia'];
						}
						$asistencia_beneficiario->asistencia = $value['assist'];
						$asistencia_beneficiario->save();

						}
						return response()->json(
						$asistencia_beneficiario->toArray()
					);
					return response()->json('GUARDADO');
				}


			public function ObtenerAsistencias(Request $request, $id)
			{

				$fecha_asistencia_beneficiario = $request->input('date');
				$date_asistencia_beneficiario = str_replace('/', '-', $fecha_asistencia_beneficiario);
				$result_fecha_asistencia = date('Y-m-d', strtotime($date_asistencia_beneficiario));

				$asistencia = Asistencia::select('tbl_gen_asistencias.id','tbl_gen_asistencias.ficha_id', 'tbl_gen_asistencias.grupo_id', 'tbl_gen_asistencias.fecha_asistencia', 'tbl_gen_asistencias.observaciones', 'tbl_gen_asistencias.asistencia', 'grupos.codigo_grupo', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero')->join(
					'grupos',
					'grupos.id', '=', 'tbl_gen_asistencias.grupo_id')->join(
					'tbl_cm_ficha',
					'tbl_cm_ficha.id', '=', 'tbl_gen_asistencias.ficha_id')->join(
					'tbl_gen_persona',
					'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->where('tbl_gen_asistencias.fecha_asistencia', '=', $result_fecha_asistencia)->where('tbl_gen_asistencias.grupo_id', '=', $id)->get();

					return response()->json(
						$asistencia->toArray()
					);

			}


			public function ObtenerAsistenciasPrograma(Request $request, $id)

			{

				$fecha_asistencia_beneficiario = $request->input('date');
				$date_asistencia_beneficiario = str_replace('/', '-', $fecha_asistencia_beneficiario);
				$result_fecha_asistencia = date('Y-m-d', strtotime($date_asistencia_beneficiario));

				$asistencia = AsistenciaPrograma::select('tbl_pr_asistencias.id','tbl_pr_asistencias.ficha_id', 'tbl_pr_asistencias.grupo_id', 'tbl_pr_asistencias.fecha_asistencia', 'tbl_pr_asistencias.observaciones', 'tbl_pr_asistencias.asistencia', 'tbl_pr_grupos.nombre_grupo', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero')->leftJoin(
					'tbl_pr_grupos',
					'tbl_pr_grupos.id', '=', 'tbl_pr_asistencias.grupo_id')->leftJoin(
					'tbl_pr_ficha',
					'tbl_pr_ficha.id', '=', 'tbl_pr_asistencias.ficha_id')->leftJoin(
					'tbl_gen_persona',
					'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')->where('tbl_pr_asistencias.fecha_asistencia', '=', $result_fecha_asistencia)->where('tbl_pr_asistencias.grupo_id', '=', $id)->get();

					return response()->json(
						$asistencia->toArray()
					);

			}


			public function UpdateAsistencias(Request $request, $id)

			{


				$fecha_asistencia_beneficiario = $request->input('fecha_asistencia');
				$date_asistencia_beneficiario = str_replace('/', '-', $fecha_asistencia_beneficiario);
				$result_fecha_asistencia = date('Y-m-d', strtotime($date_asistencia_beneficiario));



				foreach ($request->input('datos_update') as $value) {

				$asistencia_beneficiario = Asistencia::find($value['id']);


					$asistencia_beneficiario->fecha_asistencia = $result_fecha_asistencia;
					$asistencia_beneficiario->grupo_id = $id;
					$asistencia_beneficiario->ficha_id = $value['ficha_id'];
					$asistencia_beneficiario->observaciones = $value['observaciones'];
					$asistencia_beneficiario->asistencia = $value['asistencia'];

					$asistencia_beneficiario->save();

				}


				}

			public function UpdateAsistenciasProgramas(Request $request, $id)

			{


				$fecha_asistencia_beneficiario = $request->input('fecha_asistencia');
				$date_asistencia_beneficiario = str_replace('/', '-', $fecha_asistencia_beneficiario);
				$result_fecha_asistencia = date('Y-m-d', strtotime($date_asistencia_beneficiario));



				foreach ($request->input('datos_update') as $value) {

				$asistencia_beneficiario = AsistenciaPrograma::find($value['id']);


					$asistencia_beneficiario->fecha_asistencia = $result_fecha_asistencia;
					$asistencia_beneficiario->grupo_id = $id;
					$asistencia_beneficiario->ficha_id = $value['ficha_id'];
					$asistencia_beneficiario->observaciones = $value['observaciones'];
					$asistencia_beneficiario->asistencia = $value['asistencia'];
					$asistencia_beneficiario->save();

				}


				}

				public function ObtenerNombreGrupo($id)
				{


					$nombre_grupo = Grupo::select('grupos.codigo_grupo', 'tbl_cm_grados.nombre_grado')->join(
					'tbl_cm_grados',
					'tbl_cm_grados.id', '=', 'grupos.grado_id')->where('grupos.id', '=', $id)->firstOrfail();
					return response()->json(
						$nombre_grupo->toArray()
						);

				}


				public function ObtenerNombreGrupoPrograma($id)
				{


					$nombre_grupo = ProgramaGrupo::select('tbl_pr_grupos.nombre_grupo',
						'tbl_pr_lugares.nombre_lugar', 'tbl_pr_disciplinas.nombre_disciplina')
						->join('tbl_pr_lugares','tbl_pr_lugares.id', '=', 'tbl_pr_grupos.lugar_id')
						->join('tbl_pr_disciplinas','tbl_pr_disciplinas.id', '=', 'tbl_pr_grupos.disciplina_id')
						->where('tbl_pr_grupos.id', '=', $id)->firstOrfail();
					return response()->json(
						$nombre_grupo->toArray()
						);

				}

				public function ObtenerMiAsistencia($ficha, $grupo)
				{

					$miasistencia = Asistencia::select(DB::raw(("(CASE WHEN (asistencia = 0) THEN 'FALTO' WHEN (asistencia = 1) THEN 'ASISTIO' ELSE 'F' END) as asistencia, fecha_asistencia, observaciones")))->where('grupo_id', '=', $grupo)->where('ficha_id', '=', $ficha)->get();
					return response()->json(
						$miasistencia->toArray()
						);
				}


				public function ObtenerMiAsistenciaPrograma($ficha, $grupo)
				{

					$miasistencia = AsistenciaPrograma::select(DB::raw(("(CASE WHEN (asistencia = 0) THEN 'FALTO' WHEN (asistencia = 1) THEN 'ASISTIO' ELSE 'F' END) as asistencia, fecha_asistencia, observaciones")))->where('grupo_id', '=', $grupo)->where('ficha_id', '=', $ficha)->get();
					return response()->json(
						$miasistencia->toArray()
						);
				}



				public function HorarioGrupos($id)
				{

					$horarios = HorarioGrupo::select(DB::raw(("(CASE WHEN (horario_grupos.dia = 'lunes') THEN '1' WHEN (horario_grupos.dia = 'martes') THEN '2' WHEN (horario_grupos.dia = 'miercoles') THEN '3' WHEN (horario_grupos.dia = 'jueves') THEN '4' WHEN (horario_grupos.dia = 'viernes') THEN '5' ELSE '6' END) as dia")))->where('horario_grupos.grupo_id', '=', $id)->get();
					return response()->json(
						$horarios->toArray()
						);
				}

				public function ObtenerNombreBeneficiario($id)
				{

					$beneficiario = FichaComunidad::select('tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_gen_persona.documento')->join(
						'tbl_gen_persona',
						'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->where('tbl_cm_ficha.id', '=', $id)->firstOrfail();
					return response()->json(
						$beneficiario->toArray()
						);
				}


				public function ObtenerNombreBeneficiarioPrograma($id)
				{

					$beneficiario = FichaPrograma::select('tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_gen_persona.documento')->join(
						'tbl_gen_persona',
						'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')->where('tbl_pr_ficha.id', '=', $id)->firstOrfail();
					return response()->json(
						$beneficiario->toArray()
						);
				}


				public function InactivarGrupo($id)
				{

					$grupo = Grupo::find($id);
					$grupo->estado = 1;
					$grupo->save();
					return response()->json(
						$grupo->toArray()
						);


				}

				public function ActivarGrupo($id)
				{

					$grupo = Grupo::find($id);
					$grupo->estado = 0;
					$grupo->save();
					return response()->json(
						$grupo->toArray()
						);


				}

				public function EliminarGrupoHorario(Request $request)
				{


					$GrupoHorario = HorarioGrupo::find($request->dato);
					$GrupoHorario->delete();
					return response()->json(
						$GrupoHorario->toArray()
						);
				}

				public function ObtenerEstadoEscolaridades()
				{

					$EstadoEscolaridad = DB::table('tbl_gen_escolaridad_estado')
				    ->select(
				         'id',
				          DB::raw('UPPER(descripcion) as descripcion'))
				          ->orderBy('descripcion', 'asc')
				          ->get();
					return response()->json(
						$EstadoEscolaridad->toArray()
						);
				}
				public function Universidades()
				{
					$universidades = Universidad::orderBy('tbl_dv_instituciones_educativas.nombre', 'asc')->get();
					return response()->json(
						$universidades->toArray()
						);
				}

				public function ObtenerEtnias()
				{
					$EstadoEscolaridad = DB::table('tbl_gen_etnia')
				    ->select(
			         'id',
			          DB::raw('UPPER(descripcion) as descripcion'))
			          ->orderBy('descripcion', 'asc')
			          ->get();
						return response()->json(
						$EstadoEscolaridad->toArray()
						);
				}


				public function ObtenerEtnias2()
				{
					$datos = DB::table('tbl_gen_etnia')
				    ->select(
			         'id',
			          DB::raw('UPPER(descripcion) as descripcion'))
			          ->orderBy('descripcion', 'asc')
			          ->get();
						return ['datos' => $datos];
				}
				public function Afiliaciones()
				{

					$Afiliacion = DB::table('tbl_gen_salud_regimen')
				    ->select(
				         'id',
				          DB::raw('UPPER(descripcion) as descripcion'))
				          ->orderBy('descripcion', 'asc')
				          ->get();
					return response()->json(
						$Afiliacion->toArray()
						);
				}

				public function ReasignarGrupo(Request $request, $grupo)
				{

					$grupocambio = Grupo::find($grupo);
					$grupocambio->user_id = $request->usuario;
					$grupocambio->save();
					return response()->json(
						$grupocambio->toArray()
						);

				}


	}
