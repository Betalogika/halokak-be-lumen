<?php

namespace App\Repositories\v_1;

use App\Models\User;
use App\Models\Profile;
use App\Models\RoleModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyAccount as MailVerify;
use App\Models\verifyAccount as ModelVerify;

trait AuthUsersRepositories
{
    public static function response()
    {
        return new Controller;
    }

    public function loginRepositories($request)
    {
        if ($email = User::whereemail($request->umail)->first()) { //cek email jika email benar maka login pakai email
            $user = $email;
        } elseif ($username = User::whereusername($request->umail)->first()) { // akan tetapi jika email salah maka kemudian lanjut cek username dan jika username benar maka login pakai username
            $user = $username;
        } else {
            return $this->response()->error('email atau username salah');
        }

        if (!Hash::check($request->password, $user->password)) { //ambil var user berdasarkan kondisi login yang dia(users) gunakan(email/password)
            $result = $this->response()->error('Password salah');
        } else if ($user->verify != 'Y') {
            $result = $this->response()->error('Akun Anda belum diverifikasi, silakan cek email atau hubungi Admin');
        } else if ($user->role_id != 5) {
            $result = $this->response()->error('Login ini khusus untuk user, dan anda bukan user');
        } else {
            $dataUser = array(
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'status' => $user->verify == 'Y' ? 'aktif' : 'inactive',
                'role' => RoleModels::whereId($user->role_id)->first(),
                'profile' => Profile::whereusers_id($user->id)->first(),
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'token' =>  $user->createToken('halokak')->accessToken,
            );
            $result = $this->response()->ok($dataUser, 'Succesfully Login');
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
            $result = $this->response()->ok($user, 'Registrasi berhasil, silakan cek email untuk melanjutkan proses verifikasi');
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

    public function profileRepositories()
    {
        if ($data = Profile::whereusers_id(Auth::guard('user')->user()->id)->first()) {
            $profile = $this->response()->ok(new ProfileResource($data), 'Successfuly Data');
        } else {
            $profile = $this->response()->error('Profile Belum ada');
        }
        return $profile;
    }

    public function ProfileUpdateOrCreateRepositories($data)
    {
        DB::beginTransaction();
        try {
            if (isset($data['photo'])) {
                $data['photo'] = $this->response()->imageToUrl($data['photo']); // upload foto real
            } else {
                $data['photo'] = 'https://alibabaspaces.betalogika.tech/img/imgdef.png'; //photo default if not upload real photos
            }
            $data['users_id'] = Auth::guard('user')->user()->id;
            Profile::updateOrCreate(
                ['users_id' => Auth::guard('user')->user()->id],
                $data,
            );
            DB::commit();
            return $this->response()->ok($data, 'Successfully Create Photo Profiles');
        } catch (\Exception $errors) {
            DB::rollBack();
            return $this->response()->error($errors);
        }
    }
}
