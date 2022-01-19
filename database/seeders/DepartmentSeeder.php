<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder {
    public function run() {
        DB::table('departments')->insert([
            [
                'name' => 'Programming',
            ],
            [
                'name' => 'Design',
            ],
            [
                'name' => 'Marketing',
            ],
            [
                'name' => 'Photography',
            ],
            [
                'name' => 'Management',
            ],
        ]);
    }
}
