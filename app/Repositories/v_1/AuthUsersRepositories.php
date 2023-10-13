<?php

namespace App\Repositories\v_1;

use App\Models\User;
use App\Models\Profile;
use App\Models\RoleModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        if (!$user = User::whereemail($request->email)->first()) {
            $result = $this->response()->error('email salah');
        } elseif (!Hash::check($request->password, $user->password)) {
            $result = $this->response()->error('password salah');
        } else if ($user->verify != 'Y') {
            $result = $this->response()->error('akun anda belum terverifikasi');
        } else if ($user->role_id != 5) {
            $result = $this->response()->error('login ini khusus untuk user, dan anda bukan user');
        } else {
            $dataUser = array(
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'status' => $user->verify == 'Y' ? 'aktif' : 'inactive',
                'role_id' => RoleModels::whereId($user->role_id)->first(),
                'profile' => Profile::whereusers_id($user->id)->first(),
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            );
            $result = $this->response()->ok(array('user' => $dataUser, 'token' => $user->createToken('halokak')->accessToken), 'Succesfully Login');
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
            $result = $this->response()->ok($user, 'Sucessfully Register Users');
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
        return $this->response()->ok(Profile::whereusers_id(Auth::guard('user')->user()->id)->first(), 'Successfully Data Profiles');
    }

    public function updateOrCreateRepositories($data)
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
