<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClubDeportivo extends Model
{
    protected $table = 'clubes_deportivos';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_club'];
}
