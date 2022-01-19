<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            DepartmentSeeder::class,
            ProjectStatusesSeeder::class,
            TaskStatusesSeeder::class,
            CurrenciesSeeder::class,
        ]);
    }
}
