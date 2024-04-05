<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoPoblacional extends Model
{
    

    protected $table = 'tbl_gen_grupo_poblacional';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion'];

}
