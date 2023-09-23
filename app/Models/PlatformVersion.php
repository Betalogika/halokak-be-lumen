<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformVersion extends Model
{
    protected $connection = 'mysql';

    protected $table = 'platform_version';
}
