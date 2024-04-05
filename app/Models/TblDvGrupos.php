<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvGrupos extends Model
{

    protected $table      = 'tbl_dv_grupos';
    protected $primarykey = 'id';
    protected $fillable   = ['id_escenario','id_metodologo','id_disciplina','id_monitor','id_nivel','observaciones','codigo_grupo','fecha_registro','activo'];
}
