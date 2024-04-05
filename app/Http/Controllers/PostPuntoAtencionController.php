<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\PuntoAtencion;
use response;

class PostPuntoAtencionController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postpuntosatencion.apppuntosatencion");
	}

	public function index()
	{

		$PuntoAtenciones = PuntoAtencion::all();
		return response()->json(
			$PuntoAtenciones->toArray()
		);

	}


public function CrearPuntoAtencion(Request $request){


        $PuntoAtencion = new PuntoAtencion();
        $PuntoAtencion->nombre = $request->input('nombre');
	    $PuntoAtencion->save();
         return response()->json(
                  $PuntoAtencion->toArray()
              );

}



	public function ObtenerPuntoAtencion($id){


		$PuntoAtencion = PuntoAtencion::where('tbl_cm_punto_atencion.id', '=', $id)->firstOrfail();

		return response()->json(
			$PuntoAtencion->toArray()
		);
	}


	public function EditarPuntoAtencion(Request $request, $id){


	  $PuntoAtencion = PuntoAtencion::findOrfail($id);
	  $PuntoAtencion->nombre = $request->input('nombre');
	  $PuntoAtencion->save();
	      return response()->json(
	                $PuntoAtencion->toArray()
	            );
	}

	

	public function EliminarPuntoAtencion($id){

		$PuntoAtencion = PuntoAtencion::findOrfail($id);
		$PuntoAtencion->delete();
		    return response()->json(
		                $PuntoAtencion->toArray()
		            );


	}

}
