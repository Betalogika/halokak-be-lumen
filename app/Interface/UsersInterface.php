<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface UsersInterface
{
    public function login(Request $request);
    public function register(Request $request);
    public function logout();
    public function checkVerify($tokenURL);
    public function verifyUsers($tokenURL);
    public function forgotPassword($tokenURL);
    public function changePassword($email);
}
