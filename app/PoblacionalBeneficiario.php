<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoblacionalBeneficiario extends Model
{
    
	public $timestamps = false;
    protected $table = 'poblacional_beneficiarios';
    protected $primarykey = 'id';
    protected $fillable = ['ficha_id', 'grupo_pcs'];

}



