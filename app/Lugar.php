<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    protected $table = 'tbl_pr_lugares';
    protected $primarykey = 'id';
    protected $fillable = [
							'nombre_lugar',
							'tenantId',
							'direccion',
							'barrio_id',
							'comuna_id',
							'observaciones',
							'estado',
							'tipo_punto_atencion'
						   ];

	
}
