<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformVersion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platform = ['android', 'ios', 'web'];

        for ($x = 0; $x <= count($platform) - 1; $x++) {
            DB::table('platform_version')->insert([
                'platform' => $platform[$x],
                'version' => '1.0.0',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
