<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Sponsor extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'sponsor';

    protected $guarded = ['_id'];
}
