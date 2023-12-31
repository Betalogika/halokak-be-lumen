<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Http\Request;
use App\Interface\MentorInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\v_1\AuthMentorRepositories;

class AuthMentorControllers extends Controller implements MentorInterface
{
    use AuthMentorRepositories;

    public function login(Request $request)
    {
        $validatior = Validator::make($request->all(), [
            'umail' => 'required',
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

    public function updateOrCreateProfile(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'nama_lengkap' => 'required|string',
            'nama_panggilan' => 'string|string',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'tempat_lahir' => 'string',
            'negara' => 'string',
            'provinsi' => 'string',
            'kecamatan' => 'string',
            'kota_kabupaten' => 'string',
            'alamat_lengkap' => 'string',
            'umur' => 'string|integer',
            'universitas' => 'string',
            'fakultas' => 'string',
            'jurusan' => 'string',
            'gelar_depan' => 'string',
            'gelar_belakang' => 'string',
            'about' => 'string',
            'photo' => 'string',
        ]);

        if ($validate->fails()) {
            $result = $this->customError($validate->errors());
        } else {
            $result = $this->ProfileUpdateOrCreateRepositories($data);
        }
        return $result;
    }
}
