<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->string('password');

            //Personal
            $table->string('name');
            $table->string('surname');
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->string('description')->nullable();

            //Address
            $table->string('street')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            //Invoice info
            $table->string('iban')->nullable();
            $table->foreignId('invoice_detail_id')->nullable()->constrained('invoice_details');

            $table->string('avatar')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}
