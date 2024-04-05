<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentoTipo;
use App\Corregimiento;
use App\Vereda;
use App\Barrio;
use App\EstadoCivil;
use App\Eps;
use App\GrupoPoblacional;
use App\Discapacidad;
use App\Modalidad;
use App\PuntoAtencion;
use App\Ocupacion;
use App\Disciplinas;
use App\Programa;
use App\Titulo;
use App\User;
use App\ClubDeportivo;
use DB;
use Auth;


class SelectedController extends Controller
{
    
	public function ObtenerTipoDocumento()
	{

		$DocumentoTipo = DocumentoTipo::select('id',
	           DB::raw('UPPER(descripcion) as descripcion'))
			   ->orderBy('descripcion', 'asc')->get();

		return response()->json(
			$DocumentoTipo->toArray()
		);


	}

	public function ObtenerTipoDocumento2()
	{

		$DocumentoTipo = DocumentoTipo::select('id',
	           DB::raw('UPPER(descripcion) as descripcion'))
			   ->orderBy('descripcion', 'asc')->get();

		return ['documentos' => $DocumentoTipo];


	}


	public function ObtenerCorregimientos()
	{
		$Corregimiento = DB::table('tbl_gen_corregimientos')
		    ->select(
		         'id',
		          DB::raw('UPPER(descripcion) as descripcion'))
		          ->orderBy('descripcion', 'asc')
		          ->get();
		return response()->json(
			$Corregimiento->toArray()
		);

	}
	public function ObtenerCorregimientos2()
	{
		$datos = DB::table('tbl_gen_corregimientos')
		    ->select(
		         'id',
		          DB::raw('UPPER(descripcion) as descripcion'))
		          ->orderBy('descripcion', 'asc')
		          ->get();
		
		          return ['datos'=> $datos];

	}


	public function ObtenerVeredas($id)
			{


				$veredas = Vereda::select('tbl_gen_veredas.id', 'tbl_gen_veredas.nombre')->join(
					'tbl_gen_corregimientos',
					'tbl_gen_corregimientos.id', '=', 'tbl_gen_veredas.corregimiento_id')->where('tbl_gen_corregimientos.id', '=', $id)->get();
				return response()->json(
					$veredas
				);
			}


	public function ObtenerEstadosCiviles()
	{

		$EstadoCivil = EstadoCivil::all();
		return response()->json(
			$EstadoCivil->toArray()
		);

	}

	public function ObtenerSaludEps()
	{


		$SaludEps = DB::table('tbl_gen_eps')
		    ->select(
		         'id',
		          DB::raw('UPPER(descripcion) as descripcion'))
		          ->orderBy('descripcion', 'asc')
		          ->get();
		return response()->json(
			$SaludEps->toArray()
		);
	}

	public function ObtenerGruposPoblacional()
	{

		$GrupoPoblacional = GrupoPoblacional::all();
		return response()->json(
			$GrupoPoblacional->toArray()
		);
	}
	
	public function ObtenerGruposDisciplina()
	{

		$GrupoDisciplina = Disciplinas::orderBy('descripcion', 'asc')
		->get();
		return response()->json(
			$GrupoDisciplina->toArray()
		);
	}

	public function ObtenerDiscapacidades()
	{

		$Discapacidad = DB::table('tbl_gen_discapacidad')
		    ->select(
		         'id',
		          DB::raw('UPPER(descripcion) as descripcion'))
		          ->orderBy('descripcion', 'asc')
		          ->get();
		return response()->json(
			$Discapacidad->toArray()
		);
	}

		public function ObtenerDiscapacidades2()
	{

		$datos = DB::table('tbl_gen_discapacidad')
		    ->select(
		         'id',
		          DB::raw('UPPER(descripcion) as descripcion'))
		          ->orderBy('descripcion', 'asc')
		          ->get();
		return ['datos' => $datos];
	}

	public function ObtenerEstratoBarrio($id)
	{

		$estrato = Barrio::find($id);
		return response()->json(
			$estrato->toArray()
		);
	}



	public function ObtenerModalidades()
	{

		$Modalidad = Modalidad::all();
		return response()->json(
			$Modalidad->toArray()
		);
	}


	public function ObtenerPuntosAtencion()
	{

		$PuntoAtencion = PuntoAtencion::all();
		return response()->json(
			$PuntoAtencion->toArray()
		);
	}
	
	public function ObtenerOcupaciones()
		{
			$Ocupacion = DB::table('tbl_gen_ocupacion')
			    ->select(
			         'id',
			          DB::raw('UPPER(descripcion) as descripcion'))
			          ->orderBy('descripcion', 'asc')
			          ->get();
			return response()->json(
				$Ocupacion->toArray()
			);
		}

	public function ObtenerProgramaSelect()
	{
		$programa = Programa::where('programas.tenantId', '=', Auth::user()->tenantId)->get();
		return response()->json(
			$programa->toArray()
		);
	}

	public function ObtenerTitulos()
	{
		$Titulo = Titulo::orderBy('descripcion', 'asc')->get();
		return response()->json(
			$Titulo->toArray()
		);
	}
	public function ObtenerUsuariosAll()
	{
	
		$users = User::select('id', DB::raw('CONCAT(primer_nombre, " ", primer_apellido) AS full_name'))->where('users.tenantId', '=', Auth::user()->tenantId)
		->orderBy('id')->get();
	
		return response()->json(
			$users->toArray()
		);
		
	}

	public function clubesdeportivos()
	{
		$clubesdeportivos = ClubDeportivo::all();
		return response()->json(
			$clubesdeportivos->toArray()
		);
	}

	public function nombre_ahdi($id)
	{

		$nombre_barrio = Barrio::where('id', '=', $id)->firstOrFail();
		return response()->json(
			$nombre_barrio->toArray()
		);	
	}


}
