<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Meta;
use App\Indicador;
use Response;
use DB;
use Hashids\Hashids;

class PostIndicadoresController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
	//$this->hashids = new Hashids('', 10);

	}

	public function vista(){

		return view("postindicadores.appindicadores");
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

    public function ObtenerMetaAnualidad()
    {

        $metaanualidad = Meta::select('tbl_gen_metas.id', 'tbl_gen_metas.nombre_meta', 'tbl_gen_metas.periodo', 'programas.nombre_programa', 'tbl_gen_metas.meta', 'tbl_gen_metas.descripcion')
        ->join(
			'programas',
            'programas.id', '=', 'tbl_gen_metas.programa_id')
        ->where('programas.tenantId', '=', Auth::user()->tenantId)
        ->orderBy('tbl_gen_metas.id', 'asc')->get();
            return response()->json(
                $metaanualidad->toArray()
            );

    }

    public function AlcanceMeta($meta)
    {
        $metaanualidad = Meta::find($meta);
        return response()->json(
            $metaanualidad->toArray()
        );
    }

    public function IndicadorMeta($mes, $meta)
    {
        $metaanualidad = Indicador::where('meta_id', '=', $meta)->where('mes', '=', $mes)->firstOrfail();
        return response()->json(
            $metaanualidad->toArray()
        );
    }

    public function CrearIndicador(Request $request)
    {
     
        $indicador = Indicador::firstOrNew([
            'meta_id' => $request->datos['meta'],
            'mes'  => $request->datos['mes']
        ]); 
        $indicador->meta_id = $request->datos['meta'];
        $indicador->mes = $request->datos['mes'];
        $indicador->avance_meta = $request->datos['avance'];
        $indicador->descripcion = $request->datos['descripcion'];
        $indicador->save();
        return response()->json(
                $indicador->toArray()
            );
  
    }
    

    public function GraficoIndicador($id)
	{
        
    $indicadores = DB::table('tbl_indicador_metas')
    ->select('tbl_indicador_metas.mes as label', 'tbl_indicador_metas.avance_meta as value', 'tbl_gen_metas.meta')
    ->join('tbl_gen_metas', 'tbl_gen_metas.id', '=', 'tbl_indicador_metas.meta_id')
    ->where('tbl_indicador_metas.meta_id', '=', $id)
    ->orderBy('tbl_indicador_metas.id', 'asc') 
    ->groupBy('tbl_indicador_metas.mes')
    ->get();

    
    return response()->json(
     $indicadores);
  }

  public function MetaAlcance($id)
  {

    $metaalcance = Meta::select('tbl_gen_metas.meta', 'tbl_gen_metas.nombre_meta')->where('id', '=', $id)->firstOrfail();
    return response()->json(
        $metaalcance);
  }

    // public function ObtenerIndicador($id)
    // {

    //     $meta = Meta::find($id);
    //     return response()->json(
	// 		$meta->toArray()
	// 	);
    // }
    // public function EditarIndicador(Request $request, $id)
    // {

    //     $errormsg = "";
    //     $result = false;
    //     try{
     
    //     $meta = Meta::findOrfail($id);
    //     $meta->nombre_meta = $request->nombre_meta;
    //     $meta->periodo = $request->anualidad;
    //     $meta->programa_id =  $request->programa;
    //     $meta->meta = $request->meta;
    //     $meta->descripcion = $request->descripcion;
    //     $meta->save();

    // }catch(Exception $exception)
    // {
    //     $errormsg = 'Database error! ' . $exception->getCode();
    // }
    // return Response::json(['success'=>$result,'errormsg'=>$errormsg]);

    // }
    // public function EliminarIndicador($id)
    // {

    //     $meta = Meta::findOrfail($id);
	// 	$meta->delete();
	// 	    return response()->json(
	// 	                $meta->toArray()
	// 	            );

    // }
}
