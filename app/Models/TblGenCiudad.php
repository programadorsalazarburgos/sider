<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TblGenCiudad extends Model
{
    protected $table      = 'tbl_gen_ciudad';
    protected $primaryKey = 'id';
    protected $fillable   = ['nombre', 'id_departamento'];

}
