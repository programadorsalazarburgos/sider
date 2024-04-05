<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Role;
use App\PermissionRole;
use App\Permission;
use response;
use Hashids\Hashids;

class PostRolesController extends Controller
{

protected $hashids;

 public function __construct()
 {



 }

 public function vista(){

  return view("postroles.approles");
}

public function index()
{


  $Roles = Role::where('roles.tenantId', '=', Auth::user()->tenantId)->get();
  return response()->json(
    $Roles->toArray()
  );

}


public function ObtenerRol($id){

  $rol_permiso = Role::where('roles.id', '=', $id)->firstOrfail();
  return response()->json(
    $rol_permiso->toArray()
  );
}


public function ObtenerPermisosId($id){



  $permission_role = PermissionRole::select('permission_role.permission_id as id', 'permission_role.role_id','permissions.name')->where('permission_role.role_id', '=', $id)->join(
    'permissions',
    'permissions.id', '=', 'permission_role.permission_id')->get();
  return response()->json(
    $permission_role->toArray()
  );
}




public function ObtenerPermisosTotal(){

  $permission_role = Permission::where('permissions.tenantId', '=', Auth::user()->tenantId)->get();
  return response()->json(
    $permission_role->toArray()
  );
}


public function CrearPermisosRole(Request $request, $id){

  $permissions = PermissionRole::where('permission_role.role_id', '=', $id)->delete();

  if($request->isMethod('post')) {


    foreach ($request->input() as $dato1) {
      $permisos = new PermissionRole();
      $permisos->permission_id = $dato1[0];
      $permisos->role_id = $id;
      $permisos->save();
      
    }
    return response()->json($permisos);
  }

}


private function Eliminar($id_permiso, $id_rol)
{
  



  $permissions = PermissionRole::where('permission_role.role_id', '=', $id_rol)->where('permission_role.permission_id', '=', $id_permiso)->delete();  

  
}




public function EliminarPermisosRole(Request $request, $id)
{
$data=$request->input();

    foreach($data as $temp)
    {
        
        $this->Eliminar($temp[0],$id);

    }

    }


public function CrearRol(Request $request)

{

  $rol = new Role();
  $rol->name = $request->nombre;
  $rol->display_name = $request->nombre;
  $rol->description = $request->descripcion;
  $rol->tenantId = Auth::user()->tenantId;
  $rol->save();
  return response()->json($rol);
  

}

public function EliminarRol($id)
{



    $rol = Role::where('roles.id', '=', $id)->firstOrfail();
    $rol->delete();

       return response()->json(
                $rol->toArray()
            );

}

public function ObtenerRolUsuario($id)
{

  $rol = Role::find($id);
  return response()->json(
    $rol->toArray()
  );


}

public function ActualizarRol(Request $request, $id)
{


  $rol = Role::find($id);
  $rol->name = $request->nombre;
  $rol->display_name = $request->nombre;
  $rol->description = $request->descripcion;
  $rol->tenantId = Auth::user()->tenantId;
  $rol->save();
  return response()->json(
    $rol->toArray()
  );


}


}
