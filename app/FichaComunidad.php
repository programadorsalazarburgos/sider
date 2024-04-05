<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaComunidad extends Model
{

    public $timestamps = false;
    
    protected $table = 'tbl_cm_ficha';
    protected $primarykey = 'id';
    protected $fillable = [
    

                            'id_persona_beneficiario',
                            'grupo_id',
                            'fecha_inscripcion',
                            'no_ficha',
                            'modalidad_id',
                            'puntoatencion_id',
                            'hijos_beneficiario',
                            'cantidad_hijos_beneficiario',
                            'ocupacion_beneficiario',
                            'otra_ocupacion_beneficiario',
                            'escolaridad_id',
                            'cultura_beneficiario',
                            'otra_cultura_beneficiario',
                            'discapacidad_beneficiario',
                            'discapacidad_id',
                            'otra_discapacidad_beneficiario',
                            'enfermedad_permanente_beneficiario',
                            'enfermedad_beneficiario',
                            'medicamentos_permanente_beneficiario',
                            'medicamentos_beneficiario',
                            'seguridad_social_beneficiario',
                            'salud_sgss_id',
                            'nombre_seguridad_beneficiario',
                            'id_persona_acudiente',
                            'parentesco_acudiente',
                            'otro_parentesco_acudiente',
                            'otro_poblacional',
                            'tenantId',
                            'comuna_id'


    	];

}
