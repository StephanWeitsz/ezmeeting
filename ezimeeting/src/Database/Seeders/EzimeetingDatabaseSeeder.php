<?php

namespace Mudtec\Ezimeeting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EzimeetingDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Mudtec\Ezimeeting\Database\Seeders\EzimeetingRoleSeeder::class,
            \Mudtec\Ezimeeting\Database\Seeders\EzimeetingUserSeeder::class,
        ]);
    }
}


