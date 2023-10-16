<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class forgotPasswords extends Model
{
    protected $connection = 'mysql';

    protected $table = 'forgot_password';

    protected $fillable = ['token', 'users_id', 'created_at', 'updated_at'];
}
