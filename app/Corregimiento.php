<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corregimiento extends Model
{
    

    protected $table = 'tbl_gen_corregimientos';
    protected $primarykey = 'id';
    protected $fillable = ['codigo_unico', 'descripcion', 'estrato'];


}




