<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration {
	public function up() {
		Schema::create('tasks', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('duration');
			$table->string('duration_budget');
			$table->string('money_budget');
			$table->longText('description')->nullable();
			$table->dateTime('start');
			$table->dateTime('deadline');

			$table->integer('order');
            $table->string('currency_iso');
			$table->foreignId('status_id')->constrained('task_statuses');
			$table->foreignId('project_id')->nullable()->constrained('projects');

			$table->timestamps();

            $table->foreign('currency_iso')->references('iso')->on('currencies');
		});
	}

	public function down() {
		Schema::dropIfExists('tasks');
	}
}
