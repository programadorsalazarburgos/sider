<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    
    protected $table = 'barrios';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_barrio', 'id_barrio_tipo', 'comuna_id', 'id_estrato', 'codigo'];

}
