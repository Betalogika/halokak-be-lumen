<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Interface\AdminInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\v_1\AuthAdminRepositories;

class AuthAdminControllers extends Controller implements AdminInterface
{
    use AuthAdminRepositories;

    public function login(Request $request)
    {
        $validatior = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validatior->fails()) {
            $result = $this->customError($validatior->errors());
        } else {
            $result = $this->loginRepositories($request);
        }
        return $result;
    }

    public function register(Request $request)
    {
    }

    public function logout(Request $request)
    {
    }
}
