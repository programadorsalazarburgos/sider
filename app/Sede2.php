<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede2 extends Model
{
    
    public $timestamps = false;
    protected $table = 'sedes';
    protected $primarykey = 'id';
    protected $fillable = ['institucion_id', 'nombre_sede', 'direccion'];


    // public function institucion() {
    //     return $this->hasOne('App\Institucion', 'id'); // Le indicamos que se va relacionar con el 
    // }

	     public function institucion()
	  {
	    return $this->belongsTo('App\Institucion');
	  }

	  
}
