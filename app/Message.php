<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'tbl_cm_messages';
    protected $primarykey = 'id';
    protected $fillable = ['sender_id','recipient_id', 'body'];
}
