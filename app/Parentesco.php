<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model
{
    

    protected $table = 'tbl_gen_parentesco';
    protected $primarykey = 'id_persona_parentesco';
    protected $fillable = ['descripcion'];

}
