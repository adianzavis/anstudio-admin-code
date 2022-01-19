<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTaskTable extends Migration {
    public function up() {
        Schema::create('project_task', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('task_id')->constrained('tasks');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('project_task');
    }
}
