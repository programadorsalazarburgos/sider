<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{

    protected $table = 'tbl_gen_metas';
    protected $primarykey = 'id';
    protected $fillable = [
                            'nombre_meta',
                            'periodo',
                            'programa_id',
                            'meta',
                            'descripcion'];

}
