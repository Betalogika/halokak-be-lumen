<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface VerifyAndFogotPasswordInterface
{
    public function checkVerify($tokenURL);
    public function verifyUsers($tokenURL);
    public function forgotPassword(Request $request);
    public function changePassword($tokenURL, Request $request);
}
