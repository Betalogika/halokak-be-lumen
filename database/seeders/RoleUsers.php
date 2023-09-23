<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maprole = ['admin', 'users', 'mentor'];
        $idrole = [3, 5, 7];
        for ($x = 0; $x <= count($maprole) - 1; $x++) {
            DB::table('role')->insert([
                'id' => $idrole[$x],
                'name' => $maprole[$x],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
