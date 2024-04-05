<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //línea necesaria

class ProgramaGrupo extends Model
{
	use SoftDeletes; //Implementamos 
    protected $dates = ['deleted_at']; //Registramos la nueva columna    
    protected $table = 'tbl_pr_grupos';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_grupo',
							'tenantId',
							'lugar_id',
							'disciplina_id',
							'user_id',
							'observaciones',
							'estado'

];


}
