<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Diskon extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'diskon';

    protected $guarded = ['_id'];
}
