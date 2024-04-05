<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Sede;
use App\Institucion;
use App\EquipamientoColegio;
use App\Models\TblDvEquipamentoTipo;
use response;
use Hashids\Hashids;

class PostFichaColegioController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
	//$this->hashids = new Hashids('', 10);

	}

	public function vista(){

		return view("postfichacolegios.appfichacolegios");
	}

	public function ObtenerTipoEquipamiento()
	{

		$TblDvEquipamentoTipo = TblDvEquipamentoTipo::all();
		return response()->json(
			$TblDvEquipamentoTipo->toArray()
		);

	}

	public function CrearFichaColegio(Request $request)
	{

		if($request->cantidadAgregar !=null)
		{
		$equipamiento = EquipamientoColegio::where('sede_id', '=', $request->sede)->where('equipamiento_id', '=', $request->equipamiento)->first();

		if(count($equipamiento)!=null){

			$equipamiento->cantidad = $equipamiento->cantidad + $request->cantidadAgregar;
			$equipamiento->save();		
		 }
		else{
			$fichacolegio = new EquipamientoColegio();
			$fichacolegio->sede_id = $request->sede;
			$fichacolegio->equipamiento_id = $request->equipamiento;
			$fichacolegio->cantidad = $request->cantidadAgregar;
			$fichacolegio->save();

			}
		}

		if($request->cantidadEliminar !=null)
		{
		$equipamiento = EquipamientoColegio::where('sede_id', '=', $request->sede)->where('equipamiento_id', '=', $request->equipamiento)->first();

		if(count($equipamiento)!=null){

			$equipamiento->cantidad = $equipamiento->cantidad - $request->cantidadEliminar;
			$equipamiento->save();		
		 }
	
		}

	}

	public function ObtenerEquipamientos($sede)
	{

		$equipamiento = EquipamientoColegio::select('instituciones.nombre_institucion', 'sedes.nombre_sede', 'tbl_dv_equipamento_tipo.descripcion', 'tbl_cm_colegios_x_equipamiento.cantidad')
		->join('tbl_dv_equipamento_tipo',
		'tbl_dv_equipamento_tipo.id', '=', 'tbl_cm_colegios_x_equipamiento.equipamiento_id')
		->join('sedes',
		'sedes.id', '=', 'tbl_cm_colegios_x_equipamiento.sede_id')
		->join('instituciones',
		'instituciones.id', '=', 'sedes.institucion_id')->where('sede_id', '=', $sede)->get();
		return response()->json(
			$equipamiento
		);

	}

}
