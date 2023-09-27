<?php

namespace App\Repositories\v_1;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        if (!$user = Admin::whereemail($request->email)->first()) {
            $result = $this->response()->error('email salah');
        } elseif (!Hash::check($request->password, $user->password)) {
            $result = $this->response()->error('password salah');
        } else if ($user->verify != 'Y') {
            $result = $this->response()->error('akun anda belum terverifikasi');
        } else if ($user->role_id != 3) {
            $result = $this->response()->error('login ini khusus untuk admin, dan anda bukan admin');
        } else {
            $result = $this->response()->ok(array('user' => $user, 'token' => $user->createToken('halokak')->accessToken), 'Succesfully Login');
        }
        return $result;
    }

    public function registerRepositories($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only('username', 'email', 'verify', 'password', 'role_id');
            $data['password'] = Hash::make($request->password);
            $data['verify'] = 'N';
            $data['role_id'] = 3;
            $result = $this->response()->ok(Admin::create($data), 'Sucessfully Register');
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            $result = $this->response()->error($error, 500);
        }
        return $result;
    }

    public function logoutRepositories()
    {
        return Auth::guard('admin')->user()->token()->delete();
    }
}
