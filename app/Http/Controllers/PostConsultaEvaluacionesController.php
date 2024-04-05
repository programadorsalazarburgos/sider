<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Grupo;
use App\HorarioGrupo;
use App\Programa;
use App\Pais;
use App\Departamento;
use App\Municipio;
use App\Barrio;
use App\Beneficiario;
use App\PoblacionalBeneficiario;
use response;
use Hashids\Hashids;
use App\Persona;
use App\FichaComunidad;
use App\Vereda;
use App\TblCmConfig;
use App\Asistencia;
use App\BeneficiarioGrupo;
use App\Criterio;
use App\Evaluacion;
use DB;
use DateTime;
use Carbon\Carbon;


class PostConsultaEvaluacionesController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);

	//	$this->hashids = new Hashids('', 10);
		
	}

	public function vista(){

		return view("postconsultaevaluaciones.appconsultaevaluaciones");
	}

	public function index()
	{

		$grupos = Grupo::select('grupos.id', 'grupos.user_id', 'grupos.codigo_grupo', 'grupos.observaciones', 'grupos.estado', 'sedes.nombre_sede', 'instituciones.nombre_institucion', 'tbl_cm_grados.nombre_grado', 'users.primer_nombre', 'users.primer_apellido')->join(
			'sedes',
			'sedes.id', '=', 'grupos.sede_id')->join(
				'instituciones',
				'instituciones.id', '=', 'sedes.institucion_id')->join(
				'tbl_cm_grados',
				'tbl_cm_grados.id', '=', 'grupos.grado_id')->join(
				'users',
				'users.id', '=', 'grupos.user_id')->where('users.tenantId', '=', Auth::user()->tenantId)->get();
			return response()->json(
				$grupos->toArray()
			);
		}

	public function misbeneficiariosevaluaciones($id)
	{



		    $beneficiario = DB::table('tbl_cm_evaluaciones')
		    ->select(
		    
		    		 'tbl_cm_ficha.id',
		    		 'tbl_gen_persona.nombre_primero',
		    		 'tbl_gen_persona.apellido_primero',
		    		 'tbl_cm_evaluaciones.id as evaluacion',
		    		 'tbl_cm_evaluaciones.valor_evaluacion',
		    		 'tbl_cm_evaluaciones.fecha_evaluacion',
		    		 'tbl_cm_evaluaciones.criterio_id',
		    		 'tbl_cm_evaluaciones.ficha_id',
		    		 'tbl_cm_criterios.nombre_criterio'

		    		)

		   	->leftJoin('grupos','grupos.id', '=', 'tbl_cm_evaluaciones.grupo_id')
		   	->leftJoin('tbl_cm_ficha','tbl_cm_ficha.id', '=', 'tbl_cm_evaluaciones.ficha_id')
			->join('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
			->join('tbl_cm_criterios', 'tbl_cm_criterios.id', '=', 'tbl_cm_evaluaciones.criterio_id')
		      
			->groupBy('evaluacion')
		  
			->where('tbl_cm_ficha.grupo_id', '=', $id)

			->orderBy('tbl_gen_persona.nombre_primero', 'asc', 'tbl_cm_criterios.nombre_criterio', 'asc')
		    
		    ->get();

			return response()->json(
						$beneficiario
					);



	}



	public function PromedioEvaluaciones($id)
	{


	$promedio = DB::table('tbl_cm_evaluaciones')
	    ->select(

	   'tbl_cm_evaluaciones.id',
	   'tbl_cm_evaluaciones.grupo_id',
	   'tbl_cm_evaluaciones.ficha_id',
	   'tbl_cm_criterios.nombre_criterio',
	   'tbl_cm_evaluaciones.fecha_evaluacion',
	   'tbl_cm_evaluaciones.tenantId',
	   'tbl_cm_evaluaciones.created_at',
	   'tbl_cm_evaluaciones.updated_at',
	         

	    DB::raw('COUNT(tbl_cm_evaluaciones.`criterio_id`) as total, SUM(tbl_cm_evaluaciones.`valor_evaluacion`) as sumatoria, avg(valor_evaluacion) as promedio'))
	   
	   	->join('tbl_cm_criterios', 'tbl_cm_criterios.id', '=', 'tbl_cm_evaluaciones.criterio_id')
	

	    ->groupBy('tbl_cm_evaluaciones.criterio_id')->where('tbl_cm_evaluaciones.ficha_id', '=', $id)->get();

		return response()->json(
						$promedio
					);

			}


	public function PromedioEvaluacionesGrafico($id)
	{


	$promedio = DB::table('tbl_cm_evaluaciones')
	    ->select(

	   'tbl_cm_criterios.nombre_criterio as label',
	         

	    DB::raw('avg(valor_evaluacion) as y'))
	   
	   	->join('tbl_cm_criterios', 'tbl_cm_criterios.id', '=', 'tbl_cm_evaluaciones.criterio_id')
	

	    ->groupBy('tbl_cm_evaluaciones.criterio_id')->where('tbl_cm_evaluaciones.ficha_id', '=', $id)->get();

		return response()->json(
						$promedio
					);

			}

	}
