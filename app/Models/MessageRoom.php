<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class MessageRoom extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'chatroom';

    protected $fillable = ['message', 'code', 'mentor', 'created_at', 'updated_at'];

    protected $hidden = ['_id'];
}
