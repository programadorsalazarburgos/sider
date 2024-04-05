<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    
    protected $table = 'tbl_gen_asistencias';
    protected $primarykey = 'id';
    protected $fillable = ['fecha_asistencia', 'grupo_id', 'ficha_id', 'observaciones', 'asistencia'];

}





