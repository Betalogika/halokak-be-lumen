<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class verifyAccount extends Model
{
    protected $connection = 'mysql';

    protected $table = 'verify_account_table';

    protected $fillable = ['token', 'users_id', 'created_at', 'updated_at'];
}
