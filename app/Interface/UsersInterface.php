<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface UsersInterface
{
    public function login(Request $request);
    public function register(Request $request);
    public function logout();
    public function profile();
    public function updateOrCreateProfile(Request $request);
}
