<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Http\Request;
use App\Interface\MentorInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\v_1\AuthMentorRepositories;

class AuthMentorControllers extends Controller implements MentorInterface
{
    use AuthMentorRepositories;

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
