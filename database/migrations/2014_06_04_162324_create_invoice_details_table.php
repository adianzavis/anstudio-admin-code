<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration {

    public function up() {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();

            $table->string('company');
            $table->string('street');
            $table->string('city');
            $table->string('postcode');
            $table->string('country');
            $table->boolean('dph')->default(0);
            $table->string('ico');
            $table->string('dic')->nullable();
            $table->string('icdph')->nullable();

            $table->foreignId('old_invoice')->nullable()->constrained('invoice_details');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('invoice_details');
    }
}
