<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Implemento;
use response;

class PostImplementosController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postimplementos.appimplementos");
	}

	public function index()
	{

		$Implemento = Implemento::all();
		return response()->json(
			$Implemento->toArray()
		);

	}



public function CrearImplemento(Request $request){


        $Implemento = new Implemento();
        $Implemento->nombre_implemento = $request->input('nombre_implemento');
	    $Implemento->save();
         return response()->json(
                  $Implemento->toArray()
              );

}



	public function ObtenerImplemento($id){


		$Implemento = Implemento::where('id', '=', $id)->firstOrfail();

		return response()->json(
			$Implemento->toArray()
		);
	}


public function EditarImplemento(Request $request, $id){


  $Implemento = Implemento::findOrfail($id);

  $Implemento->nombre_implemento = $request->input('nombre_implemento');
  $Implemento->save();
      return response()->json(
                $Implemento->toArray()
            );
}

	

	public function EliminarImplemento($id){

		$Implemento = Implemento::findOrfail($id);
		$Implemento->delete();
		    return response()->json(
		                $Implemento->toArray()
		            );


	}

}
