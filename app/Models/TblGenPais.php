<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenPais extends Model
{

    protected $table      = 'tbl_gen_paises';
    protected $primaryKey = 'id_paises';
    protected $fillable   = ['iso', 'nombre'];

}
