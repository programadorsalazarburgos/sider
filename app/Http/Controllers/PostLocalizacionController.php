<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Grupo;
use App\HorarioGrupo;
use App\Programa;
use App\Pais;
use App\Departamento;
use App\Municipio;
use App\Barrio;
use App\Beneficiario;
use App\Institucion;
use App\Sede;
use App\PoblacionalBeneficiario;
use App\FichaComunidad;
use DB;
use response;

class PostLocalizacionController extends Controller
{


	public function __construct()
	{


//    $this->middleware('permission:ver-roles', ['only' => 'vista']);


	}

	public function vista(){

		return view("postlocalizacion.applocalizacion");
	}

	public function index($id)
	{


    $instituciones = DB::table('sedes')
    ->select('instituciones.nombre_institucion as label', DB::raw('count(sedes.`id`) as value'))
    ->join('instituciones', 'instituciones.id', '=', 'sedes.institucion_id')
    ->join('barrios', 'barrios.id', '=', 'instituciones.barrio_id')
    ->where('barrios.comuna_id', '=', $id)
    ->groupBy('instituciones.nombre_institucion')
    ->get();

    
    return response()->json(
     $instituciones);
  }

  public function instituciones($id)
  {


    $instituciones = DB::table('sedes')
    ->select('instituciones.id','instituciones.nombre_institucion as label', DB::raw('count(sedes.`id`) as value'))
    ->join('instituciones', 'instituciones.id', '=', 'sedes.institucion_id')
    ->join('barrios', 'barrios.id', '=', 'instituciones.barrio_id')
    ->where('barrios.comuna_id', '=', $id)
    ->groupBy('instituciones.nombre_institucion', 'instituciones.id')
    ->get();


    return response()->json(
      $instituciones);
  }


  public function InstitucionesCorregimiento($id)
  {



    $instituciones = DB::table('instituciones')
    ->select('instituciones.id','instituciones.nombre_institucion as label', DB::raw('count(sedes.`id`) as value'))
    ->leftjoin('sedes', 'instituciones.id', '=', 'sedes.institucion_id')
    ->leftjoin('tbl_gen_corregimientos', 'tbl_gen_corregimientos.id', '=', 'instituciones.corregimiento_id')
    ->where('instituciones.corregimiento_id', '=', $id)
    ->groupBy('instituciones.nombre_institucion', 'instituciones.id')
    ->get();





    return response()->json(
      $instituciones);
  }



  public function sede($id)
  {


    $sedes = DB::table('sedes')
    ->select('sedes.id','sedes.nombre_sede as label', DB::raw('count(tbl_cm_ficha.`id`) as value'))
    ->leftjoin('instituciones', 'instituciones.id', '=', 'sedes.institucion_id')
    ->leftjoin('barrios', 'barrios.id', '=', 'instituciones.barrio_id')
    ->leftjoin('grupos', 'sedes.id', '=', 'grupos.sede_id')
    ->leftjoin('tbl_cm_ficha', 'grupos.id', '=', 'tbl_cm_ficha.grupo_id')
    ->where('sedes.institucion_id', '=', $id)
    ->groupBy('sedes.nombre_sede', 'sedes.id')
    ->get();



    
    return response()->json(
      $sedes);
  }


  public function institucion($id)
  {


    $institucion = Institucion::select('instituciones.nombre_institucion')->where('instituciones.id', '=', $id)->firstOrfail();
    return response()->json(
      $institucion->toArray()
    );


  }


  public function SedeBeneficiario($id)
  {



    $beneficiarios = FichaComunidad::select('tbl_cm_ficha.id','tbl_gen_persona.nombre_primero', 'tbl_gen_persona.nombre_segundo', 'tbl_gen_persona.apellido_primero', 'grupos.codigo_grupo', 'tbl_gen_persona.documento', 'users.primer_nombre', 'users.primer_apellido')->join(
      'tbl_gen_persona',
      'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->join(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')->join(
      'users',
      'users.id', '=', 'grupos.user_id')->join(
        'sedes',
        'sedes.id', '=', 'grupos.sede_id')->where('sedes.id', '=', $id)->get();
      return response()->json(
        $beneficiarios->toArray()
      );





    }


  }
