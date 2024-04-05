<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\ProgramaGrupo;
use App\ProgramaHorario;
use App\ProgramaDisciplina;
use App\Lugar;
use App\Programa;
use App\Pais;
use App\Departamento;
use App\Municipio;
use App\Barrio;
use App\Beneficiario;
use App\PoblacionalBeneficiario;
use Response;
use Hashids\Hashids;
use App\Persona;
use App\FichaComunidad;
use App\Vereda;
use App\TblCmConfig;
use App\Asistencia;
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
use App\Disciplinas;
use App\Adicional;
use App\FichaPrograma;
use DB;
use DateTime;

class PostGruposProgramasController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);

	//	$this->hashids = new Hashids('', 10);

	}

	public function vista(){

		return view("postgruposprogramas.appgruposprogramas");
	}

	public function index()
	{

		$grupos = ProgramaGrupo::select('tbl_pr_grupos.id', 'tbl_pr_grupos.user_id', 'tbl_pr_grupos.nombre_grupo', 'tbl_pr_grupos.observaciones', 'tbl_pr_grupos.estado', 'tbl_pr_lugares.nombre_lugar', 'tbl_pr_disciplinas.nombre_disciplina')
		->join(
			'tbl_pr_lugares',
			'tbl_pr_lugares.id', '=', 'tbl_pr_grupos.lugar_id')
		->join(
			'tbl_pr_disciplinas',
			'tbl_pr_disciplinas.id', '=', 'tbl_pr_grupos.disciplina_id')
		->where('tbl_pr_grupos.estado', '=', 0)
		->where('tbl_pr_grupos.user_id', '=', Auth::id())
		->where('tbl_pr_grupos.tenantId', '=', Auth::user()->tenantId)
		->get();
		return response()->json(
			$grupos->toArray()
		);
	}



	public function ObtenerLugares()
	{

	$lugar = DB::table('tbl_pr_lugares')
    ->select(
         'id',
          DB::raw('UPPER(nombre_lugar) as nombre_lugar'))
          ->orderBy('nombre_lugar', 'asc')
          ->where('tbl_pr_lugares.tenantId', '=', Auth::user()->tenantId)
          ->where('tbl_pr_lugares.estado', '=', 0)
          ->get();

		return response()->json(
			$lugar->toArray()
		);

	}

	public function ObtenerDisciplinas()
	{


	$ProgramaDisciplina = DB::table('tbl_pr_disciplinas')
	->select(
     'id',
      DB::raw('UPPER(nombre_disciplina) as nombre_disciplina'))
      ->orderBy('nombre_disciplina', 'asc')
      ->where('tbl_pr_disciplinas.tenantId', '=', Auth::user()->tenantId)
      ->get();
		return response()->json(
			$ProgramaDisciplina->toArray()
		);

	}

	public function ConsultaGrupos()
	{


		$grupos = DB::table('tbl_pr_grupos')
		->leftjoin(
			'tbl_pr_horario_grupos',
			'tbl_pr_grupos.id', '=', 'tbl_pr_horario_grupos.grupo_id')
		->leftjoin(
			'tbl_pr_lugares',
			'tbl_pr_lugares.id', '=', 'tbl_pr_grupos.lugar_id')
		->leftjoin(
			'tbl_pr_disciplinas',
			'tbl_pr_disciplinas.id', '=', 'tbl_pr_grupos.disciplina_id')
		->leftjoin(
			'users',
			'users.id', '=', 'tbl_pr_grupos.user_id')

		->select(DB::raw(
			"tbl_pr_grupos.nombre_grupo,
			tbl_pr_grupos.id,
			tbl_pr_grupos.user_id,
			tbl_pr_grupos.observaciones,
			tbl_pr_grupos.estado,
			tbl_pr_lugares.nombre_lugar,
			tbl_pr_lugares.direccion as direccion_lugar,
			tbl_pr_disciplinas.nombre_disciplina,
			users.primer_nombre,
			users.primer_apellido,
			(GROUP_CONCAT(tbl_pr_horario_grupos.dia SEPARATOR '-')) as `dias`,
			(GROUP_CONCAT(CONCAT(dia, '-', tbl_pr_horario_grupos.hora_inicio))) as `horario_inicial`,
			(GROUP_CONCAT(CONCAT(dia, ':', DATE_FORMAT(tbl_pr_horario_grupos.hora_inicio,  '%l.%i%p'))SEPARATOR '-')) as `horario_inicial`,
			(GROUP_CONCAT(CONCAT(dia, ':', DATE_FORMAT(tbl_pr_horario_grupos.hora_fin,  '%l.%i%p'))SEPARATOR '-')) as `horario_final`


			"))->where('tbl_pr_grupos.tenantId', '=', Auth::user()->tenantId)
				->where('tbl_pr_grupos.estado', 0)
		->orderBy('tbl_pr_grupos.nombre_grupo', 'asc')->groupBy('tbl_pr_grupos.id')->get();

		return response()->json(
			$grupos->toArray()
		);

	}

	 public function ConsultaGruposUsuario($usuario)
  {

    $tbl_pr_grupos = ProgramaGrupo::select('tbl_pr_grupos.id', 'tbl_pr_grupos.user_id', 'tbl_pr_grupos.nombre_grupo', 'tbl_pr_grupos.observaciones', 'tbl_pr_grupos.estado', 'tbl_pr_lugares.nombre_lugar', 'tbl_pr_disciplinas.nombre_disciplina', 'users.primer_nombre', 'users.primer_apellido')
      ->join(
      'tbl_pr_lugares',
      'tbl_pr_lugares.id', '=', 'tbl_pr_grupos.lugar_id')
      ->join(
        'tbl_pr_disciplinas',
        'tbl_pr_disciplinas.id', '=', 'tbl_pr_grupos.disciplina_id')
      ->join(
        'users',
        'users.id', '=', 'tbl_pr_grupos.user_id')->where('tbl_pr_grupos.user_id', '=', $usuario)
      ->where('users.tenantId', '=', Auth::user()->tenantId)->get();

      return response()->json(
        $tbl_pr_grupos->toArray()
      );
    }


	public function CrearGrupo(Request $request){

		$errormsg = "";
		$result = false;

		try{

			$grupo = new ProgramaGrupo();
			$grupo->nombre_grupo = $request->input('nombre_grupo');;
			$grupo->tenantId = Auth::user()->tenantId;
			$grupo->lugar_id = $request->input('lugar');
			$grupo->disciplina_id = $request->input('disciplina');
			$grupo->user_id = Auth::id();
			$grupo->observaciones = $request->input('observaciones');
			$grupo->save();

			foreach ($request->input('dias_horario') as $value) {

				$inicio = explode(' ', $value['inicio']);
				$fin = explode(' ', $value['fin']);

				$horario_grupo = new ProgramaHorario();
				$horario_grupo->grupo_id	= $grupo->id;
				$horario_grupo->dia			= $value['id'];
				$horario_grupo->hora_inicio	= $inicio[4];
				$horario_grupo->hora_fin	= $fin[4];
				$horario_grupo->save();
			}


		}catch(Exception $exception)
		{
			$errormsg = 'Database error! ' . $exception->getCode();
		}
		return Response::json(['success'=>$result,'errormsg'=>$errormsg]);




	}


	public function ObtenerGrupoMonitorPrograma(){

	$grupo = DB::table('tbl_pr_grupos')
    ->select(
         'id',
          DB::raw('UPPER(nombre_grupo) as nombre_grupo'))
          ->orderBy('nombre_grupo', 'asc')
          ->where('tbl_pr_grupos.tenantId', '=', Auth::user()->tenantId)
          ->get();

		return response()->json(
			$grupo->toArray()
		);
	}


	public function ObtenerGrupoPrograma($id){


		$grupo = ProgramaGrupo::where('tbl_pr_grupos.id', '=', $id)->firstOrfail();
		return response()->json(
			$grupo->toArray()
		);
	}



	public function GrupoHorarioPrograma($id){

		$horario = ProgramaHorario::select('tbl_pr_horario_grupos.id', 'tbl_pr_horario_grupos.dia', 'tbl_pr_horario_grupos.hora_inicio','tbl_pr_horario_grupos.hora_fin')->join(
			'tbl_pr_grupos',
			'tbl_pr_grupos.id', '=', 'tbl_pr_horario_grupos.grupo_id')->where('tbl_pr_horario_grupos.grupo_id', '=', $id)->get();
		return response()->json(
			$horario->toArray()
		);

	}


	public function ActualizarGrupoPrograma(Request $request, $id)
	{


		$errormsg = "";
		$result = false;

		try{

			$grupo = ProgramaGrupo::findOrfail($id);
			$grupo->nombre_grupo = $request->input('nombre_grupo');;
			$grupo->tenantId = Auth::user()->tenantId;
			$grupo->lugar_id = $request->input('lugar');
			$grupo->disciplina_id = $request->input('disciplina');
			$grupo->user_id = Auth::id();
			$grupo->observaciones = $request->input('observaciones');
			$grupo->save();


			foreach ($request->input('dias_horario') as $value) {



				$inicio = explode(' ', $value['inicio']);
				$fin = explode(' ', $value['fin']);

				$horario_grupo = null;

				if (isset($value['_id'])) {

					$horario_grupo =ProgramaHorario::find($value['_id']);

				}	else {

					$horario_grupo = new ProgramaHorario();

				}

				$horario_grupo->grupo_id	= $request->id;
				$horario_grupo->dia			= $value['id'];
				$horario_grupo->hora_inicio	= $inicio[4];
				$horario_grupo->hora_fin	= $fin[4];
				$horario_grupo->save();

			}

		}catch(Exception $exception)
		{
			$errormsg = 'Database error! ' . $exception->getCode();
		}
		return Response::json(['success'=>$result,'errormsg'=>$errormsg]);


	}


	public function ObtenerMisBeneficiariosConsulta($id)
	{

		$beneficiario = DB::table('tbl_pr_ficha')
		->select('tbl_gen_persona.id as persona',
			'tbl_gen_persona.nombre_primero as label',
			'tbl_pr_ficha.id',
			'tbl_gen_persona.nombre_primero',
			'tbl_gen_persona.apellido_primero',
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


		->groupBy('tbl_gen_persona.nombre_primero', 'persona', 'tbl_pr_ficha.id', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_pr_ficha.fecha_inscripcion', 'tbl_pr_ficha.no_ficha', 'grupo_beneficiario', 'user_id', 'nombre_grupo', 'tbl_pr_grupos.observaciones')
		->where('tbl_pr_ficha.grupo_id', '=', $id)
		->get();

		return response()->json(
			$beneficiario
		);

	}


	public function ObtenerMisBeneficiariosAsistenciasProgramas()
	{

		$beneficiario = DB::table('tbl_pr_ficha')
		->select(

			'tbl_gen_persona.id as persona',
			'tbl_gen_persona.documento',
			'tbl_gen_persona.nombre_primero as label',
			'tbl_pr_ficha.id',
			'tbl_gen_persona.nombre_primero',
			'tbl_gen_persona.apellido_primero',
			'tbl_pr_ficha.fecha_inscripcion',
			'tbl_pr_ficha.no_ficha',
			'tbl_pr_grupos.id as grupo_beneficiario',
			'tbl_pr_grupos.user_id',
			'tbl_pr_grupos.nombre_grupo',
			'tbl_pr_grupos.observaciones',
			'tbl_pr_grupos.estado',
			'tbl_pr_grupos.created_at as fecha_creacion_grupo',
			'tbl_pr_lugares.nombre_lugar',
			'tbl_pr_disciplinas.nombre_disciplina',
			'users.primer_nombre',
			'users.primer_apellido',



			DB::raw('SUM(tbl_pr_asistencias.`asistencia`) as asistencia, (- SUM(tbl_pr_asistencias.`asistencia`) + COUNT(tbl_pr_asistencias.`id`)) as inasistencias, COUNT(tbl_pr_asistencias.`id`) as total'))
		->leftJoin('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')
		->leftJoin('tbl_pr_asistencias', 'tbl_pr_ficha.id', '=', 'tbl_pr_asistencias.ficha_id')
		->join('tbl_pr_grupos','tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
		->leftJoin('tbl_pr_lugares','tbl_pr_lugares.id', '=', 'tbl_pr_grupos.lugar_id')
		->leftJoin('tbl_pr_disciplinas','tbl_pr_disciplinas.id', '=', 'tbl_pr_grupos.disciplina_id')
		->leftJoin('users','users.id', '=', 'tbl_pr_grupos.user_id')
		->groupBy('tbl_gen_persona.nombre_primero', 'persona', 'tbl_pr_ficha.id', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_pr_ficha.fecha_inscripcion', 'tbl_pr_ficha.no_ficha', 'grupo_beneficiario', 'user_id', 'nombre_grupo', 'tbl_pr_grupos.observaciones')->where('users.tenantId', '=', Auth::user()->tenantId)->get();

		return response()->json(
			$beneficiario
		);

	}




	public function ObtenerNombreGrupo($id)
	{


		$nombre_grupo = ProgramaGrupo::select('tbl_pr_grupos.nombre_grupo', 'tbl_pr_lugares.nombre_lugar', 'tbl_pr_disciplinas.nombre_disciplina')
		->join('tbl_pr_lugares', 'tbl_pr_lugares.id', '=', 'tbl_pr_grupos.lugar_id')
		->join('tbl_pr_disciplinas', 'tbl_pr_disciplinas.id', '=', 'tbl_pr_grupos.disciplina_id')
		->where('tbl_pr_grupos.id', '=', $id)->firstOrfail();
		return response()->json(
			$nombre_grupo->toArray()
		);


	}



	public function InactivarGrupoPrograma($id)
	{

		$grupo = ProgramaGrupo::find($id);
		$grupo->estado = 1;
		$grupo->save();
		return response()->json(
			$grupo->toArray()
		);


	}

	public function ActivarGrupoPrograma($id)
	{

		$grupo = ProgramaGrupo::find($id);
		$grupo->estado = 0;
		$grupo->save();
		return response()->json(
			$grupo->toArray()
		);

	}

	public function EliminaHorarioPrograma(Request $request)
	{


		$GrupoHorario = ProgramaHorario::find($request->dato);
		$GrupoHorario->delete();
		return response()->json(
			$GrupoHorario->toArray()
		);
	}

	public function ReasignarGrupo(Request $request, $grupo)
		{

			$grupocambio = ProgramaGrupo::where('tbl_pr_grupos.id', '=', $grupo)->firstOrfail();
			$grupocambio->user_id = (int)$request->usuario;
			$grupocambio->estado = 0;
			$grupocambio->save();
			return response()->json(
				$grupocambio->toArray()
				);

		}

	public function obtenerdisciplinas_deportivas()
	{
		$disciplinas = Disciplinas::orderBy('descripcion')->get();
		return response()->json($disciplinas->toArray());

	}

	public function crear_adicional(Request $request, $id)
	{


		$errormsg = "";
		$result = false;

		try{

			$adicional = new Adicional();
			$adicional->ficha_id = $id;
			$adicional->codigo = $request->no_tajeta;
			$adicional->disciplina_id = $request->disciplina;
			$adicional->pertenece_a = $request->seleccion;
			$adicional->nombre_club = $request->club;
			$adicional->save();



		}catch(Exception $exception)
		{
			$errormsg = 'Database error! ' . $exception->getCode();
		}
		return Response::json(['success'=>$result,'errormsg'=>$errormsg]);


	}


	public function editar_adicional(Request $request, $id)
	{


		$errormsg = "";
		$result = false;

		try{

			$adicional = Adicional::where('ficha_id', '=', $id)->firstOrfail();
			$adicional->ficha_id = $id;
			$adicional->codigo = $request->no_tajeta;
			$adicional->disciplina_id = $request->disciplina;
			$adicional->pertenece_a = $request->seleccion;
			$adicional->nombre_club = $request->club;
			$adicional->save();



		}catch(Exception $exception)
		{
			$errormsg = 'Database error! ' . $exception->getCode();
		}
		return Response::json(['success'=>$result,'errormsg'=>$errormsg]);


	}

	public function obtener_adicional($id)
	{


	 $errormsg = "";
	 $adicional = null;

    try{
        $adicional= Adicional::where('ficha_id', '=', $id)->firstOrfail();
    }catch(ModelNotFoundException $e){
        $errormsg = 'Database error! ' . $e->getCode();
    }

	return Response::json(['adicional'=>$adicional,'errormsg'=>$errormsg]);


	}

		public function EliminarGrupoPrograma($id)
			{


				$beneficiarios = FichaPrograma::where('grupo_id', '=', $id)->exists();

				if ($beneficiarios == false) {

				$horario_grupo = ProgramaHorario::where('tbl_pr_horario_grupos.grupo_id', '=', $id)->get();

				foreach ($horario_grupo as $value) {

					$value->delete();

				}


				$grupo = ProgramaGrupo::findOrfail($id);
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


}
