<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etnia extends Model
{
    
    protected $table = 'tbl_gen_etnia';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion'];

}

