<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEscenario extends Model
{
    
    protected $table = 'tipoescenarios';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_tipo_escenario'];

}
