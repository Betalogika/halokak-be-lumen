<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interface\VerifyAndFogotPasswordInterface;
use App\Repositories\v_1\VerifyAndForgotPasswordRepositories;

class VerifyAndForgotPasswordControllers extends Controller implements VerifyAndFogotPasswordInterface
{
    use VerifyAndForgotPasswordRepositories;

    public function checkVerify($tokenURL)
    {
        return $this->checkVerifyRepositories($tokenURL);
    }

    public function checkForgot($tokenURL)
    {
        return $this->checkForgotRepositories($tokenURL);
    }

    public function verifyUsers($tokenURL)
    {
        return $this->verifyUsersRepositories($tokenURL);
    }


    public function forgotPassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'email|required',
        ], [
            'required' => 'Email wajib di isi',
            'email' => 'Penulisan email tidak benar'
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
            'password' => 'required|confirmed',
        ], [
            'email' => 'penulisan email tidak benar',
            'confirmed' => 'password tidak sama',
        ]);
        if ($validate->fails()) {
            $result = $this->customError($validate->errors());
        } else {
            $result = $this->changePasswordRespositories($tokenURL, $request);
        }
        return $result;
    }
}
