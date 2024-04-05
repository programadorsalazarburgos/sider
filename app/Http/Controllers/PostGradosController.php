<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Grado;
use response;

class PostGradosController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postgrados.appgrados");
	}

	public function index()
	{

		$grados = Grado::all();
		return response()->json(
			$grados->toArray()
		);

	}


public function CrearGrado(Request $request){


        $grado = new Grado();
        $grado->nombre_grado = $request->input('nombre_grado');
	    $grado->save();
         return response()->json(
                  $grado->toArray()
              );

}



	public function ObtenerGrado($id){


		$grado = Grado::where('tbl_cm_grados.id', '=', $id)->firstOrfail();

		return response()->json(
			$grado->toArray()
		);
	}




	public function ObtenerGrados(){


		$grados = Grado::all();

		return response()->json(
			$grados->toArray()
		);
	}


public function EditarGrado(Request $request, $id){


  $grado = Grado::findOrfail($id);

  $grado->nombre_grado = $request->input('nombre_grado');
  $grado->save();
      return response()->json(
                $grado->toArray()
            );
}

	

	public function EliminarGrado($id){

		$grado = Grado::findOrfail($id);
		$grado->delete();
		    return response()->json(
		                $grado->toArray()
		            );


	}

}
