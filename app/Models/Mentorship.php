<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Mentorship extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'room';

    protected $fillable = ['title', 'desc', 'code', 'mentor', 'status', 'mentee'];

    protected $hidden = ['_id'];
}
