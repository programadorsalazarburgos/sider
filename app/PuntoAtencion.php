<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntoAtencion extends Model
{
    
    protected $table = 'tbl_cm_punto_atencion';
    protected $primarykey = 'id';
    protected $fillable = ['nombre'];
}
