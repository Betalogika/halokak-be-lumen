<?php

namespace App\Interface;

use Illuminate\Http\Request;


interface AdminInterface
{
    public function login(Request $request);
    public function register(Request $request);
    public function logout();
}
