<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblCmConfig extends Model
{

	protected $table = 'tbl_cm_config';
    protected $primarykey = 'id';
    protected $fillable = [
        'name', 'value'
    ];
}
