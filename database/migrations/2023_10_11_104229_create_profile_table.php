<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->date('tanggal_lahir')->date_format('YYYY-MM-DD');
            $table->string('tempat_lahir');
            $table->string('negara');
            $table->string('provinsi');
            $table->string('kecamatan');
            $table->string('kota_kabupaten');
            $table->string('alamat_lengkap');
            $table->integer('umur');
            $table->string('universitas');
            $table->string('fakultas');
            $table->string('jurusan');
            $table->string('gelar_depan');
            $table->string('gelar_belakang');
            $table->string('about');
            $table->string('photo');
            $table->foreignId('users_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
