<?php

namespace App\Repositories\v_1;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\RoleModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait AuthAdminRepositories
{
    public static function response()
    {
        return new Controller;
    }

    public function loginRepositories($request)
    {
        if ($email = Admin::whereemail($request->umail)->first()) {
            $user = $email;
        } else if ($username = Admin::whereusername($request->umail)->first()) {
            $user = $username;
        } else {
            return $this->response()->error('Email atau username salah');
        }
        if (!Hash::check($request->password, $user->password)) {
            $result = $this->response()->error('password salah');
        } else if ($user->verify != 'Y') {
            $result = $this->response()->error('akun anda belum terverifikasi');
        } else if ($user->role_id != 3) {
            $result = $this->response()->error('login ini khusus untuk admin, dan anda bukan admin');
        } else {
            $admin = $user;
            $admin['role'] = RoleModels::whereId($admin['role_id'])->first();
            $admin['profile'] = Profile::whereusers_id($admin['id'])->first();
            $admin['token'] = $user->createToken('halokak')->accessToken;
            $result = $this->response()->ok($admin, 'Succesfully Login');
        }
        return $result;
    }

    public function logoutRepositories()
    {
        return Auth::guard('admin')->user()->token()->delete();
    }
}
