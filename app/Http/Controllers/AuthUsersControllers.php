<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interface\UsersInterface;
use Illuminate\Support\Facades\Validator;
use App\Repositories\v_1\AuthUsersRepositories;

class AuthUsersControllers extends Controller implements UsersInterface
{
    use AuthUsersRepositories;

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

    public function profile(Request $request)
    {
    }
}
