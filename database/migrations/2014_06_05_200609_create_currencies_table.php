<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration {
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->string('iso')->primary();
            $table->string('symbol');
            $table->boolean('symbol_before_amount')->default(0);
        });
    }

    public function down() {
        Schema::dropIfExists('currencies');
    }
}
