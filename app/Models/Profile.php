<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $connection = 'mysql';

    protected $table = 'profile';

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'tanggal_lahir',
        'tempat_lahir',
        'negara',
        'provinsi',
        'kecamatan',
        'kota_kabupaten',
        'alamat_lengkap',
        'umur',
        'universitas',
        'fakultas',
        'jurusan',
        'gelar_depan',
        'gelar_belakang',
        'about',
        'photo',
        'users_id',
        'created_at',
        'updated_at',
    ];
}
