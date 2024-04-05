<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenBarrio extends Model
{

    protected $table      = 'tbl_gen_barrio';
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'codigo',
    	'id_estrato',
    	'nombre_barrio',
    	'id_barrio_tipo',
        'comuna_id'
    ];

}
