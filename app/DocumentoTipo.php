<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //línea necesaria


class DocumentoTipo extends Model
{
    
    use SoftDeletes; //Implementamos 
    protected $dates = ['deleted_at']; //Registramos la nueva columna

    protected $table = 'tbl_gen_documento_tipo';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion', 'descripcion_2'];

}
