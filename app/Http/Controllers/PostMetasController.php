<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Meta;
use Response;
use DB;
use Hashids\Hashids;

class PostMetasController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
	//$this->hashids = new Hashids('', 10);

	}

	public function vista(){

		return view("postmetas.appmetas");
	}

	public function index()
	{

        $metas = Meta::select('tbl_gen_metas.id', 'tbl_gen_metas.nombre_meta', 'tbl_gen_metas.periodo', 'programas.nombre_programa', 'tbl_gen_metas.meta', 'tbl_gen_metas.descripcion')
        ->join(
			'programas',
            'programas.id', '=', 'tbl_gen_metas.programa_id')
        ->where('programas.tenantId', '=', Auth::user()->tenantId)
        
            ->orderBy('tbl_gen_metas.id', 'asc')->get();
		return response()->json(
			$metas->toArray()
		);
    }
    public function CrearMeta(Request $request)
    {
     
        $errormsg = "";
        $result = false;
        try{
            $result = DB::table('tbl_gen_metas')->
            insert(
                    [
                        'nombre_meta' => $request->datos['nombre_meta'],
                        'periodo' => $request->datos['anualidad'],
                        'programa_id' => $request->datos['programa'],
                        'meta' => $request->datos['cantidad_meta'],
                        'descripcion' => $request->datos['descripcion']
                    ]
                );
        }catch(Exception $exception)
        {
            $errormsg = 'Database error! ' . $exception->getCode();
        }
        return Response::json(['success'=>$result,'errormsg'=>$errormsg]);

    }

    public function ObtenerMeta($id)
    {

        $meta = Meta::find($id);
        return response()->json(
			$meta->toArray()
		);
    }
    public function EditarMeta(Request $request, $id)
    {

        $errormsg = "";
        $result = false;
        try{
     
        $meta = Meta::findOrfail($id);
        $meta->nombre_meta = $request->nombre_meta;
        $meta->periodo = $request->anualidad;
        $meta->programa_id =  $request->programa;
        $meta->meta = $request->meta;
        $meta->descripcion = $request->descripcion;
        $meta->save();

    }catch(Exception $exception)
    {
        $errormsg = 'Database error! ' . $exception->getCode();
    }
    return Response::json(['success'=>$result,'errormsg'=>$errormsg]);

    }
    public function EliminarMeta($id)
    {

        $meta = Meta::findOrfail($id);
		$meta->delete();
		    return response()->json(
		                $meta->toArray()
		            );

    }
}
