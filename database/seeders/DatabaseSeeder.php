<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        DB::table('users')->insert([
            'email' => "manusiakemos@gmail.com",
            'username' => "super-admin",
            'password' => Hash::make("123123"),
            'name' => "Hafiz Nugraha",
            'avatar' => "",
            'phone' => "085715397145",
            'role' => "super-admin",
        ]);
    }
}
