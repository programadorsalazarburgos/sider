<?php

namespace App;

use App\Institucion;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    

  	public $timestamps = false;
    protected $table = 'sedes';
    protected $primarykey = 'id';
    protected $fillable = ['institucion_id', 'nombre_sede', 'direccion'];


    public function institucion() {
        return $this->hasOne('App\Institucion', 'id'); // Le indicamos que se va relacionar con el 
    }
  
}


