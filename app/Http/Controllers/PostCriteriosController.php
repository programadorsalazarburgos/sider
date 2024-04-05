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


class PostCriteriosController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);

	//	$this->hashids = new Hashids('', 10);
		
	}

	public function vista(){

		return view("postcriterios.appcriterios");
	}

	public function index()
	{

		$grupos = Grupo::select('grupos.id', 'grupos.user_id', 'grupos.codigo_grupo', 'grupos.observaciones', 'grupos.estado', 'sedes.nombre_sede', 'instituciones.nombre_institucion', 'tbl_cm_grados.nombre_grado')->join(
			'sedes',
			'sedes.id', '=', 'grupos.sede_id')->join(
				'instituciones',
				'instituciones.id', '=', 'sedes.institucion_id')->join(
				'tbl_cm_grados',
				'tbl_cm_grados.id', '=', 'grupos.grado_id')->where('grupos.user_id', '=', Auth::id())->get();
			return response()->json(
				$grupos->toArray()
			);
		}

	public function CriteriosGrupo($id)
	{


	    $criterios = Criterio::where('tbl_cm_criterios.grupo_id', '=', $id)->get();
		return response()->json(
			$criterios->toArray()
		);



	}

	public function CrearCriterio(Request $request, $valor)

{


	  $rol = new Criterio();
	  $rol->nombre_criterio = $request->nombre;
	  $rol->grupo_id = $valor;
	  $rol->tenantId = Auth::user()->tenantId;
	  $rol->save();
	  return response()->json($rol);
	  

}



	public function ObtenerCriterioGrupo($id)
	{

	  $Criterio = Criterio::find($id);
	  return response()->json(
	    $Criterio->toArray()
	  );


	}


	public function ActualizarCriterio(Request $request, $id)
	{


	  $criterio = Criterio::find($id);
	  $criterio->nombre_criterio = $request->nombre;
	  $criterio->tenantId = Auth::user()->tenantId;
	  $criterio->save();
	  return response()->json(
	    $criterio->toArray()
	  );


	}

	public function EliminarCriterio($id)
	{


	  $criterio = Criterio::find($id);
	  $criterio->delete();
	  return response()->json(
	    $criterio->toArray()
	  );


	}

	public function CrearEvaluaciones(Request $request, $id)
	{

		  $dt1 = new \DateTime($request->fecha_evaluacion); 
          $carbon_date = Carbon::instance($dt1);
          $date = $carbon_date->format('Y-m-d');


		foreach ($request->datos as $value) {

		   foreach ($value as $clave) {
			
			  $rol = new Evaluacion();
			  $rol->grupo_id = $id;
			  $rol->ficha_id = $clave["beneficiario_id"];
			  $rol->criterio_id = $clave["criterio_id"];
			  $rol->valor_evaluacion = $clave["valor"];
			  $rol->fecha_evaluacion = $date;
			  $rol->tenantId = Auth::user()->tenantId;
			  $rol->save();
			 		   	
		   		}
			
			}

			  return response()->json($rol);
		}

					public function ObtenerEvaluaciones(Request $request, $id)
			{


				  $dt1 = new \DateTime($request->date); 
		          $carbon_date = Carbon::instance($dt1);
		          $fecha = $carbon_date->format('Y-m-d');



				$Evaluacion = Evaluacion::select('tbl_cm_evaluaciones.id', 'tbl_cm_criterios.id as clavecriterio', 'tbl_cm_evaluaciones.grupo_id', 'tbl_cm_evaluaciones.ficha_id', 'tbl_cm_evaluaciones.criterio_id', 'tbl_cm_evaluaciones.valor_evaluacion', 'tbl_cm_evaluaciones.fecha_evaluacion')->where('tbl_cm_evaluaciones.fecha_evaluacion', '=', $fecha)->where('tbl_cm_evaluaciones.grupo_id', '=', $id)->join('tbl_cm_criterios',
					'tbl_cm_criterios.id', '=', 'tbl_cm_evaluaciones.criterio_id')->get();

					return response()->json(
						$Evaluacion->toArray()
					);	

			}


					public function ActualizarEvaluaciones(Request $request, $id)
			{

					  $dt1 = new \DateTime($request->fecha_evaluacion); 
			          $carbon_date = Carbon::instance($dt1);
			          $date = $carbon_date->format('Y-m-d');


					foreach ($request->input('datos_ev') as $value) {


						  foreach ($value as $clave) {
		
							$evaluacion = null;					
						
						if (isset($clave['evaluacion_id'])) {

							$evaluacion = Evaluacion::find($clave['evaluacion_id']);



						}	
						else {
							$evaluacion = new Evaluacion();

						}

						    $evaluacion->grupo_id = $id;
						    $evaluacion->ficha_id = $clave["beneficiario_id"];
						    $evaluacion->criterio_id = $clave["criterio_id"];
						    $evaluacion->valor_evaluacion = $clave["valor"];
						    $evaluacion->fecha_evaluacion = $date;
						    $evaluacion->tenantId = Auth::user()->tenantId;
						    $evaluacion->save();


						}

					

				
					}






			}


	}
