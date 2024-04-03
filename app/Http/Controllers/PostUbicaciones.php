<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use DB;
use response;



class PostUbicaciones extends Controller
{

	public function __construct()
	{
//    $this->middleware('permission:ver-roles', ['only' => 'vista']);
	}
	public function VerDepartamentos(Request $request)//$id=id_pais
	{
		$sql='SELECT 
			  `tbl_gen_departamento`.`id`,
			  `tbl_gen_departamento`.`nombre`
			FROM
			  `tbl_gen_departamento`
			WHERE
			  `tbl_gen_departamento`.`id_pais`=?
			ORDER BY 2';
		$data=DB::select($sql,[$request->input('id')]);
		return json_encode($data,128);
	}
	public function VerMunicipios(Request $request)//$id=id_pais
	{
		$sql='SELECT 
				  `tbl_gen_ciudad`.`id`,
				  `tbl_gen_ciudad`.`nombre`
				FROM
				  `tbl_gen_ciudad`
				WHERE
				  `tbl_gen_ciudad`.`id_departamento` = ?
				  ORDER BY 2';
		$data=DB::select($sql,[$request->input('id')]);
		return json_encode($data,128);
	}
}