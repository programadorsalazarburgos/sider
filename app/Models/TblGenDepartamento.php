<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenDepartamento extends Model
{

    protected $table      = 'tbl_gen_departamento';
    protected $primaryKey = 'id';
    protected $fillable   = ['nombre'];

}
