<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escolaridad extends Model
{
    
    protected $table = 'tbl_gen_escolaridad_nivel';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion'];
}
