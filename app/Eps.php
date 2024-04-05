<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
    
    protected $table = 'tbl_gen_eps';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion', 'id_regimen'];


}
