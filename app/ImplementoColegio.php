<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImplementoColegio extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_cm_colegios_x_implementos';
    protected $primarykey = 'id';
    protected $fillable = ['sede_id', 'implemento_id', 'cantidad'];
}




