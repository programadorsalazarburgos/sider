<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    
    protected $table = 'tbl_cm_modalidades';
    protected $primarykey = 'id';
    protected $fillable = ['nombre'];
}
