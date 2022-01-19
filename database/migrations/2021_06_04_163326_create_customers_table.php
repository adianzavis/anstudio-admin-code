<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration {

    public function up() {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('position')->nullable();
            $table->string('based');
            $table->string('phone');
            $table->string('email');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('description')->nullable();

            //Invoice info
            $table->foreignId('invoice_detail_id')->nullable()->constrained('invoice_details');

            $table->string('avatar')->nullable();

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('customers');
    }
}
