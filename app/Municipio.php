<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    
    protected $table = 'municipios';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_municipio', 'cod_municipio', 'departamento_id'];
}


