<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoDisciplina extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_cm_empleado_x_disciplina';
    protected $primarykey = 'id';
    protected $fillable = ['empleado_id', 'disciplina_id'];
}
