<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Modalidad;
use response;

class PostModalidadController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postmodalidades.appmodalidades");
	}

	public function index()
	{

		$modalidades = Modalidad::all();
		return response()->json(
			$modalidades->toArray()
		);

	}


public function CrearModalidad(Request $request){


        $modalidad = new Modalidad();
        $modalidad->nombre = $request->input('nombre');
	    $modalidad->save();
         return response()->json(
                  $modalidad->toArray()
              );

}



	public function ObtenerModalidad($id){


		$modalidad = Modalidad::where('tbl_cm_modalidades.id', '=', $id)->firstOrfail();

		return response()->json(
			$modalidad->toArray()
		);
	}


	public function EditarModalidad(Request $request, $id){


	  $modalidad = Modalidad::findOrfail($id);
	  $modalidad->nombre = $request->input('nombre');
	  $modalidad->save();
	      return response()->json(
	                $modalidad->toArray()
	            );
	}

	

	public function EliminarModalidad($id){

		$modalidad = Modalidad::findOrfail($id);
		$modalidad->delete();
		    return response()->json(
		                $modalidad->toArray()
		            );


	}

}
