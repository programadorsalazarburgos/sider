<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoPoblacional extends Model
{
 
 
    public $timestamps = false;
    protected $table = 'tbl_cm_empleado_x_grupo_poblacional';
    protected $primarykey = 'id';
    protected $fillable = ['empleado_id', 'grupopoblacional_id'];

}
