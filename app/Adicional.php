<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    
    protected $table = 'tbl_pr_adicionales';
    protected $primarykey = 'id';
    protected $fillable = [	'ficha_id',
    						'codigo',
							'disciplina_id',
							'pertenece_a',
							'nombre_club'
];

}
