<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioGrupo extends Model
{
    
	protected $table = 'horario_grupos';
    protected $primarykey = 'id';
    protected $fillable = ['grupo_id','dia', 'hora_inicio', 'hora_fin'];

}

