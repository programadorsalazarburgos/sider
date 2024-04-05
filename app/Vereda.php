<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vereda extends Model
{
    
    protected $table = 'tbl_gen_veredas';
    protected $primarykey = 'id';
    protected $fillable = ['codigo_unico', 'codigo_estudio', 'nombre', 'estrato', 'corregimiento_id', 'id_comuna'];

}

