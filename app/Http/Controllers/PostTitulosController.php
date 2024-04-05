<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Titulo;
use response;

class PostTitulosController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("posttitulos.apptitulos");
	}

	public function index()
	{

		$Titulo = Titulo::orderBy('descripcion', 'asc')->get();
		return response()->json(
			$Titulo->toArray()
		);

	}


    public function CrearTitulo(Request $request){


        $Titulo = new Titulo();
        $Titulo->descripcion = $request->input('descripcion');
	    $Titulo->save();
         return response()->json(
                  $Titulo->toArray()
              );

}



	public function ObtenerTitulo($id){


		$Titulo = Titulo::where('id', '=', $id)->firstOrfail();

		return response()->json(
			$Titulo->toArray()
		);
	}


    public function EditarTitulo(Request $request, $id){

        $Titulo = Titulo::findOrfail($id);
        $Titulo->descripcion = $request->input('descripcion');
        $Titulo->save();
            return response()->json(
                        $Titulo->toArray()
                    );
    }

	
	public function EliminarTitulo($id){

		$Titulo = Titulo::findOrfail($id);
		$Titulo->delete();
		    return response()->json(
		                $Titulo->toArray()
		            );


	}

}
