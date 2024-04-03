<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoDiscapacidad extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_cm_empleado_discapacidad';
    protected $primarykey = 'id';
    protected $fillable = ['empleado_id', 'discapacidad_id'];

}
