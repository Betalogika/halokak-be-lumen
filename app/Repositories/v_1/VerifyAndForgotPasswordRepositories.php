<?php

namespace App\Repositories\v_1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RoleModels;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use App\Mail\SuccessChangePassword;
use App\Models\forgotPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\verifyAccount as ModelVerify;


trait VerifyAndForgotPasswordRepositories
{
    public function response()
    {
        return new Controller;
    }
    public function checkVerifyRepositories($tokenURL)
    {
        try {
            $token = ModelVerify::wheretoken($tokenURL)->firstOrFail();
            $user = array(
                'id' => User::whereId($token->users_id)->first()->id,
                'username' => User::whereId($token->users_id)->first()->username,
                'email' => User::whereId($token->users_id)->first()->email,
                'verify' => User::whereId($token->users_id)->first()->verify == 'N' ? 'akun belum aktif' : 'akun sudah aktif',
                'created_at' => User::whereId($token->users_id)->first()->created_at,
                'updated_at' => User::whereId($token->users_id)->first()->updated_at,
                'role' => RoleModels::whereId(User::whereId($token->users_id)->first()->role_id)->first(),
                'token' => $token->token,
            );
            $result = $this->response()->ok($user);
        } catch (\Exception $error) {
            $result = $this->response()->error('token salah atau token sudah kadaluarsa');
        }
        return $result;
    }

    public function verifyUsersRepositories($tokenURL)
    {
        try {
            $token = ModelVerify::wheretoken($tokenURL)->first();
            User::whereId($token->users_id)->update(['verify' => 'Y']);
            ModelVerify::wheretoken($tokenURL)->delete();  //after success verify and then delete token verify
            $result = $this->response()->ok(User::whereId($token->users_id)->first(), 'Akun Anda Sudah Aktif silahkan lakukan login');
        } catch (\Exception $error) {
            $result = $this->response()->error('token salah atau token sudah kadaluarsa');
        }
        return $result;
    }

    public function forgotPasswordRepositories($request)
    {
        try {
            $user = User::whereemail($request->email)->first();
            $url = forgotPasswords::create(['token' => Str::random(64), 'users_id' => $user->id]);
            Mail::to($request->email)->send(new ForgotPassword($user, $this->response()->urlForgot($url)));
            return $this->response()->ok('berhasil kirim link forgot password');
        } catch (\Exception $error) {
            return $this->response()->error('Email tidak ditemukan');
        }
    }

    public function changePasswordRespositories($tokenURL, $request)
    {
        try {
            $token = forgotPasswords::wheretoken($tokenURL)->first();
            $user = User::whereId($token->users_id)->first();
            if ($request->email != $user->email) return $this->response()->error('email salah'); //check target email yang dijadikan untuk reset password
            $user->update(['password' => Hash::make($request->password)]);
            Mail::to($user->email)->send(new SuccessChangePassword($user, $this->response()->urlLogin()));
            forgotPasswords::wheretoken($tokenURL)->delete(); //after success change password then delete token reset pass
            return $this->response()->ok($user, 'password berhasil di reset');
        } catch (\Exception $error) {
            return $this->response()->error('token salah atau token sudah kadaluarsa');
        }
    }
}
