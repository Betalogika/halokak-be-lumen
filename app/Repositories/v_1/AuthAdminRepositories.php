<?php

namespace App\Repositories\v_1;

use App\Models\Admin;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ProfileResource;

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

    public function profileRepositories()
    {
        if ($data = Profile::whereusers_id(Auth::guard('admin')->user()->id)->first()) {
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
            $data['users_id'] = Auth::guard('admin')->user()->id;
            Profile::updateOrCreate(
                ['users_id' => Auth::guard('admin')->user()->id],
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
