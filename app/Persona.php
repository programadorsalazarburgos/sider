<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    

    public $timestamps = false;
    protected $table = 'tbl_gen_persona';
    protected $primarykey = 'id';
    protected $fillable = 
    [
    	'nombre_primero', 
    	'nombre_segundo',
    	'apellido_primero', 
    	'apellido_segundo',
    	'documento',
    	'id_documento_tipo',
    	'sexo',
    	'fecha_nacimiento',
    	'telefono_fijo',
    	'telefono_movil',
    	'correo_electronico',
    	'id_procedencia_pais',
    	'id_procedencia_municipio',
    	'id_procedencia_departamento',
		'id_residencia_corregimiento',
		'otro_municipio',
    	'id_residencia_barrio',
    	'id_residencia_vereda',
    	'residencia_direccion',
    	'residencia_estrato',
    	'sangre_tipo',
		'id_estado_civil',
		'tenantId',
		'departamento_residencia_id',
		'municipio_residencia_id',
		'direccion_residencia',
		'escolaridad_id',
		'estado_escolaridad',
		'ocupacion_id'

    ];


}
