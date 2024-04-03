<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    
	protected $table = 'grupos';
    protected $primarykey = 'id';
    protected $fillable = ['codigo_grupo','user_id', 'grado_id', 'sede_id', 'observaciones', 'estado', 'tenantId'];

}




