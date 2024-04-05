<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Beneficiario;
use App\Programa;
use App\PoblacionalBeneficiario;
use App\RoleUser;
use App\Grupo;
use App\Persona;
use App\FichaComunidad;
use App\Vereda;
use App\Escolaridad;
use App\PersonaDiscapacidad;
use response;
use DB;
use DateTime;
use Exception;

class ReporteFichaController extends Controller
{
   
   
    public function ObtenerBeneficiarioFicha($id)
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
            (CASE WHEN (tbl_gen_persona.sexo = 1) THEN 'Mujer' WHEN (tbl_gen_persona.sexo = 2) THEN 'Hombre' ELSE 'F' END) as sexo,
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
	  (CASE WHEN (hijos_beneficiario = 1) THEN 'Si'  ELSE 'No' END) as hijos_beneficiario,  
      (CASE WHEN (medicamentos_permanente_beneficiario = 1) THEN 'Si' ELSE 'No' END) as Medicamento_Permanente, medicamentos_beneficiario,
      tbl_gen_eps.descripcion as nombre_eps,
      acudiente_persona.nombre_primero as primer_nombre_acudiente,
      acudiente_persona.nombre_segundo as segundo_nombre_acudiente,
      acudiente_persona.apellido_primero as primer_apellido_acudiente,
      acudiente_persona.apellido_segundo as segundo_apellido_acudiente,
      tipo_documento_acudiente.descripcion as tipo_documento_acudiente,
      acudiente_persona.documento as documento_acudiente,
            (CASE WHEN (acudiente_persona.sexo = 1) THEN 'Mujer' WHEN (acudiente_persona.sexo = 2) THEN 'Hombre' ELSE 'F' END) as sexo_acudiente,
      acudiente_persona.fecha_nacimiento as fecha_nacimiento_acudiente,
      acudiente_persona.telefono_fijo as telefono_fijo_acudiente,
      acudiente_persona.telefono_movil as telefono_movil_acudiente,
      acudiente_persona.correo_electronico as correo_acudiente,   
      (CASE WHEN (parentesco_acudiente = 1) THEN 'Madre/Padre' WHEN (parentesco_acudiente = 2) THEN 'Hermana/Hermano' WHEN (cultura_beneficiario = 3) THEN 'Tia/Tio' WHEN (parentesco_acudiente = 4) THEN 'Abuela/Abuelo' WHEN (parentesco_acudiente = 5) THEN 'Cuidador' ELSE 'Otro' END) as parentesco_acudiente,
      tbl_cm_ficha.otro_parentesco_acudiente

    "))->where('tbl_cm_ficha.id', '=', $id)->groupBy('tbl_cm_ficha.id')->get();

return response()->json(
			$data
		);


	}


}
