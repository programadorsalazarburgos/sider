<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Eps;
use response;

class PostEpsController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("posteps.appeps");
	}

	public function index()
	{

		$Eps = Eps::all();
		return response()->json(
			$Eps->toArray()
		);

	}



public function CrearEps(Request $request){


        $eps = new Eps();
        $eps->descripcion = $request->input('descripcion');
	    $eps->save();
         return response()->json(
                  $eps->toArray()
              );

}



	public function ObtenerEps($id){


		$Eps = Eps::where('id', '=', $id)->firstOrfail();

		return response()->json(
			$Eps->toArray()
		);
	}


public function EditarEps(Request $request, $id){


  $Eps = Eps::findOrfail($id);

  $Eps->descripcion = $request->input('descripcion');
  $Eps->save();
      return response()->json(
                $Eps->toArray()
            );
}

	

	public function EliminarEps($id){

		$Eps = Eps::findOrfail($id);
		$Eps->delete();
		    return response()->json(
		                $Eps->toArray()
		            );


	}

}
