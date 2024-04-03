<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsistenciaPrograma extends Model
{
    protected $table = 'tbl_pr_asistencias';
    protected $primarykey = 'id';
    protected $fillable = ['fecha_asistencia', 'grupo_id', 'ficha_id', 'observaciones', 'asistencia'];

}
