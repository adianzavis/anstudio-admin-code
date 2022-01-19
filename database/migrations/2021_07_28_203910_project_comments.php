<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectComments extends Migration {

    public function up() {
        Schema::create('project_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('project_id')->constrained('projects');
            $table->longText('comment');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('project_comments');
    }
}
