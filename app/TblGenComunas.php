<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblGenComunas extends Model
{

    protected $table      = 'tbl_gen_comunas';
    protected $primarykey = 'id';
    protected $fillable   = ['codigo_comuna', 'nombre_comuna', 'zona_id'];

}
