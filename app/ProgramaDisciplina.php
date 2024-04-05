<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramaDisciplina extends Model
{
    
    protected $table = 'tbl_pr_disciplinas';
    protected $primarykey = 'id';
    protected $fillable = [
    	'nombre_disciplina',
		'tenantId',
		'descripcion',
		'estado'
		];
}
