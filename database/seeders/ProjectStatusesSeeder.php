<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectStatusesSeeder extends Seeder {
	public function run() {
		DB::table('project_statuses')->insert([
			[
				'name' => 'Initialized',
			],
			[
				'name' => 'Discussion',
			],
			[
				'name' => 'Accepted',
			],
			[
				'name' => 'Work in progress',
			],
			[
				'name' => 'Done',
			],
			[
				'name' => 'Repeating',
			],
		]);
	}
}
