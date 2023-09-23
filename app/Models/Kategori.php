<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Kategori extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'kategori';

    protected $guarded = ['_id'];
}
