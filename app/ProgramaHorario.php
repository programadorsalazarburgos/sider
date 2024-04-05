<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramaHorario extends Model
{
    protected $table = 'tbl_pr_horario_grupos';
    protected $primarykey = 'id';
    protected $fillable = ['grupo_id',
							'dia',
							'hora_inicio',
							'hora_fin'
];

}


