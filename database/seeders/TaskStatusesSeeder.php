<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusesSeeder extends Seeder {
    public function run() {
        DB::table('task_statuses')->insert([
            [
                'name' => 'Todo',
            ],
            [
                'name' => 'Working',
            ],
            [
                'name' => 'On review',
            ],
            [
                'name' => 'Done',
            ],
        ]);
    }
}
