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
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            $result = $this->customError($validator->errors());
        } else {
            $result = $this->registerRepositories($request);
        }
        return $result;
    }

    public function logout()
    {
        return $this->ok($this->logoutRepositories(), 'Successfully Logout');
    }

    public function checkVerify($tokenURL)
    {
        return $this->checkVerifyRepositories($tokenURL);
    }

    public function verifyUsers($tokenURL)
    {
        return $this->verifyUsersRepositories($tokenURL);
    }


    public function forgotPassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'email|required',
        ]);

        if ($validate->fails()) {
            $result  = $this->customError($validate->errors());
        } else {
            $result =  $this->forgotPasswordRepositories($request);
        }
        return $result;
    }

    public function changePassword($tokenURL, Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'email|required',
            'password_lama' => 'required',
            'password_baru' => 'required',
        ]);
        if ($validate->fails()) {
            $result = $this->customError($validate->errors());
        } else {
            $result = $this->changePasswordRespositories($tokenURL, $request);
        }
        return $result;
    }
}
