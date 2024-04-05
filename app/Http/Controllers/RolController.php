<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Role;
use App\PermissionRole;
use App\Permission;
use response;
use Hashids\Hashids;
use App\VistaReporteGeneral;
use App\FichaComunidad;

use Illuminate\Support\Facades\DB;


class RolController extends Controller
{
    

    public function index(Request $request)
    {

        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
    
        if ($buscar==''){

            $roles = Role::orderBy('id', 'desc')->where('roles.tenantId', '=', Auth::user()->tenantId)->paginate(20);

        }
        else{

            $roles = Role::where($criterio, 'LIKE', '%'. $buscar . '%')->orderBy('id', 'desc')
            ->where('roles.tenantId', '=', Auth::user()->tenantId)->paginate(20);
            
             // die('<pre>'. print_r($request->rol_id$criterio, 1));
        }
        

        return [
            'pagination' => [
                'total'        => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page'     => $roles->perPage(),
                'last_page'    => $roles->lastPage(),
                'from'         => $roles->firstItem(),
                'to'           => $roles->lastItem(),
            ],
            'roles' => $roles
        ];
    }



    public function listar_reporte_general(Request $request)
    {


    if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
    
        if ($buscar==''){
        
           $roles = FichaComunidad::select(
                'tbl_cm_ficha.id',
                'tbl_cm_ficha.tenantId AS tenantId',
                'grupos.codigo_grupo AS codigo_grupo',
                'tbl_cm_grados.nombre_grado AS nombre_grado',
                'instituciones.nombre_institucion AS nombre_institucion',
                'sedes.nombre_sede AS nombre_sede',
                'tbl_gen_documento_tipo.descripcion AS tipo_documento',
                'tbl_gen_persona.documento AS documento',
                'tbl_cm_ficha.no_ficha AS no_ficha',
                'tbl_cm_ficha.fecha_inscripcion AS fecha_inscripcion',
                'tbl_gen_persona.nombre_primero AS nombre_primero',
                'tbl_gen_persona.nombre_segundo AS nombre_segundo',
                'tbl_gen_persona.apellido_primero AS apellido_primero',
                'tbl_gen_persona.apellido_segundo AS apellido_segundo',
                'tbl_gen_persona.correo_electronico AS correo_electronico',
                DB::raw("(CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo"),
                'tbl_gen_persona.fecha_nacimiento AS fecha_nacimiento',

                DB::raw("timestampdiff(YEAR,'tbl_gen_persona.fecha_nacimiento',curdate()) AS edad_persona"),
                 'paises.nombre_pais AS nombre_pais',
                 'departamentos.nombre_departamento AS nombre_departamento',
                 'municipios.nombre_municipio AS nombre_municipio',
                 'tbl_gen_corregimientos.descripcion AS nombre_corregimiento',
                 'tbl_gen_veredas.nombre AS nombre_vereda',
                 'barrios.nombre_barrio AS nombre_barrio',
                 'tbl_gen_persona.residencia_estrato AS residencia_estrato',
                 'comunas.nombre_comuna AS nombre_comuna',
                 'tbl_gen_persona.residencia_direccion AS residencia_direccion',
                 'tbl_gen_persona.telefono_fijo AS telefono_fijo',
                 'tbl_gen_persona.telefono_movil AS telefono_movil',
                 'tbl_gen_escolaridad_nivel.descripcion AS nivel_escolaridad',
                 'tbl_gen_escolaridad_estado.descripcion AS estado_escolaridad',
                 'tbl_gen_ocupacion.descripcion AS ocupacion_beneficiario',
                 'tbl_gen_estado_civil.descripcion AS estado_civil',
                  'users.primer_nombre AS primer_nombre_usuario',
                  'users.primer_apellido AS primer_apellido_usuario'

            )
            ->leftjoin('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
            ->leftjoin('tbl_gen_persona as acudiente_persona','acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')


            ->leftjoin('poblacional_beneficiarios', 'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')
            ->leftjoin('tbl_cm_persona_x_discapacidad', 'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')
            ->leftjoin('grupos', 'grupos.id', '=', 'tbl_cm_ficha.grupo_id')
            ->leftjoin('sedes', 'sedes.id', '=', 'grupos.sede_id')
            ->leftjoin('instituciones', 'instituciones.id', '=', 'sedes.institucion_id')
            ->leftjoin('tbl_cm_grados', 'tbl_cm_grados.id', '=', 'grupos.grado_id')
            ->leftjoin('comunas', 'comunas.id', '=', 'tbl_cm_ficha.comuna_id')
            ->leftjoin('users', 'users.id', '=', 'grupos.user_id')
            ->leftjoin('view_grupo_poblacional_ficha', 'tbl_cm_ficha.id', '=', 'view_grupo_poblacional_ficha.ficha_id')
            ->leftjoin('view_discapacidad_persona_ficha', 'tbl_cm_ficha.id', '=', 'view_discapacidad_persona_ficha.ficha_id')
            ->leftjoin('paises', 'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')
            ->leftjoin('departamentos', 'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')
            ->leftjoin('municipios', 'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')
            ->leftjoin('barrios', 'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')
            ->leftjoin('tbl_gen_corregimientos', 'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
            ->leftjoin('tbl_gen_veredas', 'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
            ->leftjoin('tbl_gen_estado_civil', 'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
            ->leftjoin('tbl_gen_escolaridad_nivel', 'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
            ->leftjoin('tbl_gen_documento_tipo', 'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
            ->leftjoin('tbl_gen_documento_tipo as tipo_documento_acudiente', 'tipo_documento_acudiente.id', '=', 'acudiente_persona.id_documento_tipo')
            ->leftjoin('tbl_gen_eps', 'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
            ->leftjoin('tbl_gen_ocupacion', 'tbl_gen_ocupacion.id', '=', 'tbl_cm_ficha.ocupacion_beneficiario')
            ->leftjoin('tbl_gen_etnia', 'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')
            ->leftjoin('tbl_gen_escolaridad_estado', 'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')
            ->leftjoin('tbl_gen_salud_regimen', 'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')
            ->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)
           ->whereYear('tbl_cm_ficha.fecha_inscripcion', '=', 2019)
            ->groupBy('tbl_cm_ficha.id')->paginate(20);


        }
        else{

            // $roles = VistaReporteGeneral::where('vista_reporte_general.tenantId', '=', Auth::user()->tenantId)->groupBy('vista_reporte_general.id')->paginate(2);

            // $roles = Role::where($criterio, 'LIKE', '%'. $buscar . '%')->orderBy('id', 'desc')
            // ->where('roles.tenantId', '=', Auth::user()->tenantId)->paginate(20);
            
             // die('<pre>'. print_r($request->rol_id$criterio, 1));
        }
        

        return [
            'pagination' => [
                'total'        => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page'     => $roles->perPage(),
                'last_page'    => $roles->lastPage(),
                'from'         => $roles->firstItem(),
                'to'           => $roles->lastItem(),
            ],
            'roles' => $roles
        ];

    }

       public function store(Request $request)
    {


        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $rol = new Role();
            $rol->name = $request->nombre;
            $rol->display_name = $request->nombre; 
            $rol->description = $request->descripcion; 
            $rol->tenantId = Auth::user()->tenantId;
            $rol->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

        public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $rol = Role::findOrFail($request->id);            
            $rol->name = $request->nombre;
            $rol->display_name = $request->nombre; 
            $rol->description = $request->descripcion; 
            $rol->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

     public function permisos()
    {


        $permisos = Permission::where('permissions.tenantId', '=', Auth::user()->tenantId)->orderBy('name', 'desc')->get();
        return ['permisos' => $permisos];
    }

        public function permisos_asignados(Request $request)
    {

       
        $permission = PermissionRole::select('permissions.created_at', 'permissions.name', 'permissions.id', 'permissions.display_name', 'permissions.updated_at', 'permissions.description', 'permissions.tenantId')->where('permission_role.role_id', '=', (int)$request->rol_id)
        ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
        ->get();

        return ['permisos' => $permission];

    }

        public function asignar_permisos(Request $request)
    {
      
      // die('<pre>'. print_r($request->rol_id, 1));
       $role = Role::where('id', '=', (int)$request->rol_id)->firstOrfail();  
       foreach ($request->permisos as $permiso) {
        
           $permission_role = PermissionRole::firstOrNew([
                'permission_id' => $permiso['id'],
                'role_id' => $request->rol_id,
            ]);
           $permission_role->permission_id = $permiso['id'];
           $permission_role->role_id = $request->rol_id;
           $permission_role->save();           
              
       }
    }

    public function quitar_permiso(Request $request)
    {
        
     
        $permissions = PermissionRole::where('permission_role.role_id', '=', (int)$request->rol_id)->where('permission_role.permission_id', '=', (int)$request->permiso['id'])->delete();  


    }



	public function EliminarRol(Request $request)
    {
		try{
			Role::whereId($request->id)->delete();
			return response()->json('eliminado');
		} catch (\Exception $ex) {
            throw $ex;
        }
    }
}
