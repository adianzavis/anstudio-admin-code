<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration {

	public function up() {
		Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();

            //Invoice info
            $table->foreignId('invoice_detail_id')->nullable()->constrained('invoice_details');

            $table->string('avatar')->nullable();

            $table->timestamps();
		});
	}

	public function down() {
		Schema::dropIfExists('projects');
	}
}
