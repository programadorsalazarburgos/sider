<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{

    protected $table = 'tbl_indicador_metas';
    protected $primarykey = 'id';
    protected $fillable = ['meta_id', 'mes', 'avance_meta', 'descripcion'];

}




