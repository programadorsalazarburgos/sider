<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\ProgramaDisciplina;
use Response;

class PostDisciplinasController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postdisciplinas.appdisciplinas");
	}

	public function index()
	{

		$ProgramaDisciplina = ProgramaDisciplina::where('tenantId', '=', Auth::user()->tenantId)->get();


		return response()->json(
			$ProgramaDisciplina->toArray()
		);

	}



public function CrearDisciplina(Request $request){


    $errormsg = "";
    $result = false;

    try{
     
 		$ProgramaDisciplina = new ProgramaDisciplina();
        $ProgramaDisciplina->nombre_disciplina = $request->input('nombre_disciplina');
        $ProgramaDisciplina->tenantId = Auth::user()->tenantId;
        $ProgramaDisciplina->descripcion = $request->input('descripcion');
        $ProgramaDisciplina->estado = 0;
	    $ProgramaDisciplina->save();
        

    }catch(Exception $exception)
    {
        $errormsg = 'Database error! ' . $exception->getCode();
    }
    return Response::json(['success'=>$result,'errormsg'=>$errormsg]);




}



	public function ObtenerDisciplina($id){


		$ProgramaDisciplina = ProgramaDisciplina::find($id);

		return response()->json(
			$ProgramaDisciplina->toArray()
		);
	}


public function EditarDisciplina(Request $request, $id){


    $errormsg = "";
    $result = false;

    try{
     
	    $ProgramaDisciplina = ProgramaDisciplina::findOrfail($id);
        $ProgramaDisciplina->nombre_disciplina = $request->input('nombre_disciplina');
        $ProgramaDisciplina->tenantId = Auth::user()->tenantId;
        $ProgramaDisciplina->descripcion = $request->input('descripcion');
	    $ProgramaDisciplina->save();
        

    }catch(Exception $exception)
    {
        $errormsg = 'Database error! ' . $exception->getCode();
    }
    return Response::json(['success'=>$result,'errormsg'=>$errormsg]);

}

	
	public function InactivarDisciplina($id){

		$ProgramaDisciplina = ProgramaDisciplina::findOrfail($id);
        $ProgramaDisciplina->estado = 1;
        $ProgramaDisciplina->save();
		    return response()->json(
		                $ProgramaDisciplina->toArray()
		            );


	}	

	public function ActivarDisciplina($id){

		$ProgramaDisciplina = ProgramaDisciplina::findOrfail($id);
        $ProgramaDisciplina->estado = 0;
        $ProgramaDisciplina->save();
		    return response()->json(
		                $ProgramaDisciplina->toArray()
		            );


	}

}
