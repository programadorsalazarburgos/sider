<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Sede;
use App\Institucion;
use App\ImplementoColegio;
use App\Implemento;
use response;
use Hashids\Hashids;

class PostInventarioColegioController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
	//$this->hashids = new Hashids('', 10);

	}

	public function vista(){

		return view("postinventariocolegios.appinventariocolegios");
	}

	public function ObtenerTipoImplementos()
	{

		$Implemento = Implemento::all();
		return response()->json(
			$Implemento->toArray()
		);

	}

	public function CrearInventarioColegio(Request $request)
	{



		if($request->cantidadAgregar !=null)
		{



		$inventario = ImplementoColegio::where('sede_id', '=', (int)$request->sede)->where('implemento_id', '=', (int)$request->implemento)->exists();

	

		if($inventario == true){

			$inventarios = ImplementoColegio::where('sede_id', '=', (int)$request->sede)->where('implemento_id', '=', (int)$request->implemento)->firstOrfail();
			
			$inventarios->cantidad = (int)$inventarios->cantidad + (int)$request->cantidadAgregar;
			$inventarios->save();		
		 }
		else{
			$inventariocolegio = new ImplementoColegio();
			$inventariocolegio->sede_id = (int)$request->sede;
			$inventariocolegio->implemento_id = (int)$request->implemento;
			$inventariocolegio->cantidad = (int)$request->cantidadAgregar;
			$inventariocolegio->save();

			}
		}

		if($request->cantidadEliminar !=null)
		{
		$implemento = ImplementoColegio::where('sede_id', '=', (int)$request->sede)->where('implemento_id', '=', (int)$request->implemento)->exists();

		
		if($implemento == true){
			
			$implementos = ImplementoColegio::where('sede_id', '=', (int)$request->sede)->where('implemento_id', '=', (int)$request->implemento)->firstOrfail();
			$implementos->cantidad = (int)$implementos->cantidad - (int)$request->cantidadEliminar;
			$implementos->save();		
		 }
	
		}

	}

	public function ObtenerImplementos($sede)
	{

		$implemento = ImplementoColegio::select('instituciones.nombre_institucion', 'sedes.nombre_sede', 'tbl_cm_implementos.nombre_implemento', 'tbl_cm_colegios_x_implementos.cantidad')
		->join('tbl_cm_implementos',
		'tbl_cm_implementos.id', '=', 'tbl_cm_colegios_x_implementos.implemento_id')
		->join('sedes',
		'sedes.id', '=', 'tbl_cm_colegios_x_implementos.sede_id')
		->join('instituciones',
		'instituciones.id', '=', 'sedes.institucion_id')->where('sede_id', '=', $sede)->get();
		return response()->json(
			$implemento
		);

	}

}
