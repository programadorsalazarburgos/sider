<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramaDiscapacidad extends Model
{
    
    public $timestamps = false;
    protected $table = 'tbl_pr_persona_x_discapacidad';
    protected $primarykey = 'id';
    protected $fillable = ['ficha_id', 'discapacidad_id'];

}
