<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DepartmentProject extends Migration {
    public function up() {
        Schema::create('department_project', function (Blueprint $table) {
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('project_id')->constrained('projects');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('department_project');
    }
}
