<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{

    public $timestamps = false;
    protected $table      = 'tbl_cm_empleado';
    protected $primarykey = 'id';
    protected $fillable   = [
    
        'id_persona',
        'id_usuario',
        'hijos_beneficiario',
        'cantidad_hijos_beneficiario',
        'ocupacion_beneficiario',
        'escolaridad_id',
        'estado_escolaridad',
        'titulo_obtenido',
        'universidad_id',
        'ocupacion_id',
        'hijos_empleado',
        'cantidad_hijos',
        'etnia_id',
        'enfermedad_permanente',
        'otra_enfermedad',
        'medicamentos',
        'otros_medicamentos',
        'tipo_sangre',
        'condicion_discapacidad',
        'afiliacion_salud',
        'tipoafiliacion_id',
        'eps_id',
        'libreta_militar',
        'no_libreta',
        'distrito_militar',
        'skype_empleado',
        'proyecto_profesional',
        'otro_poblacional',
        'tenantId'
        

    ];

}
