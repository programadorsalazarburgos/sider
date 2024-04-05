<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    protected $primarykey = 'id';
    protected $fillable = ['type', 'notifiable_id', 'notifiable_type', 'data', 'read_at'];

}
