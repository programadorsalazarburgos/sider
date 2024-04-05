<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Lugar;
use Response;

class PostLugaresController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postlugares.applugares");
	}

	public function index()
	{

		$Lugar = Lugar::select('tbl_pr_lugares.id','tbl_pr_lugares.nombre_lugar', 'tbl_pr_lugares.direccion', 'barrios.nombre_barrio', 'comunas.nombre_comuna', 'tbl_pr_lugares.observaciones', 'tbl_pr_lugares.estado', 'tbl_gen_corregimientos.descripcion as corregimiento', 'tbl_gen_veredas.nombre as vereda', 'tbl_pr_lugares.tipo_punto_atencion')
		->leftJoin('barrios',
				   'barrios.id', '=', 'tbl_pr_lugares.barrio_id')
		->leftJoin('comunas',
				   'comunas.id', '=', 'tbl_pr_lugares.comuna_id')
		->leftJoin('tbl_gen_corregimientos',
				   'tbl_gen_corregimientos.id', '=', 'tbl_pr_lugares.corregimiento_id')
		->leftJoin('tbl_gen_veredas',
				   'tbl_gen_veredas.id', '=', 'tbl_pr_lugares.vereda_id')
		->where('tbl_pr_lugares.tenantId', '=', Auth::user()->tenantId)
		->where('tbl_pr_lugares.estado', '=', 0)
		->orderBy('tbl_pr_lugares.nombre_lugar', 'asc')
        ->get();
		return response()->json(
			$Lugar->toArray()
		);

	}



public function CrearLugar(Request $request){


    $errormsg = "";
    $result = false;

    try{

 		$Lugar = new Lugar();
        $Lugar->nombre_lugar = $request->input('lugar');
        $Lugar->tenantId = Auth::user()->tenantId;
        $Lugar->direccion = $request->input('direccion');
        $Lugar->barrio_id = $request->input('barrio');
        $Lugar->comuna_id = $request->input('comuna_id');
        $Lugar->corregimiento_id = $request->input('corregimiento');
        $Lugar->vereda_id = $request->input('vereda');
        $Lugar->observaciones = $request->input('observaciones');
        $Lugar->tipo_punto_atencion = $request->input('tipo_punto_atencion');
        $Lugar->estado = 0;
	    $Lugar->save();


    }catch(Exception $exception)
    {
        $errormsg = 'Database error! ' . $exception->getCode();
    }
    return Response::json(['success'=>$result,'errormsg'=>$errormsg]);




}



	public function ObtenerLugar($id){


		$lugar = lugar::select('tbl_pr_lugares.id', 'tbl_pr_lugares.nombre_lugar','tbl_pr_lugares.tenantId', 'tbl_pr_lugares.direccion', 'tbl_pr_lugares.barrio_id', 'tbl_pr_lugares.comuna_id', 'tbl_pr_lugares.observaciones', 'comunas.nombre_comuna', 'tbl_pr_lugares.tipo_punto_atencion')
		->leftJoin('comunas','comunas.id', '=', 'tbl_pr_lugares.comuna_id')
		->where('tbl_pr_lugares.id', '=', $id)->firstOrfail();

		return response()->json(
			$lugar->toArray()
		);
	}


public function EditarLugar(Request $request, $id){



    $errormsg = "";
    $result = false;

    try{

     	$observaciones = ($request->input('observaciones') == null) ? '' : $request->input('observaciones');

	    $Lugar = Lugar::findOrfail($id);
        $Lugar->nombre_lugar = $request->input('lugar');
        $Lugar->tenantId = Auth::user()->tenantId;
        $Lugar->direccion = $request->input('direccion');
        $Lugar->barrio_id = $request->input('barrio');
        $Lugar->comuna_id = $request->input('comuna_id');
        $Lugar->corregimiento_id = $request->input('corregimiento');
        $Lugar->vereda_id = $request->input('vereda');
        $Lugar->observaciones = $observaciones;
        $Lugar->tipo_punto_atencion = $request->input('tipo_punto_atencion');
	    $Lugar->save();


    }catch(Exception $exception)
    {
        $errormsg = 'Database error! ' . $exception->getCode();
    }
    return Response::json(['success'=>$result,'errormsg'=>$errormsg]);

}


	public function InactivarLugar($id){

		$Lugar = Lugar::findOrfail($id);
        $Lugar->estado = 1;
        $Lugar->save();
		    return response()->json(
		                $Lugar->toArray()
		            );


	}

	public function ActivarLugar($id){

		$Lugar = Lugar::findOrfail($id);
        $Lugar->estado = 0;
        $Lugar->save();
		    return response()->json(
		                $Lugar->toArray()
		            );


	}


	public function obtenerlugaresall(){

		$Lugar = Lugar::all();
    	return response()->json(
		                $Lugar->toArray()
		            );


	}


}
