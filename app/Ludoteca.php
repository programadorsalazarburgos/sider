<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ludoteca extends Model
{
    protected $table = 'tbl_gen_ludotecas';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_ludoteca', 'telefono', 'direccion', 'barrio_id', 'sede_id', 'corregimiento_id'];
}
