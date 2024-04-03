<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeneficiarioGrupo extends Model
{
    
    public $timestamps = false;
    protected $table = 'beneficiario_grupos';
    protected $primarykey = 'id';
    protected $fillable = [
					        'grupo_id',
							'id_persona_beneficiario',
							'fecha_inscripcion'
    ];

}
