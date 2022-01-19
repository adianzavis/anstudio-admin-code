<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder {
    public function run() {
        DB::table('companies')->insert([
            'name' => 'anstudio s.r.o.',
            'description' => 'This is our primary company. We are duty of paying VAT.
            Our place is in Senica on 3th floor address Hurbanova 40/A. We enjoy every
            moment in our lives and the one we love the most is our job.',
        ]);
    }
}
