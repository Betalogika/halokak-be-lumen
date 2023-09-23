<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Articles extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'articles';

    protected $guarded = ['_id'];
}
