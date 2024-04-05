<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoEscolaridad extends Model
{
    protected $table = 'tbl_gen_escolaridad_estado';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion'];
}
