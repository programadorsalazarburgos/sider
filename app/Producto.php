<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    
    protected $table = 'productos';
    protected $primarykey = 'id';
    protected $fillable = ['nombre'];
}
