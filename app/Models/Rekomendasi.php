<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Rekomendasi extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'rekomendasi';

    protected $guarded = ['_id'];
}
