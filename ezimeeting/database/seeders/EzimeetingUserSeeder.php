<?php

namespace Mudtec\Ezimeeting\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Mudtec\Ezimeeting\Models\Role;


class EzimeetingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superRole = Role::where('description', 'Super User')->first();
        $adminRole = Role::where('description', 'Admin')->first();
        $userRole = Role::where('description', 'User')->first();

        User::create([
            'name' => "admin",
            'email' => "stevewe@me.com",
            'email_verified_at' => now(),
            'IDnumber' => 'NA',
            'password' => bcrypt('Passw0rd'),
            'remember_token' => Str::random(10),
        ])->assignRole($superRole);

        User::create([
            'name' => "Stephan Weitsz",
            'email' => "jstevewe@gmail.com",
            'email_verified_at' => now(),
            'IDnumber' => 'NA',
            'password' => bcrypt('Passw0rd'),
            'remember_token' => Str::random(10),
        ])->assignRole($adminRole);

        User::create([
            'name' => "Shawn Jordaan",
            'email' => "darth.jordy@gmail.com",
            'email_verified_at' => now(),
            'IDnumber' => 'NA',
            'password' => bcrypt('Passw0rd'),
            'remember_token' => Str::random(10),
        ])->assignRole($adminRole);

        User::factory()->count(10)->create()->assignRole($userRole);
    }
}
