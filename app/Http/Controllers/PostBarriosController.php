<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Barrio;
use App\Comuna;
use response;
use DB;

class PostBarriosController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postbarrios.appbarrios");
	}

	public function index()
	{

		$barrios = Barrio::orderBy('nombre_barrio', 'asc')->get();
		return response()->json(
			$barrios->toArray()
		);

	}

	public function ObtenerComunas()
	{

		$comunas = DB::table('comunas')
		    ->select(
		         'id',
		          DB::raw('UPPER(nombre_comuna) as nombre_comuna'))
		          ->orderBy('nombre_comuna', 'asc')
		          ->get();
		return response()->json(
			$comunas->toArray()
		);

	}

	public function ObtenerComunas2()
	{

		$datos = DB::table('comunas')
		    ->select(
		         'id',
		          DB::raw('UPPER(nombre_comuna) as name'))
		          ->orderBy('name', 'asc')
		          ->get();
		return ['datos' => $datos];

	}


	public function ObtenerComunaID($id){

		$comunas = Barrio::select('comunas.id','comunas.nombre_comuna')->join('comunas',
			'comunas.id','=', 'barrios.comuna_id')->where('barrios.id','=', $id)->firstOrfail();
		return response()->json(
			$comunas->toArray()
		);

	}



public function CrearBarrio(Request $request){


        $barrio = new Barrio();
        $barrio->codigo = $request->input('codigo_barrio');
        $barrio->nombre_barrio = $request->input('nombre_barrio');
        $barrio->comuna_id = $request->input('comuna');
        $barrio->id_estrato = $request->input('estrato');
	    $barrio->save();
         return response()->json(
                  $barrio->toArray()
              );

}



	public function ObtenerBarrio($id){


		$barrio = Barrio::where('barrios.id', '=', $id)->firstOrfail();

		return response()->json(
			$barrio->toArray()
		);
	}



public function EditarBarrio(Request $request, $id){


  $barrio = Barrio::findOrfail($id);
  $barrio->codigo = $request->input('codigo_barrio');
  $barrio->nombre_barrio = $request->input('nombre_barrio');
  $barrio->comuna_id = $request->input('comuna');
  $barrio->id_estrato = $request->input('estrato');
  $barrio->save();
      return response()->json(
                $barrio->toArray()
            );
}




	public function EliminarBarrio($id){

		$barrio = Barrio::findOrfail($id);
		$barrio->delete();
		    return response()->json(
		                $barrio->toArray()
		            );


	}

}
