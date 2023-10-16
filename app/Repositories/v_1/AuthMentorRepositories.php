<?php

namespace App\Repositories\v_1;

use App\Models\Mentor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\verifyAccount as ModelVerify;
use App\Mail\VerifyAccount as MailVerify;



trait AuthMentorRepositories
{
    public static function response()
    {
        return new Controller;
    }

    public function loginRepositories($request)
    {
        if (!$user = Mentor::whereemail($request->email)->first()) {
            $result = $this->response()->error('email salah');
        } elseif (!Hash::check($request->password, $user->password)) {
            $result = $this->response()->error('password salah');
        } else if ($user->verify != 'Y') {
            $result = $this->response()->error('akun anda belum terverifikasi');
        } else if ($user->role_id != 7) {
            $result = $this->response()->error('login ini khusus untuk mentor, dan anda bukan mentor');
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
            $data['role_id'] = 7;
            $mentor = Mentor::create($data);
            $url = ModelVerify::create(['token' => Str::random(64), 'users_id' => $mentor->id]); //send to link verify account via email
            DB::commit();
            Mail::to($mentor->email)->send(new MailVerify($mentor, $this->response()->urlVerify($url)));
            $result = $this->response()->ok($mentor, 'Sucessfully Register Mentor');
        } catch (\Exception $error) {
            DB::rollBack();
            $result = $this->response()->error($error, 500);
        }
        return $result;
    }

    public function logoutRepositories()
    {
        return Auth::guard('mentor')->user()->token()->delete();
    }
}
