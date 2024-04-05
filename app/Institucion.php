<?php

namespace App;

use App\Sede;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    
    protected $table = 'instituciones';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_institucion', 'codigo_dane', 'telefono', 'direccion', 'nombre_rector', 'barrio_id', 'corregimiento_id'];


  public function sedes()
        {
            return $this->hasMany('App\Sede');
        }
  

}







