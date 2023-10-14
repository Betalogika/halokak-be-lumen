<?php

namespace App\Http\Resources;

use App\Models\RoleModels;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private static function mapUser($user)
    {
        return array(
            "id" =>  $user->id,
            "username" =>  $user->username,
            "email" =>  $user->email,
            "verify" =>  $user->verify == 'Y' ? 'active' : 'inactive',
            "role" =>  RoleModels::whereId($user->role_id)->first(),
            "created_at" => $user->created_at,
            "updated_at" => $user->updated_at,
        );
    }
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nama_lengkap" => $this->nama_lengkap,
            "nama_panggilan" => $this->nama_panggilan,
            "tanggal_lahir" => $this->tanggal_lahir,
            "tempat_lahir" => $this->tempat_lahir,
            "negara" => $this->negara,
            "provinsi" => $this->provinsi,
            "kecamatan" => $this->kecamatan,
            "kota_kabupaten" => $this->kota_kabupaten,
            "alamat_lengkap" => $this->alamat_lengkap,
            "umur" => $this->umur,
            "universitas" => $this->universitas,
            "fakultas" => $this->fakultas,
            "jurusan" => $this->jurusan,
            "gelar_depan" => $this->gelar_depan,
            "gelar_belakang" => $this->gelar_belakang,
            "about" => $this->about,
            "photo" => $this->photo,
            "user" => $this->mapUser(User::whereId($this->users_id)->first()),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
