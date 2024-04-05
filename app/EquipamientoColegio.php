<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipamientoColegio extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_cm_colegios_x_equipamiento';
    protected $primarykey = 'id';
    protected $fillable = ['sede_id', 'equipamiento_id', 'cantidad'];

}
