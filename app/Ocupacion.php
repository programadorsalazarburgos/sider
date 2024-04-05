<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    

    protected $table = 'tbl_gen_ocupacion';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion', 'activo'];

}
