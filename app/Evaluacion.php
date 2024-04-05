<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    

    protected $table = 'tbl_cm_evaluaciones';
    protected $primarykey = 'id';
    protected $fillable = ['grupo_id','ficha_id', 'criterio_id', 'valor_evaluacion', 'tenantId'];

}
