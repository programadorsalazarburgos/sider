<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Beneficiario;
use App\User;
use App\Asistencia;
use App\ProgramaHorario;
use App\HorarioGrupo;
use Excel;
use DB;
use response;
use Carbon\Carbon;
//Sidercali 2019

class ItemController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('items');
   }



   public function export2(Request $request){


$asistencias = DB::table('tbl_cm_ficha')
    ->select(

         'tbl_gen_persona.nombre_primero',
         'tbl_gen_persona.apellido_primero',
         'tbl_cm_ficha.fecha_inscripcion',
         'tbl_cm_ficha.no_ficha',
         'grupos.id as grupo_beneficiario',
         'grupos.codigo_grupo',
         'grupos.observaciones',
         'tbl_gen_asistencias.fecha_asistencia',


    DB::raw('SUM(tbl_gen_asistencias.`asistencia`) as asistencia, (- SUM(tbl_gen_asistencias.`asistencia`) + COUNT(tbl_gen_asistencias.`id`)) as inasistencias, COUNT(tbl_gen_asistencias.`id`) as total'))
    ->join('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
    ->join('tbl_gen_asistencias', 'tbl_cm_ficha.id', '=', 'tbl_gen_asistencias.ficha_id')

  ->leftJoin('grupos','grupos.id', '=', 'tbl_cm_ficha.grupo_id')


    ->groupBy('tbl_gen_persona.nombre_primero', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_cm_ficha.fecha_inscripcion', 'tbl_cm_ficha.no_ficha', 'grupo_beneficiario', 'user_id', 'codigo_grupo', 'grupos.observaciones', 'tbl_gen_asistencias.fecha_asistencia')->where('grupos.user_id', '=', Auth::id())->where('tbl_cm_ficha.grupo_id', '=', $request->grupo)->where('tbl_gen_asistencias.fecha_asistencia', 'like', '%' . $request->fechaExport . '%')
      ->where('grupos.estado', '=', 0)
      ->get();



$items= json_decode( json_encode($asistencias), true);

Excel::create('items', function($excel) use($items) {
  $excel->sheet('ExportFile', function($sheet) use($items) {
      $sheet->fromArray($items);
  });
})->export('xls');

}

public function asistenciaprogramas(Request $request){

  $fecha = explode("-",$request->fechaExport);
  $date_y = $fecha[0];
  $date_m = $fecha[1];

  // exit();
  $asistencias = DB::table('tbl_pr_ficha')
  ->select(

     'tbl_pr_grupos.nombre_grupo',
     'tbl_pr_asistencias.fecha_asistencia',
     'tbl_gen_persona.nombre_primero as nombre_beneficiario',
     'tbl_gen_persona.apellido_primero as apellido_beneficiario',
     'tbl_pr_asistencias.observaciones',

    DB::raw('SUM(tbl_pr_asistencias.`asistencia`) as asistencia, (- SUM(tbl_pr_asistencias.`asistencia`) + COUNT(tbl_pr_asistencias.`id`)) as inasistencias, COUNT(tbl_pr_asistencias.`id`) as total'))
      ->join('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')
      ->join('tbl_pr_asistencias', 'tbl_pr_ficha.id', '=', 'tbl_pr_asistencias.ficha_id')
      ->leftJoin('tbl_pr_grupos','tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
    ->groupBy('tbl_gen_persona.nombre_primero', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_pr_ficha.fecha_inscripcion', 'tbl_pr_ficha.no_ficha', 'user_id', 'nombre_grupo', 'tbl_pr_grupos.observaciones', 'tbl_pr_asistencias.fecha_asistencia')->where('tbl_pr_grupos.user_id', '=', Auth::id())->where('tbl_pr_ficha.grupo_id', '=', $request->grupo)
    ->whereYear('tbl_pr_asistencias.fecha_asistencia', $date_y)
    ->whereMonth('tbl_pr_asistencias.fecha_asistencia', $date_m)
    ->get();


    $items= json_decode( json_encode($asistencias), true);

    Excel::create('items', function($excel) use($items) {
      $excel->sheet('ExportFile', function($sheet) use($items) {
          $sheet->fromArray($items);
      });
    })->export('xls');
  }

public function asistenciaprogramas_all(Request $request){


  $asistencias = DB::table('tbl_pr_ficha')
  ->select(

     'tbl_gen_persona.nombre_primero',
     'tbl_gen_persona.apellido_primero',
     'tbl_pr_ficha.fecha_inscripcion',
     'tbl_pr_ficha.no_ficha',
     'tbl_pr_grupos.id as grupo_beneficiario',
     'tbl_pr_grupos.nombre_grupo',
     'tbl_pr_grupos.observaciones',
     'tbl_pr_asistencias.fecha_asistencia',

    DB::raw('SUM(tbl_pr_asistencias.`asistencia`) as asistencia, (- SUM(tbl_pr_asistencias.`asistencia`) + COUNT(tbl_pr_asistencias.`id`)) as inasistencias, COUNT(tbl_pr_asistencias.`id`) as total'))
      ->join('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')
      ->join('tbl_pr_asistencias', 'tbl_pr_ficha.id', '=', 'tbl_pr_asistencias.ficha_id')
      ->leftJoin('tbl_pr_grupos','tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
    ->groupBy('tbl_gen_persona.nombre_primero', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_pr_ficha.fecha_inscripcion', 'tbl_pr_ficha.no_ficha', 'grupo_beneficiario', 'user_id', 'nombre_grupo', 'tbl_pr_grupos.observaciones', 'tbl_pr_asistencias.fecha_asistencia')->where('tbl_pr_ficha.grupo_id', '=', $request->grupo)->where('tbl_pr_asistencias.fecha_asistencia', 'like', '%' . $request->fechaExport . '%')
    ->get();

    $items= json_decode( json_encode($asistencias), true);

    Excel::create('items', function($excel) use($items) {
      $excel->sheet('ExportFile', function($sheet) use($items) {
          $sheet->fromArray($items);
      });
    })->export('xls');
  }


public function export(Request $request)
    {

    $data = DB::table('tbl_cm_ficha')
    ->leftjoin(
      'tbl_gen_persona',
      'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')

      ->leftjoin(
      'tbl_gen_persona as acudiente_persona',
      'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
      ->leftjoin(
      'poblacional_beneficiarios',
    'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

    ->leftjoin(
    'tbl_cm_persona_x_discapacidad',
    'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

    ->leftjoin(
    'grupos',
    'grupos.id', '=', 'tbl_cm_ficha.grupo_id')


    ->leftjoin(
    'sedes',
    'sedes.id', '=', 'grupos.sede_id')

    ->leftjoin(
    'instituciones',
    'instituciones.id', '=', 'sedes.institucion_id')

    ->leftjoin(
    'tbl_cm_grados',
    'tbl_cm_grados.id', '=', 'grupos.grado_id')

    ->leftjoin(
    'comunas',
    'comunas.id', '=', 'tbl_cm_ficha.comuna_id')

    ->leftjoin(
    'users',
    'users.id', '=', 'grupos.user_id')

    ->leftjoin(
    'tbl_cm_grupo_poblacional',
    'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

    ->leftjoin(
      'tbl_gen_discapacidad',
      'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

    ->leftjoin(
    'paises',
    'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

    ->leftjoin(
      'departamentos',
    'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

    ->leftjoin(
      'municipios',
    'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')


    ->leftjoin(
      'barrios',
    'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

    ->leftjoin(
      'tbl_gen_corregimientos',
    'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
    ->leftjoin(
      'tbl_gen_veredas',
    'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
    ->leftjoin(
      'tbl_gen_estado_civil',
    'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
    ->leftjoin(
      'tbl_gen_escolaridad_nivel',
    'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
    ->leftjoin(
      'tbl_gen_documento_tipo',
    'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
    ->leftjoin(
      'tbl_gen_documento_tipo as tipo_documento_acudiente',
    'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')

    ->leftjoin(
      'tbl_gen_eps',
    'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')

    ->leftjoin(
      'tbl_gen_etnia',
      'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
    'tbl_gen_escolaridad_estado',
    'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

    ->leftjoin(
    'tbl_gen_ocupacion',
    'tbl_gen_ocupacion.id', '=', 'tbl_cm_ficha.ocupacion_beneficiario')

    ->leftjoin(
      'tbl_gen_salud_regimen',
      'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

      ->select(DB::raw(
      "
      instituciones.nombre_institucion,
      sedes.nombre_sede,
      grupos.codigo_grupo,
      tbl_cm_grados.nombre_grado,
      tbl_gen_documento_tipo.descripcion as tipo_documento,
      tbl_gen_persona.documento,
      tbl_cm_ficha.no_ficha,
      tbl_cm_ficha.fecha_inscripcion,
      tbl_gen_persona.nombre_primero,
      tbl_gen_persona.nombre_segundo,
      tbl_gen_persona.apellido_primero,
      tbl_gen_persona.apellido_segundo,
      tbl_gen_persona.correo_electronico,
      (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
      tbl_gen_persona.fecha_nacimiento,
      TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) AS edad_persona,
      paises.nombre_pais,
      departamentos.nombre_departamento,
      municipios.nombre_municipio,
      tbl_gen_corregimientos.descripcion as nombre_corregimiento,
      tbl_gen_veredas.nombre as nombre_vereda,
      barrios.nombre_barrio,
      tbl_gen_persona.residencia_estrato,
      comunas.nombre_comuna,
      tbl_gen_persona.residencia_direccion,
      tbl_gen_persona.telefono_fijo,
      tbl_gen_persona.telefono_movil,
      tbl_gen_escolaridad_nivel.descripcion as nivel_escolaridad,
      tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
      `tbl_gen_ocupacion`.`descripcion` as ocupacion_beneficiario,
      tbl_gen_estado_civil.descripcion as estado_civil,
      (CASE WHEN (tbl_cm_ficha.hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
      tbl_cm_ficha.cantidad_hijos_beneficiario,
      tbl_gen_etnia.descripcion as etnia_beneficiario,
      group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
      (CASE WHEN (tbl_cm_ficha.discapacidad_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as enfermedad_permanente,
      `tbl_cm_ficha`.`otra_discapacidad_beneficiario`,
      (CASE WHEN (tbl_cm_ficha.medicamentos_permanente_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as toma_medicamentos,
      `tbl_cm_ficha`.`medicamentos_beneficiario`,
      `tbl_gen_persona`.`sangre_tipo`,
      group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
      (CASE WHEN (tbl_cm_ficha.afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as afiliacion_salud,
      `tbl_gen_salud_regimen`.`descripcion` as tipo_afiliacion,
      `tbl_gen_eps`.`descripcion` as nombre_eps,
      tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
      acudiente_persona.documento as documento_acudiente,
      acudiente_persona.nombre_primero as primer_nombre_acudiente,
      acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
      acudiente_persona.apellido_primero as primer_apellido_acudiente,
      acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
      acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
      acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
      acudiente_persona.telefono_movil as telefono_movil_acudiente,
      acudiente_persona.correo_electronico as correo_acudiente,
      (CASE WHEN (tbl_cm_ficha.parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (tbl_cm_ficha.parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (tbl_cm_ficha.parentesco_acudiente = 3) THEN 'Tia/Tio' WHEN (tbl_cm_ficha.parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (tbl_cm_ficha.parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
      tbl_cm_ficha.otro_parentesco_acudiente,
      users.primer_nombre as primer_nombre_usuario,
      users.primer_apellido as primer_apellido_usuario


      "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->where('grupos.user_id', '=', Auth::id())->orderBy('grupos.codigo_grupo', 'asc')->groupBy('tbl_cm_ficha.id')->get();


  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}

   public function exportjsb(Request $request){


   $data = DB::select('select tbl_cm_ficha.id, grupos.codigo_grupo, tbl_gen_persona.nombre_primero, tbl_gen_persona.nombre_segundo, tbl_gen_persona.apellido_primero, tbl_gen_persona.apellido_segundo, tbl_gen_documento_tipo.descripcion as tipo_documento, tbl_gen_persona.documento, (CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "Hombre" END) as sexo, tbl_gen_persona.fecha_nacimiento, tbl_gen_persona.telefono_fijo, tbl_gen_persona.telefono_movil, tbl_gen_persona.correo_electronico, paises.nombre_pais, departamentos.nombre_departamento, municipios.nombre_municipio, tbl_gen_corregimientos.descripcion, barrios.nombre_barrio, tbl_gen_persona.residencia_direccion, tbl_gen_persona.residencia_estrato, tbl_gen_persona.sangre_tipo, tbl_gen_estado_civil.descripcion, grupos.codigo_grupo, tbl_cm_ficha.fecha_inscripcion, tbl_cm_ficha.no_ficha, tbl_cm_ficha.modalidad, tbl_cm_ficha.punto_atencion, tbl_cm_ficha.hijos_beneficiario, tbl_cm_ficha.cantidad_hijos_beneficiario, group_concat(tbl_cm_grupo_poblacional.nombre) as grupo_poblacional, (CASE WHEN (ocupacion_beneficiario = 1) THEN "Ama de casa" WHEN (ocupacion_beneficiario = 2) THEN "Empleado" WHEN (ocupacion_beneficiario = 3) THEN "Estudiante" WHEN (ocupacion_beneficiario = 4) THEN "Desempleado" WHEN (ocupacion_beneficiario = 5) THEN "Independiente" WHEN (ocupacion_beneficiario = 6) THEN "Pensionado-Jubilado" WHEN (ocupacion_beneficiario = 7) THEN "Servidor Público" ELSE "Otro" END) as Ocupacion,  tbl_gen_escolaridad_nivel.descripcion, (CASE WHEN (cultura_beneficiario = 1) THEN "Negro" WHEN (cultura_beneficiario = 2) THEN "Blanco" WHEN (cultura_beneficiario = 3) THEN "Índigena" WHEN (cultura_beneficiario = 4) THEN "Mestizo" WHEN (cultura_beneficiario = 5) THEN "Mulato" WHEN (cultura_beneficiario = 6) THEN "ROM, Gitano" WHEN (cultura_beneficiario = 7) THEN "Palenquero" WHEN (cultura_beneficiario = 8) THEN "Raizal" WHEN (cultura_beneficiario = 9) THEN "No sabe-No responde" ELSE "Otro" END) as Cultura,  (CASE WHEN (discapacidad_beneficiario = 1) THEN "Si" ELSE "No" END) as Discapacidad, tbl_gen_discapacidad.descripcion as nombre_dicapacidad, otra_discapacidad_beneficiario, (CASE WHEN (enfermedad_permanente_beneficiario = 1) THEN "Si" ELSE "No" END) as Enfermedad_Permanente,  (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN "Si" ELSE "No" END) as Medicamento_Permanente, medicamentos_beneficiario, (CASE WHEN (seguridad_social_beneficiario = 1) THEN "Si" ELSE "No" END) as Seguridad_Social, tbl_gen_eps.descripcion as nombre_eps, acudiente_persona.nombre_primero as primer_nombre_acudiente, acudiente_persona.nombre_segundo as segundo_nombre_acudiente, acudiente_persona.apellido_primero as primer_apellido_acudiente, acudiente_persona.apellido_segundo as segundo_apellido_acudiente, tipo_documento_acudiente.descripcion as tipo_documento_acudiente, acudiente_persona.documento as documento_acudiente, (CASE WHEN (acudiente_persona.sexo = 1) THEN "Mujer" WHEN (acudiente_persona.sexo = 2) THEN "Hombre" ELSE "Mujer" END) as sexo_acudiente, acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente, acudiente_persona.telefono_fijo as telefono_fijo_acudiente, acudiente_persona.telefono_movil as telefono_movil_acudiente, acudiente_persona.correo_electronico as correo_acudiente, (CASE WHEN (parentesco_acudiente = 1) THEN "Madre/Padre" WHEN (parentesco_acudiente = 2) THEN "Hermana/Hermano" WHEN (cultura_beneficiario = 3) THEN "Tia/Tio" WHEN (parentesco_acudiente = 4) THEN "Abuela/Abuelo" WHEN (parentesco_acudiente = 5) THEN "Cuidador" ELSE "Otro" END) as parentesco_acudiente, tbl_cm_ficha.otro_parentesco_acudiente, users.primer_nombre as primer_nombre_usuario, users.primer_apellido as primer_apellido_usuario, SUM(tbl_gen_asistencias.`asistencia`) as asistencia, (- SUM(tbl_gen_asistencias.`asistencia`) + COUNT(tbl_gen_asistencias.`id`)) as inasistencias, COUNT(tbl_gen_asistencias.`id`) as total from `tbl_cm_ficha` inner join `tbl_gen_persona` on `tbl_gen_persona`.`id` = `tbl_cm_ficha`.`id_persona_beneficiario` inner join `tbl_gen_persona` as `acudiente_persona` on `acudiente_persona`.`id` = `tbl_cm_ficha`.`id_persona_acudiente` inner join `poblacional_beneficiarios` on `tbl_cm_ficha`.`id` = `poblacional_beneficiarios`.`ficha_id` left join `grupos` on `grupos`.`id` = `tbl_cm_ficha`.`grupo_id` left join `users` on `users`.`id` = `grupos`.`user_id`  left join `tbl_gen_asistencias` on `tbl_cm_ficha`.`id` = `tbl_gen_asistencias`.`ficha_id`
   left join `tbl_cm_grupo_poblacional` on `tbl_cm_grupo_poblacional`.`id` = `poblacional_beneficiarios`.`grupo_pcs` inner join `paises` on `paises`.`id` = `tbl_gen_persona`.`id_procedencia_pais` inner join `departamentos` on `departamentos`.`id` = `tbl_gen_persona`.`id_procedencia_departamento` inner join `municipios` on `municipios`.`id` = `tbl_gen_persona`.`id_procedencia_municipio` inner join `barrios` on `barrios`.`id` = `tbl_gen_persona`.`id_residencia_barrio` inner join `comunas` on `comunas`.`id` = `barrios`.`comuna_id` inner join `tbl_gen_corregimientos` on `tbl_gen_corregimientos`.`id` = `tbl_gen_persona`.`id_residencia_corregimiento` inner join `tbl_gen_veredas` on `tbl_gen_veredas`.`id` = `tbl_gen_persona`.`id_residencia_vereda` inner join `tbl_gen_estado_civil` on `tbl_gen_estado_civil`.`id` = `tbl_gen_persona`.`id_estado_civil` inner join `tbl_gen_escolaridad_nivel` on `tbl_gen_escolaridad_nivel`.`id` = `tbl_cm_ficha`.`escolaridad_id` inner join `tbl_gen_documento_tipo` on `tbl_gen_documento_tipo`.`id` = `tbl_gen_persona`.`id_documento_tipo` inner join `tbl_gen_documento_tipo` as `tipo_documento_acudiente` on `tipo_documento_acudiente`.`id` = `tbl_gen_persona`.`id_documento_tipo` left join `tbl_gen_discapacidad` on `tbl_gen_discapacidad`.`id` = `tbl_cm_ficha`.`discapacidad_id` left join `tbl_gen_eps` on `tbl_gen_eps`.`id` = `tbl_cm_ficha`.`salud_sgss_id` group by `tbl_cm_ficha`.`id`');




$items= json_decode( json_encode($data), true);
Excel::create('items', function($excel) use($items) {
  $excel->sheet('ExportFile', function($sheet) use($items) {
      $sheet->fromArray($items);
  });
})->export('xls');




}

public function exportAsistencias()
{
  $data = DB::table('tbl_cm_ficha')
  ->select(

       'tbl_gen_persona.id as persona',
       'tbl_gen_persona.documento',
       'tbl_gen_persona.nombre_primero as label',
       'tbl_cm_ficha.id',
       'tbl_gen_persona.nombre_primero',
       'tbl_gen_persona.apellido_primero',
       'tbl_cm_ficha.fecha_inscripcion',
       'tbl_cm_ficha.no_ficha',
       'grupos.id as grupo_beneficiario',
       'grupos.user_id',
       'grupos.codigo_grupo',
       'grupos.observaciones',
       'grupos.estado',
       'grupos.created_at as fecha_creacion_grupo',
       'instituciones.nombre_institucion',
       'sedes.nombre_sede',
       'users.primer_nombre',
       'users.primer_apellido',



  DB::raw('SUM(tbl_gen_asistencias.`asistencia`) as asistencia, (- SUM(tbl_gen_asistencias.`asistencia`) + COUNT(tbl_gen_asistencias.`id`)) as inasistencias, COUNT(tbl_gen_asistencias.`id`) as total'))
  ->leftJoin('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
  ->leftJoin('tbl_gen_asistencias', 'tbl_cm_ficha.id', '=', 'tbl_gen_asistencias.ficha_id')
->join('grupos','grupos.id', '=', 'tbl_cm_ficha.grupo_id')
->leftJoin('sedes','sedes.id', '=', 'grupos.sede_id')
->leftJoin('instituciones','instituciones.id', '=', 'sedes.institucion_id')
->leftJoin('users','users.id', '=', 'grupos.user_id')


  ->groupBy('tbl_gen_persona.nombre_primero', 'persona', 'tbl_cm_ficha.id', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_cm_ficha.fecha_inscripcion', 'tbl_cm_ficha.no_ficha', 'grupo_beneficiario', 'user_id', 'codigo_grupo', 'grupos.observaciones')->get();

  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


public function exportAsistenciasProgramas()
{
  $data = DB::table('tbl_pr_ficha')
  ->select(

       'tbl_gen_persona.id as persona',
       'tbl_gen_persona.documento',
       'tbl_gen_persona.nombre_primero as label',
       'tbl_pr_ficha.id',
       'tbl_gen_persona.nombre_primero',
       'tbl_gen_persona.apellido_primero',
       'tbl_pr_ficha.fecha_inscripcion',
       'tbl_pr_ficha.no_ficha',
       'tbl_pr_grupos.id as grupo_beneficiario',
       'tbl_pr_grupos.user_id',
       'tbl_pr_grupos.nombre_grupo',
       'tbl_pr_grupos.observaciones',
       'tbl_pr_grupos.estado',
       'tbl_pr_grupos.created_at as fecha_creacion_grupo',
       'tbl_pr_lugares.nombre_lugar',
       'tbl_pr_disciplinas.nombre_disciplina',
       'users.primer_nombre',
       'users.primer_apellido',



  DB::raw('SUM(tbl_pr_asistencias.`asistencia`) as asistencia, (- SUM(tbl_pr_asistencias.`asistencia`) + COUNT(tbl_pr_asistencias.`id`)) as inasistencias, COUNT(tbl_pr_asistencias.`id`) as total'))
  ->leftJoin('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_pr_ficha.id_persona_beneficiario')
  ->leftJoin('tbl_pr_asistencias', 'tbl_pr_ficha.id', '=', 'tbl_pr_asistencias.ficha_id')
->join('tbl_pr_grupos','tbl_pr_grupos.id', '=', 'tbl_pr_ficha.grupo_id')
->leftJoin('tbl_pr_lugares','tbl_pr_lugares.id', '=', 'tbl_pr_grupos.lugar_id')
->leftJoin('tbl_pr_disciplinas','tbl_pr_disciplinas.id', '=', 'tbl_pr_grupos.disciplina_id')
->leftJoin('users','users.id', '=', 'tbl_pr_grupos.user_id')


  ->groupBy('tbl_gen_persona.nombre_primero', 'persona', 'tbl_pr_ficha.id', 'tbl_gen_persona.nombre_primero', 'tbl_gen_persona.apellido_primero', 'tbl_pr_ficha.fecha_inscripcion', 'tbl_pr_ficha.no_ficha', 'grupo_beneficiario', 'user_id', 'nombre_grupo', 'tbl_pr_grupos.observaciones')->get();

  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


   public function ExportMisBeneficiarios($no_grupo){


    $data = DB::table('tbl_cm_ficha')->join(
    'tbl_gen_persona',
    'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
    ->join(
    'tbl_cm_modalidades',
    'tbl_cm_modalidades.id', '=', 'tbl_cm_ficha.modalidad_id')
    ->join(
    'tbl_cm_punto_atencion',
    'tbl_cm_punto_atencion.id', '=', 'tbl_cm_ficha.puntoatencion_id')

      ->join(
    'grupos',
    'grupos.id', '=', 'tbl_cm_ficha.grupo_id')->join(
    'paises',
    'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')->join(
    'departamentos',
    'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')->join(
    'municipios',
    'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')->join(
    'barrios',
    'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')->join(
    'tbl_gen_corregimientos',
    'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')->join(
    'tbl_gen_veredas',
    'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')->join(
    'tbl_gen_estado_civil',
    'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')->join(
    'tbl_gen_escolaridad_nivel',
    'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')->join(
    'tbl_gen_documento_tipo',
    'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
    ->select(DB::raw(
      "
      grupos.codigo_grupo,
      tbl_gen_persona.nombre_primero,
      tbl_gen_persona.nombre_segundo,
      tbl_gen_persona.apellido_primero,
      tbl_gen_persona.apellido_segundo,
      tbl_gen_documento_tipo.descripcion,
      (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
      tbl_gen_persona.fecha_nacimiento,
      tbl_gen_persona.telefono_fijo,
      tbl_gen_persona.telefono_movil,
      tbl_gen_persona.correo_electronico,
      paises.nombre_pais,
      departamentos.nombre_departamento,
      municipios.nombre_municipio,
      tbl_gen_corregimientos.descripcion,
      barrios.nombre_barrio,
      tbl_gen_persona.residencia_direccion,
      tbl_gen_persona.residencia_estrato,
      tbl_gen_persona.sangre_tipo,
      tbl_gen_estado_civil.descripcion,
      grupos.codigo_grupo,
      tbl_cm_ficha.fecha_inscripcion,
      tbl_cm_ficha.no_ficha,
      tbl_cm_modalidades.nombre as modalidad,
      tbl_cm_punto_atencion.nombre as punto_atencion,
      tbl_cm_ficha.hijos_beneficiario,
      tbl_cm_ficha.cantidad_hijos_beneficiario,

      (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
      tbl_gen_escolaridad_nivel.descripcion,
      (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
      (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,

      (CASE WHEN (discapacidad_id = 1) THEN 'Auditiva' WHEN (discapacidad_id = 2) THEN 'Cognitiva' WHEN (discapacidad_id = 3) THEN 'Mental' WHEN (discapacidad_id = 4) THEN 'Motriz' WHEN (discapacidad_id = 5) THEN 'Oral' ELSE 'Visual' END) as Discapacidad_Cual, otra_discapacidad_beneficiario,

      (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,


      (CASE WHEN (salud_sgss_id = 1) THEN 'Regimen Contributivo (EPS)' WHEN (salud_sgss_id = 2) THEN 'Regimen Subsidiado (SISBEN-EPS-S)' ELSE 'Especial (FFMM, Policia, etc)' END) as Nombre_Seguridad_Social
  ")


)->where('tbl_cm_ficha.grupo_id', '=', $no_grupo)->get();




$items= json_decode( json_encode($data), true);
Excel::create('items', function($excel) use($items) {
  $excel->sheet('ExportFile', function($sheet) use($items) {
      $sheet->fromArray($items);
  });
})->export('xls');

}

public function exportar_usuarios()
{
        $usuario = Auth::user()->tenantId;
      $data = DB::select('select
      tbl_gen_persona.nombre_primero,
      tbl_gen_persona.nombre_segundo,
      tbl_gen_persona.apellido_primero,
      tbl_gen_persona.apellido_segundo,
      tbl_gen_documento_tipo.descripcion as tipo_documento,
      FORMAT(tbl_gen_persona.documento, 0, \'de_DE\') as documento,
      (CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "Hombre" END) as sexo,
      tbl_gen_persona.sangre_tipo,
      tbl_gen_persona.fecha_nacimiento,
      tbl_gen_persona.correo_electronico,
      paises.nombre_pais as pais_procedencia,
      departamentos.nombre_departamento as departamento_procedencia,
      municipios.nombre_municipio as municipio_procedencia,
      depresidencias.nombre_departamento as departamento_residencia,
      municresidencias.nombre_municipio as municipio_residencia,
      tbl_gen_persona.id_residencia_vereda as direccion_alterna,
      tbl_gen_corregimientos.descripcion as corregimiento_residencia,
      tbl_gen_veredas.nombre as vereda_residencia,
      barrios.nombre_barrio,
      tbl_gen_persona.residencia_direccion,
      tbl_gen_persona.telefono_fijo,
      tbl_gen_persona.telefono_movil,
      tbl_gen_escolaridad_nivel.descripcion as ultimo_nivel_escolaridad,
      tbl_gen_escolaridad_estado.descripcion as Estado_escolaridad,
      tbl_gen_titulos_academicos.descripcion as Titulo_academico,
      tbl_dv_instituciones_educativas.nombre as Institucion_educativa_superior,
      tbl_gen_ocupacion.descripcion as Ocupacion_actual,
      tbl_gen_estado_civil.descripcion as Estado_civil,
      (CASE WHEN (tbl_cm_empleado.hijos_empleado = 1) THEN "Si"  ELSE "No" END) as hijos_empleado,
      tbl_cm_empleado.cantidad_hijos,
      tbl_gen_etnia.descripcion as se_auto_reconoce_como,
      (CASE WHEN (tbl_cm_empleado.enfermedad_permanente = 1) THEN "Si"  ELSE "No" END) as padece_enfermedad_permanente,
      tbl_cm_empleado.otra_enfermedad,
      (CASE WHEN (tbl_cm_empleado.medicamentos = 1) THEN "Si"  ELSE "No" END) as toma_medicamentos,
      tbl_cm_empleado.otros_medicamentos,
      tbl_gen_persona.sangre_tipo,
      (CASE WHEN (tbl_cm_empleado.condicion_discapacidad = 1) THEN "Si"  ELSE "No" END) as condicion_discapacidad,
      (CASE WHEN (tbl_cm_empleado.afiliacion_salud = 1) THEN "Si"  ELSE "No" END) as afiliacion_salud,
      tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
      tbl_gen_eps.descripcion as entidad_salud_eps,
      tbl_cm_empleado.libreta_militar,
      tbl_cm_empleado.no_libreta,
      tbl_cm_empleado.distrito_militar,
      tbl_cm_empleado.skype_empleado,
      roles.name as rol_usuario
       from tbl_cm_empleado
       left join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_empleado.id_persona
       left join tbl_gen_documento_tipo on tbl_gen_documento_tipo.id = tbl_gen_persona.id_documento_tipo
       left join paises on paises.id = tbl_gen_persona.id_procedencia_pais
       left join departamentos on departamentos.id = tbl_gen_persona.id_procedencia_departamento
       left join municipios on municipios.id = tbl_gen_persona.id_procedencia_municipio
       left join departamentos as depresidencias on depresidencias.id = tbl_gen_persona.departamento_residencia_id
       left join municipios as municresidencias on municresidencias.id = tbl_gen_persona.municipio_residencia_id
       left join tbl_gen_corregimientos on tbl_gen_corregimientos.id = tbl_gen_persona.id_residencia_corregimiento
       left join tbl_gen_veredas on tbl_gen_veredas.id = tbl_gen_persona.id_residencia_vereda
       left join barrios on barrios.id = tbl_gen_persona.id_residencia_barrio
       left join tbl_gen_escolaridad_nivel on tbl_gen_escolaridad_nivel.id = tbl_gen_persona.escolaridad_id
       left join tbl_gen_escolaridad_estado on tbl_gen_escolaridad_estado.id = tbl_gen_persona.estado_escolaridad
       left join tbl_gen_titulos_academicos on tbl_gen_titulos_academicos.id = tbl_cm_empleado.titulo_obtenido
       left join tbl_gen_ocupacion on tbl_gen_ocupacion.id = tbl_cm_empleado.ocupacion_id
       left join tbl_gen_estado_civil on tbl_gen_estado_civil.id = tbl_gen_persona.id_estado_civil
       left join tbl_gen_etnia on tbl_gen_etnia.id = tbl_cm_empleado.etnia_id
       left join tbl_gen_salud_regimen on tbl_gen_salud_regimen.id = tbl_cm_empleado.tipoafiliacion_id
       left join tbl_gen_eps on tbl_gen_eps.id = tbl_cm_empleado.eps_id
       left join tbl_dv_instituciones_educativas on tbl_dv_instituciones_educativas.id = tbl_cm_empleado.universidad_id
       left join users on users.id = tbl_cm_empleado.id_usuario
       inner join role_user on users.id = role_user.user_id
       inner join roles on role_user.role_id  = roles.id

        where users.tenantId =?', [$usuario]);


      $items= json_decode( json_encode($data), true);
      Excel::create('items', function($excel) use($items) {
        $excel->sheet('ExportFile', function($sheet) use($items) {
            $sheet->fromArray($items);
        });
      })->export('xls');

}

    public function ExportUsuarios()
    {

      var_dump(2);
      exit(2);
      $usuario = Auth::user()->tenantId;
      $data = DB::select('select
      tbl_gen_persona.nombre_primero,
      tbl_gen_persona.nombre_segundo,
      tbl_gen_persona.apellido_primero,
      tbl_gen_persona.apellido_segundo,
      tbl_gen_documento_tipo.descripcion as tipo_documento,
      FORMAT(tbl_gen_persona.documento, 0, \'de_DE\') as documento,
      (CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "Hombre" END) as sexo,
      tbl_gen_persona.sangre_tipo,
      tbl_gen_persona.fecha_nacimiento,
      tbl_gen_persona.correo_electronico,
      paises.nombre_pais as pais_procedencia,
      departamentos.nombre_departamento as departamento_procedencia,
      municipios.nombre_municipio as municipio_procedencia,
      depresidencias.nombre_departamento as departamento_residencia,
      municresidencias.nombre_municipio as municipio_residencia,
      tbl_gen_persona.id_residencia_vereda as direccion_alterna,
      tbl_gen_corregimientos.descripcion as corregimiento_residencia,
      tbl_gen_veredas.nombre as vereda_residencia,
      barrios.nombre_barrio,
      tbl_gen_persona.residencia_direccion,
      tbl_gen_persona.telefono_fijo,
      tbl_gen_persona.telefono_movil,
      tbl_gen_escolaridad_nivel.descripcion as ultimo_nivel_escolaridad,
      tbl_gen_escolaridad_estado.descripcion as Estado_escolaridad,
      tbl_gen_titulos_academicos.descripcion as Titulo_academico,
      tbl_dv_instituciones_educativas.nombre as Institucion_educativa_superior,
      tbl_gen_ocupacion.descripcion as Ocupacion_actual,
      tbl_gen_estado_civil.descripcion as Estado_civil,
      (CASE WHEN (tbl_cm_empleado.hijos_empleado = 1) THEN "Si"  ELSE "No" END) as hijos_empleado,
      tbl_cm_empleado.cantidad_hijos,
      tbl_gen_etnia.descripcion as se_auto_reconoce_como,
      (CASE WHEN (tbl_cm_empleado.enfermedad_permanente = 1) THEN "Si"  ELSE "No" END) as padece_enfermedad_permanente,
      tbl_cm_empleado.otra_enfermedad,
      (CASE WHEN (tbl_cm_empleado.medicamentos = 1) THEN "Si"  ELSE "No" END) as toma_medicamentos,
      tbl_cm_empleado.otros_medicamentos,
      tbl_gen_persona.sangre_tipo,
      (CASE WHEN (tbl_cm_empleado.condicion_discapacidad = 1) THEN "Si"  ELSE "No" END) as condicion_discapacidad,
      (CASE WHEN (tbl_cm_empleado.afiliacion_salud = 1) THEN "Si"  ELSE "No" END) as afiliacion_salud,
      tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
      tbl_gen_eps.descripcion as entidad_salud_eps,
      tbl_cm_empleado.libreta_militar,
      tbl_cm_empleado.no_libreta,
      tbl_cm_empleado.distrito_militar,
      tbl_cm_empleado.skype_empleado,
      roles.name as rol_usuario
       from tbl_cm_empleado
       left join tbl_gen_persona on tbl_gen_persona.id = tbl_cm_empleado.id_persona
       left join tbl_gen_documento_tipo on tbl_gen_documento_tipo.id = tbl_gen_persona.id_documento_tipo
       left join paises on paises.id = tbl_gen_persona.id_procedencia_pais
       left join departamentos on departamentos.id = tbl_gen_persona.id_procedencia_departamento
       left join municipios on municipios.id = tbl_gen_persona.id_procedencia_municipio
       left join departamentos as depresidencias on depresidencias.id = tbl_gen_persona.departamento_residencia_id
       left join municipios as municresidencias on municresidencias.id = tbl_gen_persona.municipio_residencia_id
       left join tbl_gen_corregimientos on tbl_gen_corregimientos.id = tbl_gen_persona.id_residencia_corregimiento
       left join tbl_gen_veredas on tbl_gen_veredas.id = tbl_gen_persona.id_residencia_vereda
       left join barrios on barrios.id = tbl_gen_persona.id_residencia_barrio
       left join tbl_gen_escolaridad_nivel on tbl_gen_escolaridad_nivel.id = tbl_gen_persona.escolaridad_id
       left join tbl_gen_escolaridad_estado on tbl_gen_escolaridad_estado.id = tbl_gen_persona.estado_escolaridad
       left join tbl_gen_titulos_academicos on tbl_gen_titulos_academicos.id = tbl_cm_empleado.titulo_obtenido
       left join tbl_gen_ocupacion on tbl_gen_ocupacion.id = tbl_cm_empleado.ocupacion_id
       left join tbl_gen_estado_civil on tbl_gen_estado_civil.id = tbl_gen_persona.id_estado_civil
       left join tbl_gen_etnia on tbl_gen_etnia.id = tbl_cm_empleado.etnia_id
       left join tbl_gen_salud_regimen on tbl_gen_salud_regimen.id = tbl_cm_empleado.tipoafiliacion_id
       left join tbl_gen_eps on tbl_gen_eps.id = tbl_cm_empleado.eps_id
       left join tbl_dv_instituciones_educativas on tbl_dv_instituciones_educativas.id = tbl_cm_empleado.universidad_id
       left join users on users.id = tbl_cm_empleado.id_usuario
       inner join role_user on users.id = role_user.user_id
       inner join roles on role_user.role_id  = roles.id

        where users.tenantId =?', [$usuario]);


      $items= json_decode( json_encode($data), true);
      Excel::create('items', function($excel) use($items) {
        $excel->sheet('ExportFile', function($sheet) use($items) {
            $sheet->fromArray($items);
        });
      })->export('xls');


    }

//Informe completo
public function exportInformeCompleto(Request $request)
    {

      $data = DB::table('tbl_cm_ficha')
      ->leftjoin(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')


        ->leftjoin(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
      'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
      'users',
      'users.id', '=', 'grupos.user_id')

      ->leftjoin(
      'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
          tbl_cm_ficha.cantidad_hijos_beneficiario,
          tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
          tbl_gen_etnia.descripcion as etnia_beneficiario,
          tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
          (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->groupBy('tbl_cm_ficha.id')->get();


  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


    public function exportTipoDocumento(Request $request)
    {

      $dato_documento = $request->tipo_doc_persona;

      $tipo_documento = (int)$dato_documento;

      $data = DB::table('tbl_cm_ficha')
      ->leftjoin(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')


        ->leftjoin(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
      'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
      'users',
      'users.id', '=', 'grupos.user_id')

      ->leftjoin(
      'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
          tbl_cm_ficha.cantidad_hijos_beneficiario,
          tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
          tbl_gen_etnia.descripcion as etnia_beneficiario,
          tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
          (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->where('tbl_gen_persona.id_documento_tipo', '=', $tipo_documento)->groupBy('tbl_cm_ficha.id')->get();


  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


 public function exportModalidad(Request $request)
    {

      $data = substr($request->modalidad, 7);
      $modalidad = (int)$data;

  $data = DB::table('tbl_cm_ficha')->join(
    'tbl_gen_persona',
    'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->join(
    'tbl_gen_persona as acudiente_persona',
    'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
    ->join(
    'tbl_cm_modalidades',
    'tbl_cm_modalidades.id', '=', 'tbl_cm_ficha.modalidad_id')
    ->join(
    'tbl_cm_punto_atencion',
    'tbl_cm_punto_atencion.id', '=', 'tbl_cm_ficha.puntoatencion_id')
    ->join(
    'poblacional_beneficiarios',
    'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')->leftjoin(
    'grupos',
    'grupos.id', '=', 'tbl_cm_ficha.grupo_id')->leftjoin(
    'tbl_cm_grupo_poblacional',
    'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')->join(
    'paises',
    'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')->join(
    'departamentos',
    'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')->join(
    'municipios',
    'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')->join(
    'barrios',
    'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')->join(
    'tbl_gen_corregimientos',
    'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')->join(
    'tbl_gen_veredas',
    'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')->join(
    'tbl_gen_estado_civil',
    'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')->join(
    'tbl_gen_escolaridad_nivel',
    'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')->join(
    'tbl_gen_documento_tipo',
    'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')->join(
    'tbl_gen_documento_tipo as tipo_documento_acudiente',
    'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')->leftjoin(
    'tbl_gen_discapacidad',
    'tbl_gen_discapacidad.id', '=', 'tbl_cm_ficha.discapacidad_id')->leftjoin(
    'tbl_gen_eps',
    'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')->select(DB::raw(
    "tbl_cm_ficha.id,
      grupos.codigo_grupo,
      tbl_gen_persona.nombre_primero,
      tbl_gen_persona.nombre_segundo,
      tbl_gen_persona.apellido_primero,
      tbl_gen_persona.apellido_segundo,
      tbl_gen_documento_tipo.descripcion as tipo_documento,
      tbl_gen_persona.documento,
            (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
      tbl_gen_persona.fecha_nacimiento,
      tbl_gen_persona.telefono_fijo,
      tbl_gen_persona.telefono_movil,
      tbl_gen_persona.correo_electronico,
      paises.nombre_pais,
      departamentos.nombre_departamento,
      municipios.nombre_municipio,
      tbl_gen_corregimientos.descripcion,
      barrios.nombre_barrio,
      tbl_gen_persona.residencia_direccion,
      tbl_gen_persona.residencia_estrato,
      tbl_gen_persona.sangre_tipo,
      tbl_gen_estado_civil.descripcion,
      grupos.codigo_grupo,
      tbl_cm_ficha.fecha_inscripcion,
      tbl_cm_ficha.no_ficha,
      tbl_cm_modalidades.nombre as modalidad,
      tbl_cm_punto_atencion.nombre as punto_atencion,
      tbl_cm_ficha.hijos_beneficiario,
      tbl_cm_ficha.cantidad_hijos_beneficiario,
      group_concat(tbl_cm_grupo_poblacional.nombre) as grupo_poblacional,

      (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,

      tbl_gen_escolaridad_nivel.descripcion,
      (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
      (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
      tbl_gen_discapacidad.descripcion as nombre_dicapacidad, otra_discapacidad_beneficiario,



      (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,


      tbl_gen_eps.descripcion as nombre_eps,
      acudiente_persona.nombre_primero as primer_nombre_acudiente,
      acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
      acudiente_persona.apellido_primero as primer_apellido_acudiente,
      acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
      tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
      acudiente_persona.documento as documento_acudiente,
            (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
      acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
      acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
      acudiente_persona.telefono_movil as telefono_movil_acudiente,
      acudiente_persona.correo_electronico as correo_acudiente,
      (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
      tbl_cm_ficha.otro_parentesco_acudiente



    "))->where('tbl_cm_ficha.modalidad_id', '=', $modalidad)->groupBy('tbl_cm_ficha.id')->get();

  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}



public function exportPuntoAtencion(Request $request)
    {

      $data = substr($request->atencion, 7);
      $atencion = (int)$data;


   $data = DB::table('tbl_cm_ficha')->join(
    'tbl_gen_persona',
    'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->join(
    'tbl_gen_persona as acudiente_persona',
    'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
    ->join(
    'tbl_cm_modalidades',
    'tbl_cm_modalidades.id', '=', 'tbl_cm_ficha.modalidad_id')
    ->join(
    'tbl_cm_punto_atencion',
    'tbl_cm_punto_atencion.id', '=', 'tbl_cm_ficha.puntoatencion_id')
    ->join(
    'poblacional_beneficiarios',
    'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')->leftjoin(
    'grupos',
    'grupos.id', '=', 'tbl_cm_ficha.grupo_id')->leftjoin(
    'tbl_cm_grupo_poblacional',
    'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')->join(
    'paises',
    'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')->join(
    'departamentos',
    'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')->join(
    'municipios',
    'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')->join(
    'barrios',
    'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')->join(
    'tbl_gen_corregimientos',
    'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')->join(
    'tbl_gen_veredas',
    'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')->join(
    'tbl_gen_estado_civil',
    'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')->join(
    'tbl_gen_escolaridad_nivel',
    'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')->join(
    'tbl_gen_documento_tipo',
    'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')->join(
    'tbl_gen_documento_tipo as tipo_documento_acudiente',
    'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')->leftjoin(
    'tbl_gen_discapacidad',
    'tbl_gen_discapacidad.id', '=', 'tbl_cm_ficha.discapacidad_id')->leftjoin(
    'tbl_gen_eps',
    'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')->select(DB::raw(
    "tbl_cm_ficha.id,
      grupos.codigo_grupo,
      tbl_gen_persona.nombre_primero,
      tbl_gen_persona.nombre_segundo,
      tbl_gen_persona.apellido_primero,
      tbl_gen_persona.apellido_segundo,
      tbl_gen_documento_tipo.descripcion as tipo_documento,
      tbl_gen_persona.documento,
            (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
      tbl_gen_persona.fecha_nacimiento,
      tbl_gen_persona.telefono_fijo,
      tbl_gen_persona.telefono_movil,
      tbl_gen_persona.correo_electronico,
      paises.nombre_pais,
      departamentos.nombre_departamento,
      municipios.nombre_municipio,
      tbl_gen_corregimientos.descripcion,
      barrios.nombre_barrio,
      tbl_gen_persona.residencia_direccion,
      tbl_gen_persona.residencia_estrato,
      tbl_gen_persona.sangre_tipo,
      tbl_gen_estado_civil.descripcion,
      grupos.codigo_grupo,
      tbl_cm_ficha.fecha_inscripcion,
      tbl_cm_ficha.no_ficha,
      tbl_cm_modalidades.nombre as modalidad,
      tbl_cm_punto_atencion.nombre as punto_atencion,
      tbl_cm_ficha.hijos_beneficiario,
      tbl_cm_ficha.cantidad_hijos_beneficiario,
      group_concat(tbl_cm_grupo_poblacional.nombre) as grupo_poblacional,

      (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,

      tbl_gen_escolaridad_nivel.descripcion,
      (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
      (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
      tbl_gen_discapacidad.descripcion as nombre_dicapacidad, otra_discapacidad_beneficiario,



      (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,


      tbl_gen_eps.descripcion as nombre_eps,
      acudiente_persona.nombre_primero as primer_nombre_acudiente,
      acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
      acudiente_persona.apellido_primero as primer_apellido_acudiente,
      acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
      tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
      acudiente_persona.documento as documento_acudiente,
            (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
      acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
      acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
      acudiente_persona.telefono_movil as telefono_movil_acudiente,
      acudiente_persona.correo_electronico as correo_acudiente,
      (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
      tbl_cm_ficha.otro_parentesco_acudiente



    "))->where('tbl_cm_ficha.punto_atencion', '=', $atencion)->groupBy('tbl_cm_ficha.id')->get();

  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


public function exportFechaInscripcion(Request $request)
    {


      $entre = $request->entre;
      $hasta = $request->hasta;

      $data = DB::table('tbl_cm_ficha')
      ->leftjoin(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')


        ->leftjoin(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
      'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
      'users',
      'users.id', '=', 'grupos.user_id')

      ->leftjoin(
      'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
          tbl_cm_ficha.cantidad_hijos_beneficiario,
          tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
          tbl_gen_etnia.descripcion as etnia_beneficiario,
          tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
          (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)
          ->whereBetween('tbl_cm_ficha.fecha_inscripcion', [$entre, $hasta])
          ->groupBy('tbl_cm_ficha.id')->get();




  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}



 public function exportSexo(Request $request)
    {

      $dato_sexo = $request->sexo;

      $tipo_sexo = (int)$dato_sexo;

      $data = DB::table('tbl_cm_ficha')
      ->leftjoin(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')


        ->leftjoin(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
      'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
      'users',
      'users.id', '=', 'grupos.user_id')

      ->leftjoin(
      'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
          tbl_cm_ficha.cantidad_hijos_beneficiario,
          tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
          tbl_gen_etnia.descripcion as etnia_beneficiario,
          tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
          (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->where('tbl_gen_persona.sexo', '=', $tipo_sexo)->groupBy('tbl_cm_ficha.id')->get();



  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


public function exportEdad(Request $request)
    {


      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");

      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;


      $data = DB::table('tbl_cm_ficha')->join(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->join(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
        'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
        'grupos',
        'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
        'users',
        'users.id', '=', 'grupos.user_id')

      ->leftjoin(
        'tbl_cm_grupo_poblacional',
        'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
        tbl_cm_ficha.cantidad_hijos_beneficiario,
        tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
        tbl_gen_etnia.descripcion as etnia_beneficiario,
        tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,

          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,

          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,

        (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->whereBetween('tbl_gen_persona.fecha_nacimiento', [$fecha_entre_edad, $fecha_hasta_edad])->groupBy('tbl_cm_ficha.id')->get();


        $items= json_decode( json_encode($data), true);
        Excel::create('items', function($excel) use($items) {
          $excel->sheet('ExportFile', function($sheet) use($items) {
              $sheet->fromArray($items);
          });
        })->export('xls');

}


public function exportEstrato(Request $request)
    {

      $dato_estrato = $request->estrato;
      $tipo_estrato = (int)$dato_estrato;

      $data = DB::table('tbl_cm_ficha')
      ->leftjoin(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')


        ->leftjoin(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
      'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
      'users',
      'users.id', '=', 'grupos.user_id')

      ->leftjoin(
      'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
          tbl_cm_ficha.cantidad_hijos_beneficiario,
          tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
          tbl_gen_etnia.descripcion as etnia_beneficiario,
          tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
          (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->where('tbl_gen_persona.residencia_estrato', '=', $tipo_estrato)->groupBy('tbl_cm_ficha.id')->get();


  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}

public function exportComuna(Request $request)
    {

      $dato_comuna = $request->comuna;
      $tipo_comuna = (int)$dato_comuna;

      $data = DB::table('tbl_cm_ficha')
      ->leftjoin(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')


        ->leftjoin(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
      'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
      'users',
      'users.id', '=', 'grupos.user_id')

      ->leftjoin(
      'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
          tbl_cm_ficha.cantidad_hijos_beneficiario,
          tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
          tbl_gen_etnia.descripcion as etnia_beneficiario,
          tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
          (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->where('comunas.id', '=', $tipo_comuna)->groupBy('tbl_cm_ficha.id')->get();


  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}



public function exportCorregimiento(Request $request)
    {

      $dato_corregimiento = $request->corregimiento;
      $tipo_corregimiento = (int)$dato_corregimiento;

      $data = DB::table('tbl_cm_ficha')
      ->leftjoin(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')


        ->leftjoin(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
      'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
      'users',
      'users.id', '=', 'grupos.user_id')

      ->leftjoin(
      'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
          tbl_cm_ficha.cantidad_hijos_beneficiario,
          tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
          tbl_gen_etnia.descripcion as etnia_beneficiario,
          tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
          (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->where('tbl_gen_persona.id_residencia_corregimiento', '=', $tipo_corregimiento)->groupBy('tbl_cm_ficha.id')->get();



  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


public function exportHijos(Request $request)
    {

      $dato_hijos = $request->hijos;
      $tipo_hijos  = (int)$dato_hijos;

      $data = DB::table('tbl_cm_ficha')->join(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->join(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
        'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
        'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
        'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->join(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->join(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->join(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->join(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->join(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->join(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->join(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->join(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->join(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
        tbl_cm_ficha.cantidad_hijos_beneficiario,
        tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
        tbl_gen_etnia.descripcion as etnia_beneficiario,
        tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,

          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,

          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,

        (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.cantidad_hijos_beneficiario', '=', $tipo_hijos)->groupBy('tbl_cm_ficha.id')->get();



  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


public function exportOcupacion(Request $request)
    {

      $dato_ocupacion = $request->ocupacion;
      $tipo_ocupacion  = (int)$dato_ocupacion;

      $data = DB::table('tbl_cm_ficha')
      ->leftjoin(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')


        ->leftjoin(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
      'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
      'users',
      'users.id', '=', 'grupos.user_id')

      ->leftjoin(
      'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
          tbl_cm_ficha.cantidad_hijos_beneficiario,
          tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
          tbl_gen_etnia.descripcion as etnia_beneficiario,
          tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
          (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->where('tbl_cm_ficha.ocupacion_beneficiario', '=', $tipo_ocupacion)->groupBy('tbl_cm_ficha.id')->get();



  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}



public function exportEscolaridad(Request $request)
    {

      $dato_escolaridad = $request->escolaridad;
      $tipo_escolaridad  = (int)$dato_escolaridad;

      $data = DB::table('tbl_cm_ficha')
      ->leftjoin(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')


        ->leftjoin(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
      'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
      'tbl_cm_grados',
      'tbl_cm_grados.id', '=', 'grupos.grado_id')

      ->leftjoin(
      'users',
      'users.id', '=', 'grupos.user_id')

      ->leftjoin(
      'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
          tbl_cm_ficha.cantidad_hijos_beneficiario,
          tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
          tbl_gen_etnia.descripcion as etnia_beneficiario,
          tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
          (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->where('grupos.grado_id', '=', $tipo_escolaridad)->groupBy('tbl_cm_ficha.id')->get();



  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


public function exportCultura(Request $request)
    {

      $dato_cultura = $request->cultura;
      $tipo_cultura  = (int)$dato_cultura;
      $data = DB::table('tbl_cm_ficha')
      ->leftjoin(
        'tbl_gen_persona',
        'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')


        ->leftjoin(
        'tbl_gen_persona as acudiente_persona',
        'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
        ->leftjoin(
        'poblacional_beneficiarios',
      'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')

      ->leftjoin(
      'tbl_cm_persona_x_discapacidad',
      'tbl_cm_ficha.id', '=', 'tbl_cm_persona_x_discapacidad.ficha_id')

      ->leftjoin(
      'grupos',
      'grupos.id', '=', 'tbl_cm_ficha.grupo_id')

      ->leftjoin(
      'users',
      'users.id', '=', 'grupos.user_id')

      ->leftjoin(
      'tbl_cm_grupo_poblacional',
      'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')

      ->leftjoin(
        'tbl_gen_discapacidad',
        'tbl_gen_discapacidad.id', '=', 'tbl_cm_persona_x_discapacidad.discapacidad_id')

      ->leftjoin(
      'paises',
      'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')

      ->leftjoin(
        'departamentos',
      'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')

      ->leftjoin(
        'municipios',
      'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')

      ->leftjoin(
        'barrios',
      'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')

      ->leftjoin(
        'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')
      ->leftjoin(
        'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')
      ->leftjoin(
        'tbl_gen_estado_civil',
      'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')
      ->leftjoin(
        'tbl_gen_escolaridad_nivel',
      'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')
      ->leftjoin(
        'tbl_gen_documento_tipo',
      'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_documento_tipo as tipo_documento_acudiente',
      'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')
      ->leftjoin(
        'tbl_gen_eps',
      'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')
      ->leftjoin(
        'tbl_gen_etnia',
        'tbl_gen_etnia.id', '=', 'tbl_cm_ficha.cultura_beneficiario')

      ->leftjoin(
      'tbl_gen_escolaridad_estado',
      'tbl_gen_escolaridad_estado.id', '=', 'tbl_cm_ficha.estado_escolaridad')

      ->leftjoin(
        'tbl_gen_salud_regimen',
        'tbl_gen_salud_regimen.id', '=', 'tbl_cm_ficha.tipo_afiliacion')

        ->select(DB::raw(
        "tbl_cm_ficha.id,
          grupos.codigo_grupo,
          tbl_gen_persona.nombre_primero,
          tbl_gen_persona.nombre_segundo,
          tbl_gen_persona.apellido_primero,
          tbl_gen_persona.apellido_segundo,
          tbl_gen_documento_tipo.descripcion as tipo_documento,
          tbl_gen_persona.documento,
                (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
          tbl_gen_persona.fecha_nacimiento,
          tbl_gen_persona.telefono_fijo,
          tbl_gen_persona.telefono_movil,
          tbl_gen_persona.correo_electronico,
          paises.nombre_pais,
          departamentos.nombre_departamento,
          municipios.nombre_municipio,
          tbl_gen_corregimientos.descripcion,
          barrios.nombre_barrio,
          tbl_gen_persona.residencia_direccion,
          tbl_gen_persona.residencia_estrato,
          tbl_gen_persona.sangre_tipo,
          tbl_gen_estado_civil.descripcion,
          grupos.codigo_grupo,
          tbl_cm_ficha.fecha_inscripcion,
          tbl_cm_ficha.no_ficha,
          tbl_cm_ficha.otra_discapacidad_beneficiario,
          (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,
          tbl_cm_ficha.cantidad_hijos_beneficiario,
          tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
          tbl_gen_etnia.descripcion as etnia_beneficiario,
          tbl_gen_salud_regimen.descripcion as tipo_afiliacion,
          group_concat(DISTINCT(tbl_cm_grupo_poblacional.nombre)) as grupo_poblacional,
          group_concat(DISTINCT(tbl_gen_discapacidad.descripcion)) as discapacidades,
          (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,
          tbl_gen_escolaridad_nivel.descripcion,
          (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
          (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
          (CASE WHEN (afiliacion_salud = 1) THEN 'Si'  ELSE 'No' END) as Afiliacion_Salud,
          (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
          tbl_gen_eps.descripcion as nombre_eps,
          acudiente_persona.nombre_primero as primer_nombre_acudiente,
          acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
          acudiente_persona.apellido_primero as primer_apellido_acudiente,
          acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
          acudiente_persona.documento as documento_acudiente,
                (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
          acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
          acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
          acudiente_persona.telefono_movil as telefono_movil_acudiente,
          acudiente_persona.correo_electronico as correo_acudiente,
          (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
          tbl_cm_ficha.otro_parentesco_acudiente

        "))->where('tbl_cm_ficha.tenantId', '=', Auth::user()->tenantId)->where('tbl_cm_ficha.cultura_beneficiario', '=', $tipo_cultura)->groupBy('tbl_cm_ficha.id')->get();



  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


public function exportDiscapacidad(Request $request)
    {

      $dato_discapacidad = $request->discapacidad;
      $tipo_discapacidad  = (int)$dato_discapacidad;


   $data = DB::table('tbl_cm_ficha')->join(
    'tbl_gen_persona',
    'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')->join(
    'tbl_gen_persona as acudiente_persona',
    'acudiente_persona.id', '=', 'tbl_cm_ficha.id_persona_acudiente')
    ->join(
    'tbl_cm_modalidades',
    'tbl_cm_modalidades.id', '=', 'tbl_cm_ficha.modalidad_id')
    ->join(
    'tbl_cm_punto_atencion',
    'tbl_cm_punto_atencion.id', '=', 'tbl_cm_ficha.puntoatencion_id')

    ->join(
    'poblacional_beneficiarios',
    'tbl_cm_ficha.id', '=', 'poblacional_beneficiarios.ficha_id')->leftjoin(
    'grupos',
    'grupos.id', '=', 'tbl_cm_ficha.grupo_id')->leftjoin(
    'tbl_cm_grupo_poblacional',
    'tbl_cm_grupo_poblacional.id', '=', 'poblacional_beneficiarios.grupo_pcs')->join(
    'paises',
    'paises.id', '=', 'tbl_gen_persona.id_procedencia_pais')->join(
    'departamentos',
    'departamentos.id', '=', 'tbl_gen_persona.id_procedencia_departamento')->join(
    'municipios',
    'municipios.id', '=', 'tbl_gen_persona.id_procedencia_municipio')->join(
    'barrios',
    'barrios.id', '=', 'tbl_gen_persona.id_residencia_barrio')->join(
    'tbl_gen_corregimientos',
    'tbl_gen_corregimientos.id', '=', 'tbl_gen_persona.id_residencia_corregimiento')->join(
    'tbl_gen_veredas',
    'tbl_gen_veredas.id', '=', 'tbl_gen_persona.id_residencia_vereda')->join(
    'tbl_gen_estado_civil',
    'tbl_gen_estado_civil.id', '=', 'tbl_gen_persona.id_estado_civil')->join(
    'tbl_gen_escolaridad_nivel',
    'tbl_gen_escolaridad_nivel.id', '=', 'tbl_cm_ficha.escolaridad_id')->join(
    'tbl_gen_documento_tipo',
    'tbl_gen_documento_tipo.id', '=', 'tbl_gen_persona.id_documento_tipo')->join(
    'tbl_gen_documento_tipo as tipo_documento_acudiente',
    'tipo_documento_acudiente.id', '=', 'tbl_gen_persona.id_documento_tipo')->leftjoin(
    'tbl_gen_discapacidad',
    'tbl_gen_discapacidad.id', '=', 'tbl_cm_ficha.discapacidad_id')->leftjoin(
    'tbl_gen_eps',
    'tbl_gen_eps.id', '=', 'tbl_cm_ficha.salud_sgss_id')->select(DB::raw(
    "tbl_cm_ficha.id,
      grupos.codigo_grupo,
      tbl_gen_persona.nombre_primero,
      tbl_gen_persona.nombre_segundo,
      tbl_gen_persona.apellido_primero,
      tbl_gen_persona.apellido_segundo,
      tbl_gen_documento_tipo.descripcion as tipo_documento,
      tbl_gen_persona.documento,
            (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'Hombre' END) as sexo,
      tbl_gen_persona.fecha_nacimiento,
      tbl_gen_persona.telefono_fijo,
      tbl_gen_persona.telefono_movil,
      tbl_gen_persona.correo_electronico,
      paises.nombre_pais,
      departamentos.nombre_departamento,
      municipios.nombre_municipio,
      tbl_gen_corregimientos.descripcion,
      barrios.nombre_barrio,
      tbl_gen_persona.residencia_direccion,
      tbl_gen_persona.residencia_estrato,
      tbl_gen_persona.sangre_tipo,
      tbl_gen_estado_civil.descripcion,
      grupos.codigo_grupo,
      tbl_cm_ficha.fecha_inscripcion,
      tbl_cm_ficha.no_ficha,
      tbl_cm_modalidades.nombre as modalidad,
      tbl_cm_punto_atencion.nombre as punto_atencion,
      tbl_cm_ficha.hijos_beneficiario,
      tbl_cm_ficha.cantidad_hijos_beneficiario,
      group_concat(tbl_cm_grupo_poblacional.nombre) as grupo_poblacional,

      (CASE WHEN (ocupacion_beneficiario = 1) THEN 'Ama de casa' WHEN (ocupacion_beneficiario = 2) THEN 'Empleado' WHEN (ocupacion_beneficiario = 3) THEN 'Estudiante' WHEN (ocupacion_beneficiario = 4) THEN 'Desempleado' WHEN (ocupacion_beneficiario = 5) THEN 'Independiente' WHEN (ocupacion_beneficiario = 6) THEN 'Pensionado-Jubilado' WHEN (ocupacion_beneficiario = 7) THEN 'Servidor Público'  ELSE 'Otro' END) as Ocupacion,

      tbl_gen_escolaridad_nivel.descripcion,
      (CASE WHEN (cultura_beneficiario = 1) THEN 'Negro' WHEN (cultura_beneficiario = 2) THEN 'Blanco' WHEN (cultura_beneficiario = 3) THEN 'Índigena' WHEN (cultura_beneficiario = 4) THEN 'Mestizo' WHEN (cultura_beneficiario = 5) THEN 'Mulato' WHEN (cultura_beneficiario = 6) THEN 'ROM, Gitano' WHEN (cultura_beneficiario = 7) THEN 'Palenquero' WHEN (cultura_beneficiario = 8) THEN 'Raizal' WHEN (cultura_beneficiario = 9) THEN 'No sabe-No responde'  ELSE 'Otro' END) as Cultura,
      (CASE WHEN (discapacidad_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Discapacidad,
      tbl_gen_discapacidad.descripcion as nombre_dicapacidad, otra_discapacidad_beneficiario,



      (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,


      tbl_gen_eps.descripcion as nombre_eps,
      acudiente_persona.nombre_primero as primer_nombre_acudiente,
      acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
      acudiente_persona.apellido_primero as primer_apellido_acudiente,
      acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
      tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
      acudiente_persona.documento as documento_acudiente,
            (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'Mujer' END) as sexo_acudiente,
      acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
      acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
      acudiente_persona.telefono_movil as telefono_movil_acudiente,
      acudiente_persona.correo_electronico as correo_acudiente,
      (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
      tbl_cm_ficha.otro_parentesco_acudiente



    "))->where('tbl_cm_ficha.discapacidad_id', '=', $tipo_discapacidad)->groupBy('tbl_cm_ficha.id')->get();


  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


public function export_parrilla_grupos(Request $request)
{



  $Filtro = array();
  $where  = array();
  $wheres = '';

    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {
        $dt1 = new \DateTime($request->entre);
        $carbon_entre = Carbon::instance($dt1);
        $entre = $carbon_entre->format('Y-m-d');
        $dt2 = new \DateTime($request->hasta);
        $carbon_hasta = Carbon::instance($dt2);
        $hasta = $carbon_hasta->format('Y-m-d');
        $where[]  = 'tbl_cm_ficha.fecha_inscripcion BETWEEN ' .'"'. $entre. '"'. ' AND ' . '"' .$hasta . '"';
    }

   $where[]  = 'tbl_cm_ficha.tenantId =' . Auth::user()->tenantId;

   if (count($where) > 0)
    {
      $wheres = 'where ' . implode(' and ', $where);

    }


  $data = DB::select('select
  `tbl_gen_asistencias`.`ficha_id`,
  `grupos`.`codigo_grupo`,
  `tbl_cm_grados`.`nombre_grado`,
  instituciones.nombre_institucion,
  sedes.nombre_sede,
  ((count(`tbl_gen_asistencias`.`fecha_asistencia`))-SUM(`tbl_gen_asistencias`.`asistencia`) ) AS `inasistencias`,
  SUM(`tbl_gen_asistencias`.`asistencia`) AS `asistencias`,
  (count(`tbl_gen_asistencias`.`fecha_asistencia`)) AS `total`,
  `tbl_gen_documento_tipo`.`descripcion` AS `tipo_documento`,
  `tbl_gen_persona`.`documento`,
  `tbl_cm_ficha`.`no_ficha`,
  `tbl_cm_ficha`.`fecha_inscripcion`,
  `tbl_gen_persona`.`nombre_primero`,
  `tbl_gen_persona`.`nombre_segundo`,
  `tbl_gen_persona`.`apellido_primero`,
  `tbl_gen_persona`.`apellido_segundo`,
  `tbl_gen_persona`.`correo_electronico`,
  (CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "F" END) as sexo,
  `tbl_gen_persona`.`fecha_nacimiento`,
  `paises`.`nombre_pais` as pais_procedencia,
  `departamentos`.`nombre_departamento` as departamento_procedencia,
  `municipios`.`nombre_municipio` as municipio_procedencia,
  `tbl_gen_corregimientos`.`descripcion` AS `nombre_corregimiento`,
  `tbl_gen_veredas`.`nombre` as nombre_vereda,
  `barrios`.`nombre_barrio`,
  `tbl_gen_persona`.`residencia_estrato`,
  `comunas`.`nombre_comuna`,
  `tbl_gen_persona`.`residencia_direccion`,
  `tbl_gen_persona`.`telefono_fijo`,
  `tbl_gen_persona`.`telefono_movil`,
  `tbl_gen_escolaridad_nivel`.`descripcion` as nivel_escolaridad,
  `tbl_gen_escolaridad_estado`.`descripcion` as estado_escolaridad,
  `tbl_gen_ocupacion`.`descripcion` as ocupacion_beneficiario,
  `tbl_gen_estado_civil`.`descripcion` as estado_civil,
  (CASE WHEN (tbl_cm_ficha.hijos_beneficiario = 1) THEN "Si"  ELSE "No" END) as hijos_beneficiario,
  `tbl_cm_ficha`.`cantidad_hijos_beneficiario`,
  `tbl_gen_etnia`.`descripcion` as etnia_beneficiario,
  `view_grupo_poblacional_ficha`.`nombre` as poblacional,
  view_discapacidad_persona_ficha.nombre_discapacidad as discapacidades,
  (CASE WHEN (tbl_cm_ficha.discapacidad_beneficiario = 1) THEN "Si"  ELSE "No" END) as enfermedad_permanente,
  `tbl_cm_ficha`.`otra_discapacidad_beneficiario`,
  (CASE WHEN (tbl_cm_ficha.medicamentos_permanente_beneficiario = 1) THEN "Si"  ELSE "No" END) as toma_medicamentos,
  `tbl_cm_ficha`.`medicamentos_beneficiario`,
  `tbl_gen_persona`.`sangre_tipo`,
  (CASE WHEN (tbl_cm_ficha.afiliacion_salud = 1) THEN "Si"  ELSE "No" END) as afiliacion_salud,
  `tbl_gen_salud_regimen`.`descripcion` as tipo_afiliacion,
  `tbl_gen_eps`.`descripcion` as nombre_eps,
  `tbl_gen_documento_tipo_acudiente`.`descripcion` as tipo_documento_acudiente,
  `acudiente_persona`.`documento` as documento_acudiente,
  `acudiente_persona`.`nombre_primero` as nombre_primero_acudiente,
  `acudiente_persona`.`nombre_segundo` as nombre_segundo_acudiente,
  `acudiente_persona`.`apellido_primero` as apellido_primero_acudiente,
  `acudiente_persona`.`apellido_segundo` as apellido_segundo_acudiente,
  `acudiente_persona`.`fecha_nacimiento` as fecha_nacimiento_acudiente,
  `acudiente_persona`.`telefono_fijo` as telefono_fijo_acudiente,
  `acudiente_persona`.`telefono_movil` as telefono_movil_acudiente,
  `acudiente_persona`.`correo_electronico` as correo_electronico_acudiente,
  (CASE WHEN (tbl_cm_ficha.parentesco_acudiente = 1) THEN "Madre/Padre" WHEN (tbl_cm_ficha.parentesco_acudiente = 2) THEN "Hermana/Hermano" WHEN (tbl_cm_ficha.parentesco_acudiente = 3) THEN "Tia/Tio" WHEN (tbl_cm_ficha.parentesco_acudiente = 4) THEN "Abuela/Abuelo" WHEN (tbl_cm_ficha.parentesco_acudiente = 5) THEN "Cuidador" ELSE "Otro" END) as parentesco_acudiente,
  tbl_cm_ficha.otro_parentesco_acudiente,
  `users`.`primer_nombre` as primer_nombre_formador,
  `users`.`segundo_apellido` as primer_apellido_formador

  FROM
  `tbl_gen_asistencias`
  LEFT JOIN `tbl_cm_ficha` ON (`tbl_gen_asistencias`.`ficha_id` = `tbl_cm_ficha`.`id`)
  LEFT JOIN `tbl_gen_persona` ON (`tbl_cm_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo`.`id`)
  LEFT JOIN `paises` ON (`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)
  LEFT OUTER JOIN `departamentos` ON (`tbl_gen_persona`.`id_procedencia_departamento` = `departamentos`.`id`)
  LEFT OUTER JOIN `municipios` ON (`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)
  LEFT OUTER JOIN `tbl_gen_corregimientos` ON (`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)
  LEFT OUTER JOIN `tbl_gen_veredas` ON (`tbl_gen_persona`.`id_residencia_vereda` = `tbl_gen_veredas`.`id`)
  LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
  LEFT OUTER JOIN `tbl_gen_estado_civil` ON (`tbl_gen_persona`.`id_estado_civil` = `tbl_gen_estado_civil`.`id`)
  LEFT OUTER JOIN `grupos` ON (`tbl_cm_ficha`.`grupo_id` = `grupos`.`id`)
  LEFT JOIN `sedes` ON (`sedes`.`id` = `grupos`.`sede_id`)
  LEFT JOIN `instituciones` ON (`instituciones`.`id` = `sedes`.`institucion_id`)
  LEFT JOIN `tbl_cm_grados` ON (`tbl_cm_grados`.`id` = `grupos`.`grado_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_cm_ficha`.`comuna_id`)
  LEFT OUTER JOIN `users` ON (`grupos`.`user_id` = `users`.`id`)
  LEFT OUTER JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_cm_ficha`.`escolaridad_id` = `tbl_gen_escolaridad_nivel`.`id`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_cm_ficha`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_cm_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_cm_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_cm_ficha`.`tipo_afiliacion`)

  LEFT JOIN `view_grupo_poblacional_ficha` ON (`tbl_cm_ficha`.`id` =
 `view_grupo_poblacional_ficha`.`ficha_id`)

  LEFT JOIN `view_discapacidad_persona_ficha` ON (`tbl_cm_ficha`.`id` =
  `view_discapacidad_persona_ficha`.`ficha_id`)

  LEFT OUTER JOIN `tbl_gen_eps` ON (`tbl_cm_ficha`.`salud_sgss_id` = `tbl_gen_eps`.`id`)
  LEFT JOIN `tbl_gen_persona` `acudiente_persona` ON (`tbl_cm_ficha`.`id_persona_acudiente` = `acudiente_persona`.`id`)
  LEFT JOIN `tbl_gen_documento_tipo` `tbl_gen_documento_tipo_acudiente` ON (`acudiente_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo_acudiente`.`id`)
  '.$wheres.'
  GROUP BY
  `tbl_gen_asistencias`.`ficha_id`');

  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}


public function exportDetallado(Request $request)
{

  $Filtro = array();
  $where  = array();
  $wheres = '';



    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {
        $dt1 = new \DateTime($request->entre);
        $carbon_entre = Carbon::instance($dt1);
        $entre = $carbon_entre->format('Y-m-d');
        $dt2 = new \DateTime($request->hasta);
        $carbon_hasta = Carbon::instance($dt2);
        $hasta = $carbon_hasta->format('Y-m-d');
        $where[]  = 'tbl_cm_ficha.fecha_inscripcion BETWEEN ' .'"'. $entre. '"'. ' AND ' . '"' .$hasta . '"';
    }
    if ($request->sexo != null)
    {
        $where[]  = 'tbl_gen_persona.sexo=' . (int)$request->sexo;
    }
    if ($request->entre_edad != null && $request->hasta_edad !=null)
    {
      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");
      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;

      $where[]  = 'TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) BETWEEN ' .'"'. $entre_edad. '"'. ' AND ' . '"' .$hasta_edad . '"';

    }
    if ($request->corregimiento != null)
    {
        $where[]  = 'tbl_gen_persona.id_residencia_corregimiento=' . (int)$request->corregimiento;
    }
    if ($request->barrio != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_barrio=' . (int)$request->barrio;
    }
    if ($request->comuna != null)
    {
        $where[]  = 'tbl_cm_ficha.comuna_id=' . (int)$request->comuna;
    }
    if ($request->estrato != null)
    {
      $where[]  = 'tbl_gen_persona.residencia_estrato=' . (int)$request->estrato;
    }
    if ($request->escolaridad != null)
    {
      $where[]  = 'grupos.grado_id=' . (int)$request->escolaridad;
    }
    if ($request->etnia != null)
    {
      $where[]  = 'tbl_cm_ficha.cultura_beneficiario=' . (int)$request->etnia;
    }
    if ($request->discapacidad != null)
    {
      $where[]  = 'view_discapacidad_persona_ficha.discapacidad_id=' . (int)$request->discapacidad;
    }
    if ($request->institucion != null)
    {
      $where[]  = 'instituciones.id=' . (int)$request->institucion;
    }
    if ($request->sede != null)
    {
      $where[]  = 'sedes.id=' . (int)$request->sede;
    }

   $where[]  = 'tbl_cm_ficha.tenantId =' . Auth::user()->tenantId;

   if (count($where) > 0)
    {
      $wheres = 'where ' . implode(' and ', $where);

    }


  $data = DB::select('select
  `tbl_gen_asistencias`.`ficha_id`,
  `grupos`.`codigo_grupo`,
  `tbl_cm_grados`.`nombre_grado`,
  instituciones.nombre_institucion,
  sedes.nombre_sede,
  ((count(`tbl_gen_asistencias`.`fecha_asistencia`))-SUM(`tbl_gen_asistencias`.`asistencia`) ) AS `inasistencias`,
  SUM(`tbl_gen_asistencias`.`asistencia`) AS `asistencias`,
  (count(`tbl_gen_asistencias`.`fecha_asistencia`)) AS `total`,
  `tbl_gen_documento_tipo`.`descripcion` AS `tipo_documento`,
  `tbl_gen_persona`.`documento`,
  `tbl_cm_ficha`.`no_ficha`,
  `tbl_cm_ficha`.`fecha_inscripcion`,
  `tbl_gen_persona`.`nombre_primero`,
  `tbl_gen_persona`.`nombre_segundo`,
  `tbl_gen_persona`.`apellido_primero`,
  `tbl_gen_persona`.`apellido_segundo`,
  `tbl_gen_persona`.`correo_electronico`,
  (CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "F" END) as sexo,
  `tbl_gen_persona`.`fecha_nacimiento`,
  `paises`.`nombre_pais` as pais_procedencia,
  `departamentos`.`nombre_departamento` as departamento_procedencia,
  `municipios`.`nombre_municipio` as municipio_procedencia,
  `tbl_gen_corregimientos`.`descripcion` AS `nombre_corregimiento`,
  `tbl_gen_veredas`.`nombre` as nombre_vereda,
  `barrios`.`nombre_barrio`,
  `tbl_gen_persona`.`residencia_estrato`,
  `comunas`.`nombre_comuna`,
  `tbl_gen_persona`.`residencia_direccion`,
  `tbl_gen_persona`.`telefono_fijo`,
  `tbl_gen_persona`.`telefono_movil`,
  `tbl_gen_escolaridad_nivel`.`descripcion` as nivel_escolaridad,
  `tbl_gen_escolaridad_estado`.`descripcion` as estado_escolaridad,
  `tbl_gen_ocupacion`.`descripcion` as ocupacion_beneficiario,
  `tbl_gen_estado_civil`.`descripcion` as estado_civil,
  (CASE WHEN (tbl_cm_ficha.hijos_beneficiario = 1) THEN "Si"  ELSE "No" END) as hijos_beneficiario,
  `tbl_cm_ficha`.`cantidad_hijos_beneficiario`,
  `tbl_gen_etnia`.`descripcion` as etnia_beneficiario,
  `view_grupo_poblacional_ficha`.`nombre` as poblacional,
  view_discapacidad_persona_ficha.nombre_discapacidad as discapacidades,
  (CASE WHEN (tbl_cm_ficha.discapacidad_beneficiario = 1) THEN "Si"  ELSE "No" END) as enfermedad_permanente,
  `tbl_cm_ficha`.`otra_discapacidad_beneficiario`,
  (CASE WHEN (tbl_cm_ficha.medicamentos_permanente_beneficiario = 1) THEN "Si"  ELSE "No" END) as toma_medicamentos,
  `tbl_cm_ficha`.`medicamentos_beneficiario`,
  `tbl_gen_persona`.`sangre_tipo`,
  (CASE WHEN (tbl_cm_ficha.afiliacion_salud = 1) THEN "Si"  ELSE "No" END) as afiliacion_salud,
  `tbl_gen_salud_regimen`.`descripcion` as tipo_afiliacion,
  `tbl_gen_eps`.`descripcion` as nombre_eps,
  `tbl_gen_documento_tipo_acudiente`.`descripcion` as tipo_documento_acudiente,
  `acudiente_persona`.`documento` as documento_acudiente,
  `acudiente_persona`.`nombre_primero` as nombre_primero_acudiente,
  `acudiente_persona`.`nombre_segundo` as nombre_segundo_acudiente,
  `acudiente_persona`.`apellido_primero` as apellido_primero_acudiente,
  `acudiente_persona`.`apellido_segundo` as apellido_segundo_acudiente,
  `acudiente_persona`.`fecha_nacimiento` as fecha_nacimiento_acudiente,
  `acudiente_persona`.`telefono_fijo` as telefono_fijo_acudiente,
  `acudiente_persona`.`telefono_movil` as telefono_movil_acudiente,
  `acudiente_persona`.`correo_electronico` as correo_electronico_acudiente,
  (CASE WHEN (tbl_cm_ficha.parentesco_acudiente = 1) THEN "Madre/Padre" WHEN (tbl_cm_ficha.parentesco_acudiente = 2) THEN "Hermana/Hermano" WHEN (tbl_cm_ficha.parentesco_acudiente = 3) THEN "Tia/Tio" WHEN (tbl_cm_ficha.parentesco_acudiente = 4) THEN "Abuela/Abuelo" WHEN (tbl_cm_ficha.parentesco_acudiente = 5) THEN "Cuidador" ELSE "Otro" END) as parentesco_acudiente,
  tbl_cm_ficha.otro_parentesco_acudiente,
  `users`.`primer_nombre` as primer_nombre_formador,
  `users`.`segundo_apellido` as primer_apellido_formador

  FROM
  `tbl_gen_asistencias`
  LEFT JOIN `tbl_cm_ficha` ON (`tbl_gen_asistencias`.`ficha_id` = `tbl_cm_ficha`.`id`)
  LEFT JOIN `tbl_gen_persona` ON (`tbl_cm_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo`.`id`)
  LEFT JOIN `paises` ON (`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)
  LEFT OUTER JOIN `departamentos` ON (`tbl_gen_persona`.`id_procedencia_departamento` = `departamentos`.`id`)
  LEFT OUTER JOIN `municipios` ON (`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)
  LEFT OUTER JOIN `tbl_gen_corregimientos` ON (`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)
  LEFT OUTER JOIN `tbl_gen_veredas` ON (`tbl_gen_persona`.`id_residencia_vereda` = `tbl_gen_veredas`.`id`)
  LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
  LEFT OUTER JOIN `tbl_gen_estado_civil` ON (`tbl_gen_persona`.`id_estado_civil` = `tbl_gen_estado_civil`.`id`)
  LEFT OUTER JOIN `grupos` ON (`tbl_cm_ficha`.`grupo_id` = `grupos`.`id`)
  LEFT JOIN `sedes` ON (`sedes`.`id` = `grupos`.`sede_id`)
  LEFT JOIN `instituciones` ON (`instituciones`.`id` = `sedes`.`institucion_id`)
  LEFT JOIN `tbl_cm_grados` ON (`tbl_cm_grados`.`id` = `grupos`.`grado_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_cm_ficha`.`comuna_id`)
  LEFT OUTER JOIN `users` ON (`grupos`.`user_id` = `users`.`id`)
  LEFT OUTER JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_cm_ficha`.`escolaridad_id` = `tbl_gen_escolaridad_nivel`.`id`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_cm_ficha`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_cm_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_cm_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_cm_ficha`.`tipo_afiliacion`)

  LEFT JOIN `view_grupo_poblacional_ficha` ON (`tbl_cm_ficha`.`id` =
 `view_grupo_poblacional_ficha`.`ficha_id`)

  LEFT JOIN `view_discapacidad_persona_ficha` ON (`tbl_cm_ficha`.`id` =
  `view_discapacidad_persona_ficha`.`ficha_id`)

  LEFT OUTER JOIN `tbl_gen_eps` ON (`tbl_cm_ficha`.`salud_sgss_id` = `tbl_gen_eps`.`id`)
  LEFT JOIN `tbl_gen_persona` `acudiente_persona` ON (`tbl_cm_ficha`.`id_persona_acudiente` = `acudiente_persona`.`id`)
  LEFT JOIN `tbl_gen_documento_tipo` `tbl_gen_documento_tipo_acudiente` ON (`acudiente_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo_acudiente`.`id`)
  '.$wheres.'
  GROUP BY
  `tbl_gen_asistencias`.`ficha_id`');

  $items= json_decode( json_encode($data), true);
  Excel::create('items', function($excel) use($items) {
    $excel->sheet('ExportFile', function($sheet) use($items) {
        $sheet->fromArray($items);
    });
  })->export('xls');

}



 public function BeneficiariosDetallado(Request $request)
{

  $Filtro = array();
  $where  = array();
  $wheres = '';

    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {
        $dt1 = new \DateTime($request->entre);
        $carbon_entre = Carbon::instance($dt1);
        $entre = $carbon_entre->format('Y-m-d');
        $dt2 = new \DateTime($request->hasta);
        $carbon_hasta = Carbon::instance($dt2);
        $hasta = $carbon_hasta->format('Y-m-d');
        $where[]  = 'tbl_cm_ficha.fecha_inscripcion BETWEEN ' .'"'. $entre. '"'. ' AND ' . '"' .$hasta . '"';
    }
    if ($request->sexo != null)
    {
        $where[]  = 'tbl_gen_persona.sexo=' . (int)$request->sexo;
    }
    if ($request->entre_edad != null && $request->hasta_edad !=null)
    {
      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");
      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;

      $where[]  = 'TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) BETWEEN ' .'"'. $entre_edad. '"'. ' AND ' . '"' .$hasta_edad . '"';

    }
    if ($request->corregimiento != null)
    {
        $where[]  = 'tbl_gen_persona.id_residencia_corregimiento=' . (int)$request->corregimiento;
    }
    if ($request->barrio != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_barrio=' . (int)$request->barrio;
    }
    if ($request->comuna != null)
    {
        $where[]  = 'tbl_cm_ficha.comuna_id=' . (int)$request->comuna;
    }
    if ($request->estrato != null)
    {
      $where[]  = 'tbl_gen_persona.residencia_estrato=' . (int)$request->estrato;
    }
    if ($request->escolaridad != null)
    {
      $where[]  = 'grupos.grado_id=' . (int)$request->escolaridad;
    }
    if ($request->etnia != null)
    {
      $where[]  = 'tbl_cm_ficha.cultura_beneficiario=' . (int)$request->etnia;
    }
    if ($request->discapacidad != null)
    {
      $where[]  = 'view_discapacidad_persona_ficha.discapacidad_id=' . (int)$request->discapacidad;
    }
    if ($request->institucion != null)
    {
      $where[]  = 'instituciones.id=' . (int)$request->institucion;
    }
    if ($request->sede != null)
    {
      $where[]  = 'sedes.id=' . (int)$request->sede;
    }

   $where[]  = 'tbl_cm_ficha.tenantId =' . Auth::user()->tenantId;

  if (count($where) > 0)
    {
      $wheres = 'where ' . implode(' and ', $where);

    }

  $data = DB::select('select
  `tbl_gen_asistencias`.`ficha_id`,
  `grupos`.`codigo_grupo`,
  `tbl_cm_grados`.`nombre_grado`,
  instituciones.nombre_institucion,
  sedes.nombre_sede,
  ((count(`tbl_gen_asistencias`.`fecha_asistencia`))-SUM(`tbl_gen_asistencias`.`asistencia`) ) AS `inasistencias`,
  SUM(`tbl_gen_asistencias`.`asistencia`) AS `asistencias`,
  (count(`tbl_gen_asistencias`.`fecha_asistencia`)) AS `total`,
  `tbl_gen_documento_tipo`.`descripcion` AS `tipo_documento`,
  `tbl_gen_persona`.`documento`,
  `tbl_cm_ficha`.`no_ficha`,
  `tbl_cm_ficha`.`fecha_inscripcion`,
  `tbl_gen_persona`.`nombre_primero`,
  `tbl_gen_persona`.`nombre_segundo`,
  `tbl_gen_persona`.`apellido_primero`,
  `tbl_gen_persona`.`apellido_segundo`,
  `tbl_gen_persona`.`correo_electronico`,
  (CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "F" END) as sexo,
  `tbl_gen_persona`.`fecha_nacimiento`,
  `paises`.`nombre_pais` as pais_procedencia,
  `departamentos`.`nombre_departamento` as departamento_procedencia,
  `municipios`.`nombre_municipio` as municipio_procedencia,
  `tbl_gen_corregimientos`.`descripcion` AS `nombre_corregimiento`,
  `tbl_gen_veredas`.`nombre` as nombre_vereda,
  `barrios`.`nombre_barrio`,
  `tbl_gen_persona`.`residencia_estrato`,
  `comunas`.`nombre_comuna`,
  `tbl_gen_persona`.`residencia_direccion`,
  `tbl_gen_persona`.`telefono_fijo`,
  `tbl_gen_persona`.`telefono_movil`,
  `tbl_gen_escolaridad_nivel`.`descripcion` as nivel_escolaridad,
  `tbl_gen_escolaridad_estado`.`descripcion` as estado_escolaridad,
  `tbl_gen_ocupacion`.`descripcion` as ocupacion_beneficiario,
  `tbl_gen_estado_civil`.`descripcion` as estado_civil,
  (CASE WHEN (tbl_cm_ficha.hijos_beneficiario = 1) THEN "Si"  ELSE "No" END) as hijos_beneficiario,
  `tbl_cm_ficha`.`cantidad_hijos_beneficiario`,
  `tbl_gen_etnia`.`descripcion` as etnia_beneficiario,
  `view_grupo_poblacional_ficha`.`nombre` as poblacional,
  view_discapacidad_persona_ficha.nombre_discapacidad as discapacidades,
  (CASE WHEN (tbl_cm_ficha.discapacidad_beneficiario = 1) THEN "Si"  ELSE "No" END) as enfermedad_permanente,
  `tbl_cm_ficha`.`otra_discapacidad_beneficiario`,
  (CASE WHEN (tbl_cm_ficha.medicamentos_permanente_beneficiario = 1) THEN "Si"  ELSE "No" END) as toma_medicamentos,
  `tbl_cm_ficha`.`medicamentos_beneficiario`,
  `tbl_gen_persona`.`sangre_tipo`,
  (CASE WHEN (tbl_cm_ficha.afiliacion_salud = 1) THEN "Si"  ELSE "No" END) as afiliacion_salud,
  `tbl_gen_salud_regimen`.`descripcion` as tipo_afiliacion,
  `tbl_gen_eps`.`descripcion` as nombre_eps,
  `tbl_gen_documento_tipo_acudiente`.`descripcion` as tipo_documento_acudiente,
  `acudiente_persona`.`documento` as documento_acudiente,
  `acudiente_persona`.`nombre_primero` as nombre_primero_acudiente,
  `acudiente_persona`.`nombre_segundo` as nombre_segundo_acudiente,
  `acudiente_persona`.`apellido_primero` as apellido_primero_acudiente,
  `acudiente_persona`.`apellido_segundo` as apellido_segundo_acudiente,
  `acudiente_persona`.`fecha_nacimiento` as fecha_nacimiento_acudiente,
  `acudiente_persona`.`telefono_fijo` as telefono_fijo_acudiente,
  `acudiente_persona`.`telefono_movil` as telefono_movil_acudiente,
  `acudiente_persona`.`correo_electronico` as correo_electronico_acudiente,
  (CASE WHEN (tbl_cm_ficha.parentesco_acudiente = 1) THEN "Madre/Padre" WHEN (tbl_cm_ficha.parentesco_acudiente = 2) THEN "Hermana/Hermano" WHEN (tbl_cm_ficha.parentesco_acudiente = 3) THEN "Tia/Tio" WHEN (tbl_cm_ficha.parentesco_acudiente = 4) THEN "Abuela/Abuelo" WHEN (tbl_cm_ficha.parentesco_acudiente = 5) THEN "Cuidador" ELSE "Otro" END) as parentesco_acudiente,
  tbl_cm_ficha.otro_parentesco_acudiente,
  `users`.`primer_nombre` as primer_nombre_formador,
  `users`.`segundo_apellido` as primer_apellido_formador

  FROM
  `tbl_gen_asistencias`
  LEFT JOIN `tbl_cm_ficha` ON (`tbl_gen_asistencias`.`ficha_id` = `tbl_cm_ficha`.`id`)
  LEFT JOIN `tbl_gen_persona` ON (`tbl_cm_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo`.`id`)
  LEFT JOIN `paises` ON (`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)
  LEFT OUTER JOIN `departamentos` ON (`tbl_gen_persona`.`id_procedencia_departamento` = `departamentos`.`id`)
  LEFT OUTER JOIN `municipios` ON (`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)
  LEFT OUTER JOIN `tbl_gen_corregimientos` ON (`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)
  LEFT OUTER JOIN `tbl_gen_veredas` ON (`tbl_gen_persona`.`id_residencia_vereda` = `tbl_gen_veredas`.`id`)
  LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
  LEFT OUTER JOIN `tbl_gen_estado_civil` ON (`tbl_gen_persona`.`id_estado_civil` = `tbl_gen_estado_civil`.`id`)
  LEFT OUTER JOIN `grupos` ON (`tbl_cm_ficha`.`grupo_id` = `grupos`.`id`)
  LEFT JOIN `sedes` ON (`sedes`.`id` = `grupos`.`sede_id`)
  LEFT JOIN `instituciones` ON (`instituciones`.`id` = `sedes`.`institucion_id`)
  LEFT JOIN `tbl_cm_grados` ON (`tbl_cm_grados`.`id` = `grupos`.`grado_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_cm_ficha`.`comuna_id`)
  LEFT OUTER JOIN `users` ON (`grupos`.`user_id` = `users`.`id`)
  LEFT OUTER JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_cm_ficha`.`escolaridad_id` = `tbl_gen_escolaridad_nivel`.`id`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_cm_ficha`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_cm_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_cm_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_cm_ficha`.`tipo_afiliacion`)
 LEFT JOIN `view_grupo_poblacional_ficha` ON (`tbl_cm_ficha`.`id` = `view_grupo_poblacional_ficha`.`ficha_id`)
    LEFT OUTER JOIN `view_discapacidad_persona_ficha` ON (`tbl_cm_ficha`.`id` = `view_discapacidad_persona_ficha`.`ficha_id`)
  LEFT OUTER JOIN `tbl_gen_eps` ON (`tbl_cm_ficha`.`salud_sgss_id` = `tbl_gen_eps`.`id`)
  LEFT JOIN `tbl_gen_persona` `acudiente_persona` ON (`tbl_cm_ficha`.`id_persona_acudiente` = `acudiente_persona`.`id`)
  LEFT JOIN `tbl_gen_documento_tipo` `tbl_gen_documento_tipo_acudiente` ON (`acudiente_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo_acudiente`.`id`)

  '.$wheres.'
  GROUP BY
  `tbl_gen_asistencias`.`ficha_id`');

return response()->json(
      $data
    );

}

public function BeneficiariosGeneral(Request $request)
{

  $Filtro = array();
  $where  = array();
  $wheres = '';
    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {
        $dt1 = new \DateTime($request->entre);
        $carbon_entre = Carbon::instance($dt1);
        $entre = $carbon_entre->format('Y-m-d');
        $dt2 = new \DateTime($request->hasta);
        $carbon_hasta = Carbon::instance($dt2);
        $hasta = $carbon_hasta->format('Y-m-d');
        $where[]  = 'tbl_cm_ficha.fecha_inscripcion BETWEEN ' .'"'. $entre. '"'. ' AND ' . '"' .$hasta . '"';
    }
    if ($request->sexo != null)
    {
       $where[]  = 'tbl_gen_persona.sexo=' . (int)$request->sexo;
    }
    if ($request->entre_edad != null && $request->hasta_edad !=null)
    {
      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");
      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;

      $where[]  = 'TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) BETWEEN ' .'"'. $entre_edad. '"'. ' AND ' . '"' .$hasta_edad . '"';

    }
    if ($request->corregimiento != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_corregimiento=' . (int)$request->corregimiento;
    }
    if ($request->barrio != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_barrio=' . (int)$request->barrio;
    }
    if ($request->comuna != null)
    {
        $where[]  = 'tbl_cm_ficha.comuna_id=' . (int)$request->comuna;
    }
    if ($request->estrato != null)
    {
      $where[]  = 'tbl_gen_persona.residencia_estrato=' . (int)$request->estrato;
    }
    if ($request->escolaridad != null)
    {
      $where[]  = 'grupos.grado_id=' . (int)$request->escolaridad;
    }
    if ($request->etnia != null)
    {
      $where[]  = 'tbl_cm_ficha.cultura_beneficiario=' . (int)$request->etnia;
    }
    if ($request->discapacidad != null)
    {
      $where[]  = 'view_discapacidad_persona_ficha.discapacidad_id=' . (int)$request->discapacidad;
    }
    if ($request->institucion != null)
    {
      $where[]  = 'instituciones.id=' . (int)$request->institucion;
    }
    if ($request->sede != null)
    {
      $where[]  = 'sedes.id=' . (int)$request->sede;
    }

     $where[]  = 'tbl_cm_ficha.tenantId =' . Auth::user()->tenantId;

    if (count($where) > 0)
      {
        $wheres = 'where ' . implode(' and ', $where);

      }

  $data = DB::select('select

  tbl_cm_ficha.id,
      grupos.codigo_grupo,
      tbl_cm_grados.nombre_grado,
      instituciones.nombre_institucion,
      sedes.nombre_sede,
      tbl_gen_documento_tipo.descripcion as tipo_documento,
      tbl_gen_persona.documento,
      tbl_cm_ficha.no_ficha,
      tbl_cm_ficha.fecha_inscripcion,
      tbl_gen_persona.nombre_primero,
      tbl_gen_persona.nombre_segundo,
      tbl_gen_persona.apellido_primero,
      tbl_gen_persona.apellido_segundo,
      tbl_gen_persona.correo_electronico,
      (CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "F" END) as sexo,
      tbl_gen_persona.fecha_nacimiento,
      TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) AS edad_persona,
      paises.nombre_pais,
      departamentos.nombre_departamento,
      municipios.nombre_municipio,
      tbl_gen_corregimientos.descripcion as nombre_corregimiento,
      tbl_gen_veredas.nombre as nombre_vereda,
      barrios.nombre_barrio,
      tbl_gen_persona.residencia_estrato,
      comunas.nombre_comuna,
      tbl_gen_persona.residencia_direccion,
      tbl_gen_persona.telefono_fijo,
      tbl_gen_persona.telefono_movil,
      tbl_gen_escolaridad_nivel.descripcion as nivel_escolaridad,
      tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
      `tbl_gen_ocupacion`.`descripcion` as ocupacion_beneficiario,
      tbl_gen_estado_civil.descripcion as estado_civil,
      (CASE WHEN (tbl_cm_ficha.hijos_beneficiario = 1) THEN "Si"  ELSE "No" END) as hijos_beneficiario,
      tbl_cm_ficha.cantidad_hijos_beneficiario,
      tbl_gen_etnia.descripcion as etnia_beneficiario,
      (CASE WHEN (tbl_cm_ficha.discapacidad_beneficiario = 1) THEN "Si"  ELSE "No" END) as enfermedad_permanente,
      `tbl_cm_ficha`.`otra_discapacidad_beneficiario`,
      (CASE WHEN (tbl_cm_ficha.medicamentos_permanente_beneficiario = 1) THEN "Si"  ELSE "No" END) as toma_medicamentos,
      `tbl_cm_ficha`.`medicamentos_beneficiario`,
      `tbl_gen_persona`.`sangre_tipo`,
      view_grupo_poblacional_ficha.nombre as grupo_poblacional,
      view_discapacidad_persona_ficha.nombre_discapacidad as discapacidades,
      (CASE WHEN (tbl_cm_ficha.afiliacion_salud = 1) THEN "Si"  ELSE "No" END) as afiliacion_salud,
      `tbl_gen_salud_regimen`.`descripcion` as tipo_afiliacion,
      `tbl_gen_eps`.`descripcion` as nombre_eps,
      tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
      acudiente_persona.documento as documento_acudiente,
      acudiente_persona.nombre_primero as primer_nombre_acudiente,
      acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
      acudiente_persona.apellido_primero as primer_apellido_acudiente,
      acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          (CASE WHEN (acudiente_persona.sexo = 1) THEN "Mujer" WHEN (acudiente_persona.sexo = 2) THEN "Hombre" ELSE "F" END) as sexo_acudiente,
      acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
      acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
      acudiente_persona.telefono_movil as telefono_movil_acudiente,
      acudiente_persona.correo_electronico as correo_acudiente,
      (CASE WHEN (tbl_cm_ficha.parentesco_acudiente = 1) THEN "Madre/Padre" WHEN (tbl_cm_ficha.parentesco_acudiente = 2) THEN "Hermana/Hermano" WHEN (tbl_cm_ficha.parentesco_acudiente = 3) THEN "Tia/Tio" WHEN (tbl_cm_ficha.parentesco_acudiente = 4) THEN "Abuela/Abuelo" WHEN (tbl_cm_ficha.parentesco_acudiente = 5) THEN "Cuidador" ELSE "Otro" END) as parentesco_acudiente,
      tbl_cm_ficha.otro_parentesco_acudiente,
      users.primer_nombre as primer_nombre_usuario,
      users.primer_apellido as primer_apellido_usuario

  FROM
  `tbl_cm_ficha`
  LEFT JOIN `tbl_gen_persona` ON (`tbl_gen_persona`.`id` = `tbl_cm_ficha`.`id_persona_beneficiario`)
  LEFT JOIN `tbl_gen_persona`  AS acudiente_persona ON acudiente_persona.`id` = tbl_cm_ficha.`id_persona_acudiente`
  LEFT JOIN `poblacional_beneficiarios` ON (`tbl_cm_ficha`.`id` = `poblacional_beneficiarios`.`ficha_id`)
  LEFT JOIN `tbl_cm_persona_x_discapacidad` ON (`tbl_cm_ficha`.`id` = `tbl_cm_persona_x_discapacidad`.`ficha_id`)
  LEFT JOIN `grupos` ON (`grupos`.`id` = `tbl_cm_ficha`.`grupo_id`)
  LEFT JOIN `sedes` ON (`sedes`.`id` = `grupos`.`sede_id`)
  LEFT JOIN `instituciones` ON (`instituciones`.`id` = `sedes`.`institucion_id`)
  LEFT JOIN `tbl_cm_grados` ON (`tbl_cm_grados`.`id` = `grupos`.`grado_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_cm_ficha`.`comuna_id`)
  LEFT JOIN `users` ON (`users`.`id` = `grupos`.`user_id`)

  LEFT JOIN `view_grupo_poblacional_ficha` ON (`tbl_cm_ficha`.`id` = `view_grupo_poblacional_ficha`.`ficha_id`)

  LEFT JOIN `view_discapacidad_persona_ficha` ON (`tbl_cm_ficha`.`id` = `view_discapacidad_persona_ficha`.`ficha_id`)

  LEFT JOIN `paises` ON (`paises`.`id` = `tbl_gen_persona`.`id_procedencia_pais`)
  LEFT JOIN `departamentos` ON (`departamentos`.`id` = `tbl_gen_persona`.`id_procedencia_departamento`)
  LEFT JOIN `municipios` ON (`municipios`.`id` = `tbl_gen_persona`.`id_procedencia_municipio`)
  LEFT JOIN `barrios` ON (`barrios`.`id` = `tbl_gen_persona`.`id_residencia_barrio`)
  LEFT JOIN `tbl_gen_corregimientos` ON (`tbl_gen_corregimientos`.`id` = `tbl_gen_persona`.`id_residencia_corregimiento`)
  LEFT JOIN `tbl_gen_veredas` ON (`tbl_gen_veredas`.`id` = `tbl_gen_persona`.`id_residencia_vereda`)
  LEFT JOIN `tbl_gen_estado_civil` ON (`tbl_gen_estado_civil`.`id` = `tbl_gen_persona`.`id_estado_civil`)
  LEFT JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_gen_escolaridad_nivel`.`id` = `tbl_cm_ficha`.`escolaridad_id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_documento_tipo`.`id` = `tbl_gen_persona`.`id_documento_tipo`)
  LEFT JOIN `tbl_gen_documento_tipo`  AS tipo_documento_acudiente ON tipo_documento_acudiente.`id` = tbl_gen_persona.`id_documento_tipo`
  LEFT JOIN `tbl_gen_eps` ON (`tbl_gen_eps`.`id` = `tbl_cm_ficha`.`salud_sgss_id`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_cm_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_cm_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_cm_ficha`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_cm_ficha`.`tipo_afiliacion`)
  '.$wheres.'
  GROUP BY
  `tbl_cm_ficha`.`id`');
  return response()->json(
        $data
      );

}
public function ExportBeneficiariosGeneral(Request $request)
{

 // return response()->json(1);
// dd($request->all());


  $Filtro = array();
  $where  = array();
  $wheres = '';
    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {
        $dt1 = new \DateTime($request->entre);
        $carbon_entre = Carbon::instance($dt1);
        $entre = $carbon_entre->format('Y-m-d');
        $dt2 = new \DateTime($request->hasta);
        $carbon_hasta = Carbon::instance($dt2);
        $hasta = $carbon_hasta->format('Y-m-d');
        $where[]  = 'tbl_cm_ficha.fecha_inscripcion BETWEEN ' .'"'. $entre. '"'. ' AND ' . '"' .$hasta . '"';
    }
    if ($request->sexo != null)
    {
       $where[]  = 'tbl_gen_persona.sexo=' . (int)$request->sexo;
    }
    if ($request->entre_edad != null && $request->hasta_edad !=null)
    {
      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");
      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;

      $where[]  = 'TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) BETWEEN ' .'"'. $entre_edad. '"'. ' AND ' . '"' .$hasta_edad . '"';

    }
    if ($request->corregimiento != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_corregimiento=' . (int)$request->corregimiento;
    }
    if ($request->barrio != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_barrio=' . (int)$request->barrio;
    }
    if ($request->comuna != null)
    {
        $where[]  = 'tbl_cm_ficha.comuna_id=' . (int)$request->comuna;
    }
    if ($request->estrato != null)
    {
      $where[]  = 'tbl_gen_persona.residencia_estrato=' . (int)$request->estrato;
    }
    if ($request->escolaridad != null)
    {
      $where[]  = 'grupos.grado_id=' . (int)$request->escolaridad;
    }
    if ($request->etnia != null)
    {
      $where[]  = 'tbl_cm_ficha.cultura_beneficiario=' . (int)$request->etnia;
    }
    if ($request->discapacidad != null)
    {
      $where[]  = 'view_discapacidad_persona_ficha.discapacidad_id=' . (int)$request->discapacidad;
    }

    if ($request->institucion != null)
    {
      $where[]  = 'instituciones.id=' . (int)$request->institucion;
    }
    if ($request->sede != null)
    {
      $where[]  = 'sedes.id=' . (int)$request->sede;
    }

    $where[]  = 'tbl_cm_ficha.tenantId =' . Auth::user()->tenantId;

    if (count($where) > 0)
      {
        $wheres = 'where ' . implode(' and ', $where);

      }

  $data = DB::select('select

  COALESCE(grupos.codigo_grupo, " ") as codigo_grupo,
  COALESCE(tbl_cm_grados.nombre_grado, " ") as nombre_grado,
  COALESCE(instituciones.nombre_institucion, " ") as nombre_institucion,
  COALESCE(sedes.nombre_sede, "") as nombre_sede,
  COALESCE(tbl_gen_documento_tipo.descripcion, " ") as tipo_documento,
  COALESCE(tbl_gen_persona.documento, "") as documento,
  COALESCE(tbl_cm_ficha.no_ficha, " ") as no_ficha,
  COALESCE(tbl_cm_ficha.fecha_inscripcion, " ") as fecha_inscripcion,
  COALESCE(tbl_gen_persona.nombre_primero, " ") as nombre_primero,
  COALESCE(tbl_gen_persona.nombre_segundo, " ") as nombre_segundo,
  COALESCE(tbl_gen_persona.apellido_primero, " ") as apellido_primero,
  COALESCE(tbl_gen_persona.apellido_segundo, " ") as apellido_segundo,
  COALESCE(tbl_gen_persona.correo_electronico, " ") as correo_electronico,
  COALESCE((CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "F" END), " ") as sexo,
  COALESCE(tbl_gen_persona.fecha_nacimiento, " ") as fecha_nacimiento,
  COALESCE(TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()), " ") AS edad_persona,
  COALESCE(paises.nombre_pais, " ") as nombre_pais,
  COALESCE(departamentos.nombre_departamento, " ") as nombre_departamento,
  COALESCE(municipios.nombre_municipio, " ") as nombre_municipio,
  COALESCE(tbl_gen_corregimientos.descripcion, " ") as nombre_corregimiento,
  COALESCE(tbl_gen_veredas.nombre, " ") as nombre_vereda,
  COALESCE(barrios.nombre_barrio, " ") as nombre_barrio,
  COALESCE(tbl_gen_persona.residencia_estrato, " ") as residencia_estrato,
  COALESCE(comunas.nombre_comuna, "") as nombre_comuna,
  COALESCE(tbl_gen_persona.residencia_direccion, " ") as residencia_direccion,
  COALESCE(tbl_gen_persona.telefono_fijo, " ") as telefono_fijo,
  COALESCE(tbl_gen_persona.telefono_movil, " ") as telefono_movil,
  COALESCE(tbl_gen_escolaridad_nivel.descripcion, " ") as nivel_escolaridad,
  COALESCE(tbl_gen_escolaridad_estado.descripcion, " ") as estado_escolaridad,
  COALESCE(`tbl_gen_ocupacion`.`descripcion`, " ") as ocupacion_beneficiario,
  COALESCE(tbl_gen_estado_civil.descripcion, " ") as estado_civil,
  COALESCE((CASE WHEN (tbl_cm_ficha.hijos_beneficiario = 1) THEN "Si"  ELSE "No" END), " ") as hijos_beneficiario,
  COALESCE(tbl_cm_ficha.cantidad_hijos_beneficiario, " ") as cantidad_hijos_beneficiario,
  COALESCE(tbl_gen_etnia.descripcion, " ") as etnia_beneficiario,
  COALESCE(view_grupo_poblacional_ficha.nombre, " ") as grupo_poblacional,
  COALESCE(view_discapacidad_persona_ficha.nombre_discapacidad, " ") as discapacidades,
  COALESCE((CASE WHEN (tbl_cm_ficha.discapacidad_beneficiario = 1) THEN "Si"  ELSE "No" END), " ") as enfermedad_permanente,
  COALESCE(`tbl_cm_ficha`.`otra_discapacidad_beneficiario`, " ") as otra_discapacidad_beneficiario,
  COALESCE((CASE WHEN (tbl_cm_ficha.medicamentos_permanente_beneficiario = 1) THEN "Si"  ELSE "No" END), " ") as toma_medicamentos,
  COALESCE(`tbl_cm_ficha`.`medicamentos_beneficiario`, " ") as medicamentos_beneficiario,
  COALESCE(`tbl_gen_persona`.`sangre_tipo`, " ") as sangre_tipo,
  COALESCE((CASE WHEN (tbl_cm_ficha.afiliacion_salud = 1) THEN "Si"  ELSE "No" END), " ") as afiliacion_salud,
  COALESCE(`tbl_gen_salud_regimen`.`descripcion`, " ") as tipo_afiliacion,
  COALESCE(`tbl_gen_eps`.`descripcion`, " ") as nombre_eps,
  COALESCE(tipo_documento_acudiente.descripcion, " ") as tipo_documento_acudiente,
  COALESCE(acudiente_persona.documento, " ") as documento_acudiente,
  COALESCE(acudiente_persona.nombre_primero, " ") as primer_nombre_acudiente,
  COALESCE(acudiente_persona.nombre_segundo, " ") as segundo_nombre_acudiente,
  COALESCE(acudiente_persona.apellido_primero, " ") as primer_apellido_acudiente,
  COALESCE(acudiente_persona.apellido_segundo, " ") as segundo_apellido_acudiente,
  COALESCE((CASE WHEN (acudiente_persona.sexo = 1) THEN "Mujer" WHEN (acudiente_persona.sexo = 2) THEN "Hombre" ELSE "Mujer" END), " ") as sexo_acudiente,
  COALESCE(acudiente_persona.fecha_nacimiento, " ") as fecha_nacimiento_acudiente,
  COALESCE(acudiente_persona.telefono_fijo, " ") as telefono_fijo_acudiente,
  COALESCE(acudiente_persona.telefono_movil, " ") as telefono_movil_acudiente,
  COALESCE(acudiente_persona.correo_electronico, " ") as correo_acudiente,
  COALESCE((CASE WHEN (tbl_cm_ficha.parentesco_acudiente = 1) THEN "Madre/Padre" WHEN (tbl_cm_ficha.parentesco_acudiente = 2) THEN "Hermana/Hermano" WHEN (tbl_cm_ficha.parentesco_acudiente = 3) THEN "Tia/Tio" WHEN (tbl_cm_ficha.parentesco_acudiente = 4) THEN "Abuela/Abuelo" WHEN (tbl_cm_ficha.parentesco_acudiente = 5) THEN "Cuidador" ELSE "Otro" END), " ") as parentesco_acudiente,
  COALESCE(tbl_cm_ficha.otro_parentesco_acudiente, " ") as otro_parentesco_acudiente,
  users.primer_nombre as primer_nombre_usuario,
  users.primer_apellido as primer_apellido_usuario

  FROM
  `tbl_cm_ficha`
  LEFT JOIN `tbl_gen_persona` ON (`tbl_gen_persona`.`id` = `tbl_cm_ficha`.`id_persona_beneficiario`)
  LEFT JOIN `tbl_gen_persona`  AS acudiente_persona ON acudiente_persona.`id` = tbl_cm_ficha.`id_persona_acudiente`
  LEFT JOIN `poblacional_beneficiarios` ON (`tbl_cm_ficha`.`id` = `poblacional_beneficiarios`.`ficha_id`)
  LEFT JOIN `tbl_cm_persona_x_discapacidad` ON (`tbl_cm_ficha`.`id` = `tbl_cm_persona_x_discapacidad`.`ficha_id`)
  LEFT JOIN `grupos` ON (`grupos`.`id` = `tbl_cm_ficha`.`grupo_id`)
  LEFT JOIN `sedes` ON (`sedes`.`id` = `grupos`.`sede_id`)
  LEFT JOIN `instituciones` ON (`instituciones`.`id` = `sedes`.`institucion_id`)
  LEFT JOIN `tbl_cm_grados` ON (`tbl_cm_grados`.`id` = `grupos`.`grado_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_cm_ficha`.`comuna_id`)
  LEFT JOIN `users` ON (`users`.`id` = `grupos`.`user_id`)
  LEFT JOIN `view_grupo_poblacional_ficha` ON (`tbl_cm_ficha`.`id` = `view_grupo_poblacional_ficha`.`ficha_id`)
  LEFT JOIN `view_discapacidad_persona_ficha` ON (`tbl_cm_ficha`.`id` = `view_discapacidad_persona_ficha`.`ficha_id`)
  LEFT JOIN `paises` ON (`paises`.`id` = `tbl_gen_persona`.`id_procedencia_pais`)
  LEFT JOIN `departamentos` ON (`departamentos`.`id` = `tbl_gen_persona`.`id_procedencia_departamento`)
  LEFT JOIN `municipios` ON (`municipios`.`id` = `tbl_gen_persona`.`id_procedencia_municipio`)
  LEFT JOIN `barrios` ON (`barrios`.`id` = `tbl_gen_persona`.`id_residencia_barrio`)
  LEFT JOIN `tbl_gen_corregimientos` ON (`tbl_gen_corregimientos`.`id` = `tbl_gen_persona`.`id_residencia_corregimiento`)
  LEFT JOIN `tbl_gen_veredas` ON (`tbl_gen_veredas`.`id` = `tbl_gen_persona`.`id_residencia_vereda`)
  LEFT JOIN `tbl_gen_estado_civil` ON (`tbl_gen_estado_civil`.`id` = `tbl_gen_persona`.`id_estado_civil`)
  LEFT JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_gen_escolaridad_nivel`.`id` = `tbl_cm_ficha`.`escolaridad_id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_documento_tipo`.`id` = `tbl_gen_persona`.`id_documento_tipo`)
  LEFT JOIN `tbl_gen_documento_tipo`  AS tipo_documento_acudiente ON tipo_documento_acudiente.`id` = acudiente_persona.`id_documento_tipo`
  LEFT JOIN `tbl_gen_eps` ON (`tbl_gen_eps`.`id` = `tbl_cm_ficha`.`salud_sgss_id`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_cm_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_cm_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_cm_ficha`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_cm_ficha`.`tipo_afiliacion`)
  '.$wheres.'
  GROUP BY
  `tbl_cm_ficha`.`id`');


return response()->json(
        $data
      );

//   $items= json_decode( json_encode($data), true);

// Excel::create('items', function($excel) use($items) {
//   $excel->sheet('ExportFile', function($sheet) use($items) {
//       $sheet->fromArray($items);
//   });
// })->export('xls');

}


public function ExportBeneficiariosGeneral2(Request $request)
{

  $Filtro = array();
  $where  = array();
  $wheres = '';
    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {


        $where[]  = 'tbl_cm_ficha.fecha_inscripcion BETWEEN ' .'"'. $request->entre. '"'. ' AND ' . '"' .$request->hasta . '"';
    }
    if ($request->sexo != null)
    {
       $where[]  = 'tbl_gen_persona.sexo=' . (int)$request->sexo;
    }
    if ($request->entre_edad != null && $request->hasta_edad !=null)
    {
      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");
      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;

      $where[]  = 'TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) BETWEEN ' .'"'. $entre_edad. '"'. ' AND ' . '"' .$hasta_edad . '"';

    }
    if ($request->corregimiento != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_corregimiento=' . (int)$request->corregimiento;
    }
    if ($request->barrio != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_barrio=' . (int)$request->barrio;
    }
    if ($request->comuna != null)
    {
        $where[]  = 'tbl_cm_ficha.comuna_id=' . (int)$request->comuna;
    }
    if ($request->estrato != null)
    {
      $where[]  = 'tbl_gen_persona.residencia_estrato=' . (int)$request->estrato;
    }
    if ($request->escolaridad != null)
    {
      $where[]  = 'grupos.grado_id=' . (int)$request->escolaridad;
    }
    if ($request->etnia != null)
    {
      $where[]  = 'tbl_cm_ficha.cultura_beneficiario=' . (int)$request->etnia;
    }
    if ($request->discapacidad != null)
    {
      $where[]  = 'view_discapacidad_persona_ficha.discapacidad_id=' . (int)$request->discapacidad;
    }

    if ($request->institucion != null)
    {
      $where[]  = 'instituciones.id=' . (int)$request->institucion;
    }
    if ($request->sede != null)
    {
      $where[]  = 'sedes.id=' . (int)$request->sede;
    }

    $where[]  = 'tbl_cm_ficha.tenantId =' . Auth::user()->tenantId;
    // $where[]  = 'YEAR(tbl_cm_ficha.fecha_inscripcion) =' . $request->anual;
    // $where[]  = 'MONTH(tbl_cm_ficha.fecha_inscripcion) =' . $request->mes;

    if (count($where) > 0)
      {
        $wheres = 'where ' . implode(' and ', $where);

      }



  $data = DB::select('select

  COALESCE(grupos.codigo_grupo, " ") as codigo_grupo,
  COALESCE(tbl_cm_grados.nombre_grado, " ") as nombre_grado,
  COALESCE(instituciones.nombre_institucion, " ") as nombre_institucion,
  COALESCE(sedes.nombre_sede, "") as nombre_sede,
  COALESCE(tbl_gen_documento_tipo.descripcion, " ") as tipo_documento,
  COALESCE(tbl_gen_persona.documento, "") as documento,
  COALESCE(tbl_cm_ficha.no_ficha, " ") as no_ficha,
  COALESCE(tbl_cm_ficha.fecha_inscripcion, " ") as fecha_inscripcion,
  COALESCE(tbl_gen_persona.nombre_primero, " ") as nombre_primero,
  COALESCE(tbl_gen_persona.nombre_segundo, " ") as nombre_segundo,
  COALESCE(tbl_gen_persona.apellido_primero, " ") as apellido_primero,
  COALESCE(tbl_gen_persona.apellido_segundo, " ") as apellido_segundo,
  COALESCE(tbl_gen_persona.correo_electronico, " ") as correo_electronico,
  COALESCE((CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "F" END), " ") as sexo,
  COALESCE(tbl_gen_persona.fecha_nacimiento, " ") as fecha_nacimiento,
  COALESCE(TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()), " ") AS edad_persona,
  COALESCE(paises.nombre_pais, " ") as nombre_pais,
  COALESCE(departamentos.nombre_departamento, " ") as nombre_departamento,
  COALESCE(municipios.nombre_municipio, " ") as nombre_municipio,
  COALESCE(tbl_gen_corregimientos.descripcion, " ") as nombre_corregimiento,
  COALESCE(tbl_gen_veredas.nombre, " ") as nombre_vereda,
  COALESCE(barrios.nombre_barrio, " ") as nombre_barrio,
  COALESCE(tbl_gen_persona.residencia_estrato, " ") as residencia_estrato,
  COALESCE(comunas.nombre_comuna, "") as nombre_comuna,
  COALESCE(tbl_gen_persona.residencia_direccion, " ") as residencia_direccion,
  COALESCE(tbl_gen_persona.telefono_fijo, " ") as telefono_fijo,
  COALESCE(tbl_gen_persona.telefono_movil, " ") as telefono_movil,
  COALESCE(tbl_gen_escolaridad_nivel.descripcion, " ") as nivel_escolaridad,
  COALESCE(tbl_gen_escolaridad_estado.descripcion, " ") as estado_escolaridad,
  COALESCE(`tbl_gen_ocupacion`.`descripcion`, " ") as ocupacion_beneficiario,
  COALESCE(tbl_gen_estado_civil.descripcion, " ") as estado_civil,
  COALESCE((CASE WHEN (tbl_cm_ficha.hijos_beneficiario = 1) THEN "Si"  ELSE "No" END), " ") as hijos_beneficiario,
  COALESCE(tbl_cm_ficha.cantidad_hijos_beneficiario, " ") as cantidad_hijos_beneficiario,
  COALESCE(tbl_gen_etnia.descripcion, " ") as etnia_beneficiario,
  COALESCE(view_grupo_poblacional_ficha.nombre, " ") as grupo_poblacional,
  COALESCE(view_discapacidad_persona_ficha.nombre_discapacidad, " ") as discapacidades,
  COALESCE((CASE WHEN (tbl_cm_ficha.discapacidad_beneficiario = 1) THEN "Si"  ELSE "No" END), " ") as enfermedad_permanente,
  COALESCE(`tbl_cm_ficha`.`otra_discapacidad_beneficiario`, " ") as otra_discapacidad_beneficiario,
  COALESCE((CASE WHEN (tbl_cm_ficha.medicamentos_permanente_beneficiario = 1) THEN "Si"  ELSE "No" END), " ") as toma_medicamentos,
  COALESCE(`tbl_cm_ficha`.`medicamentos_beneficiario`, " ") as medicamentos_beneficiario,
  COALESCE(`tbl_gen_persona`.`sangre_tipo`, " ") as sangre_tipo,
  COALESCE((CASE WHEN (tbl_cm_ficha.afiliacion_salud = 1) THEN "Si"  ELSE "No" END), " ") as afiliacion_salud,
  COALESCE(`tbl_gen_salud_regimen`.`descripcion`, " ") as tipo_afiliacion,
  COALESCE(`tbl_gen_eps`.`descripcion`, " ") as nombre_eps,
  COALESCE(tipo_documento_acudiente.descripcion, " ") as tipo_documento_acudiente,
  COALESCE(acudiente_persona.documento, " ") as documento_acudiente,
  COALESCE(acudiente_persona.nombre_primero, " ") as primer_nombre_acudiente,
  COALESCE(acudiente_persona.nombre_segundo, " ") as segundo_nombre_acudiente,
  COALESCE(acudiente_persona.apellido_primero, " ") as primer_apellido_acudiente,
  COALESCE(acudiente_persona.apellido_segundo, " ") as segundo_apellido_acudiente,
  COALESCE((CASE WHEN (acudiente_persona.sexo = 1) THEN "Mujer" WHEN (acudiente_persona.sexo = 2) THEN "Hombre" ELSE "Mujer" END), " ") as sexo_acudiente,
  COALESCE(acudiente_persona.fecha_nacimiento, " ") as fecha_nacimiento_acudiente,
  COALESCE(acudiente_persona.telefono_fijo, " ") as telefono_fijo_acudiente,
  COALESCE(acudiente_persona.telefono_movil, " ") as telefono_movil_acudiente,
  COALESCE(acudiente_persona.correo_electronico, " ") as correo_acudiente,
  COALESCE((CASE WHEN (tbl_cm_ficha.parentesco_acudiente = 1) THEN "Madre/Padre" WHEN (tbl_cm_ficha.parentesco_acudiente = 2) THEN "Hermana/Hermano" WHEN (tbl_cm_ficha.parentesco_acudiente = 3) THEN "Tia/Tio" WHEN (tbl_cm_ficha.parentesco_acudiente = 4) THEN "Abuela/Abuelo" WHEN (tbl_cm_ficha.parentesco_acudiente = 5) THEN "Cuidador" ELSE "Otro" END), " ") as parentesco_acudiente,
  COALESCE(tbl_cm_ficha.otro_parentesco_acudiente, " ") as otro_parentesco_acudiente,
  users.primer_nombre as primer_nombre_usuario,
  users.primer_apellido as primer_apellido_usuario

  FROM
  `tbl_cm_ficha`
  LEFT JOIN `tbl_gen_persona` ON (`tbl_gen_persona`.`id` = `tbl_cm_ficha`.`id_persona_beneficiario`)
  LEFT JOIN `tbl_gen_persona`  AS acudiente_persona ON acudiente_persona.`id` = tbl_cm_ficha.`id_persona_acudiente`
  LEFT JOIN `poblacional_beneficiarios` ON (`tbl_cm_ficha`.`id` = `poblacional_beneficiarios`.`ficha_id`)
  LEFT JOIN `tbl_cm_persona_x_discapacidad` ON (`tbl_cm_ficha`.`id` = `tbl_cm_persona_x_discapacidad`.`ficha_id`)
  LEFT JOIN `grupos` ON (`grupos`.`id` = `tbl_cm_ficha`.`grupo_id`)
  LEFT JOIN `sedes` ON (`sedes`.`id` = `grupos`.`sede_id`)
  LEFT JOIN `instituciones` ON (`instituciones`.`id` = `sedes`.`institucion_id`)
  LEFT JOIN `tbl_cm_grados` ON (`tbl_cm_grados`.`id` = `grupos`.`grado_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_cm_ficha`.`comuna_id`)
  LEFT JOIN `users` ON (`users`.`id` = `grupos`.`user_id`)
  LEFT JOIN `view_grupo_poblacional_ficha` ON (`tbl_cm_ficha`.`id` = `view_grupo_poblacional_ficha`.`ficha_id`)
  LEFT JOIN `view_discapacidad_persona_ficha` ON (`tbl_cm_ficha`.`id` = `view_discapacidad_persona_ficha`.`ficha_id`)
  LEFT JOIN `paises` ON (`paises`.`id` = `tbl_gen_persona`.`id_procedencia_pais`)
  LEFT JOIN `departamentos` ON (`departamentos`.`id` = `tbl_gen_persona`.`id_procedencia_departamento`)
  LEFT JOIN `municipios` ON (`municipios`.`id` = `tbl_gen_persona`.`id_procedencia_municipio`)
  LEFT JOIN `barrios` ON (`barrios`.`id` = `tbl_gen_persona`.`id_residencia_barrio`)
  LEFT JOIN `tbl_gen_corregimientos` ON (`tbl_gen_corregimientos`.`id` = `tbl_gen_persona`.`id_residencia_corregimiento`)
  LEFT JOIN `tbl_gen_veredas` ON (`tbl_gen_veredas`.`id` = `tbl_gen_persona`.`id_residencia_vereda`)
  LEFT JOIN `tbl_gen_estado_civil` ON (`tbl_gen_estado_civil`.`id` = `tbl_gen_persona`.`id_estado_civil`)
  LEFT JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_gen_escolaridad_nivel`.`id` = `tbl_cm_ficha`.`escolaridad_id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_documento_tipo`.`id` = `tbl_gen_persona`.`id_documento_tipo`)
  LEFT JOIN `tbl_gen_documento_tipo`  AS tipo_documento_acudiente ON tipo_documento_acudiente.`id` = acudiente_persona.`id_documento_tipo`
  LEFT JOIN `tbl_gen_eps` ON (`tbl_gen_eps`.`id` = `tbl_cm_ficha`.`salud_sgss_id`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_cm_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_cm_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_cm_ficha`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_cm_ficha`.`tipo_afiliacion`)
  '.$wheres.'
  GROUP BY
  `tbl_cm_ficha`.`id`


  ');


  return ['datos' => $data];


}



public function generar_total(Request $request)
{


  // dd($request->all());

  $Filtro = array();
  $where  = array();
  $wheres = '';
    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {


        $where[]  = 'tbl_cm_ficha.fecha_inscripcion BETWEEN ' .'"'. $request->entre. '"'. ' AND ' . '"' .$request->hasta . '"';
    }
    if ($request->sexo != null)

    {
       $where[]  = 'tbl_gen_persona.sexo=' . (int)$request->sexo;
    }
    if ($request->entre_edad != null && $request->hasta_edad !=null)
    {
      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");
      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;

      $where[]  = 'TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) BETWEEN ' .'"'. $entre_edad. '"'. ' AND ' . '"' .$hasta_edad . '"';

    }
    if ($request->corregimiento != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_corregimiento=' . (int)$request->corregimiento;
    }
    if ($request->barrio != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_barrio=' . (int)$request->barrio;
    }
    if ($request->comuna != null)
    {
        $where[]  = 'tbl_cm_ficha.comuna_id=' . (int)$request->comuna;
    }
    if ($request->estrato != null)
    {
      $where[]  = 'tbl_gen_persona.residencia_estrato=' . (int)$request->estrato;
    }
    if ($request->escolaridad != null)
    {
      $where[]  = 'grupos.grado_id=' . (int)$request->escolaridad;
    }
    if ($request->etnia != null)
    {
      $where[]  = 'tbl_cm_ficha.cultura_beneficiario=' . (int)$request->etnia;
    }
    if ($request->discapacidad != null)
    {
      $where[]  = 'view_discapacidad_persona_ficha.discapacidad_id=' . (int)$request->discapacidad;
    }

    if ($request->institucion != null)
    {
      $where[]  = 'instituciones.id=' . (int)$request->institucion;
    }
    if ($request->sede != null)
    {
      $where[]  = 'sedes.id=' . (int)$request->sede;
    }

    $where[]  = 'tbl_cm_ficha.tenantId =' . Auth::user()->tenantId;



    if (count($where) > 0)
      {
        $wheres = 'where ' . implode(' and ', $where);

      }



  $data = DB::select('select

  COALESCE(grupos.codigo_grupo, " ") as codigo_grupo


  FROM
  `tbl_cm_ficha`
  LEFT JOIN `tbl_gen_persona` ON (`tbl_gen_persona`.`id` = `tbl_cm_ficha`.`id_persona_beneficiario`)
  LEFT JOIN `tbl_gen_persona`  AS acudiente_persona ON acudiente_persona.`id` = tbl_cm_ficha.`id_persona_acudiente`
  LEFT JOIN `poblacional_beneficiarios` ON (`tbl_cm_ficha`.`id` = `poblacional_beneficiarios`.`ficha_id`)
  LEFT JOIN `tbl_cm_persona_x_discapacidad` ON (`tbl_cm_ficha`.`id` = `tbl_cm_persona_x_discapacidad`.`ficha_id`)
  LEFT JOIN `grupos` ON (`grupos`.`id` = `tbl_cm_ficha`.`grupo_id`)
  LEFT JOIN `sedes` ON (`sedes`.`id` = `grupos`.`sede_id`)
  LEFT JOIN `instituciones` ON (`instituciones`.`id` = `sedes`.`institucion_id`)
  LEFT JOIN `tbl_cm_grados` ON (`tbl_cm_grados`.`id` = `grupos`.`grado_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_cm_ficha`.`comuna_id`)
  LEFT JOIN `barrios` ON (`barrios`.`id` = `tbl_gen_persona`.`id_residencia_barrio`)
  LEFT JOIN `tbl_gen_corregimientos` ON (`tbl_gen_corregimientos`.`id` = `tbl_gen_persona`.`id_residencia_corregimiento`)
  LEFT JOIN `tbl_gen_veredas` ON (`tbl_gen_veredas`.`id` = `tbl_gen_persona`.`id_residencia_vereda`)
  LEFT JOIN `tbl_gen_estado_civil` ON (`tbl_gen_estado_civil`.`id` = `tbl_gen_persona`.`id_estado_civil`)
  LEFT JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_gen_escolaridad_nivel`.`id` = `tbl_cm_ficha`.`escolaridad_id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_documento_tipo`.`id` = `tbl_gen_persona`.`id_documento_tipo`)
  LEFT JOIN `tbl_gen_documento_tipo`  AS tipo_documento_acudiente ON tipo_documento_acudiente.`id` = acudiente_persona.`id_documento_tipo`
  LEFT JOIN `tbl_gen_eps` ON (`tbl_gen_eps`.`id` = `tbl_cm_ficha`.`salud_sgss_id`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_cm_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_cm_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_cm_ficha`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_cm_ficha`.`tipo_afiliacion`)
  '.$wheres.'
  GROUP BY
  `tbl_cm_ficha`.`id`


  ');


  return ['datos' => count($data)];


}



 public function ExportEvaluacionGrupo($no_grupo){


    $beneficiario = DB::table('tbl_cm_evaluaciones')
        ->select(

             'tbl_cm_evaluaciones.id as evaluacion',
             'tbl_cm_criterios.nombre_criterio',
             'tbl_gen_persona.nombre_primero',
             'tbl_gen_persona.apellido_primero',
             'tbl_cm_evaluaciones.fecha_evaluacion',
             'tbl_cm_evaluaciones.valor_evaluacion'


            )

        ->leftJoin('grupos','grupos.id', '=', 'tbl_cm_evaluaciones.grupo_id')
        ->leftJoin('tbl_cm_ficha','tbl_cm_ficha.id', '=', 'tbl_cm_evaluaciones.ficha_id')
      ->join('tbl_gen_persona', 'tbl_gen_persona.id', '=', 'tbl_cm_ficha.id_persona_beneficiario')
      ->join('tbl_cm_criterios', 'tbl_cm_criterios.id', '=', 'tbl_cm_evaluaciones.criterio_id')

      ->groupBy('evaluacion')

      ->where('tbl_cm_ficha.grupo_id', '=', $no_grupo)

      ->orderBy('tbl_gen_persona.nombre_primero', 'desc')

        ->get();


$items= json_decode( json_encode($beneficiario), true);

Excel::create('items', function($excel) use($items) {
  $excel->sheet('ExportFile', function($sheet) use($items) {
      $sheet->fromArray($items);
  });
})->export('xls');

}



 public function ExportPromedioBeneficiario($id){

  $promedio = DB::table('tbl_cm_evaluaciones')
      ->select(

     'tbl_cm_criterios.nombre_criterio',
     'tbl_cm_evaluaciones.fecha_evaluacion',


      DB::raw('COUNT(tbl_cm_evaluaciones.`criterio_id`) as total_evaluaciones_criterio, SUM(tbl_cm_evaluaciones.`valor_evaluacion`) as sumatoria, avg(valor_evaluacion) as promedio'))

      ->join('tbl_cm_criterios', 'tbl_cm_criterios.id', '=', 'tbl_cm_evaluaciones.criterio_id')


      ->groupBy('tbl_cm_evaluaciones.criterio_id')->where('tbl_cm_evaluaciones.ficha_id', '=', $id)->get();

$items= json_decode( json_encode($promedio), true);

Excel::create('items', function($excel) use($items) {
  $excel->sheet('ExportFile', function($sheet) use($items) {
      $sheet->fromArray($items);
  });
})->export('xls');

}

public function BeneficiariosGeneralPrograma(Request $request)
{

  $Filtro = array();
  $where  = array();
  $wheres = '';
    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {
        $dt1 = new \DateTime($request->entre);
        $carbon_entre = Carbon::instance($dt1);
        $entre = $carbon_entre->format('Y-m-d');
        $dt2 = new \DateTime($request->hasta);
        $carbon_hasta = Carbon::instance($dt2);
        $hasta = $carbon_hasta->format('Y-m-d');
        $where[]  = 'tbl_pr_ficha.fecha_inscripcion BETWEEN ' .'"'. $entre. '"'. ' AND ' . '"' .$hasta . '"';
    }
    if ($request->sexo != null)
    {
       $where[]  = 'tbl_gen_persona.sexo=' . (int)$request->sexo;
    }
    if ($request->entre_edad != null && $request->hasta_edad !=null)
    {
      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");
      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;

      $where[]  = 'TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) BETWEEN ' .'"'. $entre_edad. '"'. ' AND ' . '"' .$hasta_edad . '"';

    }
    if ($request->corregimiento != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_corregimiento=' . (int)$request->corregimiento;
    }
    if ($request->barrio != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_barrio=' . (int)$request->barrio;
    }
    if ($request->comuna != null)
    {
        $where[]  = 'tbl_pr_ficha.comuna_id=' . (int)$request->comuna;
    }
    if ($request->estrato != null)
    {
      $where[]  = 'tbl_gen_persona.residencia_estrato=' . (int)$request->estrato;
    }
    if ($request->etnia != null)
    {
      $where[]  = 'tbl_pr_ficha.cultura_beneficiario=' . (int)$request->etnia;
    }
    if ($request->discapacidad != null)
    {
      $where[]  = 'view_discapacidad_persona_ficha_pr.discapacidad_id=' . (int)$request->discapacidad;
    }
    if ($request->lugar != null)
    {
      $where[]  = 'tbl_pr_lugares.id=' . (int)$request->lugar;
    }
    if ($request->disciplina != null)
    {
      $where[]  = 'tbl_pr_disciplinas.id=' . (int)$request->disciplina;
    }

     $where[]  = 'tbl_pr_ficha.tenantId =' . Auth::user()->tenantId;
     $where[]  = 'tbl_pr_ficha.grupo_id IS NOT NULL';
     $where[]  = 'tbl_pr_grupos.tenantId IS NOT NULL';
     $where[]  = 'tbl_pr_ficha.tenantId IS NOT NULL';

    if (count($where) > 0)
      {
        $wheres = 'where ' . implode(' and ', $where);

      }

  $data = DB::select('select

        tbl_pr_ficha.id,
      tbl_pr_grupos.nombre_grupo,
          tbl_pr_lugares.nombre_lugar,
          tbl_pr_disciplinas.nombre_disciplina,
      tbl_gen_documento_tipo.descripcion as tipo_documento,
      tbl_gen_persona.documento,
      tbl_pr_ficha.no_ficha,
      tbl_pr_ficha.fecha_inscripcion,
      tbl_gen_persona.nombre_primero,
      tbl_gen_persona.nombre_segundo,
      tbl_gen_persona.apellido_primero,
      tbl_gen_persona.apellido_segundo,
      tbl_gen_persona.correo_electronico,
      (CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "Hombre" END) as sexo,
      tbl_gen_persona.fecha_nacimiento,
      TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) AS edad_persona,
      paises.nombre_pais,
      departamentos.nombre_departamento,
      municipios.nombre_municipio,
      tbl_gen_corregimientos.descripcion as nombre_corregimiento,
      tbl_gen_veredas.nombre as nombre_vereda,
      barrios.nombre_barrio,
      tbl_gen_persona.residencia_estrato,
      comunas.nombre_comuna,
      tbl_gen_persona.residencia_direccion,
      tbl_gen_persona.telefono_fijo,
      tbl_gen_persona.telefono_movil,
      tbl_gen_escolaridad_nivel.descripcion as nivel_escolaridad,
      tbl_gen_escolaridad_estado.descripcion as estado_escolaridad,
      `tbl_gen_ocupacion`.`descripcion` as ocupacion_beneficiario,
      tbl_gen_estado_civil.descripcion as estado_civil,
      (CASE WHEN (tbl_pr_ficha.hijos_beneficiario = 1) THEN "Si"  ELSE "No" END) as hijos_beneficiario,
      tbl_pr_ficha.cantidad_hijos_beneficiario,
      tbl_gen_etnia.descripcion as etnia_beneficiario,
      `view_grupo_poblacional_ficha_pr`.`nombre` as poblacional,
      (CASE WHEN (tbl_pr_ficha.discapacidad_beneficiario = 1) THEN "Si"  ELSE "No" END) as enfermedad_permanente,
      `tbl_pr_ficha`.`otra_discapacidad_beneficiario`,
      (CASE WHEN (tbl_pr_ficha.medicamentos_permanente_beneficiario = 1) THEN "Si"  ELSE "No" END) as toma_medicamentos,
      `tbl_pr_ficha`.`medicamentos_beneficiario`,
      `tbl_gen_persona`.`sangre_tipo`,
       view_discapacidad_persona_ficha_pr.nombre_discapacidad as discapacidades,
      (CASE WHEN (tbl_pr_ficha.afiliacion_salud = 1) THEN "Si"  ELSE "No" END) as afiliacion_salud,
      `tbl_gen_salud_regimen`.`descripcion` as tipo_afiliacion,
      `tbl_gen_eps`.`descripcion` as nombre_eps,
      tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
      acudiente_persona.documento as documento_acudiente,
      acudiente_persona.nombre_primero as primer_nombre_acudiente,
      acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
      acudiente_persona.apellido_primero as primer_apellido_acudiente,
      acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
          (CASE WHEN (acudiente_persona.sexo = 1) THEN "Mujer" WHEN (acudiente_persona.sexo = 2) THEN "Hombre" ELSE "Mujer" END) as sexo_acudiente,
      acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
      acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
      acudiente_persona.telefono_movil as telefono_movil_acudiente,
      acudiente_persona.correo_electronico as correo_acudiente,
      (CASE WHEN (tbl_pr_ficha.parentesco_acudiente = 1) THEN "Madre/Padre" WHEN (tbl_pr_ficha.parentesco_acudiente = 2) THEN "Hermana/Hermano" WHEN (tbl_pr_ficha.parentesco_acudiente = 3) THEN "Tia/Tio" WHEN (tbl_pr_ficha.parentesco_acudiente = 4) THEN "Abuela/Abuelo" WHEN (tbl_pr_ficha.parentesco_acudiente = 5) THEN "Cuidador" ELSE "Otro" END) as parentesco_acudiente,
      tbl_pr_ficha.otro_parentesco_acudiente,
      users.primer_nombre as primer_nombre_usuario,
      users.primer_apellido as primer_apellido_usuario

  FROM
  `tbl_pr_ficha`
  LEFT JOIN `tbl_gen_persona` ON (`tbl_gen_persona`.`id` = `tbl_pr_ficha`.`id_persona_beneficiario`)
  LEFT JOIN `tbl_gen_persona`  AS acudiente_persona ON acudiente_persona.`id` = tbl_pr_ficha.`id_persona_acudiente`
  LEFT JOIN `tbl_pr_poblacional_beneficiarios` ON (`tbl_pr_ficha`.`id` = `tbl_pr_poblacional_beneficiarios`.`ficha_id`)
  LEFT JOIN `tbl_pr_persona_x_discapacidad` ON (`tbl_pr_ficha`.`id` = `tbl_pr_persona_x_discapacidad`.`ficha_id`)
  LEFT JOIN `tbl_pr_grupos` ON (`tbl_pr_grupos`.`id` = `tbl_pr_ficha`.`grupo_id`)
  LEFT JOIN `tbl_pr_lugares` ON (`tbl_pr_lugares`.`id` = `tbl_pr_grupos`.`lugar_id`)
  LEFT JOIN `tbl_pr_disciplinas` ON (`tbl_pr_disciplinas`.`id` = `tbl_pr_grupos`.`disciplina_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_pr_ficha`.`comuna_id`)
  LEFT JOIN `users` ON (`users`.`id` = `tbl_pr_grupos`.`user_id`)

  LEFT JOIN `tbl_gen_grupo_poblacional` ON (`tbl_gen_grupo_poblacional`.`id` = `tbl_pr_poblacional_beneficiarios`.`grupo_pcs`)

  LEFT JOIN `view_grupo_poblacional_ficha_pr` ON (`tbl_pr_ficha`.`id` = `view_grupo_poblacional_ficha_pr`.`ficha_id`)

  LEFT JOIN `view_discapacidad_persona_ficha_pr` ON (`tbl_pr_ficha`.`id` = `view_discapacidad_persona_ficha_pr`.`ficha_id`)


  LEFT JOIN `tbl_gen_discapacidad` ON (`tbl_gen_discapacidad`.`id` = `tbl_pr_persona_x_discapacidad`.`discapacidad_id`)
  LEFT JOIN `paises` ON (`paises`.`id` = `tbl_gen_persona`.`id_procedencia_pais`)
  LEFT JOIN `departamentos` ON (`departamentos`.`id` = `tbl_gen_persona`.`id_procedencia_departamento`)
  LEFT JOIN `municipios` ON (`municipios`.`id` = `tbl_gen_persona`.`id_procedencia_municipio`)
  LEFT JOIN `barrios` ON (`barrios`.`id` = `tbl_gen_persona`.`id_residencia_barrio`)
  LEFT JOIN `tbl_gen_corregimientos` ON (`tbl_gen_corregimientos`.`id` = `tbl_gen_persona`.`id_residencia_corregimiento`)
  LEFT JOIN `tbl_gen_veredas` ON (`tbl_gen_veredas`.`id` = `tbl_gen_persona`.`id_residencia_vereda`)
  LEFT JOIN `tbl_gen_estado_civil` ON (`tbl_gen_estado_civil`.`id` = `tbl_gen_persona`.`id_estado_civil`)
  LEFT JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_gen_escolaridad_nivel`.`id` = `tbl_pr_ficha`.`escolaridad_id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_documento_tipo`.`id` = `tbl_gen_persona`.`id_documento_tipo`)
  LEFT JOIN `tbl_gen_documento_tipo`  AS tipo_documento_acudiente ON tipo_documento_acudiente.`id` = tbl_gen_persona.`id_documento_tipo`
  LEFT JOIN `tbl_gen_eps` ON (`tbl_gen_eps`.`id` = `tbl_pr_ficha`.`salud_sgss_id`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_pr_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_pr_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_pr_ficha`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_pr_ficha`.`tipo_afiliacion`)
  '.$wheres.'
  GROUP BY
  `tbl_pr_ficha`.`id`');
  return response()->json(
        $data
      );

}


public function ExportBeneficiariosGeneralProgramas(Request $request)//jsb1
{

$res1 = explode(':', $request->disciplina);

  $Filtro = array();
  $where  = array();
  $wheres = '';
    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {
        $dt1 = new \DateTime($request->entre);
        $carbon_entre = Carbon::instance($dt1);
        $entre = $carbon_entre->format('Y-m-d');
        $dt2 = new \DateTime($request->hasta);
        $carbon_hasta = Carbon::instance($dt2);
        $hasta = $carbon_hasta->format('Y-m-d');
        $where[]  = 'tbl_pr_ficha.fecha_inscripcion BETWEEN ' .'"'. $entre. '"'. ' AND ' . '"' .$hasta . '"';
    }
    if ($request->sexo_persona != null)
    {
       $where[]  = 'tbl_gen_persona.sexo=' . (int)$request->sexo_persona;
    }
    if ($request->entre_edad != null && $request->hasta_edad !=null)
    {
      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");
      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;

      $where[]  = 'TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) BETWEEN ' .'"'. $entre_edad. '"'. ' AND ' . '"' .$hasta_edad . '"';

    }
    if ($request->corregimiento != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_corregimiento=' . (int)$request->corregimiento;
    }
    if ($request->barrio != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_barrio=' . (int)$request->barrio;
    }
    if ($request->comuna != null)
    {
        $where[]  = 'tbl_pr_ficha.comuna_id=' . (int)$request->comuna;
    }
    if ($request->estrato != null)
    {
      $where[]  = 'tbl_gen_persona.residencia_estrato=' . (int)$request->estrato;
    }
    if ($request->etnia != null)
    {
      $where[]  = 'tbl_pr_ficha.cultura_beneficiario=' . (int)$request->etnia;
    }
    if ($request->discapacidad != null)
    {
      $where[]  = 'view_discapacidad_persona_ficha_pr.discapacidad_id=' . (int)$request->discapacidad;
    }
    if ($request->lugar != null)
    {
      $where[]  = 'tbl_pr_lugares.id=' . (int)$request->lugar;
    }
    if ($request->disciplina != null)
    {
      $where[]  = 'tbl_pr_disciplinas.id=' . (int)$res1[1];
    }

     $where[]  = 'tbl_pr_ficha.tenantId =' . Auth::user()->tenantId;
     $where[]  = 'tbl_pr_ficha.grupo_id IS NOT NULL';
     $where[]  = 'tbl_pr_grupos.tenantId IS NOT NULL';
     $where[]  = 'tbl_pr_ficha.tenantId IS NOT NULL';

    if (count($where) > 0)
      {
        $wheres = 'where ' . implode(' and ', $where);

      }


  $data = DB::select('select


      COALESCE(users.primer_nombre, " ") as nombre_formador,
      COALESCE(users.primer_apellido, " ") as apellido_formador,
      COALESCE(tbl_pr_grupos.nombre_grupo, " ") as nombre_grupo,
      COALESCE(tbl_pr_lugares.nombre_lugar, " ") as nombre_lugar,
      COALESCE(tbl_pr_disciplinas.nombre_disciplina, " ") as nombre_disciplina,
      COALESCE(tbl_pr_ficha.fecha_inscripcion, " ") as fecha_inscripcion,
      COALESCE(tbl_gen_persona.documento, " ") as documento,
      COALESCE(tbl_gen_persona.nombre_primero, " ") as nombre_primero,
      COALESCE(tbl_gen_persona.nombre_segundo, " ") as nombre_segundo,
      COALESCE(tbl_gen_persona.apellido_primero, " ") as apellido_primero,
      COALESCE(tbl_gen_persona.apellido_segundo, " ") as apellido_segundo,
      COALESCE((CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "Hombre" END), " ") as sexo,
      COALESCE(tbl_gen_persona.fecha_nacimiento, " ") as fecha_nacimiento,
      COALESCE(TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()), " ") AS edad_persona,
      COALESCE(tbl_gen_corregimientos.descripcion, " ") as nombre_corregimiento,
      COALESCE(tbl_gen_veredas.nombre, " ") as nombre_vereda,
      COALESCE(barrios.nombre_barrio, " ") as nombre_barrio,
      COALESCE(tbl_gen_persona.residencia_estrato, " ") as residencia_estrato,
      COALESCE(comunas.nombre_comuna, " ") as nombre_comuna,
      COALESCE(tbl_gen_escolaridad_nivel.descripcion, " ") as nivel_escolaridad,
      COALESCE(tbl_gen_escolaridad_estado.descripcion, " ") as estado_escolaridad,
      COALESCE(`tbl_gen_ocupacion`.`descripcion`, " ") as ocupacion_beneficiario,
      COALESCE(tbl_gen_estado_civil.descripcion, " ") as estado_civil,
      COALESCE(tbl_gen_etnia.descripcion, " ") as etnia_beneficiario,
      COALESCE(`view_grupo_poblacional_ficha_pr`.`nombre`, " ") as poblacional,
      COALESCE((CASE WHEN (tbl_pr_ficha.discapacidad_beneficiario = 1) THEN "Si"  ELSE "No" END), " ") as enfermedad_permanente,
      COALESCE(view_discapacidad_persona_ficha_pr.nombre_discapacidad, " ") as discapacidades,
      COALESCE(`tbl_pr_ficha`.`otra_discapacidad_beneficiario`, " ") as otra_discapacidad_beneficiario,
      COALESCE((CASE WHEN (tbl_pr_ficha.medicamentos_permanente_beneficiario = 1) THEN "Si"  ELSE "No" END), " ") as toma_medicamentos,
      COALESCE(`tbl_pr_ficha`.`medicamentos_beneficiario`, " ") as medicamentos_beneficiario,
      COALESCE(`tbl_gen_persona`.`sangre_tipo`, "") as sangre_tipo,
      COALESCE((CASE WHEN (tbl_pr_ficha.afiliacion_salud = 1) THEN "Si"  ELSE "No" END), " ") as afiliacion_salud,
      COALESCE(`tbl_gen_salud_regimen`.`descripcion`, " ") as tipo_afiliacion,
      COALESCE(`tbl_gen_eps`.`descripcion`, " ") as nombre_eps
  FROM
  `tbl_pr_ficha`
  LEFT JOIN `tbl_gen_persona` ON (`tbl_gen_persona`.`id` = `tbl_pr_ficha`.`id_persona_beneficiario`)
  LEFT JOIN `tbl_gen_persona`  AS acudiente_persona ON acudiente_persona.`id` = tbl_pr_ficha.`id_persona_acudiente`
  LEFT JOIN `tbl_pr_poblacional_beneficiarios` ON (`tbl_pr_ficha`.`id` = `tbl_pr_poblacional_beneficiarios`.`ficha_id`)
  LEFT JOIN `tbl_pr_persona_x_discapacidad` ON (`tbl_pr_ficha`.`id` = `tbl_pr_persona_x_discapacidad`.`ficha_id`)
  LEFT JOIN `tbl_pr_grupos` ON (`tbl_pr_grupos`.`id` = `tbl_pr_ficha`.`grupo_id`)
  LEFT JOIN `tbl_pr_lugares` ON (`tbl_pr_lugares`.`id` = `tbl_pr_grupos`.`lugar_id`)
  LEFT JOIN `tbl_pr_disciplinas` ON (`tbl_pr_disciplinas`.`id` = `tbl_pr_grupos`.`disciplina_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_pr_ficha`.`comuna_id`)
  LEFT JOIN `users` ON (`users`.`id` = `tbl_pr_grupos`.`user_id`)

  LEFT JOIN `tbl_gen_grupo_poblacional` ON (`tbl_gen_grupo_poblacional`.`id` = `tbl_pr_poblacional_beneficiarios`.`grupo_pcs`)

  LEFT JOIN `view_grupo_poblacional_ficha_pr` ON (`tbl_pr_ficha`.`id` = `view_grupo_poblacional_ficha_pr`.`ficha_id`)

  LEFT JOIN `view_discapacidad_persona_ficha_pr` ON (`tbl_pr_ficha`.`id` = `view_discapacidad_persona_ficha_pr`.`ficha_id`)


  LEFT JOIN `tbl_gen_discapacidad` ON (`tbl_gen_discapacidad`.`id` = `tbl_pr_persona_x_discapacidad`.`discapacidad_id`)
  LEFT JOIN `paises` ON (`paises`.`id` = `tbl_gen_persona`.`id_procedencia_pais`)
  LEFT JOIN `departamentos` ON (`departamentos`.`id` = `tbl_gen_persona`.`id_procedencia_departamento`)
  LEFT JOIN `municipios` ON (`municipios`.`id` = `tbl_gen_persona`.`id_procedencia_municipio`)
  LEFT JOIN `barrios` ON (`barrios`.`id` = `tbl_gen_persona`.`id_residencia_barrio`)
  LEFT JOIN `tbl_gen_corregimientos` ON (`tbl_gen_corregimientos`.`id` = `tbl_gen_persona`.`id_residencia_corregimiento`)
  LEFT JOIN `tbl_gen_veredas` ON (`tbl_gen_veredas`.`id` = `tbl_gen_persona`.`id_residencia_vereda`)
  LEFT JOIN `tbl_gen_estado_civil` ON (`tbl_gen_estado_civil`.`id` = `tbl_gen_persona`.`id_estado_civil`)
  LEFT JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_gen_escolaridad_nivel`.`id` = `tbl_gen_persona`.`escolaridad_id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_documento_tipo`.`id` = `tbl_gen_persona`.`id_documento_tipo`)
  LEFT JOIN `tbl_gen_documento_tipo`  AS tipo_documento_acudiente ON tipo_documento_acudiente.`id` = tbl_gen_persona.`id_documento_tipo`
  LEFT JOIN `tbl_gen_eps` ON (`tbl_gen_eps`.`id` = `tbl_pr_ficha`.`salud_sgss_id`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_pr_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_pr_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_gen_persona`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_pr_ficha`.`tipo_afiliacion`)
  '.$wheres.'
  GROUP BY
  `tbl_pr_ficha`.`id`');


return response()->json(
        $data
      );


}

public function BeneficiariosDetalladoProgramas(Request $request)
{

  $res1 = explode(':', $request->disciplina);
  $Filtro = array();
  $where  = array();
  $wheres = '';

    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {
        $dt1 = new \DateTime($request->entre);
        $carbon_entre = Carbon::instance($dt1);
        $entre = $carbon_entre->format('Y-m-d');
        $dt2 = new \DateTime($request->hasta);
        $carbon_hasta = Carbon::instance($dt2);
        $hasta = $carbon_hasta->format('Y-m-d');
        $where[]  = 'tbl_pr_asistencias.fecha_asistencia BETWEEN ' .'"'. $entre. '"'. ' AND ' . '"' .$hasta . '"';
    }
    if ($request->sexo != null)
    {
        $where[]  = 'tbl_gen_persona.sexo=' . (int)$request->sexo;
    }
    if ($request->entre_edad != null && $request->hasta_edad !=null)
    {
      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");
      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;

      $where[]  = 'TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) BETWEEN ' .'"'. $entre_edad. '"'. ' AND ' . '"' .$hasta_edad . '"';

    }
    if ($request->corregimiento != null)
    {
        $where[]  = 'tbl_gen_persona.id_residencia_corregimiento=' . (int)$request->corregimiento;
    }
    if ($request->barrio != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_barrio=' . (int)$request->barrio;
    }
    if ($request->comuna != null)
    {
        $where[]  = 'tbl_pr_ficha.comuna_id=' . (int)$request->comuna;
    }
    if ($request->estrato != null)
    {
      $where[]  = 'tbl_gen_persona.residencia_estrato=' . (int)$request->estrato;
    }
    if ($request->etnia != null)
    {
      $where[]  = 'tbl_pr_ficha.cultura_beneficiario=' . (int)$request->etnia;
    }
    if ($request->discapacidad != null)
    {
      $where[]  = 'view_discapacidad_persona_ficha_pr.discapacidad_id=' . (int)$request->discapacidad;
    }
    if ($request->lugar != null)
    {
      $where[]  = 'tbl_pr_lugares.id=' . (int)$request->lugar;
    }
    if ($request->disciplina != null)
    {
      $where[]  = 'tbl_pr_disciplinas.id=' . (int)$res1[1];
    }

     $where[]  = 'tbl_pr_ficha.tenantId =' . Auth::user()->tenantId;

    if (count($where) > 0)
      {
        $wheres = 'where ' . implode(' and ', $where);

      }


  $data = DB::select('select
  `tbl_pr_asistencias`.`ficha_id`,
  `tbl_pr_grupos`.`nombre_grupo`,
  `tbl_pr_lugares`.`nombre_lugar`,
  tbl_pr_disciplinas.nombre_disciplina,
  ((count(`tbl_pr_asistencias`.`fecha_asistencia`))-SUM(`tbl_pr_asistencias`.`asistencia`) ) AS `inasistencias`,
  SUM(`tbl_pr_asistencias`.`asistencia`) AS `asistencias`,
  (count(`tbl_pr_asistencias`.`fecha_asistencia`)) AS `total`,
  `tbl_gen_documento_tipo`.`descripcion` AS `tipo_documento`,
  `tbl_gen_persona`.`documento`,
  `tbl_pr_ficha`.`no_ficha`,
  `tbl_pr_ficha`.`fecha_inscripcion`,
  `tbl_gen_persona`.`nombre_primero`,
  `tbl_gen_persona`.`nombre_segundo`,
  `tbl_gen_persona`.`apellido_primero`,
  `tbl_gen_persona`.`apellido_segundo`,
  `tbl_gen_persona`.`correo_electronico`,
  (CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "Hombre" END) as sexo,
  `tbl_gen_persona`.`fecha_nacimiento`,
  `paises`.`nombre_pais` as pais_procedencia,
  `departamentos`.`nombre_departamento` as departamento_procedencia,
  `municipios`.`nombre_municipio` as municipio_procedencia,
  `tbl_gen_corregimientos`.`descripcion` AS `nombre_corregimiento`,
  `tbl_gen_veredas`.`nombre` as nombre_vereda,
  `barrios`.`nombre_barrio`,
  `tbl_gen_persona`.`residencia_estrato`,
  `comunas`.`nombre_comuna`,
  `tbl_gen_persona`.`residencia_direccion`,
  `tbl_gen_persona`.`telefono_fijo`,
  `tbl_gen_persona`.`telefono_movil`,
  `tbl_gen_escolaridad_nivel`.`descripcion` as nivel_escolaridad,
  `tbl_gen_escolaridad_estado`.`descripcion` as estado_escolaridad,
  `tbl_gen_ocupacion`.`descripcion` as ocupacion_beneficiario,
  `tbl_gen_estado_civil`.`descripcion` as estado_civil,
  (CASE WHEN (tbl_pr_ficha.hijos_beneficiario = 1) THEN "Si"  ELSE "No" END) as hijos_beneficiario,
  `tbl_pr_ficha`.`cantidad_hijos_beneficiario`,
  `tbl_gen_etnia`.`descripcion` as etnia_beneficiario,
  `view_grupo_poblacional_ficha_pr`.`nombre` as poblacional,
  (CASE WHEN (tbl_pr_ficha.discapacidad_beneficiario = 1) THEN "Si"  ELSE "No" END) as enfermedad_permanente,
  `tbl_pr_ficha`.`otra_discapacidad_beneficiario`,
  (CASE WHEN (tbl_pr_ficha.medicamentos_permanente_beneficiario = 1) THEN "Si"  ELSE "No" END) as toma_medicamentos,
  `tbl_pr_ficha`.`medicamentos_beneficiario`,
  `tbl_gen_persona`.`sangre_tipo`,
   view_discapacidad_persona_ficha_pr.nombre_discapacidad as discapacidades,
  (CASE WHEN (tbl_pr_ficha.afiliacion_salud = 1) THEN "Si"  ELSE "No" END) as afiliacion_salud,
  `tbl_gen_salud_regimen`.`descripcion` as tipo_afiliacion,
  `tbl_gen_eps`.`descripcion` as nombre_eps,
  `tbl_gen_documento_tipo_acudiente`.`descripcion` as tipo_documento_acudiente,
  `acudiente_persona`.`documento` as documento_acudiente,
  `acudiente_persona`.`nombre_primero` as nombre_primero_acudiente,
  `acudiente_persona`.`nombre_segundo` as nombre_segundo_acudiente,
  `acudiente_persona`.`apellido_primero` as apellido_primero_acudiente,
  `acudiente_persona`.`apellido_segundo` as apellido_segundo_acudiente,
  `acudiente_persona`.`fecha_nacimiento` as fecha_nacimiento_acudiente,
  `acudiente_persona`.`telefono_fijo` as telefono_fijo_acudiente,
  `acudiente_persona`.`telefono_movil` as telefono_movil_acudiente,
  `acudiente_persona`.`correo_electronico` as correo_electronico_acudiente,
  (CASE WHEN (tbl_pr_ficha.parentesco_acudiente = 1) THEN "Madre/Padre" WHEN (tbl_pr_ficha.parentesco_acudiente = 2) THEN "Hermana/Hermano" WHEN (tbl_pr_ficha.parentesco_acudiente = 3) THEN "Tia/Tio" WHEN (tbl_pr_ficha.parentesco_acudiente = 4) THEN "Abuela/Abuelo" WHEN (tbl_pr_ficha.parentesco_acudiente = 5) THEN "Cuidador" ELSE "Otro" END) as parentesco_acudiente,
  tbl_pr_ficha.otro_parentesco_acudiente,
  `users`.`primer_nombre` as primer_nombre_formador,
  `users`.`segundo_apellido` as primer_apellido_formador

  FROM
  `tbl_pr_asistencias`
  LEFT JOIN `tbl_pr_ficha` ON (`tbl_pr_asistencias`.`ficha_id` = `tbl_pr_ficha`.`id`)
  LEFT JOIN `tbl_gen_persona` ON (`tbl_pr_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo`.`id`)
  LEFT JOIN `paises` ON (`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)
  LEFT OUTER JOIN `departamentos` ON (`tbl_gen_persona`.`id_procedencia_departamento` = `departamentos`.`id`)
  LEFT OUTER JOIN `municipios` ON (`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)
  LEFT OUTER JOIN `tbl_gen_corregimientos` ON (`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)
  LEFT OUTER JOIN `tbl_gen_veredas` ON (`tbl_gen_persona`.`id_residencia_vereda` = `tbl_gen_veredas`.`id`)
  LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
  LEFT OUTER JOIN `tbl_gen_estado_civil` ON (`tbl_gen_persona`.`id_estado_civil` = `tbl_gen_estado_civil`.`id`)
  LEFT OUTER JOIN `tbl_pr_grupos` ON (`tbl_pr_ficha`.`grupo_id` = `tbl_pr_grupos`.`id`)
  LEFT JOIN `tbl_pr_lugares` ON (`tbl_pr_lugares`.`id` = `tbl_pr_grupos`.`lugar_id`)
  LEFT JOIN `tbl_pr_disciplinas` ON (`tbl_pr_disciplinas`.`id` = `tbl_pr_grupos`.`disciplina_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_pr_ficha`.`comuna_id`)
  LEFT OUTER JOIN `users` ON (`tbl_pr_grupos`.`user_id` = `users`.`id`)
  LEFT OUTER JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_pr_ficha`.`escolaridad_id` = `tbl_gen_escolaridad_nivel`.`id`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_pr_ficha`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_pr_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_pr_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_pr_ficha`.`tipo_afiliacion`)

    LEFT JOIN `view_discapacidad_persona_ficha_pr` ON (`tbl_pr_ficha`.`id` = `view_discapacidad_persona_ficha_pr`.`ficha_id`)

  LEFT OUTER JOIN `tbl_gen_eps` ON (`tbl_pr_ficha`.`salud_sgss_id` = `tbl_gen_eps`.`id`)
  LEFT JOIN `tbl_gen_persona` `acudiente_persona` ON (`tbl_pr_ficha`.`id_persona_acudiente` = `acudiente_persona`.`id`)


  LEFT JOIN `tbl_gen_documento_tipo` `tbl_gen_documento_tipo_acudiente` ON (`acudiente_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo_acudiente`.`id`)
  LEFT JOIN `view_grupo_poblacional_ficha_pr` ON (`tbl_pr_ficha`.`id` = `view_grupo_poblacional_ficha_pr`.`ficha_id`)
  '.$wheres.'
  GROUP BY
  `tbl_pr_asistencias`.`ficha_id`');

return response()->json(
      $data
    );

}


public function exportDetalladoProgramas(Request $request)
{

  $Filtro = array();
  $where  = array();
  $wheres = '';

  $res1 = explode(':', $request->disciplina);

    if ($request->tipo_doc_persona != null)
    {
        $where[]  = 'tbl_gen_persona.id_documento_tipo=' . (int)$request->tipo_doc_persona;
    }
    if ($request->entre != null && $request->hasta != null)
    {
        $dt1 = new \DateTime($request->entre);
        $carbon_entre = Carbon::instance($dt1);
        $entre = $carbon_entre->format('Y-m-d');
        $dt2 = new \DateTime($request->hasta);
        $carbon_hasta = Carbon::instance($dt2);
        $hasta = $carbon_hasta->format('Y-m-d');
        $where[]  = 'tbl_pr_asistencias.fecha_asistencia BETWEEN ' .'"'. $entre. '"'. ' AND ' . '"' .$hasta . '"';
    }
    if ($request->sexo != null)
    {
        $where[]  = 'tbl_gen_persona.sexo=' . (int)$request->sexo;
    }
    if ($request->entre_edad != null && $request->hasta_edad !=null)
    {
      $entre_edad = (int)$request->entre_edad;
      $hasta_edad = (int)$request->hasta_edad;
      $fecha_actual = (int)date ("Y");
      $fecha_entre_edad = $fecha_actual - $entre_edad;
      $fecha_hasta_edad = $fecha_actual - $hasta_edad;

      $where[]  = 'TIMESTAMPDIFF(YEAR, `tbl_gen_persona`.`fecha_nacimiento`, CURDATE()) BETWEEN ' .'"'. $entre_edad. '"'. ' AND ' . '"' .$hasta_edad . '"';

    }
    if ($request->corregimiento != null)
    {
        $where[]  = 'tbl_gen_persona.id_residencia_corregimiento=' . (int)$request->corregimiento;
    }
    if ($request->barrio != null)
    {
      $where[]  = 'tbl_gen_persona.id_residencia_barrio=' . (int)$request->barrio;
    }
    if ($request->comuna != null)
    {
        $where[]  = 'tbl_pr_ficha.comuna_id=' . (int)$request->comuna;
    }
    if ($request->estrato != null)
    {
      $where[]  = 'tbl_gen_persona.residencia_estrato=' . (int)$request->estrato;
    }
    if ($request->etnia != null)
    {
      $where[]  = 'tbl_pr_ficha.cultura_beneficiario=' . (int)$request->etnia;
    }
    if ($request->discapacidad != null)
    {
      $where[]  = 'view_discapacidad_persona_ficha_pr.discapacidad_id=' . (int)$request->discapacidad;
    }
    if ($request->lugar != null)
    {
      $where[]  = 'tbl_pr_lugares.id=' . (int)$request->lugar;
    }
    if ($request->disciplina != null)
    {
      $where[]  = 'tbl_pr_disciplinas.id=' . (int)$res1[1];
    }

     $where[]  = 'tbl_pr_ficha.tenantId =' . Auth::user()->tenantId;

    if (count($where) > 0)
      {
        $wheres = 'where ' . implode(' and ', $where);

      }


  $data = DB::select('select
  `users`.`primer_nombre` as nombre_formador,
  `users`.`primer_apellido` as apellido_formador,
  `tbl_pr_grupos`.`nombre_grupo`,
  `tbl_pr_lugares`.`nombre_lugar` as sitio_atencion,
   tbl_pr_disciplinas.nombre_disciplina as disciplina_actividad,
  `tbl_gen_persona`.`documento`,
  `tbl_gen_persona`.`nombre_primero` as primer_nombre_beneficiario,
  `tbl_gen_persona`.`apellido_primero` as primer_apellido_beneficiario,
   (CASE WHEN (tbl_gen_persona.sexo = 1) THEN "Mujer" WHEN (tbl_gen_persona.sexo = 2) THEN "Hombre" ELSE "Hombre" END) as sexo,
  ((count(`tbl_pr_asistencias`.`fecha_asistencia`))-SUM(`tbl_pr_asistencias`.`asistencia`) ) AS `inasistencias`,
  SUM(`tbl_pr_asistencias`.`asistencia`) AS `asistencias`,
  (count(`tbl_pr_asistencias`.`fecha_asistencia`)) AS `total`


  FROM
  `tbl_pr_asistencias`
  LEFT JOIN `tbl_pr_ficha` ON (`tbl_pr_asistencias`.`ficha_id` = `tbl_pr_ficha`.`id`)
  LEFT JOIN `tbl_gen_persona` ON (`tbl_pr_ficha`.`id_persona_beneficiario` = `tbl_gen_persona`.`id`)
  LEFT JOIN `tbl_gen_documento_tipo` ON (`tbl_gen_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo`.`id`)
  LEFT JOIN `paises` ON (`tbl_gen_persona`.`id_procedencia_pais` = `paises`.`id`)
  LEFT OUTER JOIN `departamentos` ON (`tbl_gen_persona`.`id_procedencia_departamento` = `departamentos`.`id`)
  LEFT OUTER JOIN `municipios` ON (`tbl_gen_persona`.`id_procedencia_municipio` = `municipios`.`id`)
  LEFT OUTER JOIN `tbl_gen_corregimientos` ON (`tbl_gen_persona`.`id_residencia_corregimiento` = `tbl_gen_corregimientos`.`id`)
  LEFT OUTER JOIN `tbl_gen_veredas` ON (`tbl_gen_persona`.`id_residencia_vereda` = `tbl_gen_veredas`.`id`)
  LEFT OUTER JOIN `barrios` ON (`tbl_gen_persona`.`id_residencia_barrio` = `barrios`.`id`)
  LEFT OUTER JOIN `tbl_gen_estado_civil` ON (`tbl_gen_persona`.`id_estado_civil` = `tbl_gen_estado_civil`.`id`)
  LEFT OUTER JOIN `tbl_pr_grupos` ON (`tbl_pr_ficha`.`grupo_id` = `tbl_pr_grupos`.`id`)
  LEFT JOIN `tbl_pr_lugares` ON (`tbl_pr_lugares`.`id` = `tbl_pr_grupos`.`lugar_id`)
  LEFT JOIN `tbl_pr_disciplinas` ON (`tbl_pr_disciplinas`.`id` = `tbl_pr_grupos`.`disciplina_id`)
  LEFT JOIN `comunas` ON (`comunas`.`id` = `tbl_pr_ficha`.`comuna_id`)
  LEFT OUTER JOIN `users` ON (`tbl_pr_grupos`.`user_id` = `users`.`id`)
  LEFT OUTER JOIN `tbl_gen_escolaridad_nivel` ON (`tbl_pr_ficha`.`escolaridad_id` = `tbl_gen_escolaridad_nivel`.`id`)
  LEFT JOIN `tbl_gen_escolaridad_estado` ON (`tbl_gen_escolaridad_estado`.`id` = `tbl_pr_ficha`.`estado_escolaridad`)
  LEFT JOIN `tbl_gen_ocupacion` ON (`tbl_gen_ocupacion`.`id` = `tbl_pr_ficha`.`ocupacion_beneficiario`)
  LEFT JOIN `tbl_gen_etnia` ON (`tbl_gen_etnia`.`id` = `tbl_pr_ficha`.`cultura_beneficiario`)
  LEFT JOIN `tbl_gen_salud_regimen` ON (`tbl_gen_salud_regimen`.`id` = `tbl_pr_ficha`.`tipo_afiliacion`)

 LEFT JOIN `view_grupo_poblacional_ficha_pr` ON (`tbl_pr_ficha`.`id` = `view_grupo_poblacional_ficha_pr`.`ficha_id`)

    LEFT JOIN `view_discapacidad_persona_ficha_pr` ON (`tbl_pr_ficha`.`id` = `view_discapacidad_persona_ficha_pr`.`ficha_id`)

  LEFT OUTER JOIN `tbl_gen_eps` ON (`tbl_pr_ficha`.`salud_sgss_id` = `tbl_gen_eps`.`id`)
  LEFT JOIN `tbl_gen_persona` `acudiente_persona` ON (`tbl_pr_ficha`.`id_persona_acudiente` = `acudiente_persona`.`id`)


  LEFT JOIN `tbl_gen_documento_tipo` `tbl_gen_documento_tipo_acudiente` ON (`acudiente_persona`.`id_documento_tipo` = `tbl_gen_documento_tipo_acudiente`.`id`)

  '.$wheres.'
  GROUP BY
  `tbl_pr_asistencias`.`ficha_id`');

$items= json_decode( json_encode($data), true);

Excel::create('items', function($excel) use($items) {
  $excel->sheet('ExportFile', function($sheet) use($items) {
      $sheet->fromArray($items);
  });
})->export('xls');

}

public function ExportarParrilla()
  {


    $grupos = DB::table('tbl_pr_grupos')
    ->leftjoin(
      'tbl_pr_horario_grupos',
      'tbl_pr_grupos.id', '=', 'tbl_pr_horario_grupos.grupo_id')
    ->leftjoin(
      'tbl_pr_lugares',
      'tbl_pr_lugares.id', '=', 'tbl_pr_grupos.lugar_id')
    ->leftjoin(
      'barrios',
      'barrios.id', '=', 'tbl_pr_lugares.barrio_id')
    ->leftjoin(
      'comunas',
      'comunas.id', '=', 'tbl_pr_lugares.comuna_id')
    ->leftjoin(
      'tbl_pr_disciplinas',
      'tbl_pr_disciplinas.id', '=', 'tbl_pr_grupos.disciplina_id')
    ->leftjoin(
      'users',
      'users.id', '=', 'tbl_pr_grupos.user_id')
    ->leftjoin(
      'tbl_gen_corregimientos',
      'tbl_gen_corregimientos.id', '=', 'tbl_pr_lugares.corregimiento_id')
    ->leftjoin(
      'tbl_gen_veredas',
      'tbl_gen_veredas.id', '=', 'tbl_pr_lugares.vereda_id')


    ->select(DB::raw(
      "
      tbl_pr_grupos.id,
      (CASE
       WHEN (tbl_pr_grupos.tenantId = 2767829213) THEN 'Mas recreo'
       WHEN (tbl_pr_grupos.tenantId = 3651901612) THEN 'Cali Incluye'
       WHEN (tbl_pr_grupos.tenantId = 7233109821) THEN 'In Cali'
       WHEN (tbl_pr_grupos.tenantId = 1240916273) THEN 'Mas vitales'
       WHEN (tbl_pr_grupos.tenantId = 2871155601) THEN 'Rutas de vida'
       WHEN (tbl_pr_grupos.tenantId = 8762109662) THEN 'Cali en forma'
       WHEN (tbl_pr_grupos.tenantId = 4432891188) THEN 'Team Cali'
       WHEN (tbl_pr_grupos.tenantId = 1177624100) THEN 'Ciclo vida'
       WHEN (tbl_pr_grupos.tenantId = 7765533102) THEN 'Cali juega'

       ELSE 'Ninguno' END) as programa,
      users.primer_nombre,
      users.primer_apellido,
      tbl_pr_grupos.nombre_grupo,
      tbl_pr_lugares.nombre_lugar as sitio_atencion,
      tbl_pr_lugares.direccion as direccion_sitio_atencion,
      tbl_pr_disciplinas.nombre_disciplina as disciplina_y_o_actividad,
      barrios.nombre_barrio,
      comunas.nombre_comuna,
      tbl_gen_corregimientos.descripcion as corregimiento,
      tbl_gen_veredas.nombre as vereda


      "))->where('tbl_pr_grupos.tenantId', '=', Auth::user()->tenantId)
    ->where('tbl_pr_grupos.estado', '=', 0)
    ->orderBy('tbl_pr_grupos.nombre_grupo', 'asc')->groupBy('tbl_pr_grupos.id')->get();


    foreach ($grupos as $key => $temp) {

            $temp->dias = $this->datosHorarios($temp->id);
            $temp->hora_inicio = $this->datosInicio($temp->id);
            $temp->hora_fin = $this->datosFin($temp->id);
            $grupos[$key] = $temp;
        }



   $items= json_decode( json_encode($grupos), true);

Excel::create('items', function($excel) use($items) {
  $excel->sheet('ExportFile', function($sheet) use($items) {
      $sheet->fromArray($items);
  });
})->export('xls');

  }

  private function datosHorarios($id)
{


    $dias = ProgramaHorario::select(
        'tbl_pr_horario_grupos.dia'

    )
        ->where('tbl_pr_horario_grupos.grupo_id', '=', $id)
        ->groupBy('tbl_pr_horario_grupos.dia')
        ->orderBy('tbl_pr_horario_grupos.id', 'ASC')
        ->get();

          $data_agrupados = array();
          foreach ($dias as $key => $temp) {
              $data_agrupados[] = $temp->dia;
              $dias[$key] = $temp;
          }


$cadena_equipo = implode("-", $data_agrupados);


    return $cadena_equipo;
}


private function datosInicio($id)
{


      $dias = DB::table('tbl_pr_horario_grupos')
          ->select(

                 'tbl_pr_horario_grupos.dia',


      DB::raw('DATE_FORMAT(tbl_pr_horario_grupos.hora_inicio, "%l:%i%p") as hora_inicio'))

          ->where('tbl_pr_horario_grupos.grupo_id', '=', $id)
          ->groupBy('tbl_pr_horario_grupos.dia', 'tbl_pr_horario_grupos.hora_inicio')



            ->get();

        $data_agrupados = array();
        foreach ($dias as $key => $temp) {
            $data_agrupados[] = $temp->hora_inicio;
            $dias[$key] = $temp;
        }



$cadena_equipo = implode("-", $data_agrupados);

  return $cadena_equipo;
}


private function datosFin($id)
{


      $dias = DB::table('tbl_pr_horario_grupos')
          ->select(

                 'tbl_pr_horario_grupos.dia',


      DB::raw('DATE_FORMAT(tbl_pr_horario_grupos.hora_fin, "%l:%i%p") as hora_fin'))

          ->where('tbl_pr_horario_grupos.grupo_id', '=', $id)
          ->groupBy('tbl_pr_horario_grupos.dia', 'tbl_pr_horario_grupos.hora_fin')



            ->get();

        $data_agrupados = array();
        foreach ($dias as $key => $temp) {
            $data_agrupados[] = $temp->hora_fin;
            $dias[$key] = $temp;
        }



$cadena_equipo = implode("-", $data_agrupados);

  return $cadena_equipo;
}


public function ExportarParrilla2()
  {


    $grupos = DB::table('grupos')
    ->leftjoin(
      'horario_grupos',
      'grupos.id', '=', 'horario_grupos.grupo_id')

    ->leftjoin(
      'sedes',
      'sedes.id', '=', 'grupos.sede_id')
    ->leftjoin(
      'instituciones',
      'instituciones.id', '=', 'sedes.institucion_id')

      ->leftjoin(
        'barrios',
        'barrios.id', '=', 'instituciones.barrio_id')

        ->leftjoin(
          'comunas',
          'comunas.id', '=', 'barrios.comuna_id')

      ->leftjoin(
        'users',
        'users.id', '=', 'grupos.user_id')

        ->leftjoin(
          'tbl_gen_corregimientos',
          'tbl_gen_corregimientos.id', '=', 'instituciones.corregimiento_id')


    ->select(DB::raw(
      "
      grupos.id,
      (CASE 
       WHEN (grupos.tenantId = 2767829213) THEN 'Mas recreo'
       WHEN (grupos.tenantId = 3651901612) THEN 'Cali Incluye'
       WHEN (grupos.tenantId = 7233109821) THEN 'In Cali'
       WHEN (grupos.tenantId = 1240916273) THEN 'Mas vitales'
       WHEN (grupos.tenantId = 2871155601) THEN 'Rutas de vida'
       WHEN (grupos.tenantId = 8762109662) THEN 'Cali en forma'
       WHEN (grupos.tenantId = 4432891188) THEN 'Team Cali'
       WHEN (grupos.tenantId = 1177624100) THEN 'Ciclo vida'
       WHEN (grupos.tenantId = 7765533102) THEN 'Cali juega'
	   
       ELSE 'Ninguno' END) as programa,
      users.primer_nombre,
      users.primer_apellido,
      grupos.codigo_grupo,
      instituciones.nombre_institucion as nombre_institucion,
      sedes.nombre_sede as nombre_sede,
      barrios.nombre_barrio,
      comunas.nombre_comuna,
      tbl_gen_corregimientos.descripcion as corregimiento

      "))->where('grupos.tenantId', '=', Auth::user()->tenantId)
    ->orderBy('grupos.codigo_grupo', 'asc')->groupBy('grupos.id')->get();


    foreach ($grupos as $key => $temp) {

            $temp->dias = $this->datosHorarios2($temp->id);
            $temp->hora_inicio = $this->datosInicio2($temp->id);
            $temp->hora_fin = $this->datosFin2($temp->id);
            $grupos[$key] = $temp;
        }


   $items= json_decode( json_encode($grupos), true);

Excel::create('items', function($excel) use($items) {
  $excel->sheet('ExportFile', function($sheet) use($items) {
      $sheet->fromArray($items);
  });
})->export('xls');

  }

  private function datosHorarios2($id)
{



    $dias = HorarioGrupo::select(
        'horario_grupos.dia'

    )
        ->where('horario_grupos.grupo_id', '=', $id)
        ->groupBy('horario_grupos.dia')
        ->orderBy('horario_grupos.id', 'ASC')
        ->get();

          $data_agrupados = array();
          foreach ($dias as $key => $temp) {
              $data_agrupados[] = $temp->dia;
              $dias[$key] = $temp;
          }


$cadena_equipo = implode("-", $data_agrupados);

    return $cadena_equipo;
}


private function datosInicio2($id)
{


      $dias = DB::table('horario_grupos')
          ->select(

                 'horario_grupos.dia',


      DB::raw('DATE_FORMAT(horario_grupos.hora_inicio, "%l:%i%p") as hora_inicio'))

          ->where('horario_grupos.grupo_id', '=', $id)
          ->groupBy('horario_grupos.dia', 'horario_grupos.hora_inicio')



            ->get();

        $data_agrupados = array();
        foreach ($dias as $key => $temp) {
            $data_agrupados[] = $temp->hora_inicio;
            $dias[$key] = $temp;
        }



$cadena_equipo = implode("-", $data_agrupados);

  return $cadena_equipo;
}


private function datosFin2($id)
{


      $dias = DB::table('horario_grupos')
          ->select(

                 'horario_grupos.dia',


      DB::raw('DATE_FORMAT(horario_grupos.hora_fin, "%l:%i%p") as hora_fin'))

          ->where('horario_grupos.grupo_id', '=', $id)
          ->groupBy('horario_grupos.dia', 'horario_grupos.hora_fin')



            ->get();

        $data_agrupados = array();
        foreach ($dias as $key => $temp) {
            $data_agrupados[] = $temp->hora_fin;
            $dias[$key] = $temp;
        }



$cadena_equipo = implode("-", $data_agrupados);

  return $cadena_equipo;
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Responsee
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
