<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaludRegimen extends Model
{
    

    protected $table = 'tbl_gen_salud_regimen';
    protected $primarykey = 'tbl_regimen_salud';
    protected $fillable = ['descripcion'];


}
