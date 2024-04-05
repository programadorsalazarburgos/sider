<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    protected $table = 'tbl_gen_titulos_academicos';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion'];
}
