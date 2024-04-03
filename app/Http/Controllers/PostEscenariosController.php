<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Escenario;
use App\TipoEscenario;
use App\Sede;
use response;

class PostEscenariosController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postescenarios.appescenarios");
	}

	public function index()
	{

		$escenarios = Escenario::select('escenarios.id', 'escenarios.nombre_escenario', 'escenarios.descripcion', 'tipoescenarios.nombre_tipo_escenario', 'sedes.nombre_sede', 'instituciones.nombre_institucion')->join('tipoescenarios',
			'tipoescenarios.id', '=', 'escenarios.tipoescenario_id')->join(
				'sedes',
				'sedes.id', '=', 'escenarios.sede_id')->join(
					'instituciones',
					'instituciones.id', '=', 'sedes.institucion_id')->get();
				return response()->json(
					$escenarios->toArray()
				);


			}


			public function ObtenerTipoEscenarios()
			{

				$tipoescenarios = TipoEscenario::all();
				return response()->json(
					$tipoescenarios->toArray()
				);

			}


			public function ObtenerTipoEscenarioID($id){

				$tipoescenarios = Escenario::select('tipoescenarios.id','tipoescenarios.nombre_tipo_escenario')->join('tipoescenarios',
					'tipoescenarios.id','=', 'escenarios.tipoescenario_id')->where('escenarios.id','=', $id)->firstOrfail();
				return response()->json(
					$tipoescenarios->toArray()
				);

			}


			public function ObtenerSedes()
			{

				$sedes = Sede::select('sedes.id', 'sedes.nombre_sede', 'instituciones.nombre_institucion')->join('instituciones',
					'instituciones.id', '=', 'sedes.institucion_id'
				)->get();
				return response()->json(
					$sedes->toArray()
				);

			}


	public function ObtenerSedes2()
			{

				$datos = Sede::select('sedes.id', 'sedes.nombre_sede as name', 'instituciones.nombre_institucion')->join('instituciones',
					'instituciones.id', '=', 'sedes.institucion_id'
				)->get();
				return ['datos' => $datos];

			}







			public function CrearEscenario(Request $request){


				$escenario = new Escenario();
				$escenario->tipoescenario_id = $request->input('tipoescenario');
				$escenario->nombre_escenario = $request->input('nombre_escenario');
				$escenario->sede_id = $request->input('sede');
				$escenario->descripcion = $request->input('descripcion');
				$escenario->save();
				return response()->json(
					$escenario->toArray()
				);

			}

			public function ObtenerEscenario($id){


				$escenario = Escenario::where('escenarios.id', '=', $id)->firstOrfail();
				return response()->json(
					$escenario->toArray()
				);
			}



			public function ObtenerSedeID($id){

				$sedes = Escenario::select('sedes.id', 'sedes.nombre_sede', 'instituciones.nombre_institucion')->join(
					'sedes',
					'sedes.id', '=', 'escenarios.sede_id')->join('instituciones',
					'instituciones.id', '=', 'sedes.institucion_id')->where('escenarios.id', '=', $id)->firstOrfail();
					return response()->json(
						$sedes->toArray()
					);

				}



				public function EditarEscenario(Request $request, $id){









					if ($request->input('sede') == 0) {

						$escenario = Escenario::findOrfail($id);
						$escenario->tipoescenario_id = $request->input('tipoescenario');
						$escenario->nombre_escenario = $request->input('nombre_escenario');
						$escenario->descripcion = $request->input('descripcion');
						$escenario->save();
						return response()->json(
							$escenario->toArray()
						);

					}
					else {

						$escenario = Escenario::findOrfail($id);
					   	$escenario->tipoescenario_id = $request->input('tipoescenario');
						$escenario->nombre_escenario = $request->input('nombre_escenario');
						$escenario->sede_id = $request->input('sede');
						$escenario->descripcion = $request->input('descripcion');
						$escenario->save();
						return response()->json(
							$escenario->toArray()
						);

					}

				}


				public function EliminarEscenario($id){

					$institucion = Institucion::findOrfail($id);
					$institucion->delete();
					return response()->json(
						$institucion->toArray()
					);


				}

			}
