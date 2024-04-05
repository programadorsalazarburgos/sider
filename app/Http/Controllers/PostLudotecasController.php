<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Ludoteca;
use App\Barrio;
use App\Corregimiento;
use response;
use Hashids\Hashids;

class PostLudotecasController extends Controller
{

protected $hashids;

	public function __construct(Hashids $hashids)
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
		//$this->hashids = new Hashids('', 10);
	

	}

	public function vista(){

		return view("postludotecas.appludotecas");
	}

	public function index()
	{




		$comunas = Ludoteca::select('tbl_gen_ludotecas.id','tbl_gen_ludotecas.nombre_ludoteca','tbl_gen_ludotecas.telefono','tbl_gen_ludotecas.direccion', 'tbl_gen_ludotecas.barrio_id', 'comunas.nombre_comuna', 'barrios.nombre_barrio', 'tbl_gen_corregimientos.descripcion')->leftjoin(
			'tbl_gen_corregimientos',
			'tbl_gen_corregimientos.id', '=', 'tbl_gen_ludotecas.corregimiento_id')->leftjoin(
			'barrios',
			'barrios.id', '=', 'tbl_gen_ludotecas.barrio_id')->leftjoin(
			'comunas',
			'comunas.id', '=', 'barrios.comuna_id')->orderBy('tbl_gen_ludotecas.created_at', 'asc')->get();
		return response()->json(
			$comunas->toArray()
		);


	}

	public function ObtenerBarriosLudoteca()
	{

		$barrios = Barrio::select('barrios.id', 'barrios.nombre_barrio', 'comunas.nombre_comuna')->join('comunas',
			'comunas.id', '=', 'barrios.comuna_id'
	)->get();
		return response()->json(
			$barrios->toArray()
		);

	}


	public function ObtenerLudotecaBarrioID($id){


		$barrios = Ludoteca::select('barrios.id', 'barrios.nombre_barrio', 'comunas.nombre_comuna')->join(
			'barrios',
			'barrios.id', '=', 'tbl_gen_ludotecas.barrio_id')->join('comunas',
			'comunas.id', '=', 'barrios.comuna_id')->where('tbl_gen_ludotecas.id', '=', $id)->firstOrfail();
			return response()->json(
			$barrios->toArray()
		);

	}
	public function ObtenerLudotecaSedeID($id){


		$barrios = Ludoteca::select('sedes.id', 'sedes.nombre_sede', 'instituciones.nombre_institucion')->join(
			'sedes',
			'sedes.id', '=', 'tbl_gen_ludotecas.sede_id')->join('instituciones',
			'instituciones.id', '=', 'sedes.institucion_id')->where('tbl_gen_ludotecas.id', '=', $id)->firstOrfail();
			return response()->json(
			$barrios->toArray()
		);

	}


public function obtenerbarriosID($id){


		$barrios = Barrio::select('barrios.id', 'barrios.nombre_barrio')->join('comunas',
			'comunas.id', '=', 'barrios.comuna_id')->get();
			return response()->json(
			$barrios->toArray()
		);

	}



public function obtenerBarrioComunaID($id){


		$barrios = Ludoteca::select('comunas.id', 'comunas.nombre_comuna')->join(
			'barrios',
			'barrios.id', '=', 'tbl_gen_ludotecas.barrio_id')->join('comunas',
			'comunas.id', '=', 'barrios.comuna_id')->where('tbl_gen_ludotecas.id', '=', $id)->firstOrfail();
			return response()->json(
			$barrios->toArray()
		);

	}

public function CrearLudoteca(Request $request){

        $ludoteca = new Ludoteca();
        $ludoteca->nombre_ludoteca = $request->input('nombre_ludoteca');
        $ludoteca->telefono = $request->input('telefono');
		$ludoteca->direccion = $request->input('direccion') . $request->input('complemento');
        $ludoteca->sede_id = $request->input('sede');
        $ludoteca->barrio_id = $request->input('barrio');
        $ludoteca->corregimiento_id = $request->input('corregimiento_ludoteca');
        $ludoteca->save();
         return response()->json(
                  $ludoteca->toArray()
              );


}

public function ObtenerLudotecaId($id){


	$institucion = Ludoteca::where('tbl_gen_ludotecas.id', '=', $id)->firstOrfail();
		return response()->json(
			$institucion->toArray()
		);
	}


public function EditarLudoteca(Request $request, $id){


	  $ludoteca = Ludoteca::findOrfail($id);
	  $ludoteca->nombre_ludoteca = $request->input('nombre_ludoteca');
      $ludoteca->telefono = $request->input('telefono');
	  $ludoteca->direccion = $request->input('direccion');
	  if ($request->input('sede') == 0) {
	  $ludoteca->sede_id = $ludoteca->sede_id;
	  }
	  else{
		$ludoteca->sede_id = $request->input('sede');
	  }
	  if ($request->input('barrio') == 0) {
		$ludoteca->barrio_id = $ludoteca->barrio_id;
		}
		else{
		  $ludoteca->barrio_id = $request->input('barrio');
		}
	  if ($request->input('corregimiento') == 'null') {
		 $ludoteca->corregimiento_id = null;
	  }
	  else if($request->input('corregimiento') != null) {
		$ludoteca->corregimiento_id = $request->input('corregimiento');
		$ludoteca->barrio_id = null;
	  }
      $ludoteca->save();
      return response()->json(
            $ludoteca->toArray()
         );
}

	public function ObtenerCorregimientoLudoteca($id)
	{


	$corregimiento = Ludoteca::select('tbl_gen_corregimientos.id', 'tbl_gen_corregimientos.descripcion')->join(
		'tbl_gen_corregimientos',
		'tbl_gen_corregimientos.id', '=', 'tbl_gen_ludotecas.corregimiento_id')->where('tbl_gen_ludotecas.id', '=', $id)->firstOrfail();

		return response()->json(
			$corregimiento
		);

	}



	public function EliminarLudoteca($id){

		$ludoteca = Ludoteca::findOrfail($id);
		$ludoteca->delete();
		    return response()->json(
		                $ludoteca->toArray()
		            );


	}

	public function LudotecaCorregimiento($id)
	{

		$ludoteca = Ludoteca::findOrfail($id);
		    return response()->json(
		                $ludoteca->toArray()
		            );

	}


}
