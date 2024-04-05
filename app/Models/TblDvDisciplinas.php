<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvDisciplinas extends Model
{
	protected $table = 'tbl_dv_disciplinas';
	protected $primaryKey = 'id';
	protected $fillable = ['descripcion'];

}
