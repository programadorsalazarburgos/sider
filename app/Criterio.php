<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    
    protected $table = 'tbl_cm_criterios';
    protected $primarykey = 'id';
    protected $fillable = ['grupo_id','nombre_criterio'];

}



