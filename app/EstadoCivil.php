<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    
    protected $table = 'tbl_gen_estado_civil';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion'];

}
