<?php

namespace App\Interface;

use Illuminate\Http\Request;


interface MentorInterface
{
    public function login(Request $request);
    public function register(Request $request);
    public function logout();
    public function verifyMentor($tokenURL);
}
