<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectUserTable extends Migration {
    public function up() {
        Schema::create('project_user', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('project_user');
    }
}
