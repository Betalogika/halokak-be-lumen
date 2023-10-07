<?php

namespace App\Repositories\v_1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RoleModels;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
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
            $token->delete(); //after success verify and then delete token verify
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
            $token->delete(); //after success delete token forgot password
        } catch (\Exception $error) {
            return $this->response()->error('token salah', 500, $error);
        }
    }
}
