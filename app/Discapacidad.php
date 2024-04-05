<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    
    protected $table = 'tbl_gen_discapacidad';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion'];

}
