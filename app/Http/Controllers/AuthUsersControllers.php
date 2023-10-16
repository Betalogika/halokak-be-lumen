<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interface\UsersInterface;
use Illuminate\Support\Facades\Validator;
use App\Repositories\v_1\AuthUsersRepositories;

class AuthUsersControllers extends Controller implements UsersInterface
{
    use AuthUsersRepositories;

    public function login(Request $request)
    {
        $validatior = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validatior->fails()) {
            $result = $this->customError($validatior->errors());
        } else {
            $result = $this->loginRepositories($request);
        }
        return $result;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            $result = $this->customError($validator->errors());
        } else {
            $result = $this->registerRepositories($request);
        }
        return $result;
    }

    public function logout()
    {
        return $this->ok($this->logoutRepositories(), 'Successfully Logout');
    }

    public function profile()
    {
        return $this->profileRepositories();
    }

    public function updateOrCreate(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'nama_lengkap' => 'required|string',
            'nama_panggilan' => 'required|string',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'tempat_lahir' => 'required',
            'negara' => 'required',
            'provinsi' => 'required',
            'kecamatan' => 'required',
            'kota_kabupaten' => 'required',
            'alamat_lengkap' => 'required',
            'umur' => 'required|integer',
            'universitas' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'gelar_depan' => 'string',
            'gelar_belakang' => 'string',
            'about' => 'string',
            'photo' => 'string',
        ]);

        if ($validate->fails()) {
            $result = $this->customError($validate->errors());
        } else {
            $result = $this->updateOrCreateRepositories($data);
        }
        return $result;
    }
}
