<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EscolaridadEstado extends Model
{
    
    protected $table = 'tbl_gen_escolaridad_estado';
    protected $primarykey = 'id_escolaridad_estado';
    protected $fillable = ['descripcion'];
}
