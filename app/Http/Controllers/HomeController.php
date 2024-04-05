<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Programa;
use App\FichaComunidad;
use App\Disciplinas;
use App\User;
use App\Institucion;
use App\Sede;
use App\FichaDeporvida;
use App\FichaPrograma;
use App\Meta;
use App\Escenario;
use App\Role;
use DateTime;
use Response;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function show()
    {
        return view('vuejs.plantilla');
    }

    public function __construct()
    {

     /*    $this->middleware('permission:version_compare(version1, version2)-usuario', ['only' => 'index']);
*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function vista(){
        return view("postsider.appsider");
    }


    public function graficos()
    {
        return view("graficos");
    }

   public function index()
    {

        $programas = Programa::all();
        return view("welcome", compact('programas'));
    }


    public function ObtenerProgramas()
    {

        $programas = Programa::whereIn("id",array(1,3,8,9,10,11,13,15,16,17))->get();
        return response()->json($programas->toArray());
    }

    public function DescripcionPrograma($id)
    {
   
        $descripcion = Programa::select('programas.id','programas.nombre_programa','programas.descripcion_programa','programas.image')->where('programas.id','=', $id)->firstOrfail();
        return response()->json($descripcion->toArray());


    }
    public function TotalEscenarios()
    {
        $data = Escenario::select(DB::raw('count(*) as total'))->first();
        return response()->json($data->total);
    }        

    public function TotalDisciplinas()
    {

        $data = Disciplinas::select(DB::raw('count(*) as total'))->first();
        return response()->json($data->total);
    }        

    public function TotalProgramas()
    {

        $data = Programa::select(DB::raw('count(*) as total'))->first();
        return response()->json($data->total);
    }       
    private function TotalBeneficiariosDeporvida()
    {
        $data=DB::select('SELECT 
                COUNT(`tbl_dv_ficha`.`id_persona_beneficiario`)as total
            FROM
                `tbl_dv_ficha`
            LEFT JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
            WHERE
                `tbl_dv_ficha`.`vinculado` = 1 AND `tbl_dv_grupos`.`activo` = 1');
        return isset($data[0])?$data[0]->total:0; 
    }
    public function TotalProgramasBeneficiarios()
    {
           // DB::raw('count(DISTINCT id_persona_beneficiario) as total')
        $TotalDeporvida = $this->TotalBeneficiariosDeporvida();
        $masRecreo = FichaComunidad::select(
            DB::raw('count(*) as total')
        )->join(
            'tbl_pr_grupos',
            'tbl_pr_grupos.id', '=', 'tbl_cm_ficha.grupo_id')
        ->where('tbl_cm_ficha.tenantId', '=', '2767829213')->first();
        $caliIncluye = FichaPrograma::select(
            DB::raw('count(*) as total')
        )->join(
            'tbl_pr_grupos',
            'tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
        ->where('tbl_pr_ficha.tenantId', '=', '3651901612')->first();
        $inCali = FichaPrograma::select(
            DB::raw('count(*) as total')
        )->join(
            'tbl_pr_grupos',
            'tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
        ->where('tbl_pr_ficha.tenantId', '=', '7233109821')->first();
        $masVitales = FichaPrograma::select(
            DB::raw('count(*) as total')
        )->join(
            'tbl_pr_grupos',
            'tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
        ->where('tbl_pr_ficha.tenantId', '=', '1240916273')->first();       
        $rutasVida = FichaPrograma::select(
            DB::raw('count(*) as total')
        )->join(
            'tbl_pr_grupos',
            'tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
        ->where('tbl_pr_ficha.tenantId', '=', '2871155601')->first();
        $calieEnForma = FichaPrograma::select(
            DB::raw('count(*) as total')
        )->join(
            'tbl_pr_grupos',
            'tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
        ->where('tbl_pr_ficha.tenantId', '=', '8762109662')      
        ->first();
        $teamCali = FichaPrograma::select(
            DB::raw('count(*) as total')
        )->join(
            'tbl_pr_grupos',
            'tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
        ->where('tbl_pr_ficha.tenantId', '=', '4432891188')->first();
        $caliJuega = FichaPrograma::select(
            DB::raw('count(*) as total')
        )->join(
            'tbl_pr_grupos',
            'tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
        ->where('tbl_pr_ficha.tenantId', '=', '7765533102')->first();
        $cicloVida = FichaPrograma::select(
            DB::raw('count(*) as total')
        )->join(
            'tbl_pr_grupos',
            'tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
        ->where('tbl_pr_ficha.tenantId', '=', '1177624100')->first();

        $masRecreo = ($masRecreo)->total;
        $caliIncluye = ($caliIncluye)->total;
        $inCali = ($inCali)->total;
        $masVitales = ($masVitales)->total;
        $rutasVida = ($rutasVida)->total;
        $calieEnForma = ($calieEnForma)->total;
        $teamCali = ($teamCali)->total;
        $cicloVida = ($cicloVida)->total;
        $caliJuega = ($caliJuega)->total;

        return  Response::json(array(
             'TotalDeporvida'=>$TotalDeporvida
            ,'TotalDeporteEscolar'=>$masRecreo
            , 'TotalCaliAcoge'=>$caliIncluye
            , 'TotalCaliIntegra'=>$inCali
            , 'TotalCanasyGanas'=>$masVitales
            , 'TotalCarrerasyCamintas'=>$rutasVida
            , 'TotalCuerpoyEspiritu'=>$calieEnForma
            , 'TotalDeporteAsociado'=>$teamCali
            , 'TotalViactiva'=>$cicloVida
            , 'TotalViveelParque'=>$caliJuega

    ));

    }        
    private function totalComuna($id_comuna)
    {
        $sql='SELECT 
                ((select count(`tbl_cm_ficha`.`id`) from `tbl_cm_ficha` where `comuna_id` = ?)
                +
                (select count(`tbl_dv_ficha`.`id`) from `tbl_dv_ficha` inner join `tbl_dv_grupos` on `tbl_dv_grupos`.`id` = `tbl_dv_ficha`.`id_grupo` where `tbl_dv_grupos`.`id_comuna_impacto` = ?)
                +
                (select count(`tbl_pr_ficha`.`id`) from `tbl_pr_ficha` where `comuna_id` = ?)
                ) AS total';
        $data=DB::select($sql,[$id_comuna,$id_comuna,$id_comuna]);
        return $data[0]->total;
    }
    public function TotalComunasBeneficiarios()
    {
        $TotalCorregimientosDeporvida = FichaDeporvida::join('tbl_gen_persona', 'tbl_gen_persona.id', 'tbl_dv_ficha.id_persona_beneficiario')->select(DB::raw('count(*) as total'))
        ->where('tbl_gen_persona.id_residencia_corregimiento', '=', '1')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '2')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '3')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '4')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '5')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '6')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '7')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '8')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '9')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '10')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '11')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '12')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '13')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '14')
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', '15')
        ->first();
        
        $beneficiariosCorregimientosComunidad = FichaComunidad::join('tbl_gen_persona', 'tbl_gen_persona.id', 'tbl_cm_ficha.id_persona_beneficiario')->select(DB::raw('count(*) as total'))
        ->where('tbl_gen_persona.id_residencia_corregimiento', '=', 1)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 2)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 3)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 4)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 5)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 6)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 7)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 8)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 9)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 10)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 11)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 12)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 13)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 14)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 15)
        ->first();

        $beneficiariosCorregimientosProgramas = FichaPrograma::join('tbl_gen_persona', 'tbl_gen_persona.id', 'tbl_pr_ficha.id_persona_beneficiario')
        ->select(DB::raw('count(*) as total'))
        ->where('tbl_gen_persona.id_residencia_corregimiento', '=', 1)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 2)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 3)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 4)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 5)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 6)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 7)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 8)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 9)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 10)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 11)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 12)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 13)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 14)
        ->orwhere('tbl_gen_persona.id_residencia_corregimiento', '=', 15)
        ->first();        

        $TotalCorregimientosComunidad   = $beneficiariosCorregimientosComunidad->total;
        $TotalCorregimientosDeporvida   = $TotalCorregimientosDeporvida->total;
        $TotalCorregimientosProgramas   = $beneficiariosCorregimientosProgramas->total ;
        $TotalCorregimientos            = $TotalCorregimientosDeporvida + $TotalCorregimientosComunidad + $TotalCorregimientosProgramas;
        return  Response::json(array(
            'totalComuna1'          => $this->totalComuna(1),
            'totalComuna2'          => $this->totalComuna(2),
            'totalComuna3'          => $this->totalComuna(3),
            'totalComuna4'          => $this->totalComuna(4),
            'totalComuna5'          => $this->totalComuna(5),
            'totalComuna6'          => $this->totalComuna(6),
            'totalComuna7'          => $this->totalComuna(7),
            'totalComuna8'          => $this->totalComuna(8),
            'totalComuna9'          => $this->totalComuna(9),
            'totalComuna10'         => $this->totalComuna(10),
            'totalComuna11'         => $this->totalComuna(11),
            'totalComuna12'         => $this->totalComuna(12),
            'totalComuna13'         => $this->totalComuna(13),
            'totalComuna14'         => $this->totalComuna(14),
            'totalComuna15'         => $this->totalComuna(15),
            'totalComuna16'         => $this->totalComuna(16),
            'totalComuna17'         => $this->totalComuna(17),
            'totalComuna18'         => $this->totalComuna(18),
            'totalComuna19'         => $this->totalComuna(19),
            'totalComuna20'         => $this->totalComuna(20),
            'totalComuna21'         => $this->totalComuna(21),
            'totalComuna22'         => $this->totalComuna(22),
            'TotalCorregimientos'   => $TotalCorregimientos,
        ));

    }        

    public function TotalUsuarios()
    {
        $usuarios = User::
        select(DB::raw('count(*) as total'))
        ->where('users.tenantId', '=', 5467829281)
        ->first();
        return response()->json($usuarios->total);
    }

    public function TotalColegios()
    {

        $colegios = Institucion::select(DB::raw('count(*) as total'))->first();
        return response()->json($colegios->total);
    }     

    public function TotalSedes()
    {

        $sedes = DB::table('sedes')->count();
        return response()->json($sedes);
    }  


    public function TotalBeneficiarios()
    {   
        $total = DB::select('
            SELECT
            (

                (SELECT COUNT(DISTINCT `tbl_cm_ficha`.`id_persona_beneficiario`)as total
                FROM `tbl_cm_ficha`)
                +
                (SELECT COUNT(DISTINCT `tbl_pr_ficha`.`id_persona_beneficiario`)as total
                FROM `tbl_pr_ficha`)
                +
                (SELECT COUNT(DISTINCT `tbl_dv_ficha`.`id_persona_beneficiario`)as total
                FROM `tbl_dv_ficha`
                INNER JOIN `tbl_dv_grupos` ON (`tbl_dv_ficha`.`id_grupo` = `tbl_dv_grupos`.`id`)
                WHERE `tbl_dv_ficha`.`vinculado` = 1 AND `tbl_dv_grupos`.`activo` = 1)
            ) as total');
        return response()->json($total[0]->total);
    }  

    public function ObtenerMetasPrograma($programa)
    {

        $metas = Meta::select('id','nombre_meta', 'periodo')->where('programa_id', '=', $programa)->get();
        return response()->json(
            $metas
        );

    }

    public function importar()
    {
        return view('importar');
    }

    public function importUsers(Request $request)
{


ini_set('memory_limit', '-1');
    \Excel::load($request->excel, function($reader) {

        $excel = $reader->get();

            $reader->each(function($row) {

            $user = FichaPrograma::firstOrNew([
            'id' => $row->id,
            ]);
            $user->id_persona_beneficiario = $row->id_persona_beneficiario;
            $user->grupo_id = $row->grupo_id;
            $user->fecha_inscripcion = $row->fecha_inscripcion;
            $user->no_ficha = $row->no_ficha;
            $user->hijos_beneficiario = $row->hijos_beneficiario;
            $user->cantidad_hijos_beneficiario = $row->cantidad_hijos_beneficiario;
            $user->ocupacion_beneficiario = $row->ocupacion_beneficiario;
            $user->escolaridad_id = $row->escolaridad_id;
            $user->estado_escolaridad = $row->estado_escolaridad;
            $user->cultura_beneficiario = $row->cultura_beneficiario;
            $user->discapacidad_beneficiario = $row->discapacidad_beneficiario;
            $user->otra_discapacidad_beneficiario = $row->otra_discapacidad_beneficiario;
            $user->medicamentos_permanente_beneficiario = $row->medicamentos_permanente_beneficiario;
            $user->medicamentos_beneficiario = $row->medicamentos_beneficiario;
            $user->condicion_discapacidad = $row->condicion_discapacidad;
            $user->afiliacion_salud = $row->afiliacion_salud;
            $user->tipo_afiliacion = $row->tipo_afiliacion;
            $user->salud_sgss_id = $row->salud_sgss_id;
            $user->id_persona_acudiente = $row->id_persona_acudiente;
            $user->parentesco_acudiente = $row->parentesco_acudiente;
            $user->otro_parentesco_acudiente = $row->otro_parentesco_acudiente;
            $user->fecha_retiro = $row->fecha_retiro;
            $user->otro_poblacional = $row->otro_poblacional;
            $user->tenantId = '1240916273';
            $user->comuna_id = $row->comuna_id;
            $user->created_at = $row->created_at;
            $user->updated_at = $row->updated_at;
            $user->save();

        });
    
    });

    return "Terminado";
}

}
