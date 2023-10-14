<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class MessageRoomMentee extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'chatroom';

    protected $fillable = ['message', 'code', 'mentee_user_id', 'created_at', 'updated_at'];

    protected $hidden = ['_id'];
}
