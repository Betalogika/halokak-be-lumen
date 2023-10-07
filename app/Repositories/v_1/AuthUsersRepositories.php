<?php

namespace App\Repositories\v_1;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount as MailVerify;
use App\Models\forgotPasswords;
use App\Models\RoleModels;
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

    public function checkVerifyRepositories($tokenURL)
    {
        try {
            $token = ModelVerify::wheretoken($tokenURL)->firstOrFail();
            $user = array(
                'id' => User::whereId($token->users_id)->first()->id,
                'username' => User::whereId($token->users_id)->first()->username,
                'email' => User::whereId($token->users_id)->first()->email,
                'role_id' => RoleModels::whereId(User::whereId($token->users_id)->first()->role_id)->first(),
                'verify' => User::whereId($token->users_id)->first()->verify == 'N' ? 'akun belum aktif' : 'akun sudah aktif',
            );
            $data = array('id' => $token->id, 'token' => $token->token, 'users' => $user);
            $result = $this->response()->ok($data);
        } catch (\Exception $error) {
            $result = $this->response()->error('token salah', 500, $error);
        }
        return $result;
    }

    public function verifyUsersRepositories($tokenURL)
    {
        try {
            $token = ModelVerify::wheretoken($tokenURL)->first();
            $user = User::whereId($token->users_id)->update(['verify' => 'Y']);
            $result = $this->response()->ok($user, 'Akun Anda Sudah Aktif silahkan lakukan login');
        } catch (\Exception $error) {
            $result = $this->response()->error('token salah', 500, $error);
        }
        return $result;
    }

    public function forgotPasswordRepositories($request)
    {
        try {
            $user = User::whereemail($request->email)->first();
            $url = forgotPasswords::create(['token' => Str::random(64), 'users_id' => $user->id]);
            Mail::to($request->email)->send(new ForgotPassword($this->response()->urlForgot($url)));
            return $this->response()->ok('berhasil kirim link forgot password');
        } catch (\Exception $error) {
            return $this->response()->error($error, 500);
        }
    }

    public function changePasswordRespositories($tokenURL, $request)
    {
        try {
            $token = forgotPasswords::wheretoken($tokenURL)->first();
            $user = User::whereId($token->users_id)->first();
            if ($request->email != $user->email) return $this->response()->error('email salah'); //check target email yang dijadikan untuk reset password
            if (!Hash::check($request->password_lama, $user->password)) return $this->response()->error('password lama salah'); // check password lama
            $user->update(['password' => Hash::make($request->password_baru)]);
            return $this->response()->ok($user, 'password berhasil di reset');
        } catch (\Exception $error) {
            return $this->response()->error('token salah', 500, $error);
        }
    }
}
