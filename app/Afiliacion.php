<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afiliacion extends Model
{
    protected $table = 'tbl_gen_salud_regimen';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion'];

}
