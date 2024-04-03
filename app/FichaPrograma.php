<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaPrograma extends Model
{
    
    protected $table = 'tbl_pr_ficha';
    protected $primarykey = 'id';
    protected $fillable = [
    
							'id_persona_beneficiario',
							'grupo_id',
							'fecha_inscripcion',
							'no_ficha',
							'hijos_beneficiario',
							'cantidad_hijos_beneficiario',
							'ocupacion_beneficiario',
							'cultura_beneficiario',
							'discapacidad_beneficiario',
							'otra_discapacidad_beneficiario',
							'medicamentos_permanente_beneficiario',
							'medicamentos_beneficiario',
							'condicion_discapacidad',
							'afiliacion_salud',
							'tipo_afiliacion',
							'salud_sgss_id',
							'id_persona_acudiente',
							'parentesco_acudiente',
							'otro_parentesco_acudiente',
							'fecha_retiro',
							'otro_poblacional',
							'tenantId',
							'comuna_id'

    	];

}
