<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoblacionalPrograma extends Model
{
   	
   	public $timestamps = false;
    protected $table = 'tbl_pr_poblacional_beneficiarios';
    protected $primarykey = 'id';
    protected $fillable = ['ficha_id', 'grupo_pcs'];

}
