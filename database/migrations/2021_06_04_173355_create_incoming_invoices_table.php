<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingInvoicesTable extends Migration {
    public function up() {
        Schema::create('incoming_invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('seller')->constrained('invoice_details');
            $table->foreignId('buyer')->constrained('invoice_details');

            $table->foreignId('company')->constrained('invoice_details');
            $table->foreignId('customer')->constrained('invoice_details');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('incoming_invoices');
    }
}
