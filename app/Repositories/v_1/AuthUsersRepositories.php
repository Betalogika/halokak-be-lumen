<?php

namespace App\Repositories\v_1;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\VerifyAccount as MailVerify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\verifyAccount as ModelVerify;
use Illuminate\Support\Facades\Mail;

trait AuthUsersRepositories
{
    public static function response()
    {
        return new Controller;
    }

    public function loginRepositories($request)
    {
        if (!$user = User::whereemail($request->email)->first()) {
            $result = $this->response()->error('email salah');
        } elseif (!Hash::check($request->password, $user->password)) {
            $result = $this->response()->error('password salah');
        } else if ($user->verify != 'Y') {
            $result = $this->response()->error('akun anda belum terverifikasi');
        } else if ($user->role_id != 5) {
            $result = $this->response()->error('login ini khusus untuk user, dan anda bukan user');
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
            $data['role_id'] = 5;
            $user = User::create($data);
            $url = ModelVerify::create(['token' => Str::random(64), 'users_id' => $user->id]); //send to link verify account via email
            DB::commit();
            Mail::to($user->email)->send(new MailVerify($user, $this->response()->urlVerify($url)));
            $result = $this->response()->ok($user, 'Sucessfully Register');
        } catch (\Exception $error) {
            DB::rollBack();
            $result = $this->response()->error('kesalahan sistem', 500, $error);
        }
        return $result;
    }

    public function logoutRepositories()
    {
        return Auth::guard('user')->user()->token()->delete();
    }
}
