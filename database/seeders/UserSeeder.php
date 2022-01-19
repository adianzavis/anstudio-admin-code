<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run() {
        DB::table('users')->insert([
            'name' => 'Adrian',
            'surname' => 'Zavis',
            'email' => 'asdf@asdf.sk',
            'password' => Hash::make('asdf'),
        ]);
    }
}
