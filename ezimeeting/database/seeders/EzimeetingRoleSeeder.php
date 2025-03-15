<?php

namespace Mudtec\Ezimeeting\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Mudtec\Ezimeeting\Models\Role;


class EzimeetingRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'description' => "Super User" ,
            'text' => "Super User",
            'is_active' => true,
        ]);

        Role::create([
            'description' => "Admin",
            'text' => "Administrator",
            'is_active' => true,
        ]);

        Role::create([
            'description' => "User",
            'text' => "System User",
            'is_active' => true,
        ]);

    }
}
