<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemTable extends Migration {
    public function up() {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit');
            $table->string('count');
            $table->string('price');

            $table->foreignId('invoice')->nullable()->constrained('incoming_invoices');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('invoice_items');
    }
}
