<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentUserTable extends Migration {
    public function up() {
        Schema::create('department_user', function (Blueprint $table) {
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('user_id')->constrained('users');
        });
    }

    public function down() {
        Schema::dropIfExists('department_user');
    }
}
