<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\User;
use App\Role;
use App\RoleUser;
use response;
use Hashids\Hashids;
use respondNotFound;
use Exception;
use DB;

class PostUsuariosController extends Controller
{


	public function __construct()
	{


    	// $this->middleware('permission:ver-instituciones', ['only' => 'vista']);
     //    $this->middleware('permission:crear-instituciones', ['only' => 'CrearUsuario']);


	}

	public function vista(){

		return view("postusuarios.appusuarios");
	}
	public function soporte(){

		return view("postsoporte.appsoporte");
	}

	public function index()
	{

  	
	$usuarios = User::select('users.id','users.primer_nombre','users.segundo_nombre','users.primer_apellido','users.email', 'users.telefono_movil', 'users.direccion', 'roles.display_name')
			->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
			->leftjoin('roles', 'role_user.role_id', '=', 'roles.id')->where('users.tenantId', '=', Auth::user()->tenantId)->get();
		return response()->json(
			$usuarios->toArray()
		);


	}

	public function ObtenerTenanId()
	{
		$tenanId = Auth::user()->tenantId;
		return response()->json(
			$tenanId
		);
	}
	public function ObtenerRoles()
	{

		$roles = Role::where('roles.tenantId', '=', Auth::user()->tenantId)->get();
		return response()->json(
			$roles->toArray()
		);

	}


public function CorreoUsuario(Request $request)
{
	

	$correo = User::where('users.email', '=', $request->input('email'))->firstOrfail();

		return response()->json(
			$correo->toArray()
		);


}


public function DocumentoUsuario($id)
{
	

	$documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $id));

	try {
    $query = User::where('users.numero_documento', '=', $documento)->firstOrfail();
    if ($query === null) {
        throw new Exception($this->mysqli->error);
    }
    return response()->json(
			$query->toArray()
		);

} catch(Exception $e) {

	echo 'string';
   
}



}



	public function CrearUsuario(Request $request)

{
		$usuario = new User();
		$usuario->primer_nombre = $request->input('primer_nombre');
		$usuario->segundo_nombre = $request->input('segundo_nombre');
		$usuario->primer_apellido = $request->input('primer_apellido');
		$usuario->segundo_apellido = $request->input('segundo_apellido');
		$usuario->tipo_documento = $request->input('tipo_documento');
		$usuario->numero_documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('numero_documento')));
		$usuario->direccion = $request->input('direccion');
		$usuario->fecha_nacimiento = date('Y-m-d',strtotime($request->input('fecha_nacimiento')));
		$usuario->telefono_movil = $request->input('telefono_movil');
		$usuario->telefono_fijo = $request->input('telefono_fijo');
		$usuario->email = $request->input('correo');
		$usuario->password = bcrypt($request->input('password'));
		$usuario->remember_token = str_random(50);
		$usuario->tenantId = Auth::user()->tenantId;
		$usuario->save();
		$rol_user = new RoleUser();
		$rol_user->user_id = $usuario->id;
		$rol_user->role_id = $request->input('rol');
		$rol_user->save();
		return response('almacenado');


	}

	public function ObtenerUsuario($id){


	$usuario = DB::select('select id, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, numero_documento, direccion, DATE_FORMAT(users.fecha_nacimiento, "%d/%m/%Y") as fecha_nacimiento, telefono_movil, telefono_fijo, email, FORMAT(users.numero_documento, 0, \'de_DE\') as numero_documento from users where users.id =?', [$id]);
		return response()->json(
			$usuario
		);
	}


	public function ObtenerTipoDocumento($id)
	{

		$tipodocumento = User::select('users.tipo_documento as id')->where('users.id', '=', $id)->firstOrfail();
		return response()->json(
			$tipodocumento->toArray());
	}

	public function ObtenerRolID($id){


		$roles = RoleUser::select('roles.id','roles.name')->join('roles',
			'roles.id','=', 'role_user.role_id')->where('role_user.user_id','=', $id)->firstOrfail();
		return response()->json(
			$roles->toArray()
		);


	}


	public function ActualizarUsuario(Request $request, $id){


		if($request->isMethod('post')) {

			$usuario = User::where('users.id','=', $id)->firstOrfail();
			$usuario->primer_nombre = $request->input('primer_nombre');
			$usuario->segundo_nombre = $request->input('segundo_nombre');
			$usuario->primer_apellido = $request->input('primer_apellido');
			$usuario->segundo_apellido = $request->input('segundo_apellido');
			$usuario->tipo_documento = $request->input('tipo_documento');
			$usuario->numero_documento = trim(str_replace(array('.', ' ', ','), array('', '', ''), $request->input('numero_documento')));
			$usuario->direccion = $request->input('direccion');
			$usuario->fecha_nacimiento = date('Y-m-d',strtotime($request->input('fecha_nacimiento')));
			$usuario->telefono_movil = $request->input('telefono_movil');
			$usuario->telefono_fijo = $request->input('telefono_fijo');
			$usuario->email = $request->input('correo');
			$usuario->save();


			$rol_user = RoleUser::where('role_user.user_id','=', $id)->firstOrfail();
			$rol_user->user_id = $usuario->id;
			$rol_user->role_id = $request->input('rol');
			$rol_user->save();
			return response('Actualizado');
		}

	}


	public function ActualizarClave(Request $request, $id){



		if($request->isMethod('post')) {

			$usuario = User::where('users.id','=', $id)->firstOrfail();
			$usuario->password = bcrypt($request->input('password'));
			$usuario->save();
			return response()->json(
				$usuario->toArray()
			);		

		}

	}


	public function EliminarUsuario($id){

		$usuario = User::findOrfail($id);
		$usuario->delete();
		return response()->json(
			$usuario->toArray()
		);


	}
	
	public function QuitarRol($id){

		$usuario = RoleUser::where('user_id', '=', $id)->firstOrfail();
		$usuario->delete();
		return response()->json(
			$usuario->toArray()
		);


	}

}