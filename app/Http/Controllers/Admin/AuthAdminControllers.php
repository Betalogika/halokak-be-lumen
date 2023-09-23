<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interface\AdminInterface;
use Illuminate\Http\Request;
use App\Repositories\v_1\AuthAdminRepositories;

class AuthAdminControllers extends Controller implements AdminInterface
{
    use AuthAdminRepositories;
}
