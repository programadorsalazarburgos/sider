<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Comuna;
use App\Zona;
use response;

class PostComunasController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postcomunas.appcomunas");
	}

	public function index()
	{

		$comunas = Comuna::all();
		return response()->json(
			$comunas->toArray()
		);

	}

	public function ObtenerZonas()
	{

		$zonas = Zona::all();
		return response()->json(
			$zonas->toArray()
		);

	}


	public function ObtenerZonaID($id){

		$zonas = Comuna::select('zonas.id','zonas.nombre_zona')->join('zonas',
			'zonas.id','=', 'comunas.zona_id')->where('comunas.id','=', $id)->firstOrfail();
		return response()->json(
			$zonas->toArray()
		);

	}



public function CrearComuna(Request $request){


        $comuna = new Comuna();
        $comuna->codigo_comuna = $request->input('codigo_comuna');
        $comuna->nombre_comuna = $request->input('nombre_comuna');
        $comuna->zona_id = $request->input('zona');
	    $comuna->save();
         return response()->json(
                  $comuna->toArray()
              );

}



	public function ObtenerComuna($id){


		$comuna = Comuna::where('comunas.id', '=', $id)->firstOrfail();

		return response()->json(
			$comuna->toArray()
		);
	}



public function EditarComuna(Request $request, $id){


  $comuna = Comuna::findOrfail($id);
  $comuna->codigo_comuna = $request->input('codigo_comuna');
  $comuna->nombre_comuna = $request->input('nombre_comuna');
  $comuna->zona_id = $request->input('zona');
  $comuna->save();
      return response()->json(
                $comuna->toArray()
            );
}

	

	public function EliminarComuna($id){

		$comuna = Comuna::findOrfail($id);
		$comuna->delete();
		    return response()->json(
		                $comuna->toArray()
		            );


	}

}
