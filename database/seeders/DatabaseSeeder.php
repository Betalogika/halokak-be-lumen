<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleUsers::class,
            AdminSeeders::class,
            MentorSeeders::class,
            UsersSeeders::class,
            PlatformVersion::class,
        ]);
    }
}
