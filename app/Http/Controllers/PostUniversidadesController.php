<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Universidad;
use response;

class PostUniversidadesController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postuniversidades.appuniversidades");
	}

	public function index()
	{

		$Universidad = Universidad::orderBy('nombre', 'asc')->get();
		return response()->json(
			$Universidad->toArray()
		);

	}


    public function CrearUniversidad(Request $request){


        $Universidad = new Universidad();
        $Universidad->nombre = $request->input('nombre');
	    $Universidad->save();
         return response()->json(
                  $Universidad->toArray()
              );

}



	public function ObtenerUniversidad($id){


		$Universidad = Universidad::where('id', '=', $id)->firstOrfail();

		return response()->json(
			$Universidad->toArray()
		);
	}


    public function EditarUniversidad(Request $request, $id){

        $Universidad = Universidad::findOrfail($id);
        $Universidad->nombre = $request->input('nombre');
        $Universidad->save();
            return response()->json(
                        $Universidad->toArray()
                    );
    }

	public function EliminarUniversidad($id){

		$Universidad = Universidad::findOrfail($id);
		$Universidad->delete();
		    return response()->json(
		                $Universidad->toArray()
		            );


	}
}
