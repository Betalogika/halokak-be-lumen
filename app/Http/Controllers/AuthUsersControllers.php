<?php

namespace App\Http\Controllers;

use App\Interface\UsersInterface;
use Illuminate\Http\Request;
use App\Repositories\v_1\AuthUsersRepositories;

class AuthUsersControllers extends Controller implements UsersInterface
{
    use AuthUsersRepositories;
}
