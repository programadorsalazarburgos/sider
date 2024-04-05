<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{

    protected $table = 'tbl_cm_grados';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_grado'];


}
