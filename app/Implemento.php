<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Implemento extends Model
{

    protected $table = 'tbl_cm_implementos';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_implemento'];
}
